<?php

  
function add_resources_meta_boxes() {
   
   add_meta_box( 
        'Resource Library Meta',
        __( ' Resource Library Meta '),
        'resources_callback',
        'resource',
        'normal',
        'default'
    );

    





}
add_action( 'add_meta_boxes', 'add_resources_meta_boxes' );






function resources_callback() {
    global $post;  ?>
      <div class="metal-customFieldData">
        <div class="metal-section">
         <div class="file-upload">
             <input name="_fh_pdf" type="text" class="upload-target" data-upload-label="Upload Resume" placeholder="PDF, DOC, HTML, TXT" value="" />
             <a href="#" class="upload-button">Upload PDF</a>
        </div>

          <label>Attach PDF</label>
           <input type="text" name="_fh_button_text" placeholder="..." />
            <label>Alternate Button Text</label>
           
          
        </div>
      </div>
      <input type="hidden" name="customFieldData-postID" value="<?php echo $post->ID; ?>" />

      <?php
  }



