<?php

/**
 * Adds a custom taxonomy for placing posts in a series and adding a block to that end.
 */
class LkWdwrd_Post_Series {
	const TAX = 'lkwdwrd_post_series';
	public static function load() {
		add_action( 'init', array( __CLASS__, 'register_tax' ) );
		add_action( 'wp', array( __CLASS__, 'add_filter' ) );
	}
	public static function register_tax() {
		$args = array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'              => _x( 'Series', 'Post series general name', 'lkwdwrd' ),
				'singular_name'     => _x( 'Series', 'Post series singular name', 'lkwdwrd' ),
				'search_items'      => __( 'Search Genres', 'lkwdwrd' ),
				'all_items'         => __( 'All Series', 'lkwdwrd' ),
				'parent_item'       => __( 'Parent Series', 'lkwdwrd' ),
				'parent_item_colon' => __( 'Parent Series:', 'lkwdwrd' ),
				'edit_item'         => __( 'Edit Series', 'lkwdwrd' ),
				'update_item'       => __( 'Update Series', 'lkwdwrd' ),
				'add_new_item'      => __( 'Add New Series', 'lkwdwrd' ),
				'new_item_name'     => __( 'New Genre Series', 'lkwdwrd' ),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'series' ),
		);
		register_taxonomy( self::TAX, array( 'post', 'page' ), $args );
	}
	public static function add_filter() {
		if ( is_single() && is_object_in_term( get_the_id(), self::TAX ) ) {
			add_filter( 'the_content', array( __CLASS__, 'add_series' ) );
		}
	}
	public static function add_series( $content ) {
		// get the terms
		$terms = get_the_terms( get_the_id(), self::TAX );
		if ( is_wp_error( $terms ) || ! $terms ) {
			return $cotnent;
		}
		// generate series markup
		$series_markup = '';
		foreach( $terms as $term ) {
			$posts = get_objects_in_term( $term->term_id, self::TAX );
			if ( is_wp_error( $posts ) || 2 > count( $posts ) ) {
				continue;
			}
			$series_markup .= '<div class="lkwdwrd-post-series">';
			$series_markup .= '<h3 class="lkwdwrd-post-series-title">' . esc_attr( $term->name ) . '</h3>';
			if ( ! empty( $term->description ) ) {
				$series_markup .= '<p>' . esc_html( $term->description ) . '</p>';
			}
			$series_markup .= '<ul>';
			foreach( $posts as $post ) {
				$series_markup .= '<li>';
				$series_markup .= '<a href="' . get_the_permalink( $post ) . '" ';
				$series_markup .= 'title="' . get_the_title( $post ) . '" ';
				$serise_markup .= 'rel="related" ';
				$series_markup .= '>';
				$series_markup .= get_the_title( $post );
				$series_markup .= '</a>';
				$series_markup .= '</li>';
			}
			$series_markup .= '</ul>';
			$series_markup .= '</div>';
		}
		return $content . $series_markup;
	}
}