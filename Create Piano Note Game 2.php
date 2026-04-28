<?php
/* Template Name: Create Piano Note Game 2 */
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

	.piano-note-game__note {
		position: absolute;
		height: 25px;
		z-index: 5;
		background: #e25c1b;
		border: 5px solid #e25c1b;
	}

	.piano-note-game__particle {
		position: absolute;
		z-index: 20;
		width: 12px;
		height: 12px;
		border-radius: 50%;
		pointer-events: none;
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
		width: 800px;
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
		.piano-note-game__board {
			transform: scale(calc((100vw - 32px) / 850));
			transform-origin: top center;
			margin-bottom: calc(600px * ((100vw - 32px) / 850 - 1));
		}

		.piano-note-game__scorebar {
			transform: scale(calc(850 / (100vw - 32px)));
			transform-origin: top right;
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
		var BOARD_HEIGHT = 600;
		var PIANO_WIDTH = WHITE_KEY_WIDTH * 10;
		var LEFT_OFFSET = (BOARD_WIDTH - PIANO_WIDTH) / 2;
		var FALL_SPEED = 2.2;
		var SPAWN_INTERVAL = 1350;
		var GOLDEN_LINE_POSITION = 400;
		var GOLDEN_LINE_HEIGHT = 25;
		var NOTE_HEIGHT = 25;
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

		function ensureAudio() {
			if (audioContext) {
				return;
			}

			var AudioContextClass = window.AudioContext || window.webkitAudioContext;
			if (!AudioContextClass) {
				return;
			}

			audioContext = new AudioContextClass();
			masterGain = audioContext.createGain();
			masterGain.gain.value = 0.22;
			masterGain.connect(audioContext.destination);
		}

		function playTone(key) {
			ensureAudio();
			if (!audioContext || !masterGain) {
				return;
			}

			var now = audioContext.currentTime;
			var output = audioContext.createGain();
			var osc = audioContext.createOscillator();
			var shine = audioContext.createOscillator();

			osc.type = 'triangle';
			osc.frequency.setValueAtTime(key.freq, now);
			shine.type = 'sine';
			shine.frequency.setValueAtTime(key.freq * 2, now);
			output.gain.setValueAtTime(0.0001, now);
			output.gain.exponentialRampToValueAtTime(0.55, now + 0.015);
			output.gain.exponentialRampToValueAtTime(0.0001, now + 0.45);
			osc.connect(output);
			shine.connect(output);
			output.connect(masterGain);
			osc.start(now);
			shine.start(now);
			osc.stop(now + 0.48);
			shine.stop(now + 0.48);
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
			noteEl.style.left = (LEFT_OFFSET + key.xPosition) + 'px';
			noteEl.style.width = key.width + 'px';
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

		function showHitLabel(note, scoreText, isPerfect) {
			if (!note || !scoreText) {
				return;
			}

			var key = pianoKeys[note.keyIndex];
			if (!key) {
				return;
			}

			var labelEl = document.createElement('span');
			labelEl.className = 'piano-note-game__hit-label ' + (isPerfect ? 'piano-note-game__hit-label--perfect' : 'piano-note-game__hit-label--normal');
			labelEl.textContent = scoreText;
			labelEl.style.left = (LEFT_OFFSET + key.xPosition + (key.width / 2)) + 'px';
			labelEl.style.top = (note.position + (NOTE_HEIGHT / 2)) + 'px';
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
				createBurst(key.xPosition + key.width / 2, note.position, isPerfect);
				note.element.remove();
				return false;
			});
		}

		function updateFallingNotes(delta) {
			var speedScale = delta / 16.67;
			fallingNotes = fallingNotes.filter(function (note) {
				note.position += FALL_SPEED * speedScale;

				if (!note.missed && note.position >= GOLDEN_LINE_POSITION) {
					note.missed = true;
					setCombo(0);
				}

				if (!note.missedPenalty && note.position + NOTE_HEIGHT >= BOARD_HEIGHT) {
					note.missedPenalty = true;
					updateScore(-10);
				}

				if (note.position >= 650) {
					note.element.remove();
					return false;
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
			playTone(pianoKeys[keyIndex]);
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
				ensureAudio();
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

		renderKeyboard();
		startGame();
	})();
</script>

<?php get_footer(); ?>
