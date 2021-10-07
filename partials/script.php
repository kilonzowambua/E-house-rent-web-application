
    <script src="../public/vendors/jquery/dist/jquery.min.js"></script>
    <script src="../public/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../public/assets/js/main.js"></script>
    <script src="../public/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="../public/assets/js/dashboard.js"></script>
    <script src="../public/assets/js/widgets.js"></script>
    <script src="../public/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="../public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="../public/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../public/plugins/iziToast/iziToast.min.js"></script>
 <!-- Initialize Alerts -->
 <?php if (isset($success)) { ?>
     <script>
         iziToast.success({
             title: 'Success',
             position: 'center',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $success; ?>',
         });
     </script>

 <?php } ?>

 <?php if (isset($err)) { ?>
     <script>
         iziToast.error({
             title: 'Error',
             timeout: 10000,
             resetOnHover: true,
             position: 'center',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $err; ?>',
         });
     </script>

 <?php } ?>

 <?php if (isset($info)) { ?>
     <script>
         iziToast.warning({
             title: 'Warning',
             position: 'center',
             transitionIn: 'flipInX',
             transitionOut: 'flipOutX',
             transitionIn: 'fadeInUp',
             transitionInMobile: 'fadeInUp',
             transitionOutMobile: 'fadeOutDown',
             message: '<?php echo $info; ?>',
         });
     </script>

 <?php }
    ?>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>
