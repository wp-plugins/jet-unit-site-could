<?php
/*
Plugin Name: Jet Site Unit Could Widgets
URI: http://milordk.ru
Author: Jettochkin
Author URI: http://milordk.ru
Plugin URI: http://milordk.ru/r-lichnoe/opyt/cms/jet-site-unit-could-poleznye-vidzhety-dlya-vashej-socialnoj-seti.html
Donate URI: http://milordk.ru/projects/wordpress-buddypress/podderzhka.html
Description: ru-Вывод случайных пользователей и/или групп в виде аватар + вывод списка блогов. en-Provides random avatart members and/or groups + blog list.
Tags: BuddyPress, Wordpress, MU, meta, members, widget, groups, blog, tag
Version: 2.1
*/
?>
<?php

/*
=Member Could
*/
class JetSUC_Members extends WP_Widget {
	function JetSUC_Members() {
		parent::WP_Widget(false, $name = __('Jet SUC Members','JetSUC_Members') );
	}

	function widget($args, $instance) {
		extract( $args ); ?>
	<?php	echo $before_widget;
		$mkeytitle = $instance['mjmtitle'];
		$mavatarsize = $instance['mavatarsize'];
		$mindexkey = $instance['mindexkey']; ?>
	<!-- Milordk Dev http://milordk.ru -->
		<?php echo $before_title; ?>
	<?php if ( $mkeytitle ) { ?>
<a href="<?php echo get_option('home') ?>/<?php echo BP_MEMBERS_SLUG ?>" title="<?php _e( 'Members', 'buddypress' ); ?>">
	<?php } ?>
		<?php echo $instance['mtitle']; ?>
	<?php if ($mkeytitle ) { ?>
</a>
	<?php } ?>
<?php echo $after_title; ?>

		<?php $argj = 'type=random&max='.$instance["mnumber"];
		    $mkeytitle = $instance["mkeytitle"]
		 ?>
			<?php if ( bp_has_members( $argj ) ) : ?>
			<?php if ($mindexkey) { ?>
			<!-- <noindex> -->
			<?php } ?>
					<?php while ( bp_members() ) : bp_the_member(); ?>
							<a href="<?php bp_member_link() ?>" title="<?php _e('Member','buddypress'); ?>: <?php bp_member_name() ?>" <?php if ($indexkey) { ?>rel="nofollow"<?php } ?>><?php bp_member_avatar('type=thumb&width='.$mavatarsize.'&height='.$mavatarsize) ?></a>
					<?php endwhile; ?>	
			<?php if ($mindexkey) { ?>
			<!-- </noindex> -->
			<?php } ?>
			<br />
				<?php do_action( 'bp_directory_members_featured' ) ?>	
				
			<?php else: ?>

				<div id="message" class="info">
					<p><?php _e( 'There are not enough members to feature.', 'buddypress' ) ?></p>
				</div>

			<?php endif; ?>
<?
		echo $after_widget; ?>
		<div style="clear:both;"><span></span></div>
<?php	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['mtitle'] = strip_tags($new_instance['mtitle']);
		$instance['mnumber'] = strip_tags($new_instance['mnumber']);
		$instance['mavatarsize'] = strip_tags($new_instance['mavatarsize']);		
		$instance['mindexkey'] = strip_tags($new_instance['mindexkey']);
		$instance['mjmtitle'] = strip_tags($new_instance['mjmtitle']);	
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'mtitle' => '', 'mnumber'=>''));
		$mtitle = strip_tags( $instance['mtitle']); 
		$mnumber = strip_tags( $instance['mnumber']);
		$mavatarsize = strip_tags( $instance['mavatarsize']);
		$mindexkey = strip_tags($instance['mindexkey']);		
		$mjmtitle = strip_tags( $instance['mjmtitle']); ?>
		<p><label for="<?php echo $this->get_field_id('mtitle'); ?>"><?php _e('Title:', 'buddypress'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'mtitle' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $mtitle ) ); ?>" /></label></p>
		<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Количество пользователей для отображения:'; } else { echo 'Members count for show:'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('mnumber'); ?>" name="<?php echo $this->get_field_name( 'mnumber' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $mnumber ) ); ?>" /></label></p>
	<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Размер аватара (25..50px):'; } else { echo 'Size avatar (25..50px):'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('mavatarsize'); ?>" name="<?php echo $this->get_field_name( 'mavatarsize' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $mavatarsize ) ); ?>" /></label></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Использовать ссылку на всех пользователей:';
        }else{
                echo 'To use the link for the all users:';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($mjmtitle) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('mjmtitle'); ?>" name="<?php echo $this->get_field_name('mjmtitle'); ?>" value="1" /></p>
<p><?php if ( WPLANG == 'ru_RU' or WPLANG == 'ru_RU_litle') { 
            echo 'Установить noindex на облако пользователей и nofollow на ссылки?';
        }else{
                echo 'Set on the members could and noindex nofollow on links?';
        } ?>&nbsp;
		<input class="checkbox" type="checkbox" <?php if ($mindexkey) {echo 'checked="checked"';} ?> id="<?php echo $this->get_field_id('mindexkey'); ?>" name="<?php echo $this->get_field_name('mindexkey'); ?>" value="1" /></p>
	<p><?php if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { ?>
			Обратите внимание на другие плагины на <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">сайте разработчика</a>
			<?php } else { ?>
			Pay attention to the other plugins on the <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">site developer</a> 
			<?php } ?></p>
<?php
	}
}

