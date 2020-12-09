	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/dist/js/bsn.min.js"></script>
	<!-- PLUGIN -->
	<script type="text/javascript" src="<?=siteURL()?>_assets/global/alphanum/jquery.alphanum.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/global/validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/global/sweetalert/sweetalert2.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/fastclick/fastclick.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>_assets/admin/pace/pace.min.js"></script>
    <script type="text/javascript" src="<?=siteURL()?>_assets/admin/toastr/toastr.min.js"></script>
	<?php
		if (count($js_script) !== 0) {
			for ($i=0; $i < count($js_script); $i++) { 
				echo $js_script[$i];
			}
		}
	?>
