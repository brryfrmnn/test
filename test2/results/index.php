<?php

require '../vendor/autoload.php';

$validator = new \Brryfrmnn\Test2\Validator;

$typeA = $validator->make('Type_A.xlsx');
$dataA = $validator->validate($typeA);

$typeB = $validator->make('Type_B.xlsx');
$dataB = $validator->validate($typeB);

?>

	<h3>Sample Output Type A</h3>
	<table border="1">
		<thead>
			<tr>
				<th>Row</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dataA as $row => $item) { ?>
				<tr>
					<td><?php echo $row;?></td>
					<td>
						<?php
							$dataError = implode(', ', $item);
							echo $dataError;
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<h3>Sample Output Type B</h3>
	<table border="1">
		<thead>
			<tr>
				<th>Row</th>
				<th>Error</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($dataB as $row => $item) { ?>
				<tr>
					<td><?php echo $row;?></td>
					<td>
						<?php
							$dataError = implode(', ', $item);
							echo $dataError;
						?>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
