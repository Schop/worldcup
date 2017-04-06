<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hometeam_model extends MY_Model
{
	public $protected_attributes = array( 'id' );

    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    
    // Copy the teams table after it has changed, for away teams
    public $after_update = array('copy_table');
	public $after_create = array('copy_table');
	public $after_delete = array('copy_table');


	function check_unique_name($id = '', $team_name) {
	        $this->db->where('name', $team_name);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('hometeams')->num_rows();
	}
	
	function check_unique_flag($id = '', $team_flag) {
	        $this->db->where('flag', $team_flag);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('hometeams')->num_rows();
	}	    

	function check_unique_identifier($id = '', $team_identifier) {
	        $this->db->where('identifier', $team_identifier);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('hometeams')->num_rows();
	}	

	function check_unique_shortname($id = '', $team_shortname) {
	        $this->db->where('identifier', $team_shortname);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('hometeams')->num_rows();
	}

	function copy_table($row) {
		$this->db->query("DROP TABLE IF EXISTS awayteams");
		$this->db->query("CREATE TABLE awayteams LIKE hometeams"); 
		$this->db->query("INSERT awayteams SELECT * FROM hometeams");
	}

}