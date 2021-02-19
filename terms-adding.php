<?php
include("inc/function.php");

$Template->TemplateType = 1;

$Template->title = get_words(241).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(241);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(241);
$content = $Template->tpl_content(get_words(241), get_option('terms_adding', 2 ));
echo $Template->Template_view(widgets(1),$content,'');
?>