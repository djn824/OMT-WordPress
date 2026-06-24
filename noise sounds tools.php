<?php /*Template Name:Noise Sounds Tools*/
get_header(); ?>
<style media="screen">
	/* Search Input */
	.input-group .form-control,
	.input-group .input-group-text {
		border-radius: 25px;
		border-color: #dee2e6;
	}

	.input-group .input-group-text {
		border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}

	.input-group .form-control {
		border-top-left-radius: 0;
		border-bottom-left-radius: 0;
	}

	.input-group .form-control:focus {
		box-shadow: none;
		border-color: #436f8e;
	}

	.input-group-lg:focus-within .input-group-text {
		border-color: #436f8e;
	}

	.search-wrapper {
		width: 250px;
		flex-shrink: 0;
	}

	.search-wrapper .input-group {
		border-radius: 50px;
		overflow: hidden;
	}

	/* A single 1rem gap drives both layouts: when the filter strip sits beside
	   the search input it becomes a 1rem horizontal gap; when it wraps below,
	   the same value becomes the 1rem space above it. No margins to go stale. */
	.toolbar {
		gap: 1rem;
	}

	/* Filter strip: flush-left under the search input, evenly spaced buttons.
	   Spacing is owned by the flex gap (not per-button margins) so the first
	   button lines up exactly with the search input's left edge. */
	#categoryFilters {
		padding-left: 0;
		gap: 0.5rem;
		align-items: center;
	}

	#categoryFilters .btn-filter {
		margin: 0 !important;
	}

	/* Filter Buttons */
	.btn-filter {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 0.4rem;
		line-height: 1.2;
		background-color: #f0f0f0;
		color: #666;
		border: none;
		border-radius: 10px;
		padding: 0.35rem 0.6rem;
		font-weight: 500;
		transition: all 0.2s ease;
	}

	.btn-filter .tab-icon {
		font-size: 1.1rem;
		line-height: 1;
	}

	.btn-filter:hover {
		background-color: #e0e0e0;
		color: #333;
	}

	.btn-filter.active {
		background-color: #436f8e;
		color: white;
		box-shadow: 0 4px 12px rgba(67, 111, 142, 0.3);
	}

	.btn-filter.active .tab-icon {
		color: #e25c1b;
	}

	/* Sound Cards */
	.tool-card {
		display: flex;
		align-items: flex-start;
		gap: 1rem;
		padding: 0.9rem 0.625rem 0.625rem 0.9rem;
		background: white;
		border-radius: 12px;
		border: 2px solid transparent;
		color: inherit;
		transition: all 0.3s ease;
		animation: fadeIn 0.4s ease-out forwards;
		opacity: 0;
		height: 100%;
		min-height: 100px;
		width: 100%;
	}

	.tool-card:hover {
		transform: translateY(-4px) scale(1.02);
		color: inherit;
	}

	/* ---- Category color tokens ----
	   Each category exposes: --cat (main), --cat-rgb (for shadows),
	   --cat-bg (light fill), --cat-border (resting border). These inherit
	   down to icons, sliders and pulse animation, so the rules below stay
	   category-agnostic. */
	.tool-card.category-rain,
	.sound-orb.category-rain,
	.stage-volume.category-rain,
	.category-header.category-rain   { --cat: #436f8e; --cat-rgb: 67, 111, 142; --cat-bg: #e8f0f5; --cat-border: #a3c1d4; }
	.tool-card.category-water,
	.sound-orb.category-water,
	.stage-volume.category-water,
	.category-header.category-water  { --cat: #1b9aaa; --cat-rgb: 27, 154, 170; --cat-bg: #e4f4f6; --cat-border: #a6dce2; }
	.tool-card.category-nature,
	.sound-orb.category-nature,
	.stage-volume.category-nature,
	.category-header.category-nature { --cat: #4f8a3f; --cat-rgb: 79, 138, 63;  --cat-bg: #edf5e9; --cat-border: #b9d4ac; }
	.tool-card.category-noise,
	.sound-orb.category-noise,
	.stage-volume.category-noise,
	.category-header.category-noise  { --cat: #7c4daf; --cat-rgb: 124, 77, 175; --cat-bg: #f3eef9; --cat-border: #c4a8db; }
	.tool-card.category-focus,
	.sound-orb.category-focus,
	.stage-volume.category-focus,
	.category-header.category-focus  { --cat: #e25c1b; --cat-rgb: 226, 92, 27;  --cat-bg: #fef3ee; --cat-border: #f5b08a; }

	/* Category-specific card styles (driven by the tokens above) */
	.tool-card[class*="category-"] {
		border-color: var(--cat-border);
	}
	.tool-card[class*="category-"]:hover {
		border-color: var(--cat);
		box-shadow: 0 8px 24px rgba(var(--cat-rgb), 0.2);
	}

	/* Active (playing) card */
	.tool-card.active[class*="category-"] {
		border-color: var(--cat);
		background: var(--cat-bg);
		box-shadow: 0 8px 24px rgba(var(--cat-rgb), 0.2);
	}

	/* Icon Container */
	.tool-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 48px;
		height: 48px;
		min-width: 48px;
		border-radius: 10px;
		font-size: 1.5rem;
		cursor: pointer;
		transition: all 0.2s ease;
	}

	.tool-icon[class*="category-"] {
		background-color: var(--cat-bg);
		color: var(--cat);
	}

	.tool-card.active .tool-icon[class*="category-"] {
		background-color: var(--cat);
		color: #fff;
	}

	/* Playing (enabled sound) icon animation.
	   The pulse ring color comes from the inherited --cat-rgb token,
	   so a single keyframe works for every category. */
	.tool-card.active .tool-icon {
		animation: soundPulse 1.6s ease-out infinite;
	}

	.tool-card.active .tool-icon i {
		animation: iconBeat 1.6s ease-in-out infinite;
	}

	@keyframes soundPulse {
		0%   { box-shadow: 0 0 0 0 rgba(var(--cat-rgb), 0.45); }
		70%  { box-shadow: 0 0 0 12px rgba(var(--cat-rgb), 0); }
		100% { box-shadow: 0 0 0 0 rgba(var(--cat-rgb), 0); }
	}

	@keyframes iconBeat {
		0%, 100% { transform: scale(1); }
		50%      { transform: scale(1.18); }
	}

	@media (prefers-reduced-motion: reduce) {
		.tool-card.active .tool-icon,
		.tool-card.active .tool-icon i {
			animation: none;
		}
	}

	/* Loading spinner shown on the icon while a sound buffers after clicking */
	.tool-icon.loading {
		/* pause the pulse ring while loading so only the spinner shows */
		animation: none !important;
	}
	.tool-icon.loading i {
		display: none;
	}
	.tool-icon.loading::after {
		content: "";
		width: 22px;
		height: 22px;
		border: 2.5px solid currentColor;
		border-top-color: transparent;
		border-radius: 50%;
		animation: iconSpin 0.7s linear infinite;
	}

	@keyframes iconSpin {
		to { transform: rotate(360deg); }
	}

	/* Tool Content */
	.tool-content {
		flex: 1;
		min-width: 0;
		text-align: left;
	}

	.tool-name {
		font-weight: 600;
		font-size: 1rem;
		margin-bottom: 0.1rem;
		color: #1a1a1a;
		text-align: left;
	}

	.tool-description {
		font-size: 0.875rem;
		color: #666;
		margin: 0 0 0.4rem;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-align: left;
	}

	/* Volume Slider */
	.sound-slider {
		-webkit-appearance: none;
		appearance: none;
		width: 100%;
		height: 6px;
		border-radius: 5px;
		background: #e0e0e0;
		outline: none;
		cursor: pointer;
		margin: 0;
	}

	.sound-slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 32px;
		height: 32px;
		border-radius: 50%;
		background: var(--cat, #436f8e);
		cursor: pointer;
		border: 2px solid #fff;
		box-shadow: 0 1px 4px rgba(0,0,0,0.2);
	}

	.sound-slider::-moz-range-thumb {
		width: 32px;
		height: 32px;
		border-radius: 50%;
		background: var(--cat, #436f8e);
		cursor: pointer;
		border: 2px solid #fff;
		box-shadow: 0 1px 4px rgba(0,0,0,0.2);
	}

	/* Fade In Animation */
	@keyframes fadeIn {
		from {
			opacity: 0;
			transform: translateY(10px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* =====================================================================
	   Soundscape circular layout (left side)
	   Layer 1: intro  ·  Layer 2: category tabs  ·  Layer 3: sound circle
	   ===================================================================== */

	/* Layer 1 — intro / description (left-aligned, full width) */
	.soundscape-intro {
		font-size: 1.35rem;
		font-weight: 700;
		line-height: 1.3;
		color: #436f8e;
		text-align: left;
		margin: 0 0 1.25rem;
		width: 100%;
		max-width: none;
	}

	/* Layer 2 — category tabs row (reuses .btn-filter chips, left-aligned) */
	.category-tabs {
		display: flex;
		flex-wrap: wrap;
		justify-content: flex-start;
		gap: 0.5rem;
		margin-bottom: 1.5rem;
	}

	/* Layer 3 — the circular stage. Square box; orbs are positioned around
	   the centre with JS-computed percentage coordinates so it scales fluidly. */
	.circle-stage {
		/* Radius of the ring the list orbs sit on: 160px on desktop, scaling down
		   on narrow viewports so the orbs never overflow the stage. */
		--ring-r: min(160px, 36vw);
		position: relative;
		width: 100%;
		max-width: 460px;
		margin: 0 auto;
		aspect-ratio: 1 / 1;
	}

	/* Clear (×) button — top-right of the circle, stops all playing sounds */
	.stage-clear {
		position: absolute;
		top: 0;
		right: 0;
		z-index: 2;
		width: 38px;
		height: 38px;
		border: none;
		border-radius: 50%;
		background: #f0f0f0;
		color: #436f8e;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 1rem;
		line-height: 1;
		cursor: pointer;
		transition: background 0.2s ease, color 0.2s ease, transform 0.1s ease;
	}
	.stage-clear:hover { background: #436f8e; color: #fff; }
	.stage-clear:active { transform: scale(0.92); }

	/* Centre area: holds either the prompt (nothing playing) or the
	   "now playing" carousel of overlapping sound circles + paging arrows. */
	.circle-center {
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 0.3rem;
		max-width: 80%;
		z-index: 1;
	}

	/* Empty state → show the prompt, hide the carousel + arrows. */
	.circle-center.is-empty .stack-arrow,
	.circle-center.is-empty .playing-stack { display: none; }
	.circle-center:not(.is-empty) #centerText { display: none; }

	#centerText {
		font-size: 1.4rem;
		font-weight: 700;
		line-height: 1.25;
		color: #436f8e;
		text-align: center;
	}

	/* Paging arrows (shown only when more than 3 sounds are playing) */
	.stack-arrow {
		flex: 0 0 auto;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		padding: 0;
		border: none;
		background: none;
		color: #9aa7b0;
		font-size: 1.15rem;
		line-height: 1;
		cursor: pointer;
		transition: color 0.2s ease;
	}
	.stack-arrow:hover:not(:disabled) { color: #436f8e; }
	.stack-arrow:disabled { opacity: 0.3; cursor: default; }

	/* Carousel: up to 3 circles stacked as an overlapping deck — the selected
	   sound sits full at the front (right), the others peek out behind it to the
	   left. Extras (4th+) are paged in with the arrows. --vis (from JS) is how
	   many circles are stacked (1–3); --peek is how far each one peeks out. */
	.playing-stack {
		--orb: 95px;
		--peek: 50px;
		--vis: 1;
		position: relative;
		flex: 0 0 auto;
		height: var(--orb);
		width: calc(var(--orb) + var(--peek) * (var(--vis) - 1));
	}

	/* A playing sound circle. --pos is its depth in the deck (0 = backmost/left,
	   highest = front/right), so it both positions and layers the card. */
	.playing-orb {
		position: absolute;
		top: 0;
		left: calc(var(--pos) * var(--peek));
		width: var(--orb);
		height: var(--orb);
		display: flex;
		align-items: center;
		justify-content: center;
		border: 2px solid #fff;
		border-radius: 50%;
		background: #b6cdde;
		color: #fff;
		font-size: calc(var(--orb) * 0.42);
		cursor: pointer;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
		transition: left 0.25s ease, background 0.2s ease;
		z-index: calc(var(--pos) + 1);
	}

	/* Selected sound — brought to the front, filled brand blue. */
	.playing-orb.selected {
		background: #436f8e;
		z-index: 50;
		box-shadow: 0 2px 8px rgba(67, 111, 142, 0.45);
	}

	/* Sound orb — a round icon button positioned on the ring */
	.sound-orb {
		position: absolute;
		transform: translate(-50%, -50%);
		width: clamp(48px, 13.5%, 74px);
		aspect-ratio: 1 / 1;
		padding: 0;
		border: 2.5px solid var(--cat, #436f8e);
		border-radius: 50%;
		background: #fff;
		color: var(--cat, #436f8e);
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
		animation: orbIn 0.35s ease-out backwards;
		-webkit-tap-highlight-color: transparent;
	}

	.sound-orb .orb-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: clamp(1.1rem, 5.5%, 1.7rem);
		line-height: 1;
	}

	/* Accessible label, hidden visually (orbs are icon-only like the mockup) */
	.sound-orb .orb-label {
		position: absolute;
		width: 1px; height: 1px;
		padding: 0; margin: -1px;
		overflow: hidden;
		clip: rect(0, 0, 0, 0);
		white-space: nowrap;
		border: 0;
	}

	.sound-orb:hover {
		transform: translate(-50%, -50%) scale(1.08);
		box-shadow: 0 6px 18px rgba(var(--cat-rgb), 0.25);
	}

	/* Playing */
	.sound-orb.active {
		background: var(--cat, #436f8e);
		color: #fff;
	}

	/* Selected (the orb the bottom slider controls) */
	.sound-orb.selected {
		box-shadow: 0 0 0 4px rgba(var(--cat-rgb), 0.25);
	}

	.sound-orb.active.selected {
		box-shadow: 0 0 0 4px rgba(var(--cat-rgb), 0.35), 0 6px 18px rgba(var(--cat-rgb), 0.3);
	}

	/* Pulse ring while a sound plays */
	.sound-orb.active {
		animation: soundPulse 1.6s ease-out infinite;
	}

	@media (prefers-reduced-motion: reduce) {
		.sound-orb.active { animation: none; }
	}

	/* Loading spinner on an orb while its audio buffers */
	.sound-orb.loading { animation: none !important; }
	.sound-orb.loading .orb-icon i { display: none; }
	.sound-orb.loading .orb-icon::after {
		content: "";
		width: 55%;
		aspect-ratio: 1 / 1;
		border: 2.5px solid currentColor;
		border-top-color: transparent;
		border-radius: 50%;
		animation: iconSpin 0.7s linear infinite;
	}

	@keyframes orbIn {
		from { opacity: 0; transform: translate(-50%, -50%) scale(0.6); }
		to   { opacity: 1; transform: translate(-50%, -50%) scale(1); }
	}

	/* Bottom volume bar — controls the selected sound.
	   Stacked: the −/+ buttons sit above the slider (− top-left, + top-right),
	   with the slider spanning the full width below them. */
	.stage-volume {
		display: flex;
		flex-direction: column;
		gap: 0.55rem;
		width: 100%;
		max-width: 300px;
		margin: 0 auto;
	}

	.stage-volume-top {
		display: flex;
		align-items: center;
		justify-content: space-between;
	}

	.stage-volume.is-empty {
		opacity: 0.5;
	}

	/* Stepper buttons: no background — just the +/- glyph in brand blue. */
	.vol-btn {
		flex: 0 0 auto;
		width: 40px;
		height: 29px;
		padding: 0;
		border: none;
		background: none;
		color: #436f8e;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		font-size: 29px;
		font-weight: 700;
		line-height: 1;
		cursor: pointer;
		transition: transform 0.1s ease, opacity 0.2s ease;
	}

	.vol-btn:active { transform: scale(0.92); }
	.vol-btn:hover { opacity: 0.7; }

	/* No focus ring/border when the button is clicked (selected). */
	.vol-btn:focus,
	.vol-btn:focus-visible { outline: none; box-shadow: none; }

	.stage-volume.is-empty .vol-btn { cursor: not-allowed; }

	/* Track: two-tone — the dark-blue fill (left of the thumb) is painted as a
	   gradient from JS; this light-blue is the unfilled remainder / fallback. */
	/* Input is as tall as the thumb so the 12px track can sit centred inside it
	   and the thumb has room to overhang; the track itself is drawn by the
	   ::track pseudo-elements below. */
	.stage-slider {
		-webkit-appearance: none;
		appearance: none;
		width: 100%;
		min-width: 0;
		height: 39px;
		border: none;
		background: transparent;
		outline: none;
		cursor: pointer;
	}

	.stage-slider:disabled { cursor: not-allowed; }

	/* WebKit/Blink: track carries the two-tone fill (via --fill), thumb centred */
	.stage-slider::-webkit-slider-runnable-track {
		height: 12px;
		border-radius: 3px;
		background: linear-gradient(to right, #436f8e var(--fill, 0%), #a3c1d4 var(--fill, 0%));
	}
	.stage-slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 39px;
		height: 39px;
		border-radius: 50%;
		background: #fff;
		border: 3px solid #436f8e;
		cursor: pointer;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25);
		/* Centre the 39px thumb on the 12px track: (12 - 39) / 2. */
		margin-top: -13.5px;
	}

	/* Firefox: track + native progress fill + thumb (centred automatically) */
	.stage-slider::-moz-range-track {
		height: 12px;
		border-radius: 3px;
		background: #a3c1d4;
	}
	.stage-slider::-moz-range-progress {
		height: 12px;
		border-radius: 3px;
		background: #436f8e;
	}
	.stage-slider::-moz-range-thumb {
		width: 39px;
		height: 39px;
		border-radius: 50%;
		background: #fff;
		border: 3px solid #436f8e;
		cursor: pointer;
		box-shadow: 0 1px 4px rgba(0,0,0,0.25);
	}

	/* Category Headers */
	.category-header {
		margin-top: 2rem;
		margin-bottom: 1rem;
	}

	.category-header:first-child {
		margin-top: 0;
	}

	.category-header-content {
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}

	.category-header-icon {
		font-size: 1.25rem;
	}

	.category-header-title {
		font-size: 1.25rem;
		font-weight: 600;
		margin: 0;
		color: #1a1a1a;
	}

	.category-header-badge {
		font-size: 0.75rem;
		font-weight: 500;
		padding: 0.25rem 0.75rem;
		border-radius: 50px;
	}

	/* Category Header Colors (driven by the category tokens) */
	.category-header[class*="category-"] .category-header-icon { color: var(--cat); }
	.category-header[class*="category-"] .category-header-badge {
		background-color: var(--cat-bg);
		color: var(--cat);
	}
	.category-header[class*="category-"] .category-header-title {
		color: var(--cat);
	}

	/* Ensure grid items stretch equally */
	.row.g-4 > [class*="col-"] {
		display: flex;
	}

	/* Auto-fill grid: every card is at least 290px, fluid up to 1fr.
	   min(100%, 290px) lets columns shrink below 290px on very narrow
	   phones so they never overflow the viewport. */
	#soundsGrid.row {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(min(100%, 290px), 1fr));
		column-gap: 1.5rem;
		row-gap: 3px;
		margin: 0;
	}

	#soundsGrid > [class*="col-"]:not(.category-header) {
		display: flex;
		width: auto;
		max-width: none;
		flex: initial;
		padding: 0;
		margin: 0;
	}

	/* Category headers span the full width of the grid. The 5px vertical
	   margin adds to the 5px row gap above and below, so each category is
	   separated by 10px while card rows stay 5px apart. */
	#soundsGrid > .category-header {
		display: block;
		grid-column: 1 / -1;
		margin: 5px 0;
		padding: 0;
	}

	/* Responsive Adjustments */
	@media (max-width: 768px) {
		.tool-card {
			padding: 0.75rem 0.5rem 0.5rem 0.75rem;
		}

		.tool-icon {
			width: 40px;
			height: 40px;
			min-width: 40px;
			font-size: 1.25rem;
		}

		.tool-name {
			font-size: 0.9rem;
		}

		.tool-description {
			font-size: 0.8rem;
		}

		.category-header-title {
			font-size: 1.1rem;
		}

		.search-wrapper {
			width: 100%;
		}

		/* Stack search above the filter strip (1rem gap from the toolbar) */
		.toolbar {
			flex-direction: column;
			align-items: stretch;
			gap: 1rem;
		}

		/* Category tabs stay as left-aligned, wrapping chips on small screens */
		#categoryFilters {
			flex-wrap: wrap;
			justify-content: flex-start;
			width: 100%;
		}
	}

	/* Phones */
	@media (max-width: 575.98px) {
		.container-fluid {
			padding-left: 0.75rem;
			padding-right: 0.75rem;
		}

		.text-center.mb-5 {
			margin-bottom: 1.5rem !important;
		}

		.tool-card {
			padding: 0.65rem 0.425rem 0.425rem 0.65rem;
			gap: 0.75rem;
			min-height: 0;
		}

		.btn-filter {
			font-size: 0.8rem;
			padding: 0.35rem 0.5rem;
		}

		.category-header {
			margin-top: 1.25rem;
		}

		/* Shrink the centre carousel circles so the deck fits on small phones */
		.playing-stack {
			--orb: 64px;
		}
	}

	/* No Results */
	#noResults i {
		display: block;
	}

	/* ===== Two-column layout: flexible left, fixed-width right =====
	   The left column flexes to fill the row; the right column is a fixed 340px.
	   min-width:0 on the left lets it shrink so the row never overflows the screen. */
	.noise-layout {
		display: flex;
		gap: 1.5rem;
	}
	.noise-left {
		flex: 1 1 auto;
		min-width: 0;
	}
	.noise-right {
		flex: 0 0 340px;
		width: 340px;
		max-width: 340px;
	}

	/* Shown only on mobile (see the slide-panel media query below). */
	.settings-fab,
	.settings-backdrop,
	.settings-close {
		display: none;
	}

	/* ===== Settings panel (right side) =====
	   Sticky on desktop, capped to the viewport height with its own scroll so a
	   tall panel never runs past the bottom of the screen. */
	.settings-panel {
		position: sticky;
		top: 2.3rem;
		width: 100%;
		max-height: calc(100vh - 3rem);
		overflow-y: auto;
		background: #fff;
		border: 2px solid #436f8e;
		border-radius: 10px;
		padding: 1.25rem;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
		display: flex;
		flex-direction: column;
		gap: 1.4rem;
	}

	.panel-section {
		border-bottom: 1px solid rgba(0, 0, 0, 0.08);
		padding-bottom: 1.1rem;
	}

	.panel-section:last-of-type {
		border-bottom: none;
		padding-bottom: 0;
	}

	/* Section heading — same treatment as the White Noise Generator preset titles. */
	.panel-section-title {
		font-weight: 600;
		font-size: 1.112em;
		color: #436f8e;
		margin-bottom: 0.45rem;
	}

	.panel-hint {
		font-size: 0.8rem;
		color: #888;
		margin: 0 0 0.75rem;
	}

	/* Panel buttons.
	   Scoped under .settings-panel and forced with !important so the active
	   WordPress theme's global `button { ... }` styles can't repaint them. */
	.settings-panel .panel-btn {
		background: #436f8e !important;
		color: #fff !important;
		border: none !important;
		border-radius: 10px;
		padding: 0.5rem 0.9rem;
		font-weight: 500;
		font-size: 0.875rem;
		line-height: 1.2;
		cursor: pointer;
		transition: background 0.2s ease;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 0.35rem;
		text-shadow: none;
		box-shadow: none;
	}

	.settings-panel .panel-btn:hover { background: #395d77 !important; }
	.settings-panel .panel-btn-ghost { background: #f0f0f0 !important; color: #555 !important; }
	.settings-panel .panel-btn-ghost:hover { background: #e2e2e2 !important; color: #333 !important; }
	.panel-btn-block { width: 100%; }

	/* Stop-all: taller than the other panel buttons. Inactive (dimmed) until a
	   sound is playing; turns red + pulses while playing. */
	.settings-panel #stopAll {
		background: #e2e2e2 !important;
		color: #000 !important;
		padding-top: 0.85rem;
		padding-bottom: 0.85rem;
		font-size: 0.95rem;
		opacity: 0.55;
		cursor: not-allowed;
		transition: background 0.2s ease, opacity 0.2s ease, color 0.2s ease;
	}
	.settings-panel #stopAll i { color: #000; font-size: 1.15rem; }

	.settings-panel #stopAll.is-playing {
		background: #e25c1b !important;
		color: #fff !important;
		opacity: 1;
		cursor: pointer;
	}
	.settings-panel #stopAll.is-playing i { color: #fff; }
	.settings-panel #stopAll.is-playing:hover { background: #c64e15 !important; }

	/* Square icon-only buttons (timer start/stop toggle + reset). */
	.settings-panel .panel-icon-btn {
		flex: 0 0 auto;
		width: 38px;
		padding: 0.5rem;
	}

	.settings-panel .panel-icon-btn i {
		font-size: 1.05rem;
		line-height: 1;
	}

	/* Timer.
	   Fixed height + centered text so the box stays the same size whether it
	   shows the small "Off" label or the larger running countdown. */
	.timer-display {
		display: flex;
		align-items: center;
		justify-content: center;
		min-height: 2.4rem;
		font-size: 2rem;
		line-height: 1.2;
		font-weight: 700;
		text-align: center;
		color: #436f8e;
		letter-spacing: 1px;
		margin-bottom: 0.75rem;
		font-variant-numeric: tabular-nums;
	}

	.timer-display:not(.active) {
		color: #c4c4c4;
		font-size: 1.25rem;
	}

	.timer-presets {
		margin-bottom: 0.75rem;
	}

	/* ===== Preset chip rows — ported from the White Noise Generator preset UI ===== */
	.settings-panel .preset-chip-row {
		--preset-chip-sep: 0.75rem;
		display: flex;
		flex-wrap: wrap;
		gap: 0.35rem var(--preset-chip-sep);
		align-items: center;
	}

	/* Dot after each chip, positioned in the gap so it stays out of the hover/active
	   background and never leaves a stray dot when the row wraps. */
	.settings-panel .preset-chip-row .actionlink:not(:last-child)::after {
		content: '•';
		position: absolute;
		left: calc(100% + 0.5 * var(--preset-chip-sep));
		top: 50%;
		transform: translate(-50%, -50%);
		line-height: 1;
		color: #436f8e;
		font-weight: 600;
		pointer-events: none;
		user-select: none;
	}

	/* Preset chips: brand orange, filling to solid orange when active. */
	.settings-panel span.actionlink {
		position: relative;
		margin: 0;
		padding: 0 3px;
		border-radius: 4px;
		background: transparent;
		color: #e25c1b;
		font: inherit;
		font-size: 0.875rem;
		font-weight: 400;
		text-decoration: none;
		cursor: pointer;
		line-height: 1.55;
		display: inline-block;
		transition: background-color 0.12s ease, color 0.12s ease;
		touch-action: manipulation;
		-webkit-tap-highlight-color: transparent;
	}

	.settings-panel span.actionlink:hover {
		font-weight: 600;
	}

	.settings-panel span.actionlink:focus-visible {
		outline: 2px solid #e25c1b;
		outline-offset: 2px;
	}

	.settings-panel span.actionlink.active,
	.settings-panel span.actionlink.is-active,
	.settings-panel span.actionlink[aria-pressed="true"] {
		background-color: #e25c1b;
		color: #fff;
		font-weight: 300;
	}

	.timer-custom { display: flex; gap: 0.4rem; }

	.settings-panel .timer-custom input {
		flex: 1;
		min-width: 0;
		background: #fff !important;
		color: #1a1a1a !important;
		border: 1px solid #dee2e6;
		border-radius: 8px;
		padding: 0.4rem 0.6rem;
		font-size: 0.85rem;
	}

	.settings-panel .timer-custom input::placeholder { color: #888; }
	.settings-panel .timer-custom input:focus { outline: none; border-color: #436f8e; }

	/* Mixes */
	.mix-save { display: flex; gap: 0.4rem; margin-bottom: 0.75rem; }

	.settings-panel .mix-save input {
		flex: 1;
		min-width: 0;
		background: #fff !important;
		color: #1a1a1a !important;
		border: 1px solid #dee2e6;
		border-radius: 8px;
		padding: 0.45rem 0.7rem;
		font-size: 0.85rem;
	}

	.settings-panel .mix-save input::placeholder { color: #888; }
	.settings-panel .mix-save input:focus { outline: none; border-color: #436f8e; }

	.mix-list {
		list-style: none;
		padding: 0;
		margin: 0;
		display: flex;
		flex-direction: column;
		gap: 0.4rem;
		max-height: 240px;
		overflow-y: auto;
	}

	.mix-item {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 0.5rem;
		background: #f8f9fa;
		border-radius: 8px;
		padding: 0.4rem 0.4rem 0.4rem 0.7rem;
	}

	.mix-item-name {
		font-size: 0.875rem;
		font-weight: 500;
		color: #333;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	.mix-item-actions { display: flex; gap: 0.25rem; flex-shrink: 0; }

	.mix-icon-btn {
		width: 30px;
		height: 30px;
		border: none;
		border-radius: 7px;
		background: #fff;
		color: #666;
		cursor: pointer;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s;
	}

	.mix-icon-btn[data-action="load"]:hover { background: #436f8e; color: #fff; }
	.mix-icon-btn[data-action="del"]:hover { background: #e25c1b; color: #fff; }
	.mix-icon-btn[data-action="stop"] { background: #436f8e; color: #fff; }
	.mix-icon-btn[data-action="stop"]:hover { background: #e25c1b; }

	.mix-item.is-playing { background: #eef3f7; }

	.mix-empty {
		font-size: 0.825rem;
		color: #aaa;
		text-align: center;
		margin: 0.5rem 0 0;
	}

	/* Share */
	.share-feedback {
		font-size: 0.8rem;
		color: #436f8e;
		text-align: center;
		margin-top: 0.6rem;
		min-height: 1rem;
		opacity: 0;
		transition: opacity 0.3s;
	}

	.share-feedback.show { opacity: 1; }

	/* One-tap prompt shown when a shared link's audio is blocked by the browser's
	   autoplay policy. A single tap anywhere (or on the pill) starts the mix. */
	.shared-mix-prompt {
		position: fixed;
		left: 50%;
		bottom: 1.5rem;
		transform: translateX(-50%);
		z-index: 1060;
		display: inline-flex;
		align-items: center;
		gap: 0.5rem;
		padding: 0.7rem 1.25rem;
		border: none;
		border-radius: 50px;
		background: #436f8e;
		color: #fff;
		font-size: 0.95rem;
		font-weight: 600;
		box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
		cursor: pointer;
		animation: sharedMixPromptIn 0.25s ease-out;
	}
	.shared-mix-prompt i { font-size: 1.2rem; line-height: 1; }
	.shared-mix-prompt:hover { background: #395d77; }
	@keyframes sharedMixPromptIn {
		from { opacity: 0; transform: translate(-50%, 10px); }
		to   { opacity: 1; transform: translate(-50%, 0); }
	}

	/* ===== Mobile: the right panel becomes an off-canvas slide-in panel,
	   opened by a floating settings button at the bottom-right. ===== */
	@media (max-width: 991.98px) {
		.noise-right {
			position: fixed;
			top: 0;
			right: 0;
			z-index: 1050;
			flex: none;
			width: min(360px, 88vw);
			max-width: none;
			height: 100%;
			overflow-y: auto;
			-webkit-overflow-scrolling: touch;
			background: #fff;
			box-shadow: -8px 0 30px rgba(0, 0, 0, 0.18);
			transform: translateX(100%);
			transition: transform 0.3s ease;
		}
		.noise-right.is-open {
			transform: translateX(0);
		}

		/* Inside the slide panel the card fills the surface (no floating border).
		   The fixed .noise-right container owns the scroll, so drop the desktop
		   sticky/viewport-height caps here. */
		.settings-panel {
			position: static;
			width: 100%;
			max-height: none;
			overflow: visible;
			min-height: 100%;
			border: none;
			border-radius: 0;
			box-shadow: none;
			padding: 1.1rem 1.25rem calc(1.25rem + env(safe-area-inset-bottom, 0px));
		}

		/* Dim backdrop behind the open panel. */
		.settings-backdrop {
			display: block;
			position: fixed;
			inset: 0;
			z-index: 1040;
			background: rgba(0, 0, 0, 0.45);
			opacity: 0;
			visibility: hidden;
			transition: opacity 0.3s ease, visibility 0.3s ease;
		}
		.settings-backdrop.is-open {
			opacity: 1;
			visibility: visible;
		}

		/* Floating settings button, bottom-right. */
		.settings-fab {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			position: fixed;
			right: 1rem;
			bottom: 1rem;
			z-index: 1035;
			width: 56px;
			height: 56px;
			border: none;
			border-radius: 50%;
			background: #436f8e;
			color: #fff;
			font-size: 1.45rem;
			box-shadow: 0 6px 18px rgba(0, 0, 0, 0.28);
			cursor: pointer;
			transition: background 0.2s ease, transform 0.15s ease;
		}
		.settings-fab:hover { background: #395d77; }
		.settings-fab:active { transform: scale(0.94); }
		.settings-fab.is-hidden { display: none; }

		/* Close (×) button inside the slide panel. */
		.settings-close {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			align-self: flex-end;
			width: 36px;
			height: 36px;
			margin-bottom: -0.2rem;
			border: none;
			border-radius: 8px;
			background: #f0f0f0;
			color: #555;
			font-size: 1rem;
			cursor: pointer;
			transition: background 0.2s ease;
		}
		.settings-close:hover { background: #e2e2e2; color: #333; }
	}
</style>

<div class="container-fluid">
	<div class="noise-layout">

		<!-- ============ LEFT SIDE: Soundscape (intro · categories · circle) ============ -->
		<?php
			// Intro heading + centre prompt. Both are ACF-overridable with a fallback
			// so the tool still reads correctly before the fields are filled in.
			$soundscape_intro = get_field('soundscape_intro');
			if ( ! $soundscape_intro ) { $soundscape_intro = 'Create your perfect relaxing soundscape with this simple tool'; }
			$choose_prompt = get_field('choose_sound_prompt');
			if ( ! $choose_prompt ) { $choose_prompt = 'Choose a sound to begin'; }
		?>
		<div class="noise-left">

			<!-- Layer 1: description -->
			<h2 class="soundscape-intro"><?php echo esc_html( $soundscape_intro ); ?></h2>

			<!-- Search (kept from the original tool) -->
			<div class="search-wrapper mb-4">
				<div class="input-group">
					<span class="input-group-text bg-white border-end-0" style="padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0rem; padding-bottom: 0rem;">
						<img class="img-fluid" src="<?=get_stylesheet_directory_uri();?>/assets/images/search-tools.svg" alt="">
					</span>
					<input type="text" class="form-control border-start-0 ps-0"
						   id="searchInput" placeholder="<?php the_field('search_sounds'); ?>">
				</div>
			</div>

			<!-- Layer 2: category tabs (generated from categoryMeta in JS) -->
			<div class="category-tabs" id="categoryFilters"></div>

			<!-- Layer 3: circular sound stage -->
			<div class="circle-stage" id="soundStage">
				<!-- Clear: stops every playing sound -->
				<button type="button" class="stage-clear" id="stageClear" aria-label="Clear sounds" title="Clear sounds">
					<i class="bi bi-x-lg"></i>
				</button>
				<div class="circle-center is-empty" id="circleCenter">
					<button type="button" class="stack-arrow stack-prev" id="stackPrev" aria-label="Previous sounds">
						<i class="bi bi-caret-left-fill"></i>
					</button>
					<div class="playing-stack" id="playingStack">
						<!-- Currently-playing sounds (carousel) inserted here -->
					</div>
					<button type="button" class="stack-arrow stack-next" id="stackNext" aria-label="More sounds">
						<i class="bi bi-caret-right-fill"></i>
					</button>
					<span id="centerText"><?php echo esc_html( $choose_prompt ); ?></span>
				</div>
				<!-- Sound orbs are inserted here -->
			</div>

			<!-- Volume bar for the selected sound -->
			<div class="stage-volume is-empty" id="stageVolume">
				<div class="stage-volume-top">
					<button type="button" class="vol-btn vol-down" id="volDown" aria-label="Lower volume">&minus;</button>
					<button type="button" class="vol-btn vol-up" id="volUp" aria-label="Raise volume">&plus;</button>
				</div>
				<input type="range" class="stage-slider" id="stageSlider" min="0" max="100" value="0" aria-label="Selected sound volume">
			</div>

			<!-- No Results Message -->
			<div class="text-center py-5 d-none" id="noResults">
				<i class="bi bi-search display-1 text-muted mb-3"></i>
				<h3 class="text-muted"><?php the_field('no_result_search_title'); ?></h3>
				<p class="text-muted"><?php the_field('no_results_search_message'); ?></p>
			</div>
		</div>

		<!-- ============ RIGHT SIDE: Settings panel ============ -->
		<div class="noise-right" id="noiseRight">
			<aside class="settings-panel">

				<!-- Close button (mobile slide panel only) -->
				<button type="button" class="settings-close" id="settingsClose" aria-label="Close settings">
					<i class="bi bi-x-lg"></i>
				</button>

				<!-- Timer -->
				<section class="panel-section">
					<div class="panel-section-title"><?php the_field('timer'); ?></div>
					<div class="timer-display" id="timerDisplay"><?php the_field('timer_off'); ?></div>
					<div class="timer-presets preset-chip-row" id="timerPresets" role="group" aria-label="Timer presets">
						<?php
						// Timer presets come from the ACF "timer_labels" repeater:
						// [{ label, value }]. Falls back to 15/30/45/60 minutes.
						$timer_labels = get_field('timer_labels');
						if ( empty( $timer_labels ) ) {
							$timer_labels = array(
								array( 'label' => '15m', 'value' => 15 ),
								array( 'label' => '30m', 'value' => 30 ),
								array( 'label' => '45m', 'value' => 45 ),
								array( 'label' => '60m', 'value' => 60 ),
							);
						}
						foreach ( $timer_labels as $preset ) : ?>
							<span class="actionlink" role="button" tabindex="0" data-min="<?php echo esc_attr( $preset['value'] ); ?>" aria-pressed="false"><?php echo esc_html( $preset['label'] ); ?></span>
						<?php endforeach; ?>
					</div>
					<div class="timer-custom">
						<input type="number" id="timerCustom" min="1" max="600" placeholder="<?php the_field('timer_input_placeholder'); ?>">
						<button type="button" class="panel-btn panel-icon-btn" id="timerStart" aria-label="Start timer" title="Start timer">
							<i class="bi bi-play-fill"></i>
						</button>
						<button type="button" class="panel-btn panel-btn-ghost panel-icon-btn" id="timerStop" aria-label="Reset timer" title="Reset timer">
							<i class="bi bi-arrow-counterclockwise"></i>
						</button>
					</div>
				</section>

				<!-- Stop all -->
				<section class="panel-section">
					<button type="button" class="panel-btn panel-btn-block panel-btn-ghost" id="stopAll">
						<i class="bi bi-stop-circle"></i> <?php the_field('stop_button'); ?>
					</button>
				</section>

				<!-- My Mixes (saved to localStorage) -->
				<section class="panel-section">
					<div class="panel-section-title"><?php the_field('mixes'); ?></div>
					<div class="mix-save">
						<input type="text" id="mixName" placeholder="<?php the_field('mixes_input_placeholder'); ?>" maxlength="40">
						<button type="button" class="panel-btn" id="mixSave"><?php the_field('save_button'); ?></button>
					</div>
					<ul class="mix-list" id="mixList"></ul>
					<p class="mix-empty" id="mixEmpty"><?php the_field('no_saved_mixes'); ?></p>
				</section>

				<!-- Share -->
				<section class="panel-section">
					<div class="panel-section-title"><?php the_field('share'); ?></div>
					<p class="panel-hint"><?php the_field('share_description'); ?></p>
					<button type="button" class="panel-btn panel-btn-block" id="shareBtn">
						<i class="bi bi-link-45deg"></i> <?php the_field('copy_button'); ?>
					</button>
					<div class="share-feedback" id="shareFeedback"></div>
				</section>

			</aside>
		</div>

	</div>	
	
	<br/><br/>
	<div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text"><?php the_field('get_easily_started_title'); ?></h3>
				</div>
			</div>
		</div>
		<div class="ct-row">
			<div class="new-webcam-desc">
				<ul>
					<?php

                        // check if the repeater field has rows of data
                        if (have_rows('get_easily_started_steps')):

                            // loop through the rows of data
                        while (have_rows('get_easily_started_steps')): the_row(); ?>
											<li>
												<span><?php the_sub_field('numbers'); ?></span>
												<div>
													<strong><?php the_sub_field('title'); ?></strong>
												</div>
											</li>
										<?php endwhile;
                                            else:
                                            endif;
                                        ?>
				</ul>
			</div>
		</div>
	</div>

	<div class="wid-sm-100 wid-xs-100">
		<div class="ct-row mar-bot-15 dis-flex">
			<img class="tve_image" alt="" style="width: 64px;" src="<?php the_field('red_icon'); ?>" width="64" height="64">
			<div class="webcam-1-text_">
				<div class="icon-text-1">
					<h3 class="ct-bold-text" style="color: rgb(226, 92, 27)"><?php the_field('trouble-shooting_title'); ?></h3>
				</div>
			</div>
		</div>

		<div class="trouble-shooting-2 dis-flex">
			<div class="width-33_3 wid-md-50 wid-xs-100">
				<div class="trouble-shooting-text-1 pd-1">
					<ul>
						<?php

                            // check if the repeater field has rows of data
                            if (have_rows('leftside_guide_list')):

                                // loop through the rows of data
                            while (have_rows('leftside_guide_list')): the_row(); ?>
												<li>
													<span class="fw-bold color-link">
														<?php the_sub_field('left_side_list_title'); ?>
													</span>
												</li>

											<?php endwhile;
                                                else:
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
			<?php
                $right_side_guide_list = get_field('rightside_guide_list');
            if ($right_side_guide_list) {?>
				<div class="width-33_3 wid-md-50  wid-xs-100">
					<div class="trouble-shooting-text-1 pd-1">
						<ul>
							<li>
								<span class="fw-bold">
									<?php echo $right_side_guide_list ?>
								</span>
							</li>
						</ul>
					</div>
				</div>
				<?php
                }?>
			<div class="width-33_3 md-hidden">
			</div>
		</div>
	</div>

	<div class="other-section">
			<div class="read-more-section">
				<div class="ct-row dis-flex">
					<div class="width-50 wid-xs-100">
						<div class="read-more-text-secction">
							<div class="read-more-title clearfix" >
								<h2><strong><?php the_field('more_about_title'); ?></strong></h2>
							</div>
							<?php

                                // check if the repeater field has rows of data
                                if (have_rows('test_content')):

                                    // loop through the rows of data
                                while (have_rows('test_content')): the_row(); ?>
													<div class="read-more-1">


														<div class="read-more-subtitle clearfix">
															<h3 class="mar-bot-20"><?php the_sub_field('heading'); ?></h3>
														</div>

														<div class="read-more-text">
															<p><?php the_sub_field('descp'); ?>
														</p>
													</div>
												</div>
											<?php endwhile;
                                                else:
                                                endif;
                                            ?>
					</div>
				</div>

				<div class="width-50">
					<div class="img-section pad-left-15">
						<img class="lazyload" src="<?php the_field('rightside_lazy_gif'); ?>" data-src="<?php the_field('rightside_image'); ?>"/>
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

<!-- Mobile slide-panel controls (hidden on desktop via CSS) -->
<div class="settings-backdrop" id="settingsBackdrop"></div>
<button type="button" class="settings-fab" id="settingsFab" aria-label="Open settings" aria-expanded="false">
	<i class="bi bi-gear-fill"></i>
</button>

<script>
	(function () {
		// Base URL for every sound file; entries below store base + filename.
		const base = '<?php echo get_stylesheet_directory_uri();?>/assets/audio/noise-sounds/';

		// Fallback sound library, used when the "sounds_library" field is empty.
		// Each entry: { title, desc, icon, file, category }
		const DEFAULT_SOUNDS = [
			// ---- RAIN & STORMS ----
			{ title: "Rain",              desc: "Steady rainfall to help you relax and focus",   icon: "bi-cloud-rain",           file: base + "Rain.mp3",                 category: "rain" },
			{ title: "Thunder",           desc: "Distant rolling thunder for a stormy mood",      icon: "bi-cloud-lightning-rain", file: base + "Thunder.mp3",              category: "rain" },
			{ title: "Rain on tin roof",  desc: "Rain pattering on a metal roof",                 icon: "bi-cloud-rain-heavy",     file: base + "Rain-on-TinRoof.mp3",      category: "rain" },
			{ title: "Rain on trees",     desc: "Raindrops falling through the leaves",           icon: "bi-cloud-drizzle",        file: base + "Rain-on-Trees.mp3",        category: "rain" },
			{ title: "Rain on cabin",     desc: "Rain falling on a cozy wooden cabin",            icon: "bi-house",                file: base + "Rain-on-Cabin.mp3",        category: "rain" },

			// ---- WATER ----
			{ title: "Waves",             desc: "Gentle ocean waves rolling onto the shore",      icon: "bi-water",                file: base + "Waves.mp3",               category: "water" },
			{ title: "Stream",            desc: "A babbling stream flowing over rocks",           icon: "bi-tsunami",              file: base + "Stream.mp3",              category: "water" },
			{ title: "Waterfall",         desc: "A powerful waterfall cascading down",            icon: "bi-water",                file: base + "Waterfall.mp3",           category: "water" },
			{ title: "Water rippling",    desc: "Soft ripples across calm water",                 icon: "bi-droplet",              file: base + "Water-Rippling.mp3",      category: "water" },
			{ title: "Underwater bubbles", desc: "Gentle bubbles drifting underwater",            icon: "bi-droplet-half",         file: base + "Underwater-Bubbles.mp3",  category: "water" },
			{ title: "Bottle bubbles",    desc: "Soft bubbles from a submerged bottle",           icon: "bi-droplet-fill",         file: base + "Bottle-Bubbles.mp3",      category: "water" },

			// ---- NATURE & WILDLIFE ----
			{ title: "Wind",              desc: "Soft wind blowing through open space",           icon: "bi-wind",                 file: base + "Wind.mp3",                category: "nature" },
			{ title: "Fire",              desc: "Warm crackling campfire sounds",                 icon: "bi-fire",                 file: base + "Fire.mp3",                category: "nature" },
			{ title: "Fire crackling",    desc: "Crackling flames of an open fire",               icon: "bi-fire",                 file: base + "Fire-Crackling.mp3",      category: "nature" },
			{ title: "Bamboo rustling",   desc: "Bamboo leaves rustling in the breeze",           icon: "bi-tree",                 file: base + "Bamboo-Rustling.mp3",     category: "nature" },
			{ title: "Birds",             desc: "Cheerful birds singing in the morning",          icon: "bi-feather",              file: base + "Birds.mp3",               category: "nature" },
			{ title: "Crickets",          desc: "Calming crickets chirping through the night",    icon: "bi-bug",                  file: base + "Crickets.mp3",            category: "nature" },
			{ title: "Chirping birds",    desc: "Birds chirping in a peaceful forest",            icon: "bi-feather",              file: base + "Chirping-Birds.mp3",      category: "nature" },
			{ title: "Cicadas",           desc: "Buzzing cicadas on a warm summer day",           icon: "bi-bug-fill",             file: base + "Cicadas.mp3",             category: "nature" },
			{ title: "Frogs",             desc: "Frogs croaking by a quiet pond",                 icon: "bi-bug-fill",             file: base + "Frogs.mp3",               category: "nature" },
			{ title: "Night crickets & frogs", desc: "Crickets and frogs on a calm night",       icon: "bi-moon-stars",           file: base + "Night-Crickets-Frogs.mp3", category: "nature" },

			// ---- WHITE NOISE & FANS ----
			{ title: "White noise",       desc: "Even white noise to mask distractions",          icon: "bi-volume-up",            file: base + "White-Noise.ogg",         category: "noise" },
			{ title: "Brown noise",       desc: "Deep brown noise for intense focus",             icon: "bi-volume-down",          file: base + "Brown-Noise.ogg",         category: "noise" },
			{ title: "Pink noise",        desc: "Balanced pink noise to aid sleep",               icon: "bi-volume-up",            file: base + "Pink-Noise.ogg",          category: "noise" },
			{ title: "Fan on high",       desc: "A strong fan running on high speed",             icon: "bi-fan",                  file: base + "Fan-on-High.mp3",         category: "noise" },
			{ title: "Fan on low",        desc: "A gentle fan running on low speed",              icon: "bi-fan",                  file: base + "Fan-on-Low.mp3",          category: "noise" },
			{ title: "Air conditioning",  desc: "Steady hum of an air conditioner",               icon: "bi-snow",                 file: base + "Air-Conditioning.mp3",    category: "noise" },

			// ---- FOCUS & AMBIENCE ----
			{ title: "Coffee shop",       desc: "Cozy background chatter of a busy cafe",         icon: "bi-cup-hot",              file: base + "Coffee-Shop.mp3",         category: "focus" },
			{ title: "City",              desc: "Busy city ambience and distant traffic",         icon: "bi-buildings",            file: base + "City.mp3",                category: "focus" },
			{ title: "Record player",     desc: "Warm vinyl crackle of a record player",          icon: "bi-vinyl",                file: base + "Record-Player.mp3",       category: "focus" },
			{ title: "Typing",            desc: "Rhythmic keyboard typing to keep you in flow",   icon: "bi-keyboard",             file: base + "Typing-Sound.mp3",        category: "focus" },
			{ title: "Writing",           desc: "A pen scratching across paper",                  icon: "bi-pencil",               file: base + "Writing-Sound.mp3",       category: "focus" },
			{ title: "Soft piano",        desc: "Gentle piano melodies to help you unwind",       icon: "bi-music-note-beamed",    file: base + "Soft-Piano.mp3",          category: "focus" },
			{ title: "Singing bowl",      desc: "Resonant singing bowl tones for meditation",     icon: "bi-soundwave",            file: base + "Singing-Bowl.mp3",        category: "focus" },
			{ title: "Metal chimes",      desc: "Soft metal wind chimes ringing gently",          icon: "bi-bell",                 file: base + "Metal-Chimes.mp3",        category: "focus" },
			{ title: "Wooden fish",       desc: "Steady wooden fish taps for deep focus",         icon: "bi-record-circle",        file: base + "Wooden-Fish.mp3",         category: "focus" },
		];

		// Sounds come from the ACF "sounds_library" field:
		// [{ title, description, icon, file_name, category_key }]. Falls back to DEFAULT_SOUNDS.
		let soundsLibrary = <?php echo json_encode(get_field('sounds_library')); ?>;
		const sounds = (Array.isArray(soundsLibrary) && soundsLibrary.length)
			? soundsLibrary.map(s => ({
				title:    s.title,
				desc:     s.description,
				icon:     s.icon,
				file:     base + s.file_name,
				category: s.category_key
			}))
			: DEFAULT_SOUNDS;

		// Stable key per sound, derived from its filename (no path/extension).
		// Used to encode mixes for localStorage and share links so they survive
		// re-ordering of the library.
		const soundKey = (s) => s.file.split('/').pop().replace(/\.[^.]+$/, '').toLowerCase();

		// Category labels come from the ACF "category_labels" field: [{ key, label, icon }].
		// Include an entry with key "all" for the "All Sounds" filter button.
		// The array order defines the order of the filter buttons and category sections.
		let categoryLabels = <?php echo json_encode(get_field('category_labels')); ?>;
		if (!Array.isArray(categoryLabels) || categoryLabels.length === 0) {
			categoryLabels = [
				{ key: "all",    label: "All Sounds",       icon: "bi-grid" },
				{ key: "rain",   label: "Rain & Storms",    icon: "bi-cloud-rain" },
				{ key: "focus",  label: "Focus & Ambience", icon: "bi-headphones" },
				{ key: "water",  label: "Water",            icon: "bi-water" },
				{ key: "nature", label: "Nature",           icon: "bi-tree" },
				{ key: "noise",  label: "White Noise",      icon: "bi-volume-up" }
			];
		}

		// Lookup ({ key: { label, icon } }) for every label, including "all".
		const categoryMeta = {};
		categoryLabels.forEach(c => { categoryMeta[c.key] = { label: c.label, icon: c.icon }; });
		// Order of the real category sections — excludes the "all" filter.
		const categoryOrder = categoryLabels.map(c => c.key).filter(k => k !== 'all');

		// Audio objects keyed by index, created lazily.
		const players = {};

		var a = function(){};

		a.main = function() {
			// DOM Elements
			a.searchInput = window.document.getElementById('searchInput');
			a.soundStage = window.document.getElementById('soundStage');
			a.categoryFilters = window.document.getElementById('categoryFilters');
			a.noResults = window.document.getElementById('noResults');

			// Circular-stage controls
			const stageSliderEl = document.getElementById('stageSlider');
			const stageVolumeEl = document.getElementById('stageVolume');
			const volDownEl     = document.getElementById('volDown');
			const volUpEl       = document.getElementById('volUp');
			const stageClearEl  = document.getElementById('stageClear');
			const centerTextEl  = document.getElementById('centerText');
			const CHOOSE_PROMPT = centerTextEl ? centerTextEl.textContent : '';

			// Centre "now playing" carousel
			const circleCenterEl = document.getElementById('circleCenter');
			const playingStackEl = document.getElementById('playingStack');
			const stackPrevEl    = document.getElementById('stackPrev');
			const stackNextEl    = document.getElementById('stackNext');

			// Settings-panel elements
			const timerDisplayEl = document.getElementById('timerDisplay');
			const timerPresetsEl = document.getElementById('timerPresets');
			const timerCustomEl  = document.getElementById('timerCustom');
			const timerStartEl   = document.getElementById('timerStart');
			const timerStopEl    = document.getElementById('timerStop');
			const mixNameEl      = document.getElementById('mixName');
			const mixSaveEl      = document.getElementById('mixSave');
			const mixListEl      = document.getElementById('mixList');
			const mixEmptyEl     = document.getElementById('mixEmpty');
			const shareBtnEl     = document.getElementById('shareBtn');
			const shareFeedbackEl = document.getElementById('shareFeedback');
			const stopAllEl      = document.getElementById('stopAll');

			// State
			// Default to the first real category so the circle shows one group at a
			// time (like the mockup), with the "All" tab still available.
			let activeCategory = categoryOrder[0] || 'all';
			let searchQuery = '';
			// Index of the sound the bottom volume bar controls (-1 = none).
			let selectedIndex = -1;
			// Remembers each sound's last non-zero volume so re-tapping restarts it
			// at the level it was last played, not a fixed default.
			const lastVolume = {};
			// Centre carousel: how many playing sounds are scrolled off the left, and
			// a signature of the playing set so we only rebuild when it changes.
			let stackOffset = 0;
			let lastStackSig = '';
			const STACK_WINDOW = 3;

			function getPlayer(index, file) {
				if (!players[index]) {
					const audio = new Audio(encodeURI(file));
					audio.loop = true;
					audio.volume = 0;
					players[index] = audio;
				}
				return players[index];
			}

			// Find the orb element for a sound index in the current stage (may be null
			// when the sound's category isn't the one on screen).
			function orbFor(index) {
				return a.soundStage.querySelector('.sound-orb[data-index="' + index + '"]');
			}

			function setOrbLoading(orb, isLoading) {
				if (orb) orb.classList.toggle('loading', isLoading);
			}

			// Set a sound's volume by index (0-100). The orb is optional: when a
			// sound isn't in the on-screen category (e.g. while applying a saved mix
			// or a shared link) there is no orb, but the audio still plays.
			function setVolume(index, value) {
				index = Number(index);
				const sound = sounds[index];
				if (!sound) return;
				const audio = getPlayer(index, sound.file);
				const vol = Math.max(0, Math.min(100, value)) / 100;
				audio.volume = vol;
				if (vol > 0) lastVolume[index] = Math.round(vol * 100);

				const orb = orbFor(index);

				if (vol > 0) {
					if (audio.paused) {
						audio.currentTime = 0;   // replay from the beginning
						if (orb) {
							// Show a spinner on the orb until the sound actually starts.
							setOrbLoading(orb, true);
							const stopLoading = () => setOrbLoading(orb, false);
							audio.addEventListener('playing', stopLoading, { once: true });
							audio.play().then(stopLoading).catch(stopLoading);
						} else {
							audio.play().catch(() => {});
						}
					}
					if (orb) orb.classList.add('active');
				} else {
					audio.pause();
					if (orb) {
						setOrbLoading(orb, false);
						orb.classList.remove('active');
					}
				}

				// Keep the bottom volume bar in sync when it controls this sound.
				if (index === selectedIndex) updateStageVolume();

				updateStopAllState();
				renderPlayingStack(true);
			}

			// Point the volume bar's accent colour at a category.
			function setStageCategory(category) {
				categoryOrder.forEach(c => stageVolumeEl.classList.remove('category-' + c));
				if (category) stageVolumeEl.classList.add('category-' + category);
			}

			// Paint the WebKit/Blink track's two-tone fill via the --fill custom
			// property (read by ::-webkit-slider-runnable-track). Firefox uses
			// ::-moz-range-progress instead, so this is a no-op there.
			function paintStageSlider(val) {
				const pct = Math.max(0, Math.min(100, val));
				stageSliderEl.style.setProperty('--fill', pct + '%');
			}

			// Enable/disable the whole volume bar (no sound selected = disabled).
			function setStageEnabled(enabled) {
				stageSliderEl.disabled = !enabled;
				volDownEl.disabled = !enabled;
				volUpEl.disabled = !enabled;
			}

			// Reflect the selected sound in the bottom volume bar.
			function updateStageVolume() {
				if (selectedIndex < 0 || !sounds[selectedIndex]) {
					stageVolumeEl.classList.add('is-empty');
					setStageEnabled(false);
					setStageCategory(null);
					stageSliderEl.value = 0;
					paintStageSlider(0);
					return;
				}
				const sound = sounds[selectedIndex];
				const vol = players[selectedIndex] ? Math.round(players[selectedIndex].volume * 100) : 0;
				stageVolumeEl.classList.remove('is-empty');
				setStageEnabled(true);
				setStageCategory(sound.category);
				stageSliderEl.value = vol;
				paintStageSlider(vol);
			}

			/* =====================================================================
			   Centre "now playing" carousel — the playing sounds shown as an
			   overlapping stack of circles, the selected one on top. When more than
			   STACK_WINDOW are playing, paging arrows let you scroll through them.
			   ===================================================================== */
			function getPlayingIndices() {
				const out = [];
				for (let i = 0; i < sounds.length; i++) {
					if (players[i] && players[i].volume > 0) out.push(i);
				}
				return out;
			}

			// Keep the paging offset within range; returns the max offset.
			function clampStackOffset(n) {
				const maxOffset = Math.max(0, n - STACK_WINDOW);
				if (stackOffset > maxOffset) stackOffset = maxOffset;
				if (stackOffset < 0) stackOffset = 0;
				return maxOffset;
			}

			// Scroll the window so the selected sound stays visible.
			function snapToSelected(playing) {
				const pos = playing.indexOf(selectedIndex);
				if (pos < 0) return;
				if (pos < stackOffset) stackOffset = pos;
				else if (pos > stackOffset + STACK_WINDOW - 1) stackOffset = pos - STACK_WINDOW + 1;
			}

			// Refresh the paging arrows (shown only when more than STACK_WINDOW play).
			function applyArrows(n) {
				const maxOffset = clampStackOffset(n);
				const showArrows = n > STACK_WINDOW;
				stackPrevEl.style.display = showArrows ? '' : 'none';
				stackNextEl.style.display = showArrows ? '' : 'none';
				stackPrevEl.disabled = stackOffset <= 0;
				stackNextEl.disabled = stackOffset >= maxOffset;
			}

			// Build / refresh the centre deck. `snap` keeps the selected sound in the
			// visible window (used on play/select); paging passes snap=false so the
			// user can scroll past the selected one.
			function renderPlayingStack(snap) {
				const playing = getPlayingIndices();

				if (playing.length === 0) {
					lastStackSig = '';
					stackOffset = 0;
					playingStackEl.innerHTML = '';
					circleCenterEl.classList.add('is-empty');
					return;
				}
				circleCenterEl.classList.remove('is-empty');

				clampStackOffset(playing.length);
				if (snap) snapToSelected(playing);
				clampStackOffset(playing.length);

				const vis = Math.min(playing.length, STACK_WINDOW);
				const windowArr = playing.slice(stackOffset, stackOffset + vis);

				applyArrows(playing.length);

				// Rebuild only when the visible window or the selection changes.
				const sig = windowArr.join(',') + '|' + selectedIndex;
				if (sig === lastStackSig) return;
				lastStackSig = sig;

				// Keep each card in its playing-order position (no reordering). The
				// selected card simply rises to the top via its z-index (CSS), so
				// clicking an icon never moves the circles around.
				playingStackEl.style.setProperty('--vis', vis);
				playingStackEl.innerHTML = windowArr.map((idx, depth) => {
					const sound = sounds[idx];
					const sel = idx === selectedIndex ? ' selected' : '';
					return '<button type="button" class="playing-orb' + sel + '" data-index="' + idx +
						'" style="--pos:' + depth + '" title="' + escapeHtml(sound.title) +
						'" aria-label="' + escapeHtml(sound.title) + '"><i class="bi ' + sound.icon + '"></i></button>';
				}).join('');
			}

			// Make a sound the one the volume bar controls.
			function selectSound(index) {
				selectedIndex = index;
				a.soundStage.querySelectorAll('.sound-orb.selected').forEach(o => o.classList.remove('selected'));
				const orb = orbFor(index);
				if (orb) orb.classList.add('selected');
				updateStageVolume();
				renderPlayingStack(true);
			}

			// Tap an orb: start a stopped sound, retarget the bar to an already
			// playing one, or stop the currently selected+playing one.
			function activateOrb(index) {
				const playing = players[index] && players[index].volume > 0;
				if (playing && selectedIndex !== index) {
					selectSound(index);                       // just retarget the volume bar
				} else if (playing) {
					setVolume(index, 0);                      // selected + playing -> stop
					selectSound(index);                       // stay selected (bar at 0)
				} else {
					selectSound(index);                       // stopped -> start it
					setVolume(index, lastVolume[index] || 50);
				}
			}

			// Animate the stop-all button while any sound is playing.
			function updateStopAllState() {
				if (!stopAllEl) return;
				const anyPlaying = sounds.some((s, i) => players[i] && players[i].volume > 0);
				stopAllEl.classList.toggle('is-playing', anyPlaying);
			}

			// Place `count` items evenly on a ring at fraction `frac` of the ring
			// radius (1 = the full --ring-r), starting at `startDeg` (-90 = top).
			// Returns trig multipliers {mx, my}; the actual radius (in px) is applied
			// in CSS via the --ring-r variable so the ring stays responsive.
			function placeRing(count, frac, startDeg) {
				const out = [];
				const step = 360 / count;
				for (let i = 0; i < count; i++) {
					const ang = (startDeg + i * step) * Math.PI / 180;
					out.push({ mx: frac * Math.cos(ang), my: frac * Math.sin(ang) });
				}
				return out;
			}

			// Distribute n orbs across one or more concentric rings. Small groups use
			// a single ring (centre stays free for the prompt); larger groups (e.g.
			// the "All" tab) fill an outer then inner ring, and only use the small
			// inner ring when they truly overflow.
			function ringLayout(n) {
				if (n <= 0) return [];
				if (n <= 12) return placeRing(n, 1, -90);

				const rings = [ { frac: 1, cap: 19 }, { frac: 0.62, cap: 13 }, { frac: 0.3, cap: 6 } ];
				let positions = [];
				let remaining = n;
				rings.forEach((ring, ri) => {
					if (remaining <= 0) return;
					const count = Math.min(ring.cap, remaining);
					// Offset each inner ring slightly so orbs don't line up radially.
					positions = positions.concat(placeRing(count, ring.frac, -90 + ri * 14));
					remaining -= count;
				});
				return positions;
			}

			// Build one sound orb element.
			function createOrb(sound, index, pos, order) {
				const orb = document.createElement('button');
				orb.type = 'button';
				orb.className = 'sound-orb category-' + sound.category;
				orb.dataset.index = index;
				// Position from the centre using the px ring radius (--ring-r).
				orb.style.left = 'calc(50% + ' + pos.mx.toFixed(4) + ' * var(--ring-r))';
				orb.style.top  = 'calc(50% + ' + pos.my.toFixed(4) + ' * var(--ring-r))';
				orb.style.animationDelay = (order * 0.03) + 's';
				orb.title = sound.title;
				orb.setAttribute('aria-label', sound.title);
				orb.innerHTML =
					'<span class="orb-icon"><i class="bi ' + sound.icon + '"></i></span>' +
					'<span class="orb-label">' + escapeHtml(sound.title) + '</span>';
				if (players[index] && players[index].volume > 0) orb.classList.add('active');
				if (index === selectedIndex) orb.classList.add('selected');
				return orb;
			}

			// Create Filter Button HTML
			function createFilterButton(category, meta, isActive) {
				return `
					<button class="btn btn-filter${isActive ? ' active' : ''} mx-2 my-1 p-2" data-category="${category}">
						<i class="bi ${meta.icon} tab-icon"></i>
						${meta.label}
					</button>
				`;
			}

			// Render the filter strip entirely from categoryMeta, including the
			// "all" entry. The button whose key matches the initial activeCategory
			// ("all") starts active.
			function renderFilters() {
				let html = '';
				Object.keys(categoryMeta).forEach(category => {
					html += createFilterButton(category, categoryMeta[category], category === activeCategory);
				});
				a.categoryFilters.innerHTML = html;
			}

			// Filter sounds for the current view: a search query searches across every
			// category; otherwise the active category (or all) is shown.
			function getFilteredSounds() {
				const q = searchQuery.trim().toLowerCase();
				return sounds
					.map((sound, index) => ({ sound, index }))
					.filter(({ sound }) => {
						if (q) {
							return sound.title.toLowerCase().includes(q) ||
								   sound.desc.toLowerCase().includes(q);
						}
						return activeCategory === 'all' || sound.category === activeCategory;
					});
			}

			// Render the sound orbs around the circular stage.
			function renderSounds() {
				// Remove the previous orbs (the centre label is a permanent child).
				a.soundStage.querySelectorAll('.sound-orb').forEach(o => o.remove());

				const filtered = getFilteredSounds();

				if (filtered.length === 0) {
					a.noResults.classList.remove('d-none');
					updateStageVolume();
					renderPlayingStack(true);
					return;
				}
				a.noResults.classList.add('d-none');

				const positions = ringLayout(filtered.length);
				const frag = document.createDocumentFragment();
				filtered.forEach((item, i) => {
					frag.appendChild(createOrb(item.sound, item.index, positions[i], i));
				});
				a.soundStage.appendChild(frag);

				updateStageVolume();
				renderPlayingStack(true);
			}

			// Tap an orb → select / toggle the sound.
			a.soundStage.addEventListener('click', (e) => {
				const orb = e.target.closest('.sound-orb');
				if (!orb) return;
				activateOrb(Number(orb.dataset.index));
			});

			// Bottom volume bar → selected sound's volume.
			stageSliderEl.addEventListener('input', (e) => {
				if (selectedIndex < 0) return;
				setVolume(selectedIndex, Number(e.target.value));
			});

			function stepVolume(delta) {
				if (selectedIndex < 0) return;
				const cur = players[selectedIndex] ? Math.round(players[selectedIndex].volume * 100) : 0;
				setVolume(selectedIndex, Math.max(0, Math.min(100, cur + delta)));
			}
			volDownEl.addEventListener('click', () => stepVolume(-10));
			volUpEl.addEventListener('click', () => stepVolume(10));

			// Clear (×) → stop every playing sound and reset the selection.
			stageClearEl.addEventListener('click', () => {
				applyMix({});            // silence + pause every sound
				selectedIndex = -1;
				activeMixIndex = -1;     // drop any loaded-mix highlight
				renderSounds();          // refresh orb states + centre prompt
				renderMixes();
			});

			// Tap a circle in the centre carousel → make it the selected sound.
			playingStackEl.addEventListener('click', (e) => {
				const orb = e.target.closest('.playing-orb');
				if (!orb) return;
				selectSound(Number(orb.dataset.index));
			});

			// Paging arrows scroll the visible window of playing sounds (no snap,
			// so you can scroll past the selected one).
			stackPrevEl.addEventListener('click', () => {
				stackOffset--;
				renderPlayingStack(false);
			});
			stackNextEl.addEventListener('click', () => {
				stackOffset++;
				renderPlayingStack(false);
			});

			// Event Listeners
			a.searchInput.addEventListener('input', (e) => {
				searchQuery = e.target.value;
				renderSounds();
			});

			a.categoryFilters.addEventListener('click', (e) => {
				const button = e.target.closest('.btn-filter');
				if (!button) return;

				// Update active state
				document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
				button.classList.add('active');

				// Choosing a category clears any active search so the group shows.
				if (searchQuery) {
					searchQuery = '';
					a.searchInput.value = '';
				}

				// Update category and render
				activeCategory = button.dataset.category;
				renderSounds();
			});

			/* =====================================================================
			   Current mix helpers (shared by Mixes + Share)
			   A "mix" is a map of { soundKey: volume(1-100) } for every playing sound.
			   ===================================================================== */
			function getCurrentMix() {
				const mix = {};
				sounds.forEach((sound, i) => {
					const vol = players[i] ? Math.round(players[i].volume * 100) : 0;
					if (vol > 0) mix[soundKey(sound)] = vol;
				});
				return mix;
			}

			function applyMix(mix) {
				mix = mix || {};
				sounds.forEach((sound, i) => {
					setVolume(i, mix[soundKey(sound)] || 0);
				});
			}

			function escapeHtml(str) {
				return String(str).replace(/[&<>"']/g, c => ({
					'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
				}[c]));
			}

			/* =====================================================================
			   Timer — count down, then fade every playing sound out and stop.
			   ===================================================================== */
			let timerEnd = 0, timerTick = null, timerPausedRemaining = 0;

			function formatTime(ms) {
				const total = Math.max(0, Math.ceil(ms / 1000));
				const m = Math.floor(total / 60);
				const s = total % 60;
				return m + ':' + String(s).padStart(2, '0');
			}

			function refreshTimerDisplay() {
				if (!timerEnd) {
					timerDisplayEl.textContent = '<?php the_field('timer_off'); ?>';
					timerDisplayEl.classList.remove('active');
					return;
				}
				const remaining = timerEnd - Date.now();
				if (remaining <= 0) {
					timerDisplayEl.textContent = '0:00';
					finishTimer();
					return;
				}
				timerDisplayEl.textContent = formatTime(remaining);
				timerDisplayEl.classList.add('active');
			}

			// Swap the start button between a play and pause icon to mirror whether
			// the timer is currently counting down.
			function updateTimerControls() {
				if (!timerStartEl) return;
				const running = !!timerTick;
				const icon = timerStartEl.querySelector('i');
				if (icon) icon.className = running ? 'bi bi-pause-fill' : 'bi bi-play-fill';
				const label = running ? 'Pause timer' : 'Start timer';
				timerStartEl.setAttribute('aria-label', label);
				timerStartEl.setAttribute('title', label);
			}

			function startTimer(minutes) {
				minutes = Number(minutes);
				if (!minutes || minutes <= 0) return;
				timerPausedRemaining = 0;
				timerEnd = Date.now() + minutes * 60000;
				if (timerTick) clearInterval(timerTick);
				timerTick = setInterval(refreshTimerDisplay, 500);
				refreshTimerDisplay();
				updateTimerControls();
			}

			// Pause the countdown, remembering how much time is left so it can resume.
			function pauseTimer() {
				if (!timerTick) return;
				timerPausedRemaining = Math.max(0, timerEnd - Date.now());
				clearInterval(timerTick);
				timerTick = null;
				timerEnd = 0;
				// Freeze the display at the remaining time instead of showing "Off".
				timerDisplayEl.textContent = formatTime(timerPausedRemaining);
				timerDisplayEl.classList.add('active');
				updateTimerControls();
			}

			// Resume a paused countdown from the remembered remaining time.
			function resumeTimer() {
				if (timerPausedRemaining <= 0) return;
				timerEnd = Date.now() + timerPausedRemaining;
				timerPausedRemaining = 0;
				if (timerTick) clearInterval(timerTick);
				timerTick = setInterval(refreshTimerDisplay, 500);
				refreshTimerDisplay();
				updateTimerControls();
			}

			function stopTimer() {
				if (timerTick) clearInterval(timerTick);
				timerTick = null;
				timerEnd = 0;
				timerPausedRemaining = 0;
				clearPresetSelection();
				refreshTimerDisplay();
				updateTimerControls();
			}

			// Gradually fade all playing sounds to silence, then pause them.
			function fadeOutAll() {
				const steps = 40, duration = 4000;
				const start = {};
				Object.keys(players).forEach(k => {
					if (players[k].volume > 0) start[k] = players[k].volume;
				});
				if (!Object.keys(start).length) return;
				let i = 0;
				const fade = setInterval(() => {
					i++;
					const factor = 1 - i / steps;
					Object.keys(start).forEach(k => {
						players[k].volume = Math.max(0, start[k] * factor);
					});
					if (i >= steps) {
						clearInterval(fade);
						Object.keys(start).forEach(k => setVolume(k, 0));
					}
				}, duration / steps);
			}

			function finishTimer() {
				if (timerTick) clearInterval(timerTick);
				timerTick = null;
				timerEnd = 0;
				timerPausedRemaining = 0;
				clearPresetSelection();
				updateTimerControls();
				fadeOutAll();
			}

			// Clear the active state from every preset chip.
			function clearPresetSelection() {
				timerPresetsEl.querySelectorAll('.actionlink').forEach(b => {
					b.classList.remove('active');
					b.setAttribute('aria-pressed', 'false');
				});
			}

			// Activate a preset chip and start its timer.
			function activatePreset(chip) {
				if (!chip) return;
				clearPresetSelection();
				chip.classList.add('active');
				chip.setAttribute('aria-pressed', 'true');
				timerCustomEl.value = '';
				startTimer(chip.dataset.min);
			}

			timerPresetsEl.addEventListener('click', (e) => {
				activatePreset(e.target.closest('.actionlink'));
			});

			// The chips are <span role="button">, so wire up keyboard activation.
			timerPresetsEl.addEventListener('keydown', (e) => {
				if (e.key !== 'Enter' && e.key !== ' ' && e.key !== 'Spacebar') return;
				const chip = e.target.closest('.actionlink');
				if (!chip) return;
				e.preventDefault();
				activatePreset(chip);
			});

			// Start/pause toggle: pauses a running timer, resumes a paused one,
			// otherwise starts a fresh one from the custom minutes input.
			timerStartEl.addEventListener('click', () => {
				if (timerTick) { pauseTimer(); return; }
				if (timerPausedRemaining > 0) { resumeTimer(); return; }
				const mins = Number(timerCustomEl.value);
				if (!mins || mins <= 0) { timerCustomEl.focus(); return; }
				clearPresetSelection();
				startTimer(mins);
			});

			// Reset: stop the timer and clear the custom minutes input.
			timerStopEl.addEventListener('click', () => {
				stopTimer();
				timerCustomEl.value = '';
			});

			/* =====================================================================
			   My Mixes — saved to localStorage as [{ name, sounds: {key: vol} }].
			   ===================================================================== */
			const MIX_STORE = 'noiseSoundsMixes';

			// Index of the mix currently playing (-1 = none). Only one at a time.
			let activeMixIndex = -1;

			function loadMixes() {
				try { return JSON.parse(localStorage.getItem(MIX_STORE)) || []; }
				catch (e) { return []; }
			}

			function persistMixes(list) {
				try { localStorage.setItem(MIX_STORE, JSON.stringify(list)); }
				catch (e) {}
			}

			function renderMixes() {
				const list = loadMixes();
				mixEmptyEl.style.display = list.length ? 'none' : 'block';
				mixListEl.innerHTML = list.map((mix, i) => {
					const playing = i === activeMixIndex;
					const action = playing ? 'stop' : 'load';
					const icon = playing ? 'bi-stop-fill' : 'bi-play-fill';
					const label = playing ? 'Stop' : 'Load';
					return `
					<li class="mix-item${playing ? ' is-playing' : ''}">
						<span class="mix-item-name" title="${escapeHtml(mix.name)}">${escapeHtml(mix.name)}</span>
						<span class="mix-item-actions">
							<button class="mix-icon-btn" data-action="${action}" data-i="${i}" title="${label} mix" aria-label="${label} ${escapeHtml(mix.name)}"><i class="bi ${icon}"></i></button>
							<button class="mix-icon-btn" data-action="del" data-i="${i}" title="Delete mix" aria-label="Delete ${escapeHtml(mix.name)}"><i class="bi bi-trash"></i></button>
						</span>
					</li>
				`;
				}).join('');
			}

			mixSaveEl.addEventListener('click', () => {
				const name = (mixNameEl.value || '').trim();
				if (!name) { mixNameEl.focus(); return; }
				const mix = getCurrentMix();
				if (!Object.keys(mix).length) {
					showShareFeedback('Play a sound before saving.', true);
					return;
				}
				const list = loadMixes();
				const existing = list.findIndex(m => m.name.toLowerCase() === name.toLowerCase());
				const entry = { name: name, sounds: mix };
				if (existing >= 0) list[existing] = entry; else list.push(entry);
				persistMixes(list);
				mixNameEl.value = '';
				renderMixes();
			});

			mixNameEl.addEventListener('keydown', (e) => {
				if (e.key === 'Enter') mixSaveEl.click();
			});

			mixListEl.addEventListener('click', (e) => {
				const btn = e.target.closest('.mix-icon-btn');
				if (!btn) return;
				const list = loadMixes();
				const i = Number(btn.dataset.i);
				if (btn.dataset.action === 'load') {
					if (list[i]) {
						// Only one mix plays at a time: applyMix replaces all volumes.
						applyMix(list[i].sounds);
						activeMixIndex = i;
						renderSounds();
						renderMixes();
					}
				} else if (btn.dataset.action === 'stop') {
					applyMix({});
					activeMixIndex = -1;
					renderSounds();
					renderMixes();
				} else if (btn.dataset.action === 'del') {
					list.splice(i, 1);
					// Keep the active index aligned after the list shifts.
					if (i === activeMixIndex) activeMixIndex = -1;
					else if (i < activeMixIndex) activeMixIndex--;
					persistMixes(list);
					renderMixes();
				}
			});

			/* =====================================================================
			   Share — encode the current mix into a ?mix= URL and copy it.
			   ===================================================================== */
			function buildShareUrl() {
				const mix = getCurrentMix();
				const url = location.origin + location.pathname;
				return url + '?mix=' + encodeURIComponent(JSON.stringify(mix));
			}

			function showShareFeedback(msg, isError) {
				shareFeedbackEl.textContent = msg;
				shareFeedbackEl.style.color = isError ? '#e25c1b' : '#436f8e';
				shareFeedbackEl.classList.add('show');
				clearTimeout(showShareFeedback._t);
				showShareFeedback._t = setTimeout(() => shareFeedbackEl.classList.remove('show'), 2500);
			}

			function copyText(text) {
				if (navigator.clipboard && navigator.clipboard.writeText) {
					return navigator.clipboard.writeText(text);
				}
				return new Promise((resolve, reject) => {
					const ta = document.createElement('textarea');
					ta.value = text;
					ta.style.position = 'fixed';
					ta.style.opacity = '0';
					document.body.appendChild(ta);
					ta.select();
					try { document.execCommand('copy'); resolve(); }
					catch (err) { reject(err); }
					document.body.removeChild(ta);
				});
			}

			shareBtnEl.addEventListener('click', () => {
				const mix = getCurrentMix();
				if (!Object.keys(mix).length) {
					showShareFeedback('<?php the_field('copy_warning'); ?>', true);
					return;
				}
				copyText(buildShareUrl())
					.then(() => showShareFeedback('<?php the_field('copy_success'); ?>', false))
					.catch(() => showShareFeedback('<?php the_field('copy_error'); ?>', true));
			});

			// On load, apply a mix passed in the URL (?mix=...).
			function applyMixFromUrl() {
				const raw = new URLSearchParams(location.search).get('mix');
				if (!raw) return;
				let mix;
				try {
					mix = JSON.parse(decodeURIComponent(raw));
				} catch (e) { return; }
				if (!mix || typeof mix !== 'object') return;

				// Attempt to start the mix immediately. Browsers block audible autoplay
				// until the user interacts with the page, so this may be rejected on a
				// freshly opened shared link.
				applyMix(mix);

				const shouldPlay = Object.keys(mix).some(k => Number(mix[k]) > 0);
				if (!shouldPlay) return;

				// Resume every sound that should be playing but is still paused (blocked).
				// Returns true if at least one sound is now (or already was) playing.
				function resumeBlocked() {
					sounds.forEach((sound, i) => {
						const audio = players[i];
						if (audio && audio.volume > 0 && audio.paused) audio.play().catch(() => {});
					});
				}

				function anyStillBlocked() {
					return sounds.some((s, i) => players[i] && players[i].volume > 0 && players[i].paused);
				}

				let promptEl = null;
				function removePrompt() {
					if (promptEl) { promptEl.remove(); promptEl = null; }
				}

				const events = ['pointerdown', 'keydown', 'touchstart'];
				function detach() {
					events.forEach(evt => window.removeEventListener(evt, onFirstGesture, true));
				}
				function onFirstGesture() {
					resumeBlocked();
					detach();
					removePrompt();
				}
				// Any interaction anywhere starts the mix and clears the prompt.
				events.forEach(evt => window.addEventListener(evt, onFirstGesture, true));

				// Give the immediate autoplay a moment to take effect; if the browser
				// blocked it, show a single-tap prompt so the visitor knows one tap plays it.
				setTimeout(() => {
					if (!anyStillBlocked()) { detach(); return; }
					promptEl = document.createElement('button');
					promptEl.type = 'button';
					promptEl.className = 'shared-mix-prompt';
					promptEl.innerHTML = '<i class="bi bi-play-circle-fill"></i> <?php the_field('play_shared_link'); ?>';
					promptEl.addEventListener('click', onFirstGesture);
					document.body.appendChild(promptEl);
				}, 350);
			}

			/* =====================================================================
			   Stop all
			   ===================================================================== */
			stopAllEl.addEventListener('click', () => {
				applyMix({});
				stopTimer();
				// Clear any playing mix so its button reverts to the play icon.
				activeMixIndex = -1;
				renderMixes();
			});

			/* =====================================================================
			   Mobile settings slide panel — opened by the floating button (FAB),
			   closed by the backdrop, the × button, or Escape.
			   ===================================================================== */
			const noiseRightEl     = document.getElementById('noiseRight');
			const settingsFabEl     = document.getElementById('settingsFab');
			const settingsBackdropEl = document.getElementById('settingsBackdrop');
			const settingsCloseEl   = document.getElementById('settingsClose');

			function openSettings() {
				if (!noiseRightEl) return;
				noiseRightEl.classList.add('is-open');
				if (settingsBackdropEl) settingsBackdropEl.classList.add('is-open');
				if (settingsFabEl) {
					settingsFabEl.classList.add('is-hidden');
					settingsFabEl.setAttribute('aria-expanded', 'true');
				}
				document.body.style.overflow = 'hidden';
			}

			function closeSettings() {
				if (!noiseRightEl) return;
				noiseRightEl.classList.remove('is-open');
				if (settingsBackdropEl) settingsBackdropEl.classList.remove('is-open');
				if (settingsFabEl) {
					settingsFabEl.classList.remove('is-hidden');
					settingsFabEl.setAttribute('aria-expanded', 'false');
				}
				document.body.style.overflow = '';
			}

			if (settingsFabEl) settingsFabEl.addEventListener('click', openSettings);
			if (settingsCloseEl) settingsCloseEl.addEventListener('click', closeSettings);
			if (settingsBackdropEl) settingsBackdropEl.addEventListener('click', closeSettings);
			document.addEventListener('keydown', (e) => {
				if (e.key === 'Escape') closeSettings();
			});
			// If the viewport grows back to desktop while the panel is open, reset it.
			window.addEventListener('resize', () => {
				if (window.innerWidth > 991.98 && noiseRightEl && noiseRightEl.classList.contains('is-open')) {
					closeSettings();
				}
			});

			// Initial Render
			renderFilters();
			renderSounds();
			renderMixes();
			applyMixFromUrl();
			updateTimerControls();
		}

		a.main();
	})();
</script>

<?php get_footer();
