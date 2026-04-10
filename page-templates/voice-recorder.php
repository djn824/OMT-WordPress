<?php /*Template Name: Voice Recorder */
get_header();
?>
<style>
	body, html {
		overflow-x: hidden;
		position: relative;
	}

	.main-recorder-wrapper {
		max-width: 100vw;
	}
	
	.vibration-warning-box {
		background-color: #E35D26;     /* exact orange from your screenshot */
		color: #ffffff;
		padding: 14px 20px;
		font-family: Raleway, sans-serif;
		font-weight: bold;
		font-size: 17px;               /* adjust if needed */
		text-align: center;
		border-radius: 4px;            /* slightly more rounded than your note-message */
		margin: 20px auto 15px auto;   /* spacing: top + bottom */
		max-width: 100%;
		box-sizing: border-box;
		border: 1px solid #E35D26;
		width: 100%;                   /* makes it full width like the red box in screenshot */
	}
</style>
                                <div class="microphone-test">
                                    <div class="voice-recorder-1">
                                        <div class="width-100 wid-sm-100 wid-xs-100">
                                            
<!-- 											<div class="note-box width-50 wid-xs-100" id="note">
												<p><?php the_field('note');?></p>
											</div>
											<br/>
											 -->
                                            <div id="recording-step1" class="ct-row">
                                                <div class="ct-row web-test-res dis-flex">
                                                    <div class="webcam-2-text_">
                                                        <div class="icon-text-1">
                                                            <h5 class="ct-bold-text italic"><?php the_field("start_recording_title"); ?>&nbsp;</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ct-row toolBar">
                                                    <div class="recorder-start">
                                                        <div>
                                                            <div id="recorder-start-btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											<div id="error" class="ct-row error-area">
												<div class="width-41 wid-sm-100 wid-xs-100">
													<span><?php the_field("not_found_error"); ?></span>
												</div>
											</div>
                                            
                                            <div id="recording-step2" class="ct-row">
                                                <div id="display-area" class="ct-row display-area">
													<div id="div1" class="width-41 wid-sm-100 wid-xs-100">
														<canvas id="audio-player1"></canvas>
														<div id="clip-area" class="clip-area">
															<canvas id="audio-player2" class="canvas-background"></canvas>
															<canvas id="live-player"></canvas>
															<div id="stick-left" class="stick">
																<div><span></span></div>
															</div>
															<div id="stick-right" class="stick">
																<div><span></span></div>
															</div>
															
															<div id="clipped" class="clipped">
															</div>
															
															<div id="progress-container" class="progress-container">
																<div id="progress" class="progress">
																	<div id="percentage" class="progress-percentage">
																		<div><span></span></div>
																	</div>
																</div>
																<div id="timeline" class="timeline">
																	<span>00:00</span>
																	<span id="total-time"></span>
																</div>
															</div>

														</div>								
													</div>
													<div>
														<h5 class="ct-bold-text"><span id="time-count" class="time-count"></span></h5>
													</div>
                                                </div>
												
                                                <div class="ct-row toolBar">
                                                    <div id="toolBar1" class="recorder-group">
                                                        <button id="cancel"></button>
                                                        <button id="check" class="check1">
															<div class="arrow">
																<span></span>
																<span></span>
																<span></span>
															</div>
														</button>
														
<!-- 														<div id="download-icon" class="download-button"> -->
														<button id="download-icon" style="background-image: url(https://03a897595e3ab43aefc8b.admin.hardypress.com/wp-content/themes/onlinemictest_child-2/assets/css/../../../../uploads/2023/10/btn-group-1.svg); display: none; background-color: #436f8e; transition: all .5s; background-repeat: no-repeat; background-position: center;"></button>
<!-- 															</div> -->
														
                                                        <div class="record">
															<div>
																<div id="pause1" class="pause">
																</div>
																<div id="play1" class="play">
																</div>
																<div id="record1" class="record-btn">
																	<svg width="35" height="47" viewBox="0 0 35 47" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<circle cx="16.5" cy="11.5" r="11.5" fill="white"/>
																		<path d="M1.07457 43V30.6364H5.95242C6.88613 30.6364 7.683 30.8034 8.34304 31.1374C9.0071 31.4674 9.51219 31.9363 9.85831 32.544C10.2085 33.1477 10.3835 33.8581 10.3835 34.6751C10.3835 35.4961 10.2064 36.2024 9.85227 36.794C9.49811 37.3816 8.98497 37.8324 8.31286 38.1463C7.64477 38.4602 6.83582 38.6172 5.88601 38.6172H2.62003V36.5163H5.46342C5.96248 36.5163 6.37701 36.4479 6.70703 36.3111C7.03705 36.1742 7.28255 35.969 7.44354 35.6953C7.60855 35.4216 7.69105 35.0816 7.69105 34.6751C7.69105 34.2646 7.60855 33.9184 7.44354 33.6367C7.28255 33.355 7.03504 33.1417 6.70099 32.9968C6.37098 32.8479 5.95443 32.7734 5.45135 32.7734H3.68857V43H1.07457ZM7.75142 37.3736L10.8242 43H7.93857L4.93217 37.3736H7.75142ZM12.2308 43V30.6364H20.5618V32.7915H14.8448V35.7376H20.1332V37.8928H14.8448V40.8448H20.5859V43H12.2308ZM33.5487 34.9648H30.9046C30.8563 34.6228 30.7577 34.3189 30.6088 34.0533C30.4598 33.7836 30.2687 33.5542 30.0352 33.3651C29.8018 33.1759 29.5322 33.031 29.2263 32.9304C28.9244 32.8298 28.5964 32.7795 28.2423 32.7795C27.6024 32.7795 27.045 32.9384 26.57 33.2564C26.0951 33.5703 25.7269 34.0291 25.4653 34.6328C25.2037 35.2325 25.0729 35.9609 25.0729 36.8182C25.0729 37.6996 25.2037 38.4401 25.4653 39.0398C25.7309 39.6394 26.1012 40.0922 26.5761 40.3981C27.051 40.704 27.6003 40.8569 28.2242 40.8569C28.5743 40.8569 28.8983 40.8106 29.1961 40.718C29.498 40.6255 29.7656 40.4906 29.999 40.3136C30.2325 40.1325 30.4256 39.9131 30.5786 39.6555C30.7355 39.398 30.8442 39.1042 30.9046 38.7741L33.5487 38.7862C33.4803 39.3537 33.3093 39.901 33.0356 40.4283C32.766 40.9515 32.4017 41.4203 31.9429 41.8349C31.4881 42.2454 30.9448 42.5714 30.3129 42.8129C29.6851 43.0503 28.9748 43.169 28.1819 43.169C27.0792 43.169 26.0931 42.9195 25.2238 42.4205C24.3585 41.9214 23.6743 41.199 23.1713 40.2532C22.6722 39.3074 22.4227 38.1624 22.4227 36.8182C22.4227 35.4699 22.6762 34.3229 23.1833 33.3771C23.6904 32.4313 24.3786 31.7109 25.248 31.2159C26.1173 30.7169 27.0953 30.4673 28.1819 30.4673C28.8983 30.4673 29.5624 30.5679 30.1741 30.7692C30.7899 30.9704 31.3352 31.2642 31.8101 31.6506C32.285 32.0329 32.6714 32.5018 32.9692 33.0572C33.271 33.6126 33.4642 34.2485 33.5487 34.9648Z" fill="white"/>
																		</svg>

																</div>
															</div>
                                                        </div>
                                                    </div>
													<div id="toolBar2" class="main-group">
                                                        <div class="action-group">

                                                            <div class="record">
																<div>
																	<div id="pause2" class="pause">
																	</div>
																	<div id="play2" class="play">
																	</div>
																</div>
															</div>

                                                            <div class="extra-btn-group">
																<div class="btn-parent">
                                                                	<button id="download"></button>
																</div>
																<div class="btn-parent">
																	<div id="share-bar">
