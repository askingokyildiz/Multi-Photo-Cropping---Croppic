<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<?php

include("dUnzip2.inc.php");
include("dZip.inc.php");
if (isset($_GET["a"])) {
    $klasoradi2=$_GET["a"];
    $klasoradi=$_GET["b"];
          echo $klasoradi;          
          echo $klasoradi2;    

    function replace_tr($text) {
    $text = trim($text);
    $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
    $replace = array('c','c','g','g','i','i','o','o','s','s','u','u');
    $new_text = str_replace($search,$replace,$text);
    return $new_text;
    } 
$zip = new dZip('arsiv/'.$klasoradi2.'.zip',ZipArchive::CREATE);

$files=scandir('oteller/'.$klasoradi);
unset($files[0],$files[1]);

foreach ($files as $file ) {
 print_r($file);
    $zip->addFile("oteller/".$klasoradi."/".$file, replace_tr($file));
}
$zip->save();

header("Content-Disposition:attachment; filename=$klasoradi2.zip");
readfile("arsiv/".$klasoradi2.".zip");
header( "Connection: Close" );
}
Header("Connection: close"); ;
?>
