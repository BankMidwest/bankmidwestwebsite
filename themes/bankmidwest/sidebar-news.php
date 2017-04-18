<?php
/* News sidebar template */
global $post;
?>
<a class="blogsubscribe" href="/news/rss" target="_blank">Subscribe to the news feed<i></i></a>

<div class='sidebar-content'>
	<div class='sidebar-image-container'>
	<?php 
		$sidebarImageOne = slt_cf_field_value('sidebar_news_image_one', 'post', 311 );
		$sidebarImageOneLink = slt_cf_field_value('sidebar_news_image_one_link', 'post', 311 );
		echo "<a href=' $sidebarImageOneLink '>";
		echo wp_get_attachment_image( $sidebarImageOne, 'medium' ); 
			echo "</a>";
	?>
	</div>
	<div class='sidebar-image-container'>
	<?php 
		$sidebarImageTwo = slt_cf_field_value('sidebar_news_image_two', 'post', 311 );
		$sidebarImageTwoLink = slt_cf_field_value('sidebar_news_image_two_link', 'post', 311 );
		echo "<a href=' $sidebarImageTwoLink '>";
		echo wp_get_attachment_image( $sidebarImageTwo,'medium' ); 
		echo "</a>";
	?>

	</div>
	<div > 
	<select name="event-dropdown" class='turnintodropdown' > 
	 <option value=""><?php echo esc_attr(__('Categories')); ?></option> 
	 <?php 
      $args = array( 
			'taxonomy' => 'news_categories',
			'title_li'     => '');
      $categories = get_categories( $args );
      foreach ($categories as $category) {
          $option = '<option value="/news_categories/'.$category->category_nicename.'">';
          $option .= $category->cat_name;
          $option .= ' ('.$category->category_count.')';
          $option .= '</option>';
          echo $option;
      }
	 ?>        
	</select>

	</div>
	<div>

	<select name="archive-dropdown" class='turnintodropdown' >
	  <option value=""><?php echo esc_attr( __( 'Archives' ) ); ?></option> 
	  <?php  wp_get_archives( array( 'post_type'  => 'news','type' => 'monthly', 'format' => 'option', 'limit' => 24) );?>
	 
	</select>


	</div>


	<?php
	/*
	if ( !dynamic_sidebar('blog-sidebar') ) : ?>
		<div class="widget">
			<div class="widget-title">Archives</div>
			<?php wp_get_archives('type=monthly&limit=5&show_post_count=true'); ?>
		</div><!-- .widget -->
		<div class="widget">
			<div class="widget-title">Recent Posts</div>
			<?php wp_get_archives('type=postbypost&limit=5'); ?>
		</div><!-- .widget -->

	 endif; */
	?>


		         

	<?php $orig_post = $post;
	global $post;

	$categories = get_the_category($post->ID);
	if ($categories) 
		{
		$category_ids = array();
		foreach($categories as $individual_category) 
			{ 
				$category_ids[] = $individual_category->term_id;
			}
		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 2, // Number of related posts that will be shown.
			'caller_get_posts'=>1
		);
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
		echo '<div id="related_posts"><h3>Related Posts</h3><ul>';
				while( $my_query->have_posts() ) {
					$my_query->the_post();?>

					
					<li><div class="relatedthumb"><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php  the_post_thumbnail( 'medium' );  ?></a></div>
					<div class="relatedcontent">
					<h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<?php the_time('M j, Y'); ?>
					</div>
					</li>
					<?php
				} // end while have posts
				echo '</ul></div>';
		} // end if have posts
	}  // end if categories

	$post = $orig_post;
	wp_reset_query(); ?>
</div>
  <?php get_sidebar('bottom-links'); ?>