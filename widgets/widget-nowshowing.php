<?php

/**
 * Now Showing Widget
 */
class NowShowing_Widget extends WP_Widget {

	public function __construct()
	{
		// widget actual process
		parent::__construct(
			'nowshowing_widget',
			'Now Showing Widget',
			array('description' => 'Display Now Showing Movies')
		);
	}

	public function form($instance)
	{
		// outputs the options form on admin
		echo "HERE";
	}

	public function update($new_instance, $old_instance)
	{
		// processes widget options to be saved
	}

	public function widget($args, $instance)
	{
		echo "NOW SHOWING";
		$today = date_i18n('Y-m-d');

		$args = array(
			'post_type' => 'mewcinema',
			'posts_per_page' => 0,
			'meta_query' => array(
				array(
					'key' => 'start_date',
					'value' => $today,
					'compare' => '<='
				),
				array(
					'key' => 'end_date',
					'value' => $today,
					'compare' => '>='
				)
			)
		);

		$cinema = new WP_Query($args);

		
		$data = array();

		ob_start();
		while($cinema->have_posts()) : $cinema->the_post();
			// cinema, title, time schedule, rate
			$cinemas = wp_get_post_terms($cinema->post->ID, 'cinema');
			$rating = wp_get_post_terms($cinema->post->ID, 'rating');
			$meta = get_post_meta($cinema->post->ID);
			foreach ($cinemas as $key => $value) {
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($cinema->post->ID), 'movie-thumbnail');

				$data[$value->slug][$cinema->post->ID]['name'] = $value->name;
				$data[$value->slug][$cinema->post->ID]['title'] = get_the_title();
				$data[$value->slug][$cinema->post->ID]['permalink'] = get_permalink();
				$data[$value->slug][$cinema->post->ID]['time'] = $meta['time'][0];
				$data[$value->slug][$cinema->post->ID]['rating'] = isset($rating[0]->name) ? $rating[0]->name : '';
				$data[$value->slug][$cinema->post->ID]['thumb'] = $image[0];
			}

		endwhile;
		ksort($data);
		wp_reset_postdata();
?>
	<ul class="flexslider carousel">
		<ul class="slides">
			<li>
				<div class="box">
					<img src="http://localhost/sv/wp-content/uploads/2013/03/Costa-Rican-Frog-220x330.jpg" />
					<h2>Movie Title</h2>
					<p> Theu quick orwn kfjsa ;dlfkj aposierj m;laksdj foaisj r;lkajsdfkja ;seir a;klsdfj;laksdf</p>
				</div>
			</li>
			<li><div class="box">
					<img src="http://localhost/sv/wp-content/uploads/2013/03/Costa-Rican-Frog-220x330.jpg" />
					<h2>Movie Title with Long text</h2>
					<p> Theu quick orwn kfjsa ;dlfkj aposierj m;laksdj foaisj r;lkajsdfkja ;seir a;klsdfj;laksdf</p>
				</div>
			</li>
			<li><img src="http://localhost/sv/wp-content/uploads/2013/03/Costa-Rican-Frog-220x330.jpg" /></li>
			<li><img src="http://localhost/sv/wp-content/uploads/2013/03/Costa-Rican-Frog-220x330.jpg" /></li>
		</ul>
	</ul>
	<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('.flexslider').flexslider({
		animation: 'slide',
		animationLoop: false,
		itemWidth: 230,
		itemMargin: 0
	});
});

	</script>	
<?php
		ob_end_flush();
	}
}

add_action('widgets_init', create_function('', 'register_widget("NowShowing_Widget");'));

?>