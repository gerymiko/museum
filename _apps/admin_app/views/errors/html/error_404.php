<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>MUSEUM SAMARINDA | DINAS KEBUDAYAAN KOTA SAMARINDA</title>
	<meta name="description" content="MUSEUM SAMARINDA" />
	<meta name="keywords" content="MUSEUM SAMARINDA" />
	<meta name="author" content="DINAS KEBUDAYAAN KOTA SAMARINDA" />
	<meta name="production" content="CV. BARENGIN SINERGI NUSANTARA" />
   	<meta name="coder" content="@gerymiko" />
	<link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo_favicon"/>
	<?php
		function siteURL(){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$domainName = $_SERVER['HTTP_HOST'].'/';
			return $protocol.$domainName;
		}
		define('SITE_URL', siteURL());
	?>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/bsn.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/skins/skin-dark.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/font/font.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/custom.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/global/font-awesome/css/all.min.css" />
	<script type="text/javascript" src="<?=siteURL()?>_assets/global/jquery/jquery-3.4.1.min.js"></script>
</head>
<body id="body" class="hold-transition skin-dark layout-top-nav">
	<div class="wrapper">
		<div class="content-wrapper" style="background-image: linear-gradient(120deg, #262D37 0%, #2A343D 100%);">
			<section class="content" style="padding-top: 200px;">
				<div class="error-page">
					<h2 class="headline text-red">404</h2>
					<div class="error-content">
						<h3 class="text-yellow"><i class="fas fa-exclamation-triangle"></i> Oops! Page not found.</h3>
						<p class="text-white">
							We could not find the page you were looking for.
							Meantime, you can return to <br><a href="<?=site_url()?>../../dashboard"><b>Homepage</b></a>
						</p>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
	            <small class="text-museum">Powered by <b>CV BARENGIN SINERGI NUSANTARA</b></small>
	         </div>
			<div class="container">
				Copyright &copy; <?=date("Y");?> <strong><a class="text-orange ls1" href="#">DINAS KEBUDAYAAN KOTA SAMARINDA</a></strong>
			</div>
		</footer>
	</div>
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/dist/js/bsn.min.js"></script>
</body>
</html>