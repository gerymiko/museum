<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="second-content">
         <div class="container-fluid">
            <div class="row">
               <?php
                  $checkdata = count($submenu);
                  if ($checkdata != 0) {
                     foreach ($submenu as $row) {
                        echo '
                        <div class="col-md-4">
                           <a href="'.site_url('../../category/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_menu).'">
                              <div class="box">
                                 <div class="left-content">
                                    <h2>'.ucwords($row->name).'</h2>
                                    <p>'.$row->description.'</p>
                                 </div>
                              </div>
                           </a><br>
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