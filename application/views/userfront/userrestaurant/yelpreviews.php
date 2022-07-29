<?
$this->load->view("userfront/header_view");
?>
<script type="text/javascript" src="<?=base_url()?>js/frontfunctions.js"></script>

<script type="text/javascript">

function add_rating(id)
{
	jQuery("#rating").val(id);
	jQuery("#rating_pic").html('');
	for(i=1; i <= 5; i++)
	{
		if(i <= id)
		{
			jQuery("#rating_pic").append('<img src="<?=base_url()?>images/front/star.jpg" alt="star" onclick="add_rating('+i+')" />');
		}
		else
		{
			jQuery("#rating_pic").append('<img src="<?=base_url()?>images/front/blank-star.jpg" alt="star" onclick="add_rating('+i+')" />');
		}
	}
}
</script>

    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
        	<a href="<?=base_url()?>usersearch/searchresult">Search Result</a><span>&gt;</span>
            Restaurant Reviews
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

				 <?
                 $this->load->view("userfront/userrestaurant/restaurant_header");
                 ?>

            <!-- Start Restaurant Reviews -->
	            <div class="rest-mid-cont">
                <?
				 if(isset($errors))  	
				 {
				   if (isset($errors) && count($errors) > 0)
				   {
				   ?>
						<div class="ui-widget">
						<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">                                               
				   <?
					   foreach ($errors as $error)
						echo $error;
					?>
                        </div>
                    </div>
					<?
				   }
				 } 
				?>
	                <h2 class="float-left">Yelp Reviews</h2>
                    <div class="rest-sort"></div>
              <br class="clear" />
                    <div class="review-wrap">
                    <?
					$user_reviews = false;
//					print_r($reviews);
					$i=0;
					$min_distance=0;
					$index=0;
					if($reviews->{businesses}[$i]->{reviews})
					{
						foreach($reviews->{businesses} as $bussiness)
						{
							if($i=0)
							{
								$min_distance = $bussiness->{distance};
								$index = $i;
							}	
							else if($min_distance > $bussiness->{distance})
							{
								$min_distance = $bussiness->{distance};
								$index = $i;
							}	
								
							$i++;
						}	
						
						foreach($reviews->{businesses}[$index]->{reviews} as $restaurantReviews)
						{
							
						?>	
							<div class="center-rating">
								<div class="headings-rating">
									<div class="rating-list">
										<ul>
											<li><h2><?=$restaurantReviews->{user_name}?></h2></li>
											<li><span><img src="<?=base_url()?>images/front/Review-sprtr.gif" alt="sptr" /></span></li>
											<li class="last-class"><?=$restaurantReviews->{date}?></li>
										</ul> 
									</div>
										 <div class="rating-satrs"><img src="<?=$restaurantReviews->{rating_img_url_small}?>" alt="stars" />
										 </div>
								</div>
									
							<P><?=nl2br($restaurantReviews->{text_excerpt})?></P>
						</div>
					<?
						}
						
					}
					else
					{
					?>
                    	
                    <div class="reviewHd"><?
                    echo 'Sorry No Yelp Reviews Available for '.$restaurantInfo['restaurant_name'].' restaurant';
                    ?></div>
										
                    <?
                    }
					?>
                    <!-- Start Restaurant Reviews page-->
                  <!--<div class="show-pages">
                    	<p class="last-show">Showing <strong><?=$ncounter?></strong> - <strong><?=$records?></strong> of <strong><?=$total?></strong> Reviews</p>
                    </div>-->
                    <!-- End Restaurant Reviews page-->
                    
                     <!-- Start Restaurant Reviews navigation -->
                        	<div class="nav">
                            	 <?=$paginationLinks?>
							</div>
                    
                    <!-- End Restaurant Reviews navigation -->
                 </div>	
                        
                        	
                   <!--<form name="review" id="review" method="post" action="<?=base_url()?>userrestaurant/reviews/<?=$restaurantid?>">
<div class="rate-and-reviews">
                        	<h2>Rate & Reviews</h2>
                            <div id="rating_pic">
                            <?
                            for($i=1; $i<=5; $i++)
							{
								if($user_reviews)
								{
							?>
                            	
                            	<img src="<?=base_url()?>images/front/blank-star.jpg" alt="star"/>
                               
                            <?
								}
								else
								{
							?>	
									<img src="<?=base_url()?>images/front/blank-star.jpg" alt="star" onclick="add_rating(<?=$i?>)"/>
                            <?
								}
                            }
							?>
                             </div>
                            <input type="hidden" name="rating" id="rating" value="" />  
                            	<div class="text-area">
                            		<textarea class="txt-field-rate" name="txtreview" <?=($user_reviews) ? 'disabled = "disabled"' :''?>></textarea> 	
                                 </div>
									<?
									if( ! $user_reviews)
									{
										if( $this->session->userdata('id')== "")
										{
										?>
	
										<a href="javascript:void(null);" onclick="openSign(0);" class="add-btn">Post-Review</a>
										
										<?
										}else
										{
										?>
										
										<a href="javascript:void(null);" onclick="document.getElementById('review').submit()" class="add-btn">Post-Review</a>
										
									<?
										}
									}
									?>
                     </div>
                   </form>-->     
            <!-- Start Restaurant Rate and Reviews -->
                    	
                    <!-- End Restaurant Rate and Reviews -->
                </div>
            <!-- End Restaurant Reviews -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>