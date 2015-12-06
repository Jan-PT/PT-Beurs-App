<!-- View waarop de mogelijke functies die Planet Talent aanbied weergegeven worden. -->
<div id="header">
	<?php $user_data = $this->session->userdata('user_data'); ?>
	<h1>Welke functies interesseren je?</h1>
</div>
<div class="panel-body">
	<div id="info" class="form-group">
		<?php
			echo form_open("beursapp/jobForm");
			# Er wordt gezocht of de waarde van de checkbox in de sessie zit (in het 'jobs' veld). Indien dit het geval is wordt de checkbox aangevinkt.
		?>
			<BR>
			<div class="input-group">
				<span class="input-group-addon">
					<?php
					if(strpos($user_data['jobs'],'management') !== false){
					?>
						<input checked value="management" name="management" type="checkbox" id="management" aria-label="...">
					<?php
					}else{
					?>
						<input value="management" name="management" type="checkbox" id="management" aria-label="...">
					<?php
					}
					?>
				</span>
				<label  class="form-control" aria-label="...">Management</label>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<?php
					if(strpos($user_data['jobs'],'sales') !== false){
				?>
					<input checked value="sales" name="sales" type="checkbox" id="sales" aria-label="...">
				<?php
					}else{
				?>
					<input value="sales" name="sales" type="checkbox" id="sales" aria-label="...">
				<?php
					}
				?>	
				</span>
				<label  class="form-control" aria-label="...">Sales</label>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<?php
					if(strpos($user_data['jobs'],'ict_applications') !== false){
				?>
					<input checked value="ict_applications" name="ict_applications" type="checkbox" id="ict_applications" aria-label="...">
				<?php
					}else{
				?>
					<input value="ict_applications" name="ict_applications" type="checkbox" id="ict_applications" aria-label="...">
				<?php
					}
				?>	
				</span>
				<label class="form-control" aria-label="...">ICT Applications</label>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<?php
					if(strpos($user_data['jobs'],'ict_development') !== false){
				?>
					<input checked value="ict_development" name="ict_development" type="checkbox" id="ict_development" aria-label="...">
				<?php
					}else{
				?>
					<input value="ict_development" name="ict_development" type="checkbox" id="ict_development" aria-label="...">
				<?php
					}
				?>
				</span>
				<label  class="form-control" aria-label="...">ICT Development</label>
			</div>
			<BR>
			<input type="submit" class="btn btn-warning" value="Volgende">
		<?php
			echo form_close(); 
		?>
	</div>
</div>