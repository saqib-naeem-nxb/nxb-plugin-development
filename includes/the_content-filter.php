<?php
/**
 * the_content Filter to add ad or static content at specific point
 * in this case, add text after every two paragraphs
 */
function mnp($content){
	if(!is_single( )){
		return $content;
	}

	$ad = "<div class='background-blue;padding:12px;'>AD SHOWS HERE</div>";
	return mnp_func($ad, 2, $content);
}
add_filter( "the_content", "mnp" );

function mnp_func($ad, $p, $content){
	$break = '</p>';
	$paragraphs = explode($break, $content);

	foreach($paragraphs as $i=>$paragraph){
		if(trim($paragraph)){
			$final .= $break;
		}
		if($p == $i+1){
			$paragraphs[$i] .= $ad;
		}
	}
	return implode("", $paragraphs);
}
?>