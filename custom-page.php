<?php
/**
 * Template Name: THE FRONT OF THE SITE
 * The template for displaying something on the front page.
 *
 *
 * @package TribeEventsCalendar
 **/

?>

<?php get_header(); ?>
<div id="content" class="clearfix row dark">		
	<div id="main" class="col col-md-10 col-md-offset-1 clearfix" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>				
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
		<header>
							
		<!--<div class="page-header"><h1><?php the_title(); ?></h1></div>-->
						
		</header> <!-- end article header -->
						
		<section class="post_content">
			<div class="wide-box-holder slider">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									  <!-- Indicators -->
									  <ol class="carousel-indicators">
									    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
									    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
									    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
									  </ol>						   
						   
					<div class="carousel-inner">
						               <?php
										 $class_active="active";

										 $args=array(
										      'post_type'=> 'post',
										      'post_status' => 'publish',
										      'category_name' => 'featured',
										      'posts_per_page' => 5,
										 
										     );
										$my_query = new WP_Query($args);
										if( $my_query->have_posts() ) {
										  while ($my_query->have_posts()) : $my_query->the_post(); ?>
										             
						<div class="item <?php echo $class_active ;?>">
										    <?php the_post_thumbnail('front-page-slide'); ?>

						   	<div class="container">
						        <div class="caro-caps">
						                 			<?php echo '<a href="' . get_the_permalink() . '">'?>
						                  			<h2> <?php the_title(); ?> </h2></a>
						                  			<p> <?php the_excerpt();?> </p>
						        </div>
						    </div>   
						</div>
					                   <?php

										 $class_active="";
										  endwhile;
										}
										wp_reset_query();  // Restore global post data stomped by the_post().
										?>
                	</div>
                </div>

            </div>		
		</section> <!-- end article section -->
				</article>
			</div>
		</div>
		<div class="row trio people">
			<div class="col-md-10 col-md-offset-1">
				<?php

					// The Reviews Query + the hashtag - shows only the first two submitted
					$args = array( 
							'post_type'=> 'socy_person',
							'post_status' => 'publish',
							'posts_per_page' => 3,
							'orderby' => 'rand',
							);
						$the_query = new WP_Query( $args );
						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								echo '<a href="' . get_the_permalink() . '"><div class="people col-md-4">';
								echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft circle-ppl' )) . '<br/><h3>' . get_the_title() . '</h3><div class="bio_excerpt">' . get_the_excerpt() . " . . . <br/> (click for more)";
								echo '</div></div></a>';
							}
						} else {
							// no posts found
							echo 'No posts found';
						}
						/* Restore original Post Data */
						wp_reset_postdata();

						?> 
			</div>
		</div>

						
		<div class="row trio">
			<div class="col-md-10 col-md-offset-1">
				<div class="col-md-4">
					<a class="twitter-timeline" href="https://twitter.com/hashtag/VCUSocy" data-widget-id="691693878869651456">#VCUSocy Tweets</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</div>
				<div class="col-md-4">
					<?php

					// The Reviews Query + the hashtag - shows only the first two submitted
					$args = array( 
							'posts_per_page' => 5,
							'order' => 'DSC',
							'cat' => -2,
							);
						$the_query = new WP_Query( $args );
						// The Loop
						if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								echo '<a href="' . get_the_permalink() . '"><div class="news">';
								echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' )) . '<br/><h3>' . get_the_title() . '</h3><div class="bio_excerpt">' . get_the_excerpt() . " . . . <br/> (click for more)";
								echo '</div></div></a>';
							}
						} else {
							// no posts found
							echo 'No posts found';
						}
						/* Restore original Post Data */
						wp_reset_postdata();

						?> 
				</div>
				<div class="col-md-4">
					<?php 
						$now = date("Y-m-d G:i:s");

						$proj_events = tribe_get_events( array(
								'start_date'     => date( 'Y-m-d H:i:s', strtotime($now) ),
								'end_date'       => date( 'Y-m-d H:i:s', strtotime( '+1 week' ) ),
								'eventDisplay'   => 'custom',
								'posts_per_page' => -1,
								'tax_query'=> array(
						                array(
						                    'taxonomy' => 'tribe_events_cat',
						                    'field' => 'slug',
						                    'terms' => 'long-term',
						                    'operator' => 'NOT IN',
						                )
						            )

								//'eventDisplay' => 'list' // only upcoming
							), true ); ?>
							<?php if( $proj_events->have_posts() ) :
								$countposts = $proj_events->found_posts; ?>
							
							<?php while( $proj_events->have_posts() ) : $proj_events->the_post(); ?>
								<div class="news">'
									<a href="<?php the_permalink(); ?>"> 
									    <?php the_post_thumbnail('thumbnail',array( 'class' => 'img-front alignleft' ));?>
									</a>
									<a href="<?php the_permalink(); ?>"> 
									<div class="front-day">
									    <?php echo tribe_get_start_date(null, false, 'd');?>
									</div>
									<div class="front-month">
									    <?php echo tribe_get_start_date(null, false, 'M');?>
									</div>
									<div class="event-title">
										<?php echo substr(the_title($before = "", $after = "", FALSE),0, 15);?>
									</div>
									<span class="front-location">
									    <?php echo tribe_get_full_address(); ?>
									</span>
									</a> 
								</div>
							<?php endwhile; ?>
							<?php else: ?>
								<div class="sorry">
									<p>There are currently no upcoming events for the next seven days</p>
								</div>
							</div>
								<?php endif; wp_reset_postdata(); ?>

						</div>
					</div>


						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>