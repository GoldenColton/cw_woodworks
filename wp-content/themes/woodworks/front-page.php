<?php get_header(); //includes header.php ?>
<div id="primary" class="content-area">
	<main class="home-content content">

		<?php 
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		//Show one "featured" piece from the portfolio
		$featured_work = new WP_Query( array(
			'post_type' 		=> 'portfolio_piece',
			'posts_per_page' 	=> 1,
			//example of a tax_query
			'tax_query' 		=> array(
					array(
						'taxonomy' => 'type_of_work',
						'field' => 'slug',
						'terms' => 'featured',
					),
			),
		) );
		?>
		<div class="home_section_wrapper work-wrapper">
			<section class="featured-work" >
				<h2>Work</h2>
		<?php
		if( $featured_work->have_posts() ):
			while( $featured_work->have_posts() ): 
					 $featured_work->the_post();
		?>
			  	<div class="the-work">
			  		<div class="image-overlay">
			  			<a href="<?php the_permalink(); ?>">
			  				<?php the_post_thumbnail( 'banner' ); ?>
			  			</a>
			  			<h3><?php the_title(); ?></h3>
			  		</div>
			  		<?php the_excerpt(); ?>
			  	</div>
		<?php endwhile; ?>
		<?php else: ?>
			<p>Currently no pieces are available to show.</p>
		<?php endif; 
		//clean up after you're done querying!
		wp_reset_postdata();
		?>
			</section>
		</div>
		<div class="home_section_wrapper about-wrapper">
			<section>
				<h2>About</h2>
				<p>Insert the first paragraph of the about page.</p>
			</section>
		</div>
		<div class="home_section_wrapper contact-wrapper">
			<section>
				<h2>Contact</h2>
				<p>Insert excerpt from the contact page.</p>
				<p>insert an <a>email link</a></p>
			</section>
		</div>

	</main>
</div>
<!-- end #content -->

<?php get_footer(); //includes footer.php ?>