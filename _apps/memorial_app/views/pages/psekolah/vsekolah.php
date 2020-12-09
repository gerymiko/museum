<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="second-content">
         <div class="container-fluid">
            <div class="row">
               <?php
                  foreach ($sekolah as $row) {
                     echo '
                     <div class="col-md-6">
                        <a href="'.site_url('submenu/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_sekolah).'">
                           <div class="box">
                              <img width="100%" src="'.site_url().'csekolah/poster_sekolah/'.$this->my_encryption->encrypt_decrypt('encrypt',$row->id_sekolah).'">
                              <div class="left-content">
                                 <h2>'.ucwords($row->name).'</h2>
                                 <img class="left-image" src="'.site_url().'csekolah/logo_sekolah/'.$this->my_encryption->encrypt_decrypt('encrypt',$row->id_sekolah).'">
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