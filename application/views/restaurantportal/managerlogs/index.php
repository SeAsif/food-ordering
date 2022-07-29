<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<style>
.float_element {
    float: right;
}

.date_adj {
    max-width: 250px !important;
    width: 250px;
    height: 38px;
    border-radius: 10px !important;
    margin-left: 5px;
    border: 1px solid #ced4da !important;
    padding: 10px;
}

.flex-setting {
    justify-content: end !important;
}

.show_rows_adj {
    margin-left: 10px !important;
}

.margin_top {
    margin-top: 25px !important;
}
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>

<!-- End Dialog Popups -->
<div class="title_bar title_bar_adj">

    <div class="row" style="width:100%">
        <div class="col-sm-6">
            <h1>Manager Log Book</h1>
        </div>
        <!-- <div class="col-sm-6">
            <button class="btn orange_btn text-white float_element" data-bs-toggle="modal"
                data-bs-target="#add_new_modal">Payroll Settings</button>
        </div> -->
    </div>

</div>
<?
if (!isset($_GET['log_date'])){
    $log_date = FALSE; 
} else {
    $log_date = $_GET['log_date']; 
} 

if (!isset($_GET['show_rows'])){
    $show_rows = FALSE; 
} else {
    $show_rows = $_GET['show_rows']; 
} 
?>
<div class="title_bar flexable">
    <form class="row  align-items-center">
        <div class="col-sm-12  col-md-6 col-lg-8 div_inline">

            <label for="log_date">Select Date:</label>
            <input class="date_adj form-control" type="date" id="log_date"  value="<? echo $log_date;?>">

        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <button type="button" class="btn  orange_btn text-white float_element default_orange_button"
                onClick="location.href='<?= base_url() . "managerlogbook/create" ?>'">Add New Log </button>
        </div>

    </form>
</div>

<div class=" title_bar content employe_table">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table_setting">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? if(!empty($logs)){
                       foreach($logs as $key=>$data){
                     ?>
                        <tr>
                            <td>
                                <? echo $data->log_date;?>
                            </td>
                            <td>
                                <? echo $data->created_by;?>
                            </td>
                            <td>
                                <? echo date("Y-m-d", strtotime($data->created_at));?>
                            </td>
                            <td>
                                <? echo $data->updated_by;?>
                            </td>
                            <td>
                                <? echo date("Y-m-d", strtotime($data->updated_at));?>
                            </td>
                            <td class="flex_direction">
                                <a href="<?= base_url() . "managerlogbook/edit/".$data->id; ?>"
                                    style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i
                                        class="fas fa-edit icon_margin"></i> Edit</a>
                            </td>
                        </tr>
                        <? 
                        } 
                        }else{
                        }
                        ?>


                    </tbody>
                </table>
                <div class=" flex-columns flex-setting">
                  <? if(!empty($links)){?>
                    <div class="inline_block_adj show_rows_adj">
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows :</label>
                        <select class="custom-select my-1 show_rows_count" id="inlineFormCustomSelectPref">
                            <? foreach(rows_show() as $rows){?>
                            <? if($rows==$show_rows){?>
                                <option value="<? echo $rows; ?>"  selected><? echo $rows; ?></option>
                            <?}else{?>
                             <option value="<? echo $rows; ?>"><? echo $rows; ?></option>
                           <? }?>
                            <?}?>
                        </select>
                    </div>
                    <?}?>
                    <div class="show_rows_adj margin_top">
                        <nav aria-label="Page navigation example ">
                            <ul class="pagination">
                                <ul class="pagination"><?= $links?? null ?></ul>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Delete operation hours</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you want to delete Coupon </strong>
                </div>

                <div class="modal-footer-new">
                    <input type="hidden" name="operation_hour_id" id="operation_hour_id" value="" />
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Popup Window Here -->
</div>
<!-- End Mid Right -->


<script type="text/javascript">

$(document).ready(function(){

    <? if(!empty($links)){?>

    $("#log_date").change(function(){

        if($("#inlineFormCustomSelectPref").val()!=""){
            window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?log_date='+$(this).val()+'&show_rows='+$("#inlineFormCustomSelectPref").val();
        }else{
            window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?log_date='+$(this).val();
        }
    })

    $("#inlineFormCustomSelectPref").change(function(){
        if($("#log_date").val()!=""){
            window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?log_date='+$("#log_date").val()+'&show_rows='+$(this).val();
        }else{
            window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?show_rows='+$(this).val();
        }
    })


    <? }else{?>


        $("#log_date").change(function(){

if($("#inlineFormCustomSelectPref").val()!=""){
    
    window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?log_date='+$(this).val();
}
})

$("#inlineFormCustomSelectPref").change(function(){
if($("#log_date").val()!=""){
    window.location.href='<?= base_url() . "managerlogbook/list" ?>'+'?log_date='+$(this).val();
}
})
        
<? }?>

})

</script>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>