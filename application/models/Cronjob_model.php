<?php

class Cronjob_model extends CI_Model
{

    function send_email(){
        //getting all restaurants
        $resturants= $this->db->order_by("id desc")->get('restaurant');
        if ($resturants->num_rows() > 0){
            foreach($resturants->result() as $resturant){

                //getting all customers 
                $select = 'user.email,user.firstname,user.lastname,user.birthday,order.restaurant_id';
                $this->db->select($select);
                $this->db->from('order');
                $this->db->join('user', 'order.user_id = user.id', 'left');
                $this->db->where('order.restaurant_id',$resturant->id);
                $this->db->order_by("user.id desc");
                $customers = $this->db->get();
        
                foreach($customers->result() as $key=>$customer){

                         //Smtp setting    
       

                        
                        $date= date("Y-m-d");

                        $this->db->from("mail_server_settings"); 
                        $this->db->where('restaurant_id',$customer->restaurant_id); 
                        $query= $this->db->get();
                        $email_setttings= $query->row();

                        $this->db->from("campaigns"); 
                        $this->db->where('restaurant_id',$customer->restaurant_id); 
                        $this->db->where("start_date <= '$date'");
                        $this->db->where("end_date >= '$date'");
                        $this->db->where('status','Active');
                        $query= $this->db->get();
                        $campaign= $query->row();

        
                    if(!empty($campaign)){
      
                        $this->load->library('email');
                        $adminemail = $this->config->item("adminEmail");
                        $config['wordwrap'] = TRUE;            
                        //
                        $this->email->initialize($config);
                        
                        $this->email->from($adminemail, $this->config->item("adminName"));
            
                        if(!empty($email_setttings)){
        
                            // get email subject and body from email compaign
                            //email will be sedning resturant's smtp
                            $config['protocol'] = 'smtp';
                            $config['smtp_host'] = $email_setttings->smtp_server;
                            $config['smtp_port'] = $email_setttings->smtp_port;
                            
                            $config['smtp_user'] = $email_setttings->smtp_username;
                            $config['smtp_pass'] = $email_setttings->smtp_password;
                            
                            $config['charset'] = 'utf-8';

                            if($campaign->condition=="Birthday"){
                            if(date("m-d",strtotime($customer->birthday))==date("m-d")){
                            $Subject = $campaign->subject;
                            $data["details"]=$campaign->details; 
                            $data["name"]=$customer->firstname.' '.$customer->lastname;              
                            $this->email->to($customer->email);
                            $this->email->subject($Subject);
                            $this->email->message($this->load->view('email/email_campaign',$data,true));
                            $this->email->send();

                            }else{
                                $Subject = $campaign->subject;
                                $data["details"]=$campaign->details; 
                                $data["name"]=$customer->firstname.' '.$customer->lastname;              
                                $this->email->to($customer->email);
                                $this->email->subject($Subject);
                                $this->email->message($this->load->view('email/email_campaign',$data,true));
                                $this->email->send(); 
                                echo " email sent succussfully"."<br>";
                           }
               
                         }
        
                        }
                         else{

                            $Subject = $campaign->subject;
                            $data["details"]=$campaign->details; 
                            $data["name"]=$customer->firstname.' '.$customer->lastname;              
                            $this->email->to($customer->email);
                            $this->email->subject($Subject);
                            $this->email->message($this->load->view('email/email_campaign',$data,true));
                            $this->email->send();
                            echo " email sent succussfully"."<br>";
                        }   
                    }else{
                        echo "No email campaign found"."<br>";
                    }
                }

            }

        }
                
    }




