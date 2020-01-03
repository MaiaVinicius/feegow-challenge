
<?php
	require_once('./config/config.php');
	if(!isset($_GET['debug']) && $_POST) : 
		$query = "SELECT * FROM `agendamento` WHERE cpf LIKE '%".$_POST['cpf']."%'";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $query));
		$response = json_decode(json_encode($result));
		$status = ($response->id) ? 'CPF já possui agendamento.' : 'Agendamento efetuado com sucesso.';
		if(!$response->id) {
			$insert = "INSERT INTO agendamento (specialty_id, professional_id, name, cpf, birthdate, source_id) VALUES ('".$_POST['specialty_id']."', ".$_POST['professional_id'].", '".$_POST['name']."', '".$_POST['cpf']."', '".$_POST['birthdate']."', '".$_POST['source_id']."')";
			if(mysqli_query($conn, $insert)) print_r('Agendamento efetuado com sucesso.');
			else print_r('Ocorreu um erro não especificado.');
		} else print_r($status);
	else :
		$query = "SELECT * FROM agendamento";
		$result = mysqli_query($conn,$query);
		$i = 0;
		?>
		<table width="100%" style="border: 1px black solid">
			<tr style="font-weight: bold">
				<td>id</td>
				<td>specialty_id</td>
				<td>professional_id</td>
				<td>name</td>
				<td>cpf</td>
				<td>source_id</td>
				<td>birthdate</td>
				<td>date_time</td>
			</tr>
		<?php 
			while($row = mysqli_fetch_array($result)) :		
				$i++;
				?>
				<tr <?php echo ($i&1) ? 'style="background-color: whitesmoke"' : ''; ?>>
					<td><?php print $row['id']; ?></td>
					<td><?php print $row['specialty_id']; ?></td>
					<td><?php print $row['professional_id']; ?></td>
					<td><?php print $row['name']; ?></td>
					<td><?php print $row['cpf']; ?></td>
					<td><?php print $row['source_id']; ?></td>
					<td><?php print $row['birthdate']; ?></td>
					<td><?php print $row['date_time']; ?></td>
				</tr>
				<?php 
			endwhile;
			$conn->close();
			unset($conn);
		?>
		</table>
		<?php 
	endif;