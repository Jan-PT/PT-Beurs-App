
<div id="breadcrumbs" class="col-sm-12">
    <ol class="breadcrumb">
        <?php 
        switch ($state) 
        { 
            case 'info':
            case 'infoForm':
        ?>
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li class="active"> Persoonlijke info  </li>
        <li> School:Regio </li>
        <li> School: Instelling </li>
        <li> School: Diploma </li>       
        <li> Gewenste functie </li>
		
	<?php				
                break;
            case 'region':
            case 'regionForm':
        ?>
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>beursapp/info"> Persoonlijke info </a>  </li>
        <li class="active"> School:Regio </li>
        <li> School: Instelling </li>         
        <li> School: Diploma </li>           
        <li> Gewenste functie </li>
        <li> Contact </li>
        
	<?php				
                break;
            case 'school':
            case 'schoolForm':
        
        ?>
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>beursapp/region"> School:Regio </a></li>
        <li class="active"> School: Instelling </li>
        <li> School: Diploma </li>           
        <li> Gewenste functie </li>
        <li> Contact </li>

		
	<?php				
                break;
            case 'diploma':
            case 'diplomaForm':
        ?>
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>beursapp/region"> School:Regio </a></li>
        <li><a href="<?php echo base_url();?>beursapp/school"> School: Instelling</a></li> 
        <li class="active"> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
		
	<?php				
                break;
            case 'diploma':
            case 'diplomaForm':
        ?>
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>beursapp/region"> School:Regio </a></li>
        <li><a href="<?php echo base_url();?>beursapp/school"> School: Instelling</a></li> 
        <li><a href="<?php echo base_url();?>beursapp/diploma"> School: Diploma</a></li> 
        <li class="active"> Gewenste functie </li>       
        <li> Contact </li>
		
	<?php				
                break;
            case 'type':
            case 'typeForm':
            case 'processed':
            default:
        ?>
                  
        <li><a href="<?php echo base_url(); ?>beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>beursapp/region"> School:Regio </a></li>
        <li><a href="<?php echo base_url();?>beursapp/school"> School: Instelling</a></li> 
        <li><a href="<?php echo base_url();?>beursapp/diploma"> School: Diploma</a></li> 
        <li><a href="<?php echo base_url(); ?>beursapp/job"> Gewenste functie </a> </li>			
        <li><a href="<?php echo base_url(); ?>beursapp/type"> Contact </a> </li>			

        <?php
                break;
        } 
        ?>


    </ol>    
</div>
