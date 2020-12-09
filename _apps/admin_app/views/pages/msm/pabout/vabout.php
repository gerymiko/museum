<section class="content-header">
	<h1>Tentang</h1>
	<ol class="breadcrumb">
		<li><a class="text-gray" href="#">Aplikasi Museum Samarinda</a></li>
	</ol>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_about" class="table table-hover table-bordered" width="100%">
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
<div class="modal" tabindex="-1" role="dialog" id="modal-edit-about">
   <div class="modal-dialog center modal750" role="document">
      	<div class="modal-content">
         	<div class="modal-header no-border">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            <span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Ubah Tentang</h4>
         	</div>
         	<form id="form-edit-about" method="post" action="#">
         		<input type="hidden" name="id" id="id">
	            <div class="modal-body">
					<div class="form-group">
						<label class="control-label">Nama</label>
						<input type="text" class="form-control _CalPhaNum required" name="name" id="name" maxlength="100">
					</div>
					<div class="form-group">
						<label class="control-label">Deskripsi</label>
						<textarea class="form-control _CalPhaNum required" name="description" id="description"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Status Aktif</label>
								<select class="form-control required" name="status" id="status">
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
	               <button type="button" id="btn_edit_about" class="btn btn-danger">Simpan</button>
	            </div>
	        </form>
      	</div>
   	</div>
</div>
<script type="text/javascript">
	$(document).ready(function (){
		$('#description').wysihtml5({
			toolbar: { "font-styles": true,"emphasis": true,"lists": true,"link": true,"html": false,"image": false,"color": false,"blockquote": false}
		});
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#menu1').addClass('active');
		$('#msm-about').addClass('active');
		var table = $('#table_about').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": true,
			"responsive": true,
	        "order": [],
			"ajax": {
				"url" : '<?=site_url()?>../../table/about',
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
		$('#modal-edit-about').on('show.bs.modal', function (event) {
         	if (event.namespace == 'bs.modal') {
				var button  = $(event.relatedTarget) 
				var id = button.data('id')
				var name    = button.data('name')
				var desc    = button.data('desc')
				var active  = button.data('active')
				var modal   = $(this)
	            modal.find('#id').val(id)
	            modal.find('#name').val(name)
	            modal.find('#status').val(active).trigger('change')
	            modal.find('#name').val(name)
	            modal.find("iframe[class=wysihtml5-sandbox]").contents().find("body").text(desc)
         	}
      	});
      	$('#btn_edit_about').click(function(){
	    	var formData = $("#form-edit-about").serialize();
	    	$("#loading").removeClass("hidden");
			if($("#form-edit-about").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('Terjadi kesalahan saat mengisi data, mohon periksa kembali.');
				return false;
			} else {
				$.post("<?=site_url();?>../../save/edit/about",
				formData,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-about').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.',type: "",confirmButtonText: 'Okay',});
						table.ajax.reload();
					} else {
						$('#modal-edit-about').modal('toggle');
						$("#loading").addClass("hidden");
						swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal menyimpan. Muat ulang halaman ini dan coba lagi.',type: "",confirmButtonText: 'Okay',});
					}
				});	
			}
	    });
    });
</script>