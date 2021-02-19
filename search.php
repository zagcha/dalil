<?php
include("inc/function.php");
$Template->TemplateType = 1;

$search_text = strip_tags($_GET['search']);
$text = filter($search_text);

$report = '';
$error = 0;

if($text == ""){
$report .= '<li>'.get_words(258).'</li>';
$error = 1;
}

if(strlen($text) >= 100){
$report .= '<li>'.get_words(259).'</li>';
$error = 1;
}

if(strlen($text) < 2){
$report .= '<li>'.get_words(260).'</li>';
$error = 1;
}

if($error == 1){
$code = '<h3>'.get_words(25).'</h3>';
$code .= '<div class="alert alert-danger" role="alert"><ul>'.$report.'</ul></div>';
$code .= '<p><a href="javascript:history.back(1)">'.get_words(26).'</a></p>';
}else{
$code = result($text);
}

$Template->title = get_words(261).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(261);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(261);
$content = $Template->tpl_content(get_words(261), $code);
echo $Template->Template_view(widgets(1),$content,'');
?>