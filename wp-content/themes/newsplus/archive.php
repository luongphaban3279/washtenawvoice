<?php
/**
 * The template for displaying Archive pages
 * 
 * @package NewsPlus
 * @since 1.0.0
 * @version 3.4.2 
 */

get_header();
$full_width = get_option( 'pls_archive_fw' );
$archive_template = get_option( 'pls_archive_template', 'grid' );
?>
<div id="primary" class="site-content<?php if ( $full_width ) echo ' full-width'; ?>">
	<div class="primary-row">
        <div id="content" role="main">
			<?php show_breadcrumbs();
            
            if ( have_posts() ) : ?>
                
                <header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
                </header><!-- .page-header -->            
                <?php            
                get_template_part( 'content', $archive_template ); 
        
			endif; ?>
        
        </div><!-- #content -->
        <?php
        if ( 'true' != $full_width ) {
            newsplus_sidebar_b();
        }
        ?>
    </div><!-- .primary-row -->
</div><!-- #primary -->
<?php
if ( 'no-sb' != get_option( 'pls_sb_pos', 'ca' ) ) {
	if ( 'true' != $full_width ) {
		get_sidebar();
	}
}
get_footer(); ?>