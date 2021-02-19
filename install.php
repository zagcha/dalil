<?php
include("inc/language.php");
include("inc/config.php");

function text($type,$text){
if($type==1){
if (!get_magic_quotes_gpc()) {
$text = addslashes($text);
}
$text = trim($text);
return $text;
}elseif($type==2){
$text = stripslashes($text);
$text = trim($text);
return $text;
}elseif($type==3){
$text = stripslashes($text);
//$text = strip_tags($text);
$text = htmlspecialchars($text);
return $text;
}
}

class current_page{
var $protocol;
var $site;
var $thisfile;
var $real_directories;
var $num_of_real_directories;
var $virtual_directories = array();
var $num_of_virtual_directories = array();
var $baseurl;
var $thisurl;

function current_page(){
$this->protocol = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$this->site = $this->protocol . '://' . $_SERVER['HTTP_HOST'];
$this->thisfile = basename($_SERVER['SCRIPT_FILENAME']);
$this->real_directories = $this->cleanUp(explode("/", str_replace($this->thisfile, "", $_SERVER['PHP_SELF'])));
$this->num_of_real_directories = count($this->real_directories);
$this->virtual_directories = array_diff($this->cleanUp(explode("/", str_replace($this->thisfile, "", $_SERVER['REQUEST_URI']))),$this->real_directories);
$this->num_of_virtual_directories = count($this->virtual_directories);
$this->baseurl = $this->site . "/" . implode("/", $this->real_directories) . "/";
$this->thisurl = $this->baseurl . implode("/", $this->virtual_directories) . "";
}

function cleanUp($array){
$cleaned_array = array();
foreach($array as $key => $value){
$qpos = strpos($value, "?");
if($qpos !== false){ break; }
if($key != "" && $value != ""){ $cleaned_array[] = $value; }
}
return $cleaned_array;
}
}
$current_page = new current_page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Nwahy.com">
<meta name="generator" content="Nwahy Directory V3" />
<title><?php echo get_words(348); ?></title>
<link href="templates/nwahy/css/bootstrap.min.css" rel="stylesheet">
<link href="templates/nwahy/css/style.css" rel="stylesheet">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="templates/nwahy/css/rtl.css" />
<script type="text/javascript" src="js/rating/jquery.js"></script><script type="text/javascript" src="js/rating/script.js"></script>
</head>
<body>

<div class="container" style="min-height:730px;">

	<div id="page-wrapper">
		<div id="logo-bar-wrapper">
			<div id="logo-bar">
				<div id="logo-wrapper">
					<div id="logo"><a href="index.php"><img id="site-logo" alt="Nwahy" src="images/install-logo.png" /></a></div>
				</div> 
			<br class="clearer" />
			</div>
		</div>
	</div>

<div style="clear:both;"></div>

<div class="well" style="margin-top:40px;">

<?php
$step = $_GET["step"];
if(!isset($step)) $step = 1;
if(isset($step)){
switch ($step){
case "1":
echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">'.get_words(349).'</h3></div>
<div class="panel-body">
'.get_words(350).'
</div>
</div>';
break;

case "2":
echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">'.get_words(351).'</h3></div>
<div class="panel-body">
'.get_words(352).'
</div>
</div>';
break;

case "3":
	
$insert_report = '';

$sql_1 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(99) DEFAULT NULL,
  `adminoruser` int(11) DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `site` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `signature` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `groubtype` int(11) NOT NULL DEFAULT '0',
  `date` varchar(90) NOT NULL,
  `lost_password` int(11) NOT NULL DEFAULT '0',
  `lost_password_code` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_1){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_admin</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_admin</strong></div>';
}
	
$sql_2 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `upordown` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  `orderads` int(11) DEFAULT '0',
  `vis` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_2){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_ads</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_ads</strong></div>';
}	
	
$sql_3 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `metadescription` varchar(255) NOT NULL DEFAULT '',
  `metakeywords` varchar(255) NOT NULL DEFAULT '',
  `text` text,
  `active` int(11) DEFAULT '0',
  `vis` int(11) DEFAULT '0',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_3){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_article</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_article</strong></div>';
}	

$sql_4 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `rightorleft` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  `orderblock` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_4){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_blocks</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_blocks</strong></div>';
}
	
$sql_5 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_catgory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `metadescription` text,
  `metakeywords` text,
  `sub` int(11) DEFAULT '0',
  `ordercat` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_5){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_catgory</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_catgory</strong></div>';
}	

$sql_6 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `emails` varchar(255) NOT NULL DEFAULT '',
  `text` text,
  `active` int(11) DEFAULT '0',
  `articleid` int(11) DEFAULT '0',
  `date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_6){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_comment</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_comment</strong></div>';
}


$sql_7 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_counter` (
  `counterdata` bigint(20) NOT NULL DEFAULT '0'
);
");	
if($sql_7){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_counter</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_counter</strong></div>';
}


$sql_8 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_8){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_country</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_country</strong></div>';
}

$sql_9 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipx` varchar(99) NOT NULL DEFAULT '',
  `cat` int(11) DEFAULT '0',
  `siteid` int(11) DEFAULT '0',
  `date` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_9){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_ips</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_ips</strong></div>';
}

$sql_10 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `orders` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_10){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_language</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_language</strong></div>';
}

$sql_11 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_online` (
  `xip` varchar(99) NOT NULL,
  `xtime` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
");	
if($sql_11){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_online</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_online</strong></div>';
}
	
$sql_12 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qus` varchar(255) NOT NULL DEFAULT '',
  `ans1` varchar(255) NOT NULL DEFAULT '',
  `ans2` varchar(255) NOT NULL DEFAULT '',
  `ans3` varchar(255) NOT NULL DEFAULT '',
  `vote1` int(11) DEFAULT '0',
  `vote2` int(11) DEFAULT '0',
  `vote3` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  `date` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_12){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_poll</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_poll</strong></div>';
}


$sql_13 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_rand1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_13){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_rand1</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_rand1</strong></div>';
}


$sql_14 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_rand2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_14){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_rand2</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_rand2</strong></div>';
}

$sql_15 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_rand3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text,
  `active` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_15){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_rand3</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_rand3</strong></div>';
}

$sql_16 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(250) DEFAULT NULL,
  `meta_value` text,
  `site_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_16){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_setting</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_setting</strong></div>';
}

