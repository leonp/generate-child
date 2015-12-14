<?php

// Enqueue main.css

function rbt_styles() {

    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/main.css'
    );

    wp_enqueue_script( 'roboto', get_stylesheet_directory_uri() . '/js/fonts.js', array(), '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'rbt_styles', 500 );


// Overwrite generater function so a link to comments outputted on single pages

function generate_posted_on() {

	if ( 'post' !== get_post_type() )
		return;

	$date = apply_filters( 'generate_post_date', true );
	$author = apply_filters( 'generate_post_author', true );

	$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	// If our date is enabled, show it
	if ( $date ) :
		printf( '<span class="posted-on">%1$s</span>',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				$time_string
			)
		);
	endif;

	// If our author is enabled, show it
	if ( $author ) :
		printf( ' <span class="byline">%1$s</span>',
			sprintf( '<span class="author vcard" itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author">%1$s <a class="url fn n" href="%2$s" title="%3$s" rel="author" itemprop="url"><span class="author-name" itemprop="name">%4$s</span></a></span>',
				__( 'by','generate'),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'generate' ), get_the_author() ) ),
				esc_html( get_the_author() )
			)
		);
	endif;

    // If comments enabled link to them

    if ( comments_open() ) {

		echo '<span class="comments-link"><a href="#reply-title">Add a comment</a></span>';

	}

}


?>