    function generate_payroll()
    {
            # code...

        $payroll_settings=$this->db->get("payroll_settings");
        if ($payroll_settings->num_rows() > 0) 
        {

            foreach ($payroll_settings->result() as $value) 
            {
            switch($value->frequency){
            case "Weekly":
              
                $start_date=new DateTime("last week");
                $end_date=clone($start_date);
                $end_date=$end_date->modify("+6 days");
                
                $query= $this->db
                        ->select('id,restaurant_id,employee_id, count(employee_id) AS mark_attendence, sum(total_hours) as total_hours')
                        ->from('user_tracking')
                        ->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')
                        ->where('restaurant_id',$value->restaurant_id)
                        ->where('check_out IS NOT NULL')
                        ->where('total_hours IS NOT NULL')
                        ->where('is_payroll','!=',1)
                        ->group_by('employee_id')
                        ->order_by('mark_attendence', 'desc')
                        ->get();
                        //print_r($this->db->last_query());
                        //mark as payroll generated
                    $this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')->where('check_out IS NOT NULL')->where('total_hours IS NOT NULL')->update('user_tracking', ["is_payroll"=>1]);
       
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
              
                if($row->total_hours!=null){

                    $this->db->from("staff_wages_info"); 
                    $this->db->where('user_id',$row->employee_id); 
                    $wages= $this->db->get();
                    $wages_row = $wages->row();

                    $data=["user_id"=>$row->employee_id,
                    "restaurant_id"=>$row->restaurant_id,
                    "start_date"=>$start_date->format("Y-m-d"),
                    "end_date"=>$end_date->format("Y-m-d"),
                    "total_time"=>$row->total_hours,
                    "total_amount"=>$row->total_hours*$wages_row->wage,
                    "payable_amount"=>$row->total_hours*$wages_row->wage,
                    "created_at"=>date("Y-m-d h:i:sa")
                    ];

                    $response=$this->db->insert("payrolls", $data); 
                    $staff=$this->db->from("user")->where('id',$row->employee_id)->get()->row();
                    $data["staff_name"]=$staff->firstname.' '.$staff->lastname;
                    if($response){
                        $message=["success"=>true,"message"=>"Payroll Created Successfully","data"=>$data];
                    }else{
                        $message=["success"=>false,"message"=>"Payroll did not create","data"=>$data];
                    }
                        echo"<pre>";
                        echo print_r($message);
                        echo"<pre>";
                    }
                }
        }else{
            $message=["success"=>false,"message"=>"No record exits to generate payroll"];
            echo"<pre>";
            echo print_r($message);
            echo"<pre>";   
        } 
       




            break;
            case  "Bi-Monthly":
               

                
                $get_month=date("m",strtotime($value->effective_date));
                $get_year=date("Y",strtotime($value->effective_date));
                $get_day=date("d",strtotime($value->effective_date));
                $start_date_of_month=date('Y-m-01',strtotime($value->effective_date));
                $end_date_of_month=date('Y-m-t',strtotime($value->effective_date));
              
        
                $effective_date=$get_year.'-'.$get_month.'-'. $get_day;

                $today = strtotime("now"); 
                $year = date("Y", $today);
                $month = date("m", "$today");
                $day = date("d", "$today");

                $today_date=$year."-".$get_month."-".$day;

                if(date('t',strtotime($value->effective_date))==31){
                    $mid_date=date("Y-m-d", mktime(0, 0, 0, $get_month,15, $get_year));
                    $last_date=date("Y-m-d", mktime(0, 0, 0, $get_month,31, $get_year));
                    }else{
                    $last_date=date("Y-m-d", mktime(0, 0, 0, $get_month,30, $get_year)); 
                    $mid_date=date("Y-m-d", mktime(0, 0, 0, $get_month,15, $get_year)); 
                    }

                if($mid_date==$today_date){
                    //1st interval
                    $start_date=$start_date_of_month;
                    $end_date=$mid_date;
                    $query= $this->db
                    ->select('id,restaurant_id,employee_id, count(employee_id) AS mark_attendence, sum(total_hours) as total_hours')
                    ->from('user_tracking')
                    ->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
                    ->where('restaurant_id',$value->restaurant_id)
                    ->where('check_out IS NOT NULL')
                    ->where('total_hours IS NOT NULL')
                    ->where('is_payroll','!=',1)
                    ->group_by('employee_id')
                    ->order_by('mark_attendence', 'desc')
                    ->get();
                     //print_r($this->db->last_query());
                     //mark as payroll generated
                    $this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')->where('check_out IS NOT NULL')->where('total_hours IS NOT NULL')->update('user_tracking', ["is_payroll"=>1]);
           
                        if ($query->num_rows() > 0) 
                        {
                        
                        // echo "row count >1"."<br";
                            foreach ($query->result() as $row) 
                            {
                            
                                if($row->total_hours!=null){
                
                                    $this->db->from("staff_wages_info"); 
                                    $this->db->where('user_id',$row->employee_id); 
                                    $wages= $this->db->get();
                                    $wages_row = $wages->row();
                
                                    $data=["user_id"=>$row->employee_id,
                                    "restaurant_id"=>$row->restaurant_id,
                                    "start_date"=>$start_date,
                                    "end_date"=>$end_date,
                                    "total_time"=>$row->total_hours,
                                    "total_amount"=>$row->total_hours*$wages_row->wage,
                                    "payable_amount"=>$row->total_hours*$wages_row->wage,
                                    "created_at"=>date("Y-m-d h:i:sa")
                                    ];
                
                                $response=$this->db->insert("payrolls", $data); 
                                $staff=$this->db->from("user")->where('id',$row->employee_id)->get()->row();
                                $data["staff_name"]=$staff->firstname.' '.$staff->lastname;
                                if($response){
                                    $message=["success"=>true,"message"=>"Payroll Created Successfully","data"=>$data];
                                }else{
                                    $message=["success"=>false,"message"=>"Payroll did not create","data"=>$data];
                                }
                                    echo"<pre>";
                                    echo print_r($message);
                                    echo"<pre>";
                                }
                            }
                        } 
                        else{
                            $message=["success"=>false,"message"=>"No record exits to generate payroll"];
                            echo"<pre>";
                            echo print_r($message);
                            echo"<pre>";   
                        } 
                    
    


                }//Ist interval


                if($last_date==$end_date_of_month){

                    //2nd interval
                    $start_date=date('Y-m-16',strtotime($value->effective_date));
                    $end_date=$last_date;
                    $query= $this->db
                    ->select('id,restaurant_id,employee_id, count(employee_id) AS mark_attendence, sum(total_hours) as total_hours')
                    ->from('user_tracking')
                    ->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW()')
                    ->where('restaurant_id',$value->restaurant_id)
                    ->where('check_out IS NOT NULL')
                    ->where('total_hours IS NOT NULL')
                    ->where('is_payroll','!=',1)
                    ->group_by('employee_id')
                    ->order_by('mark_attendence', 'desc')
                    ->get();
                     //print_r($this->db->last_query());
                     //mark as payroll generated
                    $this->db->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()')->where('check_out IS NOT NULL')->where('total_hours IS NOT NULL')->update('user_tracking', ["is_payroll"=>1]);
           
                        if ($query->num_rows() > 0) 
                        {
                        
                            // echo "row count >1"."<br";
                            foreach ($query->result() as $row) 
                            {
                            
                                if($row->total_hours!=null){
                
                                    $this->db->from("staff_wages_info"); 
                                    $this->db->where('user_id',$row->employee_id); 
                                    $wages= $this->db->get();
                                    $wages_row = $wages->row();
                
                                    $data=["user_id"=>$row->employee_id,
                                    "restaurant_id"=>$row->restaurant_id,
                                    "start_date"=>$start_date,
                                    "end_date"=>$end_date,
                                    "total_time"=>$row->total_hours,
                                    "total_amount"=>$row->total_hours*$wages_row->wage,
                                    "payable_amount"=>$row->total_hours*$wages_row->wage,
                                    "created_at"=>date("Y-m-d h:i:sa")
                                    ];
                
                                $response=$this->db->insert("payrolls", $data); 
                                $staff=$this->db->from("user")->where('id',$row->employee_id)->get()->row();
                                $data["staff_name"]=$staff->firstname.' '.$staff->lastname;
                                if($response){
                                    $message=["success"=>true,"message"=>"Payroll Created Successfully","data"=>$data];
                                }else{
                                    $message=["success"=>false,"message"=>"Payroll did not create","data"=>$data];
                                }
                                    echo"<pre>";
                                    echo print_r($message);
                                    echo"<pre>";
                                }
                            }
                        }else{
                            $message=["success"=>false,"message"=>"No record exits to generate payroll"];
                            echo"<pre>";
                            echo print_r($message);
                            echo"<pre>";   
                        } 
                    
    


                }//end 2nd interval 

                 break;
           
                 default:
        
                            $query= $this->db
                            ->select('id,restaurant_id,employee_id, count(employee_id) AS mark_attendence, sum(total_hours) as total_hours')
                            ->from('user_tracking')
                            ->where('date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()')
                            ->where('restaurant_id',$value->restaurant_id)
                            ->where('check_out IS NOT NULL')
                            ->where('total_hours IS NOT NULL')
                            ->where('is_payroll','!=',1)
                            ->group_by('employee_id')
                            ->order_by('mark_attendence', 'desc')
                            ->get();
                            $start_date=date('Y-m-01',strtotime($value->effective_date));
                            $end_date=date('Y-m-t',strtotime($value->effective_date));
                            //mark as payroll generated
                            $this->db->where("date >= '$start_date'")->where("date <= ' $end_date'")->where('check_out IS NOT NULL')->where('total_hours IS NOT NULL')->update('user_tracking', ["is_payroll"=>1]);
                    
                                if ($query->num_rows() > 0) 
                                {
                                    foreach ($query->result() as $row) {
                                        if($row->total_hours!=null){
                                            $this->db->from("staff_wages_info"); 
                                            $this->db->where('user_id',$row->employee_id); 
                                            $wages= $this->db->get();
                                            $wages_row = $wages->row();
                            
                                            $data=["user_id"=>$row->employee_id,
                                            "restaurant_id"=>$row->restaurant_id,
                                            "start_date"=>date('Y-m-01',strtotime($value->effective_date)),
                                            "end_date"=>date('Y-m-t',strtotime($value->effective_date)),
                                            "total_time"=>$row->total_hours,
                                            "total_amount"=>$row->total_hours*$wages_row->wage,
                                            "payable_amount"=>$row->total_hours*$wages_row->wage,
                                            "created_at"=>date("Y-m-d h:i:sa")];
        
                                            $response=$this->db->insert("payrolls", $data); 
                                            $staff=$this->db->from("user")->where('id',$row->employee_id)->get()->row();
                                            $data["staff_name"]=$staff->firstname.' '.$staff->lastname;
                                            if($response){
                                                $message=["success"=>true,"message"=>"Payroll Created Successfully","data"=>$data];
                                            }else{
                                                $message=["success"=>false,"message"=>"Payroll did not create","data"=>$data];
                                            }
                                                echo"<pre>";
                                                echo print_r($message);
                                                echo"<pre>";
                                        }
                                    }
                                }else{
                                    $message=["success"=>false,"message"=>"No record exits to generate payroll"];
                                    echo"<pre>";
                                    echo print_r($message);
                                    echo"<pre>";   
                                } 
                    }
                 }

            }
        }




        function broadcast_message(){


            $broadcast=$this->db->from("broadcast")->get()->result();

            $message=["success"=>false,"message"=>"No record exits to generate payroll","data"=>$broadcast];
            echo"<pre>";
            echo print_r($message);
            echo"<pre>";


        }



       

    }

