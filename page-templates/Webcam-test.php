<?php /*Template Name:Webcam*/

get_header(); ?>
<div class="camera-test">
    <div class="webcam-1 dis-flex sm-flex-reverse">

        <div class="width-40 pad-left-15 wid-sm-100 wid-xs-100 webcam-info">
			
			<div id="download-webcamInfo-btn" class="webcam-download-btn">
				<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/download.svg" data-attachment-id="8600" width="38px" height="38px">
			</div>


            <div class="ct-row mar-bot-15">

                <div class="webcam-1-text_">

                    <div>

                        <h3 class="ct-bold-text" style="text-align: center !important"><strong><?php the_field("camera_information"); ?></strong></h3>

                    </div>

                </div>

            </div>
			
            <div class="ct-row webcam-info1" id="webcam-info1">
				<?php

                    // check if the repeater field has rows of data
                    if( have_rows('camera_info') ):

                        // loop through the rows of data
                    while ( have_rows('camera_info') ) : the_row();?>
                        <div>
                            <p class="list-item"><?php the_sub_field('list_item');?>:</p>
                            <p class="list-value"><?php the_sub_field('list_value');?></p>
                        </div>
                        <?php endwhile;
                            else :
                            endif;
                            ?>
            </div>

        </div>

        <div class="width-45 pad-left-20 pad-right-20 wid-sm-100 wid-xs-100">

            <div class="ct-row web-test-res dis-flex flex-column">

                <div class="webcam-2-text_">

                    <div class="icon-text-1">

                        <h5 class="ct-bold-text title-sm"><?php the_field("camera"); ?>: &nbsp;</h5>

                    </div>

                </div>

                <div class="webcam-2-text_">

                    <div class="icon-text-1">

                        <Select name="camera_choice" id="camera-choice">
                            <option value="0"><?php the_field("camera_list_title"); ?></option>
                        </Select>

                    </div>

                </div>

            </div>
            <div id="webcam-test">

				<div id="fullscreen_close" class="fullscreen-img"><img class="lazyload" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/full-screen-2.svg" data-src="<?php echo get_stylesheet_directory_uri();?>/assets/images/full-screen-2.svg" draggable="false"></div>

                <div id="webcam-start1" class="webcam-start">
					<div class="blob-1"></div>
				</div>

                <p id="fps-meter1" style="position: absolute; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; font-stretch: normal; font-size: 2em; line-height: normal; font-family: Raleway, sans-serif; color: rgb(238, 238, 238); margin: 0px; width: 277px; text-align: right;">16.3</p>

                <video id="webcam-video1" class="webcam-video"></video>
				
				<div id="capture" class="capture">
					<div class="capture-body">
						<div id="image-download-btn" class="image-download-btn">
							<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/download-picture.svg" data-attachment-id="8600">
						</div>
						<canvas id="pre-canvas" class="pre-capture" width="10" height="10">
						</canvas>
					</div>
				</div>
				
				<p id="webcam-error"></p>

            </div>
			<div class="ct-row web-test-res dis-flex webcam-btn-group" id="start-group">

                <div class="webcam-2-text_">

                    <div class="icon-text-1">

                        <button id="webcam-start-btn" class="webcam-btn">
							<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/webcam-start.svg" data-attachment-id="8601" width="32" height="32">
							<?php the_field("webcam_start_title"); ?>
						</button>

                    </div>

                </div>
			</div>
			
			<div class="ct-row web-test-res dis-flex webcam-btn-group" id="action-group">
				<div class="webcam-2-text_">

                    <div class="icon-text-1">

                        <button id="take-picture-btn" class="webcam-btn">
							<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/take-picture.svg" data-attachment-id="8602" width="32" height="32">
							<?php the_field("take_picture_title"); ?>
						</button>
                    </div>

                </div>
				<div class="webcam-2-text_">

                    <div class="icon-text-1">

                        <button id="fullscreen_open" class="webcam-btn">
							<img alt="" src="<?php echo get_stylesheet_directory_uri();?>/assets/images/full-screen.svg" data-attachment-id="8602" width="32" height="32">
							<?php the_field("full_screen_title"); ?>
						</button>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<div class="camera-test">
    <div class="webcam-1 dis-flex sm-dis-block">
        <div class="width-50 pad-left-15 wid-sm-100 wid-xs-100">
            <div class="ct-row mar-bot-15 dis-flex">
                <div class="webcam-1-icon_">
                    <div class="webcam-icon">
                        <img class="tve_image" alt="" style="width: 50px;" src="<?php the_field('webcam_image');?>" width="50" height="50">
                    </div>
                </div>
                <div class="webcam-1-text_">
                    <div class="icon-text-1">
                        <h3 class="ct-bold-text"><?php the_field('get_easily_title');?></h3>
                    </div>
                </div>
            </div>
            <div class="ct-row">
                <div class="new-webcam-desc">
                    <ul>
                        <?php

                    // check if the repeater field has rows of data
                    if( have_rows('get_start') ):

                        // loop through the rows of data
                    while ( have_rows('get_start') ) : the_row();?>
                        <li>
                            <span><?php the_sub_field('number');?></span>
                            <div>
                                <?php the_sub_field('list_desc');?>
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
					<p><?php the_field('red_line_notice');?></p>
				</div>
            </div>
			<div class="ct-row">
                <div class="privacy_block">
					<div>
						<h3><strong><?php the_field('your_privacy_title');?></strong></h3>
						<p><strong><?php the_field('desc');?></strong></p>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

