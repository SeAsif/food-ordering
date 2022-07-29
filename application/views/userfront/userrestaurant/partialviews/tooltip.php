                            <a href="javascript:void(null)" onclick="$('#tooltip').hide();" title="Close" class="closebtn">
                                <img src="<?=base_url()?>images/front/closebtn.jpg" alt="take out" border="0" />
                            </a>
                            <h2><?=$restaurant["restaurant_name"]?><br /><span><?=substr($restaurant["restaurant_slogan"],0,25)?>...</span></h2>
                            <p><?=substr($restaurant["restaurant_details"],0,100)?>...</p>
                            <?
                            if($restaurant["take_out"] == "Yes")
							{
							?>
                            <a href="#" title="Take Out">
                                <img src="<?=base_url()?>images/front/take-out.png" alt="take out" border="0" />
                            </a>
                            <?
                            }
							
							if($restaurant["dine_in"] == "Yes")
							{
                            
							?>
                            <a href="#" title="Dine Inn">
                                <img src="<?=base_url()?>images/front/dine-inn.png" alt="dine inn" border="0" />
                            </a>
                            <?
                            }
							if($restaurant["location_security"] == "Post")
							{
							?>
                            <a href="#" title="Post Security">
                                <img src="<?=base_url()?>images/front/post-security.png" alt="post security" border="0" />
                            </a>
                            <?
                            }
							?>
                            <a href="#" title="Proximity">
                                <img src="<?=base_url()?>images/front/proximity.png" alt="proximity" border="0" class="float-left" />
                                &nbsp;&nbsp;(<?=$restaurant["proximity_to_gate"]?>m)
                            </a>
