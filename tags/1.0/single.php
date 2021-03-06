<?php
/*
 * The Template for displaying all single posts.
 *
 * @package cwp
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); 
		cwp_setPostViews(get_the_ID());
		$id = get_the_ID();
		
		/* TOP BANNER SECTION */
		
		if(get_theme_mod('multiple_select_setting')):
			$top_banner = get_theme_mod('multiple_select_setting');
		endif;
			if(isset($top_banner) && !empty($top_banner)):
				foreach($top_banner as $p):		
					if($id == $p):
						if(get_theme_mod('top_banner_image')):
							$top_banner_image = get_theme_mod('top_banner_image');
						endif;	
						if(get_theme_mod('top_banner_title')):
							$top_banner_title = get_theme_mod('top_banner_title');
						endif;	
						if(get_theme_mod('top_banner_text')):
							$top_banner_text = get_theme_mod('top_banner_text');
						endif;	
						if(isset($top_banner_image) && $top_banner_image != ''):
						?>
							<section id="subheader" class="subheader_news" style="background-image: url(<?php echo $top_banner_image; ?>);">
								<?php 
									if(isset($top_banner_title) && $top_banner_title != '')
										echo '<div class="album_title">'.$top_banner_title.'</div>';
									if(isset($top_banner_text) && $top_banner_text != '')	
										echo '<p>'.$top_banner_text.'</p>';
								?>
							</section><!--/subheader-->
						<?php
						else:
						?>
							<section id="subheader" class="subheader_news" style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/abovefooterbg.png);">
								<?php 
									if(isset($top_banner_title) && $top_banner_title != '')
										echo '<div class="album_title">'.$top_banner_title.'</div>';
									if(isset($top_banner_text) && $top_banner_text != '')	
										echo '<p>'.$top_banner_text.'</p>';
								?>
							</section><!--/subheader-->
						<?php
						endif;
					endif;
				endforeach;
			endif;
			
			/* END - TOP BANNER SECTION */
?>
		
		
		<!--Content Start-->
		<div id="wraper">
			<section id="content">

				<div <?php post_class('post_inside'); ?>>
					<div class="topdetails">
						<h2><a href=""><?php the_title(); ?></a></h2>
						<div class="details">
							<?php								/* date */								echo get_the_date('F j, Y').' &#8226; ';								/* author */
								echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' )).'">'.get_the_author().'</a> &#8226; ';								/* comments */
								comments_number( __('No Comments','cwp'), __('one Comment','cwp'), '% '.__('Comments','cwp') );
								echo ' &#8226; ';								/* categories */	
								$cat = get_the_category();
								if(!empty($cat)) :
										foreach($cat as $cat_item):
											echo '<a href="'.get_category_link($cat_item->cat_ID).'">'.$cat_item->cat_name.'</a> &#8226; ';
										endforeach;
								endif;								if(has_tag()):
									the_tags();									echo ' &#8226; ';								endif;	
								echo cwp_getPostViews(get_the_ID());
							?>
						</div>
					</div><!--/topdetails-->
					<div class="clearfix"></div>
					<?php 
						if(get_theme_mod('fi_single')):
							$fi_single = get_theme_mod('fi_single');
						endif;	
						if((isset($fi_single) && $fi_single == 'show') || (!isset($fi_single)) ){
							if ( has_post_thumbnail()) {
								echo '<figure>'.get_the_post_thumbnail().'</figure>';
							}
						}						
					?>
					<article>
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					</article>
					
					<?php comments_template(); ?>
				</div><!--/post-->

			</section><!--/content-->
			<aside id="sidebar">
				<?php get_sidebar(); ?>
			</aside><!--/sidebar-->
			<div class="clearfix"></div>
		</div><!--/wraper-->
<?php		
		if(get_theme_mod('multiple_select_setting_footer')):
			$footer_section = get_theme_mod('multiple_select_setting_footer');
		endif;
		
		if(isset($footer_section) && !empty($footer_section)):
			foreach($footer_section as $f):		
				if($id == $f):
					get_template_part('/inc/footer-section');
				endif;
			endforeach;
		endif;
		
		
 endwhile;	
?>
<?php get_footer(); ?>