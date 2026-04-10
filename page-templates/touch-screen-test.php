<?php /*Template Name:Touch Screen*/
get_header();
?>
<style>
.touch-container {
	margin: 20px;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}
.touch-button {
	padding: 10px 20px;
	font-size: 18px;
	font-weight: 500;
	color: #fff;
	background-color: #e25c1b;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	aspect-ratio: 1/1;
	
	display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 15px;
}

.touch-button:hover {
	background-color: #cd5518;
}
#touchArea {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: grid;
	background-color: #fbfbfb;
	grid-gap: 1px;
	display: none;
	z-index: 100;
}

.box {
	background-color: #436f8e;
	touch-action: none;
	user-select: none;
	border-radius: 5px;
}

.box.touched {
	background-color: #e25c1b;
}

.italic {
	text-align: center;
}

.guide-area {
	position: absolute;
	width: 250px;
	z-index: 101;	
	background: white;
	padding: 20px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	flex-direction: column;
	justify-content: center;
	gap: 10px;
	font-size:16px;
	display: none;
	top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
}
.guide-area span{
	text-align: center;
	color: #436f8e;
	font-weight: 500;
}
.guide-area button {
	padding: 10px 20px;
	color: #fff;
	background-color: #e25c1b;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}
.testArea {
	position: relative;
}
#takeScreen {
	position: absolute;
	z-index: 102;	
	display: flex;
	justify-content: center;
	align-items: center;
	background: rgba(0, 0, 0, 0.7);
	padding: 10px;
	border-radius: 100%;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	top: -100px;
	left: 50%;
	transform: translate(-50%, 0);
	transition: all 1s;
}
#takeScreen img {
	width:40px;
}
/* #AdThrive_Footer_1_phone,
#AdThrive_Footer_1_desktop,
#AdThrive_Footer_1_tablet {
	display: none;
} */

#explanation {
	position: absolute;
	z-index: 105;
	width: 100%;
	font-size: 22px;
	height: 100%;
	display: none;
	flex-direction: column;
	justify-content: center;
	gap: 20px;
	background: rgba(0, 0, 0, 0.3);
	backdrop-filter:  blur(2px);
	-webkit-backdrop-filter: blur(2px);
	padding: 10rem;
}
	#explanation span {
		color: white;
	}
@media only screen and (max-width: 625px) { 
	.breadcrumbs {
		margin: 0px;
	}
	.keyboard-test .keyboard-info-1-title div {
		margin-top: 0px;
	}
	.keyboard-test .keyboard-info-1-title h3 {
		margin: 0px;
		line-height: 1.3rem;
	}
	.keyboard-test .keyboard-info-2-text {
		margin-top: 0px;
	}
	.keyboard-test .keyboard-list-text {
		line-height: 1.2rem;
	}
	.keyboard-test .keyboard-info-2-text {
		margin: 0px;
		padding-bottom: 0px;
	}
	.breadcrumbs .sub-title h2 {
		padding-bottom: 10px;
	}
	#explanation {
		padding: 1rem;
	}
}

</style>
<div class="keyboard-test">
	<div class="microphone-2 dis-flex">
		<div class="mic-2-text width-60 wid-md-50 wid-xs-100">
			<div class="pad-left-15">
				<div class="mic-2-title" style="display:inline-flex; margin-left:-20px">
					<img alt="" width="100" height="67" title="keyboard icon" src="<?php the_field('leftside_keyboard_icon');?>">
					<h3 id="moreExplanation" class="ct-bold-text"><?php the_field('leftside_keyboard_info_title1');?></h3>
				</div>
				<div class="mic-2-desc">
					<ul>
						<?php

						if( have_rows('rightside_desc') ):

						while ( have_rows('rightside_desc') ) : the_row();?>
							<li>
								<span class="mic-li-text">
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
		<div class="width-40 wid-md-50 wid-xs-100 dis-flex justify-center">
			<div class="touch-container">
				<button class="touch-button" onclick="enterFullscreen()">
					<span><?php the_field('start_title');?></span>
					<img src="<?php echo get_stylesheet_directory_uri();?>/../../uploads/2023/10/play-1.svg">
				</button>
				<div id="testArea">
					<div id="takeScreen" onclick="takeScreenshot()">
						<img src="<?php echo get_stylesheet_directory_uri();?>/../../uploads/2024/05/photo-camera.svg">
					</div>
					<div id="explanation">
						<?php

						if( have_rows('explanation') ):

						while ( have_rows('explanation') ) : the_row();?>
							<span><?php the_sub_field('item');?></span>
						<?php 
						endwhile;
						else :
						endif;
						?>
					</div>
					<div id="touchArea"></div>
					<div id="guideArea" class="guide-area">
						<span><?php the_field('success_title');?></span>
						<button onclick="exitFullscreen()">
							<?php the_field('confirm_title');?>
						</button>
					</div>
				</div>
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
							<p><?php the_sub_field('descp');?>
							</p>
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
</article>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dom-to-image@2.6.0/dist/dom-to-image.min.js"></script>
<script>
const touchArea = document.getElementById("touchArea");
const explanation = document.getElementById("explanation");
const guideArea = document.getElementById("guideArea");
const testArea = document.getElementById("testArea");
const screenShootBtn = document.getElementById("takeScreen");
let touchedCells;
let totalCells;

