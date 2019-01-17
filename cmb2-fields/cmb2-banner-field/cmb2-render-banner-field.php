<?php
    class CMB2_Render_Banner_Field extends CMB2_Type_Base {

        public static function init(){
            add_filter( 'cmb2_render_class_banner', array( __CLASS__, 'class_name' ) );
        }

        public static function class_name()
        {
            return __CLASS__;
        }

        public function render() {
            echo '<img class="cmb2-metabox-banner" src="' . esc_url( $this->field->args( 'url' ) ) . '" alt="preview" />';
            echo '<p class="cmb2-metabox-description">' . esc_html( $this->field->args( 'desc' ) ) . '</p>';
        }
    }