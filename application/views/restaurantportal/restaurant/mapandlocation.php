<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
echo form_open(base_url().'restaurantsettings/mapandlocation');
?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
	<h1>Location</h1>
</div>
<div class="title_bar content">
<?
$this->load->view("restaurantportal/messages");
?>
    <div class="row ">
    <form>
      <div class="col-lg-6 col-xl-6 col-md-6 col-12">
          <div class="form-group">
              <label for="address" class="form-label">Edit Address</label>
              <input type="text" class="form-control" name="address" aria-describedby="address" value="<?=$restaurant["address"]?>">
        </div>
      </div>
      <div class="col-lg-12 col-xl-12 col-md-12 col-12">
          <input type="submit" class="btn  btn_adj" value="Save">
     </div>
   </form>
 </div>  
</div>
</form>
<?
$this->load->view("restaurantportal/footer_view");
?>