/*
=Group Could
*/
class JetSUC_Groups extends WP_Widget {
	function JetSUC_Groups() {
		parent::WP_Widget(false, $name = __('Jet SUC Groups','JetSUC_Groups') );
	}

	function widget($args, $instance) {
		extract( $args ); ?>
		<?php echo $before_widget;
		$keytitle = $instance['jgtitle'];
		$avatarsize = $instance['avatarsize'];
		$indexkey = $instance['indexkey']; ?>		
		<!-- Milordk Dev http://milordk.ru -->
		<?php echo $before_title; ?>
<?php if ( $keytitle ) { ?>
<a href="<?php echo get_option('home') ?>/<?php echo BP_GROUPS_SLUG ?>" title="<?php _e( 'Groups', 'buddypress' ) ?>">
<?php } ?>
		<?php echo $instance['title']; ?>
<?php if ($keytitle ) { ?>
</a>
<?php } ?>
		<?php echo $after_title; ?>
	<?php $argj = 'type=random&max='.$instance["number"].'&per_page='.$instance["number"]; ?>

			<?php if ( bp_has_groups( $argj ) ) : ?>
			<?php if ($indexkey) { ?>
			<!-- <noindex> -->
			<?php } ?>
					<?php while ( bp_groups() ) : bp_the_group(); ?>
								<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?> | <?php bp_group_last_active() ?> | <?php bp_group_member_count(); ?>"<?php if ($indexkey) { ?> rel="nofollow"<?php } ?>><?php bp_group_avatar('type=thumb&width='.$avatarsize.'&height='.$avatarsize) ?></a>
					<?php endwhile; ?>	
			<?php if ($indexkey) { ?>
			<!-- </noindex> -->
			<?php } ?>				
				<?php do_action( 'bp_directory_groups_featured' ) ?>	
				
			<?php else: ?>

				<div id="message" class="info">
					<p><?php _e( 'No groups found.', 'buddypress' ) ?></p>
				</div>
			<?php endif; ?>

<?	echo $after_widget; ?>
		<div style="clear:both;"><span></span></div>
<?php	}

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
		$indexkey = strip_tags($instance['indexkey']);		
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
	<p><?php if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { ?>
			Обратите внимание на другие плагины на <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">сайте разработчика</a>
			<?php } else { ?>
			Pay attention to the other plugins on the <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">site developer</a> 
			<?php } ?></p>
<?php
	}
}

/*
=Blog list
Description: ru-Вывод списка (облака) блогов с сортировкой по последнему обновлению (последняя активность на блоге). en-Provides a list of blogs sorted by last update (the last activity on the blog).
*/

