<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
     * This is default constructor of the class
     */
class Cronjob extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Cronjob_model');
        $this->load->helper('crontab_helper');
    }

    public function index()
    {
      echo "Hello, World" . PHP_EOL;
    }
      
    /**
     * This function is called by cron job once in a day at 9 AM. EST
     */
    public function send_automated_email()
    {            
        // is_cli_request() is provided by default input library of codeigniter
       // if($this->input->is_cli_request())
       // {            
           $response= $this->Cronjob_model->send_email();
           echo"<pre>";
           echo print_r($response);
           echo"<pre>";
      //  }
       // else
       // {
        //   echo json_encode("You dont have access");
       // }
    }

  public function generate_payroll(){
    //if($this->input->is_cli_request())
    //{            
        $this->Cronjob_model->generate_payroll();

          
  //  }
   // else
   // {
       // echo json_encode("You dont have access");
   // }

  }



  public function broadcaster(){

    $month=date("m");
    $year=date("Y");
     weekofmonth($month, $year);

     die();
    //if($this->input->is_cli_request())
    //{            
        $this->Cronjob_model->broadcast_message();

          
  //  }
   // else
   // {
       // echo json_encode("You dont have access");
   // }

  }

    


  
    
    
   


}