$sql_17 = mysql_query("
CREATE TABLE IF NOT EXISTS `dlil_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `metadescription` text,
  `metakeywords` text,
  `country` varchar(255) DEFAULT NULL,
  `yourname` varchar(255) DEFAULT NULL,
  `yourmail` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `cat` int(11) DEFAULT '0',
  `vis` int(11) DEFAULT '0',
  `rate` int(11) DEFAULT '0',
  `count` int(11) DEFAULT '0',
  `lang` int(11) DEFAULT '0',
  `date` varchar(50) DEFAULT NULL,
  `language_id` int(11) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
");	
if($sql_17){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(353).' <strong>dlil_site</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(354).' <strong>dlil_site</strong></div>';
}

echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">'.get_words(355).'</h3></div>
<div class="panel-body">
'.$insert_report.'
<p>&nbsp;</p>
'.get_words(356).'
</div>
</div>';
break;

case "4":

$sql_18 = mysql_query("
INSERT INTO `dlil_admin` (`id`, `username`, `password`, `adminoruser`, `name`, `email`, `site`, `image`, `signature`, `active`, `groubtype`, `date`, `lost_password`, `lost_password_code`) VALUES (1, 'nwahy', 'bb127db0cb20bd37fe7b1671cb04c3a7', 1, 'احمد العنزي', 'nwahycom@gmail.com', 'http://www.nwahy.com', '', '', 1, 0, '', 1, 'a99Go1DUsmrfcQf');
");	
if($sql_18){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_admin</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_admin</strong></div>';
}

$sql_19 = mysql_query("
INSERT INTO `dlil_blocks` (`id`, `title`, `text`, `rightorleft`, `active`, `orderblock`) VALUES
(1, 'أحدث المواقع', '{new_sites}', 1, 1, 1),
(4, 'أقسام الموقع', '{just_categories_one_line}', 0, 1, 0),
(5, 'محرك البحث', '{search}', 1, 1, 3),
(6, 'الاستفتاء', '{poll}', 1, 1, 10);
");	
if($sql_19){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_blocks</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_blocks</strong></div>';
}

$sql_20 = mysql_query("
INSERT INTO `dlil_catgory` (`id`, `title`, `metadescription`, `metakeywords`, `sub`, `ordercat`, `active`) VALUES
(1, 'مواقع إسلامية', 'مواقع اسلاميه,اسلاميات,دينيه,فتاوى,قرآن كريم,حديث شريف,أحاديث,تلاوات,محاضرات,دعوه,عقيده,تفسير,سيره', 'مواقع اسلاميه,اسلاميات,دينيه,فتاوى,قرآن كريم,حديث شريف,أحاديث,تلاوات,محاضرات,دعوه,عقيده,تفسير,سيره', 0, 1, 1),
(2, 'القرآن الكريم', 'قران كريم,تلاوات,تفسير,محاضرات,عقيده', 'قران كريم,تلاوات,تفسير,محاضرات,عقيده', 1, 1, 1),
(3, 'الحديث الشريف', 'الحديث الشريف,تخريج الأحاديث,الألباني', 'الحديث الشريف,تخريج الأحاديث,الألباني', 1, 2, 1),
(4, 'العلماء والدعاة', 'العلماء والدعاة', 'العلماء والدعاة', 1, 3, 1),
(5, 'الفرق والمذاهب والأديان', '', '', 1, 4, 1),
(6, 'المجلات والتسجيلات الإسلاميه', 'المجلات الإسلامية,تسجيلات,التسجيلات الاسلاميه,دور النشر الاسلاميه,كتب إسلاميه', 'المجلات الإسلامية,تسجيلات,التسجيلات الاسلاميه,دور النشر الاسلاميه,كتب إسلاميه', 1, 5, 1),
(7, 'الكتب الإسلامية', 'كتب إسلاميه', 'كتب إسلاميه', 1, 6, 1),
(8, 'الفتاوى', '', '', 1, 7, 1),
(9, 'الصوتيات الإسلامية', 'الصوتيات الإسلامية', 'الصوتيات الإسلامية', 1, 8, 1),
(10, 'مواقع إخباريه', 'اخبار,وكالات أنباء,مقالات,الجزيره,العربيه,بي بي سي', 'اخبار,وكالات أنباء,مقالات,الجزيره,العربيه,بي بي سي', 0, 2, 1),
(11, 'مواقع الأخبار العربيه', '', '', 10, 1, 1),
(12, 'وكالات الأنباء', '', '', 10, 2, 1),
(13, 'الصحف السعوديه', '', '', 10, 3, 1),
(14, 'الصحف الكويتيه', '', '', 10, 4, 1),
(15, 'الصحف الإماراتيه والقطريه والعمانيه والبحرينيه', '', '', 10, 5, 1),
(16, 'الصحف المصريه', '', '', 10, 6, 1),
(17, 'الصحف العربيه', '', '', 10, 7, 1),
(18, 'صحف أخرى', '', '', 10, 8, 1),
(19, 'كمبيوتر وبرامج', 'كمبيوتر,سوفت وير,ويندوز,برامج مجانيه,برامج جديده,برمجيات,مكافحة فيروسات', 'مكافحة التجسس,برامج الحمايه,برامج التصفح,برامج انترنت,مسنجر,العاب,برامج تصميم', 0, 3, 1),
(20, 'مواقع البرامج', 'برامج مجانيه,مضاد التجسس,كشف الفيروسات,مكافحة التروجان,العاب,دونلود', 'تسريع التصفح,تسريع التحميل,انترنت وشبكات,مسنجر,ياهو,تحرير الصوت,الفيديو,الاكواد', 19, 1, 1),
(21, 'مواقع كمبيوتر عامة', '', '', 19, 2, 1),
(22, 'اخبار ومجلات الكمبيوتر', '', '', 19, 3, 1),
(23, 'البرامج وانظمة التشغيل', '', '', 19, 4, 1),
(24, 'الرسم والتصميم - الجرافيكس', 'فوتوشوب,فلاش,اتوكاد,صور للتصميم,برامج تحرير الصور', 'فوتوشوب,فلاش,اتوكاد,صور للتصميم,برامج تحرير الصور', 19, 5, 1),
(25, 'لغات البرمجه وقواعد البيانات', 'php,html,cgi,asp,jsp,css,vb,vb .net,java,sql,mysql,xml,rss,linux,unix,zend,txt', 'php,html,cgi,asp,jsp,css,vb,vb .net,java,sql,mysql,xml,rss,linux,unix,zend,txt', 19, 6, 1),
(26, 'مشغلات الأجهزة - التعريفات', 'تعريف الصوت,تعريف المودم,تعريف الشاشه,تعريفات,كرت الصوت,كرت الشاشه,مودم', 'تعريف الصوت,تعريف المودم,تعريف الشاشه,تعريفات,كرت الصوت,كرت الشاشه,مودم', 19, 7, 1),
(27, 'إنترنت وشبكات', 'الامن والحمايه,تصميم,تسكين,استضافه,نطاقات,دومين,حجز,خطه', 'الامن والحمايه,تصميم,تسكين,استضافه,نطاقات,دومين,حجز,خطه', 0, 4, 1),
(28, 'الأمن والحمايه', '', '', 27, 1, 1),
(29, 'حجز النطاقات - الدومين', '', '', 27, 2, 1),
(30, 'تصميم المواقع', '', '', 27, 3, 1),
(31, 'استضافة المواقع - تسكين', '', '', 27, 4, 1),
(32, 'مواقع الخدمات', '', '', 27, 5, 1),
(33, 'مزودي خدمة الإنترنت', '', '', 27, 6, 1),
(34, 'مواقع اخرى', '', '', 27, 7, 1),
(35, 'الأسرة والترفيه', 'مواقع نسائيه,اسريه,مواقع اطفال,مواقع العاب,مواقع طبخ وحلويات,بطاقات التهنئه,اناشيد اسلاميه', 'مواقع نسائيه,اسريه,مواقع اطفال,مواقع العاب,مواقع طبخ وحلويات,بطاقات التهنئه,اناشيد اسلاميه', 0, 5, 1),
(36, 'مواقع نسائية', '', '', 35, 1, 1),
(37, 'مواقع الأطفال', '', '', 35, 2, 1),
(38, 'أناشيد إسلاميه', '', '', 35, 3, 1),
(39, 'مواقع الطبخ والحلويات', '', '', 35, 4, 1),
(40, 'مواقع بطاقات التهنئة', '', '', 35, 5, 1),
(41, 'مواقع الترفيه', '', '', 35, 6, 1),
(42, 'مواقع الألعاب', '', '', 35, 7, 1),
(43, 'مواقع طبيه', 'الطب البديل Alternative Medicine,طب الأسنان Dentistry,الجلدية Dermatology', 'طبي إسلامي Islamic Medicicne,عيون Ophthalmology,جراحة قلب وصدر Cardiothoracic Surgery', 0, 6, 1),
(44, 'البطب الإسلامي والطب البديل', 'طبي إسلامي Islamic Medicicne,الطب البديل Alternative Medicine', 'طبي إسلامي Islamic Medicicne,الطب البديل Alternative Medicine', 43, 1, 1),
(45, 'طب الأسنان', 'طب الأسنان Dentistry', 'طب الأسنان Dentistry', 43, 2, 1),
(46, 'نساء وولادة', 'نساء وولادة Obstetrics and Gynecology', 'نساء وولادة Obstetrics and Gynecology', 43, 3, 1),
(47, 'أطفال', 'أطفال Pediatrics', 'أطفال Pediatrics', 43, 4, 1),
(48, 'أمراض نفسية', 'أمراض نفسية psychiatry', 'أمراض نفسية psychiatry', 43, 5, 1),
(49, 'أدلة مواقع طبية', 'أدلة مواقع طبية webguides medical', 'أدلة مواقع طبية webguides medical', 43, 6, 1),
(50, 'مواقع طبيه أخرى', '', '', 43, 7, 1),
(51, 'منتديات', 'منتديات اسلاميه,منتديات برمجه,منتديات تطوير مواقع', 'منتديات اقتصاديه,منتديات سياسيه,منتديات كمبيوتر,منتديات الالعاب', 0, 7, 1),
(52, 'منتديات إسلاميه', '', '', 51, 1, 1),
(53, 'منتديات اقتصاديه', '', '', 51, 2, 1),
(54, 'منتديات سياسيه', '', '', 51, 3, 1),
(55, 'منتديات أدبيه', '', '', 51, 4, 1),
(56, 'منتديات طبيه', '', '', 51, 5, 1),
(57, 'منتديات رياضيه', '', '', 51, 7, 1),
(58, 'منتديات كمبيوتر وانترنت', '', '', 51, 8, 1),
(59, 'منتديات تطوير مواقع', '', '', 51, 9, 1),
(60, 'منتديات أسريه وترفيهيه', '', '', 51, 10, 1),
(61, 'منتديات البرمجه', '', '', 51, 11, 1),
(62, 'أخرى ومنوعه', 'بريد مجاني,ايميل مجاني,مواقع تعليميه,كتب ومكتبات,متاحف وفنون,خدمات مجانيه', 'بريد مجاني,ايميل مجاني,مواقع تعليميه,كتب ومكتبات,متاحف وفنون,خدمات مجانيه', 0, 8, 1),
(63, 'مواقع تعليميه', 'جامعات,كليات,جامعة,كلية,مدارس,تعليم,معهد,معاهد,تدريبي,تطبيقي,التربيه,الإدارات', 'جامعات,كليات,جامعة,كلية,مدارس,تعليم,معهد,معاهد,تدريبي,تطبيقي,التربيه,الإدارات', 62, 1, 1),
(64, 'كتب ومكتبات', '', '', 62, 2, 1),
(65, 'مواقع بحث وأدله', 'محرك بحث,دليل مواقع,أدلة مواقع,بيج رانك,محركات بحث', 'محرك بحث,دليل مواقع,أدلة مواقع,بيج رانك,محركات بحث', 62, 3, 1),
(66, 'مواقع اقتصادية', 'مال وأعمال,بنوك,مصارف,غرف تجاريه,بورصه,أسهم,أوراق ماليه,توظيف,بيع,شراء,عرض,طلب,عقارات', 'مال وأعمال,بنوك,مصارف,غرف تجاريه,بورصه,أسهم,أوراق ماليه,توظيف,بيع,شراء,عرض,طلب,عقارات', 62, 4, 1),
(67, 'مواقع رياضيه', 'نادي الهلال,نادي النصر,نادي الاتحاد,نادي الاهلي,الزعين,العالمي,القادسيه,العربيه,الريان,ام صلال,الغرافه,نادي قطر,الوحده,الجمهور,كوره,حكم', 'ريال مدريد,برشلونه,مانشستر يونايتد,تشلسي,ليفربول,يوفنتوس,ميلان,انترميلان,يوفي,روما,بايرن ميونخ', 62, 5, 1),
(68, 'متاحف وفنون', 'متحف,متاحف,معارض الصور,خطوط,زخارف,فن تشكيلي', 'متحف,متاحف,معارض الصور,خطوط,زخارف,فن تشكيلي', 62, 6, 1),
(69, 'دول ومدن', '', '', 62, 7, 1),
(70, 'البريد المجاني', '', '', 62, 8, 1),
(71, 'قبائل وأسر وعوائل', 'عنزه,مطير,ظفير,شمري,عازمي,رشيدي,وايلي,عجمي,مري,تميمي', 'عنزي,شمري,ظفيري,مطيري,رفيعي,هاجري,دوسري,سبيعي', 62, 9, 1),
(72, 'مواقع أخرى منوعه', '', '', 62, 10, 1),
(73, 'منتديات عامه ومنوعه', '', '', 51, 11, 1),
(74, 'سكربتات', 'سكربتات مجانية مميزة', 'سكربت, سكربتات', 27, 10, 1),
(75, 'إضافات ووردبرس', 'إضافات ووردبرس WordPress Plugin', 'plugin', 27, 100, 1);
");	
if($sql_20){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_catgory</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_catgory</strong></div>';
}

$sql_21 = mysql_query("
INSERT INTO `dlil_counter` (`counterdata`) VALUES (1);
");	
if($sql_21){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_counter</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_counter</strong></div>';
}

$sql_22 = mysql_query("
INSERT INTO `dlil_country` (`id`, `title`, `orders`, `active`) VALUES
(1, 'Afghanistan', 1, 0),
(2, 'Albania', 2, 0),
(3, 'الجزائر', 3, 1),
(4, 'American Samoa', 4, 0),
(5, 'Andorra', 5, 0),
(6, 'Angola', 6, 0),
(7, 'Anguilla', 7, 0),
(8, 'Antigua and Barbuda', 8, 0),
(9, 'Argentina', 9, 0),
(10, 'Armenia', 10, 0),
(11, 'Aruba', 11, 0),
(12, 'Australia', 12, 0),
(13, 'Austria', 13, 0),
(14, 'Azerbaijan', 14, 0),
(15, 'Bahamas', 15, 0),
(16, 'البحرين', 16, 1),
(17, 'Bangladesh', 17, 0),
(18, 'Barbados', 18, 0),
(19, 'Belarus', 19, 0),
(20, 'Belgium', 20, 0),
(21, 'Belize', 21, 0),
(22, 'Benin', 23, 0),
(23, 'Bermuda', 24, 0),
(24, 'Bhutan', 25, 0),
(25, 'Bolivia', 26, 0),
(26, 'Bosnia and Herzegovina', 27, 0),
(27, 'Botswana', 28, 0),
(28, 'Brazil', 29, 0),
(29, 'Brunei Darussalam', 30, 0),
(30, 'Bulgaria', 31, 0),
(31, 'Burkina Faso', 32, 0),
(32, 'Burundi', 33, 0),
(33, 'Cambodia', 34, 0),
(34, 'Cameroon', 35, 0),
(35, 'Canada', 36, 0),
(36, 'Cape Verde', 37, 0),
(37, 'Cayman Islands', 38, 0),
(38, 'Central African Republic', 39, 0),
(39, 'Chad', 40, 0),
(40, 'Chile', 40, 0),
(41, 'China', 41, 0),
(42, 'Christmas Island', 42, 0),
(43, 'Cocos (Keeling) Islands', 43, 0),
(44, 'Colombia', 44, 0),
(45, 'Comoros', 45, 0),
(46, 'Democratic Republic of the Congo (Kinshasa)', 46, 0),
(47, 'Congo, Republic of (Brazzaville)', 47, 0),
(48, 'Cook Islands', 48, 0),
(49, 'Costa Rica', 49, 0),
(50, 'Ivory Coast', 50, 0),
(51, 'Croatia', 51, 0),
(52, 'Cuba', 52, 0),
(53, 'Cyprus', 53, 0),
(54, 'Czech Republic', 54, 0),
(55, 'Denmark', 55, 0),
(56, 'Dominica', 56, 0),
(57, 'Dominican Republic', 57, 0),
(58, 'East Timor (Timor-Leste)', 58, 0),
(59, 'Ecuador', 59, 0),
(60, 'مصر', 60, 1),
(61, 'El Salvador', 61, 0),
(62, 'Equatorial Guinea', 62, 0),
(63, 'Eritrea', 63, 0),
(64, 'Estonia', 64, 0),
(65, 'Ethiopia', 65, 0),
(66, 'Falkland Islands', 66, 0),
(67, 'Faroe Islands', 67, 0),
(68, 'Fiji', 68, 0),
(69, 'Finland', 69, 0),
(70, 'France', 70, 0),
(71, 'French Guiana', 71, 0),
(72, 'French Polynesia', 72, 0),
(73, 'French Southern Territories', 73, 0),
(74, 'Gabon', 74, 0),
(75, 'Gambia', 75, 0),
(76, 'Georgia', 76, 0),
(77, 'Germany', 77, 0),
(78, 'Ghana', 78, 0),
(79, 'Gibraltar', 79, 0),
(80, 'Great Britain', 80, 0),
(81, 'Greece', 81, 0),
(82, 'Greenland', 82, 0),
(83, 'Grenada', 83, 0),
(84, 'Guadeloupe', 84, 0),
(85, 'Guam', 85, 0),
(86, 'Guatemala', 86, 0),
(87, 'Guinea', 87, 0),
(88, 'Guinea-Bissau', 88, 0),
(89, 'Guyana', 89, 0),
(90, 'Haiti', 90, 0),
(91, 'Holy See', 91, 0),
(92, 'Honduras', 92, 0),
(93, 'Hong Kong', 93, 0),
(94, 'Hungary', 94, 0),
(95, 'Iceland', 95, 0),
(96, 'India', 96, 0),
(97, 'Indonesia', 97, 0),
(98, 'إيران', 98, 1),
(99, 'العراق', 99, 1),
(100, 'Ireland', 100, 0),
(101, 'Israel', 101, 0),
(102, 'Italy', 102, 0),
(103, 'Jamaica', 103, 0),
(104, 'Japan', 104, 0),
(105, 'الأردن', 105, 1),
(106, 'Kazakhstan', 106, 0),
(107, 'Kenya', 107, 0),
(108, 'Kiribati', 108, 0),
(109, 'Korea, Democratic People''s Rep. (North Korea)', 109, 0),
(110, 'Korea, Republic of (South Korea)', 110, 0),
(111, 'Kosovo', 111, 0),
(112, 'الكويت', 112, 1),
(113, 'Kyrgyzstan', 113, 0),
(114, 'Lao, People''s Democratic Republic', 114, 0),
(115, 'Latvia', 115, 0),
(116, 'لبنان', 116, 1),
(117, 'Lesotho', 117, 0),
(118, 'Liberia', 118, 0),
(119, 'ليبيا', 119, 1),
(120, 'Liechtenstein', 120, 0),
(121, 'Lithuania', 121, 0),
(122, 'Luxembourg', 122, 0),
(123, 'Macau', 123, 0),
(124, 'Macedonia', 124, 0),
(125, 'Madagascar', 125, 0),
(126, 'Malawi', 126, 0),
(127, 'Malaysia', 127, 0),
(128, 'Maldives', 128, 0),
(129, 'Mali', 129, 0),
(130, 'Malta', 130, 0),
(131, 'Marshall Islands', 131, 0),
(132, 'Martinique', 132, 0),
(133, 'Mauritania', 133, 0),
(134, 'Mauritius', 134, 0),
(135, 'Mayotte', 135, 0),
(136, 'Micronesia', 136, 0),
(137, 'Moldova', 137, 0),
(138, 'Monaco', 138, 0),
(139, 'Mongolia', 139, 0),
(140, 'Montenegro', 140, 0),
(141, 'Montserrat', 141, 0),
(142, 'المغرب', 142, 1),
(143, 'Mozambique', 143, 0),
(144, 'Myanmar, Burma', 144, 0),
(145, 'Namibia', 145, 0),
(146, 'Nauru', 146, 0),
(147, 'Nepal', 147, 0),
(148, 'Netherlands', 148, 0),
(149, 'Netherlands Antilles', 149, 0),
(150, 'New Caledonia', 150, 0),
(151, 'New Zealand', 151, 0),
(152, 'Nicaragua', 152, 0),
(153, 'Niger', 153, 0),
(154, 'Nigeria', 154, 0),
(155, 'Niue', 155, 0),
(156, 'Northern Mariana Islands', 155, 0),
(157, 'Norway', 156, 0),
(158, 'عمان', 157, 1),
(159, 'Pakistan', 158, 0),
(160, 'Palau', 160, 0),
(161, 'Palestinian territories', 161, 0),
(162, 'Panama', 162, 0),
(163, 'Papua New Guinea', 163, 0),
(164, 'Paraguay', 164, 0),
(165, 'Peru', 165, 0),
(166, 'Philippines', 166, 0),
(167, 'Pitcairn Island', 167, 0),
(168, 'Poland', 168, 0),
(169, 'Portugal', 169, 0),
(170, 'Puerto Rico', 170, 0),
(171, 'قطر', 171, 1),
(172, 'Reunion Island', 172, 0),
(173, 'Romania', 173, 0),
(174, 'Russian Federation', 174, 0),
(175, 'Rwanda', 175, 0),
(176, 'Saint Kitts and Nevis', 176, 0),
(177, 'Saint Lucia', 177, 0),
(178, 'Saint Vincent and the Grenadines', 178, 0),
(179, 'Samoa', 179, 0),
(180, 'San Marino', 180, 0),
(181, 'السعودية', 181, 1),
(182, 'Senegal', 182, 0),
(183, 'Serbia', 183, 0),
(184, 'Seychelles', 184, 0),
(185, 'Sierra Leone', 185, 0),
(186, 'Singapore', 186, 0),
(187, 'Slovakia (Slovak Republic)', 185, 0),
(188, 'Slovenia', 186, 0),
(189, 'Solomon Islands', 187, 0),
(190, 'الصومال', 188, 1),
(191, 'South Africa', 189, 0),
(192, 'جنوب السودان', 190, 1),
(193, 'Spain', 191, 0),
(194, 'Sri Lanka', 192, 0),
(195, 'السودان', 193, 1),
(196, 'Suriname', 196, 0),
(197, 'Swaziland', 197, 0),
(198, 'Sweden', 198, 0),
(199, 'Switzerland', 199, 0),
(200, 'سوريا', 200, 1),
(201, 'Taiwan', 201, 0),
(202, 'Tajikistan', 202, 0),
(203, 'Tanzania', 203, 0),
(204, 'Thailand', 204, 0),
(205, 'Tibet', 205, 0),
(206, 'Timor-Leste', 206, 0),
(207, 'Togo', 207, 0),
(208, 'Tokelau', 208, 0),
(209, 'Tonga', 209, 0),
(210, 'Trinidad and Tobago', 210, 0),
(211, 'تونس', 211, 1),
(212, 'Turkey', 212, 0),
(213, 'Turkmenistan', 213, 0),
(214, 'Tuvalu', 214, 0),
(215, 'Uganda', 215, 0),
(216, 'Ukraine', 216, 0),
(217, 'الإمارات', 217, 1),
(218, 'United Kingdom', 218, 1),
(219, 'United States', 219, 1),
(220, 'Uruguay', 220, 0),
(221, 'Uzbekistan', 221, 0),
(222, 'Vanuatu', 222, 0),
(223, 'Venezuela', 223, 0),
(224, 'Vietnam', 224, 0),
(225, 'Virgin Islands (British)', 225, 0),
(226, 'Virgin Islands (U.S.)', 226, 0),
(227, 'Wallis and Futuna Islands', 227, 0),
(228, 'Western Sahara', 228, 0),
(229, 'اليمن', 229, 1),
(230, 'Zambia', 230, 0),
(231, 'Zimbabwe', 231, 0);
");	
if($sql_22){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_country</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_country</strong></div>';
}

$sql_23 = mysql_query("
INSERT INTO `dlil_language` (`id`, `title`, `orders`, `active`) VALUES
(1, 'عربي', 1, 1),
(2, 'إنجليزي', 2, 1),
(3, 'فرنسي', 3, 1);
");	
if($sql_23){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_language</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_language</strong></div>';
}

$sql_24 = mysql_query("
INSERT INTO `dlil_poll` (`id`, `qus`, `ans1`, `ans2`, `ans3`, `vote1`, `vote2`, `vote3`, `active`, `date`) VALUES (1, 'ماهو موقعك المفضل؟', 'جوجل', 'ياهو', 'أبل', 1, 9, 4, 1, '1421701919');
");	
if($sql_24){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_poll</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_poll</strong></div>';
}

$sql_25 = mysql_query("
INSERT INTO `dlil_rand3` (`id`, `text`, `active`) VALUES
(1, '\'قُتل رحمه الله\' خير من \'فر أخزاه الله\'', 1),
(2, 'أخاك أخاك إن مَنْ لا أخا له كَساعٍ إلى الهيجا بغير سلاح', 1),
(3, 'أخوك من صدقك النصيحة', 1),
(4, 'إذا غامَرْتَ في شرف مروم فلا تقنع بما دون النجوم', 1),
(5, 'إذا لم يكن إلا الأَسِنَّةُ مركبا فلا رأي للمضطر إلا ركوبها', 1),
(6, 'استقبال الموت خير من استدباره', 1),
(7, 'أكرم نفسك عن كل دنيء', 1),
(8, 'الإفراط في التواضع يجلب المذلة', 1),
(9, 'الجود بالنفس أقصى غاية الجود', 1),
(10, 'السيف أهول ما يُرى مسلولا', 1),
(11, 'العز في نواصي الخيل', 1),
(12, 'القَصَّابُ لا تهوله كثرة الغنم', 1),
(13, 'إن البعوضة تُدْمي مُقْلةَ الأسد', 1),
(14, 'إن الجبان حتْفُه من فوقه', 1),
(15, 'إن القذى يؤذي العيون قليله ولربما جرح البعوض الفيلا', 1),
(16, 'أنا لها ولكل عظيمة', 1),
(17, 'بنفسي فَخَرْتُ لا بجدودي', 1),
(18, 'تجوع الحرة ولا تأكل بثدييها', 1),
(19, 'تعدو الذئاب على من لا كلاب له وتتقي صولة المستنفر الحامي', 1),
(20, 'ذل من لا سيف له', 1),
(21, 'عش عزيزا أو مت وأنت كريم', 1),
(22, 'عزيزا أو مت وأنت كريم بين طعن القنا وخفق البنود', 1),
(23, 'فلان كالكعبة تُزارُ ولا تُسْتَزارُ', 1),
(24, 'قد يتوقى السيف وهو مغمد', 1),
(25, 'قد يجبن الشجاع بلا سلاح', 1),
(26, 'لا يضير الشاة سلخها بعد ذبحها', 1),
(27, 'من تعرض للمصاعب ثبت للمصائب', 1),
(28, 'من لم يركب الأهوال لم ينل المطالب', 1),
(29, 'موت في عز خير من حياة في ذل', 1),
(30, 'وإذا ما خلا الجبان بأرض طلب الطعن وحده والنزالا', 1),
(31, 'وكل شجاعة في المرء تغني ولا مثل الشجاعة في الحكيم', 1),
(32, 'ولم أر في عيوب الناس شيئا كنقص القادرين على التمام', 1),
(33, 'ولو لم يكن في كله غير روحه لجاد بها فليتق الله سائله', 1),
(34, 'وما أنا إلا من غُزَيَّةَ إن غوت غويت وإن ترشد غُزَيَّةُ أرشد', 1),
(35, 'وما تنفع الخيل الكرام ولا القنا إذا لم يكن فوق الكرام كرام', 1),
(36, 'العمل أبلغ خطابٍ', 1),
(37, 'الأفعال أبلغ من الأقوال', 1),
(38, 'فَإِذَا عَزَمتَ فَتَوَكَّل عَلَى اللَّهِ إِنَّ اللَّهَ يُحِبُّ المُتَوَكِّلِينَ (ق\r\nرآن كريم آل عمران 159)', 1),
(39, 'ازرع كل يوم تأكل', 1),
(40, 'اطلب تظفر', 1),
(41, 'اعملوا فكل ميسر لما خلق له (حديث)', 1),
(42, 'الإنسان بالتفكير والله بالتدبير', 1),
(43, 'الحركة بركة', 1),
(44, 'السماء لا تمطر ذهباً ولا فضة', 1),
(45, 'السيف يقطع بحده المرء يسعى بجده', 1),
(46, 'العيش في الدنيا جهاد دائم', 1),
(47, 'الفُرَصُ تَمُرُّ مَرَّ السحاب', 1),
(48, 'إن جهد المقل غير قليل', 1),
(49, 'إن مفاتيح الأمور العزائم', 1),
(50, 'أنجز حر ما وعد', 1),
(51, 'خير الأعمال ما كان ديمة', 1),
(52, 'زرع آباؤنا فأكلنا ونزرع ليأكل أبناؤنا', 1),
(53, 'زرعوا فأكلنا ونزرع فيأكلون', 1),
(54, 'زيادة القول تحكي النقص في العمل ومنطق المرء قد يهديه للزلل', 1),
(55, 'شعيرنا ولا قمح غيرنا', 1),
(56, 'شَمِّرْ وائتزر والبس جلد النمر', 1),
(57, 'علي أن أسعى وليس علي إدراك النجاح', 1),
(58, 'عند الرهان تعرف السوابق', 1),
(59, 'كما تزرع تحصد', 1),
(60, 'لا تؤجل عمل اليوم إلى الغد', 1),
(61, 'لا تعنف طالبا لرزقه', 1),
(62, 'لا تَلُمْ كفي إذا السيف نبا صح مِنِّي العزم والدهر أبى', 1),
(63, 'لا بد دون الشهد من إبر النحل', 1),
(64, 'ليست يدي مُخَضَّبةً بالحناء', 1),
(65, 'ما الناس إلا الماء يحييه جريه', 1),
(66, 'من جال نال', 1),
(67, 'من جد وجد ومن زرع حصد', 1),
(68, 'من سار على الدرب وصل', 1),
(69, 'من سعى جنى ومن نام رأى الأحلام', 1),
(70, 'من طلب العلا سهر الليالي', 1),
(71, 'من طلب شيئا وجده', 1),
(72, 'من عمل دائما أكل نائما', 1),
(73, 'من لا يخطئ لا يفعل شيئا', 1),
(74, 'من لم يحترف لم يَعْتَلِفْ', 1),
(75, 'وإذا وصلت بعاقل أملا كانت نتيجة قوله فعلا', 1),
(76, 'والمرء ليس بصادق في قوله حتى يؤيد قوله بفعاله', 1),
(77, 'وما استعصى على قوم منال إذا الإقدام كان لهم ركابا', 1),
(78, 'وما نيل المطالب بالتمني ولكن تؤخذ الدنيا غلابا', 1),
(79, 'ومن خطب الحسناء لم يغلها الْمَهْرُ', 1),
(80, 'يا طالب الرزق إن الرزق في طلبك', 1),
(81, 'يركب الصعب من لا ذلول له', 1),
(82, 'يساعد الله الذين يساعدون أنفسهم', 1),
(83, 'يسقط الطير حيث يُنْثَرُ الحب وتغشى منازل الكرماء', 1),
(84, 'لكل حي أجل', 1),
(85, 'لكل داء دواء', 1),
(86, 'بعض الحلم ذل', 1),
(87, 'يد واحدة لا تحمل بطيختين', 1),
(88, 'خذو الحكمة من أفواه البسطاء', 1),
(89, 'ما كلُّ ما يُعلم يُقال', 1),
(90, 'اتقوا النار ولو بشق تمرة (حديث)', 1),
(91, 'اجلس حيث يُؤْخَذُ بيدك وَتُبَرُّ ولا تجلس حيث يؤخذ برجلك وتُجَرُّ', 1),
(92, 'أَحْسِنْ إلي الناس تستعبد قلوبهم', 1),
(93, 'إذا التقى المسلمان بسيفيهما فالقاتل والمقتول في النار (حديث)', 1),
(94, 'إذا تم العقل نقص الكلام', 1),
(95, 'إذا زل العالِمُ زل بزلته عالَمٌ', 1),
(96, 'إذا ضربت فأوجع فإن الملامة واحدة', 1),
(97, 'إذا كنت ذا رأي فكن ذا عزيمة', 1),
(98, 'إذا نُصِرَ الرأي بطل الهوى', 1),
(99, 'ازهد في الدنيا يحبك الله وازهد فيما عند الناس يحبك الناس (حديث)', 1),
(100, 'أرسل حكيما ولا توصه', 1),
(101, 'اسْتَفْتِ قلبك وإن أفتاك الناس وأفتوك. (حديث)', 1),
(102, 'اشتدي يا أزمة تنفرجي', 1),
(103, 'أشد الجهاد مجاهدة الغيظ', 1),
(104, 'أشد الفاقة عدم العقل', 1),
(105, 'أصحاب العقول في نعيم', 1),
(106, 'إصلاح الموجود خير من انتظار المفقود', 1),
(107, 'أضيق الأمر أدناه من الفرج', 1),
(108, 'اطلبوا العلم من المهد إلى اللحد', 1),
(109, 'اطلبوا العلم ولو في الصين', 1),
(110, 'أعط الخبز لخبازه ولو أكل نصفه', 1),
(111, 'أعط القوس باريها', 1),
(112, 'أَعقَلُ الناس أَعْذَرُهُمْ للناس', 1),
(113, 'آفة الرأي الهوى', 1),
(114, 'آفة العِلْم النسيان', 1),
(115, 'أفْضَلُ الجهاد كلمة عدل عند سلطان جائر', 1),
(116, 'الإشارات تُغْني اللبيب عن العبارات', 1),
(117, 'الأمر يعرض دونه الأمر', 1),
(118, 'البِشْر يعقد القلوب على المحبة', 1),
(119, 'البصر بالزَّبُونِ تجارة', 1),
(120, 'التدبير نصف المعيشة', 1),
(121, 'الجهل شر الأصحاب', 1),
(122, 'الحاجة تفتق الحيلة', 1),
(123, 'الحق أبْلَجُ والباطل لجلج', 1),
(124, 'الحكمة ضالة المؤمن (حديث)', 1),
(125, 'الحِلْم أجَلُّ من العقل', 1),
(126, 'الخيل أعرف بفارسها', 1),
(127, 'الدم لا يصير ماء', 1),
(128, 'الدنيا سجن المؤمن وجنة الكافر', 1),
(129, 'الشبعان يفُتُّ للجائع فتا بطيئا', 1),
(130, 'الشر في الناس لا يفنى وإن قُبِرُوا', 1),
(131, 'الشر قليله كثير', 1),
(132, 'الشر للشر خُلِقَ', 1),
(133, 'الشكوى لغير الله مذلة', 1),
(134, 'الشيب قبل العيب', 1),
(135, 'الصِّيتُ ولا الغنى', 1),
(136, 'الضرورات تبيح المحظورات', 1),
(137, 'الطيور على أشكالها تقع', 1),
(138, 'الظَّفَرُ بالضعيف هزيمة', 1),
(139, 'العاقل لا يستقبل النعمة ببطر ولا يودعها بجزع', 1),
(140, 'العاقل من عقل لسانه والجاهل من جهل قدره', 1),
(141, 'العقل صدق الحكم على الأمور', 1),
(142, 'العقل أشرف الأحباب', 1),
(143, 'العقل صفاء النفس والجهل كدرها', 1),
(144, 'العقل غريزة تربيها التجارب', 1),
(145, 'العقل يُهَابُ ما لا يُهابُ السيف', 1),
(146, 'العِلْمُ أشهر الأحساب', 1),
(147, 'العلم في الصِّغَرِ كالنقش على الحجر', 1),
(148, 'العلم كالسراج من مر به اقتبس منه', 1),
(149, 'العلم يُؤْتَى ولا يَأْتِي', 1),
(150, 'العلماء ورثة الأنبياء', 1),
(151, 'الغنى غنى القلب لا غنى المال', 1),
(152, 'المذبوحة لا تتألم من السلخ', 1),
(153, 'المرء حيث يضع نفسه', 1),
(154, 'المرء يجمع والدنيا مفرقة', 1),
(155, 'المصائب لا تأتي فرادى', 1),
(156, 'الموت حوض مورود', 1),
(157, 'الموت على رقاب العباد', 1),
(158, 'الناس أعداء ما جهلوا', 1),
(159, 'الناس عبيد الإحسان', 1),
(160, 'الناس لولا الدين لأكل بعضهم بعضا', 1),
(161, 'الناس معادن (حديث)', 1),
(162, 'الندم على السكوت خير من الندم على القول', 1),
(163, 'النفس مولعة بحب العاجل', 1),
(164, 'النهر يشرب منه الكلب والأسد', 1),
(165, 'الوقت كالسيف إن لم تقطعه قطعك', 1),
(166, 'الوقت من ذهب', 1),
(167, 'إلى التراب يصير الناس كلهم', 1),
(168, 'اليد العليا خير من اليد السفلى (حديث)', 1);
");	
if($sql_25){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_rand3</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_rand3</strong></div>';
}

$sql_26 = mysql_query("
INSERT INTO `dlil_setting` (`id`, `meta_key`, `meta_value`, `site_id`) VALUES
(1, 'site_name', 'Nwahy', 0),
(2, 'site_url', 'http://www.nwahy.com', 0),
(3, 'site_email', 'nwahycom@gmail.com', 0),
(4, 'site_description', 'موقع نواحي لدليل المواقع', 0),
(5, 'site_keywords', 'دليل,مواقع,أدلة', 0),
(6, 'theme_url', 'templates/nwahy', 0),
(7, 'header_code', '', 0),
(8, 'footer_code', '', 0),
(9, 'rewrite_rule', '1', 0),
(10, 'header_ads', '', 0),
(11, 'footer_ads', '', 0),
(12, 'site_close', '0', 0),
(13, 'site_close_message', '', 0),
(14, 'poll_id', '1', 0),
(15, 'allow_related_sites', '1', 0),
(16, 'limit_related_sites', '10', 0),
(17, 'allow_add_site', '1', 0),
(18, 'active_site', '0', 0),
(19, 'terms_adding', '<p>شروط إضافة الموقع:</p>\r\n<ul>\r\n<li>أن لا يحتوي الموقع على ما يخالف الدين الصحيح.</li>\r\n<li>أن لا يحتوي الموقع على صور نساء ولا أغاني ولا على معاصي.</li>\r\n</ul>', 0),
(20, 'allow_nofollow_category', '0', 0),
(21, 'allow_nofollow_sites', '0', 0),
(22, 'allow_view_alexa', '0', 0),
(23, 'comments_limit', '15', 0),
(24, 'limitinblock', '19', 0),
(25, 'allow_add', '1', 0),
(26, 'site_cat_limit', '20', 0),
(27, 'index_limit', '5', 0),
(28, 'showcomments', '1', 0),
(29, 'allowcomments', '1', 0),
(30, 'activecomments', '0', 0),
(31, 'showrandsiteinindex', '1', 0),
(32, 'randtype', '2', 0),
(33, 'randdate', '1423947706', 0),
(34, 'randsiteid', '208', 0),
(35, 'header_top_code', '<div style=\"text-align:center; padding:20px 0 0 0;\"><a target=\"_blank\" href=\"http://www.muslim-library.com\"><img src=\"images/muslim-library.gif\" alt=\"Muslim Library\" /></a></div>', 0);
");	
if($sql_26){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_setting</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_setting</strong></div>';
}

$sql_27 = mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(5, 'تفسير القرآن (ابن كثير)', 'http://quran.al-islam.com/Tafseer/DispTafsser.asp?l=arb&bm=yes&taf=KATHEER', 'تفسير القرآن (ابن كثير)', 'تفسير القرآن (ابن كثير)', '', '', '', 1, 2, 0, 0, 0, 1, '1211213817', 0, 0),
(4, 'استمع للقرآن - طريق الإسلام', 'http://www.islamway.com/?iw_s=Quran', 'استمع للقرآن - طريق الإسلام', 'استمع للقرآن - طريق الإسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211213817', 0, 0),
(3, 'القرآن الكريم - موقع الإسلام', 'http://www.quran.al-islam.com/arb', 'القرآن الكريم - موقع الإسلام', 'القرآن الكريم - موقع الإسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211213817', 0, 0),
(2, 'القرآن الكريم - الشبكة الإسلامية', 'http://audio.islamweb.net/audio/index.php?page=rewaya', 'القرآن الكريم - الشبكة الإسلامية', 'القرآن الكريم - الشبكة الإسلامية', '', '', '', 1, 2, 0, 0, 0, 1, '1211213817', 0, 0),
(1, 'طريق القرآن الكريم', 'http://www.quranway.net', 'طريق القرآن الكريم', 'طريق القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211213817', 0, 0),
(6, 'تفسير القرآن (الطبري)', 'http://quran.al-islam.com/Tafseer/DispTafsser.asp?l=arb&taf=TABARY&nType=1&nSora=1&nAya=1', 'تفسير القرآن (الطبري)', 'تفسير القرآن (الطبري)', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(7, 'القرآن الكريم - شبكة نسيج', 'http://islamic.naseej.com.sa/staticpages/islamic/quran/index.asp', 'القرآن الكريم - شبكة نسيج', 'القرآن الكريم - شبكة نسيج', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(8, 'تفسير القرآن (القرطبي)', 'http://quran.al-islam.com/Tafseer/DispTafsser.asp?l=arb&taf=KORTOBY&nType=1&nSora=1&nAya=1', 'تفسير القرآن (القرطبي)', 'تفسير القرآن (القرطبي)', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(9, 'تفسير القرآن (الجلالين)', 'http://quran.al-islam.com/Tafseer/DispTafsser.asp?l=arb&taf=GALALEEN&nType=1&nSora=1&nAya=1', 'تفسير القرآن (الجلالين)', 'تفسير القرآن (الجلالين)', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(10, 'استمع للقرآن الكريم', 'http://quran.muslim-web.com', 'استمع للقرآن الكريم', 'استمع للقرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(11, 'الإعجاز العلمي في القرآن والسنة', 'http://www.55a.net', 'الإعجاز العلمي في القرآن والسنة', 'الإعجاز العلمي في القرآن والسنة', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(12, 'الإعجازالعلمي في القرآن والسنة', 'http://www.eajaz.com', 'الإعجازالعلمي في القرآن والسنة', 'الإعجازالعلمي في القرآن والسنة', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(13, 'مجمع الملك فهد لطباعة القرآن', 'http://www.qurancomplex.org', 'مجمع الملك فهد لطباعة القرآن', 'مجمع الملك فهد لطباعة القرآن', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(14, 'إذاعـة طريق السماء', 'http://www.samaway.com', 'إذاعـة طريق السماء', 'إذاعـة طريق السماء', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(15, 'علوم القرآن الكريم', 'http://qurankareem.info', 'علوم القرآن الكريم', 'علوم القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(16, 'المركز العلمي لتعليم القرآن والسنة', 'http://www.markaz1.com', 'المركز العلمي لتعليم القرآن والسنة', 'المركز العلمي لتعليم القرآن والسنة', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(17, 'نون للدراسات والأبحاث القرآنية', 'http://www.islamnoon.com', 'نون للدراسات والأبحاث القرآنية', 'نون للدراسات والأبحاث القرآنية', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(18, 'القرآن الكريم تلاوة السديس', 'http://www.hamoislam.com/quraan.htm', 'القرآن الكريم تلاوة السديس', 'القرآن الكريم تلاوة السديس', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(19, 'في ظلال القرآن لسيد قطب', 'http://www.khayma.com/islamissolution/iis/zelal/fhrszelal.htm', 'في ظلال القرآن لسيد قطب', 'في ظلال القرآن لسيد قطب', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(20, 'فهرست القرآن الكريم', 'http://www.prayertimes.ps/Quran/QIndex.html', 'فهرست القرآن الكريم', 'فهرست القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(21, 'اذاعة القرآن الكريم من نابلس', 'http://www.quran-radio.com', 'اذاعة القرآن الكريم من نابلس', 'اذاعة القرآن الكريم من نابلس', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(22, 'التجويد', 'http://www.tadjweed.com', 'التجويد', 'التجويد', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(23, 'موقع القرآن الكريم', 'http://www.quraan.com', 'موقع القرآن الكريم', 'موقع القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 2, '1211214958', 0, 0),
(24, 'موقع قراء القرآن', 'http://www.qquran.com', 'موقع قراء القرآن', 'موقع قراء القرآن', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(25, 'موقع قرآني', 'http://www.qurani.com', 'موقع قرآني', 'موقع قرآني', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(26, 'موقع القرآن الكريم', 'http://www.quransite.com', 'موقع القرآن الكريم', 'موقع القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(27, 'ترتيل القرآن الكريم', 'http://www.tarteel.com', 'ترتيل القرآن الكريم', 'ترتيل القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(28, 'شبكة حفاظ الوحيين', 'http://www.alwahyain.net', 'شبكة حفاظ الوحيين', 'شبكة حفاظ الوحيين', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(29, 'قناة المجد للقرآن الكريم', 'http://www.quran.tv', 'قناة المجد للقرآن الكريم', 'قناة المجد للقرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(30, 'الشيخ اسماعيل الشيخ', 'http://www.shikh.com', 'الشيخ اسماعيل الشيخ', 'الشيخ اسماعيل الشيخ', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(31, 'الثقة للقرآن الكريم', 'http://www.altheqa.org', 'الثقة للقرآن الكريم', 'الثقة للقرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(32, 'محرك بحث القرآن والسنة النبوية', 'http://www.alawfa.com', 'محرك بحث القرآن والسنة النبوية', 'محرك بحث القرآن والسنة النبوية', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(33, 'قاف لخدمة القرآن الكريم', 'http://www.qaaaf.org', 'قاف لخدمة القرآن الكريم', 'قاف لخدمة القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(34, 'حلقات جامع الفرقان', 'http://www.al-forquan.com', 'حلقات جامع الفرقان', 'حلقات جامع الفرقان', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(35, 'أيات', 'http://www.ayaat.com', 'أيات', 'أيات', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(36, 'هدي الاسلام', 'http://www.hadielislam.com', 'هدي الاسلام', 'هدي الاسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(37, 'جائزة دبي للقرآن الكريم', 'http://www.quran.gov.ae', 'جائزة دبي للقرآن الكريم', 'جائزة دبي للقرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(38, 'القرآن للجميع', 'http://quran4all.net', 'القرآن للجميع', 'القرآن للجميع', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(39, 'مؤسسة رأس الخيمة للقرآن وعلومه', 'http://www.quranrak.org.ae', 'مؤسسة رأس الخيمة للقرآن وعلومه', 'مؤسسة رأس الخيمة للقرآن وعلومه', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(40, 'الشيخ الدكتور علي جابر', 'http://www.alijaber.net', 'الشيخ الدكتور علي جابر', 'الشيخ الدكتور علي جابر', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(41, 'القارئ الشيخ أبوبكر الشاطري', 'http://www.alshatri.net', 'القارئ الشيخ أبوبكر الشاطري', 'القارئ الشيخ أبوبكر الشاطري', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(42, 'رياض القرآن', 'http://www.ryadh-quran.com', 'رياض القرآن', 'رياض القرآن', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(43, 'أسرار إعجاز القرآن', 'http://www.kaheel7.com', 'أسرار إعجاز القرآن', 'أسرار إعجاز القرآن', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(44, 'الدين النصيحة', 'http://www.nasiha.net', 'الدين النصيحة', 'الدين النصيحة', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(45, 'قرآنيات', 'http://quran.qatardr.net', 'قرآنيات', 'قرآنيات', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(46, 'نص القرآن الكريم بالخط الكبير', 'http://www.hollyq.com', 'نص القرآن الكريم بالخط الكبير', 'نص القرآن الكريم بالخط الكبير', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(47, 'مكتبة القرآن الكريم الصوتية', 'http://www.mp3quran.net', 'مكتبة القرآن الكريم الصوتية', 'مكتبة القرآن الكريم الصوتية', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(48, 'الشيخ عبدالباسط عبدالصمد', 'http://www.abdalbasit.com', 'الشيخ عبدالباسط عبدالصمد', 'الشيخ عبدالباسط عبدالصمد', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(49, 'الدورة المكثفة لحفظ القرآن بالحرم المكي', 'http://www.dorah-quran.org', 'الدورة المكثفة لحفظ القرآن بالحرم المكي', 'الدورة المكثفة لحفظ القرآن بالحرم المكي', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(50, 'مركز ناصر بن هزاع لحفاظ القرآن', 'http://www.hoffad.com', 'مركز ناصر بن هزاع لحفاظ القرآن', 'مركز ناصر بن هزاع لحفاظ القرآن', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(51, 'رياض القرآن الكريم', 'http://ryadh-quran.net', 'رياض القرآن الكريم', 'رياض القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(52, 'بذرة الإسلام', 'http://www.islamseed.com', 'بذرة الإسلام', 'بذرة الإسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(53, 'إذاعات القرآن الكريم', 'http://www.tanateesh.com/quran', 'إذاعات القرآن الكريم', 'إذاعات القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(54, 'المصحف الشريف', 'http://www.quranflash.com', 'المصحف الشريف', 'المصحف الشريف', '', '', '', 1, 2, 0, 0, 0, 1, '1211214958', 0, 0),
(55, 'علم القرآن الكريم', 'http://www.ketaballah.net', 'علم القرآن الكريم', 'علم القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(56, 'الثقة للقرآن الكريم', 'http://www.altheqa.org', 'الثقة للقرآن الكريم', 'الثقة للقرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(57, 'الشيخ محمد بن سليمان المحيسني', 'http://almehaisni.net', 'الشيخ محمد بن سليمان المحيسني', 'الشيخ محمد بن سليمان المحيسني', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(58, 'الشيخ محمد بسيونى', 'http://www.m-bassuony.com', 'الشيخ محمد بسيونى', 'الشيخ محمد بسيونى', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(59, 'المقرأة القرآنية', 'http://www.almaqraa.com', 'المقرأة القرآنية', 'المقرأة القرآنية', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(60, 'برنامج الرياحين لتحفيظ القران الكريم', 'http://www.al-rayaheen.com', 'برنامج الرياحين لتحفيظ القران الكريم', 'برنامج الرياحين لتحفيظ القران الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(61, 'شبكة ترتيل وتجويد القران الكريم', 'http://www.trtel.com', 'شبكة ترتيل وتجويد القران الكريم', 'شبكة ترتيل وتجويد القران الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(62, 'سهم النور', 'http://www.sahmalnour.org', 'سهم النور', 'سهم النور', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(63, 'عالم القرآن الكريم', 'http://www.hqw7.com', 'عالم القرآن الكريم', 'عالم القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(64, 'استمع وترجم القرآن الكريم', 'http://www.quranexplorer.com', 'استمع وترجم القرآن الكريم', 'استمع وترجم القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(65, 'القرآن الكريم للجميع', 'http://www.quran-for-all.com', 'القرآن الكريم للجميع', 'القرآن الكريم للجميع', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(66, 'الماهر لحلقات التحفيظ', 'http://www.ma3h.com', 'الماهر لحلقات التحفيظ', 'الماهر لحلقات التحفيظ', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(67, 'حفص لتجويد القرآن الكريم', 'http://www.hafss.com', 'حفص لتجويد القرآن الكريم', 'حفص لتجويد القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(68, 'عماد الاسلام', 'http://www.imadislam.com', 'عماد الاسلام', 'عماد الاسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(69, 'القرآن الكريم mp3', 'http://quran.y-nas.com', 'القرآن الكريم mp3', 'القرآن الكريم mp3', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(70, 'موسوعة القرآن الكريم', 'http://www.iid-quran.com', 'موسوعة القرآن الكريم', 'موسوعة القرآن الكريم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(71, 'القبس - يعني بالقرآن وعلومة', 'http://www.alkabs.net', 'القبس - يعني بالقرآن وعلومة', 'القبس - يعني بالقرآن وعلومة', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(72, 'المصحف الجامع', 'http://www.mosshaf.com', 'المصحف الجامع', 'المصحف الجامع', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(73, 'شبكة المسلم', 'http://www.el-moslem.com', 'شبكة المسلم', 'شبكة المسلم', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(74, 'بدر الاسلام', 'http://www.badrelislam.com', 'بدر الاسلام', 'بدر الاسلام', '', '', '', 1, 2, 0, 0, 0, 1, '1211215259', 0, 0),
(75, 'الحديث الشريف', 'http://hadith.al-islam.com', 'الحديث الشريف', 'الحديث الشريف', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(76, 'الحديث - نداء الإيمان', 'http://www.al-eman.com/hadeeth', 'الحديث - نداء الإيمان', 'الحديث - نداء الإيمان', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(77, 'الحديث - الشئون الإسلامية بمصر', 'http://www.islamic-council.com/Al-Sonna/Default.asp?Action=Start', 'الحديث - الشئون الإسلامية بمصر', 'الحديث - الشئون الإسلامية بمصر', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(78, 'تيسير الوصول الى احاديث الرسول', 'http://www.dorar.net/hadith.php', 'تيسير الوصول الى احاديث الرسول', 'تيسير الوصول الى احاديث الرسول', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(79, 'شبكة السنة النبوية وعلومها', 'http://www.alssunnah.com', 'شبكة السنة النبوية وعلومها', 'شبكة السنة النبوية وعلومها', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(80, 'الشيخان للدراسات العربية والإسلامية', 'http://www.alshaykhan.com', 'الشيخان للدراسات العربية والإسلامية', 'الشيخان للدراسات العربية والإسلامية', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(81, 'الجمعية السعودية للسنة وعلومها', 'http://www.sunan.org', 'الجمعية السعودية للسنة وعلومها', 'الجمعية السعودية للسنة وعلومها', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(82, 'صناعة الحديث', 'http://www.hadiith.net', 'صناعة الحديث', 'صناعة الحديث', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(83, 'مكتبة الحديث الشريف', 'http://www.iid-hadeth.com', 'مكتبة الحديث الشريف', 'مكتبة الحديث الشريف', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(84, 'أهل الحديث', 'http://www.alsalafe.com', 'أهل الحديث', 'أهل الحديث', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(85, 'موسوعة السيرة النبوية', 'http://sirah.al-islam.com', 'موسوعة السيرة النبوية', 'موسوعة السيرة النبوية', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(86, 'قناة المجد للحديث النبوي', 'http://www.hadeeth.tv', 'قناة المجد للحديث النبوي', 'قناة المجد للحديث النبوي', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(87, 'أفق الإسلام', 'http://www.offok.com', 'أفق الإسلام', 'أفق الإسلام', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(88, 'احسان رابطة الشبكة لدراسة الحديث', 'http://www.ihsanetwork.org', 'احسان رابطة الشبكة لدراسة الحديث', 'احسان رابطة الشبكة لدراسة الحديث', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(89, 'تخريج الأحاديث النبوية للألباني', 'http://arabic.islamicweb.com/Books/albani.asp', 'تخريج الأحاديث النبوية للألباني', 'تخريج الأحاديث النبوية للألباني', '', '', '', 1, 3, 0, 0, 0, 1, '1211215667', 0, 0),
(90, 'موقع الشيخ ابن باز', 'http://www.binbaz.org.sa', 'موقع الشيخ ابن باز', 'موقع الشيخ ابن باز', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(91, 'الشيخ عبدالله بن جبرين', 'http://www.ibn-jebreen.com', 'الشيخ عبدالله بن جبرين', 'الشيخ عبدالله بن جبرين', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(92, 'الشيخ سلمان العودة - الاسلام اليوم', 'http://www.islamtoday.net', 'الشيخ سلمان العودة - الاسلام اليوم', 'الشيخ سلمان العودة - الاسلام اليوم', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(93, 'الشيخ محمد المختار الشنقيطي', 'http://shankeety.net', 'الشيخ محمد المختار الشنقيطي', 'الشيخ محمد المختار الشنقيطي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(94, 'موقع المنبر للخطب', 'http://www.alminbar.net', 'موقع المنبر للخطب', 'موقع المنبر للخطب', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(95, 'الاسلام سؤال وجواب الشيخ المنجد', 'http://www.islam-qa.com', 'الاسلام سؤال وجواب الشيخ المنجد', 'الاسلام سؤال وجواب الشيخ المنجد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(96, 'المختار الإسلامي للشيخ المنجد', 'http://www.islamselect.com', 'المختار الإسلامي للشيخ المنجد', 'المختار الإسلامي للشيخ المنجد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(97, 'الشيخ عبد العزيز الراجحي', 'http://www.sh-rajhi.com', 'الشيخ عبد العزيز الراجحي', 'الشيخ عبد العزيز الراجحي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(98, 'الشيخ ناصر العمر - المسلم', 'http://www.almoslim.net', 'الشيخ ناصر العمر - المسلم', 'الشيخ ناصر العمر - المسلم', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(99, 'موقع الشيخ ابن عثيمين', 'http://www.ibnothaimeen.com', 'موقع الشيخ ابن عثيمين', 'موقع الشيخ ابن عثيمين', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(100, 'الشيخ صالح بن فوزان آل فوزان', 'http://www.alfawzan.ws', 'الشيخ صالح بن فوزان آل فوزان', 'الشيخ صالح بن فوزان آل فوزان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(101, 'الشيخ سفر الحوالي', 'http://www.alhawali.com', 'الشيخ سفر الحوالي', 'الشيخ سفر الحوالي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(102, 'موقع الفقه للشيخ أيمن سامي', 'http://www.alfeqh.com', 'موقع الفقه للشيخ أيمن سامي', 'موقع الفقه للشيخ أيمن سامي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(103, 'تخريج الأحاديث النبوية للألباني', 'http://arabic.islamicweb.com/Books/albani.asp', 'تخريج الأحاديث النبوية للألباني', 'تخريج الأحاديث النبوية للألباني', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(104, 'العمل للإسلام للشيخ المنجد', 'http://www.islamqa.com', 'العمل للإسلام للشيخ المنجد', 'العمل للإسلام للشيخ المنجد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(105, 'الصوتيات والمرئيات الإسلامي - المنجد', 'http://www.islamicaudiovideo.com', 'الصوتيات والمرئيات الإسلامي - المنجد', 'الصوتيات والمرئيات الإسلامي - المنجد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(106, 'المربي - الشيخ محمد الدويش', 'http://www.almurabbi.com', 'المربي - الشيخ محمد الدويش', 'المربي - الشيخ محمد الدويش', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(107, 'حفاظ الوحيين للشيخ يحي اليحي', 'http://www.alwahyain.net', 'حفاظ الوحيين للشيخ يحي اليحي', 'حفاظ الوحيين للشيخ يحي اليحي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(108, 'الشيخ عائض بن عبدالله القرني', 'http://www.algarne.com', 'الشيخ عائض بن عبدالله القرني', 'الشيخ عائض بن عبدالله القرني', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(109, 'طريق الإيمان - الشيخ نبيل العوضي', 'http://www.emanway.com', 'طريق الإيمان - الشيخ نبيل العوضي', 'طريق الإيمان - الشيخ نبيل العوضي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(110, 'التاريخ للدكتور محمد موسى الشريف', 'http://www.altareekh.com', 'التاريخ للدكتور محمد موسى الشريف', 'التاريخ للدكتور محمد موسى الشريف', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(111, 'الدكتور طارق السويدان', 'http://www.suwaidan.com', 'الدكتور طارق السويدان', 'الدكتور طارق السويدان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(112, 'طيبة الطيبة - الشيخ يحيى اليحيى', 'http://www.taiba.org', 'طيبة الطيبة - الشيخ يحيى اليحيى', 'طيبة الطيبة - الشيخ يحيى اليحيى', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(113, 'تراتيل - الشيخ عبدالعزيز الأحمد', 'http://www.taratil.com', 'تراتيل - الشيخ عبدالعزيز الأحمد', 'تراتيل - الشيخ عبدالعزيز الأحمد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(114, 'الشيخ حامد عبدالله العلي', 'http://www.h-alali.net', 'الشيخ حامد عبدالله العلي', 'الشيخ حامد عبدالله العلي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(115, 'المنهج - الشيخ عثمان الخميس', 'http://www.almanhaj.net', 'المنهج - الشيخ عثمان الخميس', 'المنهج - الشيخ عثمان الخميس', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(116, 'الإسلام للجميع - الشيخ طارق الطواري', 'http://www.alislam4all.com', 'الإسلام للجميع - الشيخ طارق الطواري', 'الإسلام للجميع - الشيخ طارق الطواري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(117, 'الإسلام اليوم (الشيخ يوسف)', 'http://www.islamtoday.com', 'الإسلام اليوم (الشيخ يوسف)', 'الإسلام اليوم (الشيخ يوسف)', '', '', '', 1, 4, 0, 0, 0, 2, '1211277322', 0, 0),
(118, 'الشيخ محمد نبهان (علم القراءات)', 'http://www.quraat.com', 'الشيخ محمد نبهان (علم القراءات)', 'الشيخ محمد نبهان (علم القراءات)', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(119, 'الشيخ مقبل بن هادي الوادعي', 'http://www.muqbel.net', 'الشيخ مقبل بن هادي الوادعي', 'الشيخ مقبل بن هادي الوادعي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(120, 'الشيخ عبد الله آل محمود الشريف', 'http://www.alshreef.com', 'الشيخ عبد الله آل محمود الشريف', 'الشيخ عبد الله آل محمود الشريف', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(121, 'الشيخ علي بن عمر بادحدح - إسلاميات', 'http://www.islameiat.com', 'الشيخ علي بن عمر بادحدح - إسلاميات', 'الشيخ علي بن عمر بادحدح - إسلاميات', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(122, 'دعوة الإسلام - الشيخ محمد الحمد', 'http://www.toislam.net', 'دعوة الإسلام - الشيخ محمد الحمد', 'دعوة الإسلام - الشيخ محمد الحمد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(123, 'الداعية جاسم المطوع', 'http://www.almutawa.info', 'الداعية جاسم المطوع', 'الداعية جاسم المطوع', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(124, 'موقع الشيخ فائز شيخ الزور', 'http://www.shaikhfayez.net', 'موقع الشيخ فائز شيخ الزور', 'موقع الشيخ فائز شيخ الزور', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(125, 'تفسير الأحلام - الشيخ فهد العصيمي', 'http://www.22522.com', 'تفسير الأحلام - الشيخ فهد العصيمي', 'تفسير الأحلام - الشيخ فهد العصيمي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(126, 'الإنسان بين العلم والرؤى', 'http://www.arabian-child.net/Allehaidan/AlLuhaidan.html', 'الإنسان بين العلم والرؤى', 'الإنسان بين العلم والرؤى', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(127, 'دعوة الإمام محمد بن عبدالوهاب', 'http://www.almoslim.net/Moslim_Files/dawah/index.cfm', 'دعوة الإمام محمد بن عبدالوهاب', 'دعوة الإمام محمد بن عبدالوهاب', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(128, 'القارئ صلاح الهاشم', 'http://www.alhashem.net', 'القارئ صلاح الهاشم', 'القارئ صلاح الهاشم', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(129, 'سلسلة العلامتين', 'http://www.3llamteen.com', 'سلسلة العلامتين', 'سلسلة العلامتين', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(130, 'الشيخ عبدالرحمن عبدالخالق', 'http://www.salafi.net', 'الشيخ عبدالرحمن عبدالخالق', 'الشيخ عبدالرحمن عبدالخالق', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(131, 'الشيخ محمد حمود النجدي', 'http://www.alathry.com', 'الشيخ محمد حمود النجدي', 'الشيخ محمد حمود النجدي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(132, 'عناوين بريد المشائخ والعلماء', 'http://www.raddadi.com/?action=pages.11', 'عناوين بريد المشائخ والعلماء', 'عناوين بريد المشائخ والعلماء', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(133, 'السعادة الأسرية للشيخ مازن الفريح', 'http://www.naseh.net', 'السعادة الأسرية للشيخ مازن الفريح', 'السعادة الأسرية للشيخ مازن الفريح', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(134, 'هواتف العلماء والدعاة', 'http://www.raddadi.com/?action=pages.10', 'هواتف العلماء والدعاة', 'هواتف العلماء والدعاة', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(135, 'يسألونك للشيخ حسام الدين عفانه', 'http://www.yasaloonak.net', 'يسألونك للشيخ حسام الدين عفانه', 'يسألونك للشيخ حسام الدين عفانه', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(136, 'الشيخ خالد بن عبدالله المصلح', 'http://www.almosleh.com', 'الشيخ خالد بن عبدالله المصلح', 'الشيخ خالد بن عبدالله المصلح', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(137, 'الدكتور جعفر شيخ ادريس', 'http://www.jaafaridris.com', 'الدكتور جعفر شيخ ادريس', 'الدكتور جعفر شيخ ادريس', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(138, 'الدرر السنية للشيخ علوي السقاف', 'http://www.dorar.net', 'الدرر السنية للشيخ علوي السقاف', 'الدرر السنية للشيخ علوي السقاف', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(139, 'الشيخ محمد صالح كابوري', 'http://www.gabori.net', 'الشيخ محمد صالح كابوري', 'الشيخ محمد صالح كابوري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(140, 'الداعية عمرو خالد', 'http://www.amrkhaled.net', 'الداعية عمرو خالد', 'الداعية عمرو خالد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(141, 'خطب الحرمين الشريفين', 'http://www.islamway.com/bindex.php?section=scholarlessons&scholar_id=216', 'خطب الحرمين الشريفين', 'خطب الحرمين الشريفين', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(142, 'موقع القارئ مشاري العفاسي', 'http://www.alafasy.com', 'موقع القارئ مشاري العفاسي', 'موقع القارئ مشاري العفاسي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(143, 'موقع الشيخ محمد جبريل', 'http://www.jebril.com', 'موقع الشيخ محمد جبريل', 'موقع الشيخ محمد جبريل', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(144, 'الشيخ علي الطنطاوي', 'http://www.alitantawi.com', 'الشيخ علي الطنطاوي', 'الشيخ علي الطنطاوي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(145, 'الداعية محمد زياد الحسني الجزائري', 'http://www.zeadonline.com', 'الداعية محمد زياد الحسني الجزائري', 'الداعية محمد زياد الحسني الجزائري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(146, 'نوافذ الدعوة - الشيخ أحمد الحمدان', 'http://www.dawahwin.com', 'نوافذ الدعوة - الشيخ أحمد الحمدان', 'نوافذ الدعوة - الشيخ أحمد الحمدان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(147, 'الشيخ وجدي غنيم', 'http://www.wagdyghoneim.com', 'الشيخ وجدي غنيم', 'الشيخ وجدي غنيم', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(148, 'برنامج أول اثنين - الشيخ سلمان العودة', 'http://www.awalethnain.com', 'برنامج أول اثنين - الشيخ سلمان العودة', 'برنامج أول اثنين - الشيخ سلمان العودة', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(149, 'الشيخ أحمد ياسين', 'http://www.ayaseen.com', 'الشيخ أحمد ياسين', 'الشيخ أحمد ياسين', '', '', '', 1, 4, 0, 0, 0, 1, '1211277322', 0, 0),
(150, 'قوافل العائدين - الشيخ خالد الراشد', 'http://www.alrashed-km.com', 'قوافل العائدين - الشيخ خالد الراشد', 'قوافل العائدين - الشيخ خالد الراشد', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(151, 'القارئ محمد إبراهيم اللحيدان', 'http://www.al7aidan.com', 'القارئ محمد إبراهيم اللحيدان', 'القارئ محمد إبراهيم اللحيدان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(152, 'موقع الشيخ محمد الدويش', 'http://www.dweesh.com', 'موقع الشيخ محمد الدويش', 'موقع الشيخ محمد الدويش', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(153, 'القارئ فهد الكندري', 'http://www.alkanderi.com', 'القارئ فهد الكندري', 'القارئ فهد الكندري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(154, 'الشيخ الشعراوى', 'http://www.khayma.com/alsharawi', 'الشيخ الشعراوى', 'الشيخ الشعراوى', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(155, 'الشيخ فهد العصيمي', 'http://www.22522.com', 'الشيخ فهد العصيمي', 'الشيخ فهد العصيمي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(156, 'شبكة نور الإسلام', 'http://www.islamlight.net', 'شبكة نور الإسلام', 'شبكة نور الإسلام', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(157, 'الدكتور حاكم المطيري', 'http://www.dr-hakem.org', 'الدكتور حاكم المطيري', 'الدكتور حاكم المطيري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(158, 'الشيخ ثامر بن مبارك العامر', 'http://www.bnmobarak.com/', 'الشيخ ثامر بن مبارك العامر', 'الشيخ ثامر بن مبارك العامر', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(159, 'الشيخ عبدالرحمن بن ناصر البراك', 'http://albarrak.islamlight.net', 'الشيخ عبدالرحمن بن ناصر البراك', 'الشيخ عبدالرحمن بن ناصر البراك', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(160, 'الكاشف - الشيخ سليمان الخراشي', 'http://www.alkashf.net', 'الكاشف - الشيخ سليمان الخراشي', 'الكاشف - الشيخ سليمان الخراشي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(161, 'الشيخ الدكتور محمد علي فركوس', 'http://www.ferkous.com', 'الشيخ الدكتور محمد علي فركوس', 'الشيخ الدكتور محمد علي فركوس', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(162, 'شفاء - العلاج بالرقية الشرعية', 'http://www.shefaa.org', 'شفاء - العلاج بالرقية الشرعية', 'شفاء - العلاج بالرقية الشرعية', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(163, 'خواطر الشيخ محمد متولى الشعراوي', 'http://www.elsharawy.com', 'خواطر الشيخ محمد متولى الشعراوي', 'خواطر الشيخ محمد متولى الشعراوي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(164, 'الشيخ أحمد بن علي العجمي', 'http://www.alajmy.com', 'الشيخ أحمد بن علي العجمي', 'الشيخ أحمد بن علي العجمي', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(165, 'الشيخ عبدالله بن صالح الفوزان', 'http://www.alfuzan.islamlight.net', 'الشيخ عبدالله بن صالح الفوزان', 'الشيخ عبدالله بن صالح الفوزان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(166, 'الشيخ عبد السلام العييري', 'http://www.abdslam.com', 'الشيخ عبد السلام العييري', 'الشيخ عبد السلام العييري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(167, 'الشيخ محمد ناصر الدين الألباني', 'http://www.alalbany.net', 'الشيخ محمد ناصر الدين الألباني', 'الشيخ محمد ناصر الدين الألباني', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(168, 'الشيخ محمد حسان', 'http://www.mohamedhassan.org', 'الشيخ محمد حسان', 'الشيخ محمد حسان', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(169, 'الشيخ رياض المسيميري', 'http://islamlight.net/almosimiry', 'الشيخ رياض المسيميري', 'الشيخ رياض المسيميري', '', '', '', 1, 4, 0, 0, 0, 1, '1211277660', 0, 0),
(170, 'الشيخ الدكتور يوسف الشبيلي', 'http://www.shubily.com', 'الشيخ الدكتور يوسف الشبيلي', 'الشيخ الدكتور يوسف الشبيلي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(171, 'الصارم المسلول', 'http://www.alsarm.com', 'الصارم المسلول', 'الصارم المسلول', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(172, 'الشيخ سعود الشريم', 'http://www.shuraim.net', 'الشيخ سعود الشريم', 'الشيخ سعود الشريم', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(173, 'الشيخ سعد بن عبد الرحمن الحصين', 'http://www.saad-alhusayen.com', 'الشيخ سعد بن عبد الرحمن الحصين', 'الشيخ سعد بن عبد الرحمن الحصين', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(174, 'الشيخ عبد الله ناصح علوان', 'http://www.abdullahelwan.net', 'الشيخ عبد الله ناصح علوان', 'الشيخ عبد الله ناصح علوان', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(175, 'الشيخ عبدالمحسن القاسم', 'http://www.alqasim.org', 'الشيخ عبدالمحسن القاسم', 'الشيخ عبدالمحسن القاسم', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(176, 'الشيخ سالم العجمي', 'http://www.salemalajmi.com', 'الشيخ سالم العجمي', 'الشيخ سالم العجمي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(177, 'المنادي - الشيخ عبد الملك القاسم', 'http://www.almunadi.com', 'المنادي - الشيخ عبد الملك القاسم', 'المنادي - الشيخ عبد الملك القاسم', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(178, 'الشيخ الدكتور علي بن حمزة العمري', 'http://www.alomarey.net', 'الشيخ الدكتور علي بن حمزة العمري', 'الشيخ الدكتور علي بن حمزة العمري', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(179, 'منارة الشريعة - الشيخ صالح الأسمري', 'http://www.manarahnet.net', 'منارة الشريعة - الشيخ صالح الأسمري', 'منارة الشريعة - الشيخ صالح الأسمري', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(180, 'القارئ الشيخ جمال شاكر', 'http://www.jamalshaker.com', 'القارئ الشيخ جمال شاكر', 'القارئ الشيخ جمال شاكر', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(181, 'منار الإسلام - الشيخ عبدالله الطيار', 'http://www.m-islam.net', 'منار الإسلام - الشيخ عبدالله الطيار', 'منار الإسلام - الشيخ عبدالله الطيار', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(182, 'الشيخ سعد البريك', 'http://www.saadalbreik.com', 'الشيخ سعد البريك', 'الشيخ سعد البريك', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(183, 'احياء السنة - الشيخ احمد العمودي', 'http://www.alsonnah.net', 'احياء السنة - الشيخ احمد العمودي', 'احياء السنة - الشيخ احمد العمودي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(184, 'الشيخ الدكتور على محمد الصلابي', 'http://www.alsallaby.com', 'الشيخ الدكتور على محمد الصلابي', 'الشيخ الدكتور على محمد الصلابي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(185, 'جوال الخير للشيخ عائض القرني', 'http://www.alkhairsms.com', 'جوال الخير للشيخ عائض القرني', 'جوال الخير للشيخ عائض القرني', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(186, 'خطب القنام لوعظ الأنام', 'http://www.algannam.com', 'خطب القنام لوعظ الأنام', 'خطب القنام لوعظ الأنام', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(187, 'العقيدة والحياة . الشيخ أحمد القاضي', 'http://www.al-aqidah.com', 'العقيدة والحياة . الشيخ أحمد القاضي', 'العقيدة والحياة . الشيخ أحمد القاضي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(188, 'الشيخ ابراهيم شاهين', 'http://www.ibraheemshaheen.com', 'الشيخ ابراهيم شاهين', 'الشيخ ابراهيم شاهين', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(189, 'الشيخ الدكتور عمر عبد الكافي', 'http://www.abdelkafy.com', 'الشيخ الدكتور عمر عبد الكافي', 'الشيخ الدكتور عمر عبد الكافي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(190, 'الدكتور زغلول النجار', 'http://www.elnaggarzr.com', 'الدكتور زغلول النجار', 'الدكتور زغلول النجار', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(191, 'الشيخ جماز بن عبدالرحمن الجماز', 'http://www.aljmaz.net', 'الشيخ جماز بن عبدالرحمن الجماز', 'الشيخ جماز بن عبدالرحمن الجماز', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(192, 'القارئ هاني الرفاعي', 'http://www.alrfaey.org', 'القارئ هاني الرفاعي', 'القارئ هاني الرفاعي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(193, 'الشيخ عبد الحميد كشك', 'http://www.keshk.meshmesh.net', 'الشيخ عبد الحميد كشك', 'الشيخ عبد الحميد كشك', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(194, 'الشيخ سعود بن ابراهيم الشريم', 'http://www.shuraym.com', 'الشيخ سعود بن ابراهيم الشريم', 'الشيخ سعود بن ابراهيم الشريم', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(195, 'منبر علماء اليمن', 'http://olamaa-yemen.net', 'منبر علماء اليمن', 'منبر علماء اليمن', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(196, 'الشيخ ابو اسحاق الحويني', 'http://www.al-heweny.com', 'الشيخ ابو اسحاق الحويني', 'الشيخ ابو اسحاق الحويني', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(197, 'شيخ الاسلام ابن تيمية', 'http://www.ibntaimiah.com', 'شيخ الاسلام ابن تيمية', 'شيخ الاسلام ابن تيمية', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(198, 'القارئ الشيخ عبدالولي الأركاني', 'http://www.alarkani.com', 'القارئ الشيخ عبدالولي الأركاني', 'القارئ الشيخ عبدالولي الأركاني', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(199, 'الشيخ محمد المحيسني', 'http://www.almohisni.com', 'الشيخ محمد المحيسني', 'الشيخ محمد المحيسني', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(200, 'الشيخ زيد بن مسفر البحري', 'http://www.albahre.com', 'الشيخ زيد بن مسفر البحري', 'الشيخ زيد بن مسفر البحري', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(201, 'الشيخ عبدالله بن عبدالرحمن السعد', 'http://www.alssad.com', 'الشيخ عبدالله بن عبدالرحمن السعد', 'الشيخ عبدالله بن عبدالرحمن السعد', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(202, 'الشيخ أحمد ديدات', 'http://www.ahmed-deedat.net', 'الشيخ أحمد ديدات', 'الشيخ أحمد ديدات', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(203, 'الشيخ سعد بن جبرين', 'http://www.alhemam.com', 'الشيخ سعد بن جبرين', 'الشيخ سعد بن جبرين', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(204, 'لقاء المؤمنين وبناء الجيل المؤمن', 'http://www.alnahwi.com', 'لقاء المؤمنين وبناء الجيل المؤمن', 'لقاء المؤمنين وبناء الجيل المؤمن', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(205, 'الشيخ عيسى بن إبراهيم الدريويش', 'http://essanet.org', 'الشيخ عيسى بن إبراهيم الدريويش', 'الشيخ عيسى بن إبراهيم الدريويش', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(206, 'صفحة نايف الإسلامية', 'http://www.nayefbinmamdooh.com', 'صفحة نايف الإسلامية', 'صفحة نايف الإسلامية', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(207, 'الشيخ المحدث عبدالله السعد', 'http://www.alssad.com', 'الشيخ المحدث عبدالله السعد', 'الشيخ المحدث عبدالله السعد', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(208, 'الشيخ محمد علي الشنقيطي', 'http://www.alshngiti.com', 'الشيخ محمد علي الشنقيطي', 'الشيخ محمد علي الشنقيطي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(209, 'الشيخ صلاح الدين علي عبد الموجود', 'http://www.salahmera.com', 'الشيخ صلاح الدين علي عبد الموجود', 'الشيخ صلاح الدين علي عبد الموجود', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(210, 'الدكتور أحمد الزهراني', 'http://alkinani.net', 'الدكتور أحمد الزهراني', 'الدكتور أحمد الزهراني', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(211, 'الشيخ عبدالله بن إبراهيم القرعاوي', 'http://www.qaraye.com', 'الشيخ عبدالله بن إبراهيم القرعاوي', 'الشيخ عبدالله بن إبراهيم القرعاوي', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(212, 'الشيخ سليمان الماجد', 'http://www.salmajed.com', 'الشيخ سليمان الماجد', 'الشيخ سليمان الماجد', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(213, 'الشبخ حمد بن عبدالله الحمد', 'http://www.al-zad.net', 'الشبخ حمد بن عبدالله الحمد', 'الشبخ حمد بن عبدالله الحمد', '', '', '', 1, 4, 0, 0, 0, 1, '1211348368', 0, 0),
(214, 'شبكة السرداب الإسلامية', 'http://www.alserdaab.org', 'شبكة السرداب الإسلامية', 'شبكة السرداب الإسلامية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(215, 'دليل حقائق الرافضه', 'http://www.dhr12.com', 'دليل حقائق الرافضه', 'دليل حقائق الرافضه', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(216, 'موقع البينة', 'http://www.albainah.net', 'موقع البينة', 'موقع البينة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(217, 'موقع البرهان', 'http://www.albrhan.com', 'موقع البرهان', 'موقع البرهان', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(218, 'شبكة الرد', 'http://www.alradnet.com', 'شبكة الرد', 'شبكة الرد', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(219, 'إسلامية لا وهابية', 'http://www.wahabih.com', 'إسلامية لا وهابية', 'إسلامية لا وهابية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(220, 'فيصل نور - الحقائق الغائبة', 'http://www.fnoor.com', 'فيصل نور - الحقائق الغائبة', 'فيصل نور - الحقائق الغائبة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(221, 'أنصار أهل البيت', 'http://www.ansaaar.com', 'أنصار أهل البيت', 'أنصار أهل البيت', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(222, 'شبكة أنصار', 'http://www.ansar.org', 'شبكة أنصار', 'شبكة أنصار', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(223, 'رابطة أهل السنة في إيران', 'http://www.isl.org.uk', 'رابطة أهل السنة في إيران', 'رابطة أهل السنة في إيران', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(224, 'اللجنة العالمية لنصرة خاتم الأنبياء', 'http://www.icsfp.com', 'اللجنة العالمية لنصرة خاتم الأنبياء', 'اللجنة العالمية لنصرة خاتم الأنبياء', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(225, 'اللجنة الأوروبية لنصرة خير البرية', 'http://www.islamudeni.net', 'اللجنة الأوروبية لنصرة خير البرية', 'اللجنة الأوروبية لنصرة خير البرية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(226, 'رسول الله صلى الله عليه وسلم', 'http://nosra.islammemo.cc', 'رسول الله صلى الله عليه وسلم', 'رسول الله صلى الله عليه وسلم', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(227, 'الانتصار للنبي المختار', 'http://www.islameiat.com/entsar', 'الانتصار للنبي المختار', 'الانتصار للنبي المختار', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(228, 'كشف حقيقة فرقة الأحباش', 'http://www.antihabashis.com', 'كشف حقيقة فرقة الأحباش', 'كشف حقيقة فرقة الأحباش', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(229, 'المسيحية بمنظور اسلامي', 'http://arabic.islamicweb.com/christianity', 'المسيحية بمنظور اسلامي', 'المسيحية بمنظور اسلامي', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(230, 'حوار هادئ مع الشيعة', 'http://islamicweb.com/arabic/shia', 'حوار هادئ مع الشيعة', 'حوار هادئ مع الشيعة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(231, 'حركات التنصير في العالم الإسلامي', 'http://tanseer.jeeran.com', 'حركات التنصير في العالم الإسلامي', 'حركات التنصير في العالم الإسلامي', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(232, 'الصوفية1', 'http://www.alsoufia.com', 'الصوفية1', 'الصوفية1', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(233, 'الصوفية2', 'http://www.heartsactions.com/su.htm', 'الصوفية2', 'الصوفية2', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(234, 'شبكة صوت بلدي', 'http://www.baladynet.net', 'شبكة صوت بلدي', 'شبكة صوت بلدي', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(235, 'شبكة المجهر', 'http://www.almijhar.net', 'شبكة المجهر', 'شبكة المجهر', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(236, 'المسيحية في الميزان', 'http://www.alhakekah.com', 'المسيحية في الميزان', 'المسيحية في الميزان', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(237, 'شبكة الحقيقة الاسلامية', 'http://www.trutheye.com', 'شبكة الحقيقة الاسلامية', 'شبكة الحقيقة الاسلامية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(238, 'موقع ابن مريم عن المسيح الحق', 'http://www.ebnmaryam.com', 'موقع ابن مريم عن المسيح الحق', 'موقع ابن مريم عن المسيح الحق', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(239, 'الحقيقة العظمى', 'http://www.truth.org.ye', 'الحقيقة العظمى', 'الحقيقة العظمى', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(240, 'شبكة الراصد الإسلامية', 'http://www.alrased.net', 'شبكة الراصد الإسلامية', 'شبكة الراصد الإسلامية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(241, 'الرافضة في سطور', 'http://awfi.4t.com', 'الرافضة في سطور', 'الرافضة في سطور', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(242, 'المهتدون الشيعة', 'http://www.wylsh.com', 'المهتدون الشيعة', 'المهتدون الشيعة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(243, 'تلفزيون طريق الحقيقة', 'http://www.truthway.tv', 'تلفزيون طريق الحقيقة', 'تلفزيون طريق الحقيقة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(244, 'الحدقة', 'http://www.islammemo.cc/cat1.aspx?id=633', 'الحدقة', 'الحدقة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(245, 'شبكة القلم الفكرية', 'http://www.alqlm.com', 'شبكة القلم الفكرية', 'شبكة القلم الفكرية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(246, 'كسر الصنم', 'http://www.kasralsanam.com', 'كسر الصنم', 'كسر الصنم', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(247, 'موقع الخرافة', 'http://www.khorafa.org', 'موقع الخرافة', 'موقع الخرافة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(248, 'الإسلام أم المسيحية', 'http://www.islamorchristianity.org', 'الإسلام أم المسيحية', 'الإسلام أم المسيحية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(249, 'صحوة الشيعة', 'http://www.newshia.com', 'صحوة الشيعة', 'صحوة الشيعة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(250, 'مقاطعة الدنمارك', 'http://www.no4denmark.com', 'مقاطعة الدنمارك', 'مقاطعة الدنمارك', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(251, 'موقع النور', 'http://www.noor4.com', 'موقع النور', 'موقع النور', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(252, 'الحقائق الخفية في مذهب الرافضة', 'http://64.187.100.19/sheah/index.htm', 'الحقائق الخفية في مذهب الرافضة', 'الحقائق الخفية في مذهب الرافضة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(253, 'الطريق إلى الله', 'http://www.allahway.com', 'الطريق إلى الله', 'الطريق إلى الله', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(254, 'سفهاء بلا حدود', 'http://www.sofaha.com', 'سفهاء بلا حدود', 'سفهاء بلا حدود', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(255, 'المنتدى الإسلامي الأروبي', 'http://www.almuntede.net', 'المنتدى الإسلامي الأروبي', 'المنتدى الإسلامي الأروبي', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(256, 'فخور كونى مسلم', 'http://www.proud2bemuslim.com', 'فخور كونى مسلم', 'فخور كونى مسلم', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(257, 'حزب الله والوعد الكاذب', 'http://moqawama.ws', 'حزب الله والوعد الكاذب', 'حزب الله والوعد الكاذب', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(258, 'إظهار الحق', 'http://www.edharalhaq.com', 'إظهار الحق', 'إظهار الحق', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(259, 'الموسوعة الميسرة فى الاديان والمذاهب', 'http://www.almwsoaa.com', 'الموسوعة الميسرة فى الاديان والمذاهب', 'الموسوعة الميسرة فى الاديان والمذاهب', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(260, 'الشبكة الاسلامية', 'http://arabic.islamicweb.com', 'الشبكة الاسلامية', 'الشبكة الاسلامية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(261, 'التحذير من خطر التنصير', 'http://www.tanseer.com', 'التحذير من خطر التنصير', 'التحذير من خطر التنصير', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(262, 'منظمة النصرة العالمية', 'http://www.nusrah.org', 'منظمة النصرة العالمية', 'منظمة النصرة العالمية', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(263, 'الجمعية السعودية لعلوم العقيدة', 'http://www.aqeeda.org.sa', 'الجمعية السعودية لعلوم العقيدة', 'الجمعية السعودية لعلوم العقيدة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(264, 'ماذا تعرف عن حزب الله', 'http://www.d-sunnah.net/hizballah', 'ماذا تعرف عن حزب الله', 'ماذا تعرف عن حزب الله', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(265, 'شبكة الدفاع عن السنة', 'http://www.d-sunnah.net', 'شبكة الدفاع عن السنة', 'شبكة الدفاع عن السنة', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(266, 'الإسلام و العالم', 'http://www.islamegy.com', 'الإسلام و العالم', 'الإسلام و العالم', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(267, 'نحن نحبك يا مسيح', 'http://www.loveujesus.com', 'نحن نحبك يا مسيح', 'نحن نحبك يا مسيح', '', '', '', 1, 5, 0, 0, 0, 1, '1211349338', 0, 0),
(268, 'مجلة البيان', 'http://www.albayan-magazine.com', 'مجلة البيان', 'مجلة البيان', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(269, 'مجلة الوعي الاسلامي', 'http://www.alwaei.com', 'مجلة الوعي الاسلامي', 'مجلة الوعي الاسلامي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(270, 'مجلة فلسطين المسلمة', 'http://www.fm-m.com', 'مجلة فلسطين المسلمة', 'مجلة فلسطين المسلمة', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(271, 'مجلة العصر', 'http://www.alasr.ws', 'مجلة العصر', 'مجلة العصر', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(272, 'مجلة الدعوة', 'http://www.aldaawah.com', 'مجلة الدعوة', 'مجلة الدعوة', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(273, 'مجلة الدرر الإسلامية', 'http://www.uae4ever.com/dorar/index.php', 'مجلة الدرر الإسلامية', 'مجلة الدرر الإسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(274, 'مجلة التوحيد', 'http://www.altawhed.com', 'مجلة التوحيد', 'مجلة التوحيد', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(275, 'مجلة التقوى', 'http://www.attakwa.net', 'مجلة التقوى', 'مجلة التقوى', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(276, 'مجلة رياض المتقين', 'http://www.almotaqeen.net', 'مجلة رياض المتقين', 'مجلة رياض المتقين', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(277, 'مجلة المجتمع', 'http://www.almujtamaa-mag.com', 'مجلة المجتمع', 'مجلة المجتمع', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(278, 'مجلة الفرقان', 'http://www.al-forqan.net', 'مجلة الفرقان', 'مجلة الفرقان', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(279, 'المجلة الإسلامية', 'http://www.ali4.com', 'المجلة الإسلامية', 'المجلة الإسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(280, 'شبكة قسايمة الإلكترونية', 'http://www.tech4islam.info', 'شبكة قسايمة الإلكترونية', 'شبكة قسايمة الإلكترونية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(281, 'مجلة المسلم المعاصر', 'http://www.biblioislam.net', 'مجلة المسلم المعاصر', 'مجلة المسلم المعاصر', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(282, 'مجلة الفسطاط', 'http://www.fustat.com', 'مجلة الفسطاط', 'مجلة الفسطاط', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(283, 'مجلة الراية', 'http://www.rayah.info', 'مجلة الراية', 'مجلة الراية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(284, 'مجلة همسات', 'http://www.khayma.com/hamasat', 'مجلة همسات', 'مجلة همسات', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(285, 'تسجيلات التقوى الاسلامية', 'http://www.altaqwa.com', 'تسجيلات التقوى الاسلامية', 'تسجيلات التقوى الاسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(286, 'دار القاسم للنشر والتوزيع', 'http://www.dar-alqassem.com', 'دار القاسم للنشر والتوزيع', 'دار القاسم للنشر والتوزيع', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(287, 'متجر دار البلاغ', 'http://www.daralbalagh.com', 'متجر دار البلاغ', 'متجر دار البلاغ', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(288, 'مدار الوطن للنشر والتوزيع', 'http://www.madar-alwatan.com', 'مدار الوطن للنشر والتوزيع', 'مدار الوطن للنشر والتوزيع', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(289, 'دار أطلس الخضراء للنشر والتوزيع', 'http://www.dar-atlas.com', 'دار أطلس الخضراء للنشر والتوزيع', 'دار أطلس الخضراء للنشر والتوزيع', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(290, 'دار الآثار للنشر والتوزيع', 'http://www.dar-alathar.com', 'دار الآثار للنشر والتوزيع', 'دار الآثار للنشر والتوزيع', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(291, 'مؤسسة الآفاق للإنتاج الإعلامي', 'http://www.afaaaq.com', 'مؤسسة الآفاق للإنتاج الإعلامي', 'مؤسسة الآفاق للإنتاج الإعلامي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(292, 'الصوت الإسلامي', 'http://www.islamcvoice.com/mas/index.php', 'الصوت الإسلامي', 'الصوت الإسلامي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(293, 'الآفاق للإنتاج الإعلامي', 'http://www.afaaaq.com', 'الآفاق للإنتاج الإعلامي', 'الآفاق للإنتاج الإعلامي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(294, 'مؤسسة اليقين الإسلامية', 'http://www.alyaqin.com', 'مؤسسة اليقين الإسلامية', 'مؤسسة اليقين الإسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(295, 'بيت الرسالة', 'http://www.alrisalh.com', 'بيت الرسالة', 'بيت الرسالة', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(296, 'تسجيلات القادسية الإسلامية', 'http://www.qimam.com', 'تسجيلات القادسية الإسلامية', 'تسجيلات القادسية الإسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(297, 'مركز اللواء للإنتاج الإعلامي', 'http://www.allewaa.org', 'مركز اللواء للإنتاج الإعلامي', 'مركز اللواء للإنتاج الإعلامي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(298, 'سوق النور', 'http://market.elnoor.com', 'سوق النور', 'سوق النور', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(299, 'الصوت الذهبي', 'http://www.alzahabi-sy.com', 'الصوت الذهبي', 'الصوت الذهبي', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(300, 'مجمع التسجيلات الإسلامية', 'http://www.mojama.net', 'مجمع التسجيلات الإسلامية', 'مجمع التسجيلات الإسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(301, 'تسجيلات ابن الخطاب الاسلامية', 'http://www.khattab.cc', 'تسجيلات ابن الخطاب الاسلامية', 'تسجيلات ابن الخطاب الاسلامية', '', '', '', 1, 6, 0, 0, 0, 1, '1211351211', 0, 0),
(302, 'الموسوعة الشاملة', 'http://islamport.com', 'الموسوعة الشاملة', 'الموسوعة الشاملة', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(303, 'مؤلفات الشيخ ابن باز', 'http://www.binbaz.org.sa/index.php?pg=more&type=book&no=1', 'مؤلفات الشيخ ابن باز', 'مؤلفات الشيخ ابن باز', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(304, 'مؤلفات الشيخ ابن عثيمين', 'http://www.ibnothaimeen.com/all/index/article_17097.shtml', 'مؤلفات الشيخ ابن عثيمين', 'مؤلفات الشيخ ابن عثيمين', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(305, 'كتب الشيخ محمد الدويش', 'http://www.almurabbi.com/book1.asp', 'كتب الشيخ محمد الدويش', 'كتب الشيخ محمد الدويش', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(306, 'دليل الكتب المجانية باللغات المختلفة', 'http://www.sultan.org/books', 'دليل الكتب المجانية باللغات المختلفة', 'دليل الكتب المجانية باللغات المختلفة', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(307, 'كتب من موقع شبكة الدعوة الاسلامية', 'http://www.aldawah.net/maktabah.htm', 'كتب من موقع شبكة الدعوة الاسلامية', 'كتب من موقع شبكة الدعوة الاسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(308, 'كتب الشيخ عبدالرحمن عبدالخالق', 'http://www.salafi.net/list.html', 'كتب الشيخ عبدالرحمن عبدالخالق', 'كتب الشيخ عبدالرحمن عبدالخالق', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(309, 'مشروع المكتبة الإسلامية الإلكترونية', 'http://arabic.islamicweb.com/Encyclopedia', 'مشروع المكتبة الإسلامية الإلكترونية', 'مشروع المكتبة الإسلامية الإلكترونية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(310, 'مقالات من موقع هداية الحيارى', 'http://www.khayma.com/hedaya/mk/index.html', 'مقالات من موقع هداية الحيارى', 'مقالات من موقع هداية الحيارى', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(311, 'كتب وأبحاث من موقع هداية الحيارى', 'http://www.khayma.com/hedaya/books/index.html', 'كتب وأبحاث من موقع هداية الحيارى', 'كتب وأبحاث من موقع هداية الحيارى', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(312, 'مؤلفات الشيخ محمد صالح المنجد', 'http://www.islam-qa.com/index.php?pg=articles&type=1&ln=ara', 'مؤلفات الشيخ محمد صالح المنجد', 'مؤلفات الشيخ محمد صالح المنجد', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(313, 'مكتبة السراج المنير الإسلامية', 'http://www.assiraj.bizland.com/library.htm', 'مكتبة السراج المنير الإسلامية', 'مكتبة السراج المنير الإسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(314, 'مقالات من موقع الشبكة السلفية', 'http://www.salafi.net/articles.html', 'مقالات من موقع الشبكة السلفية', 'مقالات من موقع الشبكة السلفية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(315, 'كتب من موقع الوراق', 'http://www.alwaraq.com', 'كتب من موقع الوراق', 'كتب من موقع الوراق', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(316, 'كتب من موقع شبكة سلسبيل', 'http://www.khayma.com/salsabeel/SAL/book.htm', 'كتب من موقع شبكة سلسبيل', 'كتب من موقع شبكة سلسبيل', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(317, 'كتب الشيخ حمود بن عقلاء الشعيبي', 'http://www.saaid.net/Warathah/hmood/index.htm', 'كتب الشيخ حمود بن عقلاء الشعيبي', 'كتب الشيخ حمود بن عقلاء الشعيبي', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(318, 'كتب من موقع الدرر السنية', 'http://www.dorar.net/book_list.php?book_type=2', 'كتب من موقع الدرر السنية', 'كتب من موقع الدرر السنية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(319, 'الموسوعة الفقهية', 'http://www.awkaf.net/mousoaa/index.html', 'الموسوعة الفقهية', 'الموسوعة الفقهية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(320, 'كتب من موقع جمعية البر بالرياض', 'http://www.albr.org/books', 'كتب من موقع جمعية البر بالرياض', 'كتب من موقع جمعية البر بالرياض', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(321, 'مكتبة صيد الفوائد الإسلامية', 'http://www.saaid.net/book/index.php', 'مكتبة صيد الفوائد الإسلامية', 'مكتبة صيد الفوائد الإسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(322, 'المكتبة الإلكترونية من اسلام اون لاين', 'http://www.biblioislam.net/Elibrary/Arabic/library/index.asp', 'المكتبة الإلكترونية من اسلام اون لاين', 'المكتبة الإلكترونية من اسلام اون لاين', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(323, 'كتب ومؤلفات الشيخ سلمان العودة', 'http://www.islamtoday.net/pen/books_content.cfm', 'كتب ومؤلفات الشيخ سلمان العودة', 'كتب ومؤلفات الشيخ سلمان العودة', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(324, 'خزانة الكتب والأبحاث', 'http://www.ahlalhdeeth.com/vb/forumdisplay.php?&forumid=16', 'خزانة الكتب والأبحاث', 'خزانة الكتب والأبحاث', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(325, 'مكتبة المدينة الرقمية', 'http://www.raqamiya.org', 'مكتبة المدينة الرقمية', 'مكتبة المدينة الرقمية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(326, 'أم الكتاب', 'http://www.omelketab.net', 'أم الكتاب', 'أم الكتاب', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(327, 'موقع كلمات للمطويات الإسلامية', 'http://www.kalemat.org', 'موقع كلمات للمطويات الإسلامية', 'موقع كلمات للمطويات الإسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(328, 'مشروع العشر الأخير', 'http://www.tafseer.info', 'مشروع العشر الأخير', 'مشروع العشر الأخير', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(329, 'منابع اسلامية', 'http://www.mislamih.com', 'منابع اسلامية', 'منابع اسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(330, 'المكتبة الإسلامية - إسلام سايتز', 'http://www.islamsites.net/books', 'المكتبة الإسلامية - إسلام سايتز', 'المكتبة الإسلامية - إسلام سايتز', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(331, 'الكتبة الوقفية للكتب الإسلامية', 'http://www.waqfeya.com', 'الكتبة الوقفية للكتب الإسلامية', 'الكتبة الوقفية للكتب الإسلامية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(332, 'المكتبة الوقفية', 'http://www.waqfeya.com', 'المكتبة الوقفية', 'المكتبة الوقفية', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(333, 'دار النوادر', 'http://www.daralnawader.com', 'دار النوادر', 'دار النوادر', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(334, 'مؤسسة صوت القلم العربي', 'http://www.3lsooot.com', 'مؤسسة صوت القلم العربي', 'مؤسسة صوت القلم العربي', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(335, 'المكتبة الشاملة', 'http://www.shamela.ws', 'المكتبة الشاملة', 'المكتبة الشاملة', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(336, 'مركز ودود للمخطوطات', 'http://www.wadod.com', 'مركز ودود للمخطوطات', 'مركز ودود للمخطوطات', '', '', '', 1, 7, 0, 0, 0, 1, '1211354777', 0, 0),
(337, 'فتاوى الشيخ ابن باز', 'http://www.binbaz.org.sa/index.php?pg=fatawa', 'فتاوى الشيخ ابن باز', 'فتاوى الشيخ ابن باز', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(338, 'الفتاوى - الشبكة السلفية', 'http://www.salafi.net/fatawa.htm', 'الفتاوى - الشبكة السلفية', 'الفتاوى - الشبكة السلفية', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(339, 'الفتاوى - موقع الإسلام', 'http://fatawa.al-islam.com/fatawa/default.asp', 'الفتاوى - موقع الإسلام', 'الفتاوى - موقع الإسلام', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(340, 'باحث الفتاوى', 'http://www.sultan.org/f', 'باحث الفتاوى', 'باحث الفتاوى', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(341, 'اسألوا أهل الذكر - إسلام أون لاين', 'http://www.islamonline.net/servlet/Satellite?cid=1121779389729&pagename=IslamOnline-Arabic-Ask_Scholar/Page/FatwaCounselA', 'اسألوا أهل الذكر - إسلام أون لاين', 'اسألوا أهل الذكر - إسلام أون لاين', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(342, 'فتاوى العلماء - موقع الرقية الشرعية', 'http://www.alroqia.com/fatawi_n/index.html', 'فتاوى العلماء - موقع الرقية الشرعية', 'فتاوى العلماء - موقع الرقية الشرعية', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(343, 'فتاوى من موقع الجبيل نت', 'http://fatawaweb.com', 'فتاوى من موقع الجبيل نت', 'فتاوى من موقع الجبيل نت', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(344, 'فتاوى من موقع الأوقاف الكويتيه', 'http://www.awkaf.net/haje-ftw/index.html', 'فتاوى من موقع الأوقاف الكويتيه', 'فتاوى من موقع الأوقاف الكويتيه', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(345, 'الفتوى بين يديك', 'http://www.al-eman.com/Ask', 'الفتوى بين يديك', 'الفتوى بين يديك', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(346, 'الفتاوى و الداراسات - الاسلام اليوم', 'http://www.islamtoday.net/questions/fatawa.cfm', 'الفتاوى و الداراسات - الاسلام اليوم', 'الفتاوى و الداراسات - الاسلام اليوم', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(347, 'ركن الأسد للفتاوى الشرعية', 'http://www.alasad.net/fatwa/index.php', 'ركن الأسد للفتاوى الشرعية', 'ركن الأسد للفتاوى الشرعية', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(348, 'دار الإفتاء المصرية', 'http://www.dar-alifta.org', 'دار الإفتاء المصرية', 'دار الإفتاء المصرية', '', '', '', 1, 8, 1, 0, 0, 1, '1211355874', 0, 0),
(349, 'فتاوى نور على الدرب', 'http://www.alandals.net', 'فتاوى نور على الدرب', 'فتاوى نور على الدرب', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(350, 'فتاوى الشيخ العثيمين', 'http://www.ibnothaimeen.com/all/Noor.shtml', 'فتاوى الشيخ العثيمين', 'فتاوى الشيخ العثيمين', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(351, 'مركز الفتوى - الشبكة الإسلامية', 'http://www.islamweb.net/ver2/Fatwa/index.php?', 'مركز الفتوى - الشبكة الإسلامية', 'مركز الفتوى - الشبكة الإسلامية', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(352, 'الاسلام سؤال وجواب للشيخ المنجد', 'http://www.islam-qa.com/index.php?ln=ara', 'الاسلام سؤال وجواب للشيخ المنجد', 'الاسلام سؤال وجواب للشيخ المنجد', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(353, 'موسوعة الفتاوى - طريق الإسلام', 'http://www.islamway.com/?iw_s=Fatawa', 'موسوعة الفتاوى - طريق الإسلام', 'موسوعة الفتاوى - طريق الإسلام', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(354, 'الفتاوى الكبرى لابن تيمية - موقع الإسلام', 'http://feqh.al-islam.com/bookhier.asp?DocID=27&Mode=0', 'الفتاوى الكبرى لابن تيمية - موقع الإسلام', 'الفتاوى الكبرى لابن تيمية - موقع الإسلام', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(355, 'فتاوى اون لاين', 'http://www.fatwa-online.com', 'فتاوى اون لاين', 'فتاوى اون لاين', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(356, 'الفتاوى الشرعية', 'http://www.islamic-fatwa.com', 'الفتاوى الشرعية', 'الفتاوى الشرعية', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(357, 'فتاوى القرآن الكريم', 'http://www.qurancomplex.org/qfatwa/tree.asp', 'فتاوى القرآن الكريم', 'فتاوى القرآن الكريم', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(358, 'فتاوى الطبيب المسلم', 'http://www.muslimdoctor.net/pages/arabic/Ar_fatawa.htm', 'فتاوى الطبيب المسلم', 'فتاوى الطبيب المسلم', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(359, 'الفتوى من موقع الشيخ حامد العلي', 'http://www.h-alali.net/f_index.php', 'الفتوى من موقع الشيخ حامد العلي', 'الفتوى من موقع الشيخ حامد العلي', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(360, 'الفتاوى الجامعة للمرأة المسلمة', 'http://alftawa.com', 'الفتاوى الجامعة للمرأة المسلمة', 'الفتاوى الجامعة للمرأة المسلمة', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(361, 'الرئاسة العامة للبحوث والافتاء', 'http://www.alifta.com', 'الرئاسة العامة للبحوث والافتاء', 'الرئاسة العامة للبحوث والافتاء', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(362, 'السكينة', 'http://www.asskeenh.com', 'السكينة', 'السكينة', '', '', '', 1, 8, 0, 0, 0, 1, '1211355874', 0, 0),
(363, 'دروس ومحاضرات الشيخ ابن باز', 'http://www.binbaz.org.sa/index.php?pg=audio', 'دروس ومحاضرات الشيخ ابن باز', 'دروس ومحاضرات الشيخ ابن باز', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(364, 'دوس ومحاضرات الشيخ ابن عثيمين', 'http://www.ibnothaimeen.com/all/eSound.shtml', 'دوس ومحاضرات الشيخ ابن عثيمين', 'دوس ومحاضرات الشيخ ابن عثيمين', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(365, 'موقع البث الإسلامي', 'http://www.liveislam.com', 'موقع البث الإسلامي', 'موقع البث الإسلامي', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(366, 'تسجيلات الشبكة الإسلامية', 'http://audio.islamweb.net/audio/index.php', 'تسجيلات الشبكة الإسلامية', 'تسجيلات الشبكة الإسلامية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(367, 'دروس وخطب - طريق الاسلام', 'http://www.islamway.com/?iw_s=Lesson', 'دروس وخطب - طريق الاسلام', 'دروس وخطب - طريق الاسلام', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(368, 'مكتبة إيماننا الصوتية', 'http://www.emanona.com/cat.php?catsmktba=50', 'مكتبة إيماننا الصوتية', 'مكتبة إيماننا الصوتية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(369, 'صوتيات من موقع الشيخ محمد الدويش', 'http://www.almurabbi.com/mainpage.asp?main_id=5', 'صوتيات من موقع الشيخ محمد الدويش', 'صوتيات من موقع الشيخ محمد الدويش', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(370, 'دروس من موقع الشبكة السلفية', 'http://www.salafi.net/audiotapes.html', 'دروس من موقع الشبكة السلفية', 'دروس من موقع الشبكة السلفية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(371, 'المكتبة الصوتية من نداء الإيمان', 'http://www.al-eman.com/Voice', 'المكتبة الصوتية من نداء الإيمان', 'المكتبة الصوتية من نداء الإيمان', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(372, 'مكتبة الشريط الإسلامي', 'http://www.uae4ever.com/audio', 'مكتبة الشريط الإسلامي', 'مكتبة الشريط الإسلامي', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(373, 'تسجيلات المشكاة الإسلامية', 'http://www.almeshkat.net/index.php?pg=audio_cat', 'تسجيلات المشكاة الإسلامية', 'تسجيلات المشكاة الإسلامية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(374, 'صوتيات نحن الإسلام', 'http://www.weislam.com/iv/cat.php?catsmktba=3', 'صوتيات نحن الإسلام', 'صوتيات نحن الإسلام', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(375, 'حلقات برنامج الفاروق - قناة المستقلة', 'http://www.al-sahabah.com/?album=1', 'حلقات برنامج الفاروق - قناة المستقلة', 'حلقات برنامج الفاروق - قناة المستقلة', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(376, 'صوتيات واحة المسك الإسلامية', 'http://www.soutiat.com', 'صوتيات واحة المسك الإسلامية', 'صوتيات واحة المسك الإسلامية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(377, 'صوتيات الإسلام للجميع', 'http://www.islam2all.com/sounds/sounds.php', 'صوتيات الإسلام للجميع', 'صوتيات الإسلام للجميع', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(378, 'شبكة عطر الإمارات الإسلامية', 'http://www.uae36r.com', 'شبكة عطر الإمارات الإسلامية', 'شبكة عطر الإمارات الإسلامية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(379, 'مملكة فتيات الإسلام الصوتية', 'http://www.ftiatislam.com', 'مملكة فتيات الإسلام الصوتية', 'مملكة فتيات الإسلام الصوتية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(380, 'صوتيات الصافنات الإسلامية', 'http://www.ftiatislam.com', 'صوتيات الصافنات الإسلامية', 'صوتيات الصافنات الإسلامية', '', '', '', 1, 9, 0, 0, 0, 1, '1211357782', 0, 0),
(381, 'موقع الاسلام', 'http://www.al-islam.com/arb', 'موقع الاسلام', 'موقع الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211404985', 0, 0),
(382, 'نداء الإيمان', 'http://www.al-eman.com', 'نداء الإيمان', 'نداء الإيمان', '', '', '', 1, 1, 0, 0, 0, 1, '1211404985', 0, 0),
(383, 'مفكرة الإسلام', 'http://www.islammemo.cc', 'مفكرة الإسلام', 'مفكرة الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(384, 'إسلام أون لاين', 'http://www.islam-online.net/Arabic/index.shtml', 'إسلام أون لاين', 'إسلام أون لاين', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(385, 'الشبكة الاسلامية', 'http://www.islamweb.net', 'الشبكة الاسلامية', 'الشبكة الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(386, 'طريق الاسلام', 'http://www.islamway.com', 'طريق الاسلام', 'طريق الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(387, 'موقع الحج والعمرة', 'http://www.tohajj.com', 'موقع الحج والعمرة', 'موقع الحج والعمرة', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(388, 'صيد الفوائد', 'http://www.saaid.net', 'صيد الفوائد', 'صيد الفوائد', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(389, 'البث الإسلامي', 'http://www.liveislam.net', 'البث الإسلامي', 'البث الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(390, 'طريق الإيمان', 'http://islamic.kuwaitchat.net', 'طريق الإيمان', 'طريق الإيمان', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(391, 'كلمات', 'http://www.kl28.com', 'كلمات', 'كلمات', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(392, 'مجموعة مواقع الإسلام', 'http://www.islam.ws', 'مجموعة مواقع الإسلام', 'مجموعة مواقع الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211406609', 0, 0),
(393, 'الصوت الإسلامي', 'http://www.islamcvoice.com', 'الصوت الإسلامي', 'الصوت الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211406853', 0, 0),
(394, 'رئاسة المسجد النبوي', 'http://www.wmn.gov.sa', 'رئاسة المسجد النبوي', 'رئاسة المسجد النبوي', '', '', '', 1, 72, 0, 0, 0, 1, '1211406853', 0, 0),
(395, 'رئاسة المسجد النبوي', 'http://www.wmn.gov.sa', 'رئاسة المسجد النبوي', 'رئاسة المسجد النبوي', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(396, 'موسوعة القصص الواقعية', 'http://www.gesah.net', 'موسوعة القصص الواقعية', 'موسوعة القصص الواقعية', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(397, 'قصص الأنبياء', 'http://www.alnoor-world.com/prophets', 'قصص الأنبياء', 'قصص الأنبياء', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(398, 'اذكر الله', 'http://www.khayma.com/uzkurallah/Frame/aFront.htm', 'اذكر الله', 'اذكر الله', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(399, 'دار الإسلام', 'http://www.islamhouse.com', 'دار الإسلام', 'دار الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(400, 'الرقية الشرعية', 'http://www.ruqya.net', 'الرقية الشرعية', 'الرقية الشرعية', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(401, 'طريق التوبة', 'http://www.twbh.com', 'طريق التوبة', 'طريق التوبة', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(402, 'موقع القصص', 'http://www.alqasas.com', 'موقع القصص', 'موقع القصص', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(403, 'موقع دعوة', 'http://www.d3wa.org', 'موقع دعوة', 'موقع دعوة', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(404, 'موقع رمضانيات', 'http://www.ramadan.ws', 'موقع رمضانيات', 'موقع رمضانيات', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(405, 'قبسات من حياة الرسول', 'http://www.alsiraj.net', 'قبسات من حياة الرسول', 'قبسات من حياة الرسول', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(406, 'قافلة الداعيات', 'http://www.gafelh.com', 'قافلة الداعيات', 'قافلة الداعيات', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(407, 'إمام المسجد', 'http://www.alimam.ws', 'إمام المسجد', 'إمام المسجد', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(408, 'الجوال الاسلامي', 'http://www.islamicmobile.net', 'الجوال الاسلامي', 'الجوال الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(409, 'قصة الاسلام', 'http://www.islamstory.com', 'قصة الاسلام', 'قصة الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(410, 'موقع المستشار', 'http://www.almostshar.com', 'موقع المستشار', 'موقع المستشار', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(411, 'اللباس الطبي الساتر', 'http://www.sater7.com', 'اللباس الطبي الساتر', 'اللباس الطبي الساتر', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(412, 'طريق الدعوة', 'http://tttt4.com', 'طريق الدعوة', 'طريق الدعوة', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(413, 'رسائل نت', 'http://www.rasael.net', 'رسائل نت', 'رسائل نت', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(414, 'منزلة المرأة في الإسلام', 'http://www.manzilat.net', 'منزلة المرأة في الإسلام', 'منزلة المرأة في الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211407737', 0, 0),
(415, 'شبكة مساجدنا الدعوية', 'http://www.msajedna.ps', 'شبكة مساجدنا الدعوية', 'شبكة مساجدنا الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(416, 'الدار الإسلامية للإعلام', 'http://www.iid-alraid.de', 'الدار الإسلامية للإعلام', 'الدار الإسلامية للإعلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(417, 'شبكة الإسلام للجميع', 'http://www.islam2all.com', 'شبكة الإسلام للجميع', 'شبكة الإسلام للجميع', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(418, 'الموسوعة الإسلامية الحرة', 'http://www.azizpedia.com', 'الموسوعة الإسلامية الحرة', 'الموسوعة الإسلامية الحرة', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(419, 'بوابة نور الله', 'http://www.nourallah.com', 'بوابة نور الله', 'بوابة نور الله', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(420, 'موقع العائدون الى الله', 'http://www.alaidon.com', 'موقع العائدون الى الله', 'موقع العائدون الى الله', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(421, 'موسوعة الاستشارات', 'http://www.istisharaat.com', 'موسوعة الاستشارات', 'موسوعة الاستشارات', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(422, 'المأذون الشرعي لعقود الأنكحة', 'http://www.mathoun.com', 'المأذون الشرعي لعقود الأنكحة', 'المأذون الشرعي لعقود الأنكحة', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(423, 'حجابي نجاتي', 'http://www.hijabi.net', 'حجابي نجاتي', 'حجابي نجاتي', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(424, 'موقع الصومعة الاسلامي', 'http://www.ssislam.com', 'موقع الصومعة الاسلامي', 'موقع الصومعة الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(425, 'جامع الفقه الاسلامي', 'http://feqh.al-islam.com', 'جامع الفقه الاسلامي', 'جامع الفقه الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(426, 'زكاة الأفراد', 'http://zakat.al-islam.com/arb', 'زكاة الأفراد', 'زكاة الأفراد', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(427, 'الحج والعمرة', 'http://hajj.al-islam.com/arb', 'الحج والعمرة', 'الحج والعمرة', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(428, 'القاموس الإسلامي', 'http://dictionary.al-islam.com/default.asp?t=ARBENG', 'القاموس الإسلامي', 'القاموس الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(429, 'التاريخ الإسلامي', 'http://history.al-islam.com', 'التاريخ الإسلامي', 'التاريخ الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(430, 'مواقيت الصلاة', 'http://prayer.al-islam.com/default.asp?l=Arb', 'مواقيت الصلاة', 'مواقيت الصلاة', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(431, 'منابر الدعوة', 'http://www.dawah.ws', 'منابر الدعوة', 'منابر الدعوة', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(432, 'جامع شيخ الاسلام ابن تيمية', 'http://www.taimiah.org', 'جامع شيخ الاسلام ابن تيمية', 'جامع شيخ الاسلام ابن تيمية', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(433, 'سلسبيل', 'http://www.khayma.com/salsabeel', 'سلسبيل', 'سلسبيل', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(434, 'نسيج الاسلامية', 'http://islamic.naseej.com', 'نسيج الاسلامية', 'نسيج الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211408228', 0, 0),
(435, 'موقع سيرة الصحابة', 'http://www.khayma.com/alsahaba', 'موقع سيرة الصحابة', 'موقع سيرة الصحابة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(436, 'اخطاء يقع فيها المسلمين', 'http://www.khayma.com/akhtaa', 'اخطاء يقع فيها المسلمين', 'اخطاء يقع فيها المسلمين', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(437, 'مواقع اسلامية بالإنجليزية', 'http://sultan.org', 'مواقع اسلامية بالإنجليزية', 'مواقع اسلامية بالإنجليزية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(438, 'سواك المسلم', 'http://www.sewak.com', 'سواك المسلم', 'سواك المسلم', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(439, 'مركز المدينة لدرسات الاستشراق', 'http://www.madinacenter.com', 'مركز المدينة لدرسات الاستشراق', 'مركز المدينة لدرسات الاستشراق', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(440, 'المرشد الاسلامي', 'http://www.khayma.com/almurshed/index.htm', 'المرشد الاسلامي', 'المرشد الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(441, 'المحدث', 'http://www.muhaddith.org/a_index.html', 'المحدث', 'المحدث', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(442, 'الاربعين النووية', 'http://www.elafco.com/nwa-1.htm', 'الاربعين النووية', 'الاربعين النووية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(443, 'اوقات الصلاة', 'http://prayer.naseej.com/World_A.asp', 'اوقات الصلاة', 'اوقات الصلاة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(444, 'شبكة النوادر الإسلامية', 'http://www.sohari.com', 'شبكة النوادر الإسلامية', 'شبكة النوادر الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(445, 'شبكة الشمس العربية', 'http://www.khayma.com/asn', 'شبكة الشمس العربية', 'شبكة الشمس العربية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(446, 'الشئون الاسلامية بالكويت', 'http://www.awkaf.net', 'الشئون الاسلامية بالكويت', 'الشئون الاسلامية بالكويت', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(447, 'أعمال القلوب والسلوك والأخلاق', 'http://www.heartsactions.com', 'أعمال القلوب والسلوك والأخلاق', 'أعمال القلوب والسلوك والأخلاق', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(448, 'موقع الموت', 'http://www.almawt.com', 'موقع الموت', 'موقع الموت', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(449, 'المنتدى الاسلامي بالشارقة', 'http://www.muntada.org.ae', 'المنتدى الاسلامي بالشارقة', 'المنتدى الاسلامي بالشارقة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(450, 'المخطوطات والمكتبات الإسلامية', 'http://www.mild-kw.net', 'المخطوطات والمكتبات الإسلامية', 'المخطوطات والمكتبات الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(451, 'المنظمة الاسلامية للعلوم الطبية', 'http://www.islamset.com/arabic', 'المنظمة الاسلامية للعلوم الطبية', 'المنظمة الاسلامية للعلوم الطبية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(452, 'رسالة الإسلام', 'http://www.islammessage.com', 'رسالة الإسلام', 'رسالة الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(453, 'موقع المشكاة', 'http://www.meshkat.net', 'موقع المشكاة', 'موقع المشكاة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(454, 'التجمع الإسلامي في أمريكا', 'http://iananet.org/arabic', 'التجمع الإسلامي في أمريكا', 'التجمع الإسلامي في أمريكا', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(455, 'موقع الكلمة الطيبة', 'http://www.altyba.com', 'موقع الكلمة الطيبة', 'موقع الكلمة الطيبة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(456, 'حامل المسك', 'http://www.asiri.net', 'حامل المسك', 'حامل المسك', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(457, 'عالم الشباب', 'http://www.youthworlds.com', 'عالم الشباب', 'عالم الشباب', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(458, 'منبر الأمة الإسلامية للدراسات والبحوث', 'http://al-ommah.org', 'منبر الأمة الإسلامية للدراسات والبحوث', 'منبر الأمة الإسلامية للدراسات والبحوث', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(459, 'الباحث الإسلامي للمواقع والمواقيت', 'http://www.islamicfinder.org', 'الباحث الإسلامي للمواقع والمواقيت', 'الباحث الإسلامي للمواقع والمواقيت', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(460, 'دليل البحوث الإسلامية', 'http://www.khayma.com/wahbi', 'دليل البحوث الإسلامية', 'دليل البحوث الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(461, 'الكتاب الإسلامي', 'http://www.khayma.com/islambook', 'الكتاب الإسلامي', 'الكتاب الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(462, 'جامع على بن المديني', 'http://www.masjeed.org', 'جامع على بن المديني', 'جامع على بن المديني', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(463, 'موقع حي الشهداء بالمدينة', 'http://www.khayma.com/shuhada', 'موقع حي الشهداء بالمدينة', 'موقع حي الشهداء بالمدينة', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(464, 'الإسلام الحق', 'http://www.islamunveiled.org', 'الإسلام الحق', 'الإسلام الحق', '', '', '', 1, 1, 0, 0, 0, 1, '1211409019', 0, 0),
(465, 'الأزهر والمؤسسات الدينية بمصر', 'http://www.alazhr.org', 'الأزهر والمؤسسات الدينية بمصر', 'الأزهر والمؤسسات الدينية بمصر', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(466, 'الشرح الفقهي المصور', 'http://www.saaid.net/rasael/r39.htm', 'الشرح الفقهي المصور', 'الشرح الفقهي المصور', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(467, 'موقع المأوى', 'http://www.almawa.net', 'موقع المأوى', 'موقع المأوى', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(468, 'الحج خطوة خطوة', 'http://www.tohajj.com/data/steps/hajj-steps.htm', 'الحج خطوة خطوة', 'الحج خطوة خطوة', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(469, 'موقع الجنة', 'http://www.jannah.com', 'موقع الجنة', 'موقع الجنة', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(470, 'حلوان للحج و العمرة', 'http://www.halwanhaj.co.ae', 'حلوان للحج و العمرة', 'حلوان للحج و العمرة', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(471, 'دار الإيمان', 'http://www.daraleiman.com', 'دار الإيمان', 'دار الإيمان', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(472, 'موقع فناتق', 'http://www.fanateq.com', 'موقع فناتق', 'موقع فناتق', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(473, 'شبكة الأسد نت', 'http://www.alasad.net', 'شبكة الأسد نت', 'شبكة الأسد نت', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(474, 'أرض الشرق', 'http://www.ardalsharq.com', 'أرض الشرق', 'أرض الشرق', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(475, 'التقويم الهجري', 'http://ceri.kacst.edu.sa/calendar.htm', 'التقويم الهجري', 'التقويم الهجري', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(476, 'المنتدى الاسلامي العالمي للحوار', 'http://dialogueonline.org', 'المنتدى الاسلامي العالمي للحوار', 'المنتدى الاسلامي العالمي للحوار', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(477, 'مباشر رياض المسك', 'http://www.almisk.net/AdsImgs/radio.htm', 'مباشر رياض المسك', 'مباشر رياض المسك', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(478, 'مفكرة بلال الإسلامية', 'http://www.bilal-prayer.com/default_a.asp', 'مفكرة بلال الإسلامية', 'مفكرة بلال الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(479, 'المنسيون', 'http://www.almansiuon.com', 'المنسيون', 'المنسيون', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(480, 'البحوث الإسلامية والدعوة في الفلبين', 'http://www.iscag.org', 'البحوث الإسلامية والدعوة في الفلبين', 'البحوث الإسلامية والدعوة في الفلبين', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(481, 'موقع مسلمات', 'http://www.muslimat.net', 'موقع مسلمات', 'موقع مسلمات', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(482, 'مؤتمر العمل الإسلامي', 'http://www.islamicwork.info', 'مؤتمر العمل الإسلامي', 'مؤتمر العمل الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(483, 'شبكة أهل السنة الإسلامية', 'http://www.asunnah.net', 'شبكة أهل السنة الإسلامية', 'شبكة أهل السنة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(484, 'شبكة الدعوة الإسلامية', 'http://www.aldawah.net', 'شبكة الدعوة الإسلامية', 'شبكة الدعوة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(485, 'واحة المسك', 'http://www.soutiat.com', 'واحة المسك', 'واحة المسك', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(486, 'جنازة', 'http://www.janazh.com', 'جنازة', 'جنازة', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(487, 'زاد الداعي', 'http://www.islamdoor.com/k', 'زاد الداعي', 'زاد الداعي', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(488, 'كشف الشبهات', 'http://www.khayma.com/kshf', 'كشف الشبهات', 'كشف الشبهات', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(489, 'شبكة نورين الإسلامية', 'http://www.norayn.com', 'شبكة نورين الإسلامية', 'شبكة نورين الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(490, 'موقع المسك', 'http://www.almisk.net', 'موقع المسك', 'موقع المسك', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(491, 'موقع العودة الإسلامي', 'http://www.almojahed.info', 'موقع العودة الإسلامي', 'موقع العودة الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(492, 'أبحاث فقه المعاملات الإسلامية', 'http://kantakji.org', 'أبحاث فقه المعاملات الإسلامية', 'أبحاث فقه المعاملات الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(493, 'موقع داعي', 'http://www.da3y.org', 'موقع داعي', 'موقع داعي', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(494, 'أسماء الله الحسنى', 'http://www.deentimes.com', 'أسماء الله الحسنى', 'أسماء الله الحسنى', '', '', '', 1, 1, 0, 0, 0, 1, '1211410425', 0, 0),
(495, 'جامع الأمير سلمان بجدة', 'http://www.salman1.com', 'جامع الأمير سلمان بجدة', 'جامع الأمير سلمان بجدة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(496, 'اللجنة الثقافية بجمعية حائل', 'http://www.hailclce.com', 'اللجنة الثقافية بجمعية حائل', 'اللجنة الثقافية بجمعية حائل', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(497, 'شبكة المنهاج الإسلامية', 'http://www.almenhaj.net', 'شبكة المنهاج الإسلامية', 'شبكة المنهاج الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(498, 'عيون الإسلام', 'http://www.3ss3.com', 'عيون الإسلام', 'عيون الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(499, 'الكلم الطيب', 'http://www.islamword.com', 'الكلم الطيب', 'الكلم الطيب', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(500, 'الاسلام سؤال وجواب', 'http://www.islamqa.com', 'موقع العمل للإسلام', 'موقع العمل للإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(501, 'أنصار السنة', 'http://www.elsonna.com', 'أنصار السنة', 'أنصار السنة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(502, 'موقع إسلامي', 'http://www.islamme.com', 'موقع إسلامي', 'موقع إسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(503, 'شبكة القمة الاسلامية', 'http://www.go2top.net', 'شبكة القمة الاسلامية', 'شبكة القمة الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(504, 'شبكة الدرر الدعوية', 'http://www.aldorarnet.com', 'شبكة الدرر الدعوية', 'شبكة الدرر الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(505, 'شبكة ظهران الدعوية', 'http://www.dahran.net', 'شبكة ظهران الدعوية', 'شبكة ظهران الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(506, 'رسول الإسلام', 'http://www.islam-prophet.com', 'رسول الإسلام', 'رسول الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(507, 'المفكرة الدعوية', 'http://www.dawahmemo.com', 'المفكرة الدعوية', 'المفكرة الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(508, 'الدين النصيحة', 'http://www.islamadvice.com', 'الدين النصيحة', 'الدين النصيحة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(509, 'يا له من دين', 'http://www.denana.com', 'يا له من دين', 'يا له من دين', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(510, 'الصحابة', 'http://www.al-sahabah.com', 'الصحابة', 'الصحابة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(511, 'موقع التاريخ الاسلامي', 'http://www.islamichistory.net', 'موقع التاريخ الاسلامي', 'موقع التاريخ الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(512, 'شبكة هاجس الإسلامية', 'http://www.hajs.net', 'شبكة هاجس الإسلامية', 'شبكة هاجس الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(513, 'شبكة الإسلام', 'http://www.elislam.net', 'شبكة الإسلام', 'شبكة الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(514, 'ابن الإسلام', 'http://www.ibnalislam.com', 'ابن الإسلام', 'ابن الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(515, 'الأكاديمية الإسلامية المفتوحة', 'http://www.islamacademy.net', 'الأكاديمية الإسلامية المفتوحة', 'الأكاديمية الإسلامية المفتوحة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(516, 'موقع مكة الشامل', 'http://www.maccah.com', 'موقع مكة الشامل', 'موقع مكة الشامل', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(517, 'آل البيت', 'http://www.alalbayt.com', 'آل البيت', 'آل البيت', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(518, 'فقه الصيام', 'http://www.nawafith.net/feqh', 'فقه الصيام', 'فقه الصيام', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(519, 'رمضان مشاعر وشعائر', 'http://www.islameiat.com/ramadan', 'رمضان مشاعر وشعائر', 'رمضان مشاعر وشعائر', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(520, 'صوت الايمان', 'http://www.imanvoice.com', 'صوت الايمان', 'صوت الايمان', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(521, 'طريق الجنة', 'http://www.aljannahway.com', 'طريق الجنة', 'طريق الجنة', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(522, 'جامع العز بن عبدالسلام بالخرج', 'http://www.al-3z.net', 'جامع العز بن عبدالسلام بالخرج', 'جامع العز بن عبدالسلام بالخرج', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(523, 'مسلمون', 'http://www.muslemoon.net', 'مسلمون', 'مسلمون', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(524, 'لبيك أفريقيا', 'http://www.labaik-africa.org', 'لبيك أفريقيا', 'لبيك أفريقيا', '', '', '', 1, 1, 0, 0, 0, 1, '1211411486', 0, 0),
(525, 'الأفكار الدعوية', 'http://www.alafkar.org', 'الأفكار الدعوية', 'الأفكار الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(526, 'علم المواريث', 'http://www.moarith.com', 'علم المواريث', 'علم المواريث', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(527, 'حصاد القلم', 'http://www.hasaad.net', 'حصاد القلم', 'حصاد القلم', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(528, 'أوراق إيمانية', 'http://www.awrak.com', 'أوراق إيمانية', 'أوراق إيمانية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(529, 'الدعاة إلى العلم النافع', 'http://www.du3at.com', 'الدعاة إلى العلم النافع', 'الدعاة إلى العلم النافع', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(530, 'مفكرة الدعاه', 'http://www.aldoah.com', 'مفكرة الدعاه', 'مفكرة الدعاه', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(531, 'المسك الأذفر', 'http://www.athfer.com', 'المسك الأذفر', 'المسك الأذفر', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(532, 'شبكة شباب السنة', 'http://www.al-sunna.net', 'شبكة شباب السنة', 'شبكة شباب السنة', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(533, 'شبكة المعالي الإسلامية', 'http://www.ma3ali.net', 'شبكة المعالي الإسلامية', 'شبكة المعالي الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(534, 'شبكة عين الإسلام', 'http://www.eyeislam.net', 'شبكة عين الإسلام', 'شبكة عين الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(535, 'التوابون', 'http://www.tawabon.com', 'التوابون', 'التوابون', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(536, 'الدنيا الفانية', 'http://www.zzrz.com', 'الدنيا الفانية', 'الدنيا الفانية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(537, 'موقع الروضة الإسلامي', 'http://www.al-rawdah.net', 'موقع الروضة الإسلامي', 'موقع الروضة الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(538, 'شبكة مشكاة الإسلامية', 'http://www.almeshkat.net', 'شبكة مشكاة الإسلامية', 'شبكة مشكاة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(539, 'موقع نوف عبدالله لخدمة الإسلام', 'http://nouf.org', 'موقع نوف عبدالله لخدمة الإسلام', 'موقع نوف عبدالله لخدمة الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(540, 'الفلاش الإسلامي', 'http://www.islamic-flash.com', 'الفلاش الإسلامي', 'الفلاش الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(541, 'وسيط الخير', 'http://www.wseeet.com', 'وسيط الخير', 'وسيط الخير', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(542, 'موقع مواسم النور', 'http://www.mwasim.com', 'موقع مواسم النور', 'موقع مواسم النور', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(543, 'الرسول وآل البيت', 'http://www.aalalbait.com', 'الرسول وآل البيت', 'الرسول وآل البيت', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(544, 'استبدلني', 'http://www.istbdlne.com', 'استبدلني', 'استبدلني', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(545, 'المراكز الصيفية', 'http://www.dawahmemo.com/mrkz', 'المراكز الصيفية', 'المراكز الصيفية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(546, 'الشيخ الشاعر حفيظ بن عجب الدوسري', 'http://www.hafedh.net', 'الشيخ الشاعر حفيظ بن عجب الدوسري', 'الشيخ الشاعر حفيظ بن عجب الدوسري', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(547, 'موقع المحراب الدعوي', 'http://www.almehrab.ws', 'موقع المحراب الدعوي', 'موقع المحراب الدعوي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(548, 'أرض افريقيا', 'http://africaland.net', 'أرض افريقيا', 'أرض افريقيا', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(549, 'التربية النبوية', 'http://www.propheteducation.com', 'التربية النبوية', 'التربية النبوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(550, 'رسائلي القصيرة', 'http://huda76-sms.blogspot.com', 'رسائلي القصيرة', 'رسائلي القصيرة', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(551, 'الإسلام العتيق', 'http://www.islamancient.net', 'الإسلام العتيق', 'الإسلام العتيق', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(552, 'بوابة النصح الإسلامي', 'http://www.nos7.com', 'بوابة النصح الإسلامي', 'بوابة النصح الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(553, 'موقع وذكر', 'http://www.wathakker.com', 'موقع وذكر', 'موقع وذكر', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(554, 'غزة الحرة الإسلامية', 'http://www.free-gaza.com', 'غزة الحرة الإسلامية', 'غزة الحرة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412398', 0, 0),
(555, 'حياتي بلا أغاني', 'http://www.no4songs.com', 'حياتي بلا أغاني', 'حياتي بلا أغاني', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(556, 'موقع وقفنا', 'http://www.waqfuna.com', 'موقع وقفنا', 'موقع وقفنا', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(557, 'موقع دعوة', 'http://www.khayma.com/da3wah', 'موقع دعوة', 'موقع دعوة', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(558, 'البرنامج العالمي للتعريف بنبي الرحمة', 'http://www.mercyprophet.com', 'البرنامج العالمي للتعريف بنبي الرحمة', 'البرنامج العالمي للتعريف بنبي الرحمة', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(559, 'الدكتور عدنان باحارث للتربية الإسلامية', 'http://www.bahareth.org', 'الدكتور عدنان باحارث للتربية الإسلامية', 'الدكتور عدنان باحارث للتربية الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(560, 'نسايم الإيمان', 'http://www.nsaaym.com', 'نسايم الإيمان', 'نسايم الإيمان', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(561, 'شبكة الرفقة الصالحة', 'http://www.refqh.com', 'شبكة الرفقة الصالحة', 'شبكة الرفقة الصالحة', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(562, 'موقع شباب الدعوي', 'http://www.shbdw.com', 'موقع شباب الدعوي', 'موقع شباب الدعوي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(563, 'شبكة إيماننا الإسلامية', 'http://www.emanona.com', 'شبكة إيماننا الإسلامية', 'شبكة إيماننا الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(564, 'شبكة الفلاش الإسلامي', 'http://www.islamic-flash.net', 'شبكة الفلاش الإسلامي', 'شبكة الفلاش الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211412836', 0, 0),
(565, 'موقع البينة', 'http://www.bayyna.com', 'موقع البينة', 'موقع البينة', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(566, 'منشور - للمنشورات الدعوية', 'http://www.mnshoor.com', 'منشور - للمنشورات الدعوية', 'منشور - للمنشورات الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(567, 'موقع دعوتها', 'http://www.wdawah.com', 'موقع دعوتها', 'موقع دعوتها', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(568, 'شبكة المعرفة الإسلامية', 'http://www.almarfah.com', 'شبكة المعرفة الإسلامية', 'شبكة المعرفة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(569, 'الهدى للإسلاميات', 'http://www.elhooda.com', 'الهدى للإسلاميات', 'الهدى للإسلاميات', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(570, 'جامعة دار العلوم لاهل السنة ف&#1740; ا&#1740;ران', 'http://www.sunnionline.net', 'جامعة دار العلوم لاهل السنة ف&#1740; ا&#1740;ران', 'جامعة دار العلوم لاهل السنة ف&#1740; ا&#1740;ران', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(571, 'ابن الإسلام للمراسلات الدعوية', 'http://www.moraslat.com', 'ابن الإسلام للمراسلات الدعوية', 'ابن الإسلام للمراسلات الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(572, 'واحة المسلم', 'http://www.al-wa7a.com', 'واحة المسلم', 'واحة المسلم', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(573, 'الموبيل الاسلامى', 'http://www.islamicmob.org', 'الموبيل الاسلامى', 'الموبيل الاسلامى', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(574, 'جماعة الاعتصام بالكتاب والسنة', 'http://www.al-etsam.com', 'جماعة الاعتصام بالكتاب والسنة', 'جماعة الاعتصام بالكتاب والسنة', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(575, 'مملكة الاسلام', 'http://www.mislam.net', 'مملكة الاسلام', 'مملكة الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(576, 'بيت المسلم', 'http://www.merkaz.info', 'بيت المسلم', 'بيت المسلم', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(577, 'حب الإسلام', 'http://www.islam-love.com', 'حب الإسلام', 'حب الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(578, 'صوت الحق', 'http://www.soutulhaq.com', 'صوت الحق', 'صوت الحق', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(579, 'موقع الصحوة الإلكترونية', 'http://www.esahwa.com', 'موقع الصحوة الإلكترونية', 'موقع الصحوة الإلكترونية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(580, 'المكتبة الإسلامية', 'http://a-adil.com/mktba/index.php', 'المكتبة الإسلامية', 'المكتبة الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(581, 'شبكة دعوي الإسلامية', 'http://www.d3we.com', 'شبكة دعوي الإسلامية', 'شبكة دعوي الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(582, 'شبكة يارحمن الاسلامية', 'http://www.yarhman.com', 'شبكة يارحمن الاسلامية', 'شبكة يارحمن الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(583, 'الصحبة الصالحة', 'http://www.asso7ba.com', 'الصحبة الصالحة', 'الصحبة الصالحة', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(584, 'إلى الإسلام', 'http://www.toislamy.com', 'إلى الإسلام', 'إلى الإسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211413407', 0, 0),
(585, 'شبكة دعوة الاسلامية', 'http://www.daawaah.com', 'شبكة دعوة الاسلامية', 'شبكة دعوة الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(586, 'موقع الاستقامة', 'http://www.al-mishkat.com/istiqama', 'موقع الاستقامة', 'موقع الاستقامة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(587, 'موقع الرساله', 'http://www.alrisaalah.com', 'موقع الرساله', 'موقع الرساله', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(588, 'موقع الفضيلة', 'http://www.alfadeelh.com', 'موقع الفضيلة', 'موقع الفضيلة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(589, 'مسابقة الأسرة العلمية الكبرى', 'http://www.alosrah.net', 'مسابقة الأسرة العلمية الكبرى', 'مسابقة الأسرة العلمية الكبرى', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(590, 'دليل مختصر مصور لفهم الإسلام (E)', 'http://www.islam-guide.com', 'دليل مختصر مصور لفهم الإسلام (E)', 'دليل مختصر مصور لفهم الإسلام (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(591, 'مركز البحوث الإسلامية (E)', 'http://www.irf.net', 'مركز البحوث الإسلامية (E)', 'مركز البحوث الإسلامية (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(592, 'موقع ارض الإسلام (E)', 'http://www.islamland.org', 'موقع ارض الإسلام (E)', 'موقع ارض الإسلام (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(593, 'اكتشف الإسلام (E)', 'http://www.discoverislam.com', 'اكتشف الإسلام (E)', 'اكتشف الإسلام (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(594, 'مساجد حول العالم (E)', 'http://www.islam.org/Culture/MOSQUES', 'مساجد حول العالم (E)', 'مساجد حول العالم (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(595, 'فتاوى اون لاين (E)', 'http://www.fatwa-online.com', 'فتاوى اون لاين (E)', 'فتاوى اون لاين (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(596, 'موقع السنة (E)', 'http://www.al-sunnah.com', 'موقع السنة (E)', 'موقع السنة (E)', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(597, 'كلمات الدعاة', 'http://kalimataldoah.net', 'كلمات الدعاة', 'كلمات الدعاة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(598, 'موقع الاسلام والمسلمين', 'http://www.muslem.info/muslem', 'موقع الاسلام والمسلمين', 'موقع الاسلام والمسلمين', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(599, 'موقع ذكرى الإسلامي', 'http://www.thekra.ws', 'موقع ذكرى الإسلامي', 'موقع ذكرى الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(600, 'شبكة إسلامك', 'http://www.islam4m.com', 'شبكة إسلامك', 'شبكة إسلامك', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(601, 'شبكة الفجر الصادق', 'http://www.n7n9.com', 'شبكة الفجر الصادق', 'شبكة الفجر الصادق', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(602, 'تونس المسلمة', 'http://www.tunisalmoslima.com', 'تونس المسلمة', 'تونس المسلمة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(603, 'عالم التطوع العربي', 'http://www.arabvolunteering.org', 'عالم التطوع العربي', 'عالم التطوع العربي', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(604, 'موقع طالب العلم', 'http://www.talebal3elm.com', 'موقع طالب العلم', 'موقع طالب العلم', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(605, 'الحضارة الاسلامية في مدينة بخارى', 'http://www.al-bukhari.net', 'الحضارة الاسلامية في مدينة بخارى', 'الحضارة الاسلامية في مدينة بخارى', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(606, 'موقع حلقات', 'http://www.halqat.com', 'موقع حلقات', 'موقع حلقات', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(607, 'محمد رسول الله', 'http://www.rasoulallah.net', 'محمد رسول الله', 'محمد رسول الله', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(608, 'شبكة ذكريات الاسلامية', 'http://www.zkryat.com', 'شبكة ذكريات الاسلامية', 'شبكة ذكريات الاسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(609, 'الهمس للوسائط الدعوية', 'http://www.alhams.net', 'الهمس للوسائط الدعوية', 'الهمس للوسائط الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(610, 'لواء الشريعة', 'http://www.shareah.com', 'لواء الشريعة', 'لواء الشريعة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(611, 'شبكة أنوار مكة الأسلامية', 'http://www.anwarmaka.net', 'شبكة أنوار مكة الأسلامية', 'شبكة أنوار مكة الأسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(612, 'نبي الرحمة', 'http://www.nabialrahma.com', 'نبي الرحمة', 'نبي الرحمة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(613, 'لواء الشريعة', 'http://www.shareah.com', 'لواء الشريعة', 'لواء الشريعة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(614, 'البصائر', 'http://albsayer.net', 'البصائر', 'البصائر', '', '', '', 1, 1, 0, 0, 0, 1, '1211414259', 0, 0),
(615, 'الآمرون بالمعروف والناهون عن المنكر', 'http://www.alameron.com', 'الآمرون بالمعروف والناهون عن المنكر', 'الآمرون بالمعروف والناهون عن المنكر', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(616, 'نور الاسلام', 'http://www.nooralislam.net', 'نور الاسلام', 'نور الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(617, 'طريق الحقيقة', 'http://www.factway.net', 'طريق الحقيقة', 'طريق الحقيقة', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(618, 'أروع القصص الواقعية', 'http://www.ade2006.jeeran.com', 'أروع القصص الواقعية', 'أروع القصص الواقعية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(619, 'مدونة شباب الاسلام', 'http://shabab-alislam.blogspot.com', 'مدونة شباب الاسلام', 'مدونة شباب الاسلام', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(620, 'برنامج إلى صلاتى', 'http://www.ela-salaty.com', 'برنامج إلى صلاتى', 'برنامج إلى صلاتى', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(621, 'نور على الدرب', 'http://www.al-darb.com', 'نور على الدرب', 'نور على الدرب', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(622, 'اليوتيوب الإسلامي', 'http://www.isyoutube.com', 'اليوتيوب الإسلامي', 'اليوتيوب الإسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(623, 'شبكة المرابط الدعوية', 'http://www.morabt.com', 'شبكة المرابط الدعوية', 'شبكة المرابط الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(624, 'شبكة العلوم الإسلامية', 'http://www.islamicsc.com', 'شبكة العلوم الإسلامية', 'شبكة العلوم الإسلامية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414485', 0, 0),
(625, 'الرسائل الدعوية', 'http://www.alrsael.net', 'الرسائل الدعوية', 'الرسائل الدعوية', '', '', '', 1, 1, 0, 0, 0, 1, '1211414598', 0, 0),
(626, 'رئاسة الحرمين الشريفين', 'http://gph.gov.sa', 'رئاسة الحرمين الشريفين', 'رئاسة الحرمين الشريفين', '', '', '', 1, 1, 0, 0, 0, 1, '1211414598', 0, 0),
(627, 'مكتبة الشيخ عبد الله المحمود', 'http://almahmood.ae', 'مكتبة الشيخ عبد الله المحمود', 'مكتبة الشيخ عبد الله المحمود', '', '', '', 1, 1, 0, 0, 0, 1, '1211414598', 0, 0),
(628, 'الحجاب الاسلامي', 'http://hijab.3rbu.net', 'الحجاب الاسلامي', 'الحجاب الاسلامي', '', '', '', 1, 1, 0, 0, 0, 1, '1211414598', 0, 0),
(645, 'موقع انساب', 'http://www.ansab-online.com', 'موقع انساب', 'موقع انساب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(646, 'قبيلة مطير', 'http://www.mutair-net.com', 'قبيلة مطير', 'قبيلة مطير', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(647, 'قبيلة شمر', 'http://www.shammar.org', 'قبيلة شمر', 'قبيلة شمر', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(648, 'قبيلة بلي', 'http://www.bluwe.com', 'قبيلة بلي', 'قبيلة بلي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(649, 'قبيلة العوازم', 'http://www.alawazm.com', 'قبيلة العوازم', 'قبيلة العوازم', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(650, 'قبيلة مزينة', 'http://www.mozinh.com', 'قبيلة مزينة', 'قبيلة مزينة', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(651, 'اسرة باوزير', 'http://www.bawazir.com', 'اسرة باوزير', 'اسرة باوزير', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(652, 'أسرة المديفر', 'http://www.almudaifer.net', 'أسرة المديفر', 'أسرة المديفر', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(653, 'موقع قبيلة زعب', 'http://www.zaub.com', 'موقع قبيلة زعب', 'موقع قبيلة زعب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(654, 'بني مالك الماضي والحاضر', 'http://www.banimalk.com', 'بني مالك الماضي والحاضر', 'بني مالك الماضي والحاضر', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(655, 'قبيلة حرب', 'http://www.harb-net.com', 'قبيلة حرب', 'قبيلة حرب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(656, 'شبكة قبيلة عتيبة', 'http://www.otaibah.net', 'شبكة قبيلة عتيبة', 'شبكة قبيلة عتيبة', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(657, 'قبيلة غامد', 'http://www.ghamid.net', 'قبيلة غامد', 'قبيلة غامد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(658, 'قبيلة بني هزان', 'http://www.banyhezzan.com', 'قبيلة بني هزان', 'قبيلة بني هزان', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(659, 'قبيلة الحويطات', 'http://www.alhowaitat.com', 'قبيلة الحويطات', 'قبيلة الحويطات', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(660, 'قبائل نجران', 'http://www.najran.cc', 'قبائل نجران', 'قبائل نجران', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(661, 'قبيلة بني خالد', 'http://www.banikhaled.com', 'قبيلة بني خالد', 'قبيلة بني خالد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(662, 'شبكة قبيلة الظفير', 'http://www.aldhfeer.com', 'شبكة قبيلة الظفير', 'شبكة قبيلة الظفير', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(663, 'قبيلة الوافي', 'http://www.alwafi.org', 'قبيلة الوافي', 'قبيلة الوافي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(664, 'أسرة الأحيدب', 'http://www.alahaideb.org', 'أسرة الأحيدب', 'أسرة الأحيدب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(665, 'قبيلة بني هاجر', 'http://www.alhwajr.com', 'قبيلة بني هاجر', 'قبيلة بني هاجر', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(666, 'عائلة المنيع', 'http://www.almanea.net', 'عائلة المنيع', 'عائلة المنيع', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(667, 'قبيلة الفضول', 'http://www.alfothool.com', 'قبيلة الفضول', 'قبيلة الفضول', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(668, 'أسرة قزاز', 'http://www.gazzaz.net', 'أسرة قزاز', 'أسرة قزاز', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(669, 'بني تميم', 'http://www.banitamim.net', 'بني تميم', 'بني تميم', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(670, 'عائلة آل الشيخ مبارك', 'http://www.almubarak.org', 'عائلة آل الشيخ مبارك', 'عائلة آل الشيخ مبارك', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(671, 'قبيلة العجمان', 'http://www.alajman.net', 'قبيلة العجمان', 'قبيلة العجمان', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(672, 'الأشراف السليمانيون في الحجاز', 'http://www.al-sulymani.com', 'الأشراف السليمانيون في الحجاز', 'الأشراف السليمانيون في الحجاز', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(673, 'قبيلة بني عطية', 'http://www.alatawi.net', 'قبيلة بني عطية', 'قبيلة بني عطية', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(674, 'قبيلة بني الحارث', 'http://www.harthi.org', 'قبيلة بني الحارث', 'قبيلة بني الحارث', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(675, 'قبيلة بني زيد', 'http://www.banyzaid.net', 'قبيلة بني زيد', 'قبيلة بني زيد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(676, 'قبيلة المنيعات من بني تميم', 'http://www.almnay3at.net', 'قبيلة المنيعات من بني تميم', 'قبيلة المنيعات من بني تميم', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(677, 'أسرة الخليوي', 'http://www.alkheliwi.com', 'أسرة الخليوي', 'أسرة الخليوي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(678, 'قبيلة بني كعب', 'http://www.alkaabi.org', 'قبيلة بني كعب', 'قبيلة بني كعب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(679, 'فخذ البتلة من قبيلة الحجيلي', 'http://www.alhojaili.net', 'فخذ البتلة من قبيلة الحجيلي', 'فخذ البتلة من قبيلة الحجيلي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(680, 'قبيلة الأنصار البصاديين', 'http://www.ansar.info', 'قبيلة الأنصار البصاديين', 'قبيلة الأنصار البصاديين', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(681, 'القبائل العربية بأزواد', 'http://www.azawade.jeeran.com', 'القبائل العربية بأزواد', 'القبائل العربية بأزواد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(682, 'قبيلة آل بوعينين', 'http://www.al-buainain.com', 'قبيلة آل بوعينين', 'قبيلة آل بوعينين', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(683, 'بلاد ثمالة', 'http://www.thomala.com', 'بلاد ثمالة', 'بلاد ثمالة', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(684, 'عائلة الراشد', 'http://www.alrashidweb.com', 'عائلة الراشد', 'عائلة الراشد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(685, 'قبيلة أكلب', 'http://www.aklob.com', 'قبيلة أكلب', 'قبيلة أكلب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(686, 'موقع عائلة السوافيري', 'http://www.sawafiri.net', 'موقع عائلة السوافيري', 'موقع عائلة السوافيري', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(687, 'قبيلة عليان', 'http://3lyan.com', 'قبيلة عليان', 'قبيلة عليان', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(688, 'أسرة آل قويفل', 'http://www.qwaifel.com', 'أسرة آل قويفل', 'أسرة آل قويفل', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(689, 'أسرة العمران', 'http://www.alomran.info', 'أسرة العمران', 'أسرة العمران', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(690, 'أسرة الفوزان', 'http://www.alfouzan.net', 'أسرة الفوزان', 'أسرة الفوزان', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(691, 'عائلة السنيد', 'http://www.alsunaid.net', 'عائلة السنيد', 'عائلة السنيد', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(692, 'قبيلة المغيرة', 'http://www.almogheerah.org', 'قبيلة المغيرة', 'قبيلة المغيرة', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(693, 'قبائل العرب', 'http://qabayl.com', 'قبائل العرب', 'قبائل العرب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(694, 'عائلة الدريويش', 'http://www.al-driweesh.net', 'عائلة الدريويش', 'عائلة الدريويش', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(695, 'قبيلة الشلاوى', 'http://www.alshalawa.com', 'قبيلة الشلاوى', 'قبيلة الشلاوى', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(696, 'مقالات في التاريخ والأنساب', 'http://www.mkalat.com', 'مقالات في التاريخ والأنساب', 'مقالات في التاريخ والأنساب', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(697, 'قبيلة بني لحيان', 'http://www.lahyan.com', 'قبيلة بني لحيان', 'قبيلة بني لحيان', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(698, 'اسرة الثميري', 'http://www.althumairy.com', 'اسرة الثميري', 'اسرة الثميري', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(699, 'قبيلة آل الشواط', 'http://www.shwaati.com', 'قبيلة آل الشواط', 'قبيلة آل الشواط', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(700, 'موقع آل ياغي', 'http://www.yaghi.ps', 'موقع آل ياغي', 'موقع آل ياغي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(701, 'عائلة آل عتي', 'http://www.alotay.com', 'عائلة آل عتي', 'عائلة آل عتي', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(702, 'أسرة آل ملحم', 'http://www.almulhem.net', 'أسرة آل ملحم', 'أسرة آل ملحم', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(703, 'قبيلة الكبسه', 'http://www.al-kubaisi.net', 'قبيلة الكبسه', 'قبيلة الكبسه', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(704, 'قبيلة القبابنة من سبيع', 'http://www.al-qbabnh.com', 'قبيلة القبابنة من سبيع', 'قبيلة القبابنة من سبيع', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(705, 'قبيلة فهم', 'http://www.fham.net', 'قبيلة فهم', 'قبيلة فهم', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(706, 'قبائل شهران العريضة', 'http://www.shahran.com', 'قبائل شهران العريضة', 'قبائل شهران العريضة', '', '', '', 1, 71, 0, 0, 0, 1, '1213258445', 0, 0),
(707, 'التخدير - Medmark links', 'http://www.medmark.org/anes/', 'التخدير - Medmark links', 'التخدير - Medmark links', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(708, 'Basic Sciences Medical', 'http://www.medmatrix.org/_Spages/basic_sciences.asp#Examination_Skills', 'Basic Sciences Medical', 'Basic Sciences Medical', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(709, 'Gray', 'http://www.bartleby.com/107', 'Gray', 'Gray', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(710, 'حكيم - طلاب الطب بجامعة دمشق', 'http://www.hakeem-sy.com', 'حكيم - طلاب الطب بجامعة دمشق', 'حكيم - طلاب الطب بجامعة دمشق', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(711, 'Global Cardiology Network', 'http://www.globalcardiology.org', 'Global Cardiology Network', 'Global Cardiology Network', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(712, 'أمراض القلب Cardiology', 'http://www.medmark.org/car', 'أمراض القلب Cardiology', 'أمراض القلب Cardiology', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(713, 'جراحة قلب وصدر Cardiothoracic Surgery', 'http://www.medmark.org/chest', 'جراحة قلب وصدر Cardiothoracic Surgery', 'جراحة قلب وصدر Cardiothoracic Surgery', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(714, 'موقع داء السكري', 'http://www.diabetes-edu.com', 'موقع داء السكري', 'موقع داء السكري', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(715, 'مركز معلومات الصرع', 'http://www.epilepsyinarabic.com', 'مركز معلومات الصرع', 'مركز معلومات الصرع', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(716, 'مركز الشلل الدماغي التشنجي', 'http://cerebralpalsy.wustl.edu/arabic/index.htm', 'مركز الشلل الدماغي التشنجي', 'مركز الشلل الدماغي التشنجي', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(717, 'مركز شلل الضفيرة العضدية', 'http://brachialplexus.wustl.edu/arabic/index.htm', 'مركز شلل الضفيرة العضدية', 'مركز شلل الضفيرة العضدية', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(718, 'معا ضد مرض السرطان', 'http://www.alamal.info', 'معا ضد مرض السرطان', 'معا ضد مرض السرطان', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(719, 'موقع الدكتور ضياء لأمراض الروماتيزم', 'http://www.drdia.com', 'موقع الدكتور ضياء لأمراض الروماتيزم', 'موقع الدكتور ضياء لأمراض الروماتيزم', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(720, 'العلوم العصبية عبرالانترنت', 'http://www.neuroguide.com', 'العلوم العصبية عبرالانترنت', 'العلوم العصبية عبرالانترنت', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(721, 'الدماغ', 'http://www.brain.com', 'الدماغ', 'الدماغ', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(722, 'القلب', 'http://sln.fi.edu/biosci/heart.html', 'القلب', 'القلب', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(723, 'My Medline', 'http://www.mymedline.com/medline', 'My Medline', 'My Medline', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(724, 'Society of General Internal Medici', 'http://www.sgim.org', 'Society of General Internal Medici', 'Society of General Internal Medici', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(725, 'Internal Medicine Journals', 'http://www.medbioworld.com/med/journals/internal.html', 'Internal Medicine Journals', 'Internal Medicine Journals', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(726, 'MRCP', 'http://www.mrcpuk.org', 'MRCP', 'MRCP', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(727, 'الطب الباطني', 'http://www.acponline.org', 'الطب الباطني', 'الطب الباطني', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(728, 'كل ما يتعلق بمرض السكر', 'http://diabetes.ly', 'كل ما يتعلق بمرض السكر', 'كل ما يتعلق بمرض السكر', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(729, 'الجلدية Dermatology', 'http://www.medmark.org/derm', 'الجلدية Dermatology', 'الجلدية Dermatology', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(730, 'عيادات أدمة', 'http://www.adamaclinics.com', 'عيادات أدمة', 'عيادات أدمة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(731, 'الدكتور محمود حجازي', 'http://www.drmhijazy.com', 'الدكتور محمود حجازي', 'الدكتور محمود حجازي', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(732, 'جمعية الأطباء الكويتية للأسنان', 'http://www.schooloralhealthkw.com', 'جمعية الأطباء الكويتية للأسنان', 'جمعية الأطباء الكويتية للأسنان', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0),
(733, 'LINKS OF INTEREST IN DENTISTRY', 'http://www.il-st-acad-sci.org/health/dental.html', 'LINKS OF INTEREST IN DENTISTRY', 'LINKS OF INTEREST IN DENTISTRY', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(734, 'عيادات الحركان لطب الاسنان', 'http://www.harkandental.com', 'عيادات الحركان لطب الاسنان', 'عيادات الحركان لطب الاسنان', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0),
(735, 'المركز التقني لتقويم الأسنان', 'http://www.dr-ghamian.net', 'المركز التقني لتقويم الأسنان', 'المركز التقني لتقويم الأسنان', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0),
(736, 'أسنانك نت', 'http://www.asnanak.net', 'أسنانك نت', 'أسنانك نت', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0),
(737, 'أسنانك', 'http://www.asnanaka.com', 'أسنانك', 'أسنانك', '', '', '', 1, 45, 0, 0, 0, 1, '1213263963', 0, 0),
(738, 'Primary Care Internet Guide', 'http://www.uib.no/isf/guide/family.htm', 'Primary Care Internet Guide', 'Primary Care Internet Guide', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(739, 'طب الأسرة والمجتمع', 'http://www.medmark.org/family', 'طب الأسرة والمجتمع', 'طب الأسرة والمجتمع', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(740, 'لجنة مكافحة التدخين بالمدينة', 'http://www.masc.med.sa', 'لجنة مكافحة التدخين بالمدينة', 'لجنة مكافحة التدخين بالمدينة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(741, 'الأطفال ذوي الإحتياجات الخاصة', 'http://www.dr-soby.com', 'الأطفال ذوي الإحتياجات الخاصة', 'الأطفال ذوي الإحتياجات الخاصة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(742, 'البرمجة اللغوية العصبية', 'http://www.nlpnote.com', 'البرمجة اللغوية العصبية', 'البرمجة اللغوية العصبية', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(743, 'الطبيب المسلم', 'http://www.muslimdoctor.org', 'الطبيب المسلم', 'الطبيب المسلم', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(744, 'الجمعية السعودية لطب الأسرة', 'http://www.ssfcm.org', 'الجمعية السعودية لطب الأسرة', 'الجمعية السعودية لطب الأسرة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(745, 'طبيب دوت كوم', 'http://www.6abib.com', 'طبيب دوت كوم', 'طبيب دوت كوم', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(746, 'قياس ومتابعة ضغط الدم والسكري', 'http://www.salamat.org.sa', 'قياس ومتابعة ضغط الدم والسكري', 'قياس ومتابعة ضغط الدم والسكري', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(747, 'موسوعة صحتي الطبية', 'http://www.9haty.com', 'موسوعة صحتي الطبية', 'موسوعة صحتي الطبية', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(748, 'شبكة اللجان الطبية', 'http://www.medicalcom.net', 'شبكة اللجان الطبية', 'شبكة اللجان الطبية', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(749, 'مكافحة السمنة والنحافة', 'http://www.arabobesity.com', 'مكافحة السمنة والنحافة', 'مكافحة السمنة والنحافة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(750, 'مدونة التدخين', 'http://kady.ektob.com', 'مدونة التدخين', 'مدونة التدخين', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(751, 'مركز الدكتور نظمي لطب الأسرة', 'http://www.drnazmi.com', 'مركز الدكتور نظمي لطب الأسرة', 'مركز الدكتور نظمي لطب الأسرة', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(752, 'موقع الدكتور محمد العتيق', 'http://dralateeq.com', 'موقع الدكتور محمد العتيق', 'موقع الدكتور محمد العتيق', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(753, 'الغدد الصماء Endocrinology', 'http://www.medmark.org/endo', 'الغدد الصماء Endocrinology', 'الغدد الصماء Endocrinology', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(754, 'انف واذن وحنجرة', 'http://www.utmb.edu/oto', 'انف واذن وحنجرة', 'انف واذن وحنجرة', '', '', '', 1, 50, 0, 0, 0, 2, '1213263963', 0, 0),
(755, 'جراحة عامة General Surgery', 'http://www.medmark.org/general', 'جراحة عامة General Surgery', 'جراحة عامة General Surgery', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(756, 'الجهاز الهضمي Gastroenterology', 'http://www.medmark.org/gastro', 'الجهاز الهضمي Gastroenterology', 'الجهاز الهضمي Gastroenterology', '', '', '', 1, 50, 0, 0, 0, 1, '1213263963', 0, 0),
(757, 'المناعة Immunology', 'http://www.medmark.org/imm', 'المناعة Immunology', 'المناعة Immunology', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(758, 'أمراض الدم Hematology', 'http://www.medmark.org/hem', 'أمراض الدم Hematology', 'أمراض الدم Hematology', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(759, 'طب المختبر وعلم الأمراض', 'http://www.medmark.org/path/', 'طب المختبر وعلم الأمراض', 'طب المختبر وعلم الأمراض', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(760, 'مختبرات العرب', 'http://www.arabslab.com', 'مختبرات العرب', 'مختبرات العرب', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(761, 'أمراض الإنتان Infectious Diseases', 'http://www.medmark.org/inf', 'أمراض الإنتان Infectious Diseases', 'أمراض الإنتان Infectious Diseases', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(762, 'Medical ethics in Islam', 'http://www.islamicmedicine.org/ethics.htm', 'Medical ethics in Islam', 'Medical ethics in Islam', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(763, 'حكم الإسلام في قضايا طبية', 'http://www.islamicmedicine.org/views.htm', 'حكم الإسلام في قضايا طبية', 'حكم الإسلام في قضايا طبية', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(764, 'Biomedical & Health Ethics Resources', 'http://www.ethics.ubc.ca/resources/biomed', 'Biomedical & Health Ethics Resources', 'Biomedical & Health Ethics Resources', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(765, 'Medical Education Resourse', 'http://www.meducation.com/index.html', 'Medical Education Resourse', 'Medical Education Resourse', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(766, 'MedicalConferences.com', 'http://www.medicalconferences.com', 'MedicalConferences.com', 'MedicalConferences.com', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(767, 'MedicalStudent.com', 'http://www.medicalstudent.com', 'MedicalStudent.com', 'MedicalStudent.com', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(768, 'مسك للعلوم الطبية', 'http://newmsk.jeeran.com', 'مسك للعلوم الطبية', 'مسك للعلوم الطبية', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(769, 'شبكة أطباء مصر', 'http://www.egydoctors.net', 'شبكة أطباء مصر', 'شبكة أطباء مصر', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(770, 'الموقع الطبي الاستشاري السوري', 'http://www.e-smc.net', 'الموقع الطبي الاستشاري السوري', 'الموقع الطبي الاستشاري السوري', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(771, 'كلية طب الأسنان بجامعة قناة السويس', 'http://www.scudent.com', 'كلية طب الأسنان بجامعة قناة السويس', 'كلية طب الأسنان بجامعة قناة السويس', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(772, 'الأمراض العصبية Neurology/Neuroscience', 'http://www.medmark.org/neuro', 'الأمراض العصبية Neurology/Neuroscience', 'الأمراض العصبية Neurology/Neuroscience', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(773, 'Links to Neurology', 'http://www.uku.fi/neuro/links2.htm', 'Links to Neurology', 'Links to Neurology', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(774, 'علم النفس العصبي', 'http://www.bafree.net/arabneuropsych', 'علم النفس العصبي', 'علم النفس العصبي', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(775, 'أمراض الكلى Nephrology', 'http://www.medmark.org/neph', 'أمراض الكلى Nephrology', 'أمراض الكلى Nephrology', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(776, 'مركز زراعة الكلي والبنكرياس', 'http://www.kidney-transplant.org.sa', 'مركز زراعة الكلي والبنكرياس', 'مركز زراعة الكلي والبنكرياس', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(777, 'Links to Neurology', 'http://www.uku.fi/neuro/links2.htm', 'Links to Neurology', 'Links to Neurology', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(778, 'جراحة عصبية Neurosurgery', 'http://www.medmark.org/ns', 'جراحة عصبية Neurosurgery', 'جراحة عصبية Neurosurgery', '', '', '', 1, 50, 0, 0, 0, 1, '1213264638', 0, 0),
(779, 'Medmark links', 'http://www.medmark.org/obgy', 'Medmark links', 'Medmark links', '', '', '', 1, 46, 0, 0, 0, 1, '1213291474', 0, 0),
(780, 'طبيبي لأمراض النساء والولادة', 'http://www.tabeebe.com', 'طبيبي لأمراض النساء والولادة', 'طبيبي لأمراض النساء والولادة', '', '', '', 1, 46, 0, 0, 0, 1, '1213291474', 0, 0),
(781, 'خصوبة دوت كوم', 'http://www.khosoba.com', 'خصوبة دوت كوم', 'خصوبة دوت كوم', '', '', '', 1, 46, 0, 0, 0, 1, '1213291474', 0, 0),
(782, 'الدكتور نجيب ليوس', 'http://www.layyous.com', 'الدكتور نجيب ليوس', 'الدكتور نجيب ليوس', '', '', '', 1, 46, 0, 0, 0, 1, '1213291474', 0, 0),
(783, 'الدكتور سمير عربي كاتبي', 'http://www.drkatbi.com', 'الدكتور سمير عربي كاتبي', 'الدكتور سمير عربي كاتبي', '', '', '', 1, 46, 0, 0, 0, 1, '1213291474', 0, 0),
(784, 'طب الأورام Oncology', 'http://www.medmark.org/onco', 'طب الأورام Oncology', 'طب الأورام Oncology', '', '', '', 1, 50, 0, 0, 0, 1, '1213291474', 0, 0),
(785, 'جمعية آدم لسرطان الطفولة', 'http://www.adamcs.org', 'جمعية آدم لسرطان الطفولة', 'جمعية آدم لسرطان الطفولة', '', '', '', 1, 50, 0, 0, 0, 1, '1213291474', 0, 0),
(786, 'اطلس طب العيون', 'http://www.eyeatlas.com', 'اطلس طب العيون', 'اطلس طب العيون', '', '', '', 1, 50, 0, 0, 0, 2, '1213291474', 0, 0),
(787, 'Welcome to CLSA', 'http://www.clsa.info/index.shtml', 'Welcome to CLSA', 'Welcome to CLSA', '', '', '', 1, 50, 0, 0, 0, 1, '1213291474', 0, 0),
(788, 'Wilmer Eye Institute Home Page', 'http://www.wilmer.jhu.edu', 'Wilmer Eye Institute Home Page', 'Wilmer Eye Institute Home Page', '', '', '', 1, 50, 0, 0, 0, 1, '1213291474', 0, 0),
(797, 'ملتقي اهل الحديث', 'http://www.ahlalhdeeth.com/vb/index.php', 'ملتقي اهل الحديث', 'ملتقي اهل الحديث', '', '', '', 1, 52, 0, 0, 0, 1, '1213716979', 0, 0),
(798, 'ملتقي أهل التفسير', 'http://www.tafsir.org/vb/', 'ملتقي أهل التفسير', 'ملتقي أهل التفسير', '', '', '', 1, 52, 0, 0, 0, 1, '1213716979', 0, 0),
(799, 'منتديات بيت الفقه', 'http://www.alfeqh.com/montda/', 'منتديات بيت الفقه', 'منتديات بيت الفقه', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(800, 'منتديات رنيم للحوار', 'http://www.raneem.net/', 'منتديات رنيم للحوار', 'منتديات رنيم للحوار', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(801, 'منتدي الكلمة الطيبه', 'http://gesah.net/vb/vb/index.php', 'منتدي الكلمة الطيبه', 'منتدي الكلمة الطيبه', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(802, 'منتديات فناتق', 'http://talk.fanateq.com/vb/', 'منتديات فناتق', 'منتديات فناتق', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(803, 'منتدي الخير للرقيةالشرعية', 'http://www.roqyah.com/', 'منتدي الخير للرقيةالشرعية', 'منتدي الخير للرقيةالشرعية', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(804, 'منتديات الصوت الاسلامي', 'http://www.islamcvoice.com/vb/', 'منتديات الصوت الاسلامي', 'منتديات الصوت الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(805, 'منتديات بيت حواء', 'http://www.hawahome.com/vb/', 'منتديات بيت حواء', 'منتديات بيت حواء', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(806, 'منتديات شبكة التبيان', 'http://www.altebyan.net/vb/', 'منتديات شبكة التبيان', 'منتديات شبكة التبيان', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(807, 'منتديات لها اون لاين', 'http://forum.lahaonline.com/', 'منتديات لها اون لاين', 'منتديات لها اون لاين', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(808, 'منتدي سفينة النصح', 'http://www.nos7.com/vb/', 'منتدي سفينة النصح', 'منتدي سفينة النصح', '', '', '', 1, 52, 0, 0, 0, 1, '1213719250', 0, 0),
(809, 'منتدي المعالي', 'http://', 'منتدي المعالي', 'منتدي المعالي', '', '', '', 1, 0, 0, 0, 0, 0, '1213719250', 0, 0),
(810, 'منتديات بيت الفقه', 'http://www.alfeqh.com/montda/', 'منتديات بيت الفقه', 'منتديات بيت الفقه', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(811, 'منتديات رنيم للحوار', 'http://www.raneem.net/', 'منتديات رنيم للحوار', 'منتديات رنيم للحوار', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(812, 'منتدي الكلمة الطيبه', 'http://gesah.net/vb/vb/index.php', 'منتدي الكلمة الطيبه', 'منتدي الكلمة الطيبه', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(813, 'منتديات فناتق', 'http://talk.fanateq.com/vb/', 'منتديات فناتق', 'منتديات فناتق', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(814, 'منتدي الخير للرقيةالشرعية', 'http://www.roqyah.com/', 'منتدي الخير للرقيةالشرعية', 'منتدي الخير للرقيةالشرعية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(815, 'منتديات الصوت الاسلامي', 'http://www.islamcvoice.com/vb/', 'منتديات الصوت الاسلامي', 'منتديات الصوت الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(816, 'منتديات بيت حواء', 'http://www.hawahome.com/vb/', 'منتديات بيت حواء', 'منتديات بيت حواء', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(817, 'منتديات شبكة التبيان', 'http://www.altebyan.net/vb/', 'منتديات شبكة التبيان', 'منتديات شبكة التبيان', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(818, 'منتديات لها اون لاين', 'http://forum.lahaonline.com/', 'منتديات لها اون لاين', 'منتديات لها اون لاين', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(819, 'منتدي سفينة النصح', 'http://www.nos7.com/vb/', 'منتدي سفينة النصح', 'منتدي سفينة النصح', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(820, 'منتدي المعالي', 'http://www.forum.ma3ali.net/', 'منتدي المعالي', 'منتدي المعالي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(821, 'منتدي الفتاوي الشرعية', 'http://www.ftawa.ws/fw/', 'منتدي الفتاوي الشرعية', 'منتدي الفتاوي الشرعية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(822, 'منتديات عشاق الجنان', 'http://www.ao0oa.com/vb/', 'منتديات عشاق الجنان', 'منتديات عشاق الجنان', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(823, 'منتدي قاف لخدمة القران', 'http://www.qaaaf.com/Forums/', 'منتدي قاف لخدمة القران', 'منتدي قاف لخدمة القران', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(824, 'منتدي عبق الرياحين النسائية', 'http://www.3abaq.com/3abaq/', 'منتدي عبق الرياحين النسائية', 'منتدي عبق الرياحين النسائية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(825, 'منتدي لجنة التعريف بالإسلام', 'http://www.ipc-kw.com/vb/', 'منتدي لجنة التعريف بالإسلام', 'منتدي لجنة التعريف بالإسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(826, 'ملتقي طلاب الجامعة الاسلامية', 'http://eejaz.jackotec.com/suspended.page/', 'ملتقي طلاب الجامعة الاسلامية', 'ملتقي طلاب الجامعة الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(827, 'منتدي لصافنات الإسلامي', 'http://safynat.com/vb/', 'منتدي لصافنات الإسلامي', 'منتدي لصافنات الإسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(828, 'منتديات وجهة الإسلامي', 'http://www.wejhah.com/vb/', 'منتديات وجهة الإسلامي', 'منتديات وجهة الإسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(829, 'منتديات افاق', 'http://afaek.com/forum/', 'منتديات افاق', 'منتديات افاق', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(830, 'منتدي لألئ الايمان', 'http://www.quranonline.us/women/', 'منتدي لألئ الايمان', 'منتدي لألئ الايمان', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(831, 'منتديات المشتاقين الدعوي', 'http://al-moshtaqeen.com/vb/index.php', 'منتديات المشتاقين الدعوي', 'منتديات المشتاقين الدعوي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(832, 'منتديات قوارب النجاة', 'http://www.gwarb.com/vb/', 'منتديات قوارب النجاة', 'منتديات قوارب النجاة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(833, 'منتديات قراء طيبة الطيبة', 'http://www.qurrataiba.com/vb/', 'منتديات قراء طيبة الطيبة', 'منتديات قراء طيبة الطيبة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(834, 'منتديات الراية الإسلامية', 'http://www.al-raih.com/vb/', 'منتديات الراية الإسلامية', 'منتديات الراية الإسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(835, 'منتديات عطر الامارات الاسلامية', 'http://www.uae36r.com/vb/', 'منتديات عطر الامارات الاسلامية', 'منتديات عطر الامارات الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(836, 'منتديات مفكرة الدعاة', 'http://www.aldoah.com/upload/index.php', 'منتديات مفكرة الدعاة', 'منتديات مفكرة الدعاة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(837, 'منتديات التقوي الاسلامية', 'http://www.altqwa.com/', 'منتديات التقوي الاسلامية', 'منتديات التقوي الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(838, 'منتديات الحسبة', 'http://www.hisbah.net/vb', 'منتديات الحسبة', 'منتديات الحسبة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(839, 'ملتقي البيان في تفسير القران', 'http://www.bayan-alquran.net/forums/', 'ملتقي البيان في تفسير القران', 'ملتقي البيان في تفسير القران', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(840, 'منتديات طالب العلم', 'http://www.talebal3elm.com/vb/', 'منتديات طالب العلم', 'منتديات طالب العلم', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(841, 'منتدي الطريق الي الجنة', 'http://www.ganahway.com/gana/index.php', 'منتدي الطريق الي الجنة', 'منتدي الطريق الي الجنة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(842, 'منتدي الداعيات الي الخير', 'http://alda3yat.net/montada/', 'منتدي الداعيات الي الخير', 'منتدي الداعيات الي الخير', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(843, 'منتدي صوت الصاقنات', 'http://safynat.com/vb/', 'منتدي صوت الصاقنات', 'منتدي صوت الصاقنات', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(844, 'منتديات فرسان الاسلام', 'http://www.forsanoalislam.net/vb/', 'منتديات فرسان الاسلام', 'منتديات فرسان الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(845, 'منتديات فجر الاسلام', 'http://www.rfqa.com/', 'منتديات فجر الاسلام', 'منتديات فجر الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(846, 'ملتقي كلمات', 'http://www.kl28.com/forums/', 'ملتقي كلمات', 'ملتقي كلمات', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(847, 'منتدي القارئ هاني الرفاعي', 'http://www.alrfaey.org/vb/', 'منتدي القارئ هاني الرفاعي', 'منتدي القارئ هاني الرفاعي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(848, 'منتديات الإعتصام للنشيد ولإسلامي', 'http://www.i3tesam.com/forums/', 'منتديات الإعتصام للنشيد ولإسلامي', 'منتديات الإعتصام للنشيد ولإسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(849, 'منتديات الصارم المسلول', 'http://www.alsarm.com/vb/', 'منتديات الصارم المسلول', 'منتديات الصارم المسلول', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(850, 'منتديات السلف الصالح الاسلامية', 'http://salfcom.com/vb/', 'منتديات السلف الصالح الاسلامية', 'منتديات السلف الصالح الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(851, 'منتدي الرسالة', 'http://alrisaalah.com/vb/', 'منتدي الرسالة', 'منتدي الرسالة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(852, 'منتدي ممرات الإنشادية', 'http://www.mm11mm.com/vb/', 'منتدي ممرات الإنشادية', 'منتدي ممرات الإنشادية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(853, 'منتدي لا تحزن', 'http://www.islambl.com/vb/', 'منتدي لا تحزن', 'منتدي لا تحزن', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(854, 'منتدي جمعية تحفيظ القران  بالطائف', 'http://www.comqt.org/vb/', 'منتدي جمعية تحفيظ القران  بالطائف', 'منتدي جمعية تحفيظ القران  بالطائف', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(855, 'منتدي طريق الحقيقة', 'http://www.factway.net/vb/', 'منتدي طريق الحقيقة', 'منتدي طريق الحقيقة', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(856, 'منتديات الكلم الطيب', 'http://al-klem.net/vb/', 'منتديات الكلم الطيب', 'منتديات الكلم الطيب', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(857, 'ملتقي طلاب العلم', 'http://www.salahmera.com/vb/', 'ملتقي طلاب العلم', 'ملتقي طلاب العلم', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(858, 'منتدي الحياه الاسلامي', 'http://el7yaah.com/vb/', 'منتدي الحياه الاسلامي', 'منتدي الحياه الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(859, 'ساحة المقاومة الاسلامية', 'http://www.palir.net/vb/', 'ساحة المقاومة الاسلامية', 'ساحة المقاومة الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(860, 'منتديات نصرة نبينا', 'http://www.alrasul.com/vb/', 'منتديات نصرة نبينا', 'منتديات نصرة نبينا', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(861, 'منتدي شبكة الحرمين الشريفين', 'http://www.s00m.net/vb/', 'منتدي شبكة الحرمين الشريفين', 'منتدي شبكة الحرمين الشريفين', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(862, 'منتديات هدي الاسلام', 'http://www.hudaislam.com/vb/', 'منتديات هدي الاسلام', 'منتديات هدي الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213721223', 0, 0),
(863, 'منتديات المسك', 'http://www.almeske.net/vb/', 'منتديات المسك', 'منتديات المسك', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(864, 'منتديات الفجر الصادق', 'http://www.n7n9.com/vb/', 'منتديات الفجر الصادق', 'منتديات الفجر الصادق', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(865, 'منتدي فرسان الحق', 'http://www.forsanelhaq.com/', 'منتدي فرسان الحق', 'منتدي فرسان الحق', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(866, 'منتديات رسالتي', 'http://resalte.net/vb/', 'منتديات رسالتي', 'منتديات رسالتي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(867, 'منتديات عالم التطوع العربي', 'http://www.arabvolunteering.org/corner/', 'منتديات عالم التطوع العربي', 'منتديات عالم التطوع العربي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(868, 'منتدي قباء الاسلامي', 'http://www.qopaa.com/vb/', 'منتدي قباء الاسلامي', 'منتدي قباء الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(869, 'منتديات ذكريات الاسلامية', 'http://www.zkryat.com/vb/', 'منتديات ذكريات الاسلامية', 'منتديات ذكريات الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(870, 'منتديات الاستقامة الاعلامية', 'http://www.istqamh.net/vb/', 'منتديات الاستقامة الاعلامية', 'منتديات الاستقامة الاعلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(871, 'منتدي محبي رسول الله', 'http://7abetk.com/forum/', 'منتدي محبي رسول الله', 'منتدي محبي رسول الله', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(872, 'مركز دراسات وأبحاث علوم الجان', 'http://www.rc4js.com/vb/', 'مركز دراسات وأبحاث علوم الجان', 'مركز دراسات وأبحاث علوم الجان', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(873, 'منتديات الكلم الطيب', 'http://al-klem.net/vb/', 'منتديات الكلم الطيب', 'منتديات الكلم الطيب', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(874, 'منتديات الارشاد وللفتاوي الشرعية', 'http://al-ershaad.com/vb4/', 'منتديات الارشاد وللفتاوي الشرعية', 'منتديات الارشاد وللفتاوي الشرعية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(875, 'منتدي مهاجرات', 'http://mohajrat.com/vb/', 'منتدي مهاجرات', 'منتدي مهاجرات', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(876, 'منتديات طريق الهدي', 'http://al-hoda.keuf.net/index.htm', 'منتديات طريق الهدي', 'منتديات طريق الهدي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(877, 'منتديات الجامع الاسلامية', 'http://www.aljame3.net/ib/', 'منتديات الجامع الاسلامية', 'منتديات الجامع الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(878, 'منتديات الحلم الاسلامي', 'http://www.islamicdream.net/vb/', 'منتديات الحلم الاسلامي', 'منتديات الحلم الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(879, 'منتدي انا المسلم', 'http://www.muslm.net/vb/', 'منتدي انا المسلم', 'منتدي انا المسلم', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(880, 'ملتقي الاسد للحوار', 'http://www.alasad.net/vb/', 'ملتقي الاسد للحوار', 'ملتقي الاسد للحوار', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(881, 'منتدي ناصح للتربية والدعوة', 'http://www.naseh.net/vb/', 'منتدي ناصح للتربية والدعوة', 'منتدي ناصح للتربية والدعوة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(882, 'ساحة حوار اسلام اون لاين', 'http://www.islamonline.net/Discussion/arabic/bbs.asp', 'ساحة حوار اسلام اون لاين', 'ساحة حوار اسلام اون لاين', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(883, 'منتدي المسلم الصغير', 'http://gesah.net/vb/vb/forumdisplay.php?f=73', 'منتدي المسلم الصغير', 'منتدي المسلم الصغير', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(884, 'منتدي شبكة المهج', 'http://www.almanhaj.com/vb/', 'منتدي شبكة المهج', 'منتدي شبكة المهج', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(885, 'منتدي انا مسلمة', 'http://www.muslmh.com/vb', 'منتدي انا مسلمة', 'منتدي انا مسلمة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(886, 'المنتدي المسكي', 'http://almski.com/', 'المنتدي المسكي', 'المنتدي المسكي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(887, 'ملتقي الاحبة في الله', 'http://www.ala7ebah.com/upload/', 'ملتقي الاحبة في الله', 'ملتقي الاحبة في الله', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(888, 'منتدي الاسلام اليوم', 'http://www.islamtoday.net/articles/new_articles_content.cfm?id=172&p=0', 'منتدي الاسلام اليوم', 'منتدي الاسلام اليوم', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(889, 'منتديات مشكاة', 'http://www.almeshkat.net/vb/', 'منتديات مشكاة', 'منتديات مشكاة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(890, 'منتديات حفاظ الوحيين', 'http://www.alwhyyn.net/vb/', 'منتديات حفاظ الوحيين', 'منتديات حفاظ الوحيين', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(891, 'منتدي ابن الاسلام', 'http://www.ibnalislam.com/vb/', 'منتدي ابن الاسلام', 'منتدي ابن الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(892, 'منتديات الطلائع الاسلامية', 'http://www.altlae3.com/', 'منتديات الطلائع الاسلامية', 'منتديات الطلائع الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(893, 'مجالس شبابيات الاسلامية', 'http://www.shbabait.com/fourm/', 'مجالس شبابيات الاسلامية', 'مجالس شبابيات الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(894, 'منتديات الداعية عمرو خالد', 'http://forum.amrkhaled.net/index.php?', 'منتديات الداعية عمرو خالد', 'منتديات الداعية عمرو خالد', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(895, 'منتديات رفيق الدرب', 'http://www.albashiri.com/vb', 'منتديات رفيق الدرب', 'منتديات رفيق الدرب', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(896, 'ملتقي أهل السنة والجماعة بالسودان', 'http://www.sd-sunnah.com/vb/', 'ملتقي أهل السنة والجماعة بالسودان', 'ملتقي أهل السنة والجماعة بالسودان', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(897, 'منتديات نسائم الفرقان', 'http://www.al-forquan.com/vb/', 'منتديات نسائم الفرقان', 'منتديات نسائم الفرقان', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(898, 'منتديات قراء القران', 'http://www.qquran.com/forum/', 'منتديات قراء القران', 'منتديات قراء القران', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(899, 'منتديات عشاق الجنة', 'http://www.aljanh.com/vb/', 'منتديات عشاق الجنة', 'منتديات عشاق الجنة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(900, 'متدي شبكة راية الاسلام', 'http://www.islamflag.net/vb/', 'متدي شبكة راية الاسلام', 'متدي شبكة راية الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(901, 'منتدي فتيات الوحيين', 'http://www.alwhyyn.net/nesa', 'منتدي فتيات الوحيين', 'منتدي فتيات الوحيين', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(902, 'منتدي حوارنا الاسلامي', 'http://www.hewarona.com/vb/', 'منتدي حوارنا الاسلامي', 'منتدي حوارنا الاسلامي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(903, 'منتديات أخوات طريق الاسلام', 'http://akhawat.islamway.com/forum/', 'منتديات أخوات طريق الاسلام', 'منتديات أخوات طريق الاسلام', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(904, 'منتديات الحور العين الاسلامية', 'http://www.hor3en.com/', 'منتديات الحور العين الاسلامية', 'منتديات الحور العين الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(905, 'منتديات دار القران الكريم النسائية', 'http://www.dar-quran.com/vb/index.php', 'منتديات دار القران الكريم النسائية', 'منتديات دار القران الكريم النسائية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(906, 'ملتقيات خير امة', 'http://daawh.com/vb/', 'ملتقيات خير امة', 'ملتقيات خير امة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(907, 'منتديات أهل السنه والجماعة', 'http://www.alsonaa.com/vb/', 'منتديات أهل السنه والجماعة', 'منتديات أهل السنه والجماعة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(908, 'منتديات إسلامنا', 'http://www.islamonaa.com/vb/index.php', 'منتديات إسلامنا', 'منتديات إسلامنا', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(909, 'منتديات أمل المسلم', 'http://amlmuslem.com/vb/', 'منتديات أمل المسلم', 'منتديات أمل المسلم', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(910, 'منتديات طريق التوبة', 'http://tawba-way.com/vb/', 'منتديات طريق التوبة', 'منتديات طريق التوبة', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(911, 'منتديات مكتبة المسجد النبوي', 'http://mktaba.org/vb/', 'منتديات مكتبة المسجد النبوي', 'منتديات مكتبة المسجد النبوي', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(912, 'منتديات ويانا الإنشادية', 'http://www.we-yana.com/forum/', 'منتديات ويانا الإنشادية', 'منتديات ويانا الإنشادية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(913, 'منتديات داعية نت', 'http://www.da3ya.net/', 'منتديات داعية نت', 'منتديات داعية نت', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(914, 'منتديات اقصانا الجريح', 'http://www.aqsaa.com/vb/index.php', 'منتديات اقصانا الجريح', 'منتديات اقصانا الجريح', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(915, 'شبكة المسك الاسلامية', 'http://www.almeske.net/vb/', 'شبكة المسك الاسلامية', 'شبكة المسك الاسلامية', '', '', '', 1, 52, 0, 0, 0, 1, '1213726219', 0, 0),
(916, 'منتديات الرياضة إلي الابد', 'http://sport4ever.maktoob.com/', 'منتديات الرياضة إلي الابد', 'منتديات الرياضة إلي الابد', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(917, 'منتدي رابطة جمهور الاتحاد', 'http://www.ittihadfans.com/fans/', 'منتدي رابطة جمهور الاتحاد', 'منتدي رابطة جمهور الاتحاد', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(918, 'منتديات العالمي', 'http://forums.al3almi.net/', 'منتديات العالمي', 'منتديات العالمي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(919, 'منتدي نادي الشارقة', 'http://www.sharjawy.com/vb/', 'منتدي نادي الشارقة', 'منتدي نادي الشارقة', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(920, 'منتدي الجماهير النصرواية', 'http://www.alnassr.com/vb/', 'منتدي الجماهير النصرواية', 'منتدي الجماهير النصرواية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(921, 'منتديات الرياضة العربية والعالمية', 'http://www.alzaeem.net/forumdisplay.php?f=13', 'منتديات الرياضة العربية والعالمية', 'منتديات الرياضة العربية والعالمية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(922, 'منتديات الفنون القتالية', 'http://www.alfonon.net/vb/', 'منتديات الفنون القتالية', 'منتديات الفنون القتالية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(923, 'منتدي القلم الرياضي', 'http://www.sportpen.net/vb/', 'منتدي القلم الرياضي', 'منتدي القلم الرياضي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(924, 'منتديات شبكة الزعيم', 'http://alzaeem.com/', 'منتديات شبكة الزعيم', 'منتديات شبكة الزعيم', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(925, 'منتديات البطل الرياضية', 'http://al-batal.com/vb/', 'منتديات البطل الرياضية', 'منتديات البطل الرياضية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(926, 'منتدي جهور منتخب الامارات', 'http://www.uaesport.ae/vb/', 'منتدي جهور منتخب الامارات', 'منتدي جهور منتخب الامارات', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(927, 'منتدي عنابي', 'http://www.3nabi.com/forums/', 'منتدي عنابي', 'منتدي عنابي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(928, 'منتديات جماهير التعاون', 'http://www.t2002.com/vb/', 'منتديات جماهير التعاون', 'منتديات جماهير التعاون', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(929, 'منتدي نادي هجر الرسمي', 'http://www.hajirclub.com/vb/index.php', 'منتدي نادي هجر الرسمي', 'منتدي نادي هجر الرسمي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(930, 'منتديات الفروسية', 'http://www.frosiah.com/vb/', 'منتديات الفروسية', 'منتديات الفروسية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(931, 'منتديات غواص العرب', 'http://www.arabdiver.com/vb/', 'منتديات غواص العرب', 'منتديات غواص العرب', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(932, 'منتدي الهدف الرياضي', 'http://www.uaegoal.com/vb/', 'منتدي الهدف الرياضي', 'منتدي الهدف الرياضي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(933, 'منتديات شبكه العالمي', 'http://www.vb.alnassrclub.com/', 'منتديات شبكه العالمي', 'منتديات شبكه العالمي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(934, 'منتدي نادي الرائد', 'http://www.alraed.com/vb/', 'منتدي نادي الرائد', 'منتدي نادي الرائد', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(935, 'منتدي العنابي', 'http://www.al3nabi.com/vb/', 'منتدي العنابي', 'منتدي العنابي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(936, 'منتديات قطر فوتبول', 'http://www.qatarfootball.com/vb/', 'منتديات قطر فوتبول', 'منتديات قطر فوتبول', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(937, 'منتديات المربع من للسيارات', 'http://almuraba.net/forum/', 'منتديات المربع من للسيارات', 'منتديات المربع من للسيارات', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(938, 'منتديات الرياضة السعودية', 'http://www.ksasports.com/vb/', 'منتديات الرياضة السعودية', 'منتديات الرياضة السعودية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(939, 'منتديات سبورت برو الرياضية', 'http://www.sport-pro.net/', 'منتديات سبورت برو الرياضية', 'منتديات سبورت برو الرياضية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(940, 'منتديات كورة', 'http://forum.kooora.com/', 'منتديات كورة', 'منتديات كورة', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(941, 'منتدي الكونغ في للعرب', 'http://wushu4arab.clubme.net/', 'منتدي الكونغ في للعرب', 'منتدي الكونغ في للعرب', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(942, 'منتديات الاندية السعودية', 'http://www.saudi-clubs.net/vb/', 'منتديات الاندية السعودية', 'منتديات الاندية السعودية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(943, 'منتدي شبكة نادي الاهلي السعودية', 'http://www.alahlisaudi.org/', 'منتدي شبكة نادي الاهلي السعودية', 'منتدي شبكة نادي الاهلي السعودية', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(944, 'منتديات نادي الحزم الرياضي', 'http://ser10.ksatec.com/suspended.page/', 'منتديات نادي الحزم الرياضي', 'منتديات نادي الحزم الرياضي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(945, 'منتديات وحداوي', 'http://wehda.net/vb/', 'منتديات وحداوي', 'منتديات وحداوي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(946, 'منتديات ملوك الصيد', 'http://hunt-kings.com/vb/', 'منتديات ملوك الصيد', 'منتديات ملوك الصيد', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(947, 'منتديات الدور السعودي', 'http://ksa-ball.com/vb/', 'منتديات الدور السعودي', 'منتديات الدور السعودي', '', '', '', 1, 57, 0, 0, 0, 1, '1213786420', 0, 0),
(948, 'الرقية الشرعية', 'http://ksa-ball.com/vb/', 'الرقية الشرعية', 'الرقية الشرعية', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(949, 'الطب الاسلامي', 'http://ksa-ball.com/vb/', 'الطب الاسلامي', 'الطب الاسلامي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(950, 'الجمعية الدولية للطلب الاسلامي', 'http://ksa-ball.com/vb/', 'الجمعية الدولية للطلب الاسلامي', 'الجمعية الدولية للطلب الاسلامي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(951, 'الطب الاسلامي والكلاسيكي', 'http://www.mic.ki.se/Arab.html', 'الطب الاسلامي والكلاسيكي', 'الطب الاسلامي والكلاسيكي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(952, 'الطب النبوي', 'http://www.khayma.com/roqia/nabaway.htm', 'الطب النبوي', 'الطب النبوي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(953, 'شفاء السرطان', 'http://www.khayma.com/shefaa%2Dalsaratan/', 'شفاء السرطان', 'شفاء السرطان', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(954, 'موقع الحجامة', 'http://www.hijama.net/', 'موقع الحجامة', 'موقع الحجامة', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(955, 'الطب اليديل', 'http://www.healthmap.com/', 'الطب اليديل', 'الطب اليديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(956, 'العيادة الكندية للطب البديل', 'http://www.doctorallergies.com/arabic/', 'العيادة الكندية للطب البديل', 'العيادة الكندية للطب البديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(957, 'ولود لطب الاعشاب', 'http://www.walood.com/', 'ولود لطب الاعشاب', 'ولود لطب الاعشاب', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(958, 'العلاج بالماء', 'http://www.walood.com/', 'العلاج بالماء', 'العلاج بالماء', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(959, 'موقع الطب البديل', 'http://6eb-badeel.banaat.com/main.html', 'موقع الطب البديل', 'موقع الطب البديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(960, 'الطب الشعبي', 'http://www.khayma.com/cupping/index.htm', 'الطب الشعبي', 'الطب الشعبي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(961, 'لقط المرجان', 'http://www.khayma.com/roqia/', 'لقط المرجان', 'لقط المرجان', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(962, 'شبكة الطبيب المسلم', 'http://www.muslimdoctor.net/', 'شبكة الطبيب المسلم', 'شبكة الطبيب المسلم', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(963, 'الاتحاد الطبي الاسلامي في امريكا', 'http://www.imana.org/', 'الاتحاد الطبي الاسلامي في امريكا', 'الاتحاد الطبي الاسلامي في امريكا', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(964, 'كتب ومقالات عن الطب الاسلامي', 'http://www.islam-usa.com/', 'كتب ومقالات عن الطب الاسلامي', 'كتب ومقالات عن الطب الاسلامي', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(965, 'الحواج للعلاج بالاعشاب الطبية', 'http://www.khayma.com/hawaj/', 'الحواج للعلاج بالاعشاب الطبية', 'الحواج للعلاج بالاعشاب الطبية', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(966, 'المعجزة النبوية _ الحجامة', 'http://www.adl90.com/', 'المعجزة النبوية _ الحجامة', 'المعجزة النبوية _ الحجامة', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(967, 'صفحة الطب البديل', 'http://www.pitt.edu/~cbw/altm.html', 'صفحة الطب البديل', 'صفحة الطب البديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(968, 'موقع وقاء للطب البديل', 'http://www.weqa.com/', 'موقع وقاء للطب البديل', 'موقع وقاء للطب البديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(969, 'الغذاء دواء', 'http://www.tolaymat.com/', 'الغذاء دواء', 'الغذاء دواء', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(970, 'موقع عشبة', 'http://www.oshba.com/', 'موقع عشبة', 'موقع عشبة', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(971, 'الطب العربي البديل', 'http://arabaltmed.com/ews/', 'الطب العربي البديل', 'الطب العربي البديل', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(972, 'الطب البديل  _ واحة الاعشاب', 'http://www.sis4ever.com/', 'الطب البديل  _ واحة الاعشاب', 'الطب البديل  _ واحة الاعشاب', '', '', '', 1, 44, 0, 0, 0, 1, '1213788376', 0, 0),
(973, 'منتديات سوالف ليل', 'http://www.swalflail.net/forum/index.php', 'منتديات سوالف ليل', 'منتديات سوالف ليل', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(974, 'منتدي محايل الثقافيه', 'http://www.mohayil.com/vb/', 'منتدي محايل الثقافيه', 'منتدي محايل الثقافيه', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(975, 'منتدي شبكة الطنايا', 'http://www.altanaya.net/vb/', 'منتدي شبكة الطنايا', 'منتدي شبكة الطنايا', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(976, 'رابطة رواء للأدب الاسلامي', 'http://www.ruowaa.com/', 'رابطة رواء للأدب الاسلامي', 'رابطة رواء للأدب الاسلامي', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(977, 'منتديات نوادر التراث الشعبي', 'http://www.nawader.net/montada/', 'منتديات نوادر التراث الشعبي', 'منتديات نوادر التراث الشعبي', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(978, 'شبكة المرقاب الادبية', 'http://montada.mergab.com/', 'شبكة المرقاب الادبية', 'شبكة المرقاب الادبية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(979, 'منتديات الندواي الشعبية', 'http://www.alnadawi.com/vb/', 'منتديات الندواي الشعبية', 'منتديات الندواي الشعبية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(980, 'منتدي أزاهير', 'http://www.azaheer.com/vb/', 'منتدي أزاهير', 'منتدي أزاهير', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(981, 'منتديات هواجيس الادبيه', 'http://www.hwages.net/vb/', 'منتديات هواجيس الادبيه', 'منتديات هواجيس الادبيه', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(982, 'منتديات الباحر الثقافية', 'http://www.alba7er.com/vb/index.php?', 'منتديات الباحر الثقافية', 'منتديات الباحر الثقافية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(983, 'منتدي مجلة أنهار الثقافي', 'http://www.anhaar.com/vb/index.php', 'منتدي مجلة أنهار الثقافي', 'منتدي مجلة أنهار الثقافي', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(984, 'منتديات الشعراء', 'http://www.alsh3ra.net/vb/', 'منتديات الشعراء', 'منتديات الشعراء', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(985, 'منتدي العروض للشعر العربي', 'http://www.arood.com/vb/index.php', 'منتدي العروض للشعر العربي', 'منتدي العروض للشعر العربي', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(986, 'منتديات المعني الادبية', 'http://www.alm3na.net/vb', 'منتديات المعني الادبية', 'منتديات المعني الادبية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(987, 'منتديات سمان الهرج والادبية', 'http://www.smanalhrj.com/', 'منتديات سمان الهرج والادبية', 'منتديات سمان الهرج والادبية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(988, 'منتدي القصة العربية', 'http://www.arabicstory.net/forum/', 'منتدي القصة العربية', 'منتدي القصة العربية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(989, 'منتديات شرواك الادبية', 'http://www.s-ak.com/vb/', 'منتديات شرواك الادبية', 'منتديات شرواك الادبية', '', '', '', 1, 55, 0, 0, 0, 1, '1213788967', 0, 0),
(990, 'منتدي نفساني', 'http://www.nafsany.cc/vb/', 'منتدي نفساني', 'منتدي نفساني', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(991, 'منتدي الادارة العامة للتمريض', 'http://www.gndmoh.com/vb', 'منتدي الادارة العامة للتمريض', 'منتدي الادارة العامة للتمريض', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(992, 'منتدي التمريض السعودي', 'http://www.nursing-sa.com/vb/', 'منتدي التمريض السعودي', 'منتدي التمريض السعودي', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(993, 'منتدي مشروع صيدلي المستقبل', 'http://www.nursing-sa.com/vb/', 'منتدي مشروع صيدلي المستقبل', 'منتدي مشروع صيدلي المستقبل', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(994, 'منتدي الإرادة والتحدي', 'http://%20www.aleradah.org/vb/', 'منتدي الإرادة والتحدي', 'منتدي الإرادة والتحدي', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(995, 'منتديات نادي ديفي للصم والبكم', 'http://www.deafyclub.com/vb', 'منتديات نادي ديفي للصم والبكم', 'منتديات نادي ديفي للصم والبكم', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(996, 'منتديات طبيعي للطب البديل', 'http://forum.tabi3i.org/', 'منتديات طبيعي للطب البديل', 'منتديات طبيعي للطب البديل', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(997, 'ملتقي الاطباء العرب', 'http://www.md4a.net/vb/', 'ملتقي الاطباء العرب', 'ملتقي الاطباء العرب', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(998, 'المنتدي الطبي البيطري', 'http://www.syriavet.com/vet/index.php', 'المنتدي الطبي البيطري', 'المنتدي الطبي البيطري', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(999, 'منتدي جمعية البحرين لرعاية السكر', 'http://www.scdbh.com/vb/', 'منتدي جمعية البحرين لرعاية السكر', 'منتدي جمعية البحرين لرعاية السكر', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1000, 'منتديات بيت التمريض', 'http://palnurse.com/vb/', 'منتديات بيت التمريض', 'منتديات بيت التمريض', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1001, 'منتديات الكوادر الطبية السعودية', 'http://www.mssaudi.com/vb', 'منتديات الكوادر الطبية السعودية', 'منتديات الكوادر الطبية السعودية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1002, 'منتديات واحة الاعشاب', 'http://www.sis4ever.com/vb/', 'منتديات واحة الاعشاب', 'منتديات واحة الاعشاب', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1003, 'ملتقي الصيادلية', 'http://www.sydlah.com/vb', 'ملتقي الصيادلية', 'ملتقي الصيادلية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1004, 'منتديات الهلال الاحمر السعودي', 'http://forum.srcs.org.sa/', 'منتديات الهلال الاحمر السعودي', 'منتديات الهلال الاحمر السعودي', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1005, 'منتدي اضطرابات النوم والعلاج التنفسي', 'http://www.mashsleep.com/forum.php', 'منتدي اضطرابات النوم والعلاج التنفسي', 'منتدي اضطرابات النوم والعلاج التنفسي', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1006, 'ملتقي كلية الامير سلطان الصحية', 'http://www.pscksa.com/vb/', 'ملتقي كلية الامير سلطان الصحية', 'ملتقي كلية الامير سلطان الصحية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1007, 'منتدي عالمالمختبرات الطبية', 'http://www.labsworld.net/vb/', 'منتدي عالمالمختبرات الطبية', 'منتدي عالمالمختبرات الطبية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1008, 'منتديات حياتنا النفسية', 'http://www.hayatnafs.com/cgi-bin/ubbcgi/Ultimate.cgi?action=intro&BypassCookie=true', 'منتديات حياتنا النفسية', 'منتديات حياتنا النفسية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1009, 'منتديات قلعة التمريض', 'http://www.nursingcastle.com/vb/', 'منتديات قلعة التمريض', 'منتديات قلعة التمريض', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1010, 'ملتقي الصيادلية العرب', 'http://www.4ph.net/', 'ملتقي الصيادلية العرب', 'ملتقي الصيادلية العرب', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1011, 'منتدي كيان لذوي الاحتاياجات الخاصة', 'http://www.kayanegypt.com/montada/index.php', 'منتدي كيان لذوي الاحتاياجات الخاصة', 'منتدي كيان لذوي الاحتاياجات الخاصة', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1012, 'منتديات تحدي الاعاقة', 'http://www.t7di.net/vb/', 'منتديات تحدي الاعاقة', 'منتديات تحدي الاعاقة', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1013, 'منتديات طبيعي نت', 'http://www.tabeae.net/vb', 'منتديات طبيعي نت', 'منتديات طبيعي نت', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1014, 'منتدي الاكاديمية الطبية', 'http://www.medicalacademy.net/vb/', 'منتدي الاكاديمية الطبية', 'منتدي الاكاديمية الطبية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1015, 'منتديات طلاب كلية طب لاسنان', 'http://www.rcdph.com/vb/', 'منتديات طلاب كلية طب لاسنان', 'منتديات طلاب كلية طب لاسنان', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1016, 'منتدي البيطرة السعودية', 'http://www.saudivet.com/vb/#Layer%201', 'منتدي البيطرة السعودية', 'منتدي البيطرة السعودية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1017, 'منتديات طبيبي', 'http://www.tabeebe.com/vb/', 'منتديات طبيبي', 'منتديات طبيبي', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1018, 'منتديات الصحة النفسية ببريدة', 'http://www.bmhh.med.sa/vb/', 'منتديات الصحة النفسية ببريدة', 'منتديات الصحة النفسية ببريدة', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1019, 'منتدي طلاب طب جامعة طنطا', 'http://www.tantatalaba.ch/vb', 'منتدي طلاب طب جامعة طنطا', 'منتدي طلاب طب جامعة طنطا', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1020, 'منتدي الحمية للجميع', 'http://www.diet4all.info/', 'منتدي الحمية للجميع', 'منتدي الحمية للجميع', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1021, 'منتدي الهيئة العربية لخدمات نقل الدم', 'http://www.arababts.com/vb/', 'منتدي الهيئة العربية لخدمات نقل الدم', 'منتدي الهيئة العربية لخدمات نقل الدم', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1022, 'منتديات الامل للصحة النفسية', 'http://alamalksa.com/vb/', 'منتديات الامل للصحة النفسية', 'منتديات الامل للصحة النفسية', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1023, 'منتديات بوابة الصيدلة', 'http://www.pharmag8.com/vb/', 'منتديات بوابة الصيدلة', 'منتديات بوابة الصيدلة', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1024, 'ملتقي مرضي البهاق', 'http://www.vitiligoteam.com/', 'ملتقي مرضي البهاق', 'ملتقي مرضي البهاق', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1025, 'منتدي تجمع الشعاعيين العرب', 'http://4x-ray.com/', 'منتدي تجمع الشعاعيين العرب', 'منتدي تجمع الشعاعيين العرب', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1026, 'منتدي مختبرات العرب', 'http://www.arabslab.com/vb/', 'منتدي مختبرات العرب', 'منتدي مختبرات العرب', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1027, 'منتديات الصيادليه اليوم', 'http://sayadla.com/vb/', 'منتديات الصيادليه اليوم', 'منتديات الصيادليه اليوم', '', '', '', 1, 56, 0, 0, 0, 1, '1213792901', 0, 0),
(1030, 'منتديات أعمال الخليج', 'http://thegulfbiz.com/', 'منتديات أعمال الخليج', 'منتديات أعمال الخليج', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1031, 'منتديات أعمال الخليج', 'http://www.musahim.biz/', 'منتديات أعمال الخليج', 'منتديات أعمال الخليج', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1032, 'بوابة الاسهم', 'http://www.sharesgate.com/vb', 'بوابة الاسهم', 'بوابة الاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1033, 'منتديات البورصة السعودية', 'http://www.saudi-stock.com/', 'منتديات البورصة السعودية', 'منتديات البورصة السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1034, 'منتدى فرسان البورصة السعودية', 'http://www.stock-knights1.com/forum/index.php', 'منتدى فرسان البورصة السعودية', 'منتدى فرسان البورصة السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1035, 'منتديات هوامير البورصة السعودية', 'http://www.hawamer.com/vb/', 'منتديات هوامير البورصة السعودية', 'منتديات هوامير البورصة السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1036, 'تداول السعودية', 'http://www.tdwlsa.com/forums/', 'تداول السعودية', 'تداول السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1037, 'منتدى الأسهم السعودية', 'http://www.saudistocks.com/forums/', 'منتدى الأسهم السعودية', 'منتدى الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1038, 'منتدى بورصة الاسهم السعودية', 'http://www.sahmy.com/', 'منتدى بورصة الاسهم السعودية', 'منتدى بورصة الاسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1039, 'منتديات بوابة البورصة', 'http://www.alsa33h.com/vb/', 'منتديات بوابة البورصة', 'منتديات بوابة البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1040, 'منتديات الوطن للأسهم السعودية', 'http://www.5ttt5.net/vb/', 'منتديات الوطن للأسهم السعودية', 'منتديات الوطن للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1041, 'منتديات سسهام الإقتصادية', 'http://www.ssham.com/', 'منتديات سسهام الإقتصادية', 'منتديات سسهام الإقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1042, 'منتديات الساعة الاقتصادية', 'http://www.alsa33h.com/vb/', 'منتديات الساعة الاقتصادية', 'منتديات الساعة الاقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1043, 'منتديات الصفوة للأسهم السعودية', 'http://www.alsafoa.com/vb/', 'منتديات الصفوة للأسهم السعودية', 'منتديات الصفوة للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1044, 'منتديات تداول دوجي', 'http://dojisa.com/forum/forumdisplay.php?f=13', 'منتديات تداول دوجي', 'منتديات تداول دوجي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1045, 'منتديات أصدقاء البورصة', 'http://www.sadagh.com/', 'منتديات أصدقاء البورصة', 'منتديات أصدقاء البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1046, 'منتدى الموجز للاسهم السعودية', 'http://www.9i2.net/vb', 'منتدى الموجز للاسهم السعودية', 'منتدى الموجز للاسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1047, 'منتديات الإمارات للأوراق المالية', 'http://www.uaesm.com/', 'منتديات الإمارات للأوراق المالية', 'منتديات الإمارات للأوراق المالية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1048, 'منتديات اقتصاديات', 'http://www.4eqt.com/vb', 'منتديات اقتصاديات', 'منتديات اقتصاديات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1049, 'منتدى المؤشرنت الإقتصادي', 'http://www.indexsignal.com/vb', 'منتدى المؤشرنت الإقتصادي', 'منتدى المؤشرنت الإقتصادي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1050, 'منتديات السبت الاقتصادية', 'http://www.alsabet.com/vb', 'منتديات السبت الاقتصادية', 'منتديات السبت الاقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1051, 'نقية للأسهم السعودية', 'http://www.nqeia.com/vb', 'نقية للأسهم السعودية', 'نقية للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1052, 'منتدى المرجع الإقتصادي لسوق الأسهم', 'http://www.market-information.net/', 'منتدى المرجع الإقتصادي لسوق الأسهم', 'منتدى المرجع الإقتصادي لسوق الأسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1053, 'منتدى المستثمرون العرب', 'http://www.mostathmr.com/', 'منتدى المستثمرون العرب', 'منتدى المستثمرون العرب', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1054, 'منتدى أنوار الخليج الاقتصادي', 'http://www.thegulflights.com/', 'منتدى أنوار الخليج الاقتصادي', 'منتدى أنوار الخليج الاقتصادي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1055, 'منتدى مركز الاسهم', 'http://www.sharescenter.com/', 'منتدى مركز الاسهم', 'منتدى مركز الاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1056, 'منتدى مؤشرات للأسهم السعودية', 'http://www.indexes-sa.com/vb/', 'منتدى مؤشرات للأسهم السعودية', 'منتدى مؤشرات للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1057, 'منتدى سعودي شارت', 'http://www.saudi-chart.com/vb', 'منتدى سعودي شارت', 'منتدى سعودي شارت', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1058, 'منتدى الإعلانات', 'http://www.bahth.com/elan/', 'منتدى الإعلانات', 'منتدى الإعلانات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1059, 'منتدى عقارية', 'http://www.aqareh.com/vb/', 'منتدى عقارية', 'منتدى عقارية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1060, 'منتدى سيدات الأعمال', 'http://saedat.com/vb/', 'منتدى سيدات الأعمال', 'منتدى سيدات الأعمال', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1061, 'منتدى تشارتس للأسهم', 'http://www.ohlccharts.com/', 'منتدى تشارتس للأسهم', 'منتدى تشارتس للأسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1062, 'منتدى بورصة الكويت', 'http://www.kuwaitboorsa.com/vb/', 'منتدى بورصة الكويت', 'منتدى بورصة الكويت', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1063, 'منتديات رواد البورصة السعودية', 'http://www.rowads.com/vb/', 'منتديات رواد البورصة السعودية', 'منتديات رواد البورصة السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1064, 'منتدى بورصة الامارات', 'http://www.uaebourse.com/vb/index.php', 'منتدى بورصة الامارات', 'منتدى بورصة الامارات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1065, 'منتديات عقار ستي', 'http://www.aqarcity.com/', 'منتديات عقار ستي', 'منتديات عقار ستي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1066, 'منتديات خبراء للأسهم والبورصات', 'http://khoobara.com/vb/', 'منتديات خبراء للأسهم والبورصات', 'منتديات خبراء للأسهم والبورصات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1067, 'منتديات عمالقة الاسهم', 'http://www.stocksvip.net/', 'منتديات عمالقة الاسهم', 'منتديات عمالقة الاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1068, 'منتديات المتداول السعودي', 'http://www.mutdawl.net/forums/', 'منتديات المتداول السعودي', 'منتديات المتداول السعودي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1069, 'منتديات سوق الكويت', 'http://www.sooqalkuwait.com/vb/', 'منتديات سوق الكويت', 'منتديات سوق الكويت', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1070, 'منتدى الاعمال', 'http://www.v6060.com/vb/', 'منتدى الاعمال', 'منتدى الاعمال', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1071, 'منتديات منارة الخبراء', 'http://mnt-khoobara.com/', 'منتديات منارة الخبراء', 'منتديات منارة الخبراء', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1072, 'منتدى مركز التجار الاستراتيجي', 'http://www.altjar.net/vb/', 'منتدى مركز التجار الاستراتيجي', 'منتدى مركز التجار الاستراتيجي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1073, 'منتديات أكاديمية التداول الافتراضية', 'http://tdwl-academy.com/vb', 'منتديات أكاديمية التداول الافتراضية', 'منتديات أكاديمية التداول الافتراضية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1074, 'منتدى حراج بيعات', 'http://www.byaat.com/forum/', 'منتدى حراج بيعات', 'منتدى حراج بيعات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1075, 'منتدى خبراء سوق المال', 'http://khubara.com/', 'منتدى خبراء سوق المال', 'منتدى خبراء سوق المال', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1076, 'منتديات الوافي للاسهم', 'http://www.j100j.com/', 'منتديات الوافي للاسهم', 'منتديات الوافي للاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1077, 'منتدى تمليك العقاري', 'http://tmleek.com/vb', 'منتدى تمليك العقاري', 'منتدى تمليك العقاري', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1078, 'منتديات الجزيره للاسهم السعوديه', 'http://www.aljzerhsa.com/', 'منتديات الجزيره للاسهم السعوديه', 'منتديات الجزيره للاسهم السعوديه', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1079, 'منتديات هوامير تداول البورصة', 'http://www.a00n.com/', 'منتديات هوامير تداول البورصة', 'منتديات هوامير تداول البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1080, 'منتديات أسواق الاقتصادية', 'http://www.aswaqweb.net/vb/', 'منتديات أسواق الاقتصادية', 'منتديات أسواق الاقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1081, 'منتدي تداول', 'http://www.tdwl.net/vb', 'منتدي تداول', 'منتدي تداول', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1082, 'منتديات الأسهم السعودية', 'http://www.saudishares.net/vb/', 'منتديات الأسهم السعودية', 'منتديات الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1083, 'منتدى تداول أون لاين', 'http://www.tadawul-online.com/vb', 'منتدى تداول أون لاين', 'منتدى تداول أون لاين', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1084, 'منتديات سنبكا لإستشارات الاسهم', 'http://www.cnbca.net/vb/', 'منتديات سنبكا لإستشارات الاسهم', 'منتديات سنبكا لإستشارات الاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1085, 'منتدى حيتان البورصة', 'http://www.7ooot.com/vb/index.php', 'منتدى حيتان البورصة', 'منتدى حيتان البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1086, 'منتديات مال وأعمال', 'http://www.malwa3mal.net/vb/', 'منتديات مال وأعمال', 'منتديات مال وأعمال', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1087, 'منتدى توصيات الأسهم السعودية', 'http://www.twsyat.net/forum/', 'منتدى توصيات الأسهم السعودية', 'منتدى توصيات الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1088, 'منتديات استشارات أون لاين', 'http://www.estsharatonline.com/vb/', 'منتديات استشارات أون لاين', 'منتديات استشارات أون لاين', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1089, 'منتدى المضاربون', 'http://www.w15w.com/', 'منتدى المضاربون', 'منتدى المضاربون', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1090, 'منتديات نوافذ الأسهم السعودية', 'http://www.stockws.com/forum/index.php', 'منتديات نوافذ الأسهم السعودية', 'منتديات نوافذ الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1091, 'منتديات تجار البورصة', 'http://www.tjjar.net/vb/', 'منتديات تجار البورصة', 'منتديات تجار البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1092, 'المتداولون العرب', 'http://www.arabtadawl.com/vb', 'المتداولون العرب', 'المتداولون العرب', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1093, 'منتديات المتداول العربي', 'http://www.arabictrader.com/vb/', 'منتديات المتداول العربي', 'منتديات المتداول العربي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1094, 'ملتقى هوامير الأسهم السعودية', 'http://hawamir.com/', 'ملتقى هوامير الأسهم السعودية', 'ملتقى هوامير الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1095, 'منتديات الشلاقي للأسهم السعودية', 'http://www.alshlagy.com/', 'منتديات الشلاقي للأسهم السعودية', 'منتديات الشلاقي للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1096, 'منتدى العالمية للأسهم السعودية', 'http://www.alalamyah.com/vb/', 'منتدى العالمية للأسهم السعودية', 'منتدى العالمية للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1097, 'منتدى طريق السهم السعودي', 'http://saudisw.com/vb/index.php', 'منتدى طريق السهم السعودي', 'منتدى طريق السهم السعودي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1098, 'منتديات شبكة الأسهم القطرية', 'http://www.qatarshares.com/vb/', 'منتديات شبكة الأسهم القطرية', 'منتديات شبكة الأسهم القطرية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1099, 'نوادي المضاربة والإستثمار', 'http://www.alnwady.com/stock/index.php', 'نوادي المضاربة والإستثمار', 'نوادي المضاربة والإستثمار', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1100, 'منتدى مستعمل', 'http://www.mstaml.com/forum/', 'منتدى مستعمل', 'منتدى مستعمل', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1101, 'منتديات بيع', 'http://www.bay3.org/', 'منتديات بيع', 'منتديات بيع', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1102, 'منتدى المضارب', 'http://www.almodareb.com/', 'منتدى المضارب', 'منتدى المضارب', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1103, 'منتدى الدليل للأسهم السعودية', 'http://www.t905.com/', 'منتدى الدليل للأسهم السعودية', 'منتدى الدليل للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1104, 'منتديات المؤشر للأسهم السعودية', 'http://www.moshr.com/', 'منتديات المؤشر للأسهم السعودية', 'منتديات المؤشر للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1105, 'منتديات العربية الاقتصادية', 'http://www.arbeh.com/', 'منتديات العربية الاقتصادية', 'منتديات العربية الاقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1106, 'منتدى البورصة السعودية', 'http://www.saudi-stock.net/vb/index.php', 'منتدى البورصة السعودية', 'منتدى البورصة السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1107, 'منتديات الماكد السعودي للاسهم', 'http://www.saudimacd.com/vb/index.php', 'منتديات الماكد السعودي للاسهم', 'منتديات الماكد السعودي للاسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1108, 'منتديات الخطوط الأربعه الأقتصادية', 'http://www.4lines.net/', 'منتديات الخطوط الأربعه الأقتصادية', 'منتديات الخطوط الأربعه الأقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1109, 'منتدى مؤشرات الأسهم السعودية', 'http://www.tksa.net/', 'منتدى مؤشرات الأسهم السعودية', 'منتدى مؤشرات الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1110, 'منتديات الشاعر للأسهم السعودية', 'http://www.ashaer.com/', 'منتديات الشاعر للأسهم السعودية', 'منتديات الشاعر للأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1111, 'منتدى الأموال السعودية', 'http://www.alamwal.com/', 'منتدى الأموال السعودية', 'منتدى الأموال السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1112, 'منتديات عالم البورصة', 'http://www.borsaworld.com/vb/', 'منتديات عالم البورصة', 'منتديات عالم البورصة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1113, 'منتديات في آي بي للبيع والشراء', 'http://www.viiip.com/', 'منتديات في آي بي للبيع والشراء', 'منتديات في آي بي للبيع والشراء', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1114, 'منتدى الإمارات الاقتصادي', 'http://www.uaeec.com/vb/', 'منتدى الإمارات الاقتصادي', 'منتدى الإمارات الاقتصادي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1115, 'منتدى المشروعات العربية الصغيرة', 'http://www.arabproject.net/', 'منتدى المشروعات العربية الصغيرة', 'منتدى المشروعات العربية الصغيرة', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1116, 'منتديات نجوم البورصه', 'http://www.borsastars.com/', 'منتديات نجوم البورصه', 'منتديات نجوم البورصه', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1117, 'منتدى شارت للأسهم السعوديه', 'http://www.chart5.com/', 'منتدى شارت للأسهم السعوديه', 'منتدى شارت للأسهم السعوديه', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1118, 'منتديات شارتات', 'http://chartat.com/vb/', 'منتديات شارتات', 'منتديات شارتات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1119, 'مصدر المؤشر', 'http://www.m9dr.com/', 'مصدر المؤشر', 'مصدر المؤشر', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1120, 'منتديات مجالات الأسهم', 'http://www.mjalat.com/vb/', 'منتديات مجالات الأسهم', 'منتديات مجالات الأسهم', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1121, 'ملتقى نادي خبراء المال', 'http://www.moneyexpertsclub.net/forum/', 'ملتقى نادي خبراء المال', 'ملتقى نادي خبراء المال', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1122, 'منتديات الإدارة والتسويق', 'http://www.marketingspirit.net/', 'منتديات الإدارة والتسويق', 'منتديات الإدارة والتسويق', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1123, 'منتدى محفظتي', 'http://www.mahfazti.com/vb/', 'منتدى محفظتي', 'منتدى محفظتي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1124, 'منتديات بلا ميعاد الإقتصادي', 'http://www.ssmarket.net/vb', 'منتديات بلا ميعاد الإقتصادي', 'منتديات بلا ميعاد الإقتصادي', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1125, 'منتدى الادارة والتسويق', 'http://www.marketingspirit.net/', 'منتدى الادارة والتسويق', 'منتدى الادارة والتسويق', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1126, 'منتدى طلبة وخريجى كلية الحاسبات', 'http://fci4all.com/forums/', 'منتدى طلبة وخريجى كلية الحاسبات', 'منتدى طلبة وخريجى كلية الحاسبات', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1127, 'منتديات المتميز المالية', 'http://www.almutamaiz.com/vb/', 'منتديات المتميز المالية', 'منتديات المتميز المالية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1128, 'منتديات السوق المفتوح', 'http://www.alsogalmftoh.com/vb/', 'منتديات السوق المفتوح', 'منتديات السوق المفتوح', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1129, 'منتديات إطلالة الإقتصادية', 'http://www.etlalah.com/vb/', 'منتديات إطلالة الإقتصادية', 'منتديات إطلالة الإقتصادية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883270', 0, 0),
(1130, 'منتدى عقارية الفيصلية', 'http://www.nnonna.com/vb/', 'منتدى عقارية الفيصلية', 'منتدى عقارية الفيصلية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883441', 0, 0),
(1131, 'منتديات خالد2007 للأسهم السعودية', 'http://kaleed2007.com/vb/', 'الأسهم السعودية', 'الأسهم السعودية', '', '', '', 1, 53, 0, 0, 0, 1, '1213883441', 0, 0),
(1132, 'الساحة العربية', 'http://www.alsaha.com/', 'الساحة العربية', 'الساحة العربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1133, 'سوالف للجميع', 'http://www.swalif.com/forum/', 'سوالف للجميع', 'سوالف للجميع', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1134, 'منتديات مهارات المستقبل', 'http://www.future-skills.org/vb/', 'منتديات مهارات المستقبل', 'منتديات مهارات المستقبل', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1135, 'منتدى شبكة المهندس', 'http://www.almuhands.org/forum/index.php?s=', 'منتدى شبكة المهندس', 'منتدى شبكة المهندس', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1136, 'منتديات ألم الأمارات', 'http://www.alamuae.com/vb/', 'منتديات ألم الأمارات', 'منتديات ألم الأمارات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1137, 'منتديات نسيج', 'http://forums.naseej.com/index.php', 'منتديات نسيج', 'منتديات نسيج', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1138, 'مجالس حرب', 'http://www.harb-net.com/vb/', 'مجالس حرب', 'مجالس حرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1139, 'مجلس عنيزة', 'http://www.onaizah.net/majlis/index.php', 'مجلس عنيزة', 'مجلس عنيزة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1140, 'مجالس قحطان', 'http://www.qahtaan.com/vb/', 'مجالس قحطان', 'مجالس قحطان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1141, 'منتديات قبيلة العصمة', 'http://www.osaimi-tr.com/vb/', 'منتديات قبيلة العصمة', 'منتديات قبيلة العصمة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1142, 'منتديات قبيلة الشيابين', 'http://www.sheiabeen.com/vb', 'منتديات قبيلة الشيابين', 'منتديات قبيلة الشيابين', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1143, 'منتديات الاقلام المعاصرة', 'http://www.aqlamweb.net/vb/', 'منتديات الاقلام المعاصرة', 'منتديات الاقلام المعاصرة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1144, 'منتدى السيارات', 'http://www.assayyarat.com/forums/index.php', 'منتدى السيارات', 'منتدى السيارات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1145, 'منتديات عالم السيارات', 'http://www.aespeed.com/vb/', 'منتديات عالم السيارات', 'منتديات عالم السيارات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1146, 'منتديات المدينة المنورة', 'http://www.madenah-monawara.com/vb/index.php?', 'منتديات المدينة المنورة', 'منتديات المدينة المنورة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1147, 'منتديات ساندروز الثقافية', 'http://www.sandroses.com/abbs/index.php', 'منتديات ساندروز الثقافية', 'منتديات ساندروز الثقافية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1148, 'منتدى نبضات', 'http://www.sandroses.com/abbs/index.php', 'منتدى نبضات', 'منتدى نبضات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1149, 'منتديات حوارات', 'http://www.hwarat.com/', 'منتديات حوارات', 'منتديات حوارات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1150, 'منتديات الذكرى', 'http://www.1a1a1a.com/vb/', 'منتديات الذكرى', 'منتديات الذكرى', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1151, 'منتدى البراحة', 'http://www.albraha.com/', 'منتدى البراحة', 'منتدى البراحة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1152, 'ساحات سهارا للحوار', 'http://www.sahaara.com/vb/', 'ساحات سهارا للحوار', 'ساحات سهارا للحوار', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1153, 'منتديات جازان', 'http://www.jazan.org/vb/', 'منتديات جازان', 'منتديات جازان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1154, 'منتديات وادي الدواسر', 'http://www.alwadi.com.sa/vb/index.php?s=', 'منتديات وادي الدواسر', 'منتديات وادي الدواسر', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1155, 'منتديات ريان', 'http://www.riyan4u.com/vb/', 'منتديات ريان', 'منتديات ريان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1156, 'منتدى الإمارات', 'http://www.uae4ever.com/vb/index.php', 'منتدى الإمارات', 'منتدى الإمارات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1157, 'مجالس الساهر نت', 'http://www.alsaher.net/mjales/', 'مجالس الساهر نت', 'مجالس الساهر نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1158, 'منتدى شبكة الحلم', 'http://www.7lem.com/vb/', 'منتدى شبكة الحلم', 'منتدى شبكة الحلم', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1159, 'منتديات مجالسنا', 'http://majalisna.com/', 'منتديات مجالسنا', 'منتديات مجالسنا', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1160, 'منتديات شبكة الصحبة الصالحة', 'http://www.suhbaonline.net/vb/', 'منتديات شبكة الصحبة الصالحة', 'منتديات شبكة الصحبة الصالحة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1161, 'منتدى الشلة', 'http://www.alshellah.com/vb/', 'منتدى الشلة', 'منتدى الشلة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1162, 'منتديات رحاب المدينة المنورة', 'http://www.al3ez.com/vb/', 'منتديات رحاب المدينة المنورة', 'منتديات رحاب المدينة المنورة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1163, 'منتديات بللسمر', 'http://www.balasmer.com/vb/', 'منتديات بللسمر', 'منتديات بللسمر', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1164, 'منتديات الحرية', 'http://www.al-hurriya.com/vb/index.php?s=', 'منتديات الحرية', 'منتديات الحرية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1165, 'منتديات حائل', 'http://www.hyil.com/vb/index.php?s', 'منتديات حائل', 'منتديات حائل', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1166, 'منتدى مدينة المذنب', 'http://www.almithnab.net/forum/index.php', 'منتدى مدينة المذنب', 'منتدى مدينة المذنب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1167, 'منتدى شبكة قبيلة عتيبه', 'http://www.otaiby.com/vb', 'منتدى شبكة قبيلة عتيبه', 'منتدى شبكة قبيلة عتيبه', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1168, 'المجالس الينبعاويه', 'http://www.alhejaz.net/vb/', 'المجالس الينبعاويه', 'المجالس الينبعاويه', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1169, 'منتديات مرجان', 'http://www.morjan5.com/vb/', 'منتديات مرجان', 'منتديات مرجان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1170, 'منتديات طيوب', 'http://www.tayob.com/vb', 'منتديات طيوب', 'منتديات طيوب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1171, 'منتديات موقعي نت', 'http://www.mawki3i.net/vb/', 'منتديات موقعي نت', 'منتديات موقعي نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1172, 'منتديات ينبع المستقبل', 'http://alalwani.net/vb/', 'منتديات ينبع المستقبل', 'منتديات ينبع المستقبل', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1173, 'منتدى المحبه', 'http://www.almhba.com/vb/', 'منتدى المحبه', 'منتدى المحبه', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1174, 'استراحة الشقردي', 'http://www.shegrdy.com/', 'استراحة الشقردي', 'استراحة الشقردي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1175, 'منتديات أطياف', 'http://www.atiaf.com/vb/', 'منتديات أطياف', 'منتديات أطياف', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1176, 'منتدى التاريخ', 'http://www.altareekh.com/vb', 'منتدى التاريخ', 'منتدى التاريخ', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1177, 'منتدى الأحساء', 'http://ahsaweb.net/vb/', 'منتدى الأحساء', 'منتدى الأحساء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1178, 'منتديات الأحرار', 'http://www.a7rar.com/vb/', 'منتديات الأحرار', 'منتديات الأحرار', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1179, 'منتدى شبكة ليالينا', 'http://www.lyaleena.com/vb', 'منتدى شبكة ليالينا', 'منتدى شبكة ليالينا', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1180, 'منتديات خواطر', 'http://www.khwater.com/vb/', 'منتديات خواطر', 'منتديات خواطر', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1181, 'منتديات شبكة السلام', 'http://www.al-salaam.net/vb/', 'منتديات شبكة السلام', 'منتديات شبكة السلام', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1182, 'منتديات حرمة', 'http://www.harmah.org/', 'منتديات حرمة', 'منتديات حرمة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1183, 'منتديات شبكة نجد العربية', 'http://www.najd.cc/', 'منتديات شبكة نجد العربية', 'منتديات شبكة نجد العربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1184, 'منتديات هدهد سليمان', 'http://www.al-hdhd.net/', 'منتديات هدهد سليمان', 'منتديات هدهد سليمان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1185, 'مجالس حمران النواظر', 'http://www.mutair-net.com/vb/', 'مجالس حمران النواظر', 'مجالس حمران النواظر', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1186, 'منتديات القبائل العربية', 'http://www.qabail.com/vb/', 'منتديات القبائل العربية', 'منتديات القبائل العربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1187, 'منتديات مرسى العرب', 'http://www.saiedi.com/vb', 'منتديات مرسى العرب', 'منتديات مرسى العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1188, 'منتديات المنطقة الشرقية', 'http://www.2s2s.com/vb/', 'منتديات المنطقة الشرقية', 'منتديات المنطقة الشرقية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1189, 'منتديات تذكار', 'http://www.tethkar.org/vb', 'منتديات تذكار', 'منتديات تذكار', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1190, 'مجالس منطقة الرياض', 'http://www.alriyadh1.com/vb', 'مجالس منطقة الرياض', 'مجالس منطقة الرياض', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1191, 'منتديات مدينة الطائف', 'http://www.taifcity.com/vb', 'منتديات مدينة الطائف', 'منتديات مدينة الطائف', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1192, 'منتديات الرائدية', 'http://www.alraidiah.com/vb', 'منتديات الرائدية', 'منتديات الرائدية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1193, 'منتديات اسرار', 'http://www.asraar.com/vb/', 'منتديات اسرار', 'منتديات اسرار', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1194, 'منتدى البرج', 'http://www.purj.com/forum/', 'منتدى البرج', 'منتدى البرج', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1195, 'منتدى مكنون', 'http://www.maknoon.com/mon/haya.php', 'منتدى مكنون', 'منتدى مكنون', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1196, 'منتديات الغد', 'http://www.ghad.net/vb/', 'منتديات الغد', 'منتديات الغد', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1197, 'منتديات شبكة الحرة', 'http://www.7rh.com/vb', 'منتديات شبكة الحرة', 'منتديات شبكة الحرة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1198, 'منتدى روح الخليج', 'http://www.roohalkaleej.com/vb/', 'منتدى روح الخليج', 'منتدى روح الخليج', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1199, 'منتديات دار الزين', 'http://www.daralzain.com/vb/', 'منتديات دار الزين', 'منتديات دار الزين', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1200, 'منتدى مدرسة الإتقان', 'منتدى مدرسة الإتقان', 'منتدى مدرسة الإتقان', 'منتدى مدرسة الإتقان', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1201, 'منتديات حداق', 'http://www.7daq.com/vb/', 'منتديات حداق', 'منتديات حداق', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1202, 'منتديات قوافل المبدعين', 'http://forum.qawafil.com/', 'منتديات قوافل المبدعين', 'منتديات قوافل المبدعين', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1203, 'منتديات الدليمية', 'http://www.duli100.com/vb/', 'منتديات الدليمية', 'منتديات الدليمية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(1204, 'منتدى الطلاب السعوديين في بريطانيا', 'http://www.saudistudents.org/vb/', 'منتدى الطلاب السعوديين في بريطانيا', 'منتدى الطلاب السعوديين في بريطانيا', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1205, 'منتدى الساحات الإلكترونية', 'http://www.arabsys.net/vb/', 'منتدى الساحات الإلكترونية', 'منتدى الساحات الإلكترونية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1206, 'منتديات الوئام', 'http://www.mahroom.net/', 'منتديات الوئام', 'منتديات الوئام', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1207, 'منتديات همس الغلا', 'http://www.hmsalghla.com/vb', 'منتديات همس الغلا', 'منتديات همس الغلا', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1208, 'منتديات ينبع الصناعية', 'http://www.rcyanbu.com/vb/index.php', 'منتديات ينبع الصناعية', 'منتديات ينبع الصناعية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1209, 'منتديات شبكة منبر الصفوة', 'http://www.fioif.com/vb', 'منتديات شبكة منبر الصفوة', 'منتديات شبكة منبر الصفوة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1210, 'منتديات شموخ', 'http://www.shomookh.com/', 'منتديات شموخ', 'منتديات شموخ', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1211, 'منتدى قمة', 'http://www.qmah.com/forum/index.php', 'منتدى قمة', 'منتدى قمة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1212, 'منتدى يدا بيد', 'http://forum.alsadeeq.net/', 'منتدى يدا بيد', 'منتدى يدا بيد', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1213, 'منتدى كورنر الطاهية', 'http://www.moderncafe.net/vb', 'منتدى كورنر الطاهية', 'منتدى كورنر الطاهية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1214, 'منتدى البريد العربي', 'http://www.arapost.com/', 'منتدى البريد العربي', 'منتدى البريد العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1215, 'مجالس شبابيات', 'http://www.shbabait.com/fourm/index.php', 'مجالس شبابيات', 'مجالس شبابيات', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1216, 'منتديات صدى الصحافة', 'http://www.al9da.net/vb/', 'منتديات صدى الصحافة', 'منتديات صدى الصحافة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1217, 'منتدى نواعم النت', 'http://www.wafanet.com/vbb/', 'منتدى نواعم النت', 'منتدى نواعم النت', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1218, 'منتدى حماية المستهلك', 'http://www.al-mostahlik.com/', 'منتدى حماية المستهلك', 'منتدى حماية المستهلك', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1219, 'منتدى اجتماعي', 'http://www.ejtemay.com/', 'منتدى اجتماعي', 'منتدى اجتماعي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1220, 'منتدى نبض القوافي', 'http://www.nalqawafi.com/vb/', 'منتدى نبض القوافي', 'منتدى نبض القوافي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1221, 'منتدى الديرة', 'http://www.aldeerah.net/vb/', 'منتدى الديرة', 'منتدى الديرة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1222, 'منتدى الجيش العربي', 'http://www.arab-army.com/', 'منتدى الجيش العربي', 'منتدى الجيش العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1223, 'منتديات ينبع سيتي', 'http://yanbu-city.com/vb/', 'منتديات ينبع سيتي', 'منتديات ينبع سيتي', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1224, 'منتدى شظايا أدبية', 'http://www.shathaaya.com/vb/', 'منتدى شظايا أدبية', 'منتدى شظايا أدبية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1225, 'منتدى بني مالك بجيلة', 'http://www.banimalk.net/vb/', 'منتدى بني مالك بجيلة', 'منتدى بني مالك بجيلة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1226, 'منتديات محافظة ضرماء', 'http://durmaa.com/vb/', 'منتديات محافظة ضرماء', 'منتديات محافظة ضرماء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1227, 'منتديات جبه', 'http://www.jubbah.net/vb/', 'منتديات جبه', 'منتديات جبه', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1228, 'منتديات شبكة الخرج', 'http://www.kharj.net/vb/', 'منتديات شبكة الخرج', 'منتديات شبكة الخرج', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1229, 'منتديات رفحاء', 'http://www.rafha.com/vb/', 'منتديات رفحاء', 'منتديات رفحاء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1230, 'منتدى بني هلال', 'http://www.bnihilal.com/vb', 'منتدى بني هلال', 'منتدى بني هلال', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1231, 'منتديات شبكة حريملاء', 'http://www.hrmla.com/forums/', 'منتديات شبكة حريملاء', 'منتديات شبكة حريملاء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1232, 'منتديات القصيم اليوم', 'http://www.qassimtoday.net/vb/', 'منتديات القصيم اليوم', 'منتديات القصيم اليوم', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1233, 'منتديات جراف', 'http://grraf.com/vb/', 'منتديات جراف', 'منتديات جراف', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1234, 'منتديات حدائق الخير', 'http://www.hadaeeq.com/vb303/', 'منتديات حدائق الخير', 'منتديات حدائق الخير', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1235, 'منتديات قبيلة حوازم حرب', 'منتديات قبيلة حوازم حرب', 'منتديات قبيلة حوازم حرب', 'منتديات قبيلة حوازم حرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1236, 'منتديات المقناص', 'http://www.al-mgnas.com/', 'منتديات المقناص', 'منتديات المقناص', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1237, 'منتدى فجر الغد', 'http://www.fjrona.com/', 'منتدى فجر الغد', 'منتدى فجر الغد', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1238, 'منتدى قبيلة بني كبير', 'http://www.banikabeer.com/vb/', 'منتدى قبيلة بني كبير', 'منتدى قبيلة بني كبير', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1239, 'منتديات محيط العرب', 'http://vb.arablocale.net/', 'منتديات محيط العرب', 'منتديات محيط العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1240, 'منتديات بنت حواء', 'http://www.hawa-girl.net/vb/', 'منتديات بنت حواء', 'منتديات بنت حواء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1241, 'منتدى قبيلة القثمة', 'http://www.alqthmh.com/vb/', 'منتدى قبيلة القثمة', 'منتدى قبيلة القثمة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1242, 'منتديات شبكة إب الخضراء', 'http://www.ibb7.com/vb/', 'منتديات شبكة إب الخضراء', 'منتديات شبكة إب الخضراء', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1243, 'منتديات مجالس قبيلة عنزه', 'http://www.3nze.com/vb', 'منتديات مجالس قبيلة عنزه', 'منتديات مجالس قبيلة عنزه', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1244, 'منتدى قبيلة الزقاريط من شمر', 'http://www.alzaqarit.com/vb/', 'منتدى قبيلة الزقاريط من شمر', 'منتدى قبيلة الزقاريط من شمر', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1245, 'منتديات الفردوس', 'http://st4rnet.com/vb/', 'منتديات الفردوس', 'منتديات الفردوس', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1246, 'منتديات الهبوب', 'http://www.habob.com/vb/', 'منتديات الهبوب', 'منتديات الهبوب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1247, 'منتديات الضويلة', 'http://www.aldhwailah.com/vb/', 'منتديات الضويلة', 'منتديات الضويلة', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1248, 'منتديات بوابة داماس', 'http://www.damasgate.com/vb/', 'منتديات بوابة داماس', 'منتديات بوابة داماس', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1249, 'منتديات ديوان العرب', 'http://www.diwan4arab.com/vb', 'منتديات ديوان العرب', 'منتديات ديوان العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1250, 'منتديات مهد الذهب', 'http://www.al-mahd.net/vb/', 'منتديات مهد الذهب', 'منتديات مهد الذهب', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1251, 'منتديات فيض النشامى', 'http://www.fid-alnashama.com/vb/', 'منتديات فيض النشامى', 'منتديات فيض النشامى', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1252, 'منتديات عنزة الوائلية', 'منتديات عنزة الوائلية', 'منتديات عنزة الوائلية', 'منتديات عنزة الوائلية', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1253, 'منتديات ساحات المجد', 'http://www.saa7aat.com/', 'منتديات ساحات المجد', 'منتديات ساحات المجد', '', '', '', 1, 73, 0, 0, 0, 1, '1213886702', 0, 0),
(1254, 'منتديات المشاغب للبرامج', 'http://www.absba.org/vb/', 'منتديات المشاغب للبرامج', 'منتديات المشاغب للبرامج', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1255, 'مركز بوابة العرب التعليمي', 'http://edu.arabsgate.com/', 'مركز بوابة العرب التعليمي', 'مركز بوابة العرب التعليمي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1256, 'منتدى شامل نت', 'http://www.shammel.net/vb', 'منتدى شامل نت', 'منتدى شامل نت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1257, 'منتدى بوابة الانترنت الرقمية', 'http://www.adslgate.com/dsl/', 'منتدى بوابة الانترنت الرقمية', 'منتدى بوابة الانترنت الرقمية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1258, 'منتديات لاب توب العرب', 'http://www.arabslaptop.net/vb/', 'منتديات لاب توب العرب', 'منتديات لاب توب العرب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1259, 'منتدي القرية الالكترونية', 'http://www.qariya.com/vb/', 'منتدي القرية الالكترونية', 'منتدي القرية الالكترونية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1260, 'منتديات كتاب العرب', 'http://university.arabsbook.com/', 'منتديات كتاب العرب', 'منتديات كتاب العرب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1261, 'منتدي امتياز للبرامج', 'http://www.emtiaz.net/', 'منتدي امتياز للبرامج', 'منتدي امتياز للبرامج', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1262, 'منتديات الجياش', 'http://forum.aljayyash.net/', 'منتديات الجياش', 'منتديات الجياش', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1263, 'منتديات جوال العرب', 'http://www.mobile4arab.com/vb/index.php', 'منتديات جوال العرب', 'منتديات جوال العرب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1264, 'منتدى فيجوال بيسك', 'http://www.vb4arab.com/vb/index.php?s=', 'منتدى فيجوال بيسك', 'منتدى فيجوال بيسك', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1265, 'منتدى قلعة الفوتوشوب', 'http://www.gl3a.com/vb/', 'منتدى قلعة الفوتوشوب', 'منتدى قلعة الفوتوشوب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1266, 'منتديات الحاسب في حياتنا', 'http://www.pcintv.com/vb/', 'منتديات الحاسب في حياتنا', 'منتديات الحاسب في حياتنا', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1267, 'منتدى أضواء فريق التصميم العربي', 'http://www.adt4w.com/vb/', 'منتدى أضواء فريق التصميم العربي', 'منتدى أضواء فريق التصميم العربي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1268, 'منتدى قرية بي اتش بي', 'http://www.phpvillage.org/community/', 'منتدى قرية بي اتش بي', 'منتدى قرية بي اتش بي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1269, 'منتديات أوفيسنا', 'http://www.officena.com/ib/', 'منتديات أوفيسنا', 'منتديات أوفيسنا', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1270, 'منتديات المحترفين العربية للبرامج', 'http://www.arabproshost.com/', 'منتديات المحترفين العربية للبرامج', 'منتديات المحترفين العربية للبرامج', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1271, 'منتديات نسج الخيال', 'http://www.nsj5.com/vb/index.php', 'منتديات نسج الخيال', 'منتديات نسج الخيال', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1272, 'منتدى دنيا تك للهاردوير', 'http://www.donyatech.com/', 'منتدى دنيا تك للهاردوير', 'منتدى دنيا تك للهاردوير', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1273, 'ملتقى نجوم الآي تي', 'http://itstars.ws/vb/', 'ملتقى نجوم الآي تي', 'ملتقى نجوم الآي تي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1274, 'منتديات المراوغ للبرامج', 'http://www.mgro7yn.com/vb/', 'منتديات المراوغ للبرامج', 'منتديات المراوغ للبرامج', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1275, 'منتدي عربو', 'http://www.3rb0.com/', 'منتدي عربو', 'منتدي عربو', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1276, 'منتديات ماك للعرب', 'http://www.mac4arabs.com/forums/', 'منتديات ماك للعرب', 'منتديات ماك للعرب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1277, 'منتديات البوابة العربية', 'http://www.arabportal.net/forum.php', 'منتديات البوابة العربية', 'منتديات البوابة العربية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1278, 'منتدى جوالات', 'http://www.jawalat.com/', 'منتدى جوالات', 'منتدى جوالات', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1279, 'منتديات النبراس للألعاب', 'http://alnebrasgames.com/forum/', 'منتديات النبراس للألعاب', 'منتديات النبراس للألعاب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1280, 'جو نوكيا', 'http://www.gonokia.com/vb', 'جو نوكيا', 'جو نوكيا', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1281, 'منتديات نوافذ عربية', 'http://arabs-win.com/net/', 'منتديات نوافذ عربية', 'منتديات نوافذ عربية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1282, 'منتديات اكسترا سوفت', 'http://extraa-soft.com/', 'منتديات اكسترا سوفت', 'منتديات اكسترا سوفت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1283, 'منتديات مساحات التقنية', 'http://www.vb.mes7at.com/', 'منتديات مساحات التقنية', 'منتديات مساحات التقنية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1284, 'منتديات الويب العربي', 'http://www.arabwebtalk.com/', 'منتديات الويب العربي', 'منتديات الويب العربي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1285, 'منتديات بيت التقنية', 'http://x7xr.com/vb/', 'منتديات بيت التقنية', 'منتديات بيت التقنية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1286, 'منتديات الويب', 'http://al-web.net/vb/', 'منتديات الويب', 'منتديات الويب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1287, 'منتديات الفريق العربي للأمن والحماية', 'http://www.atsdp.com/forum/', 'منتديات الفريق العربي للأمن والحماية', 'منتديات الفريق العربي للأمن والحماية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1288, 'منتدى فريق الأمن الإلكتروني', 'http://yee7.com/forums/', 'منتدى فريق الأمن الإلكتروني', 'منتدى فريق الأمن الإلكتروني', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1289, 'منتدى النطاقات العربي', 'http://www.nameclub.com/', 'منتدى النطاقات العربي', 'منتدى النطاقات العربي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1290, 'منتدى اتصالاتي', 'http://www.etsalati.com/', 'منتدى اتصالاتي', 'منتدى اتصالاتي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1291, 'منتديات تكنولوجي فورس', 'http://www.tech4c.com/vb/', 'منتديات تكنولوجي فورس', 'منتديات تكنولوجي فورس', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1292, 'منتديات شبكة آرا ويب التطويرية', 'http://www.arawebserv.com/vb', 'منتديات شبكة آرا ويب التطويرية', 'منتديات شبكة آرا ويب التطويرية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1293, 'منتديات مجتمع لينوكس العربي', 'http://www.linuxac.org/', 'منتديات مجتمع لينوكس العربي', 'منتديات مجتمع لينوكس العربي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1294, 'منتديات جهازك المحمول', 'http://www.jhazk.com/', 'منتديات جهازك المحمول', 'منتديات جهازك المحمول', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1295, 'منتديات ميكروسوفت للجميع', 'http://www.micro4all.com/', 'منتديات ميكروسوفت للجميع', 'منتديات ميكروسوفت للجميع', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1296, 'منتديات شبكة رعدى', 'http://www.r3dy.com/vb', 'منتديات شبكة رعدى', 'منتديات شبكة رعدى', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1297, 'منتدى مجتمع حياة تك', 'http://hayatech.com/c/', 'منتدى مجتمع حياة تك', 'منتدى مجتمع حياة تك', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1298, 'منتديات إسأل الكمبيوتر', 'http://www.ask-pc.com/vbx/', 'منتديات إسأل الكمبيوتر', 'منتديات إسأل الكمبيوتر', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1299, 'منتدى مكتبة نبع الوفاء', 'http://www.s0s0.com/vb/forumdisplay.php?f=28', 'منتدى مكتبة نبع الوفاء', 'منتدى مكتبة نبع الوفاء', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1300, 'منتديات شبكة برامج نت', 'http://www.bramj.net/vb', 'منتديات شبكة برامج نت', 'منتديات شبكة برامج نت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1301, 'منتديات تكنولوجيا الكون', 'http://forum.uni4tech.com/', 'منتديات تكنولوجيا الكون', 'منتديات تكنولوجيا الكون', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1302, 'منتديات ماك ارابيا', 'http://macarabia.net/forums.php', 'منتديات ماك ارابيا', 'منتديات ماك ارابيا', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1303, 'المنتدى العربي لتكنولوجيا المعلومات', 'http://www.arabitf.com/', 'المنتدى العربي لتكنولوجيا المعلومات', 'المنتدى العربي لتكنولوجيا المعلومات', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1304, 'منتديات برامجي سوفت', 'http://www.bramjy.com/vb/index.php', 'منتديات برامجي سوفت', 'منتديات برامجي سوفت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1305, 'منتدى الاوائل للبرامج', 'http://top.trytop.com/', 'منتدى الاوائل للبرامج', 'منتدى الاوائل للبرامج', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1306, 'منتدى أكاديمية بايتات التقنية', 'http://www.bytat.net/vb', 'منتدى أكاديمية بايتات التقنية', 'منتدى أكاديمية بايتات التقنية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1307, 'منتدى دبليو انتر', 'http://www.w-enter.com/forum/', 'منتدى دبليو انتر', 'منتدى دبليو انتر', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1308, 'منتديات تقنية المستقبل', 'http://www.fut4tech.com/vb/index.php?', 'منتديات تقنية المستقبل', 'منتديات تقنية المستقبل', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1309, 'منتديات زاجل', 'http://www.zajildot.com/forum/index.php', 'منتديات زاجل', 'منتديات زاجل', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1310, 'منتدى الشبكة العربية', 'http://www.arabspc.net/vb/', 'منتدى الشبكة العربية', 'منتدى الشبكة العربية', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1311, 'منتديات شبكة رسوم للجرافيكس', 'http://www.rsoom.com/vb', 'منتديات شبكة رسوم للجرافيكس', 'منتديات شبكة رسوم للجرافيكس', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1312, 'منتديات مذهل للجرافكس', 'http://www.mothhel.net/vb/', 'منتديات مذهل للجرافكس', 'منتديات مذهل للجرافكس', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1313, 'منتديات ثورة الفوتوشوب', 'http://www.ps-revolution.com/forum/', 'منتديات ثورة الفوتوشوب', 'منتديات ثورة الفوتوشوب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1314, 'منتدى فجوال سي للعرب', 'http://www.vc4arab.com/', 'منتدى فجوال سي للعرب', 'منتدى فجوال سي للعرب', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1315, 'منتديات الموبايل', 'http://almobile.maktoob.com/vb/', 'منتديات الموبايل', 'منتديات الموبايل', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1316, 'منتديات البرامج العربية والمعربة', 'http://www.ar-tr.com/vb', 'منتديات البرامج العربية والمعربة', 'منتديات البرامج العربية والمعربة', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1317, 'الفريق العربي للبرمجة', 'http://www.arabteam2000-forum.com/', 'الفريق العربي للبرمجة', 'الفريق العربي للبرمجة', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1318, 'منتدى برامج سوفت', 'http://www.paramegsoft.com/forum/', 'منتدى برامج سوفت', 'منتدى برامج سوفت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1319, 'منتدى الشرق', 'http://www.al-sharg.com/vb/', 'منتدى الشرق', 'منتدى الشرق', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1320, 'منتديات الكمبيوتر الكفي', 'http://www.ce4arab.com/vb7/index.php', 'منتديات الكمبيوتر الكفي', 'منتديات الكمبيوتر الكفي', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1321, 'منتدى عرب هاردوير', 'http://www.arabhardware.net/', 'منتدى عرب هاردوير', 'منتدى عرب هاردوير', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1322, 'منتديات ترايدنت', 'http://www.traidnt.net/vb/', 'منتديات ترايدنت', 'منتديات ترايدنت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1323, 'منتديات برامج نت', 'http://www.bramjnet.com/vb3/', 'منتديات برامج نت', 'منتديات برامج نت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1324, 'منتديات سوالف سوفت', 'http://www.swalif.net/softs/', 'منتديات سوالف سوفت', 'منتديات سوالف سوفت', '', '', '', 1, 58, 0, 0, 0, 1, '1213888456', 0, 0),
(1325, 'منتدى لك', 'http://www.lakii.com/vb/index.php', 'منتدى لك', 'منتدى لك', '', '', '', 1, 73, 0, 0, 0, 1, '1213890790', 0, 0),
(1326, 'منتدى الشاملة نت', 'http://www.fff.fm/', 'منتدى الشاملة نت', 'منتدى الشاملة نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1327, 'منتديات بوابة العرب', 'http://vb.arabsgate.com/', 'منتديات بوابة العرب', 'منتديات بوابة العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1328, 'منتديات الصايره', 'http://www.alsayra.com/vb/', 'منتديات الصايره', 'منتديات الصايره', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1329, 'منتديت أقلام الثقافية', 'http://aklaam.nepras.net/', 'منتديت أقلام الثقافية', 'منتديت أقلام الثقافية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1330, 'منتديات قصيمي نت', 'http://www.qassimy.com/vb/index.php', 'منتديات قصيمي نت', 'منتديات قصيمي نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1331, 'ديوانية حرب', 'http://www.alharbi-net.com/vb/', 'ديوانية حرب', 'ديوانية حرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1332, 'منتدى قبيلة عتيبة', 'http://www.otaibah.net/m/', 'منتدى قبيلة عتيبة', 'منتدى قبيلة عتيبة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1333, 'منتديات شبكة جهينه نت', 'http://www.johaynah.net/vb/', 'منتديات شبكة جهينه نت', 'منتديات شبكة جهينه نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1334, 'منتديات قبيلة بني زيد', 'http://www.banyzaid.net/vb/', 'منتديات قبيلة بني زيد', 'منتديات قبيلة بني زيد', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1335, 'منتدى القصمان', 'http://www.alqosman.net/vb/', 'منتدى القصمان', 'منتدى القصمان', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1336, 'منتدى النوادي', 'http://www.alnwadi.com/', 'منتدى النوادي', 'منتدى النوادي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1337, 'منتدى تويوتا العرب', 'http://www.toyota4arab.com/forum/', 'منتدى تويوتا العرب', 'منتدى تويوتا العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1338, 'مجالس كيوكات', 'http://majales.qcat.net/', 'مجالس كيوكات', 'مجالس كيوكات', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1339, 'ملتقى الحوار العربي', 'http://hdrmut.net/vb/', 'ملتقى الحوار العربي', 'ملتقى الحوار العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1340, 'منتديات بريدة ستي', 'http://www.buraydahcity.net/vb/', 'منتديات بريدة ستي', 'منتديات بريدة ستي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1341, 'منتديات القمة', 'http://alquma.net/vb/index.php?s=', 'منتديات القمة', 'منتديات القمة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1342, 'منتديات الفنان', 'http://host.atyab.info/suspended.page/', 'منتديات الفنان', 'منتديات الفنان', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1343, 'منتدى واحات سهارى', 'http://www.sahaara.com/vb/', 'منتدى واحات سهارى', 'منتدى واحات سهارى', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1344, 'منتديات همس الليل', 'http://www.alhams.net/vb/index.php?s=', 'منتديات همس الليل', 'منتديات همس الليل', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1345, 'منتدى السليل', 'http://www.sulayyil.com/vb/index.php', 'منتدى السليل', 'منتدى السليل', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1346, 'مجالس الصقور', 'http://www.ghamid.net/vb/index.php', 'مجالس الصقور', 'مجالس الصقور', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1347, 'منتدى بريدة', 'http://forum.buraydh.com/index.php', 'منتدى بريدة', 'منتدى بريدة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1348, 'منتديات شارقتي', 'http://www.shj4all.net/vb/', 'منتديات شارقتي', 'منتديات شارقتي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1349, 'ساحة العرب', 'http://www.arabsforum.com/', 'ساحة العرب', 'ساحة العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1350, 'المجلس اليمني للحوار', 'http://www.al-yemen.org/vb/', 'المجلس اليمني للحوار', 'المجلس اليمني للحوار', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1351, 'منابر المتميز نت', 'http://www.almotmaiz.net/vb/', 'منابر المتميز نت', 'منابر المتميز نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1352, 'منتدى ملتقى الاحبة', 'http://www.moltqa.com/vb/index.php', 'منتدى ملتقى الاحبة', 'منتدى ملتقى الاحبة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1353, 'سقيفة الشبامي', 'http://www.alshibami.net/saqifa/index.php', 'سقيفة الشبامي', 'سقيفة الشبامي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1354, 'منتديات أبناء العرب', 'http://www.arabsons.com/vb/', 'منتديات أبناء العرب', 'منتديات أبناء العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1355, 'منتديات حفر الباطن', 'http://www.hafaralbaten.net/vb', 'منتديات حفر الباطن', 'منتديات حفر الباطن', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1356, 'منتديات شواطىء', 'http://www.shawati.com/vb/index.php?s=', 'منتديات شواطىء', 'منتديات شواطىء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1357, 'المقهى العربي', 'http://arabscafe.com/vb/', 'المقهى العربي', 'المقهى العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1358, 'منتدى جبيل نت', 'http://www.jubailnet.com/vb/', 'منتدى جبيل نت', 'منتدى جبيل نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1359, 'منتدى القمر', 'http://www.moon15.com/vb/index.php', 'منتدى القمر', 'منتدى القمر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1360, 'منتدى قرية الابناء', 'http://www.alabna.net/vb/index.php?s=', 'منتدى قرية الابناء', 'منتدى قرية الابناء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1361, 'منتديات الساخر', 'http://www.alsakher.com/vb2', 'منتديات الساخر', 'منتديات الساخر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1362, 'منتدى مخيمات البراري', 'http://www.albrary.com/vb/', 'منتدى مخيمات البراري', 'منتدى مخيمات البراري', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1363, 'منتديات يزيد', 'http://www.yzeeed.com/vb', 'منتديات يزيد', 'منتديات يزيد', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1364, 'منتديات أصداف', 'http://www.asdaff.com/', 'منتديات أصداف', 'منتديات أصداف', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1365, 'منتدى الروضة', 'http://www.alrodh.com/vb', 'منتدى الروضة', 'منتدى الروضة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1366, 'ساحات العلا', 'http://www.al-ula.com/vb', 'ساحات العلا', 'ساحات العلا', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1367, 'منتديات المكنون', 'http://www.almaknoon.net/', 'منتديات المكنون', 'منتديات المكنون', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1368, 'منتديات الروابي', 'http://www.rwabi.net/vb', 'منتديات الروابي', 'منتديات الروابي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1369, 'منتديات مكشات', 'http://www.mekshat.com/vb', 'منتديات مكشات', 'منتديات مكشات', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1370, 'منتديات المجمعة', 'http://www.majmaah.net/', 'منتديات المجمعة', 'منتديات المجمعة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1371, 'منتديات الساحات السعودية', 'http://www.sahatsau.com/forum/', 'منتديات الساحات السعودية', 'منتديات الساحات السعودية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1372, 'منتديات رسايل', 'http://www.rsayel.com/vb/', 'منتديات رسايل', 'منتديات رسايل', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1373, 'منتديات الفارس', 'http://vb.alfaris.cc/index.php', 'منتديات الفارس', 'منتديات الفارس', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1374, 'منتديات الدرر', 'http://www.aldorr.com/vb/', 'منتديات الدرر', 'منتديات الدرر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1375, 'منتديات نبع الوفاء', 'http://www.s0s0.com/vb/', 'منتديات نبع الوفاء', 'منتديات نبع الوفاء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1376, 'منتديات عسير', 'http://www.asir1.com/as/', 'منتديات عسير', 'منتديات عسير', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1377, 'منتديات قلب المحيط', 'http://www.oc-h.com/vb', 'منتديات قلب المحيط', 'منتديات قلب المحيط', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1378, 'منتديات جامعة قطر', 'http://www.qataru.com/vb/', 'منتديات جامعة قطر', 'منتديات جامعة قطر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1379, 'منتديات ينبع الصناعية', 'http://www.yanbu1.com/vb/', 'منتديات ينبع الصناعية', 'منتديات ينبع الصناعية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1380, 'منتديات المقناص', 'http://www.megnas.com/', 'منتديات المقناص', 'منتديات المقناص', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1381, 'منتديات جاكم دوت كم', 'http://jaacom.com/vb/', 'منتديات جاكم دوت كم', 'منتديات جاكم دوت كم', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1382, 'منتديات الرس', 'http://www.al-rass.net/vb/', 'منتديات الرس', 'منتديات الرس', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1383, 'منتديات عاصمة الربيع', 'http://www.hafralbatin.com/vb/', 'منتديات عاصمة الربيع', 'منتديات عاصمة الربيع', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1384, 'منتديات هديل ويب', 'http://www.hadeelweb.com/vb', 'منتديات هديل ويب', 'منتديات هديل ويب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1385, 'منتدى صوت', 'http://www.saowt.com/forum/', 'منتدى صوت', 'منتدى صوت', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1386, 'منتدى البريد العربي', 'http://www.saudipostal.com/', 'منتدى البريد العربي', 'منتدى البريد العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1387, 'منتدى العروض رقميا', 'http://www.arood.com/vb/index.php?s', 'منتدى العروض رقميا', 'منتدى العروض رقميا', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1388, 'منتديات بني تميم', 'http://www.banitamim.net/forum/', 'منتديات بني تميم', 'منتديات بني تميم', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1389, 'منتديات برج القصيم', 'http://www.purj.com/', 'منتديات برج القصيم', 'منتديات برج القصيم', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1390, 'منتدى صحبة القصر', 'http://www.qaser.net/', 'منتدى صحبة القصر', 'منتدى صحبة القصر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1391, 'منتدى حسناء', 'http://www.hssna.com/vb/', 'منتدى حسناء', 'منتدى حسناء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1392, 'منتديات نبع العرب', 'http://www.arabswell.com/vb/', 'منتديات نبع العرب', 'منتديات نبع العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1393, 'منتديات شبكة طريف', 'http://www.turaif.net/vb/', 'منتديات شبكة طريف', 'منتديات شبكة طريف', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1394, 'منتدى الفراشة النسائي', 'http://www.alfrasha.com/', 'منتدى الفراشة النسائي', 'منتدى الفراشة النسائي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1395, 'ملتقيات القرية', 'http://www.algarya.net/hewar/index.php', 'ملتقيات القرية', 'ملتقيات القرية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1396, 'منتدى عدسات عربية', 'http://www.arabiclenses.com/forums.php', 'منتدى عدسات عربية', 'منتدى عدسات عربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1397, 'منتديات المواهب', 'http://www.mwaheb.net/vb/', 'منتديات المواهب', 'منتديات المواهب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1398, 'منتديات أم عبدالله النسائية', 'http://www.umabdullah.com/ib/', 'منتديات أم عبدالله النسائية', 'منتديات أم عبدالله النسائية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1399, 'منتدى بحور الوفاء', 'http://www.alb7ooor.com/vb/', 'منتدى بحور الوفاء', 'منتدى بحور الوفاء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1400, 'مجالس مدينة المذنب', 'http://www.methnb.com/forums/index.php', 'مجالس مدينة المذنب', 'مجالس مدينة المذنب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1401, 'منتديات العصر', 'http://www.al3sr.com/', 'منتديات العصر', 'منتديات العصر', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1402, 'منتدى الجزيرة', 'http://albeed.com/', 'منتدى الجزيرة', 'منتدى الجزيرة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1403, 'واحة العرب', 'http://www.wahatalarab.net/', 'واحة العرب', 'واحة العرب', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1404, 'منتديات روضة الأسرة', 'http://www.roodh.com/vb/', 'منتديات روضة الأسرة', 'منتديات روضة الأسرة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1405, 'منتديات القاف الأدبية', 'http://www.algaf.net/vb', 'منتديات القاف الأدبية', 'منتديات القاف الأدبية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1406, 'منتدى الجوف', 'http://www.j00f.com/vb/', 'منتدى الجوف', 'منتدى الجوف', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1407, 'منتدى نادى محبى الحيوانات الاليفة', 'http://www.ourpetclub.com/', 'منتدى نادى محبى الحيوانات الاليفة', 'منتدى نادى محبى الحيوانات الاليفة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1408, 'منتديات انظمة التسليح العربي', 'http://www.arab-military.com/', 'منتديات انظمة التسليح العربي', 'منتديات انظمة التسليح العربي', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1409, 'منتديات الكتب المصورة', 'http://www.pdfbooks.net/vb/', 'منتديات الكتب المصورة', 'منتديات الكتب المصورة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1410, 'نادي المنتديات العربية', 'http://www.alnaadi.com/', 'نادي المنتديات العربية', 'نادي المنتديات العربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1411, 'منتدى محافظة البدائع', 'http://www.albadaya.net/vb/', 'منتدى محافظة البدائع', 'منتدى محافظة البدائع', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1412, 'منتديات العيص', 'http://www.al3es.net/Vb', 'منتديات العيص', 'منتديات العيص', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1413, 'منتديات روضة سدير', 'http://www.sudayr.com/vb/', 'منتديات روضة سدير', 'منتديات روضة سدير', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1414, 'منتدى النماص', 'http://alnamas.net/vb/', 'منتدى النماص', 'منتدى النماص', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1415, 'منتديات الليث', 'http://www.alhdriti.net/vb/', 'منتديات الليث', 'منتديات الليث', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1416, 'منتديات نعام', 'http://www.n3am.com/vb/', 'منتديات نعام', 'منتديات نعام', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1417, 'منتديات مدينة شقراء', 'http://www.shaqra-city.com/vb/', 'منتديات مدينة شقراء', 'منتديات مدينة شقراء', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1418, 'دكات عنيزة', 'http://www.unaizah.net/', 'دكات عنيزة', 'دكات عنيزة', '', '', '', 1, 73, 0, 0, 0, 1, '1213890791', 0, 0),
(1419, 'منتديات عروس الجبال', 'http://www.3-jebal.com/', 'منتديات عروس الجبال', 'منتديات عروس الجبال', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1420, 'منتدى اقلام عربية', 'http://www.aqlam-arabia.net/vb/', 'منتدى اقلام عربية', 'منتدى اقلام عربية', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1421, 'منتديات مدينة خميس مشيط', 'http://www.khamiscity.com/vb', 'منتديات مدينة خميس مشيط', 'منتديات مدينة خميس مشيط', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1422, 'منتديات حزنة', 'http://www.heznah.net/vb/', 'منتديات حزنة', 'منتديات حزنة', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1423, 'منتديات النبراس', 'http://www.alnebras.com/forums/', 'منتديات النبراس', 'منتديات النبراس', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1424, 'منتديات النشاما', 'http://www.alnshama.com/vb/', 'منتديات النشاما', 'منتديات النشاما', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1425, 'منتديات غلاكم النسائية', 'http://www.al-frsaan.com/vb/', 'منتديات غلاكم النسائية', 'منتديات غلاكم النسائية', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1426, 'منتديات أيام', 'http://ayaam.com/vb/', 'منتديات أيام', 'منتديات أيام', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1427, 'منتديات مدينة الظهران', 'http://www.dhahrancity.com/vb/', 'منتديات مدينة الظهران', 'منتديات مدينة الظهران', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1428, 'منتديات همسة حنان', 'http://www.7zzz7.com/vb', 'منتديات همسة حنان', 'منتديات همسة حنان', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1429, 'منتديات مطبخي', 'http://www.mtbkhy.com/', 'منتديات مطبخي', 'منتديات مطبخي', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1430, 'مجالس بني كبير', 'http://bani-kabeer.com/vb/', 'مجالس بني كبير', 'مجالس بني كبير', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1431, 'منتديات شبكة ظهران الجنوب', 'http://www.dhran.com/vb/', 'منتديات شبكة ظهران الجنوب', 'منتديات شبكة ظهران الجنوب', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1432, 'منتديات فنون الحياة الزوجية', 'http://www.fn7z.com/vb/', 'منتديات فنون الحياة الزوجية', 'منتديات فنون الحياة الزوجية', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1433, 'منتديات بلاد بلقرن', 'http://www.blqarn.net/vb', 'منتديات بلاد بلقرن', 'منتديات بلاد بلقرن', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1434, 'منتدى أخوات طريق الجنة', 'http://www.akhawat-aljannahway.ahlamontada.com/', 'منتدى أخوات طريق الجنة', 'منتدى أخوات طريق الجنة', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1435, 'مجالس الأهادلة', 'http://www.alahdal.net/vb/', 'مجالس الأهادلة', 'مجالس الأهادلة', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1436, 'منتديات المدينة اون لاين', 'http://almadinahonline.com/vb/', 'منتديات المدينة اون لاين', 'منتديات المدينة اون لاين', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1437, 'منتديات البريد وتقنية المعلومات', 'http://www.technpost.com/', 'منتديات البريد وتقنية المعلومات', 'منتديات البريد وتقنية المعلومات', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1439, 'منتديات أسرة نت', 'http://www.osrah.net/forum/', 'منتديات أسرة نت', 'منتديات أسرة نت', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1440, 'منتدى عالم بلا مشكلات', 'http://www.noo-problems.com/vb/', 'منتدى عالم بلا مشكلات', 'منتدى عالم بلا مشكلات', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1441, 'منتديات محافظة عفيف', 'http://www.afifcity.com/vb/', 'منتديات محافظة عفيف', 'منتديات محافظة عفيف', '', '', '', 1, 73, 0, 0, 0, 1, '1213891451', 0, 0),
(1471, 'شبكة أنا مسلم أون لاين', 'http://ana-moslem.com', 'موقع إسلامى يوضح مدى صدق الإسلام والرسول ورسالته ويبين أخلاق المسلم وعقيدته وينتقد الإعلام بعين إسلامية وينادى بعدم الطائفية وتطبيق الإسلام بما يحمله من وسطيه وإعتدال ورحمه وعدم تعصب والمعاملة الحسنة مع أهل  الكتاب والإلتزام بأحكام الدين الحنيف ويتواجد بالموقع مقالات خاصة للموقع من أئمة مساجد ... ويحتوى الموقع على منتدى به العديد من الأقسام الإسلامية و العامة كالبرامج والجوال وحل مشاكل الكمبيوتر .. إلخ .. ويحتوى الموقع أيضا على مجلة تصدر شهرياً .. وراديو بث مباشر ... وإستضافة للمواقع العامة والإسلامية وبيع نطاقات وسعر خاص لإستضافة المواقع الإسلامية', 'مسلم,عقيدة,الله,الإسلام,الرسول,الرسالة,صدق,أخلاق,المسلم,أخبار,منتدى,مجلة,راديو,إعلام,إستضافة', 'eg', 'ramy', 'webmaster@ana-moslem.com', 1, 1, 0, 0, 0, 1, '1214903007', 0, 0),
(1472, 'قلعة المواقع الإسلامية', 'http://www.islamcastle.com', 'قلعة المواقع الإسلامية. أضخم دليل إسلامي', 'مواقع, اسلامبة, دليل, موقع, اناشيد, قلاشات', 'ps', 'admin', 'admin@admin.com', 1, 72, 0, 0, 0, 1, '1215003079', 0, 0);
");	
$sql_27 .= mysql_query("
INSERT INTO `dlil_site` (`id`, `title`, `url`, `metadescription`, `metakeywords`, `country`, `yourname`, `yourmail`, `active`, `cat`, `vis`, `rate`, `count`, `lang`, `date`, `language_id`, `country_id`) VALUES
(1682, 'فوركس فايزر', 'http://www.forexvisor.com/affiliate/jrox.php?id=10012', 'يعتبر موقع فوركس فايزر وسيلة ناجعة للمستثمرين تساعدهم على المتاجرة الناجحة بسوق العملات.\r\nولكي تتعرف على أفضليات الموقع والهدف الأساسي من إقامته بإمكانك الضغط على \" لماذا فوركس فايزر\" ، فتظهر أمامك صفحة تحوي شرح وافي عن خدماتنا التي نقدمها للمستثمرين، مثل : التحليل الفني والدقيق لسوق المتاجرة العالمي في وقت حقيقي وبشكل حي ومباشر، والحصول على توصيات بواسطة البريد الالكتروني، إضافة على ذلك توفر فوركس فايزر  خدمة جديدة لمستخدميها، وهي إرسال توصيات بواسطة رسائل قصيرة إلى الهاتف الخلوي بشكل مباشر مع صدور التوصية', 'يعتبر موقع فوركس فايزر وسيلة ناجعة للمستثمرين تساعدهم على المتاجرة الناجحة بسوق العملات.\r\nولكي تتعرف على أفضليات الموقع والهدف الأساسي من إقامته بإمكانك الضغط على \" لماذا فوركس فايزر\" ، فتظهر أمامك صفحة تحوي شرح وافي عن خدماتنا التي نقدمها للمستثمرين، مثل : التحليل الفني والدقيق لسوق المتاجرة العالمي في وقت حقيقي وبشكل حي ومباشر، والحصول على توصيات بواسطة البريد الالكتروني، إضافة على ذلك توفر فوركس فايزر  خدمة جديدة لمستخدميها، وهي إرسال توصيات بواسطة رسائل قصيرة إلى الهاتف الخلوي بشكل مباشر مع صدور التوصية', 'ps', 'محمد', 'forex.v.f@gmail.com', 1, 66, 0, 0, 0, 1, '1227864279', 0, 0),
(1685, 'مربع لخدمات الإستضافة|| Murabba For Hosting Srevices', 'http://murabba.org', 'مربع لخدمات الإستضافة|| Murabba For Hosting Srevices', 'استضافة, استضافة cpanel, استضافة سعودية, استضافة صفحات, استضافة عربية, استضافة غير محدودة, استضافة مجانا, استضافة مجانية, استضافة منتدى, استضافة منتديات, استضافة مواقع, استضافة مواقع asp, استضافة مواقع الانترنت, استضافة موقع, استضافه, افضل استضافة', 'sa', 'yaser', 'admin@murabba.org', 1, 31, 0, 0, 0, 1, '1228072428', 0, 0),
(1686, 'موقع الشروق للبرمجة والتصميم', 'http://www.zmzmy.com/', 'تصميم برامج ومواقع ومنتديات', 'موقع الشروق للبرمجة والتصميم', 'eg', 'شروق', 'ash@s77.com', 1, 61, 0, 0, 0, 1, '1228311184', 0, 0),
(1697, 'عرب فور فويس', 'http://www.arba4voice.com', 'عرب فور فويس لاستضافة وخدمات الشات الصوتي والكتابي+خدمات البرمجة', 'عرب فور فويس لاستضافة وخدمات الشات الصوتي والكتابي+خدمات البرمجة', 'sa', 'علي', 'arb4voice@hotmail.com', 1, 32, 0, 0, 0, 1, '1228953970', 0, 0),
(1702, 'منتديات القحمه', 'http://www.alqahmah.com', 'منتديات القحمه', 'منتديات القحمه', 'sa', 'صالح', 'aa-ss55@hotmail.com', 1, 73, 0, 0, 0, 1, '1229298928', 0, 0),
(1707, 'الأكاديمية السويسرية لعلوم الحاسب وإدارة الأعمال', 'http://www.scac-edu.com', 'S.C.A.C - Swiss Academy of Computer Science and Business Administration', 'S.C.A.C, الاكاديمية السويسرية لعلوم الحاسب وادارة الاعمال, معهد علوم الحاسب وادارة الاعمال', 'eg', 'scac', 'adv@scac-edu.com', 1, 63, 0, 0, 0, 1, '1229543831', 0, 0),
(1711, 'ماركت تداول', 'http://www.tdwlup.com', 'موقع متخصص في توصيات الاسهم السعودية والتي يتم ارسالها بشكل منظم عن طريق الجوال للمشتركين. ويستفيد من خدمات هذا الموقع الكثير من المستثمرين في سوق الاسهم السعودية وباسعار منافسة جدا. التجربة خير برهان', 'ماركت تداول', 'sa', 'zZ', 'qz2@hotmail.com', 1, 66, 0, 0, 0, 1, '1229717992', 0, 0),
(1714, 'منتديات قبيلة حوازم حرب', 'http://www.al-hazme.com', 'الموقع الرسمي والأول للقبيلة على الانترنت * فروع حوزام حرب *ديارحوازم حرب * شجرة حوازم حرب *قصص حوازم حرب *عادات وتقاليد حوازم حرب *وثائق حوازم حرب *', 'حوازم ، الحوازم ، ديار ، شجرة حوازم ، الحازمي ، وثائق، عادات  تقاليد ،بطولات ، تاريخ ، قصص ، الموقع الرسمي ، حازمي ، حازم، الحازم', 'sa', 'الجبولي', 'ssmk22@hotmail.com', 1, 71, 0, 0, 0, 1, '1229866836', 0, 0),
(1807, 'دليل مواقع نور', 'http://www.nooor.info/dir', 'دليل المواقع العربية نور - اشهار مجاني للمواقع - اضف موقعك و اربح باك لينك مجانا و ارفع البيج رانك', 'دليل نور, نور, دليل مواقع, اضف موقعك, مجانا, اشهار المواقع, البيج رانك', 'eg', 'نور', '', 1, 65, 0, 0, 0, 1, '1231940543', 0, 0),
(1808, 'دليل مواقع سما البرامج', 'http://www.sky-bramj.com/dir/', 'دليل مواقع سما البرامج,دليل مواقع عربي.ادلة,محركات بحث', 'دليل مواقع سما البرامج,دليل مواقع عربي.ادلة,محركات بحث', 'jo', 'كمال', 'nooo_pm@yahoo.co.uk', 1, 65, 0, 0, 0, 1, '1231940704', 0, 0),
(1810, 'JobsEyes', 'http://www.jobseyes.com', 'نحن نوفر فرص العمل في جميع أنحاء الوطن العربي\r\n و دول الخليج من جميع التخصصات', 'لكل من يطلب عمل, فرص عمل,  مطلوب موظفين, وظائف شاغرة في جميع أنحاء الوطن العربي و دول الخليج من جميع التخصصات ,  مهندسين , أطباء , صيادلة , مدرسين , مبرمجين , حرفيين , وجميع المهن الأخرى', 'jo', 'Hazem', 'rara1990rara@yahoo.com', 1, 34, 0, 0, 0, 2, '1231943692', 0, 0),
(1826, 'شركة مصر للأستضافة والتصميم', 'http://www.egypt2host.com', 'شركة مصر للأستضافه وخدمات المواقع والتصميم والبرمجة والحماية والدعم الفنى المتكامل وادارة مواقع ومنتديات والشهرة ونشر الموقع فى جوجل والياهو وجميع محركات البحث العالمية ونشر الموقع فى الادله العربية والاجنبية وتركيب واعداد السكربتات وتركيب نسخه فى بى وتعريبها وحمايتها وحجز دومينات نحن نضمن لك موقع متكامل فى عالم الانترنت بأعلى جوده واقــل تكلفة وأسرع وقــت', 'شركة مصر للأستضافه وخدمات المواقع والتصميم والبرمجة والحماية والدعم الفنى المتكامل وادارة مواقع ومنتديات والشهرة ونشر الموقع فى جوجل والياهو وجميع محركات البحث العالمية ونشر الموقع فى الادله العربية والاجنبية وتركيب واعداد السكربتات وتركيب نسخه فى بى وتعريبها وحمايتها وحجز دومينات نحن نضمن لك موقع متكامل فى عالم الانترنت بأعلى جوده واقــل تكلفة وأسرع وقــت', 'eg', 'محمد انس محمد ', 'admin@egypt2host.com', 1, 59, 0, 0, 0, 1, '1232184734', 0, 0),
(1833, 'استضافة عالمك', 'http://www.3almk.com', 'شركة عالمك لخدمات الاستضافة والتصميم - حماية المواقع - تركيب اسكربتات - منتديات - تطوير - الجمهورية العربية \r\nالسورية - سيرفرات - رسيلر - vps - رسائل جوال - دردشات', 'دردشة,صوتية,كتابية,محادثة عربية,خليجية,شبكة عالمك,برنامج,برامج,البرامج,العاب,ألعاب,لعبة,لعبه,لعب,\r\n\r\nتحميل,تنزيل,نزل,حمل,رفع,صور,جوال,موبايل,محمول,ثيمات,خلفيات,6600,نوكي,سامسونج,احدث,اقوي,\r\n\r\nافضل,منتدي,منتديات,موضوع,موضوعات,7610,مجان,بالمجان مكتوب,الجزيرة,جواب,بريد,ايميل,دليل,سباق,\r\n\r\nمعرض,مكتبة,خطوط,خط,قديم,جديد ,مصر,السعودية,الكويت,الامارات,فلسطين,العراق,لبنان,اسرائيل,امريكا \r\n\r\nمصرية,كويتية,خليجية,سعودية,اماراتية,مغربية,جروب,قروب,كومبيوتر,برامج نت,كراك,مولد ارقام,كراكات,\r\n\r\nسيريال,حاسب الي,القمر,تقنية,شباب,بنات,ماسنجر,تعارف,مسنجر,مصر,عرب,العرب,عربي,مصري,دردشة,\r\n\r\nمسابقات,الغاز,جوائز,رياضة,بلايستيشن,بلاي ستيشن,فلاش,فلاشات,سويتش,تصميم,جرافيك,فوتوشوب,\r\n\r\nالفوتوشوب,دروس,شروحات,طريقة,ستايلات,فلاتر,فلتر,بلوتوث,مقاطع,اسلام,اسلامي,دين,مرأة,ياهو,جوجل,\r\n\r\nمايكروسوفت,google,msn,yahoo,games,download,free,arab,arabic,nok\r\n\r\nia,forum,chat,photoshop,USA,arab news,3almk,alamk,شركة عالمك,\r\n\r\nشركات الاستضافة السورية,عالمك,شبكةعالمك', 'sy', 'rami', 'ramiashkar1982@hotmail.com', 1, 31, 0, 0, 0, 1, '1232364347', 0, 0),
(4652, 'منتدى قبيلة معبد', 'http://www.mu3abbad.net/', 'الموقع الرسمي للقبيلة واول موقع على الشبكة العنكبوتيه', 'نسب معبد , ديار معبد , مشايخ معبد , المعابيد , النتاف', 'sa', 'ابناء القبيلة', 'f656n2008@hotmail.com', 1, 71, 0, 0, 0, 1, '1295786849', 1, 181),
(4669, 'بكسلات', 'http://www.pixelat.com', 'تصميم المواقع - تصميم الواجهات - تصميم ستايلات المنتديات - تصميم شعارات - تصميم الفلاشات - تصميم اعلانات', 'تصميم,تطوير,مواقع,منتديات', 'sa', 'PIXELAT', 'info@pixelat.com', 1, 30, 0, 0, 0, 1, '1296070304', 1, 181),
(4671, 'اشهار سعودي كليك', 'http://www.saudi-click.com', 'سعودي كليك للخدمات الالكترونية هي شركة سعودية تهدف الى مساعدة عملائها عن طريق تقديم افضل العروض\r\nونعمل جميعاً لتحقيق مصداقية شعارنا \"أرقى خدمات الويب\" تعودنا أن نجعل خدماتنا شاهدة علينا نسخّر لك كافة\r\n الإمكانيات لتحقيق ما يصبو إلـيـه حلـمـك و نحن نؤمن بالتخصـص، وتذكر بأن مخيلتك هي البداية لـعــمــل مـمـيـــز ،،', 'اشهار سعودي كليك ، اشهار ، اشهار كليك ، تنشيط مواضيع ، شركة اشهار ، شركة اشهار سعودية ، تنشيط سعودي\r\nتنشيط منتديات ، مواقع للبيع ، بيع مواقع ، سوق المواقع ، سوق كليك ، كليك ، عربي كليك ، سعودي كليك ، كليك', 'sa', 'متعب', 'dam@saudi-click.com', 1, 32, 0, 0, 0, 1, '1296164775', 1, 181),
(4672, 'منتدى مسلمة', 'http://www.muslmah.net/', 'تعني بجميع إهتمامات المرأة المسلمة وتلبية جميع إحتياجاتها في جو نسائي آمن', 'منتدى مسلمة', 'kw', 'ام عبدالرحمن', 'muslmah@hotmail.com', 1, 52, 0, 0, 0, 1, '1296294902', 1, 112),
(7379, 'نواحي', 'http://www.nwahy.com/', 'موقع نواحي لتعليم لغات البرمجة والتصميم وتقديم السكربتات المجانية والسكربتات الإسلامية', 'نواحي,سكربت,سكربتات', NULL, 'أحمد العنزي', 'nwahycom@gmail.com', 1, 25, 0, 0, 0, 0, '1423243222', 1, 112),
(7380, 'بوابة الكويت الدعوية Da`wah Focused Network', 'http://www.islam.com.kw', 'Islam | Da`wah Focused Network - Your Way to Understanding Islam', 'Islam, Da`wah Focused Network, Your Way to Understanding Islam', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423243585', 2, 112),
(7381, 'المهتدون الجدد New Muslims', 'http://www.new-muslims.info', 'New Muslims aspires to be a unique interactive and informative online resource about Islam for new Muslims as well as potential converts.', 'New,muslims,new,to,islam,converts,to,islam,new,muslim,convert,to,islam,converted,to,islam,converting,to,islam,new,muslim,converts,conversion,to,islam,muslim,conversion,Islamic,conversion,new,muslim,stories,muslim,reverts,how,to,become,a,muslim,how,to,convert,to,islam,recently,converted,to,islam,new,muslim,guide,step,by,step,guide,to,islam,conversion,stories,famous,converts,to,islam,newmuslim,newmuslims', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423243948', 2, 112),
(7382, 'الصلاة في الإسلام Prayer in Islam', 'http://www.prayerinislam.com/', 'Prayer In Islam aspires to be a unique and simple online guide on Prayer and how to perform it properly. It seeks to teach Muslims how to pray as correctly as Prophet Muhammad did.', 'الصلاة في الإسلام Prayer in Islam', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423243948', 2, 112),
(7383, 'تعليم القرآن الكريم Learn the Qur''an', 'http://www.learning-quran.com', 'Learn the Qur&#039;an intends to be one of the main online sources of information and a professional training platform for those eager to learn how to recite the Qur&#039;an correctly, commit it to their hearts, understand its verses well, and receive its message right.', 'learning,learn,Qur&#039;an,recitation,tajweed,noble,emissaries,interpretation,translation,memorization,double,reward', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7384, 'إذاعات القرآن الكريم Qur''an Online Radio', 'http://quraan.us', 'إذاعات القرآن الكريم - ترجمات معاني القرآن الكريم بلغات مختلفة', 'إذاعات القرآن الكريم Qur''an Online Radio', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 1, 112),
(7385, 'ترجمة معاني القرآن الكريم MP3 Qur''an Translations', 'http://www.qurantranslations.net', 'Qur''an Translations offers a high quality Qur''an translations in 30 languages. Get these translations for free &amp; share the massage.', 'audio,quran,translation,,quran,recitation,with,translation,,mp3,quran,translation,,Quran,Translations,in,different,languages,,muslim,holy,book', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7386, 'مهارات الدعوة Da`wah Skills', 'http://www.dawahskills.com/', 'Da`wah Skills is an online source of information and a professional training platform for those engaged in Da`wah (calling to Islam) activities.', 'dawah,tools,,Communication,Skills,,Presentation,Skills,,Persuasion,Skills,,Computer,Skills,,ABC’s,of,Dawah,,Torchbearers,of,dawah,,Comparative,Religion,,misconceptions,about,islam,,web,skills,,dawah,materials,,calling,to,islam,,inviting,others,to,islam,,dawah,methodology,,dawah,techniques,,dawah,techniques,,dawa,mission,,dawah,training,program,,online,dawah,training,course,,Dawah,Training,Course,,PDF,Dawah,Training,Course,,Islamic,Courses,,dawah,skills,', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7387, 'المكتبة الإسلامية الإلكترونية الشاملة', 'http://www.muslim-library.com/', 'يتطلع موقع المكتبة الإسلامية الإلكترونية الشاملة إلى أن يكون مصدراً شاملا للكتب التي تتعلق بالإسلام والمسلمين والأديان الأخرى باللغات المختلفة مع إتاحة تحميل هذه الكتب.', 'المكتبة الإسلامية الإلكترونية الشاملة', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 1, 112),
(7388, 'المدونات الدعوية IPC Bloggers', 'http://ipcblogger.net/', 'IPC Bloggers Network', 'المدونات الدعوية IPC Bloggers', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7389, 'الباحث عن الحقيقة Truth Seeker', 'http://www.truth-seeker.info', 'The Truth Seeker Website aspires to be a unique, reliable refuge and online source of information regarding the truth of the creation, the Creator Allah and His existence, and the purpose of life.', 'الباحث عن الحقيقة Truth Seeker', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7390, 'الإيمان The Faith', 'http://www.the-faith.com', 'The Faith introduces Islam to non-Muslims. It provides information about the Qur’an, Prophet Muhammad, and Islamic civilization.', 'introduction,to,islam,,introducing,islam,,presenting,islam,,islam,in,brief,,islam,in,focu,,what,is,islam,,islam,and,muslims,,mutual,understanding,,interfaith,dialogue,,what,is,the,quran,,islam,and,politics,,family,in,islam,islam,and,environment,,islam,and,democracy', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7391, 'المعجزة الأخيرة Last Miracle', 'http://www.lastmiracle.com', 'Videos and Documentaries about Islam', 'المعجزة الأخيرة Last Miracle', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7392, 'دعوة النصارى Islam for Christians', 'http://www.islamforchristians.com', 'Islamforchristians is a main informative online source of knowledge about the true message of prophet Jesus and how Muslims view him.', 'دعوة النصارى Islam for Christians', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423244999', 2, 112),
(7393, 'دعوة الهندوس Islam for Hindus', 'http://www.islamforhindus.com', 'موقع متخصص في دعوة الهندوس', 'دعوة الهندوس Islam for Hindus', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423245145', 2, 112),
(7394, 'لجنة الدعوة الإلكترونية', 'http://www.edc.org.kw', 'لجنة الدعوة الإلكترونية', 'لجنة الدعوة الإلكترونية', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423245290', 1, 112),
(7395, 'جمعية النجاة الخيرية', 'http://alnajat.org.kw', 'جمعية النجاة الخيرية', 'جمعية النجاة الخيرية', NULL, 'جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423245413', 1, 112),
(7396, 'لجنة التعريف بالإسلام', 'http://ipc.org.kw', 'هدفنا أن نكون اللجنة الرائدة في التعريف بالإسلام ورعاية المسلمين الجدد والجاليات على المستوى المحلي والدولي.', 'التعريف بالاسلام,اسلام,الاسلام,القرآن الكريم,ترجمة القرآن الكريم,قصص,قصص المتهدين,تلاوات,كتب,كتب دعوية,مواد دعوية,دعوة غير المسلمين,تعريف,وقف,وقفيات,مشاريع,ادارات,لجنة خيريه,بحث,بحوث,أعمال دعوية,افطار صائم,رمضان,اوردو,هندي,بنغالي,مالايالم,صيني,كوري,انجليزي,فرنسي,الماني,اسباني,سنهالي,روسي,برتغالي,كناد,اخبار,مدونات,المدونات الدعوية,مجلات,المجلات الدعوية,طلب,طلبات المواد الكتب,محاضرات,صوتيات,البوم,النجاة,طباعة القرآن الكريم,تبرعات,صدقات,زكاة,رعاية المهتدين,كفالة الدعاة,داعية,حج,عمرة,مكتبة دعوية,التوحيد,العقيدة,رحمة للعالمين,تدريب,تأهيل,العمل الخيري,المجال الدعوي,جاليات,مهتدي,اشهار اسلامي,رحلة عمرة,اللغة العربية,طب,رعاية,حفظ القرآن الكريم,دعوة,إرشاد,الطرق الدعوية,رحلات ترفيهية,مقابلات,حوارات,ندوات,مؤتمرات,نشرات,مطبوعات,مصاحف,حقيبة الهداية,حلقات تحفيظ,برامج,اصدارات,فصول دراسية,تثقيف', NULL, 'جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423245515', 1, 112),
(7397, 'المركز الكويتي الفبيني Kuwait Philippine Cultural Center', 'http://www.kpccenter.com', 'المركز الكويتي الفبيني Kuwait Philippine Cultural Center', 'المركز الكويتي الفبيني Kuwait Philippine Cultural Center', NULL, 'جمعية النجاة الخيرية', '', 1, 1, 0, 0, 0, 0, '1423245639', 2, 112),
(7398, 'سكربت دليل نواحي Nwahy Directory V3', 'http://www.nwahy.com/showdownload-3138.html', 'سكربت دليل نواحي Nwahy Directory V3', 'سكربت دليل نواحي Nwahy Directory V3', NULL, 'احمد العنزي', 'nwahycom@gmail.com', 1, 74, 0, 0, 0, 0, '1427660198', 1, 112),
(7399, 'سكربت DFN latest posts', 'http://www.nwahy.com/showdownload-3137.html', 'سكربت DFN latest posts يعتبر سكربت دعوي مجاني خفيف التصفح وصغير الحجم يحتوي على مواضيع كثيرة بروابطها المباشرة وكتب دعوية بأكثر من 88 لغة وإذاعات لترجمات معاني القرآن الكريم بأكثر من 38 لغة تعمل طوال اليوم بدون توقف.', 'سكربت DFN latest posts', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 74, 0, 0, 0, 0, '1427660365', 2, 112),
(7400, 'سكربت دعوة بلا حدود الاصدار 2.0 Islam Beyond Borders', 'http://www.nwahy.com/showdownload-3136.html', 'سكربت دعوة بلا حدود الاصدار 2.0 Islam Beyond Borders يحتوي السكربت على أكثر من 2500 مقال نصي ومادة مرئية كلها باللغة الانجليزية وايضا 35 إذاعة خاصة بترجمة معاني القرآن الكريم', 'سكربت دعوة بلا حدود الاصدار 2.0 Islam Beyond Borders', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 74, 0, 0, 0, 0, '1427660525', 2, 112),
(7401, 'سكربت القرآن الكريم للجميع الاصدار 1.2', 'http://www.nwahy.com/showdownload-3133.html', 'سكربت القرآن الكريم يحتوي على خمس تفاسير للقرآن الكريم ابن كثير - الجلالين - الطبري - القرطبي - السعدي ويحتوي على اكثر 40 ترجمة لمعاني القرآن الكريم وأيضا مواد سمعيه لأكثر من 30 قاريء', 'سكربت القرآن الكريم للجميع الاصدار 1.2', NULL, 'احمد العنزي', 'nwahycom@gmail.com', 1, 74, 0, 0, 0, 0, '1427660663', 1, 112),
(7402, 'سكربت المقالات الاصدار 2.2', 'http://www.nwahy.com/showdownload-3130.html', 'سكربت المقالات الاصدار 2.2 من أفضل السكربتات لإدارة محتوى موقعك', 'سكربت المقالات الاصدار 2.2', NULL, 'احمد العنزي', 'nwahycom@gmail.com', 1, 74, 0, 0, 0, 0, '1427660768', 1, 112),
(7403, 'إضافة Online Quran Radio', 'http://www.nwahy.com/showdownload-3139.html', 'إضافة Online Quran Radio التي تمكن مستخدمي نظام WordPress من نشر ترجمات القرآن الكريم الصوتية والاستماع لها على مواقعهم بكل سهولة ويسر وب 38 لغة على مدار ٢٤ ساعة من خلال إذاعات ترجمات القرأن الكريم التابعة للجنة البالغ عددها 64 اذاعة', 'إضافة Online Quran Radio', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 75, 1, 0, 0, 0, '1427662911', 2, 112),
(7404, 'إضافة Islamic Books by EDC', 'http://www.nwahy.com/showdownload-3140.html', 'إضافة Islamic Books by EDC تحتوي على أكثر من 7000 كتاب مصنف على أكثر من 260 قسم موزعة على 88 لغة', 'إضافة Islamic Books by EDC', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 75, 0, 0, 0, 0, '1427662970', 2, 112),
(7405, 'إضافة Quran Translations by EDC', 'http://www.nwahy.com/showdownload-3141.html', 'إضافة Quran Translations by EDC خاصة بعرض ترجمات صوتية لمعاني القرآن الكريم بالعديد من اللغات', 'إضافة Quran Translations by EDC', NULL, 'لجنة الدعوة الإلكترونية - جمعية النجاة الخيرية', '', 1, 75, 0, 0, 0, 0, '1427663050', 2, 112);
");	
if($sql_27){
$insert_report .= '<div class="alert alert-success" role="alert">'.get_words(357).' <strong>dlil_site</strong></div>';
}else{
$insert_report .= '<div class="alert alert-danger" role="alert">'.get_words(358).' <strong>dlil_site</strong></div>';
}

echo '<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">'.get_words(359).'</h3></div>
<div class="panel-body">
'.$insert_report.'
<p>&nbsp;</p>
'.get_words(360).'
</div>
</div>';

break;

case "5":

function setting_value($meta_key='', $insertcode='' ){
$query = mysql_query("SELECT * FROM dlil_setting where site_id='0' AND meta_key='".$meta_key."' limit 1");
$querycount = mysql_num_rows($query);
if($querycount == 0){
$code = '<p>'.get_words(187).'</p>';
}else{
$row = mysql_fetch_array($query);
$meta_value = text(2,$row['meta_value']);

if($insertcode == ""){
$value = text(3,$meta_value);
}else{
$value = text(3,$insertcode);
}

$code = '<input type="hidden" name="id[]" value="'.$row['id'].'" />';
$code .= '<input type="hidden" name="meta_key[]" value="'.$meta_key.'" />';
$code .= '<input id="'.$meta_key.'" type="text" name="option_name[]" value="'.$value.'" />';
}

return $code;
}

function view_setting(){
global $_GET, $current_page;

$code = '<div id="add_comment">';
$code .= '<form name="vbform" method="post" action="install.php?step=6">';

$code .= '<div class="inputs">
<p><label for="site_name">'.get_words(191).'</label></p>
'.setting_value('site_name', '' ).'
</div>';

$code .= '<div class="inputs">
<p><label for="site_url">'.get_words(192).'</label></p>
'.setting_value('site_url', $current_page->thisurl ).'
</div>';

$code .= '<div class="inputs">
<p><label for="site_email">'.get_words(193).'</label></p>
'.setting_value('site_email', '' ).'
</div>';

$code .= '<div class="inputs">
<p><label for="site_description">'.get_words(194).'</label></p>
'.setting_value('site_description', '' ).'
</div>';

$code .= '<div class="inputs">
<p><label for="site_keywords">'.get_words(195).'</label></p>
'.setting_value('site_keywords', '' ).'
</div>';

$code .= '<div class="submitform">';
$code .= '<p><input type="submit" value=" '.get_words(41).' " name="submit" /></p>';
$code .= '</div>';

$code .= '</form>';
$code .= '</div>';

return $code;
}

echo '<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">'.get_words(361).'</h3></div>
	<div class="panel-body">'.view_setting().'</div>
</div>';

break;

case "6":
$number = count($_POST['id']);
echo '<div class="panel panel-default">
	<div class="panel-heading"><h3 class="panel-title">'.get_words(34).'</h3></div>';
	
$reortt = '';
for($i=0;$i<$number;$i++){
$id = intval($_POST['id'][$i]);
$option_name = text(1,$_POST['option_name'][$i]);
$meta_key = text(1,$_POST['meta_key'][$i]);

$queryx = mysql_query("SELECT * FROM dlil_setting where meta_key='".$meta_key."'");
$querycount = mysql_num_rows($queryx);
if($querycount != 0){
$query = mysql_query ("UPDATE dlil_setting SET meta_value='".strip_tags($option_name)."' where id='".$id."' limit 1");
}

if($query){
$reortt .= '';
}else{
$reortt .= '<p style="color:red;">'.get_words(35).' (<strong>'.$id.'</strong>)</p>';
$report = 1;
}
}

echo '<div class="panel-body">'.$reortt.'
'.get_words(362).'
</div>';
echo '</div>';

echo '<div class="panel panel-danger">
	<div class="panel-heading"><h3 class="panel-title">'.get_words(363).'</h3></div>
	<div class="panel-body">
	'.get_words(364).'
	</div>
</div>';
	
echo '<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title">'.get_words(365).'</h3></div>
	<div class="panel-body">
	<p>'.get_words(366).'</p>
	<p>'.get_words(367).' <a target="_blank" href="'.$current_page->thisurl.'admincp">'.$current_page->thisurl.'admincp</a><br />'.get_words(368).'</p>
	
	</div>
</div>';
break;
}
}
?>

</div>
<div style="clear:both;"></div>
</div>

<div id="footer">
<div class="powered"><?php echo get_words(369); ?></div>
</div>

<script src="templates/nwahy/js/jquery.min.js"></script>
<script src="templates/nwahy/js/bootstrap.min.js"></script>
</body>
</html>