<?php
    /**
     * Template tag for displaying an double_input from the CMB2 double_input field type (on the front-end)
     *
     * @since  0.1.0
     *
     * @param  string $metakey The 'id' of the 'double_input' field (the metakey for get_post_meta)
     * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
     */
    function jt_cmb2_double_input_field( $metakey, $post_id = 0 )
    {
        echo jt_cmb2_get_double_input_field( $metakey, $post_id );
    }

    /**
     * Template tag for returning an double_input from the CMB2 double_input field type (on the front-end)
     *
     * @since  0.1.0
     *
     * @param  string $metakey The 'id' of the 'double_input' field (the metakey for get_post_meta)
     * @param  integer $post_id (optional) post ID. If using in the loop, it is not necessary
     */
    function jt_cmb2_get_double_input_field( $metakey, $post_id = 0 )
    {
        $post_id = $post_id ? $post_id : get_the_ID();
        $double_input = get_post_meta( $post_id, $metakey, 1 );
        // Set default values for each double_input key
        $double_input = wp_parse_args( $double_input, array(
            'double_input-1' => '',
            'double_input-2' => '',
        ) );
        $output = '<div class="cmb2-double_input">';
        $output .= '<p><strong>Double_input1:</strong> ' . esc_html( $double_input['double_input-1'] ) . '</p>';
        $output .= '<p><strong>Double_input2:</strong> ' . esc_html( $double_input['double_input-2'] ) . '</p>';
        $output .= '</div><!-- .cmb2-double_input -->';
        return apply_filters( 'jt_cmb2_get_double_input_field', $output );
    }

    function cmb2_init_double_input_field()
    {
        include( plugin_dir_path( __FILE__ ) . 'cmb2-render-double-input-field.php' );
        CMB2_Render_Double_input_Field::init();
    }

    add_action( 'cmb2_init', 'cmb2_init_double_input_field' );