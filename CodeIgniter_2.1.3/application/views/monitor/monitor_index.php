<?php $this->load->helper('url'); ?>
<div id="container">
	<h1>Sistem pembuatan laporan centreon!</h1>

	<div id="body">
		<p>Apa yang anda butuhkan saat ini ?.</p>

		<ol>
			<li><a href=" <?php echo site_url("cen_cont/view_host")?>" >Daftar Host</a></li>
			<li><a href="#">Laporan Downtime Host Bulan ini</a></li>
			<li><a href="#">Detail laporan host</a></li>
		</ol>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>