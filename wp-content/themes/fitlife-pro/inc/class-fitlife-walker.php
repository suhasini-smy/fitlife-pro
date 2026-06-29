<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FitLife_Walker extends Walker_Nav_Menu {

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {

		$item = $data_object;

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$active = in_array( 'current-menu-item', $classes, true ) ? ' active' : '';

		$output .= '<li class="' . esc_attr( trim( $active ) ) . '">';

		$output .= '<a href="' . esc_url( $item->url ) . '">';

		$output .= esc_html( $item->title );

		if ( in_array( 'menu-item-has-children', $classes, true ) ) {
			$output .= ' <span class="dropdown-arrow" aria-hidden="true">▼</span>';
		}

		$output .= '</a>';
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= "</li>\n";
	}
}