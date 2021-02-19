<?php
session_start();
include("inc/function.php");

$Template->TemplateType = 1;

$action = $_GET['action'];
if(!isset($action)) $action = "add";

IF ($action=="add"){
$Template->title = get_words(239).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(239);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(239);

if($allow_add == 1){
$add_form = addsite();
}else{
$add_form = get_words(240);
}

$content = $Template->tpl_content(get_words(239), $add_form);
echo $Template->Template_view(widgets(1),$content,'');

}elseif($action=="insert"){
if($allow_add == 1){
	
$title = text(1,$_POST['title']);
$url = text(1,$_POST['url']);
$metadescription = text(1,$_POST['metadescription']);
$metakeywords = text(1,$_POST['metakeywords']);
$yourname = text(1,$_POST['yourname']);
$yourmail = text(1,$_POST['yourmail']);
$cat = intval($_POST['cat']);
$language_id = intval($_POST['language_id']);
$country_id = intval($_POST['country_id']);

if($metadescription == ""){ $xx1 = strip_tags($title); }else{ $xx1 = strip_tags($metadescription); }
if($metakeywords == ""){ $xx2 = strip_tags($title); }else{ $xx2 = strip_tags($metakeywords); }

$report = '';
$error = 0;

if($_POST['code'] != $_SESSION['captchacode'] OR $_SESSION["captchacode"]==''){
$report = '<li>'.get_words(243).'</li>';
$error = 1;
}

if($title == ""){
$report .= '<li>'.get_words(21).'</li>';
$error = 1;
}

if($url == ""){
$report .= '<li>'.get_words(22).'</li>';
$error = 1;
}

if(!preg_match('/^http:\/\//i', $url)){ 
$report .= '<li>'.get_words(252).'</li>';
$error = 1;
}

if($metadescription == ""){
$report .= '<li>'.get_words(244).'</li>';
$error = 1;
}

if($yourname == ""){
$report .= '<li>'.get_words(245).'</li>';
$error = 1;
}

if($yourmail == ""){
$report .= '<li>'.get_words(246).'</li>';
$error = 1;
}

if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-z.]$/i', $yourmail)){ 
$report .= '<li>'.get_words(250).'</li>';
$error = 1;
}

if($country_id == 0){
$report .= '<li>'.get_words(247).'</li>';
$error = 1;
}

if($language_id == 0){
$report .= '<li>'.get_words(248).'</li>';
$error = 1;
}

if($cat == 0){
$report .= '<li>'.get_words(249).'</li>';
$error = 1;
}



	$queryx = mysql_query("SELECT id,title,url,active FROM dlil_site where url='".$url."' LIMIT 100");
	$xx = mysql_num_rows($queryx);
	if($xx == 0){
		$sites = '';
	}else{
		$sites = '<ul>';
		while($p = mysql_fetch_array($queryx)){
			$p['title'] = text(3,$p['title']);
			$p['url'] = text(3,$p['url']);
			if($p['active']==1){
			$sites .= '<li><a href="'.url(7,$p['id'],0).'">'.$p['title'].' | '.$p['url'].'</a></li>';
			}else{
			$sites .= '<li>'.$p['title'].' | '.$p['url'].' ['.get_words(251).']</li>';
			}
		}
		$sites .= '</ul>';
		$report .= '<li>'.get_words(253).''.$sites.'</li>';
		$error = 1;
	}
	
if($error == 1){
$adding = '<h3>'.get_words(25).'</h3>';
$adding .= '<div class="alert alert-danger" role="alert"><ul>'.$report.'</ul></div>';
$adding .= '<p><a href="javascript:history.back(1)">'.get_words(26).'</a></p>';
}else{
$query = mysql_query ("INSERT INTO dlil_site (title,url,metadescription,metakeywords,active,country_id,yourname,yourmail,language_id,cat,date) VALUES 
('".strip_tags($title)."','".strip_tags($url)."','$xx1','$xx2','".get_option('active_site', 1 )."','$country_id','".strip_tags($yourname)."','".strip_tags($yourmail)."','$language_id','$cat','".time()."')") or die ("Error");
	if($query){
		$lastid = mysql_insert_id();
		$_SESSION['captchacode'] = '';
		$adding = '<div class="alert alert-success" role="alert">'.get_words(28).'<br /><br />'.get_words(254).'<br /><br />'.get_words(29).'<br /><a href="'.url(0,0,0).'">'.get_words(30).'</a></div>';
		$adding .= '<META HTTP-EQUIV="Refresh" CONTENT="3;URL='.url(0,0,0).'" />';
	}else{
		$adding = '<div class="alert alert-danger" role="alert">'.get_words(31).' <strong>dlil_site</strong><br /><a href="javascript:history.back(1)">'.get_words(26).'</a></div>';
	}
}

$Template->title = get_words(239).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(239);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(239);
$content = $Template->tpl_content(get_words(239), $adding);
echo $Template->Template_view(widgets(1),$content,'');

}else{
$Template->title = get_words(239).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(239);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(239);
$content = $Template->tpl_content(get_words(239), get_words(240));
echo $Template->Template_view(widgets(1),$content,'');
}



}elseif($action=="addcomments"){
$name = text(1,$_POST['name']);
$emails = text(1,$_POST['email']);
$text = text(1,$_POST['text']);
$articleid = intval($_POST['id']);


$report = '';
$error = 0;

if($_POST['code'] != $_SESSION['captchacode'] OR $_SESSION["captchacode"]==''){
$report = '<li>'.get_words(243).'</li>';
$error = 1;
}

if($name == ""){
$report .= '<li>'.get_words(255).'</li>';
$error = 1;
}

if($emails == ""){
$report .= '<li>'.get_words(246).'</li>';
$error = 1;
}

if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-z.]$/i', $emails)){ 
$report .= '<li>'.get_words(250).'</li>';
$error = 1;
}

if($text == ""){
$report .= '<li>'.get_words(256).'</li>';
$error = 1;
}


if($error == 1){
$adding = '<h3>'.get_words(25).'</h3>';
$adding .= '<div class="alert alert-danger" role="alert"><ul>'.$report.'</ul></div>';
$adding .= '<p><a href="javascript:history.back(1)">'.get_words(26).'</a></p>';
}else{
$query = mysql_query ("INSERT INTO dlil_comment (name,emails,text,active,articleid,date) VALUES ('".strip_tags($name)."','".strip_tags($emails)."','".text(3,$text)."','$activecomments','$articleid','".time()."')") or die ("Error");
	if($query){
		$_SESSION['captchacode'] = '';
		$adding = '<div class="alert alert-success" role="alert">'.get_words(28).'<br /><br />'.get_words(257).'<br /><br />'.get_words(29).'<br /><a href="'.url(1,$articleid,0).'">'.get_words(30).'</a></div>';
		$adding .= '<META HTTP-EQUIV="Refresh" CONTENT="3;URL='.url(1,$articleid,0).'" />';
	}else{
		$adding = '<div class="alert alert-danger" role="alert">'.get_words(31).' <strong>dlil_comment</strong><br /><a href="javascript:history.back(1)">'.get_words(26).'</a></div>';
	}
}

$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(68);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(68);
$content = $Template->tpl_content(get_words(68), $adding);
echo $Template->Template_view(widgets(1),$content,'');
}
?>