<!--- View waarop de student een lijst met mogelijke diploma's te zien krijgt te zien krijgt nadat hij al zijn gegevens heeft ingevuld --->
<!--- Hierop wordt een overzicht van alle gegevens weergegeven en bevestigd dat we deze goed ontvangen hebben. --> 
<div id="header">
	<?php
	$user_data = $this->session->userdata('user_data');
    if (($this->session->userdata('user_data'))) {
        $user_data = $this->session->userdata('user_data');
        echo "<h1>Welke diploma heb je of ga je behalen bij ".$user_data['school']." ?</h1>";
    }else{
        echo "<h1>Welke diploma heb je of ga je behalen?</h1>";
    }
    ?>
	<h1></h1>
</div>
<div class="panel-body">
	<div id="info" class="col-sm-7 form-group">
		<?php
			echo form_open("beursapp/diplomaForm");
			# Gaat kijken of er al een diploma lv geselecteerd was en deze in de dropdown lijst op de button weergeven
			if($user_data['diplomaLV']!=''){
				if($user_data['diplomaLV'] == 'Professionele bachelor'){
		?>          
            
			<select id="diplomaLV" name="diplomaLV" class="btn btn-warning dropdown-toggle">
				<option id="diplomaLV" name="diplomaLV" value="Professionele bachelor" selected>Professionele bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Technische bachelor">Technische bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Master">Master</option>
			</select>
		<?php 
				}
				
				if($user_data['diplomaLV'] == 'Technische bachelor'){
		?>
			<select id="diplomaLV" name="diplomaLV" class="btn btn-warning dropdown-toggle">
				<option id="diplomaLV" name="diplomaLV" value="Professionele bachelor">Professionele bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Technische bachelor" selected>Technische bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Master">Master</option>
			</select>
		<?php 
				}
				
				if($user_data['diplomaLV'] == 'Master'){
		?>
			<select id="diplomaLV" name="diplomaLV" class="btn btn-warning dropdown-toggle">
				<option id="diplomaLV" name="diplomaLV" value="Professionele bachelor">Professionele bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Technische bachelor">Technische bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Master" selected>Master</option>
			</select>
		<?php 
				}
			}
			else{
			# Indien er nog geen diplomaLV in de sessie zit komt er gewoon Diploma niveau als verborgen veld op de button
		?>
			<select id="diplomaLV" name="diplomaLV" class="btn btn-warning dropdown-toggle">
				<option id="diplomaLV" name="diplomaLV" value="" hidden selected>Diploma niveau</option>
				<option id="diplomaLV" name="diplomaLV" value="Professionele bachelor">Professionele bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Technische bachelor">Technische bachelor</option>
				<option id="diplomaLV" name="diplomaLV" value="Master">Master</option>
			</select>
		<?php
			}
		?>
			<BR><BR>
		<?php 
			# Indien er al een diploma in de sessie zit wordt deze terug in het veld geladen. Anders is het veld nog leeg
			if($user_data['diploma'] != ''){
				echo "<input value='".$user_data['diploma']."' name='diploma' list='diploma' class='form-control'>";
			}
			else{
		?>
			<input list="diploma" name="diploma" value="" class="form-control">
		<?php
			}
		?>

			<!--- 
				diploma's opsplitsen in datalists aan de hand van diploma niveau 
				en de datalist aan de input list hangen?
			---->
			
			<datalist id="diploma">
				<option value="Professionele bachelor in de Toegepaste Informatica">
				<option value="Professionele bachelor Electronica-ICT">
				<option value="Master in de Toegepaste Informatica">
			</datalist>
			<BR>
                        
                        <?php 
                        
                        $this->load->helper('date');

                        $jaar = date('Y'); 

                        $months = array(0 => 'Maand', );
                        for ($i = 1; $i <= 12; $i++)
                        {
                            $months[] = $i;
                        }
                        $years = array(0 => 'Jaar');
                        for ($i = $jaar-5; $i <= $jaar+5; $i++)
                        {
                            $years[$i] = $i; 
                        }
                        
                        if ($user_data){
                            $selected_month = $user_data['grad_maand'];
                            $selected_year = $user_data['grad_jaar'];
                        }
                        
                        $selected_month = (isset($selected_month)) ? $selected_month : 0;
                        $selected_year = (isset($selected_year)) ? $selected_year : 0;
                        
                        echo "<p>";
                            echo form_label('Wanneer studeer je af?:');
                            echo form_dropdown('grad_maand', $months, $selected_month, 'class="btn btn-warning dropdown-toggle"'); 
                            echo form_dropdown('grad_jaar', $years, $selected_year, 'class="btn btn-warning dropdown-toggle"'); 
                        echo "</p>";
                        ?>

                        <BR>
			<input type="submit" class="form-control btn btn-warning" value="Volgende">
		<?php 
			echo form_close(); 
		?>
	</div>
</div>