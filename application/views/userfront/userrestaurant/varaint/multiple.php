<?php if(count($GroupDetail["variant"]) > 0) { ?>
		<div class="extraWrap menu-heading">
            <h1 class="menu-heading"><?=$GroupDetail["group_name"]?>&nbsp;<?=($GroupDetail["required"]=="Yes")?"<span class='menu-heading' >(Required)</span>":""?></h1>
            <span class="menu-sub-heading" style=" display:block; float:left; padding-bottom:5px;">
				<?=isset($variantInfo["varianterrors"][$VariantNumber]) ? $variantInfo["varianterrors"][$VariantNumber] : ""?>
            </span>
            <div class="extraItem main-menu-bg-color">
            	<input type="hidden" value="<?=$GroupDetail["required"]?>" name="variantrequired_<?=$VariantNumber?>" />
            	<input type="hidden" value="multiple" name="varianttype_<?=$VariantNumber?>" />                
            	<input type="hidden" value="<?=$GroupDetail["id"]?>" name="variantgroup_<?=$VariantNumber?>" />
					<?
					$nCount	=	0;
					
                    foreach ($GroupDetail["variant"] as $varaintItem)
					{
					?>
					<label class="checkbox-container menu-heading multi">
					<input type="checkbox" value="<?=$varaintItem["id"]?>" class="float-left radio multi_variant_price" price="<?=$varaintItem["price"]?>" name="variant_name_<?=$VariantNumber.$nCount?>" <? if (isset($variantInfo["variantdata"][$VariantNumber]) && in_array($varaintItem["id"],$variantInfo["variantdata"][$VariantNumber]))echo 'checked="checked"';?>/>
								<span class="checkmark"></span>
								<?=$varaintItem["name"]?> (₦ <?=$varaintItem["price"]?>)
					</label>
					
                    <?
						$nCount++;
					}//end foreach ($GroupDetail["variant"] as $varaintItem)
					
					?>
                    <input type="hidden" name="variant_item_count_<?=$VariantNumber?>" value="<?=$nCount?>" />

            </div>
        </div>
<?php } ?>
