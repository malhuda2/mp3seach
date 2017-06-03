<?php


Class Mp3Db Extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insert_lastsearch($data)
	{
		$sql = $this->db->select('query')
							->from('last_search')
							->where('date',date('Y-m-d'))
							->where('query',$data['query'])
							->get();
		if($sql->num_rows() !== 1)
		{
			$this->db->insert('last_search',$data);
		}

	}

	public function get_lastsearch()
	{
		$sql = $this->db->select('query')
					->from('last_search')
					->order_by('id','DESC')
					->limit(15)
					->get();
		return $sql->result_array();
	}

	public function get_popularsearch()
	{
		$sql = $this->db->query('SELECT query, count(*) FROM last_search GROUP BY query ORDER BY count(*) DESC LIMIT 10');
		return $sql->result_array();
	}
	public function insert_sitemap($data)
	{
		$sql = $this->db->select('*')
						->from('sitemap')
						->where('url',$data['url'])
						->get();
		if($sql->num_rows() !== 1)
		{
			$this->db->insert('sitemap',$data);
		}
	}

	public function get_sitemap()
	{
		$row = $this->db->select('*')
					->from('sitemap')
					->order_by('id','DESC')
					->get();
		return $row->result_array();
	}



}