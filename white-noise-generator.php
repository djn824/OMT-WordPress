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
	border: 2px solid #436f8e;
	border-radius: 10px;
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
	padding: 0 3px;
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
	font-weight: 600;
}
.white-noise-presets span.actionlink:focus-visible {
	outline: 2px solid #e25c1b;
	outline-offset: 2px;
}
.white-noise-presets span.actionlink.is-active,
.white-noise-presets span.actionlink[aria-pressed="true"] {
	background-color: #e25c1b;
	color: #fff;
	font-weight: 300;
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
		margin: 1rem auto 0;
		padding-bottom: max(1rem, env(safe-area-inset-bottom, 0px));
	}
	.white-noise-presets span.actionlink {
		display: inline-flex;
		align-items: center;
	}
}
/* --- Three.js flowing-water background --- */
.noise-container {
	position: relative;
	isolation: isolate;
	height: 545px;
	overflow: hidden;
	border-radius: 18px;
	background:
		radial-gradient(circle at 18% 18%, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0) 31%),
		linear-gradient(180deg, #eafaff 0%, #9edcec 48%, #2d94b7 100%);
	box-shadow:
		inset 0 0 100px rgba(255, 255, 255, 0.38),
		inset 0 -70px 140px rgba(0, 94, 130, 0.24);
}
.noise-container::before,
.noise-container::after {
	content: '';
	position: absolute;
	inset: -18%;
	z-index: 1;
	pointer-events: none;
}
.noise-container::before {
	background:
		radial-gradient(ellipse at 22% 22%, rgba(255, 255, 255, 0.82), rgba(255, 255, 255, 0) 24%),
		radial-gradient(ellipse at 70% 74%, rgba(78, 206, 230, 0.32), rgba(78, 206, 230, 0) 36%);
	mix-blend-mode: screen;
	opacity: 0.84;
	transform: translate3d(-3%, 0, 0) rotate(-2deg);
	animation: noiseWaterGlow 14s ease-in-out infinite alternate;
}
.noise-container::after {
	display: none;
}
@keyframes noiseWaterGlow {
	from {
		transform: translate3d(-4%, -1%, 0) rotate(-2deg) scale(1.02);
	}
	to {
		transform: translate3d(4%, 2%, 0) rotate(2deg) scale(1.06);
	}
}
.noise-container:not(.is-playing)::before {
	animation-play-state: paused;
}
.noise-container .noise-bg-canvas {
	position: absolute;
	inset: 0;
	width: 100%;
	height: 100%;
	display: block;
	z-index: 0;
	opacity: 0;
	pointer-events: none;
	filter: saturate(1.26) contrast(1.08) brightness(1.02);
	transition: opacity 1.25s ease;
}
.noise-container .noise-bg-canvas.is-ready {
	opacity: 1;
}
/* Keep every interactive control above the animated background */
.noise-container .white-noise-layout {
	position: relative;
	z-index: 2;
}
/* Frosted panel so preset text stays legible over the animated background */
.white-noise-presets {
	background: rgba(255, 255, 255, 0.8);
	-webkit-backdrop-filter: blur(8px);
	backdrop-filter: blur(8px);
}
.white-noise .display-info span {
	text-shadow: 0 1px 6px rgba(255, 255, 255, 0.95);
}
.timer-label.is-running input {
	animation: timerPulse 1.4s ease-in-out infinite;
}
@keyframes timerPulse {
	0%,
	100% {
		box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.28);
		transform: scale(1);
	}
	50% {
		box-shadow: 0 0 0 5px rgba(255, 255, 255, 0);
		transform: scale(1.045);
	}
}
@media (prefers-reduced-motion: reduce) {
	.noise-container::before,
	.noise-container::after,
	.timer-label.is-running input {
		animation: none;
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
				<input type="range" name="Sub-Bass" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="Low Bass" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="Bass" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="High Bass" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="Low Mids" class="slider-bar" min="0" max="990" value="446" step="1">
			</div>
			<div class="slider">
				<input type="range" name="Mids" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="High Mids" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="Low Treble" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="Treble" class="slider-bar" min="0" max="990" value="446" step="1">
				<input type="range" name="High Treble" class="slider-bar" min="0" max="990" value="446" step="1">
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
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="deep-focus">Deep Focus</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="coding">Coding Focus</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="reading">Reading Focus</span>
					<span class="actionlink" role="button" tabindex="0" data-preset-group="focus" data-preset="studying">Study Sounds</span>
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
(() => {
	const b = {};

	const setSecondaryControlsVisible = (visible) => {
		if (!b.controlBar) return;
		b.controlBar.classList.toggle('is-controls-visible', !!visible);
	};

	const placeButton = () => {
		setSecondaryControlsVisible(true);
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
		setSecondaryControlsVisible(false);
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
	/** Soft first-play fade-in so the fallback synth never appears as a hard burst. */
	const PLAY_FADE_IN_S = 0.18;
	/** Stems bus fade-in on every Play — mix is faded to 0 during Stop so the next Play is a clean swell only */
	const STEMS_PLAY_FADE_IN_S = 0.93;
	/** Slightly longer fade-out on Stop to avoid clicks */
	const STOP_FADE_OUT_S = 0.35;
	/** The instant fallback is raw synthesized noise, so keep it below the calibrated stems. */
	const SYNTH_FALLBACK_GAIN = 0.62;
	const SYNTH_BAND_VOICING = [0.92, 0.94, 0.92, 0.88, 0.80, 0.70, 0.56, 0.42, 0.30, 0.22];

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
	let lastSchedulerTime = 0;
	let schedulerTimer = null;
	/** Pending suspend after Stop fade — must be cleared on Play or overlapping Stops */
	let stopAfterFadeTimeoutId = null;
	let launchCounter = 0;
	/** True after loadAllSounds() has been started — never load stems again on Play */
	let stemLoadStarted = false;
	let engineReady = false;
	let stemsStarted = false;
	let isplaying = false;
	window.__whiteNoiseIsPlaying = false;
	/** Precomputed motion from slider dB (amp, speed, ripple, narrow, rough, focusX). */
	window.__whiteNoiseWaterMotion = null;

	/** Slider represents linear level 0..0.99 (like white_noise.html). */
	const LEVEL_MAX = 0.99;
	/** Display clamp for near-zero levels (white_noise.html shows ~-129 dBFS at bottom). */
	const DB_FLOOR = -129;
	/** Slider step for +/- buttons (units of the range input, 0..990). */
	const SLIDER_STEP = 20;
	/** Initial / reset band level: matches `levelToDb` (26·ln(level)). */
	const DEFAULT_START_DBFS = -21;
	const DEFAULT_START_LEVEL = Math.min(LEVEL_MAX, Math.exp(DEFAULT_START_DBFS / 26));

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
	const ANIM_MIN_RANDOM_SPAN = 0.18;
	const ANIM_ZERO_RANDOM_HIGH = 0.42;

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
		setTimerPulseActive(false);
	}

	function formatTimerLabel(mins) {
		if (!mins || mins < 0) return 'Timer: Off';
		return 'Timer: ' + mins + ' min';
	}

	function formatTimerInputValue(mins) {
		return String(mins) + 'm';
	}

	function setTimerPulseActive(active) {
		if (!b.timerLabelWrap) return;
		b.timerLabelWrap.classList.toggle('is-running', !!active);
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
		input.style.padding = '6px 2px';
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
			b.timerLabelInput.value = formatTimerInputValue(remMin);
			return;
		}
		b.timerLabelInput.value = formatTimerInputValue(sleepTimerMinutes);
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

	/**
	 * Show a not-allowed cursor on a group volume button while its click would be a no-op:
	 * the raise button (#decrease, volume-up) when any band is already at max, and the lower
	 * button (#increase, volume-down) when any band is already at min. Mirrors the guards in
	 * the click handlers. Call after anything that changes slider values.
	 */
	function updateVolumeButtonCursors() {
		if (!b.sliderBar || !b.sliderBar.length) return;
		let anyAtMax = false;
		let anyAtMin = false;
		for (let i = 0; i < b.sliderBar.length; i++) {
			const el = b.sliderBar[i];
			const mn = Number(el.min) || 0;
			const mx = Number(el.max) || 990;
			const v = Number(el.value);
			if (v >= mx) anyAtMax = true;
			if (v <= mn) anyAtMin = true;
		}
		if (b.decreaseBtn) {
			b.decreaseBtn.style.cursor = anyAtMax ? 'not-allowed' : '';
			b.decreaseBtn.setAttribute('aria-disabled', anyAtMax ? 'true' : 'false');
		}
		if (b.increaseBtn) {
			b.increaseBtn.style.cursor = anyAtMin ? 'not-allowed' : '';
			b.increaseBtn.setAttribute('aria-disabled', anyAtMin ? 'true' : 'false');
		}
	}

	function armSleepTimerIfPlaying() {
		clearSleepTimer();
		if (!isplaying || !engineReady) return;
		if (!sleepTimerMinutes || sleepTimerMinutes < 0) return;
		sleepTimerEndAtMs = Date.now() + sleepTimerMinutes * 60 * 1000;
		setTimerPulseActive(true);
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
		// Random should still move silent bands; otherwise 0 creates a locked 0..0 range.
		for (let i = 0; i < iNUMBERBANDS; i++) {
			const level = clamp(currentLevel[i], 0, LEVEL_MAX);
			let lo = clamp(level * 0.5, 0, LEVEL_MAX);
			let hi = clamp(level * 1.25, 0, LEVEL_MAX);

			if (level <= 0.001) {
				lo = 0;
				hi = clamp(ANIM_ZERO_RANDOM_HIGH, 0, LEVEL_MAX);
			} else if (hi - lo < ANIM_MIN_RANDOM_SPAN) {
				lo = clamp(level - ANIM_MIN_RANDOM_SPAN / 2, 0, LEVEL_MAX);
				hi = clamp(lo + ANIM_MIN_RANDOM_SPAN, 0, LEVEL_MAX);
				lo = clamp(hi - ANIM_MIN_RANDOM_SPAN, 0, LEVEL_MAX);
			}

			animationProfileLow[i] = lo;
			animationProfileHigh[i] = hi;
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
		currentLevel[i] = DEFAULT_START_LEVEL;
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

	/** Frequency chip: nearest band to `hz` at midDb, neighbours at sideDb; all other bands 0. */
	function makeFixedFreqChipLevels(hz, sideDb, midDb) {
		const j = bandIndexForHz(hz);
		const out = new Array(iNUMBERBANDS).fill(0);
		if (j > 0) {
			out[j - 1] = dbfsToLevel(sideDb);
		}
		out[j] = dbfsToLevel(midDb);
		if (j < iNUMBERBANDS - 1) {
			out[j + 1] = dbfsToLevel(sideDb);
		}
		return out;
	}

	/** Preset key → [ centreHz, sideDb, midDb ]; neighbours at sideDb, centre band at midDb, rest 0. */
	const FIXED_FREQ_CHIP_PRESETS = {
		f63: [63, -17, -7],
		f125: [125, -13, -7],
		f250: [250, -14, -7],
		f500: [500, -15, -7],
		f1k: [1000, -15, -7],
		f2k: [2000, -15, -7],
		f4k: [4000, -15, -7],
		f8k: [8000, -14, -7]
	};

	/** Full-band presets: exact dBFS per slider (Sub-Bass → High Treble), no normalize pass. */
	const FIXED_FULLBAND_DB_PRESETS = {
		white: [-39, -35, -31, -28, -26, -22, -19, -17, -14, -13],
		brown: [-13, -15, -17, -20, -23, -26, -29, -32, -35, -39],
		grey: [-7, -21, -25, -31, -31, -31, -34, -37, -31, -21],
		studying: [0, 0, 0, 0, -13, -60, -49, -58, -129, -52],
		'deep-focus': [-21, -8, 0, -7, -17, -29, -47, -90, -129, -129],
		reading: [-25, -9, 0, -9, -38, -56, -58, -58, -63, -63],
		coding: [-41, -11, -5, -4, -5, -7, -12, -17, -17, -17],
		'voice-mask': [-10, -10, -11, -13, -16, -20, -26, -36, -51, -129],
		'cafe-blur': [-11, -11, -11, -12, -16, -20, -22, -23, -24, -24],
		'quiet-bubble': [-129, -129, -41, -37, -129, -41, -32, -19, -19, -19],
		'night-drift': [0, 0, 0, 0, -7, -17, -24, -34, -49, -49],
		'deep-sleep': [-5, 0, -4, -10, -20, -32, -48, -70, -100, -100],
		'calm-hush': [-15, -6, -3, -4, -10, -18, -29, -37, -38, -38],
	};

	/** Per-slider wave routing from band position: bass swell, rising speed, treble narrow/ripple. */
	function buildBandIndexWaterWeights() {
		const amp = new Float32Array(iNUMBERBANDS);
		const speed = new Float32Array(iNUMBERBANDS);
		const ripple = new Float32Array(iNUMBERBANDS);
		const narrow = new Float32Array(iNUMBERBANDS);
		const rough = new Float32Array(iNUMBERBANDS);
		for (let i = 0; i < iNUMBERBANDS; i++) {
			const t = i / (iNUMBERBANDS - 1);
			amp[i] = t < 0.38 ? 1.05 - t * 0.22 : -(0.42 + (t - 0.38) * 1.15);
			speed[i] = 0.08 + Math.pow(t, 0.82) * 0.92;
			ripple[i] = 0.55 + t * 0.45;
			narrow[i] = Math.pow(t, 1.15);
			rough[i] = 0.22 + t * 0.62;
		}
		return { amp: amp, speed: speed, ripple: ripple, narrow: narrow, rough: rough };
	}

	const DEFAULT_WATER_BAND_WEIGHTS = buildBandIndexWaterWeights();
	window.__whiteNoiseDefaultWaterBandWeights = DEFAULT_WATER_BAND_WEIGHTS;

	const PINK_RAW = new Array(iNUMBERBANDS).fill(0.3);

	/** Blue noise: +3 dB/oct power (amplitude ~ sqrt(Hz)); matches common web blue-noise generators. */
	function blueRawStandard() {
		const f0 = MY_EQ_CENTER_FREQS[0];
		const out = [];
		for (let i = 0; i < iNUMBERBANDS; i++) {
			out.push(Math.sqrt(MY_EQ_CENTER_FREQS[i] / f0));
		}
		return out;
	}

	/** Violet noise: +6 dB/oct power (amplitude ~ Hz); matches common web violet-noise generators. */
	function violetRawStandard() {
		const f0 = MY_EQ_CENTER_FREQS[0];
		const out = [];
		for (let i = 0; i < iNUMBERBANDS; i++) {
			out.push(MY_EQ_CENTER_FREQS[i] / f0);
		}
		return out;
	}

	const NOISE_PRESET_RAW = {
		pink: PINK_RAW,
		blue: blueRawStandard(),
		violet: violetRawStandard(),
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
		let levels;
		const bandDb = FIXED_FULLBAND_DB_PRESETS[presetKey];
		if (bandDb && bandDb.length === iNUMBERBANDS) {
			levels = bandDb.map(function (db) {
				return clampPresetLevel(dbfsToLevel(db));
			});
		} else if (FIXED_FREQ_CHIP_PRESETS[presetKey]) {
			const chip = FIXED_FREQ_CHIP_PRESETS[presetKey];
			levels = makeFixedFreqChipLevels(chip[0], chip[1], chip[2]).map(clampPresetLevel);
		} else {
			const rawTemplate = NOISE_PRESET_RAW[presetKey];
			if (!rawTemplate || rawTemplate.length !== iNUMBERBANDS) return;
			levels = normalizeMyNoiseLevels(rawTemplate).map(clampPresetLevel);
		}
		for (let i = 0; i < iNUMBERBANDS; i++) {
			currentLevel[i] = levels[i];
		}
		updateSlidersFromLevels(levels, !!isplaying);
		updateVolumeButtonCursors();
		refreshAnimationAfterControlChange();
		clearPresetChipActive();
		if (activeButton) {
			activeButton.classList.add('is-active');
			activeButton.setAttribute('aria-pressed', 'true');
		}
		publishWaterBandLevels();
		// Preset/chip change: let the water jump straight to the new shape (manual slider
		// drags leave this clear so they ease in gradually instead).
		window.__whiteNoiseWaterMotionSnap = true;
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
			return;
		}

		nextA[i] = startTime;
		nextB[i] = startTime + (Math.round(sourceA[i].buffer.duration * 8) / 16) * stretch[i] / playbackFactor[i];

		scheduleA(i, nextA[i]);
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
		publishWaterBandLevels();
		var now = context.currentTime;
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			const g = Math.pow(currentLevel[i], 3);
			if (gainNode[i] && gainNode[i].gain) {
				gainNode[i].gain.setTargetAtTime(g, now, fAUDIOFADETIME);
			}
			if (synthBandGain[i] && synthBandGain[i].gain) {
				synthBandGain[i].gain.setTargetAtTime(g * SYNTH_BAND_VOICING[i], now, fAUDIOFADETIME);
			}
		}
	}

	function setAllLevelsImmediate() {
		if (!engineReady) {
			return;
		}
		publishWaterBandLevels();
		var now = context.currentTime;
		for (let i = 0; i < iNUMBERBANDS; ++i) {
			const g = Math.pow(currentLevel[i], 3);
			if (gainNode[i] && gainNode[i].gain) {
				gainNode[i].gain.cancelScheduledValues(now);
				gainNode[i].gain.setValueAtTime(g, now);
			}
			if (synthBandGain[i] && synthBandGain[i].gain) {
				synthBandGain[i].gain.cancelScheduledValues(now);
				synthBandGain[i].gain.setValueAtTime(g * SYNTH_BAND_VOICING[i], now);
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

	function waterDbResponse(db) {
		const clamped = clamp(db, -60, 0);
		const t = clamp((clamped + 58) / 50, 0, 1);
		const smooth = t * t * (3 - 2 * t);
		return Math.pow(smooth, 0.72);
	}

	function waterRegionEnergy(dbArr, from, to) {
		let sum = 0;
		for (let i = from; i <= to; i++) {
			sum += waterDbResponse(dbArr[i]);
		}
		return sum / (to - from + 1);
	}

	/** Weighted blend: each slider contributes by its level × band-index weight. */
	function waterSliderBlend(weights, bandE) {
		let num = 0;
		let den = 0;
		for (let i = 0; i < iNUMBERBANDS; i++) {
			const e = bandE[i];
			if (e < 0.001) {
				continue;
			}
			const w = weights[i];
			num += w < 0 ? (1 - e) * Math.abs(w) : w * e;
			den += e;
		}
		return den > 0.001 ? clamp(num / den, 0, 1) : 0;
	}

	/** Motion derived only from live slider dB levels (each band weighted by index). */
	function computeWaterMotionState() {
		const dbArr = window.__whiteNoiseBandDbLevels;
		if (!dbArr || dbArr.length !== iNUMBERBANDS) {
			return null;
		}
		const weights = window.__whiteNoiseDefaultWaterBandWeights;
		if (!weights) {
			return null;
		}

		const bandE = new Array(iNUMBERBANDS);
		let totalE = 0;
		let centroid = 0;
		for (let i = 0; i < iNUMBERBANDS; i++) {
			bandE[i] = waterDbResponse(dbArr[i]);
			totalE += bandE[i];
			centroid += bandE[i] * (i / (iNUMBERBANDS - 1));
		}
		// With effectively no energy, leave the centroid at the centre so the funnel
		// stays mid-frame instead of snapping to an edge once amplified below.
		centroid = totalE > 0.01 ? centroid / totalE : 0.5;
		totalE = Math.max(totalE, 0.001);

		const bassE = waterRegionEnergy(dbArr, 0, 3);
		const midE = waterRegionEnergy(dbArr, 4, 6);
		const trebleE = waterRegionEnergy(dbArr, 7, 9);

		let amp = waterSliderBlend(weights.amp, bandE);
		let speed = waterSliderBlend(weights.speed, bandE);
		let ripple = waterSliderBlend(weights.ripple, bandE);
		let narrow = waterSliderBlend(weights.narrow, bandE);
		const roughBase = waterSliderBlend(weights.rough, bandE);

		amp = clamp(amp + bassE * 0.22, 0.04, 1);
		narrow = clamp(narrow * (1 - bassE * 0.38), 0, 1);
		speed = clamp(speed * (0.22 + centroid * 1.05), 0, 1);
		speed = clamp(speed + trebleE * 0.18 * (1 - bassE * 0.55), 0, 1);
		speed = clamp(speed + midE * 0.14, 0, 1);
		narrow = clamp(narrow + trebleE * 0.12 * (1 - bassE * 0.45), 0, 1);
		let rough = clamp(roughBase * ripple * (0.32 + Math.min(bassE, midE) * 0.5), 0, 1);
		rough = clamp(rough + midE * 0.08, 0, 1);
		const chop = rough;

		// Energy-weighted band index → horizontal vanishing point (bass left, treble right).
		// The raw centroid clusters tightly around 0.5 for most presets (every audible band
		// contributes), so amplify its deviation from centre and spread it across a wider
		// horizontal range. This makes the funnel/vanishing point visibly track the spectral
		// balance and drift as the sliders (or Random) move, instead of sitting mid-frame.
		const FOCUS_SPREAD_GAIN = 2.35;
		const centroidSpread = clamp(0.5 + (centroid - 0.5) * FOCUS_SPREAD_GAIN, 0, 1);
		const focusX = clamp(0.18 + centroidSpread * 0.64, 0.18, 0.82);

		// Horizontal flow direction from the same spectral balance: -1 = water flows
		// toward the left (bass-heavy), +1 = toward the right (treble-heavy), 0 = neutral
		// (waves fall straight down). Shares the amplified centroid so the funnel point
		// and the flow direction always agree.
		const flowDir = clamp((centroidSpread - 0.5) * 2, -1, 1);

		return {
			amp: amp,
			speed: speed,
			ripple: ripple,
			narrow: clamp(narrow, 0, 1),
			rough: rough,
			chop: chop,
			focusX: focusX,
			flowDir: flowDir,
			bassE: bassE,
			midE: midE,
			trebleE: trebleE,
		};
	}

	function publishWaterBandLevels() {
		const out = new Array(iNUMBERBANDS);
		for (let i = 0; i < iNUMBERBANDS; i++) {
			const db = levelToDb(currentLevel[i]);
			out[i] = clamp(db, -60, 0);
		}
		window.__whiteNoiseBandDbLevels = out;
		window.__whiteNoiseWaterMotion = computeWaterMotionState();
	}
	publishWaterBandLevels();

	function dbfsToLevel(db) {
		if (!isFinite(db) || db <= DB_FLOOR) {
			return 0;
		}
		return Math.min(LEVEL_MAX, Math.exp(db / 26));
	}

	function setSliderToDefaultStart(sliderEl) {
		sliderEl.value = String(levelToSliderValue(DEFAULT_START_LEVEL, sliderEl));
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
		const synthTone = context.createBiquadFilter();
		synthTone.type = 'lowpass';
		synthTone.frequency.value = 6200;
		synthTone.Q.value = 0.35;
		synthMasterGain.connect(synthTone).connect(masterGain);

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
		publishWaterBandLevels();
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
			var synthG = g * SYNTH_BAND_VOICING[idx];
			if (immediateGain) {
				synthBandGain[idx].gain.cancelScheduledValues(t);
				synthBandGain[idx].gain.setValueAtTime(synthG, t);
			} else {
				synthBandGain[idx].gain.setTargetAtTime(synthG, t, fAUDIOFADETIME);
			}
		}
	}

	/** Set all sliders to the default start level (-21 dBFS per band). */
	function applyHalfRangeToAllSliders(immediateGain) {
		for (let i = 0; i < b.sliderBar.length; i++) {
			var el = b.sliderBar[i];
			setSliderToDefaultStart(el);
			applyBandGainFromSlider(el, immediateGain);
		}
		if (b.displayInfo && b.sliderBar.length) {
			var refLevel = sliderToLevel(b.sliderBar[0]);
			var refDb = Math.round(levelToDb(refLevel));
			b.displayInfo.textContent = 'All bands: ' + refDb.toLocaleString() + ' dBFS';
		}
	}

	function syncWaterBackgroundPlayback() {
		const container = window.document.querySelector('.noise-container');
		if (!container) return;
		container.classList.toggle('is-playing', !!isplaying);
	}

	function playNoise() {
		if (!engineReady) {
			return;
		}

		if (stopAfterFadeTimeoutId !== null) {
			clearTimeout(stopAfterFadeTimeoutId);
			stopAfterFadeTimeoutId = null;
		}

		// Flip state immediately so UI animations stay in sync with user intent.
		// Audio start is async (AudioContext.resume), but the button/animation should not lag.
		isplaying = true;
		window.__whiteNoiseIsPlaying = true;
		syncWaterBackgroundPlayback();

		function beginPlayback() {
			if (!isplaying) {
				return;
			}
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
				stemsMixGain.gain.linearRampToValueAtTime(1, now + STEMS_PLAY_FADE_IN_S);
				if (synthMasterGain) {
					synthMasterGain.gain.cancelScheduledValues(now);
					synthMasterGain.gain.setValueAtTime(synthMasterGain.gain.value, now);
					synthMasterGain.gain.linearRampToValueAtTime(0, now + STEMS_PLAY_FADE_IN_S);
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
					synthMasterGain.gain.linearRampToValueAtTime(SYNTH_FALLBACK_GAIN, now + PLAY_FADE_IN_S);
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
			window.__whiteNoiseIsPlaying = false;
			syncWaterBackgroundPlayback();
		});

		// Resume animation (if enabled) when audio starts.
		syncAnimationToPlaybackState();
		armSleepTimerIfPlaying();
	}

	function stopNoise() {
		// Flip state immediately so UI animations stay in sync with user intent.
		isplaying = false;
		window.__whiteNoiseIsPlaying = false;
		syncWaterBackgroundPlayback();
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
		// Fade stem/synth buses with the master so the next Play is not a fast 1→0 “erase” before the swell.
		if (stemsMixGain) {
			stemsMixGain.gain.cancelScheduledValues(now);
			stemsMixGain.gain.setValueAtTime(stemsMixGain.gain.value, now);
			stemsMixGain.gain.linearRampToValueAtTime(0, now + STOP_FADE_OUT_S);
		}
		if (synthMasterGain) {
			synthMasterGain.gain.cancelScheduledValues(now);
			synthMasterGain.gain.setValueAtTime(synthMasterGain.gain.value, now);
			synthMasterGain.gain.linearRampToValueAtTime(0, now + STOP_FADE_OUT_S);
		}

		if (stopAfterFadeTimeoutId !== null) {
			clearTimeout(stopAfterFadeTimeoutId);
		}
		stopAfterFadeTimeoutId = window.setTimeout(function () {
			stopAfterFadeTimeoutId = null;
			stopScheduler();
			if (context && context.state === 'running') {
				context.suspend();
			}
		}, STOP_FADE_OUT_S * 1000);

	}

	function setupResponsivePresetPanel() {
		const panel = b.presetPanel;
		const layout = window.document.querySelector('.white-noise-layout');
		const container = window.document.querySelector('.noise-container');
		if (!panel || !layout || !container || !container.parentNode) return;

		const mediaQuery = window.matchMedia('(max-width: 900px)');
		const anchor = window.document.createComment('white-noise-presets-anchor');
		layout.insertBefore(anchor, panel);

		const syncPlacement = () => {
			if (mediaQuery.matches) {
				if (panel.parentNode !== container.parentNode || panel.previousElementSibling !== container) {
					container.insertAdjacentElement('afterend', panel);
				}
				return;
			}

			if (anchor.parentNode && panel.parentNode !== layout) {
				anchor.parentNode.insertBefore(panel, anchor.nextSibling);
			}
		};

		syncPlacement();
		if (mediaQuery.addEventListener) {
			mediaQuery.addEventListener('change', syncPlacement);
		} else {
			mediaQuery.addListener(syncPlacement);
		}
	}

	b.main = () => {
		window.addEventListener('DOMContentLoaded', function () {
			b.check = window.document.getElementById('main-btn');
			b.controlBar = window.document.querySelector('.control-bar');
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
			setupResponsivePresetPanel();
			replaceButton();

			for (let i of b.sliderBar) {
				// Ensure numeric value; default to -21 dBFS.
				if (i.value === '' || i.value == null || isNaN(Number(i.value))) {
					setSliderToDefaultStart(i);
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
					updateVolumeButtonCursors();
				};
			}
			updateVolumeButtonCursors();

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
						setSliderToDefaultStart(i);
						applyBandGainFromSlider(i);
					}
					updateVolumeButtonCursors();
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
						if (b.timerLabelInput) b.timerLabelInput.value = formatTimerInputValue(sleepTimerMinutes);
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
					// Don't lower if any slider is already at its minimum.
					for (let i of b.sliderBar) {
						var mn = Number(i.min) || 0;
						if (Number(i.value) <= mn) return;
					}
					clearPresetChipActive();
					for (let i of b.sliderBar) {
						var mn = Number(i.min) || 0;
						i.value = String(Math.max(mn, Number(i.value) - SLIDER_STEP));
						applyBandGainFromSlider(i);
					}
					updateVolumeButtonCursors();
					refreshAnimationAfterControlChange();
					if (b.displayInfo && !animEnabled) {
						b.displayInfo.textContent = 'All Bands';
					}
				});
			}

			/* #decrease = volume-up icon → louder (thumb up) */
			if (b.decreaseBtn) {
				b.decreaseBtn.addEventListener('click', () => {
					// Don't raise if any slider is already at its maximum.
					for (let i of b.sliderBar) {
						var mx = Number(i.max) || 990;
						if (Number(i.value) >= mx) return;
					}
					clearPresetChipActive();
					for (let i of b.sliderBar) {
						var mx = Number(i.max) || 990;
						i.value = String(Math.min(mx, Number(i.value) + SLIDER_STEP));
						applyBandGainFromSlider(i);
					}
					updateVolumeButtonCursors();
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
})();
</script>
<script type="module">
/**
 * Procedural flowing-water background for .noise-container.
 * A Three.js full-bleed quad draws rolling aqua waves, foam crests,
 * pearlescent depth, and subtle caustic highlights over a cool white ground.
 * No video, no images. Degrades silently to nothing if WebGL is unavailable.
 */
import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js';

(function () {
	const container = document.querySelector('.noise-container');
	if (!container) return;

	const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// --- Renderer -------------------------------------------------------
	let renderer;
	try {
		renderer = new THREE.WebGLRenderer({ antialias: false, powerPreference: 'low-power' });
	} catch (e) {
		// No WebGL support — the generator UI works fine without the background.
		return;
	}
	renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));

	const canvas = renderer.domElement;
	canvas.className = 'noise-bg-canvas';
	canvas.setAttribute('aria-hidden', 'true');
	container.insertBefore(canvas, container.firstChild);

	// --- Scene / camera -------------------------------------------------
	const scene = new THREE.Scene();
	const camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0.1, 10);
	camera.position.z = 1;

	// --- Water Pro inspired surface --------------------------------------
	// WebGPU FFT water is not embedded here; this WebGL shader recreates the
	// visible style with Gerstner-like swells, ripples, Fresnel, foam, and caustics.
	const BAND_COUNT = 10;
	const WATER_DB_FLOOR = -60;
	const bandDbLevels = new Float32Array(BAND_COUNT).fill(WATER_DB_FLOOR);
	const smoothedBandDbLevels = new Float32Array(BAND_COUNT).fill(WATER_DB_FLOOR);
	const ZERO_WATER_MOTION = { amp: 0.04, speed: 0, ripple: 0.02, narrow: 0.1, rough: 0.04, chop: 0.03, focusX: 0.5, flowDir: 0 };
	const uniforms = {
		uTime: { value: 0 },
		uBandDb: { value: smoothedBandDbLevels },
		uAudioEnergy: { value: 0 },
		uMotionAmp: { value: ZERO_WATER_MOTION.amp },
		uMotionSpeed: { value: ZERO_WATER_MOTION.speed },
		uMotionRipple: { value: ZERO_WATER_MOTION.ripple },
		uNarrow: { value: ZERO_WATER_MOTION.narrow },
		uRough: { value: ZERO_WATER_MOTION.rough },
		uChop: { value: ZERO_WATER_MOTION.chop },
		uFocusX: { value: ZERO_WATER_MOTION.focusX },
		uFlowDir: { value: ZERO_WATER_MOTION.flowDir },
		uFlowMix: { value: 0 },
		uShallow: { value: new THREE.Color(0x78e4ee) },
		uMid: { value: new THREE.Color(0x1aa4c8) },
		uDeep: { value: new THREE.Color(0x07577c) },
		uSky: { value: new THREE.Color(0xe8fbff) },
		uFoam: { value: new THREE.Color(0xf8ffff) },
		uSun: { value: new THREE.Color(0xffffff) }
	};

	const material = new THREE.ShaderMaterial({
		uniforms: uniforms,
		extensions: {
			derivatives: true
		},
		vertexShader: `
			varying vec2 vUv;
			void main() {
				vUv = uv;
				gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
			}
		`,
		fragmentShader: `
			precision highp float;
			#define TAU 6.2831853
			#define BAND_COUNT ${BAND_COUNT}
			uniform float uTime;
			uniform float uBandDb[BAND_COUNT];
			uniform float uAudioEnergy;
			uniform float uMotionAmp;
			uniform float uMotionSpeed;
			uniform float uMotionRipple;
			uniform float uNarrow;
			uniform float uRough;
			uniform float uChop;
			uniform float uFocusX;
			uniform float uFlowDir;
			uniform float uFlowMix;
			uniform vec3 uShallow;
			uniform vec3 uMid;
			uniform vec3 uDeep;
			uniform vec3 uSky;
			uniform vec3 uFoam;
			uniform vec3 uSun;
			varying vec2 vUv;

			float hash21(vec2 p) {
				p = fract(p * vec2(127.1, 311.7));
				p += dot(p, p + 34.13);
				return fract(p.x * p.y);
			}

			float noise(vec2 p) {
				vec2 i = floor(p);
				vec2 f = fract(p);
				f = f * f * (3.0 - 2.0 * f);
				float a = hash21(i);
				float b = hash21(i + vec2(1.0, 0.0));
				float c = hash21(i + vec2(0.0, 1.0));
				float d = hash21(i + vec2(1.0, 1.0));
				return mix(mix(a, b, f.x), mix(c, d, f.x), f.y);
			}

			float fbm(vec2 p) {
				float v = 0.0;
				float a = 0.52;
				mat2 m = mat2(1.62, 1.17, -1.17, 1.62);
				for (int i = 0; i < 5; i++) {
					v += a * noise(p);
					p = m * p + vec2(4.7, 2.3);
					a *= 0.48;
				}
				return v;
			}

			float waveHeight(vec2 p, float t, float waveAmp, float waveSpeed, float rippleEnergy, float energy, float narrow, float rough, float chop, float flowDir) {
				float swellWide = 1.0 + (1.0 - narrow) * 0.85;
				float swellFreq = (0.52 + narrow * 1.35) / swellWide;
				float swellAmp = (0.06 + 0.92 * waveAmp) * swellWide;
				float motion = 0.06 + 1.85 * waveSpeed;
				float rippleScale = 1.6 + 5.2 * rippleEnergy + narrow * 2.4;
				float rippleAmp = (0.04 + 0.64 * rippleEnergy) * (0.75 + rough * 0.55 + chop * 0.35);
					// Tilt every wave train toward the current so the crests travel across the
					// panel with the spectral balance, instead of the whole field sliding rigidly.
					float ang = flowDir * 0.7;
					float cs = cos(ang);
					float sn = sin(ang);
					mat2 flowRot = mat2(cs, -sn, sn, cs);
					vec2 d0 = flowRot * vec2(0.62, 0.34);
					vec2 d1 = flowRot * vec2(-0.25, 0.86);
					vec2 d2 = flowRot * vec2(0.92, 0.12);
				float swell =
					swellAmp * sin(dot(p, d0) * TAU * swellFreq - t * motion) +
					(0.03 + 0.5 * waveAmp) * sin(dot(p, d1) * TAU * (1.02 + narrow * 0.55) + t * (0.06 + motion * 0.78)) +
					(0.02 + 0.24 * energy) * sin(dot(p, d2) * TAU * (1.85 + narrow * 1.1) - t * (0.1 + motion * 0.92));
				vec2 rippleUv = p * rippleScale + vec2(
					t * (0.03 + waveSpeed * 0.68 + chop * 0.22),
					-t * (0.02 + rippleEnergy * 0.48 + rough * 0.18)
				);
				float ripples = fbm(rippleUv) - 0.5;
				if (rough > 0.35) {
					ripples += 0.22 * rough * (fbm(rippleUv * 2.15 + vec2(t * 0.18, -t * 0.12)) - 0.5);
				}
				return swell + ripples * rippleAmp;
			}

			vec3 waterNormal(vec2 p, float t, float waveAmp, float waveSpeed, float rippleEnergy, float energy, float narrow, float rough, float chop, float flowDir) {
				float e = 0.025;
				float h = waveHeight(p, t, waveAmp, waveSpeed, rippleEnergy, energy, narrow, rough, chop, flowDir);
				float hx = waveHeight(p + vec2(e, 0.0), t, waveAmp, waveSpeed, rippleEnergy, energy, narrow, rough, chop, flowDir);
				float hy = waveHeight(p + vec2(0.0, e), t, waveAmp, waveSpeed, rippleEnergy, energy, narrow, rough, chop, flowDir);
				return normalize(vec3((h - hx) / e, 1.4, (h - hy) / e));
			}

			void main() {
				float x = vUv.x;
				float y = vUv.y;

				float t = uTime;
				float depth = smoothstep(0.0, 1.0, y);
				float ampControl = clamp(uMotionAmp, 0.04, 1.0);
				float speedControl = clamp(uMotionSpeed, 0.0, 1.0);
				float rippleControl = clamp(uMotionRipple, 0.0, 1.0);
				float narrow = clamp(uNarrow, 0.0, 1.0);
				float rough = clamp(uRough, 0.0, 1.0);
				float chop = clamp(uChop, 0.0, 1.0);
				float energy = clamp(uAudioEnergy, 0.0, 1.0);
				float flow = clamp(uFlowMix, 0.0, 1.0);

				// Stable full-frame water coordinates. Avoid a horizon split so the
				// lower panel never stretches into vertical stripe artifacts.
				float focusX = mix(clamp(uFocusX, 0.18, 0.82), 0.5, 0.85);
				float flowDir = clamp(uFlowDir, -1.0, 1.0);
				float perspective = mix(2.08 + ampControl * 0.76, 0.92, smoothstep(0.0, 1.0, y));
				vec2 p = vec2((x - focusX) * perspective * 2.15, (1.0 - y) * 2.35 + y * 0.42);
				// Diagonal current from the spectral balance. With the bottom pinch centred at
				// bottom-mid, a leftward lean (flowDir < 0, bass) flows from the TOP-RIGHT down to
				// bottom-mid, and a rightward lean (flowDir > 0, treble) flows from the TOP-LEFT down.
				// (Sampling-offset sign is inverted: lookup +x moves the pattern -x on screen.)
				// Driven purely by flowDir so left and right are symmetric — a constant
				// horizontal bias here would cancel the rightward flow while doubling the
				// leftward one. Balanced spectrum => no sideways drift, water falls straight.
				// The meander adds a slow depth-dependent wobble so the flow
					// curves gently across the panel rather than sliding as one flat sheet.
					float lateral = flowDir * (0.06 + speedControl * 0.34);
					float meander = flowDir * 0.05 * sin(t * 0.45 + (1.0 - y) * 2.6);
					float sideDrift = -(lateral * t) - meander;
				p += vec2(sideDrift, -t * (0.028 + speedControl * 0.28));

				float h = waveHeight(p, t, ampControl, speedControl, rippleControl, energy, narrow, rough, chop, flowDir);
				vec3 n = waterNormal(p, t, ampControl, speedControl, rippleControl, energy, narrow, rough, chop, flowDir);
				vec3 viewDir = normalize(vec3(0.0, 0.78, 1.25));
				vec3 sunDir = normalize(vec3(-0.42, 0.82, 0.35));
				float fresnel = pow(1.0 - clamp(dot(n, viewDir), 0.0, 1.0), 3.0);
				float spec = pow(max(dot(reflect(-sunDir, n), viewDir), 0.0), 90.0);

				vec3 sky = mix(vec3(0.88, 0.98, 1.0), uSky, smoothstep(0.18, 1.0, y));
				vec3 water = mix(uDeep, uMid, depth);
				water = mix(water, uShallow, smoothstep(0.08, 0.88, h * 0.42 + fbm(p * 0.7)));
				vec3 col = mix(water, sky, fresnel * 0.66);

				// White breaking foam appears where the simulated surface folds sharply.
				float steep = length(vec2(dFdx(h), dFdy(h))) * 7.5;
				float foam = smoothstep(0.30, 0.82, steep + h * (0.09 + energy * 0.44));
				foam *= smoothstep(0.04, 0.64, y);
				foam *= 0.38 + 0.62 * fbm(p * (4.2 + rippleControl * 5.0 + rough * 3.5) + vec2(t * (0.12 + speedControl * 1.05 + chop * 0.35), -t * 0.24));
				foam *= flow;

				col = mix(col, uFoam, clamp(foam, 0.0, 0.70));

				// Caustic lattice and sun sparkle, strongest near the foreground.
				float caustic =
					sin((p.x * (2.4 + rippleControl * 3.2) + h * 1.7 + t * (0.045 + speedControl * 0.44)) * TAU) *
					sin((p.y * 2.9 - h * 1.2 - t * (0.035 + speedControl * 0.36)) * TAU);
				col += uShallow * smoothstep(0.56, 1.0, caustic) * depth * (0.025 + rippleControl * 0.19) * flow;
				col += uSun * spec * (0.22 + energy * 1.05) * flow;

				float glitter = smoothstep(0.992, 1.0, hash21(floor((p + n.xz * 0.3) * 42.0)) + spec * 0.28);
				col = mix(col, uFoam, glitter * depth * (0.04 + rippleControl * 0.50) * flow);

				// Soft reflection keeps the water bright behind the controls.
				float mist = smoothstep(0.34, 1.0, y);
				col = mix(col, sky, mist * 0.30);
				float vignette = smoothstep(1.05, 0.18, distance(vec2(x, y), vec2(focusX, 0.58)));
				col *= 0.90 + 0.10 * vignette;

				gl_FragColor = vec4(clamp(col, 0.0, 1.0), 1.0);
			}
		`
	});

	const quad = new THREE.Mesh(new THREE.PlaneGeometry(2, 2), material);
	scene.add(quad);

	// --- Resize ---------------------------------------------------------
	function resize() {
		renderer.setSize(container.clientWidth || 1, container.clientHeight || 1, false);
	}
	resize();

	if (typeof ResizeObserver !== 'undefined') {
		new ResizeObserver(resize).observe(container);
	} else {
		window.addEventListener('resize', resize);
	}

	let revealed = false;
	function reveal() {
		if (revealed) return;
		revealed = true;
		canvas.classList.add('is-ready');
	}

	// --- Render loop ----------------------------------------------------
	const clock = new THREE.Clock();
	let running = !reduceMotion;
	let flowActivity = 0;
	const WATER_FLOW_ATTACK_S = 0.18;
	const WATER_FLOW_RELEASE_S = 0.28;
	function easeToward(current, target, dt, timeConstant) {
		const tc = Math.max(0.0001, timeConstant || 0.0001);
		const alpha = 1 - Math.exp(-dt / tc);
		return current + (target - current) * alpha;
	}
	function dbToVisualResponse(db) {
		return Math.min(1, Math.max(0, (db + 54) / 48));
	}
	function updateWaterAudioUniforms(flowMix, snap) {
		const source = window.__whiteNoiseBandDbLevels;
		let energy = 0;
		for (let i = 0; i < BAND_COUNT; i++) {
			const rawTarget = source && Number.isFinite(source[i]) ? source[i] : bandDbLevels[i];
			const gatedTarget = WATER_DB_FLOOR + (rawTarget - WATER_DB_FLOOR) * flowMix;
			bandDbLevels[i] = gatedTarget;
			// snap = preset/chip change: jump straight to the new shape. Otherwise ease.
			if (snap) {
				smoothedBandDbLevels[i] = gatedTarget;
			} else {
				smoothedBandDbLevels[i] += (gatedTarget - smoothedBandDbLevels[i]) * 0.08;
			}
			energy += dbToVisualResponse(smoothedBandDbLevels[i]);
		}
		const energyTarget = energy / BAND_COUNT;
		if (snap) {
			uniforms.uAudioEnergy.value = energyTarget;
		} else {
			uniforms.uAudioEnergy.value += (energyTarget - uniforms.uAudioEnergy.value) * 0.08;
		}
	}
	// liveSmooth = the slider-driven wave shape, damped on its own time constant and
	// maintained regardless of play state. The start/stop fade is applied separately by
	// gating this with flowMix, so damping never bleeds into the fade.
	const liveSmooth = { ...ZERO_WATER_MOTION };
	function lerpWaterMotion(from, to, t) {
		const mix = Math.min(1, Math.max(0, t));
		return {
			amp: from.amp + (to.amp - from.amp) * mix,
			speed: from.speed + (to.speed - from.speed) * mix,
			ripple: from.ripple + (to.ripple - from.ripple) * mix,
			narrow: from.narrow + (to.narrow - from.narrow) * mix,
			rough: from.rough + (to.rough - from.rough) * mix,
			chop: from.chop + (to.chop - from.chop) * mix,
			focusX: from.focusX + (to.focusX - from.focusX) * mix,
			flowDir: from.flowDir + (to.flowDir - from.flowDir) * mix,
		};
	}
	// Manual slider changes ease into the new wave shape over this many seconds so the
	// transition feels like a gradual morph rather than a disorienting snap. Preset/chip
	// changes bypass this (snap = true) and jump straight to the new shape.
	const WATER_MOTION_MORPH_S = 0.9;
	function updateWaterMotionUniforms(dt, flowMix, snap, resetFlat) {
		const live = window.__whiteNoiseWaterMotion || ZERO_WATER_MOTION;
		if (resetFlat) {
			// Rising edge of playback: collapse the shape to flat so every Play grows the
			// waves in from calm water over the morph time — the consistent "first fade"
			// look, regardless of how many presets were set (which otherwise leave the
			// shape pre-formed and make the fade-in look instant).
			liveSmooth.amp = ZERO_WATER_MOTION.amp;
			liveSmooth.speed = ZERO_WATER_MOTION.speed;
			liveSmooth.ripple = ZERO_WATER_MOTION.ripple;
			liveSmooth.narrow = ZERO_WATER_MOTION.narrow;
			liveSmooth.rough = ZERO_WATER_MOTION.rough;
			liveSmooth.chop = ZERO_WATER_MOTION.chop;
			liveSmooth.focusX = ZERO_WATER_MOTION.focusX;
			liveSmooth.flowDir = ZERO_WATER_MOTION.flowDir;
		}
		// 1. Ease the slider-driven shape into liveSmooth (snap jumps it for presets).
		//    This runs every frame independent of flowMix, so it never touches the fade.
		const alpha = snap ? 1 : 1 - Math.exp(-(dt || 0.016) / WATER_MOTION_MORPH_S);
		liveSmooth.amp += (live.amp - liveSmooth.amp) * alpha;
		liveSmooth.speed += (live.speed - liveSmooth.speed) * alpha;
		liveSmooth.ripple += (live.ripple - liveSmooth.ripple) * alpha;
		liveSmooth.narrow += (live.narrow - liveSmooth.narrow) * alpha;
		liveSmooth.rough += (live.rough - liveSmooth.rough) * alpha;
		liveSmooth.chop += (live.chop - liveSmooth.chop) * alpha;
		liveSmooth.focusX += (live.focusX - liveSmooth.focusX) * alpha;
		liveSmooth.flowDir += (live.flowDir - liveSmooth.flowDir) * alpha;
		// 2. Apply the start/stop fade by gating with flowMix only. flowActivity is already
		//    eased on the flow attack/release constants, so the fade-in/out is unchanged by
		//    any preset or slider damping — it always looks like the original first fade.
		const gated = lerpWaterMotion(ZERO_WATER_MOTION, liveSmooth, flowMix);
		uniforms.uMotionAmp.value = gated.amp;
		uniforms.uMotionSpeed.value = gated.speed;
		uniforms.uMotionRipple.value = gated.ripple;
		uniforms.uNarrow.value = gated.narrow;
		uniforms.uRough.value = gated.rough;
		uniforms.uChop.value = gated.chop;
		uniforms.uFocusX.value = gated.focusX;
		uniforms.uFlowDir.value = gated.flowDir;
	}
	let wasFlowing = false;
	function render() {
		const dt = clock.getDelta();
		const shouldFlow = !!window.__whiteNoiseIsPlaying;
		// Rising edge of playback: grow the waves in from flat water (resetFlat) so every
		// Play looks like the very first fade — flat -> waves build up -> full shape — no
		// matter how many presets were set while stopped.
		const startEdge = shouldFlow && !wasFlowing;
		wasFlowing = shouldFlow;
		const tc = shouldFlow ? WATER_FLOW_ATTACK_S : WATER_FLOW_RELEASE_S;
		flowActivity = easeToward(flowActivity, shouldFlow ? 1 : 0, dt, tc);
		uniforms.uFlowMix.value = flowActivity;
		uniforms.uTime.value += dt * flowActivity;
		// A preset/chip change requests an instant jump to the new shape (while playing);
		// manual slider changes leave the flag clear and ease in gradually.
		const snap = !!window.__whiteNoiseWaterMotionSnap;
		if (snap) window.__whiteNoiseWaterMotionSnap = false;
		updateWaterAudioUniforms(flowActivity, snap);
		updateWaterMotionUniforms(dt, flowActivity, snap, startEdge);
		renderer.render(scene, camera);
		reveal();
		if (running) requestAnimationFrame(render);
	}

	if (reduceMotion) {
		// Reduced motion: draw a single static frame, no animation loop.
		uniforms.uFlowMix.value = 0;
		updateWaterAudioUniforms(0, true);
		updateWaterMotionUniforms(0.016, 0, true);
		renderer.render(scene, camera);
		reveal();
	} else {
		requestAnimationFrame(render);
	}

	// Pause the loop while the tab is hidden to save battery.
	document.addEventListener('visibilitychange', function () {
		if (reduceMotion) return;
		if (document.hidden) {
			running = false;
		} else if (!running) {
			running = true;
			clock.getDelta();
			requestAnimationFrame(render);
		}
	});

	// Recover gracefully from a lost WebGL context.
	canvas.addEventListener('webglcontextlost', function (e) {
		e.preventDefault();
		running = false;
	});
	canvas.addEventListener('webglcontextrestored', function () {
		resize();
		if (!reduceMotion && !running) {
			running = true;
			clock.getDelta();
			requestAnimationFrame(render);
		}
	});
})();
</script>
<?php get_footer();