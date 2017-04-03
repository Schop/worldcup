<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venues extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('venues','general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('venues','general','ion_auth'), $this->config->item('pool_default_language'));
    }

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('venues_no_access'));
      redirect('admin','refresh');
    }

    $this->load->model('venue_model', 'venue');
  }

  public function index()
  {
    $this->data['page_title'] = lang('venues');
    $this->data['venues'] = $this->venue->get_all();
    $this->render('admin/venues/list_venues_view');
  }

  public function create()
  {
    $this->data['page_title'] = lang('create_venue');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('venue_name',lang('venue_name'),'trim|required|min_length[3]|is_unique[venues.name]');
    $this->form_validation->set_rules('venue_location',lang('venue_location'),'trim|required');
    $this->form_validation->set_rules('venue_time_offset_utc',lang('venue_time_offset_utc'),'trim|required|integer');
   
    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->data['venues'] = $this->venue->get_all();
      $this->render('admin/venues/create_venue_view');
    }
    else
    {
      $venue_name = $this->input->post('venue_name');
      $venue_location = $this->input->post('venue_location');
      $venue_time_offset_utc = $this->input->post('venue_time_offset_utc');
      //print_r($this->input->post);
      $create = $this->venue->insert(array(
      	'name' => $venue_name,
        'location' => $venue_location,
      	'time_offset_utc' => $venue_time_offset_utc,
      	)
      );
      if ($create != FALSE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('venue_created'), $venue_name));
      } else {
        $this->session->set_flashdata('errormessage','Venue not created');
      }

      redirect('admin/venues','refresh');
    }
  }

  public function edit($venue_id = NULL)
  {
    $venue_id = $this->input->post('venue_id') ? $this->input->post('venue_id') : $venue_id;
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('venue_name',lang('venue_name'),'trim|required|min_length[3]|callback_check_venue_name');
    $this->form_validation->set_rules('venue_location',lang('venue_location'),'trim|required');
    $this->form_validation->set_rules('venue_time_offset_utc',lang('venue_time_offset_utc'),'trim|required|integer');

    if($this->form_validation->run() === FALSE)
    {
      if($venue = $this->venue->get($venue_id))
      {
        $this->data['venue'] = $venue;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The venue doesn\'t exist.');
        redirect('admin/venues', 'refresh');
      }
      $this->data['venues'] = $this->venue->get_all();
      $this->data['page_title'] = sprintf(lang('edit_venue'),$venue->name);
      $this->load->helper('form');
      $this->render('admin/venues/edit_venue_view');
    }
    else
    {
      $venue_name = $this->input->post('venue_name');
      $venue_location = $this->input->post('venue_location');
      $venue_time_offset_utc = $this->input->post('venue_time_offset_utc');

      $update = $this->venue->update($venue_id, array('name' => $venue_name, 'location' => $venue_location, 'time_offset_utc' => $venue_time_offset_utc));
      if ($update == TRUE) {
        $this->session->set_flashdata('successmessage', sprintf(lang('venue_saved'), $venue_name));
      } else {
        $this->session->set_flashdata('errormessage', lang('error_saving_venue'));
      }
      redirect('admin/venues','refresh');
    }
  }

  public function delete($venue_id = NULL)
  {
    if(is_null($venue_id))
    {
      $this->session->set_flashdata('infomessage','There\'s no venue to delete');
    }
    else
    {
      $this->venue->delete($venue_id);
      $this->session->set_flashdata('infomessage','Venue deleted');
    }
    redirect('admin/venues','refresh');
  }

  function check_venue_name($venue_name) {        
      if($this->input->post('venue_id'))
          $id = $this->input->post('venue_id');
      else
          $id = '';
      $result = $this->venue->check_unique_name($id, $venue_name);
      if($result == 0)
          $response = true;
      else {

          $this->form_validation->set_message('check_venue_name', 'Venue Name is already used by a different venue.');
          $response = false;
      }
      return $response;
  }
}