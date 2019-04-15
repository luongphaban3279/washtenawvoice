<?php
/**
 * Breadcrumbs
 *
 * @package NewsPlus
 * @since 1.0.0
 * @version 3.4.2
 */

if ( !function_exists( 'ss_breadcrumbs' ) ):
    function ss_breadcrumbs() {
        
        $pls_schema = get_option( 'pls_schema' );
        $schema     = newsplus_schema( $pls_schema );
        $delimiter  = apply_filters( 'newsplus_breadcrumb_sep', '<span class="sep"></span>' );
        $home       = __( 'Home', 'newsplus' );
        $before     = '<span class="current">';
        $after      = '</span>';
        $liopen     = '<li' . $schema['bcelement'] . '>';
        $liclose    = '</li>';
        $paged      = '';
        
        if ( ( !is_home() && !is_front_page() && !( is_single() && !is_singular( 'post' ) ) ) ) {
            echo '<ol' . $schema['bclist'] . ' class="breadcrumbs">';
            global $post;
            $home_link = home_url();
            
            
            if ( get_query_var( 'paged' ) ) {
                $paged = sprintf( esc_attr__( ' (Page %s)', 'newsplus' ), get_query_var( 'paged' ) );
            }
            
            // Home
            echo $liopen;
            printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], $home_link, $schema['name'], $home, $pls_schema ? '<meta itemprop="position" content="1" />' : '' );
            echo $liclose;
            
            // Category
            if ( is_category() ) {
                global $post;
                $pos      = 2;
                $curr_cat = get_category( get_query_var( 'cat' ) );
                $parents  = get_ancestors( $curr_cat->term_id, $curr_cat->taxonomy );
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;
                        
                        echo $liopen;
                        printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], $link, $schema['name'], $name, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' );
                        echo $liclose;
                        $pos++;
                    }
                }
                
                // Current category name
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], $curr_cat->name . $paged, $pls_schema ? '<meta itemprop="position" content="' . ( $pos ) . '" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_category_link( $curr_cat->term_id ) . '" />' : '' );
                echo $liclose;
            }
            
            elseif ( is_day() ) {
                
                // Current year
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_year_link( get_the_time( 'Y' ) ), $schema['name'], get_the_time( 'Y' ), $pls_schema ? '<meta itemprop="position" content="2" />' : '' );
                echo $liclose;
                
                // Current month
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), $schema['name'], get_the_time( 'm' ), $pls_schema ? '<meta itemprop="position" content="3" />' : '' );
                echo $liclose;
                
                // Current day
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], get_the_time( 'd' ) . $paged, $pls_schema ? '<meta itemprop="position" content="4" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) . '" />' : '' );
                echo $liclose;
                
            } elseif ( is_month() ) {
                
                // Current year
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_year_link( get_the_time( 'Y' ) ), $schema['name'], get_the_time( 'Y' ), $pls_schema ? '<meta itemprop="position" content="2" />' : '' );
                echo $liclose;
                
                // Current month
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], get_the_time( 'm' ) . $paged, $pls_schema ? '<meta itemprop="position" content="3" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" />' : '' );
                echo $liclose;
                
            } elseif ( is_year() ) {
                
                // Current year
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], get_the_time( 'Y' ) . $paged, $pls_schema ? '<meta itemprop="position" content="2" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_year_link( get_the_time( 'Y' ) ) . '" />' : '' );
                echo $liclose;
            }
			
			elseif ( is_singular( 'post' ) && !is_attachment() ) {
                $curr_cat = get_the_category( $post->id );
                $parents  = get_ancestors( $curr_cat[0]->term_id, $curr_cat[0]->taxonomy );
                $pos     = 2;				
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;
                        
                        echo $liopen;
                        printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], $link, $schema['name'], $name, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' );
                        echo $liclose;
                        $pos++;
                    }
                }
                
                // Current category link
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_category_link( $curr_cat[0]->term_id ), $schema['name'], $curr_cat[0]->name, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' );
                echo $liclose;
                
                // Current post name
                $title = '' !== get_the_title() ? get_the_title() : get_the_id();
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], $title, $pls_schema ? '<meta itemprop="position" content="' . ( $pos + 1 ) . '" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_permalink() . '" />' : '' );
                echo $liclose;
            } elseif ( is_attachment() ) {
                
                $post_parent = get_post( $post->post_parent );
                $curr_cat    = get_the_category( $post_parent->ID );                
                $parents = get_ancestors( $curr_cat[0]->term_id, $curr_cat[0]->taxonomy );
				$pos     = 2;
                if ( $parents && is_array( $parents ) ) {
                    $parents = array_reverse( $parents );
                    foreach ( $parents as $parent ) {
                        $link    = get_category_link( $parent );
                        $cat_obj = get_category( $parent );
                        $name    = $cat_obj->name;
                        
                        echo $liopen;
                        printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], $link, $schema['name'], $name, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' );
                        echo $liclose;
                        $pos++;
                    }
                }
                
                // Current category link
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_category_link( $curr_cat[0]->term_id ), $schema['name'], $curr_cat[0]->name, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' );
                echo $liclose;
                
                // Current post link
                echo $liopen;
                printf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_permalink( $post_parent ), $schema['name'], $post_parent->post_title, $pls_schema ? '<meta itemprop="position" content="' . ( $pos + 1 ) . '" />' : '' );
                echo $liclose;
                
                // Current attachment name
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], get_the_title(), $pls_schema ? '<meta itemprop="position" content="' . ( $pos + 2 ) . '" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_permalink() . '" />' : '' );
                echo $liclose;
                
            } elseif ( is_page() && !$post->post_parent ) {
                // Current page name
                $title = '' !== get_the_title() ? get_the_title() : get_the_id();
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], $title, $pls_schema ? '<meta itemprop="position" content="2" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_permalink() . '" />' : '' );
                echo $liclose;
            } elseif ( is_page() && $post->post_parent ) {
                $parent_id = $post->post_parent;
                $items     = array();
                $pos       = 2;
                while ( $parent_id ) {
                    $page      = get_page( $parent_id );
                    $parent_id = $page->post_parent;
                    $items[]   = $page;
                }
                
                $items = array_reverse( $items );
                
                if ( !empty( $items ) && is_array( $items ) ) {
                    foreach ( $items as $item ) {
                        echo $liopen . sprintf( '<a%1$s href="%2$s"><span%3$s>%4$s</span></a>%5$s', $schema['item'], get_permalink( $item->ID ), $schema['name'], get_the_title( $item->ID ), $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '' ) . $liclose;
                        $pos++;
                    }
                }
                
                // Current page name
                $title = ( '' !== get_the_title() ) ? get_the_title() : get_the_id();
                echo $liopen;
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], $title, $pls_schema ? '<meta itemprop="position" content="' . $pos . '" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_permalink() . '" />' : '' );
                echo $liclose;
            } elseif ( is_search() ) {
                echo $liopen;
                esc_attr_e( 'Search results for: ', 'newsplus' );
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], get_search_query(), $pls_schema ? '<meta itemprop="position" content="2" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_search_link() . '" />' : '' );
                echo $liclose;
            } elseif ( is_tag() ) {
                $tag_obj = get_term_by( 'name', single_tag_title( '', false ), 'post_tag' );
                echo $liopen;
                esc_attr_e( 'Posts tagged: ', 'newsplus' );
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], single_tag_title( '', false ) . $paged, $pls_schema ? '<meta itemprop="position" content="2" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_tag_link( $tag_obj->term_id ) . '" />' : '' );
                echo $liclose;
            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata( $author );
                
                echo $liopen;
                esc_attr_e( 'Articles posted by: ', 'newsplus' );
                printf( '<span%1$s><span%2$s>%3$s</span></span>%4$s%5$s', $schema['item'], $schema['name'], $userdata->display_name . $paged, $pls_schema ? '<meta itemprop="position" content="2" />' : '', $pls_schema ? '<meta itemprop="url" content="' . get_author_posts_url( $author ) . '" />' : '' );
                echo $liclose;
            } elseif ( is_404() ) {
                printf( '<li>%s</li>', esc_attr__( 'Error 404', 'newsplus' ) );
            }
            
            echo '</ol>';
        }
    } // end ss_breadcrumbs()
endif;

/* Function to show breadcrumbs as required */
if ( !function_exists( 'show_breadcrumbs' ) ):
    function show_breadcrumbs() {
        global $post;
        
        if ( !is_home() && !is_front_page() ) {
            if ( is_page() ) {
                $page_opts   = get_post_meta( $post->ID, 'page_options', true );
                $hide_crumbs = isset( $page_opts['hide_crumbs'] ) ? $page_opts['hide_crumbs'] : '';
                if ( 'true' != $hide_crumbs ) { // If not opted to hide breadcrumbs
                    if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                        ss_breadcrumbs();
                    }
                } // Hide breadcrumbs
                elseif ( !isset( $page_opts ) ) {
                    if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                        ss_breadcrumbs();
                    }
                } // Default Fallback when no options are set
            } // is_page
            else {
                if ( 'true' != get_option( 'pls_hide_crumbs' ) ) {
                    ss_breadcrumbs();
                }
            }
        }
    }
endif;
?>