<canvas id="real-canvas" width="100" height="100"></canvas>

                        <div class="advertising_banner">

                            <div align="center">

                                <style>

                                    .OMT_MOINSBD_Middle_Banner { width: 300px; height: 250px; }

                                    @media(min-width: 500px) { .OMT_MOINSBD_Middle_Banner { width: 336px; height: 280px; } }

                                    @media(min-width: 800px) { .OMT_MOINSBD_Middle_Banner { width: 970px; height: 90px; } }

                                </style>

                            </div>

                        </div>



                        <div class="trouble-shooting">

                            <div class="trouble-shooting-1 dis-flex">

                                <div class="width-13 wid-xs-20">

                                    <div class="webcam-icon">

                                        <img class="tve_image" alt=""  src="<?php the_field('webcam_image2');?>" data-attachment-id="8509" width="64" height="64">

                                    </div>

                                </div>

                                <div class="width-87 wid-xs-80">

                                    <h3 class="ct-bold-text"><?php the_field('trouble-shooting_guide_title');?></h3>

                                </div>

                            </div>



                            <div class="trouble-shooting-2 dis-flex">

                                <div class="width-33_3 wid-md-50 wid-xs-100">

                                    <div class="trouble-shooting-text-1 pd-1">

                                        <ul>

                                            <?php



                                            // check if the repeater field has rows of data

                                            if( have_rows('trouble-shooting_guide_list') ):



                                                // loop through the rows of data

                                                while ( have_rows('trouble-shooting_guide_list') ) : the_row();?>

                                                    <li >

													<span class="fw-bold">

														<font color="#666666"><?php the_sub_field('list_desc');?></font>

													</span>

                                                    </li>

                                                <?php



                                                endwhile;

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



                                <div class="width-33_3 wid-md-50  wid-xs-100">

                                    <div class="trouble-shooting-text-1 pd-1">

                                        <ul>

                                            <li>

													<span class="fw-bold">
													<?php the_field('follow_these_steps');?><br><br>
														<?php
                                                        // check if the repeater field has rows of data
                                                        if( have_rows('trouble-shooting_rightside_content') ):
                                                            // loop through the rows of data
                                                            while ( have_rows('trouble-shooting_rightside_content') ) : the_row();?>
                                                                <font color="#666666">
										<?php the_sub_field('trouble-shooting_rightside_content_desc');?><br><br></font>
                                                            <?php
                                                            endwhile;

                                                        else :

                                                        endif;

                                                        ?>
												</span>
                                            </li>

                                        </ul>

                                    </div>

                                </div>



                                <div class="width-33_3 md-hidden">

                                </div>

                            </div>

                        </div>



                        <div class="other-section">
                            <div class="ct-row mic-settings-title">
                                <span><?php the_field('webcam_settings_title');?></span>
                            </div>
                            <div class="mic-settings-section">
                                <div class="mic-settings-menu width-50 wid-md-100">
                                    <ul>
                                        <?php

                                        // check if the repeater field has rows of data
                                        if( have_rows('webcam_settings_links') ):

                                            // loop through the rows of data
                                            while ( have_rows('webcam_settings_links') ) : the_row();?>
                                                <li class="dis-flex">

                                                    <div class="webcam-icon">

                                                        <img class="tve_image" alt=""  src="<?php the_field('webcam_image');?>" data-attachment-id="8509" width="24" height="24" style="margin-right: 10px;">

                                                    </div>
                                                    <div>
                                                        <a href="<?php the_sub_field('url');?>">
                                                            <?php the_sub_field('webcam_program_name');?></a>
                                                    </div>

                                                </li>
                                            <?php endwhile;
                                        else :
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="ct-row mic-settings-title">
                                <span><?php the_field('webcam_settings_title_2');?></span>
                            </div>
                            <div class="mic-settings-section">
                                <div class="mic-settings-menu width-50 wid-md-100">
                                    <ul>
                                        <?php

                                        // check if the repeater field has rows of data
                                        if( have_rows('webcam_settings_links_2') ):

                                            // loop through the rows of data
                                            while ( have_rows('webcam_settings_links_2') ) : the_row();?>
                                                <li class="dis-flex">

                                                    <div class="webcam-icon">

                                                        <img class="tve_image" alt=""  src="<?php the_field('webcam_image');?>" data-attachment-id="8509" width="24" height="24" style="margin-right: 10px;">

                                                    </div>
                                                    <div>
                                                        <a href="<?php the_sub_field('url');?>">
                                                            <?php the_sub_field('webcam_program_name');?></a>
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

                                            $add=0;

                                            $class=['1','2','3','3',''];

                                            ?>

                                            <?php



                                            // check if the repeater field has rows of data

                                            if( have_rows('more_about') ):



                                                // loop through the rows of data

                                                while ( have_rows('more_about') ) : the_row();?>

                                                    <div class="read-more-<?php echo $class[$add];?> clearfix">





                                                        <div class="read-more-subtitle clearfix">

                                                            <h3 class="mar-bot-20"><?php the_sub_field('leftside_title');?></h3>

                                                        </div>



                                                        <div class="read-more-text">

                                                            <p><span style="font-family: Raleway !important; font-weight: 400;"><?php the_sub_field('leftside_desc');?></span>

                                                                <!-- <span style="font-family: "Open Sans"; font-weight: 400;">In this test your browser asks for permission to see the output of your computer's webcam, or the browser on your phone asks for permission to see the output of the camera - <strong>and the output is then transferred to your screen</strong>. </span><br><br><span data-css="tve-u-161b3aedac0" style="font-family: "Open Sans"; font-weight: 400;">That makes it easy - if you see the cam video then you know it's working and connected.</span><br><br><span data-css="tve-u-161b3aedac0" style="font-family: "Open Sans"; font-weight: 400;">As was mentioned above, everything that happens happens in your computer and <strong>no information is being sent to our servers</strong>. We care about your privacy.<br><br>To the more techy among us: this test is built simply with Javascript, HTML5 and CSS, and is <strong>100% on the client-side</strong>.<br></span> --></p>

                                                        </div>

                                                    </div>

                                                    <?php

                                                    $add++;

                                                endwhile;

                                            else :

                                            endif;

                                            ?>

                                            <!-- <div class="read-more-2 clearfix">



                                                <div class="read-more-subtitle clearfix">

                                                    <h3 class="mar-bot-20">Why do you only test FPS and the camera's video output? My webcam can also record sound...</h3>

                                                </div>



                                                <div class="read-more-text">

                                                    <p><span style="font-family: "Open Sans"; font-weight: 400;">True, some cams have a microphone built-in as well. But since that is not the case for everybody (and also for historic reasons), <strong>we decided to separate the audio and video to two different tests</strong>. If you're looking to check if the audio of your webcam works, please check our </span>

                                                    <a href="#" target="_blank"><span data-css="tve-u-161b3b1512c" style="font-family: "Open Sans"; font-weight: 400;">mic test</span></a><span data-css="tve-u-161b3b1512c" style="font-family: "Open Sans"; font-weight: 400;"> page.<br></span></p>

                                                </div>

                                            </div>



                                            <div class="read-more-3 clearfix">

                                                <div class="read-more-subtitle clearfix">

                                                    <h3 class="mar-bot-20">Speaking of which... What exactly is FPS, and why is it important?</h3>

                                                </div>

                                                <div class="read-more-text">

                                                    <p"><span style="font-family: "Open Sans"; font-weight: 400;">FPS is the <strong>number of frames</strong>, or images, that your webcam is taking and transmitting every second. This number is affected by the type of webcam that you have, and also by the speed of your computer and the number of tasks that it is engaged in at a given moment... <br><br>FPS matters because <strong>the higher this nubmer is the more life-like and real the resulting video looks</strong>. We are used to seeing movies in the cinema and TV shows displayed at around 24-30 FPS. Generally the FPS of television is higher than that of the cinema. </span><br><br><span style="font-family: "Open Sans"; font-weight: 400;">So if, let's say, you're using Skype and the FPS your camera is recording is lower than 24, then that means that the image is going to look a little <strong>stuttery</strong> to the other side.<br><br>A number significantly <strong>higher</strong> than 30, meanwhile, just means that the video will be more <strong>fluid, more lifelike</strong>. This fluidity might seem a little odd to our eyes which are accustomed to 24-30 FPS, but generally a higher FPS count is a good thing. It will just look a little less "cinematic", and a little more "daily soap opera".</span></p>

                                                </div>

                                            </div>



                                            <div class="read-more-3 clearfix">

                                                <div class="read-more-subtitle clearfix">

                                                    <h3 class="mar-bot-20">What do I do if after all the trouble-shooting stages my webcam still isn't working?</h3>

                                                </div>

                                                <div class="read-more-text">

                                                    <p><span style="font-family: "Open Sans"; font-weight: 400;">To understand whether the problem is with the webcam or with your computer, we would advise that you try your webcam <strong>on a different computer</strong>, and also, if you have access to one, <strong>try a different camera at your own computer</strong>.<br><br>This should leave you with a better understanding on <strong>what's working and what isn't</strong>, and what needs to be fixed.<br><br>If you think the camera isn't working (you tried it on two computers and it didn't work), then <strong>contact the support staff of the camera's brand</strong>.<br><br>If the camera is working on a different computer but isn't working on yours - then it means there's probably a <strong>software issue</strong> with your computer. You can try contacting us and we'll try to help, hopping on a general tech support forum on the internet, or calling a technician.</span></p>

                                                </div>

                                            </div>

