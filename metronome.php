<?php 
/* Template Name:Metronome */
get_header();?>
<style media="screen">
	@media all and (max-width: 1024px) {
		#sAs-menu-responsive span {
			background-image: url(<?php echo get_stylesheet_directory_uri();?>/assets/images/toggle.png);
			background-repeat: no-repeat;
			background-size: contain;
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
	}
	
	.metronome-wrapper {
		position: relative;
		justify-self: center;
	}
	
	.metronome-wrapper img {
/* display: block; */
	}
	
	.needle {
		position: absolute;
		top: 50%;
        left: 50%;
        transform: translate3d(-50%, -60%, 0);
		display: inline-block;
		backface-visibility: hidden;
	}
	
	.needle-weight{
  		position:absolute;
	  	left:50%;
	  	transform: translate(-50%, -10%);
	  	top: 44.5%; /* initial position (will be overridden by JS) */
	  	z-index: 2;
	  	cursor: grab;
	  	touch-action: none; /* needed for touch dragging */
	  	user-select: none;
		width: 40px;  /* ← force container size */
    	height: 30px;
	}
	
	.needle-weight img{ 
		width: 100% !important;
   	 	height: 30px !important;
		display: block;
		pointer-events:none;
	}
	
	.needle-rotator {
		position: relative;
		display: inline-block;
		overflow: visible;
		will-change: transform;
	}
	
	.needle-rotator > .needle-img {
		width: auto;      /* ← let JS control width */
		height: auto;     /* ← JS will override this */
		display: block;
		max-width: none; /* override .img-fluid so SVG scales cleanly */
		overflow: visible;
	}
	
	/* Anchored to shaft bottom; horizontal center only — vertical offset comes from JS so flat edge meets template line at every scale */
	.weight-point {
		box-sizing: border-box;
		position: absolute;
		left: 50%;
		top: auto;
		z-index: 1;
		transform: translate3d(-50%, 0, 0);
		width: 40px;
		height: 25px;
	}
	
	.weight-point img {
		width: 40px !important;
		height: 25px !important;
		display: block;
		object-fit: contain;
		object-position: bottom center;
	}
	
	.minus-btn {
		position: absolute;
		top: 83%;
		left: 15%;
	}
	
	.plus-btn {
		position: absolute;
		top: 83%;
		left: 68%;
	}
	
	.bpm {
		position: absolute;
		top: 80%;
		left: 50%;
		transform: translate(-50%, -10px);
		text-align: center;
	}
	
	.bpm-value {
		color: #E35D26;
		font-size: 40px;
	}
	
	.bpm-unit {
		color: #E35D26;
		font-size: 12px;
	}
	
	.strong-beat {
/* position: absolute;
		top: 105%; */
		padding-left: 0;
/* text-align: center; */
	}
	
	.strong-label {
		color: #436f8e;
		font-size: 12px;
	}
	
	.tap-group {
		display: flex;
		flex-direction: row;
		align-items: center;
		justify-content: center;
		padding: 8px 0;
		width: 100%;
		box-sizing: border-box;
		gap: 4px;
		overflow: hidden; /* ← prevent any overflow */
	}
	
	.tap-group > div {
		flex-shrink: 1;   /* ← allow shrinking */
		min-width: 0;     /* ← allow shrinking below content size */
	}
	
	.tap-btn {
		padding-left: 0;
		padding-right: 0;
	}
	
	.select-bar select {				
		padding: 4px;
		border-radius: 5px;
		color: #E35D26;
		border: 1px solid #436f8e;
		font-size: 13px;
		width: auto;        /* ← remove fixed width */
		max-width: 100px;   /* ← cap maximum width */
		min-width: 60px;
}
	}
	
	.metronome-col {
		display: flex;
		flex-direction: column;
		align-items: center;
		width: 100%;           /* ← add this */
    	-webkit-box-align: center; /* ← Safari prefix */
	}

	.needle-weight:active{ cursor: grabbing; }

	/* Optional: make clicks pass to weight only (if needed) */
	.needle img{ pointer-events:none; }          /* needle image ignores pointer */
	
	.custom-select-wrapper {
		position: relative;
		user-select: none;
		overflow: visible !important;
	}
	
	.custom-select-wrapper select {
		display: none !important;
	}

	.beat-custom-select {
		position: relative;
		display: inline-block;
		min-width: 85px;
		overflow: visible !important;
	}
	
	.tap-group {
		overflow: visible !important; /* ← changed from overflow: hidden */
	}

	.custom-select-trigger {
		padding: 5px 10px;
		border-radius: 5px;
		color: #E35D26;
		border: 1px solid #436f8e;
		font-size: 13px;
		cursor: pointer;
		background: white;
		white-space: nowrap;
	}

	.custom-options {
		display: none;
		position: absolute;
		bottom: 100%; /* ← opens UPWARD */
		left: 0;
		background: white;
		border: 1px solid #436f8e;
		border-radius: 5px;
		z-index: 9999;
		min-width: 100%;
		max-height: 250px; /* ← shows ~5 options */
		overflow-y: auto; /* ← scroll for the rest */
		box-shadow: 0 -4px 8px rgba(0,0,0,0.1);
	}

	/* Scrollbar styling */
	.custom-options::-webkit-scrollbar {
		width: 4px;
	}

	.custom-options::-webkit-scrollbar-track {
		background: #f1f1f1;
		border-radius: 4px;
	}

	.custom-options::-webkit-scrollbar-thumb {
		background: #436f8e;
		border-radius: 4px;
	}

	.custom-option {
		padding: 7px 10px;
		cursor: pointer;
		font-size: 13px;
		color: #333;
		white-space: nowrap;
	}

	.custom-option:hover {
		background: #f0f6fa;
		color: #E35D26;
	}

	.custom-option.selected {
		background: #436f8e;
		color: white;
	}

	.beat-custom-select.open .custom-options {
		display: block;
	}
	
	#metronome-sizer {
		display: block;
		width: 220px;
		margin: 0 auto;        /* ← add this for iOS fallback */
		float: none;           /* ← prevent any float interference */
	}
	
	#tap-btn {
		margin-left: 1%;
		margin-right: 1%;
	}
	
	@media (min-width: 600px) {
		#tap-btn {
			margin-left: 3%;
			margin-right: 3%;
		}
		
		#metronome-sizer {
			width: 320px;
		}
		
		.needle-img {
			height: 330px;
		}
	}
	
	@media (max-width: 600px) {
	  	#metronome-sizer{
			width: 65vw;  
			max-width: 220px;
			justify-self: center;
		 }

	  	.metronome-wrapper{
			width: 100%;
		  }

		.metronome-wrapper img{
			width: 100%;
			height: auto;
		}
	}
	
	@media (max-width: 768px) {
		.col-12.metronome-col {
			display: flex !important;
			flex-direction: column !important;
			align-items: center !important;
			-webkit-align-items: center !important;
			text-align: center;
			width: 100% !important;
		}

		#metronome-sizer {
			margin-left: auto !important;
			margin-right: auto !important;
			float: none !important;
		}
	}
	
	

	/* --- PLAY/PAUSE CSS BUTTON & ICON --- */
	.play-btn-css {
		background-color: #E35D26;
		border-radius: 50%;
		cursor: pointer;
		display: flex;
		align-items: center;
		justify-content: center;
		border: none;
		box-sizing: border-box;
		transition: transform 0.1s ease-in-out;
		
		/* The Drop Shadow style based on TAP button screenshot */
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
	}

	/* Added active/press state so the user gets feedback */
	.play-btn-css:active { 
		transform: scale(0.97); 
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* softer shadow on press */
	}

	.play-icon-shape::before {
		content: "";
		display: block;
		width: 0; height: 0;
		border-style: solid;
		border-width: 10px 0 10px 16px;
		border-color: transparent transparent transparent #ffffff;
		margin-left: 4px; /* Optical center */
	}

	.pause-icon-shape::before, .pause-icon-shape::after {
		content: "";
		display: block;
		width: 4px;
		height: 18px;
		background-color: #ffffff;
		margin: 0 2px;
	}
	/* ---------------------------- */
	
