



<div class="panel-body">
    <div id="info" class="form-group">
    <?php 
        echo validation_errors(); 
        
        var_dump($db_crm);
        echo '<br>';
        var_dump($db_preset);
        echo '<br>';
        var_dump($db_tdd);
        echo '<br>';

    ?>
    </div>

<div class="col-sm-12">
        <h1>Database opruimen  pagina
<?php
        if(isset($ip) && $ip != ''){
            echo 'voor IP = ' . $ip;
        }
?>
        </h1>
    <h2>Bent u zeker dat u volgende gegevens uit de database wilt smijten</h2>
    
    
    
    
        
    
    
    
    
    
<?php
        if(isset($ip) && $ip != ''){
            $form_url = 'admin/clearDBForm/'.$ip;
            
        }
        else{
            $form_url = 'admin/clearDBForm';
        }
        
        echo form_open('admin/clearDBForm');
        
        
        
        $answer = array(
        "type" => "text",
        "name" => "answer",
        "id" => "answer",
        "placeholder" => "Database leegmaken? tip 'ja' om verder te gaan.",
        "class" => "form-control input-lg",
        
        );

            $answer['value'] = set_value('answer');


        echo "<p> ".form_input($answer)."</p>";

?>
        
    <p>
    <input type="submit" class="btn btn-lg btn-warning btn-block" value="Submit">
    </p>
<?php 
    echo form_close(); 
?>  
    <p>
<?php
    if(isset($ip) && $ip != ''){
        $admin_url = base_url('index.php/admin/admin_page/'.$ip);

    }
    else{
        $admin_url = base_url('index.php/admin/admin_page');
    }  
?>
        <a href="<?php echo $admin_url; ?>"
          class="btn btn-lg btn-warning btn-block">
            Klik hier om <b>terug</b> te gaan</a>
    </p>
</div>
    
</div>
