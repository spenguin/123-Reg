<?php

/**
 * Foundation 6 Shortcodes
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */ 

if ( ! defined( 'ABSPATH' ) ) exit;

$fp_globals = array( 
	
	//Tabs
	'counter_tabs' => 0, 
	'counter_tab_wraps' => 0, 
	'tab_id' => '', 
	'tab_title'=> '', 

	//Accordion 
	'counter_accordion' => 0, 
	'counter_accordion_wraps' => 0, 
	'accordion_id' => '', 

	//Menu
	'nested_class' => '', 

	//Orbit
	'counter_orbit' => 0, 
	'orbit_container' => '', 

	//Reveal
	'reveal_id' =>'', 

	//Tooltip
	'counter_tips' => 0, 

	//Equalizer
	'equalizer_watch' => '', 
	'row_equalizer_watch' => '', 

	//Carousel
	'owl_id' =>'', 

	//General
	'open_tab' => 'is-active', 
	'vertical_class' => 'vertical'
 );

new FP_Tabs;
new FP_Accordion;
new FP_Menu;
new FP_Button;
new FP_Callout;
new FP_Dropdown;
new FP_Video;
new FP_Interchange;
new FP_Label;
new FP_Orbit;
new FP_Progress;
new FP_Reveal;
new FP_Tooltip;
new FP_Visible;
new FP_Float;
new FP_Grid;
new FP_Carousel;


