<!-- 
	 View met de verschillende provincies waaruit de student kan kiezen. 
	 Door de keuze van de provincie krijgt de student op de volgende view enkel de scholen uit die provincie te zien. 
-->
<div id="header">
    <?php
	$user_data = $this->session->userdata('user_data');
    if ($this->session->userdata('user_data') && $user_data['voornaam']) {
        echo "<h1>In welke provincie ga je naar school, " . $user_data['voornaam'] . "?</h1>";
    }else{
        echo "<h1>In welke provincie ga je naar school?</h1>";
    }
    ?>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
        <?php echo form_open("beursapp/regionForm");
            foreach($regions as $rec){
                    echo form_prep($rec->id)."-".form_prep($rec->name)."-". form_prep($rec->crm_name). "<br>\n"; 
                        
            }
            $size_records = count($regions);
            echo "size ". $size_records . "<br>"; 
            for($i = 0; $i <= ($size_records/2); $i++)
            {
                echo form_prep($regions[$i]->crm_name);
                echo "<br>";
                             
            }
                            echo "<br>";

            for($i = (int)($size_records/2)+1; $i < $size_records; $i++ )
            {
                echo form_prep($regions[$i]->crm_name);
                echo "<br>";
                
            }
                    #  Gaat kijken of er al een provincie geselecteerd was en deze als een groene button tonen ipv de oranje
			  if(isset($user_data['provincie']) && $user_data['provincie']!='' ){
				if($user_data['provincie'] == 'Antwerpen'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-success">TEST</button></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Oost-Vlaanderen'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-success"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Limburg'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-success"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Vlaams-Brabant'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-success"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'West-Vlaanderen'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-success"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Andere'){
		?>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning"></p>
					</div>
					<div class="col-sm-6">
						<p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning"></p>
						<p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-success"></p>
					</div>
		<?php
				}
			  }
			  else{
			  # Als er nog geen provincie in de sessie staat dan blijven alle knoppen gewoon oranje.
		?>
            <div class="col-sm-6">
                <p><button type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-lg btn-block btn-warning">Antwerpen</button></p>
                <p><button type="submit" name="provincie" id="provincie" value="Brussel" class="btn btn-lg btn-block btn-warning">Brussel</button></p>
                <p><button type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-lg btn-block btn-warning">Oost-Vlaanderen</button></p>
                <p><button type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-lg btn-block btn-warning">Limburg</button></p>
            </div>
            <div class="col-sm-6">
                <p><button type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-lg btn-block btn-warning">Vlaams-Brabant</button></p>
                <p><button type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-lg btn-block btn-warning">West-Vlaanderen</button></p>
                <p><button type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-lg btn-block btn-warning">Andere</button></p>
            </div>
        <?php 
			} echo form_close(); 
		?>
    </div>
</div>