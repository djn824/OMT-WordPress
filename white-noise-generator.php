<?php
/* Template Name:White Noise Generator*/
get_header();
?>
<style>
.white-noise-layout {
	display: flex;
	flex-direction: row;
	align-items: stretch;
	gap: 1.25rem;
	max-width: 1320px;
	margin-left: auto;
	margin-right: auto;
}
.white-noise-mainpanel {
	flex: 1;
	min-width: 0;
}
.white-noise-presets {
	align-self: flex-start;
	flex: 0 0 clamp(300px, 34vw, 460px);
	min-width: 280px;
	max-width: 360px;
	width: 100%;
	box-sizing: border-box;
	padding: 1.1rem 1.25rem 1.2rem;
	border-radius: 14px;
	background: #fff;
	border: 1px solid rgba(0, 0, 0, 0.08);
	box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
	color: #333;
	font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
	font-size: 0.875rem;
	line-height: 1.42;
	overflow-y: auto;
	-webkit-overflow-scrolling: touch;
}
.white-noise-presets .preset-section + .preset-section {
	margin-top: 1rem;
	padding-top: 0.85rem;
	border-top: 1px solid rgba(0, 0, 0, 0.08);
}
.white-noise-presets .preset-section-title {
	margin: 0 0 0.45rem;
	font-family: system-ui !important;
	font-weight: 600;
	font-size: 1.112em !important;
	color: #436f8e;
}
.white-noise-presets .preset-chip-row {
	--preset-chip-sep: 0.75rem;
	display: flex;
	flex-wrap: wrap;
	gap: 0.35rem var(--preset-chip-sep);
	align-items: center;
}
/* Dot after each chip (not inside next chip): stays out of hover/active backgrounds and avoids a stray dot when the row wraps */
.white-noise-presets .preset-chip-row .actionlink:not(:last-child)::after {
	content: '•';
	position: absolute;
	left: calc(100% + 0.5 * var(--preset-chip-sep));
	top: 50%;
	transform: translate(-50%, -50%);
	line-height: 1;
	color: #436f8e;
	font-weight: 600;
	pointer-events: none;
	user-select: none;
}
/* Preset spans: brand orange */
.white-noise-presets span.actionlink {
	position: relative;
	margin: 0;
	padding: 0 1px;
	border-radius: 4px;
	background: transparent;
	color: #e25c1b;
	font: inherit;
	font-size: 0.875rem;
	font-weight: 400;
	text-decoration: none;
	cursor: pointer;
	line-height: 1.55;
	display: inline-block;
	transition: background-color 0.12s ease, color 0.12s ease;
	touch-action: manipulation;
	-webkit-tap-highlight-color: transparent;
}
.white-noise-presets span.actionlink:hover {
	background-color: #e25c1b;
	color: #fff;
}
.white-noise-presets span.actionlink:focus-visible {
	outline: 2px solid #e25c1b;
	outline-offset: 2px;
}
.white-noise-presets span.actionlink.is-active,
.white-noise-presets span.actionlink[aria-pressed="true"] {
	background-color: #e25c1b;
	color: #fff;
}
@media (max-width: 900px) {
	.white-noise-layout {
		flex-direction: column;
		gap: 1rem;
		max-width: 100%;
	}
	.white-noise-presets {
		flex: 1 1 auto;
		max-width: none;
		width: 100%;
		padding-bottom: max(1rem, env(safe-area-inset-bottom, 0px));
	}
	.white-noise-presets span.actionlink {
		display: inline-flex;
		align-items: center;
	}
}
</style>
<div class="noise-container">
	<div class="width-100 my-20 white-noise-layout">
		<div class="white-noise white-noise-mainpanel">
		<div class="display-info">
			<span></span>
		</div>
		<div class="equalizer">
			<div class="slider">
				<input type="range" name="Sub-Bass" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="Low Bass" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="Bass" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="High Bass" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="Low Mids" class="slider-bar" min="0" max="990" value="495" step="1">
			</div>
			<div class="slider">
				<input type="range" name="Mids" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="High Mids" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="Low Treble" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="Treble" class="slider-bar" min="0" max="990" value="495" step="1">
				<input type="range" name="High Treble" class="slider-bar" min="0" max="990" value="495" step="1">
			</div>
		</div>
		<div class="control-bar">
			<div id="main-btn" class="main-btn">
				<div>
					<div id="pause-btn" class="pause-btn">
					</div>
					<div id="play-btn" class="play-btn">
					</div>
				</div>
			</div>
			<div class="general">
				<button id="animate" class="general-btn" type="button" aria-pressed="false">
					Random
				</button>
			</div>
			<div class="general">	
				<button id="timer" class="general-btn" type="button" aria-pressed="false">
					Timer
				</button>
			</div>
			<div class="general">	
				<button id="decrease" class="general-btn">
					<i class="fa fa-volume-up fa-2x"></i>
				</button>
			</div>
			<div class="general">	
				<button id="increase" class="general-btn">
					<i class="fa fa-volume-down fa-2x"></i>
				</button>
			</div>
			<div class="general">	
				<button id="reset" class="general-btn">
					<i class="fa fa-reply fa-2x"></i>
				</button>
			</div>
		</div>
		</div>
		<aside class="white-noise-presets" id="white-noise-presets" aria-label="Sound presets">
			<section class="preset-section">
				<h3 class="preset-section-title">Noise Colors</h3>
				<div class="preset-chip-row" role="group" aria-label="Noise colors">
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="white">White</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="pink">Pink</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="brown">Brown</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="grey">Grey</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="blue">Blue</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="noise-color" data-preset="violet">Violet</span>
				</div>
			</section>
			<section class="preset-section">
				<h3 class="preset-section-title">Focus</h3>
				<div class="preset-chip-row" role="group" aria-label="Focus">
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="focus-flow">Focus Flow</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="coding">Coding</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="reading">Reading</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="study-hall">Study Hall</span>
				</div>
			</section>
			<section class="preset-section">
				<h3 class="preset-section-title">Privacy</h3>
				<div class="preset-chip-row" role="group" aria-label="Privacy">
					<span class="actionlink" role="button" tabindex="0" data-preset-group="privacy" data-preset="voice-mask">Voice Mask</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="privacy" data-preset="cafe-blur">Cafe Blur</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="privacy" data-preset="quiet-bubble">Quiet Bubble</span>
				</div>
			</section>
			<section class="preset-section">
				<h3 class="preset-section-title">Sleep</h3>
				<div class="preset-chip-row" role="group" aria-label="Sleep">
					<span class="actionlink" role="button" tabindex="0" data-preset-group="sleep" data-preset="night-drift">Night Drift</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="sleep" data-preset="deep-sleep">Deep Sleep</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="sleep" data-preset="calm-hush">Calm Hush</span>
				</div>
			</section>
			<section class="preset-section">
				<h3 class="preset-section-title">Frequency</h3>
				<div class="preset-chip-row" role="group" aria-label="Frequency bands">
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f63">63Hz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f125">125Hz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f250">250Hz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f500">500Hz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f1k">1kHz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f2k">2kHz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f4k">4kHz</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="frequency" data-preset="f8k">8kHz</span>
				</div>
			</section>
		</aside>
	</div>
