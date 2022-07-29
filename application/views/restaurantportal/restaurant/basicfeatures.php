<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");

echo form_open(base_url().'restaurantsettings/basicfeatures');
?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
	<h1>Basic Features</h1>
</div>
<div class="title_bar content">
<?
$this->load->view("restaurantportal/messages");
?>
    <div class="row justify-content-center">
        <from>
		  <div class="col-sm-12 col_mrg_btm">
            <div class="form-check">
					<input name="pre_order" type="hidden" value="No"/>
					<input class="form-check-input checkbox_adj"  name="pre_order" type="checkbox" value="Yes" <?=($restaurant["pre_order"]=="Yes")?'checked="checked"':''?> />
               <label class="form-check-label " for="flexCheckDefault">
                  <b>Pre order </b> 
               </label>
            </div>
         </div>
         <div class="col-sm-12 col_mrg_btm">
            <div class="form-check">
					<input name="take_out" type="hidden" value="No"/>
					<input class="form-check-input checkbox_adj"  name="take_out" type="checkbox" value="Yes" <?=($restaurant["take_out"]=="Yes")?'checked="checked"':''?> />
               <!-- <input class="form-check-input checkbox_adj" type="checkbox" value="" id="flexCheckDefault"> -->
               <label class="form-check-label " for="flexCheckDefault">
                  <b>Take Out </b> 
               </label>
            </div>
         </div>
         <div class="col-sm-12 col_mrg_btm">
            <div class="form-check">
				<input name="dine_in" type="hidden" value="No"/>	
				<input class="form-check-input checkbox_adj" name="dine_in" type="checkbox" value="Yes" <?=($restaurant["dine_in"]=="Yes")?'checked="checked"':''?> />										
            <label class="form-check-label " for="flexCheckChecked">
              <b>Dine In</b> 
            </label>
            </div>
         </div>
			<div class="col-sm-12 col_mrg_btm">
            <div class="form-check">
				<input name="delivery" type="hidden" value="No"/>	
				<input class="form-check-input checkbox_adj" name="delivery" type="checkbox" value="Yes" <?=($restaurant["delivery"]=="Yes")?'checked="checked"':''?> />										
            <label class="form-check-label " for="flexCheckChecked">
              <b>Delivery</b> 
            </label>
            </div>
         </div>
			<div class="col-sm-6 col_mrg_btm" >
				<div class="form-group" id="delivery_charge" style="<?= $restaurant["delivery"]=="Yes" ? 'display:block' : 'display:none' ?>">
					<label for="delivery_charge" class="form-label">Delivery Charges</label>
					<input type="number" class="form-control" name="delivery_charge" value="<?= $restaurant["delivery_charge"] ?>">
				</div>
			</div>
         <div class="col-sm-12">
               <input type="submit" class="btn  btn_adj" value="Save">
         </div>
      </from>  
     </div>
</div>

</form>
<script>
	$(document).ready(function(){
		$('input[type=checkbox][name=delivery]').change(function() {
			if ($(this).is(':checked')) {
				document.getElementById("delivery_charge").style.display = "block";
			}
			else{
				document.getElementById("delivery_charge").style.display = "none";
			}
		});
 	});
</script>
<?
$this->load->view("restaurantportal/footer_view");
?>
