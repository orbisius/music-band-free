<?php
/*
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cwp
 */

get_header(); ?>
		<div class="pagetitle">
			<div class="pagetitlecenter">
				<h3><?php _e('Latest News','cwp'); ?></h3>
			</div><!--/pagetitlecenter-->
		</div><!--/pagetitle-->
		
		<!--Content Start-->
		<div id="wraper">
			<section id="content">
				<?php 
				<div <?php post_class(); ?>>
					<div class="topdetails">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="details">
						</div>
					</div><!--/topdetails-->
					<div class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('Read More','cwp'); ?></a></div>
					<div class="clearfix"></div>
					<article>
						<?php the_excerpt(); ?>
					</article>
				</div><!--/post-->
				<?php endif; endwhile; ?>
				<div class="pagination">
					<div class="prev"><?php previous_posts_link( __( 'Prev', 'cwp' ) ); ?></div>	
					<div class="next"><?php next_posts_link( __( 'Next', 'cwp' ) ); ?></div>
				</div><!-- /pagination-->
			</section><!--/content-->
			<aside id="sidebar">
				<?php get_sidebar(); ?>
			</aside><!--/sidebar-->
			<div class="clearfix"></div>
		</div><!--/wraper-->
		<!--Content End -->
<?php get_footer(); ?>