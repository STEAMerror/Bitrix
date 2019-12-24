<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<div class="footer_inner <?=($arTheme["SHOW_BG_BLOCK"]["VALUE"] == "Y" ? "fill" : "no_fill");?> footer-grey">
    <div class="bottom_wrapper">
        <div class="maxwidth-theme items">
            <div class="row bottom-middle">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-6">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                                array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => SITE_DIR."include/left_block/comp_subscribe.php",
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "standard.php"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 contact-block">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-2">
                            <?$APPLICATION->IncludeFile(SITE_DIR."include/footer/contacts-title.php", array(), array(
                                    "MODE" => "html",
                                    "NAME" => "Title",
                                    "TEMPLATE" => "include_area.php",
                                )
                            );?>
                            <div class="info">
                                <div class="row">
                                    <div class="col-md-12 col-sm-4">
                                        <?CNext::showEmail('email blocks');?>
                                        <div class="social-block">
                                            <?$APPLICATION->IncludeComponent(
                                                "aspro:social.info.next",
                                                ".default",
                                                array(
                                                    "CACHE_TYPE" => "A",
                                                    "CACHE_TIME" => "3600000",
                                                    "CACHE_GROUPS" => "N",
                                                    "COMPONENT_TEMPLATE" => ".default"
                                                ),
                                                false
                                            );?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-under">
                <div class="row">
                    <div class="col-md-12 outer-wrapper">
                        <div class="inner-wrapper row">
                            <div class="copy-block">
                                <div class="copy">
                                    <?$APPLICATION->IncludeFile(SITE_DIR."include/fm/footer/copy/copyright.php", Array(), Array(
                                            "MODE" => "php",
                                            "NAME" => "Copyright",
                                            "TEMPLATE" => "include_area.php",
                                        )
                                    );?>
                                </div>
                                <div class="print-block"><?=CNext::ShowPrintLink();?></div>
                                <div id="bx-composite-banner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>