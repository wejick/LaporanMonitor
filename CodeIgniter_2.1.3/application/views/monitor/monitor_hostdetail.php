<div id="container">
	<h1>Daftar kondisi host</h1>
	<p> Pilih waktu monitoring :
		<?php 
			$month_list = range(1,12); //list of month
			echo form_open('cen_cont/view_log_detail');
			echo form_label('Hostname', 'hostname');
			echo form_dropdown('hostname', $host_name);
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
</div>