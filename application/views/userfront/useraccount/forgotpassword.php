<?
$this->load->view("userfront/header_view");
?>
    <div class="cont-wrap">
        <div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        <div class="rest-mid">

        <!-- Start Restaurant Head -->
            <div class="account-hed">
                <h1>Reset Password</h1>
            </div>
        <!-- End Restaurant Head -->
            <br class="clear" />
              <div class="contentPage">
                    <div class="contactForm">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td style="padding-bottom:3px; width:30%;"><strong>Email Address:</strong></td>
                            <td>
                                <input name="fld" type="text" class="itemTxtfield" style="padding:3px; width:250px;" />
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-bottom:3px;"><strong>Password:</strong></td>
                            <td>
                                <input name="fld" type="password" class="itemTxtfield" style="padding:3px; width:250px;" />
                            </td>
                          </tr>
                          <tr>
                            <td style="padding-bottom:3px;"><strong>Retype Password:</strong></td>
                            <td>
                                <input name="fld" type="password" class="itemTxtfield" style="padding:3px; width:250px;" />
                            </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>
                                <input name="BTN" type="button" class="add-btn float-left" value="Submit" style="margin-right:10px;" />
                                <input name="BTN" type="button" class="add-btn float-left" value="Cancel" />
                            </td>
                          </tr>
                        </table>
                    </div>
              </div>

        </div>
        <div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
    </div>
<?
$this->load->view("userfront/footer_view");
?>