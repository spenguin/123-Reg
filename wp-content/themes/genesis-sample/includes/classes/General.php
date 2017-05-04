<?php
namespace ns123blog;

/**
 * Class General
 * @package ns123blog
 * @author John Anderson (based on work by Gabriel Livan on the 123 Reg site)
 */

class General
{
    /**
     * This will trigger an action before a page is updated via the Dashboard
     * @var bool
     */
    private $_enableFilterPostData = false;

    /**
     *
     */
    public function init()
    {
        // Show admin bar in the front-end view
        // You can remove it if you append /?hegNoAdminBar to the URL
        // This will work only if you're logged in
        if (isset($_GET['hegNoAdminBar'])) {
            add_filter('show_admin_bar', '__return_false');
        }

        add_action( 'genesis_before_header', array( $this, 'header_main_menu' ) );

    }


    /**
     *  Structure for Header Main Menu
     *  uses Timber/Twig
     */
    public function header_main_menu( $content )
    {
        ?>
        <p>Test</p>
    <?php
    }

}
