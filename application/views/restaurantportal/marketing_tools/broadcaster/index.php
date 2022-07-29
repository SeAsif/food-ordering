<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>
<div class="title_bar flex-columns">
   <h1>Broadcaster</h1>
</div>


<div class="title_bar title_bar_adj" >
   <h1>
     
     
   </h1>
   <button type="button" class="btn opr_btn_adj" onClick="location.href='<?= base_url() . "marketingtools/create_broadcaster" ?>'">
    new Broadcaster
   </button>
</div>
<div class="title_bar content">

   <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-12">
         <div id="exTab1" class="">
            <div class="tab-content clearfix">
               <div class="tab-pane active" id="1a">
                  <div class="card ">
                     <div class="card-body p-4">
                        <div class="col-sm-12">
                           <div class="table-responsive variant_fixed_table">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th scope="col">Name</th>
                                       <th scope="col">Turn Ordering</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Start Date</th>
                                       <th scope="col">End Date</th>
                                       <th scope="col">Actions</th>
                                    </tr>
                                 </thead>
                                <tbody>
                                 <?
                                  if(!empty($broadcaster)){
                                    foreach($broadcaster as $key=>$value)
                                    {
                                 ?>
                                   
                                <tr>
                                       <td scope="col"><? echo $value->name; ?></td>
                                       <td scope="col"><? echo $value->is_open=="Enable"?"On":"Off"; ?></td>
                                       <td scope="col"><? echo $value->is_on=="On"?"Active":"Inactive"; ?></td>
                                       <td scope="col"><?  echo date("Y-m-d", strtotime($value->start_date)); ?></td>
                                       <td scope="col"><? echo date("Y-m-d", strtotime($value->end_date)); ?></td>
                                       <td scope="col">
                                       
                                       <a href="<?= base_url() . "marketingtools/edit_broadcaster/".$value->id; ?>" style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i
                                        class="fas fa-edit icon_margin"></i> Edit</a>
                                       </td>
                                </tr>

                                <?
                              }
                           } 
                           ?>

                                		
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?
	$this->load->view("restaurantportal/footer_view");
?>
