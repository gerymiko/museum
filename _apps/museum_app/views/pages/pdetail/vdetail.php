<?php
   if ($detail!==false) {
      $name = $detail->category_name;
      $link = site_url('../../category/').$this->my_encryption->encrypt_decrypt('encrypt',$submenu->id_menu);
   } else {
      $name = $submenu->category_name;
      $link = site_url('../../category/').$this->my_encryption->encrypt_decrypt('encrypt',$submenu->id_menu);
   }
   $checkdata = count($detail_category);
?>
<div class="slide">
   <div class="content transition-fade" id="swup"><br>
      <h4 class="detail">Galeri <?=$name?></h4>
      <div class="fourth-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-6">
                  <div class="main-btn transition-fade"><a href="<?=$link?>">Kembali</a></div>
                  <div class="main-btn transition-fade"><a href="<?=site_url('../../menu')?>">Menu</a></div>
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
            <?php if ($checkdata != 0 ) { foreach ($detail_category as $row) { if ($row->type == 'video') { ?>
               <div style="display:none;" id="<?=$row->type.$row->id_detail?>">
                  <video class="lg-video-object lg-html5" controls preload="none">
                     <source src="<?=site_url('show/file/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail)?>" type="video/mp4">
                     Browser Anda tidak mendukung video HTML5.
                  </video>
               </div>
            <?php } } } ?>
            <div class="demo-gallery boxes">
               <ul id="html5-videos" class="list-unstyled row">
                  <?php                     
                     if ($checkdata != 0 ) {
                        foreach ($detail_category as $row) { 
                           $title = strlen($row->detail_name) > 20 ? substr($row->detail_name,0,20)."..." : $row->detail_name;
                           if ($row->type == 'video') {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video red" data-color="red" data-poster="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail).'" data-sub-html=".caption" data-html="#'.$row->type.$row->id_detail.'" >
                                 <a href="#">
                                    <div class="caption hidden">
                                      <h5>'.$row->detail_name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/vid">
                                    </div>
                                    <p><small><b>'.$row->tanggal.'</b></small>. '.$title.'</p>
                                 </a>
                              </li>';
                           } elseif ($row->type == 'gambar') {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video green" data-color="green" data-sub-html=".caption" data-src="'.site_url('show/file/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail).'">
                                 <a href="#">
                                    <div class="caption hidden">
                                      <h5>'.$row->detail_name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/img">
                                    </div>
                                    <p><small><b>'.$row->tanggal.'</b></small>. '.$title.'</p>
                                 </a>
                              </li>';
                           } else {
                              echo '
                              <li class="col-xs-6 col-sm-4 col-md-3 video blue" data-color="blue" data-iframe="true" data-src="../../../../_assets/img/museum/'.$row->type.'/'.$row->file.'" data-sub-html=".caption">
                                 <a href="#">
                                    <div class="caption hidden">
                                       <h5>'.$row->detail_name.'</h5><p>'.$row->description.'</p>
                                    </div>
                                    <img class="img-responsive" src="'.site_url('show/thumb/').$this->my_encryption->encrypt_decrypt('encrypt',$row->id_detail).'">
                                    <div class="demo-gallery-poster">
                                       <img src="'.site_url().'s_url/icon/doc">
                                    </div>
                                    <p><small><b>'.$row->tanggal.'</b></small>. '.$title.'</p>
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

