<div id="header">
	<h1>Welke diploma heb je of ga je behalen?</h1>
</div>
<div class="panel-body">
	<div id="info" class="form-group">
		<form>
			<select class="btn btn-warning dropdown-toggle">
				<option value="" hidden selected>Diploma niveau</option>
				<option value="bProfessioneel">Professionele bachelor</option>
				<option value="bTechnisch">Technische bachelor</option>
				<option value="master">Master</option>
			</select>
			<BR><BR>
			<input list="diploma" class="form-control">

			<!--- 
				diploma's opsplitsen in datalists aan de hand van diploma niveau 
				en de datalist aan de input list hangen
			---->
			
			<datalist id="diploma">
				<option value="Professionele bachelor in de Toegepaste Informatica">
				<option value="Professionele bachelor Electronica-ICT">
				<option value="Master in de Toegepaste Informatica">
			</datalist>
			<BR>
			<a href="<?php echo site_url('beursapp/job');?>" class="btn btn-warning">Volgende</a>
		</form>
	</div>
</div>