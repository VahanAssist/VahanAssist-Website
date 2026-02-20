 <?php $getOdersCount = $this->Manage_product->getOdersCount('');
             $count  = count($getOdersCount);
             if ($count!=0) {
                 //echo "alert";
          
              ?>
<a href="<?php base_url(); ?>Main_con/orders">New Order</a>
              <audio controls autoplay hidden>
  <!-- <source src="horse.ogg" type="audio/ogg"> -->
  <source src="<?php base_url(); ?>images/sound.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>

<?php } ?>