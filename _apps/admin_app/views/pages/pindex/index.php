<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <title>MUSEUM SAMARINDA | DINAS KEBUDAYAAN KOTA SAMARINDA</title>
   <meta name="description" content="MUSEUM SAMARINDA" />
   <meta name="author" content="DINAS KEBUDAYAAN KOTA SAMARINDA" />
   <meta name="production" content="CV. BARENGIN SINERGI NUSANTARA" />
   <meta name="coder" content="@gerymiko" />
   <link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo/logo_smd"/>
   <?php
      function siteURL(){
         $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
         $domainName = $_SERVER['HTTP_HOST'].'/';
         return $protocol.$domainName;
      }
      define('SITE_URL', siteURL());
      $this->load->view($header);
   ?>
</head>
<body class="hold-transition skin-dark fixed sidebar-mini">
   <div class="wrapper">
      <div id="loading" class="loading hidden"></div>
      <header class="main-header">
         <a href="#" class="logo">
            <span class="logo-mini"><img src="<?=site_url();?>s_url/logo/logo_smd" width="20"></span>
            <span class="logo-lg"><img src="<?=site_url();?>s_url/logo/logo_disbud" width="150"></span>
         </a>
         <?php $this->load->view($topmenu);?>
      </header>
      <aside class="main-sidebar">
         <?php $this->load->view($sidemenu);?>
      </aside>
      <div class="content-wrapper">
         <?php $this->load->view($content);?>
      </div>
      <footer class="main-footer">
         <div class="pull-right hidden-xs">
            <small class="text-museum">Powered by <b>CV BARENGIN SINERGI NUSANTARA</b></small>
         </div>
         Copyright &copy; <?=date("Y");?> <strong><a href="#" class="text-orange ls1">DINAS KEBUDAYAAN KOTA SAMARINDA</a></strong>
      </footer>
   </div>
   <a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
   <?php $this->load->view($footer); ?>
   <script>
      $(function () {
         $('[data-toggle="popover"]').popover();
         $('[data-toggle="tooltip"]').tooltip();
         $('body').tooltip({selector: '[data-toggle="tooltip"]'});
         $('a[data-toggle="push-menu"]').on('click', function(e){ 
            $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
            $(".dataTables_scrollHeadInner").css( "width", "100%" );
            $(".dataTables_scrollHeadInner table").css( "width", "100%" );
         });
         $('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
         $(window).scroll(function(){ if ($(this).scrollTop() > 100){ $('#scroll').fadeIn();} else { $('#scroll').fadeOut();}}); 
         $('#scroll').click(function(){ $("html, body").animate({ scrollTop: 0 }, 600);return false;}); 
      });
      $(document).ajaxStart(function(){ Pace.restart();});
   </script>
</body>
</html>
