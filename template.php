<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="news-list" style="display:flex; width:100%; min-height:400px;">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="padding-top:50px; display:block; width:33%;">

<strong>Название:</strong> <?= $arItem["PROPERTIES"]["A"]["VALUE"]." "; ?><br />

<?php if ($arItem["PROPERTIES"]["C"]["VALUE"]) {?>
<strong>Ученики:</strong> <br>
<? 
$arr = $arItem["PROPERTIES"]["B"]["VALUE"];
foreach ($arr as $key => $value) {
$rsUser = CUser::GetByID($value);
$arUser = $rsUser->Fetch();
echo $arUser["NAME"].' '.$arUser["LAST_NAME"];echo " <br> "; 
}
?>
<?php } else { ?><?php }?>


<?php if ($arItem["PROPERTIES"]["C"]["VALUE"]) {?>
<strong>Предметы:</strong> <br>
<? if(is_array($arItem["PROPERTIES"]["C"]["VALUE"]))
echo implode(" <br> ", $arItem["PROPERTIES"]["C"]["VALUE"]);
else
echo $arItem["PROPERTIES"]["c"]["VALUE"];?><br />
<?php } else { ?><?php }?>

<strong>Дата изменения:</strong> <?= $arItem["PROPERTIES"]["D"]["VALUE"]." "; ?><br />

	</div>
<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

