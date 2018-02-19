<?php
$vehicles = get_posts( [
   'posts_per_page' => $number_cars,
   'offset' => 0,
   'orderby' => 'date',
   'order' => 'DESC',
   'post_type' => 'wpcm_vehicle',
   'post_status' => 'publish'
] );
?>

<ul class="fpcs-wpcm-rc-list">

<?php
foreach( $vehicles as $vehicle ):
   $thumbnail = get_the_post_thumbnail( $vehicle, 'thumbnail' );
   $title = $vehicle->post_title;
   $price = Never5\WPCarManager\Helper\Format::price( get_post_meta( $vehicle->ID, 'wpcm_price', true ) );
   $mileage = Never5\WPCarManager\Helper\Format::mileage( get_post_meta( $vehicle->ID, 'wpcm_mileage', true ) );
   $permalink = get_permalink( $vehicle );
?>

   <li>
      <a class="fpcs-wpcm-rc-thumb" href="<?php echo $permalink; ?>"><?php echo $thumbnail; ?></a>
      <div class="fpcs-wpcm-rc-title"><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></div>
      <div class="fpcs-wpcm-rc-attributes">
         <span class="fpcs-wpcm-rc-mileage"><?php echo $mileage; ?> miles | <span class="fpcs-wpcm-rc-price"><?php echo $price; ?></span>
         <a href="<?php echo $permalink; ?>">View Listing &raquo;</a>
      </div>
   </li>

<?php endforeach; ?>

</ul>
