<!-- <link href="<?= base_url() ?>css/frontstyle.css" rel="stylesheet" type="text/css" /> -->
<link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
<script src="https://kit.fontawesome.com/92a16d9d6c.js" crossorigin="anonymous"></script>
<style type="text/css">
body {
    background: none !important;
    border: 0px;
}

ui-state-hover {
    background: transparent !important;
    border-color: transparent !important;
}
</style>
<style>
.popcont {
    width: 100% !important;
    overflow: hidden !important;
}

.popcont h4 {
    display: flex;
    justify-content: space-between;
    width: 100%;
    margin: 0 auto !important;
}

.popcont h4 span {
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.56 !important;
    letter-spacing: 0.14px !important;
    text-align: left !important;
    /* color: rgba(0, 0, 0, 0.87) !important; */
}

.popcont h4 strong {
    font-size: 18px !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.28 !important;
    letter-spacing: 0.32px !important;
    text-align: left !important;
    /* color: #000000 !important; */
}

.popcont p,
.popcont .extraCont .extraWrap h1,
.popcont .extraCont .extraWrap .extraItem .multi {
    font-size: 14px !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: normal !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.29 !important;
    letter-spacing: 0.25px !important;
    text-align: left !important;
    /* color: rgba(0, 0, 0, 0.6) !important; */
}

