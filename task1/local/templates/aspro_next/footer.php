						<?CNext::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isBlog):?>
									</div> <?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
										<div class="sidearea">
											<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
											<?CNext::get_banners_position('SIDE', 'Y');?>
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "sidebar", "AREA_FILE_RECURSIVE" => "Y"), false);?>
										</div>
									</div>
								</div><?endif;?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
								</div> <?// .container?>
							<?else:?>
								<?CNext::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CNext::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(!$isHideLeftBlock && !$isBlog):?>
					<?if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
						</div> <?// .right_block?>				
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<div class="left_block">
								<?CNext::ShowPageType('left_block');?>
							</div>
						<?endif;?>
					<?endif;?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>				
				<?endif;?>
			</div> <?// #content?>
			<?CNext::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>
		<footer id="footer">
			<?if($APPLICATION->GetProperty("viewed_show") == "Y" || $is404):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					"basket", 
					array(
						"COMPONENT_TEMPLATE" => "basket",
						"PATH" => SITE_DIR."include/footer/comp_viewed.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "standard.php",
						"PRICE_CODE" => array(
							0 => "BASE",
						),
						"STORES" => array(
							0 => "",
							1 => "",
						),
						"BIG_DATA_RCM_TYPE" => "bestsell"
					),
					false
				);?>					
			<?endif;?>
			<?CNext::ShowPageType('footer');?>
		</footer>
		<div class="bx_areas">
			<?CNext::ShowPageType('bottom_counter');?>
		</div>
		<?CNext::ShowPageType('search_title_component');?>
		<?CNext::setFooterTitle();
		CNext::showFooterBasket();?>

        <?
        $frame = new \Bitrix\Main\Page\FrameBuffered("cookie_fixed_area");
        $frame->begin();
        if(ERROR_404!='Y'):
            /**добавить реферерер в инфоблок - старт**/
            $referer_href = $_SERVER['HTTP_REFERER'];
            if(isset($referer_href)){
                if(strlen($referer_href)>5){
                    $pos = strpos($referer_href, "myfinmarket.ru");
                    if($pos == false ){
                        $el = new CIBlockElement;
                        $arLoadProductArray = Array(
                            "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                            "IBLOCK_ID"      => 26,
                            "NAME"           => $referer_href,
                            "ACTIVE"         => "Y",            // активен
                        );
                        $PRODUCT_ID = $el->Add($arLoadProductArray);
                    }
                }
            }
            /**добавить реферерер в инфоблок - конец**/

            $referer = 'organic';
            if(isset($_GET['utm_source'])){
                if(!empty($_GET['utm_source'])){
                    if($_GET['utm_source']!='null'){
                        $referer = $_GET['utm_source'];
                    }
                }
            }
            if($referer == 'organic'){
                $referer_href = $_SERVER['HTTP_REFERER'];
                if(isset($referer_href)){
                    $arr_search_referer = array();
                    $arr_search_referer[] = "yandex";
                    $arr_search_referer[] = "google";
                    $arr_search_referer[] = "direct";
                    $arr_search_referer[] = "adwords";
                    $arr_search_referer[] = "vk";
                    $arr_search_referer[] = "facebook";
                    $arr_search_referer[] = "ok";
                    $arr_search_referer[] = "mail";
                    $arr_search_referer[] = "instagram";

                    foreach ($arr_search_referer as $item){
                        $pos = strpos($referer_href, $item);
                        if($pos !== false ){
                            if($item=="vk"){
                                $referer = "vkontakte";
                            }elseif ($item=="ok"){
                                $referer = "odnoklassniki";
                            }else{
                                $referer = $item;
                            }
                            break;
                        }//if($pos > 0)
                    }//foreach ($arr_search_referer as $item)
                }
            }else{
                $pos = strpos($referer, "vk");
                if($pos !== false ){
                    $referer = "vk-ads";
                }
                $pos = strpos($referer, "fb");
                if($pos !== false ){
                    $referer = "fb-ads";
                }
                $pos = strpos($referer, "ig");
                if($pos !== false ){
                    $referer = "ig-ads";
                }
                $pos = strpos($referer, "ok");
                if($pos !== false ){
                    $referer = "ok-ads";
                }
            }


            $old_referer = 'null';
            if(isset($_COOKIE['utm_source'])){
                if(!empty($_COOKIE['utm_source'])){
                    $old_referer = $_COOKIE['utm_source'];
                }
            }
            $set_referer = false;
            if($old_referer!='null'){
                if($referer!='organic'){
                    $set_referer = true;
                }
            }else{
                $set_referer = true;
            }

            if($set_referer){
                setcookie('utm_source', '', time() - 3600, '/');
                unset($_COOKIE['utm_source']);
                setcookie('utm_source', $referer, strtotime("+6 month"), '/');
            }
        endif;
        $frame->beginStub();
        //заглушка
        $frame->end();
         ?>


	</body>
</html>