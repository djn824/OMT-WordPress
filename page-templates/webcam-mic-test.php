<?php /*Template Name: Webcam Mic test*/
get_header();
?>
								<div class="microphone-test">
									<div class="microphone-1">
										<div class="width-100 wid-sm-100 wid-xs-100 dis-flex flex-column gap-30 my-20">

											<div class="width-45 wid-sm-100 wid-xs-100 ct-row-2">
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
													<video id="webcam-video1" class="webcam-video" muted></video>
													
													<p id="webcam-error"></p>
												</div>
											</div>
											<div class="width-45 wid-sm-100 wid-xs-100 ct-row-2">
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

												<div class="ct-row my1 microphone-test-tool">
													<div class="btn-group">
														<button id="audio-play-btn" class="webcam-btn">
															<span></span>
															<?php the_field("start_microphone_test"); ?>
														</button>
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
	(function(q) {
		var b = function() {};
		let selectedMicophoneDeviceId = -1;
		let selectedCameraDeviceId = -1;
		let micophone_list = [];
		let camera_list = [];
		let mediaRecorder;
		let record_file_URL = "";
		let chunks = [];
		let start_status = false;

		b.__name__ = !0;
		b.main = function() {
			window.addEventListener("DOMContentLoaded", function() {
				b.cameraDiv=window.document.getElementById("webcam-test");
				b.userMediaErrorDisplay=window.document.getElementById("webcam-error");
				b.video = window.document.getElementById("webcam-video1");
				b.previousDisplay=window.document.getElementById("webcam-start1");
				
				b.audioDiv = window.document.getElementById("audio-area");
				b.audioCanvas = window.document.getElementById("audio-canvas");
				b.initialArea = window.document.getElementById("audio-initial-area");
				b.testArea = window.document.getElementById("audio-test-area");
				b.audioErrorDisplay = window.document.getElementById("audio-error");
				b.audioInfoDisplay = window.document.getElementById("audio-info");

				b.microphoneChoice = window.document.getElementById("microphone-choice");
				b.cameraChoice = window.document.getElementById("camera-choice");
				
				b.btnPlay = window.document.getElementById("audio-play-btn");
				
				b.startMedia = () => {
					navigator.mediaDevices.getUserMedia({
						audio: selectedMicophoneDeviceId === -1 ? !0 : 
						{ 
							deviceId: { exact: micophone_list[selectedMicophoneDeviceId].deviceId },
							echoCancellation: true,
							noiseSuppression: true,
							autoGainControl: true
						},
						video:{ 
							width: b.cameraDiv.ientWidth,
							height: b.cameraDiv.clientHeight,
							...camera_list.length !== 0 ? {deviceId: { exact: camera_list[selectedCameraDeviceId].id }, facingMode: camera_list[selectedCameraDeviceId].facingMode} : {},
						}
					}).then(b.onGetUserMedia, b.onGetUserMediaFailed);
				}
				
				b.microphoneChoice.addEventListener("change", () => {
					selectedMicophoneDeviceId = b.microphoneChoice.value;
					
					if(start_status) {
						b.startMedia();
					}
				});
				
				b.cameraChoice.addEventListener("change", () => {
					selectedCameraDeviceId = b.cameraChoice.value;
					
					if(start_status) {
						b.startMedia();
					}
				});
				
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
					let microphone = devices.filter((device) => {
						return device.kind === 'audioinput';
					});
					let cameras = devices.filter((device) => {
						return device.kind === 'videoinput';
					});

					if(microphone.length === 0 || cameras.length === 0) {
						b.displayErrorMessage(0);
					} else {
						if(microphone[0].label === "" || cameras[0].label === "") {
							return false;
						} else {
							micophone_list = microphone.map(({label, deviceId, groupId}) => ({ 
								label: label, 
								deviceId: deviceId,
								groupId: groupId
							}));
							
							camera_list = cameras.map((camera) => ({ 
								label: camera.label, 
								id: camera.deviceId , 
								facingMode: camera.label.toLowerCase().includes('front') ? 'user' : 'environment',
							}));
							
							selectedMicophoneDeviceId = selectedCameraDeviceId = 0;

							b.microphoneChoice.innerHTML = "";
							micophone_list.forEach((item, index) => {
								b.microphoneChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
							});	
							
							b.cameraChoice.innerHTML = "";
							camera_list.forEach((item, index) => {
								b.cameraChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
							});
						}	
					}

				}).catch(function(error) {
					b.displayErrorMessage(1);
				});
				
				b.btnPlay.addEventListener("click", () => {
					start_status = true;
					b.startMedia();
				});
				
				b.ctx = b.audioCanvas.getContext("2d");
			})
		};
		b.onGetUserMediaFailed = function(a) {
			start_status = false;
			window.console.log("Getting user media failed: " + n.string(a));
			if("NotFoundError" === a.name) {
				b.displayErrorMessage(0);
			} else {
				b.displayErrorMessage(1);
			}
		};
			
		b.start_webcam = (stream) => {
			b.userMediaErrorDisplay.style.display = "none";
			b.previousDisplay.style.display = "none";

			b.cameraDiv.style.height = b.cameraDiv.clientHeight+"px";
			b.video.srcObject = stream;
			b.video.width = b.cameraDiv.clientWidth;
			b.video.height = b.cameraDiv.clientHeight;
			b.video.onloadedmetadata = (stream) => {
				b.video.play();
			};
			b.cameraDiv.appendChild(b.video);
		}
		
		b.start_microphoneTest = (stream) => {

			b.audioInfoDisplay.style.display = "block";
			b.initialArea.style.display="none";
			b.testArea.style.display="block";

			b.audioCanvas.width = b.audioDiv.clientWidth;
			b.audioCanvas.height = b.audioDiv.clientHeight;
			b.audioErrorDisplay.style.display = "none";
			b.actx = new AudioContext;
			b.analyser = b.actx.createAnalyser();
			b.source = b.actx.createMediaStreamSource(stream);
			b.source.connect(b.analyser);
			b.visualize(stream);
		}
		
		b.onGetUserMedia = function(stream) {
			if(selectedMicophoneDeviceId < 0 || selectedCameraDeviceId < 0) {
				navigator.mediaDevices.enumerateDevices()
					.then((devices) => {
					
					if(selectedMicophoneDeviceId < 0) {
						// Filter the results to get only videoinput devices (cameras)
						let microphone = devices.filter((device) => {
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
					} 
					if(selectedCameraDeviceId < 0) {
						let cameras = devices.filter((device) => {
							return device.kind === 'videoinput';
						});
						
						camera_list = cameras.map((camera) => ({ 
							label: camera.label, 
							id: camera.deviceId , 
							facingMode: camera.label.toLowerCase().includes('front') ? 'user' : 'environment',
						}));
						
						selectedCameraDeviceId = 0;
						
						b.cameraChoice.innerHTML = "";
						camera_list.forEach((item, index) => {
							b.cameraChoice.innerHTML += "<option value='" + index + "'>" + item.label + "</option>";
						});
						
						b.start_webcam(stream);
					}

				}).catch(function(error) {
					b.displayErrorMessage(1);
				});
			} else {
				b.start_webcam(stream);
				b.start_microphoneTest(stream);
			}
		};
		b.visualize = (a) => {
			b.ctx.clearRect(0, 0, b.audioCanvas.width, b.audioCanvas.height);
			var d = .5 * b.audioCanvas.height,
				c = b.audioCanvas.width / b.analyser.frequencyBinCount;
			var m = .5 * b.audioCanvas.height;
			var e = new w(b.analyser.frequencyBinCount),
				f = null;
			f = function() {
				window.requestAnimationFrame(f);
				b.analyser.getFloatTimeDomainData(e);
				b.ctx.fillStyle = "#eeeeee";
				b.ctx.fillRect(0, 0, b.audioCanvas.width, b.audioCanvas.height);
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