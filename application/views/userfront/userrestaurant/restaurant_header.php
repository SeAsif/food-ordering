            <!-- Start Restaurant Name, Slogan and Rating -->
				<div class="name-rating">
                	<h1><?=$restaurantInfo["restaurant_name"]?></h1>
                    <span class="rest-slogan font11"><?=$restaurantInfo["restaurant_slogan"]?></span>
                    <!-- <div class="rating">
                        <table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><strong>Avg Rating:</strong></td>
                            <td style="padding-left:5px;"><img src="<?=base_url()?>images/front/rating_<?=round($restaurantInfo['avg_rating'])?>.jpg" alt="stars" /></td>
                            <td style="padding:0px 15px 0px 15px;"><img src="<?=base_url()?>images/front/rating-sptr.gif" alt="sptr" /></td>
                            <td id="rating-add-fav<?=$restaurantInfo["id"]?>">
                            <?
				            if( $this->session->userdata('id'))
							{
								if ($favrest==NULL)
								{
							?>	                            
                                <a href="javascript:void(null);" class="add-btn" onclick="addToFavorites(<?=$restaurantInfo["id"]?>,<?=$restaurantInfo["terminal_id"]?>)">Add To Fav</a>
                            <?
								}
								else
								{
							?>
									<a href="javascript:void(null);" class="remove" onclick="removeFavorites(<?=$favrest["favid"]?>,<?=$favrest["restaurant_id"]?>,<?=$favrest["terminal_id"]?>)">Remove From Fav</a>
                            <?	
								}
                            }
							else
							{
							?>
                            	<a href="javascript:void(null);" onclick="openSign(0);" class="add-btn">Add To Fav</a>
                            <?
							}
							?>
                            </td>
                          </tr>
                        </table>
                    </div> -->
                </div>
            <!-- End Restaurant Name, Slogan and Rating -->

            <!-- Start Restaurant Logo and Number -->
                <div class="logo-num">
                <?	//echo $logoPath;
					if($restaurantInfo["logo"] != "" && file_exists($logoPath."/".$restaurantInfo["logo"]))
					{
				?>	
					<img src="<?=base_url().$logoPath.$restaurantInfo["logo"]?>" alt="logo" />
                <?
					}
					else
					{
				?>	
						<img src="<?=base_url().$logoPath?>noImage.jpg" alt="logo" />
                  <?
                  	}
				  ?>      
				    
                    <h2><?=$restaurantInfo["phone_number"]?></h2>                	
                </div><br class="clear" />
            <!-- End Restaurant Logo and Number -->

            <!-- Start Restaurant Menu Navigation Bar -->
            <div class="rest-menu">
                <a href="<?=base_url('/').$restaurantInfo["id"]?>" <?=($activemenu=="restaurantmenu")?'class="selected"':""?>>
                    <span title="Our Menu">Our Menu</span>
                </a>
                <a href="<?=base_url('/')."userrestaurant/restaurantinfo/".$restaurantInfo["id"]?>" <?=($activemenu=="restaurantinfo")?'class="selected"':""?>>
                    <span title="Our Restaurant">Our Restaurant</span>
                </a>
                <!-- <a href="<?=base_url()."userrestaurant/reviews/".$restaurantInfo["id"]?>" <?=($activemenu=="reviews")?'class="selected"':""?>>
                    <span title="Reviews">Reviews</span>
                </a> -->
                <?
             //   if($activemenu=="reviews")
				{
				?>
                	<!-- <a href="<?=base_url()."userrestaurant/listYelpRestaurantReviews/".$restaurantInfo["id"]?>" <?=($activemenu=="yelpreviews")?'class="selected"':""?>>
                    <span title="Reviews">Yelp Reviews</span> -->
                </a>
				<?
                }
				?>
            </div>
            <!-- End Restaurant Menu Navigation Bar -->
            