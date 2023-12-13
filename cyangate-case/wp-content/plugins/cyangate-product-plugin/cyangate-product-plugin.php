<?php
/*
Plugin Name: CyanGate Product Plugin
Description: Custom plugin for product management.
Version: 1.0
Author: Bugra Kara
*/

// Product Submit and Create Post

function product_form_submission() {
    if (isset($_POST['submit_product'])) {
        
        $product_name = isset($_POST['product_name']) ? sanitize_text_field($_POST['product_name']) : '';
        $product_description = isset($_POST['product_description']) ? sanitize_textarea_field($_POST['product_description']) : '';

        // Create a new product post
        $product_post = array(
            'post_title'    => $product_name,
            'post_content'  => $product_description,
            'post_type'     => 'product',
            'post_status'   => 'publish',
        );

        $product_post_id = wp_insert_post($product_post);


        $product_image_url = ''; // Initialize the variable

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $upload_dir = wp_upload_dir(); // Get the WordPress uploads directory
            $file_name = sanitize_file_name($_FILES['product_image']['name']);
            $file_path = $upload_dir['path'] . '/' . $file_name;

            move_uploaded_file($_FILES['product_image']['tmp_name'], $file_path);

            $product_image_url = $upload_dir['url'] . '/' . $file_name;

                 // Add custom field for product image URL
                add_post_meta($product_post_id, '_product_image', $product_image_url);
        }

   

        // Automatically create a new page for the product details
        $product_details_page = array(
            'post_title'    => $product_name,
            'post_content'  => '[product_details id="' . $product_post_id . '"]', // Shortcode to display product details
            'post_type'     => 'page',
            'post_status'   => 'publish',
        );

        $product_details_page_id = wp_insert_post($product_details_page);

    }
}

// Submission init
add_action('init', 'product_form_submission');

// Product Details

function add_product_details($atts, $content) {
    $atts = shortcode_atts(array(
        'id' => 0,
    ), $atts);

    $product_id = absint($atts['id']);

    // Retrieve product details
    $product_name = get_the_title($product_id);
    $product_description = get_post_field('post_content', $product_id);
    $product_image_url = get_post_meta($product_id, '_product_image', true);

    // Display product details
    ?>
     <?php $content .= '
        <style>.has-text-align-center{display: none !important;}.product_name,.product_name.h3{text-align:center !important; text-transform: capitalize; color: #005670;}
        .list-group-item{position: relative;display: block;padding: .75rem 1.25rem;margin-bottom: -1px;background-color: #fff;border: 1px solid rgba(0,0,0,.125);text-transform: capitalize;}.wp-block-spacer{display:none !important;}
        </style>
        <div class="product_name">
        <h3 style="font-family: inherit !important;">' . esc_html($product_name) . '</h2>
        <img style="max-width: 100%; height: auto; border-radius: 10px;" src="' . esc_url($product_image_url) . '" alt="' . esc_attr($product_name) . '">
        <p class="list-group-itemss">' . esc_html($product_description) . '</p>
        </div>
        <div>
        <h3>Other Products</h3>
        <ul style="padding:0;">';
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'exclude' => $product_id, // Exclude the current product
            );

            $other_products = get_posts($args);

            foreach ($other_products as $other_product) {
                $content .= '<li class="list-group-item"><a href="' . esc_url(get_site_url().'/'.$other_product->post_name) . '">' . esc_html($other_product->post_title) . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <?php
    return $content;
}

// Register the shortcode
add_shortcode('product_details', 'add_product_details');





function display_product_list() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    );

    $products = get_posts($args);

    if ($products) {
        echo '<style>
        .admin-product-list{
        position: relative;
        display: block;
        padding: .75rem 1.25rem;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.125);
        text-transform: capitalize;
        }
        .admin-prod{text-decoration: none;
        font-size: 16px;
        color: #00205b;}
        </style>';
        echo '<ul>';
        foreach ($products as $product) {
            echo '<li class="admin-product-list">PRODUCT NAME:&nbsp; <a class="admin-prod" href="' . esc_url(get_site_url().'/'.$product->post_name) . '">' . esc_html($product->post_title) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No products found.';
    }
}


// Admin Pages

function add_product_admin_page() {
    add_menu_page(
        'Product List',       // Page title
        'Product List',       // Menu title
        'manage_options',     // Capability
        'product-list',       // Menu slug
        'display_product_list' // Product list
    );
}

// Hook to add admin page
add_action('admin_menu', 'add_product_admin_page');


function view_add_product_form($content){
 ?>
 <?php $content.= '
<style>.form-col{display: flex;flex-direction: column;margin-bottom: 20px;}.form-input-bg{padding: 6px;border: 1px solid #ccccd4;border-radius: 5px;}.form-btn{color: #fff;background-color: #005670;border-color: #005670;padding: 10px;border-radius: 10px;font-family: inherit;cursor: pointer;}.form-label{margin-bottom:10px}.form-submit{margin-top:40px}
</style>
 <form method="post" enctype="multipart/form-data">
        <!-- Your form fields go here -->
        <div class="form-col">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-input-bg" name="product_name" required>
        </div>

        <div class="form-col">
        <label for="product_description" class="form-label">Product Description</label>
        <textarea name="product_description" class="form-input-bg" required></textarea>
        </div>

        <div class="form-col">
        <label for="product_image" class="form-label">Product Image</label>
        <input type="file" name="product_image" accept="image/*" required><br>
        </div>

        <div class="form-submit">
        <input type="submit" class="form-btn" name="submit_product" value="Add Product">
        </div>
    </form>'?>
    <?php
    return $content;
}
add_shortcode('add_product_form', 'view_add_product_form');


?>
