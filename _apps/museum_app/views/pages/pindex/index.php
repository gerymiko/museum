<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>MUSEUM SAMARINDA | DINAS KEBUDAYAAN KOTA SAMARINDA</title>
   <meta name="description" content="Dinas Kebudayaan Kota Samarinda" />
   <meta name="author" content="DINAS KEBUDAYAAN" />
   <meta name="production" content="CV. BARENGIN SINERGI NUSANTARA" />
   <meta name="coder" content="@gerymiko" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo/logo_smd"/>
   <?php
      function siteURL(){
         $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
         $domainName = $_SERVER['HTTP_HOST'].'/';
         return $protocol.$domainName;
      }
      define('SITE_URL', siteURL());
      $this->load->view($css_script);
   ?>
</head>
<body><!-- oncontextmenu="return false" -->
   <div class="img-container">
      <img src="<?=site_url()?>s_url/logo/logo_smd" class="blink_me" width="150">
   </div>
   <div class="slides">
      <?php $this->load->view($content);?>
   </div>
   <div class="footer">
      <div class="content">
         <p>Copyright &copy; <?=date("Y")?> <b><a onClick="window.location.href='<?=site_url()?>../../home'" href="#">Dinas Kebudayaan Kota Samarinda</a></b></p>
      </div>
   </div>

   <?php $this->load->view($js_script);?>

   <script type="text/javascript">
      var global = 100;
      function noMovement(){
         if(global==0){
            window.location.href = "<?=site_url()?>../../home";resetGlobal();                
         } else {global--;}
      }
      function resetGlobal(){global=100;}
      setInterval(function(){noMovement()},1000);
      $(document).ready(function(){
         if (window.location.href.indexOf("home")> -1){$('.img-header').addClass('opacity-none');}
         var swup = new Swup({cache: false,debugMode: false,elements: ['#swup']});
         $('html').mousemove(function(event){resetGlobal();});
         $('#clickme, #clickmetoo').on('click',function(){ $('.img-header').removeClass('opacity-none'); });
      });
      function initx() {
         var filters = $('.filter [data-filter]'),boxes = $('.boxes [data-color]');
         filters.on('click', function(e) {
            e.preventDefault();
            var thiss = $(this);
            filters.removeClass('active');
            thiss.addClass('active');
            var filterColor = thiss.attr('data-filter');
            if (filterColor == 'all') {
               boxes.removeClass('is-animated').fadeOut().promise().done(function() {
                  boxes.addClass('is-animated').fadeIn();
               });
            } else {
               boxes.removeClass('is-animated').fadeOut().promise().done(function() {
                  boxes.filter('[data-color = "' + filterColor + '"]').addClass('is-animated').fadeIn();
               });
            }
         });
         $('#clickhome').on('click',function(){ $('.img-header').addClass('opacity-none'); });
         $('.modal').appendTo(".slides");
         $('#html5-videos').lightGallery({download:false,thumbnail:false,zoom: false,fullScreen: false,subHtmlSelectorRelative: true});
      }
      initx();
      document.addEventListener('swup:contentReplaced', initx);
</script>
</body>
</html>