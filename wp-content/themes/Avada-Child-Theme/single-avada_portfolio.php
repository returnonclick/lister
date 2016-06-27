<?php get_header(); ?>
<div id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
	query_posts( $query_string . '&paged=' . $paged );
	$portfolioID     = ( isset( $_GET['portfolioID'] ) ) ? $_GET['portfolioID'] : '';
	$categoryID      = ( isset( $_GET['categoryID'] ) ) ? $_GET['categoryID'] : '';
	$page_categories = get_post_meta( $portfolioID, 'pyre_portfolio_category', true );
	$nav_categories  = ( $page_categories && is_array( $page_categories ) && '0' !== $page_categories[0] ) ? implode( ',', $page_categories ) : '';
	$nav_categories  = ( $categoryID ) ? $categoryID : $nav_categories;
	?>

	<?php

	$prefix = 'roc_';

		if ( ! function_exists( 'rwmb_meta' ) ) {
			function rwmb_meta( $key, $args = '', $post_id = null ) {
				return false;
			}
		}

	$city = rwmb_meta( $prefix . 'city' );
	$date = rwmb_meta( $prefix . 'date' );
	$date_formatted = explode("-", $date);

	?>

	<div style="width: 100%; text-align: center">
		<h1><?php echo the_title(); ?></h1>
		<h3><?php echo $city; ?> / <?php echo $date_formatted[0]; ?></h3>
	</div>


	<?php if ( ( Avada()->settings->get( 'portfolio_pn_nav' ) && 'no' != get_post_meta( $post->ID, 'pyre_post_pagination', true ) ) || ( ! Avada()->settings->get( 'portfolio_pn_nav' ) && 'yes' == get_post_meta( $post->ID, 'pyre_post_pagination', true ) ) ) : ?>
		<div class="single-navigation clearfix">
			<?php
			if ( $portfolioID || $categoryID ) {
				$previous_post_link = fusion_previous_post_link_plus( array(
					'format'      => '%link',
					'link'        => esc_html__( 'Previous', 'Avada' ),
					'in_same_tax' => 'portfolio_category',
					'in_cats'     => $nav_categories,
					'return'      => 'href',
				) );
			} else {
				$previous_post_link = fusion_previous_post_link_plus( array(
					'format'      => '%link',
					'link'        => esc_html__( 'Previous', 'Avada' ),
					'return'      => 'href'
				) );
			}
			?>

			<?php if ( $previous_post_link ) : ?>
				<?php if ( $portfolioID ) : ?>
					<?php $previous_post_link = fusion_add_url_parameter( $previous_post_link, 'portfolioID', $portfolioID ); ?>
				<?php elseif ( $categoryID ) : ?>
					<?php $previous_post_link = fusion_add_url_parameter( $previous_post_link, 'categoryID', $categoryID ); ?>
				<?php endif; ?>
				<a href="<?php echo $previous_post_link; ?>" rel="prev"><?php esc_html_e( 'Previous', 'Avada' ); ?></a>
			<?php endif; ?>

			<?php
			if ( $portfolioID || $categoryID ) {
				$next_post_link = fusion_next_post_link_plus( array(
					'format'      => '%link',
					'link'        => esc_html__( 'Next', 'Avada' ),
					'in_same_tax' => 'portfolio_category',
					'in_cats'     => $nav_categories,
					'return'      => 'href',
				) );
			} else {
				$next_post_link = fusion_next_post_link_plus( array(
					'format'      => '%link',
					'link'        => esc_html__( 'Next', 'Avada' ),
					'return'      => 'href',
				) );
			}
			?>

			<?php if ( $next_post_link ) : ?>
				<?php if ( $portfolioID ) : ?>
					<?php $next_post_link = fusion_add_url_parameter( $next_post_link, 'portfolioID', $portfolioID ); ?>
				<?php elseif ( $categoryID ) : ?>
					<?php $next_post_link = fusion_add_url_parameter( $next_post_link, 'categoryID', $categoryID ); ?>
				<?php endif; ?>
				<a href="<?php echo $next_post_link; ?>" rel="next"><?php esc_html_e( 'Next', 'Avada' ); ?></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( have_posts() ): the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php $full_image = ''; ?>

			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php if ( Avada()->settings->get( 'portfolio_featured_images' ) ) : ?>
					<?php if ( 0 < avada_number_of_featured_images() || get_post_meta( $post->ID, 'pyre_video', true ) ) : ?>
						<div class="fusion-flexslider flexslider fusion-post-slideshow post-slideshow fusion-flexslider-loading">
							<ul class="slides">

								<!-- IMAGES TO GALLERY -->




								<?php $attachment_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
								<?php $full_image       = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
								<?php $attachment_data  = wp_get_attachment_metadata( get_post_thumbnail_id() ); ?>
								<li data-thumb="<?php echo $full_image[0]; ?>">
										<a href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field( 'post_excerpt', get_post_thumbnail_id() ); ?>" data-title="<?php echo get_post_field( 'post_title', get_post_thumbnail_id() ); ?>" data-caption="<?php echo get_post_field( 'post_excerpt', get_post_thumbnail_id() ); ?>">
											<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ); ?>" role="presentation" />
										</a>
								</li>

								<?php $attachment_image = rwmb_meta( $prefix . 'plupload', 'type=image&size=full' ); ?>
								<?php $full_image       = rwmb_meta( $prefix . 'plupload', 'type=image&size=full' ); ?>
								<?php $attachment_data  = rwmb_meta( $prefix . 'plupload', 'type=image' ); ?>
								<?php
								if ( !empty( $full_image ) ) {
									foreach ( $full_image as $image ) {

										?>

										<li data-thumb="<?php echo $image['full_url'] ?>">

											<a href="<?php echo $image['full_url'] ?>"
											   data-rel="iLightbox[gallery<?php the_ID(); ?>]"
											   >
												<img src="<?php echo $image['url']; ?>" role="presentation"
													 width='<?php echo $image['width'] ?>'
													 height='<?php echo $image['height'] ?>'
													 alt='<?php echo $image['alt'] ?>'/>
											</a>

										</li>
										<?php
									}
								}
								?>




							</ul>
						</div>
					<?php endif; ?>
				<?php endif; // portfolio single image theme option check ?>
			<?php endif; // password check ?>

			<?php
			$portfolio_width          = ( fusion_get_option( 'portfolio_featured_image_width', 'width', $post->ID ) == 'half' ) ? 'half' : 'full';
			$portfolio_width          = ( ! Avada()->settings->get( 'portfolio_featured_images' ) && 'half' == $portfolio_width ) ? 'full' : $portfolio_width;
			$project_desc_title_style = ( ! fusion_get_option( 'portfolio_project_desc_title', 'project_desc_title', $post->ID ) || 'no' == fusion_get_option( 'portfolio_project_desc_title', 'project_desc_title', $post->ID ) ) ? 'display:none;' : '';
			$project_desc_width_style = ( 'full' == $portfolio_width && ( ! fusion_get_option( 'portfolio_project_details', 'project_details', $post->ID ) || 'no' == fusion_get_option( 'portfolio_project_details', 'project_details', $post->ID ) ) ) ? ' width:100%;' : '';
			$project_details          = ( in_array( fusion_get_option( 'portfolio_project_details', 'project_details', $post->ID ), array( 'yes', '1', 1 ) ) ) ? true : false;
			?>
			<div class="project-content clearfix">
				<?php echo avada_render_rich_snippets_for_pages(); ?>
				<div class="project-description post-content<?php echo ( $project_details ) ? ' fusion-project-description-details' : ''; ?>" style="<?php echo $project_desc_width_style; ?>">
					<?php if ( ! post_password_required( $post->ID ) ) : ?>
						<h3 style="<?php echo $project_desc_title_style; ?>"><?php esc_html_e( 'Project Description', 'Avada' ) ?></h3>
					<?php endif; ?>
					<?php the_content(); ?>
				</div>
				<?php if ( ! post_password_required( $post->ID ) && $project_details ) : ?>
					<div class="project-info">

						<h3><?php esc_html_e( 'Project Details', 'Avada' ); ?></h3>

						<?php if ( get_the_term_list( $post->ID, 'portfolio_skills', '', '<br />', '' ) ) : ?>
							<div class="project-info-box">
								<h4><?php esc_html_e( 'Skills Needed:', 'Avada' ) ?></h4>
								<div class="project-terms">
									<?php echo get_the_term_list( $post->ID, 'portfolio_skills', '', '<br />', '' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( get_the_term_list( $post->ID, 'portfolio_category', '', '<br />', '' ) ) : ?>
							<div class="project-info-box">
								<h4><?php esc_html_e( 'Categories:', 'Avada' ) ?></h4>
								<div class="project-terms">
									<?php echo get_the_term_list( $post->ID, 'portfolio_category', '', '<br />', '' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( get_the_term_list( $post->ID, 'portfolio_tags', '', '<br />', '' ) ) : ?>
							<div class="project-info-box">
								<h4><?php esc_html_e( 'Tags:', 'Avada' ) ?></h4>
								<div class="project-terms">
									<?php echo get_the_term_list( $post->ID, 'portfolio_tags', '', '<br />', '' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( get_post_meta( $post->ID, 'pyre_project_url', true ) && get_post_meta( $post->ID, 'pyre_project_url_text', true ) ) : ?>
							<?php $link_target = ( in_array( fusion_get_option( 'portfolio_link_icon_target', 'link_icon_target', $post->ID ), array( '1', 1, 'yes' ) ) ) ? ' target="_blank"' : ''; ?>
							<div class="project-info-box">
								<h4><?php esc_html_e( 'Project URL:', 'Avada') ?></h4>
								<span><a href="<?php echo get_post_meta( $post->ID, 'pyre_project_url', true ); ?>"<?php echo $link_target; ?>><?php echo get_post_meta( $post->ID, 'pyre_project_url_text', true ); ?></a></span>
							</div>
						<?php endif; ?>

						<?php if ( get_post_meta($post->ID, 'pyre_copy_url', true ) && get_post_meta( $post->ID, 'pyre_copy_url_text', true ) ) : ?>
							<?php $link_target = ( in_array( fusion_get_option( 'portfolio_link_icon_target', 'link_icon_target', $post->ID ), array( '1', 1, 'yes' ) ) ) ? ' target="_blank"' : ''; ?>
							<div class="project-info-box">
								<h4><?php esc_html_e( 'Copyright:', 'Avada' ); ?></h4>
								<span><a href="<?php echo get_post_meta( $post->ID, 'pyre_copy_url', true ); ?>"<?php echo $link_target; ?>><?php echo get_post_meta( $post->ID, 'pyre_copy_url_text', true ); ?></a></span>
							</div>
						<?php endif; ?>

						<?php if ( Avada()->settings->get( 'portfolio_author' ) ) : ?>
							<div class="project-info-box<?php echo ( Avada()->settings->get( 'disable_date_rich_snippet_pages' ) ) ? ' vcard' : ''; ?>">
								<h4><?php esc_html_e( 'By:', 'Avada' ); ?></h4>
								<span<?php echo ( Avada()->settings->get( 'disable_date_rich_snippet_pages' ) )? ' class="fn"' : ''; ?>><?php the_author_posts_link(); ?></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="portfolio-sep"></div>
			<?php if ( ! post_password_required( $post->ID ) ) : ?>
				<?php avada_render_social_sharing( 'portfolio' ); ?>
				<?php echo avada_render_related_posts( 'avada_portfolio' ); // Render Related Posts ?>

				<?php if ( Avada()->settings->get( 'portfolio_comments' ) ) : ?>
					<?php wp_reset_query(); ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<script type="text/javascript">
		jQuery(window).load(function(){
			jQuery('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails",
				smoothHeight: "true",
				start: function(slider){
					jQuery('body').removeClass('loading');
				}
			});
		});
	</script>
</div>
<?php do_action( 'avada_after_content' ); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