-->

                                        </div>

                                    </div>



                                    <div class="width-50">

                                        <div class="img-section pad-left-15">

                                            <img class="lazyload" src="<?php the_field('rightside_image');?>" data-src="<?php the_field('rightside_image');?>" alt="rightside_image"/>

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
			let cameraInfo = [];
			let image_data_url;
			let selectedCameraDeviceId = -1;
			let camera_list = [];
			let row_camera;
			let videoWidth, videoHeight;
			let initial_state;
			
			var downloadImage = function (url) {
				const link = document.createElement('a');
				link.href = url;
				
				let date = new Date();
  				link.download = date + ".jpg";
 				document.body.appendChild(link);
  				link.click();
  				document.body.removeChild(link);
			}
			
			var rgbToHsl = function (r, g, b) {
			  r /= 255;
			  g /= 255;
			  b /= 255;

			  var max = Math.max(r, g, b);
			  var min = Math.min(r, g, b);
			  var h, s, l;

			  l = (max + min) / 2;

			  if (max == min) {
				h = s = 0; // achromatic
			  } else {
				var d = max - min;
				s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

				switch (max) {
				  case r:
					h = (g - b) / d + (g < b ? 6 : 0);
					break;
				  case g:
					h = (b - r) / d + 2;
					break;
				  case b:
					h = (r - g) / d + 4;
					break;
				}

				h /= 6;
			  }

			  return [h, s, l];
			}
			
			var display_cameraInfo = function () {
				let box = window.document.getElementsByClassName("list-value");
				
				for ( let i in box ) {
					box[i].innerHTML = cameraInfo[i] ?? "—";
				}
			}
			
			var get_cameraInfo = function (b) {
				const userAgent = navigator.userAgent;
				const videoTrack = b.getVideoTracks()[0];
				const trackSettings = videoTrack.getSettings();
				
				cameraInfo[0] = videoTrack.label;
				cameraInfo[5] = camera_list[selectedCameraDeviceId].facingMode;
				
				if (userAgent.indexOf("Chrome") != -1 || userAgent.indexOf("Edge") != -1) {
				  	const capabilities = videoTrack.getCapabilities();
				
					cameraInfo[1] = (capabilities.frameRate.max - capabilities.frameRate.min).toString() + " FPS";
					cameraInfo[2] = capabilities.width.max.toString() + "x" + capabilities.height.max.toString();
					cameraInfo[3] = (capabilities.width.max / capabilities.height.max).toFixed(2);
					cameraInfo[4] = (capabilities.width.max * capabilities.height.max / 1000000).toFixed(2) + " MP";

					if(capabilities.microphone === undefined) {
						cameraInfo[6] = "None";
					} else {
						cameraInfo[6] = "Yes";
					}
					if(capabilities.speaker === undefined) {
						cameraInfo[7] = "None";
					} else {
						cameraInfo[7] = "Yes";
					}
				} else if (userAgent.indexOf("Firefox") != -1 || userAgent.indexOf("Safari") != -1) {
					cameraInfo[1] = trackSettings.frameRate + " FPS";
					cameraInfo[2] = trackSettings.width.toString() + "x" + trackSettings.height.toString();
					cameraInfo[3] = (trackSettings.width / trackSettings.height).toFixed(2);
					cameraInfo[4] = (trackSettings.width * trackSettings.height / 1000000).toFixed(2) + " MP";
					cameraInfo[6] = cameraInfo[7] = "None";
				}
			}
			
			var get_cameraInfo_image = function () {
			
				//Take a Picture
				let canvas = window.document.getElementById("real-canvas");
				let pre_canvas = window.document.getElementById("pre-canvas");
				let video = window.document.getElementById("webcam-video1");
				let capture = window.document.getElementById("capture");

				canvas.width= video.videoWidth;
				canvas.height = video.videoHeight;
				canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
				
				if(canvas.width === 0) return true;

				let imageData = canvas.getContext('2d').getImageData(0, 0, video.videoWidth, video.videoHeight);
				
				image_data_url = canvas.toDataURL('image/jpeg');

				//Get Camera Info
				let pixelData = imageData.data;
				let colorSet = {};
				let saturationValues = [];
				let hueValues = [];
				let brightnessValues = 0;

				const pixelCount = imageData.width * imageData.height;

				for (let i = 0; i < pixelData.length; i += 4) {
					var r = pixelData[i];
					var g = pixelData[i + 1];
					var b = pixelData[i + 2];

					// Combine the RGB values into a color code
					var colorCode = r + '-' + g + '-' + b;

					// Add the color code to the colors object
					if (!colorSet[colorCode]) {
						colorSet[colorCode] = true;
					}
					var hsl = rgbToHsl(r, g, b);
					var hue = hsl[0];
					var saturation = hsl[1];
					var brightness = (r + g + b) / 3;

					// Add the lightness value to the array
					hueValues.push(hue);
					brightnessValues += brightness;
					saturationValues.push(saturation);
				}

				cameraInfo[10] = Object.keys(colorSet).length;
				let sum2 = saturationValues.reduce(function(a, b) {
					return a + b;
				}, 0);
				let sum3 = hueValues.reduce(function(a, b) {
					return a + b;
				}, 0);

				let [png, jpeg] = getEncodedSize(imageData, canvas);
				cameraInfo[8] = png + " kB";
				cameraInfo[9] = jpeg + " kB";
				
				cameraInfo[11] = ( brightnessValues / pixelData.length).toFixed(2) + " %";
				cameraInfo[12] = (sum2 / saturationValues.length * 100).toFixed(2) + " %";
				cameraInfo[13] = Math.round(sum3 / hueValues.length * 100)+ " °";

				display_cameraInfo();
			}
			
			var h=function(a,d){
				this.r=new RegExp(a,d.split("u").join(""))
			};
			h.__name__=!0;
			h.prototype={
				match:function(a){
					this.r.global&&(this.r.lastIndex=0);
					this.r.m=this.r.exec(a);
					this.r.s=a;
					return null!=this.r.m
				}
			};
			
			var downloadAsFile = function () {
				let item = window.document.getElementsByClassName("list-item");
				let value = window.document.getElementsByClassName("list-value");
				let data = {};
				
				for ( let i in item ) {
					data[item[i].innerHTML] = value[i].innerHTML;
				}
				var textData = JSON.stringify(data);
				var blob = new Blob([textData], { type: 'text/plain' });
				var url = window.URL.createObjectURL(blob);
				
				var link = document.createElement('a');
				var d = new Date();
				link.href = url;
				link.download = "camera_info_" + d.toISOString() + ".txt" ;
				document.body.appendChild(link);
				link.click();

				document.body.removeChild(link);
				window.URL.revokeObjectURL(url);
			}
			
			var getEncodedSize = function (imageData, canvas) {
			  // Create a canvas element and set its size to match the image data
			  canvas.width = imageData.width;
			  canvas.height = imageData.height;

			  const context = canvas.getContext('2d');

			  // Create an ImageData object from the input image data
			  const imageDataObject = new ImageData(
				new Uint8ClampedArray(imageData.data),
				imageData.width,
				imageData.height
			  );

			  // Draw the image data onto the canvas
			  context.putImageData(imageDataObject, 0, 0);

			  // Convert the canvas content to a data URL representing a PNG image
			  const dataPNGURL = canvas.toDataURL('image/png');
			  const encodedPNGData = dataPNGURL.slice('data:image/png;base64,'.length);
			  const encodedPNGSize = (encodedPNGData.length * 0.75 / 1024).toFixed(2); // Convert from base64 to bytes and then to kilobytes
				
			  const dataJPEGURL = canvas.toDataURL('image/jpeg');
			  const encodedJPEGData = dataJPEGURL.slice('data:image/jpeg;base64,'.length);
			  const encodedJPEGSize = (encodedJPEGData.length * 0.75 / 1024).toFixed(2);

			  return [encodedPNGSize, encodedJPEGSize];
			}
			
			var a=function(){};
			a.__name__=!0;
			a.main=function(){
				window.addEventListener("DOMContentLoaded", function(){
					
					a.div=window.document.getElementById("webcam-test");
					a.div.style.background="black";
					a.userMediaErrorDisplay=window.document.getElementById("webcam-error");
					a.userMediaErrorDisplay.innerHTML="";
					a.userMediaErrorDisplay.style.display="none";
					a.fpsMeter=window.document.getElementById("fps-meter1");
					a.fpsMeter.innerHTML="";
					a.btnStart=window.document.getElementById("webcam-start-btn");
					a.takePicture=window.document.getElementById("take-picture-btn")
					a.downloadBtn = window.document.getElementById("image-download-btn");
					a.downloadInfoBtn = window.document.getElementById("download-webcamInfo-btn");
					a.capture = window.document.getElementById("capture-body");
					a.video = window.document.getElementById("webcam-video1");
					a.cameraChoice = window.document.getElementById("camera-choice");
					
					a.displayErrorMessage = function (type) {
						let message = "";
						switch(type) {
							case 0:
// 								message = "<strong>We can't find your camera</strong> - that most probably means that it's either not connected, broken, or you don't have the proper webcam drivers (see below)";
 								message = "<strong><?php the_field("not_found_camera_1"); ?></strong> - <?php the_field("not_found_camera_2"); ?>";
								break;
							case 1:
								message = "<strong>Error accessing media devices</strong>";
								break;
							case 2:
								message = "<?php the_field("not_authorized_camera"); ?>";
								break;
						}
						a.userMediaErrorDisplay.innerHTML= message;
						a.userMediaErrorDisplay.style.display="table-cell";
					}
					
					a.cameraChoice.addEventListener("change", function () {
						a.start = window.document.getElementById("start-group");
						
						selectedCameraDeviceId = a.cameraChoice.value;
						capture.style.display = "none";
						
						if(a.start.style.display === "none") {
							navigator.mediaDevices.getUserMedia({
								audio:!1,
								video:{ 
									width:a.div.clientWidth,
									height:a.div.clientHeight,
									deviceId: { exact: camera_list[selectedCameraDeviceId].id },
									facingMode: camera_list[selectedCameraDeviceId].facingMode
								}
							}).then(a.onGetUserMedia, a.onGetUserMediaFailed);
						}
					});
					
					a.takePicture.addEventListener("click", function () {
						
						//Take a Picture
						let canvas = window.document.getElementById("real-canvas");
						let pre_canvas = window.document.getElementById("pre-canvas");
						let video = window.document.getElementById("webcam-video1");
						let capture = window.document.getElementById("capture");
						
						canvas.width= video.videoWidth;
						canvas.height = video.videoHeight;
						canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
						
						pre_canvas.width= video.videoWidth/4;
						pre_canvas.height = video.videoHeight/4;
						pre_canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth/4, video.videoHeight/4);
						capture.style.display = "block";
						let imageData = canvas.getContext('2d').getImageData(0, 0, video.videoWidth, video.videoHeight);
   						image_data_url = canvas.toDataURL('image/jpeg');
						
					});
					
					navigator.mediaDevices.enumerateDevices()
						.then(function(devices) {
							// Filter the results to get only videoinput devices (cameras)
							var cameras = devices.filter(function(device) {
								return device.kind === 'videoinput';
							});
						
						    if(cameras.length === 0) {
								a.displayErrorMessage(0);
							} else {
								if(cameras[0].label === "") {
									return false;
								} else {

									camera_list = cameras.map((camera) => ({ 
										label: camera.label, 
										id: camera.deviceId , 
										facingMode: camera.label.toLowerCase().includes('front') ? 'user' : 'environment',
									}));
									selectedCameraDeviceId = 0;

									a.cameraChoice.innerHTML = "";
									camera_list.forEach((item, index) => {
										a.cameraChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
									});	
								}	
							}
						
						})
						.catch(function(error) {
							a.displayErrorMessage(1);
						});
					
					a.btnStart.addEventListener("click", function() {
						a.userMediaErrorDisplay.style.display="block";
						a.userMediaErrorDisplay.innerHTML="";
						
						if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) { 
							navigator.mediaDevices.getUserMedia({
								audio:!1,
								video:{ 
									width:a.div.clientWidth,
									height:a.div.clientHeight,
									...camera_list.length !== 0 ? {deviceId: { exact: camera_list[selectedCameraDeviceId].id }} : {},
								}
							}).then(a.onGetUserMedia, a.onGetUserMediaFailed);
						} else if (navigator.getUserMedia) {
							navigator.getUserMedia({
								audio:!1,
								video:{ 
									width:a.div.clientWidth,
									height:a.div.clientHeight,
									...camera_list.length !== 0 ? {deviceId: { exact: camera_list[selectedCameraDeviceId].id }} : {},
								}
							}).then(a.onGetUserMedia, a.onGetUserMediaFailed);
						}
						
					});
					
					a.downloadInfoBtn.addEventListener("click", function() {
						downloadAsFile();
					});
					
					a.downloadBtn.addEventListener("click", function() {
						downloadImage(image_data_url);
					});
					
					window.addEventListener("resize",a.updateSizes);
				})
			};
										
			a.start_webcam = function (b) {
				a.userMediaErrorDisplay.style.display="none";
				
				a.start = window.document.getElementById("start-group");
				a.action = window.document.getElementById("action-group");
				a.previousDisplay=window.document.getElementById("webcam-start1");
				
				a.start.style.display = "none";
				a.previousDisplay.style.display = "none";
				a.action.style.display = "flex";
				
				a.video=window.document.getElementById("webcam-video1");
				a.div.style.height=a.div.clientHeight+"px";
				a.video.srcObject=b;
				a.video.width=a.div.clientWidth;
				a.video.height=a.div.clientHeight;
				a.video.onloadedmetadata=function(b){
					a.video.play();
					a.frameCount=function(){
						return a.video.presentedFrames?!0:a.video.mozPaintedFrames
					};
					null==a.frameCount()?(new h("Firefox/","")).match(window.navigator.userAgent) && ( 
						b=window.document.createElement("p"),
						b.innerHTML="FPS readings might not be accurate.<br />Please try a different browser for accurate FPS readings",
						b.style.font='bold 12pt "Open Sans", sans-serif',
						b.style.width=a.video.width+"px",
						b.style.textAlign="center",
						b.style.padding="8px",
						b.style.position="absolute",
						b.style.top=a.video.height-64+"px",
						b.style.color="#ee9999",
						a.div.appendChild(b)
						):a.startTime=(new Date).getTime();
					window.requestAnimationFrame(a.updateFPSmeter)
				};
				a.lastFrameTime=(new Date).getTime();
				a.div.appendChild(a.video);
				a.fpsMeter.style.width=a.video.width-8+"px"
				
				//Get Detailed Camera Information
				get_cameraInfo(b);
				display_cameraInfo();
			}
				
			a.onGetUserMedia=function(b){
				
				if(selectedCameraDeviceId < 0 ) {
					navigator.mediaDevices.enumerateDevices()
						.then(function(devices) {
							// Filter the results to get only videoinput devices (cameras)
							var cameras = devices.filter(function(device) {
								return device.kind === 'videoinput';
							});
						
							camera_list = cameras.map((camera) => ({ 
								label: camera.label, 
								id: camera.deviceId , 
								facingMode: camera.label.toLowerCase().includes('front') ? 'user' : 'environment',
							}));
							selectedCameraDeviceId = 0;

							a.cameraChoice.innerHTML = "";
							camera_list.forEach((item, index) => {
								a.cameraChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
							});	
						
							a.start_webcam(b);
						})
						.catch(function(error) {
							a.displayErrorMessage(1);
					});
				} else {
					a.start_webcam(b);
				}
				setTimeout(get_cameraInfo_image, 3000);
			};
			
			a.updateFPSmeter=function(b){
				var d=(new Date).getTime();
				null!=a.frameCount()?(b=d-a.startTime,b=1E3*a.frameCount()/b,a.smoothFps+=(b-a.smoothFps)/20,a.fpsMeter.innerHTML=a.getFpsText(a.smoothFps)):a.video.currentTime!=a.lastVideoTime&&(a.frameTime+=(d-a.lastFrameTime-a.frameTime)/20,b=1E3/a.frameTime,a.fpsMeter.innerHTML=a.getFpsText(b),a.lastFrameTime=d,a.lastVideoTime=a.video.currentTime);
				a.div.clientWidth<a.video.width&&a.updateSizes();
				a.div.clientHeight<a.video.height&&(a.video.height=a.div.clientHeight);
				window.requestAnimationFrame(a.updateFPSmeter)
			};
			
			a.getFpsText = function(a) {
				return isNaN(a)?"Waiting...":(Math.round(10*a)/10).toFixed(1)
			};
			
			a.onGetUserMediaFailed = function(b) {
				window.console.log("Getting user media failed: "+k.string(b));
				if(-1<b.name.indexOf("NotFoundError")) {
					a.displayErrorMessage(0);
				} else {
					a.displayErrorMessage(2);
				}
			};
			a.updateSizes=function(){
				null!=a.video && (
					a.video.width=a.div.clientWidth,
					a.fpsMeter.style.width=a.video.width-8+"px")
			};
			Math.__name__=!0;
			var k=function(){};
			k.__name__=!0;
			k.string=function(a){
				return e.__string_rec(a,"")
			};
			var e=function(){};
			e.__name__=!0;
			e.__string_rec=function(a,d){
				if(null==a)return"null";
				if(5<=d.length)return"<...>";
				var c=typeof a;
				"function"==c && (a.__name__||a.__ename__) && (c="object");
				switch(c){
					case "function":
						return"<function>";
					case "object":
						if(a instanceof Array){
							if(a.__enum__){
								if(2==a.length)return a[0];
								c=a[0]+"(";d+="\t";
								for(var b=2,f=a.length;b<f;){
									var g=b++;
									c=2!=g?c+(","+e.__string_rec(a[g],d)):c+e.__string_rec(a[g],d)
								}return c+")"
							}
							c=a.length;
							b="[";
							d+="\t";
							for(f=0;f<c;)g=f++,b+=(0<g?",":"")+e.__string_rec(a[g],d);
							return b+"]"
						}
						try{
							b=a.toString
						} catch(l) {
							return"???"
						}
						if(null!=b && b!=Object.toString && "function"==typeof b && (c=a.toString(),"[object Object]"!=c))
							return c;
						c=null;
						b="{\n";
						d+="\t";
						f=null!=a.hasOwnProperty;
						for(c in a)
							f&&!a.hasOwnProperty(c)||"prototype"==c||"__class__"==c||"__super__"==c||"__interfaces__"==c||"__properties__"==c||(2!=b.length&&(b+=", \n"),b+=d+c+" : "+e.__string_rec(a[c],d));
						d=d.substring(1);
						return b+("\n"+d+"}");
					case "string":
						return a;
					default:
						return String(a)
				}
			};
			String.__name__=!0;
			Array.__name__=!0;
			Date.__name__=["Date"];
			a.frameTime=0;
			a.filterStrength=20;
			a.smoothFps=0;
			a.main()
		})();
    </script>
<?php get_footer();