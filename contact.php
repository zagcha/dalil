<?php
session_start();
include("inc/function.php");
require 'inc/phpmailer/PHPMailerAutoload.php';
$Template->TemplateType = 1;

$action = $_GET['action'];
if(!isset($action)) $action = "index";

if($action=="index"){
$Template->title = get_words(289).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(289);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(289);
$content = $Template->tpl_content(get_words(289), contact(url(16,0,0),1));
echo $Template->Template_view(widgets(1),$content,'');

}elseif($action=="send"){
$subject = text(1,strip_tags($_POST['subject']));
$from = text(1,strip_tags($_POST['email']));
$alltext = nl2br($_POST['text']);
$text = text(1,strip_tags($alltext,'<br><br/><br />'));
$id = intval($_POST['id']);

$report = '';
$error = 0;

if($_POST['code'] != $_SESSION['captchacode'] OR $_SESSION["captchacode"]==''){
$report = '<li>'.get_words(243).'</li>';
$error = 1;
}

if($subject == ""){
$report .= '<li>'.get_words(294).'</li>';
$error = 1;
}

if($from == ""){
$report .= '<li>'.get_words(246).'</li>';
$error = 1;
}

if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-z.]$/i', $from)){ 
$report .= '<li>'.get_words(250).'</li>';
$error = 1;
}

if($text == ""){
$report .= '<li>'.get_words(295).'</li>';
$error = 1;
}

if( function_exists( 'mail' )){ 
$mail_available = get_words(299); 
}else{ 
$mail_available = get_words(300); 
}
	
if($error == 1){
$sending = '<h3>'.get_words(25).'</h3>';
$sending .= '<div class="alert alert-danger" role="alert"><ul>'.$report.'</ul></div>';
$sending .= '<p><a href="javascript:history.back(1)">'.get_words(26).'</a></p>';
}else{
	
/* Start sent email */
$emailmsg = str_replace(array('{site_name}', '{site_url}', '{text}'), array($name_site, $name_url, $text), get_words(298));
$success_msg = '';
/* End sent email */

$message = smtpmailer($emailsite, $name_site, $from, $name_site, $subject, $emailmsg, 0);

	if($message){
		$_SESSION['captchacode'] = '';
		$sending = '<div class="alert alert-success" role="alert">'.get_words(297).'<br /><br />'.get_words(29).'<br /><a href="'.url(0,0,0).'">'.get_words(30).'</a></div>';
		$sending .= '<META HTTP-EQUIV="Refresh" CONTENT="3;URL='.url(0,0,0).'" />';
	}else{
		$sending = '<div class="alert alert-danger" role="alert">'.get_words(296).' <br /><a href="javascript:history.back(1)">'.get_words(26).'</a></div>';
		$sending .= $mail_available;
	}
}

$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(68);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(68);
$content = $Template->tpl_content(get_words(68), $sending);
echo $Template->Template_view(widgets(1),$content,'');
}
?>