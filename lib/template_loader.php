<?php

/**
 * @package twigpress
 * @author max.calabrese@ymail.com
 */

/**
 * Twigpress template loader simulates wordpress template inheritance.
 */
class Twigpress_Template_Loader {

    /**
     *
     * @var Twig_Loader_Filesystem 
     */
    private $loader;

    function __construct($twig_loader_filesystem = null) {
        $this->loader = $twig_loader_filesystem;
    }
    
    function walkPath($path, $templates){
        
    }

    private function get_query_template($type, $templates = null) {
        $paths = $this->loader->getPaths();
        $fn = null;
        
        if ( empty( $templates ) ){
            $templates = array($type);
        }

        foreach ($paths as $path) {
            $glob = glob("$path*.twig");
            
            foreach ($templates as $template) {
                
                $file = $path.$template;
               
                if (in_array($file.'.html.twig', $glob)){
                    return $template.'.html.twig';
                }
            }      
        }
        
        return $fn;
        
    }

    private function get_index_template() {
        return $this->get_query_template('index');
    }

    private function get_foo_template() {
        return $this->get_query_template('foo');
    }
    /**
     * Retrieve path of 404 template in current or parent template.

     * @return string
     */
    private function get_404_template() {
        
    }

    /**
     * Retrieve path of archive template in current or parent template.
     *
     * @return string
     */
    private function get_archive_template() {
        
    }

    /**
     * Retrieve path of author template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_author_template() {
        
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
        
    }

    /**
     * Retrieve path of date template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_date_template() {
        
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
    private function get_page_template() {
        
    }

    /**
     * Retrieve path of paged template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_paged_template() {
        
    }

    /**
     * Retrieve path of search template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_search_template() {
        
    }

    /**
     * Retrieve path of single template in current or parent template.
     *
     * @since 1.5.0
     *
     * @return string
     */
    private function get_single_template() {
        
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
        
    }
    
    
    /**
     * Returns a response template based on the current query
     * @return string the name of the template
     */
    public function get_template($query) {
        $tmp = false;

        if ($query->is_404() && $tmp = $this->get_404_template()){
            
        }
        if ($query->is_foo() && $tmp = $this->get_foo_template()){
            
        }
        else {
            $tmp = $this->get_index_template();
        }
        
        return $tmp;
    }
}