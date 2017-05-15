<!-- footer -->
<div class="inner testingClass">
    <div class="inner-hm-content">
        <div id="footer">

            <div class="container">

                <div class="footer-left">
                    <?php $footer= slt_cf_field_value('footer_options'); ?>
                    <h2>Contact Us!</h2>
                    <p class="contact-info">Customer Support<br />
                        <?php if ( $footer == 'footer_invest' || $investFooter == true ) { ?>
                            <strong>Phone:</strong> 800.662.8756<br />
                            <strong>Monday-Friday:</strong> 7:30 a.m. - 4:30 p.m.<br />
                            <strong>Email:</strong> <a href="mailto:wealthmanagement@bankmidwest.com">wealthmanagement@bankmidwest.com</a>
                        <?php } else { ?>
                            <strong>Phone:</strong> 888.902.5662<br />
                            <strong>Monday-Friday:</strong> 7 a.m. - 7 p.m.<br />
                            <strong>Saturday:</strong> 8 a.m. - 12 p.m.<br />
                            <strong>Email:</strong> <a href="mailto:customersupport@bankmidwest.com">customersupport@bankmidwest.com</a>
                        <?php }?>
                    </p>
                    <div id="copyright">

                <?php 

                if ( $footer == 'footer_invest' || $investFooter == true ) { ?>

                    <p>IMPORTANT CONSUMER INFORMATION</p>
                    <p>
                    This site is for informational purposes only and is not intended to be a solicitation or offering of any security and:
                    </p><p>
                    Representatives of a Registered Broker-Dealer ("BD") or Registered Investment Advisor ("IA") may only conduct business in a state if the representatives and the BD or IA they represent (a) satisfy the qualification requirements of, and are approved to do business by, that state; or (b) are excluded or exempted from that state’s registration requirements.
                    </p><p>
                    Representatives of a BD or IA are deemed to conduct business in a state to the extent that they would provide individualized responses to investor inquiries that involve (a) effecting, or attempting to effect, transactions in securities; or (b) rendering personalized investment advice for compensation.
                    </p><p>
                    <!--<strong>We are registered to offer securities in the following states:</strong> Alabama, Arkansas, Arizona, California, Colorado, Florida, Georgia, Iowa, Illinois, Indiana, Kansas, Kentucky, Louisiana, Michigan, Minnesota, Mississippi, Missouri, Montana, Nebraska, New Mexico, North Carolina, North Dakota, Oklahoma, South Carolina, South Dakota, Tennessee, Texas, Washington, and
                    Wisconsin.
                    </p><p>
                    <strong>Fee-based advisory services are available only to residents of:</strong> Arizona, California, Illinois, Iowa, Kentucky, Minnesota, South Dakota, Texas, and Wisconsin.
                    </p>--><p>
                    <strong>We are licensed to sell insurance products in the following states of:</strong> Iowa, Minnesota, North Dakota, South Dakota, and Wisconsin. I acknowledge that I am a resident of one of the states listed above.
                    </p><p>
                    SII Investments, Inc.&reg; member <a href="http://www.finra.org/" target=“_blank" title="FINRA">FINRA</a>, <a href="http://www.sipc.org/" target=“_blank" title"SIP">SIPC</a> and a Registered Investment Advisor is not affiliated with Bank Midwest or Bank Midwest Wealth Management. Securities and advisory services offered through SII Investments Inc.&reg; are not insured by the FDIC or any other Federal Government Agency, not a deposit or other obligation of, or guaranteed by any bank or their affiliates, and are subject to risks including the possible loss of principal amount invested.</p>

                <?php }

                elseif ( $footer == 'footer_bank' ) { ?>

                <?php }

                else { ?>

                    <p>Securities and insurance products are not deposits, not FDIC insured, not insured by any federal government agency, not guaranteed by the bank, and may go down in value.</p>

                <?php } ?>

                <p>

                <?php

                if ($footer != 'footer_home'  && $footer != 'footer_invest' ) { ?>

                    <a href="/">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                <?php }

                if ($footer != 'footer_invest' ) { ?>

                    <a href="<?php echo get_permalink(529); ?>">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo get_permalink(532); ?>">Customer ID Policy</a>

                <?php }

                if (($footer == 'footer_home') || ($footer == 'footer_bank') || ($post->post_type=='news') || ($post->post_type=='post')) { ?>

                    &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo get_permalink(535); ?>">Equal Housing Lender Disclosure</a>

                <?php }

                if ( $footer == 'footer_invest') { ?>

                    <a href="https://www.siionline.com/public/forms/sii_madv6130a.pdf">SII Privacy Policy</a></br></br></br>

                <?php } 


                ?>

                </p>

                    <p>
                    <?php if ( $footer == 'footer_invest' ) { ?>

                    <a href="/">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                <?php }
                ?>
                    Copyright &copy;<?php echo date('Y'); ?> Bank Midwest  |  All Rights Reserved.<br />

                <?php

                if (($footer == 'footer_home') || ($footer == 'footer_bank') || ($post->post_type=='news') || ($post->post_type=='post')) { ?>
                <?php   if ($footer != 'footer_insure') { ?>
                    Member FDIC  | <img src="<?php bloginfo('stylesheet_directory'); ?>/images/house.png" width="21" height="18" /> Equal Housing Lender

                <?php  }
                        }
                

                        


                ?>

                    </p>

                </div><!-- copyright -->


                    <!--<div id="hippo">
                        <div class="left"><a href="http://www.flyinghippo.com" target="_blank">Iowa Web Design</a></div>
                        <div class="middle"><a href="http://www.flyinghippo.com" target="_blank"><span>Flying Hippo Web Technologies</span></a></div>
                        <div class="right"><a href="http://www.flyinghippo.com" target="_blank">by Flying Hippo</a></div>
                    </div><!--.hippo-->

                    </div><!--.footer-left-->

                <div id="social" class="<?php echo $footer; ?>" >

                    <?php if ( $footer != 'footer_invest' || $investFooter != true ) { ?>

                        <a href="https://www.moneypass.com/atm-locator.html">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/moneypass.png" />
                        </a>
                        <?php
                        $url = "";
                        $iPadPos = strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' );
                        if ( $iPadPos !== false ) {
                            $url = "https://itunes.apple.com/us/app/bank-midwest-for-ipad/id1226522293?mt=8";
                        } else {
                            $url = "https://itunes.apple.com/us/app/bank-midwest/id1226510695?mt=8";
                        }
                        ?>
                        <a href="<?php echo $url; ?>">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/appstore-apple.png" />
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.malauzai.DH16163">
                            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/homepage/appstore-google.png" />
                        </a>

                    <?php } ?>

                    <ul class="connect-icons">


                        <?php
                        if ( $footer == 'footer_invest') { ?>
                            <li></li>
                        <?php } else { ?>
                            <li id="social-facebook"><a href="https://www.facebook.com/BankMidwest" target="_blank"><span>Facebook</span></a></li>
                            <li id="social-twitter"><a href="https://twitter.com/bankmidwest" target="_blank"><span>Twitter</span></a></li>
                            <li id="social-linkedin">
                                <a href="https://www.linkedin.com/company/2444559?trk=tyah&trkInfo=tarId%3A1412695809903%2Ctas%3Abank%20midwest%2C%20one%20place%2Cidx%3A1-1-1" target="_blank" title="LinkedIn">
                                    <span>LinkedIn</span>
                                </a>
                            </li>
                            <!--<li id="social-email"><a href="<?php echo get_permalink(823); ?>" title="Sign up for our Weekly Market Update"><span>Newsletter</span></a></li>
                            <li id="social-rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><span>RSS</span></a></li>-->
                        <?php } ?>
                        <?php if( is_front_page() ) { ?>

                        <?php } ?>
                    </ul>
                </div><!--#social-->

                <div class="dozer"></div><!--.dozer-->

            </div><!-- .container -->

        </div><!-- #footer -->

        </div><!--inner-hm-content-->
    </div><!--.inner-->
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
                    $urls = get_option("filter_domains");   // our option name is filter_domains
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
                        alert( "<?php echo preg_replace(
                            '%[\"]%',
                            "\\\1",
                                preg_replace( "%[\n\r]%", "", str_replace( "\n", "\\n", get_option( "alert_text" ) ) )
                            ); ?>");
                    });
                }
            }
            // END offsite link notification
        });
    </script>

