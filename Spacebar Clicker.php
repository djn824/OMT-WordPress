<?php 
/* Template Name:Spacebar Clicker */
get_header();?>
<style media="screen">
  #wrap {
    position: fixed;
        inset: 0;
    }
    canvas {
        width: 100%;
        height: 100%;
        display: block;
        background: #ffffff;
    }
    .hud {
        position: fixed;
        left: 50%;
    top: 22px;
        transform: translateX(-50%);
        text-align: center;
        user-select: none;
        pointer-events: none;
        color: rgba(0,0,0,0.72);
        line-height: 1.15;
    }
    .hud .title {
        font-weight: 600;
        letter-spacing: 0.2px;
        font-size: 16px;
    }
    .hud .sub {
        font-weight: 400;
        font-size: 13px;
        opacity: 0.85;
    }
    .chip {
        display: inline-block;
        margin-top: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        border: 1px solid rgba(0,0,0,0.1);
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(6px);
        font-size: 12px;
        opacity: 0.9;
    }
	.ring-embed{
		position: relative;
  		width: 100%;
	  	height: 420px;
	  	max-width: 900px;
	  	margin: 0 auto;
	  	background: transparent;
	  	overflow: visible;
	}
	#ringCanvas{
		position: absolute;
	  	left: 0;
	  	width: 100%;
	  	height: calc(100% + 360px); /* extra fire headroom (top+bottom) */
	  	top: -160px;               /* half of extra height */
		display: block;
	  	background: transparent !important;
		touch-action: manipulation;
	}
	.ring-hud{
		position: absolute;
      	top: 12px;
      	left: 50%;
      	transform: translateX(-50%);
      	font-family: "Raleway", sans-serif;
      	font-size: 12px;
      	padding: 6px 10px;
      	border-radius: 999px;
      	border: 1px solid rgba(0,0,0,0.1);
      	background: rgba(255,255,255,0.7);
      	backdrop-filter: blur(6px);
      	pointer-events: none;
      	color: rgba(0,0,0,0.7);
	}
	.circle-box {
		margin-top: 150px;
		margin-bottom: 150px;
	}
	
	
	.cps-box{
		position: absolute;
	  	top: 14px;
	  	right: 14px;
	  	z-index: 5;

	  	width: 230px;
	  	padding: 10px 12px;

	  	border-radius: 14px;
	  	border: 1px solid #4A6B8A;
	  	background: rgba(255,255,255,0.78);
	  	backdrop-filter: blur(8px);

	  	font-family: "Raleway", sans-serif;
	  	color: #4A6B8A;
	  	user-select: none;
	  	pointer-events: none;

	  	box-shadow: 0 10px 26px rgba(0,0,0,0.08);
	}

	.cps-title{
	  	font-size: 17px;
	  	font-weight: 700;
	  	letter-spacing: 0.2px;
	  	margin-bottom: 8px;
	  	color: #4A6B8A;
	}

	.cps-row{
	  	display: flex;
	  	justify-content: space-between;
	  	align-items: baseline;
	  	margin-top: 4px;
	}

	.cps-label{
	  	font-size: 16px;
	  	opacity: 0.75;
	}

	.cps-value{
	  	font-size: 23px;
	  	font-weight: 800;
	  	letter-spacing: 0.2px;
	  	line-height: 1;
	}
	@media (max-width: 991px){
		.circle-box{
			margin-top: 90px;
			margin-bottom: 90px;
		}
		.ring-embed{
			height: 360px;
		}
		.cps-box{
			width: 200px;
			padding: 9px 10px;
		}
	}
	@media (max-width: 767px){
		.circle-box{
			margin-top: 56px;
			margin-bottom: 56px;
		}
		.ring-embed{
			height: 300px;
			max-width: 100%;
		}
		#ringCanvas{
			height: calc(100% + 240px);
			top: -100px;
		}
		.cps-box{
			left: 60%;
			right: auto;
			transform: translateX(-50%);
			top: -30px;
			width: min(92vw, 240px);
		}
		.cps-title{
			font-size: 15px;
		}
		.cps-label{
			font-size: 14px;
		}
		.cps-value{
			font-size: 20px;
		}
	}

</style>

<div class="container-fluid">
	<div class="circle-box">
		<div class="ring-embed my-4">
  			<canvas id="ringCanvas"></canvas>
			
			<div class="cps-box" id="cpsBox">
    			<div class="cps-title"><?php the_field("clicks_box_title");?></div>
    			<div class="cps-row">
      				<span class="cps-label"><?php the_field("current_label");?>:</span>
      				<span class="cps-value" id="cpsCurrent">0.0</span>
    			</div>
    			<div class="cps-row">
      				<span class="cps-label"><?php the_field("maximum_label");?>:</span>
      				<span class="cps-value" id="cpsMax">0.0</span>
    			</div>
  			</div>
		</div>
	</div>
	
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
</article>
</div>
</div>

