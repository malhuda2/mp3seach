<!doctype html>
<html>
	<head>

	<?php

	if(!$data->description)
	{
		$diskripsi = "Download Music {$data->title} Di {$app_name} Gratis Disini Menyediakan Konten Lengkap";
	}else{
		$diskripsi = $data->description." Download Di {$app_name} Gratis Kapan Aja ";
	}
	if($value->artwork_url == "")
	{
		$image = "{app_url}themes/images/mp3-flat.png";
	}else{
		$image = $value->artwork_url;
	}	

	?>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		

		<meta http-equiv="Content-Type" content="application/vnd.wap.xhtml+xml; charset=utf-8" />
        <title>Downloa Music <?= htmlentities($data->title) ?> In {app_name}</title>
        <meta name="description" content="<?= $diskripsi ?>"/>
        <meta http-equiv="content-language" content="id"/>
        <meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= $data->artwork_url ?>" />
        <meta property="og:title" content="Download Music <?= htmlentities($data->title) ?> In {app_name} Free"/>
        <meta property="og:url" content="{url_now}" />
        <meta property="og:description" content="<?= $diskripsi ?>" />
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
        <link rel="image_src" href="<?= $data->artwork_url ?>" />
        <link rel="icon" type="image/png" href="{app_url}themes/images/mp3-flat.png" />
        <link rel="canonical" href="{url_now}" />
        <link rel="alternate" href="{url_now}" hreflang="id-id" />	
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
				<?php
					function format_size($size) {
							$mod = 1024;
							$units = explode(' ','B KB MB GB TB PB');
							for ($i = 0; $size > $mod; $i++) {
									$size /= $mod;
							}
							return round($size, 2) . ' ' . $units[$i];
					}
					$csrf = array(
					        'name' => $this->security->get_csrf_token_name(),
					        'hash' => $this->security->get_csrf_hash()
					);
					
									function SEO($input){
									    //SEO - friendly URL String Converter
									    //ex) this is an example -> this-is-an-example
									    $input = str_replace("&nbsp;", " ", $input);
									    $input = str_replace(array("'", ""), "", $input); //remove single quote and dash
									    $input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
									    $input = preg_replace("#[^a-zA-Z]+#", "-", $input); //replace everything non an with dashes
									    $input = preg_replace("#(){2,}#", "$1", $input); //replace multiple dashes with one
									    $input = trim($input, "-"); //trim dashes from beginning and end of string if any
									    $input = iconv('UTF-8', 'ASCII//TRANSLIT', $input);
									    return $input;
									}
					
					 ?>
				<br/><br/><br/> 
						<div class="panel panel-primary">
							<div class="panel-heading">Download Song <?= htmlentities($data->title) ?></div>
							<div class="panel-body">
								 <div class="col-xs-12 col-xs-2">
									<img class="img-responsive img-circle" src="<?= $image ?>" alt="<?= htmlentities($value->title) ?>"></img>
								</div>
							
    <div class="col-xs-12 col-xs-10">
      <p><i class="fa fa-file-audio-o" aria-hidden="true"></i> Name 		 : <?= htmlentities($data->title) ?></p>
      <p><i class="fa fa-file-archive-o" aria-hidden="true"></i> Size 		 : <?= format_size($data->original_content_size) ?></p>
      <p><i class="fa fa-clock-o" aria-hidden="true"></i> Duration 	 : <?= date("i:s", $data->duration / 1000) ?> </p>
      <p><i class="fa fa-sort-desc" aria-hidden="true"></i> Description 	 : <?= htmlentities($data->description) ?> </p>
    </div><div class="col-xs-2"></div>
  <div class="col-xs-10">
    <audio controls>
    <source src="<?= $stream->location ?>" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio>
    <br/>
								<a href="<?= $stream->location ?>" class="btn btn-default" download><i class="fa fa-download"></i> Download MP3 (<?= format_size($data->original_content_size) ?>)</a>
							
	</div>
							</div>
						</div>
						<ul data-role="listview" data-inset="true" data-divider-theme="a" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
							<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-a ui-first-child">Related Song</li>
							<?php 
								foreach ($related as $key => $value) {
								?>
							<li data-icon="grid" class="ui-last-child">
								<div class="col-xs-2">
									<img class="img-responsive img-circle" src="<?= $image ?>" alt="<?= htmlentities($value->title) ?>">
								</div>
								<div class="col-xs-10">
									<h4><?= htmlentities($value->title) ?></h4>
									<span><i class="fa fa-headphones" aria-hidden="true"></i> <?= $value->playback_count ?> Listen</span><br/>
									<span><i class="fa fa-clock-o" aria-hidden="true"></i> <?= date("i:s", $value->duration / 1000) ?></span><br/>
									<span><i class="fa fa-file-o" aria-hidden="true"></i> <?= format_size($value->original_content_size) ?></span><br/>
									<a href="{app_url}music/show/<?= $value->id ?>/<?= SEO($value->title) ?>" class="btn btn-default"><i class="fa fa-download"></i> Download</a>
								</div>
							</li>
							<?php
								}
								?>
						</ul>
						<ul data-role="listview" data-inset="true" data-divider-theme="c" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
							<li data-role="list-divider" role="heading" class="ui-li-divider ui-bar-c ui-first-child">Top Comment</li>
							<?php 
								if(count($comment) == 0)
								{
									print '<li data-icon="grid" class="ui-last-child">No Comment Found On This Song</li>';
								}
								
								foreach ($comment as $key => $value) {
								?>
							<li data-icon="grid" class="ui-last-child">
								<div class="col-xs-2">
									<img class="img-responsive img-circle" src="<?= $value->user->avatar_url ?>">
								</div>
								<div class="col-xs-10">
									<h4> <?= $value->user->username ?> </h4>
									<span><?=  htmlentities($value->body) ?></span>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
				
				<script>
					$('img').error(function(){
					    		$(this).attr('src', '{app_url}themes/images/mp3-flat.png');
					});
				</script>

			</div>
		</div>
	</body>
	
</html>