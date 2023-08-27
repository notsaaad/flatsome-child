<?php

function theme_child_styles_scripts() {
    /* THIS WILL ALLOW ADDING CUSTOM CSS TO THE style.css */
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/style.css', '' , rand() );

    /* Uncomment this line if you want to add custom javascript */
    wp_enqueue_script( 'child-js', get_stylesheet_directory_uri() .'/scripts.js', '', rand(), true );
}
add_action( 'wp_enqueue_scripts', 'theme_child_styles_scripts', 10 );

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

/**
 * Fix Turkish characters in WooCommerce input forms
 */
function fix_turkish_characters_input_forms( $translated_text, $text, $domain ) {
    if ( 'woocommerce' === $domain ) {
        $translated_text = wptexturize( $translated_text );
        $translated_text = str_replace(
            array( '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8242;', '&#8243;' ),
            array( '‘', '’', '“', '”', '′', '″' ),
            $translated_text
        );
    }
    return $translated_text;
}
add_filter( 'gettext', 'fix_turkish_characters_input_forms', 10, 3 );



add_action( 'woocommerce_cart_calculate_fees','woocommerce_custom_donation',10, 1 );
function woocommerce_custom_donation($cart) {
    global $woocommerce;
    global $wpdb;
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

        $fee7="";
        $fee6="";
        $fee5="";
        $fee4="";
        $fee3="";
        $fee2="";
        $fee1="";
          global $wpdb;
          $user_ID = get_current_user_id();
          $table_name =  'Sawyan_user';
          $results 	= $wpdb->get_results("SELECT * FROM $table_name where (user_ID = $user_ID)" );

          $values = json_decode(json_encode($results), true);
          foreach($values as $value){
            $weight = $value['user_weight'];
            $fee7 = $value['fee7'];
            $fee6 = $value['fee6'];
            $fee5 = $value['fee5'];
            $fee4 = $value['fee4'];
            $fee3 = $value['fee3'];
            $fee2 = $value['fee2'];
            $fee1 = $value['fee1'];
        }

        foreach ( $cart->get_cart() as $key => $item ) {
          $product= $item['data'];
          $productID =$product-> id;
          if ($productID == 9113){
          $product->set_weight($weight);
          // $key['data'] -> set_weight($weight);

            if (is_numeric($fee1)&& $fee1!=0){
              $cart -> add_fee('تعبئة وتغليف',$fee1);
            }
            if (is_numeric($fee2)&& $fee2!=0){
              $cart -> add_fee('فحص ومطابقة المنتج',$fee2);
            }
            if (is_numeric($fee3)&& $fee3!=0){
              $cart -> add_fee('رسوم المرتجع',$fee3);
            }
            if (is_numeric($fee4)&& $fee4!=0){
              $cart -> add_fee('اتعاب المرتجع',$fee4);
            }
            if (is_numeric($fee5)&& $fee5!=0){
              $cart -> add_fee('انتقالات داخلية',$fee5);
            }
            if (is_numeric($fee6)&& $fee6!=0){
              $cart -> add_fee('اتعاب الانتقالات الداخلية',$fee6);
            }
            if (is_numeric($fee7)&& $fee7!=0){
              $cart -> add_fee('أخرى',$fee7);
            }



        $percentage     = 10;
        $cart_total     = $woocommerce->cart->cart_contents_total;
        $shipping_total = $woocommerce->cart->get_shipping_total() ?: 0;
        $tax_total      = $woocommerce->cart->get_taxes_total() ?: 0;

        $grand_total = $cart_total + $shipping_total + $tax_total+$fee1+$fee2+$fee3+$fee4+$fee5+$fee6+$fee7;
        $donation = $grand_total * $percentage / 100;
        $woocommerce->cart->add_fee( 'عمولة البنك', $donation, true, '' );
      }
      else{

        $percentage     = 10;
        $cart_total     = $woocommerce->cart->cart_contents_total;
        $shipping_total = $woocommerce->cart->get_shipping_total() ?: 0;
        $tax_total      = $woocommerce->cart->get_taxes_total() ?: 0;

        $grand_total = $cart_total + $shipping_total + $tax_total;
        $donation = $grand_total * $percentage / 100;
        $woocommerce->cart->add_fee( 'عمولة البنك', $donation, true, '' );

      }
      }
    }



