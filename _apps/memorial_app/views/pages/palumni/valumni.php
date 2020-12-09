<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="fifth-content">
         <h4 class="detail text-center"><?=$alumni->submenu_name?></h4>
         <div class="container-fluid">
            <div class="main-btn transition-fade"><a href="<?=site_url('../../submenu/').$this->my_encryption->encrypt_decrypt('encrypt', $alumni->id_sekolah)?>">Kembali</a></div>
            <div class="main-btn transition-fade"><a href="<?=site_url()?>../../sekolah">Sekolah</a></div>
            <div class="fb-btn" onClick="window.location.href='<?=site_url()?>../../home'"><a href="#">Halaman Awal</a></div>
            <div class="row">
               <?php
                  foreach ($alumni_list as $row) {
                     if ($row->id_sekolah == 1) {
                        $icon = '<img src="../../../_assets/img/memorial/logo/item_smp.png" width="50" style="float: left; margin-right: 10px;padding-top:5px;">';
                     } else {
                        $icon = '<img src="../../../_assets/img/memorial/logo/item_sma.png" width="50" style="float: left; margin-right: 10px;padding-top:5px;">';
                     }
                     echo '
                     <div class="col-md-6">
                        <a href="'.site_url('../../category/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_alumni).'">
                           <div class="box">
                              <h2>'.ucwords($row->alumni_name).'</h2>
                              '.$icon.'
                              <p>'.$row->description.'</p>
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