<?
$this->load->view("userfront/header_view_new");

?>
<style>
  .btn-primary {
    background-color: #37b8ac !important;
    border-color: #37b8ac !important;
  }
</style>
<div class="bg_light">
  <div class="main-container pt-0">
    <?
    if (isset($success["msg"])) {
    ?>

      <div class="ui-widget mb-3">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
          <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            <strong><?= $success["msg"] ?></strong>
          </p>
        </div>
      </div>
    <?
    }
    ?>
    <?
    if (isset($errors) && count($errors)) {
      foreach ($errors as $error) {
        $error = strip_tags($error);
        if (!empty($error)) {
    ?>
          <div class="alert alert-danger" role="alert">
            <?= $error ?>
          </div>

      <?
        }
      }
      ?>
    <?
    }
    ?>
    <?
    if ($flag == 0) {
    ?>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <style>
        .bg_light .grid_roww .left_hand form {
          text-align: center;
        }

        .bg_light .grid_roww .left_hand img {
          margin-bottom: 20px;
        }

        .bg_light .grid_roww .left_hand .card .card-body.active {
          text-align: left;
        }
      </style>
      <div class="grid_roww">
        <div class="left_hand">
          <form action="" method="post">
            <img src=" <?php echo base_url('images') . '/' . 'new_logo.png' ?>" alt="Logo">
            <p>
              <strong style="text-transform: Uppercase;font-family: 'Nunito', sans-serif;font-weight:bold;font-size:20px;">Empowering Restaurants for growth</strong>
            </p>
            <div class="card form-box-onboarding">
              <div class="card-body active">
                <h4>Manage Profile</h4>
                <div class="mb-3">
                  <input type="text" placeholder="First Name" value="<?= set_value("firstname"); ?>" name="firstname" class="form-control" id="firstname">
                </div>
                <div class="mb-3">
                  <input type="text" placeholder="Last Name" value="<?= set_value("lastname"); ?>" name="lastname" class="form-control" id="lastname">
                </div>
                <div class="mb-3">
                  <input type="text" placeholder="Email" value="<?= set_value("email"); ?>" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                  <input name="phone_number" placeholder="Phone" id="phone_number" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("phone_number"); ?>">
                </div>
                <button class=" btn btn-primary text-white next_btn">Next</button>
              </div>
              <div class="card-body ">
                <h4>Restaurant Profile</h4>
                <div class="mb-3">
                  <input name="name" placeholder="Restaurant Name" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("name"); ?>">
                </div>
                <!-- <div class="mb-3">
                  <input name="slogan" type="text" placeholder="Restaurant Slogan" class="form-control" size="56" maxlength="255" value="<?= set_value("slogan"); ?>">
                </div>
                <div class="mb-3">
                  <input name="details" placeholder="Restaurant Details" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("details"); ?>">
                </div> -->
                <div class="mb-3">
                  <input name="restaurant_email" type="text" placeholder="Restaurant Email" class="form-control" size="56" maxlength="255" value="<?= set_value("restaurant_email"); ?>">
                </div>
                <button class=" btn btn-secondary text-white prev_btn">Prev</button>
                <button class=" btn btn-primary text-white next_btn">Next</button>
              </div>
              <div class="card-body ">
                <h4>Manager Password</h4>
                <div class="mb-3">
                  <input type="password" placeholder="*******" name="password" class="form-control">
                </div>
                <div class="mb-3">
                  <input type="password" placeholder="*******" name="passconf" class="form-control">
                </div>
                <button class=" btn btn-secondary text-white prev_btn">Prev</button>
                <input name="btn" type="submit" class="btn btn-primary text-white" value="Create Account" />
              </div>
              <!-- <div class="mb-3">
              <button class="btn btn-primary text-white">Next</button>
              <input name="btn" type="submit" class="btn btn-primary" value="Create Account" />
            </div> -->
            </div>
          </form>
        </div>
        <div class="right_hand">
          <div class="card">
            <div class="card_body">
              <div class="content">
                <h4>Growth tool for your restaurant, bar or hotel</h4>
                <p>Waive Menu helps you launch, grow, and scale your restaurant business with the necessary tools to manage resources, increase revenue and efficiency. </p>
                <img src="<?php echo base_url('images') . '/' . 'manageaccountright.png' ?>" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
      <? /*
    <div class="grid_row sign_in mb-5">
      <form action="" method="post">
        <div class="card mb-0 mt-0">
          <div class="card-header">
            <h5>Manager Profile</h5>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="firstname" class="form-label">First Name</label>
              <input type="text" value="<?= set_value("firstname"); ?>" name="firstname" class="form-control" id="firstname">
  </div>
  <div class="mb-3">
    <label for="lastname" class="form-label">Last Name</label>
    <input type="text" value="<?= set_value("lastname"); ?>" name="lastname" class="form-control" id="lastname">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="text" value="<?= set_value("email"); ?>" name="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="phone_number" class="form-label">Contact Number</label>
    <input name="phone_number" id="phone_number" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("phone_number"); ?>">
  </div>
  <!-- <div class="mb-3">
            <label for="address_line1" class="form-label">Address Line</label>
            <input name="address_line1" id="address_line1" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("address_line1"); ?>">
          </div>
					<div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input name="city" id="city" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("city"); ?>"> 
          </div>
					<div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input name="state" id="state" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("state"); ?>"> 
          </div>
					<div class="mb-3">
            <label for="zip" class="form-label">Zip</label>
            <input name="zip" id="zip" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("zip"); ?>">
          </div>
					<div class="mb-3">
            <label for="zip" class="form-label">Country</label>
            <select id="country_id" name="country_id" class="form-control">
							<option value="select">Select Country</option>
							<option value="1">USA</option>
							<option value="2">Canada</option>
							<option value="3">Nigeria</option>
						</select>
          </div> -->
</div>
</div>
<div class="card mb-0 mt-0">
  <div class="card-header">
    <h5>Restaurant Profile</h5>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="name" class="form-label">Restaurant Name</label>
      <input name="name" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("name"); ?>">
    </div>
    <div class="mb-3">
      <label for="slogan" class="form-label">Slogan</label>
      <input name="slogan" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("slogan"); ?>">
    </div>
    <div class="mb-3">
      <label for="slogan" class="form-label">Details</label>
      <input name="details" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("details"); ?>">
    </div>
    <div class="mb-3">
      <label for="restaurant_email" class="form-label">Restaurant Email Address</label>
      <input name="restaurant_email" type="text" class="form-control" size="56" maxlength="255" value="<?= set_value("restaurant_email"); ?>">
    </div>
  </div>
</div>
<div class="card mb-0 mt-0">
  <div class="card-header">
    <h5>Manager Password</h5>
  </div>
  <div class="card-body">
    <div class="mb-3">
      <label for="newpass" class="form-label">New Password</label>
      <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
      <label for="retyppass" class="form-label">Retype Password</label>
      <input type="password" name="passconf" class="form-control">
    </div>
  </div>
</div>
<div class="mb-0 mt-2">
  <input name="btn" type="submit" class="btn btn-primary" value="Create Account" />
</div>
</form>
</div>
*/ ?>
    <?
    } else {
    ?>

      <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
          <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            <strong>Thankyou! for signing up with Waive. Please <a href="javascript:void(null);" onclick="openSign(0);" class="active" style="color:#0033FF">click here</a> to signin</strong>
          </p>
        </div>
      </div>

    <?

    }
    ?>
  </div>
</div>
<?php
$this->load->view("userfront/footer_view");
?>
<script>
  jQuery('.next_btn').click(function(e) {
    e.preventDefault();
    var body = jQuery('.card-body.active');
    jQuery(body).removeClass('active');
    jQuery(body).next().addClass('active');
  });
  jQuery('.prev_btn').click(function(e) {
    e.preventDefault();
    var body = jQuery('.card-body.active');
    jQuery(body).removeClass('active');
    jQuery(body).prev().addClass('active');
  });
</script>