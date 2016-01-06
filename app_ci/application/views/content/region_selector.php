<!-- 
	 View met de verschillende provincies waaruit de student kan kiezen. 
	 Door de keuze van de provincie krijgt de student op de volgende view enkel de scholen uit die provincie te zien. 
-->
<div id="header">

    <?php
    
    function printButton($db_region, $region)
    {
        $selected = FALSE;
        
        echo "<p>"
            . "<button type=\"submit\" name=\"provincie\" id=\"provincie\" "

            . "value=\"";
        echo form_prep($db_region->crm_name); 
        echo "\"";

        echo "class=\"btn btn-lg btn-block ";
        if($region !== false && $region == $db_region->crm_name){
            $selected = true;
            echo "btn-success";
        }
        else{
            $selected = false;
            echo "btn-warning";
        }

        echo "\">";

        echo form_prep($db_region->name);
        echo "</button>"
             . "</p>\n";
        
        return $selected;
    }
    
    function set_selected($selected, $test)
    {
        if($selected == false && $test == true)
        {
            return true;
        }
        elseif ($selected == true) 
        {
            return true;
        }
        else
        {
            return false;
        }
        
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


    echo form_open("beursapp/regionForm");
        
    $size_records = count($db_regions);

    if(isset($user_data['provincie']) && $user_data['provincie']!='' )
    {
        $region = $user_data['provincie'];
    }
    else
    {
        $region = false;
    }
    
    if( isset($user_data['andere_school']) && $user_data['andere_school']!= false )
    {
        $andere = $user_data['andere_school'];
    }
    else
    {
        $andere = false;
    }
        
?>
    
        <div class="col-sm-6">
<?php
    
    $selected = false;

    if($size_records % 2 == 0)
    {
        for($i = 0; $i < ($size_records/2); $i++)
        {
            $temp = printButton($db_regions[$i], $region);   
            $selected = set_selected($selected, $temp);            
        }        
    }
    else
    {
        for($i = 0; $i <= (int)($size_records/2); $i++)
        {
            $temp = printButton($db_regions[$i], $region);
            $selected = set_selected($selected, $temp);
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
            $temp = printButton($db_regions[$i], $region);
            $selected = set_selected($selected, $temp);            
        }
    }
    else
    {
        for($i = (int)($size_records/2)+1; $i < $size_records; $i++ )
        {
            $temp = printButton($db_regions[$i], $region);
            $selected = set_selected($selected, $temp);
        }
    }
?>
            <p><button type="submit" 
                       name="provincie" 
                       id="provincie" 
                       value="Andere" 
                       class="btn btn-lg btn-block 
                    <?php
                        if($selected == true){
                            echo "btn-warning";
                        }
                        elseif($andere == true){
                            echo "btn-success";
                        }
                        else{
                            echo "btn-warning";  
                        }
                        
                       
                       
                    ?>
                       "
                       >Ander</button></p>
        </div>
<?php        
    #  Gaat kijken of er al een provincie geselecteerd was en deze als een groene button tonen ipv de oranje

    # Als er nog geen provincie in de sessie staat dan blijven alle knoppen gewoon oranje.
 
    echo form_close(); 
?>
    </div>
</div>