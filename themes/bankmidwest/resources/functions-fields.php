<?php
/**
 * Sample custom fields.
 * This was taken from West Des Moines Community Schools, but contains examples of nearly every kind of field so it can be used as a reference.
 */

if(function_exists('slt_cf_register_box'))
{
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_homepage_district',
		'title' => 'District Tab',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'district_content_title',
				'label' => 'Content Box Title',
				'description' => 'Title for the gray content box in the District tab.',
				'scope' => array('posts' => array(10)),
				'type' => 'text'
			),
			array(
				'name' => 'district_content_body',
				'label' => 'Content Box Text',
				'scope' => array('posts' => array(10)),
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array('textarea_rows' => 5)
			),
			array(
				'name' => 'district_content_link',
				'label' => 'Content Box Link',
				'description' => 'The URL for the "Learn More" text at the bottom of the content box. (Ideally this should link to the District landing page.',
				'scope' => array('posts' => array(10)),
				'type' => 'text'
			)
		)
	));
	
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_homepage_students',
		'title' => 'Students Tab',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'students_show_notice',
				'label' => 'Show Notice',
				'scope' => array('posts' => array(10)),
				'label_layout' => 'inline',
				'type' => 'checkbox'
			),
			array(
				'name' => 'students_notice_title',
				'label' => 'Notice Title',
				'scope' => array('posts' => array(10)),
				'label_layout' => 'inline',
				'type' => 'text'
			),
			array(
				'name' => 'students_notice_text',
				'label' => 'Notice Text',
				'scope' => array('posts' => array(10)),
				'description' => '10-20 words maximum.',
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array('textarea_rows' => 3)
			),
			array(
				'name' => 'students_feature_graphic',
				'label' => 'Featured Story Graphic',
				'scope' => array('posts' => array(10)),
				'description' => 'Image file to use for the featured story.',
				'type' => 'file'
			),
			array(
				'name' => 'students_feature_graphic_offset',
				'label' => 'Featured Story Graphic - Right Offset',
				'scope' => array('posts' => array(10)),
				'description' => 'The right margin (in pixels) for this graphic, used to pull it outside the boundaries of the box. Should generally be negative. For example, a value of "-15" will shift the image 15 pixels to the right.',
				'type' => 'text'
			)
		)
	));

	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_sidebar_box_1',
		'title' => 'Sidebar Box 1',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'sidebar_box_1_title',
				'label' => 'Title',
				'scope' => array('page', 'school', 'except_posts' => array(10, 24, 26, 66, 472, 473, 474, 475, 476, 477, 478, 479, 480, 481, 482, 486)),
				'hide_label' => true,
				'type' => 'text'
			),
			array(
				'name' => 'sidebar_box_1_body',
				'label' => 'Content',
				'scope' => array('page', 'school', 'except_posts' => array(10, 24, 26, 66, 472, 473, 474, 475, 476, 477, 478, 479, 480, 481, 482, 486)),
				'hide_label' => true,
				'type' => 'wysiwyg',
				'wysiwyg_settings' => array('textarea_rows' => 5)
			),
			array(
				'name' => 'sidebar_box_1_format',
				'label' => 'Format',
				'scope' => array('page', 'school', 'except_posts' => array(10, 24, 26, 66, 472, 473, 474, 475, 476, 477, 478, 479, 480, 481, 482, 486)),
				'type' => 'select',
				'options' => array(
					'Normal' => 'normal',
					'Shaded' => 'shaded'
					),
				'label_layout' => 'inline'
			)
		)
	));
	
	slt_cf_register_box(array(
		'type' => 'post',		// either "post" or "user"
		'id' => 'sltcf_homepage_alert',
		'title' => 'Emergency Alert',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'show_alert',
				'label' => 'Show Alert',
				'description' => 'Whether or not to show an alert on the homepage.',
				'scope' => array('posts' => array(10)),
				'type' => 'checkbox'
			),
			array(
				'name' => 'alert_type',
				'label' => 'Alert Type',
				'scope' => array('posts' => array(10)),
				'type' => 'radio',
				'description' => 'Which graphical style to use for the alert. Usually it will be weather, but a general style is available in case of non-weather-related emergencies.',
				'options' => array('Weather Alert' => 'weather', 'General Alert' => 'general'),
				'default' => 'weather'
			),
			array(
				'name' => 'alert_text',
				'label' => 'Alert Text',
				'description' => 'Brief description (8-12 words) to accompany the alert.',
				'scope' => array('posts' => array(10)),
				'type' => 'text'
			),
			array(
				'name' => 'alert_url',
				'label' => 'Alert URL',
				'description' => 'If there is a news post or announcement related to this alert, enter the URL here and the alert will be made clickable.',
				'scope' => array('posts' => array(10)),
				'type' => 'text'
			)
		)
	));
	
}
else
{
	do_action('fh_plugin_dependency_error', 'staff', "Developer's Custom Fields 0.7+");
}