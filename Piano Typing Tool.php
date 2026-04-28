<?php 
/* Template Name:Piano-Typing Tool*/
get_header();?>
<style media="screen">
	.piano-tool-wrap {
		max-width: 920px;
		margin: 20px auto 40px;
		background: #f5f8fc;
		border: 2px solid #44708f;
		border-radius: 10px;
		overflow: hidden;
		position: relative;
	}

	.piano-total-score {
		position: absolute;
		top: 12px;
		right: 12px;
		z-index: 30;
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		border-radius: 10px;
		border: 1px solid #8cb4e3;
		background: rgba(246, 251, 255, 0.95);
		color: #1e3b5d;
		font-size: 14px;
		font-weight: 700;
		line-height: 1;
	}

	#piano-total-score-value {
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

	.piano-canvas-wrap {
		position: relative;
		width: 100%;
		overflow-x: auto;
		background: #ffffff;
	}

	#piano-canvas {
		display: block;
		width: 100%;
		height: auto;
		background: #ffffff;
		border: 0;
		cursor: pointer;
		touch-action: manipulation;
	}

	.piano-practice-panel {
		margin-bottom: 0;
		padding: 0;
	}

	.piano-practice-header {
		display: none;
		flex-wrap: wrap;
		gap: 10px 14px;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 10px;
	}

	.piano-practice-actions {
		display: flex;
		align-items: center;
		gap: 10px;
		flex-wrap: wrap;
	}

	.piano-score-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 9px 16px;
		position: relative;
		z-index: 20;
		border-radius: 12px;
		border: 1px solid #8cb4e3;
		background: #deecff;
		box-shadow: 0 6px 16px rgba(45, 93, 156, 0.16);
		color: #1e3b5d;
		font-size: 15px;
		font-weight: 700;
		letter-spacing: 0.2px;
		line-height: 1;
	}

	#piano-score-value {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		min-width: 44px;
		padding: 5px 10px;
		border-radius: 999px;
		background: #2c66ad;
		color: #ffffff;
		font-size: 17px;
		font-weight: 800;
		box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.14);
	}

	.piano-practice-actions button {
		padding: 8px 12px;
		border: 1px solid #2f5f97;
		background: #3d78be;
		color: #fff;
		border-radius: 6px;
		cursor: pointer;
		font-size: 13px;
	}

	.piano-practice-actions button:hover {
		background: #3367a1;
	}

	.piano-volume-control {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		font-size: 13px;
		color: #2f3b48;
	}

	.piano-volume-control input[type="range"] {
		width: 150px;
	}

	.piano-flow-wrap {
		background: #eceef3;
		border-radius: 0;
		overflow: hidden;
	}

	#note-flow-canvas {
		display: block;
		width: 100%;
		border: 0;
		height: auto;
		background: #eceef3;
	}

	.piano-flow-hint {
		margin-top: 8px;
		font-size: 12px;
		color: #5f6f80;
	}
</style>

