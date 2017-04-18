<?php

// This plugin is CPW-aware, and provides the opportunity for extension through the CPW plugin.

// BEGIN Enumerators


// We expect SLT Developer's Custom Fields plugin!
add_action('init', 'testimonial_widget_init');

// Widget (default) -- can be manually invoked via CPW plugin as well.
class TestimonialWidget extends WP_Widget
{
	function __construct()
	{
		parent::__construct(false, $name = 'Testimonial Widget');
	}

	function TestimonialWidget()
	{
		if(function_exists('slt_cf_field_value'))
		{
			parent::WP_Widget(false, $name = 'Testimonial Widget');
		}
	}

	function widget($args, $instance)
	{
		extract($args);
		// the default implementation offers no options.
		$posts = fhcpw_enumerator_testimonial_default();
		
		echo $before_widget;
		echo fhcpw_renderer_testimonial_default($posts);
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		// Tweaks would go here
		return $instance;
	}

	function form($instance)
	{
	}
}
add_action('widgets_init', create_function('', 'return register_widget("TestimonialWidget");'));		

function testimonial_widget_init()
{
	function fhcpw_enumerator_testimonial_default_register($enumeratorList)
	{
		$enumeratorList[] = array(
			'Name' => 'Default Testimonial Behavior',
			'Method' => 'fhcpw_enumerator_testimonial_default',
			'Type' => 'Testimonials'
		);
		$enumeratorList[] = array(
			'Name' => 'Double Testimonial Behavior',
			'Method' => 'fhcpw_enumerator_testimonial_double',
			'Type' => 'Testimonials'
		);
		return $enumeratorList;
	}
	add_filter('fhcpw_enumerators', 'fhcpw_enumerator_testimonial_default_register');

	// Double functionality is subject to override by the defaults
	function fhcpw_enumerator_testimonial_double($args = array())
	{
		$args['count'] = 2;
		return fhcpw_enumerator_testimonial_default($args);
	}
	
	// This default renderer will pull a single random testimonial.  Through various post-level settings, though,
	// this default behavior can be overridden in various ways.
	function fhcpw_enumerator_testimonial_default($args = array())
	{
		if(!is_null($args) && is_array($args))
		{
			extract($args);
		}
		if($id)
		{
			return get_post($id);
		}
		if(is_null($count))
		{
			$count = 1;
		}
		global $post;	// post-aware
		if(!$post)
		{
			return array();
		}
		$inherit = slt_cf_field_value('testimonial_inherit', 'post', $post->ID);
		$ignore = slt_cf_field_value('testimonial_negate', 'post', $post->ID);
		$override = slt_cf_field_value('testimonial_override', 'post', $post->ID);

		if($ignore)
		{
			return array();		// Do nothing.  We'll repeat this check on renderer as well.
		}
		else if($override)
		{
			$p = get_post($override);
			if($p && $p->post_status == "publish")
			{
				return array($p);
			}
			return array();
		}
		else if($inherit)
		{
			// Walk up the hierarchy until we find an override.
			$parent = $post->post_parent;
			while($parent)
			{
				$p = get_post($parent);

				$ignore = slt_cf_field_value('testimonial_negate', 'post', $p->ID);
				$override = slt_cf_field_value('testimonial_override', 'post', $p->ID);

				if($ignore)
				{
					return array();		// Do nothing.  We'll repeat this check on renderer as well.
				}
				else if($override)
				{
					$p = get_post($override);
					if($p && $p->post_status == "publish")
					{
						return array($p);
					}
					return array();
				}

				$parent = $p->post_parent;
			}
		}
		if(!$tQuery)
		{
			$tQuery = new WP_Query(array(
				'post_type' => 'testimonial',
				'posts_per_page' => $count,
				'orderby' => 'rand'
			));
		}
		return $tQuery->posts;
	}

	// END Enumerators

	// BEGIN Renderers
	function fhcpw_renderer_testimonial_default_register($rendererList)
	{
		$rendererList[] = array(
			'Name' => 'Default Testimonial Behavior',
			'Method' => 'fhcpw_renderer_testimonial_default',
			'Type' => 'Testimonials'
		);
		return $rendererList;
	}
	add_filter('fhcpw_renderers', 'fhcpw_renderer_testimonial_default_register');

	function fhcpw_renderer_testimonial_default($testimonials = array(), $args = null)
	{
		// Ideal for 1 or more testimonials
		global $post;
		$oldPost = $post;

		$ignore = slt_cf_field_value('testimonial_negate', 'post', $post->ID);
		if($ignore)
		{
			return "";	// shouldn't make it here, but just in case.
		}

		$retVal = "";

		foreach($testimonials as $post)
		{
			setup_postdata($post);
			$retVal .= '<div class="testimonial">';
			$retVal .= "<div class='leftquote'></div>";
			$retVal .= sprintf("<div class='testimony'>%s", get_the_content());
			$retVal .= "<div class='rightquote'></div>";
			$segs = array();
			foreach(array("attribution", "attribution_location") as $f)
			{
				$fv = slt_cf_field_value($f);
				if(!empty($fv))
				{
					$segs[$f] = $fv;
				}
			}
			$retVal .= sprintf("<div class=\"attribution\">%s</div></div>", esc_html(implode(", ", $segs)));
			$retVal .= sprintf("<div class='thumbnail'>%s</div>", get_the_post_thumbnail($post->ID, 'testimony-thumb'));
			$retVal .= "</div>";
		}
		$post = $oldPost;
		wp_reset_postdata();

		return $retVal;
	}
	// END Renderers
}

?>
