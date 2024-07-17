 <?php
  $stmt = $connect->prepare("SELECT * FROM index_page");
  $stmt->execute();
  $indexdata = $stmt->fetch();

  $footer_text = $indexdata['footer_text'];

  $facebook_link = $indexdata['facebook_link'];
  $whastapp_link	= $indexdata['whastapp_link'];


  ?>
 <div class="whatsapp_bottom" data-aos="fade-up">
   <a href="<?php echo $whastapp_link; ?>"> تواصل معنا <i class="fa fa-whatsapp"></i> </a>
 </div>

 <div class="footer">
   <div class="container">
     <div class="data">
       <div>
         <p>  <?php echo $footer_text; ?></p>
       </div>
       <div>
         <ul class="list-unstyled">
           <li> <a href="<?php echo $facebook_link ?>"> <i class="fa fa-facebook"></i> </a> </li>
           <li> <a href="<?php echo $whastapp_link ?>"> <i class="fa fa-whatsapp"></i> </a> </li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 <script src='<?php echo $js; ?>/jquery.min.js'></script>
 <script src='<?php echo $js; ?>/bootstrap.min.js'></script>
 <script src="https://kit.fontawesome.com/588e070751.js" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
 <!--  END SLICK  -->
 <script src='<?php echo $js; ?>/main.js'></script>


 <script>
   // Initialize AOS
   AOS.init({
     duration: 800, // Animation duration
     easing: 'ease-in-out', // Easing type
     once: true // Only animate elements once
   });
 </script>
 </body>

 </html>