// add_action( 'template_redirect', 'define_default_payment_gateway' );
// function define_default_payment_gateway(){
//     if( is_checkout() && ! is_wc_endpoint_url() ) {
//        // Define here ya 7atem payment method
//         $default_payment_id = 'stripe';

//         WC()->session->set( 'chosen_payment_method', $default_payment_id );
//     }
// }


// add_action( 'woocommerce_thankyou', function( $order_id ){
//     $order = new WC_Order( $order_id );

//     $url = 'http://sawyancom.com';

//     if ( $order->status != 'failed' ) {
//         echo "<script type=\"text/javascript\">window.location = '".$url."'</script>";
//     }
// });

// add_filter ( 'woocommerce_account_menu_items', 'misha_one_more_link' );
// function misha_one_more_link( $menu_links ){

// 	$new = array( 'anyuniquetext123' => 'بيانات مخزني' );

	// array_slice() is good when you want to add an element between the other ones
// 	$menu_links = array_slice( $menu_links, 0, 1, true )
// 	+ $new
// 	+ array_slice( $menu_links, 1, NULL, true );

// 	return $menu_links;

// }

// hook the external URL
// add_filter( 'woocommerce_get_endpoint_url', 'misha_hook_endpoint', 10, 4 );
// function misha_hook_endpoint( $url, $endpoint, $value, $permalink ){

// 	if( 'anyuniquetext123' === $endpoint ) {

		// ok, here is the place for your custom URL, it could be external
// 		$url = 'http://sawyancom.com/user-id/';

// 	}
// 	return $url;

// }
// thumbnail
add_filter( 'woocommerce_order_item_name', 'display_product_image_in_order_item', 20, 3 );
function display_product_image_in_order_item( $item_name, $item, $is_visible ) {
    //  order pages
    if( is_wc_endpoint_url( 'view-order' ) ) {
        $product   = $item->get_product(); // Get the WC_Product object
        $thumbnail = $product->get_image(array( 100, 125)); // Get the product thumbnail
        if( $product->get_image_id() > 0 )
            $item_name = '<div class="item-thumbnail">' . $thumbnail . '</div>' . $item_name;
    }
    return $item_name;
}
// add_shortcode( 'um_field_data', 'um_custom_field_shortcode' );

// if ( ! function_exists( 'um_custom_field_shortcode' ) ) {
// 	function um_custom_field_shortcode( $atts = array() ){

// 		$defaults = array(
// 				'field' => NULL,
// 				'userid' => um_profile_id(),
// 		);

// 		$atts = wp_parse_args( $atts, $defaults );
// 		extract( $atts );

// 		ob_start();
//                 if( "user_id" == $atts['field'] ){
//                     return $atts['userid'];
//                 }

// 		$user_id = um_user($atts['userid']);
// 		um_fetch_user( $user_id );
// 		$meta_value = um_user($atts['field']);

// 		print_r($meta_value);

// 	    $shortcode_content = ob_get_contents();
// 	    ob_end_clean();

// 	    return $shortcode_content;
// 	}
// }
// Hide Shipping method
add_filter( 'woocommerce_package_rates', 'hide_shipping_method', 10, 2 );
function hide_shipping_method( $rates, $package ) {
    $shipping_method_id_to_hide = 'shipping_method_0_naqel_shipping'; //
    unset( $rates[ $shipping_method_id_to_hide ] );
    return $rates;
}
//Code for column
//// Add a new column to "My Orders" page
add_filter( 'woocommerce_my_account_my_orders_columns', 'add_order_weight_column' );
function add_order_weight_column( $columns ) {
    $columns['order_weight'] = __( 'الوزن الاجمالى', 'woocommerce' );
    return $columns;
}

// Populate the new column with the total weight of all products in each order
add_action( 'woocommerce_my_account_my_orders_column_order_weight', 'show_order_weight_column', 10, 1 );
function show_order_weight_column( $order ) {
    $order_total_weight = 0;
    foreach ( $order->get_items() as $item ) {
        $product = $item->get_product();
        $product_weight = $product->get_weight();
        $item_quantity = $item->get_quantity();
        $order_total_weight += ( (int)$product_weight * (int)$item_quantity );
    }
    echo $order_total_weight . ' ' . __( 'kg', 'woocommerce' );
}
// Sobhy Field to edit total weight of order
add_action( 'woocommerce_admin_order_data_after_order_details', 'add_total_weight_to_admin_order_page' );

