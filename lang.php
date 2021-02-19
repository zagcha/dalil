<?php
include("inc/function.php");

$id = intval($_GET["id"]);
$Template->TemplateType = 1;

$Sql = mysql_query("select * from dlil_language where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($Sql);
if($querycount == 0){
$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($Sql);
$Row['title'] = text(3,$Row['title']);

$Template->title = $Row['title'];
$Template->description = get_option('site_description', 0 ).' - '.$Row['title'].'';
$Template->keywords = get_option('site_keywords', 0 ).', '.$Row['title'].'';

$content = $Template->tpl_content(''.get_words(318).': <strong>'.$Row['title'].'</strong>', sites_by_language($id));
echo $Template->Template_view(widgets(1),$content,'');
}
?>