<div class="slide">
   <div class="content transition-fade" id="swup"><br>
      <h4 class="detail">Galeri <?=$detail->submenu_name?></h4>
      <div class="fourth-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-6">
                  <div class="main-btn transition-fade"><a href="<?=site_url('../../submenu/').$this->my_encryption->encrypt_decrypt('encrypt',$detail->id_sekolah)?>">Kembali</a></div>
                  <div class="main-btn transition-fade"><a href="<?=site_url('../../sekolah')?>">Sekolah</a></div>
                  <div class="fb-btn" onClick="window.location.href='<?=site_url()?>../../home'"><a href="#">Halaman Awal</a></div>
               </div>
               <div class="col-sm-6">
                  <div class="cta filter pull-right">
                     <div class="main-btn"><a class="all active" data-filter="all" href="#" role="button">Semua</a></div>
                     <div class="main-btn"><a class="green main-btn" data-filter="green" href="#" role="button">Foto</a></div>
                     <div class="main-btn"><a class="red main-btn" data-filter="red" href="#" role="button">Video</a></div>
                     <div class="main-btn"><a class="blue main-btn" data-filter="blue" href="#" role="button">Dokumen</a></div>
                  </div>
               </div>
            </div>
            <?php foreach ($ensiklopedia as $row) { if ($row->type == 'video') { ?>
               <div style="display:none;" id="<?=$row->type.$row->id_ensiklo?>">
                  <video class="lg-video-object lg-html5" controls preload="none">
                     <source src="<?=site_url('show/file/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo)?>" type="video/mp4">
                     Browser Anda tidak mendukung video HTML5.
                  </video>
               </div>
            <?php } } ?>
            <div class="demo-gallery boxes">
               <ul id="html5-videos" class="list-unstyled row">
                  <?php
                     $checkdata = count($ensiklopedia);
                     if ($checkdata != 0 ) {
                        foreach ($ensiklopedia as $row) { 
                           $title = strlen($row->name) > 20 ? substr($row->name,0,20)."..." : $row->name;
                           if ($row->type == 'video') {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video red" data-color="red" data-poster="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo).'" data-sub-html=".caption" data-html="#'.$row->type.$row->id_ensiklo.'" >
                                 <a href="#">
                                    <div class="caption hidden">
                                       <h5>'.$row->name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/vid">
                                    </div>
                                    <p><b>'.$row->tanggal.'</b> '.$title.'</p>
                                 </a>
                              </li>';
                           } elseif ($row->type == 'gambar') {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video green" data-color="green" data-src="'.site_url('show/file/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo).'" data-sub-html=".caption">
                                 <a href="#">
                                    <div class="caption hidden">
                                       <h5>'.$row->name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/img">
                                    </div>
                                    <p><b>'.$row->tanggal.'</b> '.$title.'</p>
                                 </a>
                              </li>';
                           } else {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video blue" data-color="blue" data-iframe="true" data-src="../../../../_assets/img/memorial/'.$row->type.'/'.$row->file.'" data-sub-html=".caption">
                                 <a href="#">
                                    <div class="caption hidden">
                                       <h5>'.$row->name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_ensiklo).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/doc">
                                    </div>
                                    <p><b>'.$row->tanggal.'</b> '.$title.'</p>
                                 </a>
                              </li>';
                           }
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
               </ul>
            </div>
         </div>
      </div>
   </div> 
</div>


