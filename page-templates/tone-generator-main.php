<?php
/* Template Name:Tone Generator Main */
get_header();
?>
<style media="screen">
.graph-card .cards {
	max-width: 100%;
	width: 100%;
	margin-bottom: 30px;
}
.range-slider input {
	width: 100%;
}
.play-btn-group {
    display: flex;
    gap: 15px;
}
.play-btn-group .btn {
    flex: 1;
	height: auto;
	display: flex;
	align-items: center;
	justify-content: center;
}
	.gap-15 {
		gap: 10px;
	}
@media all and (max-width: 1199px) {
	.title-m-md {
		margin-top: 30px !important;
	}
}
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
@media all and (max-width: 767px) {
	body.tone-generator .content-section article {
		padding: 25px;
	}
	body.tone-generator .container.toon-container {
		max-width: 100%;
	}
	body.tone-generator .margin2,  body.tone-generator .margin1 {
		margin: 20px 0;
	}
	body.tone-generator .container.toon-container .input-group.number-input{
		margin-bottom: 15px;
	}
	body.tone-generator h1.entry-title {
		margin: 0;
		padding: 0;
	}
}
 @media all and (max-width: 575px) {
.btn-groups .bt-secondary {
	padding: 0;
	color: #436f8e;
	background-color: #eee;
}
.breadcrumbs-row.dis-flex section.widget.widget_polylang select {
    font-size: 12px;
}
.play-btn-group {
    flex-flow: wrap;
    gap: 0;
}
.play-btn-group .btn:nth-child(2) {
    order: 1;
    width: 100%;
}
.play-btn-group .btn:nth-child(1) {
    order: 2;
    width: calc(50% - 10px);
    margin-right: 10px;
}
.play-btn-group .btn:nth-child(3) {
    order: 3;
    width: calc(50% - 10px);
    margin-left: 10px;
}
.play-btn-group .btn {
    margin: 15px 0 0 0;
    flex: auto;
}
}
	#number-input {
		align-items: center;
		padding: 0px 10px;
		flex-wrap: none;
	}
	#number-input .spinners {
		height: 100%;
		display: flex;
		flex-direction: column;
	}
	#number-input input {
		flex: 1;
		padding: 0;
		border: none;
		background: none;
		color: #436f8e;
		font-weight: 600;
		font-family: Lato, sans-serif;
		font-size: 24px;
	}
	#number-input input:focus, 
	#number-input button:focus {
		outline: none;
	}
	
	#number-input button {
		border: none;
		background: none;
		font-size: 12px;
	}
	#number-input button: hover {
		color: #d9d9d9;
	}
	.mr-10 {
		margin-right: 10px;
	}
	.label {
		display: none;
	} 
</style>

<div class="label">
	<span id="play_label"><?php the_field('play_label');?></span>
	<span id="pause_label"><?php the_field('pause_label');?></span>
	<span id="copy_label"><?php the_field('copy_label');?></span>
	<span id="copied_label"><?php the_field('copied_label');?></span>
</div>