<!-- 																		<div id="social-network" class="social-network">
																			<button id="whatsapp"></button>
																			<button id="facebook"></button>
																			<button id="twitter"></button>
																			<button id="instagram"></button>
																		</div> -->
																		<div id="clipboard-bar" class="clipboard-bar">
																			<input id="clipboard-input" type="text" readonly />
																			<button id="clipboard">
																				<svg id="clipboard1" width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
																					<path d="M4.23304 0.149994C1.99005 0.149994 0.149902 1.99013 0.149902 4.23313V19.6613C0.149902 21.9043 1.99005 23.7445 4.23304 23.7445H19.6613C21.9042 23.7445 23.7444 21.9043 23.7444 19.6613V4.23313C23.7444 1.99013 21.9042 0.149994 19.6613 0.149994H4.23304ZM4.23304 2.37516H19.6613C20.7088 2.37516 21.5137 3.18557 21.5137 4.23313V19.6613C21.5137 20.7089 20.7088 21.5138 19.6613 21.5138H4.23304C3.1855 21.5138 2.37507 20.7089 2.37507 19.6613V4.23313C2.37507 3.18557 3.1855 2.37517 4.23304 2.37516Z" fill="white"/>
																					<path d="M22.6263 6.25552C22.3313 6.25581 22.0485 6.37312 21.8399 6.58171C21.6313 6.7903 21.514 7.07312 21.5137 7.36811C21.514 7.6631 21.6313 7.94592 21.8399 8.15451C22.0485 8.36309 22.3313 8.4804 22.6263 8.48069H25.7667C26.805 8.48069 27.6192 9.30035 27.6192 10.3387V25.7669C27.6192 26.8052 26.805 27.6194 25.7667 27.6194H10.3385C9.30021 27.6194 8.48055 26.8052 8.48055 25.7669V22.6319C8.48113 22.4854 8.45278 22.3402 8.39714 22.2046C8.3415 22.0691 8.25966 21.9458 8.1563 21.842C8.05294 21.7381 7.93011 21.6557 7.79483 21.5993C7.65955 21.543 7.51449 21.514 7.36797 21.5138C7.22144 21.514 7.07638 21.543 6.9411 21.5993C6.80582 21.6557 6.68299 21.7381 6.57963 21.842C6.47627 21.9458 6.39443 22.0691 6.33879 22.2046C6.28315 22.3402 6.2548 22.4854 6.25538 22.6319V25.7669C6.25538 28.0089 8.09645 29.85 10.3385 29.85H25.7667C28.0088 29.85 29.8499 28.0089 29.8499 25.7669V10.3387C29.8499 8.0966 28.0088 6.25552 25.7667 6.25552H22.6263Z" fill="white"/>
																				</svg>
																				<svg id="clipboard2" width="20" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																					<path d="M24.753 2.03415C24.7535 2.20925 24.7192 2.3827 24.6523 2.54449C24.5853 2.70628 24.487 2.85318 24.3629 2.97672L8.42822 18.9101C8.17813 19.1598 7.83918 19.3 7.48579 19.3C7.1324 19.3 6.79345 19.1598 6.54335 18.9101L0.987938 13.3549C0.739082 13.1047 0.599608 12.766 0.600099 12.4131C0.60059 12.0602 0.741007 11.7219 0.990559 11.4724C1.24011 11.2229 1.57843 11.0825 1.93132 11.0821C2.28422 11.0817 2.62289 11.2212 2.87306 11.4701L7.15289 15.7499C7.19656 15.7936 7.24843 15.8283 7.30554 15.852C7.36264 15.8757 7.42385 15.8879 7.48566 15.8879C7.54748 15.8879 7.60869 15.8757 7.66579 15.852C7.72289 15.8283 7.77476 15.7936 7.81844 15.7499L22.4778 1.09056C22.6642 0.904029 22.9018 0.777008 23.1605 0.72558C23.4191 0.674153 23.6872 0.700631 23.9308 0.801663C24.1745 0.902695 24.3826 1.07374 24.529 1.29314C24.6753 1.51254 24.7533 1.77042 24.753 2.03415Z" fill="#ffffff"/>
																				</svg>
																			</button>
																			
																		</div>
																		<div class="down-arrow"></div>
																	</div>
																	<div id="share-bk"></div>
                                                                	<button id="share"></button>
																</div>
                                                                <div id="extra"></div>
																<div class="btn-parent">
                                                                	<button id="delete"></button>
																</div>
																<div class="btn-parent">
                                                                	<button id="qrcode"></button>
																</div>
                                                            </div>


                                                        </div>
                                                        <div class="action-group-1">
                                                            <button id="start-again">
                                                                <?php the_field("start_again_title"); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
												
												<div id="loading-modal" class="modal">
													<div class="spinner"></div>
													<span class="italic"></span>
												</div>
												
												<div id="qr-modal" class="modal">
													<div class="modal-content">
														<div id="qrcontainer" class="qrcontainer"></div>
														<button id="download-QR"><?php the_field("save_qr_title"); ?></button>
													</div>
												</div>
												
												<div id="copied-message" class="copied-message">
													<span><?php the_field("copied_message"); ?></span>
												</div>
												
											</div>
                                            
                                        </div>
                                    </div>

                                </div>
                            <div class="read-more-section">
								<div class="vibration-warning-box">
									<?php the_field('warning_box');?>
								</div>

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

                                        </div>

                                    </div>



                                    <div class="width-50">

                                        <div class="img-section pad-left-15">
											
                                            <img class="lazyload" src="<?php the_field('rightside_image');?>" data-src="<?php the_field('rightside_image');?>" width="100%" height="100%" alt="rightside_image"/>

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
    <?php
		$s3_access_key_id = AWS_ACCESS_KEY;
		$s3_secret_access_key = AWS_SECRET_KEY;
    ?>

