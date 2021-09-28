 <!-- Analytics -->
 <?php require_once('../partials/analytics.php'); ?>
 <!-- jquery-->
 <script src="../public/js/jquery-3.3.1.min.js"></script>
 <!-- Plugins js -->
 <script src="../public/js/plugins.js"></script>
 <!-- Popper js -->
 <script src="../public/js/popper.min.js"></script>
 <!-- Bootstrap js -->
 <script src="../public/js/bootstrap.min.js"></script>
 <!-- Scroll Up Js -->
 <script src="../public/js/jquery.scrollUp.min.js"></script>
 <!-- Custom Js -->
 <script src="../public/js/main.js"></script>
 <!-- Counter Up -->
 <script src="../pubic/js/jquery.counterup.min.js"></script>
 <!-- Moment Js -->
 <script src="../public/js/moment.min.js"></script>
 <!-- Scroll Up Js -->
 <script src="../public/js/jquery.scrollUp.min.js"></script>
 <!-- Chart Js -->
 <script src="../public/js/Chart.min.js"></script>
 <!-- Select 2 Js -->
 <script src="../public/js/select2.min.js"></script>
 <!-- Date Picker Js -->
 <script src="../public/js/datepicker.min.js"></script>
 <!-- Alert Js -->
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
 <!-- Data Tables -->
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

 <script>
     /* Initailize All Plugins Here */
     $(document).ready(function() {
         $('.table').DataTable();
     });

     $(document).ready(function() {
         $('#export-data-table').DataTable({
             dom: 'Bfrtip',
             buttons: [
                 'csv', 'excel', 'pdf', 'print'
             ]
         });
     });
 </script>

 <script>
     /* Student Per Class Charts */
     if ($("#student-per-classes").length) {

         var doughnutChartData = {
             labels: ["Class One ", "Class Two ", "Class Three "],
             datasets: [{
                 backgroundColor: ["#111111", "#249dfa", "#fb7d88"],
                 data: [<?php echo $class_1; ?>, <?php echo $class_2; ?>, <?php echo $class_3; ?>],
                 label: "Total Students"
             }, ]
         };
         var doughnutChartOptions = {
             responsive: true,
             maintainAspectRatio: false,
             cutoutPercentage: 65,
             rotation: -9.4,
             animation: {
                 duration: 2000
             },
             legend: {
                 display: false
             },
             tooltips: {
                 enabled: true
             },
         };
         var studentCanvas = $("#student-per-classes").get(0).getContext("2d");
         var studentChart = new Chart(studentCanvas, {
             type: 'doughnut',
             data: doughnutChartData,
             options: doughnutChartOptions
         });
     }
 </script>

 <script>
     if ($("#student-gender-ratio").length) {

         var doughnutChartData = {
             labels: ["Female Students", "Male Students"],
             datasets: [{
                 backgroundColor: ["#249dfa", "#fb7d88"],
                 data: [<?php echo $female_students; ?>, <?php echo $male_students; ?>],
                 label: "Total Students"
             }, ]
         };
         var doughnutChartOptions = {
             responsive: true,
             maintainAspectRatio: false,
             cutoutPercentage: 65,
             rotation: -9.4,
             animation: {
                 duration: 2000
             },
             legend: {
                 display: false
             },
             tooltips: {
                 enabled: true
             },
         };
         var studentCanvas = $("#student-gender-ratio").get(0).getContext("2d");
         var studentChart = new Chart(studentCanvas, {
             type: 'doughnut',
             data: doughnutChartData,
             options: doughnutChartOptions
         });
     }
 </script>
 <script>
     /* Print Function */
     function printContent(el) {
         var restorepage = $('body').html();
         var printcontent = $('#' + el).clone();
         $('body').empty().html(printcontent);
         window.print();
         $('body').html(restorepage);
     }
 </script>
 <script>
     $('.custom-file input').change(function(e) {
         if (e.target.files.length) {
             $(this).next('.custom-file-label').html(e.target.files[0].name);
         }
     });
 </script>
 <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
