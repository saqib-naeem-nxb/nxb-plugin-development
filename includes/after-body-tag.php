<?php

/**
 * Add script imideately after <body>
 */
function firstplugin_after_opening_body_tag(){
    echo "After body opening tag from plugin";
}
add_action( "wp_body_open", "firstplugin_after_opening_body_tag" );



?>