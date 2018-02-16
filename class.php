<?php

class sampleComponent extends CBitrixComponent
{
    function getData() //наша фукнция, где будем производить какие-то действия
    {
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT"); //массив выбраных полей
        $arFilter = Array("IBLOCK_ID" => $this->arParams['IBLOCK_ID'], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"); //фильтр выборки
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => $this->arParams['COUNT_ELEM']), $arSelect); //получаем один элемент
        while ($arItem = $res->GetNext()) {
            $arButtons = CIBlock::GetPanelButtons(
                $arItem["IBLOCK_ID"],
                $arItem["ID"],
                0,
                array("SECTION_BUTTONS" => false, "SESSID" => false)
            );
            $arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
            $arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
            $this->arResult['ITEMS'][] = $arItem;
        }
    }

    public function executeComponent()
    {
        if (CModule::IncludeModule("iblock")) //подключаем модуль инфоблока
        {
            $obCache = new CPHPCache();
            if ($obCache->InitCache($this->arParams['CACHE_TIME'], 'sample_component_', '/samplecomponent')) {
                $this->arResult = $obCache->GetVars();   //если элемент уже в кеше, то берем оттуда
            } else {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache('/samplecomponent');
                $CACHE_MANAGER->RegisterTag('iblock_id_' . $this->arParams['IBLOCK_ID']); //регистрируем тег

                $this->getData(); //выполняем нашу функцию

                $CACHE_MANAGER->EndTagCache();
                if ($obCache->StartDataCache())
                    $obCache->EndDataCache($this->arResult); //записываем данные в кеш
            }

            $this->includeComponentTemplate(); //подключаем шаблон
        }
    }
}