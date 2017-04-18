<?php

	if($post->post_parent) {
		$ancestors = get_post_ancestors($post->ID);
		$root = count($ancestors) - 1;
		$parent = $ancestors[$root];
	} else {
		$parent = $post->ID;
	}
	
	$children = wp_list_pages("title_li=&child_of=" . $parent . "&echo=0"); ?>
	

<?php	if ($children) { ?>
		<ul class="sidenav">
			<?php echo $children; ?>
		</ul>

<?php get_sidebar('market-gadget') ?>

<?php get_sidebar('bottom-links'); ?>



<div class="side-links">

	<?php 

	if (is_page()) {

		$btn = slt_cf_field_value('sidebar_buttons'); 
	 	
	 	if ( !empty ($btn)) { echo do_shortcode($btn); }

		else { ?>

			<a class="btn" style="background: url(<?php echo $btn1Location[0]; ?>)" href="<?php $btn1Link= slt_cf_field_value('sidebar_btn1_link', 'post', '212'); if($btn1Link) { echo $btn1Link; } ?>">
				<?php $btn1Txt = slt_cf_field_value('sidebar_btn1_txt', 'post', '212'); if($btn1Txt) { echo $btn1Txt; } ?></a>

			<a class="btn" style="background: url(<?php echo $btn2Location[0]; ?>)" href="<?php $btn2Link= slt_cf_field_value('sidebar_btn1_link', 'post', '212'); if($btn2Link) { echo $btn2Link; } ?>">
				<?php $btn2Txt = slt_cf_field_value('sidebar_btn2_txt', 'post', '212'); if($btn1Txt) { echo $btn1Txt; } ?></a>

			<a class="btn" style="background: url(<?php echo $btn3Location[0]; ?>)" href="<?php $btn3Link= slt_cf_field_value('sidebar_btn3_link', 'post', '212'); if($btn3Link) { echo $btn3Link; } ?>">
				<?php $btn3Txt = slt_cf_field_value('sidebar_btn3_txt', 'post', '212'); if($btn3Txt) { echo $btn3Txt; } ?></a>
	<?php 

		} 

	}  

	$parent = $post->post_parent;
	$parentID = get_post_ancestors($post->ID);

		if (empty($parentID[1])) {
	
		} else if (($parent == 9) || ( $parentID[1] == 9 )) { ?>

			<a href="<?php echo get_permalink(823); ?>" class="btn news">Sign up for our weekly newsletter</a>

		<?php } ?>


</div>

<?php 

if (is_page()) {

	$f = slt_cf_field_value('crop_insurance_btn'); 
	$pageBtn = slt_cf_field_value('page_button', 'post', $f);

	if ( !empty ($f) ) {

		if ( !empty($pageBtn) ) { ?>
		
		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo $pageBtn; ?></a>

		<?php } else { ?>


		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo the_title(); ?></a>


		<?php }

	}

}

?>

	<?php } else { ?>
	

<?php 

if (is_page()) {

	$f = slt_cf_field_value('crop_insurance_btn'); 
	$pageBtn = slt_cf_field_value('page_button', 'post', $f);

	if ( !empty ($f) ) {
		
		if ( !empty($pageBtn) ) { ?>
		
		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo $pageBtn; ?></a>

		<?php } else { ?>


		<a class="sidebtn" href="<?php echo get_permalink($f); ?>"><?php echo the_title(); ?></a>


		<?php }

	} 

}  

} ?>

	           