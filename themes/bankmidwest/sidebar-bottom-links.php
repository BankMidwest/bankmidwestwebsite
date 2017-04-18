<?php // <a class="livechat" href="#">Live Chat</a> ?>
<?php
$parent = array_reverse(get_post_ancestors($post->ID));
		$first_parent = get_page($parent[0]);
		$newID = $first_parent->ID;
		$parentTemp = get_page_template_slug( $first_parent );
if ($parentTemp == 'page-modular.php') {	
		//echo $post->ID;
		$args = array(
		'page_id' => $newID

		);
	
		// The Query
		$the_parent = new WP_Query(  $args   );
		// The Loop
		if ( $the_parent->have_posts() ) {
       			while( $the_parent->have_posts() ) {
             		$the_parent->the_post();
			$postmeta = metalPostMeta( $post );

			//the link for the main image
			$link = $postmeta->contact_us_link;
			$temp = wp_get_attachment_image_src($postmeta->_contact_alternate, medium);
			$moFeaturedImage = $temp[0];

			// Ad one
			$link_ad_one = $postmeta->ad_one_link;
			$temp = wp_get_attachment_image_src($postmeta->_ad_one, medium);
			$adOneImage = $temp[0];

			// Ad one
			$link_ad_two = $postmeta->ad_two_link;
			$temp = wp_get_attachment_image_src($postmeta->_ad_two, medium);
			$adTwoImage = $temp[0];


		//print_r($temp);
		?>
		<a class="contact-alternate" rel="group" href="<?php echo $link; ?>"><img class="contact-alternate" src='<?php echo $moFeaturedImage; ?>' alt="" /></a> 
		<a class="contact-alternate" rel="group" href="<?php echo $link_ad_one; ?>"><img class="contact-alternate" src='<?php echo $adOneImage; ?>' alt="" /></a> 
		<a class="contact-alternate" rel="group" href="<?php echo $link_ad_two; ?>"><img class="contact-alternate" src='<?php echo $adTwoImage; ?>' alt="" /></a> 
	<?php

		}
	}
?>
<!-- <a class="contact-alternate" href="<?php echo $link; ?> style='background-image:url(<?php echo $moFeaturedImage ?>)"><img  src='<?php echo $moFeaturedImage; ?>' alt="" />Contact Us</a> -->

<?php
}
else
{
?>
<a class="contact" href="<?php echo get_permalink(299); ?>">Contact Us</a>
<?php 
}
?>