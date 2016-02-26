<?php
/**
 * Created by PhpStorm.
 * User: Dina
 * Date: 25.02.2016
 * Time: 18:11
 */

class Team_Widget extends WP_Widget{


	function __construct() {
		parent::__construct(
			'team_widget', // Base ID
			'Team Widget', // Name
			array('description' => __( 'Displays team members. Outputs the post thumbnail, title and description for member','houstonapps'))
		);
	}


	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfMembers'] = strip_tags($new_instance['numberOfMembers']);
		return $instance;
	}



	function form($instance) {
		if( $instance) {
			$title = esc_attr($instance['title']);
			$numberOfMembers = esc_attr($instance['numberOfMembers']);
		} else {
			$title = '';
			$numberOfMembers = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'team_widget'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberOfMembers'); ?>"><?php _e('Number of Members:', 'team_widget'); ?></label>
			<select id="<?php echo $this->get_field_id('numberOfMembers'); ?>"  name="<?php echo $this->get_field_name('numberOfMembers'); ?>">
				<?php for($x=1;$x<=10;$x++): ?>
					<option <?php echo $x == $numberOfMembers ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
				<?php endfor;?>
			</select>
		</p>
		<?php
	}




	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfMembers = $instance['numberOfMembers'];?>

         <!--TEAM-->
		<div class="large-12 columns members">
			<?php
				echo $before_widget;
				if ( $title ) {
					echo $before_title . $title . $after_title;
				}
				$this->getTeamMembers($numberOfMembers);
				echo $after_widget;?>
		</div>

	<?php}


	function getTeamMembers($numberOfMembers) { //html
		global $post;
		add_image_size( 'team_widget_size', 630, 630, false );
		$members = new WP_Query();
		$members->query('post_type=team&posts_per_page=' . $numberOfMembers );
		if($members->found_posts > 0) {

			echo '<ul class="large-12 columns members_list">';
			while ($members->have_posts()) {
				$members->the_post();
				$image = (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail($post->ID, 'team_widget_size') : '<div class="noThumb"></div>';
				$listItem = '<li class="team_member">' . $image;
				$listItem .= '<div class="member_info"><div>';
				$listItem .= '<p class="member_name">'.get_the_title(). '</p>';
				$listItem .= '<p>'.get_the_content().'</p>';
				$listItem .= '</div></div>';

				$listItem .= '<div class="mobile_member_info">';
				$listItem .= '<p class="member_name">'.get_the_title(). '</p>';
				$listItem .='<p>'. esc_html(get_the_content()).'</p>';
				$listItem .= '<div></li>';
				echo $listItem;
			}
			echo '</ul>';


			wp_reset_postdata();
		}else{
			echo '<p style="padding:25px;">No members found</p>';
		}
	}

} //end class Team_Widget




/* Working process widget*/

class Process_Widget extends WP_Widget{


	function __construct() {
		parent::__construct(
			'process_widget', // Base ID
			'Working Process', // Name
			array('description' => __( 'Displays working process items. Outputs the post title, description, icon for process','houstonapps'))
		);
	}


	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberOfItems'] = strip_tags($new_instance['numberOfItems']);
		return $instance;
	}



	function form($instance) {
		if( $instance) {
			$title = esc_attr($instance['title']);
			$numberOfMembers = esc_attr($instance['numberOfItems']);
		} else {
			$title = '';
			$numberOfMembers = '';
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'houstonapps'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('numberOfItems'); ?>"><?php _e('Number of Process items:', 'houstonapps'); ?></label>
			<select id="<?php echo $this->get_field_id('numberOfItems'); ?>"  name="<?php echo $this->get_field_name('numberOfItems'); ?>">
				<?php for($x=1;$x<=10;$x++): ?>
					<option <?php echo $x == $numberOfMembers ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
				<?php endfor;?>
			</select>
		</p>
		<?php
	}




	function widget($args, $instance) {

		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$numberOfItems = $instance['numberOfItems'];?>

		<!--WORKING PROCESS-->
		<div class="large-12 columns working_process">
			<?php
				echo $before_widget;
				if (! empty( $title) ) {
					echo $before_title . $title . $after_title;
				}
				$this->getProcessItems($numberOfItems);
				echo $after_widget;?>
		</div>

	<?php }


	function getProcessItems($numberOfItems) { //html
		global $post;

		$members = new WP_Query();
		$members->query('post_type=process&posts_per_page=' . $numberOfItems );
		if($members->found_posts > 0) {?>




			<?php


			echo '<!--TEAM-->
					<div class="large-12 columns members">
					<ul class="large-12 columns members_list">';
			while ($members->have_posts()) {
				$members->the_post();

				$listItem = '<li class="team_member">' . $image;
				$listItem .= '<div class="member_info"><div>';
				$listItem .= '<p class="member_name">'.get_the_title(). '</p>';
				$listItem .= '<p>'.get_the_content().'</p>';
				$listItem .= '</div></div>';

				$listItem .= '<div class="mobile_member_info">';
				$listItem .= '<p class="member_name">'.get_the_title(). '</p>';
				$listItem .='<p>'. esc_html(get_the_content()).'</p>';
				$listItem .= '<div></li>';
				echo $listItem;
			}
			echo '</ul></div>';


			wp_reset_postdata();
		}else{
			echo '<p style="padding:25px;">No members found</p>';
		}
	}

} //end class Team_Widget