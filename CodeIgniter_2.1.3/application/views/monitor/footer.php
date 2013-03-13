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
			if(document.getElementsByClassName('hor-minimalist-a')[0]==null)
				document.getElementById('exportLink').style.display="none";
		</script>
		<!-- handle export link -->
		<script type='text/javascript'>
			function exportPdf()
			{
				var title = document.title;
				var desc = document.getElementById('Description').innerHTML;
				var tableHTML = '<style type="text/css">.dsc{margin:5px 0; font-family: "Verdana", "Geneva", "sans-serif";font-size:10pt;}.title{margin:5px 0; font-family: "Verdana", "Geneva", "sans-serif";font-size:14pt;}.hor-minimalist-a{font-family:"Lucida Sans Unicode","Lucida Grande",Sans-Serif;font-size:10pt;background:#fff;margin:20px;width:500px;border-collapse:collapse;text-align:left;}.hor-minimalist-a th{font-size:10pt;font-weight:normal;color:#039;padding:10px 8px;border-bottom:1px solid blue;}.hor-minimalist-a td{font-size:9pt;color:#669;border-bottom:1px solid black;}</style>';
				tableHTML = tableHTML+'<div class="Title">'+title+'<br /></div>'+'<p class="dsc">'+desc+'</p>';
				tableHTML = tableHTML + outerHTML(document.getElementById('hor-minimalist-a'));
				document.exportForm.title.value = title;
				document.exportForm.tableHTML.value = tableHTML;
				document.forms["exportForm"].submit();
			}
			function outerHTML(node)
			{
    			// if IE, Chrome take the internal method otherwise build one
				return node.outerHTML || (
     			function(n){
          			var div = document.createElement('div'), h;
          			div.appendChild( n.cloneNode(true) );
					h = div.innerHTML;
        			div = null;
         			return h;
      			})(node);
			}
		</script>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</body>
</html>