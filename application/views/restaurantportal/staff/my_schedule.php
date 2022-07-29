<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flex-columns">
   <h1>Daily Schedule</h1>
</div>
<div class="title_bar content">
   <?
   $this->load->view("restaurantportal/messages");
   ?>
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
                                       <th scope="col">No</th>
                                       <th scope="col">Schedule Date</th>
                                       <th scope="col">Start</th>
                                       <th scope="col">End</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php if (!empty($myschedule)) { ?>
                                       <?php foreach ($myschedule as $key => $time) { ?>
                                          <tr>
                                             <td><?php echo $key + 1; ?></td>
                                             <td><?php echo date('M d Y, D', strtotime($time['date'])); ?></td>
                                             <td><?php echo date('h:i A', strtotime($time['start'])); ?></td>
                                             <td><?php echo date('h:i A', strtotime($time['end'])); ?></td>
                                          </tr>
                                       <?php } ?>
                                    <?php } else { ?>
                                       <tr>
                                          <td colspan="4" class="text-center">
                                             No Schedule Found from <b style="color: #000;"><?php echo $start; ?></b> to <b style="color: #000;"><?php echo $end; ?></b>
                                          </td>
                                       </tr>
                                    <?php } ?>
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