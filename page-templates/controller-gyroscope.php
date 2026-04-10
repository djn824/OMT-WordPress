<?php 
/* Template Name:Controller Gyroscope */
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
  
	model-viewer {
		width: auto;
		height: 45vh;
		margin-top: -2vh;
  	}
  
	.measurements {
		font-family: Raleway;
		font-weight: bold;                   
		font-size: 16px;
		color: #3A617C;
  	}
  
  	.measurements-info {
		max-width: 250px !important;
		color: #436f8e;
		border: 2px solid #436f8e;
		border-radius: 10px;
		padding: 15px 10px 15px 10px !important;
		position: relative;
		margin: 0 auto;
		text-align: center;
  	}
  
  	.note-message {
        display: none;
        padding: 10px;
        background-color: #E35D26;
        color: #EEEEEE;
        border: 1px solid #E35D26;
        border-radius: 2px;
		font-family: Raleway;
		font-weight: bold;
		font-size: 18px;
  	}
	
	.select-bar select{
		padding: 5px 6px;
		border-radius: 5px;
		color: #436f8e;
		border: 1px solid #436f8e;
		font-size: 16px;
		min-width: 100px;
		text-overflow: ellipsis;
	}
	
	.select-bar {
		display: flex;
		gap: 10px;
		justify-content: center;
	}
  
  	.btn-style {
    	position: absolute;
    	top: 48%;
        left: 52%;
        transform: translate(-49%, -48%);
  	}
  
  	.card {
		background-color: #f3f3f3;
		border: 2px solid #f3f3f3;
		border-radius: 10px;
		box-shadow: 0 5px 6px #d9d9d9;
		padding: 15px 20px 15px 20px !important;
		position: relative;
		margin: 0 auto;
		text-align: center;
  	}
	
	.connect-label-style {
		align-items: start;
		justify-content: center;
		font-size: 14px;
		font-weight: 500;
		color: #e35d26;
		text-align: center;
	}
  
  	.display-bar {
		top: 10px;
		width: 100%;
		padding: 0px 10px;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
  	}
          
  	.display-bar span, 
  	.display-bar p {
		font-size: 16px;
		font-weight: 700;
		color: #e35d26;
		text-align: left;
  	}  
  
  	.select-label {
		color: #3a617c;
		font-size: 14px;
		font-family: "Raleway";
		font-weight: bold;
	}
  
	.item-label {
		color: #3a617c;
		font-size: 12px;
		padding-top: 10px;
		font-family: "Raleway";
		font-weight: bold;
	}
  
  	.measurement-label {
		color: #3a617c;
		font-size: 16px;
		font-family: "Raleway";
		font-weight: 500;
  	}
  
  	.start-button {
		color: #ffffff;
		background-color: #e25d26;
		border: 1px solid #e25d26;
		border-radius: 5px;
  	}
  
  	.btn-style {
    	position: absolute;
    	top: 90%;
        left: 80%;
        transform: translate(-49%, -48%);
  	}
  
  	.group-title-label {
		text-align: start;
		font-family: "Raleway";
		font-weight: bold;
		font-size: 16px;
		color: #e25d26;
		margin-bottom: 0.5rem;
  	}
  
  	.sub-title-label {
		text-align: start;
		font-family: "Raleway";
		font-weight: bold;
		font-size: 14px;
		color: #e25d26;
		margin-bottom: 0.3rem;
  	}
  
  	.item-group {
    	padding: 0px 10px 0px 10px;
  	}
  
  	.slider {
		-webkit-appearance: none;
		 width: 100%;
		 height: 1px;
		 background: #F3631D80;
		 border-color: transparent;
		 border-radius: 100px;
		 outline: none;
		 box-shadow: -4px -4px 6px rgba(255, 255, 255, 0.5), 4px 4px 6px rgba(226, 92, 27, 0.2), inset 0px 4px 6px rgba(226, 92, 27, 0.5);
  	}
  
   	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
     	appearance: none;
     	width: 1px;
     	height: 1px;
     	background: transparent;
     	cursor: pointer;
  	}
  
	.slider-thumb {
        position: absolute;
        width: 18px;
        height: 18px;
        background: #4A6B8A;
        border-radius: 12px;
        top: 56%;
        transform: translate(-50%, -50%);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #EEEEEE;
        font-family: Raleway;
        font-size: 15px;
        font-weight: semi-bold;
        user-select: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        z-index: 2;
    }
  
  	.trigger-select {
    	font-size: 12px;
    	color: white;
        height: 20px;
    	border: 1px solid #3a617c;
        border-radius: 4px;
        background-color: #3a617c;
    	width: 100%;
  	}
  
  	.select-row {
    	display: flex;
		gap: 8px;
		width: 100%;
		align-items: center;
  	}

  	.color-picker {
		border: none;
      	border-radius: 6px;
      	cursor: pointer;
      	flex: 1;
      	background: none;
      	-webkit-appearance: none;
      	-moz-appearance: none;
      	appearance: none;  
	}
           
	.color-picker::-webkit-color-swatch-wrapper {
		padding: 0;
        border: none;
        border-radius: 6px; 
	}

	.color-picker::-webkit-color-swatch {
    	border: none;
        border-radius: 6px;
	}
        
    .color-picker::-moz-color-swatch {
    	border: none;
        border-radius: 6px;
	}
	
	.xbox-vibration {
		background-color: #3A617C;
		border: 2px solid #3A617C;
		border-radius: 8px;
		padding: 5px 0px 5px 0px !important;
		text-align: center;
		align-content: center;
		color: white;
		cursor: pointer;
	}
	
	.xbox-vibration:hover {
		background-color: #e35d26;
		border-color: #e35d26;
	}
	
	#touchpad-container {
      position: relative;
    }

    .touch-point {
      position: absolute;
      width: 10px; 
      height: 10px;
      border-radius: 50%;
      background: #3a617c;
      transform: translate(-50%, -50%);
      pointer-events: none;
      transition: opacity 0.1s;
    }
    
    .touch-point.hidden {
      opacity: 0;
    }
  
  	@keyframes rotate {
    	100%{transform: rotate(360deg)}
  	}
    
	#controller-view {
    	display: none;
  	}
	
	#select-bar {
		display: none;
	}
  
	#start-btn {
  	  display: none;
  	}
	
	#xbox-vibration {
		display: none;
	}
	
	.view-card-tablet {
		padding-right: 0px;
	}
	
	.tablet-top {
		margin-top: 0px;
	}
	
	.measurement-box {
		margin-top: 24px;
	}
	
/* 	.trouble-shooting-2 li{
	list-style-image:url(../images/ul2_f_orange.png)!important;
} */

	.grey-list li {
/* 		list-style-image:url(../images/ul2_f_orange.png)!important; */
  		color: #666666;
	}
	
	@media all and (max-width: 991px) and (min-width: 768px) {
		.view-measur-row {
			display: flex;
			flex-wrap: wrap;
		}
		
		.view-card-tablet {
			padding-right: 15px;
		}
		
		.tablet-top {
			margin-top: 24px;
		}
		
		.xbox-vibration {
			width: 50%;
			justify-self: center;
		}
		
		.measurement-box {
			margin-top: 0px;
		}
	}
	
	@media all and (min-width: 1400px) {
		.rumble-label {
			max-width: 24%;
		}
		
		.rumble-slider {
			min-width: 76%;
		}
	}
	
	@media all and (min-width: 690px) and (max-width: 767px) {
		.rumble-label {
			max-width: 15%;
		}
		
		.rumble-slider {
			min-width: 85%;
		}
	}
	
	@media all and (min-width: 561px) and (max-width: 689px) {
		.rumble-label {
			max-width: 21%;
		}
		
		.rumble-slider {
			min-width: 79%;
		}
	}
</style>

<div class="container-fluid">
	<div class="row d-flew justify-content-center align-items-center" id="connect-view">
    	<div class="col-12 col-xl-5 col-lg-6 col-md-8 col-sm-10">
      		<div class="card">
				<div class="display-bar">
					<p><?php the_field('loading_connect');?></p>
				</div>
				<div class="row justify-content-center">
					<div class="col-4">
						<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/PS_front.svg" alt="" id="ps5-style">
						<p class="select-label"><?php the_field("ps5_style");?></p>
					</div>
					<div class="col-4">
						<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Switch_front.svg" alt="" id="switch-style">
						<p class="select-label"><?php the_field("switch_pro_style");?></p>
					</div>
					<div class="col-4">
						<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Xbox_front.svg" alt="" id="xbox-style">
						<p class="select-label"><?php the_field("xbox_style");?></p>
					</div>
				</div>
				<div class="connect-label-style">
					<p id='connect-label'><?php the_field('unsure_label');?></p>
				</div>
				<div class="select-bar" id="select-bar">
					<select name="gamepad-choice" id="gamepad-choice">
					</select>
				</div>
				<br/>
				<center>
					<button class="start-button" id="start-btn">
						<?php the_field("start_btn");?>
					</button>
		  		</center>
			</div>
		</div>
	</div>
  
	<div class="row justify-content-between align-items-center" id="controller-view">
    	<div class="col-lg-7 col-xl-8 col-2xl-9 col-12">
			<div class="row justify-content-center" id="touchpad-show" style="margin-bottom: 30px;">
