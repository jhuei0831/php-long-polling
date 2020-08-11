<?php 
	include_once('./server/database.php');
	if ($_POST) {
		$sql = "INSERT INTO `admin` (`password`,`name`) VALUES ('".$_POST['name']."','".$_POST['password']."')";
		$result = $dbgo->query($sql);
	}
	$sql_data = "select * from `admin`";
	$data = $dbgo->query($sql_data);
	$row1 = $data->fetchAll(PDO::FETCH_ASSOC);

	$json = json_encode($row1);
	$max = array();
	foreach ($row1 as $key => $value) {
		array_push($max, $value['id']);
	}
	echo(max($max));
?>
<form method="post">
	name : <input type="text" name="name">
	password : <input type="password" name="password">
	<input type="submit">
</form>
<!-- <div>
	<table border="1">
		<thead>
			<th>id</th>
			<th>name</th>
			<th>password</th>
		</thead>
		<tbody>
			<?php foreach ($row1 as $key => $value): ?>
				<tr>
					<td><?=$value['id']?></td>
					<td><?=$value['name']?></td>
					<td><?=$value['password']?></td>
				</tr>
			<?php endforeach ?>	
		</tbody>
	</table>
</div> -->