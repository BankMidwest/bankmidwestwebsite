<?php
/* Events sidebar template */
?>


<div class="sidebar-content">
    <div class="sidebar-image-container image-center">
        <?php 
		$sidebarImageOne = slt_cf_field_value('sidebar_events_image_one', 'post', 320 );
		$sidebarImageOneLink = slt_cf_field_value('sidebar_events_image_one_link', 'post', 320 );
		echo "<a href=' $sidebarImageOneLink '>";
		echo wp_get_attachment_image( $sidebarImageOne, 'medium' ); 
			echo "</a>";
	   ?>
    </div>
    <div class="sidebar-image-container image-center">
        <?php 
		$sidebarImageTwo = slt_cf_field_value('sidebar_events_image_two', 'post', 320 );
		$sidebarImageTwoLink = slt_cf_field_value('sidebar_events_image_two_link', 'post', 320 );
		echo "<a href=' $sidebarImageTwoLink '>";
		echo wp_get_attachment_image( $sidebarImageTwo,'medium' ); 
		echo "</a>";
	    ?>
    </div>
    <div>
        <select name="event-dropdown" class="turnintodropdown" >
            <option value=""><?php echo esc_attr(__('Upcoming Events')); ?></option>
            <?php
             $args = array(
                'depth'        => 0,
                'post_type'    => 'event',
                'title_li'     => ''
            ); 
            $events = new WP_Query($args);
            while ($events->have_posts()) { $events->the_post(); 

                $end_date = preg_replace("/000$/", "", slt_cf_field_value("end_date"));
                $start_date = preg_replace("/000$/", "", slt_cf_field_value("event_date"));

                $eventTime = slt_cf_field_value('event_time'); 
                $eventDate = slt_cf_field_value('event_date');
                $endDate = slt_cf_field_value('end_date');

                $cur_date = time();
            ?>
                <?php if ($end_date < $cur_date) { 

                } else { ?>
                <option value="<?php echo the_permalink();?>"><?php the_title(); ?></option>
            <?php }
            }  wp_reset_postdata();  ?>
        </select>
    </div>
    <div>
        <select name="event-dropdown" class="turnintodropdown">
            <option value=""><?php echo esc_attr(__('Event Categories')); ?></option>
            <?php $args = array( 'taxonomy' => 'event_categories', 'title_li' => ''); ?>
            <?php $categories = get_categories($args)?>
            <?php
                foreach($categories as $category) {
                    $option = '<option value="/events/'.$category->category_nicename.'">';
                    $option .= $category->cat_name;
                    $option .= ' ('.$category->category_count.')';
                    $option .= '</option>';
                    echo $option;                    
                }
            ?>
        </select>
    </div>
</div>

<?php get_sidebar('bottom-links'); ?>
