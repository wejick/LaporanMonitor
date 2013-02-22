<?php $this->load->helper('url'); ?>
<div id="container">
	<h1>Sistem pembuatan laporan centreon!</h1>

	<div id="body">
		<p>Apa yang anda butuhkan saat ini ?.</p>

		<ol>
			<li><a href=" <?php echo site_url("cen_cont/view_host")?>" >Daftar Host.</a></li>
			<li><a href=" <?php echo site_url("cen_cont/view_log")?>">Laporan Host Bulan ini.</a></li>
			<li><a href=" <?php echo site_url("cen_cont/view_log_detail")?>">Detail laporan host.</a></li>
		</ol>
	</div>
</div>