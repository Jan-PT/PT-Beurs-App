<!-- 
	 View met de verschillende provincies waaruit de student kan kiezen. 
	 Door de keuze van de provincie krijgt de student op de volgende view enkel de scholen uit die provincie te zien. 
-->
<div id="header">

    <?php
    
    function printButton($db_region, $region)
    {
        $test = false;
        
        echo "<p>"
            . "<button type=\"submit\" name=\"provincie\" id=\"provincie\" "

            . "value=\"";
        echo form_prep($db_region->crm_name); 
        echo "\"";

        echo "class=\"btn btn-lg btn-block ";
        if($region !== false && $region == $db_region->crm_name){
            $test = true;
            echo "btn-success";
        }
        else{
            echo "btn-warning";
        }

        echo "\">";

        echo form_prep($db_region->name);
        echo "</button>"
             . "</p>\n";
        return $test;
    }


    $user_data = $this->session->userdata('user_data');
    
    if ($user_data !== false && isset($user_data['voornaam']) ) {
        echo "<h1>In welke provincie ga je naar school, " . $user_data['voornaam'] . "?</h1>";
    }else{
        echo "<h1>In welke provincie ga je naar school?</h1>";
    }
    ?>

</div>

<div class="panel-body">
    <div id="info" class="form-group">
    </div>
<?php 

//    var_dump($user_data);

    echo form_open("beursapp/regionForm");
            
//        //testing sql output
//        foreach($db_regions as $rec)
//        {
//             echo form_prep($rec->id)."-".form_prep($rec->name)."-". form_prep($rec->crm_name). "<br>\n";        
//        }
        
        $size_records = count($db_regions);
        
        if(isset($user_data['provincie']) && $user_data['provincie']!='' )
        {
            $region = $user_data['provincie'];
        }
        else
        {
            $region = false;
        }
        
//        echo "<br>";
//        echo "size of ". $size_records . "<br>";         
//        echo "prov ".$region ."<br><br>";
?>
    
        <div class="col-sm-6">
<?php
    
    if($size_records % 2 == 0)
    {
        for($i = 0; $i < ($size_records/2); $i++)
        {
            printButton($db_regions[$i], $region);
        }        
    }
    else
    {
        for($i = 0; $i <= (int)($size_records/2); $i++)
        {
            printButton($db_regions[$i], $region);
        }
    }
?>
        </div>
        <div class="col-sm-6">    
             
<?php
    if($size_records % 2 == 0)
    {
        for($i = ($size_records/2); $i < $size_records; $i++ )
        {
            printButton($db_regions[$i], $region);
        }
    }
    else
    {
        for($i = (int)($size_records/2)+1; $i < $size_records; $i++ )
        {
            printButton($db_regions[$i], $region);
        }
    }
?>
            <p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning">Ander</button></p>
        </div>
<?php        
    #  Gaat kijken of er al een provincie geselecteerd was en deze als een groene button tonen ipv de oranje

    # Als er nog geen provincie in de sessie staat dan blijven alle knoppen gewoon oranje.
 
    echo form_close(); 
?>
    </div>
</div>