<?php
if (is_page('search')) { ?>
<script type="text/javascript">
  function parseQueryFromUrl () {
    var queryParamName = "q";
    var search = window.location.search.substr(1);
    var parts = search.split('&');
    for (var i = 0; i < parts.length; i++) {
      var keyvaluepair = parts[i].split('=');
      if (decodeURIComponent(keyvaluepair[0]) == queryParamName) {
        return decodeURIComponent(keyvaluepair[1].replace(/\+/g, ' '));
      }
    }
    return '';
  }
  google.load('search', '1', {language : 'en'});
  google.setOnLoadCallback(function() {
    // NOTE: The ID in the next line must be updated to use the ID for the client's account (which should match the ID in header.php's search code)
    var customSearchControl = new google.search.CustomSearchControl('003074495176662961374:n2v17u_bwoi');
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.enableSearchResultsOnly();
    customSearchControl.draw('cse', options);
    var queryFromUrl = parseQueryFromUrl();
    if (queryFromUrl) {
      customSearchControl.execute(queryFromUrl);
    }
  }, true);
</script>
<?php } ?>

<?php
if ( is_page( 8170 ) ) 
{
?>

    <script type="text/javascript">
        var cdCampaignKey = 'CMP-01228-M3G4R6';
    </script>

<?php
}

global $post;

$fullPages = getPageTemplateId( 'template-no-sidebar' );

if( !in_array( $post->ID, $fullPages ) )
{
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

<?php
}
?>

</body>
</html>
<!-- END footer.php -->