</div>
</div>
</article>
</div>
</div>
<script>
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
	let stemsMixGain = null;
	let stemsReady = false;
	let synthReady = false;
	let synthStarted = false;
	let synthMasterGain = null;
	let synthBandGain = [];
	let synthFilters = [];
	let synthSource = null;
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

	/** Slider represents linear level 0..0.99 (like white_noise.html). */
	const LEVEL_MAX = 0.99;
	/** Display clamp for near-zero levels (white_noise.html shows ~-129 dBFS at bottom). */
	const DB_FLOOR = -129;
	/** Slider step for +/- buttons (units of the range input, 0..990). */
	const SLIDER_STEP = 20;

	/* --- Slider animation + sleep timer (ported from white_noise.html intent) --- */
	// animEnabled = user intent (button state). Animation only RUNS while audio is playing.
	let animEnabled = false;
	let animRunning = false;
	let animCycleTimer = null;
	let animRaf = null;
	let animFrom = [];
	let animTo = [];
	let animationProfileLow = new Array(iNUMBERBANDS).fill(0);
	let animationProfileHigh = new Array(iNUMBERBANDS).fill(0.5);
	const ANIM_PERIOD_MS = 2500;
	const ANIM_TWEEN_MS = 1600;

	let sleepTimerMinutes = -1;
	let sleepTimerTimeout = null;
	let sleepTimerEndAtMs = null;
	let sleepTimerRemainingInterval = null;
	// Minutes. -1 means Off.
	const SLEEP_TIMER_CYCLE_MIN = [-1, 1, 5, 10, 15, 20, 25, 30, 60, 120, 240, 480];

	function clamp(x, lo, hi) {
		return Math.min(hi, Math.max(lo, x));
	}

	function easeInOut(t) {
		// Smoothstep
		return t * t * (3 - 2 * t);
	}

	function clearSleepTimer() {
		if (sleepTimerTimeout) {
			clearTimeout(sleepTimerTimeout);
			sleepTimerTimeout = null;
		}
		if (sleepTimerRemainingInterval) {
			clearInterval(sleepTimerRemainingInterval);
			sleepTimerRemainingInterval = null;
		}
		sleepTimerEndAtMs = null;
	}

	function formatTimerLabel(mins) {
		if (!mins || mins < 0) return 'Timer: Off';
		return 'Timer: ' + mins + ' min';
	}

	function formatRemainingMs(ms) {
		if (ms == null || ms <= 0) return '00:00';
		const totalSec = Math.max(0, Math.floor(ms / 1000));
		const m = Math.floor(totalSec / 60);
		const s = totalSec % 60;
		if (m >= 60) {
			const h = Math.floor(m / 60);
			const mm = String(m % 60).padStart(2, '0');
			return h + ':' + mm + ':' + String(s).padStart(2, '0');
		}
		return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
	}

	function coerceMinutesInput(raw) {
		// Accept "10", "10m", "1.5", "01:30" (mm:ss) as convenience.
		if (raw == null) return -1;
		const s = String(raw).trim();
		if (!s) return -1;
		const mmss = s.match(/^(\d{1,4})\s*:\s*([0-5]?\d)$/);
		if (mmss) {
			const mm = Number(mmss[1]);
			const ss = Number(mmss[2]);
			const mins = mm + ss / 60;
			return mins > 0 ? mins : -1;
		}
		const m = s.match(/^(\d+(?:\.\d+)?)\s*(m|min|mins|minute|minutes)?$/i);
		if (m) {
			const mins = Number(m[1]);
			return mins > 0 ? mins : -1;
		}
		return -1;
	}

	function ensureTimerLabelUi() {
		if (!b.timerBtn) return;
		if (b.timerLabelWrap) return;

		// Anchor UI to the timer button itself so we don't move the layout/position.
		// We'll absolutely-position the label relative to the button.
		const btn = b.timerBtn;
		btn.style.position = btn.style.position || 'relative';
		btn.style.overflow = btn.style.overflow || 'visible';

		const wrap = document.createElement('div');
		wrap.className = 'timer-label';
		// Hidden by default; revealed with an animated class.
		wrap.style.display = 'block';
		wrap.style.position = 'absolute';
		wrap.style.left = '50%';
		wrap.style.bottom = '100%';
		wrap.style.transform = 'translate(-50%, 8px)';
		wrap.style.opacity = '0';
		wrap.style.pointerEvents = 'none';
		wrap.style.transition = 'opacity 180ms ease, transform 180ms ease';
		wrap.style.textAlign = 'center';
		wrap.style.marginBottom = '2px';
		wrap.setAttribute('aria-hidden', 'true');

		const input = document.createElement('input');
		input.type = 'text';
		input.inputMode = 'decimal';
		input.autocomplete = 'off';
		input.spellcheck = false;
		input.placeholder = 'Minutes';
		input.setAttribute('aria-label', 'Set timer minutes');
		input.style.width = '100%';
		input.style.maxWidth = '100px';
		input.style.minWidth = '45px';
		input.style.boxSizing = 'border-box';
		input.style.padding = '6px 8px';
		input.style.borderRadius = '8px';
		input.style.border = '1px solid rgba(255,255,255,0.35)';
		input.style.background = 'rgba(0,0,0,0.15)';
		input.style.color = 'inherit';
		input.style.textAlign = 'center';

		wrap.appendChild(input);
		btn.appendChild(wrap);

		b.timerLabelWrap = wrap;
		b.timerLabelInput = input;

		const commitMinutes = () => {
			const mins = coerceMinutesInput(b.timerLabelInput.value);
			if (mins > 0) {
				sleepTimerMinutes = Math.round(mins * 10) / 10;
				b.timerBtn.setAttribute('aria-pressed', 'true');
				showTimerLabelUi();
				armSleepTimerIfPlaying();
			} else {
				// Invalid/empty: keep UI but do not arm
				updateTimerLabelUi();
			}
		};

		const cyclePresetMinutes = () => {
			// Cycle through the built-in presets (-1, 1, 5, 10, ...)
			const idx = SLEEP_TIMER_CYCLE_MIN.indexOf(sleepTimerMinutes);
			sleepTimerMinutes =
				SLEEP_TIMER_CYCLE_MIN[(idx < 0 ? 0 : idx + 1) % SLEEP_TIMER_CYCLE_MIN.length];
			if (sleepTimerMinutes > 0) {
				b.timerBtn.setAttribute('aria-pressed', 'true');
				showTimerLabelUi();
				if (b.displayInfo && !animEnabled) b.displayInfo.textContent = formatTimerLabel(sleepTimerMinutes);
				armSleepTimerIfPlaying();
			} else {
				// Off
				b.timerBtn.setAttribute('aria-pressed', 'false');
				hideTimerLabelUi();
				clearSleepTimer();
				if (b.displayInfo && !animEnabled) b.displayInfo.textContent = formatTimerLabel(sleepTimerMinutes);
			}
		};

		input.addEventListener('keydown', (e) => {
			if (e.key === 'Enter') {
				e.preventDefault();
				commitMinutes();
				input.blur();
			}
		});

		// Blur should NOT commit. It should revert to the stored/original value.
		input.addEventListener('blur', () => {
			updateTimerLabelUi();
		});

		// Important: the timer UI lives inside the button; prevent clicks on the
		// input/label from bubbling and accidentally cycling the preset.
		const stopBubble = (e) => {
			e.stopPropagation();
		};
		input.addEventListener('click', stopBubble);
		input.addEventListener('mousedown', stopBubble);
		input.addEventListener('touchstart', stopBubble, { passive: true });
		wrap.addEventListener('click', stopBubble);
		wrap.addEventListener('mousedown', stopBubble);

		// Quick-set: double-click the label to cycle preset times.
		wrap.addEventListener('dblclick', (e) => {
			// Don't select text; just cycle.
			e.preventDefault();
			cyclePresetMinutes();
		});
	}

	function showTimerLabelUi() {
		ensureTimerLabelUi();
		if (!b.timerLabelWrap) return;
		b.timerLabelWrap.style.opacity = '1';
		b.timerLabelWrap.style.transform = 'translate(-50%, 0px)';
		b.timerLabelWrap.style.pointerEvents = 'auto';
		b.timerLabelWrap.setAttribute('aria-hidden', 'false');
		updateTimerLabelUi();
	}

	function hideTimerLabelUi() {
		if (!b.timerLabelWrap) return;
		b.timerLabelWrap.style.opacity = '0';
		b.timerLabelWrap.style.transform = 'translate(-50%, 8px)';
		b.timerLabelWrap.style.pointerEvents = 'none';
		b.timerLabelWrap.setAttribute('aria-hidden', 'true');
	}

	function updateTimerLabelUi() {
		if (!b.timerLabelInput) return;
		// Don't overwrite while the user is typing; only normalize on blur / Enter.
		if (document && document.activeElement === b.timerLabelInput) {
			return;
		}
		if (!sleepTimerMinutes || sleepTimerMinutes < 0) {
			b.timerLabelInput.value = '';
			return;
		}
		// While counting down, show remaining time (minutes). Otherwise show configured minutes.
		if (sleepTimerEndAtMs && isplaying) {
			const remMs = Math.max(0, sleepTimerEndAtMs - Date.now());
			const remMin = Math.ceil(remMs / (60 * 1000));
			b.timerLabelInput.value = String(remMin);
			return;
		}
		b.timerLabelInput.value = String(sleepTimerMinutes);
	}

	function setSlidersDisabled(disabled) {
		if (!b.sliderBar || !b.sliderBar.length) return;
		for (let i = 0; i < b.sliderBar.length; i++) {
			const el = b.sliderBar[i];
			el.disabled = !!disabled;
			if (disabled) {
				el.classList.add('is-disabled');
				el.style.opacity = '0.4';
				el.style.cursor = 'not-allowed';
				el.style.filter = 'grayscale(60%)';
				el.setAttribute('aria-disabled', 'true');
			} else {
				el.classList.remove('is-disabled');
				el.style.opacity = '';
				el.style.cursor = '';
				el.style.filter = '';
				el.setAttribute('aria-disabled', 'false');
			}
		}
	}

	function armSleepTimerIfPlaying() {
		clearSleepTimer();
		if (!isplaying || !engineReady) return;
		if (!sleepTimerMinutes || sleepTimerMinutes < 0) return;
		sleepTimerEndAtMs = Date.now() + sleepTimerMinutes * 60 * 1000;
		sleepTimerRemainingInterval = setInterval(() => {
			updateTimerLabelUi();
		}, 250);
		sleepTimerTimeout = setTimeout(() => {
			// Stop audio + reset UI state (same as pressing pause)
			let playBtn = b.check ? b.check.querySelector('#play-btn') : null;
			let pauseBtn = b.check ? b.check.querySelector('#pause-btn') : null;
			if (playBtn) playBtn.style.display = 'block';
			if (pauseBtn) pauseBtn.style.display = 'none';
			replaceButton();
			stopNoise();

			// Clear timer selection when it finishes
			sleepTimerMinutes = -1;
			if (b.timerBtn) {
				b.timerBtn.setAttribute('aria-pressed', 'false');
			}
			hideTimerLabelUi();
			if (b.displayInfo) {
				b.displayInfo.textContent = 'Timer finished — stopped';
			}
			sleepTimerTimeout = null;
		}, sleepTimerMinutes * 60 * 1000);
		// When animation is enabled, keep the display locked to "Animation: On"
		if (b.displayInfo && !animEnabled) {
			b.displayInfo.textContent = formatTimerLabel(sleepTimerMinutes);
		}
		updateTimerLabelUi();
	}

	function captureAnimationProfilesFromCurrent() {
		// Mirror white_noise.html logic: low = 0.5x current, high = 1.25x current (clamped)
		for (let i = 0; i < iNUMBERBANDS; i++) {
			animationProfileLow[i] = clamp(currentLevel[i] * 0.5, 0, LEVEL_MAX);
			animationProfileHigh[i] = clamp(currentLevel[i] * 1.25, 0, LEVEL_MAX);
		}
	}

	function levelToSliderValue(level, sliderEl) {
		var mx = Number(sliderEl.max) || 990;
		var p = clamp(level / LEVEL_MAX, 0, 1);
		return Math.round(p * mx);
	}

	function updateSlidersFromLevels(levels, immediateGain) {
		if (!b.sliderBar || !b.sliderBar.length) return;
		for (let i = 0; i < b.sliderBar.length; i++) {
			const el = b.sliderBar[i];
			const idx = BAND_LABELS.indexOf(el.name);
			if (idx < 0) continue;
			el.value = String(levelToSliderValue(levels[idx], el));
			applyBandGainFromSlider(el, immediateGain);
		}
	}

	function stopSliderAnimation() {
		animRunning = false;
		if (animCycleTimer) {
			clearInterval(animCycleTimer);
			animCycleTimer = null;
		}
		if (animRaf) {
			cancelAnimationFrame(animRaf);
			animRaf = null;
		}
	}

	function startSliderAnimation() {
		// Only run while audio is playing. We still keep animEnabled as "desired".
		if (!animEnabled || !isplaying) {
			return;
		}
		if (animRunning) {
			return;
		}
		animRunning = true;

		// Seed profiles from current slider positions
		syncLevelsFromSliders();
		captureAnimationProfilesFromCurrent();

		const runCycle = () => {
			if (!animEnabled) return;

			// Pick new random targets within [low..high]
			animFrom = currentLevel.slice(0);
			animTo = currentLevel.slice(0);
			for (let i = 0; i < iNUMBERBANDS; i++) {
				const lo = animationProfileLow[i];
				const hi = animationProfileHigh[i];
				animTo[i] = lo + Math.random() * (hi - lo);
			}

			const t0 = performance.now();
			const step = () => {
				if (!animEnabled) return;
				const t = clamp((performance.now() - t0) / ANIM_TWEEN_MS, 0, 1);
				const e = easeInOut(t);
				const mix = new Array(iNUMBERBANDS);
				for (let i = 0; i < iNUMBERBANDS; i++) {
					mix[i] = animFrom[i] + (animTo[i] - animFrom[i]) * e;
					currentLevel[i] = mix[i];
				}
				updateSlidersFromLevels(currentLevel, true);
				if (t < 1) {
					animRaf = requestAnimationFrame(step);
				} else {
					animRaf = null;
				}
			};
			if (animRaf) cancelAnimationFrame(animRaf);
			animRaf = requestAnimationFrame(step);
		};

		runCycle();
		animCycleTimer = setInterval(runCycle, ANIM_PERIOD_MS);
	}

	function refreshAnimationAfterControlChange() {
		if (!animEnabled) return;
		syncLevelsFromSliders();
		captureAnimationProfilesFromCurrent();
		if (animRunning) {
			stopSliderAnimation();
			startSliderAnimation();
		}
	}

	function syncAnimationToPlaybackState() {
		// Sliders must not be manually controllable while animation is enabled (even if paused).
		setSlidersDisabled(animEnabled);
		if (animEnabled && isplaying) {
			startSliderAnimation();
		} else {
			// Pause animation loop but keep animEnabled (button state) intact.
			stopSliderAnimation();
		}
	}

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

	/**
	 * white_noise.html setPreset(): when bCALIBRATE==0, levels are passed through normalizeLevels()
	 * before currentLevel / sliders are updated (fTARGETSLIDERLEVEL = 0.5).
	 */
	const fTARGETSLIDERLEVEL = 0.5;

	function normalizeMyNoiseLevels(vecIn) {
		const boostTable = [0, 1.5, 1.36, 1.23, 1.12, 1.13, 1.02, 1, 0.98, 0.95, 0.9];
		const vector = vecIn.slice();
		let activeCount = 0;
		let maxLevel = 0;
		for (let i = 0; i < iNUMBERBANDS; i++) {
			if (vector[i] > maxLevel) maxLevel = vector[i];
		}
		const threshold = maxLevel * 0.8;
		for (let i = 0; i < iNUMBERBANDS; i++) {
			if (vector[i] > threshold) activeCount++;
		}
		if (activeCount > 0 && maxLevel > 0) {
			const mult = (fTARGETSLIDERLEVEL / maxLevel) * boostTable[activeCount];
			for (let i = 0; i < iNUMBERBANDS; i++) {
				vector[i] = Math.min(vector[i] * mult, 0.9);
			}
		}
		return vector;
	}

	/** Band centre frequencies (Hz) — white_noise.html emphasisEQ / eqNode */
	const MY_EQ_CENTER_FREQS = [20, 60, 125, 250, 500, 1000, 2000, 4000, 8000, 17000];

	function bandIndexForHz(hz) {
		let best = 0;
		let bestDist = Infinity;
		for (let i = 0; i < MY_EQ_CENTER_FREQS.length; i++) {
			const d = Math.abs(Math.log(Math.max(1e-9, MY_EQ_CENTER_FREQS[i]) / Math.max(1e-9, hz)));
			if (d < bestDist) {
				bestDist = d;
				best = i;
			}
		}
		return best;
	}

	/** Raw shape for “hear this region” — then normalizeMyNoiseLevels (same pipeline as setPreset). */
	function makeRawFreqHighlightHz(hz) {
		const raw = new Array(iNUMBERBANDS).fill(0.03);
		const j = bandIndexForHz(hz);
		raw[j] = 0.5;
		if (j > 0) raw[j - 1] = Math.max(raw[j - 1], 0.36);
		if (j < iNUMBERBANDS - 1) raw[j + 1] = Math.max(raw[j + 1], 0.36);
		return raw;
	}

	/**
	 * Grey noise — slider curve from myNoise reference UI (Sub-Bass → High Treble).
	 * Plateau ~40%, dip ~30% (dark blue), then ~40%, ~50%, ~65% on the right.
	 */
	const GREY_RAW_VISUAL = [0.9, 0.5, 0.4, 0.35, 0.35, 0.35, 0.28, 0.35, 0.4, 0.55];

	/** Mousetrap w / n / b — white_noise.html lines 3049–3051 */
	const WHITE_RAW = [0.18, 0.21, 0.24, 0.27, 0.3, 0.34, 0.38, 0.42, 0.46, 0.5];
	const PINK_RAW = new Array(iNUMBERBANDS).fill(0.3);
	const BROWN_RAW = [0.5, 0.46, 0.42, 0.38, 0.34, 0.3, 0.27, 0.24, 0.21, 0.18];

	/** Blue / violet: steeper highs than white (not in saved HTML; raw shapes only, still via normalizeLevels). */
	function blueRawSteep() {
		const out = [];
		for (let i = 0; i < iNUMBERBANDS; i++) {
			out.push(0.12 + 0.38 * Math.pow(i / 9, 1.35));
		}
		return out;
	}

	function violetRawSteep() {
		const out = [];
		for (let i = 0; i < iNUMBERBANDS; i++) {
			out.push(0.08 + 0.42 * Math.pow(i / 9, 2.05));
		}
		return out;
	}

	const NOISE_PRESET_RAW = {
		white: WHITE_RAW,
		pink: PINK_RAW,
		brown: BROWN_RAW,
		grey: GREY_RAW_VISUAL,
		blue: blueRawSteep(),
		violet: violetRawSteep(),
		'focus-flow': [0.24, 0.26, 0.28, 0.3, 0.33, 0.36, 0.34, 0.3, 0.26, 0.22],
		coding: [0.26, 0.28, 0.3, 0.32, 0.34, 0.33, 0.28, 0.22, 0.18, 0.15],
		reading: [0.36, 0.34, 0.32, 0.3, 0.28, 0.24, 0.2, 0.18, 0.15, 0.12],
		'study-hall': [0.31, 0.31, 0.32, 0.32, 0.33, 0.33, 0.32, 0.31, 0.3, 0.28],
		'voice-mask': [0.34, 0.32, 0.26, 0.2, 0.16, 0.18, 0.24, 0.32, 0.38, 0.4],
		'cafe-blur': [0.28, 0.3, 0.32, 0.33, 0.3, 0.28, 0.29, 0.31, 0.29, 0.26],
		'quiet-bubble': [0.14, 0.14, 0.15, 0.16, 0.17, 0.16, 0.15, 0.14, 0.13, 0.12],
		'night-drift': [0.4, 0.36, 0.32, 0.28, 0.22, 0.18, 0.14, 0.11, 0.09, 0.07],
		'deep-sleep': [0.42, 0.35, 0.26, 0.18, 0.12, 0.08, 0.06, 0.05, 0.04, 0.04],
		'calm-hush': [0.1, 0.1, 0.11, 0.12, 0.12, 0.11, 0.1, 0.09, 0.08, 0.07],
		f63: makeRawFreqHighlightHz(63),
		f125: makeRawFreqHighlightHz(125),
		f250: makeRawFreqHighlightHz(250),
		f500: makeRawFreqHighlightHz(500),
		f1k: makeRawFreqHighlightHz(1000),
		f2k: makeRawFreqHighlightHz(2000),
		f4k: makeRawFreqHighlightHz(4000),
		f8k: makeRawFreqHighlightHz(8000)
	};

	function clampPresetLevel(lv) {
		return clamp(Number(lv) || 0, 0, LEVEL_MAX);
	}

	function clearPresetChipActive() {
		const root = b.presetPanel;
		if (!root) return;
		root.querySelectorAll('.actionlink[data-preset].is-active').forEach((el) => {
			el.classList.remove('is-active');
			el.setAttribute('aria-pressed', 'false');
		});
	}

	function applyNoisePreset(presetKey, displayLabel, activeButton) {
		const rawTemplate = NOISE_PRESET_RAW[presetKey];
		if (!rawTemplate || rawTemplate.length !== iNUMBERBANDS) return;
		const levels = normalizeMyNoiseLevels(rawTemplate).map(clampPresetLevel);
		for (let i = 0; i < iNUMBERBANDS; i++) {
			currentLevel[i] = levels[i];
		}
		updateSlidersFromLevels(levels, !!isplaying);
		refreshAnimationAfterControlChange();
		clearPresetChipActive();
		if (activeButton) {
			activeButton.classList.add('is-active');
			activeButton.setAttribute('aria-pressed', 'true');
		}
		if (b.displayInfo && !animEnabled) {
			b.displayInfo.textContent = displayLabel;
		}
	}

	function assignSources() {
		if (bSUPPORTOGG) {
			fileExt = '.ogg';
		}

		const base = '<?php echo get_stylesheet_directory_uri();?>/assets/audio/white-noise/';
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
		// Don’t surface “loading” while the instant synth engine is usable/playing.
		// Only show progress if the UI is already in a loading state and audio isn’t playing yet.
		if (isplaying) return;
		if (engineReady && synthReady) return;
		if (typeof el.textContent === 'string' && el.textContent.indexOf('Loading stems') === -1) return;
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
			const g = Math.pow(currentLevel[i], 3);
			if (gainNode[i] && gainNode[i].gain) {
				gainNode[i].gain.setTargetAtTime(g, now, fAUDIOFADETIME);
			}
			if (synthBandGain[i] && synthBandGain[i].gain) {
				synthBandGain[i].gain.setTargetAtTime(g, now, fAUDIOFADETIME);
			}
		}
	}

	function setAllLevelsImmediate() {
		if (!engineReady) {
			return;
		}
		var now = context.currentTime;
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			const g = Math.pow(currentLevel[i], 3);
			if (gainNode[i] && gainNode[i].gain) {
				gainNode[i].gain.cancelScheduledValues(now);
				gainNode[i].gain.setValueAtTime(g, now);
			}
			if (synthBandGain[i] && synthBandGain[i].gain) {
				synthBandGain[i].gain.cancelScheduledValues(now);
				synthBandGain[i].gain.setValueAtTime(g, now);
			}
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
			currentLevel[idx] = sliderToLevel(el);
		}
	}

	function clamp01(x) {
		return Math.min(1, Math.max(0, x));
	}

	function sliderToLevel(sliderEl) {
		var mx = Number(sliderEl.max) || 990;
		var v = Number(sliderEl.value);
		if (isNaN(v)) v = mx / 2;
		var p = clamp01(v / mx);
		return p * LEVEL_MAX;
	}

	function levelToDb(level) {
		// myNoise convention: dBFS ≈ 26 * ln(level), floor at ~-129 dBFS
		if (!level || level <= 0) return DB_FLOOR;
		return 26 * Math.log(level);
	}

	function setSliderToMidpoint(sliderEl) {
		var mx = Number(sliderEl.max) || 990;
		sliderEl.value = String(Math.round(mx / 2));
	}

	function finishedLoading() {
		// Stems are decoded; build stem nodes into the existing output chain.
		if (!stemsMixGain) {
			stemsMixGain = context.createGain();
			stemsMixGain.gain.value = 0;
			stemsMixGain.connect(masterGain);
		}

		for (let i = 0; i < iNUMBERBANDS; i++) {
			sourceA[i] = makeSource(bufferList[i], playbackFactor[i]);
			gainNode[i] = context.createGain();
			gainNode[i].gain.value = 0;
			sourceA[i].connect(gainNode[i]).connect(stemsMixGain);
		}

		for (let i = 0; i < iNUMBERBANDS; i++) {
			sourceB[i] = makeSource(bufferList[i + iNUMBERBANDS], playbackFactor[i]);
			sourceB[i].connect(gainNode[i]).connect(stemsMixGain);
		}

		computeIntervals();
		syncLevelsFromSliders();
		setAllLevels();

		stemsReady = true;
		if (b.displayInfo) {
			b.displayInfo.textContent = 'Audio loaded';
		}
		console.log('White noise stems loaded (mynoise.world).');
	}

	function buildSynthEngine() {
		if (synthReady || !context) return;

		// Ensure output chain exists.
		if (!masterGain) {
			masterGain = context.createGain();
			masterGain.gain.value = 0;
		}
		if (!dynCompressor) {
			dynCompressor = new DynamicsCompressorNode(context, {
				threshold: -12,
				knee: 6,
				ratio: 10,
				attack: 0.05,
				release: 2
			});
			masterGain.connect(dynCompressor);
			dynCompressor.connect(context.destination);
		}
		if (!stemsMixGain) {
			stemsMixGain = context.createGain();
			stemsMixGain.gain.value = 0;
			stemsMixGain.connect(masterGain);
		}

		// Synth white-noise generator (fast start, no network).
		synthMasterGain = context.createGain();
		// Keep synth muted until Play sets gains (prevents “max volume” burst).
		synthMasterGain.gain.value = 0;
		synthMasterGain.connect(masterGain);

		const freqs = [40, 80, 160, 320, 640, 1250, 2500, 5000, 10000, 14000];
		const qVals = [0.8, 0.9, 1.0, 1.0, 1.1, 1.2, 1.3, 1.4, 1.4, 1.2];

		synthFilters = new Array(iNUMBERBANDS);
		synthBandGain = new Array(iNUMBERBANDS);
		for (let i = 0; i < iNUMBERBANDS; i++) {
			const f = context.createBiquadFilter();
			f.type = 'bandpass';
			f.frequency.value = freqs[i];
			f.Q.value = qVals[i];
			synthFilters[i] = f;

			const g = context.createGain();
			g.gain.value = 0;
			synthBandGain[i] = g;

			f.connect(g).connect(synthMasterGain);
		}

		// Apply current slider levels to synth gains.
		syncLevelsFromSliders();
		setAllLevels();

		synthReady = true;
	}

	function startSynthIfNeeded() {
		if (!synthReady || synthStarted) return;
		// Build a looping white-noise buffer (2s) and feed it into the filter bank.
		const durS = 2;
		const len = Math.max(2, Math.floor(context.sampleRate * durS));
		const buf = context.createBuffer(1, len, context.sampleRate);
		const data = buf.getChannelData(0);
		for (let i = 0; i < len; i++) {
			data[i] = Math.random() * 2 - 1;
		}

		const src = context.createBufferSource();
		src.buffer = buf;
		src.loop = true;

		for (let i = 0; i < iNUMBERBANDS; i++) {
			src.connect(synthFilters[i]);
		}
		src.start();
		synthSource = src;
		synthStarted = true;
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

		const AC = window.AudioContext || window.webkitAudioContext;
		if (!AC) {
			console.error('Web Audio API not available.');
			return false;
		}
		context = new AC();

		// Instant engine: synth noise starts immediately; stems load in background.
		buildSynthEngine();
		engineReady = true;
		setPlayButtonEnabled(true);
		if (b.displayInfo) {
			b.displayInfo.textContent = 'Ready — press Play';
		}

		// Background load of mynoise stems (may take time depending on network).
		stemLoadStarted = true;
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
		var level = sliderToLevel(sliderEl);
		currentLevel[idx] = level;
		var db = Math.round(levelToDb(level));
		var info = sliderEl.name + ': ' + db.toLocaleString() + ' dBFS';
		// When animation is enabled, keep the display locked to "Animation: On"
		if (b.displayInfo && !animEnabled) {
			b.displayInfo.innerHTML = info;
		}
		if (!engineReady) {
			return;
		}
		var g = Math.pow(level, 3);
		var t = context.currentTime;
		if (gainNode[idx] && gainNode[idx].gain) {
			if (immediateGain) {
				gainNode[idx].gain.cancelScheduledValues(t);
				gainNode[idx].gain.setValueAtTime(g, t);
			} else {
				gainNode[idx].gain.setTargetAtTime(g, t, fAUDIOFADETIME);
			}
		}
		if (synthBandGain[idx] && synthBandGain[idx].gain) {
			if (immediateGain) {
				synthBandGain[idx].gain.cancelScheduledValues(t);
				synthBandGain[idx].gain.setValueAtTime(g, t);
			} else {
				synthBandGain[idx].gain.setTargetAtTime(g, t, fAUDIOFADETIME);
			}
		}
	}

	/** Set all sliders to half-thumb position (like your request). */
	function applyHalfRangeToAllSliders(immediateGain) {
		for (let i = 0; i < b.sliderBar.length; i++) {
			var el = b.sliderBar[i];
			setSliderToMidpoint(el);
			applyBandGainFromSlider(el, immediateGain);
		}
		if (b.displayInfo && b.sliderBar.length) {
			var refLevel = sliderToLevel(b.sliderBar[0]);
			var refDb = Math.round(levelToDb(refLevel));
			b.displayInfo.textContent = 'All bands: ' + refDb.toLocaleString() + ' dBFS';
		}
	}

	function playNoise() {
		if (!engineReady) {
			return;
		}

		// Flip state immediately so UI animations stay in sync with user intent.
		// Audio start is async (AudioContext.resume), but the button/animation should not lag.
		isplaying = true;

		function beginPlayback() {
			// Snap gains to current slider values BEFORE any audio becomes audible.
			syncLevelsFromSliders();
			setAllLevelsImmediate();
			startSynthIfNeeded();
			var now = context.currentTime;
			masterGain.gain.cancelScheduledValues(now);
			masterGain.gain.setValueAtTime(masterGain.gain.value, now);
			masterGain.gain.linearRampToValueAtTime(fMASTERGAIN, now + PLAY_FADE_IN_S);

			// If stems are ready, crossfade synth -> stems (perceived “no loading”).
			if (stemsReady && stemsMixGain) {
				stemsMixGain.gain.cancelScheduledValues(now);
				stemsMixGain.gain.setValueAtTime(stemsMixGain.gain.value, now);
				stemsMixGain.gain.linearRampToValueAtTime(1, now + 0.5);
				if (synthMasterGain) {
					synthMasterGain.gain.cancelScheduledValues(now);
					synthMasterGain.gain.setValueAtTime(synthMasterGain.gain.value, now);
					synthMasterGain.gain.linearRampToValueAtTime(0, now + 0.5);
				}

				if (!stemsStarted) {
					startStemPlaybackFromBuffers();
					startScheduler();
					schedulerTick();
					stemsStarted = true;
				} else {
					startScheduler();
					schedulerTick();
				}
			} else {
				// Stems not ready yet: keep synth audible, keep loading silently.
				if (synthMasterGain) {
					synthMasterGain.gain.cancelScheduledValues(now);
					synthMasterGain.gain.setValueAtTime(synthMasterGain.gain.value, now);
					synthMasterGain.gain.linearRampToValueAtTime(1, now + PLAY_FADE_IN_S);
				}
				if (stemsMixGain) {
					stemsMixGain.gain.cancelScheduledValues(now);
					stemsMixGain.gain.setValueAtTime(stemsMixGain.gain.value, now);
					stemsMixGain.gain.linearRampToValueAtTime(0, now + 0.05);
				}
			}

		}

		/* Always resume first so currentTime advances; then arm stems (microtask is fine). */
		void Promise.resolve(context.resume()).then(beginPlayback, function () {
			// If resume fails, revert UI state.
			isplaying = false;
		});

		// Resume animation (if enabled) when audio starts.
		syncAnimationToPlaybackState();
		armSleepTimerIfPlaying();
	}

	function stopNoise() {
		// Flip state immediately so UI animations stay in sync with user intent.
		isplaying = false;
		// Pause animation when audio is paused/stopped, but keep enabled state.
		syncAnimationToPlaybackState();
		clearSleepTimer();

		if (!engineReady || !masterGain) {
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

	}

	b.__name__ = !0;
	b.main = () => {
		window.addEventListener('DOMContentLoaded', function () {
			b.check = window.document.getElementById('main-btn');
			b.btnGroup = window.document.querySelectorAll('.control-bar > .general');
			b.presetPanel = window.document.getElementById('white-noise-presets');
			b.displayInfo = window.document.querySelector('.display-info span');
			b.sliderBar = window.document.getElementsByClassName('slider-bar');

			b.resetBtn = window.document.getElementById('reset');
			b.increaseBtn = window.document.getElementById('increase');
			b.decreaseBtn = window.document.getElementById('decrease');
			b.animateBtn = window.document.getElementById('animate');
			b.timerBtn = window.document.getElementById('timer');
			ensureTimerLabelUi();

			for (let i of b.sliderBar) {
				// Ensure numeric value; default to midpoint.
				if (i.value === '' || i.value == null || isNaN(Number(i.value))) {
					setSliderToMidpoint(i);
				}
			}

			// Instant synth is available immediately; stems will load in background.
			setPlayButtonEnabled(true);
			if (b.displayInfo) {
				b.displayInfo.textContent = 'Ready — press Play';
			}

			initAudioContext();

			for (let i of b.sliderBar) {
				i.oninput = () => {
					clearPresetChipActive();
					applyBandGainFromSlider(i);
				};
			}

			if (b.presetPanel) {
				const activatePresetTarget = (el) => {
					if (!el || !b.presetPanel.contains(el)) return;
					const key = el.getAttribute('data-preset');
					if (!key) return;
					const label = (el.textContent || '').trim() || key;
					applyNoisePreset(key, label, el);
				};
				b.presetPanel.addEventListener('click', function (e) {
					const el = e.target.closest('.actionlink[data-preset]');
					if (!el) return;
					activatePresetTarget(el);
				});
				b.presetPanel.addEventListener('keydown', function (e) {
					if (e.key !== 'Enter' && e.key !== ' ') return;
					const el = e.target.closest('.actionlink[data-preset]');
					if (!el || !b.presetPanel.contains(el)) return;
					e.preventDefault();
					activatePresetTarget(el);
				});
			}

			if (b.resetBtn) {
				b.resetBtn.addEventListener('click', () => {
					clearPresetChipActive();
					for (let i of b.sliderBar) {
						setSliderToMidpoint(i);
						applyBandGainFromSlider(i);
					}
					refreshAnimationAfterControlChange();
					if (b.displayInfo && !animEnabled) {
						b.displayInfo.textContent = 'All Bands';
					}
				});
			}

			// Animate: toggle slider animation
			if (b.animateBtn) {
				b.animateBtn.addEventListener('click', () => {
					if (animEnabled) {
						animEnabled = false;
						syncAnimationToPlaybackState();
						b.animateBtn.setAttribute('aria-pressed', 'false');
						if (b.displayInfo) b.displayInfo.textContent = 'Animation: Off';
					} else {
						animEnabled = true;
						syncAnimationToPlaybackState();
						b.animateBtn.setAttribute('aria-pressed', 'true');
						if (b.displayInfo) b.displayInfo.textContent = 'Animation: On';
					}
				});
			}

			// Timer: cycle sleep timer durations
			if (b.timerBtn) {
				b.timerBtn.addEventListener('click', () => {
					ensureTimerLabelUi();
					// Single-click cycles presets (Off → 1 → 5 → 10 → ... → Off).
					const idx = SLEEP_TIMER_CYCLE_MIN.indexOf(sleepTimerMinutes);
					sleepTimerMinutes =
						SLEEP_TIMER_CYCLE_MIN[(idx < 0 ? 0 : idx + 1) % SLEEP_TIMER_CYCLE_MIN.length];

					if (sleepTimerMinutes > 0) {
						b.timerBtn.setAttribute('aria-pressed', 'true');
						showTimerLabelUi();
						if (b.timerLabelInput) b.timerLabelInput.value = String(sleepTimerMinutes);
						if (b.displayInfo && !animEnabled) b.displayInfo.textContent = formatTimerLabel(sleepTimerMinutes);
						armSleepTimerIfPlaying();
					} else {
						b.timerBtn.setAttribute('aria-pressed', 'false');
						hideTimerLabelUi();
						clearSleepTimer();
						if (b.displayInfo && !animEnabled) b.displayInfo.textContent = formatTimerLabel(sleepTimerMinutes);
					}
				});
			}

			/* #increase = volume-down icon → quieter (thumb down) */
			if (b.increaseBtn) {
				b.increaseBtn.addEventListener('click', () => {
					clearPresetChipActive();
					for (let i of b.sliderBar) {
						var mn = Number(i.min) || 0;
						i.value = String(Math.max(mn, Number(i.value) - SLIDER_STEP));
						applyBandGainFromSlider(i);
					}
					refreshAnimationAfterControlChange();
					if (b.displayInfo && !animEnabled) {
						b.displayInfo.textContent = 'All Bands';
					}
				});
			}

			/* #decrease = volume-up icon → louder (thumb up) */
			if (b.decreaseBtn) {
				b.decreaseBtn.addEventListener('click', () => {
					clearPresetChipActive();
					for (let i of b.sliderBar) {
						var mx = Number(i.max) || 990;
						i.value = String(Math.min(mx, Number(i.value) + SLIDER_STEP));
						applyBandGainFromSlider(i);
					}
					refreshAnimationAfterControlChange();
					if (b.displayInfo && !animEnabled) {
						b.displayInfo.textContent = 'All Bands';
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

						// Keep current slider positions; use them for playback.
						syncLevelsFromSliders();
						setAllLevels();
						playNoise();
					}
				});
			}
		});
	};

	b.main();
})('undefined' != typeof window ? window : 'undefined' != typeof global ? global : 'undefined' != typeof self ? self : this);
</script>
<?php get_footer();