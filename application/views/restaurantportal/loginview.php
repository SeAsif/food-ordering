<?
$this->load->view("restaurantportal/header_view");
echo form_open(base_url().'restaurantportal');
?>
<style>
  .login-page-wrap {
    width: 100%;
  }

  .grid_row {
    display: block;
  }
</style>





<script language="javascript">
  var base_url = '<?= base_url(); ?>';

  function forgotPassword(nPassId) {
    forgotPass = nPassId;
    PassId = nPassId;

    //$('#forgot_pass').dialog('open');
    return false;
  }

  var base_url = '<?= base_url(); ?>';

  function forgotMsg(nPassId) {
    forgotMsg = nPassId;
    $('#forgot_msg').dialog('open');
    return false;
  }

  var base_url = '<?= base_url(); ?>';

  function forgotMsgFail(nPassId) {
    forgotMsgFail = nPassId;
    $('#forgot_msg_fail').dialog('open');
    return false;
  }
</script>


<!-- Start Dialog Popups -->
<script type="text/javascript">
  $(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#forgot_pass').dialog({
      autoOpen: false,
      modal: true,
      width: 300,

      buttons: {
        "Submit": function() {
          //$(this).dialog("close"); 
          var Email = $("#emailAddress").val();
          //$("#variant").val(Variant);
          $.ajax({
            type: "POST",
            url: base_url + "restaurantportal/verifyEmail/",
            data: "varia=" + Email,
            success: function(response) {
              if (response == 'Email_Sent') {
                $('#forgot_msg').dialog('open');
                //	alert(response);

                //	document.location.href=document.location.href;

              } else
                $('#forgot_msg_fail').dialog('open');
              //	alert(response);
            }

          });

        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }

    });

  });

  $(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#forgot_msg').dialog({
      autoOpen: false,
      modal: true,
      width: 300,

      buttons: {
        "Ok": function() {
          $('#forgot_pass').dialog("close");
          $(this).dialog("close");
        }
      }

    });

  });

  $(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#forgot_msg_fail').dialog({
      autoOpen: false,
      modal: true,
      width: 300,

      buttons: {
        "Ok": function() {
          $(this).dialog("close");
        }
      }

    });

  });
</script>
<!-- End Dialog Popups -->

<style>
  input.txt-field,
  input.form-control,
  .txtarea,
  .custom-select {
    display: inline-block;
    width: 120% !important;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }

  td
  {
    font-size:16px !important;
  }
  #footer-wrap a {
    font-size: 16px !important;
    background-color: transparent !important;
    color: #212529 !important;
  }
a
{
  color: #f36737 !important;
}
  input[type="submit"]{
    background: none !important;
    border-color: transparent !important;
    color: white !important;
    outline: none !important;
    min-height: 20px !important;
    font-size: 18px !important;
    min-width: 30px !important;
    margin: 5px 0px !important;
    background-color: #f36737 !important;
  }
</style>

<div class="text-center">
  <img style="width: 100px;margin-top:50px;margin-bottom:30px" src="<?= base_url() . 'images/new_logo.png'; ?>" srcset="<?= base_url() . 'images/new_logo@2x.png'; ?>" class="img-fluid " alt="">
</div>

<!-- Start Forgot passwrod process Window Here -->
<div id="forgot_pass" title="Forgot Password" style="display:none;">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
        Email Address
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" value="" name="emailAddress" id="emailAddress" style="width:200px; padding:3px;" class="txt-field01">
        <input type="hidden" value="yes" name="add">
      </td>
    </tr>
  </table>
</div>
<!-- End Forgot passwrod process Window Here -->

<!-- Start Forgot passwrod Email Msg -->
<div id="forgot_msg" title="Forgot Password" style="display:none;">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
        <strong>Please See Your Email Address security code has been sent to you. Thank You!!</strong>
      </td>
    </tr>
  </table>
</div>
<!-- End Forgot passwrod Email Msg -->

<!-- Start Forgot passwrod Email Not Sent Msg -->
<div id="forgot_msg_fail" title="Forgot Password" style="display:none;">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
        <strong>Email Not Sent</strong>
      </td>
    </tr>
  </table>
</div>
<!-- End Forgot passwrod Email Not Sent Msg -->

<!-- Start Mid Right -->
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table" s>
        <tr>
          <td valign="top"></td>
        </tr>
        <tr>
          <td valign="top" style="padding-top:30px;">

            <div class="login-page-wrap">
              <TABLE WIDTH=330 BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
                <TR>
                  <TD COLSPAN=4 WIDTH=272 HEIGHT=42></TD>
                </TR>
                <TR>
                  <TD WIDTH=111 HEIGHT=21>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>Username:</td>
                      </tr>
                    </table>
                  </TD>
                  <TD WIDTH=125 HEIGHT=21 COLSPAN=2>
                    <input name="email" type="text" class="txt-field" size="17" value="">
                  </TD>
                  <TD WIDTH=36 HEIGHT=21></TD>
                </TR>
                <TR>
                  <TD COLSPAN=4 WIDTH=272 HEIGHT=8> </TD>
                </TR>
                <TR>
                  <TD WIDTH=111 HEIGHT=21>
                    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>Password:</td>
                      </tr>
                    </table>
                  </TD>
                  <TD WIDTH=125 HEIGHT=21 COLSPAN=2>
                    <input name="password" type="password" class="txt-field" size="17" value="">
                  </TD>
                  <TD WIDTH=36 HEIGHT=21></TD>
                </TR>
                <TR>
                  <TD COLSPAN=4 WIDTH=272 HEIGHT=15></TD>
                </TR>
                <TR>
                  <TD COLSPAN=2 WIDTH=150 HEIGHT=21> </TD>
                  <TD>
                    <input type="submit" name="Submit" class="btn" value="Submit">
                    <a href="javascript:void(null);" onclick="forgotPassword(0);" class="btn">Forgot Password?</a>
                  </TD>
                  <TD WIDTH=36 HEIGHT=21></TD>
                </TR>
                <TR>
                  <TD COLSPAN=4 WIDTH=272 HEIGHT=42 class="err" align="center">
                    <?
                     if(isset($errors))  	
                     {
                       if (isset($errors) && count($errors) > 0)
                       {
                           foreach ($errors as $error)
                           {
                            echo $error;
                           }
                       }
                     } 
                        ?>
                  </TD>
                </TR>
              </TABLE>
            </div>

          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- End Mid Right -->
</form>
<?
$this->load->view("restaurantportal/footer_view");
?>
