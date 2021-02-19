<?php
include("inc/function.php");
header('Content-type: text/xml; charset=utf-8');


class rss {

public $n = "\n";
public $sitename = "Nwahy";
public $siteurl = "http://www.nwahy.com";
public $description;
public $language = "ar";
public $atomlink;
public $limit = 15;
public $generator = "Nwahy Directory V3";

function head(){
$RSS = '<?xml version="1.0" encoding="UTF-8"?>'.$this->n;
$RSS .= '<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/">'.$n;
$RSS .= '<channel>'.$this->n;

if($type == ""){
$get_link_site = $this->atomlink;
}else{
$get_link_site = $this->atomlink.'?type='.$type;
}

$RSS .= '<title>'.$this->sitename.'</title>'.$this->n;
$RSS .= '<atom:link href="'.$get_link_site.'" rel="self" type="application/rss+xml" />'.$this->n;
$RSS .= '<link>'.$this->siteurl.'</link>'.$this->n;
$RSS .= '<description>'.$this->description.'</description>'.$this->n;
//$RSS .= '<lastBuildDate>'.date("r",time()).'</lastBuildDate>'.$this->n;
$RSS .= '<language>'.$this->language.'</language>'.$this->n;
$RSS .= '<sy:updatePeriod>hourly</sy:updatePeriod>'.$this->n;
$RSS .= '<sy:updateFrequency>1</sy:updateFrequency>'.$this->n;
$RSS .= '<generator>'.$this->generator.'</generator>'.$this->n;
return $RSS;
}


function loop(){
global $q;
$RSS = '';
$result = mysql_query("SELECT id,title,url,metadescription,cat,date FROM dlil_site where active='1' order by id desc limit ".$this->limit."");
while ($Row = mysql_fetch_array($result)){
$title = htmlspecialchars(stripslashes($Row['title']));
$short = htmlspecialchars(stripslashes($Row['metadescription']));
$url = htmlspecialchars(stripslashes($Row['url']));
$dates = $Row['date'];

$queryxc = mysql_query("SELECT id,title FROM dlil_catgory where id='".$Row['cat']."' limit 1");
$Rowx = mysql_fetch_array($queryxc);
$Rowx['title'] = text(3, $Rowx['title']);

if($dates == ""){
$d = date("r",time());
}else{
$d = date("r",$Row[$dates]);
}

$s = ''.$this->siteurl.''.url(7, $Row['id'], "").'';
	
$RSS .= '<item>'.$this->n;
$RSS .= '<guid isPermaLink="false">'.$s.'</guid>'.$this->n;
$RSS .= '<title>'.$title.'</title>'.$this->n;
$RSS .= '<link>'.$s.'</link>'.$this->n;
if($short != ""){
$RSS .= '<description><![CDATA['.$short.']]></description>'.$this->n;
}
$RSS .= '<pubDate>'.$d.'</pubDate>'.$this->n;
$RSS .= '</item>'.$this->n;
}

return $RSS;
}

function foot(){
$RSS = '</channel>'.$this->n;
$RSS .= '</rss>'.$this->n;
return $RSS;
}


function feed(){
echo $this->head();
echo $this->loop();
echo $this->foot();
}

}


$rssclass = new rss();

$rssclass->sitename = $name_site;
$rssclass->siteurl = $name_url;
$rssclass->description = $meta1;
$rssclass->language = "ar";
$rssclass->atomlink = "".$name_url."rss.php";
$rssclass->limit = 15;

echo $rssclass->feed();
?>