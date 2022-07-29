<?
/**
*Manager log book
*/
class ExportTable extends CI_Controller {

	
	function export()
	{		
       
 $this->load->dbforge(); 


               $loyality_settings=array(
                'id' => array(
                   'type' => 'bigint',
                   'unsigned' => TRUE,
                   'auto_increment' => TRUE
                 ),
                 'restaurant_id' => array(
                   'type' => 'int',
                   'null' => FALSE
                 ),
                 'status' => array(
                    'type' => 'ENUM("On","Off")',
                    'default' => 'On',
                    'null' => FALSE
                ),
                
                'based_on' => array(
                    'type' => 'ENUM("Dollars","Orders")',
                    'default' => 'Dollars',
                    'null' => FALSE
                ),
                'calculation_based' => array(
                    'type' => 'ENUM("Subtotal","Total")',
                    'default' => 'Subtotal',
                    'null' => FALSE
                ),
                 'termconditions' => array(
                    'type' => 'text',
                    'null' => FALSE
                  ),

                  'conversion_value' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                  ),
                 
                  
                  'conversion_rate' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                  ),
                 
                  
                  
                 'created_by' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                ),
                'updated_by' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                ),
                'deleted_by' => array(
                    'type' => 'INT',
                    'null' => TRUE,
                ),
                'created_at' => array(
                    'type' => 'TIMESTAMP',
                    'null' => TRUE,
                ),
                'updated_at' => array(
                    'type' => 'TIMESTAMP',
                    'null' => TRUE,
                ),
                'deleted_at' => array(
                    'type' => 'TIMESTAMP',
                    'null' => TRUE,
                    )  
                );
                if ($this->db->table_exists('loyality_settings'))
                {
                    table_already_exists("loyality_settings");
                }else{
                    
                    $this->dbforge->add_field($loyality_settings);
                    $this->dbforge->add_key('id', TRUE);
                    $this->dbforge->add_key('restaurant_id', TRUE);
                    $this->dbforge->create_table('loyality_settings');
                    table_created("loyality_settings"); 
                
                    
                }
               



 $rewards=array(
    'id' => array(
       'type' => 'bigint',
       'unsigned' => TRUE,
       'auto_increment' => TRUE
     ),
     'restaurant_id' => array(
       'type' => 'int',
       'null' => FALSE
     ),
     'coupon_id' => array(
        'type' => 'int',
        'null' => FALSE
      ),
     'title' => array(
        'type' => 'text',
        'null' => FALSE
      ),
      'description' => array(
        'type' => 'text',
        'null' => FALSE
      ),
      'points' => array(
        'type' => 'VARCHAR',
        'constraint' => 50,
        'null' => FALSE
      ),

      'is_redeemed' => array(
        'type' => 'boolean',
        'default'=>0,
      ),
      
     'created_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'updated_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'deleted_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'deleted_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
        )  
    );
    if ($this->db->table_exists('rewards'))
    {
        table_already_exists("rewards");
    }else{
        
        $this->dbforge->add_field($rewards);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('restaurant_id', TRUE);
        $this->dbforge->add_key('coupon_id', TRUE);
        $this->dbforge->create_table('rewards');
        table_created("rewards"); 
    
        
    }




 $mail_server_settings=array(
     'id' => array(
        'type' => 'bigint',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'restaurant_id' => array(
        'type' => 'int',
        'null' => FALSE
      ),
    'smtp_username' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
    ),
    'smtp_password' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
    ),
    'smtp_server' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
    ),
    'smtp_port' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
    ),
    
    'created_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'updated_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'deleted_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'deleted_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
        )  
    );
if ($this->db->table_exists('mail_server_settings'))
{
    table_already_exists("mail_server_settings");
}else{
    
    $this->dbforge->add_field($mail_server_settings);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->add_key('restaurant_id', TRUE);
    $this->dbforge->create_table('mail_server_settings');
    table_created("mail_server_settings"); 

    
}




 
//coupons
$coupons=array(
    'id' => array(
        'type' => 'bigint',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
 
      'restaurant_id' => array(
        'type' => 'int',
        'unsigned' => TRUE,
      ),
      'coupon_id' => array(
        'type' => 'int',
        'null' => FALSE
      ),

      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
      ), 

      
      'subject' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
      ),
      'condition' => array(
        'type' => "ENUM('Birthday','Anniversary','Registration','FirstOrder','LastOrder','SpecificDay')",
        'default' => 'Birthday',
        'null' => FALSE
    ),
      'is_never_expire' => array(
        'type' => 'boolean',
        'default'=>0,
    ), 
      'start_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),
    'end_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),
   
    'days' => array(
        'type' => 'int',
        'null' => TRUE,
      ), 

      'anniversary' => array(
        'type' => 'int',
        'null' => TRUE,
      ),
      
      'details' => array(
        'type' => 'text',
        'null' => TRUE,
      ),
    
    'status' => array(
      'type' => 'ENUM("Active","Inactive")',
      'default' => 'Active',
      'null' => FALSE
  ),
    'created_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'updated_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'deleted_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'deleted_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    )  
    );

    if ($this->db->table_exists('campaigns'))
    {
        table_already_exists("campaigns");
    }else{
        
        $this->dbforge->add_field($coupons);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('coupon_id', TRUE);
        $this->dbforge->create_table('campaigns');
        table_created("campaigns"); 

        
    }


 //coupons
 $coupons=array(
    'id' => array(
        'type' => 'bigint',
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'code' => array(
        'type' => 'VARCHAR',
        'constraint' => 300,
        'null' => FALSE,
      ), 
      'start_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),
    'is_default' => array(
        'type' => 'boolean',
        'default'=>0,
    ),
    'end_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),
    'usage' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'discount_type' => array(
        'type' => 'ENUM("Percentage","Naira")',
        'default' => 'percentage',
        'null' => FALSE
    ),
    'discount' => array(
        'type' => 'float',
        'null' => FALSE,
      ), 
      'status' => array(
        'type' => 'ENUM("Active","Inactive")',
        'default' => 'Active',
        'null' => FALSE
    ),
    'customer_log' => array(
        'type' => 'ENUM("Yes","No")',
        'default' => 'Yes',
        'null' => FALSE
    ),
    'is_home_page' => array(
        'type' => 'ENUM("Public","Private")',
        'default' => 'Public',
        'null' => FALSE
    ),
    'created_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'updated_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'deleted_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'deleted_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    )  
    );

    if ($this->db->table_exists('coupons'))
    {
        table_already_exists("coupons");
    }else{
        $this->dbforge->add_field($coupons);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('coupons');
        table_created("coupons");
    }

