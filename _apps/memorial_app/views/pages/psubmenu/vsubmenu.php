<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="third-content">
         <div class="container-fluid">
            <div class="main-btn transition-fade"><a href="<?=site_url()?>sekolah">Kembali</a></div>
            <div class="fb-btn" onClick="window.location.href='<?=site_url()?>home'"><a href="#">Halaman Awal</a></div>
            <div class="row">
               <?php
                  foreach ($submenu as $row) {
                     echo '
                     <div class="col-md-6">
                        <a href="'.site_url().$row->alias_name.'/'.$this->my_encryption->encrypt_decrypt('encrypt',$row->id_menu).'">
                           <div class="box">
                              <div class="left-content">
                                 <h2>'.ucwords($row->name).'</h2>
                                 <p>'.$row->description.'</p>
                              </div>
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