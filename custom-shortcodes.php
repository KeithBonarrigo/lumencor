<?php
//////////////////////////////////////////////////////////////////////////////////////
// page_cats_function
// grabs pages for a given category
// accepts category name and returns html content
//////////////////////////////////////////////////////////////////////////////////////
function page_cats_function( $atts = array() ) {
    // set up default parameters
    extract(shortcode_atts(array(
        'category' => 'techniques'
    ), $atts));

    $category_id = get_cat_ID($category); //this is the category we're querying on

    //query vars
    $myposts = get_posts( array(
        'post_type' => 'page',
        'category'=>$category_id,
        'numberposts' => 30,
        'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
        /*'field' => 'slug',
        'term' => $category*/
    ) );
     
    $postContent .= "<style>
    	.tags-topics-tile { display: inline; float:left; margin:0px 20px 5px 0px; padding-right:10px; background-color:#eeeeee; }
    	.tags-topics-image { width:50px; height:50px;margin-right:10px; vertical-align:middle; }
    </style>";  
    if ( $myposts ) { //we have results - loop through them and display them
        foreach ( $myposts as $post ){
            $permalink = get_permalink($post->ID);
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
            $postContent .= "<div class='tags-topics-tile'><a href='".$permalink."' style='color:black'><img class='tags-topics-image' src='".$image[0]."'>".$post->post_title."</a></div>";
        }
    }          
    return "$postContent"; //return the output
}
add_shortcode('page_cats', 'page_cats_function');

//////////////////////////////////////////////////////////////////////////////////////
// page_tags_function
// accecpts page ID and returns array of tags associated to that page
//////////////////////////////////////////////////////////////////////////////////////
function page_tags_related_function( $atts = array() ) {
	global $wpdb;
    // set up default parameters
    extract(shortcode_atts(array(
        'page_to_tag_to' => '9999'
    ), $atts));

    $output = "";
    $these_tags = get_the_tags($page_to_tag_to); //build the array

    $output .= "
		<style>
			.tag-container { width:325px; height:190px; border: solid 1px #000; display:inline; float: left; margin-right:30px; }
			.tag-lower-bar { background-color:#12ab37; text-align:center; padding:3px; font-size:14px; width:324px; line-height:50px; vertical-align: middle;  }
			.tag-lower-bar a { color: white;  }
			img.tag-image { width:326px; height:130px; }
			div.clear { clear:both; height:40px; }
			.tag-header, h3.crp-list-title { padding-bottom:20px; margin-bottom:24px; border:solid 2px #eeeeee; border-width:0px 0px 2px 0px;  }
			.crp-list-item-has-image { margin-left:0px; }
			.crp-list-item-title { font-size:13px; }
			.learning-content-image { width:200px; height:200px; float:left; margin:0px 15px 5px 0px; }
			.hr-sub-header { height:2px; background-color:#eeeeee; margin-bottom:24px !important; }
		</style>
    ";

    if($these_tags){
    	$output .= "<h3 class='tag-header'>Tags</h3>";
    	//$output .= "<hr class='hr-sub-header'>";
    	$tag_images = array();
	    foreach($these_tags as $tag){
	    	$this_link = get_tag_link($tag);
	    	$this_tag = get_tag($tag->ID);
	    	$image = '';
	    	//$output .= $tag->term_id;

	    	//$attachment = get_attached_media('image', $tag->term_id);
	    	ob_start();
    		$sql = "SELECT option_value, term_id, name FROM wp_options, wp_terms WHERE wp_options.option_name LIKE '%_category_image".$tag->term_id."%' AND wp_terms.term_id = ".$tag->term_id." LIMIT 1";
			$results = $wpdb->get_results($sql);
			foreach($results as $result){
				//print_r($result->option_value);
				$image = $result->option_value;
			}
			

	    	$output .= "<div class='tag-container'>";

	    	if(strlen($image)>0){ 
	    		$output .=	"<img src='".$image."' class='tag-image' />";
	    	}else{
	    		$output .= "<img src='noimage.jpg' class='tag-image' />";
	    	}

	    	$output .=	"<div class='tag-lower-bar'>".$this_tag_image."<a href='".$this_link."'>".$tag->name."</a></div>
	    		</div>
	    	";
	    }
	    
			$stuff = ob_get_contents();
    		ob_end_clean();
    		$output .= $stuff;
	    $output .= "<div class='clear'></div>";
	    $output .= str_replace("Related Posts", "Related Topics", do_shortcode( '[custom-related-posts]' ));
	}
	$output .= "<div class='clear'></div>";

    return $output; //return the array
}
add_shortcode('page_tags', 'page_tags_related_function');
//////////////////////////////////////////////////////////////////////////////////////
?>