</style>

<div class="container-fluid">
    <div>

        <div>

			<div id="metronome-sizer">

				<div class="metronome-wrapper">
					<img class="img-fluid skip-lazy" 
						 id="metronome-bg"
						 src="<?=get_stylesheet_directory_uri();?>/assets/images/metronome-template.svg" alt="">		
					<div class="needle" id="needle">
						<div class="needle-rotator" id="needle-rotator">
							<!-- Single <rect> shaft avoids multi-segment / subpixel seams from scaled needle.svg -->
							<svg class="img-fluid skip-lazy needle-img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 520" preserveAspectRatio="xMidYMin meet" aria-hidden="true" focusable="false">
								<rect x="19" y="0" width="4" height="520" fill="#E35D26"/>
							</svg>
							<div class="needle-weight" id="needleWeight">
								<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/needle-weight.svg" alt="">
							</div>
						</div>
						<div class="weight-point" id="weight-point">
							<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/metronome-weight-point.svg" alt="">
						</div>
					</div>
					<div class="minus-btn">
						<img class="img-fluid skip-lazy minus-plus-btn" id='minus-btn' src="<?=get_stylesheet_directory_uri();?>/assets/images/minus-inactive.svg" alt="">
					</div>
					<div class="bpm">
						<p class="bpm-value" style="margin-bottom: 0rem;"><strong id="bpm-label">135</strong></p>
						<p class="bpm-unit"><strong><?=the_field('bpm_unit');?></strong></p>
					</div>
					<div class="plus-btn">
						<img class="img-fluid skip-lazy minus-plus-btn" id='plus-btn' src="<?=get_stylesheet_directory_uri();?>/assets/images/plus-inactive.svg" alt="">
					</div>
				</div>

				<div class="tap-group" style="width: 100%;">
					<div>
						<p class="strong-label" style="margin-bottom: 0rem !important;"><?php the_field('strong_beat_label'); ?></p>
						<div class="custom-select-wrapper" style="padding-top: 5px;">
							<div class="beat-custom-select" id="custom-beat-select">

								
								<?php
									// check if the repeater field has rows of data
									$default_beat_value = 0;
									if (have_rows('beat_values')):

										// loop through the rows of data
									while (have_rows('beat_values')): the_row(); 
										if(get_sub_field('is_default')) $default_beat_value = get_sub_field('value');
									endwhile;
									else:
									endif;
								?>
								<div class="custom-select-trigger"><?php echo $default_beat_value; ?> <?php the_field('beat_unit');?> ▾</div>
								<div class="custom-options">
									<?php
										// check if the repeater field has rows of data
										if (have_rows('beat_values')):

											// loop through the rows of data
										while (have_rows('beat_values')): the_row(); ?>
										<div class="custom-option <?php if (get_sub_field('is_default')) echo 'selected'; ?>" data-value="<?php the_sub_field('value'); ?>"><?php the_sub_field('value'); ?> <?php the_field('beat_unit'); ?></div>
									<?php endwhile;
										else:
										endif;
									?>
								</div>
							</div>
						</div>
					</div>
					<img id="tap-btn" style="margin-top: 2%;" class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/tap-inactive.svg" alt="">
					
					<div id="play-btn" class="play-btn-css play-icon-shape" style="margin-top: 1%;"></div>
				</div>

			</div></div>

        <div>
            <div class="wid-sm-100 wid-xs-100">
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
			</div>
			<div class="wid-sm-100 wid-xs-100">

				<div class="trouble-shooting-2 dis-flex">
					<div>

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
			</div>

			<div class="other-section">
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
			</div>
        </div>

    </div>
