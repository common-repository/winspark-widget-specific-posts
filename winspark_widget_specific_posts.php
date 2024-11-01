<?php
/*
* Plugin Name: Winspark Widget Specific Category Posts
* Version: 1.1
* Plugin URI: https://wordpress.org/plugins/winspark-widget-specific-posts
* Description: A widget for showing posts of specific categories.
* Author: developer@winspark.in
* Author URI: http://winspark.in 
* WC requires at least: 2.0.0
* WC tested up to: 5.5.2
* Text Domain: wnsprk
* License: GPLv2
*/

/**
 *
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is a widget for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_action( 'widgets_init', 'winspark_widget_specific_posts' );

/**
* Register widget to wordpress widgets.
*
* @return void
*/
function winspark_widget_specific_posts() {
	 register_widget( 'winspark_widget_specific_posts' );
}

/**
* Winspark widget specific posts to show posts categories wise.
*/
class winspark_widget_specific_posts extends WP_Widget
{
	/**
	 * Constructor for the winspark_widget_specific_posts class
	 *
	 * initilise widget specific posts.
	 */
    public function __construct()
    {
        $widget_details = array(
            'classname' => 'winsprk_widget_specific_posts',
            'description' => 'A widget for showing posts of specific categories.'
        );
 
        parent::__construct( 'widget_specific_posts', 'Winspark Specific Posts', $widget_details );
    }
	
	/**
	 * Display backend form for widget where user can set his posts category wise to different location like
	 * sidebar , footer etc.
	 *
	 * @instance array settings for widgets.
	 *
	 * @return void
	 */
    public function form( $instance ) 
	{
    		$title = '';
			if( !empty( $instance['title'] ) ) {
				$title = $instance['title'];
			}
		 
			$show_info = '';
			if( !empty( $instance['show_info'] ) ) {
				$show_info = $instance['show_info'];
			}
			
			$post_ids = '';
			if( !empty( $instance['post_ids'] ) ) {
				$post_ids = $instance['post_ids'];
			}
			
			$category_id = '';
			if( !empty( $instance['category_id'] ) ) {
				$category_id = $instance['category_id'];
			}
			
			$trim_txt = 0;
			if( !empty( $instance['trim_txt'] ) ) {
				$trim_txt = $instance['trim_txt'];
			}

			$show_pst_dt = ( !empty( $instance['show_pst_dt'] ) ) ? $instance['show_pst_dt'] : '';
			?>
		 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php esc_html_e( 'Title:','wnsprk'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				<small class='help-text'><?php esc_html_e( 'Title to be displayed at your website.' ,'wnsprk');?></small>
			</p>
		 
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'show_info' ) ); ?>"><?php esc_html_e( 'Show Posts:','wnsprk' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_info' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_info' ) ); ?>" type="text" value="<?php echo esc_attr( $show_info ); ?>" />
				<small class='help-text'><?php esc_html_e( 'No of posts to be displayed,default is 5.' ,'wnsprk');?></small>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'post_ids' ) ); ?>"><?php esc_html_e( 'Post ids:','wnsprk' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_ids' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_ids' ) ); ?>" type="text" value="<?php echo esc_attr( $post_ids ); ?>" />
				<small class='help-text'><?php esc_html_e( 'Post Id, example 11.' ,'wnsprk');?></small>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'trim_txt' ) ); ?>"><?php esc_html_e( 'Trim Text:','wnsprk' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'trim_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'trim_txt' ) ); ?>" type="text" value="<?php echo esc_attr( $trim_txt ); ?>" />
				<small class='help-text'><?php esc_html_e( 'Trim txt. example 30' ,'wnsprk');?></small>
			</p>
			
			<p>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_pst_dt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_pst_dt' ) ); ?>" type="checkbox" <?php echo esc_attr( $show_pst_dt )?"checked=checked":""; ?> />
				<small class='help-text'><?php esc_html_e( 'Show Post Date' ,'wnsprk');?></small>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_name( 'category_id' ) ); ?>"><?php esc_html_e( 'Categories:','wnsprk' ); ?></label>
				
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'category_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'category_id' ) ); ?>">
				<option value="0">--Select--</option>
					<?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
					<option <?php selected( $instance['category_id'], $term->term_id ); ?> value="<?php echo esc_attr( $term->term_id ); ?>">
							<?php echo esc_attr( $term->name ); ?>
					</option>
					<?php } ?>      
				</select>
				<small class='help-text'><?php esc_html_e( 'Choose category of your post.' ,'wnsprk');?></small>
			</p>
			<?php
	}
 
	/**
	 * Update your settings for showing post of category
	 *
	 * @new_instance array new settings for widgets.
	 * @old_instance array old settings for widgets.
	 *
	 * @return array
	 */
    public function update( $new_instance, $old_instance ) {  
			$instance 					= $old_instance;
			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );
			$instance['show_info'] 		= sanitize_text_field( $new_instance['show_info'] );
			$instance['category_id'] 	= sanitize_text_field( $new_instance['category_id'] );
			$instance['show_pst_dt'] 	= sanitize_text_field( $new_instance['show_pst_dt'] );
			$instance['post_ids'] 		= sanitize_text_field( $new_instance['post_ids'] );
			$instance['trim_txt'] 		= sanitize_text_field( $new_instance['trim_txt'] );
			return $new_instance;
    }
	
	/**
	 * Display posts of particular category at frontend of your site.
	 *
	 * @args array arguments of post.
	 * @instance array settings of widget.
	 *
	 * @return void
	 */
    public function widget( $args, $instance ) 
	{
		global $post;
		$title 			= array_key_exists('title',$instance) ? $instance['title']:'';
		$widget_id 		= array_key_exists('widget_id',$instance) ? $instance['widget_id']:'';
		$show_info 		= array_key_exists('show_info',$instance) ? $instance['show_info']:5;
		$category_id 	= array_key_exists('category_id',$instance) ? $instance['category_id']:0;
		$post_ids 		= array_key_exists('post_ids',$instance) ? $instance['post_ids']:'';
		$show_pst_dt 	= array_key_exists('show_pst_dt',$instance) ? $instance['show_pst_dt']:'off';
		$trim_txt 		= array_key_exists('trim_txt',$instance) ? $instance['trim_txt']:0;
		$args 			= array('posts_per_page' => $show_info);
		
		if(!empty($category_id))
		{
			$args['category'] = $category_id;
		}

		if(!empty($post_ids))
		{
			$args['include'] = $post_ids;
		}
		
		$posts 			= get_posts($args);
		?>
			<section id="<?php echo esc_attr($widget_id);?>" class="widget widget_specific_posts">
				<?php if( !empty( $title ) ){?>
				<h2 class="widget-title"><?php echo esc_attr($title);?></h2>
				<?php }?>
				<ul>
					<?php foreach ( $posts as $post ) : setup_postdata($post); ?>
					<li>
						<a href="<?php get_post_permalink($post->ID); ?>"><?php the_title(); ?></a><br/>
						<?php if($show_pst_dt=='on'){?><small><?php the_date();?></small><?php }?>
						
						<?php 
								if(!empty($trim_txt))
								{
									echo wp_trim_words( $post->post_content, $trim_txt, $more = " <a href=\"".get_post_permalink($post->ID)."\">Read More..</a>" );
								}
								else
								{
									echo $post->post_content;
								}
						?>
					</li>
					<?php endforeach; ?>
				</ul>
			</section>
<?php
		wp_reset_postdata();
	}
 
}
?>