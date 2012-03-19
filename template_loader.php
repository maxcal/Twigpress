<?php

/**
 * @name        twigpress_template_loader
 * @author      Max Calabrese <max.calabrese@greenpeace.org>
 * @copyright   Greenpeace Nordic
 * @version 
 * @since   
 */

/**
 * Description of twigpress_template_loader
 * @todo create class discription
 */
class Twigpress_Template_Loader {

    private function get_404_template(){
        
    }
    private function get_search_template(){
        
    }
    
    private function get_taxonomy_template(){
        
    }
    
    private function get_front_page_template(){
        
    }
    
    private function get_attachment_template(){
        
    }
    
    private function get_single_template(){
        
    }
    
    private function get_page_template(){
        
    }
    
    private function get_category_template(){
        
    }

    private function get_tag_template(){
        
    }
    
    private function get_date_template(){
        
    }
    
    private function get_archive_template(){
        
    }

    private function get_comments_popup_template(){
        
    }
    
    private function get_paged_template(){
        
    }  
    /**
     * PHP Magic method called on instanciation
     * @returns type
     */
    public function get_template() {
        $template = false;
	if     ( is_404()            && $template = $this->get_404_template()            ) :
	elseif ( is_search()         && $template = $this->get_search_template()         ) :
	elseif ( is_tax()            && $template = $this->get_taxonomy_template()       ) :
	elseif ( is_front_page()     && $template = $this->get_front_page_template()     ) :
	elseif ( is_home()           && $template = $this->get_home_template()           ) :
	elseif ( is_attachment()     && $template = $this->get_attachment_template()     ) :
	elseif ( is_single()         && $template = $this->get_single_template()         ) :
	elseif ( is_page()           && $template = $this->get_page_template()           ) :
	elseif ( is_category()       && $template = $this->get_category_template()       ) :
	elseif ( is_tag()            && $template = $this->get_tag_template()            ) :
	elseif ( is_author()         && $template = $this->get_author_template()         ) :
	elseif ( is_date()           && $template = $this->get_date_template()           ) :
	elseif ( is_archive()        && $template = $this->get_archive_template()        ) :
	elseif ( is_comments_popup() && $template = $this->get_comments_popup_template() ) :
	elseif ( is_paged()          && $template = $this->get_paged_template()          ) :
	else :
		$template = get_index_template();
	endif;
	
	return $template;
    }
    
    
    
    
}