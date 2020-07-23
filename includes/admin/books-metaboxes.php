<?php

function firstplugin_books_metabox(){
    add_meta_box( "sku", __( "Book Detail", "fp" ), "firstplugin_books_metabox_html", 'books', "normal", "low" );
}
add_action("add_meta_boxes", "firstplugin_books_metabox");

function firstplugin_books_metabox_html($post){

    wp_nonce_field( "firstplugin_books_metabox", "myplugin_books_metabox_nonce" );
    $sku = get_post_meta( $post->ID, "fp_sku", true );
    ?>
    <label for="fp_sku">SKU</label>
    <input type="text" name="fp_sku" id="fp_sku" value="<?php echo esc_attr( $sku ); ?>">
    <?php
}

function firstplugin_books_metabox_save($post_id){

    if(!isset($_POST['myplugin_books_metabox_nonce']))
        return;
    
    $nonce = $_POST['myplugin_books_metabox_nonce'];

    if( !wp_verify_nonce( $nonce, "firstplugin_books_metabox" ))
        return;

    $sku = sanitize_text_field( $_POST['fp_sku'] );
    update_post_meta( $post_id, "fp_sku", $sku );
}
add_action( "save_post", "firstplugin_books_metabox_save" );

?>