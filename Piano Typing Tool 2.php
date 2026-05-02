<?php 
/* Template Name:Piano-Typing Tool*/
get_header();
?>

<style>
	.piano-note-game {
		min-height: 660px;
		padding: 24px 16px 32px;
		background: #ffffff;
		color: #436f8e;
		font-family: inherit;
	}

	.piano-note-game * {
		box-sizing: border-box;
	}

	.piano-note-game__intro,
	.piano-note-game__stage {
		max-width: 920px;
		margin: 0 auto;
	}

	.piano-note-game__intro {
		min-height: 640px;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		text-align: center;
	}

	.piano-note-game__title {
		margin: 0 0 24px;
		color: #e35d26;
		font-size: clamp(40px, 7vw, 72px);
		font-weight: 800;
		line-height: 1;
	}

	.piano-note-game__subtitle {
		margin: 0 0 30px;
		color: #436f8e;
		font-size: clamp(18px, 2.4vw, 24px);
		font-weight: 700;
	}

	.piano-note-game__button {
		border: 0;
		border-radius: 10px;
		background: #e35d26;
		color: #ffffff;
		cursor: pointer;
		font-size: 20px;
		font-weight: 700;
		padding: 16px 32px;
		transition: background-color 0.18s ease, transform 0.18s ease;
	}

	.piano-note-game__button:hover {
		background: #d64f1d;
		transform: translateY(-1px);
	}

	.piano-note-game__scorebar {
		position: absolute;
		top: 12px;
		right: 12px;
		z-index: 40;
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		border: 1px solid #8cb4e3;
		border-radius: 10px;
		background: rgba(246, 251, 255, 0.95);
		color: #1e3b5d;
		font-size: 14px;
		font-weight: 700;
		line-height: 1;
	}

	#piano-note-game-score {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-width: 34px;
		padding: 4px 9px;
		border-radius: 999px;
		background: #2c66ad;
		color: #ffffff;
		font-size: 15px;
		font-weight: 800;
	}

	.piano-note-game__combo {
		display: none;
	}

	.piano-note-game__board {
		position: relative;
		width: 100%;
		max-width: 850px;
		height: 600px;
		margin: 0 auto;
		overflow: hidden;
		border: 2px solid #44708f;
		border-radius: 8px;
		background: #f7f8fa;
	}

	.piano-note-game__hit-line {
		position: absolute;
		top: 400px;
		left: 0;
		right: 0;
		height: 25px;
		z-index: 1;
		background: #f7d86a;
		opacity: 0.95;
	}

	@keyframes piano-note-game-ripple {
		0%,
		100% {
			opacity: 0.45;
			box-shadow: 0 0 8px rgba(234, 179, 8, 0.4);
		}

		50% {
			opacity: 0.6;
			box-shadow: 0 0 12px rgba(234, 179, 8, 0.6);
		}
	}

	@keyframes piano-note-game-tail-shimmer {
		0%,
		100% {
			opacity: 0.92;
		}

		50% {
			opacity: 0.98;
		}
	}

	.piano-note-game__note {
		position: absolute;
		height: 60px;
		width: 90px;
		z-index: 5;
		overflow: visible;
		pointer-events: none;
	}

	.piano-note-game__note--missed-fade {
		opacity: 0;
		transition: opacity 220ms ease-out;
	}

	.piano-note-game__note::before {
		content: '';
		position: absolute;
		left: 50%;
		top: 35%;
		z-index: 0;
		width: 22px;
		height: 750px;
		transform: translate(-50%, -100%);
		transform-origin: center bottom;
		border-radius: 7px 7px 4px 4px;
		background:
			radial-gradient(ellipse at 50% 100%, rgba(255, 255, 255, 0.98) 0%, rgba(255, 245, 187, 0.75) 10%, rgba(255, 255, 255, 0) 30%),
			linear-gradient(90deg, rgba(255, 150, 188, 0) 0%, rgba(255, 150, 188, 0.2) 16%, rgba(255, 242, 195, 0.95) 49%, rgba(255, 201, 121, 0.78) 60%, rgba(255, 150, 188, 0.18) 86%, rgba(255, 150, 188, 0) 100%),
			linear-gradient(to top, rgba(255, 210, 109, 0.92) 0%, rgba(255, 186, 122, 0.7) 35%, rgba(244, 177, 210, 0.26) 72%, rgba(244, 177, 210, 0.08) 90%, rgba(244, 177, 210, 0) 100%);
		filter: blur(0.32px);
		animation: piano-note-game-tail-shimmer 2.2s ease-in-out infinite;
	}

	.piano-note-game__note::after {
		content: '';
		position: absolute;
		inset: 0;
		z-index: 1;
		background: url('<?=get_stylesheet_directory_uri();?>/assets/images/Piano-Diamond.svg') center bottom / contain no-repeat;
		border: 0;
		box-sizing: border-box;
		box-shadow: none;
		clip-path: none;
	}

	.piano-note-game__particle {
		position: absolute;
		z-index: 20;
		width: 12px;
		height: 12px;
		border-radius: 50%;
		pointer-events: none;
	}

	.piano-note-game__pitch-wave {
		position: absolute;
		z-index: 24;
		width: 143px;
		height: 50px;
		border-radius: 50%;
		border: 3px solid rgba(255, 240, 174, 0.98);
		background:
			repeating-radial-gradient(ellipse at center,
				rgba(255, 250, 214, 1) 0 2px,
				rgba(255, 236, 154, 0.95) 2px 5px,
				rgba(255, 214, 110, 0.52) 5px 11px,
				rgba(255, 214, 110, 0) 11px 19px),
			radial-gradient(ellipse at center,
				rgba(255, 255, 246, 0.88) 0%,
				rgba(255, 232, 140, 0.56) 42%,
				rgba(255, 184, 74, 0) 74%);
		box-shadow: 0 0 24px rgba(255, 244, 170, 0.98), 0 0 62px rgba(255, 203, 86, 0.82), 0 0 98px rgba(255, 168, 60, 0.34);
		filter: none;
		transform: translate(-50%, -50%) scale(0.26);
		transform-origin: center center;
		pointer-events: none;
		animation: piano-note-game-pitch-wave 700ms linear forwards;
	}

	.piano-note-game__pitch-wave::before,
	.piano-note-game__pitch-wave::after {
		content: '';
		position: absolute;
		left: 50%;
		top: 50%;
		border-radius: 50%;
		border: 3px solid rgba(255, 238, 164, 0.95);
		transform: translate(-50%, -50%);
		pointer-events: none;
	}

	.piano-note-game__pitch-wave::before {
		width: 100px;
		height: 42px;
		border-color: rgba(255, 252, 212, 0.94);
		background: radial-gradient(ellipse at center, rgba(255, 255, 249, 0.92) 0%, rgba(255, 241, 176, 0.4) 48%, rgba(255, 206, 112, 0) 76%);
		box-shadow: 0 0 22px rgba(255, 247, 196, 0.92), inset 0 0 15px rgba(255, 251, 216, 0.86);
		animation: piano-note-game-pitch-spark 240ms linear forwards;
	}

	.piano-note-game__pitch-wave::after {
		width: 80px;
		height: 32px;
		border-color: rgba(255, 226, 142, 0.95);
		box-shadow: 0 0 22px rgba(255, 214, 112, 0.82), inset 0 0 12px rgba(255, 236, 168, 0.72);
		animation: piano-note-game-pitch-ring 700ms linear forwards;
	}

	.piano-note-game__hit-label {
		position: absolute;
		z-index: 26;
		padding: 4px 10px;
		border-radius: 10px;
		color: #ffffff;
		font-size: 14px;
		font-weight: 800;
		line-height: 1;
		pointer-events: none;
		animation: piano-note-game-hit-pop 420ms ease-out forwards;
		transform-origin: center center;
	}

	.piano-note-game__hit-label--perfect {
		background: #2fa44a;
		border: 1.3px solid #1b7430;
	}

	.piano-note-game__hit-label--normal {
		background: #cf7a2f;
		border: 1.3px solid #9a5417;
	}

	.piano-note-game__hit-label--miss {
		background: #cf3f3f;
		border: 1.3px solid #8f2424;
	}

	@keyframes piano-note-game-hit-pop {
		0% {
			opacity: 1;
			transform: translate(-50%, -50%) scale(1);
		}

		35% {
			transform: translate(-50%, -62%) scale(1.12);
		}

		100% {
			opacity: 0;
			transform: translate(-50%, -90%) scale(1.03);
		}
	}

	.piano-note-game__keys {
		position: absolute;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 30;
		height: 160px;
		display: flex;
		justify-content: center;
		align-items: flex-end;
		background: #ffffff;
	}

	.piano-note-game__keyboard {
		position: relative;
		width: 94.117647%;
		max-width: 800px;
		height: 160px;
	}

	.piano-note-game__key {
		position: absolute;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-between;
		border: 1px solid #44708f;
		border-radius: 0;
		cursor: pointer;
		font-weight: 700;
		transition: transform 0.07s ease, box-shadow 0.07s ease, filter 0.07s ease;
		user-select: none;
	}

	.piano-note-game__key--white {
		height: 160px;
		padding: 10px 8px;
		z-index: 2;
		background: #ffffff;
		color: #436f8e;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	}

	.piano-note-game__key--black {
		height: 92px;
		padding: 6px 6px 10px;
		z-index: 10;
		background: #436f8e;
		color: #ffffff;
		box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
	}

	.piano-note-game__key.is-active {
		transform: translateY(4px);
	}

	.piano-note-game__key.is-wrong {
		box-shadow: inset 0 0 0 2px #c52e2e, 0 0 0 1px rgba(197, 46, 46, 0.22);
	}

	.piano-note-game__key--white.is-active {
		background: #e5e7eb;
		box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	.piano-note-game__key--black.is-active {
		filter: brightness(1.12);
		box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.3);
	}

	.piano-note-game__key-penalty {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		z-index: 3;
		padding: 3px 8px;
		border-radius: 10px;
		border: 1.4px solid #8f2020;
		background: #e14545;
		color: #ffffff;
		font-size: 14px;
		font-weight: 800;
		line-height: 1;
		pointer-events: none;
		animation: piano-note-game-penalty-pop 520ms ease-out forwards;
	}

	.piano-note-game__key--black .piano-note-game__key-penalty {
		padding: 2px 7px;
		font-size: 12px;
	}

	@keyframes piano-note-game-penalty-pop {
		0% {
			opacity: 1;
			transform: translate(-50%, -50%) scale(1);
		}

		25% {
			transform: translate(-50%, -55%) scale(1.14);
		}

		100% {
			opacity: 0;
			transform: translate(-50%, -78%) scale(1.02);
		}
	}

	@keyframes piano-note-game-pitch-wave {
		0% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(0.28);
		}

		20% {
			opacity: 0.98;
			transform: translate(-50%, -50%) scale(0.74);
		}

		58% {
			opacity: 0.9;
			transform: translate(-50%, -50%) scale(1.1);
		}

		100% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(1.72);
		}
	}

	@keyframes piano-note-game-pitch-ring {
		0% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(0.62);
		}

		26% {
			opacity: 0.96;
		}

		62% {
			opacity: 0.72;
		}

		100% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(1.9);
		}
	}

	@keyframes piano-note-game-pitch-spark {
		0% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(0.58);
		}

		24% {
			opacity: 1;
			transform: translate(-50%, -50%) scale(0.92);
		}

		100% {
			opacity: 0;
			transform: translate(-50%, -50%) scale(1.16);
		}
	}

	.piano-note-game__note-label {
		font-size: 12px;
		font-weight: 600;
	}

	.piano-note-game__keyboard-label {
		font-size: 16px;
	}

	.piano-note-game__instructions {
		display: none;
		margin-top: 22px;
		text-align: center;
		color: #436f8e;
		font-weight: 700;
	}

	.piano-note-game__stage[hidden],
	.piano-note-game__intro[hidden] {
		display: none;
	}

	@media (max-width: 900px) {
		.piano-note-game {
			padding-left: 8px;
			padding-right: 8px;
		}
	}
