<?php $this->load->helper('url'); ?>
<?php $this->load->helper('form'); ?>
	<div id="container">
	<div id="menu">
		<ul>
			<li><a href="<?php echo site_url(); ?> ">Home</a></li>
			<li><a href="http://192.168.0.106/centreon">Back to Centreon</a></li>
			<li><a href="javascript:void(0)" id="exportLink" onclick="exportPdf()">Export to PDF</a></li>
			<!-- hidden form to post title and table to pdf exporter -->
			<?php
				$hidden = array('title' => '','tableHTML' => '');
				$attributes = array('id' => 'exportForm', 'name' => 'exportForm' );
				echo form_open('cen_cont/export_Pdf', $attributes, $hidden);
				echo form_close();
			?>
		</ul>
		<!-- hide export link when there are no table -->
		<script type='text/javascript'>
			if(document.getElementById('hor-minimalist-a')==null)
				document.getElementById('exportLink').style.display="none";
		</script>
		<!-- handle export link -->
		<script type='text/javascript'>
			function exportPdf()
			{
				var title = document.getElementsByTagName('title')[0];
				var tableHTML = document.getElementById('hor-minimalist-a').innerHTML;
				document.exportForm.title.value = title;
				document.exportForm.tableHTML.value = tableHTML;
				document.forms["exportForm"].submit();
			}
		</script>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</body>
</html>