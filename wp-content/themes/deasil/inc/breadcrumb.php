<?php
function deasil_breadcrumb() {
	echo '<ul class="breadcrumb">';
	if (is_tag()) {single_tag_title();}
	elseif (is_author()) {echo'<li>' . esc_html__('Author Archive', 'deasil') . '</li>';}
	elseif (is_search()) {echo'<li>' . esc_html__('Search Results', 'deasil') . '</li>';}
	else {
		echo '<li><a href="' . esc_url(site_url()) . '">';
		echo '<span class="fa fa-home"></span>';
		echo "</a></li>";
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {
				echo "</li><li>";
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			echo '<li>';
			echo the_title();
			echo '</li>';
		}
	}
	echo '</ul>';
}
