<?php

$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
  // check for a template type
  if ($template_file == 'page-modular.php') {
    
   echo 'foo';




function addTeamMemberMetaBox()
{
    add_meta_box( 'teamMembers', 'Independent Landing Options', 'add_team_member_metaboxes', 'page', 'normal', 'high' );
    add_meta_box( 'teamMembers2', 'Sidebar Ads Options', 'add_ads_metaboxes', 'page', 'normal', 'high' );
}

add_action( 'add_meta_boxes', 'addTeamMemberMetaBox' );

function add_team_member_metaboxes( $post ) 
{
?>

    <div class="metal-customFieldData">
        <div class="metal-section">
           
            
         <!--    <div class="single-image third">
                <div class="single-image-thumbnail">
                </div> 

                <div class="single-image-controls">
                    <a href="#" class="add-image"></a>
                    <a href="#" class="remove-image"></a>
                </div>

                <input type="hidden" class="image-thumbnail-value" name="_fh_banner_overlay" />
            </div> -->
            </br>
            <input type="text" name="_fh_contact_us_link" placeholder="/link" />
            <label>Contact us Link</label>
           
<div class='col third'>
            <div class="single-image">
              <div class="single-image-thumbnail">
              </div> 

              <div class="single-image-controls">
                  <a href="#" class="add-image"></a>
                  <a href="#" class="remove-image"></a>
              </div>

              <input type="hidden" class="image-thumbnail-value" name="_contact_alternate" />
          </div>

</div>
<div class='clear'></div>
<div class='col-third'>
            <label> Check to Show Blog </label>
            <input type="checkbox" name="_fh_hide_blog" value='1' />
             <label> Check to Show News </label>
            <input type="checkbox" name="_fh_hide_news" value='1' />
             <label> Check to Show Events </label>
            <input type="checkbox" name="_fh_hide_events" value='1' />
       </div>
        </div>
    </div>

    <input type="hidden" name="customFieldData-postID" value="<?php echo $post->ID; ?>" />

<?php
}
function add_ads_metaboxes( $post ) 
{
?>

    <div class="metal-customFieldData">
        <div class="metal-section">
           
            
         <!--    <div class="single-image third">
                <div class="single-image-thumbnail">
                </div> 

                <div class="single-image-controls">
                    <a href="#" class="add-image"></a>
                    <a href="#" class="remove-image"></a>
                </div>

                <input type="hidden" class="image-thumbnail-value" name="_fh_banner_overlay" />
            </div> -->
            </br>
          <div class='col third'>


            <div class="single-image">
              <div class="single-image-thumbnail">
              </div> 

              <div class="single-image-controls">
                  <a href="#" class="add-image"></a>
                  <a href="#" class="remove-image"></a>
              </div>

              <input type="hidden" class="image-thumbnail-value" name="_ad_one" />
          </div>
          <input type="text" name="_fh_ad_one_link" placeholder="/link" />
            <label>Ad One Link</label>
</div>
<div class='clear'></div>
<div class='col third'>

            <div class="single-image">
              <div class="single-image-thumbnail">
              </div> 

              <div class="single-image-controls">
                  <a href="#" class="add-image"></a>
                  <a href="#" class="remove-image"></a>
              </div>

              <input type="hidden" class="image-thumbnail-value" name="_ad_two" />
          </div>
        <input type="text" name="_fh_ad_two_link" placeholder="/link" />
            <label>Ad Two Link</label>
         </div>   
       <div class='clear'></div>
        </div>
    </div>

    <input type="hidden" name="customFieldData-postID" value="<?php echo $post->ID; ?>" />

<?php
}

  }