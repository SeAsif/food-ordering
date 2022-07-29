<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Restaurant Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url() ?>css/style.css?v=1" rel="stylesheet" type="text/css" />
    <!--.................menu..............-->
    <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/ddaccordion.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/menu.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>css/menu.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!--.................menu..............-->
    <!--.................Variant Popup..............-->
    <script type="text/javascript" src="<?= base_url() ?>js/dropdowncontent.js"></script>
    <!--.................Variant Popup..............-->
    <!--................. Start Jquery Ui ..............-->
    <link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>
    <script src="<?= base_url() ?>assets/alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/alertifyjs/css/themes/default.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link type="text/css" href="<?= base_url() ?>css/templatestyle.css?v=1" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <?php 
        $restaurantArr = $this->session->userdata('restaurant');
        if (isset($restaurantArr) && !empty($restaurantArr)) {
            $restaurantID  =   $restaurantArr["id"];
        }
    ?>
    

    <?php if (isset($restaurantArr) && !empty($restaurantArr)) { ?>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script type="text/javascript">
    
            alertify.set('notifier','position', 'top-right');
            //
            var my_restaurant_id = '<?php echo $restaurantID; ?>';
            //
            var pusher = new Pusher('28a9f70204712108931e', {
              cluster: 'us3'
            });
            //
            var channel = pusher.subscribe('restaurant-'+my_restaurant_id);
            //
            channel.bind('my-event', function(data) {
                if (data.restaurant_id == my_restaurant_id) {
                    postNewOrder(data);
                    var promise = document.querySelector('audio').play();

                    if (promise !== undefined) {
                      promise.then(_ => {
                        // Autoplay started!
                      }).catch(error => {
                        // alert("New order is arrived but beep was not allowed by browser. Please click on empty space of page to allow beep sound to play!");
                      });
                    }
                }
            });

            function postNewOrder (order) {
                var image_path = '<?php echo base_url("images/under-process.png"); ?>';
                var status = "'Delivered'";
                var  rows = '';
                rows += '<tr>';
                rows += '   <td>'+order.order_code+'</td>';
                rows += '   <td><img src='+image_path+' alt="mark" border="0" title="Pending"/></td>';
                rows += '   <td>'+order.order_type+'</td>';
                rows += '   <td>'+order.order_table+'</td>';
                rows += '   <td>'+order.stamp+'</td>';
                rows += '   <td>'+order.delivery_time+'</td>';
                rows += '   <td>₦'+parseFloat(order.totalprice).toFixed(2)+'</td>';
                rows += '   <td>₦'+parseFloat(order.state_tax).toFixed(2)+'</td>';
                rows += '   <td>'+order.payment_method+'</td>';
                rows += '   <td><a style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj" href="javascript:void(null);" onclick="updateOrderStatus('+order.id+','+status+')" title="Delivered" class="delivered">Mark Completed</a></td>';
                rows += '</tr>';

                var message = "New order Received, Order Code : " + order.order_code;
				var audio = document.getElementById('beepsound');
				audio.addEventListener('ended', function(){
					audio.play();
				});
                alertify.alert('Notification', message).set({onshow:null, onclose:function(){ audio.pause();}}); 
                $("#append_new_order").prepend(rows);
            }
        </script>    
    <?php } ?>

    <script type="text/javascript">
        $(function() {
			
			// setTimeout(function(){
			// 	loopAudio = true;
			// 	audio.play();        
			// 	alert('click ok to stop audio looping.');
			// 	loopAudio = false;
			// 	audio.pause(); // if you want
			// }, 1000);
            var returnUrl = '';

            // run the currently selected effect
            function showSuccess(msg, url) {

                $("#showMessageText").html(msg);

                returnUrl = url;
                // get effect type from 

                var selectedEffect = "bounce";

                // most effect types need no options passed by default
                var options = {};
                // some effects have required parameters
                if (selectedEffect === "scale") {
                    options = {
                        percent: 100
                    };
                } else if (selectedEffect === "size") {
                    options = {
                        to: {
                            width: 280,
                            height: 185
                        }
                    };
                }

                // run the effect
                $("#showMessage").show(selectedEffect, options, 500, callback);
            };

            //callback function to bring a hidden box back
            function callback() {
                setTimeout(function() {
                    $("#showMessage:visible").removeAttr("style").fadeOut();
                }, 1000);
            };

            /*		function refreshMessage(showMsg)
            		{
            		
            		}
            */
            //		alert ('def');

            $("#showMessage").hide(); 
        });
    </script>
    <!--................. End Jquery Ui ..............-->
    <!--................. Start FireBud Here ..............-->
    <!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
    <!--................. End FireBud Here ..............-->
</head>

<body>
    <div id="showMessage" class="ui-widget-content ui-corner-all" style="display:none; visibility:hidden;">
        <h3 class="ui-widget-header ui-corner-all">Show</h3>
        <p id="showMessageText"></p>
    </div>
    <!-- Start Main Body -->

	<audio id="beepsound">
	<source src="<?= base_url() ?>/audio/beepsound_new.mp3" type="audio/mpeg">
	</audio>
    <div class="grid_row">
        <div class="overlay"></div>
