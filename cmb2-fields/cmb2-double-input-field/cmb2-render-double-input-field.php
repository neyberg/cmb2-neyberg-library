<?php
    /**
     * Handles 'double_input' custom field type.
     */
    class CMB2_Render_Double_Input_Field extends CMB2_Type_Base
    {
        /**
         *
         * @var array
         */
        public static function init()
        {
            add_filter( 'cmb2_render_class_double_input', array( __CLASS__, 'class_name' ) );

            /**
             * The following snippets are required for allowing the double_input field
             * to work as a repeatable field, or in a repeatable group
             */
            add_filter( 'cmb2_sanitize_double_input', array( __CLASS__, 'sanitize' ), 10, 5 );
            add_filter( 'cmb2_types_esc_double_input', array( __CLASS__, 'escape' ), 10, 4 );
        }

        public static function class_name()
        {
            return __CLASS__;
        }

        /**
         * Handles outputting the double_input field.
         */
        public function render()
        {
            // make sure we assign each part of the value we need.
            $value = wp_parse_args( $this->field->escaped_value(), array(
                'double_input-1' => '',
                'double_input-2' => '',
            ) );
            ob_start();
            // Do html
            ?>
            <div style="overflow: hidden;">
                <div class="alignleft">
                    <?php $id_first = explode('"', $this->_id( '_double_input-1' )); ?>
                    <input type="text" class="regular-text" name="<?php echo esc_html( $this->_name( '[double_input-1]' ) ); ?>" id="<?php echo esc_html( $id_first[0] ) ?>" <?php
                        if( count( $id_first ) > 1 ) {
                            echo esc_html( $id_first[1] ) . esc_html( $id_first[2] );
                        }
                    ?> value="<?php echo esc_html( $value['double_input-1'] ) ?>">
                    <span class="cmb2-metabox-description"><?php echo esc_html( $this->_text('double_input_1_text', '' ) ); ?></span>
                </div>
                <p class="clear"></p>
                <div class="alignleft">
                    <?php $id_second = explode('"', $this->_id( '_double_input-2' )); ?>
                    <input type="text" class="regular-text" name="<?php echo esc_html( $this->_name( '[double_input-2]' ) ); ?>" id="<?php echo esc_html( $id_second[0] ) ?>" <?php
                        if( count( $id_second ) > 1 ) {
                            echo esc_html( $id_second[1] ) . esc_html( $id_second[2] );
                        }
                    ?> value="<?php echo esc_html( $value['double_input-2'] ) ?>">
                    <span class="cmb2-metabox-description"><?php echo esc_html( $this->_text('double_input_2_text', '' ) ); ?></span>
                </div>
            </div>

            <?php
            // grab the data from the output buffer.
            return $this->rendered( ob_get_clean() );
        }

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