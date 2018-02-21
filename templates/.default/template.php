<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<? if (isset($arResult['ITEMS']) && !empty($arResult['ITEMS'])) { ?>
    <div class="sampleMain">
        <?
        foreach ($arResult['ITEMS'] as $ITEM) {
            $this->AddEditAction($ITEM['ID'], $ITEM['EDIT_LINK'], CIBlock::GetArrayByID($ITEM["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($ITEM['ID'], $ITEM['DELETE_LINK'], CIBlock::GetArrayByID($ITEM["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div id="<?= $this->GetEditAreaId($ITEM['ID']); ?>">
                <?= $ITEM['~PREVIEW_TEXT']; ?>
            </div>
            <?
        }
        ?>
    </div>
<? } ?>
