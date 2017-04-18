<?php
/* Blog sidebar template */
global $post;
?>

<a class="blogsubscribe" href="<?php bloginfo('rss2_url'); ?>?post_type=post" target="_blank">Subscribe to the blog feed<i></i></a>
<div class='sidebar-content' id='move-here'>
	<div class='sidebar-image-container'>
	<?php 
		$sidebarImageOne = slt_cf_field_value('sidebar_image_one', 'post', 257 );
		$sidebarImageOneLink = slt_cf_field_value('sidebar_image_one_link', 'post', 257 );
		echo "<a href=' $sidebarImageOneLink '>";
		echo wp_get_attachment_image( $sidebarImageOne, 'large' ); 
			echo "</a>";
	?>
	</div>
	<div class='sidebar-image-container'>
	<?php 
		$sidebarImageTwo = slt_cf_field_value('sidebar_image_two', 'post', 257 );
		$sidebarImageTwoLink = slt_cf_field_value('sidebar_image_two_link', 'post', 257 );
		echo "<a href=' $sidebarImageTwoLink '>";
		echo wp_get_attachment_image( $sidebarImageTwo, 'large' ); 
		echo "</a>";
	?>

	</div>
	<div id='drop-one'> 
	<select  name="event-dropdown" class='turnintodropdown' > 
	 <option value=""><?php echo esc_attr(__('Categories')); ?></option> 
	 <?php 
	  $categories = get_categories(); 
	  foreach ($categories as $category) {
	  	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
		$option .= $category->cat_name;
		$option .= ' ('.$category->category_count.')';
		$option .= '</option>';
		echo $option;
	  }
	 ?>
	</select>
	</div>
	<div id='drop-two'>

	<select  name="archive-dropdown" class='turnintodropdown' >
	  <option value=""><?php echo esc_attr( __( 'Archives' ) ); ?></option> 
	  <?php  wp_get_archives( array( 'type' => 'monthly', 'format' => 'option') );?>
	 
	</select>


	</div>


	

		         

	<?php $orig_post = $post;
	global $post;
	$categories = get_the_category($post->ID);
	if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
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

	<?php

	?>
	<li><div class="relatedthumb"><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php  //the_post_thumbnail( 'medium' );  ?></a></div>
	<div class="relatedcontent">
	<h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
	<?php the_time('M j, Y') ?>
	</div>
	</li>
	<?php
	}
	echo '</ul></div>';
	}
	}
	$post = $orig_post;
	wp_reset_query(); ?>
</div>
  <?php get_sidebar('bottom-links'); ?>


