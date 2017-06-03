<?php

Class Music Extends CI_Controller
{

  public function index()
  {
    $this->load->library(['parser']);
		$this->load->helper('url');
    $this->load->model('Mp3Db');
		$this->parser->parse('home',[
			'app_url' => base_url(),
      'last_search' => $this->Mp3Db->get_lastsearch(),
      'popular_search' => $this->Mp3Db->get_popularsearch(),
      'top_chart' => Music::get_popular(),
      'app_name' => '',
		]);
  }

  private static function current_full_url()
  {
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
  }

  public function search()
  {
    $this->load->library(['parser']);
		$this->load->helper('url');
    $this->load->model('SoundcloudApi');
    $data = $this->SoundcloudApi->search($this->input->get('query'));
		$this->parser->parse('search',[
			'app_url' => base_url(),
      'query' => $this->input->get('query',true),
      'data' => $data,
      'url_now' => Music::current_full_url(),
      'app_name' => '',
		]);
    $this->load->model('Mp3Db');
    $this->Mp3Db->insert_lastsearch([
      'query' => $this->input->get('query',true),
      'date' => date('Y-m-d'),
      ]);
    $this->Mp3Db->insert_sitemap([
      'url' => Music::current_full_url(),
      'date' => date('Y-m-d'),
      'type' => 'search',
      ]);
  }
/*
  public function dl()
  {
    $this->load->helper('url');
    $id = $this->input->get('id',true);
    if($id == "")
    {
      redirect('/');
      exit;
    }elseif($this->input->get('mp3') !== $this->security->get_csrf_hash())
    {
      exit;
    }
    $this->load->model('SoundcloudApi');
    $this->SoundcloudApi->download($id);
  }
*/
  public function show($id,$title=null)
  {
    error_reporting(0);
    $this->load->helper('url');
    if($id == "")
    {
      redirect('/music');
      exit;
    }

    $this->load->library(['parser']);
    $this->load->helper('url');
    $this->load->model('SoundcloudApi');
    $data = $this->SoundcloudApi->song_detail($id);
    $this->parser->parse('view',[
      	'app_url' => base_url(),
        'data' => $data,
        'id' => $id,
        'comment' => $this->SoundcloudApi->get_comment($id),
        'related' => $this->SoundcloudApi->related_song($id),
        'stream' => $this->SoundcloudApi->stream($id),
        'url_now' => Music::current_full_url(),
        'app_name' => '',
    ]);
      $this->load->model('Mp3Db');
      $this->Mp3Db->insert_sitemap([
      'url' => Music::current_full_url(),
      'date' => date('Y-m-d'),
      'type' => 'download',
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


public function clear_cache()
{
    foreach(glob("cache/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir("cache/");
}


}