</div>	
</div>
</article>
</div>
</div>

<script>
(function(){
	const needle       = document.getElementById('needle');
	const weight       = document.getElementById('needleWeight');
	const bpmLabel     = document.getElementById('bpm-label');
	const minusBtn     = document.getElementById('minus-btn');
	const plusBtn      = document.getElementById('plus-btn');
	const tapBtn       = document.getElementById('tap-btn');
	const playBtn      = document.getElementById("play-btn");
	const rotator      = document.getElementById("needle-rotator");
	const pivotEl      = document.getElementById('weight-point');
	const beatSelect   = document.getElementById('beat-select');

	if (!needle || !weight || !bpmLabel) return;

	let currentBPM = 135;

	const BPM_MIN = 20;
	const BPM_MAX = 250;
	const AMP_MAX = 28;
	const AMP_MIN = 10;

	let tapTimes  = [];
	const MAX_TAPS     = 8;
	const TAP_RESET_MS = 2000;

	let dragging  = false;
	let pointerId = null;
	let isPlaying = false;
	let rafId     = null;
	let currentAngle = 0;
	let returnTimer = null;
	const RETURN_TO_CENTER_MS = 220;
	
	// ── Audio Setup ───────────────────────────────────────────────
	const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
	
	let normalClickBuffer = null;
	let strongClickBuffer = null;
	
	async function loadSound(url) {
		try {
			const response    = await fetch(url);
			const arrayBuffer = await response.arrayBuffer();
			return await audioCtx.decodeAudioData(arrayBuffer);
		} catch(e) {
			console.warn('Could not load sound:', url, e);
			return null;
		}
	}
	
	const customSelect = document.getElementById('custom-beat-select');
	const trigger      = customSelect.querySelector('.custom-select-trigger');
	const options      = customSelect.querySelectorAll('.custom-option');
	
	trigger.addEventListener('click', (e) => {
		e.stopPropagation();
		customSelect.classList.toggle('open');
	});

	options.forEach(option => {
		option.addEventListener('click', () => {
			const val = option.getAttribute('data-value');

			// Sync hidden select
// 			beatSelect.value = val;

			// Update trigger text
			trigger.textContent = option.textContent + ' ▾';

			// Update selected highlight
			options.forEach(o => o.classList.remove('selected'));
			option.classList.add('selected');

			// Close
			customSelect.classList.remove('open');

			// Reset beat count
			beatCount = 0;
			beatSelect.dispatchEvent(new Event('change'));
		});
	});

	// Close on outside click
	document.addEventListener('click', () => {
		customSelect.classList.remove('open');
	});
	
	// ── Scale needle height to match wrapper ───────────────────────
	function scaleNeedle() {
		const wrapperEl = document.querySelector('.metronome-wrapper');
		const needleImg = document.querySelector('.needle-rotator > .needle-img');
		const weightEl   = document.getElementById('needleWeight');
		const weightImg  = document.querySelector('.needle-weight img');
		const pointEl    = document.getElementById('weight-point');
		const pointImg   = document.querySelector('.weight-point img');
		const bpmValueEl = document.querySelector('.bpm-value');
    	const bpmUnitEl  = document.querySelector('.bpm-unit');
		const minusImg   = document.getElementById('minus-btn');
		const plusImg    = document.getElementById('plus-btn');
		const tapImg     = document.getElementById('tap-btn');
		const playImg    = document.getElementById('play-btn');
		
		 const bgImg      = document.getElementById('metronome-bg');

		if (!wrapperEl || !needleImg) return;

		const wrapperW = wrapperEl.getBoundingClientRect().width;

		// ── MUST be `let` not `const` so we can reassign for iOS fix ──
		let wrapperH = wrapperEl.getBoundingClientRect().height;

		// iOS Safari fix: height returns 0 before image renders
		if (!wrapperH || wrapperH < 10) {
			if (bgImg && bgImg.naturalWidth && bgImg.naturalHeight) {
				wrapperH = wrapperW * (bgImg.naturalHeight / bgImg.naturalWidth);
			} else {
				wrapperH = wrapperW * 1.4;
			}
		}
		
		// ── Needle height (integer px avoids uneven stroke when the SVG is rasterized) ──
		const platform = navigator.platform.toLowerCase();
		let needleH = /iphone|ipod|ipad/.test(platform) ? wrapperH * 0.75 : wrapperH * 0.72;
		needleH = Math.max(1, Math.round(needleH));
		needleImg.style.height = needleH + 'px';
		needleImg.style.width  = 'auto';

		// ── Needle weight ──────────────────────────────────────────
		const weightSize = wrapperW * 0.14;
		weightImg.style.width  = weightSize + 'px';
		weightImg.style.height = 'auto';
		weightEl.style.width   = weightSize + 'px';
		weightEl.style.height  = 'auto';

		// ── Weight point: flat edge on template divider (bottom offset scales with wrapper / zoom)
		if (pointImg && pointEl) {
			const pointSize = wrapperW * 0.13;
			pointImg.style.width  = pointSize + 'px';
			pointImg.style.height = 'auto';
			pointEl.style.width   = pointSize + 'px';
			pointEl.style.height  = 'auto';
			const pointBottom = Math.round(wrapperW * 0.020);
			pointEl.style.bottom = pointBottom + 'px';
		}

		// ── BPM font ───────────────────────────────────────────────
		const bpmFontSize = wrapperW * 0.14;
		const bpmUnitSize = wrapperW * 0.045;
		if (bpmValueEl) bpmValueEl.style.fontSize = Math.max(12, bpmFontSize) + 'px';
		if (bpmUnitEl)  bpmUnitEl.style.fontSize  = Math.max(7,  bpmUnitSize) + 'px';

		// ── Minus / Plus buttons ───────────────────────────────────
		const btnSize = wrapperW * 0.18; // ← scale with wrapper
		if (minusImg) { minusImg.style.width = btnSize + 'px'; minusImg.style.height = 'auto'; }
		if (plusImg)  { plusImg.style.width  = btnSize + 'px'; plusImg.style.height  = 'auto'; }

		// ── TAP / Play buttons ─────────────────────────────────────
		const tapSize  = wrapperW * 0.28;
		const playSize = wrapperW * 0.19;
		if (tapImg)  { tapImg.style.width  = tapSize  + 'px'; tapImg.style.height  = 'auto'; }
		
		// SCALE THE NEW CSS BUTTON SIZES
		if (playBtn) { 
			playBtn.style.width = playSize + 'px'; 
			playBtn.style.height = playSize + 'px'; 
		}

		setNeedlePivot();
	}

	function ensureNeedleLayout(attempt = 0) {
		scaleNeedle();
		const wrapperEl = document.querySelector('.metronome-wrapper');
		const needleImg = document.querySelector('.needle-rotator > .needle-img');
		if (!wrapperEl || !needleImg) return;

		const wrapperW = wrapperEl.getBoundingClientRect().width;
		const renderedNeedleH = needleImg.getBoundingClientRect().height;

		// Fresh-tab first paint can report 0 size; retry briefly until stable.
		if ((wrapperW < 20 || renderedNeedleH < 20) && attempt < 12) {
			requestAnimationFrame(() => ensureNeedleLayout(attempt + 1));
		}
	}

	ensureNeedleLayout();
	
	window.addEventListener('resize', () => {
		scaleNeedle();
		// Re-set weight position after resize
		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();
		const maxTop = needleRect.height - weightRect.height;
		setWeightTop(Math.max(0, maxTop * 0.5));
		setNeedlePivot();
	});
	
	// Fallback synthetic click if audio files not found
	function playSyntheticClick(isStrong = false) {
		const osc      = audioCtx.createOscillator();
		const gainNode = audioCtx.createGain();

		osc.connect(gainNode);
		gainNode.connect(audioCtx.destination);

		osc.frequency.setValueAtTime(isStrong ? 1000 : 800, audioCtx.currentTime);
		osc.type = 'sine';

		gainNode.gain.setValueAtTime(isStrong ? 1.0 : 0.6, audioCtx.currentTime);
		gainNode.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.05);

		osc.start(audioCtx.currentTime);
		osc.stop(audioCtx.currentTime + 0.05);
	}
	
	function flashBackground(isStrong) {
		if (!isStrong) return; // ← only flash on strong beat

		const metronomeBg = document.getElementById('metronome-bg');
		if (!metronomeBg) return;

		// Switch to orange background
		metronomeBg.src = "<?=get_stylesheet_directory_uri();?>/assets/images/metronome-template-orange.svg";

		// Switch back after short delay
		setTimeout(() => {
			metronomeBg.src = "<?=get_stylesheet_directory_uri();?>/assets/images/metronome-template.svg";
		}, 200); // ← 200ms flash duration
	}
	
	function playClick(isStrong = false) {
		if (audioCtx.state === 'suspended') audioCtx.resume();

		const buffer = isStrong ? strongClickBuffer : normalClickBuffer;

		if (!buffer) {
			// Fallback to synthetic beep if audio files not loaded
			playSyntheticClick(isStrong);
			flashBackground(isStrong);
			return;
		}

		const source = audioCtx.createBufferSource();
		source.buffer = buffer;
		source.connect(audioCtx.destination);
		source.start();
		
		flashBackground(isStrong);
	}
	
	// Load audio files on page load
	window.addEventListener('load', async () => {
		ensureNeedleLayout();

		const baseUrl = '<?=get_stylesheet_directory_uri();?>/assets/audio/';
		normalClickBuffer = await loadSound(baseUrl + 'metronome-strong-sound.mp3');
		strongClickBuffer = await loadSound(baseUrl + 'metronome-general-sound.mp3');

		// Set initial weight position
		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();
		const maxTop     = needleRect.height - weightRect.height;
		setWeightTop(Math.max(0, maxTop * 0.5));
	});
	
	let beatCount = 0;
	
	// Reset beat count when dropdown changes
	if (beatSelect) {
		beatSelect.addEventListener('change', () => {
			beatCount = 0;
		});
	}
	
	function getBeatInterval() {
		const selected = document.querySelector('#custom-beat-select .custom-option.selected');
		return selected ? parseInt(selected.getAttribute('data-value'), 10) : <?php echo (int) $default_beat_value; ?>;
	}
	
	function bpmToAmplitude(bpm) {
		const t = (clamp(bpm, BPM_MIN, BPM_MAX) - BPM_MIN) / (BPM_MAX - BPM_MIN);
		return AMP_MAX - t * (AMP_MAX - AMP_MIN);
	}

	function setNeedlePivot(){
  		if (!rotator || !pivotEl) return;

  		// Use stable layout coordinates (not rotator's transformed box),
  		// so zoom/resize while swinging does not skew the pivot.
  		const needleRect = needle.getBoundingClientRect();
  		const pivotRect  = pivotEl.getBoundingClientRect();

  		const rotatorLeft = needleRect.left + rotator.offsetLeft;
  		const rotatorTop  = needleRect.top + rotator.offsetTop;
  		const pivotX = (pivotRect.left + pivotRect.width / 2) - rotatorLeft;
  		const pivotY = (pivotRect.top  + pivotRect.height / 2) - rotatorTop;

  		rotator.style.transformOrigin = `${Math.round(pivotX * 100) / 100}px ${Math.round(pivotY * 100) / 100}px`;
	}

	if (window.visualViewport) {
		window.visualViewport.addEventListener('resize', () => {
			scaleNeedle();
			setNeedlePivot();
		});
	}

	// Animate back/forth: one full cycle (left->right->left) = 2 beats
	function startSwing(){
  		if (!rotator) return;
		if (returnTimer) {
			clearTimeout(returnTimer);
			returnTimer = null;
		}
		rotator.style.transition = 'none';
  		setNeedlePivot();
		
		// TOGGLE CSS SHAPES INSTEAD OF IMAGE SRC
		playBtn.classList.remove('play-icon-shape');
		playBtn.classList.add('pause-icon-shape');
		
		if (audioCtx.state === 'suspended') audioCtx.resume();

  		isPlaying = true;
		beatCount  = 0; // reset on every play start
  		const start = performance.now();
		
		let lastSide = null;
		const ENDPOINT_THRESHOLD = 0.85; // trigger click near endpoint (0-1)


  		function frame(now){
    		if (!isPlaying) return;

			const spb = 60 / clamp(currentBPM, BPM_MIN, BPM_MAX);
			const periodMs = (2 * spb) * 1000;

			const t = ((now - start) % periodMs) / periodMs;
			const s = Math.sin(t * Math.PI * 2);

			const swingDeg = bpmToAmplitude(currentBPM); // <-- dynamic amplitude
			const angle = s * swingDeg;
			currentAngle = angle;

			rotator.style.transform = `rotate(${angle}deg)`;
			// Detect endpoint and play click
			if (Math.abs(s) > ENDPOINT_THRESHOLD) {
				const currentSide = s > 0 ? 'right' : 'left';

				if (currentSide !== lastSide) {
					lastSide = currentSide;
					beatCount++;
					const isStrong = (beatCount % getBeatInterval() === 0);
					playClick(isStrong);
				}
			}
			rafId = requestAnimationFrame(frame);
		}

  		rafId = requestAnimationFrame(frame);
	}

	function stopSwing(){
  		isPlaying = false;
		
		// TOGGLE CSS SHAPES BACK TO PLAY
		playBtn.classList.remove('pause-icon-shape');
		playBtn.classList.add('play-icon-shape');
		
  		if (rafId) cancelAnimationFrame(rafId);
  		rafId = null;

  		// Return quickly with a short ease-out instead of snapping.
  		if (rotator) {
			if (returnTimer) {
				clearTimeout(returnTimer);
				returnTimer = null;
			}

			rotator.style.transition = `transform ${RETURN_TO_CENTER_MS}ms cubic-bezier(0.22, 1, 0.36, 1)`;
			rotator.style.transform = 'rotate(0deg)';

			returnTimer = setTimeout(() => {
				rotator.style.transition = 'none';
				currentAngle = 0;
				returnTimer = null;
			}, RETURN_TO_CENTER_MS + 30);
  		}
	}
	
	if (playBtn) {
  		playBtn.style.cursor = 'pointer';
  		playBtn.addEventListener('click', () => {
    		if (!isPlaying) startSwing();
    		else stopSwing();
  		});
	}

  	function clamp(v, min, max){ return Math.max(min, Math.min(max, v)); }
	
	function topToBPM (topPx, maxTop) {
		if(maxTop <= 0)	return BPM_MIN;
		const t = clamp(topPx / maxTop, 0, 1);
		const bpm = Math.round(BPM_MIN + t * (BPM_MAX - BPM_MIN));
		return bpm;
	}
	
	function bpmToTop(bpm, maxTop) {
		const clampedBpm = clamp(bpm, BPM_MIN, BPM_MAX);
		const ratio = (clampedBpm - BPM_MIN) / (BPM_MAX - BPM_MIN);
		return ratio * maxTop;
	}
	
	function setBPM(bpm) {
		bpm = clamp(bpm, BPM_MIN, BPM_MAX);
		bpmLabel.textContent = bpm;
		
		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();
		const maxTop = needleRect.height - weightRect.height;
		
		const newTop = bpmToTop(bpm, maxTop);
		weight.style.top = newTop + 'px';
	}
	
	function updateBPM (newValue) {
		currentBPM = clamp(newValue, BPM_MIN, BPM_MAX);
		setBPM(currentBPM);
	}

  	function setWeightTop(px){
		weight.style.top = px + 'px';
		// optional: accessibility value
		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();
		const maxTop = needleRect.height - weightRect.height;
		
		currentBPM = topToBPM(px, maxTop);
		setBPM(currentBPM);
  	}

  	function onPointerDown(e){
		dragging = true;
		pointerId = e.pointerId;
		weight.setPointerCapture(pointerId);
  	}

  	function onPointerMove(e){
    	if (!dragging || e.pointerId !== pointerId) return;

		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();

		// pointer Y relative to the needle container:
		const y = e.clientY - needleRect.top;

		// We want the weight centered at pointer Y:
		let top = y - (weightRect.height / 2);

		// Clamp inside needle bounds:
		const minTop = 0;
		const maxTop = needleRect.height - weightRect.height;
		top = clamp(top, minTop, maxTop);

		setWeightTop(top);
  	}

  	function onPointerUp(e){
		if (e.pointerId !== pointerId) return;
		dragging = false;
		pointerId = null;
  	}

  	weight.addEventListener('pointerdown', onPointerDown);
  	window.addEventListener('pointermove', onPointerMove);
  	window.addEventListener('pointerup', onPointerUp);
	
	function registerTap() {
		const now = performance.now();
		
		if(tapTimes.length && (now - tapTimes[tapTimes.length - 1]) > TAP_RESET_MS) {
			tapTimes = [];
		}
		
		tapTimes.push(now);
		if(tapTimes.length > MAX_TAPS)	tapTimes.shift();
		
		if(tapTimes.length < 2)	return;
		
		const intervals = [];
		for(let i =1; i < tapTimes.length; i++) {
			intervals.push(tapTimes[i] - tapTimes[i - 1]);
		}
		
		const avg = intervals.reduce((a, b) => a+b, 0) / intervals.length;
		
		const bpm = Math.round(60000 / avg);
		
		updateBPM(bpm);
	}
	
	if(tapBtn) {
		tapBtn.style.cursor = 'pointer';
		tapBtn.addEventListener('click', registerTap);
	}
	
	window.addEventListener('keydown', e => {
		const isSpace = (e.code === 'Space' || e.key === ' ');
		
		if(!isSpace)	return;
		
		if(e.repeat)	return;
		
		tapBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tap-active.svg";
		e.preventDefault();
		
		registerTap();
	}, { passive: false});
	
	window.addEventListener('keyup', e => {
		if(e.code === 'Space')
			tapBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tap-inactive.svg";
	});

  	window.addEventListener('load', () => {
		ensureNeedleLayout();
		const needleRect = needle.getBoundingClientRect();
		const weightRect = weight.getBoundingClientRect();
		const maxTop = needleRect.height - weightRect.height;
		setWeightTop(Math.max(0, maxTop * 0.5));
  	});
	
	minusBtn.addEventListener('click', () => {
		updateBPM(currentBPM - 1);
	});
	
	plusBtn.addEventListener('click', () => {
		updateBPM(currentBPM + 1);
	});
	
	minusBtn.onmousedown = () => {
		minusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/minus-active.svg"
	}
	
	minusBtn.onmouseleave = () => {
		minusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/minus-inactive.svg"
	}
	
	minusBtn.onmouseup = () => {
		minusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/minus-inactive.svg"
	}
	
	plusBtn.onmousedown = () => {
		plusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/plus-active.svg"
	}
	
	plusBtn.onmouseleave = () => {
		plusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/plus-inactive.svg"
	}
	
	plusBtn.onmouseup = () => {
		plusBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/plus-inactive.svg"
	}
	
	tapBtn.onmousedown = () => {
		tapBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tap-active.svg"
	}
	
	tapBtn.onmouseleave = () => {
		tapBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tap-inactive.svg"
	}
	
	tapBtn.onmouseup = () => {
		tapBtn.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tap-inactive.svg"
	}
})();
</script>

<?php get_footer();