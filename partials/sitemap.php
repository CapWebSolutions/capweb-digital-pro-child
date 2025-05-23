<h1>Stay clam. I couldn't find that page.<br/>Here's a list of what we do have.</h1>
<h3>If you don't see your page in this list, there is search form at the bottom.<br> That may help.</h3>
<div class="archive-page">
    <h2 id="pages">Pages</h2>
	<ul>
	<?php
	// Add pages you'd like to exclude in the exclude here
		wp_list_pages(
		  array(
			'exclude' => '9920',   //Special pricing page. 
			'title_li' => '',
		  )
		);
	?>
	</ul>

	<ul>
	<?php
	// This part prints out your custom post types
		foreach( get_post_types( array('public' => true) ) as $post_type ) {
		  if ( in_array( $post_type, array('post','page','attachment') ) )
			continue;

		  $pt = get_post_type_object( $post_type );

		  echo '<h2>'.$pt->labels->name.'</h2>';
		  echo '<ul>';

		  query_posts('post_type='.$post_type.'&posts_per_page=-1');
		  while( have_posts() ) {
			the_post();
			echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		  }

		  echo '</ul>';
		}
	?>
	</ul>
</div>

<div class="archive-page">
	<h2 id="posts">Posts</h2>
	<ul>
	<?php
		// Add categories you'd like to exclude in the exclude here
		$cats = get_categories('exclude=');
		foreach ($cats as $cat) {
		  echo "<li><h4>".$cat->cat_name."</h4>";
		  echo "<ul>";
		  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
		  while(have_posts()) {
			the_post();
			$category = get_the_category();
			// Only display a post link once, even if it's in multiple categories
			if ($category[0]->cat_ID == $cat->cat_ID) {
			  echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			}
		  }
		  echo "</ul>";
		  echo "</li>";
		}
	?>
	</ul>
</div>
