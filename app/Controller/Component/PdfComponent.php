<?php 
// Include the class file and create Html2ps instance
App::import('Vendor', 'fpdfConfig', array('file' => 'fpdf'.DS.'config.inc.php'));
App::import('Vendor', 'fpdf', array('file' => 'fpdf'.DS.'pipeline.factory.class.php'));
parse_config_file(APP .'Vendor'. DS .'fpdf'. DS .'html2ps.config');

class PdfComponent extends Component {
  var $p;                         // The Pdf Class
  var $media;
  var $filename;
  var $output;

  function init($filename, $output) {
      global $g_config;
	  
      $g_config = array(
                'cssmedia'     => 'screen',
                'renderimages' => true,
                'renderforms'  => false,
                'renderlinks'  => true,
                'mode'         => 'html',
                'debugbox'     => false,
                'draw_page_border' => false				
                );
	$this->output = $output;
	$this->filename = $filename;

    $this->media = Media::predefined('A4');
    $this->media->set_landscape(false);
    $this->media->set_margins(array('left'   => 10,
                              'right'  => 10,
                              'top'    => 20,
                              'bottom' => 20));
    $this->media->set_pixels(1024);
    global $g_px_scale;
    $g_px_scale = mm2pt($this->media->width() - $this->media->margins['left'] - $this->media->margins['right']) / $this->media->pixels;
    global $g_pt_scale;
    $g_pt_scale = $g_pt_scale * 1.43;
    $this->p = PipelineFactory::create_default_pipeline("","");
	
    switch ($this->output) {
      case 'download': 
      $this->p->destination = new DestinationDownload($this->filename);
      break;
      case 'file': 
      $this->p->destination = new DestinationFile($this->filename);
      break;
      default:
      $this->p->destination = new DestinationBrowser($this->filename);
      break;
    }
    
  }

  function process($url) {
	$this->p->output = 'download';
    $this->p->process($url, $this->media);
  }
  
   
}
?>