<div class="container-fluid">	
	<div class="piano-tool-wrap">
		<div class="piano-total-score">Total Score: <span id="piano-total-score-value">0</span></div>
		<div class="piano-practice-panel">
			<div class="piano-practice-header">
				<strong>Random Practice Notes</strong>
				<div class="piano-practice-actions">
					<button type="button" id="generate-random-list">Generate Random List</button>
					<span class="piano-score-badge">Score: <span id="piano-score-value">0</span></span>
					<label class="piano-volume-control" for="piano-volume">
						Volume
						<input type="range" id="piano-volume" min="0.05" max="1" step="0.05" value="0.25" />
						<span id="piano-volume-value">25%</span>
					</label>
				</div>
			</div>
			<div class="piano-flow-wrap">
				<canvas id="note-flow-canvas" width="920" height="470" aria-label="Falling random notes"></canvas>
			</div>
		</div>
		<div class="piano-canvas-wrap">
			<canvas id="piano-canvas" width="920" height="160" aria-label="Interactive piano keyboard"></canvas>
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
		var masterGainNode = null;
		var pianoConvolver = null;
		var flowCanvas = document.getElementById('note-flow-canvas');
		var flowCtx = flowCanvas ? flowCanvas.getContext('2d') : null;
		var generateListBtn = document.getElementById('generate-random-list');
		var scoreValue = document.getElementById('piano-score-value');
		var totalScoreValue = document.getElementById('piano-total-score-value');
		var volumeInput = document.getElementById('piano-volume');
		var volumeValue = document.getElementById('piano-volume-value');
		var masterVolume = 0.25;
		var flowSpeed = 120;
		var flowGap = 64;
		var fallingNotes = [];
		var keyFeedbackStates = {};
		var keyPenaltyLabels = {};
		var flowHitLabels = [];
		var score = 0;
		var animationFrameId = null;
		var lastFrameTime = 0;
		var FALLING_NOTE_HEIGHT = 25;
		var HIT_LINE_OFFSET_FROM_BOTTOM = 42;
		var HIT_LINE_Y = flowCanvas ? flowCanvas.height - HIT_LINE_OFFSET_FROM_BOTTOM : 118;
		var HIT_LINE_THICKNESS = 21;
		var HIT_WINDOW_TOLERANCE = 36;
		var NOTE_FADE_IN_DURATION = 260;
		var NOTE_SCALE_DURATION = 220;
		var NOTE_SCALE_PEAK = 2;
		var NOTE_RESOLVE_DURATION = 220;
		var FLOW_HIT_LABEL_DURATION = 420;
		var KEY_PENALTY_DURATION = 520;
		var PIANO_SIDE_PADDING = 24;
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

		function generateRandomNoteList(totalNotes) {
			var count = totalNotes || 12;
			var picks = [];
			for (var i = 0; i < count; i++) {
				var randomIndex = Math.floor(Math.random() * notes.length);
				picks.push(notes[randomIndex].note);
			}
			return picks;
		}

		function buildFallingNotesFromList(list) {
			var laneTop = -24;
			var sequence = [];
			for (var i = 0; i < list.length; i++) {
				var noteName = list[i];
				var geometry = keyGeometry[noteName];
				if (!geometry) {
					continue;
				}
				sequence.push({
					note: noteName,
					x: geometry.x + (geometry.w / 2),
					y: laneTop - (i * flowGap)
				});
			}
			return sequence;
		}

		function drawFlowLane() {
			if (!flowCtx || !flowCanvas) {
				return;
			}
			flowCtx.clearRect(0, 0, flowCanvas.width, flowCanvas.height);
			flowCtx.fillStyle = '#eceef3';
			flowCtx.fillRect(0, 0, flowCanvas.width, flowCanvas.height);

			flowCtx.strokeStyle = '#d8e3f1';
			flowCtx.lineWidth = 1;
			for (var i = 0; i < whiteKeys.length; i++) {
				var g = keyGeometry[whiteKeys[i].note];
				flowCtx.beginPath();
				flowCtx.moveTo(g.x, 0);
				flowCtx.lineTo(g.x, flowCanvas.height);
				flowCtx.stroke();
			}
			flowCtx.beginPath();
			flowCtx.moveTo(flowCanvas.width - PIANO_SIDE_PADDING, 0);
			flowCtx.lineTo(flowCanvas.width - PIANO_SIDE_PADDING, flowCanvas.height);
			flowCtx.stroke();

			flowCtx.strokeStyle = '#f2bd36';
			flowCtx.lineWidth = HIT_LINE_THICKNESS;
			flowCtx.beginPath();
			flowCtx.moveTo(0, HIT_LINE_Y);
			flowCtx.lineTo(flowCanvas.width, HIT_LINE_Y);
			flowCtx.stroke();
		}

		function drawFallingNotes() {
			if (!flowCtx) {
				return;
			}
			for (var i = 0; i < fallingNotes.length; i++) {
				var falling = fallingNotes[i];
				var g = keyGeometry[falling.note];
				if (!g) {
					continue;
				}
				var blockWidth = g.w;
				var blockHeight = FALLING_NOTE_HEIGHT;
				var nowTs = performance.now();
				var baseAlpha = 0.95;
				var noteScale = 1;
				if (falling.resolveStart) {
					var resolveElapsed = nowTs - falling.resolveStart;
					if (resolveElapsed >= 0 && resolveElapsed <= NOTE_RESOLVE_DURATION) {
						var resolveProgress = resolveElapsed / NOTE_RESOLVE_DURATION;
						baseAlpha = 0.18 + (resolveProgress * 0.82);
						var scaleProgress = Math.min(1, resolveElapsed / NOTE_SCALE_DURATION);
						noteScale = 1 + Math.sin(scaleProgress * Math.PI) * (NOTE_SCALE_PEAK - 1);
					}
				} else if (falling.fadeInStart) {
					var elapsed = nowTs - falling.fadeInStart;
					if (elapsed >= NOTE_FADE_IN_DURATION) {
						falling.fadeInStart = 0;
					} else if (elapsed >= 0) {
						baseAlpha = 0.15 + (elapsed / NOTE_FADE_IN_DURATION) * 0.85;
					}
					if (elapsed >= 0 && elapsed <= NOTE_SCALE_DURATION) {
						var idleScaleProgress = elapsed / NOTE_SCALE_DURATION;
						noteScale = 1 + Math.sin(idleScaleProgress * Math.PI) * (NOTE_SCALE_PEAK - 1);
					}
				}
				var scaledWidth = blockWidth * noteScale;
				var scaledHeight = blockHeight * noteScale;
				var x = falling.x - (scaledWidth / 2);
				var y = falling.y - ((scaledHeight - blockHeight) / 2);

				flowCtx.save();
				flowCtx.globalAlpha = Math.max(0.1, Math.min(1, baseAlpha));
				flowCtx.fillStyle = '#e25c1b';
				flowCtx.strokeStyle = '#e25c1b';
				flowCtx.lineWidth = 1;
				flowCtx.shadowColor = 'rgba(226, 92, 27, 0.35)';
				flowCtx.shadowBlur = 8;
				flowCtx.shadowOffsetY = 2;
				drawRoundedRectPath(flowCtx, x, y, scaledWidth, scaledHeight, 0);
				flowCtx.fill();
				flowCtx.shadowColor = 'transparent';
				flowCtx.stroke();
				flowCtx.restore();
			}
		}

		function drawFlowHitLabels(nowTs) {
			if (!flowCtx || !flowHitLabels.length) {
				return;
			}
			var active = [];
			for (var i = 0; i < flowHitLabels.length; i++) {
				var label = flowHitLabels[i];
				var elapsed = nowTs - label.createdAt;
				if (elapsed > FLOW_HIT_LABEL_DURATION) {
					continue;
				}
				active.push(label);
				var progress = elapsed / FLOW_HIT_LABEL_DURATION;
				var alpha = Math.max(0, 1 - progress);
				var yOffset = progress * 22;
				var scale = 1 + Math.sin(Math.min(1, progress * 1.3) * Math.PI) * 0.16;
				var badgeW = label.text === '+5' ? 44 : 38;
				var badgeH = 26;
				var x = label.x - (badgeW / 2);
				var y = (label.y - yOffset) - (badgeH / 2);
				flowCtx.save();
				flowCtx.globalAlpha = alpha;
				flowCtx.translate(label.x, label.y - yOffset);
				flowCtx.scale(scale, scale);
				flowCtx.translate(-label.x, -(label.y - yOffset));
				flowCtx.fillStyle = label.bg;
				flowCtx.strokeStyle = label.stroke;
				flowCtx.lineWidth = 1.6;
				drawRoundedRectPath(flowCtx, x, y, badgeW, badgeH, 12);
				flowCtx.fill();
				flowCtx.stroke();
				flowCtx.fillStyle = label.color;
				flowCtx.font = 'bold 18px Arial, sans-serif';
				flowCtx.textAlign = 'center';
				flowCtx.textBaseline = 'middle';
				flowCtx.fillText(label.text, label.x, label.y - yOffset + 1);
				flowCtx.restore();
			}
			flowHitLabels = active;
		}

		function drawRoundedRectPath(context, x, y, width, height, radius) {
			var r = Math.max(0, Math.min(radius, width / 2, height / 2));
			context.beginPath();
			context.moveTo(x + r, y);
			context.arcTo(x + width, y, x + width, y + height, r);
			context.arcTo(x + width, y + height, x, y + height, r);
			context.arcTo(x, y + height, x, y, r);
			context.arcTo(x, y, x + width, y, r);
			context.closePath();
		}

		function getCurrentTargetNote() {
			if (!fallingNotes.length) {
				return null;
			}
			var hitTop = HIT_LINE_Y - (HIT_LINE_THICKNESS / 2);
			var hitBottom = HIT_LINE_Y + (HIT_LINE_THICKNESS / 2);
			var best = null;
			var bestDistance = Infinity;
			for (var i = 0; i < fallingNotes.length; i++) {
				var item = fallingNotes[i];
				var centerY = item.y + (FALLING_NOTE_HEIGHT / 2);
				var distanceToHit = hitTop - centerY;
				if (centerY > hitBottom + HIT_WINDOW_TOLERANCE) {
					continue;
				}
				if (distanceToHit < bestDistance) {
					bestDistance = distanceToHit;
					best = item;
				}
			}
			if (!best) {
				return null;
			}
			return best;
		}

		function triggerTargetFadeIn(target) {
			if (!target) {
				target = getCurrentTargetNote();
			}
			if (!target || target.resolveStart) {
				return;
			}
			target.fadeInStart = performance.now();
		}

		function createRandomFallingNote(startY) {
			var randomIndex = Math.floor(Math.random() * notes.length);
			var noteName = notes[randomIndex].note;
			var geometry = keyGeometry[noteName];
			if (!geometry) {
				return null;
			}
			return {
				note: noteName,
				x: geometry.x + (geometry.w / 2),
				y: startY
			};
		}

		function triggerTargetResolveAnimation(target) {
			if (!target) {
				target = getCurrentTargetNote();
			}
			if (!target || target.resolveStart) {
				return null;
			}
			target.resolveStart = performance.now();
			return target;
		}

		function updateScore(delta) {
			score += delta;
			if (scoreValue) {
				scoreValue.textContent = String(score);
			}
			if (totalScoreValue) {
				totalScoreValue.textContent = String(score);
			}
		}

		function queueFlowHitLabel(noteItem, scoreText) {
			if (!noteItem || !scoreText) {
				return;
			}
			var isBig = scoreText === '+5';
			var isMiss = scoreText === '-10';
			flowHitLabels.push({
				text: scoreText,
				x: noteItem.x,
				y: noteItem.y + (FALLING_NOTE_HEIGHT / 2),
				color: '#ffffff',
				bg: isMiss ? '#cf3f3f' : (isBig ? '#2fa44a' : '#cf7a2f'),
				stroke: isMiss ? '#8f2424' : (isBig ? '#1b7430' : '#9a5417'),
				createdAt: performance.now()
			});
		}

		function registerWrongKeyPenalty(noteName) {
			if (!noteName) {
				return;
			}
			keyPenaltyLabels[noteName] = {
				text: '-5',
				createdAt: performance.now(),
				expiresAt: performance.now() + KEY_PENALTY_DURATION
			};
			window.setTimeout(function () {
				if (keyPenaltyLabels[noteName] && keyPenaltyLabels[noteName].expiresAt <= performance.now()) {
					delete keyPenaltyLabels[noteName];
					drawPiano();
				}
			}, KEY_PENALTY_DURATION + 10);
		}

		function handleHitResult(noteName, keyAccuracy, targetNote) {
			if (keyAccuracy === 'wrong') {
				registerWrongKeyPenalty(noteName);
				updateScore(-5);
				return;
			}
			triggerTargetFadeIn(targetNote);
			var resolvedNote = triggerTargetResolveAnimation(targetNote);
			var gain = keyAccuracy === 'offbeat' ? 1 : 5;
			updateScore(gain);
			queueFlowHitLabel(resolvedNote, keyAccuracy === 'offbeat' ? '+1' : '+5');
		}

		function drawKeyPenaltyLabel(noteGeometry, penaltyState, isBlackKey) {
			if (!noteGeometry || !penaltyState) {
				return;
			}
			var now = performance.now();
			var total = Math.max(1, penaltyState.expiresAt - penaltyState.createdAt);
			var progress = Math.max(0, Math.min(1, (now - penaltyState.createdAt) / total));
			var alpha = 1 - progress;
			var pop = 1 + Math.sin(Math.min(1, progress * 1.2) * Math.PI) * 0.18;
			var lift = progress * (isBlackKey ? 8 : 10);
			var cx = noteGeometry.x + (noteGeometry.w / 2);
			var cy = (noteGeometry.y + (noteGeometry.h / 2)) - lift;
			var badgeW = isBlackKey ? 36 : 42;
			var badgeH = isBlackKey ? 21 : 24;

			ctx.save();
			ctx.globalAlpha = Math.max(0, alpha);
			ctx.translate(cx, cy);
			ctx.scale(pop, pop);
			ctx.translate(-cx, -cy);
			ctx.fillStyle = '#e14545';
			ctx.strokeStyle = '#8f2020';
			ctx.lineWidth = 1.4;
			drawRoundedRectPath(ctx, cx - (badgeW / 2), cy - (badgeH / 2), badgeW, badgeH, 10);
			ctx.fill();
			ctx.stroke();
			ctx.fillStyle = '#ffffff';
			ctx.font = isBlackKey ? 'bold 14px Arial, sans-serif' : 'bold 16px Arial, sans-serif';
			ctx.textAlign = 'center';
			ctx.textBaseline = 'middle';
			ctx.fillText(penaltyState.text, cx, cy + 1);
			ctx.restore();
		}

		function animateFlow(timestamp) {
			if (!flowCtx || !flowCanvas) {
				return;
			}
			if (!lastFrameTime) {
				lastFrameTime = timestamp;
			}
			var dt = (timestamp - lastFrameTime) / 1000;
			lastFrameTime = timestamp;

			var highestY = Infinity;
			for (var i = 0; i < fallingNotes.length; i++) {
				if (fallingNotes[i].y < highestY) {
					highestY = fallingNotes[i].y;
				}
			}
			for (var j = 0; j < fallingNotes.length; j++) {
				var item = fallingNotes[j];
				if (item.resolveStart) {
					continue;
				}
				item.y += flowSpeed * dt;
			}

			var nowTs = performance.now();
			var activeNotesList = [];
			var removedCount = 0;
			var topY = Infinity;
			for (var k = 0; k < fallingNotes.length; k++) {
				var noteItem = fallingNotes[k];
				if (noteItem.resolveStart && nowTs - noteItem.resolveStart >= NOTE_RESOLVE_DURATION) {
					removedCount++;
					continue;
				}
				var noteBottomY = noteItem.y + FALLING_NOTE_HEIGHT;
				if (!noteItem.resolveStart && noteBottomY >= flowCanvas.height) {
					queueFlowHitLabel(noteItem, '-10');
					updateScore(-10);
					removedCount++;
					continue;
				}
				activeNotesList.push(noteItem);
				if (noteItem.y < topY) {
					topY = noteItem.y;
				}
			}
			if (removedCount > 0) {
				if (topY === Infinity) {
					topY = -24;
				}
				for (var r = 0; r < removedCount; r++) {
					var startY = topY - flowGap;
					var newItem = createRandomFallingNote(startY);
					if (newItem) {
						activeNotesList.push(newItem);
						topY = startY;
					}
				}
				fallingNotes = activeNotesList;
			}

			drawFlowLane();
			drawFallingNotes();
			drawFlowHitLabels(nowTs);
			animationFrameId = window.requestAnimationFrame(animateFlow);
		}

		function renderRandomNoteList() {
			if (!flowCanvas || !flowCtx) {
				return;
			}
			var list = generateRandomNoteList(14);
			fallingNotes = buildFallingNotesFromList(list);
			lastFrameTime = 0;
			if (!animationFrameId) {
				animationFrameId = window.requestAnimationFrame(animateFlow);
			}
		}

		function ensureAudioContext() {
			if (!audioContext) {
				audioContext = new (window.AudioContext || window.webkitAudioContext)();
				masterGainNode = audioContext.createGain();
				masterGainNode.gain.value = 0.9;
				masterGainNode.connect(audioContext.destination);
				pianoConvolver = audioContext.createConvolver();
				pianoConvolver.buffer = createImpulseResponse(1.8, 2.4);
				pianoConvolver.connect(masterGainNode);
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
			var gains = [];

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
				gains.push(gain);
			}

			// Short, filtered noise burst to mimic hammer strike.
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
			dryGain.connect(masterGainNode);
			wetGain.connect(pianoConvolver);

			return {
				output: output,
				oscillators: oscillators,
				noiseSource: noiseSource,
				noiseGain: noiseGain
			};
		}

		function buildKeyGeometry() {
			var playableWidth = canvas.width - (PIANO_SIDE_PADDING * 2);
			var whiteWidth = playableWidth / whiteKeys.length;
			var whiteHeight = canvas.height;
			var blackWidth = whiteWidth * 0.6;
			var blackHeight = canvas.height * 0.58;
			var keyMapByNote = {};

			for (var i = 0; i < whiteKeys.length; i++) {
				var white = whiteKeys[i];
				keyMapByNote[white.note] = {
					x: PIANO_SIDE_PADDING + (i * whiteWidth),
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
			var penaltyDrawQueue = [];

			whiteKeys.forEach(function (white) {
				var k = keyGeometry[white.note];
				var isActive = !!activeNotes[white.note];
				var feedback = keyFeedbackStates[white.note];
				var keyTopOffset = isActive ? 4 : 0;
				var keyHeight = Math.max(0, k.h - keyTopOffset);
				var baseFill = '#ffffff';
				if (feedback === 'perfect') baseFill = '#72d888';
				if (feedback === 'offbeat') baseFill = '#f3ad5c';
				if (feedback === 'wrong') baseFill = '#ee6b6b';
				if (isActive && !feedback) baseFill = '#dde8f7';
				ctx.fillStyle = baseFill;
				ctx.strokeStyle = '#44708f';
				ctx.lineWidth = 1;
				ctx.fillRect(k.x, k.y + keyTopOffset, k.w, keyHeight);
				ctx.strokeRect(k.x, k.y + keyTopOffset, k.w, keyHeight);

				ctx.fillStyle = '#6f8597';
				ctx.font = '11px Arial, sans-serif';
				ctx.textAlign = 'center';
				ctx.fillText(white.note.replace(/\d+/g, ''), k.x + (k.w / 2), canvas.height - 48 + keyTopOffset);
				ctx.fillStyle = '#436f8e';
				ctx.font = '700 16px Arial, sans-serif';
				ctx.fillText(k.key, k.x + (k.w / 2), canvas.height - 18 + keyTopOffset);

				var whitePenalty = keyPenaltyLabels[white.note];
				if (whitePenalty) {
					if (whitePenalty.expiresAt <= performance.now()) {
						delete keyPenaltyLabels[white.note];
					} else {
						penaltyDrawQueue.push({
							geometry: k,
							penalty: whitePenalty,
							isBlack: false
						});
					}
				}
			});

			blackKeys.forEach(function (black) {
				var k = keyGeometry[black.note];
				if (!k) {
					return;
				}
				var isActive = !!activeNotes[black.note];
				var feedback = keyFeedbackStates[black.note];
				var keyTopOffset = isActive ? 3 : 0;
				var keyHeight = Math.max(0, k.h - keyTopOffset);
				var baseBlackFill = '#436f8e';
				if (feedback === 'perfect') baseBlackFill = '#3abf62';
				if (feedback === 'offbeat') baseBlackFill = '#df8f43';
				if (feedback === 'wrong') baseBlackFill = '#ce4f4f';
				if (isActive && !feedback) baseBlackFill = '#5782a8';
				ctx.fillStyle = baseBlackFill;
				ctx.strokeStyle = '#33566f';
				ctx.lineWidth = 1;
				ctx.fillRect(k.x, k.y + keyTopOffset, k.w, keyHeight);
				ctx.strokeRect(k.x, k.y + keyTopOffset, k.w, keyHeight);

				ctx.fillStyle = '#d9e5f0';
				ctx.font = '10px Arial, sans-serif';
				ctx.textAlign = 'center';
				ctx.fillText(black.note.replace(/\d+/g, ''), k.x + (k.w / 2), k.h - 28 + keyTopOffset);
				ctx.fillStyle = '#ffffff';
				ctx.font = '700 13px Arial, sans-serif';
				ctx.fillText(k.key, k.x + (k.w / 2), k.h - 10 + keyTopOffset);

				var blackPenalty = keyPenaltyLabels[black.note];
				if (blackPenalty) {
					if (blackPenalty.expiresAt <= performance.now()) {
						delete keyPenaltyLabels[black.note];
					} else {
						penaltyDrawQueue.push({
							geometry: k,
							penalty: blackPenalty,
							isBlack: true
						});
					}
				}
			});

			for (var p = 0; p < penaltyDrawQueue.length; p++) {
				var penaltyItem = penaltyDrawQueue[p];
				drawKeyPenaltyLabel(penaltyItem.geometry, penaltyItem.penalty, penaltyItem.isBlack);
			}
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

		function getNoteDistanceFromHitLine(noteItem) {
			if (!noteItem) {
				return Infinity;
			}
			var hitTop = HIT_LINE_Y - (HIT_LINE_THICKNESS / 2);
			var hitBottom = HIT_LINE_Y + (HIT_LINE_THICKNESS / 2);
			var noteTopY = noteItem.y;
			var noteBottomY = noteItem.y + FALLING_NOTE_HEIGHT;

			if (noteBottomY < hitTop) {
				return hitTop - noteBottomY;
			}
			if (noteTopY > hitBottom) {
				return noteTopY - hitBottom;
			}
			return 0;
		}

		function isNoteAcrossHitLine(noteItem) {
			if (!noteItem) {
				return false;
			}
			var hitTop = HIT_LINE_Y - (HIT_LINE_THICKNESS / 2);
			var hitBottom = HIT_LINE_Y + (HIT_LINE_THICKNESS / 2);
			var noteTopY = noteItem.y;
			var noteBottomY = noteItem.y + FALLING_NOTE_HEIGHT;
			return noteTopY <= hitBottom && noteBottomY >= hitTop;
		}

		function getBestMatchForInput(noteName) {
			var nearestAny = null;
			var nearestAnyDistance = Infinity;
			var nearestMatching = null;
			var nearestMatchingDistance = Infinity;

			for (var i = 0; i < fallingNotes.length; i++) {
				var item = fallingNotes[i];
				var distance = getNoteDistanceFromHitLine(item);

				if (distance < nearestAnyDistance) {
					nearestAnyDistance = distance;
					nearestAny = item;
				}

				if (item.note === noteName && distance < nearestMatchingDistance) {
					nearestMatchingDistance = distance;
					nearestMatching = item;
				}
			}

			return {
				nearestAny: nearestAny,
				nearestAnyDistance: nearestAnyDistance,
				nearestMatching: nearestMatching,
				nearestMatchingDistance: nearestMatchingDistance
			};
		}

		function assessKeyAccuracy(noteName) {
			var match = getBestMatchForInput(noteName);
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

			if (nearestAny && nearestAny.note !== noteName && nearestAnyDistance <= nearestMatchingDistance) {
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

		function setKeyFeedback(noteName, status) {
			if (!noteName || !status) {
				return;
			}
			keyFeedbackStates[noteName] = status;
			window.setTimeout(function () {
				if (keyFeedbackStates[noteName] === status) {
					delete keyFeedbackStates[noteName];
					drawPiano();
				}
			}, 170);
		}

		function playNote(noteData) {
			if (!noteData || activeNotes[noteData.note]) {
				return;
			}

			ensureAudioContext();
			var voice = createPianoVoice(noteData);

			activeNotes[noteData.note] = {
				voice: voice
			};

			drawPiano();
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
				var pointerAssessment = assessKeyAccuracy(key.note);
				setKeyFeedback(key.note, pointerAssessment.status);
				handleHitResult(key.note, pointerAssessment.status, pointerAssessment.target);
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

		if (generateListBtn) {
			generateListBtn.addEventListener('click', renderRandomNoteList);
		}

		if (volumeInput) {
			volumeInput.addEventListener('input', function () {
				var volume = parseFloat(volumeInput.value);
				if (isNaN(volume)) {
					return;
				}
				masterVolume = volume;
				if (volumeValue) {
					volumeValue.textContent = Math.round(volume * 100) + '%';
				}
			});
		}

		document.addEventListener('keydown', function (evt) {
			if (evt.repeat) {
				return;
			}
			var mapped = keyMap[evt.key.toLowerCase()];
			if (!mapped || !keyGeometry[mapped]) {
				return;
			}
			var keyAssessment = assessKeyAccuracy(mapped);
			setKeyFeedback(mapped, keyAssessment.status);
			handleHitResult(mapped, keyAssessment.status, keyAssessment.target);
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
			HIT_LINE_Y = flowCanvas ? flowCanvas.height - HIT_LINE_OFFSET_FROM_BOTTOM : HIT_LINE_Y;
			drawPiano();
			fallingNotes = buildFallingNotesFromList(fallingNotes.map(function (item) { return item.note; }));
			drawFlowLane();
			drawFallingNotes();
		});

		renderRandomNoteList();
		drawPiano();
	})();
</script>

<?php get_footer();