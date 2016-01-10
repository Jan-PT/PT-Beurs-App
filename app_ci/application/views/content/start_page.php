<!-- Startpagina view die bestaat uit een promotie afbeelding met achterliggende link -->
<!-- waarop geklikt kan worden om naar de personal_info view te navigeren via de info functie -->
<!-- Header die boven elke content view geladen wordt. Hierin worden de javascript files, css files en images,... geladen -->  
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    $temp = base_url();
    
    if(strpos($temp, ':8080') === FALSE){
        $temp = base_url();
    }
    else{
        $temp = '';
    }

?>

    <link rel="shortcut icon" href="<?php 
	//echo $temp.'icon.ico';
	echo base_url('assets/images/icon/icon.ico');
	?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>HTTPPTTPT</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/other/style.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css');?>" />
    <script src="<?php echo base_url('assets/js/jquery/jquery-2.1.4.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery/jquery-1.11.3.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.js');?>"></script>
    <link rel="manifest" href="<?php echo $temp.'manifest.json'; ?>">
</head>
<body>
    <div id="container" class="container-fluid">
        
    <div class="panel-body" style="background-color: #1BA36F;">
        <div id="picture" style="   background-color: #1BA36F;
                                    position: fixed;    
                                    top: 0;    
                                    left: 0;    
                                    width: 100%;    
                                    height: 100%;">
            
            <a href="<?php echo base_url('index.php/beursapp/info');?>">
                <img src="<?php echo base_url('assets/images/header-home.jpg');?>" 
                     class="img-responsive" 
                     alt="headerafbeelding" 
                     text="Planet Talent - Frames that work"
                     style="position: absolute; 
                            top: 0px; 
                            left: 0px; 
                            right: 0px; 
                            bottom: 0px; 
                            margin: auto; 
                            min-width: 50%; 
                            min-height: 50%; 
                            padding: 0px 25px;">
            </a>
        </div>
    </div>
        
    </div>
</body>
</html>
