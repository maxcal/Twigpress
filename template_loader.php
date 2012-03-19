<?php

/**
 * @name        twigpress_template_loader
 * @author      Max Calabrese <max.calabrese@greenpeace.org>
 * @copyright   Greenpeace Nordic
 * @version 
 * @since   
 */

/**
 * Twigpress template loader simulates wordpress template inheritance.
 */
class Twigpress_Template_Loader {

    private function get_query_template($type, $templates = null){
        $type = preg_replace( '|[^a-z0-9-]+|', '', $type );
        $path = TEMPLATEPATH . DIRECTORY_SEPARATOR;
        $fn = null;
        
	if ( empty( $templates ) ){
            $templates = array($type);
        }
        
        foreach ($templates as $t) {
            
            if (file_exists($path.$t.'.html.twig')){
                $fn = $t.'.html.twig';
                break;
            }
            else if (file_exists($path.$t.'.twig')){
                $fn = $t.'.twig';
                break;
            }
        }
        
        return $fn;
    }

    private function get_index_template() {
	return $this->get_query_template('index');
    }

    /**
     * Retrieve path of 404 template in current or parent template.
  
     * @return string
     */
    private function get_404_template() {
        return $this->get_query_template('404');
    }

    /**
     * Retrieve path of archive template in current or parent template.
     *
     * @return string
     */
    private function get_archive_template() {
        $post_type = get_query_var('post_type');

        $templates = array();

        if ($post_type)
            $templates[] = "archive-{$post_type}";
        $templates[] = 'archive';

        return $this->get_query_template('archive', $templates);
    }

    /**
     * Retrieve path of author template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_author_template() {
        $author = get_queried_object();

        $templates = array();

        $templates[] = "author-{$author->user_nicename}";
        $templates[] = "author-{$author->ID}";
        $templates[] = 'author.php';

        return $this->get_query_template('author', $templates);
    }

    /**
     * Retrieve path of category template in current or parent template.
     *
     * Works by first retrieving the current slug for example 'category-default' and then
     * trying category ID, for example 'category-1' and will finally fallback to category
     * template, if those files don't exist.
     *
     * @return string
     */
    private function get_category_template() {
        $category = get_queried_object();

        $templates = array();

        $templates[] = "category-{$category->slug}";
        $templates[] = "category-{$category->term_id}";
        $templates[] = 'category.php';

        return $this->get_query_template('category', $templates);
    }

    /**
     * Retrieve path of tag template in current or parent template.
     *
     * Works by first retrieving the current tag name, for example 'tag-wordpress.php' and then
     * trying tag ID, for example 'tag-1.php' and will finally fallback to tag.php
     * template, if those files don't exist.
     *
     * @since 2.3.0
     * @uses apply_filters() Calls 'tag_template' on file path of tag template.
     *
     * @return string
     */
    private function get_tag_template() {
        $tag = get_queried_object();

        $templates = array();

        $templates[] = "tag-{$tag->slug}";
        $templates[] = "tag-{$tag->term_id}";
        $templates[] = 'tag.php';

        return $this->get_query_template('tag', $templates);
    }

    /**
     * Retrieve path of taxonomy template in current or parent template.
     *
     * Retrieves the taxonomy and term, if term is available. The template is
     * prepended with 'taxonomy-' and followed by both the taxonomy string and
     * the taxonomy string followed by a dash and then followed by the term.
     *
     * The taxonomy and term template is checked and used first, if it exists.
     * Second, just the taxonomy template is checked, and then finally, taxonomy.
     * template is used. If none of the files exist, then it will fall back on to
     * index.
     *
     * @return string
     */
    private function get_taxonomy_template() {
        $term = get_queried_object();
        $taxonomy = $term->taxonomy;

        $templates = array();

        $templates[] = "taxonomy-$taxonomy-{$term->slug}";
        $templates[] = "taxonomy-$taxonomy";
        $templates[] = 'taxonomy.php';

        return $this->get_query_template('taxonomy', $templates);
    }

    /**
     * Retrieve path of date template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_date_template() {
        return $this->get_query_template('date');
    }

    /**
     * Retrieve path of home template in current or parent template.
     *
     * This is the template used for the page containing the blog posts
     *
     * Attempts to locate 'home' first before falling back to 'index'.
     *
     * @since 1.5.0
     * @uses apply_filters() Calls 'home_template' on file path of home template.
     *
     * @return string
     */
    private function get_home_template() {
        $templates = array('home.php', 'index.php');

        return $this->get_query_template('home', $templates);
    }

