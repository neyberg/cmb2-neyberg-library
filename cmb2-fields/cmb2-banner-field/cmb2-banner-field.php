<?php
    function cmb2_init_banner_field()
    {
        include( plugin_dir_path( __FILE__ ) . 'cmb2-render-banner-field.php' );
        CMB2_Render_Banner_Field::init();
    }

    add_action( 'cmb2_init', 'cmb2_init_banner_field' );