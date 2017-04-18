<?php
global $post;
if(!in_the_loop())
{
	wp_die("This component must be invoked from within the Loop.");
}

$post_email = slt_cf_field_value("employee_email");
if(!empty($post_email))
{
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#emailLink").fancybox();
	});
	</script>
<div style="display: none;">
	<div class="content contactForm" id="contactForm">
		<!-- contact form start -->
		
		<form method="post" action="javascript:void(0);" id="frmContact">
			<input type="hidden" name="contact_id" value="<?php echo $post->ID; ?>" />
			<h1>Contact:&nbsp;<?php echo esc_html($post->post_title); ?></h1>
			<div id="ContactFormProfileCell">
				<div class="textWidgetContainer employee">
					<div class="title"><?php echo slt_cf_field_value('employee_title'); ?></div>
					<?php
					$v = slt_cf_field_value('employee_phone');
					if($v && !empty($v))
					{
						?>
					<div class="phone"><?php echo esc_html($v); ?></div>
						<?php
					}

					$v = slt_cf_field_value('employee_linkedin');
					if($v && !empty($v))
					{
						?>
						<?php
					}
					?>
				</div>
			</div>
			
			<ul>
				<li>
					<label for="ContactName">Your Name:</label>
					<input type="text" id="ContactName" name="contactname" />
				</li>
				<li>
					<label for="ContactEmail">Email:</label>
					<input type="text" id="ContactEmail" name="contactemail" />
				</li>
				<li>
					<label for="ContactPhone">Phone:</label>
					<input type="text" id="ContactPhone" name="contactphone" />
				</ul>
				<li>
					<label for="ContactMessage">Message:</label>
					<textarea id="ContactMessage" name="contactmessage"></textarea>
				</li>
			</ul>

			<?php
			/*
			<div id="captcha_widget">

				<div id="recaptcha_image"></div>
				<div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

				<div class="recaptcha_entry_container">
					<span class="recaptcha_only_if_image">Enter the words above:</span>
					<span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>

					<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
				</div>
				<div class="recpatcha_refresh_container">
					<div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
					<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
					<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>

					<div><a href="javascript:Recaptcha.showhelp()">Help</a></div>
				</div>
				<img id="captcha" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/inc/securimage/securimage_show.php" alt="CAPTCHA Image" />
				<div style="margin-bottom: 6px;">Please enter the above characters to submit:</div>
				<input type="text" name="captcha_code" size="10" maxlength="6" />
				<a href="#" onclick="document.getElementById('captcha').src = '<?php echo get_bloginfo('stylesheet_directory'); ?>/inc/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
			</div>
			*/
			?>

			<div class="contactBottom">
				<a id="ContactSend" href="javascript:void(0);">Send</a>
				<img id="ContactSpinner" src="<?php bloginfo('template_directory'); ?>/images/spinner.gif" />
				<span id="ContactStatus"></span>
			</div>
		</form>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#ContactSend").click(contactSend);
			});

			function contactSend()
			{
				jQuery("#ContactSpinner").css("display", "inline-block");
				var frm = jQuery("#frmContact");
				var frmdata = frm.serialize();

				jQuery.ajax({
					url: "<?php echo get_bloginfo('stylesheet_directory'); ?>/ws_contact_form.php",
					data: frmdata,
					dataType: "json",
					error: function(xhr, textStatus, errorStatus) {
						jQuery("#ContactSpinner").css("display", "none");
						jQuery("#ContactStatus").html("Error sending message. Please try again shortly.").addClass("errmsg");
					},
					success: function(data) {
						jQuery("#ContactSpinner").css("display", "none");
						var frm = jQuery("#frmContact");
						if(data.success)
						{
							jQuery("#ContactStatus").html("Message sent successfully!").removeClass("errmsg");
							jQuery("#ContactSend").addClass("disabled").unbind("click");
							setTimeout("parent.jQuery.fancybox.close();", 1500);
						}
						else
						{
							jQuery("#ContactStatus").html("Validation failed. Please correct the errors and submit again.").addClass("errmsg");
							frm.find("*").removeClass("error");
							var errs = "";
							for(var e in data.errors)
							{
								var el = frm.find("*[name='" + e + "']");
								el.addClass("error");
							}
						}
					}
				});
			}
		</script>

		<!-- contact form start -->
	</div>
</div>
	<?php
}
?>