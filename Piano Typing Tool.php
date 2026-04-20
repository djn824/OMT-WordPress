<?php 
/* Template Name:Piano-Typing Tool*/
get_header();?>
<style media="screen">
	.piano-tool-wrap {
		max-width: 960px;
		margin: 20px auto 40px;
		padding: 20px;
		background: #f7f9fc;
		border: 1px solid #d8e0eb;
		border-radius: 12px;
	}

	.piano-tool-wrap h2 {
		margin: 0 0 8px;
		font-size: 28px;
	}

	.piano-tool-wrap p {
		margin: 0 0 16px;
		color: #2f3b48;
	}

	.piano-canvas-wrap {
		position: relative;
		width: 100%;
		overflow-x: auto;
	}

	#piano-canvas {
		display: block;
		width: 100%;
		max-width: 920px;
		height: auto;
		background: #ffffff;
		border: 1px solid #c7d3e0;
		border-radius: 8px;
		cursor: pointer;
		touch-action: manipulation;
	}

	.piano-key-map {
		margin-top: 12px;
		font-size: 13px;
		color: #526273;
	}
</style>

<div class="container-fluid">	
	<div class="piano-tool-wrap">
		<h2>Piano Typing Tool</h2>
		<p>Click or tap the keys, or use your keyboard: A S D F G H J K L ; and W E T Y U O P.</p>
		<div class="piano-canvas-wrap">
			<canvas id="piano-canvas" width="920" height="280" aria-label="Interactive piano keyboard"></canvas>
		</div>
		<div class="piano-key-map">
			Lower row: A S D F G H J K L ; | Upper row: W E T Y U O P
		</div>
	</div>
	
	<!-- <div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text"><?php the_field('get_easily_started_title'); ?></h3>
				</div>
			</div>
		</div>
		<div class="ct-row">
			<div class="new-webcam-desc">
				<ul>
					<?php

                        // check if the repeater field has rows of data
                        if (have_rows('get_easily_started_steps')):

                            // loop through the rows of data
                        while (have_rows('get_easily_started_steps')): the_row(); ?>
											<li>
												<span><?php the_sub_field('numbers'); ?></span>
												<div>
													<strong><?php the_sub_field('title'); ?></strong>
												</div>
											</li>
										<?php endwhile;
                                            else:
                                            endif;
                                        ?>
				</ul>
			</div>
		</div>
	</div> -->

	<!-- <div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('red_icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text" style="color: rgb(226, 92, 27)"><?php the_field('trouble-shooting_title'); ?></h3>
				</div>
			</div>
		</div>

		<div class="trouble-shooting-2 dis-flex">
			<div class="width-33_3 wid-md-50 wid-xs-100">
				<div class="trouble-shooting-text-1 pd-1">
					<ul>
						<?php

                            // check if the repeater field has rows of data
                            if (have_rows('leftside_guide_list')):

                                // loop through the rows of data
                            while (have_rows('leftside_guide_list')): the_row(); ?>
												<li>
													<span class="fw-bold color-link">
														<?php the_sub_field('left_side_list_title'); ?>
													</span>
												</li>

											<?php endwhile;
                                                else:
                                                endif;
                                            ?>
					</ul>
				</div>

				<div align="center">
					<style>
						.OMT_MOINSBD_Middle { width: 300px; height: 250px; }
						@media(min-width: 500px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
						@media(min-width: 800px) { .OMT_MOINSBD_Middle { width: 300px; height: 250px; } }
					</style>
				</div>

			</div>
			<?php
                $right_side_guide_list = get_field('rightside_guide_list');
            if ($right_side_guide_list) {?>
				<div class="width-33_3 wid-md-50  wid-xs-100">
					<div class="trouble-shooting-text-1 pd-1">
						<ul>
							<li>
								<span class="fw-bold">
									<?php echo $right_side_guide_list ?>
								</span>
							</li>
						</ul>
					</div>
				</div>
				<?php
                }?>
			<div class="width-33_3 md-hidden">
			</div>
		</div>
	</div> -->

	<!-- <div class="other-section">
			<div class="read-more-section">
				<div class="ct-row dis-flex">
					<div class="width-50 wid-xs-100">
						<div class="read-more-text-secction">
							<div class="read-more-title clearfix" >
								<h2><strong><?php the_field('more_about_title'); ?></strong></h2>
							</div>
							<?php

                                // check if the repeater field has rows of data
                                if (have_rows('test_content')):

                                    // loop through the rows of data
                                while (have_rows('test_content')): the_row(); ?>
													<div class="read-more-1">


														<div class="read-more-subtitle clearfix">
															<h3 class="mar-bot-20"><?php the_sub_field('heading'); ?></h3>
														</div>

														<div class="read-more-text">
															<p><?php the_sub_field('descp'); ?>
														</p>
													</div>
												</div>
											<?php endwhile;
                                                else:
                                                endif;
                                            ?>
					</div>
				</div>

				<div class="width-50">
					<div class="img-section pad-left-15">
						<img class="lazyload" src="<?php the_field('rightside_lazy_gif'); ?>" data-src="<?php the_field('rightside_image'); ?>"/>
					</div>
				</div>
			</div>
		</div>
	</div> -->
</div>
</div>
</article>
</div>
</div>

<script>
	(function () {
		var canvas = document.getElementById('piano-canvas');
		if (!canvas) {
			return;
		}

		var ctx = canvas.getContext('2d');
		var audioContext = null;
		var activeNotes = {};
		var keyMap = {
			a: 'C4', w: 'C#4', s: 'D4', e: 'D#4', d: 'E4',
			f: 'F4', t: 'F#4', g: 'G4', y: 'G#4', h: 'A4',
			u: 'A#4', j: 'B4', k: 'C5', o: 'C#5', l: 'D5',
			p: 'D#5', ';': 'E5'
		};

		var notes = [
			{ note: 'C4', type: 'white', freq: 261.63, key: 'A' },
			{ note: 'C#4', type: 'black', freq: 277.18, key: 'W' },
			{ note: 'D4', type: 'white', freq: 293.66, key: 'S' },
			{ note: 'D#4', type: 'black', freq: 311.13, key: 'E' },
			{ note: 'E4', type: 'white', freq: 329.63, key: 'D' },
			{ note: 'F4', type: 'white', freq: 349.23, key: 'F' },
			{ note: 'F#4', type: 'black', freq: 369.99, key: 'T' },
			{ note: 'G4', type: 'white', freq: 392.00, key: 'G' },
			{ note: 'G#4', type: 'black', freq: 415.30, key: 'Y' },
			{ note: 'A4', type: 'white', freq: 440.00, key: 'H' },
			{ note: 'A#4', type: 'black', freq: 466.16, key: 'U' },
			{ note: 'B4', type: 'white', freq: 493.88, key: 'J' },
			{ note: 'C5', type: 'white', freq: 523.25, key: 'K' },
			{ note: 'C#5', type: 'black', freq: 554.37, key: 'O' },
			{ note: 'D5', type: 'white', freq: 587.33, key: 'L' },
			{ note: 'D#5', type: 'black', freq: 622.25, key: 'P' },
			{ note: 'E5', type: 'white', freq: 659.25, key: ';' }
		];

		var whiteKeys = notes.filter(function (n) { return n.type === 'white'; });
		var blackKeys = notes.filter(function (n) { return n.type === 'black'; });

		function ensureAudioContext() {
			if (!audioContext) {
				audioContext = new (window.AudioContext || window.webkitAudioContext)();
			}
			if (audioContext.state === 'suspended') {
				audioContext.resume();
			}
		}

		function buildKeyGeometry() {
			var whiteWidth = canvas.width / whiteKeys.length;
			var whiteHeight = canvas.height;
			var blackWidth = whiteWidth * 0.62;
			var blackHeight = canvas.height * 0.62;
			var keyMapByNote = {};

			for (var i = 0; i < whiteKeys.length; i++) {
				var white = whiteKeys[i];
				keyMapByNote[white.note] = {
					x: i * whiteWidth,
					y: 0,
					w: whiteWidth,
					h: whiteHeight,
					type: 'white',
					note: white.note,
					key: white.key,
					freq: white.freq
				};
			}

			for (var b = 0; b < blackKeys.length; b++) {
				var black = blackKeys[b];
				var whiteIndex = whiteKeys.findIndex(function (w) {
					return w.note.charAt(0) === black.note.charAt(0) && w.note.slice(1) === black.note.slice(2);
				});
				var leftWhite = null;
				if (black.note === 'C#4') leftWhite = keyMapByNote['C4'];
				if (black.note === 'D#4') leftWhite = keyMapByNote['D4'];
				if (black.note === 'F#4') leftWhite = keyMapByNote['F4'];
				if (black.note === 'G#4') leftWhite = keyMapByNote['G4'];
				if (black.note === 'A#4') leftWhite = keyMapByNote['A4'];
				if (black.note === 'C#5') leftWhite = keyMapByNote['C5'];
				if (black.note === 'D#5') leftWhite = keyMapByNote['D5'];

				if (!leftWhite) {
					continue;
				}

				keyMapByNote[black.note] = {
					x: leftWhite.x + whiteWidth - (blackWidth / 2),
					y: 0,
					w: blackWidth,
					h: blackHeight,
					type: 'black',
					note: black.note,
					key: black.key,
					freq: black.freq
				};
			}

			return keyMapByNote;
		}

		var keyGeometry = buildKeyGeometry();

		function drawPiano() {
			ctx.clearRect(0, 0, canvas.width, canvas.height);

			whiteKeys.forEach(function (white) {
				var k = keyGeometry[white.note];
				var isActive = !!activeNotes[white.note];
				ctx.fillStyle = isActive ? '#c8dcff' : '#ffffff';
				ctx.strokeStyle = '#2c3e50';
				ctx.lineWidth = 1.2;
				ctx.fillRect(k.x, k.y, k.w, k.h);
				ctx.strokeRect(k.x, k.y, k.w, k.h);

				ctx.fillStyle = '#43505d';
				ctx.font = '14px Arial, sans-serif';
				ctx.textAlign = 'center';
				ctx.fillText(k.key, k.x + (k.w / 2), canvas.height - 14);
			});

			blackKeys.forEach(function (black) {
				var k = keyGeometry[black.note];
				if (!k) {
					return;
				}
				var isActive = !!activeNotes[black.note];
				ctx.fillStyle = isActive ? '#3f5c8a' : '#1f2a36';
				ctx.strokeStyle = '#111820';
				ctx.lineWidth = 1;
				ctx.fillRect(k.x, k.y, k.w, k.h);
				ctx.strokeRect(k.x, k.y, k.w, k.h);

				ctx.fillStyle = '#dfe7ef';
				ctx.font = '12px Arial, sans-serif';
				ctx.textAlign = 'center';
				ctx.fillText(k.key, k.x + (k.w / 2), k.h - 10);
			});
		}

		function getKeyFromPoint(x, y) {
			for (var i = 0; i < blackKeys.length; i++) {
				var black = keyGeometry[blackKeys[i].note];
				if (black && x >= black.x && x <= black.x + black.w && y >= black.y && y <= black.y + black.h) {
					return black;
				}
			}

			for (var j = 0; j < whiteKeys.length; j++) {
				var white = keyGeometry[whiteKeys[j].note];
				if (x >= white.x && x <= white.x + white.w && y >= white.y && y <= white.y + white.h) {
					return white;
				}
			}

			return null;
		}

		function playNote(noteData) {
			if (!noteData || activeNotes[noteData.note]) {
				return;
			}

			ensureAudioContext();
			var oscillator = audioContext.createOscillator();
			var gainNode = audioContext.createGain();
			oscillator.type = 'sine';
			oscillator.frequency.value = noteData.freq;
			gainNode.gain.setValueAtTime(0.0001, audioContext.currentTime);
			gainNode.gain.exponentialRampToValueAtTime(0.25, audioContext.currentTime + 0.02);
			oscillator.connect(gainNode);
			gainNode.connect(audioContext.destination);
			oscillator.start();

			activeNotes[noteData.note] = {
				oscillator: oscillator,
				gainNode: gainNode
			};

			drawPiano();
		}

		function stopNote(noteName) {
			var entry = activeNotes[noteName];
			if (!entry || !audioContext) {
				return;
			}
			var now = audioContext.currentTime;
			entry.gainNode.gain.cancelScheduledValues(now);
			entry.gainNode.gain.setValueAtTime(entry.gainNode.gain.value, now);
			entry.gainNode.gain.exponentialRampToValueAtTime(0.0001, now + 0.06);
			entry.oscillator.stop(now + 0.07);
			delete activeNotes[noteName];
			drawPiano();
		}

		function pointerPosition(evt) {
			var rect = canvas.getBoundingClientRect();
			var clientX = evt.clientX;
			var clientY = evt.clientY;
			if (evt.touches && evt.touches[0]) {
				clientX = evt.touches[0].clientX;
				clientY = evt.touches[0].clientY;
			}
			return {
				x: (clientX - rect.left) * (canvas.width / rect.width),
				y: (clientY - rect.top) * (canvas.height / rect.height)
			};
		}

		var pointerNote = null;

		function onPointerDown(evt) {
			evt.preventDefault();
			var pos = pointerPosition(evt);
			var key = getKeyFromPoint(pos.x, pos.y);
			if (key) {
				pointerNote = key.note;
				playNote(key);
			}
		}

		function onPointerUp() {
			if (pointerNote) {
				stopNote(pointerNote);
				pointerNote = null;
			}
		}

		canvas.addEventListener('mousedown', onPointerDown);
		canvas.addEventListener('mouseup', onPointerUp);
		canvas.addEventListener('mouseleave', onPointerUp);
		canvas.addEventListener('touchstart', onPointerDown, { passive: false });
		canvas.addEventListener('touchend', onPointerUp);

		document.addEventListener('keydown', function (evt) {
			if (evt.repeat) {
				return;
			}
			var mapped = keyMap[evt.key.toLowerCase()];
			if (!mapped || !keyGeometry[mapped]) {
				return;
			}
			playNote(keyGeometry[mapped]);
		});

		document.addEventListener('keyup', function (evt) {
			var mapped = keyMap[evt.key.toLowerCase()];
			if (!mapped) {
				return;
			}
			stopNote(mapped);
		});

		window.addEventListener('resize', function () {
			keyGeometry = buildKeyGeometry();
			drawPiano();
		});

		drawPiano();
	})();
</script>

<?php get_footer();