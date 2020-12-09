<section class="content-header">
	<h1>Menu Utama</h1>
	<ol class="breadcrumb">
		<li><a class="text-gray" href="#">Memorial SMPN 1 &amp; SMAN 1 Samarinda</a></li>
	</ol>
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
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-submenu">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Menu</h4>
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
						<textarea class="form-control _CalPhaNum required" name="description" id="description" rows="5" maxlength="200"></textarea>
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
		$('#menu2').addClass('active');
		$('#mom-submenu').addClass('active');
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/.,-()' });
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
	            modal.find('.modal-title').text('Edit Menu : '+name)
	            modal.find('#id_menu').val(id_menu)
	            modal.find('#name').val(name)
	            modal.find('#description').val(desc)
	            modal.find('#status').val(active).trigger('change')
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
</script>