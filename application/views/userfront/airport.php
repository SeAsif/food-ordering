<script>
  var base_url = '<?= base_url() ?>';

  function newAirport() {
    airport = document.getElementById('airport').value;
    email = document.getElementById('email').value;
    $.ajax({
      type: "POST",
      url: base_url + "home/newAirportEmail/",
      data: "email=" + email + "&" + "airport=" + airport,
      success: function(response) {
        if (response == "Thank You for selecting airport!!") {
          alert(response);
          $('#this').dialog("close");
          document.location.href = document.location.href;
        } // end if condition
      } //end function

    });

  }
</script>

<!-- Start Thanx Msg -->
<!--       <br/>
        <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="width:90%; margin-bottom: 20px; padding:10px;"> 
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                <strong>Thanks For Select Airport</strong></p>
            </div>
        </div>
        <br class="clear" /> -->
<!-- End Thanx Msg -->


<form method="post" id="airport_form">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
    <tr>
      <td style="padding-bottom:10px;"><strong>Airport Name:</strong></td>
      <td style="padding-bottom:10px;"><input name="airport" id="airport" type="text" class="signinfld" /></td>
    </tr>
    <tr>
      <td style="padding-bottom:10px;"><strong>Email:</strong></td>
      <td style="padding-bottom:10px;"><input name="email" id="email" type="text" class="signinfld" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <a class="add-btn" href="javascript:void(null);" style="float:left;" onclick="newAirport();">
          Submit
        </a>
      </td>
    </tr>
  </table>
</form>