<!-- 				<div class="col-10 col-xl-6 col-lg-8 col-md-6 col-sm-8"> -->
<!-- 					<div id="touchpad-container">
						<div id="touch-point-1" class="touch-point hidden"></div>
						<div id="touch-point-2" class="touch-point hidden"></div>
					</div> -->
				<svg id="touchpad-svg" width="216" height="135" viewBox="0.278 0.159 0.444 0.284" preserveAspectRatio="xMinYMin meet">
					<defs>
						<clipPath id="tp-clip" clipPathUnits="userSpaceOnUse">
							<path d="M0.501,0.160
							   c0,0 0.142,-0.001 0.203,0.017
							   c0.011,0.003 0.019,0.016 0.018,0.027
							   c-0.008,0.057 -0.018,0.122 -0.027,0.179
							   c-0.007,0.045 -0.037,0.060 -0.062,0.060
							   c-0.025,0 -0.133,-0.001 -0.133,-0.001
							   c0,0 -0.108,0.001 -0.133,0.001
							   c-0.025,0 -0.055,-0.015 -0.062,-0.060
							   c-0.009,-0.057 -0.019,-0.122 -0.027,-0.179
							   c-0.002,-0.011 0.007,-0.024 0.018,-0.027
							   c0.061,-0.018 0.203,-0.017 0.203,-0.017Z" />	
						</clipPath>
					</defs>

					<path fill="#3a617c88" d="M0.501,0.160
											  c0,0 0.142,-0.001 0.203,0.017
											  c0.011,0.003 0.019,0.016 0.018,0.027
											  c-0.008,0.057 -0.018,0.122 -0.027,0.179
											  c-0.007,0.045 -0.037,0.060 -0.062,0.060
											  c-0.025,0 -0.133,-0.001 -0.133,-0.001
											  c0,0 -0.108,0.001 -0.133,0.001
											  c-0.025,0 -0.055,-0.015 -0.062,-0.060
											  c-0.009,-0.057 -0.019,-0.122 -0.027,-0.179
											  c-0.002,-0.011 0.007,-0.024 0.018,-0.027
											  c0.061,-0.018 0.203,-0.017 0.203,-0.017Z" />	
					<g id="tp-points" clip-path="url(#tp-clip)">
						<circle id="tp1" r="0.0062" fill="#3a617c" />
						<circle id="tp2" r="0.0062" fill="#3a617c" />
				  </g>
				</svg>
			</div>
      		<model-viewer alt="" environment-image="neutral" exposure="1.2" shadow-intensity="1" src="<?=get_stylesheet_directory_uri();?>/assets/glbs/PS5_new.glb" camera-controls touch-action="pan-y" camera-orbit="20deg 90deg" id="model"></model-viewer>
      		<div class="btn-style row" id="btn-div">
				<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Pause-Gyros.svg" alt="" id="pause-btn">
				<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/Reset-Gyros.svg" alt="" id="reset-btn">
      		</div>
    	</div>
    	<div class="col-lg-5 col-xl-4 col-2xl-3 col-12">
			<div class="view-measur-row justify-content-center">
				<div class="view-card-tablet col-12 col-md-7 col-lg-12 col-xl-12" style="padding-left: 0px;">
					<div class="card">
						<p class="group-title-label"><?php the_field('view_title');?></p>
						<div class="row justify-content-between item-group" id="view-group">
							<div class="col-4 d-flex" style="padding: 0px;">
								<div>
									<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/PS_front.svg" alt="" id="front-item">
									<div class="item-label"><?php the_field("front_item");?></div>
								</div>
							</div>
							<div class="col-4" style="padding: 0px;">
								<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/PS_back.svg" alt="" id="back-item">
								<div class="item-label"><?php the_field("back_item");?></div>
							</div>
							<div id="free-btn" class="col-4 flex-row-reverse" style="padding: 0px;">
								<div class="align-items-end align-text-end justify-content-end">
									<img class="img-fluid skip-lazy" src="<?=get_stylesheet_directory_uri();?>/assets/images/PS_free.svg" alt="" id="free-item">
									<div class="item-label"><?php the_field("free_item");?></div>
								</div>
							</div>
						</div>
					</div>
				</div>    
				<div class="card col-12 col-md-5 col-lg-12 col-xl-12 measurement-box" id="measurement-box">
					<p class="group-title-label"><?php the_field('measurement_title');?></p>
					<div class="row justify-content-start">
						<div class="col-6" style="text-align: start">
							<p class="sub-title-label"><?php the_field('accelerometer_sub');?></p>
							<?php if(have_rows('accelerometer_infor')): ?>
								<?php
									$count = 0;
									while(have_rows('accelerometer_infor')): the_row();
									$count++;
								?>
									<div class="measurement-label" id="accel<?php echo $count; ?>"><?php the_sub_field('item'); ?>: -</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
						<div class="col-6" style="text-align: start">
							<p class="sub-title-label"><?php the_field('gyroscope_sub');?></p>
							<?php if(have_rows('gyroscope_infor')): ?>
								<?php
									$count = 0;
									while(have_rows('gyroscope_infor')): the_row();
									$count++;
								?>
									<div class="measurement-label" id="gyro<?php echo $count; ?>"><?php the_sub_field('item'); ?>: -</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div id="xbox-vibration" style="margin-top: 25px">
				<div class="xbox-vibration align-items-center">
					<?php the_field("xbox_vibration");?>
				</div>
			</div>
			<br/>
			<div class="card" id="output-box">
				<div class="view-measur-row">
					<div class="col-12 col-xl-12 col-lg-12 col-md-6 view-card-tablet" style="padding-left: 0px;">
						<p class="group-title-label"><?php the_field('output_title');?></p>
						<p class="sub-title-label"><?php the_field('rumble_sub');?></p>
						<div class="row align-items-center">
							<div class="col-3 col-xl-4 col-lg-4 rumble-label">
								<div class="select-label" style="padding-top: 0px; text-align: start"><?php the_field('soft_item');?></div>
							</div>
							<div class="col-9 col-xl-8 col-lg-8 rumble-slider">
								<input type="range" min="0" max="255" value="0" step="1" class="slider" id="soft-range">
								<div id="soft-range-thumb" class="slider-thumb"></div>
							</div>
						</div>
						<div class="row align-items-center">
							<div class="col-3 col-xl-4 col-lg-4 rumble-label">
								<div class="select-label" style="padding-top: 0px; text-align: start"><?php the_field('heavy_item');?></div>
							</div>
							<div class="col-9 col-xl-8 col-lg-8 rumble-slider">
								<input type="range" min="0" max="255" value="0" step="1" class="slider" id="heavy-range">
								<div id="heavy-range-thumb" class="slider-thumb"></div>
							</div>
						</div>
					</div>
					<div class="col-12 col-xl-12 col-lg-12 col-md-6 tablet-top" style="padding-left: 0px; padding-right: 0px;">
						<p class="sub-title-label" style="margin-top: 0.3rem"><?php the_field('trigger_sub');?></p>
						<div class="row align-items-center d-flex" style="margin-left: 0px; margin-right: 0px;">
							<div class="col-6 select-row" style="padding-left:0px; padding-right: 4px;">
								<label class="select-label"><?php the_field('left_item');?></label>
								<select class="trigger-select" id="trigger-left">
									<?php if(have_rows('trigger_value_list')): ?>
										<?php
											$count = 0;  
											while(have_rows('trigger_value_list')): the_row();
											$count++;
										?>
											<option value='<?php the_sub_field('item'); ?>'><?php the_sub_field('item'); ?></option>
										<?php endwhile; ?>
									<?php endif; ?>
								</select>
							</div>
							<div class="col-6 select-row" style="padding-left:4px; padding-right: 0px;">
								<label class="select-label"><?php the_field('right_item');?></label>
								<select class="trigger-select" id="trigger-right">
									<?php if(have_rows('trigger_value_list')): ?>
										<?php
										  $count = 0;
										  while(have_rows('trigger_value_list')): the_row();
										  $count++;
										?>
											<option value='<?php the_sub_field('item'); ?>'><?php the_sub_field('item'); ?></option>
										<?php endwhile; ?>
									<?php endif; ?>
								</select>
							</div>	
						</div>
						<div class="select-row">
							<label class="sub-title-label" style="margin-bottom: 0px"><?php the_field('led_item');?></label>
							<input type="color" class="color-picker" id="color-picker" value="#f727a4">
						</div>
					</div>
				</div>
      		</div>
		</div>
  	</div>
	
	<br/><br/>
	
	<div class="row">
		<div class="col-lg-6 col-xl-6 col-12">
			<div class="ct-row mar-bot-15 dis-flex">
				<div class="webcam-1-icon_">
					<div class="webcam-icon">
						<img class="tve_image" alt="" style="width: 50px;" src="<?php the_field('mouse_icon');?>" width="50" height="50">
					</div>
				</div>
				<div class="webcam-1-text_">
					<div class="icon-text-1">
						<h3 class="ct-bold-text"><?php the_field('get_easily_started_title');?></h3>
					</div>
				</div>
			</div>
			<div class="ct-row">
				<div class="new-webcam-desc">
					<ul>
						<?php
						if( have_rows('get_easily_started_steps') ):

						while ( have_rows('get_easily_started_steps') ) : the_row();?>
						<li>
							<span><?php the_sub_field('numbers');?></span>
							<div>
								<strong><?php the_sub_field('title');?></strong>
							</div>
						</li>
						<?php endwhile;
						else :
						endif;
						?>
					</ul>
				</div>
			</div>
			<div class="ct-row">
				<div class="mic-work-not">
					<p><?php the_field('red_notice');?></p>
				</div>
			</div>
		</div>
	
		<div class="col-lg-6 col-xl-6 col-12">
			<div class="ct-row mar-bot-15 dis-flex">
				<div class="webcam-1-icon_">
					<div class="webcam-icon">
						<img class="tve_image" alt="" style="width: 50px;" src="<?php the_field('mouse_icon');?>" width="50" height="50">
					</div>
				</div>
				<div class="webcam-1-text_">
					<div class="icon-text-1">
						<h3 class="ct-bold-text" style="color: #666666;"><?php the_field('trouble-shooting_title');?></h3>
					</div>
				</div>
			</div>

			<div class="trouble-shooting-grey dis-flex">
				<div class="trouble-shooting-text-1 pd-1">
					<ul class="grey-list">
						<?php
						if( have_rows('leftside_guide_list') ):

						while ( have_rows('leftside_guide_list') ) : the_row();?>
						<li>
							<span class="fw-bold">
								<?php the_sub_field('left_side_list_title');?>
							</span>
						</li>

						<?php endwhile;
						else :
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
		</div>
	</div>

	<div class="other-section">
		<div class="ct-row mic-settings-title">
			<span><?php the_field('links_title');?></span>
		</div>
		<div class="mic-settings-section">
			<div class="mic-settings-menu width-50 wid-md-100">
				<ul>
					<?php
					if( have_rows('links_table') ):

					while ( have_rows('links_table') ) : the_row();?>
					<li class="dis-flex">
						<div class="webcam-icon">
							<img class="tve_image" alt=""  src="<?php the_field('mouse_icon');?>" data-attachment-id="8509" width="24" height="24" style="margin-right: 10px;">
						</div>
						<div>
							<a href="<?php the_sub_field('url');?>">
								<?php the_sub_field('link_name');?>
							</a>
						</div>
					</li>
					<?php endwhile;
					else :
					endif;
					?>
				</ul>
			</div>
		</div>
		<div class="read-more-section">
			<div class="ct-row dis-flex">
				<div class="width-50 wid-xs-100">
					<div class="read-more-text-secction">
						<div class="read-more-title clearfix" >
							<h2><strong><?php the_field('more_about_title');?></strong></h2>
						</div>
						<?php
						if( have_rows('test_content') ):

						while ( have_rows('test_content') ) : the_row();?>
						<div class="read-more-1">
							<div class="read-more-subtitle clearfix">
								<h3 class="mar-bot-20"><?php the_sub_field('heading');?></h3>
							</div>
							<div class="read-more-text">
								<p><?php the_sub_field('descp');?></p>
							</div>
						</div>
						<?php endwhile;
						else :
						endif;
						?>
					</div>
				</div>

				<div class="width-50">
					<div class="img-section pad-left-15">
						<img class="lazyload" src="<?php the_field('rightside_image');?>" data-src="<?php the_field('rightside_image');?>"/>
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

<script type="module" src="https://unpkg.com/@google/model-viewer@4.1.0/dist/model-viewer.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script> -->