.itemTxtarea {
    display: inline-block;
    width: 95%;
    margin: 0 auto !important;
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

.pricequanity {
    display: flex;
    width: 95%;
    margin: 0 auto !important;
    clear: both;
    justify-content: space-between;
    margin: 0 auto;
}

.pricequanity .price {
    margin: 0 !important;
    font-size: 24px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 0.96 !important;
    letter-spacing: 0.43px !important;
    text-align: left !important;
    color: #37b8ac !important;
    padding-top: 5px;
}

.amount {
    margin: 0 !important;
    font-size: 24px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 0.96 !important;
    letter-spacing: 0.43px !important;
    text-align: left !important;
    color: #37b8ac !important;
}

.pricequanity .price small {
    font-size: 14px !important;
    font-weight: normal !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.29 !important;
    letter-spacing: 0.25px !important;
    text-align: left !important;
    /* color: rgba(0, 0, 0, 0.6) !important; */
}

.pricequanity .itemTxtfield,
.pricequanity .itemTxtfield:focus,
.pricequanity .itemTxtfield:hover {
    font-size: 16px !important;
    font-weight: normal !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.44 !important;
    letter-spacing: 0.29px !important;
    text-align: left !important;
    height: 29px !important;
    padding: 0 !important;
    width: 40px !important;
    text-align: center !important;
    border: none !important;
    outline: none !important;

    /* color: rgba(0, 0, 0, 0.6) !important; */
}

.pricequanity .input-group.mb-3 span {
    /* color: white !important; */
    display: inline-flex;
    width: 28px;
    font-size: 19px;
    text-align: center;
    cursor: pointer !important;
    align-items: center;
    justify-content: center;
}

.pricequanity .input-group.mb-3 {
    border-radius: 15px;
    /* background-color: #37b8ac; */
    padding: 0px;
}


.popcont .add-btn {
    border-radius: 19px !important;
    width: 100% !important;
    margin: 0 auto;
    text-align: center !important;
    border-color: transparent !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.75 !important;
    letter-spacing: 0.12px !important;
}

.ui-widget-header {
    background: white !important;
    border-color: white !important;
}

.ui-widget-content {
    background: white !important;
}

.ui-dialog .ui-dialog-content {
    overflow: hidden !important;
}

.view_order_detail {
    border-radius: 19px !important;
    /* background-color: #37b8ac !important; */
    width: 100% !important;
    margin: 0 auto;
    text-align: center !important;
    border-color: transparent !important;
    /* color: white !important; */
    font-size: 16px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.75 !important;
    letter-spacing: 0.12px !important;
    padding: 4px 0px;
    display: block;
}
</style>

<style>
* {}

ui-state-hover {
    background: transparent !important;
    border-color: transparent !important;
}

.modal-title a {
    font-size: 12px !important;
    text-decoration: none !important;
}

.modal-body .qty-wrap,
.modal-body .qty,
.modal-body .item-name,
.modal-body .item-price {
    font-size: 16px;
    font-weight: 500;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.56;
    letter-spacing: 0.14px;
    text-align: left;
    color: rgba(0, 0, 0, 0.87);
}

.order_detail_ {
    font-family: 'Roboto', sans-serif !important;
    padding: 15px 0px;
    border-bottom: 1px solid #c8c8c8;
    margin-bottom: 10px;
    position: relative;
    width: 100% !important;
}

span.cart-arrow {
    font-family: 'Roboto', sans-serif !important;
    position: absolute;
    right: 0px;
    top: 20%;
    /* background-color: #37b8ac; */
    min-width: 104px;
    border-radius: 50px;
    text-align: center;
    display: flex;
    align-items: center;
}

span.cart-arrow span.cart-num {
    font-size: 16px !important;
    background: white;
    font-family: 'Roboto', sans-serif !important;
    min-width: 40px;
    display: inline-flex;
    min-height: 29px;
    align-items: center;
    cursor: pointer;
    justify-content: center;
}

span.cart-arrow span:first-child,
span.cart-arrow span:last-child {
    /* color: white; */
    font-size: 26px;
    font-family: 'Roboto', sans-serif !important;
    cursor: pointer;
    width: 30px;
    display: inline-flex;
    max-height: 29px;
    align-items: center;
    justify-content: center;
}

.order_detail_ .order_detail_Name {
    font-size: 18px !important;
    font-weight: 800;
    font-stretch: normal;
    font-family: 'Roboto', sans-serif !important;
    font-style: normal;
    line-height: 1.16;
    letter-spacing: 0.14px;
    text-align: left;
    color: rgba(0, 0, 0, 0.87);
}

.order_detail_ .order_detail_Name small {
    display: block;
    font-size: 14px !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: 500;
    font-stretch: normal;
    font-style: normal;
    line-height: 1;
    letter-spacing: 0.32px;
    text-align: left;
    /* color: rgba(0, 0, 0, 0.6) !important; */
}

.orderForm h3 {
    margin-bottom: 0px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500;
    padding: 15px 0px;
    border-bottom: 1px solid #c8c8c8;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.56;
    letter-spacing: 0.14px;
    text-align: left;
    position: relative;
    color: rgba(0, 0, 0, 0.87);
}

.modal-body p {
    margin-bottom: 0px;
    font-family: 'Roboto', sans-serif !important;
    font-size: 18px !important;
    font-weight: 500;
    padding: 15px 0px;
    border-bottom: 1px solid #c8c8c8;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.56;
    letter-spacing: 0.14px;
    text-align: left;
    position: relative;
    color: rgba(0, 0, 0, 0.87);
}

.modal-body p strong {
    font-size: 18px;
    font-family: 'Roboto', sans-serif !important;
    float: right;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.28;
    letter-spacing: 0.32px;
    text-align: left;
    /* color: rgba(0, 0, 0, 0.6); */
}

.modal-body p.checkout_btn {
    position: relative;
}

.modal-body p.checkout_btn i {
    position: absolute;
    left: 30% !important;
    top: 15px !important;
    right: unset !important;
}

.order_type {
    font-size: 18px !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.28;
    letter-spacing: 0.32px;
    text-align: left;
    color: rgba(0, 0, 0, 0.6);
}

.add-btn {
    border-radius: 19px !important;
    /* background-color: #37b8ac !important; */
    width: 100% !important;
    margin: 0 auto;
    text-align: center !important;
    border-color: transparent !important;
    /* color: white !important; */
    font-size: 16px !important;
    font-weight: 500 !important;
    font-stretch: normal !important;
    font-style: normal !important;
    line-height: 1.75 !important;
    letter-spacing: 0.12px !important;
}

.clear_cart {
    display: block;
    text-decoration: none;
    padding-bottom: 4px;
    padding-top: 3px;
}

.order_total_info {
    margin-bottom: 0px;
    font-size: 18px !important;
    font-family: 'Roboto', sans-serif !important;
    font-weight: 500;
    padding: 15px 0px;
    border-bottom: 1px solid #c8c8c8;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.56;
    letter-spacing: 0.14px;
    text-align: left;
    position: relative;
    /* color: rgba(0, 0, 0, 0.87); */
}

.order_total_info strong {
    font-size: 18px !important;
    font-family: 'Roboto', sans-serif !important;
    float: right;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.28;
    letter-spacing: 0.32px;
    text-align: left;
    /* color: rgba(0, 0, 0, 0.6); */
}

.cross-icon-adj {
    font-size: 12px;
}
</style>
<!-- theme color style goes here -->
<?
	   //$this->load->view("userfront/themeColor");
    if(!empty($restaurant_theme_settings)){ 
        $theme_settings = json_decode($restaurant_theme_settings,true);

    }else{
        $theme_settings = json_decode('{"theme":"default","topBarBgColor":"#35ada2","topBarTextColor":"#000000","resturantInfoBarBgColor":"#fcfcfc","resturantInfoBarTextColor":"#605f5e","moreInfoTextColor":"#35ada2","menuSliderBgColor":"#ffffff","mainMenuBackgroundColor":"#ffffff","mainHeadingTextColor":"#212121","lineColor":"#37b8ac","menuHeadingpriceTextColor":"#212121","menuSubHeadingTextColor":"#666666","primaryButtonBackgroundColor":"#37b8ac","primaryButtonTextColor":"#fff","secondaryButtonBackgroundColor":"#f36737","secondaryButtonTextColor":"#FFFFFF","textInputColor":"#341d1d"}',true);
    }
?>
<style>
    .top-bar-bg-color {
        background: <?=$theme_settings['topBarBgColor'] ?> !important;
    }

    .top-bar-txt-color {
        color: <?=$theme_settings['topBarTextColor'] ?> !important;
    }

    .signout-icon-adj {
        color: white;
        font-size: 30px;
        position: absolute;
        right: 3px;
        top: 18px;
    }

    .resturant-info-bar-background {
        background-color: <?=$theme_settings['resturantInfoBarBgColor'] ?> !important;
    }

    .returantinfo-heading-color {
        color: <?=$theme_settings['resturantInfoBarTextColor'] ?> !important;
    }

    .more-info-txt-color {
        color: <?=$theme_settings['moreInfoTextColor'] ?> !important;
    }

    .main-menu-bg-color {
        background-color: <?=$theme_settings['mainMenuBackgroundColor'] ?> !important;
    }

    /* 2nd level css */
    .menu-heading {
        color: <?=$theme_settings['menuHeadingpriceTextColor'] ?> !important;
    }

    /* 3rd level css */
    .menu-sub-heading {
        color: <?=$theme_settings['menuSubHeadingTextColor'] ?> !important;
    }

    .primary-btn-bg-color {
        background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
    }

    .primary-btn-text-color {
        color: <?=$theme_settings['primaryButtonTextColor'] ?> !important;
    }

    /* 1st level css */
    .category-text-color {
        color: <?=$theme_settings['mainHeadingTextColor'] ?> !important;
    }

    .secondary-btn-color {
        background-color: <?=$theme_settings['secondaryButtonBackgroundColor'] ?> !important;
        color: <?=$theme_settings['secondaryButtonTextColor'] ?> !important;
    }

    .food .heading:after {
        background-color: <?=$theme_settings['lineColor'] ?> !important;
    }

    .modal-header,
    .cart-item,
    .bordered_row,
    .main-form,
    .card-header {
        border-bottom: 1px solid <?=$theme_settings['lineColor'] ?> !important;
    }

    .slider-bg-color {
        background-color: <?=$theme_settings['menuSliderBgColor'] ?> !important;
    }

    .text-input-color {
        color: black !important;
    }

    /* Radio buttons css */
    input[type='radio']:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -5px;
        left: -4px;
        position: relative;

        background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -5px;
        left: -4px;
        position: relative;
        background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?>;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    /* Checkox CSS */
    /* The checkbox-container */
    .checkbox-container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 17px;
        width: 17px;
        background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
    }

    /* On mouse-over, add a grey background color */
    .checkbox-container:hover input~.checkmark {
        background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
    }

    /* When the checkbox is checked, add a blue background */
    .checkbox-container input:checked~.checkmark {
        background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?>;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .checkbox-container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .checkbox-container .checkmark:after {
        left: 5px;
        top: 2px;
        width: 4px;
        height: 7px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .form-order-details td,
    .form-order-details span,
    .form-order-details strong {
        color: <?=$theme_settings['menuHeadingpriceTextColor'] ?> !important;
    }

    .ui-state-highlight,
    .ui-widget-content .ui-state-highlight,
    .ui-widget-header .ui-state-highlight {
        border: 1px solid <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
        background: <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
        color: #363636;
    }
</style>
<!-- end of theme color style goes here -->
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/frontfunctions.js"></script>

<script language="javascript">
var single_varaint_price = 0;
var multi_varaints_price = 0;
var item_quantity = 1;
var item_price = '<?php echo $item["item_price"]; ?>';
<?php
	if (isset($success["msg"])) {
	?>
var successMgs = '<?= $success["msg"] ?>';

<?php
	} else {
	?>
var successMgs = '';

<?php
	}
	?>
var base_url = "<?= base_url() ?>";
// if (successMgs != "") {
// 	var objRef = parent.window;
// 	objRef.refreshItemPage(successMgs);


// }

function submitForm() {
    document.forms.frmAddItem.submit();
    parent.closeOrderPickup();
}

function validateRestaurant(prev_name, new_name) {
    //	forgotPass	=	nPassId;
    //	PassId	=	id;
    //	document.getElementById('newrestaurant').value=new_name;
    //	document.getElementById('prevrestaurant').value=prev_name;
    $('#newrestaurant').html(new_name);
    $('#prevrestaurant').html(prev_name);

    $('#validation').dialog('open');
    return false;
}

function openSign(nSignId) {
    signId = nSignId;
    $('#signin-message').dialog('open');
    return false;
}

$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#signin-message').dialog({
        autoOpen: false,
        modal: true,
        width: 560
    });

});

