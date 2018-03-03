<?php
function business_prime_get_social_block() {
    $open_new_tab  = (get_theme_mod('business_prime_social_new_tab', true)) ? 'target="_blank"' : '';
    $link_facebook = get_theme_mod('business_prime_social_link_facebook');
    $link_google   = get_theme_mod('business_prime_social_link_google');
    $link_youtube  = get_theme_mod('business_prime_social_link_youtube');
    $link_twitter  = get_theme_mod('business_prime_social_link_twitter');
    $link_linkedin = get_theme_mod('business_prime_social_link_linkedin');
    $is_all_empty  = true;
    ?>
        <ul class="f_social">
            <?php if (!empty($link_facebook)): $is_all_empty = false;?>
	            <li class="facebook"><a href="<?php echo esc_url($link_facebook); ?>"  <?php echo esc_attr($open_new_tab); ?>><i class="fa fa-facebook icon"></i></a></li>
	            <?php endif;?>
            <?php if (!empty($link_google)): $is_all_empty = false;?>
	            <li class="google"><a href="<?php echo esc_url($link_google); ?>"  <?php echo esc_attr($open_new_tab); ?>><i class="fa fa-google-plus icon"></i></a></li>
	            <?php endif;?>
            <?php if (!empty($link_youtube)): $is_all_empty = false;?>
	            <li class="twitter"><a href="<?php echo esc_url($link_youtube); ?>"  <?php echo esc_attr($open_new_tab); ?>><i class="fa fa-twitter icon"></i></a></li>
	            <?php endif;?>
            <?php if (!empty($link_twitter)): $is_all_empty = false;?>
	            <li class="youtube"><a href="<?php echo esc_url($link_twitter); ?>"  <?php echo esc_attr($open_new_tab); ?>><i class="fa fa-youtube icon"></i></a></li>
	            <?php endif;?>
            <?php if (!empty($link_linkedin)): $is_all_empty = false;?>
	            <li class="linkedin"><a href="<?php echo esc_url($link_linkedin); ?>"  <?php echo esc_attr($open_new_tab); ?>><i class="fa fa-linkedin icon"></i></a></li>
	            <?php endif;?>
            <?php if ($is_all_empty && current_user_can('edit_theme_options')): ?>
                <li><a href="<?php echo esc_url(admin_url('customize.php')); ?>" target="_blank"><i class="fa fa-info icon"></i> <?php _e('Click To Add Social Links ', 'business-prime');?> </a> </li>
            <?php endif;?>
        </ul>
    <?php
}

function business_prime_comment_form_fields($fields) {

    $fields['author'] = '<div class="form-group col-md-4"><label  for="name">' . __('NAME', 'business-prime') . ':</label><input type="text" class="form-control" id="name" name="author" placeholder="' . esc_attr__('Full Name', 'business-prime') . '"></div>';
    $fields['email']  = '<div class="form-group col-md-4"><label for="email">' . __('EMAIL', 'business-prime') . ':</label><input type="email" class="form-control" id="email" name="email" placeholder="' . esc_attr__('Your Email Address', 'business-prime') . '"></div>';
    $fields['url']    = '<div class="form-group col-md-4"><label  for="url">' . __('WEBSITE', 'business-prime') . ':</label><input type="text" class="form-control" id="url" name="url" placeholder="' . esc_attr__('Website', 'business-prime') . '"></div>';
    return $fields;
}
add_filter('comment_form_fields', 'business_prime_comment_form_fields');

function business_prime_comment_form_defaults($defaults) {
    $defaults['submit_field']   = '<div class="form-group col-md-4">%1$s %2$s</div>';
    $defaults['comment_field']  = '<div class="form-group col-md-12"><label  for="message">' . __('COMMENT', 'business-prime') . ':</label><textarea class="form-control" rows="5" id="comment" name="comment" placeholder="' . esc_attr__('Message', 'business-prime') . '"></textarea></div>';
    $defaults['title_reply_to'] = __('Post Your Reply Here To %s', 'business-prime');
    $defaults['class_submit']   = 'btn';
    $defaults['label_submit']   = __('SUBMIT COMMENT', 'business-prime');
    $defaults['title_reply']    = '<h2>' . __('Post Your Comment Here', 'business-prime') . '</h2>';
    $defaults['role_form']      = 'form';
    return $defaults;

}
add_filter('comment_form_defaults', 'business_prime_comment_form_defaults');

function business_prime_comment($comment, $args, $depth) {
    global $comment_data;
    // translations.
    $leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply', 'business-prime');?>
        <div class="col-xs-12 border">
            <div class="col-xs-2 ">
            <?php echo get_avatar($comment, $size = '80'); ?>
            </div>
            <div class="col-xs-11  col-xs-push-1">
                <h4><?php comment_author();?></h4>
                <h5><?php if (('d M  y') == get_option('date_format')): ?>
                <?php comment_date('F j, Y');?>
                <?php else: ?>
                <?php comment_date();?>
                <?php endif;?>
                <?php _e('at', 'business-prime');?>&nbsp;<?php comment_time('g:i a');?></h5>
                <p><?php comment_text();?></p>
                <?php comment_reply_link(array_merge($args, array('reply_text' => $leave_reply, 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
                <?php if ($comment->comment_approved == '0'): ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'business-prime');?></em>
                <br/>
                <?php endif;?>
            </div>
        </div>
        <?php
}


add_action( 'tgmpa_register', 'business_prime_register_required_plugins' );
function business_prime_register_required_plugins() {

    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Kirki',
            'slug'      => 'kirki',
            'required'  => false,
        ),        
    );
    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'business-prime',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'business-prime-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}