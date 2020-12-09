<section class="content-header">
	<h1>Detail Kategori <small>Memorial SMPN 1 &amp; SMAN 1 Samarinda</small> <button class="btn btn-sm pull-right bg-pusam" data-toggle="modal" data-target="#modal-add-detail">+ Tambah</button></h1>
</section>
<section class="content" style="min-height: 50px">
	<form id="form-filter" action="#" class="form-horizontal">					
		<div class="col-md-3">
			<div class="form-group">
                <select class="form-control select2" id="category_search" >
                    <option></option>
                    <?php
                    	foreach ($category_list as $row) {
                    		echo '<option value="'.$row->id_category.'">'.$row->name.'</option>';
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
        <div class="col-md-3">
			<div class="form-group">
                <select class="form-control select2" id="type_search" >
                    <option></option>
                    <option value="gambar">Foto</option>
                    <option value="video">Video</option>
                    <option value="dokumen">Dokumen</option>
                </select>
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
        <div class="col-md-1 text-right">
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
			<table id="table_detail" class="table table-hover table-bordered" cellspacing="0" width="100%" >
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Deskripsi</th>
						<th class="text-center">Tipe</th>
						<th class="text-center">Thumb</th>
						<th class="text-center">File</th>
						<th class="text-center">Status</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<div class="modal fade" id="modal-img" tabindex="-1" role="dialog" aria-hidden="true">
   	<div class="modal-dialog center modal700" role="document">
      	<div class="modal-content">
        	<div class="modal-body">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
           		<img class="showimagefile img-responsive" width="100%" src="" style="padding-bottom: 5px;">
        	</div>
      	</div>
   	</div>
</div>
<div class="modal fade" id="modal-vid" tabindex="-1" role="dialog" aria-hidden="true">
   	<div class="modal-dialog modal-dialog-video center modal700">
      	<div class="modal-content">
        	<div class="modal-body modal-body-video">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
				<div class="embed-responsive embed-responsive-16by9">
				  	<iframe class="embed-responsive-item showvideofile" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
				</div>
        	</div>
      	</div>
   	</div>
</div>
<div class="modal fade" id="modal-doc" tabindex="-1" role="dialog" aria-hidden="true">
   	<div class="modal-dialog center modal700" role="document">
      	<div class="modal-content">
        	<div class="modal-body">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        </button>
           		<iframe width="100%" height="550" class="showdocfile" src=""></iframe>
        	</div>
      	</div>
   	</div>
</div>
<div class="modal fade" id="modal-add-detail" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal700" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Detail</h4>
         	</div>
         	<form id="form-add-detail" method="post" action="#" enctype="multipart/form-data" >
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
			            		<label class="control-label">Pilih Kategori Alumni</label>
		                        <select class="form-control select2 required" name="id_category" >
		                            <option></option>
		                            <?php
				                    	foreach ($category_list as $row) {
				                    		echo '<option value="'.$row->id_category.'">'.$row->name.'</option>';
				                    	}
				                    ?>
		                        </select>
							</div><br><br>
							<div class="form-group">
								<label class="control-label">Deskripsi</label>
								<textarea class="form-control _CalPhaNum required" rows="5" name="description" maxlength="200">asdasd</textarea>
							</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
								<label class="control-label">Nama Item</label>
								<input type="text" class="form-control _CalPhaNum required" name="name" maxlength="200" value="asd">
							</div>
							<div class="form-group">
			            		<label class="control-label">Pilih Tipe File</label>
		                        <select class="form-control select2 required" name="type" id="type">
		                            <option></option>
		                            <option value="gambar">Foto</option>
		                            <option value="video">Video</option>
		                            <option value="dokumen">Dokumen</option>
		                        </select>
							</div><br><br>
	            		</div>
	            	</div>
					<div class="form-group">
	                  	<label class="control-label">Unggah File</label>
	                  	<input type="file" name="addfile[]" class="form-control required">
	                  	<p class="help-block">* File wajib dengan format JPG, jpeg atau PNG untuk foto, MP4 untuk video dan PDF untuk dokumen dengan maksimal ukuran 20Mb.</p>
	                </div>
	                <div class="form-group hidden" id="img_thumb">
	                  	<label class="control-label">Unggah thumbnail</label>
	                  	<input type="file" name="addfile[]" class="form-control required" disabled>
	                  	<p class="help-block">* File wajib dengan format JPG, jpeg atau PNG maksimal ukuran 1Mb.</p>
	                </div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="submit" class="btn btn-danger" >Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<div class="modal fade" id="modal-edit-detail" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal700" role="document">
      	<div class="modal-content ">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Detail</h4>
         	</div>
         	<form id="form-edit-detail" method="post" action="#" enctype="multipart/form-data" >
         		<input type="hidden" name="id_detail" id="id_detail">
	            <div class="modal-body">
	            	<div class="row">
	            		<div class="col-md-6">
	            			<div class="form-group">
			            		<label class="control-label">Pilih Menu</label>
		                        <select class="form-control select2 required" name="id_category" id="id_category" >
		                            <option></option>
		                            <?php
				                    	foreach ($category_list as $row) {
				                    		echo '<option value="'.$row->id_category.'">'.$row->name.'</option>';
				                    	}
				                    ?>
		                        </select>
		                    </div><br><br>
	                        <div class="form-group">
								<label class="control-label">Deskripsi</label>
								<textarea class="form-control _CalPhaNum required" rows="8" name="description" id="description" maxlength="200"></textarea>
							</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
								<label class="control-label">Nama Detail</label>
								<input type="text" class="form-control _CalPhaNum required" name="name" id="name" maxlength="200" >
							</div>
							<div class="form-group">
			            		<label class="control-label">Status Aktif</label>
		                        <select class="form-control select2 required" name="active" id="active">
		                            <option value="1">Aktif</option>
		                            <option value="0">Non Aktif</option>
		                        </select>
							</div><br><br>
							<div class="form-group">
								<label class="control-label">Tipe File</label>
								<input type="text" class="form-control" name="type" id="type_edit" maxlength="10" readonly>
							</div>
	            		</div>
	            	</div>
					<div class="form-group">
	                  	<label class="control-label">Unggah File</label>
	                  	<input type="file" name="editfile[]" class="form-control">
	                  	<p class="help-block">* File wajib dengan format JPG, jpeg atau PNG untuk gambar, MP4 untuk video dan PDF untuk dokumen dengan maksimal ukuran 20Mb.</p>
	                </div>
	                <div class="form-group hidden" id="img_thumb_edit">
	                  	<label class="control-label">Unggah thumbnail</label>
	                  	<input type="file" name="editfile[]" class="form-control" disabled>
	                  	<p class="help-block">* File wajib dengan format JPG, jpeg atau PNG maksimal ukuran 1Mb.</p>
	                </div>
	            </div>
	            <div class="modal-footer no-border">
	               <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	               <button type="submit" id="btn_edit_detail" class="btn btn-danger" >Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<style type="text/css">
	.dataTables_filter {display: none;}
	tr.group, tr.group:hover { background-image: linear-gradient(to right, #f83600 0%, #DA251C 100%); font-weight: 600;text-transform: uppercase;color: #FFF; }
	.modal-dialog-video {max-width: 800px;margin: 30px auto;}
	.modal-body-video {position:relative;padding:0px;}
	.close {position:absolute;right:-30px;top:0;z-index:999;font-size:2rem;font-weight: normal;color:#fff;opacity:1;}
</style>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu2').addClass('active');
		$('#mom-alumni-detail').addClass('active');
		$('.select2').select2({placeholder: "Pilih"});
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: "-/:.,()&@" });
		var groupColumn = 1;
		var table = $('#table_detail').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"responsive": true,
			"dom": "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
	         "<'row'<'col-sm-12'tr>>" +
	         "<'row'<'col-sm-5'i><'col-sm-7'p>>",
	        "order": [[ groupColumn, 'desc' ]],
			"ajax": {
				"url" : '<?=site_url()?>../../table/alumni/detail',
				"type" : 'POST',
				data : function(data){ data.category_search = $("#category_search").val();data.name_search = $("#name_search").val();data.status_search = $("#status_search").val();data.type_search = $("#type_search").val();},
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "category", "className": "text-left", "visible": false},
				{ "data": "name", "className": "text-left text-wrap"},
				{ "data": "desc", "className": "text-left text-wrap", "searchable": false, "orderable": false },
				{ "data": "type", "className": "text-left", "searchable": false, "orderable": false },
				{ "data": "thumb", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "item", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center col-md-1", "searchable": false },
				{ "data": "action", "className": "text-center", "searchable": false, "orderable": false }
			],
			"drawCallback": function ( settings ) {
	            var api = this.api(), rows = api.rows( { page:'current' } ).nodes(), last = null;
	            api.column(groupColumn, { page:'current' } ).data().each( function ( group, i ){
	               	if ( last !== group ) {
	                  	$(rows).eq( i ).before( '<tr class="group"><td colspan="9" class="text-center">'+group+'</td></tr>' );
	                  	last = group;
	               	}
	            });
	        }
		});
		$('#btn-filter').click(function(){ table.one( 'draw', function () {table.columns.adjust();}).ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$(".select2").val([]).trigger('change'); table.ajax.reload();});
		$('#table_detail tbody').on( 'click', 'tr.group', function (){
			var currentOrder = table.order()[0];
			if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ){
				table.order( [ groupColumn, 'desc' ] ).draw();
			} else {
				table.order( [ groupColumn, 'asc' ] ).draw();
			}
		});
		$('#type').on('change', function() {
	      	var data = $("#type option:selected").val();
	      	if (data !== "gambar") {
	      		$('#img_thumb').removeClass('hidden');
	      		$("#img_thumb input").attr("disabled", false);
	      	} else {
	      		$('#img_thumb').addClass('hidden');
	      		$("#img_thumb input").attr("disabled", true);	
	      	}
	    });
		$('#modal-img').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var img    = button.data('img')
				var modal  = $(this)
				modal.find('.showimagefile').attr("src", img);
			}
      	});
      	$('#modal-doc').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var doc    = button.data('doc')
				var modal  = $(this)
				modal.find('.showdocfile').attr("src", doc);
			}
      	});
      	$('#modal-vid').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button = $(event.relatedTarget) 
				var vid    = button.data('vid')
				var modal  = $(this)
				modal.find('.showvideofile').attr("src", vid);
			}
      	});
      	$('#modal-vid').on('hide.bs.modal', function (event) {
		    if (event.namespace == 'bs.modal') {
				$(".showvideofile").attr("src", "");
			}
		});
		$('#modal-edit-detail').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button     = $(event.relatedTarget)
				var id_detail = button.data('id_detail')
				var id_category    = button.data('id_category')
				var name       = button.data('name')
				var desc       = button.data('desc')
				var date       = button.data('date')
				var type       = button.data('type')
				var active     = button.data('active')
				var file       = button.data('file')
				var thumb      = button.data('thumb')
				var modal      = $(this)
				modal.find('#id_detail').val(id_detail)
				modal.find('#name').val(name)
				modal.find('#description').val(desc)
				modal.find('#date').val(date)
				modal.find('#active').val(active).trigger('change')
				modal.find('#type_edit').val(type)
				modal.find('#id_category').val(id_category).trigger('change')
				if (type != "gambar") {
					$('#img_thumb_edit').removeClass('hidden');
					$("#img_thumb_edit input").attr("disabled", false);
				}
			}
      	});
      	$('.modal').on('hidden.bs.modal', function (e) {
		 	$(this)
		 	.find("input,textarea").val('').end()
		 	.find("input[type=file]").val('').end();
		 	$(".select2").val([]).trigger("change");
		});
		$("#form-add-detail").on('submit',(function(e) {
			e.preventDefault();
			$("#loading").removeClass("hidden");
			if($("#form-add-detail").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.ajax({
					url: "<?=site_url();?>../../save/add/alumni/detail",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$("#loading").addClass("hidden");
							$('#modal-add-detail').modal('hide');
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
						} else {
							$("#loading").addClass("hidden");
							$('#modal-add-detail').modal('hide');
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					},  
				});
			}
		}));
		$("#form-edit-detail").on('submit',(function(e) {
			e.preventDefault();
			$("#loading").removeClass("hidden");
			if($("#form-edit-detail").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.ajax({
					url: "<?=site_url();?>../../save/edit/alumni/detail",
					type: "POST",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					success: function(data){
						if(data !== 'Success'){
							$("#loading").addClass("hidden");
							$('#modal-edit-detail').modal('hide');
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
						} else {
							$("#loading").addClass("hidden");
							$('#modal-edit-detail').modal('hide');
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
							table.ajax.reload();
						}
					},  
				});
			}
		}));
	});
	function removeData(id, name){
	    swal({
	        title: "",html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus detail ini (<b>'+name+'</b>)?',type: "",
	        showCancelButton: true,focusConfirm: false,confirmButtonText: 'Okay, Hapus',confirmButtonAriaLabel: 'Ok',cancelButtonText: '<i class="fas fa-times"></i>',cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value){
			    $.ajax({
					url: "<?=site_url()?>../../save/delete/alumni/detail",
					type: "post",
					data: { id:id, name:name },
					success:function(data){
						if(data == "Success"){
							$('#table_detail').DataTable().ajax.reload();
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',type: "",confirmButtonText: 'Okay',
						    });
						} else {
							swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menghapus. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay'});
						}
					},
				});
			}
	    });
	}
</script>