function addItemToFavorites(restaurantId, itemId, userId) {
    $.ajax({
        type: "POST",
        url: base_url + "irestaurant/addFavoriteItem",
        data: "restaurant_id=" + restaurantId + "&" + "item_id=" + itemId + "&" + "user_id=" + userId + "",
        success: function(addFavoriteRestaurant) {
            //alert(addFavoriteRestaurant);
            var status = "";
            var obj = jQuery.parseJSON(addFavoriteRestaurant);
            $.each(obj, function() {

                status = obj.response;
                favid = obj.insert_id;


            });

            if (status == "RECORD_ADDED") {

                //$("#rating-add-fav").remove();
                $("#rating-add-fav").html(
                    '<a href="javascript:void(null);"  onclick="removeItemFavorites(' + favid + ',' +
                    itemId + ',' + restaurantId + ',' + userId +
                    ')" class="itemfav">Remove From Fav</a>');
            } else {
                openSign(0);
            }
        } //end function
    });
}

function removeItemFavorites(favId, itemId, restaurantId, userId) {
    $.ajax({
        type: "POST",
        url: base_url + "irestaurant/delFavoriteItem/" + favId,
        data: "",
        success: function(removeItemFavorites) {
            //alert(addFavoriteRestaurant);
            var status = "";
            var obj = jQuery.parseJSON(removeItemFavorites);
            $.each(obj, function() {
                status = obj.response;

            });

            if (status == "RECORD_DELETED") {
                //$("#rating-add-fav").remove();
                $("#rating-add-fav").html(
                    '<a href="javascript:void(null);" class="itemfav" onclick="addItemToFavorites(' +
                    restaurantId + ',' + itemId + ',' + userId + ')">Add to Favorites</a>');
            } else {

            }
        } //end function
    });

}
</script>
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#validation').dialog({
        autoOpen: false,
        modal: true,
        width: 426,

        buttons: {
            "OK": function() {
                //$(this).dialog("close");
                //var id=$("#resturant_id").val();
                //$("#variant").val(Variant);
                $.ajax({
                    type: "POST",
                    url: base_url + "irestaurant/resetShoppingCart",
                    success: function(response) {
                        //	if(response=='RECORD_DELETED')
                        //	{
                        //	alert(response);	
                        document.forms.frmAddItem.submit();
                        $('#validation').dialog('close');
                        //	alert(response);

                        //	document.location.href=document.location.href;

                        //	}
                        //	else{
                        //	alert(response);
                        //		$('#validation').dialog('close');

                        //	}
                    }

                });

            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }

    });

});

