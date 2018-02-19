<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'fpcs-basic-social-widget' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'color_background' ); ?>"><?php _e( 'Number of Cars', 'fpcs-basic-social-widget' ); ?></label><br>
	<input type="number" name="<?php echo $this->get_field_name( 'number_cars' ); ?>" id="<?php echo $this->get_field_id( 'color_background' ); ?>" value="<?php echo $number_cars; ?>" />
</p>
<p>
	<input id="<?php echo $this->get_field_id('enqueue_style'); ?>" name="<?php echo $this->get_field_name('enqueue_style'); ?>" type="checkbox"<?php checked( $enqueue_style ); ?> />&nbsp;
	<label for="<?php echo $this->get_field_id('enqueue_style'); ?>"><?php _e('Enqueue default CSS'); ?></label>
</p>
