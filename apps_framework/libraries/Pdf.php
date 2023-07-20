<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Ardianta Pargo
 * @license			MIT License
 * @link			https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Dompdf;
use Dompdf\Options;
class Pdf extends Dompdf{

	/**
	 * PDF filename
	 * @var String
	 */
	public $filename;

	public function __construct(){
		parent::__construct();
		$this->filename = "profile.pdf";
	}

	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array()){
		$INDCNX_ROOT = dirname(__DIR__, 2);
		$html = $this->ci()->load->view($view, $data, TRUE);
		$options = new Options();
        $options->set('defaultPaperSize', 'A4');
        $options->set('defaultPaperOrientation', 'potrait');
		$options->set('isRemoteEnabled', false);
		$options->set('IsHtml5ParserEnabled', true);
		$photoLoc = '';
		if(!empty($data['users_profile'])) {
			if(!empty($data['users_profile']->file_path))
			$photoLoc = $INDCNX_ROOT.'/'.$data['users_profile']->file_path;
		} else if (!empty($data['business'])) {
			if(!empty($data['business']->file_path))
			$photoLoc = $INDCNX_ROOT.'/'.$data['business']->file_path;
		}
		$options->set('chroot', [
			$INDCNX_ROOT.'\public\themes\user\images\placehold',
			$photoLoc
		]);

		$dompdf = new Dompdf($options);
		$contxt = stream_context_create([
			'ssl' => [
				'verify_peer' => FALSE,
				'verify_peer_name' => FALSE,
				'allow_self_signed'=> TRUE
			]
		]);

		$dompdf->load_html($html);

		// Render the PDF
		$dompdf->render();

		$dompdf->setHttpContext($contxt);
        // Output the generated PDF to Browser
        $dompdf->stream($this->filename, array("Attachment" => false));
	}
}