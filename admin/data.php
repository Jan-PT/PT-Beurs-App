<table border="1">
	<?php
	//connection to mysql
	mysql_connect("localhost", "root", ""); //server , username , password
	mysql_select_db("ptmdbpt");
	
	//query get data
	$sql = mysql_query("SELECT * FROM pt_crm");
	while($data = mysql_fetch_assoc($sql)){
		echo '
		<tr>
			<td>'.$data['first_name'].'</td>
			<td>'.$data['contact_type'].'</td>
			<td>'.$data['account'].'</td>
			<td>'.$data['last_name'].'</td>
			<td>'.$data['owner'].'</td>
			<td>'.$data['source'].'</td>
			<td>'.$data['diploma_level'].'</td>
			<td>'.$data['diploma_type'].'</td>
			<td>'.$data['diploma_sub_type'].'</td>
			<td>'.$data['school'].'</td>
			<td>'.$data['graduation_month'].'</td>
			<td>'.$data['graduation_year'].'</td>
			<td>'.$data['home_phone'].'</td>
			<td>'.$data['mobile_phone'].'</td>
			<td>'.$data['private_email'].'</td>
			<td>'.$data['gender'].'</td>
			<td>'.$data['language'].'</td>
			<td>'.$data['description'].'</td>
			<td>'.$data['nationality'].'</td>
			<td>'.$data['birthday'].'</td>
			<td>'.$data['address_street'].'</td>
			<td>'.$data['address_country'].'</td>
			<td>'.$data['address_city_belgium'].'</td>
			<td>'.$data['address_postal_code'].'</td>
			<td>'.$data['address_city'].'</td>
		</tr>
		';
	}
	mysql_free_result($sql);
	?>
</table>