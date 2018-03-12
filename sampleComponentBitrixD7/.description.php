<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
    'NAME' => Loc::getMessage("ARBITARY_CODE"),
    'DESCRIPTION' => Loc::getMessage("DESCRIPTION_ARBITARY_CODE"),
    'SORT' => 10,
    'CACHE_PATH' => 'Y',
    'PATH' => array(
        'ID' => 'citfact',
        'NAME' => Loc::getMessage("CIT_FACT"),
    ),
);