<?php
/**
* Main class.
*
* @package Rest_Api_Tutorial
*/

class Rest_Api_Tutorial {

    /**
     * Returns the instance.
     */
    public static function get_instance() {

        static $instance = null;

        if ( is_null( $instance ) ) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Constructor method.
     */
    private function __construct() {
        $this->includes();
    }

    // Includes
    public function includes() {
        include_once REST_API_TUTORIAL_PLUGIN_DIR . '/parts/part-1/method-1.php';
        // include_once REST_API_TUTORIAL_PLUGIN_DIR . '/parts/part-1/method-2.php';
    }
}
