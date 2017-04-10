<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match_model extends MY_Model
{
	public $protected_attributes = array( 'id' );
	public $belongs_to = array( 'venue', 'hometeam', 'awayteam', 'matchtype' );
	public $has_many = array('predictions');
	public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    protected $soft_delete = TRUE;

	
	function check_unique_number($id = '', $match_number) {
        $this->db->where('match_number', $match_number);
        if($id) {
            $this->db->where_not_in('id', $id);
        }
        return $this->db->get('matches')->num_rows();
	}

}