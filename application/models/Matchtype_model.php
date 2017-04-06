<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matchtype_model extends MY_Model
{
	public $protected_attributes = array( 'id' );
	public $has_many = array( 'matches' );
	public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );
    protected $soft_delete = TRUE;
}