function jet_get_blog_could( $start = 0, $num = 10, $deprecated = '', $jincount = 1 ) {
	global $wpdb;
	$blogs = get_site_option( "blog_list" );
	$limit = $num +1;
	$update = false;
        $limit = $num+1;
	if( is_array( $blogs ) ) {
		if( ( $blogs['time'] + 60 ) < time() ) { // cache for 60 seconds.
			$update = true;
		}
	} else {
		$update = true;
	}

	if( $update == true ) {
		unset( $blogs );
		$blogs = $wpdb->get_results( $wpdb->prepare("SELECT blog_id, domain, path FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY RAND() LIMIT ".$limit, $wpdb->siteid), ARRAY_A );
		foreach ( (array) $blogs as $details ) {
		
		$blog_list[ $details['blog_id'] ] = $details;
		if ($jincount=='1')
		  { 
		$blog_list[ $details['blog_id'] ]['postcount'] = $wpdb->get_var( "SELECT COUNT(ID) FROM " . $wpdb->base_prefix . $details['blog_id'] . "_posts WHERE post_status='publish' AND post_type='post'" );
		
		 }		
		}
		unset( $blogs );
		$blogs = $blog_list;
		update_site_option( "blog_list", $blogs );
	}

	if( false == is_array( $blogs ) )
		return array();

	if( $num == 'all' ) {
		return array_slice( $blogs, $start, count( $blogs ) );
	} else {
		return array_slice( $blogs, $start, $num );
	}
}

class JetSUC_Blogs extends WP_Widget {
	function JetSUC_Blogs() {
		parent::WP_Widget(false, $name = __('Jet SUC Blog','JetSUC_Blogs') );
	}

	function widget($args, $instance) {
		extract( $args );
		echo $before_widget; ?>
		<!-- Milordk Dev http://milordk.ru -->
		<?php echo $before_title . $instance['title'] . $after_title;
		$blog_list = jet_get_blog_could(1, $instance['number'], true, $instance['jincount']);
		$nummeta=0;
		$emstart=1;
		$jincount = isset($instance['jincount']) ? $instance['jincount']: false;  
        	?>
		<p align="center"> 
		<span><a href="http://milordk.ru/r-lichnoe/opyt/cms/jet-site-unit-could-poleznye-vidzhety-dlya-vashej-socialnoj-seti.html" title="Jet Site Unit Could"><? echo '&diams; ';?></a></span>
		<? foreach ($blog_list AS $blog) { ?>
			<? $nummeta++;
			$blog_details = get_blog_details($blog['blog_id']);
			if ($jincount=='1')
			{
			$emcount = $blog['postcount']; 
			
			if ($emcount > $emcountbefore) { $emstart=($emstart+0.15); } else {
			if ($emcount <> $emcountbefore)
			{ 
			 $emstart=($emstart-0.15);
			}
			 }
			} else { $emstart = 1+(rand(10,100)/100); } 
			$emcountbefore=$emcount;
			 ?>
			<span style="font-size: <?php echo $emstart; ?>em;">			
            <?
			$jblogurl = get_blogaddress_by_id($blog['blog_id']);
			echo '<a href="'.$jblogurl.'" title="'.$blog_details->blogname.' - '.$emcount.'">'.$blog_details->blogname.'</a> ';
			echo '</span>';
			if ($nummeta<($instance['number']+1)) {
				echo '&diams; ';
			}
		} ?>
		</p>
		<? echo $after_widget; ?>
		<div style="clear:both;"><span></span></div>
<?php	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		$instance['jincount'] = $new_instance['jincount'];
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number'=>'','jincount'=>'1'));
		$title = strip_tags( $instance['title']); 
		$number = strip_tags( $instance['number']);
                $jincount = $instance['jincount'];
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'buddypress'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $title ) ); ?>" /></label></p>
		<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Количество блогов для отображения:'; } else { echo 'Blogs count for show:'; }
		?></p>
		<p><input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo attribute_escape( stripslashes( $number ) ); ?>" /></label></p>
		<p><?php 
		if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { echo 'Учитывать количество записей блога:'; } else { echo 'Dependence on post count:'; }
		?></p>
                <p><input class="checkbox" type="checkbox" <?php if ($jincount) {echo '"checked"';} ?> id="<? echo $this->get_field_id('jincount'); ?>" name="<? echo $this->get_field_name('jincount'); ?>" value="1" /></p>
	<p><?php if (WPLANG == 'ru_RU' or WPLANG == 'ru_RU_lite' ) { ?>
			Обратите внимание на другие плагины на <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">сайте разработчика</a>
			<?php } else { ?>
			Pay attention to the other plugins on the <a href="http://milordk.ru/projects/wordpress-buddypress.html" title="Wordpress BuddyPress Dev">site developer</a> 
			<?php } ?></p>
	<?php
	}
}

// Add WP widget action
add_action('widgets_init', create_function('', 'return register_widget("JetSUC_Blogs");'));
add_action('widgets_init', create_function('', 'return register_widget("JetSUC_Members");'));
add_action('widgets_init', create_function('', 'return register_widget("JetSUC_Groups");'));
?>