<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('users','general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('users','general','ion_auth'), $this->config->item('pool_default_language'));
    }

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('users_no_access'));
      redirect('admin','refresh');
    }

  }

  public function index($group_id = NULL)
  {
    
    if($group_id) {
      $group = $this->ion_auth->group($group_id)->row();
      $this->data['page_title'] = sprintf(lang('users_in_group'),$group->name);
    } else {
      $this->data['page_title'] = lang('all_users');
    }
    $this->data['users'] = $this->ion_auth->users($group_id)->result();
    $this->data['groups'] = $this->ion_auth->groups()->result();
    $this->data['group_id'] = $group_id;
    $this->render('admin/users/list_users_view');
  }

  public function create()
  {
    $this->data['page_title'] = lang('create_user');
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_error_delimiters('', '');
    $this->form_validation->set_rules('first_name',lang('first_name'),'trim');
    $this->form_validation->set_rules('last_name',lang('last_name'),'trim');
    $this->form_validation->set_rules('username',lang('username'),'trim|required|is_unique[users.username]');
    $this->form_validation->set_rules('email',lang('email'),'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password',lang('password'),'required');
    $this->form_validation->set_rules('password_confirm',lang('password_confirmation'),'required|matches[password]');
    $this->form_validation->set_rules('groups[]',lang('groups'),'required|integer');

    if($this->form_validation->run()===FALSE)
    {
      $this->data['groups'] = $this->ion_auth->groups()->result();
      $this->data['users'] = $this->ion_auth->users()->result();
      $this->data['validation_errors'] = validation_errors();
      $this->load->helper('form');
      $this->render('admin/users/create_user_view');
    }
    else
    {
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $group_ids = $this->input->post('groups');

      $additional_data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'company' => $this->input->post('company'),
        'phone' => $this->input->post('phone')
      );
      $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
      $this->session->set_flashdata('infomessage',$this->ion_auth->messages());
      redirect('admin/users','refresh');
    }
  }

  public function edit($user_id = NULL)
  {
    $user_id = $this->input->post('user_id') ? $this->input->post('user_id') : $user_id;
    $this->data['page_title'] = lang('edit_user');
    $this->load->library('form_validation');
    $this->lang->load(array('form_validation'), $this->session->userdata('site_lang'));
    $this->form_validation->set_rules('first_name',lang('first_name'),'trim');
    $this->form_validation->set_rules('last_name',lang('last_name'),'trim');
    $this->form_validation->set_rules('username',lang('username'),'trim|required');
    $this->form_validation->set_rules('email',lang('email'),'trim|required|valid_email');
    $this->form_validation->set_rules('password',lang('password'),'min_length[6]');
    $this->form_validation->set_rules('password_confirm',lang('password_confirm'),'matches[password]');
    $this->form_validation->set_rules('groups[]',lang('groups'),'required|integer');
    $this->form_validation->set_rules('user_id',lang('ID'),'trim|integer|required');

    if($this->form_validation->run() === FALSE)
    {
      if($user = $this->ion_auth->user((int) $user_id)->row())
      {
        $this->data['user'] = $user;
      }
      else
      {
        $this->session->set_flashdata('errormessage', 'The user doesn\'t exist.');
        redirect('admin/users', 'refresh');
      }
      $this->data['users'] = $this->ion_auth->users()->result();
      $this->data['groups'] = $this->ion_auth->groups()->result();
      $this->data['usergroups'] = array();
      if($usergroups = $this->ion_auth->get_users_groups($user->id)->result())
      {
        foreach($usergroups as $group)
        {
          $this->data['usergroups'][] = $group->id;
        }
      }
      $this->load->helper('form');
      $this->render('admin/users/edit_user_view');
    }
    else
    {
      $user_id = $this->input->post('user_id');
      $new_data = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'company' => $this->input->post('company'),
        'phone' => $this->input->post('phone')
      );
      if(strlen($this->input->post('password'))>=6) $new_data['password'] = $this->input->post('password');

      $this->ion_auth->update($user_id, $new_data);

      //Update the groups user belongs to
      $groups = $this->input->post('groups');
      if (isset($groups) && !empty($groups))
      {
        $this->ion_auth->remove_from_group('', $user_id);
        foreach ($groups as $group)
        {
          $this->ion_auth->add_to_group($group, $user_id);
        }
      }

      $this->session->set_flashdata('infomessage',$this->ion_auth->messages());
      redirect('admin/users','refresh');
    }
  }

  public function delete($user_id = NULL)
  {
    if(is_null($user_id))
    {
      $this->session->set_flashdata('errormessage','There\'s no user to delete');
    }
    else
    {
      $this->ion_auth->delete_user($user_id);
      $this->session->set_flashdata('infomessage',$this->ion_auth->messages());
    }
    redirect('admin/users','refresh');
  }

}