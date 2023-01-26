<?php
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Team_Member extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'Pakghor_Team_Member_Widget', esc_html__( 'Pakghor :: Team Member', 'pakghor' ), array('description'	=> esc_html__('Add Team Member Widget','pakghor')) );
    }

    public function widget($args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];

        $_pakghor_team_page_options = $pakghor_team_designation = $pakghor_team_social = '';

                        $categories = explode(',', $instance['category'] );

                        if( !empty($instance['category']) ) {
                            $pakghor_team_member_post_query  = new WP_Query( array(

                                    'post_type'         => 'pakghor_team',
                                    'post_status'       => 'publish',
                                    'posts_per_page'    => $instance['post_count'],
                                    'order'             => $instance['order'],
                                    'orderby'           => $instance['orderby'],
                                    'ignore_sticky_post'   =>  true,
                                    'tax_query'         => array(
                                            array(
                                                'taxonomy'  => 'team-category',
                                                'field'     => 'slug',
                                                'terms'     => $categories,
                                            ),

                                        ),
                                    ) 
                                );
                        }else{

                            $pakghor_team_member_post_query  = new WP_Query( array(
                                'post_type'         => 'pakghor_team',
                                'post_status'       => 'publish',
                                'posts_per_page'    => $instance['post_count'],
                                'order'             => $instance['order'],
                                'orderby'           => $instance['orderby'],
                                'ignore_sticky_post'   =>  true,
                                ) 
                            );
                        }
?>
                <div class="widget-content">
                    <ul class="team-widget">
<?php
                    if( $pakghor_team_member_post_query -> have_posts() ) :
                        while ( $pakghor_team_member_post_query -> have_posts() ) : $pakghor_team_member_post_query -> the_post(); 

                            if( function_exists('cs_get_option') ){
                                $_pakghor_team_page_options = get_post_meta( get_the_ID(), '_pakghor_team_page_options', true );
                                $pakghor_team_designation   = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_designation'] : '';
                                $pakghor_team_social        = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_social'] : '';
                            }

                    ?>
                
                        <li class="team-widget-item">
                            <?php if( has_post_thumbnail() ) : ?>
                            <div class="cooker-img">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a> 
                            </div>
                            <?php endif; ?>
                            <div class="team-widget-content">
                                <div class="cooker-details">
                                    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                    <?php if( !empty($pakghor_team_designation) ) : ?>
                                    <span><?php echo esc_html($pakghor_team_designation); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if( $pakghor_team_social ): ?>
                                <div class="social-profiles">
                                    <ul>
                                        <?php foreach ($pakghor_team_social as $pakghor_team_social_single ) : ?>
                                        <li><a href="<?php echo esc_url($pakghor_team_social_single['pakghor_social_link']) ?>"><i class="<?php echo esc_attr($pakghor_team_social_single['pakghor_social_icon'] ); ?>"></i></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div><!-- social icon -->
                            <?php endif; ?>
                            </div><!-- team-widget-content -->
                        </li><!-- team-widget-item -->
                
        <?php   endwhile; wp_reset_postdata(); 
            endif; ?>

                    </ul><!-- w-catagory -->
                </div><!-- widget-content -->
<?php
        echo wp_kses_post($args['after_widget']); 
    }

      function get_options(){
            return array(

                array(
                    'id'        => 'title',
                    'type'      => 'text',
                    'title'     => esc_html__('Title','pakghor'),
                    'default'   => esc_html__('Meet Cook Team', 'pakghor'),
                ),
                array(
                    'id'            => 'post_count',
                    'type'          => 'text',
                    'title'         => esc_html__( 'Member Count', 'pakghor' ),
                    'default'       => 4,
                    'desc'          => esc_html__( 'How many Members want to display? Default is 4', 'pakghor' ),
                ),
                array(
                    'id'            => 'category',
                    'type'          => 'text',
                    'title'         => esc_html__('Filter by Category slug:', 'pakghor'),
                    'desc'          => esc_html__('To filter by Team Category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events', 'pakghor' ),
                ),
                array(
                    'id'        => 'order',
                    'type'      => 'select',
                    'title'     =>  esc_html__('Team Order', 'pakghor' ),
                    'options'   => array(
                        'DESC'      => esc_html__( 'DESC','pakghor'),
                        'ASC'       => esc_html__( 'ASC', 'pakghor' ),
                    ),
                    'default'   => 'DESC',
                ),
                array(
                    'id'            => 'orderby',
                    'type'          => 'select',
                    'title'         => esc_html__( 'Team Order By', 'pakghor' ),
                    'options'       => array(
                        ''              => esc_html__( 'Select Team Order by','pakghor' ),
                        'date'          => esc_html__( 'Date', 'pakghor' ),
                        'name'          => esc_html__( 'Name', 'pakghor' ),
                        'modified'      => esc_html__( 'Modified', 'pakghor' ),
                        'author'        => esc_html__( 'Author', 'pakghor' ),
                        'rand'          => esc_html__( 'Random', 'pakghor' ),
                        'comment_count' => esc_html__( 'Comment Count', 'pakghor' ),

                    ),
                    'default'       => 'date',
                ),
              
            );
        }
   
}