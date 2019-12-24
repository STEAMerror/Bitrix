<?php
function AddPicturesInCategories(){
    CModule::IncludeModule("iblock");
    $url_parse = "https://myfinmarket.ru";
    $arFilter = Array('IBLOCK_ID'=>17, 'GLOBAL_ACTIVE'=>'Y');
    $rsSect  = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, true);
    while ($arSect = $rsSect->GetNext())
    {
        /**
         * получим первый попавшийся товар из раздела
         */
        $arFilterEl = Array('IBLOCK_ID'=>17, 'ACTIVE'=>'Y','SECTION_ID'=>$arSect["ID"]);
        $arSelectEl = Array('ID','NAME','DETAIL_PICTURE');
        $rsElem = CIBlockElement::GetList(Array("RAND" => "ASC"), $arFilterEl,false,Array("nTopCount"=>1),$arSelectEl);
        while ($arElem = $rsElem->GetNext()){
            $pic = CFile::GetPath($arElem['DETAIL_PICTURE']);
            //echo 'Раздел - ' . $arSect['ID'] . ' имя - ' . $arSect['NAME'] . '</br>';
            //echo 'Элемент - ' . $arElem['ID'] . ' имя - ' . $arElem['NAME'] . ' картинка - ' . $pic . '</br>';
            /**
             * устанавливаем картинку раздела
             */
            $sec = new CIBlockSection;
            $arLoadProductArray = Array(
                "ACTIVE"         => "Y",
                "PICTURE" => CFile::MakeFileArray($url_parse . $pic),
            );
            $results = $sec->Update($arSect["ID"], $arLoadProductArray);
        }
    }

    return "AddPicturesInCategories();";
}
?>