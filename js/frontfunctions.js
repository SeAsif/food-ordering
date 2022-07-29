function addToFavorites(restaurantId,terminalId)
{
	$.ajax({ type: "POST", url: base_url+"irestaurant/addFavoriteRestaurant", data: "restaurant_id="+restaurantId+"&"+"terminal_id="+terminalId+"", success: function(addFavoriteRestaurant){ 
		//alert(addFavoriteRestaurant);
		var status="";
		var obj = jQuery.parseJSON(addFavoriteRestaurant);
		$.each(obj, function() {
			
			status=obj.response;
			favid=obj.insert_id;
			
		});
		
		if (status=="RECORD_ADDED")
		{
			
			//$("#rating-add-fav").remove();
			$("#rating-add-fav"+restaurantId).html('<a href="javascript:void(null);" class="remove" onclick="removeFavorites('+favid+','+restaurantId+','+terminalId+')">Remove From Fav</a>');
		}
		else
		{
			openSign(0);			
		}
	}//end function
	});	
}
function removeFavorites(favId,restaurantId,terminalId)
{
	$.ajax({ type: "POST", url: base_url+"irestaurant/delFavoriteRestaurants/"+favId, data: "", success: function(removeFavorites){ 
		//alert(addFavoriteRestaurant);
		var status="";
		var obj = jQuery.parseJSON(removeFavorites);
		$.each(obj, function() {
			status=obj.response;
		});
		
		if (status=="FAVORITE_RESTAURANT_DELETED")
		{
			//$("#rating-add-fav").remove();
			$("#rating-add-fav"+restaurantId).html('<a href="javascript:void(null);" class="add-btn" onclick="addToFavorites('+restaurantId+','+terminalId+')">Add to Fav</a>');
		}
		else
		{
		
		}
	}//end function
	});	

}

function showTerminals(airportId,state) 
{
	
//	var airportId=$("#airport1 option:selected").val();
	$("#airportid").val(airportId);
	if(airportId == -1)
	{
				$('#terminal') .find('option') .remove() ;
			if (state!=undefined)
			{
				$('#restaurant_name') .find('option') .remove() ;
			}
	}
	else if(airportId == "Add More")
	{
		$('#terminal') .find('option') .remove() ;
		//Popup Code
		//alert("sho popup");
		openAirport(0);
	}
	else
	{
	
		$.ajax({
			url: base_url+"irestaurant/listTerminals/"+airportId,
			success: function( data ) 
			{
				var obj = jQuery.parseJSON(data);
				//terminal1
				$('#terminal') .find('option') .remove() ;
				//terminal2
				$.each(obj, function() 
				{
					  $("#terminal").append('<option value="'+this.id+'" >'+this.terminal_name+'</option>');
					  
				});	
				if (state!=undefined)
				{
						showRestaurants($("#terminal option:selected").val());
				}
			}
		});
	}
	
}


/*function showProfile(userId) 
{
	
	$.ajax({
			url: base_url+"irestaurant/getCustomerProfile/"+userId,
			success: function( data ) 
			{	
				$('#allprofiles') .find('option') .remove() ;
		//		alert(data);
				var obj = jQuery.parseJSON(data);
				//terminal1
		//		$('#allprofiles') .find('option') .remove() ;
				//terminal2
				$("#allprofiles").append('<option value="Select Profile">Select Profile</option>');
				
				$.each(obj.response, function() 
				{
				//	alert (this.customerPaymentProfileId[0]);
					  $("#allprofiles").append('<option value="'+this.customerPaymentProfileId[0]+'" >'+this.cardNumber[0]+' '+this.expirationDate[0]+'</option>');
					  
				});	
		//		if (state!=undefined)
		//		{
			//			showRestaurants($("#terminal option:selected").val());
			//	}
			}
		});
	
	
}
*/
function showProfile(userId) 
{
	
	$.ajax({
			url: base_url+"irestaurant/getCustomerProfile/"+userId,
			success: function( data ) 
			{	
			//	$('#allprofiles') .find('option') .remove() ;
			//	alert(data);
				var obj = jQuery.parseJSON(data);
				//terminal1
		//		$('#allprofiles') .find('option') .remove() ;
				//terminal2
			//	$("#allprofiles").append('<option value="Select Profile">Select Profile</option>');
				
				//	alert (this.customerPaymentProfileId[0]);
				  $("#card_number").val(obj.cardNumber);
				  $("#expiry_date").val(obj.expirationDate);
				  $("#paymentProfileId").val(obj.customerPaymentProfileId);
				  $("#have_error").val(obj.have_error);
					  
		//		if (state!=undefined)
		//		{
			//			showRestaurants($("#terminal option:selected").val());
			//	}
			}
		});
	
	
}

