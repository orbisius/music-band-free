<?php
/*
 * The template for displaying Search Results pages.
 *
 * @package cwp
 */

get_header(); ?>
<div class="pagetitle">
			<div class="pagetitlecenter">
				<h3>
					<?php printf( __( 'Search Results for: %s', 'cwp' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h3>
			</div><!--/pagetitlecenter-->
		</div><!--/pagetitle-->
		
		<!--Content Start-->
		<div id="wraper">
			<section id="content">
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="post">
					<div class="topdetails">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="details">
							<?php								/* date */								echo get_the_date('F j, Y').' &#8226; ';								/* author */								echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'">'.get_the_author().'</a> &#8226; ';								/* comments */								comments_number( __('No Comments','cwp'), __('one Comment','cwp'), '% '.__('Comments','cwp') );								echo ' &#8226; ';								/* categories */									$cat = get_the_category();								if(!empty($cat)) :										foreach($cat as $cat_item):											echo '<a href="'.get_category_link($cat_item->cat_ID).'">'.$cat_item->cat_name.'</a> &#8226; ';										endforeach;								endif;								if(has_tag()):									the_tags();									echo ' &#8226; ';								endif;									echo cwp_getPostViews(get_the_ID());							?>
						</div>
					</div><!--/topdetails-->
					<div class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('Read More','cwp'); ?></a></div>
					<div class="clearfix"></div>
					<?php 
						if(get_theme_mod('fi_index')):
							$fi_index = get_theme_mod('fi_index');
						endif;	
						if((isset($fi_index) && $fi_index == 'show') || (!isset($fi_index)) ){
							if ( has_post_thumbnail()) {
								echo '<figure>'.get_the_post_thumbnail().'</figure>';
							}
						}						
					?>
					<article>
						<?php the_excerpt(); ?>
					</article>
				</div><!--/post-->
				<?php endwhile; ?>
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
	<?php get_template_part('/inc/footer-section'); ?>
<?php get_footer(); ?>