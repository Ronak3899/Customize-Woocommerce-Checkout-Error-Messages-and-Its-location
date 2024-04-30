add_filter( 'woocommerce_form_field', 'add_inline_error_messages_element', 10, 4 );
function add_inline_error_messages_element( $field, $key, $args, $value ) {
    if ( strpos( $field, '</span>' ) !== false ) {
        $error = '<span class="js-custom-error-message" style="display:none"></span>';
        $field = substr_replace( $field, $error, strpos( $field, '</span>' ), 0);
    }
    return $field;
}
/**
 * process custom checkout validations
 *
 * @param array $fields
 * @param object $errors
 */
add_action('woocommerce_after_checkout_validation', 'custom_checkout_validations', 10, 2);
function custom_checkout_validations($data, $errors)
{
    $billing_first_name = filter_input(INPUT_POST, 'billing_first_name');
    $billing_last_name = filter_input(INPUT_POST, 'billing_last_name');
    $billing_country = filter_input(INPUT_POST, 'billing_country');
    $billing_address_1 = filter_input(INPUT_POST, 'billing_address_1');
    $billing_city = filter_input(INPUT_POST, 'billing_city');
    $billing_state = filter_input(INPUT_POST, 'billing_state');
    $billing_postcode = filter_input(INPUT_POST, 'billing_postcode');
    $billing_phone = filter_input(INPUT_POST, 'billing_phone');
    $billing_email = filter_input(INPUT_POST, 'billing_email');
    $shipping_first_name = filter_input(INPUT_POST, 'shipping_first_name');
    $shipping_last_name = filter_input(INPUT_POST, 'shipping_last_name');
    $shipping_country = filter_input(INPUT_POST, 'shipping_country');
    $shipping_address_1 = filter_input(INPUT_POST, 'shipping_address_1');
    $shipping_city = filter_input(INPUT_POST, 'shipping_city');
    $shipping_state = filter_input(INPUT_POST, 'shipping_state');
    $shipping_postcode = filter_input(INPUT_POST, 'shipping_postcode');
    $shipping_phone = filter_input(INPUT_POST, 'shipping_phone');
    $shipping_email = filter_input(INPUT_POST, 'shipping_email');
    // your custom validations goes here
    // this is an example to check for the length of the string
    if (empty($billing_first_name)) {
        $errors->add('billing_first_name', __('Please enter your first name', 'hello-elementor'));
    }
    if (empty($billing_last_name)) {
        $errors->add('billing_last_name', __('Please enter your last name', 'hello-elementor'));
    }
    if (empty($billing_country)) {
        $errors->add('billing_country', __('Please enter your country', 'hello-elementor'));
    }
    if (empty($billing_address_1)) {
        $errors->add('billing_address_1', __('Please enter your street address', 'hello-elementor'));
    }
    if (empty($billing_city)) {
        $errors->add('billing_city', __('Please enter your city name', 'hello-elementor'));
    }
    if (empty($billing_state)) {
        $errors->add('billing_state', __('Please enter your state name', 'hello-elementor'));
    }
    if (empty($billing_postcode)) {
        $errors->add('billing_postcode', __('Please enter your zipcode', 'hello-elementor'));
    }
    if (empty($billing_phone)) {
        $errors->add('billing_phone', __('Please enter your phone', 'hello-elementor'));
    }
    if (empty($billing_email)) {
        $errors->add('billing_email', __('Please enter your email address', 'hello-elementor'));
    }
    if (empty($shipping_first_name)) {
        $errors->add('shipping_first_name', __('Please enter your first name', 'hello-elementor'));
    }
    if (empty($shipping_last_name)) {
        $errors->add('shipping_last_name', __('Please enter your last name', 'hello-elementor'));
    }
    if (empty($shipping_country)) {
        $errors->add('shipping_country', __('Please enter your country', 'hello-elementor'));
    }
    if (empty($shipping_address_1)) {
        $errors->add('shipping_address_1', __('Please enter your street address', 'hello-elementor'));
    }
    if (empty($shipping_city)) {
        $errors->add('shipping_city', __('Please enter your city name', 'hello-elementor'));
    }
    if (empty($shipping_state)) {
        $errors->add('shipping_state', __('Please enter your state name', 'hello-elementor'));
    }
    if (empty($shipping_postcode)) {
        $errors->add('shipping_postcode', __('Please enter your zipcode', 'hello-elementor'));
    }
    if (empty($shipping_phone)) {
        $errors->add('shipping_phone', __('Please enter your phone', 'hello-elementor'));
    }
    if (empty($shipping_email)) {
        $errors->add('shipping_email', __('Please enter your email address', 'hello-elementor'));
    }
    // this loop adds a data array to all error messages which will be applied as a "data-error-for" HTML attribute
    // to read out the corresponding field ids with javascript and display the error messages inline
    foreach( $errors->errors as $original_key => $error ) {
        $field_key = $original_key;
        // filter and rewrite the field id for native woocommerce error messages with a key containing _required
        if(strpos($original_key, '_required') !== false) {	
            $field_key = str_replace('_required','', $original_key);
            $error[0] = __('This is a required field', 'hello-elementor');
        }
        // switch out the old error messages with the ones including a spiced up data array
        // to display with javascript
        $errors->remove($original_key);
        $errors->add($original_key, trim($error[0]), ['error-for' => $field_key . '_field']);
    }
}
