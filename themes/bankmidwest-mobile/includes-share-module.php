<?php 
    // on single pages
?>
<div id='share-module'>
    <ul>
        <li>
            <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button">
            </div>
        </li>
        <li>
            <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
            <script type="IN/Share"></script>
        </li>
        <li class='mailto'>
            <?php
                $title = get_the_title();
                $url = get_permalink();
                $f_title = str_replace(' ', '%20', $title);
            ?>
            <a href="mailto:?subject=Bank%20Midwest-%20<?php echo $f_title;?>&body=I%20wanted%20to%20show%20you%20this%20page%20<?php echo $url;?>">
                <span>
                    Share
                </span>
            </a>
        </li>                            
    </ul>                                    
</div>
