
<link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css" />

<!--.................Variant Popup..............-->
<script type="text/javascript" src="<?=base_url()?>js/dropdowncontent.js"></script>
<!--.................Variant Popup..............-->

<style type="text/css">

body { background:0px none !important;}

</style>

<div class="order-wrap">
    <h1 style="float:left;">Orders Details</h1>
    <div class="order-menu">
        <a href="#" title="Delivered" class="delivered">Delivered</a>
        <a href="#" title="Sent to process" class="process">Sent to Process</a>
        <a href="#" title="Reject" class="reject" id="searchlink01" rel="subcontent01">Reject</a>
        <!-- Start Popup Window Here -->
        <div id="subcontent01" class="reject-popup">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Why Is Rejected!</strong></td>
              </tr>
              <tr>
                <td style="padding-top:6px;">
                    <textarea name="area" cols="10" rows="10" class="txt-area"></textarea>
                </td>
              </tr>`
              <tr>
                <td style="padding-top:6px;">
                    <input name="btn" type="submit" class="confirm" value="Confirm and Send" />
                </td>
              </tr>
            </table>

        </div>
        <script type="text/javascript">
        dropdowncontent.init("searchlink01", "right-bottom", 500, "onclick")
        </script>
        <!-- End Popup Window Here -->
        
        <a href="#" title="Print" class="print">Print</a>
    </div>
    <div class="order-table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:50%; vertical-align:top;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Order Number:</td>
                    <td><strong>#4464677</strong></td>
                  </tr>
                  <tr>
                    <td>Order By:</td>
                    <td><strong>Mr Franklin</strong></td>
                  </tr>
                  <tr>
                    <td>Order Time:</td>
                    <td><strong>09:00am</strong></td>
                  </tr>
                  <tr>
                    <td>Pickup Time:</td>
                    <td><strong>09:45am</strong></td>
                  </tr>
                </table>
            </td>
            <td style="vertical-align:top;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Order Through:</td>
                    <td><strong>Mob</strong></td>
                  </tr>
                  <tr>
                    <td>Order Type:</td>
                    <td><strong>Take Away</strong></td>
                  </tr>
                  <tr>
                    <td>Total Charged:</td>
                    <td><strong>$55</strong></td>
                  </tr>
                </table>
            </td>
          </tr>
        </table>
    </div>
    <div class="order-item">
        <h1>Orders Item (s)</h1>
        <div class="item-table">
            <div class="item-name">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="width:39%;"><strong>Chicken Chimps</strong></td>
                    <td align="center"><strong>QTY:1</strong></td>
                    <td align="right">
                        <strong>Basic Price:$10 <span class="item-sptr">l</span> Total Price:$12</strong>
                    </td>
                  </tr>
                </table>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="width:50%; vertical-align:top;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td>Served With:</td>
                        <td><strong>Brown Bread</strong></td>
                      </tr>
                      <tr>
                        <td>Served With:</td>
                        <td><strong>Brown Bread</strong></td>
                      </tr>
                      <tr>
                        <td>Extras:</td>
                        <td><strong>Garlic Sauce, Chili Sauce</strong></td>
                      </tr>
                      <tr>
                        <td>Drinks:</td>
                        <td><strong>Strawberry Shake <span class="red-price">($2)</span></strong></td>
                      </tr>
                      <tr>
                        <td>Cooked:</td>
                        <td><strong>Half</strong></td>
                      </tr>
                    </table>
                </td>
                <td style="vertical-align:top;">
                    <strong class="instruction">Instructions</strong><br class="clear" />
                    <p>Nulla sagittis aliquet elit. Nullam vitae elit turpis, id euismod purus. Mauris nunc augue, porttitor ut vulputate ut, porttitor vitae sapien. Mauris sollicitudin luctus turpis eu condimentum.</p>
                </td>
              </tr>
            </table>
        </div>
        <div class="total">
            <div class="float-left">
            <a href="#" title="Sent to process" class="process">Sent to Process</a>
            <a href="#" title="Print" class="print">Print</a>
        </div>
            <div class="table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Sub Total:</td>
                <td style="text-align:right;">$51</td>
              </tr>
              <tr>
                <td>Tax:</td>
                <td style="text-align:right;">$4</td>
              </tr>
              <tr>
                <td>Grand Total:</td>
                <td style="text-align:right;">$55</td>
              </tr>
            </table>
            </div>
        </div>
    </div>
</div>
