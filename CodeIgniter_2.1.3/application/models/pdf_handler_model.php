<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf_handler_model extends CI_Model {

		function __construct()
		{

		}
		function get_pdf($title,$tableHTML)
		{
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetCreator("TCPDF");
			$pdf->SetAuthor('centreon exporter');
			$pdf->SetTitle($title);
			$pdf->SetSubject('Laporan');
			$pdf->SetKeywords('laporan','centreon');
			//$pdf->SetMargins(4,3,4,false);
			$pdf->SetHeaderMargin(30);
			$pdf->SetTopMargin(20);
			$pdf->setFooterMargin(20);
			$pdf->SetAutoPageBreak(true);
			$pdf->SetAuthor('Centreon Reporter');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->AddPage();
			$pdf->writeHTML($tableHTML, true, false, false, false, '');
			$pdf->Output('centreon-report.pdf', 'I');
		}

}

/* End of file pdf_handler_model.php */
/* Location: ./application/models/pdf_handler_model.php */