<div class="container-fluid toon-container">
  <p class="style-heading d-none d-sm-block"><?php the_field('frequency_label');?></p>
  <div class="row align-items-center ">
    <div class="col-12 col-md-2 d-flex pb-md-0 pb-3 justify-content-between">
      <p class="style-heading d-block d-sm-none mr-10"><?php the_field('frequency_label');?></p>
      <div id="number-input" class="input-group number-input">
        <input  type="text" id="inputGroupSelect04" value="440Hz" class="qtyInputLoose col-md-12 col-12 " min="1" max="20000">
        <div class="spinners">
          <button class="spinner  spin1  increment">&#9650;</button>
          <button class="spinner spin2  decrement">&#9660;</button>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-10">
      <div class="slidecontainer">
        <input type="range" min="1" max="20000" value="440" class="slider" id="myRange">
      </div>
    </div>
  </div>
  <div class="row  py-md-5 pt-3 d-flex extra my-20">
    <div class="col-12 col-md-6 col-xl-3 d-flex-column">
      <h5 class="font-weight-bold margin1 style-heading"><?php the_field('volume_label');?></h5>
      <div class="d-flex align-items-center  range-slider"><img class="modi" src="<?= get_stylesheet_directory_uri();?>/assets/images/volume.png" alt="">
        <input type="range"
      min="0" max="100" value="5" class="slider1 mx-1" id="myRange1">
        <span id="volumeText"
      class="style-percent">5%</span> </div>
    </div>
    <div class="col-12 col-md-6 col-xl-3 d-flex-column">
      <h5 class="font-weight-bold margin2  style-heading p-0"><?php the_field('speaker_balance_label');?></h5>
	  <div>
		  <div class="d-flex col-md-12 col-12 p-0 justify-content-between ">
			<div class="style-speaker"><?php the_field('left_label');?></div>
			<div class=" style-speaker"><?php the_field('right_label');?></div>
		  </div>
		  <div class="d-flex align-items-center col-md-12 col-12 p-0 range-slider">
			<input type="range" min="-10" max="10" value="0" class="slider2"
		  id="myRange2">
		  </div>
	  </div>
    </div>
    <div class="col-12 col-md-12 col-xl-6 d-flex-column">
      <h5 class="title-m-md font-weight-bold text-md-center style-heading m-0"><?php the_field('current_note_label');?></h5>
      <div class="row btn-groups">
        <div class="col-12 play-btn-group">
          <div class="btn bt-secondary">
            <div class="d-flex align-items-center justify-content-center gap-15" id="play-button"><img class="modi"  src="<?= get_stylesheet_directory_uri();?>/assets/images/playicon.png" alt=""/><?php the_field('play_label');?></div>
          </div>
          <div class="btn bt-secondary" style="background-color: #e25c1b;">
            <div class="d-flex  dropdown-toggle align-items-center justify-content-center " type="button" id="note-opener" data-toggle="modal" data-target="#exampleModal" style="color: #fff;"> A4 </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                  <div class="modal-header modal-head">
                    <h5 class="modal-title  " id="exampleModalLabel"><?php the_field('select_note_label');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body d-flex ">
                    <div class="row " id="frequency_notes_parent">
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod"  >A4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod"  >A#4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">A#8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">B8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C0 </span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C5<span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#0 </span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#5<span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">C#8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">D#8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">E8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">F#8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G8</span> </div>
                      <div class="w-100"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#0</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#1</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#2</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#3</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#4</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#5</span> </div>
                      <div class="w-100 d-block d-sm-none"></div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#6</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#7</span> </div>
                      <div class="col btn butn-primary d-flex justify-content-center align-items-center  m-2"><span class="ed-mod  ">G#8</span> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btn bt-secondary">
            <div class="d-flex align-items-center justify-content-center gap-15" id="copy-button"> <img class="modi" src="<?= get_stylesheet_directory_uri();?>/assets/images/copy.png"
                alt=""><?php the_field('copy_label');?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>
    <h5 class="font-weight-bold style-heading mt-3 mt-md-5 mb-md-5"><?php the_field('waveform_label');?></h5>
    <div class="row d-flex align-items-center justify-content-around graph-card ">
      <div class="col-6 col-lg-3">
        <div class="py-4 text-center align-items-center cards" id="waveform-sine"> <img class="vector-des" src="<?= get_stylesheet_directory_uri();?>/assets/images/Vector1_blue.png" alt="">
          <span class="style_card"><?php the_field('sine_wave_label');?></span>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="py-4 text-center align-items-center cards" style="background-color: #e25c1b;color:#fff" id="waveform-square"> <img class="vector-des" src="<?= get_stylesheet_directory_uri();?>/assets/images/Vector2_white.png" alt="">
          <span class="style_card"><?php the_field('square_wave_label');?></span>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="py-4 text-center align-items-center cards" id="waveform-sawtooth"> <img class="vector-des" src="<?= get_stylesheet_directory_uri();?>/assets/images/Vector3_blue.png" alt="">
          <span class="style_card"><?php the_field('sawtooth_wave_label');?></span>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="py-4 text-center align-items-center cards" id="waveform-triangle"> <img class="vector-des" src="<?= get_stylesheet_directory_uri();?>/assets/images/Vector4_blue.png" alt="">
          <span class="style_card"><?php the_field('triangle_wave_label');?></span>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wid-sm-100 wid-xs-100">
  <div class="ct-row mar-bot-15 dis-flex"> <img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('mouse_icon_warning');?>" width="64" height="64">
    <div class="webcam-1-text_">
      <div class="icon-text-1">
        <h3 class="ct-bold-text">
          <?php the_field('get_easily_started_title_warning');?>
        </h3>
      </div>
    </div>
  </div>
  <div class="ct-row mar-bot-15 dis-flex"> <img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('mouse_icon');?>" width="64" height="64">
    <div class="webcam-1-text_">
      <div class="icon-text-1">
        <h3 class="ct-bold-text">
          <?php the_field('get_easily_started_title');?>
        </h3>
      </div>
    </div>
  </div>
  <div class="ct-row">
    <div class="new-webcam-desc">
      <ul>
        <?php

            // check if the repeater field has rows of data
            if( have_rows('get_easily_started_steps') ):

              // loop through the rows of data
              while ( have_rows('get_easily_started_steps') ) : the_row();?>
        <li> <span>
          <?php the_sub_field('numbers');?>
          </span>
          <div> <strong>
            <?php the_sub_field('title');?>
            </strong> </div>
        </li>
        <?php endwhile;
            else :
            endif;
            ?>
      </ul>
    </div>
  </div>
</div>
<div class="other-section">
  <div class="ct-row mic-settings-title"> <span>
    <?php the_field('links_title');?>
    </span> </div>
  <div class="mic-settings-section">
    <div class="mic-settings-menu width-50 wid-md-100">
      <ul>
        <?php

            // check if the repeater field has rows of data
            if( have_rows('links_table') ):

              // loop through the rows of data
              while ( have_rows('links_table') ) : the_row();?>
        <li class="dis-flex">
          <div class="webcam-icon"> <img class="tve_image" alt=""  src="<?php the_field('mouse_icon');?>" data-attachment-id="8509" width="24" height="24" style="margin-right: 10px;"> </div>
          <div> <a href="<?php the_sub_field('url');?>">
            <?php the_sub_field('link_name');?>
            </a> </div>
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
            <h2><strong>
              <?php the_field('more_about_title');?>
              </strong></h2>
          </div>
          <?php

          // check if the repeater field has rows of data
          if( have_rows('test_content') ):

           // loop through the rows of data
           while ( have_rows('test_content') ) : the_row();?>
          <div class="read-more-1">
            <div class="read-more-subtitle clearfix">
              <h3 class="mar-bot-20">
                <?php the_sub_field('heading');?>
              </h3>
            </div>
            <div class="read-more-text">
              <p>
                <?php the_sub_field('descp');?>
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
        <div class="img-section pad-left-15"> <img class="lazyload" src="<?php the_field('rightside_lazy_gif');?>" data-src="<?php the_field('rightside_image');?>"/> </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</article>
</div>
</div>
<?php get_footer();
