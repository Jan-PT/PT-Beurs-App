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
		
		<div class="col-sm-4">
			<?php 
				if (($this->session->userdata('user_data'))) {
										
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
				}else{
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
		<div class="col-sm-4">
			<?php 
			if (($this->session->userdata('user_data'))) {
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
					
				
				$postcode = array(
                    "name" => "postcode",
                    "list"=>"postcode",
                    "value" => $user_data['postcode'],
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

        <datalist id="postcode">
			<?php
				foreach($records as $rec){
					echo "<option value=\"".$rec->zipcode."-".$rec->name."\">\n"; 
				}
			?>
        </datalist>	
		
		<?php
			echo form_close();
		?>
	</div>
</div>
