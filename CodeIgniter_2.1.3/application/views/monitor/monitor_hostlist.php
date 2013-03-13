<div id="container">
	<h1>Daftar host yang dimonitor oleh centreon</h1>
	<table class="hor-minimalist-a">
		<thead>
		<tr>
			<th>Host Id</th>
			<th>Nama Host</th>
			<th>Alamat host</th>
			<th>Nama perintah</th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($host as $host_item): ?>
		<tr>
			<td><?php echo $host_item['host_name'] ?></td>
	    	<td><?php echo $host_item['host_id'] ?></td>    		
        	<td><?php echo $host_item['host_address'] ?></td>
	        <td><?php echo $host_item['command_name'] ?></td>
    	</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>