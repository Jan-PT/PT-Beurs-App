<!-- 
	 View waarop de student zijn persoonlijke gegevens moet invullen. 
	 Deze gegevens worden in een sessie geplaatst zodat we de overige views kunnen personaliseren en op het einde zijn gegevens kunnen opslaan.
-->
<div id="header">
        <h1>Vertel ons wat over jezelf</h1>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
    <?php 
        echo validation_errors(); 
        $user_data = $this->session->userdata('user_data');
        //var_dump($user_data);
    ?>
    </div>
    
<?php
    echo form_open("beursapp/infoForm");
?>    

<div class="col-sm-6">
    <?php 
    # Als de user zijn data al eens correct ingevuld is wordt de data uit de session terug in de velden ingeladen.
    # Hierdoor kan de gebruiker zijn gegevens makkelijk nakijken en wijzigen zonder alles opnieuw te moeten invullen.
    # Als de user het form nog niet succesvol doorlopen is kan er nog geen data uit de sessie ($user_data) in de iput velden geladen worden.
    # Dan wordt er indien een veld correct is ingevuld maar er fouten zijn bij andere velden de ingevulde waarde van dit veld behouden
    # en anders de placeholder getoond.
    if($user_data ) 
    {

        $voornaam = array(
            "type" => "text",
            "name" => "voornaam",
            "id" => "voornaam",
            "placeholder" => "Voornaam",
            //"value" => $user_data['voornaam'],
            "class" => "form-control input-lg",
            "tabindex" => "1"
            );	
        if(isset($user_data['voornaam'])){
            $voornaam["value"] = $user_data['voornaam'];
        }

        echo "<p>".form_input($voornaam)."</p>";

        $gsm = array(
            "type" => "tel",
            "name" => "gsm",
            "id" => "gsm",
            "placeholder" => "Gsm +32 123 45 67 89",
            //"value" => str_replace(' ', '', $user_data['gsm']),
            "class" => "form-control input-lg bfh-phone",
            "tabindex" => "3",
            "data-format" => "+32 ddd dd dd dd"
            //"pattern" => "[+]{1}[0-9]{10,11}",
            //"title" => "+xxxxxxxxxxx \n(11 tot 12 cijfers)"
            );
        if(isset($user_data['gsm'])){
            $gsm["value"] = str_replace(' ', '', $user_data['gsm']);
        }
        
        echo "<p>".form_input($gsm)."</p>";

        $email = array(
            "type" => "email",
            "name" => "email",
            "id" => "email",
            "placeholder" => "Email",
            //"value" => $user_data['email'],
            "class" => "form-control input-lg",
            "tabindex" => "5"
            );
        if(isset($user_data['email'])){
            $email["value"] = $user_data['email'];
        }
        echo "<p>".form_input($email)."</p>";
    } 
    else
    {
        $voornaam = array(
            "type" => "text",
            "name" => "voornaam",
            "id" => "voornaam",
            "placeholder" => "Voornaam",
            "value" => set_Value("voornaam"),
            "class" => "form-control input-lg",
            "tabindex" => "1"
            );	
        echo "<p>".form_input($voornaam)."</p>";

        $gsm = array(
            "type" => "tel",
            "name" => "gsm",
            "id" => "gsm",
            "placeholder" => "Gsm +32123456789",
            "value" => set_Value("gsm"),
            "class" => "form-control input-lg bfh-phone",
            "tabindex" => "3",
            "data-format" => "+32 ddd dd dd dd"

//            "pattern" => "[+]{1}[0-9]{10,11}",
//            "title" => "+xxxxxxxxxxx \n(11 tot 12 cijfers)"                                          
        );
        
        echo "<p>".form_input($gsm)."</p>";

        $email = array(
            "type" => "email",
            "name" => "email",
            "id" => "email",
            "placeholder" => "Email",
            "value" => set_Value("email"),
            "class" => "form-control input-lg",
            "tabindex" => "5"
            );
        echo "<p>".form_input($email)."</p>";
    }
?>
</div>
<div class="col-sm-6">
<?php 
    if ($user_data) 
    {
        $naam = array(
            "type" => "text",
            "name" => "naam",
            "id" => "naam",
            "placeholder" => "Naam",
            //"value" => $user_data['naam'],
            "class" => "form-control input-lg",
            "tabindex" => "2"
        );
        
        if(isset($user_data['naam'])){
            $naam["value"] = $user_data['naam'];
        }
        echo "<p>".form_input($naam)."</p>";

        if( isset($user_data['postcode'], $user_data['gemeente']) ) {
            if($user_data['gemeente'] != '')
            {
                $postcodefield = $user_data['postcode']."-".$user_data['gemeente'];
            }
            else
            {
                $postcodefield = $user_data['postcode'];
            }
        }
        else {
            $postcodefield = '';
        }
        $postcode = array(
            "type" => "tel",

            "name" => "postcode",
            "list"=>"postcode",
            "value" => $postcodefield,
            "placeholder" => "Postcode",
            "class" => "form-control input-lg",
            "tabindex" => "4"
        );	
        echo "<p>".form_input($postcode)."</p>";	

    } 
    else
    {
        $naam = array(
            "type" => "text",
            "name" => "naam",
            "id" => "naam",
            "placeholder" => "Naam",
            "value" => set_Value("naam"),
            "class" => "form-control input-lg",
            "tabindex" => "2"
        );	
        echo "<p>".form_input($naam)."</p>";

        $postcode = array(
            "type" => "tel",

            "name" => "postcode",
            "list"=>"postcode",
            "value" => set_Value("postcode"),
            "placeholder" => "Postcode",
            "class" => "form-control input-lg",
            "tabindex" => "4"
        );	
        echo "<p>".form_input($postcode)."</p>";	
    }
?>
</div>

<div class="col-sm-12">
    <input type="submit" class="btn btn-warning btn-lg btn-block" value="Volgende">
</div>
    
<!-- Datalist met alle postcode opties die zich in de database bevinden. Deze datalist wordt achter het postcode input veld geplaats aan de hand van de id's -->
<datalist id="postcode">
<?php
    foreach($records as $rec)
    {
        echo "<option value='".form_prep($rec->zipcode)."-".form_prep($rec->name)."'>\n"; 
    }
?>
</datalist>	

<?php
    echo form_close();
?>
</div>
