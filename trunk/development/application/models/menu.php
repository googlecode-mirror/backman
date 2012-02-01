<?php
class Menu extends CI_Model{
	
	private $tbl_menu = 'menu';
	private $tbl_relation = 'menu_has_group';
	
	function __construct(){
		parent::__construct();
	}
    
    public function get_menu($group){ //$group is integer
    	$this->db->select('menu_id');
    	$this->db->where('group_id', $group);
    	$menu_id = $this->db->get($this->tbl_relation)->result();
        return $this->get_menu_id($menu_id);
    }
    
    private function get_menu_id($menu_id){ //$menu_id is ObjectArray
    	$this->db->select('title, url');
    	foreach($menu_id as $id) $this->db->where('id', $id->menu_id);
    	return $this->db->get($this->tbl_menu)->result();
    }
}