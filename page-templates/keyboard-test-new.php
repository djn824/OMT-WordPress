<?php /*Template Name:Keyboard New*/
get_header();
?>

<div class="keyboard-section">
	<div class="tve-content-box-background">
		<div class="keyboard full-size">
			<!-- contains "ESC" & Function (F1-F12) -->
			<section class="function region">
				<div class="key escape">ESC</div>
				<div class="empty-space-between-keys" aria-hidden="true"></div>
				<div class="key f1">F1</div>
				<div class="key f2">F2</div>
				<div class="key f3">F3</div>
				<div class="key f4">F4</div>
				<div class="empty-space-between-keys" aria-hidden="true"></div>
				<div class="key f5">F5</div>
				<div class="key f6">F6</div>
				<div class="key f7">F7</div>
				<div class="key f8">F8</div>
				<div class="empty-space-between-keys" aria-hidden="true"></div>
				<div class="key f9">F9</div>
				<div class="key f10">F10</div>
				<div class="key f11">F11</div>
				<div class="key f12">F12</div>
			</section>

			<!-- contains Top-Located Control (Prt Sc|Scr lck|Pause) keys -->
			<section class="system-control region">
				<div class="key printscreen key--accent-color">Prt Sc</div>
				<div class="key scrolllock key--accent-color">Scr Lk</div>
				<div class="key pause key--accent-color">Pause</div>
			</section>

			<!-- contains Modifier/Control (Ctrl|Alt|etc.) & Alpha (A-Z) keys -->
			<section class="typewriter region">
				<!-- number row (`, 1, 2, etc.) -->
				<div class="first-row">
					<div class="key backquote key--sublegend key--accent-color">
						<span>~</span> <span>`</span>
					</div>
					<div class="key digit1">1</div>
					<div class="key digit2">2</div>
					<div class="key digit3">3</div>
					<div class="key digit4">4</div>
					<div class="key digit5">5</div>
					<div class="key digit6">6</div>
					<div class="key digit7">7</div>
					<div class="key digit8">8</div>
					<div class="key digit9">9</div>
					<div class="key digit0">0</div>
					<div class="key minus key--sublegend">
						<span>&minus;</span> <span>&dash;</span>
					</div>
					<div class="key equal key--sublegend">
						<span>&plus;</span><span>&equals;</span>
					</div>
					<div class="key backspace key--accent-color">Backspace</div>
				</div>

				<!-- qwerty row (tab, \, q, w, etc.) -->
				<div class="second-row">
					<div class="key tab key--accent-color">Tab</div>
					<div class="key keyq">Q</div>
					<div class="key keyw">W</div>
					<div class="key keye">E</div>
					<div class="key keyr">R</div>
					<div class="key keyt">T</div>
					<div class="key keyy">Y</div>
					<div class="key keyu">U</div>
					<div class="key keyi">I</div>
					<div class="key keyo">O</div>
					<div class="key keyp">P</div>
					<div class="key bracketleft key--sublegend">
						<span>&lbrace;</span> <span>&lbrack;</span>
					</div>
					<div class="key bracketright key--sublegend">
						<span>&rbrace;</span> <span>&rbrack;</span>
					</div>
					<div class="key backslash key--sublegend key--accent-color">
						<span>&vert;</span><span>&Backslash;</span>
					</div>
				</div>

				<!-- asdfg row (caps, enter, a, s, etc.) -->
				<div class="third-row">
					<div class="key capslock key--accent-color">Caps</div>
					<div class="key keya">A</div>
					<div class="key keys">S</div>
					<div class="key keyd">D</div>
					<div class="key keyf">F</div>
					<div class="key keyg">G</div>
					<div class="key keyh">H</div>
					<div class="key keyj">J</div>
					<div class="key keyk">K</div>
					<div class="key keyl">L</div>
					<div class="key semicolon key--sublegend">
						<span>&colon;</span> <span>&semi;</span>
					</div>
					<div class="key quote key--sublegend">
						<span>&quot;</span> <span>&apos;</span>
					</div>
					<div class="key enter key--accent-color">Enter</div>
				</div>

				<!-- zxcvb row (left and right shift, <, >, ?, etc.) -->
				<div class="fourth-row">
					<div class="key shiftleft key--accent-color">Shift</div>
					<div class="key keyz">Z</div>
					<div class="key keyx">X</div>
					<div class="key keyc">C</div>
					<div class="key keyv">V</div>
					<div class="key keyb">B</div>
					<div class="key keyn">N</div>
					<div class="key keym">M</div>
					<div class="key comma key--sublegend">
						<span>&lt;</span> <span>&comma;</span>
					</div>
					<div class="key period key--sublegend">
						<span>&gt;</span> <span>&period;</span>
					</div>
					<div class="key slash key--sublegend">
						<span>&quest;</span> <span>&sol;</span>
					</div>
					<div class="key shiftright key--accent-color">Shift</div>
				</div>

				<!-- bottom row (ctrl, fn, win, alt, space, etc.) -->
				<div class="fifth-row">
					<div class="key controlleft key--accent-color">Ctrl</div>
					<!-- Added OSLeft for firefox support -->
					<div
						 class="key metaleft osleft key--accent-color"
						 aria-label="Windows key"
						 >
						<svg
							 xmlns="http://www.w3.org/2000/svg"
							 viewBox="0 0 4875 4875"
							 aria-label="Windows key icon"
							 >
							<path
								  d="M0 0h2311v2310H0zm2564 0h2311v2310H2564zM0 2564h2311v2311H0zm2564 0h2311v2311H2564"
								  fill="#436f8e"
								  />
						</svg>
					</div>
					<div class="key altleft key--accent-color">Alt</div>
					<div class="key space key--accent-color" aria-label="Space">
					</div>
					<div class="key altright key--accent-color">Alt</div>
					<div
						 class="key metaleft osleft key--accent-color"
						 aria-label="Windows key"
						 >
						<svg
							 xmlns="http://www.w3.org/2000/svg"
							 viewBox="0 0 4875 4875"
							 aria-label="Windows key icon"
							 >
							<path
								  d="M0 0h2311v2310H0zm2564 0h2311v2310H2564zM0 2564h2311v2311H0zm2564 0h2311v2311H2564"
								  fill="#436f8e"
								  />
						</svg>
					</div>
					<div class="key controlright key--accent-color">Ctrl</div>
				</div>
			</section>

			<!-- contains Navigation (PgUp|PgDn|etc.) & Arrow keys -->
			<section class="navigation region">
				<div class="key insert key--accent-color">Insert</div>
				<div class="key keyhome key--accent-color">Home</div>
				<div class="key pageup key--accent-color">Pg Up</div>
				<div class="key delete key--accent-color">Delete</div>
				<div class="key end key--accent-color">End</div>
				<div class="key pagedown key--accent-color">Pg Dn</div>
				<div class="key arrowup" aria-label="Up Arrow key">
					<svg
						 xmlns="http://www.w3.org/2000/svg"
						 enable-background="new 0 0 32 32"
						 viewBox="0 0 32 32"
						 aria-label="Up Arrow"
						 >
						<path
							  d="M18.221,7.206l9.585,9.585c0.879,0.879,0.879,2.317,0,3.195l-0.8,0.801c-0.877,0.878-2.316,0.878-3.194,0  l-7.315-7.315l-7.315,7.315c-0.878,0.878-2.317,0.878-3.194,0l-0.8-0.801c-0.879-0.878-0.879-2.316,0-3.195l9.587-9.585  c0.471-0.472,1.103-0.682,1.723-0.647C17.115,6.524,17.748,6.734,18.221,7.206z"
							  fill="#436f8e"
							  />
					</svg>
				</div>
				<div class="key arrowleft" aria-label="Left Arrow key">
					<svg
						 xmlns="http://www.w3.org/2000/svg"
						 enable-background="new 0 0 32 32"
						 viewBox="0 0 32 32"
						 aria-label="Left Arrow"
						 >
						<path
							  d="M7.701,14.276l9.586-9.585c0.879-0.878,2.317-0.878,3.195,0l0.801,0.8c0.878,0.877,0.878,2.316,0,3.194  L13.968,16l7.315,7.315c0.878,0.878,0.878,2.317,0,3.194l-0.801,0.8c-0.878,0.879-2.316,0.879-3.195,0l-9.586-9.587  C7.229,17.252,7.02,16.62,7.054,16C7.02,15.38,7.229,14.748,7.701,14.276z"
							  fill="#436f8e"
							  />
					</svg>
				</div>
				<div class="key arrowdown" aria-label="Down Arrow key">
					<svg
						 xmlns="http://www.w3.org/2000/svg"
						 enable-background="new 0 0 32 32"
						 viewBox="0 0 32 32"
						 aria-label="Down Arrow"
						 >
						<path
							  d="M14.77,23.795L5.185,14.21c-0.879-0.879-0.879-2.317,0-3.195l0.8-0.801c0.877-0.878,2.316-0.878,3.194,0  l7.315,7.315l7.316-7.315c0.878-0.878,2.317-0.878,3.194,0l0.8,0.801c0.879,0.878,0.879,2.316,0,3.195l-9.587,9.585  c-0.471,0.472-1.104,0.682-1.723,0.647C15.875,24.477,15.243,24.267,14.77,23.795z"
							  fill="#436f8e"
							  />
					</svg>
				</div>
				<div class="key arrowright" aria-label="Right Arrow key">
					<svg
						 xmlns="http://www.w3.org/2000/svg"
						 enable-background="new 0 0 32 32"
						 viewBox="0 0 32 32"
						 aria-label="Right Arrow"
						 >
						<path
							  d="M24.291,14.276L14.705,4.69c-0.878-0.878-2.317-0.878-3.195,0l-0.8,0.8c-0.878,0.877-0.878,2.316,0,3.194  L18.024,16l-7.315,7.315c-0.878,0.878-0.878,2.317,0,3.194l0.8,0.8c0.878,0.879,2.317,0.879,3.195,0l9.586-9.587  c0.472-0.471,0.682-1.103,0.647-1.723C24.973,15.38,24.763,14.748,24.291,14.276z"
							  fill="#436f8e"
							  />
					</svg>
				</div>
			</section>

			<!-- contains Numpad Keys -->
			<section class="numpad region">
				<div class="key numlock">NumLk</div>
				<div class="key numpaddivide">/</div>
				<div class="key numpadmultiply">&times;</div>
				<div class="key numpadsubtract">&minus;</div>
				<div class="key numpad7">7</div>
				<div class="key numpad8">8</div>
				<div class="key numpad9">9</div>
				<div class="key numpadadd">&plus;</div>
				<div class="key numpad4">4</div>
				<div class="key numpad5">5</div>
				<div class="key numpad6">6</div>
				<div class="key numpad1">1</div>
				<div class="key numpad2">2</div>
				<div class="key numpad3">3</div>
				<div class="key numpadenter">Enter</div>
				<div class="key numpad0">0</div>
				<div class="key numpaddecimal">&middot;</div>
			</section>

			<!-- contains Mousepad Keys -->
			<section class="mousepad region">
				<div class="empty-space-between-keys" aria-hidden="true"></div>
				<div class="key mouseleft"></div>
				<div class="key mousemiddle"></div>
				<div class="key mouseright"></div>
				<div class="empty-space-between-keys" aria-hidden="true"></div>
			</section>
		</div>
	</div>
	<div class="keyboard-test">
		<div class="keyboard-test-info dis-flex">
			<div class="keyboard-info-1 wid-xs-100">
				<div class="keyboard-info-1-img">
					<img alt="" width="100" height="67" title="keyboard icon" src="<?php the_field('leftside_keyboard_icon');?>">
				</div>
				<div class="keyboard-info-1-title">
					<div class="pd-1">
						<h3><?php the_field('leftside_keyboard_info_title1');?></h3>
					</div>
				</div>
			</div>
			<div class="keyboard-info-2 wid-xs-100">
				<div class="keyboard-info-2-text">
					<ul>
						<?php

						// check if the repeater field has rows of data
						if( have_rows('rightside_desc') ):

						// loop through the rows of data
						while ( have_rows('rightside_desc') ) : the_row();?>
						<li class="dis-flex">
							<div class="keyboard-list-icon">
								<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
									<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
								</svg>
							</div>
							<span class="keyboard-list-text">
								<?php the_sub_field('desc');?>
							</span>
						</li>
						<?php 
						endwhile;
						else :
						endif;
						?>
					</ul>
				</div>
			</div>
		</div>

		<?php

		// check if the repeater field has rows of data
		if( have_rows('keyboard_info') ):

		// loop through the rows of data
		while ( have_rows('keyboard_info') ) : the_row();?>
		<div class="keyboard-test-info dis-flex">
			<div class="keyboard-info-1 wid-xs-100">
				<div class="keyboard-info-1-title">
					<h3><?php the_sub_field('left_title');?></h3>
				</div>
			</div>
			<div class="keyboard-info-2 wid-xs-100">
				<div class="keyboard-info-2-text">
					<ul>
						<li class="dis-flex">
							<div class="keyboard-list-icon">
								<svg class="tcb-icon" viewBox="0 0 23 28" data-name="arrow-right">
									<path d="M23 15c0 0.531-0.203 1.047-0.578 1.422l-10.172 10.172c-0.375 0.359-0.891 0.578-1.422 0.578s-1.031-0.219-1.406-0.578l-1.172-1.172c-0.375-0.375-0.594-0.891-0.594-1.422s0.219-1.047 0.594-1.422l4.578-4.578h-11c-1.125 0-1.828-0.938-1.828-2v-2c0-1.062 0.703-2 1.828-2h11l-4.578-4.594c-0.375-0.359-0.594-0.875-0.594-1.406s0.219-1.047 0.594-1.406l1.172-1.172c0.375-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l10.172 10.172c0.375 0.359 0.578 0.875 0.578 1.406z"></path>
								</svg>
							</div>
							<span class="keyboard-list-text">
								<?php the_sub_field('right_desc');?>
							</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php 
		endwhile;
		else :
		endif;
		?>
	</div>

</div>

<?php get_template_part('template-parts/guides/trouble-shooting') ?>
</div>
</div>
</article>
</div>
</div>
</div>

<script>
	const handleKeyPress = (e) => {
		e.code && e.preventDefault();

		let mousekey = ['mouseleft', 'mousemiddle', 'mouseright'];

		let code = e.code ? e.code.toLowerCase() : mousekey[e.which - 1];
		if(code === 'home') {
			code = 'keyhome';
		}	

		const keyElement = document.querySelectorAll(`.keyboard-section .${code}`);
		
		for(let i in keyElement) {
			if (e.type === 'keydown' || e.type === 'mousedown') {
				keyElement[i].classList.add('key-pressing-simulation');
			} else if (e.type === 'keyup' || e.type === 'mouseup') {
				keyElement[i].classList.remove('key-pressing-simulation');
			}

			if (!keyElement[i].classList.contains('key--pressed'))
				keyElement[i].classList.add('key--pressed');

			// 'Meta' or 'OS' is a bit tricky and only in this way
			// we can reliably remove the class from the element
			if (e.key === 'Meta' || e.key === 'OS')
				keyElement[i].classList.remove('key-pressing-simulation');
		}

		
	};

	document.addEventListener('keydown', handleKeyPress);
	document.addEventListener('keyup', handleKeyPress);

	document.addEventListener('mousedown', handleKeyPress);
	document.addEventListener('mouseup', handleKeyPress);

	document.addEventListener("contextmenu", (e) => {
		e.preventDefault();
	});


</script>

<?php get_footer('2');?>