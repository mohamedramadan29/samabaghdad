 <!-- ./wrapper 
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 jQuery -->
 <script src="plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4  
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
-->
 <!-- Bootstrap 4 -->
 <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- ChartJS -->
 <script src="plugins/chart.js/Chart.min.js"></script>
 <!-- Sparkline -->
 <script src="plugins/sparklines/sparkline.js"></script>
 <!-- JQVMap -->
 <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
 <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
 <!-- jQuery Knob Chart -->
 <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
 <!-- daterangepicker -->
 <script src="plugins/moment/moment.min.js"></script>
 <script src="plugins/daterangepicker/daterangepicker.js"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 <!-- Summernote -->
 <script src="plugins/summernote/summernote-bs4.min.js"></script>
 <!-- overlayScrollbars -->
 <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- DataTables  & Plugins -->
 <script src="plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

 <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="plugins/jszip/jszip.min.js"></script>
 <script src="plugins/pdfmake/pdfmake.min.js"></script>
 <script src="plugins/pdfmake/vfs_fonts.js"></script>
 <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
 <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
 <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 <!-- bs-custom-file-input -->
 <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
 <!-- Select2 -->
 <script src="plugins/select2/js/select2.full.min.js"></script>
 <!--  START TIME PICKER -->

 <!-- jQuery UI -->
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

 <!-- End Time Picker -->
 <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="dist/js/pages/dashboard.js"></script>
 <!-- jQuery -->
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <!-- Ekko Lightbox -->
 <script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
 <!-- AdminLTE App -->
 <script src="dist/js/dropify.min.js"></script>
 <script src="dist/js/adminlte.min.js"></script>
 <script src="dist/js/main.js"></script>
 <!-- confirm delete message   -->
 <script>
   // Select all the buttons with the "confirm-button" class
   var buttons = document.querySelectorAll('.confirm');
   // Loop through the buttons and add a click event listener
   buttons.forEach(function(button) {
     button.addEventListener('click', function(event) {
       // Display the confirmation dialog
       if (!confirm("هل انت متاكد من عملية الحذف ؟ ")) {
         event.preventDefault(); // Prevent the button from doing anything
       }
     });
   });
 </script>
 <!-- To Add More Attribute To Product -->

 


 </body>

 </html>