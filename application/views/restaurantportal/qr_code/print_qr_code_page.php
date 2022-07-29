
<!DOCTYPE html>
<html>
	<head>
		<title>Print QR Code</title>
	</head>
	<style>
	.my_loader {
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    z-index: 1234;
	}

	#file_loader {
	    background: white none repeat scroll 0 0;
	    display: none;
	    height: 100%;
	    left: 0;
	    opacity: 0.7;
	    position: fixed;
	    top: 0;
	    width: 100%;
	    z-index: 9;
	    display:block; 
	    height:1353px;
	}

	.loader-icon-box {
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    width: auto;
	    z-index: 9999;
	    -webkit-transform: translate(-50%, -50%);
	    -moz-transform: translate(-50%, -50%);
	    -ms-transform: translate(-50%, -50%);
	    -o-transform: translate(-50%, -50%);
	    transform: translate(-50%, -50%);
	}

	.loader-text {
	    display: inline-block;
	    padding: 28px 10px;
	    color: #000;
	    background-color: #e9e9e9;
	    border-radius: 5px;
	    text-align: center;
	    font-weight: 600;
	    width: 500px;
	    display:block; 
	    margin-top: 35px;
	}

	.logo { 
	  	width: auto;
	  	height: auto;
	  	text-align:center;
	}

	.logo img {
	  	display:inline-block;
	}

	.QR_code_holder {
		width: auto;
	  	height: auto;
	  	text-align:center;
	} 

	.QR_code_btn_holder {
		width: auto;
	  	height: auto;
	  	text-align:center;
	}

	.QR_code_btn_holder button {
		background: #F36737;
	    color: #fff;
	    width: 124px;
	    padding: 9px 0px;
	    border-radius: 5px;
	    border: 0px;
	}

	.QR_code_holder img {
	  	display:inline-block;
	  	width: 150px;
	  	height: 150px;
	}

	.restaurant_text p {
		display:block;
	}

	.restaurant_text p {
		color: #F36737;
		font-size: 28px;
		margin: 0px;
    	padding: 12px 0px;
	}

	#QR_table_no{
		font-size: 24px;
	}

	.QR_link {
		color: 	#888888;
	}

	#QR_Note {
		color: #000;
	    font-size: 38px;
	    font-weight: 800;
	    margin: 0px;
	}

	.powered_by {
		width: auto;
	  	height: auto;
	  	text-align:center;
	  	/* border-top: 2px dashed #888888; */
	  	margin-top: 8px;
    	padding-top: 12px;
	}

	.powered_by img {
	    width: 30px;
	    height: 30px;
	}

	.powered_by span {
		color: #000;
	    position: relative;
	    top: 0px;
	    right: -9px;
	}    

</style>

	<body>
		<div id="QR_code_loader" class="text-center my_loader" style="" >
		    <div id="file_loader" class="file_loader"></div>
		    <div class="loader-icon-box">
		        <div class="loader-text" id="loader_text_div">
		        	<div class="logo">
					  	<!-- <img src="<?=base_url()?>uploads/restaurant/logo/new_logo.png"/> -->
					  	<img src="<?= !empty($this->session->userdata('restaurant')['logo']) ? base_url() . "uploads/restaurant/logo/" . $this->session->userdata('restaurant')['logo'] : base_url() . "images/upload-logo01.jpg" ?>" class="rounded-circle" width="108" height="108">
					</div>
					<div class="restaurant_text">
					  	<p id="QR_restaurant_name">
					  		<?php echo urldecode($restaurant_name); ?>
					  	</p>
					</div>
					<div>
					  	<p id="QR_Note">
					  		SCAN QR CODE <br> TO SEE THE MENU
					  	</p>
					  	<p id="QR_table_no">
					  	<?php if (isset($table_number)) { ?>
					  		<?php echo $table_number; ?>
					  	<?php } ?>
					  	</p>
					  	<div class="QR_code_holder">
						  	<img id="QR_code_image" src="<?php echo $QRCode; ?>"/>
						</div>
						<p class="QR_link">
							You can also visit us <?php echo $url_path; ?>
						</p>
						<div class="powered_by">
						  	<img src="<?=base_url()?>uploads/restaurant/logo/new_logo.png"/><span>Powered by waivedelivery.com</span>
						</div>
					</div>
		        </div>
		    </div>
		</div>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script language="javascript">
			(function() {
			   	window.print();


			   	window.onafterprint = function(){
                    // window.close();
                }

			})();
		</script>
	</body>

</html>
