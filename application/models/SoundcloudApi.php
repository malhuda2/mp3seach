<?php
ini_set('allow_url_fopen',1);
Class SoundcloudApi Extends CI_Model
{
  protected $client_id = '2t9loNQH90kzJcsFCODdigxfp325aq4z';

  public function search($query)
  {
    $fetch = SoundcloudApi::cache_url("https://api.soundcloud.com/tracks?client_id={$this->client_id}&q=".urlencode($query)."&limit=100&order=hotness");
    return json_decode($fetch);
  }

  public static function cache_url($url, $skip_cache = FALSE) {
	// settings
	$cachetime = 604800; //one week
	$where = "cache";
	if ( ! is_dir($where)) {
		mkdir($where);
	}

	$hash = md5($url);
	$file = "$where/$hash.cache";

	// check the bloody file.
	$mtime = 0;
	if (file_exists($file)) {
		$mtime = filemtime($file);
	}
	$filetimemod = $mtime + $cachetime;

	// if the renewal date is smaller than now, return true; else false (no need for update)
	if ($filetimemod < time() OR $skip_cache) {
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_HEADER         => FALSE,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_USERAGENT      => 'Googlebot/2.1 (+http://www.google.com/bot.html)',
			CURLOPT_FOLLOWLOCATION => TRUE,
			CURLOPT_MAXREDIRS      => 5,
			CURLOPT_CONNECTTIMEOUT => 15,
			CURLOPT_TIMEOUT        => 30,
		));
		$data = curl_exec($ch);
		curl_close($ch);

		// save the file if there's data
		if ($data AND ! $skip_cache) {
			file_put_contents($file, $data);
		}
	} else {
		$data = file_get_contents($file);
	}

	return $data;
}
public function download($id)
{
    $this->load->helper('download');
	$name = SoundcloudApi::song_detail($id);
	$name = $name->title;
  	$url = "https://api.soundcloud.com/tracks/{$id}/stream?client_id={$this->client_id}";
    $data =  SoundcloudApi::xaccess($url); 
    $decode = json_decode($data);
    $data = SoundcloudApi::xaccess($decode->location);
    force_download($name,$data); 
}

public function stream($id)
{
    $url = "https://api.soundcloud.com/tracks/{$id}/stream?client_id={$this->client_id}";
    $data =  SoundcloudApi::xaccess($url); 
    $decode = json_decode($data);
    return $decode;
}

private static function xaccess($url)
{  
$ch = curl_init($url);            
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                            
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$body = curl_exec($ch);
return $body;
}


public function song_detail($id)
{
  $api_url = "https://api.soundcloud.com/tracks/{$id}?client_id={$this->client_id}";
  $data = SoundcloudApi::cache_url($api_url);
  return json_decode($data);
}

public function related_song($id)
{
  $api_url = "https://api.soundcloud.com/tracks/{$id}/related?client_id={$this->client_id}&limit=5";
  $data = SoundcloudApi::cache_url($api_url);
  return json_decode($data);
}

public function get_popular()
{
	$xml_string = SoundcloudApi::cache_url("http://www.billboard.com/rss/charts/hot-100");
	$xml = simplexml_load_string($xml_string);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
	return $array;
}

public function get_comment($id)
{
	$api = SoundcloudApi::cache_url("https://api.soundcloud.com/tracks/{$id}/comments?client_id={$this->client_id}&limit=10");
	return json_decode($api);
}



}
