<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{

  function __construct()
  {
    parent::__construct();

    $site_lang = $this->session->userdata('site_lang');
    if ($site_lang) {
        $this->lang->load(array('general','ion_auth'), $this->session->userdata('site_lang'));
    } else {
        $this->lang->load(array('general','ion_auth'), $this->config->item('pool_default_language'));
    }
  }

  public function index()
  {
    $this->render('admin/dashboard_view');
  }
}