<?php
					$value = $post->post_name;
					$scene = $post->get_the_category;
					// The features Query + the hashtag - shows only the first two submitted
					$args = array( 
						'category_name' => 'responses',
						'tag' => $value,
						'posts_per_page' => -1,
						'order' => 'ASC',
						);

					$the_query = new WP_Query( $args );
					//only display option to write a post if user is logged in	
					if ( is_user_logged_in() AND in_category( 'scenes' ))  {

						$found_posts = $the_query->found_posts;
						$get_media = '[display-posts title="Related Media" tag="'. $value .'" category="media" wrapper="div" include_excerpt="false"]';
						$writesomething = '<h2>Student Responses</h2>
						<p>You should write one.</p>';
							$formurl = site_url('/wp-content/themes/rvarts/create_post.php');
								echo do_shortcode($get_media);
								echo $writesomething;
								echo '<br/>
								<form action="'. $formurl .'" method="post">
								<input type="hidden" name="postcategory" value="student responses"> 
								<input type="hidden" name="posttag" value="'. $value .'"> 
								<input type="submit" class="button" name="submit" value="Write a response" />
								</form>
								';

							}
							
					
					// The Loop
					if ( $the_query->have_posts() ) {
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							echo '<a href="' . get_the_permalink() . '"><div class="response">';
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' ));
								} else { 
									echo '<img src="'. htmlspecialchars(site_url('/wp-content/themes/music-lab/images/default-thumb.jpg')).'" class="alignleft" width="150" height="150" />';
								};							
								echo '<h3>'.get_the_title().'</h3><p>';
								echo the_excerpt().'</p></div></a>';
						}
					} else {
						// no posts found
						echo '';						
					}
					/* Restore original Post Data */
					wp_reset_postdata();

					?>


<?php
/*
The comments page for Bones
*/

// Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  if ( post_password_required() ) { ?>
  	<div class="alert alert-info"><?php _e("This post is password protected. Enter the password to view comments.","wpbootstrap"); ?></div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<?php if ( ! empty($comments_by_type['comment']) ) : ?>
	<h3 id="comments"><?php comments_number('<span>' . __("No","wpbootstrap") . '</span> ' . __("Responses","wpbootstrap") . '', '<span>' . __("One","wpbootstrap") . '</span> ' . __("Response","wpbootstrap") . '', '<span>%</span> ' . __("Responses","wpbootstrap") );?> <?php _e("to","wpbootstrap"); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=wp_bootstrap_comments'); ?>
	</ol>
	
	<?php endif; ?>
	
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings">Trackbacks/Pingbacks</h3>
		
		<ol class="pinglist">
			<?php wp_list_comments('type=pings&callback=list_pings'); ?>
		</ol>
	<?php endif; ?>
	
	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link( __("Older comments","wpbootstrap") ) ?></li>
	  		<li><?php next_comments_link( __("Newer comments","wpbootstrap") ) ?></li>
		</ul>
	</nav>

	<?php if ( ! comments_open() ) : ?>
	<p class="alert alert-info"><?php _e("Comments are closed","wpbootstrap"); ?>.</p>
	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

	<?php comment_form(); ?>

<?php endif; // if you delete this the sky will fall on your head ?>
