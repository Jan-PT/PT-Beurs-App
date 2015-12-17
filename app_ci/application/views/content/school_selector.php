<!-- 
	 View met de verschillende scholen waaruit de student kan kiezen (deze bevinden zich binnen de provincie die de student gekozen heeft). 
-->
<div id="header">
    <?php
    
    function printButton($school, $userdata)
    {
        echo "<p>"
            . "<button type=\"submit\" name=\"school\" id=\"school\" "

            . "value=\"";
        echo form_prep($school->crm_school); 
        echo "\"";

        echo "class=\"btn btn-lg btn-block ";
        if($userdata !== false && $userdata == $school->crm_school){
            echo "btn-success";
        }
        else{
            echo "btn-warning";
        }

        echo "\">";

        echo form_prep($school->school);
        echo "</button>"
             . "</p>\n";
        
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
<?php

            echo form_open("beursapp/schoolForm");
            # Gaat kijken of er al een school geselecteerd was en deze als een groene button tonen ipv de oranje

        
//        //testing sql output
//        if(isset($schools)){
//            foreach($schools as $rec)
//            {
//                 echo form_prep($rec->school)."-". form_prep($rec->crm_school) . "<br>\n";        
//            }
//        }
//        else
//        {
//            echo "No School";
//        }
        
        
        $size_records = count($schools);
        
        if(isset($user_data['school']) && $user_data['school']!='' )
        {
            $school = $user_data['school'];
        }
        else
        {
            $school = false;
        }
        
                      
//        echo "<br>";
//        echo "size of ". $size_records . "<br>";         
//        echo "prov ".$provincie ."<br><br>";
?>
        <div class="col-sm-6">
<?php
    
    if($size_records % 2 == 0)
    {
        for($i = 0; $i < ($size_records/2); $i++)
        {
            printButton($schools[$i], $school);
        }        
    }
    else
    {
        for($i = 0; $i <= (int)($size_records/2); $i++)
        {
            printButton($schools[$i], $school);
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
            printButton($schools[$i], $school);
        }
    }
    else
    {
        for($i = (int)($size_records/2)+1; $i < $size_records; $i++ )
        {
            printButton($schools[$i], $school);
        }
    }
?>
            <p><button type="submit" name="provincie" id="school" value="Andere" class="btn btn-lg btn-block btn-warning">Andere school</button></p>
        </div>                        
                        

		
<!--    <div class="col-sm-6">
        <p><input type="submit" name="school" id="school" value="AP" class="btn btn-lg btn-block btn-warning"></p>
        <p><input type="submit" name="school" id="school" value="UA" class="btn btn-lg btn-block btn-warning"></p>
        <p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-lg btn-block btn-warning"></p>
    </div>
    <div class="col-sm-6">
        <p><input type="submit" name="school" id="school" value="KDG" class="btn btn-lg btn-block btn-warning"></p>
        <p><input type="submit" name="school" id="school" value="KUL" class="btn btn-lg btn-block btn-warning"></p>
        <p><input type="submit" name="school" id="school" value="VUB" class="btn btn-lg btn-block btn-warning"></p>
    </div>-->
<?php

        echo form_close(); 
?>
    </div>
</div>