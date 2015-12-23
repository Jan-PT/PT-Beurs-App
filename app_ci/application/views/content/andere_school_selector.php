<!-- 
	 View met de verschillende scholen waaruit de student kan kiezen (deze bevinden zich binnen de provincie die de student gekozen heeft). 
-->
<div id="header">
    <?php
	$user_data = $this->session->userdata('user_data');
        
        if( $user_data !== false 
            && isset($user_data['voornaam'])
            && $user_data['voornaam'] != ''
        ){
           if( isset($user_data['provincie'])
               && $user_data['provincie'] != '' ) {
                echo "<h1>Naar welke school in ". $user_data['provincie']." ga je, "
                .$user_data['voornaam']."?</h1>";
           }
           else{
               echo "<h1>Waar ga je naar school, "
                .$user_data['voornaam']."?</h1>";
           }
        }
        else{
            echo "<h1>Waar ga je naar school?</h1>";
        }
            
        
    ?>
    

</div>
<div class="panel-body">
    <div id="info" class="form-group">
    </div>
<?php

//    var_dump($user_data);


    echo validation_errors();

    echo form_open("beursapp/andere_schoolForm");
//    echo form_open("beursapp/diploma");
?>
        
        
        <p>
            <input type="text" 
                   name="provincie" 
                   placeholder="In welke regio ga je naar school?" 
                   class="form-control input-lg"
                   <?php
                    if(isset($user_data['provincie']) 
                           && $user_data['provincie'] != ''
                           && $user_data['provincie'] != 'Andere'
                    ){
                        echo 'value="';
                        echo $user_data['provincie'];
                        echo '"';                   
                    }
                    else {
                        echo 'value="';
                        echo set_value('provincie');
                        echo '"';                   
                    
                    }
                   ?>
                   
                   >
        </p>
        <p>
            <input type="text"
                   name="school"
                   placeholder="Op welke school zit je?" 
                   class="form-control input-lg"
                   <?php
                    if(isset($user_data['school']) 
                           && $user_data['school'] != ''
                           && $user_data['school'] != 'Andere'

                    ){
                        echo 'value="';
                        echo $user_data['school'];
                        echo '"';                   
                    }
                    else {
                        echo 'value="';
                        echo set_value('school');
                        echo '"';                   
                    
                    }
                   ?>
                   >
        </p>
        
        <input type="submit" class="btn btn-warning btn-lg btn-block" value="Volgende">

<?php
        
    echo form_close(); 
?>
    </div>
</div>