<?php

    /**
     * Handles 'input_with_area' custom field type.
     */
    class CMB2_Render_Input_With_Area_Field extends CMB2_Type_Base
    {
        /**
         *
         * @var array
         */
        public static function init()
        {
            add_filter( 'cmb2_render_class_input_with_area', array( __CLASS__, 'class_name' ) );

            /**
             * The following snippets are required for allowing the input_with_area field
             * to work as a repeatable field, or in a repeatable group
             */
            add_filter( 'cmb2_sanitize_input_with_area', array( __CLASS__, 'sanitize' ), 10, 5 );
            add_filter( 'cmb2_types_esc_input_with_area', array( __CLASS__, 'escape' ), 10, 4 );
        }

        public static function class_name()
        {
            return __CLASS__;
        }

        /**
         * Handles outputting the input_with_area field.
         */
        public function render()
        {
            // make sure we assign each part of the value we need.
            $value = wp_parse_args( $this->field->escaped_value(), array(
                'input_with_area-1' => '',
                'input_with_area-2' => '',
            ) );
            ob_start();
            // Do html
            ?>
            <div style="overflow: hidden;">
                <div>
                    <?php $id_first = explode('"', $this->_id( '_input_with_area_1' )); ?>
                    <input type="text" class="regular-text" name="<?php echo esc_html( $this->_name( '[input_with_area-1]' ) ); ?>" id="<?php echo esc_html( $id_first[0] ) ?>" <?php
                        if( count( $id_first ) > 1 ) {
                            echo esc_html( $id_first[1] ) . esc_html( $id_first[2] );
                        }
                    ?> value="<?php echo esc_html( $value['input_with_area-1'] ) ?>">
                    <span class="cmb2-metabox-description"><?php echo esc_html( $this->_text( 'input_with_area_1_text', '' ) ); ?></span>
                </div>
                <p class="clear"></p>
                <div>
                    <?php $id_second = explode('"', $this->_id( '_input_with_area_2' )); ?>
                    <textarea class="cmb2_textarea" cols="60" rows="4" name="<?php echo esc_html( $this->_name( '[input_with_area-2]' ) ); ?>" id="<?php echo esc_html( $id_second[0] ) ?>" <?php
                        if( count( $id_second ) > 1 ) {
                            echo esc_html( $id_second[1] ) . esc_html( $id_second[2] );
                        }
                    ?> ><?php echo esc_html( $value['input_with_area-2'] ) ?></textarea>
                    <div><span class="cmb2-metabox-description"><?php echo esc_html( $this->_text('input_with_area_2_text', '') ); ?> </span></div>
                </div>
            </div>

            <?php
            // grab the data from the output buffer.
            return $this->rendered( ob_get_clean() );
        }

        /**
         * Optionally save the Input_With_Area values into separate fields
         */


        public static function sanitize( $check, $meta_value, $object_id, $field_args, $sanitize_object )
        {
            // if not repeatable, bail out.
            if ( !is_array( $meta_value ) || !$field_args['repeatable'] ) {
                return $check;
            }
            foreach ( $meta_value as $key => $val ) {
                $meta_value[$key] = array_filter( array_map( 'sanitize_text_field', $val ) );
            }
            return array_filter( $meta_value );
        }

        public static function escape( $check, $meta_value, $field_args, $field_object )
        {
            // if not repeatable, bail out.
            if ( !is_array( $meta_value ) || !$field_args['repeatable'] ) {
                return $check;
            }
            foreach ( $meta_value as $key => $val ) {
                $meta_value[$key] = array_filter( array_map( 'esc_attr', $val ) );
            }
            return array_filter( $meta_value );
        }
    }