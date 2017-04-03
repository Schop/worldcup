<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('teams','general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('teams','general','ion_auth'), $this->config->item('pool_default_language'));
    }

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('teams_no_access'));
      redirect('admin','refresh');
    }

    $this->load->model('team_model', 'team');
  }

  public function index()
  {
    $this->data['page_title'] = lang('teams');
    $this->data['teams'] = $this->team->get_all();
    $this->render('admin/teams/list_teams_view');
  }

  public function create()
  {
    $this->data['page_title'] = lang('create_team');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('team_name',lang('team_name'),'trim|required|min_length[3]|is_unique[teams.name]');
    $this->form_validation->set_rules('team_identifier',lang('team_identifier'),'trim|required|alpha_numeric|is_unique[teams.identifier]|exact_length[2]');
    $this->form_validation->set_rules('team_flag',lang('team_flag'),'trim|required|alpha_numeric|is_unique[teams.flag]|exact_length[2]');
   
    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->data['teams'] = $this->team->get_all();
      $this->render('admin/teams/create_team_view');
    }
    else
    {
      $team_name = $this->input->post('team_name');
      $team_identifier = $this->input->post('team_identifier');
      $team_flag = $this->input->post('team_flag');
      //print_r($this->input->post);
      $create = $this->team->insert(array(
      	'name' => $team_name,
        'shortname' => $team_shortname,
      	'identifier' => $team_identifier,
      	'flag' => $team_flag
      	)
      );
      if ($create != FALSE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('team_created'), $team_name));
      } else {
        $this->session->set_flashdata('errormessage','team not created');
      }

      redirect('admin/teams','refresh');
    }
  }

  public function edit($team_id = NULL)
  {
    $team_id = $this->input->post('team_id') ? $this->input->post('team_id') : $team_id;
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('team_name',lang('group_name'),'trim|required|min_length[3]|callback_check_team_name');
    $this->form_validation->set_rules('team_identifier',lang('team_identifier'),'trim|required|exact_length[2]|callback_check_team_identifier');
    $this->form_validation->set_rules('team_shortname',lang('team_shortname'),'trim|required|max_length[5]|callback_check_team_shortname');
    $this->form_validation->set_rules('team_flag',lang('team_flag'),'trim|required|exact_length[2]|callback_check_team_flag');
    $this->form_validation->set_rules('team_id',lang('ID'),'trim|integer|required');

    if($this->form_validation->run() === FALSE)
    {
      if($team = $this->team->get($team_id))
      {
        $this->data['team'] = $team;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The team doesn\'t exist.');
        redirect('admin/teams', 'refresh');
      }
      $this->data['teams'] = $this->team->get_all();
      $this->data['page_title'] = sprintf(lang('edit_team'),$team->name);
      $this->load->helper('form');
      $this->render('admin/teams/edit_team_view');
    }
    else
    {
      $team_name = $this->input->post('team_name');
      $team_shortname = $this->input->post('team_shortname');
      $team_identifier = $this->input->post('team_identifier');
      $team_flag = $this->input->post('team_flag');
      $group_id = $this->input->post('group_id');
      $update = $this->team->update($team_id, array('name' => $team_name, 'shortname' => $team_shortname, 'identifier' => $team_identifier, 'flag' => $team_flag));
      if ($update == TRUE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('team_saved'), $team_name));
      } else {
        $this->session->set_flashdata('errormessage', lang('error_saving_team'));
      }
      redirect('admin/teams','refresh');
    }
  }

  public function delete($team_id = NULL)
  {
    if(is_null($team_id))
    {
      $this->session->set_flashdata('infomessage','There\'s no team to delete');
    }
    else
    {
      $this->team->delete($team_id);
      $this->session->set_flashdata('infomessage','Team deleted');
    }
    redirect('admin/teams','refresh');
  }

  function check_team_name($team_name) {        
      if($this->input->post('team_id'))
          $id = $this->input->post('team_id');
      else
          $id = '';
      $result = $this->team->check_unique_name($id, $team_name);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('check_team_name', 'Team Name is already used by a different team.');
          $response = false;
      }
      return $response;
  }

  function check_team_flag($team_flag) {        
      if($this->input->post('team_id'))
          $id = $this->input->post('team_id');
      else
          $id = '';
      $result = $this->team->check_unique_flag($id, $team_flag);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('check_team_flag', 'That flag is already used by a different team');
          $response = false;
      }
      return $response;
  }

  function check_team_identifier($team_identifier) {        
      if($this->input->post('team_id'))
          $id = $this->input->post('team_id');
      else
          $id = '';
      $result = $this->team->check_unique_identifier($id, $team_identifier);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('check_team_identifier', 'That identifier is already used by a different team');
          $response = false;
      }
      return $response;
  }

  function check_team_shortname($team_shortname) {        
      if($this->input->post('team_id'))
          $id = $this->input->post('team_id');
      else
          $id = '';
      $result = $this->team->check_unique_shortname($id, $team_shortname);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('check_team_shortname', 'That shortname is already used by a different team');
          $response = false;
      }
      return $response;
  } 
}