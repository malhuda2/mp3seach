<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<!--- META SEO -->

		<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" />
        <title>Download Lagu Mp3 Gratis Indonesia 2017 - {app_name}</title>
        <meta name="description" content="Download lagu Mp3 terbaru Indonesia 2017, Gudang download lagu baru gratis terbaik Indonesia {app_name}"/>
        <meta http-equiv="content-language" content="id"/>
        <meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{app_url}themes/images/mp3-flat.png" />
        <meta property="og:title" content="Download Lagu Mp3 Gratis Indonesia 2017 - {app_name}"/>
        <meta property="og:url" content="{app_url}/" />
        <meta property="og:description" content="Download lagu Mp3 terbaru Indonesia 2017, Gudang download lagu baru gratis terbaik Indonesia {app_name}" />
        <meta property="og:site_name" content="Download lagu terbaru gratis" />
        <meta name="geo.placename" content="Indonesia" />
        <meta name="geo.region" content="ID" />
        <meta name="geo.position" content="-0.789275;113.921327" />
        <meta name="ICBM" content="-0.789275, 113.921327" />
        <meta name="revisit-after" content="1 days" />
        <meta name="robots" content="index, follow" />
        <link rel="dns-prefetch" href="//apis.google.com" />
        <link rel="dns-prefetch" href="//pagead2.googlesyndication.com" />
        <link rel="dns-prefetch" href="//s7.addthis.com" />
        <link rel="dns-prefetch" href="//www.google-analytics.com" />
        <link rel="dns-prefetch" href="//googleads.g.doubleclick.net" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="image_src" href="{app_url}themes/images/mp3-flat.png" />
        <link rel="icon" type="image/png" href="{app_url}themes/images/mp3-flat.png" />
        <link rel="canonical" href="{app_url}/" />
        <link rel="alternate" href="{app_url}/" hreflang="id-id" />


		<!-- END META SEO -->
		<link rel="stylesheet" href="{app_url}themes/Bootstrap.css">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile.structure-1.4.0.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	</head>
	<body>
		<div data-role="page" data-theme="a">
			<div data-role="header" data-position="inline">
				<div data-role="navbar">
					<ul>
						<li><a class="ui-btn-active" href="{app_url}music"><i class="fa fa-music fa-2x" aria-hidden="true"></i> Music</a></li>
					</ul>
				</div>
			</div>
			<div data-role="content" data-theme="a">
				<div class="container">
					<form  method="GET" data-position="inline" action="{app_url}music/search">
						<div class="col-sm-10"><input id="search_key" name="query" class="form-control input-lg" placeholder="Search Song ex : Nella Kharisma - Lungset"></div>
						<div class="col-sm-2"><button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Search</button></div>
					</form>
				</div>
				<ul data-role="listview" data-inset="true" data-divider-theme="a" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
					<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-a ui-first-child">Last Search</li>
					<?php 
						foreach ($last_search as $key => $value) {
						?>
					<li data-icon="eye" class="ui-last-child"><a href="{app_url}music/search?query=<?= urlencode($value['query']) ?>" class="ui-btn ui-btn-icon-right ui-icon-gear"><?= $value['query'] ?></a></li>
					<?php
						}
						?>
				</ul>
				<ul data-role="listview" data-inset="true" data-divider-theme="b" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
					<li data-role="list-divider" role="heading" data-icon="music" class="ui-li-divider ui-bar-b ui-first-child">Popular Search</li>
					<?php 
						foreach ($popular_search as $key => $value) {
						?>
					<li data-icon="bars" class="ui-last-child"><a href="{app_url}music/search?query=<?= urlencode($value['query']) ?>" class="ui-btn ui-btn-icon-right ui-icon-info"><?= $value['query'] ?></a></li>
					<?php } ?>
				</ul>
				<ul data-role="listview" data-inset="true" data-divider-theme="c" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
					<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-c ui-first-child">Top Chart</li>
					<?php 
						foreach ($top_chart as $key => $value) {
						?>
					<li data-icon="grid" class="ui-last-child"><a href="{app_url}music/search?query=<?= urlencode($value) ?>" class="ui-btn ui-btn-icon-right ui-icon-check"><?= $value ?></a></li>
					<?php } ?>
				</ul>
				<div data-role="footer">
					<h4>Time Load : {elapsed_time} | Memory Usage : {memory_usage}</h4> 
				</div>
				<div data-role="footer">
					<h4>Copyright {app_name} &copy; <?= date('Y') ?> All Rights Reserved</h4> 
				</div>
			</div>
		</div>
	</body>
</html>