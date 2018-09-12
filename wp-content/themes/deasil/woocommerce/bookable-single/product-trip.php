<?php while ( have_posts() ) : the_post(); ?>
	<div itemscope itemtype="http://schema.org/Product">
	<?php require get_template_directory() . '/woocommerce/bookable-single/get-image.php';?>

	<div class="container">
		<?php
		global $post;
		$deasil_trip_overview = get_post_meta( $post->ID, 'deasil_trip_overview', true ); 
		$deasil_trip_map = get_post_meta( $post->ID, 'deasil_trip_map', true );

		$terms = get_the_terms( $post->ID , 'grade' );
		if($terms) {
			foreach( $terms as $term ) {
				$grade = $term->name;
				$icon_class = get_term_meta ( $term->term_id, 'grade-icon-id', true );
			}
		}
		if(empty($deasil_trip_overview) && empty($deasil_day) && empty($deasil_night) && empty($terms)){
			$trip_insight_class = "hide";
		}
		else{
			$trip_insight_class = "";
		}
		echo '<div class="trip-insight' . $trip_insight_class . '"><div class="insight-list-wrap row">';


		if (!empty($grade)){
			echo '<div class="insight-list">';						
			echo '<span class="' . $icon_class . '"></span>';
			echo '<div class="txt">';
			echo '<p>' . esc_html__('Grade', 'deasil') . '</p>';
			echo '<h3>' . $grade . '</h3></div></div>';
		}

		if(is_array($deasil_trip_overview)){
			foreach($deasil_trip_overview  as $overview){
				echo '<div class="insight-list">';
				if(is_array($overview)){
					foreach($overview as $key => $value){
						switch($key){
							case 'icon':
							echo '<span class="'.$value.'"></span>';
							break;
							case 'title':
							echo '<div class="txt">';
							echo '<p>'.$value.'</p>';
							break;
							case 'value':
							echo '<h3>'.$value.'</h3>';
							echo '</div>';
							break;
						}
					}
				}
				echo '</div>';
			}
		}
		echo '</div></div>';

		?>
		<div class="product">
			<?php do_action( 'woocommerce_before_single_product' );?>
			<div class="product-detail-txt">
				<?php
				woocommerce_template_single_rating();
				woocommerce_template_single_price();
				$deasil_add_to_cart_label = get_post_meta( get_the_ID(), 'deasil_add_to_cart_label', true);

				?>
				<button type="button" id="single_add_to_cart_button" class="btn btn-lg btn-primary">
					<?php 
					if($deasil_add_to_cart_label != ''){
						echo $deasil_add_to_cart_label;
					}
					else{
					esc_html_e('Book Now', 'deasil');	
					}
					?>
				</button>
				<div>
					<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="fa fa-tag"></span> ' ); ?>
				</div>
			</div>

			<?php
			woocommerce_output_product_data_tabs();
			if ( isset($attachment_ids)) {
				echo '<div class="row">';
				echo '<div id="trip-gallery" class="thumbnails gallery columns-3">';

				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
					$image_title     = get_the_title($attachment_id );

					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);

					$html= '<div class="col-sm-3"><a href="' . esc_url( $full_size_image[0] ) . '" class="trip-gallery-item" data-lightbox="trip-detail-gallery" data-title="'.$image_title .'">';
					$html .= '<img src="'.$thumbnail[0].'" alt="'.$image_title.'"/><div class="hover-overlay"><span class="icon-search"></span></div></a></div>';

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				}

				echo '</div>';
				echo '</div>';
			}
			?>

			<?php if(!empty($deasil_trip_map)): ?>
				<div class="section-title center">
					<h3><?php esc_html_e('Find Map', 'deasil');?></h3>
				</div>
				<div class="map">
					<div id="map-canvas" style="height: 500px">
						<?php echo $deasil_trip_map;?>
					</div>
				</div>
			<?php endif;?>
		</div>

	</div>
	</div>

<?php endwhile; // end of the loop. ?>

<?php woocommerce_output_related_products();?>
