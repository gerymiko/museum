<section class="content-header">
	<h1>Menu Utama <small>Aplikasi Museum Samarinda</small><button class="btn btn-sm pull-right bg-pusam" data-toggle="modal" data-target="#modal-add-submenu">+ Tambah</button></h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_submenu" class="table table-hover table-bordered" width="100%">
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Deskripsi</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-submenu">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Submenu</h4>
         	</div>
         	<form id="form-add-submenu" method="post" action="#">
	            <div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" rows="3" name="description" maxlength="150"></textarea>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_add_submenu" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-submenu">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Submenu</h4>
         	</div>
         	<form id="form-edit-submenu" method="post" action="#">
         		<input type="hidden" name="id_menu" id="id_menu">
	            <div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" id="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" name="description" id="description" rows="3" maxlength="150"></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Status Aktif</label>
						<select class="form-control required" name="status" id="status">
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
						</select>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_edit_submenu" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu1').addClass('active');
		$('#msm-submenu').addClass('active');
		var table = $('#table_submenu').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"responsive": true,
	        "order": [],
			"ajax": {
				"url" : '<?=site_url()?>../../table/submenu',
				"type" : 'POST',
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left"},
				{ "data": "desc", "className": "text-left text-wrap", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center col-md-1", "searchable": false, "orderable": false }
			]
		});
		$('.modal').on('hide.bs.modal', function (e) {
		 	$(this)
		 	.find("input,select,textarea").val('').end();
		});
		$('#modal-edit-submenu').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button  = $(event.relatedTarget) 
				var id_menu = button.data('id_menu')
				var name    = button.data('name')
				var desc    = button.data('desc')
				var active  = button.data('active')
				var modal   = $(this)
	            modal.find('.modal-title').text('Edit Submenu : '+name)
	            modal.find('#id_menu').val(id_menu)
	            modal.find('#name').val(name)
	            modal.find('#description').val(desc)
	            modal.find('#status').val(active).trigger('change')
         	}
      	});
      	$('#btn_add_submenu').click(function(){
	    	var formData = $("#form-add-submenu").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-submenu").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/add/submenu",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "register") {
						$('#modal-add-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Data sudah terdaftar sebelumnya!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#btn_edit_submenu').click(function(){
	    	var formData = $("#form-edit-submenu").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-submenu").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/edit/submenu",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else {
						$('#modal-edit-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus submenu ini (<b>'+name+'</b>)?',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Hapus',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>../../save/delete/submenu",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',type: "",confirmButtonText: 'Okay',
						    });
						    $('#table_submenu').DataTable().ajax.reload();
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menghapus. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>