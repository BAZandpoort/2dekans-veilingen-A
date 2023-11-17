<script defer>
        function countDown(productId, tijd) {
          const wrapper = document.getElementById('product-' + productId);
          var countDownDate = tijd * 1000;  
          var now = <?php print time() ?> * 1000;
           var x = setInterval(function() {
          now = now + 1000;
   
          var distance = countDownDate - now;

       var days = Math.floor(distance / (1000 * 60 * 60 * 24));
       var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) + Math.floor(days * 24);
       var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
       var seconds = Math.floor((distance % (1000 * 60)) / 1000);

       wrapper.querySelector("#hours").style = "--value:" + hours + ";"
       wrapper.querySelector("#minutes").style = "--value:" + minutes + ";"
       wrapper.querySelector("#seconds").style = "--value:" + seconds + ";"    
           }, 1000);
        }
    </script>