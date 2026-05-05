<?php
/* Template Name:White Noise Generator*/
get_header();
?>
<div class="noise-container">
	<div class="width-100 my-20 white-noise">
		<div class="display-info">
			<span></span>
		</div>
		<div class="equalizer">
			<div class="slider">
				<input type="range" name="Sub-Bass" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="Low Bass" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="Bass" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="High Bass" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="Low Mids" class="slider-bar" min="-90" max="0" value="-45" step="1">
			</div>
			<div class="slider">
				<input type="range" name="Mids" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="High Mids" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="Low Treble" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="Treble" class="slider-bar" min="-90" max="0" value="-45" step="1">
				<input type="range" name="High Treble" class="slider-bar" min="-90" max="0" value="-45" step="1">
			</div>
		</div>
		<div class="control-bar">
			<div id="main-btn" class="main-btn">
				<div>
					<div id="pause-btn" class="pause-btn">
					</div>
					<div id="play-btn" class="play-btn">
					</div>
				</div>
			</div>
			<div class="general">
				<button class="general-btn">
					OK
				</button>
			</div>
			<div class="general">	
				<button class="general-btn">
					OK2
				</button>
			</div>
			<div class="general">	
				<button id="decrease" class="general-btn">
					<i class="fa fa-volume-up fa-2x"></i>
				</button>
			</div>
			<div class="general">	
				<button id="increase" class="general-btn">
					<i class="fa fa-volume-down fa-2x"></i>
				</button>
			</div>
			<div class="general">	
				<button id="reset" class="general-btn">
					<i class="fa fa-reply fa-2x"></i>
				</button>
			</div>
		</div>
	</div>
</div>
</div>
</article>
</div>
</div>
<?php get_footer();