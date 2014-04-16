<?php/** * cwp Theme Customizer * * @package cwp *//** * Add postMessage support for site title and description for the Theme Customizer. * * @param WP_Customize_Manager $wp_customize Theme Customizer object. */function codeinwp_customize_register( $wp_customize ) {	$pages = array();	$default = array();	$args = array(		'sort_order' => 'ASC',		'sort_column' => 'post_title',		'hierarchical' => 0,		'exclude' => '',		'include' => '',		'meta_key' => '',		'meta_value' => '',		'authors' => '',		'child_of' => 0,		'parent' => -1,		'exclude_tree' => '',		'number' => '',		'offset' => 0,		'post_type' => 'page',		'post_status' => 'publish'	); 	$pages_tmp = get_pages($args); 	foreach ( $pages_tmp as $page ) {		$pages[$page->ID] = $page->post_title;		array_push($default, $page->ID);	}                $args_post = array(		'posts_per_page'   => -1,        'offset'           => 0,        'category'         => '',        'orderby'          => 'post_date',        'order'            => 'DESC',        'include'          => '',        'exclude'          => '',        'meta_key'         => '',        'meta_value'       => '',        'post_type'        => array('post','acme_product'),        'post_mime_type'   => '',        'post_parent'      => '',        'post_status'      => 'publish',        'suppress_filters' => true	); 	$pages_post = get_posts($args_post);                 	foreach ( $pages_post as $page_post ) {		$pages[$page_post->ID] = $page_post->post_title;							array_push($default, $page_post->ID);	}	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';		$wp_customize->remove_control( 'header_textcolor' );		/* logo */	$wp_customize->add_section( 'codeinwp_logo_section' , array(    	'title'       => __( 'Logo', 'cwp' ),    	'priority'    => 31,    	'description' => __('Upload a logo to replace the default site name and description in the header','cwp'),	) );	$wp_customize->add_setting( 'codeinwp_logo' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(	    'label'    => __( 'Logo', 'cwp' ),	    'section'  => 'codeinwp_logo_section',	    'settings' => 'codeinwp_logo',	) ) );		/* copyright */	$wp_customize->add_section( 'codeinwp_copyright_section', array(		'title'          => __( 'Copyright','cwp' ),		'priority'       => 32,	) );		$wp_customize->add_setting( 'codeinwp_copyright', array(		'default'        => '', 'sanitize_callback' => 'cwp_text_sanitization'	) );	$wp_customize->add_control( 'codeinwp_copyright', array(		'label'   => 'Copyright',		'section' => 'codeinwp_copyright_section',		'settings'   => 'codeinwp_copyright'	) );		/* header button */	$wp_customize->add_section( 'codeinwp_headerbutton_section', array(		'title'          => __( 'Header button','cwp' ),		'priority'       => 33,	) );		$wp_customize->add_setting(		'codeinwp_headerbutton',		array(			'default' => 'hide',		)	);	 	$wp_customize->add_control(		'codeinwp_headerbutton',		array(			'type' => 'radio',			'label' => '',			'section' => 'codeinwp_headerbutton_section',			'choices' => array(				'show' => 'Show',				'hide' => 'Hide'			),			'priority' => 1		)	);		$wp_customize->add_setting( 		'codeinwp_headerbutton_text', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control( 'codeinwp_headerbutton_text', array(		'label'   => 'Header button text',		'section' => 'codeinwp_headerbutton_section',		'settings'   => 'codeinwp_headerbutton_text',		'priority' => 2	) );		$wp_customize->add_setting( 		'codeinwp_headerbutton_link', 		array(			'default' => '','sanitize_callback' => 'esc_url_raw'		) 	);	$wp_customize->add_control( 'codeinwp_headerbutton_link', array(		'label'   => 'Header button link',		'section' => 'codeinwp_headerbutton_section',		'settings'   => 'codeinwp_headerbutton_link',		'priority' => 3	) );		/* TOP BANNER SECTION */		/* on witch pages to appear */	$wp_customize->add_section( 'codeinwp_topbanner_section', array(		'title'          => __( 'Top banner section','cwp' ),		'priority'       => 35,	) );	$wp_customize->add_setting( 'multiple_select_setting', array(		'default' => $default,	) );	 	$wp_customize->add_control(		new cwp_Customize_Control_Multiple_Select(			$wp_customize,			'multiple_select_setting',			array(				'settings' => 'multiple_select_setting',				'label'    => 'Select the pages you want to have a top banner(Hold CTRL)',				'section'  => 'codeinwp_topbanner_section',				'type'     => 'multiple-select',				'choices'  => $pages,				'priority' => 1			)		)	);		/* image */	$wp_customize->add_setting( 'top_banner_image' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'top_banner_image', array(	    'label'    => __( 'Choose an image for the top banner', 'cwp' ),	    'section'  => 'codeinwp_topbanner_section',	    'settings' => 'top_banner_image',		'priority' => 2	) ) );		/* title */	$wp_customize->add_setting( 'top_banner_title', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('top_banner_title', array(		'label'   => 'Enter a title for the top banner',		'section' => 'codeinwp_topbanner_section',		'settings'   => 'top_banner_title',		'priority' => 3	) );		/* text */	$wp_customize->add_setting( 'top_banner_text', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('top_banner_text', array(		'label'   => 'Enter a text for the top banner',		'section' => 'codeinwp_topbanner_section',		'settings'   => 'top_banner_text',		'priority' => 4	) );			/* END - TOP BANNER SECTION */			/* FOOTER section with boxes and social icons */		/* on witch pages to appear */	$wp_customize->add_section( 'codeinwp_footer_section', array(		'title'          => __( 'Footer section with boxes and social icons','cwp' ),		'priority'       => 36,	) );	$wp_customize->add_setting( 'multiple_select_setting_footer', array(		'default' => $default,	) );	 	$wp_customize->add_control(		new cwp_Customize_Control_Multiple_Select(			$wp_customize,			'multiple_select_setting_footer',			array(				'settings' => 'multiple_select_setting_footer',				'label'    => 'Select the pages you want to have the footer section(Hold CTRL)',				'section'  => 'codeinwp_footer_section',				'type'     => 'multiple-select',				'choices'  => $pages,				'priority' => 1			)		)	);		/* background image */	$wp_customize->add_setting( 'footer_section_image' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_section_image', array(	    'label'    => __( 'Choose an image for the footer section', 'cwp' ),	    'section'  => 'codeinwp_footer_section',	    'settings' => 'footer_section_image',		'priority' => 2	) ) );		/* section1 - title */	$wp_customize->add_setting( 'footer_section_title1', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_title1', array(		'label'   => 'Enter a title for the first box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_title1',		'priority' => 3	) );		/* section1 - text */	$wp_customize->add_setting( 'footer_section_text1', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_text1', array(		'label'   => 'Enter a text for the first box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_text1',		'priority' => 4	) );		/* section2 - title */	$wp_customize->add_setting( 'footer_section_title2', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_title2', array(		'label'   => 'Enter a title for the second box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_title2',		'priority' => 5	) );		/* section2 - text */	$wp_customize->add_setting( 'footer_section_text2', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_text2', array(		'label'   => 'Enter a text for the second box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_text2',		'priority' => 6	) );		/* section3 - title */	$wp_customize->add_setting( 'footer_section_title3', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_title3', array(		'label'   => 'Enter a title for the third box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_title3',		'priority' => 7	) );		/* section3 - text */	$wp_customize->add_setting( 'footer_section_text3', 		array(			'default' => '', 'sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('footer_section_text3', array(		'label'   => 'Enter a text for the third box',		'section' => 'codeinwp_footer_section',		'settings'   => 'footer_section_text3',		'priority' => 8	) );		/* facebook link */	$wp_customize->add_setting( 'facebook', 		array(			'default' => '#','sanitize_callback' => 'esc_url_raw'		) 	);	$wp_customize->add_control('facebook', array(		'label'   => 'Enter the facebook link',		'section' => 'codeinwp_footer_section',		'settings'   => 'facebook',		'priority' => 9	) );		/* twitter link */	$wp_customize->add_setting( 'twitter', 		array(			'default' => '#','sanitize_callback' => 'esc_url_raw'		) 	);	$wp_customize->add_control('twitter', array(		'label'   => 'Enter the twitter link',		'section' => 'codeinwp_footer_section',		'settings'   => 'twitter',		'priority' => 10	) );		/* linkedin link */	$wp_customize->add_setting( 'linkedin', 		array(			'default' => '#','sanitize_callback' => 'esc_url_raw'		) 	);	$wp_customize->add_control('linkedin', array(		'label'   => 'Enter the linkedin link',		'section' => 'codeinwp_footer_section',		'settings'   => 'linkedin',		'priority' => 11	) );		/* END - FOOTER section with boxes and social icons */		/* SINGLE PAGE featured image */	$wp_customize->add_section( 'codeinwp_singlefeaturedimage_section', array(		'title'          => __( 'Single page featured image','cwp' ),		'priority'       =>37,	) );		$wp_customize->add_setting('fi_single', array(        'default'        => 'show'    ));     $wp_customize->add_control('fi_single', array(        'label'      => __('Show or hide featured image on single page', 'cwp'),        'section'    => 'codeinwp_singlefeaturedimage_section',        'settings'   => 'fi_single',        'type'       => 'radio',        'choices'    => array(            'show' => 'Show',            'hide' => 'Hide'        ),    ));	/* END - SINGLE PAGE featured image */			/* FRONT-PAGE/ARCHIVE/SEARCH page featured image */	$wp_customize->add_section( 'codeinwp_featuredimage_section', array(		'title'          => __( 'First page, archive page and search page featured image','cwp' ),		'priority'       => 39,	) );		$wp_customize->add_setting('fi_index', array(        'default'        => 'show'    ));     $wp_customize->add_control('fi_index', array(        'label'      => __('Show or hide featured image on first page, archive page and search page', 'cwp'),        'section'    => 'codeinwp_featuredimage_section',        'settings'   => 'fi_index',        'type'       => 'radio',        'choices'    => array(            'show' => 'Show',            'hide' => 'Hide'        ),    ));	/* END - FRONT-PAGE/ARCHIVE/SEARCH page featured image */		/* FRONT-PAGE/ARCHIVE/SEARCH page featured image */	$wp_customize->add_section( 'codeinwp_pagefeaturedimage_section', array(		'title'          => __( 'Featured image on pages','cwp' ),		'priority'       => 40,	) );		$wp_customize->add_setting('fi_pages', array(        'default'        => 'show'    ));     $wp_customize->add_control('fi_pages', array(        'label'      => __('Show or hide featured image on pages', 'cwp'),        'section'    => 'codeinwp_pagefeaturedimage_section',        'settings'   => 'fi_pages',        'type'       => 'radio',        'choices'    => array(            'show' => 'Show',            'hide' => 'Hide'        ),    ));	/* END - FRONT-PAGE/ARCHIVE/SEARCH page featured image */		/* FRONT PAGE SLIDER */	$wp_customize->add_section( 'codeinwp_slider_section', array(		'title'          => __( 'Slider section on first page','cwp' ),		'priority'       => 41,	) );	/* show or hide slider */	$wp_customize->add_setting('slider_index', array(        'default'        => 'show'    ));     $wp_customize->add_control('slider_index', array(        'label'      => __('Show or hide slider on front page', 'cwp'),        'section'    => 'codeinwp_slider_section',        'settings'   => 'slider_index',        'type'       => 'radio',        'choices'    => array(            'show' => 'Show',            'hide' => 'Hide'        ),    ));		/* first slide image */	$wp_customize->add_setting( 'slider_image1' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image1', array(	    'label'    => __( 'Choose first image for slider', 'cwp' ),	    'section'  => 'codeinwp_slider_section',	    'settings' => 'slider_image1',		'priority' => 1	) ) );		/* second slide image */	$wp_customize->add_setting( 'slider_image2' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image2', array(	    'label'    => __( 'Choose second image for slider', 'cwp' ),	    'section'  => 'codeinwp_slider_section',	    'settings' => 'slider_image2',		'priority' => 2	) ) );		/* third slide image */	$wp_customize->add_setting( 'slider_image3' );	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image3', array(	    'label'    => __( 'Choose third image for slider', 'cwp' ),	    'section'  => 'codeinwp_slider_section',	    'settings' => 'slider_image3',		'priority' => 3	) ) );		/* first image big title */	$wp_customize->add_setting( 'slider_bigtitle1', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_bigtitle1', array(		'label'   => 'Enter a title to appear on the right side of the first slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_bigtitle1',		'priority' => 4	) );			/* second image big title */	$wp_customize->add_setting( 'slider_bigtitle2', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_bigtitle2', array(		'label'   => 'Enter a title to appear on the right side of the second slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_bigtitle2',		'priority' => 5	) );	/* third image big title */	$wp_customize->add_setting( 'slider_bigtitle3', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_bigtitle3', array(		'label'   => 'Enter a title to appear on the right side of the third slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_bigtitle3',		'priority' => 6	) );			/* first image title */	$wp_customize->add_setting( 'slider_title1', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_title1', array(		'label'   => 'Enter a title to appear on the left side of the first slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_title1',		'priority' => 7	) );			/* second image title */	$wp_customize->add_setting( 'slider_title2', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_title2', array(		'label'   => 'Enter a title to appear on the left side of the second slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_title2',		'priority' => 8	) );	/* third image title */	$wp_customize->add_setting( 'slider_title3', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_title3', array(		'label'   => 'Enter a title to appear on the left side of the third slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_title3',		'priority' => 9	) );		/* first image text*/	$wp_customize->add_setting( 'slider_text1', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_text1', array(		'label'   => 'Enter a text to appear on the left side of the first slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_text1',		'priority' => 7	) );			/* second image text */	$wp_customize->add_setting( 'slider_text2', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_text2', array(		'label'   => 'Enter a text to appear on the left side of the second slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_text2',		'priority' => 8	) );	/* third image text */	$wp_customize->add_setting( 'slider_text3', 		array(			'default' => '','sanitize_callback' => 'cwp_text_sanitization'		) 	);	$wp_customize->add_control('slider_text3', array(		'label'   => 'Enter a text to appear on the left side of the third slide',		'section' => 'codeinwp_slider_section',		'settings'   => 'slider_text3',		'priority' => 9	) );			/* END - FRONT PAGE SLIDER */}add_action( 'customize_register', 'codeinwp_customize_register' );/** * Binds JS handlers to make Theme Customizer preview reload changes asynchronously. */function cwp_customize_preview_js() {	wp_enqueue_script( 'cwp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );}add_action( 'customize_preview_init', 'cwp_customize_preview_js' );function cwp_text_sanitization( $input ) {    return wp_kses_post( force_balance_tags( $input ) );}if( class_exists( 'WP_Customize_Control' ) ):class Example_Customize_Textarea_Control extends WP_Customize_Control {    public $type = 'textarea';     public function render_content() {        ?>        <label>        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>        </label>        <?php    }}/** * Multiple select customize control class. */class cwp_Customize_Control_Multiple_Select extends WP_Customize_Control {    /**     * The type of customize control being rendered.     */    public $type = 'multiple-select';    /**     * Displays the multiple select on the customize screen.     */    public function render_content() {    if ( empty( $this->choices ) )        return;    ?>        <label>            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>            <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">                <?php                    foreach ( $this->choices as $value => $label ) {                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';                    }                ?>            </select>        </label>    <?php }}endif;