<script>
	(function () {
		var CRC32 = {
			crcTable: [],

      		// Generate CRC32 lookup table
      		makeCRCTable: function() {
				if (this.crcTable.length > 0) {
					return this.crcTable;
        		}

        		var table = [];
        		for (var n = 0; n < 256; ++n) {
					var c = n;
          			for (var k = 0; k < 8; ++k) {
            			c = c & 1 ? 0xEDB88320 ^ (c >>> 1) : c >>> 1;
          			}
          			table[n] = c >>> 0;
        		}
        		this.crcTable = table;
        		return table;
      		},

      		// Compute CRC32 for prefixBytes + dataView + suffixBytes
      		calculate: function(prefixBytes, dataView, suffixBytes) {
        		if (!suffixBytes) suffixBytes = [];
				var table = this.makeCRCTable();
        		var crc = -1 >>> 0;

				// Process prefix bytes
				for (var i = 0; i < prefixBytes.length; i++) {
					var byte = prefixBytes[i];
					crc = (crc >>> 8) ^ table[(crc ^ byte) & 0xFF];
				}

				// Process data view
				for (var i = 0; i < dataView.byteLength; ++i) {
					crc = (crc >>> 8) ^ table[(crc ^ dataView.getUint8(i)) & 0xFF];
				}

				// Process suffix bytes
				for (var i = 0; i < suffixBytes.length; i++) {
					var byte = suffixBytes[i];
				  	crc = (crc >>> 8) ^ table[(crc ^ byte) & 0xFF];
				}

				return (crc ^ -1) >>> 0;
			},

			// Fill CRC32 checksum for DualSense Bluetooth output report
			fillOutputReportChecksum: function(reportId, reportData) {
            	var crc = this.calculate([0xA2, reportId], new DataView(reportData.buffer, 0, reportData.byteLength - 4));
        		reportData[reportData.byteLength - 4] = (crc >>> 0) & 0xFF;
				reportData[reportData.byteLength - 3] = (crc >>> 8) & 0xFF;
				reportData[reportData.byteLength - 2] = (crc >>> 16) & 0xFF;
				reportData[reportData.byteLength - 1] = (crc >>> 24) & 0xFF;  
			}
		};
 
    	let controllerStyle;
		let controller;
		let connectedIndex;
		let gamepadList = {};
		let hidDevice;
		let handleHIDReportRef = null;
		let gyroMove = false;
		let smoothYaw = 0, smoothPitch = 90, smoothRoll = 0;
		let lastTimestamp = null; 
		let lastOrientationUpdate = 0, lastRollUpdate = 0;
		let isUSB;
		let deviceType;
		
		let triangle, circle, cross, square, up, dw, lt, rt, stickL, stickR, l1, l2, r1, r2, touchPad, directionPad, minus, plus, capture, home, minusPan, plusPan, homePan, capturePan;
		let triangleY, circleY, crossY, squareY, upY, dwY, ltY, rtY, l1Z, l2Z, r1Z, r2Z, minusY, plusY, captureY, homeY;
		let isTriangle=false, isCircle=false, isSquare=false, isCross=false, isUp=false, isDw=false, isLt=false, isRt=false, isStickL=false, isStickR=false, isL1=false, isL2=false, isR1=false, isR2=false, isTouchPad=false, isDirectionPad=false, isMinus=false, isPlus=false, isCapture=false, isHome=false;
		
		let isConnect = false;
		let gyroscopeLabel = <?php echo json_encode(get_field('gyroscope_infor')); ?>;
		let accelLabel = <?php echo json_encode(get_field('accelerometer_infor')); ?>;
		let outputSeq = 0;
		let __ds_outputSeq = 0;
		let measurementCount = 0;
		let xboxInterval;
		let detectInterval;
		
		let TOUCHPAD_REAL_WIDTH = 216;
		let TOUCHPAD_REAL_HEIGHT = 135;

		const TOUCHPAD_RANGE_X = 1920;
		const TOUCHPAD_RANGE_Y = 1080;
    
		var a = function(){};
		a__name__=!0;
    
    	a.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				a.connectView = window.document.getElementById("connect-view");
				a.controllerView = window.document.getElementById("controller-view");
				a.connectLabel = window.document.getElementById("connect-label");
				a.ps5Style = window.document.getElementById("ps5-style");
				a.xboxStyle = window.document.getElementById("xbox-style");
				a.switchStyle = window.document.getElementById("switch-style");
				a.selectBar = window.document.getElementById("select-bar");
				a.gamepadChoice = window.document.getElementById("gamepad-choice");
				a.startBtn = window.document.getElementById("start-btn");
				a.model = window.document.getElementById("model");
				a.connectBtn = window.document.getElementById("connect-hid");
				a.frontItem = window.document.getElementById("front-item");
				a.backItem = window.document.getElementById("back-item");
				a.freeItem = window.document.getElementById("free-item");
				a.viewGroup = window.document.getElementById("view-group");
				a.pitchLabel = window.document.getElementById("gyro1");
				a.rollLabel = window.document.getElementById("gyro2");
				a.yawLabel = window.document.getElementById("gyro3");
				a.softRange = window.document.getElementById("soft-range");
				a.softThumb = window.document.getElementById("soft-range-thumb");
				a.heavyRange = window.document.getElementById("heavy-range");
				a.heavyThumb = window.document.getElementById("heavy-range-thumb");
				a.triggerL = window.document.getElementById("trigger-left");
				a.triggerR = window.document.getElementById("trigger-right");
				a.colorPicker = window.document.getElementById("color-picker");		  
				a.accelXLabel = window.document.getElementById("accel1");  
				a.accelYLabel = window.document.getElementById("accel2");
				a.accelZLabel = window.document.getElementById("accel3");
				a.pauseBtn = window.document.getElementById("pause-btn");
				a.resetBtn = window.document.getElementById("reset-btn");
				a.freeBtn = window.document.getElementById("free-btn");
				a.measurementBox = window.document.getElementById("measurement-box");
				a.outputBox = window.document.getElementById("output-box");
				a.xboxVibration = window.document.getElementById("xbox-vibration");
				a.touchpadContainer = window.document.getElementById("touchpad-container");
				a.touchPoint1 = window.document.getElementById("touch-point-1");
				a.touchPoint2 = window.document.getElementById("touch-point-2");
				a.touchShow = window.document.getElementById("touchpad-show");
				a.svg = window.document.getElementById('touchpad-svg');

				const vb = a.svg.viewBox.baseVal;
				const RANGE_X = 1920, RANGE_Y = 1080;

				a.tp1 = window.document.getElementById('tp1');
				a.tp2 = window.document.getElementById('tp2');
				
				a.xboxStyle.addEventListener("click", () => {
					a.xboxStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Xbox_front_act.svg";
					a.ps5Style.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/PS_front.svg";
					a.switchStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Switch_front.svg";
					
					controllerStyle = "xbox";
					
					if(Object.keys(gamepadList).length != 0) {
						a.startBtn.style.display = "flex";
						a.connectLabel.style.display = "none";
					} else {
						a.connectLabel.innerHTML = "<?php the_field("connecting_label");?>";
					}
				});
				
				a.ps5Style.addEventListener("click", () => {
					a.xboxStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Xbox_front.svg";
					a.ps5Style.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/PS_front_act.svg";
					a.switchStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Switch_front.svg";
					
					controllerStyle = "ps";
					
					if(Object.keys(gamepadList).length != 0) {
						a.startBtn.style.display = "flex";
						a.connectLabel.style.display = "none";
					} else {
						a.connectLabel.innerHTML = "<?php the_field("connecting_label");?>";
					}
				});
				
				a.switchStyle.addEventListener("click", () => {
					a.xboxStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Xbox_front.svg";
					a.ps5Style.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/PS_front.svg";
					a.switchStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Switch_front_act.svg";
					
					controllerStyle = "switch";
					
					if(Object.keys(gamepadList).length != 0) {
						a.startBtn.style.display = "flex";
						a.connectLabel.style.display = "none";
					} else {
						a.connectLabel.innerHTML = "<?php the_field("connecting_label");?>";
					}
				});
				
				if ("hid" in navigator) {
					navigator.hid.getDevices().then(async devices => {
						const dualSense = devices.find(d => d.vendorId === 1356);
						const switchPro = devices.find(d => d.vendorId === 1406);
						if (dualSense) {
							console.log("DualSense already authorized via HID:", dualSense);
							controller = "ps";
							a.model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/PS5_new.glb";
							if(controllerStyle) {
								a.startBtn.style.display = "flex";
								a.connectLabel.style.display = "none";
							}
							clearInterval(detectInterval);
						}
						if (switchPro) {
							controller = "switch";
							a.model.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/Switch2_new.glb";

							if(controllerStyle) {
								a.startBtn.style.display = "flex";
								a.connectLabel.style.display = "none";
							}
							clearInterval(detectInterval);
						}
					});
				}
				
				detectInterval = setInterval(() => {
    				const gamepads = navigator.getGamepads();
   					for (let i = 0; i < gamepads.length; i++) {
      					const gp = gamepads[i];
      					if (gp) {
        					determineModel(gp.id); // Call your existing function to determine the controller model
        					break;
      					} 
    				}
				}, 100);
				
				const determineModel = (id) => {
					id = id.toLowerCase();
					let model;
					if(id.indexOf('xbox') !== -1 || id.indexOf('joystick') !== -1) {
						model = 'xbox';
					} else if(id.indexOf('playstation') !== -1 || id.indexOf('ps') !== -1 || id.indexOf('dual') !== -1 || id.includes('vendor: 054c')) {
           				model = 'ps';
          			} else if (id.includes('switch') || id.includes('pro controller') || id.includes('vendor: 057e')) {
						model = 'switch';
					} else {
            			model = 'xbox';
          			}
					
					if(model === "xbox") {
						controller = "xbox";
					} else if (model === "ps") {
						controller = model;
          			} else if (model == "switch") {
						controller = model;						
					}

					clearInterval(detectInterval);
				}
				
				const displayGamePadList = () => {
					a.gamepadChoice.innerHTML = "";

					if(Object.keys(gamepadList).length === 0) {
						a.gamepadChoice.innerHTML = '<option value="0">No gamepad connected</option>';
					} else {
						Object.keys(gamepadList).map((index) => {
							let value = index;
							let name = gamepadList[index].id;
							a.gamepadChoice.innerHTML += `<option value=${value}>${name}</option>`;
						});	
					}
				}
        
				window.addEventListener("gamepadconnected", (e) => {
					var gp = navigator.getGamepads()[e.gamepad.index];
					
					gamepadList[e.gamepad.index] = gp;
					
					if(controllerStyle) {
          				a.startBtn.style.display = "flex";
					}
					
					a.connectLabel.style.display = "none";
					a.selectBar.style.display = "flex";
					
					displayGamePadList();
        		});

        		window.addEventListener("gamepaddisconnected", (e) => {
					delete gamepadList[e.gamepad.index];
					displayGamePadList();

					if(Object.keys(gamepadList).length == 0) {
						a.selectBar.style.display = "none";
						a.connectLabel.innerHTML = "<?php the_field("unsure_label");?>";
						a.connectLabel.style.display = "block";
					}
					
          			a.ps5Style.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/PS_front.svg";
          			a.xboxStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Xbox_front.svg";
					a.switchStyle.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/Switch_front.svg";
          			a.startBtn.style.display = "none";
					if(a.connectView.style.display == 'none' && e.gamepad.index == connectedIndex) {
						a.connectView.style.display = 'flex';
						a.controllerView.style.display = "none";
						a.startBtn.style.display = "none";
						resetController();
						clearInterval(xboxInterval);
					}
					if(a.connectView.style.display == 'none' && e.gamepad.index != connectedIndex) {
						
					} else {
						connectedIndex = null;
						controller = null;
						controllerStyle = null;
					}
        		});
        
        		a.startBtn.addEventListener("click", async () => {
					if(hidDevice && hidDevice.opened) {
						if (handleHIDReportRef) {
             				hidDevice.removeEventListener("inputreport", handleHIDReportRef);
            			}
						await hidDevice.close();
						hidDevice = null;
					}
					
					determineModel(gamepadList[Number(a.gamepadChoice.value)].id);
					
					if(controller == "ps" || controller == "switch") {
            			connectHID();
						a.freeBtn.style.display = 'flex';
						if(a.viewGroup.classList.contains("justify-content-center")) {
							a.viewGroup.classList.remove("justify-content-center");
							a.viewGroup.classList.add("justify-content-between");
						}
						a.measurementBox.style.display = 'block';
						a.outputBox.style.display = controller == "ps" ? 'block' : 'none';
						a.xboxVibration.style.display = controller == "ps" ? 'none' : 'block';
						a.touchShow.style.display = controller == "ps" ? "flex" : 'none';
          			} else if (controller == 'xbox') {
						a.connectView.style.display = 'none';
          				a.controllerView.style.display = "flex";
						a.freeBtn.style.display = 'none';
						if(a.viewGroup.classList.contains("justify-content-between")) {
							a.viewGroup.classList.remove("justify-content-between");
							a.viewGroup.classList.add("justify-content-center");
						}
						a.measurementBox.style.display = 'none';
						a.outputBox.style.display = 'none';
						a.xboxVibration.style.display = 'block';
						a.touchShow.style.display = 'none';
						xboxInterval = setInterval(detectXbox, 1000/60);
					}
					
					connectedIndex = gamepadList[Number(a.gamepadChoice.value)].index;
					
					a.frontItem.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + (controllerStyle == "ps" ? "PS" : (controllerStyle == "switch" ? "Switch" : "Xbox")) + "_front.svg";
					a.backItem.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + (controllerStyle == "ps" ? "PS" : (controllerStyle == "switch" ? "Switch" : "Xbox")) + "_back.svg";
					a.freeItem.src="https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + (controllerStyle == "ps" ? "PS" : (controllerStyle == "switch" ? "Switch" : "Xbox")) + "_free.svg";
					
					a.model.src= "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/glbs/" + (controllerStyle == "ps" ? "PS5" : (controllerStyle == "switch" ? "Switch2" : "XBOX")) + "_new.glb";
        		});
				
				function detectXbox() {
					let gp = navigator.getGamepads()[Number(a.gamepadChoice.value)];
					for(let j=0; j<gp.buttons.length; j++){
						let button = gp.buttons[j];

						if(button && cross) {
							if(j == 0) {
								if(!isCross && button.pressed)
									isCross = true;
								cross.position.y = button.pressed ? crossY - (controllerStyle == "switch" ? 0.18 : 0.05) : crossY;
								cross.material = cross.material.clone();
								cross.material.color.set(button.pressed ? 0xE35D26 : (isCross ? 0xed8358 : 0xffffff));
							}
							if(j == 1) {
								if(!isCircle && button.pressed)
									isCircle = true;
								circle.position.y = button.pressed ? circleY - (controllerStyle == "switch" ? 0.18 : 0.05) : circleY;
								circle.material = circle.material.clone();
								circle.material.color.set(button.pressed ? 0xE35D26 : (isCircle ? 0xed8358 : 0xffffff));
							}
							if(j == 2) {
								if(!isSquare && button.pressed)
									isSquare = true;
								square.position.y = button.pressed ? squareY - (controllerStyle == "switch" ? 0.18 : 0.05) : squareY;
								square.material = square.material.clone();
								square.material.color.set(button.pressed ? 0xE35D26 : (isSquare ? 0xed8358 : 0xffffff));
							}
							if(j == 3) {
								if(!isTriangle && button.pressed)
									isTriangle = true;
								triangle.position.y = button.pressed ? triangleY - (controllerStyle == "switch" ? 0.18 : 0.05) : triangleY;
								triangle.material = triangle.material.clone();
								triangle.material.color.set(button.pressed ? 0xE35D26 : (isTriangle ? 0xed8358 : 0xffffff));
							}
							if(j == 4) {
								if(!isL1 && button.pressed)
									isL1 = true;
								l1.position.z = button.pressed ? l1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : l1Z;
								l1.material = l1.material.clone();
								l1.material.color.set(button.pressed ? 0xE35D26 : (isL1 ? 0xed8358 : 0xffffff));
							}
							if(j == 5) {
								if(!isR1 && button.pressed)
									isR1 = true;
								r1.position.z = button.pressed ? r1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : r1Z;
								r1.material = r1.material.clone();
								r1.material.color.set(button.pressed ? 0xE35D26 : (isR1 ? 0xed8358 : 0xffffff));
							}
							if(j == 6) {
								if(!isL2 && button.pressed)
									isL2 = true;
								if(controllerStyle == "switch")
									l2.position.y = button.pressed ? l2Z-0.15 : l2Z;
								else
									l2.rotation.x = button.pressed ? Math.PI*(-3/32) : 0;
								l2.material = l2.material.clone();
								l2.material.color.set(button.pressed ? 0xE35D26 : (isL2 ? 0xed8358 : 0xffffff));
							}
							if(j == 7) {
								if(!isR2 && button.pressed)
									isR2 = true;
								if(controllerStyle == "switch")
									r2.position.y = button.pressed ? r2Z-0.15 : r2Z;
								else
									r2.rotation.x = button.pressed ? Math.PI*(-3/32) : 0;
								r2.material = r2.material.clone();
								r2.material.color.set(button.pressed ? 0xE35D26 : (isR2 ? 0xed8358 : 0xffffff));
							}
							if(j == 8) {
								if(!isMinus && button.pressed)
									isMinus = true;
								minus.position.y = button.pressed ? minusY - (controllerStyle == "switch" ? 0.11 : 0.05) : minusY;
								if (controllerStyle == "ps") {
									minus.material = minus.material.clone();
									minus.material.color.set(button.pressed ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
								} else {
									minusPan.material = minusPan.material.clone();
									minusPan.material.color.set(button.pressed ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
								}
							}
							if(j == 9) {
								if(!isPlus && button.pressed)
									isPlus = true;
								plus.position.y = button.pressed ? plusY - (controllerStyle == "switch" ? 0.11 : 0.05) : plusY;
								if (controllerStyle == "ps") {
									plus.material = plus.material.clone();
									plus.material.color.set(button.pressed ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
								} else {
									plusPan.material = plusPan.material.clone();
									plusPan.material.color.set(button.pressed ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
								}
							}
							if(j == 12) {
								if(!isUp && button.pressed)
									isUp = true;
								if(controllerStyle == "ps") {
									up.position.y = button.pressed ? upY-0.05 : upY;
									up.material = up.material.clone();
									up.material.color.set(button.pressed ? 0xE35D26 : (isUp ? 0xed8358 : 0xffffff));
								} else {
									dUp = button.pressed;
								}
							}
							if(j == 13) {
								if(!isDw && button.pressed)
									isDw = true;
								if(controllerStyle == "ps") {
									dw.position.y = button.pressed ? dwY-0.05 : dwY;
									dw.material = dw.material.clone();
									dw.material.color.set(button.pressed ? 0xE35D26 : (isDw ? 0xed8358 : 0xffffff));
								} else {
									dDw = button.pressed;
								}
							}
							if(j == 14) {
								if(!isLt && button.pressed)
									isLt = true;
								if(controllerStyle == "ps") {
									lt.position.y = button.pressed ? ltY-0.05 : ltY;
									lt.material = lt.material.clone();
									lt.material.color.set(button.pressed ? 0xE35D26 : (isLt ? 0xed8358 : 0xffffff));
								} else {
									dLt = button.pressed;
								}
							}
							if(j == 15) {
								if(!isRt && button.pressed)
									isRt = true;
								if(controllerStyle == "ps") {
									rt.position.y = button.pressed ? rtY-0.05 : rtY;
									rt.material = rt.material.clone();
									rt.material.color.set(button.pressed ? 0xE35D26 : (isRt ? 0xed8358 : 0xffffff));
								} else {
									dRt = button.pressed;
								}
							}
							if(j == 16) {
								if(!isHome && button.pressed)
									isHome = true;
								home.position.y = button.pressed ? homeY - (controllerStyle == "switch" ? 0.08 : 0.05) : homeY;
								if (controllerStyle == "ps") {
									home.material = home.material.clone();
									home.material.color.set(button.pressed ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
								} else {
									homePan.material = homePan.material.clone();
									homePan.material.color.set(button.pressed ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
								}
							}
						}
					}
					
					if(directionPad && (controllerStyle == "switch" || controllerStyle == "xbox")) {
						if(!isDirectionPad && (dUp || dDw || dLt || dRt)) {
							isDirectionPad = true;
						}
						if(dUp || dDw || dLt || dRt) {
							if(controllerStyle == "xbox") {
								directionPad.rotation.x = dUp ? Math.PI*(-1/16) : (dDw ? Math.PI*(1/16) : 0);
								directionPad.rotation.z = dLt ? Math.PI*(1/24) : (dRt ? Math.PI*(-1/24) : 0);
							} else {
								directionPad.rotation.x = dUp ? Math.PI*(-1/20) : (dDw ? Math.PI*(1/16) : 0);
                				directionPad.rotation.z = dLt ? Math.PI*(1/20) : (dRt ? Math.PI*(-1/20) : 0);
							}
							directionPad.material = directionPad.material.clone();
							directionPad.material.color.set(0xE35D26);
						} else {
							directionPad.rotation.x = 0;
							directionPad.rotation.z = 0;
							directionPad.rotation.y = 0;
							directionPad.material = directionPad.material.clone();
							directionPad.material.color.set(isDirectionPad ? 0xed8358 : 0xffffff);
						}
					}
					
					const stickLX = gp.axes[0].toFixed(3);
					const stickLY = gp.axes[1].toFixed(3);
					const stickRX = gp.axes[2].toFixed(3);
					const stickRY = gp.axes[3].toFixed(3);
			
					if(stickL && stickR) {
						if(!isStickL && (stickLX != 0 || stickLY != 0))
							isStickL = true;
						if(controllerStyle == "switch") {
						  stickL.rotation.z = Math.PI*(-stickLX/10);
						} else {
						  stickL.rotation.y = Math.PI*((stickLX/2)/8);
						}
						stickL.rotation.x = controllerStyle == "switch" ? Math.PI*((stickLY/12)) : Math.PI*(-3/8+(stickLY/2)/8);
						stickL.material = stickL.material.clone();
						stickL.material.color.set((stickLX != 0 || stickLY != 0) ? 0xE35D26 : (isStickL ? 0xed8358 : 0xffffff));
						
						if(!isStickR && (stickRX != 0 || stickRY != 0))
							isStickR = true;
						if(controllerStyle == "switch") {
						  stickR.rotation.z = Math.PI*(-stickRX/10);
						} else {
						  stickR.rotation.y = Math.PI*((stickRX/2)/8);
						}
						stickR.rotation.x = controllerStyle == "switch" ? Math.PI*((stickRY/12)) : Math.PI*(-3/8+(stickRY/2)/8);
						stickR.material = stickR.material.clone();
						stickR.material.color.set((stickRX != 0 || stickRY != 0) ? 0xE35D26 : (isStickR ? 0xed8358 : 0xffffff));
					}
					
					a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
          			a.model.requestUpdate();
				}
				
				a.xboxVibration.addEventListener("click", async () => {
					if (controller == "xbox") {
						let gp = navigator.getGamepads().filter(item=>item!=null)[0];

						if (!gp) {
							console.log("No gamepad found at index ");
						} else if(!("vibrationActuator" in gp) || !gp["vibrationActuator" ]) {
							console.log("No Vibration");
						} else {
							gp.vibrationActuator.playEffect("dual-rumble", {
								startDelay: 0,
								duration: 1000,
								weakMagnitude: 1.0,
								strongMagnitude: 1.0
							}).then(() => console.log("Vibration started")).catch(console.log);
						}
					} else if (controller == "switch") {
						const clamp = (value, min, max) => {
						  return Math.min(Math.max(value, min), max);
						};
						const outputReportID = 0x10;
						const data = new Uint8Array(9);

						data[0] = 0x00;

						let lf = clamp(600, 40.875885, 626.286133);
						let hf = clamp(600, 81.75177, 1252.572266);

						hf = (Math.round(32 * Math.log2(hf * 0.1)) - 0x60) * 4;
						lf = Math.round(32 * Math.log2(lf * 0.1)) - 0x40;

						const amp = clamp(0.5, 0, 1);

						let hfAmp;
						if (amp === 0) {
						  hfAmp = 0;
						} else if (amp < 0.117) {
						  hfAmp = (Math.log2(amp * 1000) * 32 - 0x60) / (5 - amp ** 2) - 1;
						} else if (amp < 0.23) {
						  hfAmp = Math.log2(amp * 1000) * 32 - 0x60 - 0x5c;
						} else {
						  hfAmp = (Math.log2(amp * 1000) * 32 - 0x60) * 2 - 0xf6;
						}

						let lfAmp = Math.round(hfAmp) * 0.5;
						const parity = lfAmp % 2;
						if (parity > 0) {
						  --lfAmp;
						}
						lfAmp = lfAmp >> 1;
						lfAmp += 0x40;
						if (parity > 0) {
						  lfAmp |= 0x8000;
						}

						data[1] = hf & 0xff;
						data[2] = hfAmp + ((hf >>> 8) & 0xff);
						data[3] = lf + ((lfAmp >>> 8) & 0xff);
						data[4] += lfAmp & 0xff;

						for (let i = 0; i < 4; i++) {
						  data[5 + i] = data[1 + i];
						}

						await hidDevice.sendReport(outputReportID, new Uint8Array(data));
					}
				});
				
				async function connectHID() {
					if(!hidDevice) {
						const devices = await navigator.hid.requestDevice({filters: [{ vendorId: 1356 }, {vendorId: 1406}, {vendorId: 3853}]});

						if (devices.length === 0) {
							console.log("No HID device selected.");
							return;
						}

						hidDevice = devices[0];

						await hidDevice.open();
						await initDualSenseSensors();
						
						console.log('product', hidDevice.productName);

						if (handleHIDReportRef) {
							hidDevice.removeEventListener("inputreport", handleHIDReportRef);
						}
						handleHIDReportRef = handleHIDReport;

						const inputReport = hidDevice.collections[0].inputReports[0];
						const reportLength = inputReport.items.reduce((sum, item) => sum + (item.reportSize * item.reportCount), 0) / 8;
						isUSB = reportLength == 63 ? true : false;

						if ([0x09CC, 0x05C4].includes(hidDevice.productId)) {
							deviceType = 'shock';
						} else if (hidDevice.productId == 0x0DF2 || hidDevice.productId == 0x0CE6) {
							deviceType = 'sense';
						}
					}

          			isConnect = true;
          			hidDevice.addEventListener("inputreport", handleHIDReportRef);
          
          			a.connectView.style.display = 'none';
          			a.controllerView.style.display = "flex";
				}

				a.model.addEventListener('load', () => {
          			const threeScene = a.model[Object.getOwnPropertySymbols(a.model).find(sym => sym.description === 'scene')];

          			if (!threeScene) {
            			console.error('Cannot find internal Three.js scene.');
            			return;
          			}

					if(controllerStyle == "ps") {
						triangle = threeScene.getObjectByName('TT');
						triangleY = triangle.position.y;
						circle = threeScene.getObjectByName('CC');
						circleY = circle.position.y;
						cross = threeScene.getObjectByName('XX');
						crossY = cross.position.y;
						square = threeScene.getObjectByName('SS');
						squareY = square.position.y;
						minus = threeScene.getObjectByName('b1');
						minusY = minus.position.y;     
						plus = threeScene.getObjectByName('b2');
						plusY = plus.position.y; 
						up = threeScene.getObjectByName('up');
						upY = up.position.y;
						dw = threeScene.getObjectByName('dw');
						dwY = dw.position.y; 
						rt = threeScene.getObjectByName('rt');
						rtY = rt.position.y; 
						lt = threeScene.getObjectByName('lt');
						ltY = lt.position.y; 
						l1 = threeScene.getObjectByName('LB2');
						l1Z = l1.position.z;
						r1 = threeScene.getObjectByName('RB2');
						r1Z = r1.position.z;
						l2 = threeScene.getObjectByName('LT2');
						l2Z = l2.position.z;
						r2 = threeScene.getObjectByName('RT2');
						r2Z = r2.position.z;
						touchPad = threeScene.getObjectByName('Mesh002');
						home = threeScene.getObjectByName('Mesh014');
						homeY = home.position.y;
						stickL = threeScene.getObjectByName('J2');
						stickR = threeScene.getObjectByName('J1');
					} else if(controllerStyle == "xbox") {
						cross = threeScene.getObjectByName('Mesh015');
						crossY = cross.position.y; 
						circle = threeScene.getObjectByName('Mesh014_1');
						circleY = circle.position.y;
						square = threeScene.getObjectByName('Mesh012');
						squareY = square.position.y;
						triangle = threeScene.getObjectByName('Mesh013_1');
						triangleY = triangle.position.y;
						l1 = threeScene.getObjectByName('LB1');
						l1Z = l1.position.z;
						l2 = threeScene.getObjectByName('LT1');
						l2Z = l2.position.z;
						r1 = threeScene.getObjectByName('RB1');
						r1Z = r1.position.z;
						r2 = threeScene.getObjectByName('RT1');
						r2Z = r2.position.z;
						minus = threeScene.getObjectByName('sq');
						minusY = minus.position.y;
						minusPan = threeScene.getObjectByName('Mesh010');
						plus = threeScene.getObjectByName('eq');
						plusY = plus.position.y;
						plusPan = threeScene.getObjectByName("Mesh011_1");
						home = threeScene.getObjectByName('S');
						homeY = home.position.y;
						homePan = threeScene.getObjectByName('Mesh_1');
						directionPad = threeScene.getObjectByName('P1');
						stickL = threeScene.getObjectByName('J2');
						stickR = threeScene.getObjectByName('J1');
					} else if (controllerStyle == "switch") {
						circle = threeScene.getObjectByName('button2');
						circleY = circle.position.y; 
						cross = threeScene.getObjectByName('button5');
						crossY = cross.position.y;
						triangle = threeScene.getObjectByName('button4');
						triangleY = triangle.position.y;
						square = threeScene.getObjectByName('button3');
						squareY = square.position.y;
						l1 = threeScene.getObjectByName('Mesh014');
						l1Z = l1.position.z;
						l2 = threeScene.getObjectByName('Mesh013');
						l2Z = l2.position.z;
						r1 = threeScene.getObjectByName('Mesh015');
						r1Z = r1.position.z;
						r2 = threeScene.getObjectByName('Mesh016');
						r2Z = r2.position.z;
						minus = threeScene.getObjectByName('button11');
						minusY = minus.position.y;
 						minusPan = threeScene.getObjectByName('Mesh010');
						plus = threeScene.getObjectByName('button10');
						plusY = plus.position.y;
 						plusPan = threeScene.getObjectByName("Mesh009");
						capture = threeScene.getObjectByName('button6');
						captureY = capture.position.y;
						capturePan = threeScene.getObjectByName("Mesh005");
						home = threeScene.getObjectByName('button12');
						homeY = home.position.y;
						homePan = threeScene.getObjectByName('Mesh011');
						directionPad = threeScene.getObjectByName('button8');
						stickL = threeScene.getObjectByName('button7');
						stickR = threeScene.getObjectByName('button1');
					}
				});  
				a.frontItem.addEventListener("click", async () => {
					let controllerIcon = controller == "ps" ? "PS" : (controller == "switch" ? "Switch" : "Xbox");
          			a.frontItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_front_act.svg";
          			a.backItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_back.svg";
          			a.freeItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_free.svg";
          
          			gyroMove = false;
          			a.model.cameraOrbit = '0deg 90deg';
          			a.model.orientation = '0 0 0 0';
          			a.model.cameraControls = true;
          			a.pitchLabel.innerHTML = `${gyroscopeLabel[0].item}: -`;
          			a.rollLabel.innerHTML = `${gyroscopeLabel[1].item}: -`;
          			a.yawLabel.innerHTML = `${gyroscopeLabel[2].item}: -`;					
				});
        
        		a.backItem.addEventListener("click", async () => {
					let controllerIcon = controller == "ps" ? "PS" : (controller == "switch" ? "Switch" : "Xbox");
          			a.frontItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_front.svg";
          			a.backItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_back_act.svg";
          			a.freeItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_free.svg";
          
          			gyroMove = false;
          			a.model.cameraOrbit = '180deg 90deg';
          			a.model.orientation = '0 0 0 0';
          			a.model.cameraControls = true;
          			a.pitchLabel.innerHTML = `${gyroscopeLabel[0].item}: -`;
          			a.rollLabel.innerHTML = `${gyroscopeLabel[1].item}: -`;
          			a.yawLabel.innerHTML = `${gyroscopeLabel[2].item}: -`;
        		});
        
				a.freeItem.addEventListener("click", async () => {
					let controllerIcon = controller == "ps" ? "PS" : (controller == "switch" ? "Switch" : "Xbox");
					a.frontItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_front.svg";
				  	a.backItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_back.svg";
				  	a.freeItem.src = "https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/images/" + controllerIcon + "_free_act.svg";
          
          			gyroMove = true;
          			a.model.cameraOrbit = '0deg 90deg';
          			a.model.orientation = '0 0 0 0';
          			a.model.cameraControls = false;
          			smoothYaw = 0;
          			smoothPitch = 90;
          			smoothRoll = 0;
        		});
                
				async function setVibration(softValue, heavyValue) {
            		if (isUSB) {
            			// USB: Simple 47-byte report
						const rumbleData = new Uint8Array(47);
						rumbleData[0] = 0x03;  // validFlag0: bits 0 & 1 set (rumble)
						rumbleData[1] = 0xF7;  // validFlag1 default
						rumbleData[2] = softValue;   // bcVibrationRight (soft)
						rumbleData[3] = heavyValue;  // bcVibrationLeft (heavy)

						try {
						  await hidDevice.sendReport(0x02, rumbleData);
						} catch (err) {
						  console.warn('Failed to send USB report:', err);
						}
					} else {
            			const rumbleData = new Uint8Array(77);

						rumbleData[0] = (outputSeq << 4);
						if (++outputSeq === 256) {
							outputSeq = 0;
						}

						//Byte 1: Report type
						rumbleData[1] = 0x10;

				        // Bytes 2-48: Original 47-byte payload
						rumbleData[2] = 0x03;  // validFlag0: bits 0 & 1 set (rumble)
						rumbleData[3] = 0xF7;  // validFlag1 default
						rumbleData[4] = softValue;   // bcVibrationRight (soft)
						rumbleData[5] = heavyValue;  // bcVibrationLeft (heavy)

						// Rest of payload bytes remain 0 (defaults are fine)

						// Add CRC32 checksum to bytes 49-76
						// You need to import the CRC function from the project
						CRC32.fillOutputReportChecksum(0x31, rumbleData);

						try {
						  await hidDevice.sendReport(0x31, rumbleData);
						} catch (err) {
						  console.warn('Failed to send Bluetooth report:', err);
						}
					}
				}
        
				async function updateSoftRange() {
					let slider = a.softRange;
          
					let percent = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
          
					let bgGradient = `linear-gradient(to right, #F3631D 0%, #F3631D ${percent}%, #F3631D80 ${percent}%, #F3631D80 100%)`;
          			slider.style.background = bgGradient;
          			a.softThumb.style.left = `calc(${percent}% + (${15 - percent * 0.28}px))`;
          
          			setVibration(slider.value, a.heavyRange.value);
          			if(slider.value == 0) {
						setVibration(0, 0);
          			}
        		}
        
				a.softRange.addEventListener("input", updateSoftRange);
				a.softRange.addEventListener("mouseup", onMouseUpSoft);
				a.softRange.addEventListener("touchend", onMouseUpSoft);

				let isDraggingSoft = false;
				let startSoftX, sliderSoftLeft;
        
        		function startDragSoft(e) {
					let thumb = this;
          			isDraggingSoft = true;
          			startSoftX = (e.clientX || e.touches[0].clientX) - a.softThumb.offsetLeft;
          			sliderSoftLeft = a.softRange.getBoundingClientRect().left;

          			document.addEventListener('mousemove', onMouseMoveSoft);
          			document.addEventListener('mouseup', onMouseUpSoft);
          			document.addEventListener('touchmove', onMouseMoveSoft);
          			document.addEventListener('touchend', onMouseUpSoft);
        		}
        
				a.softThumb.addEventListener('mousedown', startDragSoft);
				a.softThumb.addEventListener('touchstart', startDragSoft);

        		function onMouseMoveSoft(e) {
          			let slider = a.softRange;
          
          			if (!isDraggingSoft) return;

          			const sliderWidth = a.softRange.offsetWidth;
          			const newX = (e.clientX || e.touches[0].clientX) - startSoftX;
          			let percent = Math.max(0, Math.min(100, ((newX) / sliderWidth) * 100));
          
          			const value = (percent * (a.softRange.max - slider.min) / 100) + Number(a.softRange.min);
          			a.softRange.value = value;
          			updateSoftRange();
        		}

        		function onMouseUpSoft() {
          			isDraggingSoft = false;
          			let initialSpeed = 1;
          			const interval = setInterval(() => {
						if (a.softRange.value <= 2) {
                			a.softRange.value = 0;
                			clearInterval(interval);
            			} else {
                			a.softRange.value = Math.max(0, a.softRange.value - initialSpeed);
            			}
            			initialSpeed = initialSpeed + 1;
              			updateSoftRange();
            		}, 10);
          			document.removeEventListener('mousemove', onMouseMoveSoft);
					document.removeEventListener('mouseup', onMouseUpSoft);
        		}
        
        		async function updateHeavyRange() {
          			let slider = a.heavyRange;
          
          			let percent = ((slider.value - slider.min) / (slider.max - slider.min)) * 100;
          
          			let bgGradient = `linear-gradient(to right, #F3631D 0%, #F3631D ${percent}%, #F3631D80 ${percent}%, #F3631D80 100%)`;
          			slider.style.background = bgGradient;
          			a.heavyThumb.style.left = `calc(${percent}% + (${15 - percent * 0.28}px))`;
          
          			setVibration(a.softRange.value, slider.value);
          			if(slider.value == 0) {
            			setVibration(0, 0);
          			}
        		}
       
				a.heavyRange.addEventListener("input", updateHeavyRange);
        		a.heavyRange.addEventListener("mouseup", onMouseUpHeavy);
        		a.heavyRange.addEventListener("touchend", onMouseUpHeavy);
        
        		let isDraggingHeavy = false;
        		let startHeavyX, sliderHeavyLeft;
        
        		function startDragHeavy(e) {
          			let thumb = this;
          			isDraggingHeavy = true;
          			startHeavyX = (e.clientX || e.touches[0].clientX) - a.heavyThumb.offsetLeft;
          			sliderHeavyLeft = a.heavyRange.getBoundingClientRect().left;

					document.addEventListener('mousemove', onMouseMoveHeavy);
					document.addEventListener('mouseup', onMouseUpHeavy);
					document.addEventListener('touchmove', onMouseMoveHeavy);
					document.addEventListener('touchend', onMouseUpHeavy);
        		}
        
        		a.heavyThumb.addEventListener('mousedown', startDragHeavy);
        		a.heavyThumb.addEventListener('touchstart', startDragHeavy);

				function onMouseMoveHeavy(e) {
          			let slider = a.heavyRange;
          
          			if (!isDraggingHeavy) return;

          			const sliderWidth = a.heavyRange.offsetWidth;
          			const newX = (e.clientX || e.touches[0].clientX) - startHeavyX;
          			let percent = Math.max(0, Math.min(100, ((newX) / sliderWidth) * 100));
          
          			const value = (percent * (a.heavyRange.max - slider.min) / 100) + Number(a.heavyRange.min);
          			a.heavyRange.value = value;
          			updateHeavyRange();
        		}

        		function onMouseUpHeavy() {
          			isDraggingHeavy = false;
          
          			let initialSpeed = 1;
          			const interval = setInterval(() => {
            			if (a.heavyRange.value <= 2) {
                			a.heavyRange.value = 0;
                			clearInterval(interval);
            			} else {
                			a.heavyRange.value = Math.max(0, a.heavyRange.value - initialSpeed);
            			}
            			initialSpeed = initialSpeed + 1;
              			updateHeavyRange();
            		}, 10);
          
				  	document.removeEventListener('mousemove', onMouseMoveHeavy);
				  	document.removeEventListener('mouseup', onMouseUpHeavy);
        		}
        
				async function setTrigger() {
          			const propertyL = a.triggerL.value;
          			const propertyR = a.triggerR.value;
          
          			if(isUSB) {
			  			const triggerData = new Uint8Array(47);

			  			triggerData[0] = 0x0C;  // validFlag0: bit 2 set for left trigger
	          			triggerData[1] = 0xF7;  // validFlag1 default

			  			if(propertyL == "Off") {
				  			triggerData[21] = 0x00;
			  			} else if(propertyL == "Resistance") {
				  			triggerData[21] = 0x01;
				  			triggerData[22] = 40;
				  			triggerData[23] = 230;
			  			} else if (propertyL == "Trigger") {
						  	triggerData[21] = 0x02;
				  			triggerData[22] = 15;
				  			triggerData[23] = 100;
				  			triggerData[24] = 255;
			  			} else if(propertyL == "Automatic Trigger") {
				  			triggerData[21] = 0x06;
				  			triggerData[22] = 10;
				  			triggerData[23] = 255;
				  			triggerData[24] = 20;
			  			}

						if(propertyR == "Off") {
				  			triggerData[10] = 0x00;
			  			} else if(propertyR == "Resistance") {
				  			triggerData[10] = 0x01;
				  			triggerData[11] = 40;
				  			triggerData[12] = 230;
			  			} else if (propertyR == "Trigger") {
				  			triggerData[10] = 0x02;
				  			triggerData[11] = 15;
				  			triggerData[12] = 100;
				  			triggerData[13] = 255;
			  			} else if(propertyR == "Automatic Trigger") {
				  			triggerData[10] = 0x06;
				  			triggerData[11] = 10;
				  			triggerData[12] = 255;
				  			triggerData[13] = 20;
			  			}

			  			try {
				  			await hidDevice.sendReport(0x02, triggerData);
			  			} catch (err) {
				  			console.warn('Failed to send USB report:', err);
			  			}
		  			} else {
			  			const triggerData = new Uint8Array(77);
           
			  			triggerData[0] = (outputSeq << 4);
			  			if (++outputSeq === 256) {
				  			outputSeq = 0;
			  			}
           
						triggerData[1] = 0x10;
						triggerData[2] = 0x0C;
						triggerData[3] = 0xF7;

						// Left trigger configuration (Bluetooth positions: +2 offset)
					  	if(propertyL == "Off") {
							triggerData[23] = 0x00;
					  	} else if(propertyL == "Resistance") {
						  	triggerData[23] = 0x01;
						  	triggerData[24] = 40;
						  	triggerData[25] = 230;
					  	} else if (propertyL == "Trigger") {
						  	triggerData[23] = 0x02;
						  	triggerData[24] = 15;
						  	triggerData[25] = 100;
						  	triggerData[26] = 255;
					  	} else if(propertyL == "Automatic Trigger") {
						  	triggerData[23] = 0x06;
						  	triggerData[24] = 10;
						  	triggerData[25] = 255;
						  	triggerData[26] = 20;
					  	}
           
			  			// Right trigger configuration (Bluetooth positions: +2 offset)
					  	if(propertyR == "Off") {
							triggerData[12] = 0x00;
					  	} else if(propertyR == "Resistance") {
						  	triggerData[12] = 0x01;
						  	triggerData[13] = 40;
						  	triggerData[14] = 230;
					  	} else if (propertyR == "Trigger") {
						  	triggerData[12] = 0x02;
						  	triggerData[13] = 15;
						  	triggerData[14] = 100;
						  	triggerData[15] = 255;
					  	} else if(propertyR == "Automatic Trigger") {
						  	triggerData[12] = 0x06;
						  	triggerData[13] = 10;             
						  	triggerData[14] = 255;
						  	triggerData[15] = 20;           
					  	}

					  	CRC32.fillOutputReportChecksum(0x31, triggerData);

					  	try {
						  	await hidDevice.sendReport(0x31, triggerData);
					  	} catch (err) {
						  	console.warn('Failed to send Bluetooth report:', err);
					  	}
		  			}
				}
        
				a.triggerL.addEventListener("change", () => {
          			setTrigger();
        		});
        
        		a.triggerR.addEventListener("change", () => {
          			setTrigger();
        		});
		  
		  		a.colorPicker.addEventListener("input", async () => { 
					let cleanHex = a.colorPicker.value.startsWith('#') ? a.colorPicker.value.slice(1) : a.colorPicker.value;

				  	if (cleanHex.length === 3) {
						cleanHex = cleanHex.split('').map(char => char + char).join('');
				  	}

				  	if (cleanHex.length !== 6) {
						throw new Error('Invalid hex color format. Expected 3 or 6 digits.');
				  	}

				  	const r = parseInt(cleanHex.substring(0, 2), 16);
				  	const g = parseInt(cleanHex.substring(2, 4), 16);
				  	const b = parseInt(cleanHex.substring(4, 6), 16);
			  
			  		if (isUSB) {
				  		const ledData = new Uint8Array(47);
				  		ledData[0] = 0x00;  // validFlag0
						ledData[1] = 0x04;  // validFlag1 (bit 2 set for lightbar)
						ledData[44] = r;   // Red component
						ledData[45] = g; // Green component  
						ledData[46] = b;  // Blue component

						try {
					  		await hidDevice.sendReport(0x02, ledData);
						} catch (err) {
					  		console.warn('Failed to send LED report:', err);
						}
		  			} else {
						// Bluetooth implementation (similar to your trigger code)
						const ledData = new Uint8Array(77);
						ledData[0] = (outputSeq << 4);
						if (++outputSeq === 256) outputSeq = 0;
						ledData[1] = 0x10;
						ledData[2] = 0x00;  // validFlag0
						ledData[3] = 0xF7;  // validFlag1 (bit 2 set for lightbar)
						ledData[46] = r;   // Red component (44 + 2)
						ledData[47] = g; // Green component (45 + 2)
						ledData[48] = b;  // Blue component (46 + 2)

						CRC32.fillOutputReportChecksum(0x31, ledData);
						try {
						  await hidDevice.sendReport(0x31, ledData);
						} catch (err) {
						  console.warn('Failed to send Bluetooth LED report:', err);
						}
					}
				});
        
				const inputReportOffsetUSB = createInputReportOffset(true);
        		const inputReportOffsetBluetooth = createInputReportOffset(false);
        
        		function createInputReportOffset() {
          			const num = isUSB ? 0 : (deviceType == 'shock' ? 2 : 1);
          			return {
            			stickLX: 0 + num,
						stickLY: 1 + num,
						stickRX: 2 + num,
						stickRY: 3 + num,
						digitalKeys: (deviceType == 'shock' ? 4 : 7) + num,
						triggerL: (deviceType == 'shock' ? 7 : 4) + num,
						triggerR: (deviceType == 'shock' ? 8 : 5) + num,
						gyroPitch: (deviceType == 'shock' ? 12 : 15) + num,
						gyroYaw: (deviceType == 'shock' ? 14 : 17) + num,
						gyroRoll: (deviceType == 'shock' ? 16 : 19) + num,
						accelX : (deviceType == 'shock' ? 18 : 21) + num,
					  	accelY : (deviceType == 'shock' ? 20 : 23) + num,
					  	accelZ : (deviceType == 'shock' ? 22 : 25) + num,
						touchData: (deviceType == 'shock' ? 34 : 32) + num
					};
				}

				// Check WebHID support
				if ("hid" in navigator) {
				  console.log("WebHID is supported!");
				} else {
				  console.log("WebHID is not supported on your browser.");
				}

        		async function initDualSenseSensors() {
          			if (!hidDevice || !hidDevice.opened) {
						console.error('Device not connected or not opened.');
					  	return;
          			}

          			try {
						if (controller == "ps") {
							await hidDevice.receiveFeatureReport(0x05);
							console.log('Sensor initialization report sent successfully.');
						} else if(controller == "switch") {
							const subcommand = [0x40, 0x01];
							const data = [
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  0x00,
							  ...subcommand,
							];
							await hidDevice.sendReport(0x01, new Uint8Array(data));
							console.log("enable gyroscope in switch pro");
						}
          			} catch (error) {
          				console.error('Failed to send initialization report:', error);
          			}
				}
        
        		if(isConnect) {
          			handleHIDReportRef = handleHIDReport;
          			hidDevice.addEventListener("inputreport", handleHIDReportRef);
        		}

        		async function handleReconnect() {
					const devices = await navigator.hid.getDevices();
				  	hidDevice = devices.find(device => device.vendorId === 1356);
					
          			if (hidDevice) {
            			await hidDevice.open();
            			await initDualSenseSensors();
            			if (handleHIDReportRef) {
            				hidDevice.removeEventListener("inputreport", handleHIDReportRef);
            			}
          				handleHIDReportRef = handleHIDReport;
          			} else {
          				console.warn("No controller found after reconnect.");
          			}
				}

// 				navigator.hid.addEventListener('connect', handleReconnect);
		        navigator.hid.addEventListener('disconnect', e => disconnectHIDDevice(e));
				
				const clamp = (v, lo, hi) => Math.max(lo, Math.min(hi, v));

				function handleHIDReport(event) {
					const now = performance.now();
					if (now - lastOrientationUpdate < 1000/60 || !triangle) {
            			return;
          			}
				  	lastOrientationUpdate = now;
					const { data, timeStamp } = event;
				  	const view = new DataView(data.buffer);

				  	const offsets = createInputReportOffset();
				  	if(controller == "ps") {
						const keys = view.getInt8(offsets.digitalKeys, true);
						const keys1 = view.getInt8(offsets.digitalKeys + 1, true);
						const keys2 = view.getInt8(offsets.digitalKeys + 2, true);

						if(!isTriangle && (keys & 128) !==0)
							isTriangle = true;
                        triangle.position.y = (keys & 128) !==0 ? triangleY - (controllerStyle == "switch" ? 0.18 : 0.05) : triangleY;
                        triangle.material = triangle.material.clone();
                        triangle.material.color.set((keys & 128) !==0 ? 0xE35D26 : (isTriangle ? 0xed8358 : 0xffffff));

						if(!isCircle && (keys & 64) !==0)
							isCircle = true;
						circle.position.y = (keys & 64) !==0 ? circleY - (controllerStyle == "switch" ? 0.18 : 0.05) : circleY;
						circle.material = circle.material.clone();
						circle.material.color.set((keys & 64) !== 0 ? 0xE35D26 : (isCircle ? 0xed8358 : 0xffffff));

						if(!isCross && (keys & 32) !==0)
							isCross = true;
						cross.position.y = (keys & 32) !==0 ? crossY - (controllerStyle == "switch" ? 0.18 : 0.05) : crossY;
						cross.material = cross.material.clone();
						cross.material.color.set((keys & 32) !== 0 ? 0xE35D26 : (isCross ? 0xed8358 : 0xffffff));

						if(!isSquare && (keys & 16) !==0)
							isSquare = true;
						square.position.y = (keys & 16) !==0 ? squareY - (controllerStyle == "switch" ? 0.18 : 0.05) : squareY;
                        square.material = square.material.clone();
						square.material.color.set((keys & 16) !== 0 ? 0xE35D26 : (isSquare ? 0xed8358 : 0xffffff));

						if(!isMinus && (keys1 & 16) !==0)
							isMinus = true;
						minus.position.y = (keys1 & 16) !==0 ? minusY - (controllerStyle == "switch" ? 0.11 : 0.05) : minusY;
                        if (controllerStyle == "ps") {
                           minus.material = minus.material.clone();
                           minus.material.color.set((keys1 & 16) !==0 ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
                        } else {
                           minusPan.material = minusPan.material.clone();
                           minusPan.material.color.set((keys1 & 16) !==0 ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
                        }

						if(!isPlus && (keys1 & 32) !==0)
							isPlus = true;
						plus.position.y = (keys1 & 32) !==0 ? plusY - (controllerStyle == "switch" ? 0.11 : 0.05) : plusY;
                        if (controllerStyle == "ps") {
                           plus.material = plus.material.clone();
                           plus.material.color.set((keys1 & 32) !==0 ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
                        } else {
                           plusPan.material = plusPan.material.clone();
                           plusPan.material.color.set((keys1 & 32) !==0 ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
                        }

						const direction = keys & 15;
						if(!isUp && direction == 0)
							isUp = true;
						if(controllerStyle == "ps") {
                           up.position.y = direction == 0 ? upY-0.05 : upY;
                           up.material = up.material.clone();
                           up.material.color.set(direction == 0 ? 0xE35D26 : (isUp ? 0xed8358 : 0xffffff));
                        } else {
                           dUp = direction == 0;
                        }

						if(!isDw && direction == 4)
							isDw = true;
						if(controllerStyle == "ps") {
                           dw.position.y = direction == 4 ? dwY-0.05 : dwY;
                           dw.material = dw.material.clone();
                           dw.material.color.set(direction == 4 ? 0xE35D26 : (isDw ? 0xed8358 : 0xffffff));
                        } else {
                           dDw = direction == 4;
                        }

						if(!isRt && direction == 2)
							isRt = true;
						if(controllerStyle == "ps") {
                           rt.position.y = direction == 2 ? rtY-0.05 : rtY;
                           rt.material = rt.material.clone();
                           rt.material.color.set(direction == 2 ? 0xE35D26 : (isRt ? 0xed8358 : 0xffffff));
                        } else {
                           dRt = direction == 2;
                        }

						if(!isLt && direction == 6)
							isLt = true;
						if(controllerStyle == "ps") {
                           lt.position.y = direction == 6 ? ltY-0.05 : ltY;
                           lt.material = lt.material.clone();
                           lt.material.color.set(direction == 6 ? 0xE35D26 : (isLt ? 0xed8358 : 0xffffff));
                        } else {
                           dLt = direction == 6;
                        }
						
						if(directionPad && (controllerStyle == "switch" || controllerStyle == "xbox")) {
						  if(!isDirectionPad && (dUp || dDw || dLt || dRt)) {
							 isDirectionPad = true;
						  }
						  if(dUp || dDw || dLt || dRt) {
							 if(controllerStyle == "xbox") {
								directionPad.rotation.x = dUp ? Math.PI*(-1/16) : (dDw ? Math.PI*(1/16) : 0);
								directionPad.rotation.z = dLt ? Math.PI*(1/24) : (dRt ? Math.PI*(-1/24) : 0);
							 } else {
								directionPad.rotation.x = dUp ? Math.PI*(-1/20) : (dDw ? Math.PI*(1/16) : 0);
								directionPad.rotation.z = dLt ? Math.PI*(1/20) : (dRt ? Math.PI*(-1/20) : 0);
							 }
							 directionPad.material = directionPad.material.clone();
							 directionPad.material.color.set(0xE35D26);
						  } else {
							 directionPad.rotation.x = 0;
							 directionPad.rotation.z = 0;
							 directionPad.rotation.y = 0;
							 directionPad.material = directionPad.material.clone();
							 directionPad.material.color.set(isDirectionPad ? 0xed8358 : 0xffffff);
						  }
					   }

						if(!isL1 && (keys1 & 1) !==0)
							isL1 = true;
						l1.position.z = (keys1& 1) !== 0 ? l1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : l1Z;
                        l1.material = l1.material.clone();
                        l1.material.color.set((keys1 & 1) !== 0 ? 0xE35D26 : (isL1 ? 0xed8358 : 0xffffff));

						if(!isR1 && (keys1 & 2) !==0)
							isR1 = true;
						r1.position.z = (keys1 & 2) !==0 ? r1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : r1Z;
                        r1.material = r1.material.clone();
                        r1.material.color.set((keys1 & 2) !==0 ? 0xE35D26 : (isR1 ? 0xed8358 : 0xffffff));

						const triggerL = view.getUint8(offsets.triggerL);
						if(!isL2 && triggerL !==0)
							isL2 = true;
						if(controllerStyle == "switch")
							l2.position.y = triggerL !==0 ? l2Z-0.15*(triggerL/255) : l2Z;
                        else
                           l2.rotation.x = triggerL !==0 ? Math.PI*(-3/32*(triggerL/255)) : 0;
                        l2.material = l2.material.clone();
                        l2.material.color.set(triggerL !==0 ? 0xE35D26 : (isL2 ? 0xed8358 : 0xffffff));

						const triggerR = view.getUint8(offsets.triggerR);
						if(!isR2 && triggerR !==0)
							isR2 = true;
						if(controllerStyle == "switch")
                           r2.position.y = triggerR !==0 ? r2Z-0.15*(triggerR/255) : r2Z;
                        else
                           r2.rotation.x = triggerR !==0 ? Math.PI*(-3/32*(triggerR/255)) : 0;
                        r2.material = r2.material.clone();
                        r2.material.color.set(triggerR !==0 ? 0xE35D26 : (isR2 ? 0xed8358 : 0xffffff));

						if(controllerStyle == "ps") {
							if(!isTouchPad && (keys2 & 2) !==0)
								isTouchPad = true;
							touchPad.material = touchPad.material.clone();
							touchPad.material.color.set((keys2 & 2) !== 0 ? 0xE35D26 : (isTouchPad ? 0xed8358 : 0xffffff));
						}

						if(!isHome && (keys2 & 4) !==0)
							isHome = true;
						home.position.y = (keys2 & 4) !==0 ? homeY - (controllerStyle == "switch" ? 0.08 : 0.05) : homeY;
                        if (controllerStyle == "ps") {
                           home.material = home.material.clone();
                           home.material.color.set((keys2 & 4) !==0 ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
                        } else {
                           homePan.material = homePan.material.clone();
                           homePan.material.color.set((keys2 & 4) !==0 ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
                        }

						const stickLX = view.getUint8(offsets.stickLX);
						const stickLY = view.getUint8(offsets.stickLY);
						if(!isStickL && ((stickLX < 120 || stickLX > 136) || (stickLY < 120 || stickLY > 136)))
							isStickL = true;
						if(controllerStyle == "switch") {
						  stickL.rotation.z = Math.PI*((23/250-(stickLX/256)/5));
						} else {
						  stickL.rotation.y = Math.PI*(-1/16+(stickLX/256)/8);
						}
						stickL.rotation.x = controllerStyle == "switch" ? Math.PI*((-1/12+(stickLY/256)/6)) : Math.PI*(-7/16+(stickLY/256)/8);
						stickL.material = stickL.material.clone();
					  	stickL.material.color.set((stickLX < 120 || stickLX > 136) || (stickLY < 120 || stickLY > 136) ? 0xE35D26 : (isStickL ? 0xed8358 : 0xffffff));

						const stickRX = view.getUint8(offsets.stickRX);
						const stickRY = view.getUint8(offsets.stickRY);
						if(!isStickR && ((stickRX < 120 || stickRX > 136) || (stickRY < 120 || stickRY > 136)))
							isStickR = true;
						if(controllerStyle == "switch") {
						  stickR.rotation.z = Math.PI*((23/250-(stickRX/256)/5));
						} else {
						  stickR.rotation.y = Math.PI*(-1/16+(stickRX/256)/8);
						}
						stickR.rotation.x = controllerStyle == "switch" ? Math.PI*((-1/12+(stickRY/256)/6)) : Math.PI*(-7/16+(stickRY/256)/8);
						stickR.material = stickR.material.clone();
					  	stickR.material.color.set((stickRX < 120 || stickRX > 136) || (stickRY < 120 || stickRY > 136) ? 0xE35D26 : (isStickR ? 0xed8358 : 0xffffff));
						
						const point1Id = view.getUint8(offsets.touchData);
					 	const point1X = ((view.getUint8(offsets.touchData + 2) & 15) << 8) | (view.getUint8(offsets.touchData + 1));
					  	const point1Y = (view.getUint8(offsets.touchData + 3) << 4) | (view.getUint8(offsets.touchData + 2) >> 4);
						
						if(point1Id < 128) {
							const x1 = clamp(point1X, 0, RANGE_X - 1);
    						const y1 = clamp(point1Y, 0, RANGE_Y - 1);							
							a.tp1.setAttribute('cx', vb.x + (x1 / RANGE_X) * vb.width);
							a.tp1.setAttribute('cy', vb.y + (y1 / RANGE_Y) * vb.height);
							a.tp1.style.opacity = '1';
						} else {
							a.tp1.style.opacity = '0';
						}
						
						const point2Id = view.getUint8(offsets.touchData + 4);
  						const point2X = ((view.getUint8(offsets.touchData + 6) & 15) << 8) | (view.getUint8(offsets.touchData + 5));
  						const point2Y = (view.getUint8(offsets.touchData + 7) << 4) | (view.getUint8(offsets.touchData + 6) >> 4);

						if(point2Id < 128) {
							const x2 = clamp(point2X, 0, RANGE_X - 1);
    						const y2 = clamp(point2Y, 0, RANGE_Y - 1);							
							a.tp2.setAttribute('cx', vb.x + (x2 / RANGE_X) * vb.width);
							a.tp2.setAttribute('cy', vb.y + (y2 / RANGE_Y) * vb.height);
							a.tp2.style.opacity = '1';
// 							const x2 = (point2X / TOUCHPAD_RANGE_X) * TOUCHPAD_REAL_WIDTH;
// 							const y2 = (point2Y / TOUCHPAD_RANGE_Y) * TOUCHPAD_REAL_HEIGHT;
							
// 							a.touchPoint2.style.left = x2 + 'px';
// 							a.touchPoint2.style.top = y2 + 'px';
// 							a.touchPoint2.classList.remove('hidden');
						} else {
							a.tp2.style.opacity = '0';
// 							a.touchPoint2.classList.add('hidden');
						}
						
						a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						a.model.requestUpdate();

						const ACCEL_RES_PER_G = 8192;  			
						const STANDARD_GRAVITY = 9.80665;

						if(measurementCount == 3) {
							const accelX = (view.getInt16(offsets.accelX, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;
							const accelY = (view.getInt16(offsets.accelY, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;
							const accelZ = (view.getInt16(offsets.accelZ, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;

							a.accelXLabel.innerHTML = `${accelLabel[0].item}: ${Number(accelX % 360).toFixed(2)}`;
							a.accelYLabel.innerHTML = `${accelLabel[1].item}: ${Number(accelY % 360).toFixed(2)}`;
							a.accelZLabel.innerHTML = `${accelLabel[2].item}: ${Number(accelZ % 360).toFixed(2)}`;
							measurementCount = 0;
						} else {
							measurementCount++;
						}

						if (gyroMove == true) {
							const gyroPitch = view.getInt16(offsets.gyroPitch, true);
							const gyroYaw = view.getInt16(offsets.gyroYaw, true);
							const gyroRoll = view.getInt16(offsets.gyroRoll, true);

							let currentTimestamp = performance.now(); // timeStamp is in milliseconds
							let deltaTime = 0;
							if (lastTimestamp !== null) {
								deltaTime = (currentTimestamp - lastTimestamp) / 1000; // convert to seconds
							}
							lastTimestamp = currentTimestamp;

							const alpha = 0.9;
							smoothPitch += gyroPitch*0.1*deltaTime;
							smoothYaw += gyroYaw*0.1*deltaTime;
							smoothRoll += gyroRoll*0.1*deltaTime;

							a.pitchLabel.innerHTML = `${gyroscopeLabel[0].item}: ${Number(smoothPitch % 360).toFixed(2)}`;
							a.rollLabel.innerHTML = `${gyroscopeLabel[1].item}: ${Number(smoothRoll % 360).toFixed(2)}`;
							a.yawLabel.innerHTML = `${gyroscopeLabel[2].item}: ${Number(smoothYaw % 360).toFixed(2)}`;
							a.model.cameraOrbit = `${smoothRoll % 360}deg ${180-smoothPitch % 360}deg`;
							a.model.orientation = `${3.14*(smoothYaw % 360)/180} 0 0 0`;
						} 
					} else if (controller == "switch") {
						const keys = view.getInt8(2, true);
						const keys1 = view.getInt8(3, true);
						const keys2 = view.getInt8(4, true);
						if(!isTriangle && (keys & 2)!==0)
							isTriangle = true;
						triangle.position.y = (keys & 2) !==0 ? triangleY - (controllerStyle == "switch" ? 0.18 : 0.05) : triangleY;
                        triangle.material = triangle.material.clone();
                        triangle.material.color.set((keys & 2) !==0 ? 0xE35D26 : (isTriangle ? 0xed8358 : 0xffffff));

						if(!isCircle && (keys & 8)!==0)
							isCircle = true;
						circle.position.y = (keys & 8) !==0 ? circleY - (controllerStyle == "switch" ? 0.18 : 0.05) : circleY;
						circle.material = circle.material.clone();
						circle.material.color.set((keys & 8) !== 0 ? 0xE35D26 : (isCircle ? 0xed8358 : 0xffffff));

						if(!isCross && (keys & 4)!==0)
							isCross = true;
						cross.position.y = (keys & 4) !==0 ? crossY - (controllerStyle == "switch" ? 0.18 : 0.05) : crossY;
                        cross.material = cross.material.clone();
                  		cross.material.color.set((keys & 4) !== 0 ? 0xE35D26 : (isCross ? 0xed8358 : 0xffffff));

						if(!isSquare && (keys & 1)!==0)
							isSquare = true;
						square.position.y = (keys & 1) !==0 ? squareY - (controllerStyle == "switch" ? 0.18 : 0.05) : squareY;
                        square.material = square.material.clone();
                  		square.material.color.set((keys & 1) !== 0 ? 0xE35D26 : (isSquare ? 0xed8358 : 0xffffff));

						if(!isMinus && (keys1 & 1)!==0)
							isMinus = true;
						minus.position.y = (keys1 & 1) !==0 ? minusY - (controllerStyle == "switch" ? 0.11 : 0.05) : minusY;
                        if (controllerStyle == "ps") {
                           minus.material = minus.material.clone();
                           minus.material.color.set((keys1 & 1) !==0 ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
                        } else {
                           minusPan.material = minusPan.material.clone();
                           minusPan.material.color.set((keys1 & 1) !==0 ? 0xE35D26 : (isMinus ? 0xed8358 : 0xffffff));
                        }

						if(!isPlus && (keys1 & 2)!==0)
							isPlus = true;
						plus.position.y = (keys1 & 2) !==0 ? plusY - (controllerStyle == "switch" ? 0.11 : 0.05) : plusY;
                        if (controllerStyle == "ps") {
                           plus.material = plus.material.clone();
                           plus.material.color.set((keys1 & 2) !==0 ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
                        } else {
                           plusPan.material = plusPan.material.clone();
                           plusPan.material.color.set((keys1 & 2) !==0 ? 0xE35D26 : (isPlus ? 0xed8358 : 0xffffff));
                        }
					
						if(!isHome && (keys1 & 16)!==0)
							isHome = true;
						home.position.y = (keys1 & 16) !==0 ? homeY - (controllerStyle == "switch" ? 0.08 : 0.05) : homeY;
                        if (controllerStyle == "ps") {
                           home.material = home.material.clone();
                           home.material.color.set((keys1 & 16) !==0 ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
                        } else {
                           homePan.material = homePan.material.clone();
                           homePan.material.color.set((keys1 & 16) !==0 ? 0xE35D26 : (isHome ? 0xed8358 : 0xffffff));
                        }
						
						if(!isCapture && (keys1 & 32)!==0)
							isCapture = true;
						if(controllerStyle == "switch") {
                           capture.position.y = (keys1 & 32) !==0 ? captureY - 0.08 : captureY;
							capturePan.material = capturePan.material.clone();
                           capturePan.material.color.set((keys1 & 32) !==0 ? 0xE35D26 : (isCapture ? 0xed8358 : 0xffffff));
						}
						
						if(!isUp && (keys2 & 2) != 0)
                           isUp = true;
                        if(controllerStyle == "ps") {
                           up.position.y = (keys2 & 2) != 0 ? upY-0.05 : upY;
                           up.material = up.material.clone();
                           up.material.color.set((keys2 & 2) != 0 ? 0xE35D26 : (isUp ? 0xed8358 : 0xffffff));
                        } else {
                           dUp = (keys2 & 2)!== 0;
                        }
						
						if(!isDw && (keys2 & 1)!== 0)
                           isDw = true;
                        if(controllerStyle == "ps") {
                           dw.position.y = (keys2 & 1)!== 0 ? dwY-0.05 : dwY;
                           dw.material = dw.material.clone();
                           dw.material.color.set((keys2 & 1)!== 0 ? 0xE35D26 : (isDw ? 0xed8358 : 0xffffff));
                        } else {
                           dDw = (keys2 & 1)!== 0;
                        }
						
						if(!isLt && (keys2 & 8)!==0)
                           isLt = true;
                        if(controllerStyle == "ps") {
                           lt.position.y = (keys2 & 8)!==0 ? ltY-0.05 : ltY;
                           lt.material = lt.material.clone();
                           lt.material.color.set((keys2 & 8)!==0 ? 0xE35D26 : (isLt ? 0xed8358 : 0xffffff));
                        } else {
                           dLt = (keys2 & 8)!==0;
                        }
						
						if(!isRt && (keys2 & 4)!==0)
                           isRt = true;
                        if(controllerStyle == "ps") {
                           rt.position.y = (keys2 & 4)!==0 ? rtY-0.05 : rtY;
                           rt.material = rt.material.clone();
                           rt.material.color.set((keys2 & 4)!==0 ? 0xE35D26 : (isRt ? 0xed8358 : 0xffffff));
                        } else {
                           dRt = (keys2 & 4)!==0;
                        }
						
						if(directionPad && (controllerStyle == "switch" || controllerStyle == "xbox")) {
						  if(!isDirectionPad && (dUp || dDw || dLt || dRt)) {
							 isDirectionPad = true;
						  }
						  if(dUp || dDw || dLt || dRt) {
							 if(controllerStyle == "xbox") {
								directionPad.rotation.x = dUp ? Math.PI*(-1/16) : (dDw ? Math.PI*(1/16) : 0);
								directionPad.rotation.z = dLt ? Math.PI*(1/24) : (dRt ? Math.PI*(-1/24) : 0);
							 } else {
								directionPad.rotation.x = dUp ? Math.PI*(-1/20) : (dDw ? Math.PI*(1/16) : 0);
								directionPad.rotation.z = dLt ? Math.PI*(1/20) : (dRt ? Math.PI*(-1/20) : 0);
							 }
							 directionPad.material = directionPad.material.clone();
							 directionPad.material.color.set(0xE35D26);
						  } else {
							 directionPad.rotation.x = 0;
							 directionPad.rotation.z = 0;
							 directionPad.rotation.y = 0;
							 directionPad.material = directionPad.material.clone();
							 directionPad.material.color.set(isDirectionPad ? 0xed8358 : 0xffffff);
						  }
						}
						
						if(!isL1 && (keys2 & 64)!==0)
							isL1 = true;
						l1.position.z = (keys2 & 64) !== 0 ? l1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : l1Z;
                        l1.material = l1.material.clone();
                        l1.material.color.set((keys2 & 64) !== 0 ? 0xE35D26 : (isL1 ? 0xed8358 : 0xffffff));

						if(!isR1 && (keys & 64)!==0)
							isR1 = true;
						r1.position.z = (keys & 64) !==0 ? r1Z + (controllerStyle == "switch" ? 0.15 : 0.3) : r1Z;
                        r1.material = r1.material.clone();
                        r1.material.color.set((keys & 64) !==0 ? 0xE35D26 : (isR1 ? 0xed8358 : 0xffffff));

						if(!isL2 && (keys2 & -128)!==0)
							isL2 = true;
						if(controllerStyle == "switch")
                           l2.position.y = (keys2 & -128)!==0 ? l2Z-0.15 : l2Z;
                        else
                           l2.rotation.x = (keys2 & -128)!==0 ? Math.PI*(-3/32) : 0;
                        l2.material = l2.material.clone();
                        l2.material.color.set((keys2 & -128)!==0 ? 0xE35D26 : (isL2 ? 0xed8358 : 0xffffff));

						if(!isR2 && (keys & -128)!==0)
							isR2 = true;
						if(controllerStyle == "switch")
                           r2.position.y = (keys & -128)!==0 ? r2Z-0.15 : r2Z;
                        else
                           r2.rotation.x = (keys & -128)!==0 ? Math.PI*(-3/32) : 0;
                        r2.material = r2.material.clone();
                        r2.material.color.set((keys & -128)!==0 ? 0xE35D26 : (isR2 ? 0xed8358 : 0xffffff));

						const b5 = view.getUint8(5, true);
						const b6 = view.getUint8(6, true);
						const b7 = view.getUint8(7, true);
						const stickLX = ((b6 & 0x0F) << 8) | b5;  // Combine lower nibble of b6 + b5
						const stickLY = (b7 << 4) | ((b6 & 0xF0) >> 4); 
						if(!isStickL && ((stickLX<2044 || stickLX>2052) || (stickLY<2044 || stickLY>2052)))
							isStickL = true;
						if(controllerStyle == "switch") {
							stickL.rotation.z = Math.PI*((23/250-(stickLX/4096)/5));
						} else {
							stickL.rotation.y = Math.PI*(-1/16+(stickLX/4096)/8);
						}
						stickL.rotation.x = controllerStyle == "switch" ? Math.PI*((1/12-(stickLY/4096)/6)) : Math.PI*(-5/16-(stickLY/4096)/8);
						stickL.material = stickL.material.clone();
						stickL.material.color.set(((stickLX<2044 || stickLX>2052) || (stickLY<2044 || stickLY>2052)) ? 0xE35D26 : (isStickL ? 0xed8358 : 0xffffff));
	
						const b8 = view.getUint8(8, true);
						const b9 = view.getUint8(9, true);
						const b10 = view.getUint8(10, true);
						const stickRX = ((b9 & 0x0F) << 8) | b8;  // Combine lower nibble of b6 + b5
						const stickRY = (b10 << 4) | ((b9 & 0xF0) >> 4);
						if(!isStickR && ((stickRX<2044 || stickRX>2052) || (stickRY<2044 || stickRY>2052)))
							isStickR = true;
						if(controllerStyle == "switch") {
							stickR.rotation.z = Math.PI*((23/250-(stickRX/4096)/5));
						} else {
							stickR.rotation.y = Math.PI*(-1/16+(stickRX/4096)/8);
						}
						stickR.rotation.x = controllerStyle == "switch" ? Math.PI*((1/12-(stickRY/4096)/6)) : Math.PI*(-5/16-(stickRY/4096)/8);
						stickR.material = stickR.material.clone();
						stickR.material.color.set(((stickRX<2044 || stickRX>2052) || (stickRY<2044 || stickRY>2052)) ? 0xE35D26 : (isStickR ? 0xed8358 : 0xffffff));

						a.model.scale = `${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001} ${1 + Math.random() * 0.0001}`;
						a.model.requestUpdate();

						
						const ACCEL_RES_PER_G = 8192;  			
						const STANDARD_GRAVITY = 9.80665;

						if(measurementCount == 3) {
							const accelX = (view.getInt16(12, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;
							const accelY = (view.getInt16(14, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;
							const accelZ = (view.getInt16(16, true) / ACCEL_RES_PER_G) * STANDARD_GRAVITY;

							a.accelXLabel.innerHTML = `${accelLabel[0].item}: ${Number(accelX % 360).toFixed(2)}`;
							a.accelYLabel.innerHTML = `${accelLabel[1].item}: ${Number(accelY % 360).toFixed(2)}`;
							a.accelZLabel.innerHTML = `${accelLabel[2].item}: ${Number(accelZ % 360).toFixed(2)}`;
							measurementCount = 0;
						} else {
							measurementCount++;
						}

						if (gyroMove == true) {
							const gyroPitch = view.getInt16(20, true);
							const gyroYaw = view.getInt16(22, true);
							const gyroRoll = view.getInt16(18, true);

							let currentTimestamp = performance.now(); // timeStamp is in milliseconds
							let deltaTime = 0;
							if (lastTimestamp !== null) {
								deltaTime = (currentTimestamp - lastTimestamp) / 1000; // convert to seconds
							}
							lastTimestamp = currentTimestamp;

							const alpha = 0.9;
							smoothPitch -= gyroPitch*0.1*deltaTime;
							smoothYaw += gyroYaw*0.1*deltaTime;
							smoothRoll -= gyroRoll*0.1*deltaTime;

							a.pitchLabel.innerHTML = `${gyroscopeLabel[0].item}: ${Number(smoothPitch % 360).toFixed(2)}`;
							a.rollLabel.innerHTML = `${gyroscopeLabel[1].item}: ${Number(smoothRoll % 360).toFixed(2)}`;
							a.yawLabel.innerHTML = `${gyroscopeLabel[2].item}: ${Number(smoothYaw % 360).toFixed(2)}`;
							a.model.cameraOrbit = `${smoothRoll % 360}deg ${180-smoothPitch % 360}deg`;
							a.model.orientation = `${3.14*(smoothYaw % 360)/180} 0 0 0`;
						}
					}
				}
        
				// Disconnect HID device (optional cleanup function)
        		async function disconnectHIDDevice(e) {
					if(hidDevice && hidDevice.opened) {
						if (handleHIDReportRef) {
             				hidDevice.removeEventListener("inputreport", handleHIDReportRef);
            			}
						await hidDevice.close();
						hidDevice = null;
					}
        		}
				
				function resetController() {
					isTriangle=false, isCircle=false, isSquare=false, isCross=false, isUp=false, isDw=false, isLt=false, isRt=false, isStickL=false, isStickR=false, isL1=false, isL2=false, isR1=false, isR2=false, isTouchPad=false, isDirectionPad=false, isMinus=false, isPlus=false, isCapture=false, isHome=false;
					if(controller == "ps" || controller == "switch") {				
						a.model.cameraOrbit = '0deg 90deg';
						a.model.orientation = '0 0 0 0';
						a.model.cameraControls = !gyroMove;
						smoothYaw = 0;
						smoothPitch = 90;
						smoothRoll = 0;
					}
				}
				
				a.resetBtn.addEventListener("click", () => {
					resetController();
				});
				
				a.pauseBtn.addEventListener("click", () => {
					a.connectView.style.display = 'flex';
          			a.controllerView.style.display = "none";
					resetController();
					a.model.cameraControls = true;
					if(controller == "xbox") {
						clearInterval(xboxInterval);
					} else if (controller == "ps" || controller == "switch") {
						gyroMove = false;
						hidDevice.removeEventListener("inputreport", handleHIDReportRef);
					}
				});
			});
		}
    
		a.main();
	})();
</script>
<?php get_footer();