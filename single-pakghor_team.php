<?php
// Single Team Template
get_header(); 
    $_pakghor_team_page_options = $pakghor_team_designation = $pakghor_team_social = $pakghor_team_social = $pakghor_team_info = '';
    if( function_exists('cs_get_option') ){
        $_pakghor_team_page_options = get_post_meta( get_the_ID(), '_pakghor_team_page_options', true );
        $pakghor_team_designation   = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_designation'] : '';
        $pakghor_team_social        = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_social'] : '';
        $pakghor_team_info         = isset( $_pakghor_team_page_options['pakghor_team_info'] ) ? $_pakghor_team_page_options['pakghor_team_info'] : '';
    }
?>
        <section class="bg-single-team">
            <div class="container">
                <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="single-team">
                        <div class="row">
                            <?php if( has_post_thumbnail() ) : ?>
                            <div class="col-md-6">
                                <div class="single-team-img">
                                    <?php the_post_thumbnail() ?>
                                </div>
                                <!-- .single-team-img -->
                            </div>
                            <?php endif; ?>
                            <!-- .col-md-6 -->
                            <div class="col-md-6">
                                <div class="single-team-details">
                                    <h3><?php the_title(); ?></h3>
                                    <?php if( !empty($pakghor_team_designation) ) : ?>
                                    <h5><?php echo esc_html($pakghor_team_designation); ?></h5>
                                    <?php endif; ?>
                                    <?php the_content(); ?>
                                    <?php if( !empty($pakghor_team_social) ) : ?>
                                    <ul class="social-icon-rounded">
                                        <?php foreach ($pakghor_team_social as $pakghor_team_social_single ) : ?>
                                        <li><a href="<?php echo esc_url($pakghor_team_social_single['pakghor_social_link']) ?>"><i class="<?php echo esc_attr($pakghor_team_social_single['pakghor_social_icon'] ); ?>"></i></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                    
                                    <?php if( !empty($pakghor_team_info) ) : ?>
                                    <div class="team-address-box">
                                        <ul class="address">
                                            <?php foreach ($pakghor_team_info as $pakghor_team_info_single ) : ?>
                                            <li>
                                                <i class="<?php echo esc_attr($pakghor_team_info_single['pakghor_team_info_icon']) ?>" aria-hidden="true"></i>
                                                <span><?php echo esc_html($pakghor_team_info_single['pakghor_team_info_details']); ?></span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <!-- .team-address-box -->
                                    <?php endif; ?>
                                </div>
                                <!-- .single-team-content -->
                            </div>
                            <!-- .col-md-6 -->
                        </div>
                        <!-- .row -->
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                    <!-- .single-team -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </section>
<?php get_footer();