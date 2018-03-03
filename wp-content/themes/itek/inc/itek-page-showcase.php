<?php

class PageShowcaseWidget extends WP_Widget {

	/*
	* construct
	*/
	
	function PageShowcaseWidget() {
		parent::WP_Widget(
			'PageShowcaseWidget'
			, __('iTek Page Showcase', 'itek')
			, array(
				'description' => __('Showcase a Page in any Widget Area - Designed for use with the Showcase Widgets', 'itek'),
			)
		);
	}
	
	function psw_trim($text, $length) {
		// if the text is longer than the length it is supposed to be
		if (strlen($text) > $length){
			// trim to length
			$text = substr($text, 0, $length);
			// find last whitespace in string
			$last_whitespace = strrpos($text, ' ');
			// trim to last whitespace in string
			$text = substr($text, 0, $last_whitespace);
			// append dots
			return $text;
		}
		// if the text is shorter than the trim limit, pass it on
		else {
			return $text;
		}
	}
	
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$page_data = get_page($instance['page_id']);
		$title = $page_data->post_title;
		$permalink = get_permalink($instance['page_id']);
		$thumb = get_the_post_thumbnail($instance['page_id'], 'thumb-widget', array('class' => 'img-circle'));
		
		if ($instance['display_thumb'] == 'on'){
            echo '<a href="'. $permalink .'">'. $thumb . '</a>';
		}
		
		if (!empty($title) && $instance['display_title'] == 'on') {
			
			if ($instance['link_title']){
				echo '<h2 class="entry-title"><a href="'. $permalink .'">'. $title .'</a></h2>';
			}
			else {
				echo '<h2 class="entry-title">'. $title .'</h2>';
			}
			
		};
        
		echo '<p>';
		echo $this->psw_trim($page_data->post_content, $instance['excerpt_length']);
		
		if ($instance['dot_excerpt'] == 'on'){
			echo ' [...]';
		}
		echo '</p>';
		if ($instance['display_read_more'] == 'on'){
			echo ' <a class="itek_psw_readmore" href="'. $permalink .'">'. $instance['read_more_label'] .'</a>';
		}
		
