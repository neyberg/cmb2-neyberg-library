<?php
    /*
     * Plugin Name: CMB2 Custom Field Type - Input_With_Area
     * Description: Makes available an 'input_with_area' CMB2 Custom Field Type.
     * Author: Neyberg
     * Author URI: neyberg.com
     * Version: 1.0
     * License:  GPL2
     */
    /**
     * Template tag for displaying an input_with_area from the CMB2 input_with_area field type (on the front-end)
     *
     * @since  0.1.0
     *
     * @param  string $metakey The 'id' of the 'input_with_area' field (the metakey for get_post_meta)
     * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
     */
    function jt_cmb2_input_with_area_field( $metakey, $post_id = 0 )
    {
        echo jt_cmb2_get_input_with_area_field( $metakey, $post_id );
    }

    /**
     * Template tag for returning an input_with_area from the CMB2 input_with_area field type (on the front-end)
     *
     * @since  0.1.0
     *
     * @param  string $metakey The 'id' of the 'input_with_area' field (the metakey for get_post_meta)
     * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
     */
    function jt_cmb2_get_input_with_area_field( $metakey, $post_id = 0 )
    {
        $post_id = $post_id ? $post_id : get_the_ID();
        $input_with_area = get_post_meta( $post_id, $metakey, 1 );
        // Set default values for each input_with_area key
        $input_with_area = wp_parse_args( $input_with_area, array(
            'input_with_area-1' => '',
            'input_with_area-2' => '',
        ) );
        $output = '<div class="cmb2-input_with_area">';
        $output .= '<p><strong>Input_With_Area1:</strong> ' . esc_html( $input_with_area['input_with_area-1'] ) . '</p>';
        $output .= '<p><strong>Input_With_Area2:</strong> ' . esc_html( $input_with_area['input_with_area-2'] ) . '</p>';
        $output .= '</div><!-- .cmb2-input_with_area -->';
        return apply_filters( 'jt_cmb2_get_input_with_area_field', $output );
    }

    function cmb2_init_input_with_area_field()
    {
        include( plugin_dir_path( __FILE__ ) . 'cmb2-render-input-with-area-field.php' );
        CMB2_Render_Input_With_Area_Field::init();
    }

    add_action( 'cmb2_init', 'cmb2_init_input_with_area_field' );