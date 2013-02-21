<div id="container">
	<h1>Daftar host kondisi host</h1>
	<table id="hor-minimalist-a">
		<thead>
		<tr>
			<th>Host Id</th>
			<th>UP_A</th>
			<th>UP_T</th>
			<th>DOWN_A</th>
			<th>DOWN_T</th>
			<th>UNREACHABLE_A</th>
			<th>UNREACHABLE_T</th>
			<th>UNDETERMINED_T</th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($host as $host_item): ?>
		<tr>
	    	<td><?php echo $host_item['host_id'] ?></td>
    		<td><?php echo $host_item['UP_A'] ?></td>
        	<td><?php echo $host_item['UP_T'] ?></td>
	        <td><?php echo $host_item['DOWN_A'] ?></td>
	        <td><?php echo $host_item['DOWN_T'] ?></td>
	        <td><?php echo $host_item['UNREACHABLE_A'] ?></td>
	        <td><?php echo $host_item['UNREACHABLE_T'] ?></td>
	        <td><?php echo $host_item['UNDETERMINED_T'] ?></td>
    	</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>