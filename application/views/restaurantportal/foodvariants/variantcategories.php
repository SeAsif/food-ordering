<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
   
<script language="javascript">
   var renameVariant	;
   var variantcategoryname;
   function renameVariants(nId, strvariantItem)
   {
   	viewVariant	=	nId;
   	categoryName	=	strvariantItem;
   
   	$.ajax({ type: "POST", url: "<?=base_url()?>restaurantVariant/getVariantCategoryById", data: "category_id="+nId+"", success: function(variantCategory){ 
   	
   		if (variantCategory == "No_Record_Found") {
            alert("Sorry! No record found");
         } else {
            $("#variant_category_name").val(variantCategory.category_name);
            $("#variant_category_id").val(variantCategory.id);
            // console.log(variantCategory);
            // alert(variantCategory.category_name)
            // $('#rename_food_category').dialog('open');
            // $('#rename_food_variant_category').show();
            $('#operationHours').modal('show');


         }
   	}//end function
   	});	
   	
   	return false;
   }
   
   var deleteVariant	;
   function deleteVariants(nItemId, strvariantItem)
   {
   	deleteVariant	=	nItemId;
   	categoryName	=	strvariantItem;
   	$('#span_variantItem').html(strvariantItem);
   	$('#delete_food_variant').dialog('open');
   	return false;
   }
   
</script>
<!-- Start Dialog Popups -->
<script type="text/javascript">
   $(function(){
   	// Dialog	( Start Edit Variant Popup Window Here )
   	$('#rename_food_variant').dialog({
   		autoOpen: false,
   		modal: true,fluid:true,
   		width: 'auto',responsive: true,
         maxWidth:300
   	});
   
   	// Dialog	( Start Delete Popup Window Here )
   	$('#delete_food_variant').dialog({
   		autoOpen: false,
   		modal: true,
   		width: 'auto',responsive: true,
         maxWidth:300,
   		height: 180,fluid:true,
   		buttons: {
   			"Yes": function() { 
   //							$(this).dialog("close"); 
   				$("#variantcategoryname").val(categoryName);
   				$("#updatestatus").val("Deleted");
   				$("#updateid").val(deleteVariant);
   				document.statuschange.submit();
   				
   			}, 
   			"No": function() { 
   				$(this).dialog("close"); 
   			} 
   		}
   	});
   
   });
</script>
<!-- End Dialog Popups -->

<!-- Start Rename Popup Window Here -->

<div class="modal fade" id="operationHours" tabindex="-1" aria-labelledby="operationHoursLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="addtiming_form" action="<?= base_url("restaurantvariant/variantcategories"); ?>" method="post">
            <div class="modal-header">
               <h5 class="modal-title" id="operationHoursLabel">Rename Variant Category:</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row justify-content-centre ">
                  <div class="col-md-12 col-xl-12 col-lg-12 col-12">
                     <label>Category Name</label>
                  </div>
                  <div class="col-md-12 col-xl-12 col-lg-12 col-12">
                     <input type="text" name="category_name" id="variant_category_name" class="txt-field" />
                     <input type="hidden" name="add" value="yes" />
                     <input type="hidden" name="id" id="variant_category_id" value="" />
                  </div>
               </div>
            </div>
            <div class="modal-footer-new">
               <button type="submit" class="btn modal_btn_width modal_btn_one">Update</button>
               <button style="background-color:F7665E " type="button" class="btn modal_btn_width modal_btn_two">Cancel</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- End Rename Popup Window Here -->

<?
   echo form_open(base_url().'restaurantvariant/variantcategories',array('id' => 'statuschange','name'=>'statuschange'));
   
   ?>            
<input type="hidden" name="variantcategoryname" id="variantcategoryname" />
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
</form>
<!-- Start Delete Popup Window Here -->
<div id="delete_food_variant" title="Delete Variant Category">
   <br />
   <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
   <strong>Are you want to Delete <span id="span_variantItem"></span> variant category</strong>
