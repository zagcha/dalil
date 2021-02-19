<?php
include("inc/function.php");

$xx1 = mysql_num_rows(mysql_query("SELECT id FROM dlil_site where active=1"));
$xx2 = mysql_num_rows(mysql_query("SELECT id FROM dlil_site where active=0"));

if($htmlorphp==1){
$c = "show-site.html";
$cc = "show-section.html";
$ccc = "add-site.html";
}else{
$c = "index.php?X=1";
$cc = "index.php?X=2";
$ccc = "add.php";
}

$Template->TemplateType = 1;
$Template->title = get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );

$just_category = $Template->tpl_content(get_words(218), just_categories()); //just_categories(), categories_with_sites()

if($showrandsiteinindex == 1){
$random_site = $Template->tpl_content(get_words(277), random_site());
}else{
$random_site = '';
}	

echo $Template->Template_view(widgets(1),$random_site.widgets(0),'');
?>