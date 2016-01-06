<!--- View waarop de student kan aanduiden waarvoor hij gecontacteerd wil worden (Stage, vast contract,...) --->
<div id="header">
<?php
    $user_data = $this->session->userdata('user_data');
    
    $contact = '';
    $tdd = '';
    
    
    $set_contact = set_value('contact');
    $set_tdd = "". set_value('tdd1')."_". set_value('tdd2')."_". set_value('tdd3')."_";

    
    if($user_data !== false){
        if(isset($user_data['contact']) && $user_data['contact'] != ''){
            
            $contact = $user_data['contact'];
            if( $user_data['contact'] == 'tdd'
                && isset($user_data['tdd']) 
                && $user_data['tdd'] != ''){
                
                $tdd = $user_data['tdd'];
            }           
            else{
                $tdd = false;
            }
            
        }
        elseif(isset($set_contact) && $set_contact != ''){
            $contact = $set_contact;
            
            if($set_contact == 'tdd'
             && isset($set_tdd )
             && $set_tdd != ''
            ){
              $tdd = $set_tdd;  
            }
            else{
                $tdd = false;
            }
            
        }
        else{
            $contact = false;
        }
            
    }

    
    
?>
    <h1>We contacteren je graag... </h1>
<!--            <h1>Plan onmiddellijk een afspraak met ons</h1>-->
        <p>
        </p>
</div>
<div class="panel-body">
    <div id="info" class="form-group" onchange="setTDD();">
    <?php

        $attributes = array('id' => 'contactForm');
        echo form_open("beursapp/contactForm", $attributes);
    ?>
        <div class="input-group input-group-lg">
            <span class="input-group-addon">
                <input type="radio" value="tdd" name="contact" id="tdd" aria-label="..." 
                       <?php 
                       if($contact == 'tdd' || $contact == false){
                           echo " checked";
                       }
                       ?>
                       >                                    
            </span>
            <label class="form-control" for='tdd' aria-label="...">

                <div class="col-sm-6" style="margin-top: 50px; margin-bottom: 40px">
                    <label for='tdd'>
                        Plan onmiddellijk je afspraak op één van onze Talent Detection Days
<!--                                We hebben een aantal data gereserveerd, wat lukt voor jou?-->
                    </label>
                </div>
                <div class="col-sm-6">

<?php
    
        
    if( isset($db_data) 
        && count($db_data) <= 2
        && count($db_data) > 0
        )
    {

        //echo count($db_data);
        $i = 1;
        foreach($db_data as $val){

            $date = $val->datum;    
            $date_e = DateTime::createFromFormat('Y-m-d', $date)->format('d M Y');
?>

    <div class="input-group input-group-lg">
        <span class="input-group-addon">
        <input type="checkbox" 
               value="<?php  echo $date; ?>" 
               name="<?php  echo 'tdd'.$i; ?>"  
               id="<?php  echo 'tdd'.$i; ?>" 
               aria-label="..."
                <?php
                    if($tdd != false && strpos($tdd,$date) !== false){ 
                        echo "checked";        
                    }                        
                ?>
               >
        </span>
        <label  class="form-control" 
                for="<?php  echo 'tdd'.$i; ?>" 
                aria-label="...">
            <?php  echo $date_e; ?>        
        </label>
    </div>
<?php
    
            $i++;
        }
    }
?>
            <div class="input-group input-group-lg">
                <span class="input-group-addon">
                <input type="checkbox" 
                       value="andere" 
                       name="tdd3"  
                       id="tdd3" 
                       aria-label="..."
                <?php
                    if($tdd != false && strpos($tdd,'andere') !== false){ 
                        echo "checked";        
                    }                        
                ?>
                       >
                </span>
                <label  class="form-control" 
                        for="tdd3" 
                        aria-label="...">
                    Andere datum
                </label>
            </div>
            </label>
                </div>
        </div>
        <div class="input-group input-group-lg">
            <span class="input-group-addon">
                <input type="radio" value="skype" name="contact" id="skype" arial-label='...'
                    <?php 
                       if($contact != false && $contact == 'skype'){
                           echo " checked";
                       }
                    ?>
                    >                                       
            </span>
            <label class="form-control" for="skype" aria-label='...'>
                Contacteer mij voor een vrijblijvend Skype interview.
            </label>
        </div>
        <div class="input-group input-group-lg">
            <span class="input-group-addon">
                <input type="radio" value="andere" name="contact" id="andere_reden" arial-label='...'
                    <?php 
                       if($contact != false && $contact == 'andere'){
                           echo " checked";
                       }
                    ?>
                    >                                       
            </span>
            <label class="form-control" for="andere_reden" aria-label='...'>
                Contacteer mij voor een andere reden.
            </label>
        </div>
        <BR>
        <input type="button" class="btn btn-lg btn-warning btn-block" value="Volgende" onclick="checkTDD();">
<?php
        echo form_close(); 
?>
</div>
</div>

<script>
  function setTDD(){
    var Sel_tdd = document.getElementById("tdd");
    var Check_tdd1 = document.getElementById("tdd1");
    var Check_tdd2 = document.getElementById("tdd2");
    var Check_ander = document.getElementById("tdd3");
    
    if(Sel_tdd.checked){
        

        Check_ander.disabled = false;
    
        if(Check_ander.checked){
            Check_tdd1.disabled = true;
            Check_tdd2.disabled = true;
        }
        else{
            Check_tdd1.disabled = false;
            Check_tdd2.disabled = false;
            //Check_tdd1.checked = false;
            //Check_tdd2.checked = false;
                
        }          
    }
    else{
     Check_tdd1.disabled = true;    
     //Check_tdd1.checked = false;    
     
     Check_tdd2.disabled = true;
     //Check_tdd2.checked = false;    

     Check_ander.disabled = true;    
     //Check_ander.checked = false;    

    }
  }  
  function checkTDD(){
    var form = document.getElementById('contactForm');
    var Sel_tdd = document.getElementById("tdd");
    var Check_tdd1 = document.getElementById("tdd1");
    var Check_tdd2 = document.getElementById("tdd2");
    var Check_ander = document.getElementById("tdd3");
    
    if(Sel_tdd.checked){
        if( !Check_tdd1.checked
            && !Check_tdd2.checked
            && !Check_ander.checked
                ){
            alert('Selecteer aub één van deze data of "andere datum".');
            return;
        }
        
        form.submit();
                  
    }
    else{
        form.submit();
    }
  }  
</script>