    /**
     * Retrieve path of front-page template in current or parent template.
     *
     * Looks for 'front-page.php'.
     *
     * @since 3.0.0
     * @uses apply_filters() Calls 'front_page_template' on file path of template.
     *
     * @return string
     */
    private function get_front_page_template() {
        $templates = array('front-page');

        return $this->get_query_template('front_page', $templates);
    }

    /**
     * Retrieve path of page template in current or parent template.
     *
     * Will first look for the specifically assigned page template
     * The will search for 'page-{slug}' followed by 'page-id'
     * and finally 'page'
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_page_template(){
        $id = get_queried_object_id();
	$template = get_post_meta($id, '_wp_page_template', true);
	$pagename = get_query_var('pagename');
        
        if ( !$pagename && $id > 0 ) {
		// If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
		$post = get_queried_object();
		$pagename = $post->post_name;
	}

	if ( 'default' == $template )
		$template = '';

	$templates = array();
	if ( !empty($template) && !validate_file($template) )
		$templates[] = $template;
	if ( $pagename )
		$templates[] = "page-$pagename";
	if ( $id )
		$templates[] = "page-$id";
	$templates[] = 'page';

	return $this->get_query_template( 'page', $templates );
    }

    /**
     * Retrieve path of paged template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_paged_template() {
        return $this->get_query_template('paged');
    }

    /**
     * Retrieve path of search template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_search_template() {
        return $this->get_query_template('search');
    }

    /**
     * Retrieve path of single template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_single_template() {
        $object = get_queried_object();

        $templates = array();

        $templates[] = "single-{$object->post_type}";
        $templates[] = "single";

        return $this->get_query_template('single', $templates);
    }

    /**
     * Retrieve path of attachment template in current or parent template.
     *
     * The attachment path first checks if the first part of the mime type exists.
     * The second check is for the second part of the mime type. The last check is
     * for both types separated by an underscore. If neither are found then the file
     * 'attachment.php' is checked and returned.
     *
     * Some examples for the 'text/plain' mime type are 'text', 'plain', and
     * finally 'text_plain'.
     *
     * @since 2.0.0
     *
     * @return string
     */
    private function get_attachment_template() {
        global $posts;
        $type = explode('/', $posts[0]->post_mime_type);
        if ($template = get_query_template($type[0]))
            return $template;
        elseif ($template = get_query_template($type[1]))
            return $template;
        elseif ($template = get_query_template("$type[0]_$type[1]"))
            return $template;
        else
            return $this->get_query_template('attachment');
    }

    /**
     * Retrieve path of comment popup template in current or parent template.
     *
     * Checks for comment popup template in current template, if it exists or in the
     * parent template.
     *
     * @return string
     */
    private function get_comments_popup_template() {
        $template = get_query_template('comments_popup', array('comments-popup'));

        return $template;
    }

    
    /**
     * Returns a response template based on the current query
     * @return string the name of the template
     */
    public function get_template() {
        $tmp = false;
	if     ( is_404()            && $tmp = $this->get_404_template()            ) :
	elseif ( is_search()         && $tmp = $this->get_search_template()         ) :
	elseif ( is_tax()            && $tmp = $this->get_taxonomy_template()       ) :
	elseif ( is_front_page()     && $tmp = $this->get_front_page_template()     ) :
	elseif ( is_home()           && $tmp = $this->get_home_template()           ) :
	elseif ( is_attachment()     && $tmp = $this->get_attachment_template()     ) :
	elseif ( is_single()         && $tmp = $this->get_single_template()         ) :
	elseif ( is_page()           && $tmp = $this->get_page_template()           ) :
	elseif ( is_category()       && $tmp = $this->get_category_template()       ) :
	elseif ( is_tag()            && $tmp = $this->get_tag_template()            ) :
	elseif ( is_author()         && $tmp = $this->get_author_template()         ) :
	elseif ( is_date()           && $tmp = $this->get_date_template()           ) :
	elseif ( is_archive()        && $tmp = $this->get_archive_template()        ) :
	elseif ( is_comments_popup() && $tmp = $this->get_comments_popup_template() ) :
	elseif ( is_paged()          && $tmp = $this->get_paged_template()          ) :
	else :
		$tmp = $this->get_index_template();
	endif;
	
	return $tmp;
    }
    
    
    
    
}