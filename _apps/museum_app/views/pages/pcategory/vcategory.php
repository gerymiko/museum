<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="third-content">
         <div class="container-fluid">
            <div class="main-btn transition-fade"><a href="<?=site_url()?>../../menu">Kembali</a></div>
            <div class="fb-btn" onClick="window.location.href='<?=site_url()?>../../home'"><a href="#">Halaman Awal</a></div>
            <div class="row">
               <?php
                  $checkdata = count($category);
                  if ($checkdata != 0) {
                     foreach ($category as $row) {
                        echo '
                        <div class="col-md-6">
                           <a href="'.site_url('../../detail/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_category).'">
                              <div class="panel box">
                                 <div class="panel-body">
                                    <h2>'.$row->name.'</h2>
                                    <p><img src="../../_assets/img/museum/category/'.$row->image.'" class="pull-left" width="120">'.ucfirst(strtolower($row->description)).'</p>
                                 </div>
                              </div>
                           </a>
                        </div>';
                     }
                  } else {
                     echo '
                     <div class="col-md-12">
                        <a href="#">
                           <div class="box">
                              <p>Belum ada data untuk saat ini.</p>
                           </div>
                        </a><br>
                     </div>';
                  }
               ?>
            </div>
         </div>
      </div>
   </div>
</div>