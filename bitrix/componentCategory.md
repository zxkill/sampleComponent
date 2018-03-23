В папке шаблона компонента создаём файл _result_modifier.php_ со следующим содержимым:

```php
$rsSect = CIBlockSection::GetList(
    array("SORT"=>"ASC"),
    array('IBLOCK_ID'=>$arParams['IBLOCK_ID']),
    false,
    array('ID','NAME','SECTION_PAGE_URL')); //тут можно указать поля, которые Вам необходимы.
while ($arSect = $rsSect->GetNext()) {
    //помещаем полученные данные, о разделах, в массив $arResult
    $arResult['SECTIONS'][] = $arSect;
}

foreach ($arResult['ITEMS'] as $key => $arItem) {
    foreach ($arResult['SECTIONS'] as $arSect) {
        if($arItem['IBLOCK_SECTION_ID'] == $arSect["ID"]) {
            //а здесь, к массиву элементов, добавляем наименование раздела, что очень часто бывает необходимо (по умолчанию, в массиве содержится только ID раздела)
            $arResult['ITEMS'][$key]['SECTION_NAME'] = $arSect['NAME'];
        }
    }
}
```