<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prediction_model extends MY_Model
{
	public $protected_attributes = array( 'id' );
	public $belongs_to = array( 'match', 'user');
	
	public $before_create = array( 'created_at', 'updated_at' );
  public $before_update = array( 'updated_at' );
  protected $soft_delete = TRUE;
    
    function generate_predictions($match_id = NULL) {
    	// use this only for test purposes !!!!
    	
    	$this->load->model('user_model', 'user');

    	$users = $this->user->get_all();
    	if (is_null($match_id)) {
    		$matches = $this->match->get_all();
    	}

    	foreach($users as $user) {

    		foreach($matches as $match) {

    			$home_goals = mt_rand(0,4);
    			$away_goals = mt_rand(0,4);
    			if ($home_goals > $away_goals) {
    				$pred_result = 1;
    			} elseif ($home_goals < $away_goals) {
    				$pred_result = 2;
    			} else {
    				$pred_result = 3;
    			}

    			$data[] = array('match_id'=>$match->id,
    							'user_id'=>$user->id,
    							'pred_home_goals' => $home_goals,
    							'pred_away_goals' => $away_goals,
    							'pred_result' => $pred_result);
    		}
    		$ids[] = $this->prediction->insert_many($data);
    		unset($data);
    	}
    	print_r($ids);
    }

	function calculate($match_id) {
    $this->load->model('match_model', 'match');
		$predictions = $this->prediction->with('user')
                                    ->get_many_by('match_id',$match_id);
        $match = $this->match->get($match_id);

        if($match->matchtype_id<10) {
        	 
          $points_for_goals = $this->config->item('pool_points_for_goals_group_match');
    			$points_for_result = $this->config->item('pool_points_for_result_group_match');
    			$points_for_bonus = $this->config->item('pool_bonus_points_group_match');
		    } else {
    			$points_for_goals = $this->config->item('pool_points_for_goals_knockout_match');
    			$points_for_result = $this->config->item('pool_points_for_result_knockout_match');
    			$points_for_bonus = $this->config->item('pool_bonus_points_knockout_match');
    		}
        $count=0;
        foreach($predictions as $prediction) {
          
          $bonus = true;
          $total = 0;
          $user_total = $this->get_total_user($prediction->user_id, $match_id);

          if($match->result_home_goals == $prediction->pred_home_goals) {
            $update[$count]['points_for_home_goals'] = $points_for_goals;
            $total += $points_for_goals;
          } else {
            $update[$count]['points_for_home_goals'] = NULL;
            $bonus = false;
          }

          if($match->result_away_goals == $prediction->pred_away_goals) {
            $update[$count]['points_for_away_goals'] = $points_for_goals;
            $total += $points_for_goals;
          } else {
            $update[$count]['points_for_away_goals'] = NULL;
            $bonus = false;
          }

          if($match->result == $prediction->pred_result) {
            $update[$count]['points_for_result'] = $points_for_result;
            $total += $points_for_result;
          } else {
            $update[$count]['points_for_result'] = NULL;
            $bonus = false;
          }

          if ($bonus == true) {
            $update[$count]['points_for_bonus'] = $points_for_bonus;
            $total += $points_for_bonus;
          } else {
            $update[$count]['points_for_bonus'] = NULL;
          }

          $update[$count]['points_total_for_this_match'] = $total; 
          $update[$count]['points_after_this_match'] = $user_total + $total; 
          $update[$count]['id'] = $prediction->id;
          $update[$count]['calculated'] = 1;
          $count++;
        }
		    $rows = $this->db->update_batch('predictions', $update, 'id');
        return $count;                                        
	}

  function get_total_user($user_id, $match_id) {
    $this->db->select_max('points_after_this_match');
    $this->db->where('user_id', $user_id);
    $this->db->where('match_id <', $match_id);
    $query =  $this->db->get('predictions')->row();
    return $query->points_after_this_match;
  }

}