</div>
<!-- End Delete Popup Window Here -->
<!-- Start Rename Popup Window Here -->
<div id="rename_food_variant" title="Rename Food Variant">
   <div class="add-item">
      <?
         echo form_open(base_url().'restaurantvariant/variantcategories',array('id' => 'categoryformedit','name'=>'categoryformedit'));
         
         ?>            
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
            <td style="width:33%;">Rename Variant Category:</td>
            <td><input name="category_name" id="category_name" type="text" class="txt-field" style="width:365px;" /><input name="id" id="id" type="hidden" class="txt-field" style="width:365px;" /><input type="hidden" name="add" value="yes" /></td>
         </tr>
         <tr>
            <td></td>
            <td>
               <a href="javascript:void(null);" class="global-link float-left" style="margin-right:10px;" onclick="document.categoryformedit.submit();"><span>Save</span></a>
               <a href="#" class="global-link float-left"><span>Cancel</span></a>
            </td>
         </tr>
      </table>
      </form>
   </div>
</div>
<!-- End Rename Popup Window Here -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
   <h1>Manage Food Items</h1>
</div>
<div class="title_bar content">
<?
$this->load->view("restaurantportal/messages");
?>
   <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-12">
         <div id="exTab1" class="">
            <ul  class="nav nav-tabs">
               <li class="li_variants_adj nav-item">
                  <a  href="<?=base_url()."restaurantvariant/variantitems"?>" class="nav-link padding_li">Current Food Variants</a>
               </li>
               <li class="active li_variants_adj nav-item">
                  <a href="<?=base_url()."restaurantvariant/variantcategories"?>" class="nav-link padding_li">Manage Variant Categories (<?php echo $totalcount; ?>)</a>
               </li>
            </ul>
            <div class="tab-content clearfix">
               <div class="tab-pane active">
                  <div class="card ">
                     <div class="card-body p-4">
                        <form action="<?php echo base_url('restaurantvariant/variantcategories'); ?>" id="categoryform" name="categoryform" method="post" accept-charset="utf-8">
                           <div class="row mb-4">
                              <div class="col-md-12 col-lg-12 col-xl-12 col-12 ">
                                 <h3>Create New Variant Category</h3>
                              </div>
                              <div class="col-md-10 col-lg-10 col-xl-10 col-12 ">
                                 <input type="text" class="form-control" name="category_name" id="exampleFormControlInput1">
                                 <input type="hidden" name="add" value="yes" />
                              </div>
                              <div class="col-md-2 col-lg-2 col-xl-2 col-12 ">
                                 <!-- <button   style="background-color: #f36737;" class="btn margin_top_stng icon_btn_adj cstm_width"> Add </button> -->
                                 <a href="javascript:void(null);" title="Add" onclick="document.categoryform.submit();" style="background-color: #f36737;" class="btn margin_top_stng icon_btn_adj cstm_width"><span>Add</span></a>
                              </div>
                           </div>
                        </form>   
                        <div class="col-sm-12">
                           <div class="table-responsive">
                              <table class="table table_setting_varriant_categories">
                                 <thead>
                                    <tr>
                                       <th scope="col">No</th>
                                       <th scope="col">Category Name</th>
                                       <th scope="col">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $nCount  =  $ncounter;
                                       foreach ($variants as $key => $variant) {
                                    ?>
                                       <tr>
                                          <td><?php echo $key + 1; ?></td>
                                          <td><?php echo $variant["category_name"]; ?></td>
                                          <td class="btn_style_setting">
                                             <a href="javascript:void(null);" onclick="deleteVariants(<?=$variant["id"]?>, '<?=$variant["category_name"]?>');" style="background-color: #F7665E;" class="btn btn margin_top_stng icon_btn_adj"><i class="fa fa-trash icon_margin"></i> Delete</a>
                                             <a href="javascript:void(null);" onclick="renameVariants(<?=$variant["id"]?>, '<?=$variant["category_name"]?>');" style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i class="fas fa-edit icon_margin"></i> Rename</a>    
                                          </td>
                                       </tr>
                                    <?php } ?>  
                                 </tbody>
                              </table>
                              <div class="inline_flex_adj">
                                 <div class="show_rows_adj">
                                    <ul class="pagination"><?=$paginationLinks?></ul>
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
   </div>
</div>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>