function deleteItem(dItemId)
{
	$.ajax({
		url: base_url+"irestaurant/deleteFromCart/"+dItemId,
		success: function( data ) 
		{
			var obj = jQuery.parseJSON(data);
			if (obj	==	"RECORD_DELETED")
				document.location.href	=	document.location.href;
		}
	});
}
function increaseQuantity(dItemId)
{
	$.ajax({
		url: base_url+"irestaurant/increaseOrderQuantity/"+dItemId,
		success: function( data ) 
		{
			// var obj = jQuery.parseJSON(data);
			console.log(data)
			console.log(data.message)
			if (data.message	==	"RECORD_ADDED") {
				var item_total 		= data.item_total;
				var new_quantity 	= data.new_quantity;
				var total_city_tax 	= data.total_city_tax;
				var total_price 	= data.total_price;
				var total_state_tax = data.total_state_tax;

				$("#dis_city_tax").text(total_city_tax);
				$("#dis_state_tax").text(total_state_tax);
				$("#dis_Total").text(total_price);
				$("#"+dItemId+'_total_price').text(item_total);
				$("#"+dItemId+'_dec_inc').text(new_quantity);
				
				$("#cart_message_section").show();
				$("#cart_message_text").text("Item increase successfully!");

				setTimeout(function(){
					$("#cart_message_text").text("");
					$("#cart_message_section").hide();
				}, 4000);
 
			}
				// document.location.href	=	document.location.href;
		}
	});
}
function decreaseQuantity(dItemId)
{
	$.ajax({
		url: base_url+"irestaurant/decreaseOrderQuantity/"+dItemId,
		success: function( data ) 
		{
			// var obj = jQuery.parseJSON(data);
			// if (obj	==	"RECORD_DELETED")
			// 	document.location.href	=	document.location.href;

			if (data.message	==	"RECORD_DELETED") {
				var item_total 		= data.item_total;
				var new_quantity 	= data.new_quantity;
				var total_city_tax 	= data.total_city_tax;
				var total_price 	= data.total_price;
				var total_state_tax = data.total_state_tax;

				$("#dis_city_tax").text(total_city_tax);
				$("#dis_state_tax").text(total_state_tax);
				$("#dis_Total").text(total_price);
				$("#"+dItemId+'_total_price').text(item_total);
				$("#"+dItemId+'_dec_inc').text(new_quantity);

				$("#cart_message_section").show();
				$("#cart_message_text").text("Item decrease successfully!");

				setTimeout(function(){
					$("#cart_message_text").text("");
					$("#cart_message_section").hide();
				}, 4000);
 
			}
		}
	});
}
function resetShoppingCart()
{
	$.ajax({
		url: base_url+"irestaurant/resetShoppingCart",
		success: function( data ) 
		{
			var obj = jQuery.parseJSON(data);
			if (obj	==	"RECORD_DELETED")
				document.location.href	=	document.location.href;
		}
	});
}
function reOrder(nOrderId)
{
	
	$.ajax({
		url: base_url+"userorder/reOrder/"+nOrderId,
		success: function( reOrder ) 
		{
			var obj = jQuery.parseJSON(reOrder);
			
			if (obj	==	"SUCCESS")
				parent.location.href	=	base_url+"userorder/checkout";
			else
				alert("Cannot reorder! Currently few items in this order are not available");
		}
	});
}

function showRestaurants(terminalId) 
{
	
//	var airportId=$("#airport1 option:selected").val();
	$("#terminalid").val(terminalId);
	if(terminalId == -1)
	{
				$('#restaurant_name') .find('option') .remove() ;
	}
	
	else
	{
	
		$.ajax({
			url: base_url+"irestaurant/listRestaurant/"+terminalId,
			success: function( data ) 
			{
				var obj = jQuery.parseJSON(data);
				//terminal1
				$('#restaurant_name') .find('option') .remove() ;
				//terminal2
				$.each(obj, function() 
				{
					  $("#restaurant_name").append('<option value="'+this.id+'" >'+this.restaurant_name+'</option>');
					  
				});				
			}
		});
	}
	
}
