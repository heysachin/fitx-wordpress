<?php
/**
 *    Oxygen WordPress Theme
 *
 *    Laborator.co
 *    www.laborator.co
 */

$id = get_the_id();

$contact_form_title = oxygen_get_field( 'contact_form_title' );
$available_fields   = oxygen_get_field( 'available_fields' );
$required_fields    = oxygen_get_field( 'required_fields' );
$success_message    = oxygen_get_field( 'success_message' );
$privacy_text       = oxygen_get_field( 'privacy_text' );
$enable_recaptcha   = oxygen_get_field( 'enable_recaptcha' );

$field_names = array(
	'name'    => __( 'Name', 'oxygen' ),
	'email'   => __( 'E-mail', 'oxygen' ),
	'phone'   => __( 'Phone Number', 'oxygen' ),
	'message' => __( 'Message', 'oxygen' ),
);

?>
<!-- Contact Form Block -->
<div class="row contact-form-block">
    <div class="col-lg-5">

        <div class="success-message">
            <div class="alert alert-success">
				<?php echo $success_message; ?>
            </div>
        </div>

        <div class="white-block block-pad contact-store contact-form">
            <h4><?php echo $contact_form_title; ?></h4>

            <form role="form" class="form-elements" data-check="<?php echo wp_create_nonce( 'contact-form' ); ?>" data-id="<?php echo $id; ?>">

				<?php foreach ( $available_fields as $field_name ) : if ( $field_name == 'message' ) {
					$has_message_field = $field_name;
					continue;
				} ?>
                    <div class="field">
                        <label for="<?php echo $field_name; ?>">
							<?php echo esc_attr( $field_names[ $field_name ] ) . ( in_array( $field_name, $required_fields ) ? ' <span class="red">*</span>' : '' ); ?>
                        </label>
                        <input type="text" <?php echo in_array( $field_name, $required_fields ) ? ' data-required="1"' : ''; ?> name="<?php echo $field_name; ?>" id="<?php echo $field_name; ?>" class="form-control"/>
                    </div>
				<?php endforeach; ?>

				<?php if ( isset( $has_message_field ) ): ?>
                    <div class="field">
                        <label for="<?php echo $has_message_field; ?>"><?php echo $field_names[ $has_message_field ] . ( in_array( $has_message_field, $required_fields ) ? ' <span class="red">*</span>' : '' ); ?></label>
                        <textarea type="text"<?php echo in_array( $has_message_field, $required_fields ) ? ' data-required="1"' : ''; ?> name="<?php echo $has_message_field; ?>" id="<?php echo $has_message_field; ?>" class="autogrow"></textarea>
                    </div>
				<?php endif; ?>

				<?php if ( ! empty( $privacy_text ) ) : ?>
                    <div class="field privacy-policy">
                        <label>
                            <input type="checkbox" name="privacy_policy" value="1" data-required-text="<?php esc_attr_e( 'You must accept the site privacy policy in order to submit this form.', 'oxygen' ); ?>"/>
							<?php echo do_shortcode( $privacy_text ); ?>
                        </label>
                    </div>
				<?php endif; ?>

				<?php if ( $enable_recaptcha ) : ?>
                    <div class="recaptcha-container">
						<?php echo apply_filters( 'gglcptch_display_recaptcha', '' ); ?>
                    </div>
				<?php endif; ?>

                <div class="field contact-form-submit">
                    <input type="submit" value="<?php _e( 'Send', 'oxygen' ); ?>" class="btn-default btn contact-send"/>

                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </div>

            </form>

            <div class="mail-sent">
                <div class="mail-left"></div>
                <div class="mail-right"></div>
                <div class="mail-bottom"></div>
                <div class="mail-top"></div>
            </div>
        </div>
    </div>
</div>
