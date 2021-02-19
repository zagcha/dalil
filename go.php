<?php
include("inc/function.php");
$id = intval($_GET["id"]);
$Template->TemplateType = 1;
$sql = mysql_query("select * from dlil_ads where id='$id' AND active='1' limit 1");
$querycount = mysql_num_rows($sql);
if($querycount == 0){
$Template->title = get_words(68).' | '.get_option('site_name', 0 );
$Template->description = get_option('site_description', 0 );
$Template->keywords = get_option('site_keywords', 0 );
echo $Template->Template_view(widgets(1),error_message(),'');
}else{
$Row = mysql_fetch_array($sql);
$Row['url'] = text(3,$Row['url']);
$visit = $Row['vis']+1;
$sql2 = mysql_query("update dlil_ads set vis=$visit where id='$id' limit 1") or die ("Query failed4");
echo "<meta http-equiv='Refresh' content='1; URL=".$Row['url']."' />";
}
?>