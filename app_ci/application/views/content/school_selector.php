<!-- 
	 View met de verschillende scholen waaruit de student kan kiezen (deze bevinden zich binnen de provincie die de student gekozen heeft). 
-->
<div id="header">
    <?php
	$user_data = $this->session->userdata('user_data');
    if ($this->session->userdata('user_data') && $user_data['provincie']) {
        echo "<h1>Naar welke school in ".$user_data['provincie']." ga je, ".$user_data['voornaam']."?</h1>";
    }else{
        echo "<h1>Waar ga je naar school?</h1>";
    }
    ?>
</div>
<div class="panel-body">
    <div id="info" class="form-group">
        <?php
			echo form_open("beursapp/schoolForm");
			# Gaat kijken of er al een school geselecteerd was en deze als een groene button tonen ipv de oranje
			if($user_data['school']!=''){
				if($user_data['school'] == 'AP'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-success" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
				}
				
				if($user_data['school'] == 'UA'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-success" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
				}
				if($user_data['school'] == 'Thomas More'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-success" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
				}
				
				if($user_data['school'] == 'KDG'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-success" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
				}
				
				if($user_data['school'] == 'KUL'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-success" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
        <?php 
				}
				
				if($user_data['school'] == 'VUB'){
		?>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-success" style="width:300px"></p>
            </div>
        <?php 
				}
			}
			# Als er nog geen school in de sessie staat dan blijven alle knoppen gewoon oranje.
			else{
		?>
			<div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="AP" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="UA" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="Thomas More" class="btn btn-warning" style="width:300px"></p>
            </div>
            <div class="col-sm-6">
				<p><input type="submit" name="school" id="school" value="KDG" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="KUL" class="btn btn-warning" style="width:300px"></p>
				<p><input type="submit" name="school" id="school" value="VUB" class="btn btn-warning" style="width:300px"></p>
            </div>
		<?php
			}
			echo form_close(); 
		?>
    </div>
</div>