<?php

// function theme_enqueue_styles() {
//
//     $parent_style = 'parent-style';
//
//     wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( 'child-style',
//         get_stylesheet_directory_uri() . '/style.css',
//         array( $parent_style )
//     );
// }
// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
add_filter ( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer ( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}


//* Create Portfolio Type custom taxonomy
add_action( 'init', 'divi_type_taxonomy' );
function divi_type_taxonomy() {

	register_taxonomy( 'portfolio-type', 'portfolio',
		array(
			'labels' => array(
				'name'          => _x( 'Types', 'taxonomy general name', 'divi' ),
				'add_new_item'  => __( 'Add New Portfolio Type', 'divi' ),
				'new_item_name' => __( 'New Portfolio Type', 'divi' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => true,
			'hierarchical'        => true,
			'rewrite'             => array( 'slug' => 'portfolio-type', 'with_front' => false ),
			'show_ui'             => true,
			'show_tagcloud'       => false,
		)
	);

}

		/*
		application Description √
		RFQ Wavelengths
		RFQ Ideal Wavelengths and Bandwidths
		RFQ Sample Format:
		RFQ Maximum Switching Rate:
		RFQ Fluorescent Probes
		RFQ Light Source:
		RFQ Continuous Mode or Modulation:
		Company
		Lead Type:
		Address
		City
		Country
		State/Province
		Zip
		First Name
		Last Name
		Title
		Email
		Phone
		Lead Source
		*/

add_action( 'gform_after_submission', 'post_to_third_party', 10, 2 );
function post_to_third_party( $entry, $form ) {

	$post_url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

	if ( $form['title'] == "Contact Us" ) {

	    $body = array(
				'first_name' => rgar( $entry, '1' ),
				'last_name' => rgar( $entry, '5' ),
				'email' => rgar( $entry, '4' ),
				'description' => rgar( $entry, '3' ),
				'oid' => rgar( $entry, '8' ),
				'retURL' => rgar( $entry, '9' ),
				'lead_source' => rgar( $entry, '6' ),
			);

	    $request = new WP_Http();
	    $response = $request->post( $post_url, array( 'body' => $body ) );

	} else if ( $form['title'] == "Quote Request" ) {

		$rfqWavelengths = str_replace(',', ';', rgar( $entry, '28' ));
		$sampleFormat = str_replace(',', ';', rgar( $entry, '30' ));
		$fluorescentProbes = str_replace(',', ';', rgar( $entry, '31' ));
		$lightSource = str_replace(',', ';', rgar( $entry, '32' ));

		$body = array(
			'00N1a000003BGzi' => rgar( $entry, '1' ), 	/* application Description */
			'00N1a000003BH6k' => $rfqWavelengths,  		/* RFQ Wavelengths //rgar( $entry, '28' ),  $rfqWavelengths*/
		 	'00N1a000003BH2I' => rgar( $entry, '3' ),  	/* RFQ Ideal Wavelengths and Bandwidths */
			'00N1a000003BH74' => $sampleFormat,  		/* RFQ Sample Format */
		 	'00N1a000003BH6V' => rgar( $entry, '6' ),  	/* RFQ Maximum Switching Rate */
		 	'00N1a000003BH79' => $fluorescentProbes,  	/* RFQ Fluorescent Probes */
			'00N1a000003BH6a' => $lightSource,  		/* RFQ Light Source */
			'00N1a000003BH7E' => rgar( $entry, '12' ),	/* RFQ Continuous Mode or Modulation */
			'company' => rgar( $entry, '13' ), 			/* Company */
			'00N1a000001ui9C' => rgar( $entry, '14' ), 	/* Lead Type */
			'street' => rgar( $entry, '25.1' ),  		/* Address */
			'city' => rgar( $entry, '25.3' ), 			/* City */
			'country' => rgar( $entry, '25.6' ), 		/* Country */
			'state' => rgar( $entry, '25.4' ), 			/* State/Province */
			'zip' => rgar( $entry, '25.5' ),  			/* Zip */
			'first_name' => rgar( $entry, '16' ), 		/* First Name */
			'last_name' => rgar( $entry, '24' ),  		/* Last Name */
			'title' => rgar( $entry, '17' ),  			/* Title */
			'email' => rgar( $entry, '20' ),  			/* Email */
			'phone' => rgar( $entry, '19' ), 			/* Phone */
			'lead_source' => rgar( $entry, '21' ), 		/* Lead Source */
			'oid' => rgar( $entry, '26' ), 				/* oid */
			'retURL' => rgar( $entry, '27' ),    		/* retURL   */
		);

		$request = new WP_Http();
		$response = $request->post( $post_url, array( 'body' => $body ) );

	} else if ( $form['title'] == "Tech Support" ) {

		$body = array(
			'first_name' => rgar( $entry, '3' ), 		/* First Name */
			'last_name' => rgar( $entry, '19' ),  		/* Last Name */
			'company' => rgar( $entry, '4' ), 			/* Company */
			'email' => rgar( $entry, '5' ),  			/* Email */
			'phone' => rgar( $entry, '6' ), 			/* Phone */
			'00N1a000003BGQM' => rgar( $entry, '8' ), 	/* Product */
			'00N1a000003BGQW' => rgar( $entry, '9' ), 	/* Serial Number */
			'00N1a000003BGQg' => rgar( $entry, '10' ), 	/* Description */
			'00N1a000003BGR0' => rgar( $entry, '13' ), 	/* Attention To: */
			'street' => rgar( $entry, '17.1' ), 		/* Address */
			'city' => rgar( $entry, '17.3' ), 			/* City */
			'state' => rgar( $entry, '17.4' ), 			/* State/Provence */
			'zip' => rgar( $entry, '17.5' ), 			/* Zip */
			'country' => rgar( $entry, '17.6' ), 		/* country */
			'00N1a000003BGRZ' => rgar( $entry, '18' ), 	/* RMA Recipient Phone: */
			'lead_source' => rgar( $entry, '20' ), 		/* Lead Source */
			'oid' => rgar( $entry, '22' ), 				/* oid */
			'retURL' => rgar( $entry, '21' ), 			/* retURL */
		);

		$request = new WP_Http();
		$response = $request->post( $post_url, array( 'body' => $body ) );

	} else if ( $form['title'] == "Warranty Registration" ) {

		$intendedUse = str_replace(',', ';', rgar( $entry, '10' ));

		$body = array(
			'first_name' => rgar( $entry, '18.3' ), 		/* First Name */
			'last_name' => rgar( $entry, '18.6' ),  		/* Last Name */
			'email' => rgar( $entry, '20' ),  			/* Email */
			'company' => rgar( $entry, '17.1' ), 			/* Company */
			'street' => rgar( $entry, '17.2' ), 		/* Address */
			'city' => rgar( $entry, '17.3' ), 			/* City */
			'state' => rgar( $entry, '17.4' ), 			/* State/Provence */
			'zip' => rgar( $entry, '17.5' ), 			/* Zip */
			'country' => rgar( $entry, '17.6' ), 			/* Country */
			'00N1a000009ZJqr' => rgar( $entry, '22' ), 	/* Light Engine Model */
			'00N1a000009ZJqw' => rgar( $entry, '9' ), 	/* Serial Number */
			'00N1a000009ZJr1' => rgar( $entry, '19' ), 	/* Date of Purchase */
			'00N1a000009ZJr6' => $intendedUse, 	/* Intended Use */
			'lead_source' => rgar( $entry, '25' ), 		/* Lead Source */
			'oid' => rgar( $entry, '27' ), 				/* oid */
			'retURL' => rgar( $entry, '26' ), 			/* retURL */
		);
		GFCommon::log_debug( 'gform_after_submission: body => ' . print_r( $body, true ) );

		$request = new WP_Http();
		$response = $request->post( $post_url, array( 'body' => $body ) );
		GFCommon::log_debug( 'gform_after_submission: response => ' . print_r( $response, true ) );

	}
}



/*

  enque custom js scripts

*/

function theme_js() {
	if(is_page(1168) || is_page(869) || is_page(1243)) {
    	wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/js/quote_page.js', array( 'jquery' ), '1.0', true );
    }
    if(is_page(735)) {
    	wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/js/media_page.js', array( 'jquery' ), '1.0', true );
    }
}

add_action('wp_enqueue_scripts', 'theme_js');








//* Create portfolio custom post type
add_action( 'init', 'divi_portfolio_post_type' );
function divi_portfolio_post_type() {

	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'          => __( 'Portfolio', 'divi' ),
				'singular_name' => __( 'Portfolio', 'divi' ),
			),
			'has_archive'  => true,
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-portfolio',
			'public'       => true,
			'rewrite'      => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
			'taxonomies'   => array( 'portfolio-type' ),

		)
	);

}

//* Change the number of portfolio items to be displayed (props Brad Dalton)
add_action( 'pre_get_posts', 'divi_portfolio_items' );
function divi_portfolio_items( $query ) {

	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '12' );
	}

}


add_action('gform_enqueue_scripts',"my_gform_enqueue_scripts", 10, 5);

function my_gform_enqueue_scripts($form, $is_ajax=false){

?>

<script>
// jQuery(document).ready(function($) {
//     $("label").each(function() {
//         var label = $(this);
//         var placeholder = label.text();
//         if(placeholder == "First") {
//           placeholder = "First Name";
//         }
//         if(placeholder == "Last") {
//           placeholder = "Last Name";
//         }
//         var input_id = label.attr("for");
//         $("#"+input_id).attr("placeholder", placeholder).val("");
//         $("#"+input_id).val(placeholder);
//         $("#ui-datepicker-div").delay(300).hide();
//     });
//   });
//   
</script>
<style type="text/css">
 .et_pb_section .et_pb_bg_layout_light .et_pb_more_button,
    .et_pb_section .et_pb_bg_layout_light .et_pb_promo_button {
   color: #c5402e !important;
    }

</style>
<?php
}

include('custom-shortcodes.php');
?>
