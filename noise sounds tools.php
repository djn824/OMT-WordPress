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
	.category-header.category-rain   { --cat: #436f8e; --cat-rgb: 67, 111, 142; --cat-bg: #e8f0f5; --cat-border: #a3c1d4; }
	.tool-card.category-water,
	.category-header.category-water  { --cat: #1b9aaa; --cat-rgb: 27, 154, 170; --cat-bg: #e4f4f6; --cat-border: #a6dce2; }
	.tool-card.category-nature,
	.category-header.category-nature { --cat: #4f8a3f; --cat-rgb: 79, 138, 63;  --cat-bg: #edf5e9; --cat-border: #b9d4ac; }
	.tool-card.category-noise,
	.category-header.category-noise  { --cat: #7c4daf; --cat-rgb: 124, 77, 175; --cat-bg: #f3eef9; --cat-border: #c4a8db; }
	.tool-card.category-focus,
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

		/* Stack the filter buttons full-width on small screens */
		#categoryFilters {
			flex-direction: column;
			flex-wrap: nowrap;
			align-items: stretch;
			width: 100%;
		}

		#categoryFilters .btn-filter {
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: flex-start;
			text-align: left;
			gap: 0.6rem;
			line-height: 1.2;
			margin-left: 0 !important;
			margin-right: 0 !important;
			padding: 0.6rem 0.85rem;
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

		<!-- ============ LEFT SIDE: Sounds list (original UI) ============ -->
		<div class="noise-left">
			<div class="text-center mb-5">
				<div class="toolbar d-flex flex-wrap align-items-center justify-content-start gap-3 mb-4">
					<div class="search-wrapper">
						<div class="input-group">
							<span class="input-group-text bg-white border-end-0" style="padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0rem; padding-bottom: 0rem;">
								<img class="img-fluid" src="<?=get_stylesheet_directory_uri();?>/assets/images/search-tools.svg" alt="">
							</span>
							<input type="text" class="form-control border-start-0 ps-0"
								   id="searchInput" placeholder="<?php the_field('search_sounds'); ?>">
						</div>
					</div>

					<!-- Filter buttons are generated from categoryMeta in JS -->
					<div class="d-flex flex-wrap justify-content-start" id="categoryFilters"></div>
				</div>

				<!-- Sounds Grid -->
				<div class="row g-4" id="soundsGrid">
					<!-- Sounds will be dynamically inserted here -->
				</div>

				<!-- No Results Message -->
				<div class="text-center py-5 d-none" id="noResults">
					<i class="bi bi-search display-1 text-muted mb-3"></i>
					<h3 class="text-muted"><?php the_field('no_result_search_title'); ?></h3>
					<p class="text-muted"><?php the_field('no_results_search_message'); ?></p>
				</div>
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
					<div class="panel-section-title">Timer</div>
					<div class="timer-display" id="timerDisplay">Off</div>
					<div class="timer-presets preset-chip-row" id="timerPresets" role="group" aria-label="Timer presets">
						<span class="actionlink" role="button" tabindex="0" data-min="15" aria-pressed="false">15m</span>
						<span class="actionlink" role="button" tabindex="0" data-min="30" aria-pressed="false">30m</span>
						<span class="actionlink" role="button" tabindex="0" data-min="45" aria-pressed="false">45m</span>
						<span class="actionlink" role="button" tabindex="0" data-min="60" aria-pressed="false">60m</span>
					</div>
					<div class="timer-custom">
						<input type="number" id="timerCustom" min="1" max="600" placeholder="Min">
						<button type="button" class="panel-btn panel-icon-btn" id="timerStart" aria-label="Start timer" title="Start timer">
							<i class="bi bi-play-fill"></i>
						</button>
						<button type="button" class="panel-btn panel-btn-ghost panel-icon-btn" id="timerStop" aria-label="Reset timer" title="Reset timer">
							<i class="bi bi-arrow-counterclockwise"></i>
						</button>
					</div>
				</section>

				<!-- My Mixes (saved to localStorage) -->
				<section class="panel-section">
					<div class="panel-section-title">My Mixes</div>
					<div class="mix-save">
						<input type="text" id="mixName" placeholder="Name this mix" maxlength="40">
						<button type="button" class="panel-btn" id="mixSave">Save</button>
					</div>
					<ul class="mix-list" id="mixList"></ul>
					<p class="mix-empty" id="mixEmpty">No saved mixes yet.</p>
				</section>

				<!-- Share -->
				<section class="panel-section">
					<div class="panel-section-title">Share</div>
					<p class="panel-hint">Create a link to your current mix and send it to anyone.</p>
					<button type="button" class="panel-btn panel-btn-block" id="shareBtn">
						<i class="bi bi-link-45deg"></i> Copy share link
					</button>
					<div class="share-feedback" id="shareFeedback"></div>
				</section>

				<!-- Stop all -->
				<button type="button" class="panel-btn panel-btn-block panel-btn-ghost" id="stopAll">
					<i class="bi bi-stop-circle"></i> Stop all sounds
				</button>

			</aside>
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
			{ title: "Bottle bubbles",    desc: "Soft bubbles from a submerged bottle",           icon: "bi-droplet-half",         file: base + "Bottle-Bubbles.mp3",      category: "water" },

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
			{ title: "Insect chirping",   desc: "Insects chirping through the evening",           icon: "bi-bug",                  file: base + "Insect-Chirping.mp3",     category: "nature" },
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
			{ title: "Beeping alarm",     desc: "A simple repeating alarm beep",                  icon: "bi-alarm",                file: base + "Beeping-Alarm.mp3",       category: "focus" }
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
			a.soundsGrid = window.document.getElementById('soundsGrid');
			a.categoryFilters = window.document.getElementById('categoryFilters');
			a.noResults = window.document.getElementById('noResults');

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
			let activeCategory = 'all';
			let searchQuery = '';

			function getPlayer(index, file) {
				if (!players[index]) {
					const audio = new Audio(encodeURI(file));
					audio.loop = true;
					audio.volume = 0;
					players[index] = audio;
				}
				return players[index];
			}

			function setIconLoading(card, isLoading) {
				const icon = card && card.querySelector('.tool-icon');
				if (icon) icon.classList.toggle('loading', isLoading);
			}

			// Set a sound's volume by index (0-100). The card is optional: when a
			// sound is filtered out of the grid (e.g. while applying a saved mix or
			// a shared link) there is no card, but the audio still plays.
			function setVolume(index, value) {
				index = Number(index);
				const sound = sounds[index];
				if (!sound) return;
				const audio = getPlayer(index, sound.file);
				const vol = Math.max(0, Math.min(100, value)) / 100;
				audio.volume = vol;

				const card = a.soundsGrid.querySelector('.tool-card[data-index="' + index + '"]');
				const slider = card ? card.querySelector('.sound-slider') : null;
				if (slider) slider.value = Math.round(vol * 100);

				if (vol > 0) {
					if (audio.paused) {
						audio.currentTime = 0;   // replay from the beginning
						if (card) {
							// Show a spinner on the icon until the sound actually starts.
							setIconLoading(card, true);
							const stopLoading = () => setIconLoading(card, false);
							audio.addEventListener('playing', stopLoading, { once: true });
							audio.play().then(stopLoading).catch(stopLoading);
						} else {
							audio.play().catch(() => {});
						}
					}
					if (card) card.classList.add('active');
				} else {
					audio.pause();
					if (card) {
						setIconLoading(card, false);
						card.classList.remove('active');
					}
				}
			}

			// Create Sound Card HTML
			function createSoundCard(sound, index) {
				return `
					<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
						<div class="tool-card category-${sound.category}" data-index="${index}">
							<div class="tool-icon category-${sound.category}" role="button" aria-label="Toggle ${sound.title}">
								<i class="bi ${sound.icon}"></i>
							</div>
							<div class="tool-content">
								<h4 class="tool-name justify-content-start">${sound.title}</h4>
								<p class="tool-description">${sound.desc}</p>
								<input type="range" class="sound-slider" min="0" max="100" value="0"
									   data-index="${index}" data-file="${sound.file}" aria-label="${sound.title} volume">
							</div>
						</div>
					</div>
				`;
			}

			// Create Category Header HTML
			function createCategoryHeader(category, count) {
				const meta = categoryMeta[category];
				return `
					<div class="col-12 category-header category-${category}">
						<div class="category-header-content">
							<i class="bi ${meta.icon} category-header-icon"></i>
							<h3 class="category-header-title">${meta.label}</h3>
							<span class="category-header-badge">${count} <?php the_field('sound_unit') ?></span>
						</div>
					</div>
				`;
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

			// Filter and Render Sounds
			function renderSounds() {
				const filteredSounds = sounds
					.map((sound, index) => ({ sound, index }))
					.filter(({ sound }) => {
						const matchesCategory = activeCategory === 'all' || sound.category === activeCategory;
						const matchesSearch = sound.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
											  sound.desc.toLowerCase().includes(searchQuery.toLowerCase());
						return matchesCategory && matchesSearch;
					});

				if (filteredSounds.length === 0) {
					a.soundsGrid.innerHTML = '';
					a.noResults.classList.remove('d-none');
				} else {
					a.noResults.classList.add('d-none');

					// Group sounds by category
					const groupedSounds = {};
					filteredSounds.forEach(item => {
						if (!groupedSounds[item.sound.category]) {
							groupedSounds[item.sound.category] = [];
						}
						groupedSounds[item.sound.category].push(item);
					});

					// Render with category headers (order comes from categoryOrder)
					let html = '';

					categoryOrder.forEach(category => {
						if (groupedSounds[category] && groupedSounds[category].length > 0) {
							html += createCategoryHeader(category, groupedSounds[category].length);
							html += groupedSounds[category].map(item => createSoundCard(item.sound, item.index)).join('');
						}
					});

					a.soundsGrid.innerHTML = html;

					// Reflect currently-playing sounds in the freshly rendered cards.
					a.soundsGrid.querySelectorAll('.sound-slider').forEach(slider => {
						const idx = Number(slider.dataset.index);
						if (players[idx] && players[idx].volume > 0) {
							slider.value = Math.round(players[idx].volume * 100);
							slider.closest('.tool-card').classList.add('active');
						}
					});
				}
			}

			// Slider drag → volume
			a.soundsGrid.addEventListener('input', (e) => {
				const slider = e.target.closest('.sound-slider');
				if (!slider) return;
				setVolume(slider.dataset.index, Number(slider.value));
			});

			// Click the icon → toggle on (50%) / off
			a.soundsGrid.addEventListener('click', (e) => {
				const icon = e.target.closest('.tool-icon');
				if (!icon) return;
				const card = icon.closest('.tool-card');
				const index = Number(card.querySelector('.sound-slider').dataset.index);
				const playing = players[index] && players[index].volume > 0;
				setVolume(index, playing ? 0 : 50);
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
					timerDisplayEl.textContent = 'Off';
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
				mixListEl.innerHTML = list.map((mix, i) => `
					<li class="mix-item">
						<span class="mix-item-name" title="${escapeHtml(mix.name)}">${escapeHtml(mix.name)}</span>
						<span class="mix-item-actions">
							<button class="mix-icon-btn" data-action="load" data-i="${i}" title="Load mix" aria-label="Load ${escapeHtml(mix.name)}"><i class="bi bi-play-fill"></i></button>
							<button class="mix-icon-btn" data-action="del" data-i="${i}" title="Delete mix" aria-label="Delete ${escapeHtml(mix.name)}"><i class="bi bi-trash"></i></button>
						</span>
					</li>
				`).join('');
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
						applyMix(list[i].sounds);
						renderSounds();
					}
				} else if (btn.dataset.action === 'del') {
					list.splice(i, 1);
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
					showShareFeedback('Play a sound before sharing.', true);
					return;
				}
				copyText(buildShareUrl())
					.then(() => showShareFeedback('Link copied to clipboard!', false))
					.catch(() => showShareFeedback('Could not copy link.', true));
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
					promptEl.innerHTML = '<i class="bi bi-play-circle-fill"></i> Tap to play shared mix';
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
