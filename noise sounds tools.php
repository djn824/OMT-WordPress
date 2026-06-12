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

		/* Stack search above the filter strip */
		.toolbar {
			flex-direction: column;
			align-items: stretch;
			gap: 0.75rem;
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
</style>

<div class="container-fluid">

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
			<div class="d-flex flex-wrap justify-content-center" id="categoryFilters"></div>
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
</div>
</article>
</div>
</div>

<script>
	(function () {
		// Base URL for every sound file; entries below store base + filename.
		const base = '<?php echo get_stylesheet_directory_uri();?>/assets/audio/noise-sounds/';

		// Fallback sound library, used when the "sounds_library" field is empty.
		// Each entry: { title, desc, icon, file, category }
		const DEFAULT_SOUNDS = [
			// ---- RAIN & STORMS ----
			{ title: "Rain",              desc: "Steady rainfall to help you relax and focus",   icon: "bi-cloud-rain",           file: base + "Rain.ogg",                 category: "rain" },
			{ title: "Thunder",           desc: "Distant rolling thunder for a stormy mood",      icon: "bi-cloud-lightning-rain", file: base + "Thunder.ogg",              category: "rain" },
			{ title: "Rain on tin roof",  desc: "Rain pattering on a metal roof",                 icon: "bi-cloud-rain-heavy",     file: base + "Rain-on-TinRoof.ogg",      category: "rain" },
			{ title: "Rain on trees",     desc: "Raindrops falling through the leaves",           icon: "bi-cloud-drizzle",        file: base + "Rain-on-Trees.ogg",        category: "rain" },
			{ title: "Rain on cabin",     desc: "Rain falling on a cozy wooden cabin",            icon: "bi-house",                file: base + "Rain-on-Cabin.ogg",        category: "rain" },

			// ---- WATER ----
			{ title: "Waves",             desc: "Gentle ocean waves rolling onto the shore",      icon: "bi-water",                file: base + "Waves.ogg",               category: "water" },
			{ title: "Stream",            desc: "A babbling stream flowing over rocks",           icon: "bi-tsunami",              file: base + "Stream.ogg",              category: "water" },
			{ title: "Waterfall",         desc: "A powerful waterfall cascading down",            icon: "bi-water",                file: base + "Waterfall.ogg",           category: "water" },
			{ title: "Water rippling",    desc: "Soft ripples across calm water",                 icon: "bi-droplet",              file: base + "Water-Rippling.mp3",      category: "water" },
			{ title: "Underwater bubbles", desc: "Gentle bubbles drifting underwater",            icon: "bi-droplet-half",         file: base + "Underwater-Bubbles.mp3",  category: "water" },

			// ---- NATURE & WILDLIFE ----
			{ title: "Wind",              desc: "Soft wind blowing through open space",           icon: "bi-wind",                 file: base + "Wind.ogg",                category: "nature" },
			{ title: "Fire",              desc: "Warm crackling campfire sounds",                 icon: "bi-fire",                 file: base + "Fire.ogg",                category: "nature" },
			{ title: "Fire crackling",    desc: "Crackling flames of an open fire",               icon: "bi-fire",                 file: base + "Fire-Crackling.mp3",      category: "nature" },
			{ title: "Bamboo rustling",   desc: "Bamboo leaves rustling in the breeze",           icon: "bi-tree",                 file: base + "Bamboo-Rustling.mp3",     category: "nature" },
			{ title: "Birds",             desc: "Cheerful birds singing in the morning",          icon: "bi-feather",              file: base + "Birds.ogg",               category: "nature" },
			{ title: "Crickets",          desc: "Calming crickets chirping through the night",    icon: "bi-bug",                  file: base + "Crickets.ogg",            category: "nature" },
			{ title: "Chirping birds",    desc: "Birds chirping in a peaceful forest",            icon: "bi-feather",              file: base + "Chirping-Bird-Sounds.mp3", category: "nature" },
			{ title: "Cicadas",           desc: "Buzzing cicadas on a warm summer day",           icon: "bi-bug-fill",             file: base + "Cicadas.ogg",             category: "nature" },
			{ title: "Frogs",             desc: "Frogs croaking by a quiet pond",                 icon: "bi-bug-fill",             file: base + "Frogs.ogg",               category: "nature" },
			{ title: "Insect chirping",   desc: "Insects chirping through the evening",           icon: "bi-bug",                  file: base + "Insect-Chirping.mp3",     category: "nature" },

			// ---- WHITE NOISE & FANS ----
			{ title: "White noise",       desc: "Even white noise to mask distractions",          icon: "bi-volume-up",            file: base + "White-Noise.ogg",         category: "noise" },
			{ title: "Brown noise",       desc: "Deep brown noise for intense focus",             icon: "bi-volume-down",          file: base + "Brown-Noise.ogg",         category: "noise" },
			{ title: "Pink noise",        desc: "Balanced pink noise to aid sleep",               icon: "bi-volume-up",            file: base + "Pink-Noise.ogg",          category: "noise" },
			{ title: "Fan on high",       desc: "A strong fan running on high speed",             icon: "bi-fan",                  file: base + "Fan-on-High.ogg",         category: "noise" },
			{ title: "Fan on low",        desc: "A gentle fan running on low speed",              icon: "bi-fan",                  file: base + "Fan-on-Low.ogg",          category: "noise" },
			{ title: "Air conditioning",  desc: "Steady hum of an air conditioner",               icon: "bi-snow",                 file: base + "Air-Conditioning.ogg",    category: "noise" },

			// ---- FOCUS & AMBIENCE ----
			{ title: "Coffee shop",       desc: "Cozy background chatter of a busy cafe",         icon: "bi-cup-hot",              file: base + "Coffee-Shop.ogg",         category: "focus" },
			{ title: "City",              desc: "Busy city ambience and distant traffic",         icon: "bi-buildings",            file: base + "City.ogg",                category: "focus" },
			{ title: "Record player",     desc: "Warm vinyl crackle of a record player",          icon: "bi-vinyl",                file: base + "Record-Player.ogg",       category: "focus" },
			{ title: "Typing",            desc: "Rhythmic keyboard typing to keep you in flow",   icon: "bi-keyboard",             file: base + "Typing-Sound.mp3",        category: "focus" },
			{ title: "Writing",           desc: "A pen scratching across paper",                  icon: "bi-pencil",               file: base + "Writing-Sound.mp3",       category: "focus" },
			{ title: "Soft piano",        desc: "Gentle piano melodies to help you unwind",       icon: "bi-music-note-beamed",    file: base + "Soft-Piano.mp3",          category: "focus" },
			{ title: "Singing Bowl",      desc: "Resonant singing bowl tones for meditation",     icon: "bi-soundwave",            file: base + "Singing-Bowl.ogg",        category: "focus" },
			{ title: "Singing bowl",      desc: "Soothing singing bowl resonance",                icon: "bi-soundwave",            file: base + "Singing-Bowl-Sound.mp3",  category: "focus" },
			{ title: "Metal chimes",      desc: "Soft metal wind chimes ringing gently",          icon: "bi-bell",                 file: base + "Metal-Chimes.ogg",        category: "focus" },
			{ title: "Wooden fish",       desc: "Steady wooden fish taps for deep focus",         icon: "bi-record-circle",        file: base + "Wooden-Fish-Sound.mp3",   category: "focus" },
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

			function setVolume(index, file, value, card) {
				const audio = getPlayer(index, file);
				const vol = value / 100;
				audio.volume = vol;
				if (vol > 0) {
					if (audio.paused) {
						audio.currentTime = 0;   // replay from the beginning
						// Show a spinner on the icon until the sound actually starts.
						setIconLoading(card, true);
						const stopLoading = () => setIconLoading(card, false);
						audio.addEventListener('playing', stopLoading, { once: true });
						audio.play().then(stopLoading).catch(stopLoading);
					}
					card.classList.add('active');
				} else {
					audio.pause();
					setIconLoading(card, false);
					card.classList.remove('active');
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
						const idx = slider.dataset.index;
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
				setVolume(slider.dataset.index, slider.dataset.file, Number(slider.value), slider.closest('.tool-card'));
			});

			// Click the icon → toggle on (50%) / off
			a.soundsGrid.addEventListener('click', (e) => {
				const icon = e.target.closest('.tool-icon');
				if (!icon) return;
				const card = icon.closest('.tool-card');
				const slider = card.querySelector('.sound-slider');
				const playing = players[slider.dataset.index] && players[slider.dataset.index].volume > 0;
				slider.value = playing ? 0 : 50;
				setVolume(slider.dataset.index, slider.dataset.file, Number(slider.value), card);
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

			// Initial Render
			renderFilters();
			renderSounds();
		}

		a.main();
	})();
</script>

<?php get_footer();
