<style>
.variant_types_margin {
    margin-bottom: 10px !important;
}
</style>
<?php if(count($GroupDetail["variant"]) > 0) { ?>
<div class="extraWrap">
    <h1 class="menu-heading">
        <?=$GroupDetail["group_name"]?>&nbsp;<?=($GroupDetail["required"]=="Yes")?"<span class='menu-heading'>(Required)</span>":""?>
    </h1>
    <span class="menu-sub-heading" style=" display:block; padding-bottom:5px;">
        <?=isset($variantInfo["varianterrors"][$VariantNumber]) ? $variantInfo["varianterrors"][$VariantNumber] : ""?>
    </span>
    <div class="extraItem main-menu-bg-color">
        <input type="hidden" value="<?=$GroupDetail["required"]?>" name="variantrequired_<?=$VariantNumber?>" />
        <input type="hidden" value="single" name="varianttype_<?=$VariantNumber?>" />
        <input type="hidden" value="<?=$GroupDetail["id"]?>" name="variantgroup_<?=$VariantNumber?>" />
        <?
                    foreach ($GroupDetail["variant"] as $varaintItem)
					{
					?>
        <div class="multi menu-heading variant_types_margin">
            <input type="radio" name="variant_name_<?=$VariantNumber?>" class="float-left radio single_variant_price"
                price="<?=$varaintItem["price"]?>" value="<?=$varaintItem["id"]?>"
                <?=isset($variantInfo["variantdata"][$VariantNumber]) && ($variantInfo["variantdata"][$VariantNumber]==$varaintItem["id"])?'checked="checked"':""?> />
            <?=$varaintItem["name"]?> (₦ <?=$varaintItem["price"]?>)
        </div>
        <?
					}//end foreach ($GroupDetail["variant"] as $varaintItem)
					?>
    </div>
</div>
<?php } ?>