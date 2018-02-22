<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-" => " "));

$arIBlocks = array();
$db_iblock = CIBlock::GetList(array("SORT" => "ASC"), array("SITE_ID" => $_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")));
while ($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[" . $arRes["ID"] . "] " . $arRes["NAME"];

$arComponentParameters = array(
    'PARAMETERS' => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("TYPE_IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "DEFAULT" => "articles",
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("IBLOCK"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '',
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "COUNT_ELEM" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("COUNT_ELEM"),
            "TYPE" => "STRING",
            "DEFAULT" => '10',
        ),
        "PAGER_SHOW_ALL" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PAGER_SHOW_ALL"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => 'N',
        ),
        "PAGER_NAME" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PAGER_NAME"),
            "TYPE" => "STRING",
            "DEFAULT" => '.default',
        ),
        "CACHE_TIME" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("CACHE_TIME"),
            "TYPE" => "STRING",
            "DEFAULT" => '3600000',
        ),
    )
);
?>