<?php
/**
	Shortcodes
*/
namespace Shortcodes;

\Shortcodes\register();

function register(){
   add_shortcode( 'login', '\Shortcodes\login' );
}


function login()
{
	$o	= array();
	$o[]	= '<form>';
	$o[]	= '<input type="text" name="username" />';
	$o[]	= '<input type="submit" value="submit" name="submit" />';
	$o[]	= '</form>';

	return join( "\r\n", $o );
}