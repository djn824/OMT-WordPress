((q) => {

	var b = () => {};
	
	const placeButton = () => {
		let num = b.btnGroup.length;
		let space = Math.PI / (num - 1);
		let initialTime = 180;

		for (let i = 0 ; i < num; i++) {
			let x = 140 * Math.cos(Math.PI + i * space), y = 140 * Math.sin(Math.PI + i * space) + 25;
			b.btnGroup[i].style.transitionDuration = initialTime + i * 100 + 'ms';
			b.btnGroup[i].style.transform = `translate3d(${-x}px, ${-y}px, 0)`;
		}
	}
	
	const replaceButton = () => {
		let num = b.btnGroup.length;

		for (let i = num-1 ; i >= 0; i--) {
			b.btnGroup[i].style.transitionDuration = 360 + 'ms';
			b.btnGroup[i].style.transform = `translate3d(0px, -25px, 0)`;
		}
	}

	let frequencyRange = {
		"Sub-Bass": -20,
		"Low Bass": -20,
		"Bass": -20,
		"High Bass": -20,
		"Low Mids": -20,
		"Mids": -20,
		"High Mids": -20,
		"Low Treble": -20,
		"Treble": -20,
		"High Treble": -20
	};

	let frequencyLabel = ["Sub-Bass", "Low Bass", "Bass", "High Bass", "Low Mids", "Mids", "High Mids", "Low Treble", "Treble", "High Treble"];
	let filterType = ['lowshelf', 'peaking', 'peaking', 'peaking', 'peaking', 'peaking', 'peaking', 'peaking', 'peaking', 'highshelf'];
	
	const bufferSize = 4096;
	const fadeTime = 2;
	let context = window.AudioContext || window.webkitAudioContext || window.mozAudioContext || window.msAudioContext;
	let audioContext = null;
	let isplaying = false;

	// Function to convert dBFS (decibels full scale) to gain values
	const generateGaussianNoise = (mean, stdDev) => {
		let u = 0, v = 0;
		while (u === 0) u = Math.random(); // Generate random values until u is non-zero
		while (v === 0) v = Math.random();
		const z = Math.sqrt(-2.0 * Math.log(u)) * Math.cos(2.0 * Math.PI * v);
		return mean + stdDev * z;
	}
	
	const dBFSToGain = (dBFS) => {
		return Math.pow(10, dBFS/20);
	}
	
	let scriptNode, gainNode, filters = {};

	const createWhiteNoise = () => {
		
		audioContext = new context();
		scriptNode = (audioContext.createScriptProcessor || audioContext.createScriptProcessorNode).call(audioContext, bufferSize, 1, 1);
		gainNode = audioContext.createGain();
		gainNode.gain.setValueAtTime(0, audioContext.currentTime);
		
		scriptNode.connect(audioContext.destination);
		
// 		const createFilters = () => {
// 			for (let key in frequencyLabel) {
// 				let filter = audioContext.createBiquadFilter();
// 				filter.type = filterType[key];
// 				filter.frequency.value = 60;
// 				filter.gain.value = dBFSToGain(frequencyRange[frequencyLabel[key]]);
// 				filters[frequencyLabel[key]] = filter;
// 			}
// 		}
		
		const createFilters = () => {
			let octave = 30;
			
			for (let key in frequencyLabel) {
				let filter = audioContext.createBiquadFilter();
				let frequency = Math.pow(2, key) * octave;
				filter.type = filterType[key];
				filter.frequency.value = frequency;
				filter.gain.value = -6 * (key + 1);
				filters[frequencyLabel[key]] = filter;
			}
		}
		
		const connectFilters = () => {
			let lastFilter = scriptNode;
			for(let id in filters) {
				let filter = filters[id];
				lastFilter.connect(filter);
				lastFilter = filter;
			}
			lastFilter.connect(gainNode);
			gainNode.connect(audioContext.destination);
		}

		// Define the callback function for generating the white noise
		scriptNode.onaudioprocess = function(audioProcessingEvent) {
			const outputBuffer = audioProcessingEvent.outputBuffer;
			const outputData = outputBuffer.getChannelData(0);

			for (let i = 0; i < bufferSize; i++) {
				const sample = generateGaussianNoise(0, 0.5);
				const volume = 0.05;
				let gain = 0;
				for (let label of frequencyLabel) {
					gain += dBFSToGain(frequencyRange[label]);
				}
				outputData[i] += sample * gain * volume * gainNode.gain.value;
			}
		};
		
		createFilters();
		connectFilters();
		
	}

	const playNoise = () => {
		if(audioContext === null) {
			createWhiteNoise();
		}

		gainNode.gain.linearRampToValueAtTime(1, audioContext.currentTime + fadeTime);

		isplaying = true;
	}

	const stopNoise = () => {
		gainNode.gain.linearRampToValueAtTime(0, audioContext.currentTime + fadeTime);

		isplaying = false;
	}
		
	b.__name__ = !0;
	b.main = () => {
		window.addEventListener("DOMContentLoaded", function() {
			b.check = window.document.getElementById("main-btn");
			b.btnGroup = window.document.getElementsByClassName("general");
			b.displayInfo = window.document.querySelector(".display-info span");
			b.sliderBar = window.document.getElementsByClassName("slider-bar");
			
			b.resetBtn = window.document.getElementById("reset");
			b.increaseBtn = window.document.getElementById("increase");
			b.decreaseBtn = window.document.getElementById("decrease");
			
			for (let i of b.sliderBar) {
				i.oninput = () => {
					let freq = Number(i.value);
					frequencyRange[i.name] = freq;
					filters[i.name].gain.value = dBFSToGain(freq);
					let info = i.name + ": " + freq.toLocaleString() + " dBFS";
					b.displayInfo.innerHTML = info;
				}
			}
			
			b.resetBtn.addEventListener("click", () => {
				for (let i of b.sliderBar) { 
					frequencyRange[i.name] = i.value = (Number(i.min) + Number(i.max)) / 2;
				}	
			});
			
			b.increaseBtn.addEventListener("click", () => {
				for (let i of b.sliderBar) { 
					frequencyRange[i.name] = i.value = Number(i.value) - 1 < Number(i.min) ? Number(i.min) : Number(i.value) - 1 ;
				}	
			});
			
			b.decreaseBtn.addEventListener("click", () => {
				for (let i of b.sliderBar) { 
					frequencyRange[i.name] = i.value = Number(i.value) + 1 > Number(i.max) ? Number(i.max) : Number(i.value) + 1 ;
				}	
			});

			b.check.addEventListener("click", () => {
				let playBtn = b.check.querySelector("#play-btn");
				let pauseBtn = b.check.querySelector("#pause-btn");
				
				if(isplaying) {
					playBtn.style.display = "block";
					pauseBtn.style.display = "none";
					replaceButton();
					
					stopNoise();
				} else {
					playBtn.style.display = "none";
					pauseBtn.style.display = "block";
					placeButton();
					
					playNoise();
				}
			})
			
		});
	};

	b.main()
})("undefined" != typeof window ? window : "undefined" != typeof global ? global : "undefined" != typeof self ? self : this);