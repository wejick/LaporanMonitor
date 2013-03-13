<div id="container">
	<h1>Daftar kondisi host</h1>
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
	<table class="hor-minimalist-a">
		<thead>
		<tr>
			<th>Host Name</th>
			<th>Host Id</th>
			<th>Up AttempT</th>
			<th>Total Up Time</th>
			<th>Down Attemp</th>
			<th>Total Down Time</th>
			<th>Unreachable Attempt</th>
			<th>Total Unreachable Time</th>
			<th>Total Uncategorized Time</th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($host_log['host_log'] as $host_item): ?>
		<tr>
			<td><?php echo $host_item['hostname']?></td>
	    	<td><?php echo $host_item['host_id'] ?></td>
    		<td><?php echo $host_item['UP_A'] ?></td>
        	<td>
        		<?php
        			if(!(intval($host_item['UP_T']['month']) === 0))
        				echo $host_item['UP_T']['month']." Bulan ";
        			if(!(intval($host_item['UP_T']['day']) === 0))
        				echo $host_item['UP_T']['day']." Hari ";
        			if(!(intval($host_item['UP_T']['hour']) === 0))
        				echo $host_item['UP_T']['hour']." Jam ";
        			if(!(intval($host_item['UP_T']['min']) === 0))
        				echo $host_item['UP_T']['min']." Menit ";
        			if(!(intval($host_item['UP_T']['sec']) === 0))
        				echo $host_item['UP_T']['sec']." Detik";
        		?>
        	</td>
	        <td><?php echo $host_item['DOWN_A'] ?></td>
	        <td>
				<?php
        			if(!(intval($host_item['DOWN_T']['month']) === 0))
        				echo $host_item['DOWN_T']['month']." Bulan ";
        			if(!(intval($host_item['DOWN_T']['day']) === 0))
        				echo $host_item['DOWN_T']['day']." Hari ";
        			if(!(intval($host_item['DOWN_T']['hour']) === 0))
        				echo $host_item['DOWN_T']['hour']." Jam ";
        			if(!(intval($host_item['DOWN_T']['min']) === 0))
        				echo $host_item['DOWN_T']['min']." Menit ";
        			if(!(intval($host_item['DOWN_T']['sec']) === 0))
        				echo $host_item['DOWN_T']['sec']." Detik";
        		?>
	        </td>
	        <td><?php echo $host_item['UNREACHABLE_A'] ?></td>
	        <td>
				<?php
        			if(!(intval($host_item['UNREACHABLE_T']['month']) === 0))
        				echo $host_item['UNREACHABLE_T']['month']." Bulan ";
        			if(!(intval($host_item['UNREACHABLE_T']['day']) === 0))
        				echo $host_item['UNREACHABLE_T']['day']." Hari ";
        			if(!(intval($host_item['UNREACHABLE_T']['hour']) === 0))
        				echo $host_item['UNREACHABLE_T']['hour']." Jam ";
        			if(!(intval($host_item['UNREACHABLE_T']['min']) === 0))
        				echo $host_item['UNREACHABLE_T']['min']." Menit ";
        			if(!(intval($host_item['UNREACHABLE_T']['sec']) === 0))
        				echo $host_item['UNREACHABLE_T']['sec']." Detik";
        		?>
        	</td>
	        <td>
				<?php
        			if(!(intval($host_item['UNDETERMINED_T']['month']) === 0))
        				echo $host_item['UNDETERMINED_T']['month']." Bulan ";
        			if(!(intval($host_item['UNDETERMINED_T']['day']) === 0))
        				echo $host_item['UNDETERMINED_T']['day']." Hari ";
        			if(!(intval($host_item['UNDETERMINED_T']['hour']) === 0))
        				echo $host_item['UNDETERMINED_T']['hour']." Jam ";
        			if(!(intval($host_item['UNDETERMINED_T']['min']) === 0))
        				echo $host_item['UNDETERMINED_T']['min']." Menit ";
        			if(!(intval($host_item['UNDETERMINED_T']['sec']) === 0))
        				echo $host_item['UNDETERMINED_T']['sec']." Detik";
        		?>
	        </td>
    	</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>