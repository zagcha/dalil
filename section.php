<?php
include("inc/function.php");

$id = intval($_GET["id"]);
$Template->TemplateType = 1;

$Sql = mysql_query("select * from dlil_catgory where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($Sql);
if($querycount == 0){
$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($Sql);
$Row['title'] = text(3,$Row['title']);

if($Row['metadescription'] == ""){ $description = $Row['title']; }else{ $description = text(3,$Row['metadescription']); }
if($Row['metakeywords'] == ""){ $keywords = str_replace(' ',', ',$Row['title']); }else{ $keywords = text(3,$Row['metakeywords']); }

$Template->title = $Row['title'];
$Template->description = $description;
$Template->keywords = $keywords;

$query_subcount = mysql_num_rows(mysql_query("SELECT id,title,sub FROM dlil_catgory where active='1' AND sub='".$id."'"));
if($query_subcount == 0){
$sub = '';
}else{
$sub = $Template->tpl_content(get_words(344).$Row['title'], sub_categories_with_sites($id, 0));
}

$query_sitecount = mysql_num_rows(mysql_query("SELECT id FROM dlil_site where active='1' AND cat='".$id."'"));
if($query_sitecount == 0 && $query_subcount != 0){
$content = '';
}else{
$content = $Template->tpl_content($Row['title'], sections($id));
}

echo $Template->Template_view(widgets(1),$sub.$content,'');
}
?>