/**
 * Tabs Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Tabs { 
	
	public function __construct() { 
		add_shortcode( 'fp-tabs', array( $this, 'fp_tabs' ) );
		add_shortcode( 'fp-tab', array( $this, 'fp_tab' ) );
	 }

	public function fp_tabs( $atts, $content ) { 
		global $fp_globals;
		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place here the shortcode tags for single tab.', 'fp-foundation-assistant' ), 
				'vertical' =>'', 
				'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$fp_globals[ 'id' ] = 'id-'.uniqid();			
		$fp_globals[ 'counter_tab_wraps' ]++;
		$fp_globals[ 'counter_tabs' ] = 0;
		$fp_globals[ 'tab_title' ] = true;	

		if ( !empty( $class ) ) { $html = '<div class="'.esc_html( $class ).'">'; } else { $html = ''; }
			
		if ( $vertical == 'true' ) { 
			$html .= '<div class="row collapse"><div class="medium-3 columns"><ul id="'.esc_html( $fp_globals[ 'id' ] ).'" class="tabs '.esc_html( $fp_globals[ 'vertical_class' ] ).'" data-tabs >';

		 } else { 
			$html .= '<div class="fp-tabs-wrap"><ul id="'.esc_html( $fp_globals[ 'id' ] ).'" class="tabs" data-tabs>';
		 }

		$html .=  do_shortcode( $content );
		$html .= '</ul>';

		if ( $vertical == 'true' ) { 
			$html .= '</div><div class="medium-9 columns">';
		 }
		
		$fp_globals[ 'counter_tabs' ] = 0;
		$fp_globals[ 'tab_title' ] = false;

		$html .= '<div class="tabs-content" data-tabs-content="'.esc_html( $fp_globals[ 'id' ] ).'">';
		$html .=  do_shortcode( $content );
		$html .= '</div></div>';

		if ( $vertical == 'true' ) { 
			$html .= '</div>';
		 }

		if ( !empty( $class ) ) { $html .= '</div>'; }

        return $html;
	 }

	public function fp_tab( $atts, $content = null ){ 
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		$fp_globals[ 'counter_tabs' ]++;
		$fp_globals[ 'tab_id' ] = '00'.$fp_globals[ 'counter_tab_wraps' ].'-tab-0'.$fp_globals[ 'counter_tabs' ];

		$atts = shortcode_atts( array( 
				'title' => __( 'Tab Title ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_tabs' ], 
                'open' =>'', 
                'content' => !empty( $content ) ? $content : __( 'Tab Content ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_tabs' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' '.$class; } 
		
		if ( $fp_globals[ 'tab_title' ] ){ 

			if ( $open == 'true' ) { 
				$html = "<li class='tabs-title  ".esc_html( $fp_globals[ 'open_tab' ] )."'><a href=#".esc_html( $fp_globals[ 'tab_id' ] ).">". esc_html( $title ) ."</a></li>";
			 } else { 
				$html = "<li class='tabs-title'><a href=#".esc_html( $fp_globals[ 'tab_id' ] ).">". esc_html( $title ) ."</a></li>";
			 }	

		 } else { 

			if ( $open == 'true' ) { 				
				$html = "<div id='".esc_html( $fp_globals[ 'tab_id' ] )."' class='tabs-panel ".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."'>". do_shortcode( $content )."</div>";
			 } else { 
				$html = "<div id='".esc_html( $fp_globals[ 'tab_id' ] )."' class='tabs-panel".esc_html( $class )."'>". do_shortcode( $content )."</div>";
			 }	
		 }
		
                return $html;
        }

 }

/**
 * Accordion Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Accordion { 
	
	public function __construct() { 
		add_shortcode( 'fp-accordion-wrap', array( $this, 'fp_accordion_wrap' ) );
		add_shortcode( 'fp-accordion', array( $this, 'fp_accordion' ) );
	 }

	public function fp_accordion_wrap( $atts, $content ) { 
		global $fp_globals;

		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );
		$fp_globals[ 'counter_accordion_wraps' ]++;
		$fp_globals[ 'counter_accordion' ] = 0;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place here the shortcode tags for single accordion item.', 'fp-foundation-assistant' ), 
				'multiexpand' => '', 
				'allclosed' =>'', 
				'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' '.$class; }
		
		if ( $multiexpand == 'true' ) { 
			$html = '<ul class="accordion'.esc_html( $class ).'" data-accordion data-multi-expand="true">';	
		 } elseif ( $allclosed == 'true' ) { 
			$html = '<ul class="accordion'.esc_html( $class ).'" data-accordion data-allow-all-closed="true">';	
		 } else { 
			$html = '<ul class="accordion'.esc_html( $class ).'" data-accordion>';		
		 }

		$html .=  do_shortcode( $content );
		$html .= '</ul>';

        return $html;
	 }

	public function fp_accordion( $atts, $content = null ){ 
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		$fp_globals[ 'counter_accordion' ]++;
		$fp_globals[ 'accordion_id' ] = '00'.$fp_globals[ 'counter_accordion_wraps' ].'-accordion-0'.$fp_globals[ 'counter_accordion' ];

		$atts = shortcode_atts( array( 
				'title' => __( 'Accordion Title ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_accordion' ], 
                'open' =>'', 
                'content' => !empty( $content ) ? $content : __( 'Accordion Content ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_accordion' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

			if ( !empty( $class ) ) { $class = ' '.$class; }
		
			if ( $open == 'true' ) { 				
				$html = "<li class='accordion-item ".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."' data-accordion-item>";
			 } else { 
				$html = "<li class='accordion-item".esc_html( $class )."' data-accordion-item>";
			 }	

			$html .= "<a id='".esc_html( $fp_globals[ 'accordion_id' ] ).'-heading'."' class='accordion-title' href='".esc_html( $fp_globals[ 'accordion_id' ] )."'>".esc_html( $title )."</a>";
			$html .= "<div id='".esc_html( $fp_globals[ 'accordion_id' ] )."' class='accordion-content' data-tab-content>". do_shortcode( $content )."</div>";

			$html .= "</li>";
	
            return $html;
        }


 }

/**
 * Menu Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Menu { 
	
	public function __construct() { 
		add_shortcode( 'fp-menu', array( $this, 'fp_menu' ) );
		add_shortcode( 'fp-menu-item', array( $this, 'fp_menu_item' ) );
		add_shortcode( 'fp-menu-nested', array( $this, 'fp_menu_nested' ) );
		add_shortcode( 'fp-submenu-item', array( $this, 'fp_submenu_item' ) );
	 }


	public function fp_menu( $atts, $content ) { 
		global $fp_globals;
		$content = str_replace( array( '</p>', '<p>' ), array( '', '' ), $content );
		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );


		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Menu Wrap', 'fp-foundation-assistant' ), 
				'type' => '', 
				'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if( !empty( $class ) ) { $class = ' '.$class; }

		if( $type =='vertical' ) { 
			$html = '<ul class="menu vertical'.esc_html( $class ).'">';
		 } elseif ( $type =='accordion' ) { 
			$html = '<ul class="menu vertical'.esc_html( $class ).'" data-accordion-menu>';
		 } elseif ( $type =='dropdown' ) { 
			$html = '<ul class="menu dropdown'.esc_html( $class ).'" data-dropdown-menu>';
		 } elseif ( $type =='drilldown' ) { 
			$html = '<ul class="menu vertical'.esc_html( $class ).'" data-drilldown>';
		 } else { 
			$html = '<ul class="menu dropdown'.esc_html( $class ).'" data-dropdown-menu>';
		 }
		
		$html .=  do_shortcode( $content );
		$html .= '</ul>';
		

        return $html;
	 }

	public function fp_menu_item( $atts, $content ){ 
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );
        $content = str_replace( array( '</p>', '<p>' ), array( '', '' ), $content );
		$atts = shortcode_atts( array( 
				'link' => __( 'Place your link here', 'fp-foundation-assistant' ), 
                'content' => !empty( $content ) ? $content : '', 
                'title' => __( 'Menu Title', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

				if ( !empty( $class ) ) { $class = ' class='.$class; }
				
				$html = '<li'.esc_html( $class ).'><a href="'.esc_url( $link ).'">'.esc_html( $title ).'</a>'. do_shortcode( $content ).'</li>';
		
                return $html;
    }

    public function fp_menu_nested( $atts, $content ) { 
		global $fp_globals;

		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );
		$content = str_replace( array( '</p>', '<p>' ), array( '', '' ), $content );

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Submenu Wrap', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if( !empty( $class ) ) { $class = ' '.$class; }

		$html = '<ul class="menu vertical'.esc_html( $class ).'">';		
		$html .=  do_shortcode( $content );
		$html .= '</ul>';		

        return $html;
	 }

    public function fp_submenu_item( $atts, $content ){ 
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );
        $content = str_replace( array( '</p>', '<p>' ), array( '', '' ), $content );

		$atts = shortcode_atts( array( 
				'link' => __( 'Place your link here', 'fp-foundation-assistant' ), 
                'content' => !empty( $content ) ? $content : '', 
                'title' => __( 'Submenu Title', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

			if ( !empty( $class ) ) { $class = ' class='.$class; }			
			$html = '<li'.esc_html( $class ).'><a href="'.esc_url( $link ).'">'.esc_html( $title ).'</a>'. do_shortcode( $content ).'</li>';

            return $html;
    }
 }

/**
 * Button Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Button { 
	
	public function __construct() { 
		add_shortcode( 'fp-button', array( $this, 'fp_button' ) );
	 }


	public function fp_button( $atts, $content ) { 
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Button', 'fp-foundation-assistant' ), 
				'type' => '', 
				'size' => '', 
				'color' => '', 
				'hollow' =>'', 
				'dropdown' =>'', 
				'link' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$button_classes = array();

		if ( in_array( $size, array( 'tiny', 'small', 'large', 'expanded' ), true ) ) { $button_classes[] = $size.' '; }
		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'warning', 'disabled' ), true ) ) { $button_classes[] = $color.' '; } 
		if ( $hollow == 'true' ) { $button_classes[] = 'hollow '; } 
		if ( $dropdown == 'true' ) { $button_classes[] = 'dropdown '; }
		if ( !empty( $class ) ) { $class = $class.' '; }

		if ( is_array( $button_classes ) ) { $button_classes = implode( " ", $button_classes ); }	
		if ( !empty( $class ) ) { $class = $class.' '; }	

		if ( $type =='link' ) { 
			$html = '<a href="'.esc_html( esc_url( $link ) ).'" class="'.esc_html( $button_classes ).esc_html( $class ).'button">';
		 } else { 
			$link = '';
			if ($type == 'submit') { $type = ' type=submit'; } else if ($type == 'reset') { $type = ' type=reset'; } else { $type = '';}
			$html = '<button class="'.esc_html( $button_classes ).esc_html( $class ).'button"'.esc_html( $type ).'>';
		 }
		
		$html .=  do_shortcode( $content );

		if ( $type =='link' ) { 
			$html .= '</a>';
		 } else { 
			$html .= '</button>';
		 }
		
        return $html;
	 }

 }

/**
 * Callout Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Callout { 
	
	public function __construct() { 
		add_shortcode( 'fp-callout', array( $this, 'fp_callout' ) );
	 }


	public function fp_callout( $atts, $content ) { 
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Callout', 'fp-foundation-assistant' ), 
				'size' => '', 
				'color' => '', 
				'closable' =>'', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$callout_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'warning', 'primary' ), true ) ) { $callout_classes[] = $color.' '; } 
		if ( in_array( $size, array( 'small', 'large' ), true ) ) { $callout_classes[] = $size.' '; }
		if ( !empty( $class ) ) { $class = $class.' '; }	

		if ( is_array( $callout_classes ) ) { $callout_classes = implode( " ", $callout_classes ); }	

		if ( $closable == 'true' ) { 
			$html = '<div class="'.esc_html( $callout_classes ).esc_html( $class ).'callout" data-closable>';
		 } else { 
			$html = '<div class="'.esc_html( $callout_classes ).esc_html( $class ).'callout">';
		 }

		$html .=  do_shortcode( $content );

		if ( $closable == 'true' ) { 
			$html .= '<button class="close-button" aria-label="'.__( 'Dismiss alert', 'fp-foundation-assistant' ).'" type="button" data-close><span aria-hidden="true">&times;</span></button></div>';
		 } else { 
			$html .= '</div>';
		 }
		
        return $html;
	 }

 }

/**
 * Dropdown
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Dropdown { 
	
	public function __construct() { 
		add_shortcode( 'fp-dropdown', array( $this, 'fp_dropdown' ) );
	 }

	public function fp_dropdown( $atts, $content ) { 

		global $fp_globals;

		$fp_globals[ 'id' ] = 'id-'.uniqid();	

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Dropdown Content', 'fp-foundation-assistant' ), 
				'id' => $fp_globals[ 'id' ], 
				'title' => __( 'Dropdown Title', 'fp-foundation-assistant' ), 
				'position' => '', 
				'hover'=> '',
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( $hover == 'true' ) { $hover = ' data-hover="true"'; } 
		if ( in_array( $position, array( 'top', 'right', 'bottom' ), true ) ) { $position = ' '.$position; } else { $position = ''; }
		if ( !empty( $class ) ) { $class = $class.' '; }	

		$html = '<button class="'.esc_html( $class ).'button" type="button" data-toggle="'.esc_html( $id ).'">'.esc_html( $title ).'</button>';
		$html .= '<div class="dropdown-pane'.esc_html( $position ).'" id="'.esc_html( $id ).'" data-dropdown'. esc_html($hover).'>';		
		$html .=  do_shortcode( $content );
		$html .= '</div>';
	
        return $html;
	 }

 }

/**
 * Video Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Video { 
	
	public function __construct() { 
		add_shortcode( 'fp-video', array( $this, 'fp_video' ) );
	 }

	public function fp_video( $atts, $content ) { 
		
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'link' => __( 'Embed Video Link', 'fp-foundation-assistant' ), 
				'width' => 420, 
				'height' => 315, 
				'widescreen' => '', 
				'vimeo' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$video_classes = array();

		if ( $widescreen == 'true' ) { $video_classes[] = 'widescreen'; } 
		if ( $vimeo == 'true' ) { $video_classes[] = 'vimeo'; } 
		if ( !empty( $class ) ) { $class = ' '.$class; }

		if ( is_array( $video_classes ) ) { $video_classes = ' '. implode( " ", $video_classes ); }

		$html = '<div class="flex-video'.esc_html( $video_classes ).esc_html( $class ).'">';
		$html .= '<iframe width="'.absint( esc_html( $width ) ).'" height="'.absint( esc_html( $height ) ).'" src="'.esc_url( $link ).'" frameborder="0" allowfullscreen></iframe>';		
		$html .= '<p class="fp-video-caption">'.do_shortcode( $content ).'</p>';
		$html .= '</div>';
	
        return $html;
	 }
 }

/**
 * Interchange Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Interchange { 
	
	public function __construct() { 
		add_shortcode( 'fp-interchange', array( $this, 'fp_interchange' ) );
	 }

	public function fp_interchange( $atts, $content ) { 
		
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'small' => __( 'Embed Link for Small Screen', 'fp-foundation-assistant' ), 
				'medium' => __( 'Embed Link for Medium Screen', 'fp-foundation-assistant' ), 
				'large' => __( 'Embed Link for Large Screen', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' class='.$class; }	

			$html = '<img'.esc_html( $class ).' data-interchange="';
			$html .= '[ '.esc_url( $small ).', small],';		
			$html .= '[ '.esc_url( $medium ).', medium],';	
			$html .= '[ '.esc_url( $large ).', large]">';	
			$html .= '<p>'.do_shortcode( $content ).'</p>';
			$html .= '</img>';	
		
        return $html;
	 }

 }

/**
 * Label Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Label { 
	
	public function __construct() { 
		add_shortcode( 'fp-label', array( $this, 'fp_label' ) );
	 }

	public function fp_label( $atts, $content ) { 
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Label', 'fp-foundation-assistant' ), 
				'color' => '', 
				'id' =>'', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		!empty( $id ) ? $id = ' id='.$id.' ' : '';

		$label_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'warning' ), true ) ) { $label_classes[] = $color.' '; } 
		if ( !empty( $class ) ) { $class = $class.' '; }

		if ( is_array( $label_classes ) ) { $label_classes = implode( " ", $label_classes ); }

		$html = '<span'.esc_html( $id ).' class="'.esc_html( $label_classes ).esc_html( $class ).'label">';
		$html .=  do_shortcode( $content );
		$html .= '</span>';

        return $html;
	 }

 }

/**
 * Orbit Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Orbit { 
	
	public function __construct() { 
		add_shortcode( 'fp-orbits', array( $this, 'fp_orbits' ) );
		add_shortcode( 'fp-orbit', array( $this, 'fp_orbit' ) );
	 }

	public function fp_orbits( $atts, $content ) { 
		global $fp_globals;
		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place here the shortcode tags for the single orbit slide.', 'fp-foundation-assistant' ), 
				'label' => __( 'orbit-label', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' '.$class; }	

		$fp_globals[ 'counter_orbit' ] = 0;
		$fp_globals[ 'orbit_container' ] = true;		

		$html = '<div class="orbit" role="region" aria-label="'.esc_html( $label ).'" data-orbit>';
		$html .= '<button class="orbit-previous"><span class="show-for-sr">'.__( 'Previous Slide', 'fp-foundation-assistant' ).'</span> &#9664;&#xFE0E;</button>';
		$html .= '<button class="orbit-next"><span class="show-for-sr">'.__( 'Next Slide', 'fp-foundation-assistant' ).'</span> &#9654;&#xFE0E;</button>';
		$html .= '<ul class="orbit-container'.esc_html( $class ).'">';
		$html .=  do_shortcode( $content );
		$html .= '</ul>';
		
		$fp_globals[ 'counter_orbit' ] = 0;
		$fp_globals[ 'orbit_container' ]  = false;

		$html .= '<nav class="orbit-bullets">';
		$html .=  do_shortcode( $content );
		$html .= '</nav>';

		$html .= '</div>';

        return $html;		

	 }

	public function fp_orbit( $atts, $content = null ){ 
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		$fp_globals[ 'counter_orbit' ]++;

		$atts = shortcode_atts( array( 
				'title' => __( 'Slide ', 'fp-foundation-assistant' ).$fp_globals[ 'orbit_container' ], 
                'open' =>'', 
                'content' => !empty( $content ) ? $content : __( 'Slide ', 'fp-foundation-assistant' ).$fp_globals[ 'orbit_container' ].__( ' Content', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' '.$class; }	
		
		if ( $fp_globals[ 'orbit_container' ] ){ 

			if ( $open == 'true' ) { 
				$html = "<li class='orbit-slide ".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."'>". do_shortcode( $content )."</li>";
			 } else { 
				$html = "<li class='orbit-slide".esc_html( $class )."'>". do_shortcode( $content )."</li>";
			 }	

		 } else { 

			if ( $open == 'true' ) { 				
				$html = "<button class=".esc_html( $fp_globals[ 'open_tab' ] )." data-slide=".absint( esc_html( $fp_globals[ 'counter_orbit' ] ) ).">";
				$html .= "<span class='show-for-sr'>".esc_html( $title )."</span><span class='show-for-sr'>".__( 'Current Slide', 'fp-foundation-assistant' )."</span></button>";
			 } else { 
				$html = "<button data-slide=".absint( esc_html( $fp_globals[ 'counter_orbit' ] ) ).">";
				$html .= "<span class='show-for-sr'>".esc_html( $title )."</span></button>";				
			 }	
		 }
		
                return $html;
        }

 }

/**
 * Progress Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Progress { 
	
	public function __construct() { 
		add_shortcode( 'fp-progress', array( $this, 'fp_progress' ) );
	 }

	public function fp_progress( $atts, $content ) { 
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'color' => '', 
				'current' => 0, 
				'max' => 100, 
				'min' => 0, 
				'text' =>'', 
				'aria_text' =>'', 
				'width' => 50, 
				// 'progress' =>'', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		!empty( $aria_text ) ? $aria_text= ' aria-valuetext="'.$aria_text.'"' : '';
		!empty( $text ) ? $text : '';

		$progress_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'warning' ), true ) ) { $progress_classes[] = $color.' '; } 
		if ( !empty( $class ) ) { $class = $class.' '; }		

		if ( is_array( $progress_classes ) ) { $progress_classes = implode( " ", $progress_classes ); }	

		$html = '<div class="'.esc_html( $progress_classes ).esc_html( $class ).'progress" role="progressbar" tabindex="0" aria-valuenow="'.intval( esc_html( $current ) ).'" aria-valuemin="'.intval( esc_html( $min ) ).'" aria-valuemax="'.intval( esc_html( $max ) ).'"'.esc_html( $aria_text ).'>';
		$html .= '<div class="progress-meter" style="width:'.intval( esc_html( $width ) ).'%">';
		$html .=  "<p class='progress-meter-text'>".esc_html( $text )."</p>";
		$html .=  do_shortcode( $content );
		$html .= '</div></div>';

        return $html;
	 }

 }

/**
 * Reveal Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Reveal { 
	
	public function __construct() { 
		add_shortcode( 'fp-reveal', array( $this, 'fp_reveal' ) );
	 }

	public function fp_reveal( $atts, $content ) { 

		global $fp_globals;
		$fp_globals[ 'reveal_id' ] = 'reveal_id_'.uniqid();

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'size' =>'', 
				'overlay' => '', 
				'title' => __( 'Click here for a modal', 'fp-foundation-assistant' ), 
				'id' =>$fp_globals[ 'reveal_id' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );
		
		if ( in_array( $size, array( 'tiny', 'small', 'large', 'full' ), true ) ) { $size = $size.' '; } else { $size = ''; }
		if ( $overlay == 'false' ) { $overlay = ' data-overlay=false'; } else { $overlay = ''; }
		if ( $title == '' ) { $title = __( 'Click here for a modal', 'fp-foundation-assistant' ); } 
		if ( !empty( $class ) ) { $class = $class.' '; }	

		$html = '<div class="'.esc_html( $size ).esc_html( $class ).'reveal" id="'.esc_html( $id ).'" data-reveal'.esc_html( $overlay ).'>';
		$html .=  do_shortcode( $content );
		$html .= '<button class="close-button" data-close aria-label="'.__( 'Close modal', 'fp-foundation-assistant' ).'" type="button"><span aria-hidden="true">&times;</span></button></div>';
		$html .= '<p><a data-open="'.esc_html( $id ).'">'.esc_html( $title ).'</a></p>';

        return $html;
	 }

 }

/**
 * Tooltip Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Tooltip { 
	
	public function __construct() { 
		add_shortcode( 'fp-tooltip', array( $this, 'fp_tooltip' ) );
	 }

	public function fp_tooltip( $atts, $content ) { 

		global $fp_globals;

		$fp_globals[ 'counter_tips' ]++;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place Content Here', 'fp-foundation-assistant' ), 				
				'title' =>__( 'Place the description text here.', 'fp-foundation-assistant' ), 
				'position'=>'', 
				'hover'=>'', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$tooltip_classes = array();

		if ( in_array( $position, array( 'top', 'right', 'left' ), true ) ) { $tooltip_classes[] = ' '.$position; } 
		if ( $title == '' ) { $title = __( 'Place the description text here.' , 'fp-foundation-assistant' ); } 
		if ( !empty( $class ) ) { $class = ' '.$class; }

		if ( is_array( $tooltip_classes ) ) { $tooltip_classes = implode( " ", $tooltip_classes ); }

		if( $hover =='true' ) { 
			$html = '<span data-tooltip aria-haspopup="true" class="has-tip'.esc_html( $tooltip_classes ).esc_html( $class ).'" data-disable-hover="false" tabindex="'.absint( esc_html( $fp_globals[ 'counter_tips' ] ) ).'" title="'.esc_html( $title ).'">';
		 } else { 
			$html = '<span data-tooltip aria-haspopup="true" class="has-tip'.esc_html( $tooltip_classes ).esc_html( $class ).'" data-disable-hover="true" tabindex="'.absint( esc_html( $fp_globals[ 'counter_tips' ] ) ).'" title="'.esc_html( $title ).'">';
		 }

		$html .=  do_shortcode( $content );
		$html .= '</span>';

        return $html;
	 }

 }

/**
 * Visible Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Visible { 
	
	public function __construct() { 
		add_shortcode( 'fp-visible', array( $this, 'fp_visible' ) );
	 }

	public function fp_visible( $atts, $content ) { 

		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place Content Here', 'fp-foundation-assistant' ), 	
				'show_small_only' => '', 
				'hide_small_only' => '', 
				'show_medium' => '', 
				'show_medium_only' => '', 
				'hide_medium' => '', 
				'hide_medium_only' => '',    
				'show_large' => '', 
				'show_large_only' => '', 
				'hide_large' => '', 
				'hide_large_only' => '', 
				'show_xlarge' => '', 
				'hide_xlarge' => '', 
				'show_xlarge_only' => '', 
				'hide_xlarge_only' => '', 
				'show_xxlarge' => '', 
				'hide_xxlarge' => '', 
				'show_landscape' => '', 
				'hide_landscape' => '', 
				'show_portrait' => '', 
				'hide_portrait' => '', 
				'show_sr' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$visibility_class = array();

		if ( $show_small_only  == 'true' )  { $show_small_only  = 	array( 'size' => 'show_small_only', 	'class' => 'show-for-small-only' ); } else { $show_small_only = ''; }
		if ( $hide_small_only  == 'true' )  { $hide_small_only  = 	array( 'size' => 'hide_small_only', 	'class' => 'hide-for-small-only' ); } else { $hide_small_only = ''; }
		if ( $show_medium  	  == 'true' ) 	{ $show_medium      = 	array( 'size' => 'show_medium', 		'class' => 'show-for-medium' );     } else { $show_medium = ''; 	}
		if ( $show_medium_only == 'true' ) 	{ $show_medium_only = 	array( 'size' => 'show_medium_only', 	'class' => 'show-for-medium-only' );} else { $show_medium_only = '';}
		if ( $hide_medium      == 'true' ) 	{ $hide_medium 		= 	array( 'size' => 'hide_medium', 		'class' => 'hide-for-medium' );     } else { $hide_medium = ''; 	}
		if ( $hide_medium_only == 'true' ) 	{ $hide_medium_only = 	array( 'size' => 'hide_medium_only', 	'class' => 'hide-for-medium-only' );} else { $hide_medium_only = '';}  
		if ( $show_large 	  == 'true' ) 	{ $show_large 		= 	array( 'size' => 'show_large', 			'class' => 'show-for-large' );      } else { $show_large = ''; 		} 
		if ( $show_large_only  == 'true' )  { $show_large_only  = 	array( 'size' => 'show_large_only', 	'class' => 'show-for-large-only' ); } else { $show_large_only = ''; }   
		if ( $hide_large 	  == 'true' ) 	{ $hide_large 		=	array( 'size' => 'hide_large', 			'class' => 'hide-for-large' );      } else { $hide_large = ''; 		}  
		if ( $hide_large_only  == 'true' )  { $hide_large_only  =	array( 'size' => 'hide_large_only', 	'class' => 'hide-for-large-only' ); } else { $hide_large_only = ''; }
		if ( $show_xlarge 	  == 'true' ) 	{ $show_xlarge 		=	array( 'size' => 'show_large', 			'class' => 'show-for-large' );      } else { $show_xlarge = ''; 	}
		if ( $show_xlarge_only == 'true' ) 	{ $show_xlarge_only =	array( 'size' => 'show_large_only', 	'class' => 'show-for-large-only' ); } else { $show_xlarge_only = '';}
		if ( $hide_xlarge 	  == 'true' ) 	{ $hide_xlarge 		=	array( 'size' => 'hide_large', 			'class' => 'hide-for-large' );      } else { $hide_xlarge = ''; 	}
		if ( $hide_xlarge_only == 'true' ) 	{ $hide_xlarge_only =	array( 'size' => 'hide_large_only', 	'class' => 'hide-for-large-only' ); } else { $hide_xlarge_only = '';}
		if ( $show_xxlarge 	  == 'true' ) 	{ $show_xxlarge 	=	array( 'size' => 'show_large', 			'class' => 'show-for-large' );	    } else { $show_xxlarge = ''; 	}
		if ( $hide_xxlarge 	  == 'true' ) 	{ $hide_xxlarge 	=	array( 'size' => 'hide_large', 			'class' => 'hide-for-large' ); 	    } else { $hide_xxlarge = ''; 	}
		if ( $show_landscape   == 'true' ) 	{ $show_landscape 	=	array( 'size' => 'show_landscape', 		'class' => 'show-for-landscape' );  } else { $show_landscape = '';  }
		if ( $show_portrait    == 'true' ) 	{ $show_portrait 	=	array( 'size' => 'show_portrait', 		'class' => 'show-for-portrait' );   } else { $show_portrait = ''; 	}		
		if ( $show_sr   == 'true' ) 		{ $show_sr 			=	array( 'size' => 'show_for_sr', 		'class' => 'show-for-sr' );  		} else { $show_sr = '';  }

		$options = array( 
			$show_small_only, $hide_small_only, 									// Small Visibility Classes
			$show_medium, $show_medium_only, $hide_medium, $hide_medium_only, 		// Medium Visibility Classes
			$show_large, $show_large_only, $hide_large, $hide_large_only, 			// Large Visibility Classes
			$show_xlarge, $hide_xlarge, $show_xlarge_only, $hide_xlarge_only, 		// XLarge Visibility Classes
			$show_xxlarge, $hide_xxlarge, 											// XXLarge Visibility Classes
			$show_landscape, $hide_landscape, 										// Landscape Visibility Classes
			$show_portrait, $hide_portrait, 										// Portrait Visibility Classes
			$show_sr, 																// Accessibiltiy Classes
		 );

		foreach ( $options as $option ) { 
			if ( isset( $option[ 'class' ] ) ) { 
				$visibility_class[] = $option[ 'class' ];
			 }
		 }

		if ( is_array( $visibility_class ) ) { $visibility_class = implode( " ", $visibility_class ); } 
		if ( !empty( $class ) ) { $class = ' '.$class; }	

		$html = '<div class="'.esc_html( $visibility_class ).esc_html( $class ).'">'.do_shortcode( $content ).'</div>';
			
        return $html;
	 }

 }

/**
 * Float Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Float { 
	
	public function __construct() { 
		add_shortcode( 'fp-float', array( $this, 'fp_float' ) );
	 }

	public function fp_float( $atts, $content ) { 

		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place Content Here', 'fp-foundation-assistant' ), 	
				'float' => '', 
                'class' => ''			
			 ), $atts
		 );
		extract( $atts );

		if ( in_array( $float, array( 'left', 'right', 'center' ), true ) ) { $float = $float; } else { $float = ''; }

		if ( $float == 'left' ) { $float = 'float-left'; }
		else if ( $float == 'right' ) { $float = 'float-right'; }
		else if ( $float == 'center' ) { $float = 'float-center'; }
		else { $float == ''; }
		if ( !empty( $class ) ) { $class = ' '.$class; }	

		$html = '<div class="'.esc_html( $float ).esc_html( $class ).'">'.do_shortcode( $content ).'</div>';

        return $html;
	 }

 }

/**
 * Grid Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Grid { 
	
	public function __construct() { 
		add_shortcode( 'fp-rows', array( $this, 'fp_rows' ) );
		add_shortcode( 'fp-columns', array( $this, 'fp_columns' ) );
	 }

	public function fp_rows( $atts, $content ) { 
		global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place here the shortcode tags for the column content.', 'fp-foundation-assistant' ), 
				'expanded' =>'', 
				'collapse' => '', 
				'small_collapse' => '', 
				'medium_collapse' => '', 
				'large_collapse' => '', 	
				'small_uncollapse' => '', 
				'medium_uncollapse' => '', 
				'large_uncollapse' => '', 					
				'small_up' => '', 
				'medium_up' => '', 
				'large_up' => '', 
				'equalizer' => '', 
				'row_equalizer' => '', 
                'class' => ''		
			 ), $atts
		 );
		extract( $atts );

		$fp_globals[ 'equalizer_watch' ] = '';
		if ( $equalizer == 'true' ) { $equalizer = 'data-equalizer '; $fp_globals[ 'equalizer_watch' ] = 'data-equalizer-watch '; } else { $equalizer = ''; $fp_globals[ 'equalizer_watch' ] = ''; }

		$fp_globals[ 'row_equalizer_watch' ] = '';
		if ( $row_equalizer == 'true' ) { $row_equalizer = ' data-equalizer data-equalize-by-row=true'; $fp_globals[ 'row_equalizer_watch' ] = 'data-equalizer-watch '; } else { $row_equalizer = ''; $fp_globals[ 'row_equalizer_watch' ] = ''; }

		( int ) $max = 12;
		( int ) $min = 1;

		$grid_class = array();		
		$bool_class = array();		

		$options = array( 
			array( 'size' => $small_up, 'class' => 'small-up-' ),  
			array( 'size' => $medium_up, 'class' => 'medium-up-' ),  
			array( 'size' => $large_up, 'class' => 'large-up-' )
		 );


		foreach ( $options as $option ) { 

			if ( ( !is_numeric( $option[ 'size' ] ) ) ||( $max < $option[ 'size' ] || $option[ 'size' ] < $min ) ) { $option[ 'size' ] = ''; }

			if ( $min <= $option[ 'size' ] && $option[ 'size' ] <= $max ) { 

				$grid_class[] = $option[ 'class' ].absint( esc_html( $option[ 'size' ] ) ).' ';
			 }
		 }

		if ( is_array( $grid_class ) ) { $grid_class = implode( " ", $grid_class ); } 

		$bool_options = array( 
			array( 'bool' => $expanded, 'class' => 'expanded ' ), 
			array( 'bool' => $collapse, 'class' => 'collapse ' ), 
			array( 'bool' => $small_collapse, 'class' => 'small-collapse ' ), 
			array( 'bool' => $medium_collapse, 'class' => 'medium-collapse ' ), 
			array( 'bool' => $large_collapse, 'class' => 'large-collapse ' ), 
			array( 'bool' => $small_uncollapse, 'class' => 'small-uncollapse ' ), 
			array( 'bool' => $medium_uncollapse, 'class' => 'medium-uncollapse ' ), 
			array( 'bool' => $large_uncollapse, 'class' => 'large-uncollapse ' ), 

		 );

		foreach ( $bool_options as $bool_option ) { 

			if ( $bool_option[ 'bool' ] == 'true' ) { $bool_class[] = $bool_option[ 'class' ]; } else { $bool_option[ 'bool' ] = ''; }
		 }	

		if ( is_array( $bool_class ) ) { $bool_class = implode( " ", $bool_class ); }

		if ( !empty( $class ) ) { $class = $class.' '; }	

		$html = '<div class="'.esc_html( $grid_class ).esc_html( $bool_class ).esc_html( $class ).'row" '.esc_html( $equalizer ).esc_html( $row_equalizer ).'>';
		$html .=  do_shortcode( $content );
		$html .= '</div>';

        return $html;		

	 }

	public function fp_columns( $atts, $content ){ 
        global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place Content Here', 'fp-foundation-assistant' ), 	
				'small' => '', 			
				'medium' =>'', 
				'large'=>'', 
				'small_offset' => '', 
				'medium_offset' => '', 
				'large_offset' => '', 	
				'small_centered' => '', 
				'medium_centered' => '', 
				'large_centered' => '', 	
				'small_uncentered' => '', 
				'medium_uncentered' => '', 
				'large_uncentered' => '', 
				'small_push' => '', 
				'medium_push' => '', 
				'large_push' => '', 	
				'small_pull' => '', 
				'medium_pull' => '', 
				'large_pull' => '', 		
				'end' => '', 
                'class' => '', 

				// Not Supported in F6; Included to support compatibility between the versions;
				'column' => '', 				
				'offset' => '', 				
				'centered' => '', 	
				'push' => '', 
				'pull' => '', 
			 ), $atts
		 );
		extract( $atts );

		( int ) $max = 12;
		( int ) $min = 1;

		$grid_class = array();	
		$bool_class = array();			

		$options = array( 

			array( 'size' => $small, 'class' => 'small-' ), 
			array( 'size' => $small_offset, 'class' => 'small-offset-' ), 
			array( 'size' => $small_push, 'class' => 'small-push-' ), 
			array( 'size' => $small_pull, 'class' => 'small-pull-' ), 
			array( 'size' => $medium, 'class' => 'medium-' ), 
			array( 'size' => $medium_offset, 'class' => 'medium-offset-' ), 
			array( 'size' => $medium_push, 'class' => 'medium-push-' ), 
			array( 'size' => $medium_pull, 'class' => 'medium-pull-' ), 
			array( 'size' => $large, 'class' => 'large-' ), 
			array( 'size' => $large_offset, 'class' => 'large-offset-' ), 
			array( 'size' => $large_push, 'class' => 'large-push-' ), 
			array( 'size' => $large_pull, 'class' => 'large-pull-' ), 

			// Not Supported in F6; Included to support compatibility between the versions;
			array( 'size' => $column, 'class' => 'large-' ), 
			array( 'size' => $offset, 'class' => 'large-offset-' ), 
			array( 'size' => $push, 'class' => 'small-push-' ), 
			array( 'size' => $pull, 'class' => 'small-pull-' ), 
		 );


		foreach ( $options as $option ) { 

			if ( ( !is_numeric( $option[ 'size' ] ) ) ||( $max < $option[ 'size' ] || $option[ 'size' ] < $min ) ) { $option[ 'size' ] = ''; }

			if ( $min <= $option[ 'size' ] && $option[ 'size' ] <= $max ) { 

				$grid_class[] = $option[ 'class' ].absint( esc_html( $option[ 'size' ] ) ).' ';
			 }
		 }
		
		if ( empty( $small ) && empty( $medium ) && empty( $large ) ) { $grid_class[] = 'small-12 '; }

		if ( is_array( $grid_class ) ) { $grid_class = implode( " ", $grid_class ); } 


		$bool_options = array( 
			array( 'bool' => $small_centered, 'class' => 'small-centered ' ), 
			array( 'bool' => $medium_centered, 'class' => 'medium-centered ' ), 
			array( 'bool' => $large_centered, 'class' => 'large-centered ' ), 
			array( 'bool' => $small_uncentered, 'class' => 'small-uncentered ' ), 
			array( 'bool' => $medium_uncentered, 'class' => 'medium-uncentered ' ), 
			array( 'bool' => $large_uncentered, 'class' => 'large-uncentered ' ), 
			array( 'bool' => $end, 'class' => 'end ' ), 

			// Not Supported in F4; Included to support compatibility between the versions;
			array( 'bool' => $centered, 'class' => 'small-centered ' ), 
		 );

		foreach ( $bool_options as $bool_option ) { 

			if ( $bool_option[ 'bool' ] == 'true' ) { $bool_class[] = $bool_option[ 'class' ]; } else { $bool_option[ 'bool' ] = ''; }

		 }	

		if ( is_array( $bool_class ) ) { $bool_class = implode( " ", $bool_class ); }

		if ( !empty( $class ) ) { $class = $class.' '; }

		$html = '<div class="'.esc_html( $bool_class ).esc_html( $grid_class ).esc_html( $class ).' columns" '.esc_html( $fp_globals[ 'equalizer_watch' ] ).esc_html( $fp_globals[ 'row_equalizer_watch' ] ).'>';
		$html .=  do_shortcode( $content );
		$html .= '</div>';
	
        return $html;

    }

 }


/**
 * Carousel Shortcode
 * @since FP Foundation Assistant 1.0.0
 * @version 1.0.0
 */

