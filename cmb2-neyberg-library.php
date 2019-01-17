<?php
    /**
     * Plugin Name: CMB2 Neyberg Library
     * Plugin URI: neyberg.com
     * Description: Collection of helper CMB2 field types: banner, double input, input with area.
     * Version:  1.0
     * Author: Neyberg
     * Author URI: neyberg.com
     * License:  GPL2
     */

    include( plugin_dir_path( __FILE__ ) . 'cmb2-fields/cmb2-double-input-field/cmb2-double-input.php' );
    include( plugin_dir_path( __FILE__ ) . 'cmb2-fields/cmb2-input-with-area-field/cmb2-input-with-area.php' );
    include( plugin_dir_path( __FILE__ ) . 'cmb2-fields/cmb2-banner-field/cmb2-banner-field.php' );