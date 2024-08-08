 <?php
  $stmt = $connect->prepare("SELECT * FROM index_page");
  $stmt->execute();
  $indexdata = $stmt->fetch();

  $footer_text = $indexdata['footer_text'];

  $facebook_link = $indexdata['facebook_link'];
  $whastapp_link  = $indexdata['whastapp_link'];

  $news_title = $indexdata['news_title'];
  $news_desc = $indexdata['news_desc'];

  ?>
 <div class="whatsapp_bottom" data-aos="fade-up">
   <a href="<?php echo $whastapp_link; ?>"> تواصل معنا <i class="fa fa-whatsapp"></i> </a>
 </div>

 <div class="footer">
   <div class="container">

     <!-- <div class="popup-overlay" id="popup-overlay"></div>
     <div class="popup" id="popup">
       <h2> <?php echo $news_title; ?> </h2>
       <p> <?php echo $news_desc; ?> </p>
       <button id="close-popup" class="btn btn-danger btn-sm">إغلاق</button>
     </div> -->

     <style>
       .popup {
         display: none;
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: white;
         padding: 20px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
         z-index: 1000;

         border-radius: 10px;
       }

       @media(max-width:991px) {
         .popup {
           width: 95%;

         }
       }

       .popup h2 {
         font-size: 21px;
         color: #cc0707;
       }

       .popup p {
         line-height: 2;
         color: #434343;

       }

       .popup-overlay {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.5);
         z-index: 999;
       }
     </style>

     <div class="data">
       <div>
         <p> <?php echo $footer_text; ?></p>
       </div>
       <div>
         <ul class="list-unstyled">
           <li> <a href="<?php echo $facebook_link ?>"> <i class="bi bi-facebook"></i> </a> </li>
           <li> <a href="<?php echo $whastapp_link ?>"> <i class="bi bi-whatsapp"></i>  </a> </li>
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



 <script>
   // دالة لإظهار النافذة المنبثقة
   function showPopup() {
     document.getElementById('popup').style.display = 'block';
     document.getElementById('popup-overlay').style.display = 'block';
   }

   // دالة لإخفاء النافذة المنبثقة
   function closePopup() {
     document.getElementById('popup').style.display = 'none';
     document.getElementById('popup-overlay').style.display = 'none';
   }

   document.getElementById('close-popup').addEventListener('click', function() {
     closePopup();
     // حفظ حالة عرض النافذة في sessionStorage
     sessionStorage.setItem('popupShown', 'true');
   });

   // تحقق مما إذا كانت النافذة قد ظهرت من قبل في هذه الجلسة
   if (!sessionStorage.getItem('popupShown')) {
     showPopup();
   }
 </script>


 </body>

 </html>