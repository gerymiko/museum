<section class="content-header">
	<h1>Daftar Kategori <small>Aplikasi Museum Samarinda</small> <button class="btn btn-sm pull-right bg-pusam" data-toggle="modal" data-target="#modal-add-category">+ Tambah</button></h1>
</section>
<section class="content">
	<div class="box no-radius desktop" id="content-filter">
		<div class="box-body">
			<form id="form-filter" action="#" class="form-horizontal">					
				<div class="col-md-4">
					<div class="form-group" style="margin-bottom: 0;">
                        <select class="form-control select2" id="submenu_search" >
                            <option></option>
                            <?php
                            	foreach ($submenu_list as $row) {
                            		echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
                            	}
                            ?>
                        </select>
					</div>
				</div>
				<div class="col-md-4">
	                <div class="form-group" style="margin-bottom: 0;">
                        <input type="text" class="form-control _CalPhaNum" id="category_search" placeholder="Nama Kategori">
					</div>
	            </div>
	            <div class="col-md-3">
	            	<div class="form-group" style="margin-bottom: 0;">
	                  	<select class="form-control select2" id="status_search">
	                  		<option></option>
	                  		<option value="1">Status Aktif</option>
	                  		<option value="0">Status Non Aktif</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-1 text-center desktop">
	            	<div class="form-group" style="margin-bottom: 0;">
						<button type="button" id="btn-filter" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_category" class="table table-hover table-bordered" cellspacing="0" width="100%" >
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Submenu</th>
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
<div class="modal" tabindex="-1" role="dialog" id="modal-add-category">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Kategori</h4>
         	</div>
         	<form id="form-add-category" method="post" action="#" enctype="multipart/form-data" >
	            <div class="modal-body">
	            	<div class="form-group">
	            		<label class="control-label">Pilih Submenu</label>
                        <select class="form-control select2 required" name="id_menu" id="id_menu" >
                            <option></option>
                            <?php
                            	foreach ($submenu_list as $row) {
                            		echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
                            	}
                            ?>
                        </select>
					</div>
					<div style="padding: 17px"></div>
					<div class="form-group">
						<label class="control-label">Nama Kategori</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" rows="3" name="description" maxlength="200"></textarea>
					</div>
					<div class="form-group">
	                  	<label class="control-label">Unggah Foto</label>
	                  	<input type="file" name="addimage" id="addimage" class="form-control required">
	                  	<p class="help-block">* Foto wajib dengan format JPG, jpeg atau PNG dengan maksimal ukuran 600Kb.</p>
	                </div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="submit" id="btn_add_category" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-category">
   <div class="modal-dialog center" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Kategori</h4>
         	</div>
         	<form id="form-edit-category" method="post" action="#" enctype="multipart/form-data" >
         		<input type="hidden" name="id_category" id="id_category">
	            <div class="modal-body">
	            	<div class="form-group">
	            		<label class="control-label">Pilih Submenu</label>
                        <select class="form-control select2 required" name="id_menu" id="id_menu" >
                            <option></option>
                            <?php
                            	foreach ($submenu_list as $row) {
                            		echo '<option value="'.$row->id_menu.'">'.$row->name.'</option>';
                            	}
                            ?>
                        </select>
					</div>
					<div style="padding: 17px"></div>
					<div class="form-group">
						<label class="control-label">Nama Kategori</label>
						<input type="text" class="form-control _CalPhaNum required" id="category" name="name" maxlength="100" value="saas">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" rows="3" id="desc" name="description" maxlength="200">asda</textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Status Aktif</label>
						<select class="form-control required" name="active" id="active">
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
						</select>
					</div>
					<div class="form-group">
	                  	<label class="control-label">Unggah Foto</label>
	                  	<input type="file" name="editimage" id="editimage" class="form-control">
	                  	<p class="help-block">* Foto wajib dengan format JPG, jpeg atau PNG dengan maksimal ukuran 600Kb.</p>
	                </div>
	                <div class="form-group">
	                	<img class="showimageedit img-responsive" width="50%" src="" style="padding-bottom: 5px;">
						<i>* Reload halaman jika file masih tidak ada setelah unggah berkas.</i>
	                </div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="submit" id="btn_edit_category" class="btn btn-danger" >Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<style type="text/css">
	#close {position:absolute;right:-30px;top:0;z-index:999;font-size:2rem;font-weight: normal;color:#fff;opacity:1;}
	tr.group, tr.group:hover { background-image: linear-gradient(to right, #f83600 0%, #DA251C 100%); font-weight: 600;text-transform: uppercase;color: #FFF; }
	.form-group .select2-container{margin-bottom: 0;}
</style>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu1').addClass('active');
		$('#msm-category').addClass('active');
		$('.select2').select2({placeholder: "Pilih"});
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/.,-()' });
		var groupColumn = 1;
		var table = $('#table_category').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
	        "order": [[ groupColumn, 'asc' ]],
			"ajax": {
				"url" : '<?=site_url()?>../../table/category',
				"type" : 'POST',
				data : function(data){ data.submenu_search = $("#submenu_search").val();data.category_search = $("#category_search").val();data.status_search = $("#status_search").val();},
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "submenu", "className": "text-left text-wrap width-100", "visible": false},
				{ "data": "name", "className": "text-left text-wrap width-200"},
				{ "data": "desc", "className": "text-left text-wrap", "searchable": false, "orderable": false },
				{ "data": "img", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center", "searchable": false, "orderable": false }
			],
			"drawCallback": function ( settings ) {
	            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
	            api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ){
	               	if ( last !== group ) {
	                  	$(rows).eq( i ).before( '<tr class="group"><td colspan="8" class="text-center">'+group+'</td></tr>' );
	                  	last = group;
	               	}
	            });
	        }
		});		
		$('#table_category tbody').on( 'click', 'tr.group', function (){
			var currentOrder = table.order()[0];
			if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ){
				table.order( [ groupColumn, 'desc' ] ).draw();
			} else {
				table.order( [ groupColumn, 'asc' ] ).draw();
			}
		});
		$('#btn-filter').click(function(){ table.ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$(".select2").val([]).trigger('change'); table.ajax.reload();});
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
      	$('#modal-edit-category').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button   = $(event.relatedTarget)
				var id       = button.data('id')
				var id_menu  = button.data('id_menu')
				var category = button.data('category')
				var desc     = button.data('desc')
				var active   = button.data('active')
				var img      = button.data('img')
				var modal    = $(this)
				modal.find('#id_category').val(id)
				modal.find('#category').val(category)
				modal.find('#desc').val(desc)
				modal.find('#active').val(active).trigger('change')
				modal.find('.showimageedit').attr("src", img)
				modal.find('#id_menu').val(id_menu).trigger('change')
			}
      	});
		$("#form-add-category").on('submit', function(e) {
			$("#loading").removeClass("hidden");
			e.preventDefault();
			if($("#form-add-category").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.ajax({
					url: "<?=site_url();?>../../save/add/category",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$("#loading").addClass("hidden");
							$('#modal-add-category').modal('hide');
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						} else {
							$("#loading").addClass("hidden");
							$('#modal-add-category').modal('hide');
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					},  
				});
			}
		});
		$("#form-edit-category").on('submit',function(e){
			e.preventDefault();
			$("#loading").removeClass("hidden");
			var formdata = new FormData(this);
			if($("#form-edit-category").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.ajax({
					type: "POST",
					url: "<?=site_url();?>../../save/edit/category",
					data:  formdata,
					contentType: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$("#loading").addClass("hidden");
							$('#modal-edit-category').modal('hide');
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						} else {
							$("#loading").addClass("hidden");
							$('#modal-edit-category').modal('hide');
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					},  
				});
			}
		});
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus kategori ini (<b>'+name+'</b>)?',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Hapus',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>../../save/delete/category",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',type: "",confirmButtonText: 'Okay',
						    });
						    $('#table_category').DataTable().ajax.reload();
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menghapus. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>