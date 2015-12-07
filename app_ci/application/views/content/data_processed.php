<!--- Pagina die de student te zien krijgt nadat hij al zijn gegevens heeft ingevuld --->
<!--- Hierop wordt een overzicht van alle gegevens weergegeven en bevestigd dat we deze goed ontvangen hebben. --> 
<!--- Nadat de student op de afsluit button drukt of als de refresh time verlopen is wordt de sessie leeggemaakt -->
<!--- en naar de startpagina geredirect zodat de volgende student kan starten met het invullen van zijn gegevens -->
<?php 
	//header("Refresh: 10;url=confirmationForm");
	$user_data = $this->session->userdata('user_data');
?>
<div id="header">
    <h1>Hopelijk tot binnenkort!</h1>
</div>
<div class="panel-body">
    <p>Bedankt. We hebben je gegevens successvol ontvangen en verwerkt. </p>
	<?php
		echo form_open("beursapp/confirmationForm");
		# Alle info van de student wordt hieronder weergegeven.
	?>
	<table>
		<tr>
			<th>Naam: </th>
			<td><?php echo $user_data['voornaam'].' '.$user_data['naam']; ?></td>
		</tr>
		<tr>
			<th>Gsm nummer: </th>
			<td><?php echo $user_data['gsm'];?></td>
		</tr>
		<tr>
			<th>Email: </th>
			<td><?php echo $user_data['email'];?></td>
		</tr>
		<tr>
			<th>Postcode: </th>
			<td><?php echo $user_data['postcode'].' '.$user_data['gemeente']; ?></td>
		</tr>
		<tr>
			<th>Provincie: </th>
			<td><?php echo $user_data['provincie'];?></td>
		</tr>
		<tr>
			<th>School: </th>
			<td><?php echo $user_data['school'];?></td>
		</tr>
		<tr>
			<th>Diploma niveau: </th>
			<td><?php echo $user_data['diplomaLV'];?></td>
		</tr>
		<tr>
			<th>Diploma: </th>
			<td><?php echo $user_data['diploma'];?></td>
		</tr>
                <tr>
			<th>Afstuderen in: </th>
			<td><?php echo $user_data['grad_maand'];?> - <?php echo $user_data['grad_jaar'];?></td>
		</tr>
		<tr>
			<th>Jobs: </th>
			<td><?php echo $user_data['jobs'];?></td>
		</tr>
		<tr>
			<th>Type: </th>
			<td><?php echo $user_data['type'];?></td>
		</tr>
	</table>
	<BR>
	<input type="submit" class="btn btn-warning" value="Afsluiten">
	<?php
		echo form_close(); 
	?>
</div>