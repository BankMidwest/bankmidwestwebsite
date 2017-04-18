<?php
global $wpdb;
global $post;

$alerts_query = new WP_Query( array( 'post_type' => 'fhalerts', 'posts_per_page' => 1, 'post_status' => 'publish' ) );
$dismissed    = false;

if( $alerts_query->have_posts() )
{
    while( $alerts_query->have_posts() )
    {
        $alerts_query->the_post();

        if( isset( $_COOKIE[ 'fhalert_' . $post->ID ] ) )
        {
            $dismissed = $_COOKIE[ 'fhalert_' . $post->ID ];
        }

        if( !$dismissed )
        {
?>

            <section class="fhalerts" id="fhalerts">
                <section class="fhalerts-int">
                    <div class="fhalert-text">
                        <h4><?php the_title(); ?></h4>

                        <?php the_content(); ?>
                    </div>
                    <div class="cf"></div>
                    <a href="#" class="fhdismiss-alert" data-id="<?php echo $post->ID; ?>"></a>
                </section>
            </section>

<?php
        }
    }
}

wp_reset_postdata();
?>