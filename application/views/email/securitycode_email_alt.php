	Hi <?=$list->firstname?>,
				
    Your security code has been generated Please Folllow the link to recover your password.
    
    Please CLick the link:
    <?
    if($userType == "user")
	{
	?>
    <?=base_url()?>home/recoverview/<?=$list->id?>/<?=$list->security_code?>
    <?
	}
	else
	{
	?>
    <?=base_url()?>restaurantportal/recoverview/<?=$list->id?>/<?=$list->security_code?>
    <?
    }
	?>
	Thanks,
	
	Waive Team.
