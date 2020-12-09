<section class="content-header">
	<h1>Alumni <small>Memorial SMPN 1 &amp; SMAN 1 Samarinda</small><button class="btn btn-sm pull-right bg-pusam" data-toggle="modal" data-target="#modal-add-alumni">+ Tambah</button></h1>
</section>
<section class="content" style="min-height: 50px;">
	<form id="form-filter" action="#" class="form-horizontal">					
		<div class="col-md-3">
			<div class="form-group">
                <select class="form-control select2" id="menu_search" >
                    <option></option>
                    <?php
                    	foreach ($submenu_list as $row) {
                    		echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
                    	}
                    ?>
                </select>
			</div>
		</div>
		<div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control _CalPhaNum" id="name_search" placeholder="Nama" maxlength="30">
			</div>
        </div>
        <div class="col-md-2">
        	<div class="form-group">
              	<select class="form-control select2" id="status_search">
              		<option></option>
              		<option value="1">Status Aktif</option>
              		<option value="0">Status Non Aktif</option>
              	</select>
            </div>
        </div>
        <div class="col-md-1 text-center">
        	<div class="form-group">
				<button type="button" id="btn-filter" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
				<button type="button" id="btn-reset" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
			</div>
		</div>
	</form>
</section>
<section class="content">	
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_alumni" class="table table-hover table-bordered" width="100%">
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Kelompok</th>
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
<div class="modal" tabindex="-1" role="dialog" id="modal-add-alumni">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Kelompok Alumni</h4>
         	</div>
         	<form id="form-add-alumni" method="post" action="#">
	            <div class="modal-body">
	            	<div class="form-group">
						<label class="control-label">Sekolah</label>
						<select class="form-control select2 required" name="id_menu">
							<option></option>
							<?php
								foreach ($submenu_list as $row) {
									echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
								}
							?>
						</select>
					</div><br><br>
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" rows="3" name="description" maxlength="200"></textarea>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_add_alumni" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-alumni">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah alumni</h4>
         	</div>
         	<form id="form-edit-alumni" method="post" action="#">
         		<input type="hidden" name="id_alumni" id="id_alumni">
	            <div class="modal-body">
	            	<div class="form-group">
						<label class="control-label">Sekolah</label>
						<select class="form-control select2 required" name="id_menu" id="id_menu">
							<option></option>
							<?php
								foreach ($submenu_list as $row) {
									echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
								}
							?>
						</select>
					</div><br><br>
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" id="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" name="description" id="description" rows="3" maxlength="200"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Status Aktif</label>
								<select class="form-control required" name="active" id="active">
									<option value="1">Aktif</option>
									<option value="0">Non-Aktif</option>
								</select>
							</div>
						</div>
						<div class="col-md-6"></div>
					</div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="button" id="btn_edit_alumni" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<style type="text/css">
	tr.group, tr.group:hover { background-image: linear-gradient(to right, #f83600 0%, #DA251C 100%); font-weight: 600;text-transform: uppercase;color: #FFF; }
</style>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu2').addClass('active');
		$('#mom-alumni').addClass('active');
		$('.select2').select2({placeholder: "Pilih"});
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: "-/:.,()&@" });
		var groupColumn = 1;
		var table = $('#table_alumni').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
	        "order": [[ groupColumn, 'desc' ]],
			"ajax": {
				"url" : '<?=site_url()?>../../table/alumni',
				"type" : 'POST',
				data : function(data){ data.menu_search = $("#menu_search").val();data.name_search = $("#name_search").val();data.status_search = $("#status_search").val();},
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "group", "className": "text-left", "visible": false},
				{ "data": "name", "className": "text-left"},
				{ "data": "desc", "className": "text-left", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center col-md-1", "searchable": false, "orderable": false }
			],
			"drawCallback": function ( settings ) {
	            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
	            api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ){
	               	if ( last !== group ) {
	                  	$(rows).eq( i ).before( '<tr class="group"><td colspan="5" class="text-center">'+group+'</td></tr>' );
	                  	last = group;
	               	}
	            });
	        }
		});
		$('#table_alumni tbody').on( 'click', 'tr.group', function (){
			var currentOrder = table.order()[0];
			if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ){
				table.order( [ groupColumn, 'desc' ] ).draw();
			} else {
				table.order( [ groupColumn, 'asc' ] ).draw();
			}
		});
		$('#btn-filter').click(function(){ table.one( 'draw', function () {table.columns.adjust();}).ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$(".select2").val([]).trigger('change'); table.ajax.reload();});
		$('.modal').on('hide.bs.modal', function (e) {
		 	$(this)
		 	.find("input,textarea").val('').end();
		 	$(".select2").val([]).trigger("change");
		});
		$('#modal-edit-alumni').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button  = $(event.relatedTarget)
				var id_alumni = button.data('id_alumni') 
				var id_menu = button.data('id_menu')
				var name    = button.data('name')
				var desc    = button.data('desc')
				var active  = button.data('active')
				var modal   = $(this)
	            modal.find('.modal-title').text('Edit Alumni : '+name)
	            modal.find('#id_alumni').val(id_alumni)
	            modal.find('#name').val(name)
	            modal.find('#description').val(desc)
	            modal.find('#active').val(active).trigger('change')
	            modal.find('#id_menu').val(id_menu).trigger('change')
         	}
      	});
      	$('#btn_add_alumni').click(function(){
	    	var formData = $("#form-add-alumni").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-add-alumni").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/add/alumni",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-add-alumni').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else if(data == "register") {
						$('#modal-add-alumni').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Data sudah terdaftar sebelumnya!',type: "",confirmButtonText: 'Okay',});
					} else {
						$('#modal-add-alumni').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	    $('#btn_edit_alumni').click(function(){
	    	var formData = $("#form-edit-alumni").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-alumni").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/edit/alumni",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-alumni').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else {
						$('#modal-edit-alumni').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus alumni ini (<b>'+name+'</b>)?',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Hapus',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>../../save/delete/alumni",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',type: "",confirmButtonText: 'Okay',
						    });
						    $('#table_alumni').DataTable().ajax.reload();
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menghapus. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>