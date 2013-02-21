<div id="container">
	<h1>Daftar host kondisi host</h1>
	<p> Pilih waktu monitoring :
		<?php 
			$month_list = range(1,12); //list of month
			echo form_open('cen_cont/view_log');
			echo form_label('Bulan', 'month');
			echo form_dropdown('month', $month_list, date('m',time())-1);
			echo form_label('Tahun', 'year');
			echo form_dropdown('year', $year, date('Y',time()) );
			echo form_submit('submit', 'Pilih');
			echo form_close();
		?>
	</p>
	<p>Berikut adalah laporan <i>Up Time</i> sejak tanggal <b><?php echo $host_log['begin_time'] ?></b> hingga
	<b><?php echo $host_log['end_time'] ?></b>.  </p>
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
	<?php foreach ($host_log['host_log'] as $host_item): ?>
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