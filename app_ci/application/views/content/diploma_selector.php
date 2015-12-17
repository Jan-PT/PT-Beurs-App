<!--- View waarop de student een lijst met mogelijke diploma's te zien krijgt te zien krijgt nadat hij al zijn gegevens heeft ingevuld --->
<!--- Hierop wordt een overzicht van alle gegevens weergegeven en bevestigd dat we deze goed ontvangen hebben. --> 
<script>
function showDiploma(str) {
    if (str == "") {
        document.getElementById("diploma").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("diploma").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","<?php echo base_url(); ?>beursapp/getDiploma?q="+str,true);
        xmlhttp.send();
    }
}


</script>

<div id="header">
<?php
    
    $user_data = $this->session->userdata('user_data');

    if ($user_data !== false && isset($user_data['school']) ) {
        
        echo "<h1>Welke diploma heb je of ga je behalen bij ".$user_data['school']." ?</h1>";
    }
    else{
        echo "<h1>Welke diploma heb je of ga je behalen?</h1>";
    }
    ?>
</div>
<div class="panel-body">
	<div id="info" class="col-sm-12 form-group">
<?php
    echo form_open("beursapp/diplomaForm");
    # Gaat kijken of er al een diploma lv geselecteerd was en deze in de dropdown lijst op de button weergeven
 
//    //testing sql output
//    foreach($db_diplomaLVs as $rec)
//    {
//         echo form_prep($rec->id)."-".form_prep($rec->name)."-". form_prep($rec->crm_name). "<br>\n";        
//    }   
 
    if(isset($user_data['diplomaLV']) && $user_data['diplomaLV']!='' )
    {
        $diplomaLV = $user_data['diplomaLV'];
    }
    else
    {
        $diplomaLV = false;
    }
?>    

<select id="diplomaLV" name="diplomaLV" class="btn btn-secondary btn-lg dropdown-toggle" onchange="showDiploma(this.value);">
    <option id="diplomaLV" name="diplomaLV" value="" 
            hidden
                <?php if($diplomaLV === false) echo "selected"; ?>
            >Diploma niveau</option>

<?php    
    foreach ($db_diplomaLVs as $val) {
        echo "<option id=\"diplomaLV\" name=\"diplomaLV\""
         . " value=\"";
        echo form_prep($val->crm_name);
        echo "\"";
        
        if($diplomaLV !== false && $diplomaLV == $val->crm_name){
            echo " selected";
        }
            
        
        echo ">";
        echo form_prep($val->name);
        echo "</option>\n";
    }
?>
</select>
    
<datalist id="diploma">
<?php

    if( isset($diplomas) )
    {
        foreach ($diplomas as $val) {
            echo "<option value=\"";

            echo form_prep($val->crm_type);
            if( isset($val->sub) && $val->sub != ''){
               echo "_";
               echo form_prep($val->crm_sub);
               
            }
            
            echo "\">";
            echo form_prep($val->type);
            if( isset($val->sub) && $val->sub != ''){
               echo " (";
                echo form_prep($val->sub);
               echo ")";
            }
           
            echo "</option>\n";
            
            
        }
    }

?>
    
    
</datalist>           


			<BR><BR>
		<?php 
			# Indien er al een diploma in de sessie zit wordt deze terug in het veld geladen. Anders is het veld nog leeg
			if(isset($user_data['diploma']) && $user_data['diploma'] != ''){
				echo "<input value='".form_prep($user_data['diploma'])."' name='diploma' list='diploma' class='form-control input-lg'>";
			}
			else{
		?>
			<input list="diploma" name="diploma" value="" class="form-control input-lg">
		<?php
			}
		?>

			<!--- 
				diploma's opsplitsen in datalists aan de hand van diploma niveau 
				en de datalist aan de input list hangen?
			---->
			

                        
                        
                        
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
                        for ($i = $jaar-4; $i <= $jaar+5; $i++)
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
                            echo form_dropdown('grad_maand', $months, $selected_month, 'class="btn btn-secondary btn-lg dropdown-toggle"'); 
                            echo form_dropdown('grad_jaar', $years, $selected_year, 'class="btn btn-secondary btn-lg dropdown-toggle"'); 
                        echo "</p>";
                        ?>

                        <BR>
			<input type="submit" class="btn btn-lg btn-warning btn-block" value="Volgende">
		<?php 
			echo form_close(); 
		?>
	</div>
</div>