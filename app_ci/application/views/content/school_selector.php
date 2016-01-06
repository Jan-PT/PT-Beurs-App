<!-- 
	 View met de verschillende scholen waaruit de student kan kiezen (deze bevinden zich binnen de provincie die de student gekozen heeft). 
-->
<div id="header">
    <?php
    
    function printButton($school, $userdata)
    {
        $selected = FALSE;
        
        echo "<p>"
            . "<button type=\"submit\" name=\"school\" id=\"school\" "

            . "value=\"";
        echo form_prep($school->crm_school); 
        echo "\"";

        echo "class=\"btn btn-lg btn-block ";
        if($userdata !== false && $userdata == $school->crm_school){
            echo "btn-success";
            $selected = true;
        }
        else{
            echo "btn-warning";
            $selected = false;
        }

        echo "\">";

        echo form_prep($school->school);
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
    

    
    if ($this->session->userdata('user_data') 
            && isset($user_data['provincie'])
            && isset($user_data['voornaam']) ) 
    {
        echo "<h1>Naar welke school in ". $user_data['provincie']." ga je, "
                .$user_data['voornaam']."?</h1>";
    }
    else
    {
        echo "<h1>Waar ga je naar school?</h1>";
    }
    ?>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
    </div>
<?php

    echo form_open("beursapp/schoolForm");
    # Gaat kijken of er al een school geselecteerd was en deze als een groene button tonen ipv de oranje
        
if(isset($db_schools)){        
    $size_records = count($db_schools);

    if(isset($user_data['school']) && $user_data['school']!='' )
    {
        $school = $user_data['school'];
    }
    else
    {
        $school = false;
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
            $temp = printButton($db_schools[$i], $school);
            $selected = set_selected($selected, $temp);            

        }        
    }
    else
    {
        for($i = 0; $i <= (int)($size_records/2); $i++)
        {
            $temp = printButton($db_schools[$i], $school);
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
            $temp = printButton($db_schools[$i], $school);
            $selected = set_selected($selected, $temp);            

        }
    }
    else
    {
        for($i = (int)($size_records/2)+1; $i < $size_records; $i++ )
        {
            $temp = printButton($db_schools[$i], $school);
            $selected = set_selected($selected, $temp);            

        }
    }
} 
else {
    echo "No School";
}

?>
            <p><button type="submit" 
                       name="school" 
                       id="school" 
                       value="Andere" 
                       class="btn btn-lg btn-block 
                    <?php
                        if($selected == true){
                            echo "btn-warning";
                        }
                        elseif($school != false && $andere == true){
                            echo "btn-success";
                        }
                        else{
                            echo "btn-warning";  
                        }
                        
                       
                       
                    ?>
                    ">
                    Ander
                </button>
            </p>
        </div>                        
                        

<?php

        echo form_close(); 
?>
    </div>
</div>