async function takeScreenshot() {
//     html2canvas(touchArea).then(canvas => {
//         const image = canvas.toDataURL("image/png");
// // 		console.log('image', image);
//         const link = document.createElement('a');
//         link.href = image;
//         link.download = 'screenshot.png';
// // 		console.log('link', link);
//         link.click();
//     });
  
	   domtoimage.toPng(touchArea)
        .then(function (dataUrl) {
            const link = document.createElement('a');
            link.href = dataUrl;
            link.download = 'screenshot.png';
            link.click();
//             screenShootBtn.disabled = false;
        })
        .catch(function (error) {
            console.error('Error:', error);
//             screenShootBtn.disabled = false;
        });
}

function enterFullscreen() {
    if (testArea.requestFullscreen) {
        testArea.requestFullscreen().then(() => {
            showGrid();
        }).catch(err => {
            alert(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
        });
    } else {
        // Simulate fullscreen for iOS devices
        simulateFullscreen();
    }
}

function exitFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else {
        // Restore from simulated fullscreen mode
        restoreFromFullscreenSimulation();
    }
}

function simulateFullscreen() {
    testArea.style.position = 'fixed';
    testArea.style.top = '0';
    testArea.style.left = '0';
    testArea.style.width = '100vw';
    testArea.style.height = '100vh';
    testArea.style.zIndex = '9999'; // Ensure it's on top
    showGrid();
}

function restoreFromFullscreenSimulation() {
    testArea.style.position = '';
    testArea.style.top = '';
    testArea.style.left = '';
    testArea.style.width = '';
    testArea.style.height = '';
    testArea.style.zIndex = '';
    screenShootBtn.style.top = '-100px';
    guideArea.style.display = 'none';
    touchArea.style.display = 'none';
    explanation.style.display = 'none';
}

function showGrid() {
    const boxSize = 50;
    const numColumns = Math.floor(window.innerWidth / boxSize);
    const numRows = Math.floor(window.innerHeight / boxSize);

    touchedCells = new Set();

    touchArea.innerHTML = '';
    touchArea.style.display = "grid";
    touchArea.style.gridTemplateColumns = `repeat(${numColumns}, 1fr)`;
    touchArea.style.gridTemplateRows = `repeat(${numRows}, 1fr)`;

    totalCells = numColumns * numRows;

    for (let i = 0; i < totalCells; i++) {
        const box = document.createElement("div");
        box.dataset.index = i.toString();
        box.className = "box";
        touchArea.appendChild(box);
    }
    
    explanation.style.display = 'flex';
    screenShootBtn.style.top = '30px';

    function touchCell(target) {
        if (target && target.classList.contains("box")) {
            if (!target.classList.contains("touched")) {
                target.classList.add("touched");
                touchedCells.add(target.dataset.index);

                if (touchedCells.size === totalCells) {
                    guideArea.style.display = 'flex';
                }
            }
        }
    }
    
    explanation.addEventListener("click", () => {
        explanation.style.display = 'none';
    });

    touchArea.addEventListener("touchstart", (event) => {
        touchCell(event.target);
        event.preventDefault();
    }, { passive: false });

    touchArea.addEventListener("touchmove", (event) => {
        const touch = event.touches[0];
        const targetElement = document.elementFromPoint(
            touch.clientX,
            touch.clientY
        );
        touchCell(targetElement);
        event.preventDefault();
    }, { passive: false });
}

document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            restoreFromFullscreenSimulation();
        }
    });

    // Add event listener for iOS to "exit fullscreen" simulation
    window.addEventListener('resize', () => {
        if (!document.fullscreenElement) {
            restoreFromFullscreenSimulation();
        }
    });
});
</script>

<?php get_footer();?>