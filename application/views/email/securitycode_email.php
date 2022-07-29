	Hi <?=$list->firstname?>,
				
    Your security code has been generated Please Follow the link to recover your password.
    
    Please Click the link:
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
