<?php 
if(!empty($restaurantInfo["theme_settings"])){ 
	$theme_settings = json_decode($restaurantInfo["theme_settings"],true);

}else{
	$theme_settings = json_decode('{"theme":"default","topBarBgColor":"#35ada2","topBarTextColor":"#000000","resturantInfoBarBgColor":"#fcfcfc","resturantInfoBarTextColor":"#605f5e","moreInfoTextColor":"#35ada2","menuSliderBgColor":"#ffffff","mainMenuBackgroundColor":"#ffffff","mainHeadingTextColor":"#212121","lineColor":"#37b8ac","menuHeadingpriceTextColor":"#212121","menuSubHeadingTextColor":"#666666","primaryButtonBackgroundColor":"#37b8ac","primaryButtonTextColor":"#fff","secondaryButtonBackgroundColor":"#f36737","secondaryButtonTextColor":"#FFFFFF","textInputColor":"#341d1d"}',true);
}
?>

<style>
.top-bar-bg-color {
    background: <?=$theme_settings['topBarBgColor'] ?> !important;
}

.top-bar-txt-color {
    color: <?=$theme_settings['topBarTextColor'] ?> !important;
}

.signout-icon-adj {
    color: white;
    font-size: 30px;
    position: absolute;
    right: 3px;
    top: 18px;
}

.resturant-info-bar-background {
    background-color: <?=$theme_settings['resturantInfoBarBgColor'] ?> !important;
}

.returantinfo-heading-color {
    color: <?=$theme_settings['resturantInfoBarTextColor'] ?> !important;
}

.more-info-txt-color {
    color: <?=$theme_settings['moreInfoTextColor'] ?> !important;
}

.main-menu-bg-color {
    background-color: <?=$theme_settings['mainMenuBackgroundColor'] ?> !important;
}

/* 2nd level css */
.menu-heading {
    color: <?=$theme_settings['menuHeadingpriceTextColor'] ?> !important;
}

/* 3rd level css */
.menu-sub-heading {
    color: <?=$theme_settings['menuSubHeadingTextColor'] ?> !important;
}

.primary-btn-bg-color {
    background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
}

.primary-btn-text-color {
    color: <?=$theme_settings['primaryButtonTextColor'] ?> !important;
}

/* 1st level css */
.category-text-color {
    color: <?=$theme_settings['mainHeadingTextColor'] ?> !important;
}

.secondary-btn-color {
    background-color: <?=$theme_settings['secondaryButtonBackgroundColor'] ?> !important;
    color: <?=$theme_settings['secondaryButtonTextColor'] ?> !important;
}

.food .heading:after {
    background-color: <?=$theme_settings['lineColor'] ?> !important;
}

.modal-header,
.cart-item,
.bordered_row,
.main-form,
.card-header {
    border-bottom: 1px solid <?=$theme_settings['lineColor'] ?> !important;
}

.slider-bg-color {
    background-color: <?=$theme_settings['menuSliderBgColor'] ?> !important;
}

.text-input-color {
    color: black !important;
}

/* Radio buttons css */
input[type='radio']:after {
    width: 17px;
    height: 17px;
    border-radius: 15px;
    top: -5px;
    left: -4px;
    position: relative;

    background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
}

input[type='radio']:checked:after {
    width: 17px;
    height: 17px;
    border-radius: 15px;
    top: -5px;
    left: -4px;
    position: relative;
    background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?>;
    content: '';
    display: inline-block;
    visibility: visible;
    border: 2px solid white;
}

/* Checkox CSS */
/* The checkbox-container */
.checkbox-container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 17px;
    width: 17px;
    background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
}

/* On mouse-over, add a grey background color */
.checkbox-container:hover input~.checkmark {
    background-color: <?=$theme_settings['menuSubHeadingTextColor'] ?>;
}

/* When the checkbox is checked, add a blue background */
.checkbox-container input:checked~.checkmark {
    background-color: <?=$theme_settings['primaryButtonBackgroundColor'] ?>;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.checkbox-container input:checked~.checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.checkbox-container .checkmark:after {
    left: 5px;
    top: 2px;
    width: 4px;
    height: 7px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.form-order-details td,
.form-order-details span,
.form-order-details strong {
    color: <?=$theme_settings['menuHeadingpriceTextColor'] ?> !important;
}

.ui-state-highlight,
.ui-widget-content .ui-state-highlight,
.ui-widget-header .ui-state-highlight {
    border: 1px solid <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
    background: <?=$theme_settings['primaryButtonBackgroundColor'] ?> !important;
    color: #363636;
}
</style>