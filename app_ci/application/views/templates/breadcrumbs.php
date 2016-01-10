<?php 
    //var_dump($state) 
?>
<div id="breadcrumbs" class="col-sm-12">
    <ol class="breadcrumb">
        <?php 
        switch ($state) 
        { 
            case 'info':
            case 'infoForm':
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li class="active"> Persoonlijke info  </li>
        <li> School: Regio </li>
        <li> School: Instelling </li>
        <li> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
        

		
	<?php				
                break;
            case 'region':
            case 'regionForm':
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li class="active"> School: Regio </li>
        <li> School: Instelling </li>         
        <li> School: Diploma </li>           
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
	<?php				
                break;
            case 'school':
            case 'schoolForm':
        
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/region"> School: Regio </a></li>
        <li class="active"> School: Instelling </li>
        <li> School: Diploma </li>           
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
	<?php				
                break;
            case 'andere_school':
            case 'andere_schoolForm':
        
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li class="active"> School: Regio </li>
        <li class="active"> School: Instelling </li>
        <li> School: Diploma </li>           
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>

        
		
	<?php				
                break;
            case 'diploma':
            case 'diplomaForm':
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/region"> School: Regio </a></li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/school"> School: Instelling</a></li> 
        <li class="active"> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
		
	<?php				
                break;
            case 'job':
            case 'jobForm':
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/region"> School: Regio </a></li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/school"> School: Instelling</a></li> 
        <li><a href="<?php echo base_url();?>index.php/beursapp/diploma"> School: Diploma</a></li> 
        <li class="active"> Gewenste functie </li>       
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
		
	<?php				
                break;
            case 'contact':
            case 'contactForm':
        ?>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/region"> School: Regio </a></li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/school"> School: Instelling</a></li> 
        <li><a href="<?php echo base_url();?>index.php/beursapp/diploma"> School: Diploma</a></li> 
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/job"> Gewenste functie </a> </li>			
        <li class="active"> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>
        
        <?php
                break;
            case 'processed':
            
        ?>
                  
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/home"> Startpagina </a> </li>
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/info"> Persoonlijke info </a>  </li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/region"> School: Regio </a></li>
        <li><a href="<?php echo base_url();?>index.php/beursapp/school"> School: Instelling</a></li> 
        <li><a href="<?php echo base_url();?>index.php/beursapp/diploma"> School: Diploma</a></li> 
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/job"> Gewenste functie </a> </li>			
        <li><a href="<?php echo base_url(); ?>index.php/beursapp/contact"> Contact </a> </li>
        <li class="active"> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde</li>

        <?php
                break;
            case 'personalLogo':
            case 'personalLogoForm':
         
        ?>
        <li> Startpagina </li>
        <li> Persoonlijke info </li>
        <li> School: Regio </li>
        <li> School: Instelling </li>
        <li> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li class="active"> Persoonlijk logo</li>-->
        <li> Einde </li>
        
        
        <?php
                break;
            case 'endpage':
            case 'endpageForm':
         ?>
        <li> Startpagina </li>
        <li> Persoonlijke info </li>
        <li> School: Regio </li>
        <li> School: Instelling </li>
        <li> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li class="active"> Einde </li>
        <?php
                break;
            default :
         ?>
                <li> Startpagina </li>
        <li> Persoonlijke info </li>
        <li> School: Regio </li>
        <li> School: Instelling </li>
        <li> School: Diploma </li>       
        <li> Gewenste functie </li>
        <li> Contact </li>
        <li> Verwerking gegevens</li>
<!--        <li> &#10097; &#10097;</li>
        <li> Persoonlijk logo</li>-->
        <li> Einde </li>
        <?php
            break;
        }        
        ?>

    </ol>    
</div>
