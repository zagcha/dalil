<?php
include("inc/function.php");

$id = intval($_GET["id"]);
$Template->TemplateType = 1;

$Sql = mysql_query("select * from dlil_site where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($Sql);
if($querycount == 0){
$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($Sql);
$Row['title'] = text(3,$Row['title']);
$Row['url'] = text(3,$Row['url']);
$Row['metadescription'] = text(3,$Row['metadescription']);
$Row['metakeywords'] = text(3,$Row['metakeywords']);
$Row['language_id'] = text(3,$Row['language_id']);
$Row['country_id'] = text(3,$Row['country_id']);
$Row['yourname'] = text(3,$Row['yourname']);
$Row['yourmail'] = text(3,$Row['yourmail']);
$added = date("j/n/Y",$Row['date']);

if($Row['metadescription'] == ""){ $description = $Row['title'].' - '.$Row['url']; }else{ $description = $Row['metadescription']; }
if($Row['metakeywords'] == ""){ $keywords = $Row['title'].', '.$Row['url']; }else{ $keywords = $Row['metakeywords']; }

$visite = $Row['vis']+1;
$sql2 = mysql_query("update dlil_site set vis=$visite where id='$id'") or die ("Query failed4");

//$img = "<a href='".$Row['url']."' title='".$Row['url']."'><img src='http://open.thumbshots.org/image.pxf?url=".$Row['url']."' border='0' vspace='0' hspace='0' /></a>";
$img = "<a href='".$Row['url']."' title='".$Row['url']."'><img src='http://images.websnapr.com/?url=".$Row['url']."' border='0' /></a>";

$p = "".$Row['title']."<div dir='ltr' align='right'><a target='_blank' class='aa' href='site.php?siteid=".$Row['id']."'>".$Row['url']."</a></div>".$f."";


$SqlCategory = mysql_query("select id,title from dlil_catgory where id='".$Row['cat']."' limit 1");
$Rowx = mysql_fetch_array($SqlCategory);
$Rowx['title'] = text(3,$Rowx['title']);

if($htmlorphp==1){
$ratecode = '<a target="_blank" href="'.$pathsite.'/rate-'.$id.'-'.$t.'.html"><img src="'.$pathsite.'/images/ratex.gif" alt="ÑÔÍäÇ Ýí '.$name_site.'" border=0></a>';
}else{
$ratecode = '<a target="_blank" href="'.$pathsite.'/ratecode.php?rate=1&siteid='.$id.'&sitename='.$t.'"><img src="'.$pathsite.'/images/ratex.gif" alt="ÑÔÍäÇ Ýí '.$name_site.'" border="0" /></a>';
}

/* Start Rating */
if($Row['rate'] == 0){
$rating = 0;
}else{
$rating = ($Row['rate']/$Row['count']);
}
$ratingstar = ratingstar($id, $rating, $Row['count'], $Row['rate']);
/* End Rating */


if(get_option('allow_related_sites', 1 ) == 1){
$related_limit = get_option('limit_related_sites', 1 );
$related = related_sites($related_limit, $Row['title']);
}else{
$related = '';
}
	
$Template->title = $Row['title'].' | '.get_option('site_name', 0 );
$Template->description = $description;
$Template->keywords = $keywords;
$Template->headercode .= '<script type="text/javascript" src="js/rating/jquery.js"></script>';
$Template->headercode .= '<script type="text/javascript" src="js/rating/script.js"></script>';

$info = '<div id="site_info">';
$info .= '<p><span>'.get_words(6).'</span> '.$Row['title'].'</p>';
$info .= '<p><span>'.get_words(7).'</span> <a target="_blank" title="'.$Row['title'].' - '.replace_domain($Row['url']).'" href="'.$Row['url'].'">'.$Row['url'].'</a></p>';
if($Row['metadescription'] != ""){
$info .= '<p><span>'.get_words(8).'</span> '.$Row['metadescription'].'</p>';
}
if($Row['metakeywords'] != ""){
$info .= '<p><span>'.get_words(9).'</span> '.$Row['metakeywords'].'</p>';
}
if($Row['yourname'] != ""){
$info .= '<p><span>'.get_words(10).'</span> '.$Row['yourname'].'</p>';
}
/*
if($Row['yourmail'] != ""){
$info .= '<p><span>'.get_words(11).'</span> '.$Row['yourmail'].'</p>';
}
*/
if($Row['country_id'] != 0){
$queryxo = mysql_query("SELECT id,title FROM dlil_country where id='".$Row['country_id']."' limit 1");
$po = mysql_fetch_array($queryxo);
$info .= '<p><span>'.get_words(12).'</span> <a href="'.url(21,$po['id'],0).'">'.text(3,$po['title']).'</a></p>';
}
if($Row['language_id'] != 0){
$queryxl = mysql_query("SELECT id,title FROM dlil_language where id='".$Row['language_id']."' limit 1");
$pl = mysql_fetch_array($queryxl);
$info .= '<p><span>'.get_words(13).'</span> <a href="'.url(22,$pl['id'],0).'">'.text(3,$pl['title']).'</a></p>';
}
$info .= '<p><span>'.get_words(14).'</span> <a href="'.url(9,$Rowx['id'],0).'">'.$Rowx['title'].'</a></p>';
$info .= '<p><span>'.get_words(54).'</span> '.$Row['vis'].'</p>';
$info .= '<p><span>'.get_words(52).'</span> '.$Row['rate'].'</p>';
$info .= '<p><span>'.get_words(53).'</span> '.$Row['count'].'</p>';
$info .= '<p><span>'.get_words(225).'</span> '.$added.'</p>';

$info .= $ratingstar;
$info .= '<p><span>'.get_words(226).'</span> <a target="_blank" href="http://www.google.com/search?q=site:'.replace_domain($Row['url']).'">'.get_words(227).'</a> - <a target="_blank" href="http://www.google.com/search?q=link:'.replace_domain($Row['url']).'">'.get_words(228).'</a> - <a target="_blank" href="http://www.google.com/search?q=cach:'.replace_domain($Row['url']).'">'.get_words(229).'</a></p>';
if($allow_view_alexa == 1){
$info .= '<p><a target="_blank" href="http://www.alexa.com/siteinfo/'.replace_domain($Row['url']).'"><script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/t/a?url='.replace_domain($Row['url']).'"></script></a></p>';
}
$info .= $related;
$info .= '</div>';

$content = $Template->tpl_content($Row['title'], $info);
echo $Template->Template_view(widgets(1),$content,'');
}
?>