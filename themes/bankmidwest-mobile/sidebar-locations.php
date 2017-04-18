<ul class="sidenav locations">

	<?php
	$args = array(
		'post_type' => 'location',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'tax_query' => array(
			array(
				'taxonomy' => 'location_types',
				'terms' => 'branch-office',
				'field' => 'slug'
			)
		)
	);

	$page_id = $wp_query->post->ID;

	$query = new WP_Query($args);

	while ( $query->have_posts() )
	{
		$query->the_post();

		global $post;
		$current_id = $post->ID;
		$classes = array();
		if (($page_id == $current_id) && ( !is_archive('location')))
		{
			$classes[] = "current_page_item";
		}
		echo sprintf(
			"<li class=\"%s\"><a href=\"%s\">%s</a></li>",
			implode(" ", $classes),
			get_permalink(),
			get_the_title()
		);

	}
	wp_reset_postdata();
	?>

</ul><!-- locations -->

<?php if(is_archive()) { ?>

	<ul class="cf location-categories">
		<?php
		$categories = get_terms(
			'location_types',
			array('hide-empty' => 0)
		);
		foreach ( $categories as $category )
		{
			// Default these guys to checked.
			?>

				<li class="<?php echo preg_replace("%[^a-zA-Z0-9]%", "_", $category->slug); ?>">
					<label>
						<input name="location_cats[]" id="lcat-<?php echo preg_replace("%[^a-zA-Z0-9]%", "_", $category->slug); ?>" value="<?php echo $category->term_id; ?>" type="checkbox" checked="checked" />
						<?php echo $category->name; ?>
					</label>
				</li>

			<?php
		}
		?>
	</ul><!-- location-categories -->

<?php  } else {} ?>

<div class="moneypass">
	<a href="http://moneypass.com/atm-locator.aspx">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/money-pass.png" alt="Money Pass"/>
		<h3>Find thousands of fee-free ATMs coast to coast</h3>
	</a>
</div>