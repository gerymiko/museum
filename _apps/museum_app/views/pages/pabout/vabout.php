<div class="slide">
   <div class="content transition-fade" id="swup">
      <div class="about-content">
         <div class="container-fluid">
            <div class="main-btn transition-fade pull-right" id="clickhome"><a href="<?=site_url()?>../../home">Kembali</a></div>
            <div class="row">
               <div class="col-md-6">
                  <div class="left-content">
                     <h2>TENTANG</h2>
                     <?php
                        foreach ($about as $row) {
                           echo '<h6>'.$row->name.'</h6>'.html_entity_decode($row->description).'<br>';
                        }
                     ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="right-image">
                     <img src="_assets/img/about_image.jpg" alt="MUSEUM SAMARINDA">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>