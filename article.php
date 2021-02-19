<?php
session_start();
include("inc/bbcode.php");
include("inc/function.php");

$id = intval($_GET["id"]);
$Template->TemplateType = 1;

$Sql = mysql_query("select * from dlil_article where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($Sql);
if($querycount == 0){
$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($Sql);
$Row['title'] = text(3,$Row['title']);
$Row['text'] = text(2,$Row['text']);
$added = date("j/n/Y",$Row['date']);
$visite = $Row['vis']+1;

if($Row['metadescription'] == ""){ $description = $Row['title']; }else{ $description = text(3,$Row['metadescription']); }
if($Row['metakeywords'] == ""){ $keywords = str_replace(' ',', ',$Row['title']); }else{ $keywords = text(3,$Row['metakeywords']); }

$sql2 = mysql_query("update dlil_article set vis=$visite where id='$id' limit 1") or die ("Query failed4");

$info = '<div id="post_info">';
$info .= $Row['text'];
$info .= '<div class="info"><span>'.get_words(102).'</span> '.$added .' - <span>'.get_words(54).'</span> '.intval($Row['vis']).'</div>';
$info .= '</div>';
if($showcomments==1){
$info .= comments();
}
if($allowcomments==1){
$info .= addcomment(url(13,0,0), $id);
}

$Template->title = $Row['title'];
$Template->description = $description;
$Template->keywords = $keywords;
$content = $Template->tpl_content($Row['title'], $info);
echo $Template->Template_view(widgets(1),$content,'');
}
?>