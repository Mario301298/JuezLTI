<?php

class JuezLTI_shortcode
{

    public function JuezLTI_shortcode_init()
    {
        function JuezLTI_shortcode($atts = [], $content = null)
        {
            if(!isset($atts['n_commits'])) $atts['n_commits'] = 5;

            $query = new WP_Query( array( 'post_type' => 'commit' , 'posts_per_page' => $atts['n_commits']) );
            ob_start();
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('JuezLTI', 'JuezLTI_shortcode');
    }

}