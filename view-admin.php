<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'fpcs-basic-social-widget' ); ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" /></p>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'color_background' ); ?>"><?php _e( 'Number of Cars', 'fpcs-basic-social-widget' ); ?></label><br>
	<input type="number" id="<?php echo $this->get_field_id( 'color_background' ); ?>" name="<?php echo $this->get_field_name( 'number_cars' ); ?>" value="<?php echo esc_attr( $number_cars ); ?>" />
</p>
<p>
	<input type="checkbox" id="<?php echo $this->get_field_id('enqueue_style'); ?>" name="<?php echo $this->get_field_name('enqueue_style'); ?>"<?php checked( $enqueue_style ); ?> />&nbsp;
	<label for="<?php echo $this->get_field_id('enqueue_style'); ?>"><?php _e('Enqueue default CSS'); ?></label>
</p>