function add_total_weight_to_admin_order_page( $order ){

    $order_id = $order->get_id(); // Get the order ID

    // Get the order object
    $order = wc_get_order( $order_id );

    // Get the total order weight
    $total_weight = $order->get_meta('_order_weight');

    // Output the total order weight in a container
    echo '<p class="form-field form-field-wide"><label>' . __( 'Total Order Weight', 'woocommerce' ) . ':</label> <span>' . $total_weight . ' kg</span></p>';
    echo '<button type="button" id="edit-weight" class="button">' . __( 'Edit Weight', 'woocommerce' ) . '</button>';

    // Add jQuery script to handle the button click event
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('#edit-weight').on('click', function() {
                var weight = prompt("Enter the new weight", "<?php echo $total_weight; ?>");
                if (weight != null) {
                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'update_order_weight',
                            weight: weight,
                            order_id: '<?php echo $order_id; ?>'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
    <?php
}

add_action( 'wp_ajax_update_order_weight', 'update_order_weight_callback' );
add_action( 'wp_ajax_nopriv_update_order_weight', 'update_order_weight_callback' );

function update_order_weight_callback() {
    $weight = $_POST['weight'];
    $order_id = $_POST['order_id'];
    $order = wc_get_order( $order_id );
    $order->update_meta_data( '_order_weight', $weight );
    $order->save();
    die();
}

//Show weight in user order page
add_action( 'woocommerce_order_details_after_order_table', 'custom_order_weight_display', 10, 1 );

function custom_order_weight_display( $order_id ){
    $order = wc_get_order( $order_id );
    $weight = $order->get_meta( '_order_weight' );
    if( !empty( $weight ) ){
        echo '<div class="order-weight-container">';
        echo '<h2>' . __( 'Order Weight', 'woocommerce' ) . '</h2>';
        echo '<p>' . __( 'The total weight of your order is', 'woocommerce' ) . ' ' . $weight . ' ' . __( 'kg', 'woocommerce' ) . '</p>';
        echo '</div>';
    }
}
// Endpoint_Sobhy
add_filter ( 'woocommerce_account_menu_items', 'wpsh_custom_endpoint', 40 );
function wpsh_custom_endpoint( $menu_links ){

	$menu_links = array_slice( $menu_links, 0, 5, true )
	+ array( 'support' => 'عنوان مخزني' )
	+ array_slice( $menu_links, 5, NULL, true );

	return $menu_links;

}

add_action( 'init', 'wpsh_new_endpoint' );
function wpsh_new_endpoint() {
	add_rewrite_endpoint( 'support', EP_PAGES ); // Don’t forget to change the slug here

}
add_action( 'woocommerce_account_support_endpoint', 'wpsh_endpoint_content' );
function wpsh_endpoint_content() {


echo '  <div class="hatem-setion">

      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Ad</label>
            <label class="Right-label" style="color: white;">الأسم</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy2" value="AL BAWABAH" >
          <i id="hatem-copy-2" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>
      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Soyad</label>
            <label class="Right-label" style="color: white;">اللقب</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy3" value="TICARET" >
          <i id="hatem-copy-3" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>
      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Adı Soyadı</label>
            <label class="Right-label" style="color: white;">الاسم الكامل</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy4" value="AL BAWABAH TICARET " >
          <i id="hatem-copy-4" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>


      <div class="filed-holder">
        <div class="form hatem-filed hatem-change-id">
          <div class="labels">
            <label class="Left-label" style="color: white;">Adres</label>

            <label class="Right-label" style="color: white;">العنوان الكامل</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy1" value="İnönü, Belde Cd., 34510 Beylikdüzü Osb/Esenyurt/İstanbul, Türkiye Box:" >
          <i id="hatem-copy-1" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>

      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Adres Başliği</label>


            <label class="Right-label" style="color: white;">ترويسة العنوان</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy11" value="AL BAWABAH TICARET" >
          <i id="hatem-copy-11" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>



      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">İl / Şehir</label>

            <label class="Right-label" style="color: white;">المحافظة</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy6" value="İstanbul" >
          <i id="hatem-copy-6" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>
      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">İlçe</label>
            <label class="Right-label" style="color: white;">المقاطعة</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy7" value="ESENYURT" >
          <i id="hatem-copy-7" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>


      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Mahalle</label>

            <label class="Right-label" style="color: white;">المنطقة</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy12" value="İnönü MAH" >
          <i id="hatem-copy-12" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>


      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Cep Telefonu</label>

            <label class="Right-label" style="color: white;">رقم التليفون</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy5" value="05541870582" >
          <i id="hatem-copy-5" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>

      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">VERGI KIMLIK NO.</label>

            <label class="Right-label" style="color: white;">الرقم الضريبي</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy8" value="0471119092" >
          <i id="hatem-copy-8" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>

      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">VERGI DAIRESI</label>

            <label class="Right-label" style="color: white;">الدائرة الضريبة</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy9" value="AVCILAR" >
          <i id="hatem-copy-9" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>

      <div class="filed-holder">
        <div class="form hatem-filed">
          <div class="labels">
            <label class="Left-label" style="color: white;">Firma Adı</label>

            <label class="Right-label" style="color: white;">اسم الشركة</label>
          </div>
          <div class="Inputs-icon">
          <input type="text" id="hatem-filed-copy10" value="AL BAWABAH TICARET GAYRIMENKUL DANISMANLIGI TURIZM SAGLIK VE EGITIM HIZMETLERI LIMITED SIRKETI" >
          <i id="hatem-copy-10" class="fa-regular fa-copy" title="نسخ"></i>

            </div>
        </div>
      </div>



    </div>


    <div class="hatem-copy-ture-section">
      <div class="hatem-Copy-true"><h4>تم نسخ النص بنجاح</h4></div>
    </div>';

}


// Test remove badge sale
function hide_sale_badge_for_not_logged_in_users() {
    if ( ! is_user_logged_in() ) {
        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    }
}
add_action( 'template_redirect', 'hide_sale_badge_for_not_logged_in_users' );
function move_woocommerce_fields_to_top() {
    // Remove default fields
    remove_action('woocommerce_register_form', 'woocommerce_register_form');

    // Add custom fields at the top
    add_action('woocommerce_register_form_start', 'add_custom_woocommerce_fields');
}
add_action('init', 'move_woocommerce_fields_to_top');

function add_custom_woocommerce_fields() {
?>
    <p class="form-row form-row-first">
        <label for="reg_first_name"><?php _e('الاسم الأول', 'woocommerce'); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="first_name" id="reg_first_name" value="<?php if (!empty($_POST['first_name'])) esc_attr_e($_POST['first_name']); ?>" required="required" />
    </p>
    <p class="form-row form-row-last">
        <label for="reg_last_name"><?php _e('الاسم الأخير', 'woocommerce'); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="last_name" id="reg_last_name" value="<?php if (!empty($_POST['last_name'])) esc_attr_e($_POST['last_name']); ?>" required="required" />
    </p>
    <div class="clear"></div>
<?php
}


//Variable and simple product displayed prices (removing sale price range)
add_filter( 'woocommerce_get_price_html', 'custom_get_price_html', 20, 2 );
function custom_get_price_html( $price, $product ) {
    if( $product->is_type('variable') ) {
        if( is_user_logged_in() ) {
            $price_min = wc_get_price_to_display( $product, array( 'price' => $product->get_variation_sale_price('min') ) );
            $price_max = wc_get_price_to_display( $product, array( 'price' => $product->get_variation_sale_price('max') ) );
        } else {
            $price_min = wc_get_price_to_display( $product, array( 'price' => $product->get_variation_regular_price('min') ) );
            $price_max = wc_get_price_to_display( $product, array( 'price' => $product->get_variation_regular_price('max') ) );
        }

        if( $price_min != $price_max ) {
            if( $price_min == 0 && $price_max > 0 )
                $price = wc_price( $price_max );
            elseif( $price_min > 0 && $price_max == 0 )
                $price = wc_price( $price_min );
            else
                $price = wc_format_price_range( $price_min, $price_max );
        } else {
            if( $price_min > 0 )
                $price = wc_price( $price_min );
        }
        $price .= $product->get_price_suffix();
    }
    elseif( $product->is_type('simple') ) {
        if( is_user_logged_in() ) {
            $active_price = wc_get_price_to_display( $product, array( 'price' => $product->get_sale_price() ) );
            $regular_price = wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
            $price = wc_format_sale_price( $regular_price, $active_price ) . $product->get_price_suffix();
        } else {
            $active_price = wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
            $price = wc_price( $active_price ) . $product->get_price_suffix();
        }
    }
    return $price;
}

add_filter( 'woocommerce_sale_flash', 'filter_sales_flash_callback', 100, 3 );
function filter_sales_flash_callback( $output_html, $post, $product )
{
    if ( ! is_user_logged_in() ) {
        $output_html = false;
    }
    return $output_html;
}
add_action( 'wp_footer', 'scripts_for_adding_country_prefix_on_billing_phone' );
function scripts_for_adding_country_prefix_on_billing_phone(){
    ?>
    <script type="text/javascript">
        ( function( $ ) {
            $( document.body ).on( 'updated_checkout', function(data) {
                var ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>",
                country_code = $('#billing_country').val();
                var ajax_data = {
                    action: 'append_country_prefix_in_billing_phone',
                    country_code: $('#billing_country').val()
                };
                $.post( ajax_url, ajax_data, function( response ) {
                    $('#billing_phone').val(response);
                });
            } );
        } )( jQuery );
    </script>
    <?php
}

add_action( 'wp_ajax_nopriv_append_country_prefix_in_billing_phone', 'country_prefix_in_billing_phone' );
add_action( 'wp_ajax_append_country_prefix_in_billing_phone', 'country_prefix_in_billing_phone' );
function country_prefix_in_billing_phone() {
    $calling_code = '';
    $country_code = isset( $_POST['country_code'] ) ? $_POST['country_code'] : '';
    if( $country_code ){
        $calling_code = WC()->countries->get_country_calling_code( $country_code );
        $calling_code = is_array( $calling_code ) ? $calling_code[0] : $calling_code;
    }
    echo $calling_code;
    die();
}

// // Add a custom endpoint to the My Account menu
// add_filter( 'woocommerce_account_menu_items', 'add_custom_endpoint_to_account_menu', 10, 1 );
// function add_custom_endpoint_to_account_menu( $menu_items ) {
//     $menu_items['custom-page'] = __( 'لوحة تحكم ال FI', 'your-text-domain' ); // Replace 'Custom Page' with your desired menu item label
//     return $menu_items;
// }

// // Add a custom endpoint content
// add_action( 'woocommerce_account_custom-page_endpoint', 'custom_endpoint_content' );
// function custom_endpoint_content() {
//     // Replace 'your-custom-page-template.php' with the file name of your custom page template
//     wc_get_template( 'your-custom-page-template.php' );
// }

// // Add a custom redirect for the My Account menu item
// add_filter( 'woocommerce_get_endpoint_url', 'custom_endpoint_redirect', 10, 4 );
// function custom_endpoint_redirect( $url, $endpoint, $value, $permalink ) {
//     if ( $endpoint === 'custom-page' ) {
//         $url = get_permalink( get_page_by_path( 'my-account-2' ) ); // Replace 'your-custom-page-slug' with the slug of your custom page
//     }
//     return $url;
// }
function disable_logout_verification() {
    if (is_account_page() && !is_user_logged_in()) {
        add_filter('wp_logout', '__return_false');
    }
}
add_action('init', 'disable_logout_verification');

// Add country field to user registration form
add_action( 'woocommerce_register_form_start', 'add_country_field_to_registration_form' );
function add_country_field_to_registration_form() {
    $countries = WC()->countries->get_countries();

    echo '<p class="form-row form-row-wide">';
    woocommerce_form_field( 'billing_country', array(
        'type'          => 'select',
        'class'         => array( 'form-row-wide' ),
        'label'         => __( 'الدولة', 'woocommerce' ),
        'placeholder'   => __( 'اختر الدولة', 'woocommerce' ),
        'options'       => $countries,
        'required'      => true,
    ), '' );
    echo '</p>';
}

// Validate the country field on user registration
add_action( 'woocommerce_register_post', 'validate_country_field_on_registration', 10, 3 );
function validate_country_field_on_registration( $username, $email, $errors ) {
    if ( isset( $_POST['billing_country'] ) && empty( $_POST['billing_country'] ) ) {
        $errors->add( 'billing_country_error', __( 'Please select a country.', 'woocommerce' ) );
    }
}

function register_shipment_arrival_order_status() {
   register_post_status( 'wc-arrival-shipment', array(
       'label'                     => 'تم الاستلام بمخزن تركيا',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'تم الاستلام بمخزن تركيا <span class="count">(%s)</span>', 'تم الاستلام بمخزن تركيا <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_shipment_arrival_order_status' );

function add_awaiting_shipment_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-shipment'] = 'تم الاستلام بمخزن تركيا';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );


///Sobh7y stat2
function register_ship_arrival_order_status() {
   register_post_status( 'wc-arrival-ship', array(
       'label'                     => 'تم الشحن',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'تم الشحن  <span class="count">(%s)</span>', 'تم الشحن   <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_ship_arrival_order_status' );

function add_awaiting_ship_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-ship'] = 'تم الشحن  ';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_ship_to_order_statuses' );

///Sobh7y stat3
function register_ships_arrival_order_status() {
   register_post_status( 'wc-arrival-ships', array(
       'label'                     => 'تم الشراء من المورد',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'تم الشراء من المورد  <span class="count">(%s)</span>', 'تم الشراء من المورد   <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_ships_arrival_order_status' );

function add_awaiting_ships_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-ships'] = 'تم الشراء من المورد  ';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_ships_to_order_statuses' );

///Sobh7y stat4
function register_shipss_arrival_order_status() {
   register_post_status( 'wc-arrival-shipss', array(
       'label'                     => 'تم التعبئة والتغليف',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'تم التعبئة والتغليف  <span class="count">(%s)</span>', 'تم التعبئة والتغليف    <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_shipss_arrival_order_status' );

function add_awaiting_shipss_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-shipss'] = 'تم التعبئة والتغليف    ';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_shipss_to_order_statuses' );

///Sobh7y stat5
function register_shipsse_arrival_order_status() {
   register_post_status( 'wc-arrival-shipsse', array(
       'label'                     => 'جاهز للشحن  ',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'جاهز للشحن    <span class="count">(%s)</span>', 'جاهز للشحن      <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_shipsse_arrival_order_status' );

function add_awaiting_shipsse_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-shipsse'] = 'جاهز للشحن ';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_shipsse_to_order_statuses' );

///Sobh7y stat6
function register_shipssy_arrival_order_status() {
   register_post_status( 'wc-arrival-shipssy', array(
       'label'                     => 'تمت المراجعة    ',
       'public'                    => true,
       'show_in_admin_status_list' => true,
       'show_in_admin_all_list'    => true,
       'exclude_from_search'       => false,
       'label_count'               => _n_noop( 'تمت المراجعة  <span class="count">(%s)</span>', 'تمت المراجعة   <span class="count">(%s)</span>' )
   ) );
}
add_action( 'init', 'register_shipsse_arrival_order_status' );

function add_awaiting_shipssy_to_order_statuses( $order_statuses ) {
   $new_order_statuses = array();
   foreach ( $order_statuses as $key => $status ) {
       $new_order_statuses[ $key ] = $status;
       if ( 'wc-processing' === $key ) {
           $new_order_statuses['wc-arrival-shipssy'] = 'تمت المراجعة   ';
       }
   }
   return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_shipssy_to_order_statuses' );

// Add new column to admin orders page
add_filter('manage_edit-shop_order_columns', 'custom_order_items_column');
function custom_order_items_column($columns){
    $columns['order_items'] = 'Items';
    return $columns;
}

// Populate the new column with items' names
add_action('manage_shop_order_posts_custom_column', 'custom_order_items_column_content');
function custom_order_items_column_content($column){
    global $post;

    if($column == 'order_items'){
        $order = wc_get_order($post->ID);
        $order_items = $order->get_items();

        if($order_items){
            foreach($order_items as $item_id => $item_data){
                echo $item_data->get_name() . '<br>';
            }
        } else {
            echo 'No items found.';
        }
    }
}

  //For Fix undefined Array height and width;

add_filter('woocommerce_resize_images', static function() {
    return false;
});

function third_party_tracking_code_header() { ?>

  <script>
<!-- Snap Pixel Code -->
<script type='text/javascript'>
(function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
{a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
r.src=n;var u=t.getElementsByTagName(s)[0];
u.parentNode.insertBefore(r,u);})(window,document,
'https://sc-static.net/scevent.min.js');

snaptr('init', 'db75d7a2-a92d-4b6d-8f51-089fa6397b54', {
'user_email': '__INSERT_USER_EMAIL__'
});

snaptr('track', 'PAGE_VIEW');

</script>
<!-- End Snap Pixel Code -->
<?php }
add_action( 'wp_head', 'third_party_tracking_code_header' );

add_filter( 'woocommerce_registration_auth_new_customer', '__return_false' );



