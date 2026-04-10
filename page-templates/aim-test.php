<?php /*Template Name:AIM Test*/
get_header(); ?>

<style>
	.full-container {
		display: flex;
		flex-direction: column;
		gap: 30px;
		align-items: center;
	}
	.container {
		max-width: 880px;
		margin: 0 auto;
		display: flex;
		flex-direction: column;
		align-items: center;
		position: relative;
	}
	.click_box {
		display: block;
	}
	.clk_box {
		position: relative;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 350px;
		border: 1px solid #436f8e;
		box-sizing: border-box;
		border-radius: 16px;
		padding: 15px;
		margin-bottom: 25px;
		box-shadow: inset 0 0 15px #436f8e, inset 0 0 15px 5px rgba(255, 255, 255, 0.2);
		overflow: hidden;
	}
	
	.clk_box .clk_area {
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		font-size: 20px;
		width: 100%;
		height: 100%;
		border-radius: 16px;
	}
	
	.clk_box .clk_area button {
		width: 100%;
		height: 100%;
		border: none;
		background: 0 0;
		font-size: 20px;
		transition: .3s;
	}
	
	.click_box_btn {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 15px;
		color: #436f8e;
	}
	
	.click_box_btn div {
		width: 240px;
		height: 56px;
		display: flex;
		justify-content: center;
		align-items: center;
		background: none;
		border: 1px solid #436f8e;
		border-radius: 16px;
	}
	
	.click_box_btn div span {
		font-weight: 600;
		margin-left: 5px;
		font-family: 'Poppins',sans-serif !important;
		width: 33px;
	}
	
	.ripple {
		position: absolute;
		border-radius: 50%;
		background: #e25c1b;
		transform: scale(0);
		animation: ripple-effect 0.6s linear;
		pointer-events: none;
		z-index: 5;
	}
	
	.target {
          position: absolute;
          background: #e25c1b;
          border-radius: 50%;
      }

	@keyframes ripple-effect {
		to {
			transform: scale(3);
			opacity: 0;
		}
	}
	
	@media (min-width: 992px) and (max-width: 1200px) {
		.click_box_btn div {
			width: 200px;
		}
	}
	@media (min-width: 768px) and (max-width: 991px) {
		.click_box_btn div {
			width: max-content;
			padding: 0 35px;
		}
		.clk_box {
			height: 300px;
		}
	}
	@media (max-width: 767px) {
		.click_box_btn {
			flex-wrap: wrap;
			justify-content: center;
			gap: 5px;
		}
		.click_box_btn div {
			width: calc(33.33% - 10px) !important;
			padding: 0;
			height: 45px;
			font-size: 15px;
			border-radius: 10px;
		}
		.clk_box {
			height: 250px;
			padding: 5px;
		}
		.score_modal {
			width: 330px !important;
			padding: 2rem 2rem !important;
		}
	}
	
	.score_modal {
		display: none;
		border-radius: 20px;
		width: 400px;
		padding: 2em 3em;
		margin: auto;
		position: absolute;
		left: 50%;
		top: 0%;
		transform: translate(-50%, 0);
		z-index: 999;
		background: #e25c1b;
		color: white;
	}
	.modal-header {
		display: flex;
		align-items: center;
		justify-content: end;
	}
	.modal-close {
		background: no-repeat;
		border: none;
		font-size: 40px;
		display: block;
		transform: rotate(45deg);
		position: absolute;
		right: 40px;
		cursor: pointer;
	}
	.modal_cont {
		text-align: center;
		padding-top: 40px;
		font-family: 'Poppins',sans-serif !important;
	}
	.modal_cont h3 {
		color: white;
	}
	.modal_cont span {
		cursor: pointer;
		text-decoration: underline;
	}
	.modal_cont ul {
		display: flex;
		align-items: center;
		width: 192px;
		justify-content: space-between;
		margin: 35px auto;
	}
	.side_bar_menu {
		display: flex;
		border-radius: 20px;
		box-shadow: 0 0 6px 0 rgba(0, 0, 0, .12);
		gap: 5px;
		padding: 8px 16px;
	}
	
	.side_bar_menu div {
		border-radius: 20px;
		height: max-content;
		background-color: #f7f7f9;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	
	.side_bar_menu div span {
		cursor: pointer;
		display: flex;
		justify-content: center;
		align-items: center;
		font-family: pop-med;
		opacity: .6;
		width: 40px;
		height: 40px;
		font-family: 'Poppins',sans-serif !important;
		border-radius: 16px;
		transition: all 0.15s;
	}
	.side_bar_menu div span:hover {
		opacity: 1;
	}
	.side_bar_menu.time .active {
		background: #436f8e;
		opacity: 1;
		color: white;
	}
	.side_bar_menu.menu .active {
		background: #e25c1b;
		opacity: 1;
	}
	.side_bar_menu.menu .active svg g{
		fill: #fff;
	}
	
	@media (max-width: 540px) {
		.side_bar_menu.menu {
			padding: 4px 12px;
			gap: 0px;
		}
		
		.side_bar_menu.time {
			padding: 4px 8px;
			gap: 0px;
		}
		.side_bar_menu.time div span {
			width: 35px;
			height: 35px;
			border-radius: 12px;
		}
	}
	@media (max-width: 400px) {
		.click_box_btn div {
			margin: 5px !important;
			width: 100% !important;
		}
		.side_bar_menu.time .time-Label {
			display: none;
		}
		.side_bar_menu.time div span {
			width: 30px;
			height: 30px;
			border-radius: 10px;
		}
	}
</style>

<div class="container-fluid">
<div class="full-container">
	<div class="side_bar_menu menu">
		<div>
			<a href="/cps-test">
				<span data-index="cps">
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
						 width="28" height="28" viewBox="0 0 512.000000 512.000000"
						 preserveAspectRatio="xMidYMid meet">

						<g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
						   fill="#436f8e" stroke="none">
							<path d="M1284 5110 c-33 -13 -54 -50 -54 -95 0 -49 62 -352 79 -382 30 -57
									 100 -70 149 -28 17 14 33 38 36 53 7 36 -66 383 -88 417 -26 40 -75 54 -122
									 35z"/>
							<path d="M2142 4947 c-22 -13 -182 -243 -223 -321 -35 -65 -6 -134 64 -151 58
									 -15 83 8 199 184 90 138 108 171 108 204 0 75 -81 121 -148 84z"/>
							<path d="M194 4806 c-63 -63 -38 -131 68 -184 75 -38 104 -36 143 10 39 46 34
									 92 -13 138 -81 77 -145 89 -198 36z"/>
							<path d="M612 4545 c-17 -14 -34 -39 -37 -56 -13 -59 9 -86 149 -177 108 -70
									 138 -85 170 -85 75 0 122 91 80 151 -15 22 -189 143 -251 175 -45 24 -77 21
									 -111 -8z"/>
							<path d="M1480 4379 c-167 -27 -334 -181 -386 -358 -23 -76 -22 -210 0 -286
									 10 -33 170 -410 357 -837 187 -427 342 -783 344 -790 4 -10 -24 -13 -132 -14
									 -158 -1 -226 -15 -337 -71 -176 -89 -278 -283 -249 -473 20 -130 114 -287 231
									 -388 96 -83 1422 -1122 1458 -1144 23 -14 44 -18 63 -15 26 5 1965 854 2053
									 898 21 11 42 28 48 39 18 34 33 295 27 485 -11 361 -81 708 -207 1020 -94 235
									 -219 506 -257 562 -134 196 -386 275 -619 194 -48 -16 -89 -29 -91 -28 -1 2
									 -32 70 -68 152 -80 182 -100 217 -162 278 -60 60 -147 103 -238 117 -104 16
									 -152 6 -328 -68 l-107 -45 -55 52 c-70 66 -130 93 -222 99 -80 5 -179 -20
									 -309 -78 -37 -17 -71 -27 -75 -23 -3 4 -52 112 -108 238 -106 241 -147 307
									 -233 378 -60 50 -160 94 -238 106 -73 12 -83 12 -160 0z m183 -215 c67 -23
									 138 -90 179 -171 19 -37 165 -365 324 -727 251 -573 293 -662 319 -678 60 -38
									 140 1 151 73 4 28 -24 98 -165 417 l-169 382 47 21 c229 104 313 97 378 -28
									 17 -32 106 -231 199 -443 93 -211 176 -392 186 -402 58 -58 168 -14 168 67 0
									 24 -51 151 -156 391 -86 195 -155 356 -153 358 2 2 54 24 115 49 86 36 124 47
									 166 47 73 0 149 -38 187 -93 15 -23 121 -256 235 -517 152 -347 216 -482 237
									 -502 40 -38 88 -38 130 0 51 46 45 74 -70 337 -115 260 -114 242 -12 272 81
									 23 183 14 250 -22 99 -54 122 -90 264 -417 147 -336 217 -568 257 -848 28
									 -200 32 -631 6 -664 -6 -8 -437 -201 -958 -430 l-947 -416 -703 553 c-750 590
									 -779 617 -828 738 -63 159 14 305 188 359 119 37 298 23 405 -31 23 -12 103
									 -81 177 -153 237 -230 244 -236 288 -236 65 0 114 62 98 124 -7 28 -17 39
									 -221 236 l-149 144 -391 896 c-215 492 -397 910 -403 929 -7 19 -12 62 -12 96
									 0 212 190 355 383 289z"/>
							<path d="M4305 1184 c-68 -29 -115 -73 -115 -109 0 -62 46 -110 104 -108 43 2
									 160 56 180 84 27 39 21 93 -15 128 -38 38 -72 39 -154 5z"/>
							<path d="M3920 1011 c-25 -10 -272 -118 -550 -240 -527 -231 -560 -249 -560
									 -307 0 -33 25 -81 49 -94 11 -5 34 -10 51 -10 41 0 1104 465 1144 501 23 21
									 29 33 29 69 0 36 -6 48 -32 72 -36 33 -67 35 -131 9z"/>
							<path d="M2973 4299 c-39 -11 -83 -62 -83 -95 0 -36 24 -77 54 -93 30 -16 122
									 -9 165 13 57 30 68 110 22 157 -25 24 -37 29 -78 28 -26 0 -62 -5 -80 -10z"/>
							<path d="M2425 4186 c-144 -31 -165 -47 -165 -121 0 -50 44 -95 93 -95 37 0
									 211 33 264 51 66 21 85 101 37 158 -23 28 -32 31 -77 30 -29 0 -97 -11 -152
									 -23z"/>
							<path d="M585 3781 c-179 -39 -208 -49 -225 -81 -35 -66 11 -150 83 -150 43 0
									 360 65 387 80 45 24 65 94 40 141 -13 24 -62 49 -92 48 -13 0 -99 -17 -193
									 -38z"/>
							<path d="M1040 3217 c-15 -7 -71 -81 -135 -177 -92 -138 -109 -171 -109 -204
									 -1 -73 92 -122 152 -80 22 15 182 247 215 311 32 62 19 121 -33 148 -35 18
									 -57 19 -90 2z"/>
						</g>
					</svg>
				</span>
			</a>
		</div>
		<div>
			<a href="/aim-test">
				<span data-index="aim" class="active">
					<svg version="1.0" xmlns="http://www.w3.org/2000/svg"
						 width="28" height="28" viewBox="0 0 225.000000 225.000000"
						 preserveAspectRatio="xMidYMid meet">

						<g transform="translate(0.000000,225.000000) scale(0.100000,-0.100000)"
						   fill="#436f8e" stroke="none">
							<path d="M948 2234 c-96 -15 -239 -59 -320 -100 -211 -105 -407 -301 -512
									 -512 -67 -133 -116 -343 -116 -497 0 -154 49 -364 116 -497 106 -213 299 -406
									 512 -512 133 -67 343 -116 497 -116 154 0 364 49 497 116 264 132 475 373 568
									 651 57 172 72 347 45 526 -93 616 -670 1038 -1287 941z m112 -400 c4 -218 8
									 -285 19 -297 19 -24 67 -21 92 4 21 21 22 29 17 143 -3 67 -3 191 1 276 l6
									 155 48 -3 c112 -7 319 -86 445 -169 77 -51 205 -174 258 -250 87 -121 152
									 -290 169 -440 l7 -63 -274 0 c-308 0 -321 -3 -326 -61 -5 -63 -2 -63 312 -69
									 l281 -5 -2 -55 c-1 -30 -16 -100 -33 -155 -117 -366 -361 -595 -737 -691 -54
									 -14 -109 -23 -123 -22 l-25 3 -3 279 c-2 198 -6 284 -14 294 -17 19 -57 34
									 -78 27 -36 -11 -40 -48 -40 -331 l0 -276 -52 7 c-372 47 -662 272 -806 625
									 -35 86 -72 224 -72 269 l0 31 270 0 c176 0 277 4 293 11 29 13 50 54 42 79
									 -11 34 -60 40 -338 40 l-269 0 7 57 c19 150 91 333 179 457 50 70 180 198 246
									 243 62 42 175 98 249 122 63 22 205 51 231 48 13 -2 16 -43 20 -283z"/>
							<path d="M905 1781 c-190 -69 -318 -183 -406 -365 -45 -92 -58 -144 -39 -156
									 24 -15 39 1 60 64 41 124 137 252 246 326 25 18 87 49 137 69 71 29 92 42 92
									 57 0 26 -28 27 -90 5z"/>
							<path d="M1260 1777 c0 -20 11 -28 73 -51 198 -77 335 -216 398 -403 18 -55
									 24 -63 46 -63 24 0 25 2 20 38 -9 53 -88 208 -137 267 -81 97 -192 173 -316
									 215 -73 26 -84 25 -84 -3z"/>
							<path d="M1056 1194 c-20 -21 -26 -37 -26 -69 0 -59 36 -95 95 -95 59 0 95 36
									 95 95 0 32 -6 48 -26 69 -21 20 -37 26 -69 26 -32 0 -48 -6 -69 -26z"/>
							<path d="M1763 992 c-7 -4 -22 -34 -33 -66 -28 -82 -74 -158 -136 -225 -69
									 -75 -138 -122 -249 -170 -49 -21 -90 -42 -92 -47 -1 -5 1 -16 7 -24 7 -12 16
									 -12 67 4 218 68 394 240 458 447 23 72 13 104 -22 81z"/>
							<path d="M450 969 c0 -11 13 -54 30 -95 73 -184 189 -304 375 -390 84 -39 128
									 -42 133 -9 2 16 -12 26 -78 54 -206 86 -333 218 -395 409 -15 43 -21 52 -41
									 52 -18 0 -24 -6 -24 -21z"/>
						</g>
					</svg>
				</span>
			</a>
		</div>
	</div>
	
	<div id="aim" class="container">
		<div class="click_box">
			<div class="clk_box">
				<div class="clk_area" id="clickarea">
					<button id="start" onclick="start_aim_test()">Click here to test your aiming performance</button>
				</div>

			</div>
			<div class="click_box_btn">
				<div>Timer: <span id="timer">0</span></div>
				<div>Accuracy: <span id="accuracy">0</span></div>
				<div>Score: <span id="score">0</span></div>
			</div>
		</div>

		<section class="score_modal" role="dialog">
			<div class="modal-header">
				<span class="modal-close">+</span>
			</div>
			<div class="modal_cont">
				<h3>Find out your score!</h3>
				<p>
					Your precision is <b id="endaccuracy">57</b>%<br>
					You hit <b id="endscore">4</b>x the target in <b id="endtimer">5</b> seconds </p>
				<ul id="endstars">
				</ul>
				<!-- 					<ul id="endstars">
<li><img alt="0" src="/data/img/starb.png"></li>
<li><img alt="0" src="/data/img/starT.png"></li>
<li><img alt="1" src="/data/img/starT.png"></li>
<li><img alt="2" src="/data/img/starT.png"></li>
<li><img alt="3" src="/data/img/starT.png"></li>
</ul> -->
				<span class="modal-try">Try again</span>
			</div>
		</section>
	</div>

	<div class="side_bar_menu time">
		<div class="time-Label">
			<span><b>Sec</b></span>
		</div>
		<div>
			<span data-time="1">1</span>
		</div>
		<div>
			<span data-time="2">2</span>
		</div>
		<div>
			<span data-time="5" class="active">5</span>
		</div>
		<div>
			<span data-time="10">10</span>
		</div>
		<div>
			<span data-time="15">15</span>
		</div>
		<div>
			<span data-time="20">20</span>
		</div>
		<div>
			<span data-time="30">30</span>
		</div>
		<div>
			<span data-time="50">50</span>
		</div>
		<div>
			<span data-time="100">100</span>
		</div>
	</div>
</div>
	<br/><br/>
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

<script>
	let count = 0;
	let time = 5000;
	let test_started = false;
	
	let aim = document.getElementById("aim");
	
	const start_aim_test = () => {
		let clk_box = aim.querySelector(".clk_box");
		let startBtn = aim.querySelector("#start");

		let timerLabel = aim.querySelector("#timer");
		let accuracyLabel = aim.querySelector("#accuracy");
		let scoreLabel = aim.querySelector("#score");

		let endAccuracy = aim.querySelector("#endaccuracy");
		let endScore = aim.querySelector("#endscore");
		let endtimer = aim.querySelector("#endtimer");

		let modal = aim.querySelector(".score_modal");
		let close_btn = aim.querySelector(".modal-close");
		let try_btn = aim.querySelector(".modal-try");

		let target_click = 0;

		const getRandomNumber = (min, max) => {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

		const createTarget = () => {
			let target = document.createElement('div');
			target.className = 'target';

			let size = getRandomNumber(20, 40);

			let maxX = clk_box.clientWidth - size;
			let maxY = clk_box.clientHeight - size;
			let randomX = Math.floor(Math.random() * maxX);
			let randomY = Math.floor(Math.random() * maxY);

			target.style.width = `${size}px`;
			target.style.height = `${size}px`;
			target.style.left = `${randomX}px`;
			target.style.top = `${randomY}px`;

			target.addEventListener('click', () => {
				target_click++;
			
				target.remove();
				createTarget();
			});

			clk_box.appendChild(target);	
		}

		const handleClick = (e) => {
			if(test_started) {
				count++;	
			}
		}
		
		clk_box.addEventListener('click', handleClick);

		const end_test = () => {
			endScore.innerText = target_click;
			endtimer.innerText = time / 1000;
			endAccuracy.innerText = count !== 0 ? ((target_click / count) * 100).toFixed(1) : '0';

			clk_box.removeEventListener('click', handleClick);
			
			let target_element = document.querySelector(".target");
			if(target_element) {
				target_element.remove();
			}

			modal.style.display = 'block';
			test_started = false;
		}

		try_btn.onclick = () => {
			modal.style.display = "none";
			startBtn.style.display = 'block';
		}

		close_btn.onclick = () => {
			modal.style.display = "none";
			startBtn.style.display = 'block';
		}

		// Start AIM TEST
		count = -1;
		startBtn.style.display = 'none';
		createTarget();
		test_started = true;

		let startTime = Date.now();
		let test_timer = setInterval(() => {
			let now = Date.now();
			let milliseconds = now - startTime;
			let seconds = milliseconds / 1000;
			
			timerLabel.innerText = seconds.toFixed(2);
			accuracyLabel.innerText = count !== 0 ? ((target_click / count) * 100).toFixed(1) : '0';
			scoreLabel.innerText = target_click;

			if (milliseconds >= time) {
				clearInterval(test_timer);
				end_test();
			}
		}, 10); 
	}
	
	let timeList = document.querySelectorAll(".time div span");

    timeList.forEach(function(item) {
        item.addEventListener("click", () => {
            timeList.forEach((innerItem) => {
                innerItem.classList.remove("active");
            });

            item.classList.add("active");

            let timeValue = item.getAttribute("data-time");
            time = timeValue * 1000;
        });
    });
	
</script>
<?php get_footer();