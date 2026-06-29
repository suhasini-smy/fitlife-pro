<?php
//require_once get_template_directory() . '/inc/class-fitlife-walker.php';

add_action('after_setup_theme', function () {
    require_once get_template_directory() . '/inc/class-fitlife-walker.php';
});


function fitlife_theme_setup() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script'
        )
    );

    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'fitlife'),
        'footer-menu'  => __('Footer Menu', 'fitlife')
    ));
}

add_action('after_setup_theme', 'fitlife_theme_setup');



function fitlife_enqueue_scripts() {
    wp_enqueue_style(
        'fitlife-style',
        get_stylesheet_uri(),
        array(),
        filemtime( get_stylesheet_directory() . '/style.css' )
    );
}
add_action('wp_enqueue_scripts', 'fitlife_enqueue_scripts');


add_action( 'init', 'fitlife_register_product_fields' );


function fitlife_register_product_fields() {

    if ( class_exists( 'WooCommerce' ) ) {
        add_action(
            'woocommerce_product_options_general_product_data',
            'fitlife_custom_product_fields'
        );
    }
}

function fitlife_custom_product_fields() {

    
    woocommerce_wp_text_input(array(
        'id' => '_calorie_count',
        'label' => 'Calorie Count',
        'placeholder' => '100 kcal',
        'desc_tip' => true
    ));

    woocommerce_wp_text_input(array(
        'id' => '_protein_serving',
        'label' => 'Protein Per Serving',
        'placeholder' => '25g',
        'desc_tip' => true
    ));

    woocommerce_wp_textarea_input(array(
        'id' => '_allergen_info',
        'label' => 'Allergen Information'
    ));
}

add_action('woocommerce_process_product_meta', 'fitlife_save_product_fields');

function fitlife_save_product_fields($post_id){

    if(isset($_POST['_calorie_count'])){
        update_post_meta(
            $post_id,
            '_calorie_count',
            sanitize_text_field($_POST['_calorie_count'])
        );
    }

    if(isset($_POST['_protein_serving'])){
        update_post_meta(
            $post_id,
            '_protein_serving',
            sanitize_text_field($_POST['_protein_serving'])
        );
    }

    if(isset($_POST['_allergen_info'])){
        update_post_meta(
            $post_id,
            '_allergen_info',
            sanitize_textarea_field($_POST['_allergen_info'])
        );
    }
}

add_action('admin_notices', function () {
});



//     global $product;

//     $calories = get_post_meta($product->get_id(), '_calorie_count', true);
//     $protein  = get_post_meta($product->get_id(), '_protein_serving', true);
//     $allergen = get_post_meta($product->get_id(), '_allergen_info', true);

//     if ( $calories || $protein || $allergen ) {

//         echo '<div class="fitlife-product-info">';

//         if ( $calories ) {
//             echo '<p><strong>Calorie Count:</strong> ' . esc_html($calories) . '</p>';
//         }

//         if ( $protein ) {
//             echo '<p><strong>Protein Per Serving:</strong> ' . esc_html($protein) . '</p>';
//         }

//         if ( $allergen ) {
//             echo '<p><strong>Allergen Information:</strong> ' . esc_html($allergen) . '</p>';
//         }

//         echo '</div>';
//     }
// }


add_action( 'woocommerce_single_product_summary', 'fitlife_display_product_fields', 25 );

function fitlife_display_product_fields() {

    global $product;

    if ( ! $product ) {
        return;
    }

    $calories = get_post_meta( $product->get_id(), '_calorie_count', true );
    $protein  = get_post_meta( $product->get_id(), '_protein_serving', true );
    $allergen = get_post_meta( $product->get_id(), '_allergen_info', true );

    if ( ! $calories && ! $protein && ! $allergen ) {
        return;
    }

    echo '<div class="fitlife-product-info">';

    if ( $calories ) {
        echo '<p><strong>Calorie Count:</strong> ' . esc_html( $calories ) . '</p>';
    }

    if ( $protein ) {
        echo '<p><strong>Protein Per Serving:</strong> ' . esc_html( $protein ) . '</p>';
    }

    if ( $allergen ) {
        echo '<p><strong>Allergen Information:</strong> ' . esc_html( $allergen ) . '</p>';
    }

    echo '</div>';
}

