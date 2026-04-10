<?php /*Template Name:All Tools*/
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
		background-color: #f0f0f0;
		color: #666;
		border: none;
		border-radius: 10px;
		padding: 0.3rem 0.3rem;
		font-weight: 500;
		transition: all 0.2s ease;
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
	
	/* Tool Cards */
	.tool-card {
		display: flex;
		align-items: flex-start;
		gap: 1rem;
		padding: 1.25rem;
		background: white;
		border-radius: 12px;
		border: 2px solid transparent;
		text-decoration: none;
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
		text-decoration: none;
		color: inherit;
	}

	/* Category-specific card styles */
	.tool-card.category-tools {
		border-color: #a3c1d4;
	}
	.tool-card.category-tools:hover {
		border-color: #436f8e;
		box-shadow: 0 8px 24px rgba(67, 111, 142, 0.2);
	}

	.tool-card.category-mobile {
		border-color: #f5b08a;
	}
	.tool-card.category-mobile:hover {
		border-color: #e25c1b;
		box-shadow: 0 8px 24px rgba(226, 92, 27, 0.2);
	}

	.tool-card.category-tuners {
		border-color: #c4a8db;
	}
	.tool-card.category-tuners:hover {
		border-color: #7c4daf;
		box-shadow: 0 8px 24px rgba(124, 77, 175, 0.2);
	}

	.tool-card.category-more {
		border-color: #a8bcc5;
	}
	.tool-card.category-more:hover {
		border-color: #5a7a8a;
		box-shadow: 0 8px 24px rgba(90, 122, 138, 0.2);
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
	}

	.tool-icon.category-tools {
		background-color: #e8f0f5;
		color: #436f8e;
	}

	.tool-icon.category-mobile {
		background-color: #fef3ee;
		color: #e25c1b;
	}

	.tool-icon.category-tuners {
		background-color: #f3eef9;
		color: #7c4daf;
	}

	.tool-icon.category-more {
		background-color: #eef2f4;
		color: #5a7a8a;
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
		margin-bottom: 0.25rem;
		color: #1a1a1a;
		text-align: left;
	}

	.tool-description {
		font-size: 0.875rem;
		color: #666;
		margin: 0;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-align: left;
/* 		text-overflow: ellipsis; */
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

	/* Category Header Colors */
	.category-header.category-tools .category-header-icon { color: #436f8e; }
	.category-header.category-tools .category-header-badge { 
		background-color: #e8f0f5; 
		color: #436f8e; 
	}

	.category-header.category-mobile .category-header-icon { color: #e25c1b; }
	.category-header.category-mobile .category-header-badge { 
		background-color: #fef3ee; 
		color: #e25c1b; 
	}

	.category-header.category-tuners .category-header-icon { color: #7c4daf; }
	.category-header.category-tuners .category-header-badge { 
		background-color: #f3eef9; 
		color: #7c4daf; 
	}

	.category-header.category-more .category-header-icon { color: #5a7a8a; }
	.category-header.category-more .category-header-badge { 
		background-color: #eef2f4; 
		color: #5a7a8a; 
	}
	
	.category-tools-color {
		color: #436f8e;
	}
	
	.category-tuners-color {
		color: #7c4daf;
	}
	
	.category-mobile-color {
		color: #e25c1b;
	}
	
	.category-more-color {
		color: #5a7a8a;
	}
	
	/* Ensure grid items stretch equally */
	.row.g-4 > [class*="col-"] {
		display: flex;
	}
	
	
	.tab-img {
		height: 50%;
/* 		width: 60%; */
	}

	/* Responsive Adjustments */
	@media (max-width: 768px) {
		.tool-card {
			padding: 1rem;
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
	}

	/* No Results */
	#noResults i {
		display: block;
	}
</style>

<div class="container-fluid">
		
	<div class="text-center mb-5">            	
		<div class="d-flex flex-wrap align-items-center justify-content-start gap-3 mb-4">
			<div class="search-wrapper">
				<div class="input-group">
					<span class="input-group-text bg-white border-end-0" style="padding-left: 0.75rem; padding-right: 0.75rem; padding-top: 0rem; padding-bottom: 0rem;">
						<img class="img-fluid" src="<?=get_stylesheet_directory_uri();?>/assets/images/search-tools.svg" alt="">
					</span>
					<input type="text" class="form-control border-start-0 ps-0" 
						   id="searchInput" placeholder="<?php the_field('search_tools'); ?>">
				</div>
			</div>

			<div class="d-flex flex-wrap justify-content-center" id="categoryFilters">
				<button class="btn btn-filter active mx-2 my-1" data-category="all">
					<img class="img-fluid tab-img" src="<?=get_stylesheet_directory_uri();?>/assets/images/all-tools2.svg" id="all-tools-icon" alt="">
					<?php the_field('all_tools'); ?>
				</button>
				<button class="btn btn-filter mx-2 my-1" data-category="tools">
					<img class="img-fluid tab-img" src="<?=get_stylesheet_directory_uri();?>/assets/images/desktop-tools1.svg" id="desktop-tools-icon" alt="">
					<?php the_field('desktop_tools'); ?>
				</button>
				<button class="btn btn-filter mx-2 my-1" data-category="mobile">
					<img class="img-fluid tab-img" src="<?=get_stylesheet_directory_uri();?>/assets/images/mobile-tools1.svg" id="mobile-tools-icon" alt="">
					<?php the_field('mobile_tools'); ?>
				</button>
				<button class="btn btn-filter mx-2 my-1" data-category="tuners">
					<img class="img-fluid tab-img" src="<?=get_stylesheet_directory_uri();?>/assets/images/tuners1.svg" id="tuners-icon" alt="">
					<?php the_field('tuners'); ?>
				</button>
				<button class="btn btn-filter mx-2 my-1" data-category="more">
					<img class="img-fluid tab-img" src="<?=get_stylesheet_directory_uri();?>/assets/images/misc-tools1.svg" id="misc-tools-icon" alt="">
					<?php the_field('more'); ?>
				</button>
			</div>
		</div>
		
		<!-- Tools Grid -->
        <div class="row g-4" id="toolsGrid">
            <!-- Tools will be dynamically inserted here -->
        </div>
        
        <!-- No Results Message -->
        <div class="text-center py-5 d-none" id="noResults">
            <i class="bi bi-search display-1 text-muted mb-3"></i>
            <h3 class="text-muted"><?php the_field('no_tools_title'); ?></h3>
            <p class="text-muted"><?php the_field('no_tools_label'); ?></p>
        </div>
	</div>
</div>
</div>
</article>
</div>
</div>

<script>
	(function () {
		let desktopToolsList = <?php echo json_encode(get_field('desktop_tools_list')); ?>;
		let mobileToolsList = <?php echo json_encode(get_field('mobile_tools_list')); ?>;
		let tunersList = <?php echo json_encode(get_field('tuners_list')); ?>;
		let moreList = <?php echo json_encode(get_field('more_list')); ?>;
		
		let tools = [];
		
		desktopToolsList.map((item) => tools.push(item));
		mobileToolsList.map((item) => tools.push(item));
		tunersList.map((item) => tools.push(item));
		moreList.map((item) => tools.push(item));

		// Category metadata
		const categoryMeta = {
			tools: { label: <?php echo json_encode(get_field('desktop_tools')); ?>, emoji: "🖥", icon: "bi-display" },
			mobile: { label: <?php echo json_encode(get_field('mobile_tools')); ?>, emoji: "📱", icon: "bi-phone" },
			tuners: { label: <?php echo json_encode(get_field('tuners')); ?>, emoji: "🎵", icon: "bi-music-note-beamed" },
			more: { label: <?php echo json_encode(get_field('more')); ?>, emoji: "➕", icon: "bi-plus-lg" }
		};
		
		var a = function(){};
		a__name__=!0;

		a.main = function() {
			// DOM Elements
			a.searchInput = window.document.getElementById('searchInput');
			a.toolsGrid = window.document.getElementById('toolsGrid');
			a.categoryFilters = window.document.getElementById('categoryFilters');
			a.noResults = window.document.getElementById('noResults');
			a.allToolsIcon = window.document.getElementById('all-tools-icon');
			a.desktopToolsIcon = window.document.getElementById('desktop-tools-icon');
			a.mobileToolsIcon = window.document.getElementById('mobile-tools-icon');
			a.tunersIcon = window.document.getElementById('tuners-icon');
			a.miscToolsIcon = window.document.getElementById('misc-tools-icon');

			// State
			let activeCategory = 'all';
			let searchQuery = '';

			// Create Tool Card HTML
			function createToolCard(tool) {
				return `
					<div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-1">
						<a href="${tool.link}" 
						   target="_blank" 
						   rel="noopener noreferrer"
						   class="tool-card category-${tool.category}">
							<div class="tool-icon category-${tool.category}">
								<i class="bi ${tool.icon}"></i>
							</div>
							<div class="tool-content">
								<h4 class="tool-name justify-content-start">${tool.title}</h4>
								<p class="tool-description">${tool.descp}</p>
							</div>
						</a>
					</div>
				`;
			}

			// Create Category Header HTML
			function createCategoryHeader(category, toolCount) {
				const meta = categoryMeta[category];
				return `
					<div class="col-12 category-header category-${category}">
						<div class="category-header-content">
							<i class="bi ${meta.icon} category-header-icon"></i>
							<h3 class="category-header-title category-${category}-color">${meta.label}</h3>
							<span class="category-header-badge">${toolCount} <?php the_field('tools_unit'); ?></span>
						</div>
					</div>
				`;
			}

			// Filter and Render Tools
			function renderTools() {
				const filteredTools = tools.filter(tool => {
					const matchesCategory = activeCategory === 'all' || tool.category === activeCategory;
					const matchesSearch = tool.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
										 tool.descp.toLowerCase().includes(searchQuery.toLowerCase());
					return matchesCategory && matchesSearch;
				});

				if (filteredTools.length === 0) {
					a.toolsGrid.innerHTML = '';
					a.noResults.classList.remove('d-none');
				} else {
					a.noResults.classList.add('d-none');

					// Group tools by category
					const groupedTools = {};
					filteredTools.forEach(tool => {
						if (!groupedTools[tool.category]) {
							groupedTools[tool.category] = [];
						}
						groupedTools[tool.category].push(tool);
					});

					// Render with category headers
					const categoryOrder = ['tools', 'mobile', 'tuners', 'more'];
					let html = '';

					categoryOrder.forEach(category => {
						if (groupedTools[category] && groupedTools[category].length > 0) {
							html += createCategoryHeader(category, groupedTools[category].length);
							html += groupedTools[category].map(tool => createToolCard(tool)).join('');
						}
					});

					a.toolsGrid.innerHTML = html;
				}
			}

			// Event Listeners
			a.searchInput.addEventListener('input', (e) => {
				searchQuery = e.target.value;
				renderTools();
			});

			a.categoryFilters.addEventListener('click', (e) => {
				const button = e.target.closest('.btn-filter');
				if (!button) return;

				// Update active state
				document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
				button.classList.add('active');
				
				a.allToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/all-tools1.svg";
				a.desktopToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/desktop-tools1.svg";
				a.mobileToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/mobile-tools1.svg";
				a.tunersIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tuners1.svg";
				a.miscToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/misc-tools1.svg";

				// Update category and render
				activeCategory = button.dataset.category;
				console.log(activeCategory);
				if(activeCategory == "all")
					a.allToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/all-tools2.svg";
				if(activeCategory == "tools")
					a.desktopToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/desktop-tools2.svg";
				if(activeCategory == "mobile")
					a.mobileToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/mobile-tools2.svg";
				if(activeCategory == "tuners")
					a.tunersIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/tuners2.svg";
				if(activeCategory == "more")
					a.miscToolsIcon.src = "<?=get_stylesheet_directory_uri();?>/assets/images/misc-tools2.svg";
				
				renderTools();
			});

			// Initial Render
			document.addEventListener('DOMContentLoaded', renderTools);
		}

		a.main();
	})();
</script>

<?php get_footer();