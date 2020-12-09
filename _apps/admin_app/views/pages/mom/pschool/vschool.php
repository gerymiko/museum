<section class="content-header">
	<h1>Profil <b>SMPN 1</b> &amp; <b>SMAN 1</b></h1>
	<ol class="breadcrumb">
		<li><a class="text-gray" href="#">Memorial SMPN 1 &amp; SMAN 1 Samarinda</a></li>
	</ol>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_school" class="table table-hover table-bordered" cellspacing="0" border="1" width="100%" >
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Deskripsi</th>
						<th class="text-center">Gambar</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-img">
   <div class="modal-dialog center modal70" role="document">
      <div class="modal-content">
        <div class="modal-body">
        	<button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
	          	<span aria-hidden="true">&times;</span>
	        </button>
           	<img class="showimagefile img-responsive" width="100%" src="" style="padding-bottom: 5px;">
        </div>
      </div>
   </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-school">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Profil Sekolah</h4>
         	</div>
         	<form id="form-edit-school" method="post" action="#" enctype="multipart/form-data" >
         		<input type="hidden" name="id_sekolah" id="id">
	            <div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama Kategori</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" id="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" rows="3" name="description" id="desc" maxlength="200"></textarea>
					</div>
					<div class="form-group">
	            		<label class="control-label">Status Aktif</label>
                        <select class="form-control select2 required" name="active" id="active">
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
					</div>
					<div class="form-group">
	                  	<label class="control-label">Unggah Foto</label>
	                  	<input type="file" name="editimage" id="editimage" class="form-control">
	                  	<p class="help-block">* Foto wajib dengan format JPG, jpeg atau PNG dengan maksimal ukuran 1Mb.<br>
	                  	* Kosongkan kolom unggah jika tidak ingin merubah foto.</p>
	                </div>
	                <div class="form-group">
						<img class="showeditimage img-responsive" src="">
	                </div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="submit" id="btn_edit_school" class="btn btn-danger" >Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<style type="text/css">
	#close {position:absolute;right:-30px;top:0;z-index:999;font-size:2rem;font-weight: normal;color:#fff;opacity:1;}
</style>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu2').addClass('active');
		$('#mom-school').addClass('active');
		$('.select2').select2({placeholder: "Pilih"});
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/.,-()' });
		var table = $('#table_school').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive":true,
	        "order": [],
			"ajax": {
				"url" : '<?=site_url()?>../../table/school',
				"type" : 'POST',
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left text-wrap width-200"},
				{ "data": "desc", "className": "text-left text-wrap", "searchable": false, "orderable": false },
				{ "data": "img", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center col-md-1", "searchable": false, "orderable": false }
			]
		});
		$('.modal').on('hidden.bs.modal', function (e) {
		 	$(this)
		 	.find("input,textarea").val('').end();
		 	$(".select2").val([]).trigger("change");
		});
		$('#modal-img').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var img    = button.data('img')
				var modal  = $(this)
				modal.find('.showimagefile').attr("src", img);
			}
      	});
      	$('#modal-edit-school').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget)
				var id     = button.data('id')
				var name   = button.data('name')
				var desc   = button.data('desc')
				var active = button.data('active')
				var img    = button.data('img')
				var modal  = $(this)
				modal.find('#id').val(id);
				modal.find('#name').val(name);
				modal.find('#desc').val(desc);
				modal.find('.showeditimage').attr("src", img);
				modal.find('#active').val(active).trigger('change')
			}
      	});
      	$("#form-edit-school").on('submit',(function(e) {
			e.preventDefault();
			$("#loading").removeClass("hidden");
			if($("#form-edit-school").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.ajax({
					url: "<?=site_url();?>../../save/edit/school",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
						} else {
							$("#loading").addClass("hidden");
							$('#modal-edit-school').modal('hide');
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					},  
				});
			}
		}));
	});
</script>