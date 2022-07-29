<script language="javascript">
function setVariantItem(selecteditem, variantItemId)
{
	$("#variant_name_<?=$VariantNumber?>").val(variantItemId);
	$("a.selected").removeClass();
	$("a.selected").addClass( "not_selected" );
	$("#"+selecteditem).removeClass();
	$("#"+selecteditem).addClass("selected");
}
</script>
	
        <div class="extraWrap menu-heading">
            <h1 class='menu-heading'><?=$GroupDetail["group_name"]?>&nbsp;<?=($GroupDetail["required"]=="Yes")?"<span class='menu-heading'>(Required)</span>":""?></h1>
            <span class="menu-sub-heading" style=" display:block; float:left; padding-bottom:5px;">
				<?=$variantInfo["varianterrors"][$VariantNumber]?>
            </span>
            <div class="extraItem main-menu-bg-color">
                <div class="itemBar-wrap menu-heading">
                    <input type="hidden" value="<?=$GroupDetail["required"]?>" name="variantrequired_<?=$VariantNumber?>" />
                    <input type="hidden" value="slider" name="varianttype_<?=$VariantNumber?>" />                
                    <input type="hidden" value="<?=$GroupDetail["id"]?>" name="variantgroup_<?=$VariantNumber?>" />
                    <input type="hidden" name="variant_name_<?=$VariantNumber?>" id="variant_name_<?=$VariantNumber?>" value="<?=$variantInfo["variantdata"][$VariantNumber]?>" />
                    <span>Low</span>                    
                    <?
					
					
										
                    foreach ($GroupDetail["variant"] as $variantItem)
					{
						//echo ($variantInfo["variantdata"][$VariantNumber]."==".$variantItem["id"]."<br/>");
						
						//echo ($variantInfo["variantdata"][$VariantNumber]===$variantItem["id"]);
					?>
                    <a href="javascript:void(null);" onclick="setVariantItem('<?=($variantItem["id"]."_".$variantItem["name"])?>',<?=$variantItem["id"]?>);" class="<?=($variantInfo["variantdata"][$VariantNumber]==$varaintItem["id"])?'not_selected':'not_selected'?>" id="<?=($variantItem["id"]."_".$variantItem["name"])?>"><?=$variantItem["name"]?></a>
                    <?
                    }
					?>
                    <span class="itemBarLeft">Max</span>
                </div>
            </div>
        </div>
