<div id="container">
	<h1>Daftar service yang dimonitor oleh centreon</h1>
	<table id="hor-minimalist-a">
		<thead>
		<tr>
			<th>Nama Host</th>
			<th>Deskripsi Service</th>
			<th>Waktu update</th>
			<th>Informasi</th>			
		</tr>
		</thead>
		<tbody>
	<?php foreach ($service as $service_item): ?>
		<tr>
			<td><?php echo $service_item['host_name'] ?></td>
	    	<td><?php echo $service_item['service_description'] ?></td>
        	<td><?php echo $service_item['status_update_time'] ?></td>
	        <td><?php echo $service_item['plugin_output'] ?></td>
    	</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>