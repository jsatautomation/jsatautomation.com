<?php
// theme sub header breadcrumb functions

function business_prime_page_header() {
	?>
	<!-- Breadcum start -->
	<div class="w_back1 bp_header_pics">
		<div class="container-fluid w_breadcum">
			<div class="container">
				<div class="row w_breadcum_detail">
					<?php business_prime_header_title();?>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcum end -->
	<?php
}

/*
 * Business Prime Breadcrumbs Title. to show title on header image
 */
function business_prime_header_title($before = '<h1>', $after = '</h1>') {
	if (is_home() && is_front_page()) {
		$title = __('Home', 'business-prime');
	} else if (is_archive()) {
		$title = get_the_archive_title();
	} elseif (is_search()) {
		$title = sprintf(__('Search Results for : %s', 'business-prime'), get_search_query());
	} elseif (is_404()) {
		$title = sprintf(__('Error 404  : Page Not Found', 'business-prime'));
	} elseif(is_single()) {
		$title = get_the_title();
	} else if (is_home() && !is_front_page()) {
		$title = __('Blog', 'business-prime');
	}else {
		$title =  get_the_title();
	}

	if (!empty($title)) {
		echo $before . wp_kses_post($title) . $after;
	}
}

?>