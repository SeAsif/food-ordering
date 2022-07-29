						<?
					//	print_r($restaurant);
						if($restaurant["have_menu"] == "Yes")
						{
						?>
                        <div class="companies">
                        	<div class="center-logos">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td style="height:111px; vertical-align:middle;">
                                    <?
									//echo base_url()."uploads/restaurant/logo/".$restaurant["logo"];
										if($restaurant["logo"] != "" && file_exists($logoPath."/".$restaurant["logo"]))
										{
									?>
                                    	<a href="<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>"><img src="<?=base_url().$logoPath.$restaurant["logo"]?>" alt="" border="0"/></a>
                                        <?
										}
										else
										{
										?>	
											<a href="<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>"><img src="<?=base_url().$logoPath?>noImage.jpg" alt="logo" border="0" /></a>
									 	 <?
                                        }
										?>		
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div class="second-section-bg" onclick="location.href='<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>';" style="cursor:pointer;">
                                <h3>
                                	<a href="<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>"><?=$restaurant["restaurant_name"]?></a>
                                </h3>
                                <span>
								<?
                                if(strlen($restaurant["restaurant_slogan"])>200)
								{
								
								echo substr($restaurant["restaurant_slogan"],0,200);
								?> 
                                <a href="<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>">Read More...</a>
                                <?
                                }
								else
								{
									echo $restaurant["restaurant_slogan"];
								}
								?>
                                </span>
                                <p>
                                </p>
                                <div class="small-icons">
                                    <ul>
                                        <li>
                                        <a href="javascript:void(null);" onclick="openItem(<?= isset($nCount) ? $nCount : 0 ?>);">
                                        <?
									//	echo $restaurant["take_out"];
										if($restaurant["take_out"] == "Yes")
										{
										?>
                                            
                                                <img src="<?=base_url()?>images/front/take-out.png" alt="take-out" />
										<?
										}
									//	echo $restaurant["dine_in"];
										if($restaurant["dine_in"] == "Yes")
										{
										?>
                                                <img src="<?=base_url()?>images/front/dinn-inn-two.gif" alt="dine-in" />
                                          <?
										}
									//	echo $restaurant["location_security"];
										if($restaurant["location_security"] == "Pre")
										{
										?>     
                                                <img src="<?=base_url()?>images/front/pre-security.jpg" alt="pre" />
                                         <?
										 }
									//	echo $restaurant["legal_sea_food"];
										if($restaurant["location_security"] == "Post")
										{
										?>        
                                                <img src="<?=base_url()?>images/front/post-security.png" alt="post" />
                                        <?
										}
										
										?>     
                                               <img src="<?=base_url()?>images/front/sign.gif" alt="post" /> <span><?=$restaurant["proximity_to_gate"]?>m</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rating-add-fav">
                               	<img src="<?=base_url()?>images/front/rating_<?=round($restaurant['avg_rating'])?>.jpg" alt="rating-stars" />
                                <!-- Start Rating Stars -->
                                
                                <!-- End Rating Stars -->
                            	<div id="rating-add-fav<?=$restaurant["id"]?>" style="float:left;">
                  			
									<?
                                    //print_r ($favRestaurantIDs);
                                    $return	=	array_search($restaurant["id"],$favRestaurantIDs);
                                    //$return	=	$return	+1;
                                    if(gettype ($return)	==	"integer")
                                    {
                                        
                                    ?>
										<a href="javascript:void(null);" class="remove" onclick="removeFavorites(<?=$favIDs[$return]?>,<?=$restaurant["id"]?>,<?=$restaurant["terminal_id"]?>)">Remove From Fav</a>							
                                    <?
                                    }else{
                                    ?>
                                    <a href="javascript:void(null);" class="add-btn" onclick="addToFavorites(<?=$restaurant["id"]?>,<?=$restaurant["terminal_id"]?>)">Add To Fav</a>
                                    <?
                                    }
                                    ?>
                            	</div>
                            </div>
                        </div>
                        <?
						}
                        else
						{
						?>
                        <div class="companies">
                        	<div class="center-logos">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td style="height:111px; vertical-align:middle;">
                                    <?
									//echo base_url()."uploads/restaurant/logo/".$restaurant["logo"];
										if($restaurant["logo"] != "" && file_exists($logoPath."/".$restaurant["logo"]))
										{
									?>
                                    	<a href=""><img src="<?=base_url()?>uploads/restaurant/logo/<?=$restaurant["logo"]?>" alt="" /></a>
                                        <?
										}
										else
										{
										?>	
											<img src="<?=base_url()?>uploads/restaurant/logo/noImage.jpg" alt="logo" />
									 	 <?
                                        }
										?>		
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div class="second-section-bg">
                                <h3 class="last-class-heading float-left">
                                	<?=$restaurant["restaurant_name"]?>
                                </h3>
                               <div class="baloon">
                                    <span>Sorry Restaurant Dont have menu</span>
                               </div>
                               <br class="clear" />
                                <span class="last-span">
								<?
                                if(strlen($restaurant["restaurant_slogan"])>200)
								{
								
								echo substr($restaurant["restaurant_slogan"],0,200);
								?> 
                                <a href="<?=base_url()?>userrestaurant/restaurantmenu/<?=$restaurant["id"]?>">Read More...</a>
                                <?
                                }
								else
								{
									echo $restaurant["restaurant_slogan"];
								}
								?>
                                </span>
                                <p>
                                </p>
                                <div class="small-icons">
                                    <ul>
                                        <li>
                                        <?
									//	echo $restaurant["take_out"];
										if($restaurant["take_out"] == "Yes")
										{
										?>
                                            <a href="javascript:void(null);" onclick="openItem(<?=$nCount?>);">
                                                <img src="<?=base_url()?>images/front/take-out.png" alt="take-out" />
										<?
										}
									//	echo $restaurant["dine_in"];
										if($restaurant["dine_in"] == "Yes")
										{
										?>
                                                <img src="<?=base_url()?>images/front/dinn-inn-two.gif" alt="dine-in" />
                                          <?
										}
									//	echo $restaurant["location_security"];
										if($restaurant["location_security"] == "Pre")
										{
										?>     
                                                <img src="<?=base_url()?>images/front/pre-security.jpg" alt="pre" />
                                         <?
										 }
									//	echo $restaurant["legal_sea_food"];
										if($restaurant["location_security"] == "Post")
										{
										?>        
                                                <img src="<?=base_url()?>images/front/post-security.png" alt="post" />
                                        <?
										}
										
										?>     
                                               <img src="<?=base_url()?>images/front/sign.gif" alt="post" /> <span><?=$restaurant["proximity_to_gate"]?>m</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rating-add-fav">
                               	<img src="<?=base_url()?>images/front/rating_<?=$restaurant['avg_rating']?>.jpg" alt="rating-stars" />
                                <!-- Start Rating Stars -->
                                
                                <!-- End Rating Stars -->
                            	<div id="rating-add-fav<?=$restaurant["id"]?>" style="float:left;">
                  			
									<?
                                    //print_r ($favRestaurantIDs);
                                    $return	=	array_search($restaurant["id"],$favRestaurantIDs);
                                    //$return	=	$return	+1;
                                    if(gettype ($return)	==	"integer")
                                    {
                                        
                                    ?>
										<a href="javascript:void(null);" class="remove" onclick="removeFavorites(<?=$favIDs[$return]?>,<?=$restaurant["id"]?>,<?=$restaurant["terminal_id"]?>)">Remove From Fav</a>							
                                    <?
                                    }else{
                                    ?>
                                    <a href="javascript:void(null);" class="add-btn" onclick="addToFavorites(<?=$restaurant["id"]?>,<?=$restaurant["terminal_id"]?>)">Add To Fav</a>
                                    <?
                                    }
                                    ?>
                            	</div>
                            </div>
                        </div>
						<?
						}
						?>
                        
                        