<?php /*Template Name: Microphone */
get_header();
?>
								<div class="microphone-test">
									<div class="microphone-1">
										<div class="width-100 wid-sm-100 wid-xs-100 dis-flex sm-flex-reverse gap-30 my-20">
											
											<div class="width-37 wid-sm-100 wid-xs-100 ct-row-1">
												<div class="ct-row microphone-info">
													<div>
														<div>
															<h3 class="ct-bold-text" style="text-align: center"><strong><?php the_field("microphone_information"); ?></strong></h3>
														</div>
													</div>
													<div class="data">
														<?php
														// check if the repeater field has rows of data
														if( have_rows('mic_info_list') ):

														// loop through the rows of data
														while ( have_rows('mic_info_list') ) : 
														the_row();
														$list_item = get_sub_field('list_item'); // Get the value of 'list_item' property in each row
														if ($list_item == "Microphone receiving sound") {
															echo '<div>';
															echo '<p class="list-item color-orange"><strong>'. $list_item . '</strong>:</p>';
															echo '<p class="list-value color-orange">' . get_sub_field('list_value') . '</p>';
															echo '</div>';
														} else {
															// The 'list_item' property is empty
															echo '<div>';
															echo '<p class="list-item"><strong>' . $list_item . '</strong>:</p>';
															echo '<p class="list-value">' . get_sub_field('list_value') . '</p>';
															echo '</div>';
														}
														endwhile;
														else :
														endif;
														?>
													</div>
												</div>
											</div>
											<div class="width-45 wid-sm-100 wid-xs-100 ct-row-1">
												<div class="ct-row web-test-res dis-flex flex-column">
													<div class="webcam-2-text_">
														<div class="icon-text-1">
															<h5 class="ct-bold-text title-sm"><?php the_field("select_mic_title"); ?>: &nbsp;</h5>
														</div>
													</div>
													<div class="webcam-2-text_">
														<div class="icon-text-1">
															<Select name="microphone_choice" id="microphone-choice">
																<option value="0"><?php the_field("microphone_list_title"); ?></option>
															</Select>
														</div>
													</div>
												</div>

												<div id="audio-area" class="ct-row microphone-wave">
													<div id="audio-initial-area">
														<div class="audio-div1 initial">
															<div></div>
														</div>
														<div class="audio-div1 start">
														</div>
													</div>
													<div id="audio-test-area">
														<canvas id="audio-canvas" class="audio-canvas1"></canvas>
														<div class="audio-div1 record"></div>
													</div>
													<div id="audio-error" class="audio-error"></div>
													<div id="audio-info" class="audio-info"></div>

												</div>

												<div class="ct-row microphone-test-tool">
													<div class="btn-group">
														<button id="audio-play-btn" class="webcam-btn">
															<span></span>
															<?php the_field("start_microphone_test"); ?>
														</button>
													</div>
													<div class="btn-group flex-column1" id="group1">
														<div id="progress-bar" class="record-progress-bar">
															<div id="progress" class="record-progress"></div>
															<div id="timeSpan">0:05</div>
														</div>
														<button id="record-start-btn" class="webcam-btn"><?php the_field("record_sample_title"); ?></button>
													</div>
													<div class="btn-group" id="group2">
														<button id="record-stop-btn" class="webcam-btn">Stop Recording</button>
													</div>
													<div class="btn-group flex-column1" id="group3">
														<div class="btn-group">
															<div id="audio-player" class="audio-player">
																<div class="controls">
																	<div class="play-container">
																		<div class="toggle-play play">
																		</div>
																	</div>
																	<div class="time">
																		<div class="current">0:00</div>
																		<div class="divider">/</div>
																		<div class="length">0:05</div>
																	</div>

																	<div class="timeline">
																		<div class="progress-bar">
																			<div class="progress"></div>
																		</div>
																	</div>

																	<div class="volume-container">
																		<div class="volume-button">
																			<div class="volume icono-volumeMedium"></div>
																		</div>

																		<div class="volume-slider">
																			<div class="volume-percentage"></div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="btn-group">
															<button id="record-download-btn" class="webcam-btn">
																<span></span>
															</button>
															<button id="record-again-btn" class="webcam-btn"><?php the_field("record_again_title"); ?></button>
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
        <!-- <link href="https://fonts.googleapis.com/css?display=swap&family=Open+Sans+Condensed:300,300i,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet"> 
            <script src="<?php echo get_template_directory_uri();?>/assets/MicTest.js.min"></script>-->

