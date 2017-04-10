<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends Admin_Controller
{

  function __construct()
  {
  	parent::__construct();

    if(!$this->ion_auth->in_group('admin'))
    {
      $this->session->set_flashdata('errormessage',lang('matches_no_access'));
      redirect('admin','refresh');
    }

  }


  public function generate_predictions($match_id = NULL)
  {
    $this->load->model('prediction_model', 'prediction');

        $this->prediction->generate_predictions($match_id);

  }

  public function calculate_match($match_id) {
    $this->load->model('prediction_model','prediction');
    $this->prediction->calculate($match_id);
  }

 	public function create_users($num) {

	 	for($i=1;$i<=$num;$i++) {

	 	  $curr = sprintf("%04d", $i);	
	 	  $username = "user_".$curr;
	      $email = $username."@test.com";
	      $password = $email;
	      $group_ids = array(2);

	      $additional_data = array(
	        'first_name' => $username,
	      );
	      $hup = $this->ion_auth->register($username, $password, $email, $additional_data, $group_ids);
	      echo $hup." created.<br/>";
	  	}
 	}

  public function test($arg1, $arg=3) {
    $this->load->model('prediction_model','prediction');
    echo $this->prediction->get_total_user($arg1, $arg);
  }
      

 }