<!--- Pagina die de student te zien krijgt nadat hij al zijn gegevens heeft ingevuld --->
<!--- Hierop wordt een overzicht van alle gegevens weergegeven en bevestigd dat we deze goed ontvangen hebben. --> 
<!--- Nadat de student op de afsluit button drukt of als de refresh time verlopen is wordt de sessie leeggemaakt -->
<!--- en naar de startpagina geredirect zodat de volgende student kan starten met het invullen van zijn gegevens -->
<?php 
    function getUserData($val, $user_data){
        if($user_data !== false){
            if(isset($user_data[$val]) && $user_data[$val] != '' ){
                return $user_data[$val];
            }
            else {
                return '';
            }
        }
        
    }	

//header("Refresh: 10;url=confirmationForm");
	$user_data = $this->session->userdata('user_data');
?>
<div id="header">
    <h1>Verwerking gegevens</h1>
</div>
<div class="panel-body">
    <div class="col-sm-12">
    <p> We hebben je gegevens succesvol ontvangen. <br>Check je even of deze correct zijn? </p>
    <p>
        Indien je iets wenst te veranderen, druk onderaan in de <b>progress bar</b> op het gerelateerde item. 
    </p>
    </div>
    <div class="col-sm-12">
        <?php
		echo form_open("beursapp/confirmationForm");
		# Alle info van de student wordt hieronder weergegeven.
	?>
	<table>
		<tr>
                    <th>Naam: </th>
                    <td><?php echo getUserData('voornaam',$user_data).' '.getUserData('naam',$user_data); ?></td>
		</tr>
		<tr>
                    <th>Gsm nummer: </th>
                    <td><?php echo getUserData('gsm',$user_data);?></td>
		</tr>
		<tr>
                    <th>Email: </th>
                    <td><?php echo getUserData('email',$user_data);?></td>
		</tr>
		<tr>
                    <th>Postcode: </th>
                    <td><?php echo getUserData('postcode',$user_data);?></td>
		</tr>
                <tr>
                    <th>Gemeente: </th>
                    <td><?php echo getUserData('gemeente',$user_data);?></td>
		</tr>
		<tr>
                    <th>Provincie: </th>
                    <td><?php echo getUserData('provincie',$user_data);?></td>
		</tr>
		<tr>
                    <th>School: </th>
                    <td><?php echo getUserData('school',$user_data);?></td>
		</tr>
		<tr>
                    <th>Diploma niveau: </th>
                    <td><?php echo getUserData('diplomaLV',$user_data);?></td>
		</tr>
		<tr>
                    <th>Diploma: </th>
                    <td><?php echo getUserData('diploma',$user_data);?></td>
		</tr>
		<tr>
                    <th>Diploma subtype: </th>
                    <td><?php echo getUserData('diplomaSub',$user_data);?></td>
		</tr>
                <tr>
                    <th>Afstuderen in: </th>
                    <td><?php echo getUserData('grad_maand',$user_data);?> - 
                        <?php echo getUserData('grad_jaar',$user_data);?>
                    </td>
		</tr>
		<tr>
                    <th>Jobs: </th>
                    <td><?php 
                        $temp = getUserData('jobs',$user_data);
                        echo str_replace("-", ", ", $temp);
                        ?>
                    </td>
		</tr>
		<tr>
                    <th>Contact: </th>
                    <td><?php echo getUserData('contact',$user_data);?></td>
		</tr>
                <?php if( 'tdd' == getUserData('contact',$user_data) ) :
                        
                ?>
		<tr>
                    <th>Talent Detection Days: </th>
                    <td><?php 
                        $temp = getUserData('tdd',$user_data);
                        echo str_replace("_", ", ", $temp);
                        ?>
                    </td>
		</tr>
                <?php
                    endif;
                ?>

	</table>
	<BR>
        

        <p> Is alles correct, klik "volgende" om je persoonlijke "Topstarters" logo aan te maken. <br>
            <i>
                Hierna kan je je gegevens <b>niet</b> meer aanpassen.
            </i>
         </p>
	<input type="submit" class="btn btn-lg btn-warning btn-block" value="Volgende">
	<?php
		echo form_close(); 
	?>
        </div>
</div>