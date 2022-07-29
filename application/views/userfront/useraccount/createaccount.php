<?
// $this->load->view("userfront/header_view");
$this->load->view("userfront/header_view_new");

?>

<div class="main-container pt-3">
  <?
                        if (isset($success["msg"]))
                        {
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
                        if (isset($errors) && count($errors))
                        {
                        ?>
  <br />
  <div class="ui-widget mb-3">
    <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
      <?
                                foreach ($errors as $error)
                                {
                                    echo $error;
                                }
                                ?>

    </div>

  </div>
  <?
                        }
                        ?>
  <?
      if($flag==0)            
			{
			?>
  <div class="grid_row sign_in mb-5">
    <form action="" method="post">
      <div class="card mb-0 mt-0">
        <div class="card-header">
          <h5>Create Profile Name</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name: <span style="color:#FF0000;">*</span></label>
            <input type="text" required value="<?= $userDetail["firstname"] ?>" name="firstname" class="form-control" id="first_name" aria-describedby="emailHelp">
            <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name: <span style="color:#FF0000;">*</span></label>
            <input type="text" required value="<?= $userDetail["lastname"] ?>" name="lastname" class="form-control" id="last_name" aria-describedby="emailHelp">
            <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
        </div>
      </div>
      <div class="card mb-0 mt-0">
        <div class="card-header">
          <h5>Create Email Address</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="new_email_address" class="form-label">Email Address: <span style="color:#FF0000;">*</span></label>
            <input type="email" required value="<?= $userDetail["email"] ?>" name="newemail" class="form-control" id="new_email_address" aria-describedby="emailHelp">
            <!-- <div id="new_email_address" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="phone_number" class="form-label">Mobile Phone: <span style="color:#FF0000;">*</span></label>
            <input type="text" required value="<?= $userDetail["phone_number"] ?>"  name="phone_number" class="form-control" id="phone_number" required>
            <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
        </div>
      </div>
      <div class="card mb-0 mt-0">
        <div class="card-header">
          <h5>Create Password</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label for="newpass" class="form-label">New Password: <span style="color:#FF0000;">*</span></label>
            <input required type="password" name="newpass" class="form-control" id="newpass" aria-describedby="emailHelp">
            <!-- <div id="newpass" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
          <div class="mb-3">
            <label for="retyppass" class="form-label">Retype Password: <span style="color:#FF0000;">*</span></label>
            <input required type="password" name="confpass" class="form-control" id="retyppass" aria-describedby="emailHelp">
            <!-- <div id="first_name" class="form-text">We'll never share your email with anyone else.</div> -->
          </div>
        </div>
      </div>
      <div class="mb-0 mt-2">
        <input name="btn" type="submit" class="btn add-btn" value="Signup" />
      </div>
    </form>
  </div>
  <?
      }else
			{
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
<!-- End Restaurant Account Settings Head -->

<!-- End Error Success Msg -->


<!-- Start Update Account Form Section -->
<?
/*
//			print_r($userDetail);
			if($flag==0)            
			{
			?>
<form action="" method="post">
  <div class="account-form" style="">
    <div class="float-left">
      <h2>Create Profile Name</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
        <tr>
          <td><strong>First Name</strong></td>
        </tr>
        <tr>
          <td>
            <input name="firstname" type="text" class="txt-field" value="<?= $userDetail["firstname"] ?>" />
          </td>
        </tr>
        <tr>
          <td style="padding-top:10px;"><strong>Last Name</strong></td>
        </tr>
        <tr>
          <td><input name="lastname" type="text" class="txt-field" value="<?= $userDetail["lastname"] ?>" /></td>
        </tr>
      </table>
      <h2>Create Email Address</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
        <tr>
          <td style="padding-top:10px;"><strong>New Email Address</strong></td>
        </tr>
        <tr>
          <td><input name="newemail" type="text" class="txt-field" value="<?= $userDetail["email"] ?>" /></td>
        </tr>
        <tr>
          <td style="padding-top:10px;"><strong>Retype Email Address</strong></td>
        </tr>
        <tr>
          <td><input name="confemail" type="text" class="txt-field" /></td>
        </tr>
      </table>
    </div>
    <div class="float-right">
      <h2>Create Password</h2>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
        <tr>
          <td style="padding-top:10px;"><strong>New Password</strong></td>
        </tr>
        <tr>
          <td><input name="newpass" type="password" class="txt-field" /></td>
        </tr>
        <tr>
          <td style="padding-top:10px;"><strong>Retype Password</strong></td>
        </tr>
        <tr>
          <td><input name="confpass" type="password" class="txt-field" /></td>
        </tr>
      </table>
    </div>
    <br class="clear" />
    <div style="width:129px; float:left;">
      <input name="btn" type="submit" class="btn" value="Create Account" />
    </div>
  </div>
</form>
<?
            }else
			{
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
<!-- End Update Account Form Section -->

</div>
</div>

<?
*/
$this->load->view("userfront/footer_view");
?>
