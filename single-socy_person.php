<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-10 col-md-offset-1 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					
							
						<div class="row">
						<div class="col-md-4">
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
						
							<?php the_post_thumbnail( 'circle-ppl' ); ?>
							
							<div class="page-header"><h1 class="single-title person" itemprop="headline"><?php the_title(); ?></h1></div>
							
							<p class="meta"><?php _e("Posted", "wpbootstrap"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php echo get_the_date('F jS, Y', '','', FALSE); ?></time> <?php _e("by", "wpbootstrap"); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", "wpbootstrap"); ?> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
						</div>

							<div class="col-md-4">
								<?php 
								the_field('twitter'); 
							?>
							</div>
							<div class="col-md-4">
								courses feed - field returns <?php the_field('courses')?>
								<?php 
								$the_tags = get_field('courses');
								$args = array( 
									'posts_per_page' => 5,
									'order' => 'DSC',
									'tag__in' => $the_tags,
									);
								$the_query = new WP_Query( $args );
								// The Loop
								if ( $the_query->have_posts() ) {
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										echo '<a href="' . get_the_permalink() . '"><div class="news">';
										echo  the_post_thumbnail('thumbnail' , array( 'class' => 'alignleft' )) . '<br/><h3>' . get_the_title() . '</h3><div class="news_excerpt">' . get_the_excerpt() . " . . . <br/> (click for more)";
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
							
							<?php wp_link_pages(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ' ', '</p>'); ?>
							
							<?php 
							// only show edit button if user has permission to edit posts
							if( $user_level > 0 ) { 
							?>
							<a href="<?php echo get_edit_post_link(); ?>" class="btn btn-success edit-post"><i class="icon-pencil icon-white"></i> <?php _e("Edit post","wpbootstrap"); ?></a>
							<?php } ?>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template('',true); ?>
					
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
    
    
			</div> <!-- end #content -->

<?php get_footer(); ?>