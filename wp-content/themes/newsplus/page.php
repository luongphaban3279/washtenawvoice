<?php
/**
 * The template for displaying all pages.
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 3.4.2 
 */

get_header(); ?>
<div id="primary" class="site-content">
	<div class="primary-row">
        <div id="content" role="main">
			<?php
            show_breadcrumbs();
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    $page_opts = get_post_meta( $posts[0]->ID, 'page_options', true );
                    $hide_page_title = isset( $page_opts['hide_page_title'] ) ? $page_opts['hide_page_title'] : false;
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
                        <?php
                        $title = get_the_title();
                        if ( ! ( $hide_page_title || get_option( 'pls_hide_page_titles' ) ) && '' !== $title ) {			
                           echo '<header class="page-header"><h1 class="entry-title">' . esc_html( $title ) . '</h1></header>';            
                        }
                        ?>
                        <div class="entry-content">
                            <?php
                            the_content();
                            wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'newsplus' ), 'after' => '</div>' ) ); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post -->
                    <?php
                    comments_template( '', true );
                endwhile;
            else :
                newsplus_no_posts();
            endif; ?>
        </div><!-- #content -->
        <?php
        newsplus_sidebar_b();
        ?>    
    </div><!--.primary-row -->  
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	get_sidebar();
}
get_footer(); ?>