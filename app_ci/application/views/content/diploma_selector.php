<!--- View waarop de student een lijst met mogelijke diploma's te zien krijgt te zien krijgt nadat hij al zijn gegevens heeft ingevuld --->
<!--- Hierop wordt een overzicht van alle gegevens weergegeven en bevestigd dat we deze goed ontvangen hebben. --> 
<script>
function showDiploma(str) {
    if (str == "") {
        document.getElementById("diploma").innerHTML = "";

        document.getElementById("diploma_list").placeholder = 
                "Kies eerst hierboven je diploma niveau.";

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
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("diploma").innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET","<?php echo base_url(); ?>index.php/beursapp/getDiploma?q="+ str,true);
        //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.send();
        
        document.getElementById("diploma_list").placeholder = "Kies of typ uw diploma hier.";
        return;
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
//    echo '<br>user_data <br>';
//    var_dump($user_data);
//    
//    echo '<br>post <br>';
//    var_dump($_POST);

    echo validation_errors();

    echo form_open("beursapp/diplomaForm");
    # Gaat kijken of er al een diploma lv geselecteerd was en 
    # deze in de dropdown lijst op de button weergeven
 
//    //testing sql output
//    foreach($db_diplomaLVs as $rec)
//    {
//         echo form_prep($rec->id)."-".form_prep($rec->name)
//         ."-". form_prep($rec->crm_name). "<br>\n";        
//    }   
    
//    echo set_value('diplomaLV')."<br>";
    
    if(isset($user_data['diplomaLV']) && $user_data['diplomaLV'] != '' )
    {
        $diplomaLV = urlencode($user_data['diplomaLV']);
    }
    elseif ( NULL !== set_value('diplomaLV') ) {
        $diplomaLV = set_Value('diplomaLV');
    }
    else
    {
        $diplomaLV = false;
    }
//    echo $diplomaLV . "<br>";
?>    

<select id="diplomaLV" name="diplomaLV" 
        class="btn btn-secondary btn-lg btn-block dropdown-toggle" 
        onchange="showDiploma(this.value);">
    <option id="diplomaLV" name="diplomaLV" value="" 
            hidden
                <?php if($diplomaLV === false) echo "selected"; ?>
            >Diploma niveau</option>

<?php    
    foreach ($db_diplomaLVs as $val) {
        echo "<option id=\"diplomaLV\" name=\"diplomaLV\""
         . " value=\"";
        echo urlencode(form_prep($val->crm_name));
        echo "\"";
        
        if($diplomaLV !== false && $diplomaLV == urlencode($val->crm_name)){
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
    else{
        echo "<option value=''>";
    }

?>    
</datalist>           


<BR>
    <input list="diploma" name="diploma" id="diploma_list"
           class="form-control input-lg" 
           placeholder="Kies eerst hierboven uw diploma niveau."
<?php 
    # Indien er al een diploma in de sessie zit wordt deze terug in het veld geladen.
    #  Anders is het veld nog leeg
    if(isset($user_data['diploma']) && $user_data['diploma'] != ''){
        echo 'value="'.form_prep($user_data['diploma']) . '">';
    }
    else{
        echo 'value="'.  set_value('diploma').'">';
    }
?>

<!--
        diploma's opsplitsen in datalists aan de hand van diploma niveau 
        en de datalist aan de input list hangen?
-->

<BR>

<?php 
    $this->load->helper('date');

    $jaar = date('Y'); 

    $months = array('' => 'Maand', );
    for ($i = 1; $i <= 12; $i++)
    {
        $months[$i] = $i;
    }
    $years = array('' => 'Jaar');
    for ($i = $jaar-4; $i <= $jaar+5; $i++)
    {
        $years[$i] = $i; 
    }

    $selected_month = set_value('grad_maand');
    $selected_year = set_value('grad_jaar');

    if ($user_data !== false){
       if( isset($user_data['grad_maand'] ) 
            && $user_data['grad_maand'] != '') {
            $selected_month = $user_data['grad_maand'];
        }
       if( isset($user_data['grad_jaar'])
               && $user_data['grad_jaar'] != '') {
            $selected_year = $user_data['grad_jaar'];
        }
    }
?>
<div class="row">
    <div class='col-sm-4'>
    <label class="input-lg" for=''>Wanneer studeer(de) je af?</label>
    </div>
    <div class="col-sm-4">

<?php
    echo form_dropdown('grad_maand', $months, $selected_month, 
            'class="btn btn-secondary btn-lg btn-block dropdown-toggle"'); 
?>
    </div>
    <div class="col-sm-4">
<?php
    echo form_dropdown('grad_jaar', $years, $selected_year, 
            'class="btn btn-secondary btn-lg btn-block dropdown-toggle"'); 
?>
    </div>
</div>
    
<BR>

    <input type="submit" class="btn btn-lg btn-warning btn-block" value="Volgende">

<?php 
    echo form_close(); 
?>
</div>

    