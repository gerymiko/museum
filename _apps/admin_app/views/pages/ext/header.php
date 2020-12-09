	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/bsn.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/skins/skin-dark.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/dist/css/custom.css"/>
	<!-- FONTS -->
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/font/font.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/font-awesome/css/all.min.css"/>
	<!-- PLUGIN -->
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/pace/pace.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/admin/toastr/toastr.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>_assets/global/sweetalert/sweetalert2.min.css"/>
	<?php
		if (count($css_script) !== 0) {
			for ($i=0; $i < count($css_script); $i++) { 
				echo $css_script[$i];
			}
		}
	?>
	<!-- JQUERY -->
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/jquery/dist/jquery-3.4.1.min.js"></script>
	
