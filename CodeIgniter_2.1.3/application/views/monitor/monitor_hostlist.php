<div id="container">
	<h1>Daftar host yang dimonitor oleh centreon</h1>
	<table>
		<tr>
			<td>Host Id</td>
			<td>Nama Host</td>
			<td>Alamat host</td>
			<td>Nama perintah</td>
		</tr>
	<?php foreach ($host as $host_item): ?>
		<tr>
	    	<td><?php echo $host_item['host_id'] ?></td>
    		<td><?php echo $host_item['host_name'] ?></td>
        	<td><?php echo $host_item['host_address'] ?></td>
	        <td><?php echo $host_item['command_name'] ?></td>
    	</tr>
	<?php endforeach ?>
	</table>
</div>