$(document).bind('change', '.single_variant_price', function() {
    var total = 0;

    $(".single_variant_price:checked").each(function() {
        total += parseInt($(this).attr('price'));
    });

    $('#cart_amount').text((item_price * item_quantity) + (total * item_quantity) + (multi_varaints_price *
        item_quantity));
    single_varaint_price = total;
});


$(document).bind('change', '.multi_variant_price', function() {

    var total = 0;
    $('input:checkbox:checked').each(function() { // iterate through each checked element.
        total += isNaN(parseInt($(this).attr('price'))) ? 0 : parseInt($(this).attr('price'));
    });

    $('#cart_amount').text((item_price * item_quantity) + (total * item_quantity) + (single_varaint_price *
        item_quantity));
    multi_varaints_price = total;
});

function Decrement() {
    var count = $('input[name="quantity"]').val();
    count = parseInt(count);
    if (count > 1)
        count = count - 1;

    $('input[name="quantity"]').val(count);
    var new_amount = (item_price * count) + (single_varaint_price * count) + (multi_varaints_price * count);
    $('#cart_amount').text('₦ ' + new_amount.toFixed(2));
    item_quantity = count;
}

function Increment() {
    var count = $('input[name="quantity"]').val();
    count = parseInt(count);
    count = count + 1;

    $('input[name="quantity"]').val(count);
    var new_amount = (item_price * count) + (single_varaint_price * count) + (multi_varaints_price * count);
    $('#cart_amount').text('₦ ' + new_amount.toFixed(2));
    item_quantity = count;
}

