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
					"class" => "form-control",
                                        "tabindex" => "1"
				);	
				echo "<p>".form_input($naam)."</p>";

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
					"type" => "text",
					"name" => "email",
					"id" => "email",
					"placeholder" => "Email",
					"value" => set_Value("email"),
					"class" => "form-control",
                                        "tabindex" => "5"
				);
				echo "<p>".form_input($email)."</p>";
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
					"class" => "form-control",
                                        "tabindex" => "2"
				);	
				echo "<p>".form_input($voornaam)."</p>";
				
				$postcode = array(

                                    "name" => "postcode",
                                    "list"=>"postcode",
                                    "value" => set_Value("postcode"),
                                    "placeholder" => "Postcode",
                                    "class" => "form-control",
                                    "tabindex" => "4"

				);	
				echo "<p>".form_input($postcode)."</p>";	
			?>
                    <input type="submit" class="btn btn-warning col-sm-12" value="Volgende">
		</div>

        <datalist id="postcode">
			<?php
				foreach($records as $rec){
					echo '<option value='.$rec->zipcode."-".$rec->name.'>'; 
				}
			?>
        </datalist>	
		
		<?php
			echo form_close();
		?>
	</div>
</div>
