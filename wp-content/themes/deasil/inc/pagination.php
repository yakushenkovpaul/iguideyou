<?php

/**
* Deasil pagination function for blog list
*/
function deasil_pagination($pages = '', $range = 4, $showpagination = false){  

	if($showpagination == true){
			$showitems = ($range * 2) + 1;  
		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == ''){
			global $wp_query; 
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}   

		if(1 != $pages){
			echo '<div class="pagination-wrap"><div class="total">';
			printf( esc_html__( 'Page %1$s of %2$s', 'deasil' ), $paged, $pages );

			echo '</div><ul class="pagination pull-right">';

			if($paged > 2 && $paged > $range+1 && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";	
			} 

			if($paged > 1 && $showitems < $pages){
				echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";	
			} 

			for ($i=1; $i <= $pages; $i++){

				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
					echo ($paged == $i)? "<li class=\"active\"><span>".$i."</span>
						</li>":"<li><a href='".esc_url(get_pagenum_link($i))."'>".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages){
				echo "<li><a href=\"".esc_url(get_pagenum_link($paged + 1))."\" >&rsaquo;</a></li>";
			}

			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages){
			 echo "<li><a href='".esc_url(get_pagenum_link($pages))."'>&raquo;</a></li>";
			}

			echo "</ul></div>";
		}
	}
	else{
		posts_nav_link('&nbsp;','<span class="btn btn-primary"><i class="icon-arrow-left"></i> '.esc_html__('Newer Posts','deasil').'</span>','<span class="btn btn-primary pull-right">'.esc_html__('Older Posts', 'deasil').' <i class="icon-arrow-right"></i></span>');
	};

}