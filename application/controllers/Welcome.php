<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
  public function index()
  {
    $this->load->library(['parser']);
	$this->load->helper('url');
    $this->load->model('Mp3Db');
	$this->parser->parse('home',[
	  'app_url' => base_url(),
      'last_search' => $this->Mp3Db->get_lastsearch(),
      'popular_search' => $this->Mp3Db->get_popularsearch(),
      'top_chart' => Welcome::get_popular(),
		]);
  }

  public function get_popular()
  {
    $array = array();
    $this->load->model('SoundcloudApi');
    $data = $this->SoundcloudApi->get_popular();
    for($i=0;$i<20;$i++)
    {
      $title = $data['channel']['item'][$i]['title'];
      $title = explode(':', $title);
      $title = $title[1];
      $artis = $data['channel']['item'][$i]['artist'];
      $array[] .= $artis.' -'.$title;
    }
    return $array;
  }
}
