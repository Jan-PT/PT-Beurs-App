<div id="header">
	<h1>Vertel ons wat over jezelf</h1>
</div>
<div class="panel-body">
	<div id="info" class="form-group">
		<?php 
			echo validation_errors(); 
			echo form_open("beursapp/infoForm");
		?>	
		<div class="col-sm-4">
			<?php 
				$naam = array(
					"type" => "text",
					"name" => "naam",
					"id" => "naam",
					"placeholder" => "Naam",
					"value" => set_Value("naam"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($naam)."</p>";
				
				$straat = array(
					"type" => "text",
					"name" => "straat",
					"id" => "straat",
					"placeholder" => "Straat",
					"value" => set_Value("straat"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($straat)."</p>";
				
				$bus = array(
					"type" => "text",
					"name" => "bus",
					"id" => "bus",
					"placeholder" => "Bus",
					"value" => set_Value("bus"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($bus)."</p>";
				
				$gsm = array(
					"type" => "text",
					"name" => "gsm",
					"id" => "gsm",
					"placeholder" => "Gsm nummer",
					"value" => set_Value("gsm"),
					"class" => "form-control"
				);
				echo "<p>".form_input($gsm)."</p>";
			?>
		</div>
		<div class="col-sm-4">
			<?php 
				$voornaam = array(
					"type" => "text",
					"name" => "voornaam",
					"id" => "voornaam",
					"placeholder" => "Voornaam",
					"value" => set_Value("voornaam"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($voornaam)."</p>";
				
				$huisnr = array(
					"type" => "text",
					"name" => "huisnr",
					"id" => "huisnr",
					"placeholder" => "Huisnummer",
					"value" => set_Value("huisnr"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($huisnr)."</p>";
				
				$postcode = array(
					"type" => "text",
					"name" => "postcode",
					"id" => "postcode",
					"placeholder" => "Postcode",
					"value" => set_Value("postcode"),
					"class" => "form-control"
				);	
				echo "<p>".form_input($postcode)."</p>";
				
				$email = array(
					"type" => "text",
					"name" => "email",
					"id" => "email",
					"placeholder" => "Email",
					"value" => set_Value("email"),
					"class" => "form-control"
				);
				echo "<p>".form_input($email)."</p>";
			?>
		</div>
		<input type="submit" class="btn btn-warning">
		<?php
			echo form_close();
		?>
	</div>
</div>
