<?php
/*
Plugin Name: Jet Site Unit Could
URI: http://milordk.ru
Author: Jettochkin
Author URI: http://milordk.ru
Plugin URI: http://milordk.ru/r-lichnoe/opyt-l/cms/prodolzhaem-widget-o-stroenie-jet-random-members-widget.html
Donate URI: http://milordk.ru/uslugi.html
Description: ru-Вывод случайных пользователей и/или групп в виде аватар. en-Provides random avatart members and/or groups.
Tags: BuddyPress, Wordpress, MU, meta, members, widget, groups
Version: 1.0
*/
?>
<?php

class JetSUC_Members extends WP_Widget {
	function JetSUC_Members() {
		parent::WP_Widget(false, $name = __('Jet SUC Members','JetSUC_Members') );
	}

	function widget($args, $instance) {
		extract( $args );
		echo $before_widget;
		$keytitle = $instance['jmtitle'];
		$avatarsize = $instance['avatarsize'];		
		$indexkey = $instance['indexkey']; ?>		
<?php if ( $keytitle ) { ?>
		<a href="<?php echo get_option('home') ?>/<?php echo BP_MEMBERS_SLUG ?>" title="<?php _e( 'Members', 'buddypress' ) ?>">
<?php } ?>
		<?php echo $before_title.$instance['title'].$after_title; ?>
<?php if ($keytitle ) { ?>
		</a>
<?php } ?>
		<?php $argj = 'type=random&max='.$instance["number"];
		    $keytitle = $instance["keytitle"]
		 ?>

			<?php if ( bp_has_members( $argj ) ) : ?>
			<?php if ($indexkey) { ?>
			<noindex>
			<?php } ?>
				<div class="avatar-block">
					<?php while ( bp_members() ) : bp_the_member(); ?>

							<span class="item-avatar">
							<a href="<?php bp_member_link() ?>" title="<?php _e('Member','buddypress'); ?>: <?php bp_member_name() ?>" <?php if ($indexkey) { ?>rel="nofollow"<?php } ?>><?php bp_member_avatar('type=thumb&width='.$avatarsize.'&height='.$avatarsize) ?></a>
							</span>

					<?php endwhile; ?>	
				</div>							
			<?php if ($indexkey) { ?>
			</noindex>
			<?php } ?>				
				<?php do_action( 'bp_directory_members_featured' ) ?>	
				
			<?php else: ?>

				<div id="message" class="info">
					<p><?php _e( 'There are not enough members to feature.', 'buddypress' ) ?></p>
				</div>

			<?php endif; ?>

<?
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['avatarsize'] = strip_tags($new_instance['avatarsize']);		
		$instance['indexkey'] = strip_tags($new_instance['indexkey']);
		$instance['jmtitle'] = strip_tags($new_instance['jmtitle']);	
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number'=>''));
		$title = strip_tags( $instance['title']); 
		$number = strip_tags( $instance['number']);
		$avatarsize = strip_tags( $instance['avatarsize']);
		$jmtitle = strip_tags( $instance['jmtitle']); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'buddypress'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $title ) ); ?>" /></label></p>
		<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Количество пользователей для отображения:'; } else { echo 'Members count for show:'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $number ) ); ?>" /></label></p>
	<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Размер аватара (25..50px):'; } else { echo 'Size avatar (25..50px):'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('avatarsize'); ?>" name="<?php echo $this->get_field_name( 'avatarsize' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $avatarsize ) ); ?>" /></label></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Использовать ссылку на всех пользователей:';
        }else{
                echo 'To use the link for the all users:';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($jmtitle) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('jmtitle'); ?>" name="<?php echo $this->get_field_name('jmtitle'); ?>" value="1" /></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Установить noindex на облако пользователей и nofollow на ссылки?';
        }else{
                echo 'Set on the members could and noindex nofollow on links?';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($indexkey) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('indexkey'); ?>" name="<?php echo $this->get_field_name('indexkey'); ?>" value="1" /></p>
<?php
	}
}

class JetSUC_Groups extends WP_Widget {
	function JetSUC_Groups() {
		parent::WP_Widget(false, $name = __('Jet SUC Groups','JetSUC_Groups') );
	}

	function widget($args, $instance) {
		extract( $args );
		echo $before_widget;
		$keytitle = $instance['jgtitle'];
		$avatarsize = $instance['avatarsize'];
		$indexkey = $instance['indexkey']; ?>		
<?php if ( $keytitle ) { ?>
		<a href="<?php echo get_option('home') ?>/<?php echo BP_GROUPS_SLUG ?>" title="<?php _e( 'Groups', 'buddypress' ) ?>">
<?php } ?>
		<?php echo $before_title.$instance['title'].$after_title; ?>
<?php if ($keytitle ) { ?>
		</a>
<?php } ?>
	<?php $argj = 'type=random&max='.$instance["number"].'&per_page=20'; ?>

			<?php if ( bp_has_groups( $argj ) ) : ?>
			<?php if ($indexkey) { ?>
			<noindex>
			<?php } ?>
				<div class="avatar-block">					
					<?php while ( bp_groups() ) : bp_the_group(); ?>
							<span class="item-avatar">
								<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?> | <?php bp_group_last_active() ?> | <?php bp_group_member_count(); ?>"<?php if ($indexkey) { ?> rel="nofollow"<?php } ?>><?php bp_group_avatar('type=thumb&width='.$avatarsize.'&height='.$avatarsize) ?></a>
							</span>
					<?php endwhile; ?>	
				</div>
			<?php if ($indexkey) { ?>
			</noindex>
			<?php } ?>				
				<?php do_action( 'bp_directory_groups_featured' ) ?>	
				
			<?php else: ?>

				<div id="message" class="info">
					<p><?php _e( 'No groups found.', 'buddypress' ) ?></p>
				</div>
			<?php endif; ?>

<?	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['avatarsize'] = strip_tags($new_instance['avatarsize']);
		$instance['indexkey'] = strip_tags($new_instance['indexkey']);		
		$instance['jgtitle'] = strip_tags($new_instance['jgtitle']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number'=>''));
		$title = strip_tags( $instance['title']); 
		$number = strip_tags( $instance['number']);
		$avatarsize = strip_tags( $instance['avatarsize']);
		$jgtitle = strip_tags( $instance['jgtitle']); ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'buddypress'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $title ) ); ?>" /></label></p>
		<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Количество групп для отображения:'; } else { echo 'Groups count for show:'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $number ) ); ?>" /></label></p>
<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Размер аватара (25..50px):'; } else { echo 'Size avatar (25..50px):'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('avatarsize'); ?>" name="<?php echo $this->get_field_name( 'avatarsize' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $avatarsize ) ); ?>" /></label></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Использовать ссылку на все группы:';
        }else{
                echo 'To use the link for the all groups:';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($jgtitle) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('jgtitle'); ?>" name="<?php echo $this->get_field_name('jgtitle'); ?>" value="1" /></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Установить noindex на облако групп и nofollow на ссылки?';
        }else{
                echo 'Set on the groups could and noindex nofollow on links?';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($indexkey) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('indexkey'); ?>" name="<?php echo $this->get_field_name('indexkey'); ?>" value="1" /></p>		
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("JetSUC_Members");'));
add_action('widgets_init', create_function('', 'return register_widget("JetSUC_Groups");'));
?>