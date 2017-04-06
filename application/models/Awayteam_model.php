<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Awayteam_model extends MY_Model
{
	public $protected_attributes = array( 'id' );

    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    

	function check_unique_name($id = '', $team_name) {
	        $this->db->where('name', $team_name);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('awayteams')->num_rows();
	}
	
	function check_unique_flag($id = '', $team_flag) {
	        $this->db->where('flag', $team_flag);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('awayteams')->num_rows();
	}	    

	function check_unique_identifier($id = '', $team_identifier) {
	        $this->db->where('identifier', $team_identifier);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('awayteams')->num_rows();
	}	

	function check_unique_shortname($id = '', $team_shortname) {
	        $this->db->where('identifier', $team_shortname);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('awayteams')->num_rows();
	}


}