// define table fields
$broadcast = array(
    'id' => array(
      'type' => 'bigint',
      'unsigned' => TRUE,
      'auto_increment' => TRUE
    ),
   
    
    'restaurant_id' => array(
        'type' => 'int',
        'unsigned' => TRUE,
      ),
    'name' => array(
      'type' => 'VARCHAR',
      'constraint' => 300,
      'null' => FALSE,
    ),
    'is_open' => array(
        'type' => 'ENUM("Enable","Disable")',
        'default' => 'Enable',
        'null' => FALSE,
        'comment' => 'Enable=open & Disable=Closed',
    ),
    'is_on' => array(
        'type' => 'ENUM("On","Off")',
        'default' => 'on',
        'null' => FALSE,
        'comment' => 'turn on/off broadcast',
    ),
    'duration' => array(
        'type' => 'ENUM("Days","Range")',
        'default' => 'Days',
        'null' => FALSE,
        'comment' => 'Days when select day(s) & Range when select Range',
    ),
    
    'start_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),
    'end_date' => array(
        'type' => 'date',
        'null' => TRUE,
    ),

    'start_time' => array(
        'type' => 'time',
        'null' => TRUE,
    ),
    'end_time' => array(
        'type' => 'time',
        'null' => TRUE,
    ),

    'all_day' => array(
        'type' => 'boolean',
        'default' => '0',
        'null' => TRUE,
    ),
    'message' => array(
        'type' => 'VARCHAR',
        'constraint' => 1000,
        'null' => TRUE,
      ),
    'created_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'updated_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'deleted_by' => array(
        'type' => 'INT',
        'null' => TRUE,
    ),
    'created_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'updated_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    ),
    'deleted_at' => array(
        'type' => 'TIMESTAMP',
        'null' => TRUE,
    )
   );
   if ($this->db->table_exists('broadcast'))
{
    table_already_exists("broadcast");
}else{
    $this->dbforge->add_field($broadcast);
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->add_key('restaurant_id', TRUE);
    $this->dbforge->create_table('broadcast');
    table_created("broadcast");
}
      
 
        // define table fields
        $manager_logs = array(
            'id' => array(
              'type' => 'bigint',
              'unsigned' => TRUE,
              'auto_increment' => TRUE
            ),
            'restaurant_id' => array(
                'type' => 'int',
                'null' => FALSE
              ),
             'log_date' => array(
                'type' => 'date',
                'null' => TRUE,
            ),
            'deposit_drop_code' => array(
              'type' => 'VARCHAR',
              'constraint' => 100,
              'null' => TRUE,
            ),
             'deposit_drop_amount' => array(
              'type' => 'VARCHAR',
              'constraint' => 100,
              'null' => TRUE,
            ),
            'petty_cash_amount' => array(
              'type' => 'VARCHAR',
              'constraint' => 100,
              'null' => TRUE,
            ),
            'petty_cash_description' => array(
              'type' => 'VARCHAR',
              'constraint' => 1000,
              'null' => TRUE,
            ),
            'daily_sales' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'daily_guest_count' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'daily_labor' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'daily_food' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'breakfast_sales' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'breakfast_guest_count' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'lunch_sales' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'lunch_guest_count' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'dinner_sales' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'dinner_guest_count' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),

            'repair_and_mentenance' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'personal_issues' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'customer_feedback' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'action_taken' => array(
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => TRUE,
            ),
            'created_by' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'updated_by' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'deleted_by' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ),
            'deleted_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            )
           );
           if ($this->db->table_exists('manager_logs')){
            table_already_exists("manager_logs");
           }else{
            $this->dbforge->add_field($manager_logs);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('manager_logs');
            table_created("manager_logs");
           }
                




        }













}


?>