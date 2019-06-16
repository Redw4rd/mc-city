<?
ini_set("display_errors", 1);

echo file_get_contents("https://pixelhero.hu/tamogatas/sms/process/?".$_SERVER["QUERY_STRING"]);
?>