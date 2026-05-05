/**
 * White noise UI + myNoise-style stem engine (from white_noise.html).
 * Loads stereo stems from CDN, lookahead-schedules A/B buffers, per-band cubic gain.
 */
((q) => {
	var b = () => {};

	const placeButton = () => {
		let num = b.btnGroup.length;
		let space = Math.PI / (num - 1);
		let initialTime = 180;

		for (let i = 0; i < num; i++) {
			let x = 140 * Math.cos(Math.PI + i * space),
				y = 140 * Math.sin(Math.PI + i * space) + 25;
			b.btnGroup[i].style.transitionDuration = initialTime + i * 100 + 'ms';
			b.btnGroup[i].style.transform = `translate3d(${-x}px, ${-y}px, 0)`;
		}
	};

	const replaceButton = () => {
		let num = b.btnGroup.length;

		for (let i = num - 1; i >= 0; i--) {
			b.btnGroup[i].style.transitionDuration = 360 + 'ms';
			b.btnGroup[i].style.transform = `translate3d(0px, -25px, 0)`;
		}
	};

	/* --- Sound engine (ported from white_noise.html) --- */
	const iNUMBERBANDS = 10;
	const SCHEDULE_LOOKAHEAD = 0.5;
	const SCHEDULE_INTERVAL = 50;
	const fAUDIOFADETIME = 0.1;
	const fMASTERGAIN = 0.5;
	/** Very short master fade-in — audible within ~20–30 ms of pressing Play */
	const PLAY_FADE_IN_S = 0.025;
	/** Slightly longer fade-out on Stop to avoid clicks */
	const STOP_FADE_OUT_S = 0.35;

	let fileExt = '.mp3';
	let bSUPPORTOGG = 0;
	let context = null;
	let masterGain = null;
	let dynCompressor = null;
	let bufferList = [];
	let gainNode = [];
	let sourceA = [];
	let sourceB = [];
	let playbackFactor = [];
	let stretch = [];
	let interval = [];
	let nextA = [];
	let nextB = [];
	let lastPlayedA = [];
	let lastSchedulerTime = 0;
	let schedulerTimer = null;
	let launchCounter = 0;
	/** True after loadAllSounds() has been started — never load stems again on Play */
	let stemLoadStarted = false;
	let engineReady = false;
	let stemsStarted = false;
	let isplaying = false;

	/** Default / reset level (midpoint of -90…0 dBFS range) */
	const SLIDER_DEFAULT_DB = -45;
	/** dB per volume-up / volume-down button click (slider drag uses step=1 in HTML) */
	const SLIDER_BUTTON_STEP_DB = 6;

	let currentLevel = [];

	for (let i = 0; i < iNUMBERBANDS; i++) {
		playbackFactor[i] = 1;
		stretch[i] = 1;
		nextA[i] = 0;
		nextB[i] = 0;
		interval[i] = 0;
		lastPlayedA[i] = 0;
		currentLevel[i] = 0;
	}

	let sourceFileA = [];
	let sourceFileB = [];

	const BAND_LABELS = [
		'Sub-Bass',
		'Low Bass',
		'Bass',
		'High Bass',
		'Low Mids',
		'Mids',
		'High Mids',
		'Low Treble',
		'Treble',
		'High Treble'
	];

	function assignSources() {
		if (bSUPPORTOGG) {
			fileExt = '.ogg';
		}

		const base = 'https://mynoise.world/Data/WHITE/';
		const pairs = [
			['0b', '0a'],
			['1a', '1b'],
			['2a', '2b'],
			['3b', '3a'],
			['4a', '4b'],
			['5b', '5a'],
			['6a', '6b'],
			['7a', '7b'],
			['8a', '8b'],
			['9b', '9a']
		];
		sourceFileA = [];
		sourceFileB = [];
		for (let i = 0; i < iNUMBERBANDS; i++) {
			sourceFileA[i] = base + pairs[i][0] + fileExt;
			sourceFileB[i] = base + pairs[i][1] + fileExt;
		}
	}

	function loadWebAudioSound(url, index) {
		var request = new XMLHttpRequest();
		request.open('GET', url, true);
		request.responseType = 'arraybuffer';

		request.onload = function () {
			context.decodeAudioData(
				request.response,
				function onDecoded(decodedData) {
					if (decodedData.numberOfChannels === 1) {
						var stereo = context.createBuffer(2, decodedData.length, decodedData.sampleRate);
						var mono = decodedData.getChannelData(0);
						stereo.copyToChannel(mono, 0);
						stereo.copyToChannel(mono, 1);
						bufferList[index] = stereo;
					} else {
						bufferList[index] = decodedData;
					}
					countIn(index);
				},
				function onDecodeError() {
					console.warn('Stem decode failed, using silence placeholder:', index, url);
					var sr = context.sampleRate;
					var silent = context.createBuffer(2, Math.max(2, Math.floor(sr * 0.25)), sr);
					bufferList[index] = silent;
					countIn(index);
				}
			);
		};

		request.onerror = function () {
			console.warn('Stem load failed, retrying from origin:', url);
			var cdn = 'https://mynoise.world';
			if (url.indexOf(cdn) > -1) {
				loadWebAudioSound(url.substring(cdn.length), index);
			}
		};

		request.send();
	}

	/** One-time fetch + decode of all stem buffers (page load only; Play never calls this). */
	function loadAllSounds() {
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			loadWebAudioSound(sourceFileA[i], i);
		}
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			loadWebAudioSound(sourceFileB[i], i + iNUMBERBANDS);
		}
	}

	function updateStemLoadProgressUI() {
		var el =
			typeof b !== 'undefined' && b.displayInfo ? b.displayInfo : document.querySelector('.display-info span');
		if (!el) {
			return;
		}
		var total = iNUMBERBANDS * 2;
		var pct = Math.min(100, Math.round((launchCounter / total) * 100));
		el.textContent = 'Loading stems… ' + pct + '%';
	}

	function countIn(index) {
		launchCounter++;
		updateStemLoadProgressUI();
		if (launchCounter === iNUMBERBANDS * 2) {
			finishedLoading();
		}
	}

	function makeSource(buffer, rate) {
		const src = context.createBufferSource();
		src.buffer = buffer;
		src.playbackRate.value = rate;
		return src;
	}

	function computeIntervals() {
		var durA, durB;
		for (var i = 0; i < iNUMBERBANDS; ++i) {
			durA = Math.round(sourceA[i].buffer.duration * 8) / 8;
			durB = Math.round(sourceB[i].buffer.duration * 8) / 8;
			interval[i] = ((durA + durB) / 2) * stretch[i] / playbackFactor[i];
		}
	}

	function scheduleA(item, when, offset) {
		offset = offset || 0;

		var src = context.createBufferSource();
		src.buffer = bufferList[item];
		src.playbackRate.value = playbackFactor[item];
		src.connect(gainNode[item]);

		src.onended = function () {
			try {
				src.disconnect();
			} catch (e) {}
			src.onended = null;
		};

		src.start(when, offset);
		lastPlayedA[item] = when;
		sourceA[item] = src;
	}

	function scheduleB(item, when, offset) {
		offset = offset || 0;

		var src = context.createBufferSource();
		src.buffer = bufferList[item + iNUMBERBANDS];
		src.playbackRate.value = playbackFactor[item];
		src.connect(gainNode[item]);

		src.onended = function () {
			try {
				src.disconnect();
			} catch (e) {}
			src.onended = null;
		};

		src.start(when, offset);
		sourceB[item] = src;
	}

	function schedulerTick() {
		var now = context.currentTime;

		if (lastSchedulerTime > 0 && now - lastSchedulerTime > 2.0) {
			for (var i = 0; i < iNUMBERBANDS; i++) {
				if (stretch[i] === 0) {
					continue;
				}
				var restartTime = Math.ceil(now + 0.1);
				nextA[i] = restartTime;
				nextB[i] = restartTime + (Math.round(bufferList[i].duration * 8) / 16) * stretch[i] / playbackFactor[i];
			}
		}
		lastSchedulerTime = now;

		for (var i = 0; i < iNUMBERBANDS; i++) {
			if (stretch[i] === 0) {
				continue;
			}

			while (nextA[i] < now + SCHEDULE_LOOKAHEAD) {
				if (nextA[i] >= now) {
					scheduleA(i, nextA[i]);
				} else {
					var offsetA = (now - nextA[i]) * playbackFactor[i];
					if (offsetA < bufferList[i].duration) {
						scheduleA(i, now, offsetA);
					}
				}
				nextA[i] += interval[i];
			}

			while (nextB[i] < now + SCHEDULE_LOOKAHEAD) {
				if (nextB[i] >= now) {
					scheduleB(i, nextB[i]);
				} else {
					var offsetB = (now - nextB[i]) * playbackFactor[i];
					if (offsetB < bufferList[i + iNUMBERBANDS].duration) {
						scheduleB(i, now, offsetB);
					}
				}
				nextB[i] += interval[i];
			}
		}
	}

	function startScheduler() {
		if (schedulerTimer) {
			return;
		}
		schedulerTimer = setInterval(schedulerTick, SCHEDULE_INTERVAL);
	}

	function stopScheduler() {
		if (schedulerTimer) {
			clearInterval(schedulerTimer);
			schedulerTimer = null;
		}
	}

	function startWebAudio(i) {
		/* Next scheduling quantum (~64-sample quantum typical); avoids underrun clicks */
		var startTime = context.currentTime + 0.005;

		if (stretch[i] === 0) {
			sourceA[i].loop = 1;
			sourceB[i].loop = 1;
			sourceB[i].playbackRate.value = playbackFactor[i];

			sourceA[i].start(startTime);
			sourceB[i].start(startTime);
			lastPlayedA[i] = startTime;
			return;
		}

		nextA[i] = startTime;
		nextB[i] = startTime + (Math.round(sourceA[i].buffer.duration * 8) / 16) * stretch[i] / playbackFactor[i];

		scheduleA(i, nextA[i]);
		lastPlayedA[i] = nextA[i];
		nextA[i] += interval[i];

		scheduleB(i, nextB[i]);
		nextB[i] += interval[i];
	}

	/** Starts playback from already-decoded bufferList — no network reload. */
	function startStemPlaybackFromBuffers() {
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			startWebAudio(i);
		}
	}

	function setAllLevels() {
		if (!engineReady) {
			return;
		}
		var now = context.currentTime;
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			gainNode[i].gain.setTargetAtTime(Math.pow(currentLevel[i], 3), now, fAUDIOFADETIME);
		}
	}

	function syncLevelsFromSliders() {
		if (!b.sliderBar || !b.sliderBar.length) {
			return;
		}
		for (let i = 0; i < b.sliderBar.length; i++) {
			var el = b.sliderBar[i];
			var idx = BAND_LABELS.indexOf(el.name);
			if (idx < 0) {
				continue;
			}
			var db = Number(el.value);
			currentLevel[idx] = dbToLevel(db);
		}
	}

	function dbToLevel(db) {
		var v = Math.exp(db / 26);
		return Math.min(0.99, Math.max(0, v));
	}

	function clampSliderDb(sliderEl, db) {
		var mn = Number(sliderEl.min);
		var mx = Number(sliderEl.max);
		var n = Number(db);
		if (isNaN(n)) {
			n = SLIDER_DEFAULT_DB;
		}
		return Math.min(mx, Math.max(mn, n));
	}

	function finishedLoading() {
		masterGain = context.createGain();
		masterGain.gain.value = 0;

		for (let i = 0; i < iNUMBERBANDS; i++) {
			sourceA[i] = makeSource(bufferList[i], playbackFactor[i]);
			gainNode[i] = context.createGain();
			gainNode[i].gain.value = 0;
			sourceA[i].connect(gainNode[i]).connect(masterGain);
		}

		for (let i = 0; i < iNUMBERBANDS; i++) {
			sourceB[i] = makeSource(bufferList[i + iNUMBERBANDS], playbackFactor[i]);
			sourceB[i].connect(gainNode[i]).connect(masterGain);
		}

		dynCompressor = new DynamicsCompressorNode(context, {
			threshold: -12,
			knee: 6,
			ratio: 10,
			attack: 0.05,
			release: 2
		});

		masterGain.connect(dynCompressor);
		dynCompressor.connect(context.destination);

		computeIntervals();
		syncLevelsFromSliders();
		setAllLevels();

		engineReady = true;
		setPlayButtonEnabled(true);
		if (b.displayInfo) {
			b.displayInfo.textContent = 'Audio ready — press Play';
		}
		console.log('White noise stems loaded (mynoise.world).');
	}

	function setPlayButtonEnabled(enabled) {
		var btn = typeof b !== 'undefined' && b.check ? b.check : document.getElementById('main-btn');
		if (!btn) {
			return;
		}
		btn.style.pointerEvents = enabled ? '' : 'none';
		btn.style.opacity = enabled ? '' : '0.5';
		btn.setAttribute('aria-disabled', enabled ? 'false' : 'true');
		btn.setAttribute('aria-busy', enabled ? 'false' : 'true');
	}

	function initAudioContext() {
		if (stemLoadStarted) {
			return !!context;
		}
		stemLoadStarted = true;

		const AC = window.AudioContext || window.webkitAudioContext;
		if (!AC) {
			console.error('Web Audio API not available.');
			stemLoadStarted = false;
			return false;
		}
		context = new AC();

		var a = document.createElement('audio');
		if (a.canPlayType && a.canPlayType('audio/ogg; codecs="vorbis"').replace(/no/, '')) {
			bSUPPORTOGG = 1;
		}
		assignSources();
		loadAllSounds();
		return true;
	}

	function applyBandGainFromSlider(sliderEl, immediateGain) {
		var idx = BAND_LABELS.indexOf(sliderEl.name);
		if (idx < 0) {
			return;
		}
		var db = clampSliderDb(sliderEl, sliderEl.value);
		sliderEl.value = String(db);
		currentLevel[idx] = dbToLevel(db);
		var info = sliderEl.name + ': ' + db.toLocaleString() + ' dBFS';
		if (b.displayInfo) {
			b.displayInfo.innerHTML = info;
		}
		if (!engineReady) {
			return;
		}
		var g = Math.pow(currentLevel[idx], 3);
		var t = context.currentTime;
		if (immediateGain) {
			gainNode[idx].gain.cancelScheduledValues(t);
			gainNode[idx].gain.setValueAtTime(g, t);
		} else {
			gainNode[idx].gain.setTargetAtTime(g, t, fAUDIOFADETIME);
		}
	}

	/** Midpoint of each slider’s min/max (e.g. -90…0 → -45 dBFS). */
	function applyHalfRangeToAllSliders(immediateGain) {
		for (let i = 0; i < b.sliderBar.length; i++) {
			var el = b.sliderBar[i];
			var halfDb = (Number(el.min) + Number(el.max)) / 2;
			el.value = String(clampSliderDb(el, halfDb));
			applyBandGainFromSlider(el, immediateGain);
		}
		if (b.displayInfo && b.sliderBar.length) {
			var ref = b.sliderBar[0];
			var h = (Number(ref.min) + Number(ref.max)) / 2;
			b.displayInfo.textContent = 'All bands: ' + h.toLocaleString() + ' dBFS';
		}
	}

	function playNoise() {
		if (!engineReady) {
			return;
		}

		function beginPlayback() {
			var now = context.currentTime;
			masterGain.gain.cancelScheduledValues(now);
			masterGain.gain.setValueAtTime(masterGain.gain.value, now);
			masterGain.gain.linearRampToValueAtTime(fMASTERGAIN, now + PLAY_FADE_IN_S);

			if (!stemsStarted) {
				startStemPlaybackFromBuffers();
				startScheduler();
				schedulerTick();
				stemsStarted = true;
			} else {
				startScheduler();
				schedulerTick();
			}

			isplaying = true;
		}

		/* Always resume first so currentTime advances; then arm stems (microtask is fine). */
		void Promise.resolve(context.resume()).then(beginPlayback);
	}

	function stopNoise() {
		if (!engineReady || !masterGain) {
			isplaying = false;
			return;
		}
		var now = context.currentTime;
		masterGain.gain.cancelScheduledValues(now);
		masterGain.gain.setValueAtTime(masterGain.gain.value, now);
		masterGain.gain.linearRampToValueAtTime(0, now + STOP_FADE_OUT_S);

		window.setTimeout(function () {
			stopScheduler();
			if (context && context.state === 'running') {
				context.suspend();
			}
		}, STOP_FADE_OUT_S * 1000);

		isplaying = false;
	}

	b.__name__ = !0;
	b.main = () => {
		window.addEventListener('DOMContentLoaded', function () {
			b.check = window.document.getElementById('main-btn');
			b.btnGroup = window.document.getElementsByClassName('general');
			b.displayInfo = window.document.querySelector('.display-info span');
			b.sliderBar = window.document.getElementsByClassName('slider-bar');

			b.resetBtn = window.document.getElementById('reset');
			b.increaseBtn = window.document.getElementById('increase');
			b.decreaseBtn = window.document.getElementById('decrease');

			for (let i of b.sliderBar) {
				i.value = String(clampSliderDb(i, i.value === '' || i.value == null ? SLIDER_DEFAULT_DB : Number(i.value)));
			}

			setPlayButtonEnabled(false);
			if (b.displayInfo) {
				b.displayInfo.textContent = 'Loading stems… 0%';
			}

			initAudioContext();

			for (let i of b.sliderBar) {
				i.oninput = () => {
					applyBandGainFromSlider(i);
				};
			}

			if (b.resetBtn) {
				b.resetBtn.addEventListener('click', () => {
					for (let i of b.sliderBar) {
						i.value = String(clampSliderDb(i, SLIDER_DEFAULT_DB));
						applyBandGainFromSlider(i);
					}
				});
			}

			/* #increase = volume-down icon → quieter (toward min / -90 dBFS) */
			if (b.increaseBtn) {
				b.increaseBtn.addEventListener('click', () => {
					for (let i of b.sliderBar) {
						i.value = String(clampSliderDb(i, Number(i.value) - SLIDER_BUTTON_STEP_DB));
						applyBandGainFromSlider(i);
					}
				});
			}

			/* #decrease = volume-up icon → louder (toward max / 0 dBFS) */
			if (b.decreaseBtn) {
				b.decreaseBtn.addEventListener('click', () => {
					for (let i of b.sliderBar) {
						i.value = String(clampSliderDb(i, Number(i.value) + SLIDER_BUTTON_STEP_DB));
						applyBandGainFromSlider(i);
					}
				});
			}

			if (b.check) {
				b.check.addEventListener('click', () => {
					let playBtn = b.check.querySelector('#play-btn');
					let pauseBtn = b.check.querySelector('#pause-btn');

					if (isplaying) {
						if (playBtn) {
							playBtn.style.display = 'block';
						}
						if (pauseBtn) {
							pauseBtn.style.display = 'none';
						}
						replaceButton();

						stopNoise();
					} else {
						if (!engineReady) {
							if (b.displayInfo) {
								b.displayInfo.textContent = 'Loading audio…';
							}
							return;
						}
						if (playBtn) {
							playBtn.style.display = 'none';
						}
						if (pauseBtn) {
							pauseBtn.style.display = 'block';
						}
						placeButton();

						applyHalfRangeToAllSliders(true);
						playNoise();
					}
				});
			}
		});
	};

	b.main();
})('undefined' != typeof window ? window : 'undefined' != typeof global ? global : 'undefined' != typeof self ? self : this);
