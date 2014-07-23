<?php
if (file_exists('jwage/SplClassLoader.php')) {
	$classLoader = new SplClassLoader('Etalx\Common', 'src/Etalx/Common');
	$classLoader = new SplClassLoader('Etalx\AppNexus', 'src/Etalx/AppNexus');
	$classLoader->register();
	
	
	$upThund = new Thunderhorse();
	$appNex = new AppnexusComponent();
	$creatives = $appNex->generateCreative($imgGenUrls, $dest, HTTP_SERVER . 'image/tmp/');
	foreach($creatives as $creative) {
		$mediaUrl =  $creative['url'];
		$clickUrl = $this->url->link('product/product', 'product_id=' . $pid);
		$width = $creative['w'];
		$height = $creative['h'];
		$cleanName = Thunderhorse::cleanString(strtolower($currentCustomerSeller['ms.company']));
		$creativeName = $cleanName . '_' . $pid . '_' . $order_id . '_' . time();
		$res = $appNex->createCreative($creativeName, $mediaUrl, $clickUrl, $width, $height);
		//Thunderhorse::debug(json_decode($res, true));
	}
}