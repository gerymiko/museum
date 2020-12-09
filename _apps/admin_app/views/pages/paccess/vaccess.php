<section class="content-header">
	<h1>Master User <small>Aplikasi Museum Samarinda</small>
		<button class="btn btn-sm pull-right bg-pusam" data-toggle="modal" data-target="#modal-add-user">+ Tambah</button>
	</h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_user" class="table table-hover table-bordered" width="100%">
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Username</th>
						<th class="text-center">Level</th>
						<th class="text-center">Terdaftar</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="modal-add-user">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah User</h4>
         	</div>
         	<form id="form-add-user" method="post" action="#">
	            <div class="modal-body">
	            	<div class="form-group">
						<label class="control-label">Level User</label>
						<select class="form-control select2 required" name="level">
							<option value="1">Administrator</option>
							<option value="2">Public User</option>
						</select>
					</div><br><br>
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type="text" class="form-control _CalPhaNum required" name="username" maxlength="20">
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" class="form-control _CalPhaNum required" name="password" maxlength="30">
						<span>* Gunakan kombinasi huruf dan angka saja.</span>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_add_user" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-user">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah User</h4>
         	</div>
         	<form id="form-edit-user" method="post" action="#">
         		<input type="hidden" name="id_user" id="id_user">
	            <div class="modal-body">
	            	<div class="form-group">
						<label class="control-label">Level User</label>
						<select class="form-control select2 required" name="level" id="level">
							<option value="1">Administrator</option>
							<option value="2">Public User</option>
						</select>
					</div><br><br>
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type="text" class="form-control _CalPhaNum required" name="username" id="username" maxlength="20">
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" class="form-control _CalPhaNum" name="new_password" maxlength="30">
						<span>* Gunakan kombinasi huruf dan angka saja.<br>
						* Kosongkan jika tidak ingin merubah password.</span>
					</div>
					<div class="form-group">
						<label class="control-label">Status Aktif</label>
						<select class="form-control required" name="active" id="active">
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
						</select>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_edit_user" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#link-user').addClass('active');
		$('.select2').select2({placeholder: "Pilih"});
		$('._CalPhaNum').alphanum({ allowNumeric: true });
		var table = $('#table_user').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"responsive": true,
	        "order": [],
			"ajax": {
				"url" : '<?=site_url()?>../../table/user',
				"type" : 'POST',
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "username", "className": "text-left"},
				{ "data": "level", "className": "text-center", "searchable": false },
				{ "data": "register", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center col-md-1", "searchable": false, "orderable": false }
			]
		});
		$('.modal').on('hide.bs.modal', function (e) {
		 	$(this).find("input").val('').end();
		 	$('.select2').val('').trigger('change');
		});
		$('#modal-edit-user').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button   = $(event.relatedTarget) 
				var id_user  = button.data('id_user')
				var username = button.data('username')
				var level    = button.data('level')
				var active   = button.data('active')
				var modal    = $(this)
	            modal.find('.modal-title').text('Edit User : '+username)
	            modal.find('#id_user').val(id_user)
	            modal.find('#username').val(username)
	            modal.find('#level').val(level).trigger('change')
	            modal.find('#active').val(active).trigger('change')
         	}
      	});
      	$('#btn_add_user').click(function(){
	    	var formData = $("#form-add-user").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/add/user",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-submenu').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "register") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Data sudah terdaftar sebelumnya!',type: "",confirmButtonText: 'Okay',});
					} else if(data == "notsecure") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gunakan kombinasi huruf dan angka untuk password!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#btn_edit_user').click(function(){
	    	var formData = $("#form-edit-user").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-user").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/edit/user",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "register") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gunakan username yang lain',type: "",confirmButtonText: 'Okay',});
					} else if(data == "notsecure") {
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gunakan kombinasi huruf dan angka untuk password!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-edit-user').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus user ini (<b>'+name+'</b>)?',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Hapus',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>access/caccess/delete_user",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',type: "",confirmButtonText: 'Okay',
						    }).then(function(){$('#table_user').DataTable().ajax.reload();});
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menghapus. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>