<script>
	(function(q) {
		var b = function() {};
		let selectedMicophoneDeviceId = -1;
		let microphoneInfo = [];
		let micophone_list = [];
		let mediaRecorder;
		let record_file_URL = "";
		let chunks = [];
		let audio = new Audio();
		let mic_detect_status = false;
		let mic_detect_interval;
		
		var move = () => {
			const element = window.document.getElementById("progress");
			const timeSpan = window.document.getElementById("timeSpan");
			let width = 0;
			let timeInterval = setInterval(frame, 100);
			function frame() {
				if (width > 100) {
					clearInterval(timeInterval);
				} else {
					if((100 - width) % 20 === 0) {
						timeSpan.innerText = '0:0' + (100 - width) / 20;
					}
					width+=2; 
					element.style.width = width + '%';
				}
			}
		}
		
		var display_microphoneInfo = () => {
			let box = window.document.getElementsByClassName("list-value");
			
			for ( let i in box ) {
				box[i].innerHTML = microphoneInfo[i] ?? "—";
			}
		}
		
		var clear_microphoneInfo = () => {
			microphoneInfo[3] = microphoneInfo[5] = microphoneInfo[6] = microphoneInfo[8] = "—";
		}
		
		var get_microphoneInfo_mediaStream = (stream) => {
			var audioTrack = stream.getAudioTracks()[0];
			var constraints = audioTrack.getConstraints();

			microphoneInfo[0] = "Testing...";
			microphoneInfo[1] = micophone_list[selectedMicophoneDeviceId].label;
			microphoneInfo[2] = "noiseSuppression" in constraints ? "yes" : "Not specified";
			microphoneInfo[4] = "autoGainControl" in constraints ? "yes" : "Not specified";
			microphoneInfo[7] = "echoCancellation" in constraints ? "yes" : "Not specified";
			
			display_microphoneInfo();
		}
	
		var get_microphoneInfo_audio = () => {
			
			let audioContext = new (window.AudioContext || window.webkitAudioContext)();

			fetch(record_file_URL)
				.then(response => response.arrayBuffer())
				.then( async arrayBuffer => {
				const t0 = performance.now();
				let audioBuffer = await audioContext.decodeAudioData(arrayBuffer);
				const t1 = performance.now();
				microphoneInfo[8] = Math.ceil(t1-t0) / 1000; 
				return audioBuffer;
				})
				.then(audioBuffer => {
					microphoneInfo[3] = audioBuffer.sampleRate;
					microphoneInfo[5] = audioBuffer.numberOfChannels;
					microphoneInfo[6] = 16;
				
					display_microphoneInfo();
				});
		}
		
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
		
		var setAudio = (audioURL) => {
			audio = new Audio(audioURL);

			audio.addEventListener('ended', function() {
				b.playBtn.classList.remove("pause");
				b.playBtn.classList.add("play");
			})
		}
		
		var media_record_func = (stream) => {
			mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.onstart = () => {
                chunks = [];
            }

            mediaRecorder.ondataavailable = function(e) {
                chunks.push(e.data);
            }

            mediaRecorder.onstop = async () => {
				let blob = new Blob(chunks, { 'type' : 'audio/mp3; codecs=opus' });
				let url = URL.createObjectURL(blob);
				
				let audioBuffer = await audioURLToBuffer(url);
				blob = bufferToMp3(audioBuffer);
				url = URL.createObjectURL(blob);

				// Here you have the audio blob url to use it wherever you want.
				record_file_URL = url;
				
				setAudio(record_file_URL);
				
				b.group1.style.display = b.audioErrorDisplay.style.display = "none";
				b.group3.style.display = "flex";
				
				get_microphoneInfo_audio();
				
				b.audioInfoDisplay.style.display = "block";
				b.audioInfoDisplay.innerHTML = "<strong><?php the_field("mic_info_filled"); ?></strong>";
				setTimeout(() => {
					b.audioInfoDisplay.innerHTML = "";
					b.audioInfoDisplay.style.display = "none";
				}, 4000);
            }
		}
		
		var getTimeCodeFromNum = (num) => {
			let seconds = parseInt(num);
			let minutes = parseInt(seconds / 60);
			seconds -= minutes * 60;
			const hours = parseInt(minutes / 60);
			minutes -= hours * 60;

			if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
			return `${String(hours).padStart(2, 0)}:${minutes}:${String(
				seconds % 60
			).padStart(2, 0)}`;
		}
		
		b.__name__ = !0;
		b.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				b.div = window.document.getElementById("audio-area");
				b.canvas = window.document.getElementById("audio-canvas");
				b.initialArea = window.document.getElementById("audio-initial-area");
				b.testArea = window.document.getElementById("audio-test-area");
				b.audioErrorDisplay = window.document.getElementById("audio-error");
				b.audioInfoDisplay = window.document.getElementById("audio-info");
				b.group1 = window.document.getElementById("group1");
				b.group2 = window.document.getElementById("group2");
				b.group3 = window.document.getElementById("group3");
				b.microphoneChoice = window.document.getElementById("microphone-choice");
				b.progressBar = window.document.getElementById("progress-bar");
				
				b.btnPlay = window.document.getElementById("audio-play-btn");
				b.btnRecordStart = window.document.getElementById("record-start-btn");
				b.btnRecordAgain = window.document.getElementById("record-again-btn");
				b.btnRecordDownload = window.document.getElementById("record-download-btn");
				
				//Audio - Player 
				b.audioPlayer = window.document.querySelector(".audio-player");
				b.timeline = b.audioPlayer.querySelector(".timeline");
				b.volumeSlider = b.audioPlayer.querySelector(".controls .volume-slider");
				b.playBtn = b.audioPlayer.querySelector(".controls .toggle-play");
				
				b.microphoneChoice.addEventListener("change", () => {
					selectedMicophoneDeviceId = b.microphoneChoice.value;
					
					if(b.group1.style.display === "flex" || b.group3.style.display === "flex") {
						clear_microphoneInfo();
						if(b.group3.style.display === "flex") {
							b.btnRecordAgain.click();
						}
						
						mic_detect_status = false;
						navigator.mediaDevices.getUserMedia({
							audio: selectedMicophoneDeviceId === -1 ? !0 : 
							{ 
								deviceId: { exact: micophone_list[selectedMicophoneDeviceId].deviceId },
								echoCancellation: true,
								noiseSuppression: true,
								autoGainControl: true
							},
						}).then(b.onGetUserMedia, b.onGetUserMediaFailed);
					}
				});
				
				audio.addEventListener("loadeddata", () => {
					audio.volume = .75;
				  },
				  false
				);
				
				b.timeline.addEventListener("click", e => {
				  const timelineWidth = window.getComputedStyle(b.timeline).width;
				  const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
				  audio.currentTime = timeToSeek;
				}, false);
				
				b.volumeSlider.addEventListener("click", e => {
				  const sliderWidth = window.getComputedStyle(b.volumeSlider).width;
				  const newVolume = e.offsetX / parseInt(sliderWidth);
				  audio.volume = newVolume;
				  b.audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
				}, false);
				
				setInterval(() => {
				  const progressBar = b.audioPlayer.querySelector(".progress");
				  progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
				  b.audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
					audio.currentTime
				  );
				}, 500);
				
				b.playBtn.addEventListener("click", () => {
					if (audio.paused) {
						b.playBtn.classList.remove("play");
						b.playBtn.classList.add("pause");
						audio.play();
					} else {
						b.playBtn.classList.remove("pause");
						b.playBtn.classList.add("play");
						audio.pause();
					}
				}, false);
				
				b.displayErrorMessage = function (type) {
					let message = "";
					switch(type) {
						case 0:
							message = "<strong><?php the_field("not_found_microphone_1"); ?></strong> - <?php the_field("not_found_microphone_2"); ?>";
							break;
						case 1:
							message = "<?php the_field("not_authorized_microphone"); ?>";
							break;
					}
					b.audioErrorDisplay.style.display = "block";
					b.audioErrorDisplay.innerHTML= message;
				}
								
				navigator.mediaDevices.enumerateDevices()
					.then(function(devices) {
					// Filter the results to get only audioinput devices (microphone)
					var microphone = devices.filter(function(device) {
						return device.kind === 'audioinput';
					});

					if(microphone.length === 0) {
						b.displayErrorMessage(0);
					} else {
						if(microphone[0].label === "") {
							return false;
						} else {
							micophone_list = microphone.map(({label, deviceId, groupId}) => ({ 
								label: label, 
								deviceId: deviceId,
								groupId: groupId
							}));
							
							selectedMicophoneDeviceId = 0;

							b.microphoneChoice.innerHTML = "";
							micophone_list.forEach((item, index) => {
								b.microphoneChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
							});	
						}	
					}

				}).catch(function(error) {
					b.displayErrorMessage(1);
				});
				
				b.btnPlay.addEventListener("click", () => {
					mic_detect_status = false;
					navigator.mediaDevices.getUserMedia({
						audio: selectedMicophoneDeviceId === -1 ? !0 : 
						{ 
							deviceId: { exact: micophone_list[selectedMicophoneDeviceId].deviceId },
							echoCancellation: true,
        					noiseSuppression: true,
        					autoGainControl: true
						},
					}).then(b.onGetUserMedia, b.onGetUserMediaFailed)
				});
				
				b.btnRecordStart.addEventListener("click", () => {
					
					b.audioInfoDisplay.style.display = "none";
					b.audioInfoDisplay.innerHTML = "";
					
					mediaRecorder.start();
					b.btnRecordStart.style.display = "none";
					b.progressBar.style.display = "block";
					move();
            
					// Stop recording after 5 seconds and get the audio as a blob
					setTimeout(async() => {
						mediaRecorder.stop();
					}, 5500);
				});
				
				b.btnRecordAgain.addEventListener("click", () => {
					window.URL.revokeObjectURL(record_file_URL);
					b.group3.style.display = "none";
					b.group1.style.display = "flex";
					window.document.getElementById("progress").style.width = '0%';
					b.btnRecordStart.style.display = "block";
					b.progressBar.style.display = "none";
					
					audio.pause();
				});
				
				b.btnRecordDownload.addEventListener("click", () => {
					var link = document.createElement('a');
					var d = new Date();
					link.href = record_file_URL;
					link.download = 'onlinemictest_' + d.toISOString() + '.mp3';  // Add your desired file name here.

					// Append to HTML (this part is needed for Firefox)
					document.body.appendChild(link);

					// Simulate Click
					link.click();  

					// Clean-up
					document.body.removeChild(link);
				});
				
				b.ctx = b.canvas.getContext("2d")
			})
		};
		b.onGetUserMediaFailed = function(a) {
			window.console.log("Getting user media failed: " + n.string(a));
			if("NotFoundError" === a.name) {
				b.displayErrorMessage(0);
			} else {
				b.displayErrorMessage(1);
			}
		};
		
		b.start_microphoneTest = function(stream) {
			mic_detect_interval = null;
			
			b.audioInfoDisplay.style.display = "block";
			b.btnPlay.style.display = "none";
			b.initialArea.style.display="none";
			b.testArea.style.display="block";
			b.group1.style.display="flex";
			
			b.audioInfoDisplay.innerHTML = "<strong><?php the_field("make_sound_instruction"); ?></strong>";
			
			get_microphoneInfo_mediaStream(stream);
			media_record_func(stream);
			
			b.canvas.width = b.div.clientWidth;
			b.canvas.height = b.div.clientHeight;
			b.audioErrorDisplay.style.display = "none";
			b.actx = new AudioContext;
			b.analyser = b.actx.createAnalyser();
			b.source = b.actx.createMediaStreamSource(stream);
			b.source.connect(b.analyser);
			b.visualize(stream);
			
			b.node = b.actx.createScriptProcessor(2048, 1, 1);
			b.analyser.smoothingTimeConstant = 0.8;
    		b.analyser.fftSize = 1024;
			
			b.analyser.connect(b.node);
    		b.node.connect(b.actx.destination);
			
			b.node.onaudioprocess = () => {
				if(!mic_detect_status && b.node !== null) {
					const array = new Uint8Array(b.analyser.frequencyBinCount);
					b.analyser.getByteFrequencyData(array);
					let values = 0;

					const length = array.length;
					for (let i = 0; i < length; i++) {
						values += array[i];
					}

					const average = values / length;
					// If the average is large enough then we can say that sound happened
					if (Math.round(average) > 10) {
						mic_detect_status = true;
						clearTimeout(mic_detect_interval);

						microphoneInfo[0] = "Yes";
						display_microphoneInfo();

						b.audioInfoDisplay.innerHTML = "<strong><?php the_field("mic_working_title"); ?></strong>";
						b.node = null;

						setTimeout(() => {
							b.audioInfoDisplay.innerHTML = "<strong><?php the_field("record_sample_instruction"); ?></strong>";
							setTimeout(() => {
								b.audioInfoDisplay.innerHTML = "";
							}, 10000);
						}, 4000);
					} else {
						if(mic_detect_interval === null) {
							mic_detect_interval = setTimeout(() => {
								microphoneInfo[0] = "No";
								display_microphoneInfo();
							}, 10000);	
						}
					}
				}
			}
		}
		
		b.onGetUserMedia = function(stream) {
			if(selectedMicophoneDeviceId < 0) {
				navigator.mediaDevices.enumerateDevices()
					.then(function(devices) {
					// Filter the results to get only videoinput devices (cameras)
					var microphone = devices.filter(function(device) {
						return device.kind === 'audioinput';
					});
					
					micophone_list = microphone.map(({label, deviceId, groupId}) => ({ 
						label: label, 
						deviceId: deviceId,
						groupId: groupId
					}));
					selectedMicophoneDeviceId = 0;

					b.microphoneChoice.innerHTML = "";
					micophone_list.forEach((item, index) => {
						b.microphoneChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
					});	
					
					b.start_microphoneTest(stream);

				}).catch(function(error) {
					b.displayErrorMessage(1);
				});
			} else {
				b.start_microphoneTest(stream);
			}
		};
		b.visualize = function(a) {
			b.ctx.clearRect(0, 0, b.canvas.width, b.canvas.height);
			var d = .5 * b.canvas.height,
				c = b.canvas.width / b.analyser.frequencyBinCount;
			var m = .5 * b.canvas.height;
			var e = new w(b.analyser.frequencyBinCount),
				f = null;
			f = function() {
				window.requestAnimationFrame(f);
				b.analyser.getFloatTimeDomainData(e);
				b.ctx.fillStyle = "#eeeeee";
				b.ctx.fillRect(0, 0, b.canvas.width, b.canvas.height);
				b.ctx.lineWidth = 6;
				b.ctx.strokeStyle = "#E25C1B";
				b.ctx.beginPath();
				for (var a = 0, h = e.length; a < h;) {
					var g = a++;
					b.ctx.lineTo(g * c, e[g] * m + d)
				}
				b.ctx.stroke()
			};
			f()
		};
		Math.__name__ = !0;
		var n = function() {};
		n.__name__ = !0;
		n.string = function(a) {
			return f.__string_rec(a, "")
		};
		var p = function() {};
		p.__name__ = !0;
		p.i32ToFloat = function(a) {
			var d = a >>> 23 & 255,
				c = a & 8388607;
			return 0 ==
			c && 0 == d ? 0 : (1 - (a >>> 31 << 1)) * (1 + Math.pow(2, -23) * c) * Math.pow(2, d - 127)
		};
		p.floatToI32 = function(a) {
			if (0 == a) return 0;
			var d = 0 > a ? -a : a,
				c = Math.floor(Math.log(d) / .6931471805599453); - 127 > c ? c = -127 : 128 < c && (c = 128);
			d = Math.round(8388608 * (d / Math.pow(2, c) - 1));
			8388608 == d && 128 > c && (d = 0, ++c);
			return (0 > a ? -2147483648 : 0) | c + 127 << 23 | d
		};
		var h = function(a) {
			Error.call(this);
			this.val = a;
			this.message = String(a);
			Error.captureStackTrace && Error.captureStackTrace(this, h)
		};
		h.__name__ = !0;
		h.wrap = function(a) {
			return a instanceof Error ? a : new h(a)
		};
		h.__super__ = Error;
		h.prototype = function(a, d) {
			function c() {}
			c.prototype = a;
			a = new c;
			for (var b in d) a[b] = d[b];
			d.toString !== Object.prototype.toString && (a.toString = d.toString);
			return a
		}(Error.prototype, {
			__class__: h
		});
		var f = function() {};
		f.__name__ = !0;
		f.getClass = function(a) {
			if (a instanceof Array && null == a.__enum__) return Array;
			var d = a.__class__;
			if (null != d) return d;
			a = f.__nativeClassName(a);
			return null != a ? f.__resolveNativeClass(a) : null
		};
		f.__string_rec = function(a, d) {
			if (null == a) return "null";
			if (5 <= d.length) return "<...>";
			var c = typeof a;
			"function" == c && (a.__name__ || a.__ename__) && (c = "object");
			switch (c) {
				case "function":
					return "<function>";
				case "object":
					if (a instanceof Array) {
						if (a.__enum__) {
							if (2 == a.length) return a[0];
							c = a[0] + "(";
							d += "\t";
							for (var b = 2, e = a.length; b < e;) {
								var g = b++;
								c = 2 != g ? c + ("," + f.__string_rec(a[g], d)) : c + f.__string_rec(a[g], d)
							}
							return c + ")"
						}
						c = a.length;
						b = "[";
						d += "\t";
						for (e = 0; e < c;) g = e++, b += (0 < g ? "," : "") + f.__string_rec(a[g], d);
						return b + "]"
					}
					try {
						b = a.toString
					} catch (B) {
						return "???"
					}
					if (null != b && b != Object.toString && "function" ==
						typeof b && (c = a.toString(), "[object Object]" != c)) return c;
					c = null;
					b = "{\n";
					d += "\t";
					e = null != a.hasOwnProperty;
					for (c in a) e && !a.hasOwnProperty(c) || "prototype" == c || "__class__" == c || "__super__" == c || "__interfaces__" == c || "__properties__" == c || (2 != b.length && (b += ", \n"), b += d + c + " : " + f.__string_rec(a[c], d));
					d = d.substring(1);
					return b + ("\n" + d + "}");
				case "string":
					return a;
				default:
					return String(a)
			}
		};
		f.__interfLoop = function(a, d) {
			if (null == a) return !1;
			if (a == d) return !0;
			var b = a.__interfaces__;
			if (null != b)
				for (var m = 0, e = b.length; m <
				e;) {
					var g = m++;
					g = b[g];
					if (g == d || f.__interfLoop(g, d)) return !0
				}
			return f.__interfLoop(a.__super__, d)
		};
		f.__instanceof = function(a, d) {
			if (null == d) return !1;
			switch (d) {
				case Array:
					return a instanceof Array ? null == a.__enum__ : !1;
				case t:
					return "boolean" == typeof a;
				case x:
					return !0;
				case u:
					return "number" == typeof a;
				case y:
					return "number" == typeof a ? (a | 0) === a : !1;
				case String:
					return "string" == typeof a;
				default:
					if (null != a)
						if ("function" == typeof d) {
							if (a instanceof d || f.__interfLoop(f.getClass(a), d)) return !0
						} else {
							if ("object" == typeof d &&
								f.__isNativeObj(d) && a instanceof d) return !0
						}
					else return !1;
					return d == z && null != a.__name__ || d == A && null != a.__ename__ ? !0 : a.__enum__ == d
			}
		};
		f.__nativeClassName = function(a) {
			a = f.__toStr.call(a).slice(8, -1);
			return "Object" == a || "Function" == a || "Math" == a || "JSON" == a ? null : a
		};
		f.__isNativeObj = function(a) {
			return null != f.__nativeClassName(a)
		};
		f.__resolveNativeClass = function(a) {
			return q[a]
		};
		var g = function(a) {
			if (a instanceof Array && null == a.__enum__) this.a = a, this.byteLength = a.length;
			else {
				this.a = [];
				for (var d = 0; d < a;) {
					var b =
						d++;
					this.a[b] = 0
				}
				this.byteLength = a
			}
		};
		g.__name__ = !0;
		g.sliceImpl = function(a, d) {
			a = new v(this, a, null == d ? null : d - a);
			d = new r(a.byteLength);
			(new v(d)).set(a);
			return d
		};
		g.prototype = {
			slice: function(a, d) {
				return new g(this.a.slice(a, d))
			},
			__class__: g
		};
		var l = function() {};
		l.__name__ = !0;
		l._new = function(a, d, b) {
			if ("number" == typeof a) {
				var c = [];
				for (d = 0; d < a;) {
					var e = d++;
					c[e] = 0
				}
				c.byteLength = c.length << 2;
				c.byteOffset = 0;
				a = [];
				d = 0;
				for (e = c.length << 2; d < e;) d++, a.push(0);
				c.buffer = new g(a)
			} else if (f.__instanceof(a, g)) {
				null == d && (d =
					0);
				null == b && (b = a.byteLength - d >> 2);
				c = [];
				for (e = 0; e < b;) {
					e++;
					var k = a.a[d++] | a.a[d++] << 8 | a.a[d++] << 16 | a.a[d++] << 24;
					c.push(p.i32ToFloat(k))
				}
				c.byteLength = c.length << 2;
				c.byteOffset = d;
				c.buffer = a
			} else if (a instanceof Array && null == a.__enum__) {
				c = a.slice();
				a = [];
				for (d = 0; d < c.length;) e = c[d], ++d, e = p.floatToI32(e), a.push(e & 255), a.push(e >> 8 & 255), a.push(e >> 16 & 255), a.push(e >>> 24);
				c.byteLength = c.length << 2;
				c.byteOffset = 0;
				c.buffer = new g(a)
			} else throw new h("TODO " + n.string(a));
			c.subarray = l._subarray;
			c.set = l._set;
			return c
		};
		l._set = function(a, d) {
			if (f.__instanceof(a.buffer, g)) {
				if (a.byteLength + d > this.byteLength) throw new h("set() outside of range");
				for (var b = 0, m = a.byteLength; b < m;) {
					var e = b++;
					this[e + d] = a[e]
				}
			} else if (a instanceof Array && null == a.__enum__) {
				if (a.length + d > this.byteLength) throw new h("set() outside of range");
				b = 0;
				for (m = a.length; b < m;) e = b++, this[e + d] = a[e]
			} else throw new h("TODO");
		};
		l._subarray = function(a, b) {
			b = l._new(this.slice(a, b));
			b.byteOffset = 4 * a;
			return b
		};
		var k = function() {};
		k.__name__ = !0;
		k._new = function(a, b,
						  c) {
			if ("number" == typeof a) {
				c = [];
				for (b = 0; b < a;) {
					var d = b++;
					c[d] = 0
				}
				c.byteLength = c.length;
				c.byteOffset = 0;
				c.buffer = new g(c)
			} else if (f.__instanceof(a, g)) null == b && (b = 0), null == c && (c = a.byteLength - b), c = 0 == b ? a.a : a.a.slice(b, b + c), c.byteLength = c.length, c.byteOffset = b, c.buffer = a;
			else if (a instanceof Array && null == a.__enum__) c = a.slice(), c.byteLength = c.length, c.byteOffset = 0, c.buffer = new g(c);
			else throw new h("TODO " + n.string(a));
			c.subarray = k._subarray;
			c.set = k._set;
			return c
		};
		k._set = function(a, b) {
			if (f.__instanceof(a.buffer,
				g)) {
				if (a.byteLength + b > this.byteLength) throw new h("set() outside of range");
				for (var c = 0, d = a.byteLength; c < d;) {
					var e = c++;
					this[e + b] = a[e]
				}
			} else if (a instanceof Array && null == a.__enum__) {
				if (a.length + b > this.byteLength) throw new h("set() outside of range");
				c = 0;
				for (d = a.length; c < d;) e = c++, this[e + b] = a[e]
			} else throw new h("TODO");
		};
		k._subarray = function(a, b) {
			b = k._new(this.slice(a, b));
			b.byteOffset = a;
			return b
		};
		String.prototype.__class__ = String;
		String.__name__ = !0;
		Array.__name__ = !0;
		var y = {
				__name__: ["Int"]
			},
			x = {
				__name__: ["Dynamic"]
			},
			u = Number;
		u.__name__ = ["Float"];
		var t = Boolean;
		t.__ename__ = ["Bool"];
		var z = {
				__name__: ["Class"]
			},
			A = {},
			r = q.ArrayBuffer || g;
		null == r.prototype.slice && (r.prototype.slice = g.sliceImpl);
		var w = q.Float32Array || l._new,
			v = q.Uint8Array || k._new;
		f.__toStr = {}.toString;
		l.BYTES_PER_ELEMENT = 4;
		k.BYTES_PER_ELEMENT = 1;
		b.main()
	})("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this);
</script>
<?php get_footer();