function showItemToOrder() {
    $('#item_info').show();
    $('#view_order_detail').hide();
    return false;
}

function closeAddtoCartDialog() {
    var objRef = parent.window;
    objRef.refreshItemPage(successMgs);
    return false;
}

function closeAddtoCartCheckout() {
    var objRef = parent.window;
    objRef.proceedToCheckout();
    return false;
}

function showOrderDetail() {
    $('#item_info').hide();
    $('#view_order_detail').show();
    return false;
}
</script>
<!-- Start Forgot passwrod process Window Here -->

<div id="validation" title="Verification" style="display:none;">
    <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
                Are you sure you want to add items from <span id="newrestaurant"></span> restaurant?
                <strong> This operation will reset your cart from <span id="prevrestaurant"></span> restaurant.
                </strong>
            </td>
        </tr>
        <tr>
            <td>
                <!--   <input type="text" value="" name="restaurantId" id="emailAddress" style="width:200px; padding:3px;" class="txt-field01"> 
            <input type="text" name="newrestaurant" id="newrestaurant">
            <input type="text" name="prevrestaurant" id="prevrestaurant"> -->
            </td>
        </tr>
    </table>
</div>
<!-- End Forgot passwrod process Window Here -->



<? if( $this->session->userdata('id')== "") { ?>
<!-- Start Signin Popup Window Here -->
<div id="signin-message" title="Signin" style="display:none;">
    <?
	        $this->load->view("userfront/signin");
	    ?>
</div>
<? } ?>

<?
	//	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
	$attributes = array('id' => 'frmAddItem','name' => 'frmAddItem');
	echo form_open(base_url().'userrestaurant/addtocart/'.$item["id"],$attributes);
