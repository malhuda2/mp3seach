<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
/**
 * Example use of the CodeIgniter Sitemap Generator Model
 * 
 * @author Gerard Nijboer <me@gerardnijboer.com>
 * @version 1.0
 * @access public
 *
 */
class Sitemap extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// We load the url helper to be able to use the base_url() function
		$this->load->helper('url');
		
		$this->load->model('SitemapModel');
		$this->load->model('Mp3Db');
		$this->data = $this->Mp3Db->get_sitemap();



	}
	
	/**
	 * Generate a sitemap index file
	 * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
	 */
	public function index() {
		foreach ($this->data as $key => $value) {
		$this->SitemapModel->add(htmlspecialchars($value['url']), date('Y-m-d', time()));
		}
		$this->SitemapModel->output('sitemapindex');
	}
	
	/**
	 * Generate a sitemap both based on static urls and an array of urls
	 */
	
	
}