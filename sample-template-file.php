get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- ***This is the custom part we're handling with multiple TinyMCE windows*** -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<section class="page-section <?php echo get_post_meta( get_the_ID(), '_wpshout_main_wysiwyg_background', true ); ?>">
							<div class="section-content">
							<?php the_content(); ?>
							</div>
						</section>

						<?php $wysiwygs = get_post_meta( get_the_ID(), '_wpshout_wysiwyg', true );

						if (is_array($wysiwygs)) :
							foreach( $wysiwygs as $key => $wysiwyg ) : ?>

								<section class="page-section<?php if( $wysiwyg['color'] ) { echo ' ' . $wysiwyg['color']; } ?>">
									<div class="section-content">
										<h2><?php if( $wysiwyg['title'] ) { echo $wysiwyg['title']; } ?></h2>
										<?php echo wpautop( $wysiwyg['content'] ); ?>
									</div>
								</section>
							
							<?php endforeach;
						endif; ?>
					</div>
				</article>
				<!-- ***End custom part*** -->

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


