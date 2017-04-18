</div><!-- #wrapper -->


<?php wp_footer(); ?>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/inc/scripts.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			// BEGIN offsite link notification
			var anchors = jQuery("a[href]");

			for(var i = 0; i < anchors.length; i++)
			{
				var a = jQuery(anchors[i]);
				if(a.hasClass('accordionButton')) {
					continue;
				}
				var $href = a.attr("href");
				if(
					<?php
					$urls = get_option("filter_domains");	// our option name is filter_domains
					if(empty($urls))
					{
						echo "false";
					}
					else
					{
						// Split on new line
						$urls_arr = explode("\n", $urls);
						$first = true;
						foreach($urls_arr as $url_val)
						{
							if(!$first)
							{
								echo " || ";
							}
							$first = false;
							?>
					$href.indexOf("<?php echo preg_replace("%[^a-zA-Z0-9:./@]%", "", $url_val); ?>") >= 0
							<?php
						}
					}
					?>
					|| (
						$href.indexOf("<?php echo get_bloginfo('url'); ?>") >= 0
						|| $href.indexOf("javascript") >= 0
						|| $href.indexOf("/") == 0
						|| $href.indexOf("#") == 0
						|| $href.indexOf("mailto:") == 0
					)
				)
				{
					// NOP
				}
				else
				{
					a.click(function(){
						alert("<?php echo preg_replace(
							"%[\"]%",
							"\\\1",
							//preg_replace(
								//"%[^a-zA-Z0-9 .?,!'\"-]%",
								//"",
								preg_replace("%[\n\r]%", "", str_replace("\n", "\\n", get_option("alert_text")))
								//)
							); ?>");
					});
				}
			}
			// END offsite link notification

		});
	</script>

	<?php
		if ( is_page( 8170 ) ) { ?>
			<script type="text/javascript">
				var cdCampaignKey = 'CMP-01228-M3G4R6';
			</script> <?php
		}
	?>

	<script type="text/javascript">
	  var cdJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
	  document.write(unescape("%3Cscript src='" + cdJsHost + "analytics.clickdimensions.com/ts.js' type='text/javascript'%3E%3C/script%3E"));
	</script>

	<script type="text/javascript">
	  var cdAnalytics = new clickdimensions.Analytics('analytics.clickdimensions.com');
	  cdAnalytics.setAccountKey('aQFJ5d8fu9Ui8XlIvqg0KQ');
	  cdAnalytics.setDomain('bankmidwest.com');
	  cdAnalytics.trackPage();
	</script>

</body>
</html>
