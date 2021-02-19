<?php
session_start();
include("inc/function.php");

$Template->TemplateType = 1;

$action = $_GET['x'];
if(!isset($action)) $action = "home";

if($action=="home"){

$Template->title = get_words(285).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(285);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(285);
$content = $Template->tpl_content(get_words(285), poll($poll_id,1));
echo $Template->Template_view(widgets(1),$content,'');

}elseif($action=="show"){
$id = intval($_GET["id"]);

$sql = mysql_query("select * from dlil_poll where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($sql);
if($querycount == 0){
$Template->title = get_words(285).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($sql);
$Row['qus'] = text(3,$Row['qus']);
$Row['ans1'] = text(3,$Row['ans1']);
$Row['ans2'] = text(3,$Row['ans2']);
$Row['ans3'] = text(3,$Row['ans3']);

$Template->title = $Row['qus'];
$Template->description = $description.' - '.$Row['qus'];
$Template->keywords = $keywords.', '.$Row['qus'];
$content = $Template->tpl_content(get_words(285), poll($id,1));
echo $Template->Template_view(widgets(1),$content,'');
}

}elseif($action=="vote"){

$id = intval($_POST['poll_id']);
$answers = addslashes($_POST['answer']);

$sql = mysql_query("select * from dlil_poll where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($sql);
if($querycount == 0){
$Template->title = get_words(285).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($sql);
$Row['qus'] = text(3,$Row['qus']);
$Row['ans1'] = text(3,$Row['ans1']);
$Row['ans2'] = text(3,$Row['ans2']);
$Row['ans3'] = text(3,$Row['ans3']);

if ($answers == "vote1"){
$vote_value = $Row['vote1']+1;
$vote = 'vote1';
}elseif ($answers == "vote2"){
$vote_value = $Row['vote2']+1;
$vote = 'vote2';
}elseif ($answers == "vote3"){
$vote_value = $Row['vote3']+1;
$vote = 'vote3';
}

	if(isset($_SESSION["poll_id"]) && $_SESSION["poll_id"] == $Row['id'] && isset($_SESSION["timeout"]) && $_SESSION['timeout'] > time()){
	$msg = get_words(288);
	}else{
	$update = mysql_query("UPDATE dlil_poll SET $vote=$vote_value where id='$id' limit 1");

		if($update){
			$id = 0;
			$answers = 0;
			$_SESSION["poll_id"] = $Row['id'];
			$_SESSION["user_id"] = session_id();
			$_SESSION['timeout'] = time()+86400;
			$msg .= get_words(286);
			$msg .= '<meta http-equiv="Refresh" content="1;URL=poll.php" />';
		}else{
			$msg = get_words(287);
		}
	}

}

$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 ).' - '.get_words(68);
$Template->keywords = get_option('site_keywords', 0 ).', '.get_words(68);
$content = $Template->tpl_content(get_words(68), $msg);
echo $Template->Template_view(widgets(1),$content,'');
}
?>