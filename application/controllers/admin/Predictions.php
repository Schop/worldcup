<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predictions extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('predictions','matches','general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('predictions','matches','general','ion_auth'), $this->config->item('pool_default_language'));
    }

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('predictions_no_access'));
      redirect('admin','refresh');
    }

    $this->load->model('prediction_model', 'prediction');
    $this->load->helper('date');
  }

  public function index()
  {
    $this->data['page_title'] = lang('predictions');
    $this->data['predictions'] = $this->prediction->with('match')
                                                  ->with('user')
                                                  ->get_all();                                        
                                        
    echo "<pre>"; print_r($this->data['predictions']); echo "</pre>";

    //$this->render('admin/matches/list_matches_view');
  }

  public function by_user($user_id = NULL) {
    if(is_null($user_id))
    {
      $this->session->set_flashdata('infomessage','There\'s no user');
      redirect('admin','refresh'); 
    }

    $this->data['page_title'] = lang('predictions');
    $this->data['predictions'] = $this->prediction->with('match')
                                                  ->with('user')
                                                  ->get_many_by('user_id', $user_id);                                        
                                        
    echo "<pre>"; print_r($this->data['predictions']); echo "</pre>";


  }

  public function by_matchtype($matchtype_id) {
  	$this->load->model('matchtype_model', 'matchtype');
  	$matchtype = $this->matchtype->get($matchtype_id);
    $this->data['page_title'] = sprintf(lang('matches_by_type'), $matchtype->matchtype);
    $this->data['matches'] = $this->match->with('venue')
                                         ->with('hometeam')
                                         ->with('awayteam')
                                         ->with('matchtype')
                                         ->get_many_by('matchtype_id', $matchtype_id);                                        
                                        
    //echo "<pre>"; print_r($matchtype); echo "</pre>";

    $this->render('admin/matches/list_matches_view');  	
  }

   public function by_team($team_id) {
	$this->load->model('hometeam_model', 'team');
   	$team = $this->team->get($team_id);
    $this->data['page_title'] = sprintf(lang('matches_by_team'), $team->name);
    $result = $this->match->with('venue')
                                         ->with('hometeam')
                                         ->with('awayteam')
                                         ->with('matchtype')
                                         ->get_all();                                        
    
    // this is probably a bad way of doing this, but fuck it
    foreach ($result as $row) {
    	if($row->hometeam_id == $team_id OR $row->awayteam_id == $team_id) {
    		$matches[] = $row;
    	}
    }
    
	$this->data['matches'] = $matches;
    $this->render('admin/matches/list_matches_view');  	
  }

   public function by_venue($venue_id) {
	$this->load->model('venue_model', 'venue');
   	$venue = $this->venue->get($venue_id);
    $this->data['page_title'] = sprintf(lang('matches_by_venue'), $venue->name);
    $this->data['matches'] = $this->match->with('venue')
                          ->with('hometeam')
                          ->with('awayteam')
                          ->with('matchtype')
                          ->get_many_by('venue_id',$venue_id);                                        

    $this->render('admin/matches/list_matches_view');  	
  }

  public function timestamps()
  {
    $matches = $this->match->with('venue')->get_all();
    
    echo "GMT/UTC: ".unix_to_human(mysql_to_unix($matches[0]->match_time)-(60 * 60 * $matches[0]->venue->time_offset_utc),false,'eu')."<br/>";
    echo "Daar: ".unix_to_human(mysql_to_unix($matches[0]->match_time),false,'eu')."<br/>";
    echo "server: ".unix_to_human(mysql_to_unix($matches[0]->match_time)-(60 * 60 * $matches[0]->venue->time_offset_utc)+(60*60*$this->config->item('server_utc_offset')),false,'eu')."<br/>";

  }

  public function create()
  {
    $this->data['page_title'] = lang('create_match');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('match_number',lang('match_number'),'trim|required|is_natural_no_zero|is_unique[matches.match_number]');
    $this->form_validation->set_rules('hometeam_id',lang('hometeam'),'trim|required|callback__validTeam');
    $this->form_validation->set_rules('awayteam_id',lang('awayteam'),'trim|required|differs[hometeam_id]|callback__validTeam');
    $this->form_validation->set_rules('venue_id',lang('venue'),'trim|required|callback__validVenue');
	$this->form_validation->set_rules('matchtype_id',lang('matchtype'),'trim|required|callback__validMatchtype');
    $this->form_validation->set_rules('match_time',lang('match_time'),'trim|required|callback__timeRegex');
    
    
	$this->load->model('hometeam_model', 'team');
	$this->load->model('venue_model', 'venue');
	$this->load->model('matchtype_model', 'matchtype');
    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $teams = $this->team->get_all();
      $dropdown[0] = "";
      foreach($teams as $team) {
      	$dropdown[$team->id] = $team->name." (".$team->identifier.")";
      }
      $this->data['teams'] = $dropdown;

      unset($dropdown);
      $venues = $this->venue->get_all();
      $dropdown[0] = "";
      foreach($venues as $venue) {
      	if($venue->time_offset_utc>0) {
      		$dropdown[$venue->id] = $venue->name." (UTC +".$venue->time_offset_utc.")";
      	} else {
      		$dropdown[$venue->id] = $venue->name." (UTC ".$venue->time_offset_utc.")";
      	}
      }
      $this->data['venues'] = $dropdown;

      unset($dropdown);
      $matchtypes = $this->matchtype->get_all();
      $dropdown[0] = "";
      foreach($matchtypes as $matchtype) {
      		$dropdown[$matchtype->id] = $matchtype->matchtype;
      }
      $this->data['matchtypes'] = $dropdown;
      $this->data['matches'] = $this->match->with('venue')
                                           ->with('hometeam')
                                           ->with('awayteam')
                                           ->with('matchtype')
                                           ->get_all(); 
      $this->render('admin/matches/create_match_view');
      //echo "<pre>"; print_r($this->data['teams']); echo "</pre>";
    }
    else
    {
      $match_number = $this->input->post('match_number');
      $hometeam_id = $this->input->post('hometeam_id');
      $awayteam_id = $this->input->post('awayteam_id');
      $matchtype_id = $this->input->post('matchtype_id');
      $venue_id = $this->input->post('venue_id');
      $match_time = $this->input->post('match_time');
      //print_r($this->input->post);
      $create = $this->match->insert(array(
      	'match_number' => $match_number,
        'hometeam_id' => $hometeam_id,
      	'awayteam_id' => $awayteam_id,
      	'matchtype_id' => $matchtype_id,
      	'venue_id' => $venue_id,
      	'match_time' => $match_time
      	)
      );
      if ($create != FALSE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('match_created'), $match_number));
      } else {
        $this->session->set_flashdata('errormessage','match not created');
      }

      redirect('admin/matches','refresh');
    }
  }

  public function edit($match_id = NULL)
  {
    $match_id = $this->input->post('match_id') ? $this->input->post('match_id') : $match_id;
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('match_number',lang('match_number'),'trim|required|is_natural_no_zero|callback__unique_match_number');
    $this->form_validation->set_rules('hometeam_id',lang('hometeam'),'trim|required|callback__validTeam');
    $this->form_validation->set_rules('awayteam_id',lang('awayteam'),'trim|required|differs[hometeam_id]|callback__validTeam');
    $this->form_validation->set_rules('venue_id',lang('venue'),'trim|required|callback__validVenue');
	$this->form_validation->set_rules('matchtype_id',lang('matchtype'),'trim|required|callback__validMatchtype');
    $this->form_validation->set_rules('match_time',lang('match_time'),'trim|required|callback__timeRegex');
    
    
	$this->load->model('hometeam_model', 'team');
	$this->load->model('venue_model', 'venue');
	$this->load->model('matchtype_model', 'matchtype');
    if($this->form_validation->run()===FALSE)
    {

      if($match = $this->match->get($match_id))
      {
        $this->data['match'] = $match;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The match doesn\'t exist.');
        redirect('admin/matches', 'refresh');
      }

      $this->load->helper('form');
      $teams = $this->team->get_all();
      $dropdown[0] = "";
      foreach($teams as $team) {
      	$dropdown[$team->id] = $team->name." (".$team->identifier.")";
      }
      $this->data['teams'] = $dropdown;

      unset($dropdown);
      $venues = $this->venue->get_all();
      $dropdown[0] = "";
      foreach($venues as $venue) {
      	if($venue->time_offset_utc>0) {
      		$dropdown[$venue->id] = $venue->name." (UTC +".$venue->time_offset_utc.")";
      	} else {
      		$dropdown[$venue->id] = $venue->name." (UTC ".$venue->time_offset_utc.")";
      	}
      }
      $this->data['venues'] = $dropdown;

      unset($dropdown);
      $matchtypes = $this->matchtype->get_all();
      $dropdown[0] = "";
      foreach($matchtypes as $matchtype) {
      		$dropdown[$matchtype->id] = $matchtype->matchtype;
      }
      $this->data['matchtypes'] = $dropdown;
      $this->data['matches'] = $this->match->with('venue')
                                           ->with('hometeam')
                                           ->with('awayteam')
                                           ->with('matchtype')
                                           ->get_all();
      $this->render('admin/matches/edit_match_view');
    }
    else
    {
      $match_number = $this->input->post('match_number');
      $hometeam_id = $this->input->post('hometeam_id');
      $awayteam_id = $this->input->post('awayteam_id');
      $matchtype_id = $this->input->post('matchtype_id');
      $venue_id = $this->input->post('venue_id');
      $match_time = $this->input->post('match_time');

      $update = $this->match->update($match_id, array('match_number' => $match_number,
       												  'hometeam_id' => $hometeam_id,
       												  'awayteam_id' => $awayteam_id,
       												  'matchtype_id' => $matchtype_id,
       												  'venue_id' => $venue_id,
       												  'match_time' => $match_time
       												  ));
      if ($update == TRUE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('match_saved'), $match_number));
      } else {
        $this->session->set_flashdata('errormessage', lang('error_saving_match'));
      }
      redirect('admin/matches','refresh');
    }
  }

  public function edit_match_result($match_id)
  {
    $match_id = $this->input->post('match_id') ? $this->input->post('match_id') : $match_id;
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('result_home_goals',lang('result_home_goals'),'trim|is_natural');
    $this->form_validation->set_rules('result_away_goals',lang('result_away_goals'),'trim|is_natural');
    
      
  $this->load->model('hometeam_model', 'team');
  $this->load->model('venue_model', 'venue');
  $this->load->model('matchtype_model', 'matchtype');

    if($this->form_validation->run()===FALSE)
    {

      if($match = $this->match->with('hometeam')
                              ->with('awayteam')
                              ->get($match_id))
      {
        $this->data['match'] = $match;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The match doesn\'t exist.');
        redirect('admin/matches', 'refresh');
      }

      $this->load->helper('form');
      $teams = $this->team->get_all();
      $dropdown[0] = "";
      foreach($teams as $team) {
        $dropdown[$team->id] = $team->name." (".$team->identifier.")";
      }
      $this->data['teams'] = $dropdown;

      $this->render('admin/matches/edit_match_result_view');
    }
    else
    {

      $result_home_goals = $this->input->post('result_home_goals');
      if ($this->input->post('result_away_goals') != "") {
        $update_array['result_away_goals'] = $this->input->post('result_away_goals');  
      } else {
        $update_array['result_away_goals'] = NULL;
      }
      if ($this->input->post('result_home_goals') != "") {
        $update_array['result_home_goals'] = $this->input->post('result_home_goals');  
      } else {
        $update_array['result_home_goals'] = NULL;
      }      

      $result_away_goals = $this->input->post('result_away_goals');
      $match = $this->match->with('hometeam')
                           ->with('awayteam')
                           ->get($match_id);
      $update = $this->match->update($match_id, $update_array);

      if ($update == TRUE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('match_saved'), $match->match_number));
      } else {
        $this->session->set_flashdata('errormessage', lang('error_saving_match'));
      }
      //echo "<pre>";print_r($this->input->post()); echo "</pre>";
      redirect('admin/matches','refresh');
    }    
  }

  public function generate_predictions($match_id = NULL)
  {
    $this->load->model('prediction_model', 'prediction');

        $this->prediction->generate_predictions($match_id);

  }


  public function delete($match_id = NULL)
  {
    if(is_null($match_id))
    {
      $this->session->set_flashdata('infomessage','There\'s no match to delete');
    }
    else
    {
      $this->match->delete($match_id);
      $this->session->set_flashdata('infomessage','Match deleted');
    }
    redirect('admin/matches','refresh');
  }

	function _validTeam($team_id) {
		$this->form_validation->set_message('_validTeam', lang('team_not_valid'));
	  
		if ($team_id == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function _validVenue($venue_id) {
		$this->form_validation->set_message('_validVenue', lang('venue_not_valid'));
	  
		if ($venue_id == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function _validMatchtype($matchtype_id) {
		$this->form_validation->set_message('_validMatchtype', lang('matchtype_not_valid'));
	  
		if ($matchtype_id == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function _timeRegex($time) {
	  $this->form_validation->set_message('_timeRegex', lang('time_incorrect_format'));
	  if (preg_match('/^(19|20)\d\d[- \.](0[1-9]|1[012])[- \.](0[1-9]|[12][0-9]|3[01]) (0[0-9]|1[1-9]|2[0-3]):([0-5][0-9]):?([0-5][0-9])?$/', $time ) ) 
	  {
	    return TRUE;
	  } 
	  else 
	  {
	    return FALSE;
	  }
	}

  function _unique_match_number($match_number) {        
      if($this->input->post('match_id'))
          $id = $this->input->post('match_id');
      else
          $id = '';
      $result = $this->match->check_unique_number($id, $match_number);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('_unique_match_number', 'Match Number is already in use.');
          $response = false;
      }
      return $response;
  }

}