</style>

<div class="piano-note-game" id="piano-note-game">
	<div class="piano-note-game__intro" id="piano-note-game-intro" hidden>
		<h1 class="piano-note-game__title">Keyboard Game</h1>
		<p class="piano-note-game__subtitle">Press the keys exactly when the orange notes hit the golden line!</p>
		<button class="piano-note-game__button" type="button" id="piano-note-game-start">Start Game</button>
	</div>

	<div class="piano-note-game__stage" id="piano-note-game-stage">
		<div class="piano-note-game__board" id="piano-note-game-board" aria-label="Piano note game board">
			<div class="piano-note-game__scorebar">Total Score: <span id="piano-note-game-score">0</span><span class="piano-note-game__combo">Combo: <span id="piano-note-game-combo">0</span>x</span></div>
			<div class="piano-note-game__hit-line" aria-hidden="true"></div>
			<div class="piano-note-game__keys">
				<div class="piano-note-game__keyboard" id="piano-note-game-keyboard" aria-label="Playable piano keyboard"></div>
			</div>
		</div>

		<div class="piano-note-game__instructions">
			White keys: A S D F G H J K L ; | Black keys: W E T Y U O P
		</div>
	</div>
</div>

<script>
	(function () {
		var game = document.getElementById('piano-note-game');
		if (!game) {
			return;
		}

		var intro = document.getElementById('piano-note-game-intro');
		var stage = document.getElementById('piano-note-game-stage');
		var startButton = document.getElementById('piano-note-game-start');
		var board = document.getElementById('piano-note-game-board');
		var keyboard = document.getElementById('piano-note-game-keyboard');
		var scoreValue = document.getElementById('piano-note-game-score');
		var comboValue = document.getElementById('piano-note-game-combo');
		var WHITE_KEY_WIDTH = 80;
		var BLACK_KEY_WIDTH = 50;
		var BOARD_WIDTH = 850;
		var BASE_BOARD_WIDTH = 850;
		var BASE_KEYBOARD_WIDTH = 800;
		var BOARD_HEIGHT = 600;
		var PIANO_WIDTH = WHITE_KEY_WIDTH * 10;
		var LEFT_OFFSET = (BOARD_WIDTH - PIANO_WIDTH) / 2;
		var FALL_SPEED = 3.2;
		var SPAWN_INTERVAL = 1350;
		var GOLDEN_LINE_POSITION = 400;
		var GOLDEN_LINE_HEIGHT = 25;
		var KEYBOARD_HEIGHT = 160;
		var NOTE_HEIGHT = 60;
		var NOTE_WIDTH = 90;
		var MISSED_NOTE_FADE_OUT_MS = 220;
		var HIT_WINDOW_TOLERANCE = 36;
		var activeKeys = {};
		var fallingNotes = [];
		var particles = [];
		var score = 0;
		var combo = 0;
		var lastFrame = 0;
		var lastSpawn = 0;
		var noteId = 0;
		var particleId = 0;
		var gameStarted = false;
		var animationFrameId = null;
		var audioContext = null;
		var masterGain = null;
		var pianoConvolver = null;
		var activeNotes = {};
		var masterVolume = 0.25;

		var pianoKeys = [
			{ keyboardKey: 'A', note: 'C4', label: 'C', isBlack: false, xPosition: 0, width: WHITE_KEY_WIDTH, freq: 261.63 },
			{ keyboardKey: 'W', note: 'C#4', label: 'C#', isBlack: true, xPosition: WHITE_KEY_WIDTH - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 277.18 },
			{ keyboardKey: 'S', note: 'D4', label: 'D', isBlack: false, xPosition: WHITE_KEY_WIDTH, width: WHITE_KEY_WIDTH, freq: 293.66 },
			{ keyboardKey: 'E', note: 'D#4', label: 'D#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 2 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 311.13 },
			{ keyboardKey: 'D', note: 'E4', label: 'E', isBlack: false, xPosition: WHITE_KEY_WIDTH * 2, width: WHITE_KEY_WIDTH, freq: 329.63 },
			{ keyboardKey: 'F', note: 'F4', label: 'F', isBlack: false, xPosition: WHITE_KEY_WIDTH * 3, width: WHITE_KEY_WIDTH, freq: 349.23 },
			{ keyboardKey: 'T', note: 'F#4', label: 'F#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 4 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 369.99 },
			{ keyboardKey: 'G', note: 'G4', label: 'G', isBlack: false, xPosition: WHITE_KEY_WIDTH * 4, width: WHITE_KEY_WIDTH, freq: 392.00 },
			{ keyboardKey: 'Y', note: 'G#4', label: 'G#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 5 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 415.30 },
			{ keyboardKey: 'H', note: 'A4', label: 'A', isBlack: false, xPosition: WHITE_KEY_WIDTH * 5, width: WHITE_KEY_WIDTH, freq: 440.00 },
			{ keyboardKey: 'U', note: 'A#4', label: 'A#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 6 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 466.16 },
			{ keyboardKey: 'J', note: 'B4', label: 'B', isBlack: false, xPosition: WHITE_KEY_WIDTH * 6, width: WHITE_KEY_WIDTH, freq: 493.88 },
			{ keyboardKey: 'K', note: 'C5', label: 'C', isBlack: false, xPosition: WHITE_KEY_WIDTH * 7, width: WHITE_KEY_WIDTH, freq: 523.25 },
			{ keyboardKey: 'O', note: 'C#5', label: 'C#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 8 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 554.37 },
			{ keyboardKey: 'L', note: 'D5', label: 'D', isBlack: false, xPosition: WHITE_KEY_WIDTH * 8, width: WHITE_KEY_WIDTH, freq: 587.33 },
			{ keyboardKey: 'P', note: 'D#5', label: 'D#', isBlack: true, xPosition: WHITE_KEY_WIDTH * 9 - BLACK_KEY_WIDTH / 2, width: BLACK_KEY_WIDTH, freq: 622.25 },
			{ keyboardKey: ';', note: 'E5', label: 'E', isBlack: false, xPosition: WHITE_KEY_WIDTH * 9, width: WHITE_KEY_WIDTH, freq: 659.25 }
		];

		function recalculateLayout() {
			if (!board || !keyboard) {
				return;
			}

			var measuredBoardWidth = Math.max(320, Math.round(board.clientWidth || BASE_BOARD_WIDTH));
			var baseSidePadding = (BASE_BOARD_WIDTH - BASE_KEYBOARD_WIDTH) / 2;
			var scaledSidePadding = (measuredBoardWidth * baseSidePadding) / BASE_BOARD_WIDTH;

			BOARD_WIDTH = measuredBoardWidth;
			LEFT_OFFSET = scaledSidePadding;
			PIANO_WIDTH = measuredBoardWidth - (scaledSidePadding * 2);
			WHITE_KEY_WIDTH = PIANO_WIDTH / 10;
			BLACK_KEY_WIDTH = WHITE_KEY_WIDTH * 0.625;
			keyboard.style.width = PIANO_WIDTH + 'px';

			var whiteIndexMap = {
				A: 0,
				S: 1,
				D: 2,
				F: 3,
				G: 4,
				H: 5,
				J: 6,
				K: 7,
				L: 8,
				';': 9
			};

			var blackLeftMap = {
				W: 0,
				E: 1,
				T: 3,
				Y: 4,
				U: 5,
				O: 7,
				P: 8
			};

			pianoKeys.forEach(function (key) {
				if (key.isBlack) {
					var leftWhite = blackLeftMap[key.keyboardKey];
					key.width = BLACK_KEY_WIDTH;
					key.xPosition = ((leftWhite + 1) * WHITE_KEY_WIDTH) - (BLACK_KEY_WIDTH / 2);
					return;
				}

				var whiteIndex = whiteIndexMap[key.keyboardKey];
				key.width = WHITE_KEY_WIDTH;
				key.xPosition = whiteIndex * WHITE_KEY_WIDTH;
			});
		}

		function realignFallingNotes() {
			fallingNotes.forEach(function (note) {
				var key = pianoKeys[note.keyIndex];
				if (!key || !note.element) {
					return;
				}
				var noteLeft = LEFT_OFFSET + key.xPosition + ((key.width - NOTE_WIDTH) / 2);
				note.element.style.left = noteLeft + 'px';
			});
		}

		function syncActiveKeyVisualState() {
			Object.keys(activeKeys).forEach(function (keyName) {
				if (activeKeys[keyName]) {
					pressKeyElement(keyName);
				}
			});
		}

		function ensureAudioContext() {
			if (!audioContext) {
				var AudioContextClass = window.AudioContext || window.webkitAudioContext;
				if (!AudioContextClass) {
					return;
				}
				audioContext = new AudioContextClass();
				masterGain = audioContext.createGain();
				masterGain.gain.value = 0.9;
				masterGain.connect(audioContext.destination);
				pianoConvolver = audioContext.createConvolver();
				pianoConvolver.buffer = createImpulseResponse(1.8, 2.4);
				pianoConvolver.connect(masterGain);
			}
			if (audioContext.state === 'suspended') {
				audioContext.resume();
			}
		}

		function createImpulseResponse(duration, decay) {
			var sampleRate = audioContext.sampleRate;
			var length = Math.floor(sampleRate * duration);
			var impulse = audioContext.createBuffer(2, length, sampleRate);
			for (var channel = 0; channel < impulse.numberOfChannels; channel++) {
				var data = impulse.getChannelData(channel);
				for (var i = 0; i < length; i++) {
					var t = i / length;
					data[i] = (Math.random() * 2 - 1) * Math.pow(1 - t, decay);
				}
			}
			return impulse;
		}

		function createPianoVoice(noteData) {
			var now = audioContext.currentTime;
			var fundamental = noteData.freq;
			var output = audioContext.createGain();
			var toneFilter = audioContext.createBiquadFilter();
			var dryGain = audioContext.createGain();
			var wetGain = audioContext.createGain();
			var harmonicRatios = [1, 2, 3, 4];
			var harmonicLevels = [1, 0.42, 0.2, 0.1];
			var oscillators = [];

			toneFilter.type = 'lowpass';
			toneFilter.frequency.value = 5600;
			toneFilter.Q.value = 0.7;

			output.gain.setValueAtTime(0.0001, now);
			output.gain.exponentialRampToValueAtTime(Math.max(0.01, masterVolume), now + 0.01);
			output.gain.exponentialRampToValueAtTime(Math.max(0.004, masterVolume * 0.5), now + 0.15);
			output.gain.exponentialRampToValueAtTime(0.0001, now + 2.8);

			for (var i = 0; i < harmonicRatios.length; i++) {
				var osc = audioContext.createOscillator();
				var gain = audioContext.createGain();
				var detuneSpread = (Math.random() - 0.5) * 3.5;
				osc.type = i === 0 ? 'triangle' : 'sine';
				osc.frequency.value = fundamental * harmonicRatios[i];
				osc.detune.value = detuneSpread;
				gain.gain.setValueAtTime(harmonicLevels[i], now);
				osc.connect(gain);
				gain.connect(toneFilter);
				osc.start(now);
				oscillators.push(osc);
			}

			var noiseBuffer = audioContext.createBuffer(1, Math.floor(audioContext.sampleRate * 0.03), audioContext.sampleRate);
			var noiseData = noiseBuffer.getChannelData(0);
			for (var n = 0; n < noiseData.length; n++) {
				noiseData[n] = (Math.random() * 2 - 1) * 0.45;
			}
			var noiseSource = audioContext.createBufferSource();
			var noiseFilter = audioContext.createBiquadFilter();
			var noiseGain = audioContext.createGain();
			noiseSource.buffer = noiseBuffer;
			noiseFilter.type = 'bandpass';
			noiseFilter.frequency.value = 2900;
			noiseFilter.Q.value = 0.8;
			noiseGain.gain.setValueAtTime(0.0001, now);
			noiseGain.gain.exponentialRampToValueAtTime(Math.max(0.002, masterVolume * 0.2), now + 0.004);
			noiseGain.gain.exponentialRampToValueAtTime(0.0001, now + 0.03);
			noiseSource.connect(noiseFilter);
			noiseFilter.connect(noiseGain);
			noiseGain.connect(toneFilter);
			noiseSource.start(now);
			noiseSource.stop(now + 0.035);

			toneFilter.connect(output);
			output.connect(dryGain);
			output.connect(wetGain);
			dryGain.gain.value = 0.88;
			wetGain.gain.value = 0.2;
			dryGain.connect(masterGain);
			wetGain.connect(pianoConvolver);

			return {
				output: output,
				oscillators: oscillators
			};
		}

		function playNote(noteData) {
			if (!noteData || activeNotes[noteData.note]) {
				return;
			}
			ensureAudioContext();
			if (!audioContext || !masterGain) {
				return;
			}
			var voice = createPianoVoice(noteData);
			activeNotes[noteData.note] = {
				voice: voice
			};
		}

		function stopNote(noteName) {
			var entry = activeNotes[noteName];
			if (!entry || !audioContext) {
				return;
			}
			var now = audioContext.currentTime;
			var voice = entry.voice;
			voice.output.gain.cancelScheduledValues(now);
			voice.output.gain.setValueAtTime(Math.max(0.00012, voice.output.gain.value), now);
			voice.output.gain.exponentialRampToValueAtTime(0.0001, now + 0.22);
			for (var i = 0; i < voice.oscillators.length; i++) {
				voice.oscillators[i].stop(now + 0.24);
			}
			delete activeNotes[noteName];
		}

		function renderKeyboard() {
			keyboard.innerHTML = '';
			pianoKeys.filter(function (key) { return !key.isBlack; }).forEach(addKeyElement);
			pianoKeys.filter(function (key) { return key.isBlack; }).forEach(addKeyElement);
		}

		function addKeyElement(key) {
			var keyEl = document.createElement('button');
			keyEl.type = 'button';
			keyEl.className = 'piano-note-game__key ' + (key.isBlack ? 'piano-note-game__key--black' : 'piano-note-game__key--white');
			keyEl.dataset.key = key.keyboardKey;
			keyEl.style.left = key.xPosition + 'px';
			keyEl.style.width = key.width + 'px';
			keyEl.innerHTML = '<span class="piano-note-game__note-label">' + key.label + '</span><span class="piano-note-game__keyboard-label">' + key.keyboardKey + '</span>';
			keyEl.addEventListener('pointerdown', function (evt) {
				evt.preventDefault();
				handleKeyPress(key.keyboardKey);
			});
			keyEl.addEventListener('pointerup', function () {
				releaseKey(key.keyboardKey);
			});
			keyEl.addEventListener('pointerleave', function () {
				releaseKey(key.keyboardKey);
			});
			keyboard.appendChild(keyEl);
		}

		function updateScore(delta) {
			score += delta;
			scoreValue.textContent = String(score);
		}

		function setCombo(nextCombo) {
			combo = nextCombo;
			comboValue.textContent = String(combo);
		}

		function spawnNote() {
			var keyIndex = Math.floor(Math.random() * pianoKeys.length);
			var key = pianoKeys[keyIndex];
			var noteEl = document.createElement('div');
			noteEl.className = 'piano-note-game__note';
			var noteLeft = LEFT_OFFSET + key.xPosition + ((key.width - NOTE_WIDTH) / 2);
			noteEl.style.left = noteLeft + 'px';
			noteEl.style.top = '0px';
			board.appendChild(noteEl);
			fallingNotes.push({
				id: noteId++,
				keyIndex: keyIndex,
				position: 0,
				element: noteEl,
				missed: false
			});
		}

		function createBurst(x, y, isPerfect) {
			var colors = isPerfect
				? ['#ff0000', '#ff7f00', '#ffff00', '#00cc66', '#006dff', '#8b00ff', '#ff1493', '#00cfff']
				: ['#e25c1b'];

			for (var i = 0; i < 20; i++) {
				var angle = (Math.PI * 2 * i) / 20 + (Math.random() - 0.5) * 0.3;
				var speed = 3 + Math.random() * 3;
				var particleEl = document.createElement('div');
				var color = colors[i % colors.length];
				particleEl.className = 'piano-note-game__particle';
				particleEl.style.left = (LEFT_OFFSET + x) + 'px';
				particleEl.style.top = y + 'px';
				particleEl.style.backgroundColor = color;
				particleEl.style.boxShadow = '0 0 8px ' + color;
				board.appendChild(particleEl);
				particles.push({
					id: particleId++,
					x: LEFT_OFFSET + x,
					y: y,
					vx: Math.cos(angle) * speed,
					vy: Math.sin(angle) * speed - 2,
					life: 1,
					element: particleEl
				});
			}
		}

		function createPitchWave(x, y) {
			var keyboardTopY = BOARD_HEIGHT - KEYBOARD_HEIGHT;
			var safeWaveY = Math.min(y, keyboardTopY - 10);
			var waveEl = document.createElement('span');
			waveEl.className = 'piano-note-game__pitch-wave';
			waveEl.style.left = x + 'px';
			waveEl.style.top = safeWaveY + 'px';
			board.appendChild(waveEl);

			window.setTimeout(function () {
				if (waveEl.parentNode) {
					waveEl.parentNode.removeChild(waveEl);
				}
			}, 920);
		}

		function showHitLabel(note, scoreText, isPerfect) {
			if (!note || !scoreText) {
				return;
			}

			var key = pianoKeys[note.keyIndex];
			if (!key) {
				return;
			}

			var labelEl = document.createElement('span');
			var labelVariantClass = 'piano-note-game__hit-label--normal';
			if (scoreText === '-10') {
				labelVariantClass = 'piano-note-game__hit-label--miss';
			} else if (isPerfect) {
				labelVariantClass = 'piano-note-game__hit-label--perfect';
			}
			labelEl.className = 'piano-note-game__hit-label ' + labelVariantClass;
			labelEl.textContent = scoreText;
			var keyboardTopY = BOARD_HEIGHT - KEYBOARD_HEIGHT;
			var noteCenterY = note.position + (NOTE_HEIGHT / 2);
			var clampedY = scoreText === '-10' ? (keyboardTopY - 12) : Math.min(noteCenterY, keyboardTopY - 12);
			labelEl.style.left = (LEFT_OFFSET + key.xPosition + (key.width / 2)) + 'px';
			labelEl.style.top = clampedY + 'px';
			board.appendChild(labelEl);

			window.setTimeout(function () {
				if (labelEl.parentNode) {
					labelEl.parentNode.removeChild(labelEl);
				}
			}, 460);
		}

		function updateParticles() {
			particles = particles.filter(function (particle) {
				particle.x += particle.vx;
				particle.y += particle.vy;
				particle.vy += 0.1;
				particle.life -= 0.02;
				if (particle.life <= 0) {
					particle.element.remove();
					return false;
				}

				particle.element.style.left = particle.x + 'px';
				particle.element.style.top = particle.y + 'px';
				particle.element.style.opacity = particle.life;
				particle.element.style.transform = 'scale(' + particle.life + ')';
				return true;
			});
		}

		function getNoteDistanceFromHitLine(note) {
			if (!note) {
				return Infinity;
			}

			var goldenLineTop = GOLDEN_LINE_POSITION;
			var goldenLineBottom = GOLDEN_LINE_POSITION + GOLDEN_LINE_HEIGHT;
			var noteTop = note.position;
			var noteBottom = note.position + NOTE_HEIGHT;

			if (noteBottom < goldenLineTop) {
				return goldenLineTop - noteBottom;
			}

			if (noteTop > goldenLineBottom) {
				return noteTop - goldenLineBottom;
			}

			return 0;
		}

		function isNoteAcrossHitLine(note) {
			if (!note) {
				return false;
			}

			var goldenLineTop = GOLDEN_LINE_POSITION;
			var goldenLineBottom = GOLDEN_LINE_POSITION + GOLDEN_LINE_HEIGHT;
			var noteTop = note.position;
			var noteBottom = note.position + NOTE_HEIGHT;
			return noteTop <= goldenLineBottom && noteBottom >= goldenLineTop;
		}

		function getBestMatchForInput(keyIndex) {
			var nearestAny = null;
			var nearestAnyDistance = Infinity;
			var nearestMatching = null;
			var nearestMatchingDistance = Infinity;

			for (var i = 0; i < fallingNotes.length; i++) {
				var note = fallingNotes[i];
				var distance = getNoteDistanceFromHitLine(note);

				if (distance < nearestAnyDistance) {
					nearestAnyDistance = distance;
					nearestAny = note;
				}

				if (note.keyIndex === keyIndex && distance < nearestMatchingDistance) {
					nearestMatchingDistance = distance;
					nearestMatching = note;
				}
			}

			return {
				nearestAny: nearestAny,
				nearestAnyDistance: nearestAnyDistance,
				nearestMatching: nearestMatching,
				nearestMatchingDistance: nearestMatchingDistance
			};
		}

		function assessKeyAccuracy(keyIndex) {
			var match = getBestMatchForInput(keyIndex);
			var nearestAny = match.nearestAny;
			var nearestAnyDistance = match.nearestAnyDistance;
			var nearestMatching = match.nearestMatching;
			var nearestMatchingDistance = match.nearestMatchingDistance;

			if (!nearestMatching || nearestMatchingDistance > HIT_WINDOW_TOLERANCE) {
				return {
					status: 'wrong',
					target: null
				};
			}

			if (nearestAny && nearestAny.keyIndex !== keyIndex && nearestAnyDistance <= nearestMatchingDistance) {
				return {
					status: 'wrong',
					target: null
				};
			}

			if (isNoteAcrossHitLine(nearestMatching)) {
				return {
					status: 'perfect',
					target: nearestMatching
				};
			}

			return {
				status: 'offbeat',
				target: nearestMatching
			};
		}

		function checkHit(keyIndex) {
			var assessment = assessKeyAccuracy(keyIndex);

			if (assessment.status === 'wrong') {
				updateScore(-5);
				setCombo(0);
				showWrongKeyPenalty(pianoKeys[keyIndex].keyboardKey);
				return;
			}

			var target = assessment.target;
			if (!target) {
				return;
			}

			fallingNotes = fallingNotes.filter(function (note) {
				if (note.id !== target.id) {
					return true;
				}

				var key = pianoKeys[keyIndex];
				var isPerfect = assessment.status === 'perfect';
				updateScore(isPerfect ? 5 : 1);
				setCombo(combo + 1);
				showHitLabel(note, isPerfect ? '+5' : '+1', isPerfect);
				createPitchWave(LEFT_OFFSET + key.xPosition + (key.width / 2), note.position + NOTE_HEIGHT);
				note.element.remove();
				return false;
			});
		}

		function updateFallingNotes(delta) {
			var speedScale = delta / 16.67;
			fallingNotes = fallingNotes.filter(function (note) {
				if (!note.isFadingOut) {
					note.position += FALL_SPEED * speedScale;
				}

				if (!note.missed && note.position >= GOLDEN_LINE_POSITION) {
					note.missed = true;
					setCombo(0);
				}

				if (!note.missedPenalty && note.position + NOTE_HEIGHT >= BOARD_HEIGHT) {
					note.missedPenalty = true;
					updateScore(-10);
					showHitLabel(note, '-10', false);
				}

				if (note.position >= 650) {
					if (!note.isFadingOut) {
						note.isFadingOut = true;
						note.fadeOutRemaining = MISSED_NOTE_FADE_OUT_MS;
						note.element.classList.add('piano-note-game__note--missed-fade');
					}

					note.fadeOutRemaining -= delta;
					if (note.fadeOutRemaining <= 0) {
						note.element.remove();
						return false;
					}
				}

				note.element.style.top = note.position + 'px';
				return true;
			});
		}

		function loop(timestamp) {
			if (!gameStarted) {
				return;
			}

			if (!lastFrame) {
				lastFrame = timestamp;
				lastSpawn = timestamp;
			}

			var delta = timestamp - lastFrame;
			lastFrame = timestamp;

			if (timestamp - lastSpawn >= SPAWN_INTERVAL) {
				spawnNote();
				lastSpawn = timestamp;
			}

			updateFallingNotes(delta);
			updateParticles();
			animationFrameId = window.requestAnimationFrame(loop);
		}

		function pressKeyElement(keyName) {
			var keyEl = getKeyElement(keyName);
			if (keyEl) {
				keyEl.classList.add('is-active');
			}
		}

		function showWrongKeyPenalty(keyName) {
			var keyEl = getKeyElement(keyName);
			if (!keyEl) {
				return;
			}

			keyEl.classList.add('is-wrong');
			var existing = keyEl.querySelector('.piano-note-game__key-penalty');
			if (existing) {
				existing.remove();
			}

			var penalty = document.createElement('span');
			penalty.className = 'piano-note-game__key-penalty';
			penalty.textContent = '-5';
			keyEl.appendChild(penalty);

			window.setTimeout(function () {
				keyEl.classList.remove('is-wrong');
			}, 520);

			window.setTimeout(function () {
				if (penalty.parentNode) {
					penalty.parentNode.removeChild(penalty);
				}
			}, 560);
		}

		function getKeyElement(keyName) {
			var keyElements = keyboard.querySelectorAll('[data-key]');
			for (var i = 0; i < keyElements.length; i++) {
				if (keyElements[i].dataset.key === keyName) {
					return keyElements[i];
				}
			}
			return null;
		}

		function releaseKey(keyName) {
			delete activeKeys[keyName];
			var keyEl = getKeyElement(keyName);
			if (keyEl) {
				keyEl.classList.remove('is-active');
			}
			var keyIndex = pianoKeys.findIndex(function (key) {
				return key.keyboardKey === keyName;
			});
			if (keyIndex !== -1) {
				stopNote(pianoKeys[keyIndex].note);
			}
		}

		function handleKeyPress(keyName) {
			var keyIndex = pianoKeys.findIndex(function (key) {
				return key.keyboardKey === keyName;
			});

			if (keyIndex === -1 || activeKeys[keyName]) {
				return;
			}

			activeKeys[keyName] = true;
			pressKeyElement(keyName);
			playNote(pianoKeys[keyIndex]);
			checkHit(keyIndex);
		}

		function resetGame() {
			fallingNotes.forEach(function (note) {
				note.element.remove();
			});
			particles.forEach(function (particle) {
				particle.element.remove();
			});
			board.querySelectorAll('.piano-note-game__hit-label').forEach(function (label) {
				label.remove();
			});
			fallingNotes = [];
			particles = [];
			activeKeys = {};
			Object.keys(activeNotes).forEach(function (noteName) {
				stopNote(noteName);
			});
			activeNotes = {};
			lastFrame = 0;
			lastSpawn = 0;
			score = 0;
			scoreValue.textContent = String(score);
			setCombo(0);
		}

		function startGame() {
			resetGame();

			intro.hidden = true;
			stage.hidden = false;
			gameStarted = true;
			if (animationFrameId) {
				window.cancelAnimationFrame(animationFrameId);
			}
			animationFrameId = window.requestAnimationFrame(loop);
		}

		if (startButton) {
			startButton.addEventListener('click', function () {
				ensureAudioContext();
				if (audioContext && audioContext.state === 'suspended') {
					audioContext.resume();
				}
				startGame();
			});
		}

		document.addEventListener('keydown', function (evt) {
			var keyName = evt.key.length === 1 ? evt.key.toUpperCase() : evt.key;
			if (evt.repeat) {
				return;
			}

			handleKeyPress(keyName);
		});

		document.addEventListener('keyup', function (evt) {
			var keyName = evt.key.length === 1 ? evt.key.toUpperCase() : evt.key;
			releaseKey(keyName);
		});

		window.addEventListener('resize', function () {
			recalculateLayout();
			renderKeyboard();
			syncActiveKeyVisualState();
			realignFallingNotes();
		});

		recalculateLayout();
		renderKeyboard();
		startGame();
	})();
</script>

<?php get_footer(); ?>
