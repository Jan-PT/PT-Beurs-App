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
			  # Gaat kijken of er al een provincie geselecteerd was en deze als een groene button tonen ipv de oranje
			  if($user_data['provincie']!='' && $user_data['provincie'] != null){
				if($user_data['provincie'] == 'Antwerpen'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-success" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Oost-Vlaanderen'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-success" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Limburg'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-success" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Vlaams-Brabant'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-success" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'West-Vlaanderen'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-success" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
					</div>
		<?php
				}
				
				if($user_data['provincie'] == 'Andere'){
		?>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
					</div>
					<div class="col-sm-4">
						<p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
						<p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-success" style="width:300px"></p>
					</div>
		<?php
				}
			  }
			  else{
			  # Als er nog geen provincie in de sessie staat dan blijven alle knoppen gewoon oranje.
		?>
            <div class="col-sm-4">
                <p><input type="submit" name="provincie" id="provincie" value="Antwerpen" class="btn btn-warning" style="width:300px"></p>
                <p><input type="submit" name="provincie" id="provincie" value="Oost-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
                <p><input type="submit" name="provincie" id="provincie" value="Limburg" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-4">
                <p><input type="submit" name="provincie" id="provincie" value="Vlaams-Brabant" class="btn btn-warning" style="width:300px"></p>
                <p><input type="submit" name="provincie" id="provincie" value="West-Vlaanderen" class="btn btn-warning" style="width:300px"></p>
                <p><input type="submit" name="provincie" id="provincie" value="Andere" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
			} echo form_close(); 
		?>
    </div>
</div>