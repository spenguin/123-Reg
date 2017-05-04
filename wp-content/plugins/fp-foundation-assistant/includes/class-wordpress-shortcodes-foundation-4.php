<?php

/**
 * Foundation 4 Shortcodes
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
	'menu_id'=> '', 

	//Dropdown
	'dropdown_id'=> '', 

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
	'open_tab' => 'active', 
	'vertical_class' => 'vertical', 

	//Block Grid
	'block_grids' => ''
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

		if ( !empty( $class ) ) { $html = '<div class="'.esc_html( $class ).'">'; } else { $html = ''; }
			
		if ( $vertical == 'true' ) {
			$html .= '<div class="section-container vertical-tabs" data-section="vertical-tabs">';
		} else {
			$html .= '<div class="section-container tabs" data-section="tabs">';
		}

		$html .=  do_shortcode( $content );
		$html .= '</div>';

		if ( !empty( $class ) ) { $html .= '</div>'; }

        return $html;
	}

	public function fp_tab( $atts, $content = null ){
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		$atts = shortcode_atts( array( 
				'title' => __( 'Tab Title ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_tabs' ], 
                'open' =>'', 
                'content' => !empty( $content ) ? $content : __( 'Tab Content ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_tabs' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );
		
			if ( $open == 'true' ) {
				if ( !empty( $class ) ) { $class = ' '.$class; } 
				$html = "<section class='".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."'>";
			} else {
				if ( !empty( $class ) ) { $class = ' class='.$class; } 
				$html = "<section".esc_html( $class ).">";				
			}	

			$html .= "<p class='title' data-section-title><a href='#'>". esc_html( $title ) ."</a></p>";
			$html .= "<div class='content'><p class='fp-tab-content'>". do_shortcode( $content )."</p></div>";
			$html .= "</section>";
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

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place here the shortcode tags for single accordion item.', 'fp-foundation-assistant' ), 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = $class.' '; }
		
		$html = '<div class="section-container accordion" data-section="accordion">';		
		$html .=  do_shortcode( $content );
		$html .= '</div>';

        return $html;
	}

	public function fp_accordion( $atts, $content = null ){
        global $fp_globals;
        $content = str_replace( array( '<br />', '<br>' ), array( '', '' ), $content );

		$fp_globals[ 'counter_accordion' ]++;
		$fp_globals[ 'accordion_id' ] = 'panel'.$fp_globals[ 'counter_accordion_wraps' ].$fp_globals[ 'counter_accordion' ];

		$atts = shortcode_atts( array( 
				'title' => __( 'Accordion Title ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_accordion' ], 
                'open' =>'', 
                'content' => !empty( $content ) ? $content : __( 'Accordion Content ', 'fp-foundation-assistant' ).$fp_globals[ 'counter_accordion' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );
		
			if ( $open == 'true' ) {	
				if ( !empty( $class ) ) { $class = ' '.$class; } 			
				$html = "<section class='".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."'>";
			} else {
				if ( !empty( $class ) ) { $class = ' class='.$class; } 
				$html = "<section".esc_html( $class ).">";
			}	

			$html .= "<p class='title' data-section-title><a href='#'>".esc_html( $title )."</a></p>";
			$html .= "<div class='content' data-section-content>";
			$html .= do_shortcode( $content );
			$html .= "</div>";
			$html .= "</section>";
		
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
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = $class.' '; }

		$html = '<dl class="'.esc_html( $class ).'sub-nav">';		
		$html .=  do_shortcode( $content );
		$html .= '</dl>';
		

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

			$fp_globals[ 'menu_id' ] = 'menu-'.uniqid();	
			$html = '<dd'.esc_html( $class ).'><a href="'.esc_url( $link ).'" data-dropdown="'.esc_html( $fp_globals[ 'menu_id' ] ).'" data-options="is_hover:true; hover_timeout:5000">'.esc_html( $title ).'</a>'. do_shortcode( $content ).'</dd>';
	
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

		if ( !empty( $class ) ) { $class = ' '.$class; }

		$html = '<ul id="'.esc_html( $fp_globals[ 'menu_id' ] ).'" class="f-dropdown'.esc_html( $class ).'" data-dropdown-content tabindex="-1">';
		
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
				'shape' => '', 
				'size' => '', 
				'color' => '', 
				'link' => '', 
				'dropdown' =>'',
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$button_classes = array();

		if ( in_array( $size, array( 'tiny', 'small', 'medium', 'large', 'expand' ), true ) )  { $button_classes[] = $size.' '; } 
		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'disabled' ), true ) ) { $button_classes[] = $color.' '; } 
		if ( in_array( $shape, array( 'round', 'radius' ), true ) ) { $button_classes[] = $shape.' '; }
		if ( $dropdown == 'true' ) { $button_classes[] = 'dropdown '; }  


		if ( is_array( $button_classes ) ) { $button_classes = implode( " ", $button_classes ); }	
		if ( !empty( $class ) ) { $class = $class.' ';}	

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
				'color' => '', 
				'closable' =>'', 
				'shape' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$callout_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert', 'primary' ), true ) ) { $callout_classes[] = $color.' '; } 
		if ( $shape == 'radius' ) { $callout_classes[] = 'radius '; } elseif ( $shape == 'round' ) { $callout_classes[] = 'round '; } 
		if ( !empty( $class ) ) { $class = $class.' '; }	

		if ( is_array( $callout_classes ) ) { $callout_classes = implode( " ", $callout_classes ); }
		
		$html = '<div class="'.esc_html( $callout_classes ).esc_html( $class ).'alert-box" data-alert>';		
		$html .=  do_shortcode( $content );

		if ( $closable == 'true' ) {
			$html .= '<a href="#" class="close">&times;</a></div>';
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
				'hover' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$fp_globals[ 'dropdown_id' ] = 'dd-'.uniqid();

		if ( $hover == 'true' ) { $hover = 'is_hover:true; hover_timeout:500'; } else { $hover = ''; }
		if ( !empty( $class ) ) { $class = $class.' '; }

		$html = '<a data-dropdown="'.esc_html( $fp_globals[ 'dropdown_id' ] ).'"  data-options="'.esc_html( $hover ).'" aria-controls="'.esc_html( $fp_globals[ 'dropdown_id' ] ).'" aria-expanded="false" >'.esc_html( $title ).'</a>';
		$html .= '<div id="'.esc_html( $fp_globals[ 'dropdown_id' ] ).'" data-dropdown-content class="'.esc_html( $class ).'f-dropdown content" aria-hidden="true" tabindex="-1"><p>';		
		$html .=  do_shortcode( $content );
		$html .= '</p></div>';
	
        return $html;

        $fp_globals[ 'dropdown_id' ] = 'dd-'.uniqid();
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
				'small' => '', 
				'default' => '', 
				'large' => '', 
                'class' => '',
                
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = ' class='.$class; }	

			$html = '<img'.esc_html( $class ).' data-interchange="';
			$html .= '[ '.esc_url( $default ).',( default )],';		
			$html .= '[ '.esc_url( $small ).',( small )],';	
			$html .= '[ '.esc_url( $large ).',( large )]">';	
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
				'shape' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		!empty( $id ) ? $id = ' id='.$id.' ' : '';

		$label_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert' ), true ) ) { $label_classes[] = $color.' '; } 
		if ( in_array( $shape, array( 'round', 'radius' ), true ) ) { $label_classes[] = $shape.' '; } 
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

		$html = '<ul class="orbit'.esc_html( $class ).'" data-orbit>';
		$html .=  do_shortcode( $content );
		$html .= '</ul>';

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

			if ( $open == 'true' ) {
				$html = "<li class='orbit-slide ".esc_html( $fp_globals[ 'open_tab' ] ).esc_html( $class )."'><p>". do_shortcode( $content )."</p></li>";
			} else {
				$html = "<li class='orbit-slide".esc_html( $class )."'><p>". do_shortcode( $content )."</p></li>";
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
				'width' => 50, 
				'text' =>'', 
				'size' => '', 
				'shape' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$progress_classes = array();

		if ( in_array( $color, array( 'secondary', 'success', 'alert' ), true ) ) { $progress_classes[] = $color.' '; } 
		if ( in_array( $shape, array( 'radius', 'round' ), true ) ) { $progress_classes[] = $shape.' '; } 
		if ( in_array( $size, array( 'small', 'large' ), true ) ) { if ( $size == 'small' ) { $progress_classes[] = $size.'-8 ';} else { $progress_classes[] = $size.'-12 ';} } 
		if ( !empty( $class ) ) { $class = $class.' '; }		

		if ( is_array( $progress_classes ) ) { $progress_classes = implode( " ", $progress_classes ); }	

		$html = '<div class="'.esc_html( $progress_classes ).esc_html( $class ).'progress">';
		$html .= '<div class="meter" style="width:'.intval( esc_html( $width ) ).'%">';
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
				'title' => __( 'Click here for a modal', 'fp-foundation-assistant' ), 
				'id' =>$fp_globals[ 'reveal_id' ], 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		if ( in_array( $size, array( 'tiny', 'small', 'medium', 'large', 'xlarge' ), true ) ) { $size = $size.' '; } else { $size = ''; }
		if ( $title == '' ) { $title = __( 'Click here for a modal', 'fp-foundation-assistant' ); } 
		if ( !empty( $class ) ) { $class = $class.' '; }

		$html = '<div class="'.esc_html( $size ).esc_html( $class ).'reveal-modal" id="'.esc_html( $id ).'" data-reveal>';
		$html .=  do_shortcode( $content );
		$html .= '<a class="close-reveal-modal" aria-label="'.__( 'Close', 'fp-foundation-assistant' ).'">&#215;</a></div>';
		$html .= '<p><a data-reveal-id="'.esc_html( $id ).'">'.esc_html( $title ).'</a></p>';

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
				'shape' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$tooltip_classes = array();

		if ( in_array( $position, array( 'top', 'right', 'left', 'bottom' ), true ) ) { $tooltip_classes[] = ' tip-'.$position; } 
		if ( in_array( $shape, array( 'radius', 'round' ), true ) ) { $tooltip_classes[] = ' '.$shape; } 
		if ( $title == '' ) { $title = __( 'Place the description text here.' , 'fp-foundation-assistant' ); } 
		if ( !empty( $class ) ) { $class = ' '.$class; }

		if ( is_array( $tooltip_classes ) ) { $tooltip_classes = implode( " ", $tooltip_classes ); }

		$html = '<span data-tooltip aria-haspopup="true" class="has-tip'.esc_html( $tooltip_classes ).esc_html( $class ).'"  title="'.esc_html( $title ).'">';
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
				'show_medium_down' => '', 
				'hide_medium' => '', 
				'hide_medium_only' => '',   
				'hide_medium_down' => '', 
				'show_large' => '', 
				'show_large_only' => '', 
				'show_large_down' => '', 
				'hide_large' => '', 
				'hide_large_only' => '', 
				'hide_large_down' => '', 
				'show_xlarge' => '', 
				'hide_xlarge' => '', 
				'show_landscape' => '', 
				'hide_landscape' => '', 
				'show_portrait' => '', 
				'hide_portrait' => '', 
                'class' => ''
			 ), $atts
		 );
		extract( $atts );

		$visibility_class = array();

		if ( $show_small_only 	== 'true' )  { $show_small_only = 	array( 'size' => 'show_small_only', 	'class' => 'show-for-small' );		} else { $show_small_only = '';}
		if ( $hide_small_only 	== 'true' )  { $hide_small_only = 	array( 'size' => 'hide_small_only', 	'class' => 'hide-for-small' );		} else { $hide_small_only = '';}
		if ( $show_medium 		== 'true' )  { $show_medium = 		array( 'size' => 'show_medium', 		'class' => 'show-for-medium-up' );	} else { $show_medium = '';}
		if ( $show_medium_only 	== 'true' )  { $show_medium_only = 	array( 'size' => 'show_medium_only', 	'class' => 'show-for-medium' );		} else { $show_medium_only = '';}
		if ( $show_medium_down 	== 'true' )  { $show_medium_down = 	array( 'size' => 'show_medium_down', 	'class' => 'show-for-medium-down' );} else { $show_medium_down = '';}
		if ( $hide_medium 		== 'true' )  { $hide_medium = 		array( 'size' => 'hide_medium', 		'class' => 'hide-for-medium-up ' );	} else { $hide_medium = '';}
		if ( $hide_medium_only 	== 'true' )  { $hide_medium_only = 	array( 'size' => 'hide_medium_only', 	'class' => 'hide-for-medium' );		} else { $hide_medium_only = '';}  
		if ( $hide_medium_down 	== 'true' )  { $hide_medium_down = 	array( 'size' => 'hide_medium_down', 	'class' => 'hide-for-medium-down' );} else { $hide_medium_down = '';}
		if ( $show_large 		== 'true' )  { $show_large = 		array( 'size' => 'show_large', 			'class' => 'show-for-large-up' );	} else { $show_large = '';} 
		if ( $show_large_only 	== 'true' )  { $show_large_only = 	array( 'size' => 'show_large_only', 	'class' => 'show-for-large' );		} else { $show_large_only = '';}   
		if ( $show_large_down 	== 'true' )  { $show_large_down = 	array( 'size' => 'show_large_down', 	'class' => 'show-for-large-down' );	} else { $show_large_down = '';}
		if ( $hide_large 		== 'true' )  { $hide_large =		array( 'size' => 'hide_large', 			'class' => 'hide-for-large-up' );	} else { $hide_large = '';}  
		if ( $hide_large_only 	== 'true' )  { $hide_large_only =	array( 'size' => 'hide_large_only', 	'class' => 'hide-for-large' );		} else { $hide_large_only = '';}
		if ( $hide_large_down 	== 'true' )  { $hide_large_down = 	array( 'size' => 'hide_large_down', 	'class' => 'hide-for-large-down' );	} else { $hide_large_down = '';}
		if ( $show_xlarge 		== 'true' )  { $show_xlarge =		array( 'size' => 'show_xlarge', 		'class' => 'show-for-xlarge' );		} else { $show_xlarge = '';}
		if ( $hide_xlarge 		== 'true' )  { $hide_xlarge =		array( 'size' => 'hide_xlarge', 		'class' => 'hide-for-xlarge' );		} else { $hide_xlarge = '';}
		if ( $show_landscape 	== 'true' )  { $show_landscape =	array( 'size' => 'show_landscape', 		'class' => 'show-for-landscape' );	} else { $show_landscape = '';}
		if ( $hide_landscape 	== 'true' )  { $hide_landscape =	array( 'size' => 'hide_landscape', 		'class' => 'hide-for-landscape' );	} else { $hide_landscape = '';} 
		if ( $show_portrait 	== 'true' )  { $show_portrait =		array( 'size' => 'show_portrait', 		'class' => 'show-for-portrait' );	} else { $show_portrait = '';}
		if ( $hide_portrait 	== 'true' )  { $hide_portrait =		array( 'size' => 'hide_portrait', 		'class' => 'hide-for-portrait' );	} else { $hide_portrait = '';}  				

		$options = array( 
			$show_small_only, $hide_small_only, 																					// Small Visibility Classes
			$show_medium, $show_medium_only, $hide_medium, $hide_medium_only, $show_medium_down, $hide_medium_down, 				// Medium Visibility Classes
			$show_large, $show_large_only, $hide_large, $hide_large_only, $show_large_down, $hide_large_down, 					// Large Visibility Classes
			$show_xlarge, $hide_xlarge, 																						// XLarge Visibility Classes
			$show_landscape, $hide_landscape, 																					// Landscape Visibility Classes
			$show_portrait, $hide_portrait, 																					// Portrait Visibility Classes

		 );

		foreach ( $options as $option ) {
			if ( isset( $option[ 'class' ] ) ) {
				$visibility_class[] = $option[ 'class' ].' ';
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

		if ( in_array( $float, array( 'left', 'right' ), true ) ) { $float = $float; } else { $float = ''; }
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
                'class' => '', 
                'collapse' => '', 

				// Not Supported in F4; Included to support compatibility between the versions;
				'small_up' => '', 
				'medium_up' => '', 
				'large_up' => '', 
			 ), $atts
		 );
		extract( $atts );

		if ( !empty( $class ) ) { $class = $class.' '; }

		$grid_class = array();	
		$bool_class = array();	

		$bool_options = array( 
			array( 'bool' => $collapse, 'class' => 'collapse ' ), 
		 );

		foreach ( $bool_options as $bool_option ) {

			if ( $bool_option[ 'bool' ] == 'true' ) { $bool_class[] = $bool_option[ 'class' ]; } else { $bool_option[ 'bool' ] = ''; }
		}	

		if ( is_array( $bool_class ) ) { $bool_class = implode( " ", $bool_class );}

		( int ) $max = 12;
		( int ) $min = 1;

		// Not Supported in F4; Included to support compatibility between the versions;
		$options = array( 
			array( 'size' => $small_up, 'class' => 'small-block-grid-' ),  			 
			array( 'size' => $large_up, 'class' => 'large-block-grid-' )
		 );

		if( empty( $small_up ) && empty( $large_up ) ) {
			$options[] = array( 'size' => $medium_up, 'class' => 'large-block-grid-' );
		}


		foreach ( $options as $option ) {

			if ( ( !is_numeric( $option[ 'size' ] ) ) ||( $max < $option[ 'size' ] || $option[ 'size' ] < $min ) ) { $option[ 'size' ] = ''; }

			if ( $min <= $option[ 'size' ] && $option[ 'size' ] <= $max ) {

				$grid_class[] = $option[ 'class' ].absint( esc_html( $option[ 'size' ] ) ).' ';
			}
		}

		if ( is_array( $grid_class ) ) { $grid_class = implode( " ", $grid_class ); } 

		if ( empty( $small_up ) && empty( $medium_up ) && empty( $large_up ) ) {

			$fp_globals[ 'block_grids' ] = 'false';

			$html = '<div class="'.esc_html( $class ).esc_html( $bool_class ).'row">';
			$html .=  do_shortcode( $content );
			$html .= '</div>';

		} else {

			$fp_globals[ 'block_grids' ] = 'true';

			$html = '<ul class="'.esc_html( $class ).esc_html( $grid_class ).'">';
			$html .=  do_shortcode( $content );
			$html .= '</ul>';
		}				

        return $html;		

	}

	public function fp_columns( $atts, $content ){
        global $fp_globals;

		//Set Defaults						
		$atts = shortcode_atts( array( 
				'content' => !empty( $content ) ? $content : __( 'Place Content Here', 'fp-foundation-assistant' ), 					
				'small' => '', 			
				'large'=>'', 
				'small_offset' => '', 
				'large_offset' => '', 	
				'small_centered' => '', 
				'large_centered' => '', 	
				'small_uncentered' => '', 
				'large_uncentered' => '', 
				'push' => '', 
				'pull' => '', 
				'end' => '', 
                'class' => '', 


                // Not Supported in F4; Included to support compatibility between the versions;
                'column' => '', 				
                'medium' => '', 				
                'offset' => '', 				
                'medium_offset' => '', 		
                'centered' => '', 			
                'medium_centered' => '', 		
                'medium_uncentered' => '', 		
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
			array( 'size' => $large, 'class' => 'large-' ), 
			array( 'size' => $large_offset, 'class' => 'large-offset-' ), 
			array( 'size' => $push, 'class' => 'push-' ), 
			array( 'size' => $pull, 'class' => 'pull-' ), 

			// Not Supported in F4; Included to support compatibility between the versions;
			array( 'size' => $column, 'class' => 'large-' ), 
			array( 'size' => $medium, 'class' => 'large-' ), 
			array( 'size' => $offset, 'class' => 'large-offset-' ), 
			array( 'size' => $medium_offset, 'class' => 'large-offset-' ), 
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
			array( 'bool' => $large_centered, 'class' => 'large-centered ' ), 
			array( 'bool' => $small_uncentered, 'class' => 'small-uncentered ' ), 
			array( 'bool' => $large_uncentered, 'class' => 'large-uncentered ' ), 
			array( 'bool' => $end, 'class' => 'end ' ), 

			// Not Supported in F4; Included to support compatibility between the versions;
			array( 'bool' => $centered, 'class' => 'small-centered ' ), 
			array( 'bool' => $medium_centered, 'class' => 'small-centered ' ), 
			array( 'bool' => $medium_uncentered, 'class' => 'small-uncentered ' ), 
		 );

		foreach ( $bool_options as $bool_option ) {
			if ( $bool_option[ 'bool' ] == 'true' ) { $bool_class[] = $bool_option[ 'class' ]; } else { $bool_option[ 'bool' ] = ''; }
		}	

		if ( is_array( $bool_class ) ) { $bool_class = implode( " ", $bool_class );}
		

		if ( $fp_globals[ 'block_grids' ] == 'true' ) {
			if ( !empty( $class ) ) { $class = ' class='.$class; }
			$html = '<li'.esc_html( $class ).'>';
			$html .=  do_shortcode( $content );
			$html .= '</li>';

		} elseif ( $fp_globals[ 'block_grids' ] == 'false' ) {
			if ( !empty( $class ) ) { $class = ' '.$class; }
			$html = '<div class="'.esc_html( $bool_class ).esc_html( $grid_class ).esc_html( $class ).' columns">';
			$html .=  do_shortcode( $content );
			$html .= '</div>';
		}		
	
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

		if ( $columns =='one' ) {$columns = ' one-column';} 
		elseif ( $columns =='two' ) {$columns = ' two-columns';} 
		elseif ( $columns =='four' ) {$columns = ' four-columns';} 
		elseif ( $columns =='five' ) {$columns = ' five-columns';} 
		elseif ( $columns =='six' ) {$columns = ' six-columns';} 
		else {$columns = ' three-columns';} 

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

		if ( $style =='two' ) {$style = 'box-layout-two';} elseif ( $style =='three' ) {$style = 'box-layout-three';} else {$style = 'box-layout-one';} 		
		if ( !empty( $image ) ) { $image = esc_url( esc_html( $image ) );} else { $image = '';}
		if ( !empty( $title ) ) { $alt = esc_html( $title ); $title = esc_html( $title );} else { $title = '';}
		if ( !empty( $class ) ) { $class = ' '.$class; }

		$html = '<div><div class="'.esc_html( $style ).esc_html( $class ).'">';
		if ( !empty( $image ) ) { $html .= '<div class="box-image"><img src="'.esc_html( $image ).'" alt='.esc_html( $alt ).'></div>'; }
		if ( !empty( $title ) ) { $html .= '<div class="box-title">'.esc_html( $title ).'</div>'; }
		$html .= '<div class="box-text">';
		$html .=  do_shortcode( $content );
		$html .= '</div></div></div>';
	

        return $html;
	}

}



