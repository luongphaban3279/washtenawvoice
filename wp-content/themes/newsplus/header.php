<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "#main" div.
 */
$schema = newsplus_schema( get_option( 'pls_schema' ) );
$pls_header_style = get_option( 'pls_header_style', 'default' );
$pls_disable_resp_css = get_option( 'pls_disable_resp_css' );
$pls_html_main_menu = get_option( 'pls_html_main_menu' );
$pls_html_top_menu = get_option( 'pls_html_top_menu' );
?><!DOCTYPE html>
<html <?php echo $schema['html']; language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( 'true' != $pls_disable_resp_css ) : ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
    if ( is_active_sidebar( 'top-widget-area' ) ) { ?>
        <div class="wrap top-widget-area">
        <?php dynamic_sidebar( 'top-widget-area' ); ?>
        </div><!-- .top-widget-area -->
    <?php } ?>
    <div id="page" class="hfeed site clear">
    <?php if ( 'true' != get_option( 'pls_top_bar_hide' ) ) : ?>
        <div id="utility-top" class="top-nav">
            <div class="wrap clear">
                <?php if ( 'menu' == get_option( 'pls_cb_item_left', 'text' ) ) : ?>
                <nav id="optional-nav" class="secondary-nav">
                    <?php
                    if ( '' != $pls_html_top_menu ) {
						echo do_shortcode( stripslashes( $pls_html_top_menu ) );
					}
					else {
						wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_class' => 'sec-menu clear', 'container' => false ) );
					}?>
                </nav><!-- #optional-nav -->
                <?php else : ?>
                <div id="callout-bar" class="callout-left" role="complementary">
                    <div class="callout-inner">
                    <?php echo do_shortcode( stripslashes( get_option( 'pls_cb_text_left', __( 'Optional text here', 'newsplus' ) ) ) ); ?>
                    </div><!-- .callout-inner -->
                </div><!-- #callout-bar -->
                <?php endif;
                if ( 'searchform' == get_option( 'pls_cb_item_right', 'searchform' ) ) {  ?>
                <div id="search-bar" role="complementary">
                    <?php get_search_form(); ?>
                </div><!-- #search-bar -->
                <?php }
                elseif ( 'cart' == get_option( 'pls_cb_item_right' ) && class_exists( 'woocommerce' ) ) {
                    get_template_part( 'woocommerce/cart-nav' );
                }
                else { ?>
                    <div id="callout-bar" role="complementary">
                        <div class="callout-inner">
                        <?php echo do_shortcode( stripslashes( get_option( 'pls_cb_text_right' ) ) );  ?>
                        </div><!-- .callout-inner -->
                    </div><!-- #callout-bar -->
                <?php } // callout bar item check ?>
            </div><!-- .top-nav .wrap -->
        </div><!-- .top-nav-->
		<?php endif;
	 
		if ( 'below_top_menu' == get_option( 'pls_ticker_placement' ) ) {
			if ( get_option( 'pls_ticker_home_check' ) ) {
				if ( is_home() || is_front_page() ) {
					echo '<div class="wrap newsplus-news-ticker after-top-menu">' . newsplus_ticker_output() . '</div>';
				}
			}
			else {
				echo '<div class="wrap newsplus-news-ticker after-top-menu">' . newsplus_ticker_output() . '</div>';
			}
        }		
		
		if ( 'slim' == $pls_header_style ) {
			get_template_part( 'includes/header-slim' );
		}		
		
		else {
		?>
            <header id="header" class="site-header">
                <div class="wrap full-width clear">    
                <?php                
                    get_template_part( 'includes/header-' . $pls_header_style );
                ?>
                </div><!-- #header .wrap -->
            </header><!-- #header -->
        <?php 
		}
		
		if ( 'slim' !== $pls_header_style ) {

			if ( 'true' != $pls_disable_resp_css ) {
				if ( 'true' != get_option( 'pls_disable_resp_menu' ) ) {
				?>
					<div id="responsive-menu" class="resp-main">
                        <div class="wrap">
							<?php if ( get_option( 'pls_inline_search_box', false ) ) { ?>
                                <div class="inline-search-box"><a class="search-trigger" href="#"><span class="screen-reader-text"><?php esc_attr_e( 'Open search panel', 'newsplus' ); ?></span></a>
                                
                                <?php get_search_form(); ?>  
                                </div><!-- /.inline-search-box -->   
                            <?php } ?>                         
                            <h3 class="menu-button"><span class="screen-reader-text"><?php echo apply_filters( 'newsplus_mobile_text', esc_attr__( 'Menu', 'newsplus' ) ); ?></span>Menu<span class="toggle-icon"><span class="bar-1"></span><span class="bar-2"></span><span class="bar-3"></span></span></h3>
                        </div><!-- /.wrap -->
						<nav<?php echo $schema['nav']; ?> class="menu-drop"></nav><!-- /.menu-drop -->                        
					</div><!-- /#responsive-menu -->
				<?php
				}
			}			
			
			?>
            <nav<?php echo $schema['nav']; ?> id="main-nav" class="primary-nav<?php if ( 'true' == get_option( 'pls_disable_resp_menu' ) ) echo ' do-not-hide'; if ( 'center' == get_option( 'pls_menu_align' ) ) echo ' text-center';?>">
                <div class="wrap clearfix<?php if ( get_option( 'pls_inline_search_box', false ) ) { echo ' has-search-box'; } ?>">
                    <?php
					if ( '' != $pls_html_main_menu ) {
						echo do_shortcode( stripslashes( $pls_html_main_menu ) );
					}
					else {
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu clear', 'container' => false ) );
					}
					
					if ( get_option( 'pls_inline_search_box', false ) ) { ?>
                        <div class="inline-search-box"><a class="search-trigger" href="#"><span class="screen-reader-text"><?php esc_attr_e( 'Open search panel', 'newsplus' ); ?></span></a>
                        
                        <?php get_search_form(); ?>  
                        </div><!-- /.inline-search-box -->   
                    <?php } ?>     
                    
                </div><!-- .primary-nav .wrap -->
            </nav><!-- #main-nav -->
		
		<?php
		}
		if ( 'below_main_menu' == get_option( 'pls_ticker_placement' ) ) {
			if ( get_option( 'pls_ticker_home_check' ) ) {
				if ( is_home() || is_front_page() ) {
					echo '<div class="wrap newsplus-news-ticker after-main-menu">' . newsplus_ticker_output() . '</div>';
				}
			}
			else {
				echo '<div class="wrap newsplus-news-ticker after-main-menu">' . newsplus_ticker_output() . '</div>';
			}
        }
		       
		if ( is_active_sidebar( 'widget-area-before-content' ) ) : ?>
            <div id="widget-area-before-content">
                <div class="wrap">
					<?php dynamic_sidebar( 'widget-area-before-content' ); ?>
                </div><!--.wrap -->
            </div><!-- #widget-area-before-content -->
        <?php endif;

        // Hooked newsplus_single_overlay_header() - 20
        do_action( 'newsplus_before_main' );
        ?>
        <div id="main">
            <div class="wrap clearfix">
            	<div class="main-row clearfix">