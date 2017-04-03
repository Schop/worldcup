<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('groups','general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('groups','general','ion_auth'), $this->config->item('pool_default_language'));
    }

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('groups_no_access'));
      redirect('admin','refresh');
    }
  }

  public function index()
  {
    $this->data['page_title'] = lang('groups');
    $this->data['groups'] = $this->ion_auth->groups()->result();
    $this->render('admin/groups/list_groups_view');
  }

  public function create()
  {
    $this->data['page_title'] = lang('create_group');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('group_name',lang('group_name'),'trim|required|alpha_numeric|is_unique[groups.name]');
    $this->form_validation->set_rules('group_description',lang('group_description'),'trim|required');
   
    if($this->form_validation->run()===FALSE)
    {
      $this->load->helper('form');
      $this->data['groups'] = $this->ion_auth->groups()->result();
      $this->render('admin/groups/create_group_view');
    }
    else
    {
      $group_name = $this->input->post('group_name');
      $group_description = $this->input->post('group_description');
      $create_group = $this->ion_auth->create_group($group_name, $group_description);
      if ($create_group != FALSE) {
        $this->session->set_flashdata('successmessage',$this->ion_auth->messages());
      } else {
        $this->session->set_flashdata('errormessage',$this->ion_auth->messages());
      }

      redirect('admin/groups','refresh');
    }
  }

  public function edit($group_id = NULL)
  {
    $group_id = $this->input->post('group_id') ? $this->input->post('group_id') : $group_id;
    
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('group_name',lang('group_name'),'trim|required|alpha_numeric');
    $this->form_validation->set_rules('group_description',lang('group_description'),'trim|required');
    $this->form_validation->set_rules('group_id',lang('ID'),'trim|integer|required');

    if($this->form_validation->run() === FALSE)
    {
      if($group = $this->ion_auth->group((int) $group_id)->row())
      {
        $this->data['group'] = $group;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The group doesn\'t exist.');
        redirect('admin/groups', 'refresh');
      }
      $this->data['groups'] = $this->ion_auth->groups()->result();
      $this->data['page_title'] = 'Edit group \''.$group->name.'\'';
      $this->load->helper('form');
      $this->render('admin/groups/edit_group_view');
    }
    else
    {
      $group_name = $this->input->post('group_name');
      $group_description = $this->input->post('group_description');
      $group_id = $this->input->post('group_id');
      $update_group = $this->ion_auth->update_group($group_id, $group_name, $group_description);
      if ($update_group == TRUE) {
        $this->session->set_flashdata('successmessage',$this->ion_auth->messages());
      } else {
        $this->session->set_flashdata('errormessage',$this->ion_auth->messages());
      }
      redirect('admin/groups','refresh');
    }
  }

  public function delete($group_id = NULL)
  {
    if(is_null($group_id))
    {
      $this->session->set_flashdata('infomessage','There\'s no group to delete');
    }
    else
    {
      $this->ion_auth->delete_group($group_id);
      $this->session->set_flashdata('infomessage',$this->ion_auth->messages());
    }
    redirect('admin/groups','refresh');
  }
  
}