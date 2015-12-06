<!--- View waarop de student kan aanduiden waarvoor hij gecontacteerd wil worden (Stage, vast contract,...) --->
<div id="header">
	<?php $user_data = $this->session->userdata('user_data'); ?>
	<h1>Waarvoor kunnen we jou contacteren?</h1>
</div>
<div class="panel-body">
	<div id="info" class="form-group">
		<?php
			echo form_open("beursapp/typeForm");
		?>
			<div class="input-group ">
				<span class="input-group-addon">
				<?php
					# Er wordt gezocht of de waarde van de checkbox in de sessie zit (in het 'type' veld). Indien dit het geval is wordt de checkbox aangevinkt.
					if(strpos($user_data['type'],'vaste_job') !== false){
				?>
					<input checked value="vaste_job" name="vaste_job" type="checkbox" id="vaste_job" aria-label="...">
				<?php
					}else{
				?>
					<input value="vaste_job" name="vaste_job" type="checkbox" id="vaste_job" aria-label="...">
				<?php
					}
				?>
				</span>
				<label  class="form-control" aria-label="...">Vaste job</label>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<?php
					if(strpos($user_data['type'],'stage') !== false){
				?>
					<input checked value="stage" name="stage" type="checkbox" id="stage" aria-label="...">
				<?php
					}else{
				?>
					<input value="stage" name="stage" type="checkbox" id="stage" aria-label="...">
				<?php
					}
				?>	
				</span>
				<label  class="form-control" aria-label="...">Stage</label>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<?php
					if(strpos($user_data['type'],'andere') !== false){
				?>
					<input checked value="andere" name="andere" type="checkbox" id="andere" aria-label="...">
				<?php
					}else{
				?>
					<input value="andere" name="andere" type="checkbox" id="andere" aria-label="...">
				<?php
					}
				?>	
				</span>
				<label  class="form-control" aria-label="...">Andere</label>
			</div>
			<BR>
			<input type="submit" class="btn btn-warning" value="Volgende">
		<?php
			echo form_close(); 
		?>
	</div>
</div>