<!-- Header die boven elke content view geladen wordt. Hierin worden de javascript files, css files en images,... geladen -->  
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" href="<?php echo base_url('assets/images/icon/icon.ico');?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>HTTPPTTPT</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/other/style.css');?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css');?>" />
		<script src="<?php echo base_url('assets/js/jquery/jquery-2.1.4.min.js');?>"></script>
		<script src="<?php echo base_url('assets/js/jquery/jquery-1.11.3.min.js');?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap/bootstrap.js');?>"></script>
		<script src="<?php echo base_url('assets/js/other/random_logo.js');?>"></script>
	</head>
	<body>
		<div id="container" class="container-fluid">
                    <div class="panel-body" style="background-color: #1BA36F;">
                        <div id="picture" >
                            <a href="<?php echo base_url('index.php/beursapp/info');?>">
                                <img src="<?php echo base_url('assets/images/header-home.jpg');?>" class="img-responsive" alt="headerafbeelding" text="Planet Talent - Frames that work"/>
                            </a>
                        </div>
                    </div>                			
		</div>
	</body>
</html>
