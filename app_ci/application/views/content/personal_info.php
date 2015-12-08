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
			echo form_open("beursapp/infoForm");
			$user_data = $this->session->userdata('user_data');
		?>	
		
		<div class="col-sm-6">
			<?php 
				# Als de user zijn data al eens correct ingevuld is wordt de data uit de session terug in de velden ingeladen.
				# Hierdoor kan de gebruiker zijn gegevens makkelijk nakijken en wijzigen zonder alles opnieuw te moeten invullen.
				# Als de user het form nog niet succesvol doorlopen is kan er nog geen data uit de sessie ($user_data) in de iput velden geladen worden.
				# Dan wordt er indien een veld correct is ingevuld maar er fouten zijn bij andere velden de ingevulde waarde van dit veld behouden
				# en anders de placeholder getoond.
				if ($user_data) {
										
					$voornaam = array(
						"type" => "text",
						"name" => "voornaam",
						"id" => "voornaam",
						"placeholder" => "Voornaam",
						"value" => $user_data['voornaam'],
						"class" => "form-control",
						"tabindex" => "1"
					);	
					echo "<p>".form_input($voornaam)."</p>";
					
					$gsm = array(
						"type" => "text",
						"name" => "gsm",
						"id" => "gsm",
						"placeholder" => "Gsm nummer",
						"value" => $user_data['gsm'],
						"class" => "form-control",
                        "tabindex" => "3"
					);
					echo "<p>".form_input($gsm)."</p>";
                                
                    $email = array(
						"type" => "email",
						"name" => "email",
						"id" => "email",
						"placeholder" => "Email",
						"value" => $user_data['email'],
						"class" => "form-control",
                        "tabindex" => "5"
					);
					echo "<p>".form_input($email)."</p>";
				} 
				else{
					$voornaam = array(
						"type" => "text",
						"name" => "voornaam",
						"id" => "voornaam",
						"placeholder" => "Voornaam",
						"value" => set_Value("voornaam"),
						"class" => "form-control",
						"tabindex" => "1"
					);	
					echo "<p>".form_input($voornaam)."</p>";
					
					$gsm = array(
						"type" => "text",
						"name" => "gsm",
						"id" => "gsm",
						"placeholder" => "Gsm nummer",
						"value" => set_Value("gsm"),
						"class" => "form-control",
                        "tabindex" => "3"
					);
					echo "<p>".form_input($gsm)."</p>";
                                
                    $email = array(
						"type" => "email",
						"name" => "email",
						"id" => "email",
						"placeholder" => "Email",
						"value" => set_Value("email"),
						"class" => "form-control",
                        "tabindex" => "5"
					);
					echo "<p>".form_input($email)."</p>";
				}
			?>
		</div>
		<div class="col-sm-6">
			<?php 
			if ($user_data) {
				$naam = array(
					"type" => "text",
					"name" => "naam",
					"id" => "naam",
					"placeholder" => "Naam",
					"value" => $user_data['naam'],
					"class" => "form-control",
                    "tabindex" => "2"
					);	
				echo "<p>".form_input($naam)."</p>";
					
				$postcodefield = $user_data['postcode']."-".$user_data['gemeente'];
				$postcode = array(
                    "name" => "postcode",
                    "list"=>"postcode",
                    "value" => $postcodefield,
                    "placeholder" => "Postcode",
                    "class" => "form-control",
                    "tabindex" => "4"
				);	
				echo "<p>".form_input($postcode)."</p>";	
				
			} else{
				$naam = array(
						"type" => "text",
						"name" => "naam",
						"id" => "naam",
						"placeholder" => "Naam",
						"value" => set_Value("naam"),
						"class" => "form-control",
						"tabindex" => "2"
					);	
					echo "<p>".form_input($naam)."</p>";
				
				$postcode = array(
					"name" => "postcode",
					"list"=>"postcode",
					"value" => set_Value("postcode"),
					"placeholder" => "Postcode",
					"class" => "form-control",
					"tabindex" => "4"
				);	
				echo "<p>".form_input($postcode)."</p>";	
			}
			?>
                    <input type="submit" class="btn btn-warning col-sm-12" value="Volgende">
		</div>

		<!-- Datalist met alle postcode opties die zich in de database bevinden. Deze datalist wordt achter het postcode input veld geplaats aan de hand van de id's -->
        <datalist id="postcode">
			<?php
				foreach($records as $rec){
					echo "<option value='".$rec->zipcode."-".$rec->name."'>\n"; 
				}
			?>
        </datalist>	
		
		<?php
			echo form_close();
		?>
	</div>
</div>
