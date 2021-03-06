<?php
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
/**
 * Class to create a custom tags control
 */
class Text_Editor_Custom_Control extends WP_Customize_Control
{
      /**
       * Render the content on the theme customizer page
       */
      public function render_content()
       {
            ?>
                <label>
                  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                  <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
                  <?php
                    $settings = array(
                        'textarea_name' => $this->id,
                        'media_buttons' => false,
                        'drag_drop_upload' => false,
                        'teeny' => false
                    );
                    wp_editor($this->value(), $this->id, $settings );

                    do_action('admin_footer');
                    do_action('admin_print_footer_scripts');

                  ?>
                </label>
            <?php
       }
}
