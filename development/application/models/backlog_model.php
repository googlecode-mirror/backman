<?php
class Backlog_model extends CI_Model{
	
	private $tbl_backlog  = 'product_backlog';
	private $tbl_sbacklog = 'sprint_backlog';
	private $tbl_slice    = 'slice';
	
	function __construct(){
		parent::__construct();
	}
    
    public function get_projects(){
    	$this->db->select('id, project_name');
        return $this->db->get($this->tbl_backlog)->result();
    }
    
    public function get_backlog($project){
    	$this->db->where('id',$project);
    	return $this->db->get($this->tbl_backlog,1)->result();
    }
    
    public function get_sprint_backlogs($backlog){
    	$this->db->where('product_backlog_id',$backlog);
    	return $this->db->get($this->tbl_sbacklog)->result();
    }
    
    public function get_slices($backlog){
    	$this->db->where('product_backlog_id',$backlog);
    	return $this->db->get($this->tbl_slice)->result();
    }
    
    public function insert_backlog($data){
    	if($this->db->insert($this->tbl_backlog,$data)) return true;
    	else return false;
    }
    
    public function insert_sbacklog($data){
    	if($this->db->insert($this->tbl_sbacklog,$data)) return true;
    	else return false;
    }
    
    public function insert_slice($data){
    	if($this->db->insert($this->tbl_slice,$data)) return true;
    	else return false;
    }
}