		echo $after_widget;
		
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['page_id'] = strip_tags($new_instance['page_id']);
		$instance['display_thumb'] = strip_tags($new_instance['display_thumb']);
		$instance['link_thumb'] = strip_tags($new_instance['link_thumb']);
		$instance['excerpt_length'] = strip_tags($new_instance['excerpt_length']);
		$instance['dot_excerpt'] = strip_tags($new_instance['dot_excerpt']);
		$instance['display_title'] = strip_tags($new_instance['display_title']);
		$instance['link_title'] = strip_tags($new_instance['link_title']);
		$instance['display_read_more'] = strip_tags($new_instance['display_read_more']);
		$instance['read_more_label'] = strip_tags($new_instance['read_more_label']);
		return $instance;
	}

	function form($instance) {
		$default = 	array(
			  'title'				=> __('Page Showcase Widget', 'itek')
			, 'display_thumb'       => 'of'
			, 'link_thumb'          => '' 
			, 'excerpt_length'		=> 100
			, 'dot_excerpt'			=> 'of'
			, 'page_id'		        => ''
			, 'display_title'		=> 'on'
			, 'link_title'          => ''
			, 'display_read_more'	=> 'of'
			, 'read_more_label'		=> __('Read Full Page', 'itek')
			);
		$instance = wp_parse_args( (array) $instance, $default );
		$page_id = $this->get_field_name('page_id');
		_e('Select Page to display: ', 'itek' );
			?>
			<select name="<?php echo $page_id; ?>">
				<?php
					$pages = get_pages();
					foreach ($pages as $page){
					selected( $page_id );
						if ($page->ID == $instance['page_id']){
							$selected = 'selected="selected"';
						}
						else {
							$selected='';
						}
						echo '<option value="'
							.$page->ID.'"'
							.$selected.'>'
							.$page->post_title
							.'</option>';
					};
				?>
			</select>
		<?php
		
		$field_display_thumb_id = $this->get_field_id('display_thumb');
		$field_display_thumb = $this->get_field_name('display_thumb');
		checked( isset( $display_thumb ) ? $display_thumb : 0 );
				
		if ($instance['display_thumb'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_display_thumb_id
			.'" name="'
			.$field_display_thumb
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_display_thumb_id
			.'">'
			.__('Display Page Thumbnail?', 'itek')
			.' </label></p>';
		
		$field_link_thumb_id = $this->get_field_id('link_thumb');
		$field_link_thumb = $this->get_field_name('link_thumb');
		checked( isset( $link_thumb ) ? $link_thumb : 0 );
		
		if ($instance['link_thumb'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_link_thumb_id
			.'" name="'
			.$field_link_thumb
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_link_thumb_id
			.'">'
			.__('Hyperlink The Thumbnail?', 'itek')
			.' </label></p>';
		
		$field_excerpt_length_id = $this->get_field_id('excerpt_length');
		$field_excerpt_length = $this->get_field_name('excerpt_length');
		echo "\r\n"
			.'<p><label for="'
			.'">'
			.__('Insert Excerpt Length', 'itek')
			.': </label><input type="text" id="'
			.$field_excerpt_length_id
			.'" name="'
			.$field_excerpt_length
			.'" value="'
			.esc_attr( $instance['excerpt_length'] )
			.'" /></p>';
		
		$field_dot_excerpt_id = $this->get_field_id('dot_excerpt');
		$field_dot_excerpt = $this->get_field_name('dot_excerpt');
		checked( isset( $dot_excerpt ) ? $dot_excerpt : 0 );
		
		if ($instance['dot_excerpt'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_dot_excerpt_id
			.'" name="'
			.$field_dot_excerpt
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_dot_excerpt_id
			.'">'
			.__('Show `[...]` after excerpt?', 'itek')
			.' </label></p>';
		
		$field_display_title_id = $this->get_field_id('display_title');
		$field_display_title = $this->get_field_name('display_title');
		checked( isset( $display_title ) ? $display_title : 0 );
		
		if ($instance['display_title'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_display_title_id
			.'" name="'
			.$field_display_title
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_display_title_id
			.'">'
			.__('Display The Page Title?', 'itek')
			.' </label></p>';
		
		$field_link_title_id = $this->get_field_id('link_title');
		$field_link_title = $this->get_field_name('link_title');
		checked( isset( $link_title ) ? $link_title : 0 );
		
		if ($instance['link_title'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_link_title_id
			.'" name="'
			.$field_link_title
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_link_title_id
			.'">'
			.__('Hyperlink The Page Title?', 'itek')
			.' </label></p>';
		
		$field_display_read_more_id = $this->get_field_id('display_read_more');
		$field_display_read_more = $this->get_field_name('display_read_more');
		checked( isset( $display_read_more ) ? $display_read_more : 0 );
		
		if ($instance['display_read_more'] == 'on'){
			$checked = 'checked="checked"';
		}
		else {
			$checked = '';
		}
		
		echo "\r\n"
			.'<p><input type="checkbox" id="'
			.$field_display_read_more_id
			.'" name="'
			.$field_display_read_more
			.'" value="on"'
			.$checked
			.'/> <label for="'
			.$field_display_read_more_id
			.'">'
			.__('Show Read More Link?', 'itek')
			.' </label></p>';
		
		$field_read_more_label_id = $this->get_field_id('read_more_label');
		$field_read_more_label = $this->get_field_name('read_more_label');
		echo "\r\n"
			.'<p><label for="'
			.$field_read_more_label_id
			.'">'
			.__('Read More Label')
			.': </label><input type="text" id="'
			.$field_read_more_label_id
			.'" name="'
			.$field_read_more_label
			.'" value="'
			.esc_attr( $instance['read_more_label'] ).'"'
			.'placeholder="Read Full Page"'
			.'/></p>';
		
		
	}
	
/* class end */
}

if ( ! function_exists( 'page_showcase_widgets' ) ) :

function page_showcase_widgets(){
	register_widget('PageShowcaseWidget');
}
add_action('widgets_init', 'page_showcase_widgets');
endif;
?>