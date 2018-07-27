<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Puzzle Travel</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/croppic.css" rel="stylesheet">

    <!-- Fonts from Google Fonts 
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Mrs+Sheppards&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
-->
  </head>

  <body>
 <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> 
    <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script>-->
    <script src="assets/js/jquery-2.1.3.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
   
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.mousewheel.min.js"></script>
    <script src="croppic.js"></script>
    <script src="assets/js/main.js"></script>
    
<div class="container">
    
    <br>
    <br>
    <center>
        <?php 
        if (isset($_POST["sil"])) {
            $dizini='img/';
            $dir=scandir($dizini);
            foreach($dir as $file)
            {
                clearstatcache();
                if (is_file($dizini.$file))
                {
                    unlink($dizini.$file);
                }
            }
            echo "İmg Dosyası Temizlendi";
        } ?>
    </center>
    <?php  if (isset($_FILES['my_file'])) {
        if (isset($_POST["isim"])) {
            $klasoradi2 = $_POST["isim"]; 
            $klasoradi = "PuzzleTravel".rand();

            //"PuzzleTravel".rand();

            if (file_exists("oteller/".$klasoradi))
            //file_exists ile klasörün var olup olmadığı kontrol ediliyor.
            //Eğer mkdirtest isimli bir klasör mevcut ise true değer döndürüp if içindeki işlemleri yapıyor.
            {
            echo "klasör mevcut: ".$klasoradi;


              //klasör mevcut ise ekrana yazdırılıyor.
            }else
            {
                //eğer klasör mevcut değil ise yeni klasör oluşturuluyor.
                mkdir("oteller/".$klasoradi);
                mkdir("img/".$klasoradi);
               // echo "klasör oluşturuldu: ".$klasoradi;


            }  
        } ?>

            
        <div class="col-md-12">
            <br>
            <div class="form-group col">
                <center>
                    <a href="indir.php?a=<?=$klasoradi2?>&b=<?=$klasoradi?>" target="_blank" class="btn btn-success w-50">Kırpılmış Fotoğrafları İndir</a>
                </center>
            </div>
            <br> 
        </div> 
        <?php 
        $myFile = $_FILES['my_file'];
        $fileCount = count($myFile["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            ?>
                <? $i+1 ?>
                    <?php 
                    $docname= $myFile["name"][$i];
                    $dizin = 'img/'.$klasoradi.'/';
                    $yuklenecek_dosya = $dizin.basename($myFile["name"][$i]);
                    
                   
                    if (move_uploaded_file($myFile["tmp_name"][$i], $yuklenecek_dosya))
                    {
                        if ($docname=="Thumbs.db") {
                            
                        }
                        else
                        {

                        ?>

                            <!--Name: <?= $myFile["name"][$i] ?><br>
                            Temporary file: <?= $myFile["tmp_name"][$i] ?><br>
                            Type: <?= $myFile["type"][$i] ?><br>
                            Size: <?= $myFile["size"][$i] ?><br>
                            Error: <?= $myFile["error"][$i] ?><br>-->

                            <div class="row">
                                <div class="col-lg-12 ">
                                    <p><?php echo $i."."; echo $docname; echo "- Dosya başarıyla yüklendi.";?><br></p>
                                    <div id="cropContainerPreload<?=$i?>" class="cropContainerPreloada"></div>
                                </div>
                                <script>
                                    var croppicContainerPreloadOptions = {
                                            uploadUrl:'img_save_to_file.php?klasor=<?php print $klasoradi; ?>',
                                            cropUrl:'img_crop_to_file.php?docname=<?php print $docname; ?>&klasor=<?php print $klasoradi; ?>', 
                                            loadPicture:'img/<?= $klasoradi ?>/<?= $myFile["name"][$i] ?>',
                                            enableMousescroll:true,
                                            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                                            onBeforeImgUpload: function(){ console.log('onBeforeImgUpload') },
                                            onAfterImgUpload: function(){ console.log('onAfterImgUpload') },
                                            onImgDrag: function(){ console.log('onImgDrag') },
                                            onImgZoom: function(){ console.log('onImgZoom') },
                                            onBeforeImgCrop: function(){ console.log('onBeforeImgCrop') },
                                            onAfterImgCrop:function(){ console.log('onAfterImgCrop') },
                                            onReset:function(){ console.log('onReset') },
                                            onError:function(errormessage){ console.log('onError:'+errormessage) }
                                    }
                                    var cropContainerPreload = new Croppic('cropContainerPreload<?=$i?>', croppicContainerPreloadOptions);    
                                </script>
                            </div> 
                        <?php
                        }
                    } 
                    else 
                    {
                        echo "Dosya yüklenemedi!\n";
                    }
        }
    }
    else 
    {?>
        <div class="col-md-3 "></div>
        <div class="col-md-6 " style="border: 5px; border-style: dashed; border-color:#28a745!important;">
            <br>
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-12">
                <center>
                    <button type="submit" name="sil" class="btn btn-danger w-100 a">Öncelikle Dosya İçeriğini sil</button>
                </center>
            </div>
            </form>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row ">
                    <div class="form-group col-md-12">
                        <center><label for="inputEmail4">Fotoğrafları Seç:</label>
                        <input type="file" accept="image/gif, image/jpg, image/jpeg, image/png" name="my_file[]" onchange="selectFolder(event)" webkitdirectory nwdirectory required> </center>
                    </div>
                    <div class="form-group col-md-12">
                        <center>
                            <label for="inputEmail4">Otel İsmi:</label>
                            <input type="text" class="form-control textbox" name="isim" id="formGroupExampleInput" required>
                        </center>
                    </div>
                    <div class="form-group col-md-12">
                        <center><button type="submit" name="submit" class="btn btn-primary w-100">Yükle</button></center>
                    </div>
                </div>
            </form>
            <script type="text/javascript">
            function selectFolder(e) {
                var theFiles = e.target.files;
                var relativePath = theFiles[0].webkitRelativePath;
                var folder = relativePath.split("/");
                $("input.textbox").val(folder[0]);
            }
            </script>
        </div>
        <div class="col-md-3 "></div>
    <?php  } ?>  
</div>
  </body>
</html>