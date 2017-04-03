<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venue_model extends MY_Model
{
	public $_table = 'venues';
	public $protected_attributes = array( 'id' );

    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );

	function check_unique_name($id = '', $venue_name) {
	        $this->db->where('name', $venue_name);
	        if($id) {
	            $this->db->where_not_in('id', $id);
	        }
	        return $this->db->get('venues')->num_rows();
	}

}