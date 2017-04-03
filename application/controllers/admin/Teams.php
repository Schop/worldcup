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
    $this->form_validation->set_rules('team_name',lang('team_name'),'trim|required|alpha_numeric|is_unique[teams.name]');
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
      print_r($this->input->post);
      $create = $this->team->insert(array(
      	'name' => $team_name,
      	'identifier' => $team_identifier,
      	'flag' => $team_flag
      	)
      );
      if ($create != FALSE) {
        $this->session->set_flashdata('successmessage','team created');
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
    $this->form_validation->set_rules('team_name',lang('group_name'),'trim|required|alpha_numeric');
    $this->form_validation->set_rules('team_identifier',lang('team_identifier'),'trim|required|exact_length[2]');
    $this->form_validation->set_rules('team_flag',lang('team_flag'),'trim|required|exact_length[2]');
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
      $this->data['page_title'] = 'Edit team \''.$team->name.'\'';
      $this->load->helper('form');
      $this->render('admin/teams/edit_team_view');
    }
    else
    {
      $team_name = $this->input->post('team_name');
      $team_identifier = $this->input->post('team_identifier');
      $team_flag = $this->input->post('team_flag');
      $group_id = $this->input->post('group_id');
      $update = $this->team->update($team_id, array('name' => $team_name, 'identifier' => $team_identifier, 'flag' => $team_flag));
      if ($update == TRUE) {
        $this->session->set_flashdata('successmessage','Team saved');
      } else {
        $this->session->set_flashdata('errormessage',"Error saving team");
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
  
}