<script>
	(function () {
		const canvas = document.getElementById("ringCanvas");
		const ctx = canvas.getContext("2d");
		const hud = document.getElementById("ringHud");
	  	const OUTER_PAD = 6;
		const cpsCurrentEl = document.getElementById("cpsCurrent");
		const cpsMaxEl = document.getElementById("cpsMax");

		function resizeCanvasToContainer() {
			const rect = canvas.getBoundingClientRect();
			const dpr = Math.max(1, Math.min(2, window.devicePixelRatio || 1));

			canvas.width  = Math.floor(rect.width * dpr);
			canvas.height = Math.floor(rect.height * dpr);
  
		  	// draw in CSS pixels
		  	ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    	}

    	window.addEventListener("resize", resizeCanvasToContainer);
    	resizeCanvasToContainer();
    
		function clamp01(x){ return Math.max(0, Math.min(1, x)); }

		function lerp(a,b,t){ return a + (b-a)*t; }

		function hexToRgb(hex){
			const h = hex.replace("#","");
        	return {
				r: parseInt(h.slice(0,2),16),
				g: parseInt(h.slice(2,4),16),
				b: parseInt(h.slice(4,6),16)
	        };
    	}

    	function lerpRgb(c1, c2, t){
      		return {
        		r: Math.round(lerp(c1.r, c2.r, t)),
          		g: Math.round(lerp(c1.g, c2.g, t)),
          		b: Math.round(lerp(c1.b, c2.b, t))
        	};
    	}

		// --- brand + transition palette ---
		const OMT_BLUE   = hexToRgb("#4A6B8A");   // OMT blue
		const BLUE_GREEN = hexToRgb("#2FA9A2");   // blue/green (teal-ish)
		const GREEN      = hexToRgb("#2DBE62");   // green
		const GREEN_YELL = hexToRgb("#A7D84B");   // green/yellow
		const YELLOW     = hexToRgb("#FFD84A");   // yellow
		const YELL_ORNG  = hexToRgb("#FFB13A");   // yellow/orange
		const OMT_ORANGE = hexToRgb("#E35D26");   // OMT orange
		const ORNG_RED   = hexToRgb("#FF4A2F");   // orange/red
		const RED        = hexToRgb("#FF2A2A");   // red
    
    	// --- State ---
		const state = {
      		tapStreak: 0,        // number of taps in the current streak
      		lastTapAt: 0,
			// rotation for outer ring only
			angle: 0,
			angVel: 0,

			// growth: 1.0 baseline; can grow huge
			scale: 1,
			scaleVel: 0,

			// tapping / rate
			tapTimes: [],          // timestamps (ms) of taps
			tapsPerSec: 0,
			targetAngVel: 0,

			// fire intensity & persistence
			fire: 0,               // 0..1
			fireTarget: 0,
			fireAfterglow: 0,      // keeps it alive briefly after stopping taps
			lastTapAt: 0,

			// animation time
			t: 0,
			energy: 0,
			overEnergy: 0,
			growthPct: 0,
			
// 			cpsRaw: 0,
// 			cpsSmooth: 0,
// 			maxCps: 0.state
			
			cpsTimes: [],   // timestamps used ONLY for CPS
			cpsRaw: 0,
			cpsSmooth: 0,
			maxCps: 0,
			swirlTimer: 0, 
			_geom: null
		};

		const clamp = (v, a, b) => Math.max(a, Math.min(b, v));

		function rgb(r,g,b,a=1){ return `rgba(${r|0},${g|0},${b|0},${a})`; }
      	function hsl(h,s,l,a=1){ return `hsla(${h},${s}%,${l}%,${a})`; }

      	// Map tap rate to "speed factor" 0..1
      	// tweak these to taste
      	const RATE_MIN = 0.5;   // taps/s considered "barely"
      	const RATE_MAX = 10.0;  // taps/s considered "insane fast"
      	function rateTo01(rate){
        	return clamp((rate - RATE_MIN) / (RATE_MAX - RATE_MIN), 0, 1);
      	}
		
		function strokeTaperedPath(px, steps, startW, endW, alphaMul = 1, startI = 0, endI = steps) {
			// draws small segments with decreasing lineWidth (smooth taper)
		  	for (let i = startI; i < endI; i++) {
				const t0 = i / steps;
				const t1 = (i + 1) / steps;

				// ease so taper feels natural (slower at start, faster near end)
				const e0 = 1 - Math.pow(t0, 1.35);
				const e1 = 1 - Math.pow(t1, 1.35);

				const w0 = endW + (startW - endW) * e0;
				const w1 = endW + (startW - endW) * e1;

				// use average width for this short segment
				ctx.lineWidth = (w0 + w1) * 0.5;

				const idx0 = i * 2;
				const idx1 = (i + 1) * 2;

				ctx.beginPath();
				ctx.moveTo(px[idx0], px[idx0 + 1]);
				ctx.lineTo(px[idx1], px[idx1 + 1]);
				ctx.stroke();
			}
		}
		
		const CPS_WINDOW_MS = 1000;

		function updateCps(now, dt){
			// keep only taps within the last window
  while (state.cpsTimes.length && state.cpsTimes[0] < now - CPS_WINDOW_MS) {
    state.cpsTimes.shift();
  }

  // Fixed-window CPS: count / windowSeconds
  state.cpsRaw = state.cpsTimes.length / (CPS_WINDOW_MS / 1000);

  // Smooth (fast but stable)
  const SMOOTH = 10.0; // slightly less twitchy than 14
  state.cpsSmooth += (state.cpsRaw - state.cpsSmooth) * (1 - Math.exp(-SMOOTH * dt));

  // max should usually follow smooth, not raw (prevents 1-frame spikes)
  state.maxCps = Math.max(state.maxCps, state.cpsSmooth);
		}

      	function speedToHue01(s01){
        	if (s01 < 0.35) {
            	const t = s01 / 0.35;
            	return lerp(205, 140, t);
        	} else if (s01 < 0.7) {
				const t = (s01 - 0.35) / 0.35;
				return lerp(140, 55, t);
			} else {
				const t = (s01 - 0.7) / 0.3;
				return lerp(55, 28, t);
			}
      	}

		const particles = [];
      	const MAX_PARTICLES = 2200;
	  
	  	const stream = [];
		const MAX_STREAM = 650; // keep it lighter than main particles
		
		// ======================
		// STRONG FIRE SWIRLS
		// ======================
		const swirls = [];
		const SWIRL_LIFE = 1.0; // seconds (you asked: 1s fade)

		function clamp01(x){ return Math.max(0, Math.min(1, x)); }
		function lerp(a,b,t){ return a + (b-a)*t; }

		function swirlParamsFromCps(cps){
			const c = Math.max(6, Math.min(10, cps));

		  	let minI, maxI, minS, maxS;

		  	if (c <= 8) {
				// 6 -> 8 mapping (EXACT targets)
				const t = (c - 6) / 2; // 0..1
				minI = lerp(0.9, 0.6, t);
				maxI = lerp(1.1, 0.8, t);
				minS = lerp(2, 3, t);
				maxS = lerp(2, 4, t);
		  	} else {
				// 8 -> 10 mapping (EXACT targets)
				const t = (c - 8) / 2; // 0..1
				minI = lerp(0.6, 0.4, t);
				maxI = lerp(0.8, 0.6, t);
				minS = lerp(3, 4, t);
				maxS = lerp(4, 5, t);
		  	}

		  	// Convert max swirl range to an integer cap that preserves "3–4" and "4–5"
		  	// (probabilistic rounding so you actually get a range, not a single number)
		  	const lo = Math.floor(minS);
		  	const hi = Math.ceil(maxS);
		  	const maxCap = (Math.random() < (maxS - Math.floor(maxS))) ? hi : lo;

		  	return { minI, maxI, maxS: Math.max(2, maxCap) };
		}

		function spawnFireSwirl(cx, cy, ringOuterR, w, h, cps){
			const tHot = clamp01((cps - 6) / 4);

		  	// placement around circle
		  	const ang = Math.random() * Math.PI * 2;
		  	const minR = ringOuterR + 55;
		  	const maxR = Math.min((Math.min(w, h) * 0.5) - 35, ringOuterR + 220);
		  	const r = minR + Math.random() * Math.max(40, (maxR - minR));

		  	let x = cx + Math.cos(ang) * r;
		  	let y = cy + Math.sin(ang) * r;
		  	x = Math.max(40, Math.min(w - 40, x));
		  	y = Math.max(40, Math.min(h - 40, y));

		  	const scale = lerp(0.55, 0.95, tHot) * (0.85 + Math.random() * 0.3);
		  	const hue = Math.random() * 360;

		  	// spiral resolution (lower = faster, still smooth)
		  	const steps = 34 + Math.floor(Math.random() * 10); // ~42-56 (was 64-86)
		  	const turns = 1.15 + Math.random() * 0.75;
		  	const baseR = 10 + Math.random() * 14;
		  	const growR = 60 + Math.random() * 110;
		  	const ribbon = 12 + Math.random() * 12;

		  	// stable jitter
		  	const jitter = new Float32Array(steps + 1);
		  	const jitter2 = new Float32Array(steps + 1);
		  	let v = (Math.random() * 2 - 1);
		  	let v2 = (Math.random() * 2 - 1);
		  	for (let i = 0; i <= steps; i++){
				v  = v  * 0.86 + (Math.random() * 2 - 1) * 0.14;
				v2 = v2 * 0.86 + (Math.random() * 2 - 1) * 0.14;
				jitter[i]  = v;
				jitter2[i] = v2;
		  	}

		  	// Pre-seed tongues + embers ONCE (no per-frame random loops)
		  	const tongueCount = Math.floor(10 + 14 * lerp(1.0, 1.6, tHot));
		  	const tongues = new Array(tongueCount);
		  	for (let k=0;k<tongueCount;k++){
				tongues[k] = {
			  		t: clamp01(0.18 + Math.random() * 0.78),
			  		len: (10 + Math.random() * 24) * (0.85 + 0.5 * tHot),
			  		wid: (4 + Math.random() * 9) * (0.85 + 0.4 * tHot),
			  		ph: Math.random() * Math.PI * 2
				};
		  	}

		  	const emberCount = Math.floor(12 + 18 * lerp(1.0, 1.7, tHot));
		  	const embers = new Array(emberCount);
		  	for (let e=0;e<emberCount;e++){
				embers[e] = {
			  		t: clamp01(0.10 + Math.random() * 0.90),
			  		off: (Math.random() * 18 - 9),
			  		r: (1.6 + Math.random() * 3.0),
			  		ph: Math.random() * Math.PI * 2
				};
		  	}

		  	swirls.push({
				x, y,
				age: 0,
				life: SWIRL_LIFE,

				steps, turns, baseR, growR, ribbon,
				rot0: Math.random() * Math.PI * 2,
				rotVel: (Math.random() < 0.5 ? -1 : 1) * lerp(2.8, 7.5, tHot),
				flow: lerp(8.5, 15.5, tHot),

				hue, scale,
				jitter, jitter2,

				tongues,
				embers,

				// cached points buffer (reused every frame)
				px: new Float32Array((steps + 1) * 2),
				pa: new Float32Array(steps + 1),   // angle per step
				pt: new Float32Array(steps + 1),   // t per step

				power: lerp(1.0, 1.65, tHot)
			});
		}

		function updateSwirls(dt){
			for (let i = swirls.length - 1; i >= 0; i--){
				const s = swirls[i];
				s.age += dt;
				if (s.age >= s.life) swirls.splice(i, 1);
		  	}
		}

		function drawSwirls(time){
		  	for (const s of swirls) drawOneFireVortexFast(s, time);
		}
		
		function strokeTaperNoBlur(px, steps, startW, endW, alphaMul = 1, startT = 0, endT = 1) {
		  	const startI = Math.max(0, Math.floor(steps * startT));
		  	const endI   = Math.min(steps, Math.ceil(steps * endT));

		  	// draw short segments with varying width
		  	// IMPORTANT: caller must set shadowBlur = 0 for this to be cheap
		  	for (let i = startI; i < endI; i++) {
				const t = i / steps;

				// smooth taper curve (tune exponent to taste)
				const k = 1 - Math.pow(t, 1.6);
				const w = endW + (startW - endW) * k;

				ctx.globalAlpha *= alphaMul;
				ctx.lineWidth = w;

				const idx0 = i * 2;
				const idx1 = (i + 1) * 2;

				ctx.beginPath();
				ctx.moveTo(px[idx0], px[idx0 + 1]);
				ctx.lineTo(px[idx1], px[idx1 + 1]);
				ctx.stroke();

				// restore alpha multiplier without save/restore (fast)
				ctx.globalAlpha /= alphaMul;
		  	}
		}

		// ---- optimized draw (single point build, fewer heavy blurs) ----
		function drawOneFireVortexFast(s, time){
			const u = s.age / s.life;
		  	const fade = 1 - u;

		  	const appear = clamp01(u / 0.10);
		  	const a = appear * (fade * fade);
		  	const P = s.power;

		  	const rot = s.rot0 + s.rotVel * s.age;

		  	// build points ONCE per frame
		  	const steps = s.steps;
		  	const flow = s.flow;

		  	const wob1 = Math.sin(time * flow + 1.17) * 0.65;
		  	const wob2 = Math.cos(time * (flow * 0.83) + 2.41) * 0.65;

		  	for (let i=0;i<=steps;i++){
				const t = i / steps;
				const ang = t * Math.PI * 2 * s.turns;

				const j  = s.jitter[i]  * (1 - t) * 6.0;
				const j2 = s.jitter2[i] * (1 - t) * 4.2;

				const flamePush = (Math.sin(ang * 1.7 + time * flow) * 3.0 + wob1 * 2.5) * (0.35 + 0.65 * (1 - t));
				const rad = s.baseR + s.growR * t + j + flamePush;

				const side = (Math.cos(ang * 2.1 + time * (flow * 0.9)) * 2.2 + wob2 * 2.0) * (0.30 + 0.70 * (1 - t));

				const x = Math.cos(ang) * rad + (-Math.sin(ang)) * side;
				const y = Math.sin(ang) * rad + ( Math.cos(ang)) * side;

				const idx = i * 2;
				s.px[idx] = x;
				s.px[idx+1] = y;
				s.pa[i] = ang;
				s.pt[i] = t;
		  	}

			const path = new Path2D();
			path.moveTo(s.px[0], s.px[1]);
			for (let i = 1; i <= steps; i++) {
		  		const idx = i * 2;
		  		path.lineTo(s.px[idx], s.px[idx + 1]);
			}

			ctx.save();
		  	ctx.translate(s.x, s.y);
		  	ctx.rotate(rot);
		  	ctx.scale(s.scale, s.scale);

		  	ctx.globalCompositeOperation = "lighter";
		  	ctx.lineCap = "round";
		  	ctx.lineJoin = "round";

			const tailStartT = 0.78;                      // where tail begins (0..1)
			const tailStartIdx = Math.max(2, Math.floor(steps * tailStartT));

			// PASS 2: main ribbon (ONE stroke only)
			ctx.save();
			ctx.globalAlpha = 0.52 * a * P;          // slightly lower to avoid banding
			ctx.shadowBlur = 14 * P;                // less “beam”
			ctx.shadowColor = `hsla(${s.hue}, 100%, 62%, 1)`;
			ctx.strokeStyle = `hsla(${s.hue}, 100%, 58%, 0.92)`;
			ctx.lineWidth = (s.ribbon * 0.62) * P;
			ctx.stroke(path);
			ctx.restore();

			// PASS 2.5: tapered core (NO shadow blur = cheap)
			ctx.save();
			ctx.shadowBlur = 0; // critical for performance
			ctx.globalAlpha = 0.62 * a * P;
			ctx.strokeStyle = `hsla(${Math.min(60, s.hue + 18)}, 100%, 68%, 0.95)`;

			// taper across the whole path
			strokeTaperNoBlur(
				s.px,
			  	steps,
			  	(s.ribbon * 0.42) * P,  // start thickness
			  	(s.ribbon * 0.06) * P,  // end thickness (very thin)
			  	1.0,
			  	0.0,
			  	1.0
			);

			ctx.restore();

		  	// PASS 3: hot head core (no shadow blur)
		  	ctx.save();
		  	ctx.globalAlpha = 0.78 * a * P;
		  	ctx.shadowBlur = 0;
		  	ctx.strokeStyle = `hsla(${Math.min(60, s.hue + 22)}, 100%, 74%, 0.95)`;
		  	ctx.lineWidth = Math.max(2.2, (s.ribbon * 0.22) * P);

		  	ctx.beginPath();
		  	for (let i=0;i<=steps;i++){
				if (s.pt[i] > 0.72) break;
				const idx = i * 2;
				const x = s.px[idx], y = s.px[idx+1];
				if (i===0) ctx.moveTo(x,y); else ctx.lineTo(x,y);
		  	}
		  	ctx.stroke();
		  	ctx.restore();

		  	// Flame tongues (pre-seeded)
		  	ctx.save();
		  	ctx.globalAlpha = 0.38 * a * P;
		  	ctx.shadowBlur = 14 * P;
		  	ctx.shadowColor = `hsla(${s.hue}, 100%, 60%, 1)`;

		  	for (let k=0;k<s.tongues.length;k++){
				const tg = s.tongues[k];

				const i = Math.min(steps, Math.max(0, Math.floor(tg.t * steps)));
				const idx = i * 2;

				const x = s.px[idx], y = s.px[idx+1];
				const ang = s.pa[i];
				const t = s.pt[i];

				const nx = Math.cos(ang);
				const ny = Math.sin(ang);

				const flick = 0.78 + 0.22 * Math.sin(time * (6.0 + P) + tg.ph);
				const len = tg.len * (0.55 + 0.75 * (1 - t)) * flick;
				const hue2 = lerp(s.hue + 6, s.hue - 6, t);

				ctx.fillStyle = `hsla(${hue2}, 100%, ${lerp(70, 55, t)}%, ${0.55 * flick})`;

				ctx.beginPath();
				ctx.moveTo(x, y);
				ctx.quadraticCurveTo(x + nx * (len * 0.55), y + ny * (len * 0.55), x + nx * len, y + ny * len);
				ctx.quadraticCurveTo(x - nx * (len * 0.25), y - ny * (len * 0.25), x, y);
				ctx.closePath();
				ctx.fill();
		  	}
		  	ctx.restore();

		  	// Embers (pre-seeded, light)
		  	ctx.save();
		  	ctx.globalAlpha = 0.32 * a * P;

		  	for (let e=0;e<s.embers.length;e++){
				const em = s.embers[e];
				const i = Math.min(steps, Math.max(0, Math.floor(em.t * steps)));
				const idx = i * 2;
				const x = s.px[idx], y = s.px[idx+1];
				const ang = s.pa[i];
				const t = s.pt[i];

				const off = em.off * (0.6 + 0.7 * (1 - t)) * P;
				const ox = -Math.sin(ang) * off;
				const oy =  Math.cos(ang) * off;

				const r = em.r * (0.65 + 0.85 * (1 - t)) * P;

				const eh = lerp(s.hue, Math.min(60, s.hue + 22), (1 - t));
				ctx.fillStyle = `hsla(${eh}, 100%, ${lerp(74, 58, t)}%, 0.85)`;

				ctx.beginPath();
				ctx.arc(x + ox, y + oy, r, 0, Math.PI * 2);
				ctx.fill();
		  	}
		  	ctx.restore();

		  	ctx.restore();
		  	ctx.globalCompositeOperation = "source-over";
		}

		function spawnStream(dt, cx, cy, ringInnerR, ringOuterR, s01, growthPct) {
			const intensity = state.fire;
  			if (intensity <= 0.001) return;

  			const streamLen = (ringOuterR - ringInnerR) * 0.33 + 22 * intensity;

		  	const emitRate = lerp(12, 140, intensity) * (0.55 + 0.85 * s01); // /sec
		  	const toEmit = emitRate * dt;

		  	const whole = Math.floor(toEmit);
		  	const frac = toEmit - whole;
		  	const count = whole + (Math.random() < frac ? 1 : 0);

		  	for (let i = 0; i < count; i++) {
				if (stream.length >= MAX_STREAM) break;

				const theta = state.angle + (Math.random() - 0.5) * 0.55;

				const r0 = ringOuterR + lerp(2, 10, Math.random());
				const x0 = cx + Math.cos(theta) * r0;
				const y0 = cy + Math.sin(theta) * r0;

				const vr = lerp(120, 520, intensity) * (0.65 + 0.6 * s01) * (0.75 + Math.random() * 0.6);

				const vtBase = Math.max(120, Math.abs(state.angVel) * r0 * 0.35);
				const vt = (Math.random() < 0.5 ? -1 : 1) * vtBase * (0.8 + 0.6 * Math.random());

				const life = lerp(0.18, 0.55, intensity) * (0.85 + Math.random() * 0.5);

				const size = lerp(2.2, 7.5, intensity) * (0.75 + Math.random() * 0.8);

				// hue: force it hotter (yellowish), especially near max
				// 55 ~ yellow, but blend slightly toward orange for depth
				const hot = 55;
				const warm = 38;
				const z = clamp01(0.35 + 0.65 * intensity);
				const hue = lerp(warm, hot, z);

				stream.push({
					theta,
				  	r: r0,
				  	vr,
				  	vt,

				  	cx, cy,

				  	life,
				  	age: 0,
				  	size,
				  	hue,
				  	alpha: 1,

				  	rMax: r0 + streamLen
				});
			}
		}
		
		function updateStream(dt) {
			for (let i = stream.length - 1; i >= 0; i--) {
				const p = stream[i];
    			p.age += dt;
    			if (p.age >= p.life) {
      				stream.splice(i, 1);
      				continue;
    			}

				// fade
				const u = p.age / p.life;
				p.alpha = (1 - u);

				// keep it spinning with the ring:
				// - add ring rotation to its own theta
				// - plus its tangential velocity contribution
				const spinCouple = 0.85; // 0..1 (how tightly it follows the ring)
				p.theta += state.angVel * dt * spinCouple;

				// tangential drift (spiral feel)
				const safeR = Math.max(1, p.r);
				p.theta += (p.vt / safeR) * dt;

				// radial travel outward, but clamp to rMax (short stream)
				p.r += p.vr * dt;
				if (p.r > p.rMax) {
					// after reaching max, fade faster and kill soon
				  	p.alpha *= 0.55;
				  	p.r = p.rMax;
				  	p.vr *= 0.2;
				  	p.vt *= 0.85;
				}

				// damping
				p.vr *= Math.pow(0.90, dt * 60);
				p.vt *= Math.pow(0.93, dt * 60);  
			}	
		}

		function drawStream() {
			ctx.save();
		  	ctx.globalCompositeOperation = "lighter";
		  	ctx.lineCap = "round";

			for (const p of stream) {
				const u = p.age / p.life;
				const fade = p.alpha;

				const x = p.cx + Math.cos(p.theta) * p.r;
				const y = p.cy + Math.sin(p.theta) * p.r;

				// “blazing” look: draw a short streak opposite the motion direction
				const streak = p.size * (3.2 + 2.4 * (1 - u));
				const tx = -Math.sin(p.theta);
				const ty =  Math.cos(p.theta);

				// hot core
				ctx.beginPath();
				ctx.fillStyle = hsl(p.hue, 98, 62, 0.34 * fade);
				ctx.arc(x, y, p.size * 0.95, 0, Math.PI * 2);
				ctx.fill();

				// halo
				ctx.beginPath();
				ctx.fillStyle = hsl(p.hue, 98, 60, 0.12 * fade);
				ctx.arc(x, y, p.size * 2.9, 0, Math.PI * 2);
				ctx.fill();

				// streak ribbon (this makes it feel like a rotating stream)
				ctx.beginPath();
				ctx.strokeStyle = hsl(p.hue, 98, 64, 0.22 * fade);
				ctx.lineWidth = Math.max(1.5, p.size * 0.55);
				ctx.moveTo(x, y);
				ctx.lineTo(x - tx * streak, y - ty * streak);
				ctx.stroke();
			}

		  	ctx.restore();
		  	ctx.globalCompositeOperation = "source-over";
		}

		function fireHueFromState(s01, growthPct) {
			// normal: hue driven by speed
			const speedHue = speedToHue01(s01);

			// when pure red (near max size), force fire hue to yellow
			const redZone = (growthPct >= 0.90) ? clamp01((growthPct - 0.90) / 0.10) : 0;

			// yellow hue ~ 55
			const YELLOW_HUE = 55;

			// blend toward yellow as we enter pure red zone
			return lerp(speedHue, YELLOW_HUE, redZone);
		}

		function spawnParticles(dt, cx, cy, innerR, outerR, s01, growthPct) {
			// emission depends on current fire and tap rate
			const intensity = state.fire; // 0..1
			if (intensity <= 0.001) return;

		  	// how many to emit this frame
		  	const emitRate = lerp(20, 500, intensity) * (0.5 + s01); // particles/sec
		  	const toEmit = emitRate * dt;

		  	let n = toEmit;
		  	// handle fractional emission smoothly
		  	const whole = Math.floor(n);
		  	const frac = n - whole;
		  	const count = whole + (Math.random() < frac ? 1 : 0);

		  	for (let i = 0; i < count; i++) {
				if (particles.length >= MAX_PARTICLES) break;

				const a = Math.random() * Math.PI * 2;
				const ringR = lerp(innerR, outerR, 0.92 + Math.random() * 0.08);

				// Spawn on/near the outer ring edge, then shoot outward along normal
				const x = cx + Math.cos(a) * ringR;
				const y = cy + Math.sin(a) * ringR;

				// outward direction + some chaos
				const nx = Math.cos(a);
				const ny = Math.sin(a);

				const chaos = (1 - s01) * 0.6 + 0.25;
				const dx = nx + (Math.random() - 0.5) * chaos;
				const dy = ny + (Math.random() - 0.5) * chaos;

				// speed depends on intensity and speed
				const sp = lerp(80, 900, intensity) * (0.6 + 0.7 * s01) * (0.7 + Math.random()*0.6);

				const vx = dx * sp;
				const vy = dy * sp;

				// lifetime longer when you keep pressing
				const life = lerp(0.25, 1.15, intensity) * (0.7 + Math.random()*0.7);

				// size & glow
				const size = lerp(1.0, 6.0, intensity) * (0.6 + Math.random()*0.8);

				// warmness based on speed
				const hue = fireHueFromState(s01, growthPct);
				particles.push({
					x, y, vx, vy,
				  	life, age: 0,
				  	size,
				  	hue,
				  	// a second "hot core" brightness
				  	core: 0.6 + Math.random()*0.4
				});
			}
		}

		function updateParticles(dt) {
			for (let i = particles.length - 1; i >= 0; i--) {
				const p = particles[i];
				p.age += dt;
				if (p.age >= p.life) {
				  particles.splice(i, 1);
				  continue;
				}

				// drag + slight upward curl (planet explosion vibe)
				const drag = 0.88;
				p.vx *= Math.pow(drag, dt*60);
				p.vy *= Math.pow(drag, dt*60);

				// subtle swirl
				const swirl = 18;
				const sx = -p.vy * 0.0006 * swirl;
				const sy =  p.vx * 0.0006 * swirl;
				p.vx += sx;
				p.vy += sy;

				// buoyancy a bit (but not too "campfire")
				p.vy -= 18 * dt;

				p.x += p.vx * dt;
				p.y += p.vy * dt;
			}
		}

		function drawParticles() {
			ctx.save();
			ctx.globalCompositeOperation = "lighter";

        	for (const p of particles) {
				const u = p.age / p.life;               // 0..1
				const fade = (1 - u);
				const r = p.size * (0.9 + u*1.6);

				// outer glow
				ctx.beginPath();
				ctx.fillStyle = hsl(p.hue, 95, 60, 0.10 * fade);
				ctx.arc(p.x, p.y, r * 3.2, 0, Math.PI * 2);
				ctx.fill();

				// mid glow
				ctx.beginPath();
				ctx.fillStyle = hsl(p.hue, 95, 55, 0.18 * fade);
				ctx.arc(p.x, p.y, r * 1.8, 0, Math.PI * 2);
				ctx.fill();

				// hot core
				ctx.beginPath();
				ctx.fillStyle = hsl(Math.max(18, p.hue - 10), 98, 62, 0.35 * fade * p.core);
				ctx.arc(p.x, p.y, r * 0.85, 0, Math.PI * 2);
				ctx.fill();
			}

			ctx.restore();
        	ctx.globalCompositeOperation = "source-over";
		}

		function registerPress() {
			const now = performance.now();
			const prevTap = state.lastTapAt || 0;
			state.lastTapAt = now;

			if (prevTap && (now - prevTap) > 900) state.tapStreak = 0;
			state.tapStreak += 1;
			state.cpsTimes.push(now);

			const windowMs = 1250;
			while (state.tapTimes.length && state.tapTimes[0] < now - windowMs) {
				state.tapTimes.shift();
			}

			if (state.tapTimes.length >= 2) {
				const span = (state.tapTimes[state.tapTimes.length - 1] - state.tapTimes[0]) / 1000;
				state.tapsPerSec = span > 0 ? (state.tapTimes.length - 1) / span : state.tapTimes.length;
			} else {
				state.tapsPerSec = 1;
			}

			state.fireAfterglow = 1.0;
		}

		function isInsidePressButton(clientX, clientY) {
			if (!state._geom) return false;

			const rect = canvas.getBoundingClientRect();
			const x = clientX - rect.left;
			const y = clientY - rect.top;

			const dx = x - state._geom.cx;
			const dy = y - state._geom.cy;
			const r = state._geom.innerR || 74;

			return (dx * dx + dy * dy) <= (r * r);
		}

		window.addEventListener("keydown", (e) => {
			if (e.code === "Space") e.preventDefault();
			if (e.code !== "Space") return;
			if (e.repeat) return;
			registerPress();
		});

		canvas.addEventListener("pointerdown", (e) => {
			if (!isInsidePressButton(e.clientX, e.clientY)) return;
			e.preventDefault();
			registerPress();
		}, { passive: false });

		canvas.addEventListener("touchstart", (e) => {
			const touch = e.changedTouches && e.changedTouches[0];
			if (!touch) return;
			if (!isInsidePressButton(touch.clientX, touch.clientY)) return;
			e.preventDefault();
			registerPress();
		}, { passive: false });


		let last = performance.now();
    
		function tick(now) {
			const STOP_THRESHOLD_MS = 170;     // start shrinking almost immediately
			const HOLD_GRACE_MS     = 0;       // no grace
		
      		const dt = Math.min(0.033, (now - last) / 1000);
			
        	const msSinceTap = now - state.lastTapAt;
	      	if (msSinceTap > 220) {
          		const decay = (msSinceTap > 900) ? 6.0 : 2.5; // tweak
          		state.tapStreak *= Math.exp(-decay * dt);
          		if (state.tapStreak < 0.2) state.tapStreak = 0;
      		}
    
      		last = now;

			state.t += dt;

			// Update tap rate window even if no new taps
			const windowMs = 1250;
			while (state.tapTimes.length && state.tapTimes[0] < now - windowMs) {
				state.tapTimes.shift();
			}
			if (state.tapTimes.length >= 2) {
				const span = (state.tapTimes[state.tapTimes.length - 1] - state.tapTimes[0]) / 1000;
				state.tapsPerSec = span > 0 ? (state.tapTimes.length - 1) / span : state.tapTimes.length;
			} else if (state.tapTimes.length === 1) {
			  // if the single tap is old, it decays to 0
			  const age = (now - state.tapTimes[0]) / 1000;
			  state.tapsPerSec = age < 0.6 ? 1 : 0;
			} else {
				state.tapsPerSec = 0;
			}

			updateCps(now, dt);
			state.tapsPerSec = state.cpsSmooth;
			
			const s01 = rateTo01(state.tapsPerSec);
			
			// Update existing swirls
			if (swirls.length) updateSwirls(dt);

			// Swirl spawning conditions
			const cps = state.cpsSmooth;
			const fullSize = (state.growthPct >= 0.98); // growthPct is set in draw() each frame
			const fastEnough = (cps >= 6);

			if (fullSize && fastEnough) {
				const { minI, maxI, maxS } = swirlParamsFromCps(cps);

			  	// count down to next spawn
			  	state.swirlTimer -= dt;

			  	if (state.swirlTimer <= 0 && swirls.length < maxS && state._geom) {
					spawnFireSwirl(state._geom.cx, state._geom.cy, state._geom.ringOuterR, state._geom.w, state._geom.h, cps);
					state.swirlTimer = minI + Math.random() * (maxI - minI);
			  	}
			} else {
			  	// when not in the “special mode”, don’t keep spawning
			  	state.swirlTimer = 0;
			}

		  	const maxSpin = 14.0; // radians/sec
		  	state.targetAngVel = lerp(0, maxSpin, Math.pow(s01, 0.9));

		  	const accel = 10.5;
		  	state.angVel += (state.targetAngVel - state.angVel) * (1 - Math.exp(-accel * dt));

		  	const noTap = (now - state.lastTapAt) > 220;
		  	const friction = noTap ? 1.8 : 0.35;
		  	state.angVel *= Math.exp(-friction * dt);

		  	state.angle += state.angVel * dt;

      		const base = 1.0;

			const rect = canvas.getBoundingClientRect();
			const hostRect = canvas.parentElement.getBoundingClientRect();
			const maxOuterR = Math.min(rect.width, hostRect.height) * 0.5 - OUTER_PAD;
			const baseSize = Math.min(rect.width, hostRect.height);
			const innerR = clamp(baseSize * 0.20, 52, 74);

			const maxScale = Math.max(1, (maxOuterR / innerR) * 1.55); // bigger overall ceiling than before

			const tapping = msSinceTap < STOP_THRESHOLD_MS;
			
			const fillRate = 0.06 + 0.16 * s01;

			// Base drain (your “slow diminish” feel)
			const baseDrain = 0.07;

			// Extra drain that kicks in immediately when you stop
			// Stronger if you were near max (energy/overEnergy high)
			const stopBoost = (!tapping) ? (0.22 + 0.55 * state.energy + 0.85 * state.overEnergy) : 0;

			if (tapping) {
				state.energy += fillRate * dt;
			} else {
			  	state.energy -= (baseDrain + stopBoost) * dt;
			}

			state.energy = clamp(state.energy, 0, 1);

			const overFillRate  = 0.010 + 0.020 * s01;

			const overBaseDrain = 0.18;
			const overStopBoost = (!tapping) ? (0.70 + 1.40 * state.overEnergy) : 0;

			const canOvercharge = tapping && (state.energy >= 0.999) && (s01 > 0.35);

			if (canOvercharge) {
			  	state.overEnergy += overFillRate * dt;
			} else {
			  	state.overEnergy -= (overBaseDrain + overStopBoost) * dt;
			}

			state.overEnergy = clamp(state.overEnergy, 0, 1);

			// Curves: make it harder to reach the very biggest size
			const energyCurve = Math.pow(state.energy, 1.7);       // stage 1 curve
			const overCurve   = Math.pow(state.overEnergy, 2.2);   // stage 2 curve (harder)

			// Convert to target scale
			// Stage 1 gets you most of the way, stage 2 gives extra “significant” growth
			const stage1Max = lerp(base, maxScale, 0.78);          // normal max (~78% of full)
			const stage2Max = maxScale;                            // absolute max (near edge)

			const scaleStage1 = lerp(base, stage1Max, energyCurve);
			const scaleStage2 = lerp(stage1Max, stage2Max, overCurve);

			const targetScale = (state.overEnergy > 0.001) ? scaleStage2 : scaleStage1;

			// Smooth toward target
			state.scale += (targetScale - state.scale) * (1 - Math.exp(-2.0 * dt));
			state.scale = clamp(state.scale, base, maxScale);

      		const timeSinceTap = (now - state.lastTapAt) / 1000;

      		// afterglow decays when no taps
		  	state.fireAfterglow *= Math.exp(-(timeSinceTap > 0.22 ? 1.2 : 0.25) * dt);
		  	state.fireAfterglow = clamp(state.fireAfterglow, 0, 1);

		  	const sustained = clamp(1.0 - timeSinceTap / 0.55, 0, 1);

		  	const rateBoost = Math.pow(s01, 0.7);
		  	state.fireTarget = clamp(0.05 + 0.95 * sustained * (0.35 + 0.65 * rateBoost), 0, 1);

		  	const linger = clamp(state.fireAfterglow, 0, 1);
		  	state.fireTarget *= (0.35 + 0.65 * linger);

		  	const fireSmooth = 4.8;
			
			if (cpsCurrentEl && cpsMaxEl) {
			 	cpsCurrentEl.textContent = state.cpsSmooth.toFixed(1);
				cpsMaxEl.textContent = state.maxCps.toFixed(1);
			}

		  	draw(dt, s01);

		  	requestAnimationFrame(tick);
		}
    
    	function fireFromInputs(tps, growthPct) {
			const fast = (tps >= 6) ? clamp01((tps - 6) / 1.0) : 0; // 6..7 -> 0..1
			const redZone = (growthPct >= 0.90) ? clamp01((growthPct - 0.90) / 0.10) : 0;
		  	return Math.max(fast, redZone);
    	}

    	function draw(dt, s01) {
      		const rect = canvas.getBoundingClientRect();
			const hostRect = canvas.parentElement.getBoundingClientRect(); // ring-embed
			const offsetY = hostRect.top - rect.top; // how far the container is from canvas top
			const w = rect.width;
			const h = rect.height;

			ctx.clearRect(0, 0, w, h);
			
			if (swirls.length)	drawSwirls(state.t);

			const cx = w / 2;
			const cy = offsetY + hostRect.height / 2;

			// ---- Inner circle size ----
			const baseSize = Math.min(w, hostRect.height);
			const innerR = clamp(baseSize * 0.20, 52, 74);

			// ✅ ATTACHMENT: ring touches inner circle (no gap)
			const ATTACH_GAP = 0;

			// how much free space we have from center to the canvas edge
			const maxOuterR = Math.min(w, hostRect.height) * 0.5 - OUTER_PAD;

			// outward growth from taps
			const outwardGrow = 220 * Math.max(0, state.scale - 1);

			// ring thickness grows a bit with speed
			const ringThicknessIdle = 18;
			const ringThickness = ringThicknessIdle + 18 * s01;

			// ring radii (attached)
			const ringInnerR = innerR + ATTACH_GAP;
			const desiredOuterR = ringInnerR + ringThickness + outwardGrow;

			// ✅ clamp so it never exceeds canvas
			const ringOuterR = Math.min(desiredOuterR, maxOuterR);

			// recompute mid radius using clamped outer
			const ringMidR = (ringInnerR + ringOuterR) * 0.5;

			// thickness should match the clamped ring size
			const ringStroke = Math.max(6, ringOuterR - ringInnerR);
    
		  	// ----- FIRE CONTROL (must be inside draw, not outside) -----
		  	const growth = Math.max(0, state.scale - 1);
			
			state._geom = { cx, cy, ringOuterR, innerR, w, h };

		  	// ---- growthPct based on REAL drawn size (after clamping) ----
		  	const outwardNow = Math.max(0, ringOuterR - ringInnerR - ringThickness);
		  	const outwardMax = Math.max(0.0001, maxOuterR - ringInnerR - ringThickness);
		  	const growthPct = clamp01(outwardNow / outwardMax);
		  	state.growthPct = growthPct;

		  	// ---- Fire target: fast taps OR pure red ----
		  	const targetFire = fireFromInputs(state.tapsPerSec, growthPct);

		  	// Smooth + linger slightly, but still allow shutdown when back to init
		  	state.fire = Math.max(state.fire * 0.92, targetFire);

		  	// If we return to init size, kill fire + particles
		  	if (growthPct < 0.01) {
				state.fire = 0;
			  	particles.length = 0;
			  	stream.length = 0;
		  	}

      		const idle = (s01 < 0.02 && state.fire < 0.02 && Math.abs(state.angVel) < 0.02);

			// ---- Palette (idle look like screenshot) ----
			const baseBlue = "#436F8E";
			const innerTop = "#3E6683";
			const innerEdge = "#2E4E66";

			// ---- Overall soft shadow (gives “inside page” depth) ----
			ctx.save();
			ctx.globalAlpha = 0.25;
			ctx.shadowBlur = 26;
			ctx.shadowColor = "rgba(30,70,95,0.45)";
			ctx.beginPath();
			ctx.fillStyle = "rgba(0,0,0,0)";
			ctx.arc(cx, cy, ringOuterR + 2, 0, Math.PI * 2);
			ctx.fill();
			ctx.restore();

			ctx.save();
			ctx.globalCompositeOperation = "lighter";
			ctx.globalAlpha = idle ? 0.16 : (0.10 + 0.15 * s01 + 0.22 * state.fire);
			ctx.shadowBlur = idle ? 28 : (20 + 70 * state.fire);
			ctx.shadowColor = "rgba(70,140,175,0.65)";
			ctx.beginPath();
			ctx.fillStyle = "rgba(70,140,175,0.18)";
			ctx.arc(cx, cy, ringOuterR + 10, 0, Math.PI * 2);
			ctx.fill();
			ctx.restore();
			ctx.globalCompositeOperation = "source-over";

			if (idle) {
				// clean idle ring (flat blue band)
				ctx.save();

				// slight depth gradient across ring thickness
				const rg = ctx.createRadialGradient(cx, cy, ringInnerR, cx, cy, ringOuterR);
				rg.addColorStop(0, "rgba(79,134,168,0.95)");
				rg.addColorStop(1, "rgba(67,111,142,0.95)");

				ctx.beginPath();
				ctx.strokeStyle = rg;
				ctx.lineWidth = (ringOuterR - ringInnerR);
				ctx.lineCap = "round";
				ctx.arc(cx, cy, ringMidR, 0, Math.PI * 2);
				ctx.stroke();

				ctx.restore();  
			} else {
				// animated blinking ring (no rotation)
				drawBlinkRing(cx, cy, ringMidR, ringStroke, state.tapsPerSec);
			}

			// ---- INNER CIRCLE (draw AFTER ring so it looks “in front”) ----
			ctx.save();
			const ig = ctx.createRadialGradient(
			cx - innerR * 0.25, cy - innerR * 0.28, innerR * 0.20,
			  cx, cy, innerR
			);
      
		  	ig.addColorStop(0, innerTop);
			ig.addColorStop(0.55, baseBlue);
			ig.addColorStop(1, innerEdge);

			ctx.beginPath();
			ctx.fillStyle = ig;
			ctx.arc(cx, cy, innerR, 0, Math.PI * 2);
			ctx.fill();
			ctx.restore();

			// subtle inner vignette ring
			ctx.save();
			ctx.globalAlpha = 0.22;
			ctx.beginPath();
			ctx.strokeStyle = "rgba(0,0,0,0.25)";
			ctx.lineWidth = 6;
			ctx.arc(cx, cy, innerR - 3, 0, Math.PI * 2);
			ctx.stroke();
			ctx.restore();

			// ---- TEXT ----
			ctx.save();
			ctx.fillStyle = "rgba(255,255,255,0.95)";
			ctx.textAlign = "center";
			ctx.textBaseline = "middle";
			const labelFontPx = Math.round(clamp(innerR * 0.24, 13, 18));
			ctx.font = `700 ${labelFontPx}px Raleway, sans-serif`;
			ctx.shadowBlur = 6;
			ctx.shadowColor = "rgba(0,0,0,0.25)";
			ctx.fillText(<?php echo json_encode(get_field('press_label')); ?>, cx, cy);
// 			ctx.fillText("SPACE", cx, cy + 14);
			ctx.restore();

			// ---- FIRE (spawn from OUTER EDGE) ----
			if (state.fire > 0.01) {
        		spawnStream(dt, cx, cy, ringInnerR, ringOuterR, s01, growthPct);
			  	updateStream(dt);
			  	drawStream();

			  	// existing outward fire (does NOT rotate)
			  	spawnParticles(dt, cx, cy, ringInnerR, ringOuterR, s01, growthPct);
			  	updateParticles(dt);
			  	drawParticles();
        	}
		}

		function ringColorFromGrowth(p){
      		p = clamp01(p);

			const OMT_BLUE   = hexToRgb("#4A6B8A");
			const BLUE_GREEN = hexToRgb("#2FA9A2");
			const GREEN      = hexToRgb("#2DBE62");
			const GREEN_YELL = hexToRgb("#A7D84B");
			const YELLOW     = hexToRgb("#FFD84A");
			const YELL_ORNG  = hexToRgb("#FFB13A");
			const OMT_ORANGE = hexToRgb("#E35D26");
			const ORNG_RED   = hexToRgb("#FF4A2F");
			const RED        = hexToRgb("#FF2A2A");

			// 0–40%: OMT blue
			if (p <= 0.40) return OMT_BLUE;

			// 40–48%: blue -> blue/green
			if (p <= 0.48) return lerpRgb(OMT_BLUE, BLUE_GREEN, (p - 0.40) / 0.08);

			// 48–56%: blue/green -> green
			if (p <= 0.56) return lerpRgb(BLUE_GREEN, GREEN, (p - 0.48) / 0.08);

			// 56–64%: green -> green/yellow
			if (p <= 0.64) return lerpRgb(GREEN, GREEN_YELL, (p - 0.56) / 0.08);

			// 64–72%: green/yellow -> yellow
			if (p <= 0.72) return lerpRgb(GREEN_YELL, YELLOW, (p - 0.64) / 0.08);

			// 72–80%: yellow -> yellow/orange
			if (p <= 0.80) return lerpRgb(YELLOW, YELL_ORNG, (p - 0.72) / 0.08);

			// 80–90%: yellow/orange -> OMT orange
			if (p <= 0.90) return lerpRgb(YELL_ORNG, OMT_ORANGE, (p - 0.80) / 0.1);
		
			return OMT_ORANGE;
    	}
    
		function drawRotatingGradientOverlay(cx, cy, r, thickness, baseRgb, angle, strength = 1) {
			const segs = 220;
			const step = (Math.PI * 2) / segs;

			// a thin overlay band so it looks like "light moving" not wings
			const overlayWidth = Math.max(2, thickness * 0.28);

			ctx.save();
			ctx.lineCap = "round";
			ctx.lineWidth = overlayWidth;
			ctx.globalCompositeOperation = "lighter";

			for (let i = 0; i < segs; i++) {
          		const a0 = i * step;
          		const a1 = a0 + step * 0.95;

	          	const local = a0 - angle;

          		const peak = Math.exp(-Math.pow(local, 2) * 2.6);

          		const peak2 = Math.exp(-Math.pow(local - 0.9, 2) * 4.2) * 0.6;

          		const k = (peak + peak2) * strength;

        		if (k < 0.002) continue;

        		const a = 0.02 + 0.20 * k;
        		ctx.strokeStyle = `rgba(255,255,255,${a})`;

        		ctx.beginPath();
        		ctx.arc(cx, cy, r, a0, a1);
        		ctx.stroke();  
			}
      		ctx.restore();
		}

		function drawBlinkRing(cx, cy, r, thickness, tps) {
			const base = ringColorFromGrowth(state.growthPct ?? 0);

			const now = performance.now();
			const sinceTap = (now - state.lastTapAt) / 1000;

			// Quick pulse right after a tap, then decays
			// 0..1 where 1 = just tapped
			const tapPulse = Math.exp(-sinceTap * 10.0);

			// Baseline visibility + extra from pulse
			const alpha = 0.55 + 0.45 * tapPulse;

			// Glow strength also pulses
			const glow = 0.20 + 0.65 * tapPulse + 0.25 * state.fire;

			// ---- Draw a CLEAN solid ring (single stroke) ----
			ctx.save();
			ctx.lineCap = "round";

			// Main ring
			ctx.beginPath();
			ctx.strokeStyle = `rgba(${base.r},${base.g},${base.b},${alpha})`;
			ctx.lineWidth = thickness;
			ctx.arc(cx, cy, r, 0, Math.PI * 2);
			ctx.stroke();

			// Soft outer glow (uniform)
			ctx.globalCompositeOperation = "lighter";
			ctx.globalAlpha = glow * 0.35;
			ctx.shadowBlur = 18 + 70 * glow;
			ctx.shadowColor = `rgba(${base.r},${base.g},${base.b},1)`;

			ctx.beginPath();
			ctx.strokeStyle = `rgba(${base.r},${base.g},${base.b},${0.35})`;
			ctx.lineWidth = thickness * 1.9;
			ctx.arc(cx, cy, r, 0, Math.PI * 2);
			ctx.stroke();

			// Slight inner highlight (still uniform, helps depth)
			ctx.globalCompositeOperation = "source-over";
			ctx.globalAlpha = 0.22 + 0.25 * tapPulse;

			ctx.beginPath();
			ctx.strokeStyle = `rgba(255,255,255,${0.10 + 0.15 * tapPulse})`;
			ctx.lineWidth = Math.max(2, thickness * 0.18);
			ctx.arc(cx, cy, r - thickness * 0.32, 0, Math.PI * 2);
			ctx.stroke();

		  	const rotStrength = Math.min(1, 0.20 + 0.35 * tapPulse + 0.55 * state.fire);
		  	drawRotatingGradientOverlay(cx, cy, r, thickness, base, state.angle, rotStrength);

			ctx.restore();
		}

		requestAnimationFrame(tick);
	})();
</script>

<?php get_footer();