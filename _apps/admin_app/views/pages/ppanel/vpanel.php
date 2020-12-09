<section class="content-header">
	<ol class="breadcrumb">
		<li><a class="text-white" href="#">Aplikasi Museum Samarinda</a></li>
	</ol>
</section><br>
<section class="content">
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="callout callout-info">
                <h4>Selamat datang, <?=$this->session->userdata('username')?></h4>
                <p>di aplikasi digital museum Samarinda . . .</p>
            </div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#link-dashboard').addClass('active');
		<?php $pesan = $this->session->flashdata('pesan');
            if(isset($pesan)){ ?>
               swal({ type:'<?=$pesan['type'];?>',title:'<?=$pesan['title'];?>',html:'<?=$pesan['message'];?>',timer:3000}); 
        <?php } ?>
	});
</script>