class FP_Carousel { 
	
	public function __construct() { 
		add_shortcode( 'fp-carousel', array( $this, 'fp_carousel' ) );
		add_shortcode( 'fp-carousel-item', array( $this, 'fp_carousel_item' ) );
	 }

	public function fp_carousel( $atts, $content ) { 

		global $fp_globals;
		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );
		$fp_globals[ 'owl_id' ] = 'owl_id_'.uniqid();

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'columns' =>'', 
				'id' =>$fp_globals[ 'owl_id' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( $columns =='one' ) { $columns = ' one-column'; } 
		elseif ( $columns =='two' ) { $columns = ' two-columns'; } 
		elseif ( $columns =='four' ) { $columns = ' four-columns'; } 
		elseif ( $columns =='five' ) { $columns = ' five-columns'; } 
		elseif ( $columns =='six' ) { $columns = ' six-columns'; } 
		else { $columns = ' three-columns'; } 

		if ( !empty( $class ) ) { $class = ' '.$class; }

		$html = '<div id="'.esc_html( $id ).'" class="owl-carousel'.esc_html( $columns ).esc_html( $class ).'">';
		$html .=  do_shortcode( $content );
		$html .= '</div>';

        return $html;
        $fp_globals[ 'owl_id' ] = 'owl_id_'.uniqid();
	 }

	public function fp_carousel_item( $atts, $content ) { 

		global $fp_globals;
		$content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : '', 
				'image' =>'', 
				'title' => '', 
				'style' => '', 
                'class' => '',
                'alt' => '',
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' '.$class; }
		if ( $style =='two' ) { $style = 'box-layout-two'; } elseif ( $style =='three' ) { $style = 'box-layout-three'; } else { $style = 'box-layout-one'; } 		
		if ( !empty( $image ) ) { $image = esc_url( esc_html( $image ) ); } else { $image = ''; }
		if ( !empty( $title ) ) { $alt = esc_html( $title ); $title = esc_html( $title ); } else { $title = ''; }

		$html = '<div><div class="'.esc_html( $style ).esc_html( $class ).'">';

		if ( !empty( $image ) ) { $html .= '<div class="box-image"><img src="'.esc_html( $image ).'" alt='.esc_html( $alt ).'></div>'; }
		if ( !empty( $title ) ) { $html .= '<div class="box-title">'.esc_html( $title ).'</div>'; }

		$html .= '<div class="box-text">';
		$html .=  do_shortcode( $content );
		$html .= '</div></div></div>';
	

        return $html;
	 }

 }



