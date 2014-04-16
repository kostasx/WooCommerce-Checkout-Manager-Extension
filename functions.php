<?php

/*** WooCommerce Checkout Manager Mod ***/

remove_action('woocommerce_after_checkout_billing_form', 'wccs_custom_checkout_field');
   add_action('woocommerce_after_checkout_billing_form', 'wccs_custom_checkout_field_mod');

function wccs_custom_checkout_field_mod( $checkout ) {
	$options = get_option( 'wccs_settings' );
	if ( count( $options['buttons'] ) > 0 ) : ?>
	<?php
						$i = 0;
						// Loop through each button
						foreach ( $options['buttons'] as $btn ) :
							$label = ( isset( $btn['label'] ) ) ? $btn['label'] : '';
	?>				
	<?php
	if ( ! empty( $btn['label'] ) &&  ($btn['type'] == 'text') ) {
	   woocommerce_form_field( ''.$btn['cow'].'' , array(
	        'type'          => 'text',
	        'class'         => array('wccs-field-class wccs-form-row-wide'), 
	        'label'         =>  __(''.$btn['label'].'', 'woocommerce-checkout-manager' ),
	        'required'  => $btn['checkbox'],
	        'placeholder'       => ''.$btn['placeholder'].'',
	        ), $checkout->get_value( ''.$btn['cow'].'' )); 
	}
	if ( ! empty( $btn['label'] ) &&  ($btn['type'] == 'select') ) {

	   $select_options = explode( ',', sanitize_text_field( $btn['option_a'] ));	// ADDITION

	   woocommerce_form_field( ''.$btn['cow'].'' , array(
	        'type'          => 'select',
	        'class'         => array('wccs-field-class wccs-form-row-wide'), 
	        'label'         =>  __(''.$btn['label'].'', 'woocommerce-checkout-manager' ),
			/*
	        'options'     => array(
	             '' => __('Select below', 'woocommerce-checkout-manager' ),
	             ''.$btn['option_a'].'' => __(''.$btn['option_a'].'', 'woocommerce-checkout-manager' ),
	             ''.$btn['option_b'].'' => __(''.$btn['option_b'].'', 'woocommerce-checkout-manager' )
	                                                 ),
	        */
	   		'options' 	=> $select_options,
	        'required'  => $btn['checkbox'],
	        'placeholder'       => ''.$btn['placeholder'].'',
	        ), $checkout->get_value( ''.$btn['cow'].'' )); 
	}
	if ( ! empty( $btn['label'] ) &&  ($btn['type'] == 'date') ) {
	echo '<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery(".MyDate-'.$btn['cow'].' #'.$btn['cow'].'").datepicker({
	        dateFormat : "dd-mm-yy"
	    });
	});
	</script>';
	woocommerce_form_field( ''.$btn['cow'].'' , array(
	        'type'          => 'text',
	        'class'         => array('wccs-field-class MyDate-'.$btn['cow'].' wccs-form-row-wide'), 
	        'label'         =>  __(''.$btn['label'].'', 'woocommerce-checkout-manager' ),
	        'required'  => $btn['checkbox'],
	        'placeholder'       => ''.$btn['placeholder'].'',
	        ), $checkout->get_value( ''.$btn['cow'].'' )); 
	}
	if ( ! empty( $btn['label'] ) &&  ($btn['type'] == 'checkbox') ) {
	woocommerce_form_field( ''.$btn['cow'].'' , array(
	        'type'          => 'checkbox',
	        'class'         => array('wccs-field-class wccs-form-row-wide'), 
	        'label'         =>  __(''.$btn['label'].'', 'woocommerce-checkout-manager' ),
	        'required'  => $btn['checkbox'],
	        'placeholder'       => ''.$btn['placeholder'].'',
	        ), $checkout->get_value( ''.$btn['cow'].'' )); 
	}
	?>
	<?php 
	$i++;
						endforeach;
	?>
	<?php
	endif;
}	
