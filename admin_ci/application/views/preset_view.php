<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Preset View</title>
        
<script>
function showDiploma(str) {
    if (str == "") {
        document.getElementById("diploma").innerHTML = "";

        document.getElementById("diploma_list").placeholder = 
                "Kies uw diploma hier.";

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

        xmlhttp.open("GET","<?php echo base_url(); ?>index.php/admin/getDiploma?q="+ str,true);
        //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.send();

        document.getElementById("diploma_list").placeholder = "Kies uw diploma hier.";
        return;
    }
}
//function showSchool(str) {
//    if (str == "") {
//        document.getElementById("diploma").innerHTML = "";
//
//        document.getElementById("diploma_list").placeholder = 
//                "Kies uw diploma hier.";
//
//        return;
//    } else { 
//        if (window.XMLHttpRequest) {
//            // code for IE7+, Firefox, Chrome, Opera, Safari
//            xmlhttp = new XMLHttpRequest();
//        } else {
//            // code for IE6, IE5
//            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//        }
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
//                
//            
//            document.getElementById("diploma").innerHTML = xmlhttp.responseText;
//            }
//        };
//
//        xmlhttp.open("GET","<?php echo base_url(); ?>index.php/admin/getSchool?q="+ str,true);
//        //xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//        xmlhttp.send();
//
//        document.getElementById("diploma_list").placeholder = "Kies uw diploma hier.";
//        return;
//    }
//}

</script>        
    </head>
    <body>
        <h1>Preset Form</h1>
        <?php
        
        
//        echo "db_preset <br>";
//        var_dump($db_preset);
//        echo "<br>";
//        echo "db_diplomaLV <br>";
//        var_dump($db_diplomaLV);
//        echo "<br>";
//        echo "db_diploma <br>";
//        var_dump($db_diploma);
//        
        if(isset($test_post)){
            var_dump($test_post);
        }
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        if(isset($db_preset['diplomaLV'])){
            $diplomaLV = $db_preset['diplomaLV'];
        }
        else{
            $diplomaLV = false;
        }
        if(isset($db_preset['diploma'])){
            $diploma = $db_preset['diploma'];
        }
        else{
            $diploma = false;
        }
        if(isset($db_preset['diplomaSub'])){
            $diplomaSub = $db_preset['diplomaSub'];
        }
        else{
            $diplomaSub = false;
        }

        
        
        $hidden = array(
            'id' => $db_preset['id']
        );
        
        echo form_open('admin/presetForm', '', $hidden);
        
        
        
        $beurs = array(
        "type" => "text",
        "name" => "beurs",
        "id" => "beurs",
        "placeholder" => "Beurs",
        "class" => "form-control input-lg",
        
        );
        
        if(isset($db_preset['beurs']) && $db_preset['beurs'] != ''){
            $beurs["value"] = $db_preset['beurs'];
        }
        else{
            $beurs['value'] = set_value('beurs');
        }

        echo "<p>Beurs : ".form_input($beurs)."</p>";
        
//        
//        if( isset($db_preset['andere_school']) && $db_preset['andere_school'] == 1) {
//            $andere_school = true;
//        }
//        else{
//            $andere_school = false;
//        }
//        
//        echo "<p>Andere School: "
//            . form_checkbox('andere_school','andere_school', $andere_school)
//            . "</p>";
?>

<?php       
        $provincie = array(
        "type" => "text",
        "name" => "provincie",
        "id" => "provincie",
        "list" => "provincie_list",
        "placeholder" => "Provincie",
        "class" => "form-control input-lg",
        );
        
        if(isset($db_preset['provincie']) && $db_preset['provincie'] != ''){
            $provincie["value"] = $db_preset['provincie'];
        }
        else{
            $provincie['value'] = set_value('provincie');
        }

        echo "<p>Provincie : ".form_input($provincie)."</p>";
?>
        
        
<?php             
        $school = array(
        "type" => "text",
        "name" => "school",
        "id" => "school",
        "list" => "school_list",
        "placeholder" => "School",
        "class" => "form-control input-lg",
        );
        
        if(isset($db_preset['school']) && $db_preset['school'] != ''){
            $school["value"] = $db_preset['school'];
        }
        else{
            $school['value'] = set_value('school');
        }

        echo "<p>School : ".form_input($school)."</p>";
?>
        <p> Diploma LV
<select id="diplomaLV" name="diplomaLV" 
        class="" 
        onchange="showDiploma(this.value);">
    <option id="diplomaLV" name="diplomaLV" value="" 
            hidden
            <?php if($diplomaLV === false) echo "selected"; ?>
            >Diploma niveau
    </option>
  <?php      
    foreach ($db_diplomaLV as $val) {
        echo "<option id=\"diplomaLV\" name=\"diplomaLV\""
         . " value=\"";
        echo urlencode($val->crm_name);
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
        </p>
        
<datalist id="diploma">
<?php
    if( isset($db_diploma) )
    {
        foreach ($db_diploma as $val) {
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
        
  <p> diploma_sub 
    <input list="diploma" name="diploma" id="diploma_list"
           class="form-control input-lg" 
           placeholder="Kies uw diploma hier."
           
<?php 
    if(isset($diploma)
            && $diploma != ''        
    ){
        if( isset($diplomaSub) && 
            $diplomaSub != ''){

            echo 'value="'.form_prep($diploma)."_". form_prep($diplomaSub). '">';
        }
        else{
            echo 'value="'.form_prep($diploma). '">';
        }   
    }
    else{
        $set_diplomaSub = set_value('diplomaSub');
        
        if(isset($set_diplomaSub) && $set_diplomaSub != ''){
            echo 'value="'.  set_value('diploma'). "_". $set_diplomaSub.'">';
        }
        else{
            echo 'value="'.  set_value('diploma').'">';
           
        }
    }
    ?>
  </p>
<BR>

    <input type="submit" class="btn btn-lg btn-warning btn-block" value="Submit">

<?php 
    echo form_close(); 
?>       
           
    </body>
</html>