?>
<div class="add-item">
    <div class="popcont">
        <? if (isset($success["msg"])) { ?>
        <div class="ui-widget">

            <div class="ui-corner-all primary-btn-bg-color" style="width: 100%;margin-bottom: 20px;padding: 1px 10px;">
                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                    <strong class="primary-btn-text-color"><?= $success["msg"] ?></strong>
                </p>
            </div>
        </div>
        <? } ?>
        <? if (isset($errors) && count($errors)) { ?>
        <br />
        <div class="ui-widget">
            <div class="ui-state-error ui-corner-all primary-btn-text-color"
                style="width:90%; margin-bottom:20px; padding:5px;">
                <? 
						foreach ($errors as $error)	{
		                	echo $error;
		            	}
	            	?>
            </div>
        </div>
        <? } ?>
        <div id="item_info" style="<?= isset($success["msg"]) ? 'display:none' : '' ?>">
            <div style="text-align: center;margin-bottom:15px;">
                <?php if (isset($item["item_image"]) && !empty($item["item_image"])) { ?>
                <img style="max-width:100%"
                    src="<?= base_url() . "uploads/restaurant/menuItems/" . $item["item_image"]; ?>">
                <?php } else { ?>
                <img style="max-width:100%" src="<?= base_url() ?>/images/fooditem.png">
                <?php } ?>
            </div>
            <h4>
                <span class="menu-heading"><?= $item["item_name"] ?></span>
                <strong class="menu-heading"> ₦<span id="item_amount"><?= $item["item_price"] ?></span></strong>
            </h4>
            <p class="menu-sub-heading"><?= $item["item_description"] ?></p>
            <div class="extraCont">
                <?
					$variantCount	=	0;
	        		foreach ($itemdetail as $itemdet) {
						$data["GroupDetail"]	=	$itemdet["GroupDetail"];	
						$data["VariantNumber"]	=	$variantCount;	
				
						if ($itemdet["GroupDetail"]["selection"]	==	"slider")
						{
							$this->load->view('userfront/userrestaurant/varaint/slider',$data);
						
						}
						else if ($itemdet["GroupDetail"]["selection"]	==	"multiple")
						{
							$this->load->view('userfront/userrestaurant/varaint/multiple',$data);
						}
						else if ($itemdet["GroupDetail"]["selection"]	==	"single")
						{
							$this->load->view('userfront/userrestaurant/varaint/single',$data);
						}
				
						$variantCount++;
			
	        		}
				?>

                <input type="hidden" value="<?= count($itemdetail) ?>" name="variantcount" />
                <div class="extraWrap">
                    <h1 class="menu-sub-heading">Special Instructions <span class="font11 menu-sub-heading">(may not
                            apply if requires extra cost)</span></h1>
                    <textarea name="instructions" cols="2" rows="2" class="itemTxtarea text-input-color"></textarea>
                </div>
            </div>
            <div class="pricequanity" style="margin-bottom: 15px !important; padding-top: 8px;">
                <p class="price">
                    <?php if (isset($cartPrice)) { ?>
                    <span class="menu-heading" id="cart_amount"> ₦ <?= $cartPrice ?></span>
                    <?php } else { ?>
                    <span class="menu-heading" id="cart_amount"> ₦ <?= $item["item_price"] ?></span>
                    <?php } ?>

                    <small class="menu-heading">Total</small>
                </p>
                <div class="input-group mb-3">
                    <span class="input-group-text primary-btn-bg-color primary-btn-text-color"
                        onclick="Decrement()">-</span>
                    <input name="quantity" type="text" class="itemTxtfield text-input-color" value="1" />
                    <span class="input-group-text primary-btn-bg-color primary-btn-text-color"
                        onclick="Increment()">+</span>
                </div>
            </div>
            <div class="extraWrap"
                style="padding-top: 15px;border-top:1px solid	#e6e6e6;margin-right:0px !important;width:100%;">
                <table width="96%" style="padding-top: 15px;margin-right:0px !important;width:100%;" border="0"
                    cellspacing="0" cellpadding="0">
                    <tr>
                        <?
							$arrSearchCriteria	=	$this->session->userdata('search_criteria');
							$restaurantId = $this->session->userdata('restaurantID');
                            $broadcaster = $this->session->userdata('broadcaster');
                            $broadcaster_start=$broadcaster->start_date??null;
                            $broadcaster_end=$broadcaster->end_date??null;
                            $current_date=date("Y-m-d");
	            			if ($restaurantId != $item["restaurant_id"] && $restaurantId != "") {
						?>
                        <a class="add-btn primary-btn-bg-color primary-btn-text-color" href="javascript:void(null);"
                            onclick="validateRestaurant('<?= $restaurant_name_prev ?>' , '<?= $restaurant_name ?>');"><i
                                class="fas fa-shopping-cart primary-btn-text-color" style="margin-right:10px;"></i> Add
                            to Cart</a>
                        <? } else { ?>


                            <? if($broadcaster_start<=$current_date && $broadcaster_end>=$current_date){?>
                                <button  class="add-btn primary-btn-bg-color primary-btn-text-color"
                               style="cursor: not-allowed;pointer-events: all !important;" disabled ><i class="fas fa-shopping-cart"
                                style="margin-right:10px;"></i>Add to Cart</button>

                        <? }else{?>
                            <button type="submit" class="add-btn primary-btn-bg-color primary-btn-text-color"
                            href="javascript:void(null);"><i class="fas fa-shopping-cart"
                                style="margin-right:10px;"></i> Add to Cart</button>

                       <? }} ?>
                        <br class="clear" />
                        <div id="rating-add-fav">
                            <?
					            if( $this->session->userdata('id'))
								{
									
									$return	=	array_search($item["id"],$favItemIDs);
									
									if(gettype ($return)	==	"integer") {
							?>
                            <!-- <a href="javascript:void(null);" onclick="removeItemFavorites(<?= $favIDs[$return] ?>,<?= $item["restaurant_id"] ?>,<?= $item["id"] ?>,<?= $userId ?>);" class="itemfav">Remove From Fav</a> -->

                            <?
									}else{
							?>

                            <!-- <a href="javascript:void(null);" onclick="addItemToFavorites(<?= $item["restaurant_id"] ?>,<?= $item["id"] ?>,<?= $userId ?>);" class="itemfav">Add To Favorites</a> -->
                            <?
	                            	}
								} else {
							?>
                            <!-- <a href="javascript:void(null);" onclick="openSign(0);" class="itemfav">Add To Favorites</a> -->
                            <?
								}	
							?>
                        </div>
                        </td>
                        <td>
                            <? if(isset($cartItems) && count($cartItems) > 0) {?>
                            <a class="view_order_detail add-btn secondary-btn-color" href="javascript:void(null);"
                                onclick="showOrderDetail()" style="margin-top: 10px;"><i class="fas fa-eye"
                                    style="margin-right:10px;"></i> View Order</a>
                            <? } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div id="view_order_detail" style="<?= isset($success["msg"]) ? 'display:block' : 'display:none' ?>">
            <? if (isset($cartItems) && count($cartItems) > 0) {
				$grandTotal	=	0;
				$totalCityTax = 0;
				$totalStateTax = 0;
				foreach ($cartItems as $cartItem) {
			?>
            <div class="order_detail_">
                <? $english_format_number = number_format($cartItem["totalprice"], 2, '.', '');?>
                <span class="order_detail_Name font11 menu-heading" id="set2">
                    <?= substr($cartItem["item_name"], 0, 13) ?>
                    <span class="order_detail_Del">
                        <a href="javascript:void(null);" onclick="deleteItem(<?= $cartItem["id"] ?>);"
                            title="Delete Item"><i class="fas fa-times menu-heading cross-icon-adj"></i></a>
                    </span>
                    <small class="menu-heading">₦<span
                            id="<?= $cartItem["id"] ?>_total_price"><?= $english_format_number ?></span></small>
                </span>
                <span class="cart-arrow">
                    <span class="primary-btn-bg-color primary-btn-text-color" href="javascript:void(null);"
                        onclick="decreaseQuantity(<?= $cartItem["id"] ?>);">-</span>
                    <span id="<?= $cartItem["id"] ?>_dec_inc"
                        class="cart-num font11 text-input-color"><?= $cartItem["quantity"] ?></span>
                    <span class="primary-btn-bg-color primary-btn-text-color" href="javascript:void(null);"
                        onclick="increaseQuantity(<?= $cartItem["id"] ?>);">+</span>
                </span>
            </div>
            <?
								
					$totalCityTax = $totalCityTax + $cartItem["city_tax"];
					$totalStateTax = $totalStateTax + $cartItem["state_tax"];
					$grandTotal	=	$grandTotal+$cartItem["totalpricewithtax"];
				}
			?>

            <? $english_format_number = number_format($totalCityTax, 2, '.', '');?>
            <p class="order_total_info menu-heading" style="font-size: 18px !important; font-weight: 500 !important;">
                Total City Tax: <strong>₦<span id="dis_city_tax"><?= $english_format_number ?></span></strong></p>

            <? $english_format_number = number_format($totalStateTax, 2, '.', '');?>
            <p class="order_total_info menu-heading" style="font-size: 18px !important; font-weight: 500 !important;">
                Total State Tax: <strong>₦<span id="dis_state_tax"><?= $english_format_number ?></span></strong></p>

            <? $english_format_number = number_format($grandTotal, 2, '.', '');?>
            <p class="order_total_info menu-heading" style="font-size: 18px !important; font-weight: 500 !important;">
                Total: <strong>₦<span id="dis_Total"><?= $english_format_number ?></span></strong></p>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="padding-top:25px;">
                        <a class="view_order_detail primary-btn-text-color primary-btn-bg-color"
                            href="javascript:void(null);" onclick="closeAddtoCartDialog()" style="margin-top: 10px;">
                            Continue Shopping</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top:25px;">
                        <a class="view_order_detail primary-btn-bg-color secondary-btn-color"
                            href="javascript:void(null);" onclick="closeAddtoCartCheckout()"
                            style="margin-top: 10px;"><i class="fas fa-shopping-cart primary-btn-text-color"
                                style="margin-right:10px;" aria-hidden="true"></i> Checkout</a>
                    </td>
                </tr>
            </table>
            <? } ?>
        </div>

    </div>
</div>
</form>
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
    <tr>
        <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
    </tr>
</table>