<script src="https://sdk.amazonaws.com/js/aws-sdk-2.976.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lamejs/1.2.0/lame.min.js"></script>

<script>	
    ((q) => {
		AWS.config.update({
		  accessKeyId: "<?php echo $s3_access_key_id;?>",
		  secretAccessKey: "<?php echo $s3_secret_access_key;?>",
		  region: 'us-west-2'
		});
		let s3 = new AWS.S3();
		
		console.log("<?php echo $s3_access_key_id;?>", "<?php echo $s3_secret_access_key;?>");
		
        var b = () => {};
		let record_file_URL = "";
		let mediaRecorder;
		let timeInterval, replayInterval, liveInterval;
		let currentTime, startTime, pauseTime;
		let status = 0, method = "";
		let blob, audioUrl, audio = new Audio(), audioContext, audioBuffer, clipBuffer = null;
		let leftTime, rightTime;
		let end;
		let isPaused;
		let stored_file_URL, qrCode, fileID;
		let params = new URLSearchParams(window.location.search);
		let id_param = params.get('id');
		
		var audioURLToBuffer = (url) => {
			return new Promise(async (resolve, reject) => {
				let audioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.msAudioContext;
            	let context = new audioContext();
				let response = await fetch(url);
				let arrayBuffer = await response.arrayBuffer();
				let audioBuffer1 = await context.decodeAudioData(arrayBuffer);
				resolve(audioBuffer1);
			})
		}
				
		var setAudio = (audioURL) => {
			audio = new Audio(audioURL);

			audio.addEventListener('ended', function() {
				if(status === 1) {
					b.pauseBtn[0].click();
				}
			})
		}
		
		var bufferToMp3 = (abuffer) => {

			let len = abuffer.length;
			let numOfChan = abuffer.numberOfChannels,
				length = len * numOfChan * 2 + 44,
				buffer = new ArrayBuffer(length),
				view = new DataView(buffer),
				channels = [], i, sample,
				offset = 0,
				pos = 0;

			// write WAVE header
			setUint32(0x46464952);                         // "RIFF"
			setUint32(length - 8);                         // file length - 8
			setUint32(0x45564157);                         // "WAVE"

			setUint32(0x20746d66);                         // "fmt " chunk
			setUint32(16);                                 // length = 16
			setUint16(1);                                  // PCM (uncompressed)
			setUint16(numOfChan);
			setUint32(abuffer.sampleRate);
			setUint32(abuffer.sampleRate * 2 * numOfChan); // avg. bytes/sec
			setUint16(numOfChan * 2);                      // block-align
			setUint16(16);                                 // 16-bit (hardcoded in this demo)

			setUint32(0x61746164);                         // "data" - chunk
			setUint32(length - pos - 4);                   // chunk length

			// write interleaved data
			for(i=0; i < abuffer.numberOfChannels; i++) {
				channels.push(abuffer.getChannelData(i));  
			}

			while(pos < length) {
				for(i=0; i < numOfChan; i++) {             // interleave channels
					sample = Math.max(-1, Math.min(1, channels[i][offset])); // clamp
					sample = (0.5 + sample < 0 ? sample * 32768 : sample * 32767)|0; // scale to 16-bit signed int
					view.setInt16(pos, sample, true);          // write 16-bit sample
					pos += 2;
				}
				offset++;                                   // next source sample
			}

			// create Blob
			return new Blob([buffer], {type: "audio/wav"});

			function setUint16(data) {
				view.setUint16(pos, data, true);
				pos += 2;
			}

			function setUint32(data) {
				view.setUint32(pos, data, true);
				pos += 4;
			}
		}
		
		var startRecording = (stream) => {
			mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.onstart = () => {
                chunks = [];
				startTime = Date.now();
            }

            mediaRecorder.ondataavailable = (e) => {
				if (e.data.size > 0) {
				  chunks.push(e.data);
				}
            }

            mediaRecorder.onstop = async () => {
				blob = new Blob(chunks, {type: "audio/wav"});
				audioUrl = URL.createObjectURL(blob);
				
				chunks = [];
				
				audioBuffer = await audioURLToBuffer(audioUrl);
				b.audioStart(audioBuffer);
				
				blob = bufferToMp3(audioBuffer);
				audioUrl = URL.createObjectURL(blob);
				
				b.setAudio(audioUrl, 'clip');
            }	
		}
		
		var pauseRecording = () => {
			if (mediaRecorder && mediaRecorder.state === 'recording') {
				mediaRecorder.pause();
				isPaused = true;
				
				pauseTime = Date.now();
			}
		};
		
		var continueRecording = () => {
	    	if (mediaRecorder && mediaRecorder.state === 'paused') {
				mediaRecorder.resume();
				isPaused = false;
				
				startTime += Date.now() - pauseTime;
			}
		};
		
		var stopRecording = () => {
			if (mediaRecorder && mediaRecorder.state !== 'inactive') {
				if (!isPaused) {
					mediaRecorder.stop();
				} else {
					mediaRecorder.requestData();
					mediaRecorder.stop();
				}

				mediaRecorder.stream.getTracks().forEach(track => track.stop());
				mediaRecorder = null;
			}
		};

		
		var formatTime = (ms) => {
			let hours = Math.floor(ms / 360000); // 1 Hour = 36000 Milliseconds
			let minutes = Math.floor((ms % 360000) / 6000); // 1 Minutes = 60000 Milliseconds
			let seconds = Math.floor(((ms % 360000) % 6000) / 100); // 1 Second = 1000 Milliseconds
			let milliseconds = ((ms % 360000) % 6000) % 100;

			// formatting the time with leading zeros
			let formattedTime = `${hours} : ${padZero(minutes)} : ${padZero(seconds)}.${padZero(milliseconds)}`;
			return formattedTime;
		}
		
		var formatTime1 = (seconds) => {
		  let hours = Math.floor(seconds / 3600); // calculating hours
		  let minutes = Math.floor((seconds % 3600) / 60); // calculating minutes
		  let remainingSeconds = seconds % 60; // calculating remaining seconds

		  // formatting the time with leading zeros
		  let formattedTime = 
			  hours === 0 ? `${padZero(minutes)}:${padZero(remainingSeconds)}` 
		  				: `${hours}:${padZero(minutes)}:${padZero(remainingSeconds)}`;
		  return formattedTime;
		}
		
		var formatTime2 = (ms, method) => {
			
		  let seconds = method ? ms : Math.round(ms);
		  let hours = Math.floor(seconds / 3600); // calculating hours
		  let minutes = Math.floor((seconds % 3600) / 60); // calculating minutes
		  let remainingSeconds = seconds % 60; // calculating remaining seconds

		  // formatting the time with leading zeros
		  let formattedTime = 
			  hours === 0 ? `${padZero(minutes)}:${padZero(remainingSeconds)}` 
		  				: `${hours}:${padZero(minutes)}:${padZero(remainingSeconds)}`;
		  return formattedTime;
		}

		var padZero = (value) => {
		  return value < 10 ? "0" + value : value; // adding leading zero if value is less than 10
		} 
		
		var start_timeCount = () => {
			timeInterval = setInterval(() => {
				currentTime = Date.now() - startTime;
				b.timeCount.innerHTML = formatTime(Math.floor(currentTime/10));
			}, 10);
		}
		
		var stop_timeCount = () => {
			clearInterval(timeInterval);
		}
		
		var recordingDownload = async () => {
			let sourceBuffer = clipBuffer ?? audioBuffer;  // ✅ fallback

    if (!sourceBuffer) {
        console.error("No audio buffer available");
        return;
    }

    let clipBlob = bufferToMp3(sourceBuffer);
    let clipUrl = URL.createObjectURL(clipBlob);
			
// 			let clipBlob = bufferToMp3(clipBuffer);
// 			let clipUrl = URL.createObjectURL(clipBlob);
			let link = document.createElement("a");
			
			let d = new Date();
			
			link.href = clipUrl;
			let now = new Date();
			let year = now.getFullYear();
			let month = String(now.getMonth() + 1).padStart(2, '0');
			let day = String(now.getDate()).padStart(2, '0');
			let hours = String(now.getHours()).padStart(2, '0');
			let minutes = String(now.getMinutes()).padStart(2, '0');
			let seconds = String(now.getSeconds()).padStart(2, '0');
			let dateStr = `${year}${month}${day}_${hours}${minutes}${seconds}`;

			link.download = `OnlineMicTest_record_${dateStr}.mp3`;
			
			// Append to HTML (this part is needed for Firefox)
			document.body.appendChild(link);
			link.click();
			
			document.body.removeChild(link);
		}
		
		var saveFileToS3 = async (bucketName, fileName, audioBlob) => {
			return new Promise((resolve, reject) => {
				let folderName = "recorded-audio/";
				let params = {
					Bucket: bucketName,
					Key: folderName + fileName,
					Body: audioBlob,
// 					ACL: 'public-read',
				};

				let options = {
					partSize: 5 * 1024 * 1024, // Minimum part size is 5MB
					queueSize: 4 // Number of parallel uploads
				};
				console.log('333333333');
				s3.upload(params, options, function (err, data) {
					console.log('err', err, data);
					if (err) {
						reject(err);
					} else {
						resolve(data.Location);
					}
				}).on('httpUploadProgress', function (progress) {
					console.log('prog', progress);
					let percentage = Math.round(progress.loaded / progress.total * 100);
					b.loadingModal.querySelector("span").innerHTML = "<?php the_field("saving_file_title"); ?>" + ` ${percentage}%`; 
					console.log('Upload Progress:', Math.round(progress.loaded / progress.total * 100) + '%');
				});
			});
		}
		
		var getFileFromS3 = async (bucketName, fileName) => {
			let folderName = "recorded-audio/";
			let params = {
				Bucket: bucketName,
				Key: folderName + fileName
			};

			const url = s3.getSignedUrl('getObject', params);

			const response = await fetch(url);
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}

			const contentType = response.headers.get('content-type');
			const reader = response.body.getReader();
			const contentLength = +response.headers.get('content-length');
			let receivedLength = 0;
			const chunks = [];

			while (true) {
				const { done, value } = await reader.read();
				if (done) {
					break;
				}
				chunks.push(value);
				receivedLength += value.length;

				// Update progress
				let percentage = Math.round((receivedLength / contentLength) * 100);
				b.loadingModal.querySelector("span").innerHTML = `Loading File ${percentage}%`;
				console.log('Download Progress:', percentage + '%');
			}

			let blob = new Blob(chunks, { type: contentType });
			return blob;
		}
		
		var deleteFileFromS3 = async (bucketName, fileName) => {
			return new Promise((resolve, reject) => {
				let folderName = "recorded-audio/";
				let params = {
					Bucket: bucketName,
					Key: folderName + fileName
				};
				
				s3.deleteObject(params, function (err, data) {
					if (err) {
						reject(err);
					} else {
						resolve(data);
					}
				});
			})
		}
		
		var generateRandomString = () => {
    		let result = '';
			let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			let charactersLength = characters.length;
			for (var i = 0; i < 12; i++ ) {
			  result += characters.charAt(Math.floor(Math.random() * charactersLength));
			}
			return result;
		}
		
		var getURL = (file_ID) => {
			let url = new URL(window.location.origin + window.location.pathname);
			let params = new URLSearchParams(url.search.slice(1));

			// Add new parameters
			params.set('id', file_ID);

			// Add the new parameters to the URL
			url.search = params.toString();
			
			return url;
		}
		
        b.__name__ = !0;
        b.main = () => {
            window.addEventListener("DOMContentLoaded", function() {
				
				b.div1 = window.document.getElementById("div1");
				
				b.clipArea = window.document.getElementById("clip-area");
				b.canvas1 = window.document.getElementById("audio-player1");
				b.canvas2 = window.document.getElementById("audio-player2");
				b.canvas3 = window.document.getElementById("live-player");

                b.step1 = window.document.getElementById("recording-step1");
                b.step2 = window.document.getElementById("recording-step2");
				b.error = window.document.getElementById("error");
				
				b.toolBar1 = window.document.getElementById("toolBar1");
                b.toolBar2 = window.document.getElementById("toolBar2");
                
				b.note = window.document.getElementById("note");
                b.recordingStartBtn = window.document.getElementById("recorder-start-btn");
                b.recordingConfirmBtn = window.document.getElementById("check");
                b.recordingCancelBtn = window.document.getElementById("cancel");
                b.recordingAgainBtn = window.document.getElementById("start-again");
				b.downloadIconBtn = window.document.getElementById("download-icon");
				
				b.progress = window.document.getElementById("progress-container");
				
				b.pauseBtn = window.document.getElementsByClassName("pause");
				b.playBtn = window.document.getElementsByClassName("play");
				b.recordBtn = window.document.getElementById("record1");
				
				b.timeCount = window.document.getElementById("time-count");
				b.displayTotalTime = window.document.getElementById("total-time");
				
				b.stickLeft = window.document.getElementById("stick-left");
				b.stickRight = window.document.getElementById("stick-right");
				b.clipped = window.document.getElementById("clipped");
				
				//modal
				b.loadingModal = window.document.getElementById("loading-modal");
				b.qrModal = window.document.getElementById("qr-modal");
				b.shareBar = window.document.getElementById("share-bar");
				b.shareBK = window.document.getElementById("share-bk");
				b.socialBar = b.shareBar.querySelector("#social-network");
				b.clipboardBar = b.shareBar.querySelector("#clipboard-bar");
				
				//button - group 
				b.downloadBtn = window.document.getElementById("download");
				b.shareBtn = window.document.getElementById("share");
				b.deleteBtn = window.document.getElementById("delete");
				b.QRBtn = window.document.getElementById("qrcode");
				b.QRdownloadBtn = window.document.getElementById("download-QR");
				
				let isMouseDown, selected;
				
				// UI transition function
				b.moveToStep1 = () => {
					b.step1.style.display = "block";
				}
				
				b.moveToStep2 = () => {
					b.step2.style.display = "block";

					b.pauseBtn[1].style.display = "none";
					b.playBtn[1].style.display = "block";

					b.clipped.style.display = "none";
					b.canvas2.style.display = "block";
					b.canvas2.width = b.div1.clientWidth;
					b.canvas2.height = 154;
					b.canvas2.style.height = "154px";

					b.stickLeft.style.display = b.stickRight.style.display = "none";
					b.toolBar2.style.display = b.progress.style.display = b.clipArea.style.display = "flex";
				}
				
				b.moveStep1ToRecording = (direction) => {
					if(direction === "forward") {
						b.step1.style.display = "none";
						b.step2.style.display = "block";
     

						b.canvas1.style.display = "block";
						b.canvas1.width = b.div1.clientWidth;
						b.canvas1.height = 154;
						b.canvas1.style.height = "154px";

						b.toolBar1.style.display = "flex";
						
						b.pauseBtn[0].style.display = "block";
						b.playBtn[0].style.display = "none";
						b.recordBtn.style.display = "none";	
						
					} else if (direction === "backward") {
						b.step2.style.display = "none";
//                     	b.step1.style.display = "block";
					}
				}
				
				b.moveRecordingToClip = (direction) => {
					if(direction === "forward") { 
						b.canvas1.style.display = "none";
					
						b.canvas2.style.display = "block";
						b.canvas2.width = b.canvas3.width = b.div1.clientWidth;
						b.canvas2.height = b.canvas3.height = 154;
						b.canvas2.style.height = b.canvas3.style.height = "154px";

						b.clipArea.style.display = "flex";
						b.clipped.style.width = "100%";

						b.clipped.style.left = b.stickLeft.style.left = b.stickRight.style.right = '0px';
						b.stickRight.style.left 
							= b.stickRight.querySelector("div span").innerHTML 
							= b.stickLeft.querySelector("div span").innerHTML 
							= '';
						
						b.recordBtn.style.display = "none";
						b.playBtn[0].style.display = "block";
						
						b.recordingConfirmBtn.classList.remove("check1");
						b.recordingConfirmBtn.classList.remove("check2");

						b.recordingConfirmBtn.querySelector(".arrow").style.display = "none";
						b.downloadIconBtn.style.display = "block";

						b.stickLeft.style.display = b.stickRight.style.display = "flex";
					} else if(direction === "backward") {
						b.canvas1.style.display = "block";
						b.clipArea.style.display = "none";
						
// 						b.recordingConfirmBtn.classList.remove("check2");
						b.recordingConfirmBtn.classList.add("check1");
						b.recordingConfirmBtn.querySelector(".arrow").style.display = "none";
						b.downloadIconBtn.style.display = "none";

					}
				}
				
				b.splite = () => {
					let leftStickPosition = parseInt(window.getComputedStyle(b.stickLeft).getPropertyValue('left').slice(0, -2));
					let rightStickPosition = parseInt(window.getComputedStyle(b.stickRight).getPropertyValue('left').slice(0, -2));
					let width = parseInt(window.getComputedStyle(b.clipArea).getPropertyValue('width').slice(0, -2));

					// convert these positions to timescales
					let audioDuration = audioBuffer.duration;
					leftTime = leftStickPosition / width * audioDuration;
					rightTime = rightStickPosition / width * audioDuration;
					
					let method = (rightTime - leftTime) < 1 ;
					
					b.stickLeft.querySelector("div span").innerHTML = leftTime > 1 ? formatTime2(parseFloat(leftTime.toFixed(1)), method) : "";
					b.stickRight.querySelector("div span").innerHTML = (currentTime/100 - rightTime) > 1 ? formatTime2(parseFloat(rightTime.toFixed(1)), method) : "";

				};
				
				b.clipAudio = () => {
					let audioSampleRate = audioBuffer.sampleRate;
					let startSample = Math.round(leftTime * audioSampleRate);
					let endSample = Math.round(rightTime * audioSampleRate);
					let clipSampleCount = endSample - startSample;
					
					audioContext = audioContext 
						= window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.msAudioContext;
					let context = new audioContext();
					clipBuffer = context.createBuffer(audioBuffer.numberOfChannels, clipSampleCount, audioSampleRate);

					for (let channel = 0; channel < audioBuffer.numberOfChannels; channel++) {
						let channelData = audioBuffer.getChannelData(channel);
						let clipData = clipBuffer.getChannelData(channel);
						for (let i = startSample; i < endSample; i++) {
							clipData[i - startSample] = channelData[i];
						}
					}
					
					let clipBlob = bufferToMp3(clipBuffer);
					let clipUrl = URL.createObjectURL(clipBlob);
					b.setAudio(clipUrl, "clip");
				}
				
				b.moveStickBar = (e, env) => {
					if( (env === "desktop") && (e === undefined) ) return;
					if( (env === "mobile") && (e.touches === undefined) ) return;
					
					b.canvas3.style.display = "none";
					
					let clientX = env === "mobile" ? e.touches[0].clientX : e.clientX;
					let position = b.clipArea.getBoundingClientRect();
					let left = position.left;
					let width = b.clipArea.offsetWidth;

					b.splite();
					let cx = clientX - left;

					if (cx < 0) {
						cx = 0;
					}

					if (cx > width) {
						cx = width;
					}

					let stickLeft = parseInt(window.getComputedStyle(b.stickLeft).getPropertyValue('left').slice(0, -2));
					let stickRight = parseInt(window.getComputedStyle(b.stickRight).getPropertyValue('left').slice(0, -2));
					let limit = parseInt(window.getComputedStyle(b.clipArea).getPropertyValue('width').slice(0, -2)) / (currentTime/10);

					if(selected === "left") {
						if ( (stickRight - cx) > limit) {
							b.stickLeft.style.left = b.clipped.style.left = cx + 'px';
							b.clipped.style.width 
								=  parseInt(window.getComputedStyle(b.stickRight).left.slice(0, -2)) - cx + 'px';
						}
					} else if (selected === "right") {
						if ( (cx - stickLeft) > limit) {
							b.stickRight.style.left = cx + 'px';
							b.clipped.style.width 
								= cx - parseInt(window.getComputedStyle(b.stickLeft).left.slice(0, -2)) + 'px';
						}
					}
					
				}
				
				b.selectStick = (direction) => {
					isMouseDown = true;
					selected = direction;
					
					// Stop audio playback when user starts dragging sticks
					if (!audio.paused) {
						audio.pause();
						audio.currentTime = 0;
						clearInterval(liveInterval);
						b.pauseBtn[0].style.display = "none";
						b.playBtn[0].style.display = "block";
						b.canvas3.style.display = "none";
					}
				}

				b.stickLeft.addEventListener('touchstart', function(e) {
					b.selectStick("left");
				});
				
				b.stickRight.addEventListener('touchstart', function(e) {
				  	b.selectStick("right");
				})
				
				b.stickLeft.addEventListener('mousedown', function(e) {
					b.selectStick("left");
				});
				
				b.stickRight.addEventListener('mousedown', function(e) {
				  	b.selectStick("right");
				})

				document.addEventListener('mousemove', function(e) {
					if(isMouseDown) {
				  		b.moveStickBar(e, "desktop");
					}
				})
				
				document.addEventListener('touchmove', function(e) {
				  	if(isMouseDown) {
				  		b.moveStickBar(e, "mobile");
					}
				})

				document.addEventListener('mouseup', function() {
					if(isMouseDown) {
						b.clipAudio();
						isMouseDown = false;
					}
				})
				
				document.addEventListener('touchend', function() {
					if(isMouseDown) {
						b.clipAudio();
						isMouseDown = false;
					}
				})
				
				//function 
				b.navigateToFirst = () => {
					window.location.href = window.location.origin + window.location.pathname;
				};
				
				b.setAudio = (audioURL_t, step) => {
					audio = new Audio(audioURL_t);

					if(step === "clip") {
						audio.addEventListener('play', function() {
							liveInterval = setInterval(() => {
								b.livePlayStart(clipBuffer ?? audioBuffer);
							}, 50);
						});
						audio.addEventListener('ended', function() {
							if(status === 1) {
								b.pauseBtn[0].click();
								clearInterval(liveInterval);
							}
						});
						audio.addEventListener('pause', function() {
							if(status === 1) {
								clearInterval(liveInterval);
							}
						});
						
					} else if (step === "play") {
						audio.addEventListener('ended', function() {
							b.progress.querySelector("#progress #percentage").style.width = 100 + "%";
							end = true;
							audio.currentTime = 0;
							b.pauseBtn[1].click();
						})
					}
					
				}
				
				b.navigateToLast = async () => {
					
					//initialize QRcode
					let QRcontainer = b.qrModal.querySelector("#qrcontainer");
					QRcontainer.innerHTML = "";
					qrCode = null;
					
					if(method === "read") {
						b.loadingModal.style.display = "flex";
						b.loadingModal.querySelector("span").innerHTML = "<?php the_field("loading_file_title"); ?>";
						
						stored_file_URL = getURL(id_param);
						b.recordingStartBtn.click();
						
						try {
							let fileName = 'record_' + id_param + '.mp3';
							let audioBlob1 = await getFileFromS3("onlinemictest", fileName);
							let audioURL1 = URL.createObjectURL(audioBlob1);
							
							// Create a HTMLAudioElement with the Blob URL
							b.setAudio(audioURL1, "play");
							clipBuffer = await audioURLToBuffer(audioURL1);
							
							b.moveToStep2();
							b.audioStart(clipBuffer);
							
							b.timeCount.innerHTML = formatTime(Math.round(clipBuffer.duration * 100));
							b.displayTotalTime.innerHTML = formatTime1(Math.round(clipBuffer.duration));
							
							// Hide Delete Button
 							b.deleteBtn.parentElement.style.display = 
								document.querySelector(".extra-btn-group #extra").style.display = "none";
							document.querySelector(".action-group .record").style.position = "relative";
							
							let screenWidth = window.innerWidth;
							if(method === "read" && screenWidth > 625) {
								document.querySelector(".action-group").style.flexDirection = "row";
							}
							
						} catch(error) {
							b.error.style.display = "flex";
						}
						
						b.loadingModal.style.display = "none";

					} else if (method === "create") {
						stored_file_URL = getURL(fileID);
						
						clipBuffer = clipBuffer ?? audioBuffer;
						let audioBlob = bufferToMp3(clipBuffer);
						let audioUrl_p = URL.createObjectURL(audioBlob);
						b.setAudio(audioUrl_p, "play");
						
						b.audioStart(clipBuffer);
						
						b.toolBar2.style.display = b.progress.style.display = b.clipArea.style.display = "flex";
						
						b.timeCount.innerHTML = formatTime(Math.round(clipBuffer.duration * 100));
						b.displayTotalTime.innerHTML = formatTime1(Math.round(clipBuffer.duration));
					}
				}
				
				b.voice_record = () => {
					b.timeCount.innerHTML = "00 : 00 : 00";
					mediaRecorder.start();
					
					start_timeCount();
				}

				b.audioStart = (aBuffer) => {
					b.ctx2 = b.canvas2.getContext("2d");
					const data = aBuffer.getChannelData(0);
					const step = Math.ceil(data.length / b.canvas2.width);
					const amp = b.canvas2.height / 2;
					
					//clear canvas
					b.ctx2.clearRect(0, 0, b.canvas2.width, b.canvas2.height);
					
					let gradient = b.ctx2.createLinearGradient(0, 0, 0, b.canvas2.height);
            
					gradient.addColorStop(1, '#182934');
					gradient.addColorStop(0.5, '#86acc6');
					gradient.addColorStop(0, '#182934');
					
					b.ctx2.fillStyle = gradient;
					b.ctx2.beginPath();
					for(let i=0; i<b.canvas2.width; i++){
						let min = 1.0;
						let max = -1.0;
						for (let j=0; j<step; j++) {
							let datum = data[(i*step)+j];
							if (datum < min) {
								min = datum;
							} else if (datum > max) {
								max = datum;
							}
						}
						b.ctx2.fillRect(i,(1+min)*amp,1,Math.max(1,(max-min)*amp));
					}
					b.ctx2.stroke();
				}
				
				b.pauseBtn[0].addEventListener("click", () => {
					b.pauseBtn[0].style.display = "none";
					
					if( status === 0) {
						b.recordBtn.style.display = "flex";
						stop_timeCount();
						pauseRecording();	
					} else if ( status === 1) {
						b.playBtn[0].style.display = "block";
						audio.pause();
					}
				});
				
				b.pauseBtn[1].addEventListener("click", () => {
					b.pauseBtn[1].style.display = "none";
					b.playBtn[1].style.display = "block";
					
					audio.pause();
					clearInterval(replayInterval);
				});
				
				b.livePlayStart = (aBuffer) => {
					b.ctx3 = b.canvas3.getContext("2d");
					const data = aBuffer.getChannelData(0);
					const step = Math.ceil(data.length / b.canvas3.width);
					const amp = b.canvas3.height / 2;
					let gradient = b.ctx3.createLinearGradient(0, 0, 0, b.canvas3.height);
					
					let currentTime = audio.currentTime;
        			let totalDuration = audio.duration;
					
				 	let currentPosition = b.canvas3.width * currentTime / totalDuration;
            
					gradient.addColorStop(1, '#441c08');
					gradient.addColorStop(0.5, '#ec8e5f');
					gradient.addColorStop(0, '#441c08');
					b.ctx3.fillStyle = gradient;
					b.ctx3.beginPath();
					for(let i=0; i<currentPosition ; i++){
						let min = 1.0;
						let max = -1.0;
						for (let j=0; j<step; j++) {
							let datum = data[(i*step)+j];
							if (datum < min) {
								min = datum;
							} else if (datum > max) {
								max = datum;
							}
						}
						b.ctx3.fillRect(i, (1+min)*amp, 1.5, Math.max(1,(max-min)*amp));
					}
					b.ctx3.stroke();
				}
				
				b.playBtn[0].addEventListener("click", () => {
					b.pauseBtn[0].style.display = b.canvas3.style.display = "block";
					b.playBtn[0].style.display = "none";
					
					//Display canvas3 for real-time play wave
					b.canvas3.style.left = window.getComputedStyle(b.clipped).left;
					b.canvas3.width = b.clipped.clientWidth;
					
					audio.play();
				});
				
				b.recordBtn.addEventListener("click", () => {
					b.pauseBtn[0].style.display = "block";
					b.recordBtn.style.display = "none";
					continueRecording();
					start_timeCount();
				});
				
				b.playBtn[1].addEventListener("click", () => {
					if(end) {
						b.progress.querySelector("#progress #percentage").style.width = '0%';
					}
					end = false;
					
					b.pauseBtn[1].style.display = "block";
					b.playBtn[1].style.display = "none";
					audio.play();
					
					replayInterval = setInterval(() => {
						let percentage = b.progress.querySelector("#progress #percentage");
						percentage.style.width = audio.currentTime / clipBuffer.duration * 100 + "%";
						
						let current = b.div1.clientWidth * audio.currentTime / clipBuffer.duration;
						
						if(current < 55 || b.div1.clientWidth - current < 55) {
							percentage.querySelector("div span").innerHTML = "";
						} else {
							percentage.querySelector("div span").innerHTML = formatTime1(Math.round(audio.currentTime));
						}
					}, 100);
				});
				
				b.progress.querySelector("#progress").addEventListener("click", (e) => {
					const timelineWidth = window.getComputedStyle(b.progress.querySelector("#progress")).width;
					const timeToSeek = e.offsetX / parseInt(timelineWidth) * clipBuffer.duration;
				  	audio.currentTime = timeToSeek;
				})
                
                b.recordingStartBtn.addEventListener("click", () => {
					console.log('1');
					audio = new Audio();
					console.log('2');
					navigator.mediaDevices.getUserMedia({
						audio: !0
					}).then(b.onGetUserMedia, b.onGetUserMediaFailed);
					console.log('3');
                });
                
                b.recordingConfirmBtn.addEventListener("click", async () => {
					if( status === 0) {
						b.pauseBtn[0].click();
						stopRecording();
						
						b.moveRecordingToClip("forward");
	
						clipBuffer = null;
						leftTime = 0;
						rightTime = currentTime;
						fileID = generateRandomString();
						
						status = 1;
						
					} else if ( status === 1) {
// 						recordingDownload();
					}
                    
                });
				
				b.downloadIconBtn.addEventListener('click', () => {
					recordingDownload();
				});
				
				b.shareBtn.addEventListener("click", () => {
					b.clipboardBar.querySelector("#clipboard1").style.display = "block";
					b.clipboardBar.querySelector("#clipboard2").style.display = "none";
					b.clipboardBar.querySelector("#clipboard-input").value = stored_file_URL;
					
					b.shareBK.style.display = b.shareBar.style.display = "flex";
				});
				
				b.clipboardBar.querySelector("#clipboard").addEventListener("click", () => {
					b.clipboardBar.querySelector("#clipboard1").style.display = "none";
					b.clipboardBar.querySelector("#clipboard2").style.display = "block";
					navigator.clipboard.writeText(stored_file_URL);
					
					let messageBar = document.getElementById("copied-message");
					messageBar.classList.add("message-animate");
					messageBar.addEventListener("animationend", function(){
						messageBar.classList.remove("message-animate");
					});
					
				});
				
				b.QRBtn.addEventListener("click", () => {
					b.qrModal.style.display = "flex";
					b.generateQR(stored_file_URL.href);
				});
				
				b.QRdownloadBtn.addEventListener("click", () => {
					let QRcontainer = b.qrModal.querySelector("#qrcontainer");
					let downloadLink = document.createElement('a');
					downloadLink.href = QRcontainer.querySelector("img").src;
					downloadLink.download = 'OnlineMicTest_QRCode_' + (method === "read" ? id_param : fileID) + '.png';
					document.body.appendChild(downloadLink);
					downloadLink.click();
					document.body.removeChild(downloadLink);
				});
				
				b.generateQR = (content) => {
					let QRcontainer = b.qrModal.querySelector("#qrcontainer");
					if(qrCode === null) {
						qrCode = new QRCode(QRcontainer, {
							text: content,
							width: 256,
							height: 256,
							colorDark: "#000000",
							colorLight: "#fcfcfc",
							correctLevel: QRCode.CorrectLevel.H
						});
					}
				}
                
                b.recordingCancelBtn.addEventListener("click", () => {
					// Always stop audio playback
					audio.pause();
					audio.currentTime = 0;
					clearInterval(liveInterval);
					clearInterval(replayInterval);
					if( status === 0) {
						// Stop recording
						stopRecording();
						stop_timeCount();
						
						b.step2.style.display = "none";
						b.step1.style.display = "block";
						b.toolBar1.style.display = "none";
					} else if ( status === 1) {
						clipBuffer = null;
						status = 0;
						
						b.moveRecordingToClip("backward");

						// Go back to step1 directly instead of recursive click
						b.step2.style.display = "none";
						b.step1.style.display = "block";
						b.toolBar1.style.display = "none";
						b.downloadIconBtn.style.display = "none";
						b.recordingConfirmBtn.classList.add("check1");
					}
                });
				
				b.deleteBtn.addEventListener("click", async () => {
					b.loadingModal.style.display = "flex";
					b.loadingModal.querySelector("span").innerHTML = "<?php the_field("deleting_file_title"); ?>";
					
					try {
						let fileName = 'record_' + (method === 'read' ? id_param : fileID) + '.mp3';
						await deleteFileFromS3('onlinemictest', fileName);
						b.navigateToFirst();
					} catch(error) {
						console.log("err", error);
					}
					
					b.loadingModal.style.display = "none";
				});
                
                b.recordingAgainBtn.addEventListener("click", () => {
					b.navigateToFirst();
                });
				
				b.downloadBtn.addEventListener("click", () => {
					recordingDownload();
				});
				
				window.onclick = (event) => {
					if (event.target === b.qrModal) {
						b.qrModal.style.display = "none";
					}
					
					if (event.target === b.shareBK) {
						b.shareBar.style.display = b.shareBK.style.display = "none";
					}
				}
				
				
				
				window.addEventListener('resize', () => {
					let screenWidth = window.innerWidth;
					if(method === "read" && screenWidth > 625) {
						document.querySelector(".action-group").style.flexDirection = "row";
					} else {
						document.querySelector(".action-group").style.flexDirection = "column";
					}
				});
                
				b.ctx1 = b.canvas1.getContext("2d");
				
				if(id_param === null || id_param.length < 12) {
					status = 0;
					method = "create";
// 					b.note.style.display = "block";
					b.moveToStep1();
				} else {
					status = 2;
					method = "read";
					b.step2.style.display = "block";
// 					b.note.style.display = "none";
					b.step1.style.display = "none";
					b.navigateToLast();
				}

            });
        };
		
		b.onGetUserMedia = (stream) => {
			let audioContext = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.msAudioContext;
            let context;
            try {
              context = new audioContext();
            } catch (e) {
              console.log('not support AudioContext');
            }
			
			if(status === 0) {
				startRecording(stream);

				b.moveStep1ToRecording("forward");
				b.voice_record();

				audioInput = context.createMediaStreamSource(stream);
				var analyser = context.createAnalyser();
				audioInput.connect(analyser);

				b.visualizer(analyser);	
			}
		}
		
		b.onGetUserMediaFailed = (a) => {
			console.log("failed");
		};
		
		b.visualizer = (analyser) => {
            let cwidth = b.canvas1.width;
            let cheight = b.canvas1.height;
            let meterWidth = 5.4;
            let gap = 3;
            let meterNum = cwidth / (meterWidth + gap);
            let gradient = b.ctx1.createLinearGradient(0, 0, 0, cheight);
             
            gradient.addColorStop(1, '#436F8E');
            gradient.addColorStop(0.5, '#cbdbe7');
            gradient.addColorStop(0, '#436F8E');
            b.ctx1.fillStyle = gradient;
            var drawMeter = () => {
              var array = new Uint8Array(analyser.frequencyBinCount);
              analyser.getByteFrequencyData(array);

              var step = Math.round(array.length / meterNum);
              b.ctx1.clearRect(0, 0, cwidth, cheight);
              for (var i = 0; i < meterNum; i++) {
                var value = array[i * step] * 0.8;

                b.ctx1.fillRect(i * (meterWidth + gap), (cheight / 2) - value, meterWidth, value);
                b.ctx1.fillRect(i * (meterWidth + gap), cheight / 2, meterWidth, value);
              }
              requestAnimationFrame(drawMeter);
            }
            requestAnimationFrame(drawMeter);
        }
        
        b.main()
    })("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this);
</script>
<?php get_footer();