function fitlife_enqueue_assets() {

	wp_enqueue_style(
		'fitlife-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'fitlife-main',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'fitlife-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

}
add_action( 'wp_enqueue_scripts', 'fitlife_enqueue_assets' );


function fitlife_register_sidebar() {

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'fitlife-pro' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main Sidebar', 'fitlife-pro' ),
		'before_widget' => '<section class="widget">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'fitlife_register_sidebar' );


add_filter( 'product_type_selector', function( $types ) {
    $types['fitness_bundle'] = 'Fitness Bundle';
    return $types;
});

add_filter( 'woocommerce_product_class', function( $classname, $product_type ) {

    if ( $product_type === 'fitness_bundle' ) {
        $classname = 'WC_Product_Fitness_Bundle';
    }

    return $classname;

}, 10, 2 );




add_action( 'woocommerce_after_order_notes', 'fitlife_add_fitness_goal_field' );

function fitlife_add_fitness_goal_field( $checkout ) {

    echo '<div id="fitlife_fitness_goal"><h3>Fitness Goal</h3>';

    woocommerce_form_field( 'fitness_goal', array(
        'type'    => 'select',
        'class'   => array('form-row-wide'),
        'label'   => 'Select your goal',
        'options' => array(
            ''              => 'Select Goal',
            'weight_loss'   => 'Weight Loss',
            'muscle_gain'   => 'Muscle Gain',
            'endurance'     => 'Endurance',
            'flexibility'   => 'Flexibility'
        )
    ), $checkout->get_value( 'fitness_goal' ) );

    echo '</div>';
}



add_action( 'woocommerce_checkout_create_order', 'fitlife_save_fitness_goal' );

function fitlife_save_fitness_goal( $order ) {

    if ( ! empty( $_POST['fitness_goal'] ) ) {
        $order->update_meta_data(
            'fitness_goal',
            sanitize_text_field( $_POST['fitness_goal'] )
        );
    }
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'fitlife_show_fitness_goal_admin' );

function fitlife_show_fitness_goal_admin( $order ) {

    $goal = $order->get_meta( 'fitness_goal' );

    if ( $goal ) {
        echo '<p><strong>Fitness Goal:</strong> ' . esc_html( $goal ) . '</p>';
    }
}



add_action( 'woocommerce_review_order_before_payment', 'fitlife_checkout_upsell' );

function fitlife_checkout_upsell() {

    if ( ! WC()->cart ) return;

    $show_protein = false;
    $show_yoga    = false;

    foreach ( WC()->cart->get_cart() as $cart_item ) {

        $product_id = $cart_item['product_id'];

        $title = get_the_title( $product_id );

        if ( stripos( $title, 'protein' ) !== false ) {
            $show_protein = true;
        }

        if ( stripos( $title, 'yoga' ) !== false ) {
            $show_yoga = true;
        }
    }

    if ( ! $show_protein && ! $show_yoga ) return;

    echo '<div class="fitlife-upsell"><h3>Recommended for you</h3>';

    if ( $show_protein ) {
        echo '<p><strong>Shaker Bottle</strong> recommended with Protein products</p>';
    }

    if ( $show_yoga ) {
        echo '<p><strong>Resistance Bands</strong> recommended with Yoga products</p>';
    }

    echo '</div>';
}


add_action( 'woocommerce_email_after_order_table', 'fitlife_email_fitness_goal', 10, 4 );

function fitlife_email_fitness_goal( $order, $sent_to_admin, $plain_text, $email ) {

    if ( $sent_to_admin ) return;

    $goal = $order->get_meta( 'fitness_goal' );

    if ( $goal ) {

        echo '<p><strong>Fitness Goal:</strong> ' . esc_html( $goal ) . '</p>';

        echo '<p>💪 Stay consistent! Your fitness journey is built one workout at a time.</p>';
    }
}


add_action( 'woocommerce_email_footer', 'fitlife_email_footer_message' );

function fitlife_email_footer_message() {

    echo '<p style="text-align:center; font-size:14px;">
    🔥 FitLife Pro Tip: Discipline beats motivation every time.
    </p>';
}


function fitlife_get_cached_trainers() {

    $cache = get_transient( 'fitlife_trainers_cache' );

    if ( false !== $cache ) {
        return $cache;
    }

    $data = get_posts( array(
        'post_type'      => 'fitlife_trainer',
        'posts_per_page' => -1
    ) );

    set_transient( 'fitlife_trainers_cache', $data, 12 * HOUR_IN_SECONDS );

    return $data;
}


add_action( 'pre_get_posts', 'fitlife_optimize_queries' );

function fitlife_optimize_queries( $query ) {

    if ( is_admin() || ! $query->is_main_query() ) return;

    if ( is_post_type_archive( 'fitlife_trainer' ) || is_post_type_archive( 'fitlife_program' ) ) {

        $query->set( 'posts_per_page', 12 );
        $query->set( 'no_found_rows', true );
    }
}


function fitlife_login_attempt_limit( $user, $username, $password ) {

    $attempts = get_transient( 'fitlife_login_attempts_' . $username );

    if ( $attempts && $attempts >= 5 ) {
        return new WP_Error(
            'too_many_attempts',
            'Too many login attempts. Please try again later.'
        );
    }

    return $user;
}
add_filter( 'authenticate', 'fitlife_login_attempt_limit', 30, 3 );

function fitlife_track_login_fail( $username ) {

    $attempts = get_transient( 'fitlife_login_attempts_' . $username );
    $attempts = $attempts ? $attempts + 1 : 1;

    set_transient( 'fitlife_login_attempts_' . $username, $attempts, 15 * MINUTE_IN_SECONDS );
}
add_action( 'wp_login_failed', 'fitlife_track_login_fail' );


// add_action( 'woocommerce_before_checkout_form', 'fitlife_checkout_header', 5 );

// function fitlife_checkout_header() {

//     echo '<div class="fitlife-checkout-header">';
//     echo '<h2>FitLife Secure Checkout</h2>';
//     echo '<p>Complete your order and start your fitness journey 💪</p>';
//     echo '</div>';
// }



add_theme_support('woocommerce');



