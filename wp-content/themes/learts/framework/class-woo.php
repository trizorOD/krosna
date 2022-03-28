<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions for WooCommerce
 *
 * @package   InsightFramework
 */
if ( ! class_exists( 'Learts_Woo' ) ) {

	class Learts_Woo {

		/**
		 * The constructor.
		 */
		public function __construct() {

			// Remove default WooCommerce style
			add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

			// 360 product
			add_action( 'woocommerce_before_single_product', array( $this, 'learts_360_product' ), 10 );

			/*****************************************************************************************
			 * AJAX Registration
			 *****************************************************************************************/
			// Wishlist AJAX
			add_action( 'wp_ajax_learts_get_wishlist_fragments',
				array(
					$this,
					'get_wishlist_fragments',
				) );
			add_action( 'wp_ajax_nopriv_learts_get_wishlist_fragments',
				array(
					$this,
					'get_wishlist_fragments',
				) );
			add_action( 'wp_ajax_learts_remove_wishlist_item',
				array(
					$this,
					'remove_wishlist_item',
				) );
			add_action( 'wp_ajax_nopriv_learts_remove_wishlist_item',
				array(
					$this,
					'remove_wishlist_item',
				) );
			add_action( 'wp_ajax_learts_undo_remove_wishlist_item',
				array(
					$this,
					'undo_remove_wishlist_item',
				) );
			add_action( 'wp_ajax_nopriv_learts_undo_remove_wishlist_item',
				array(
					$this,
					'undo_remove_wishlist_item',
				) );

			// Mini cart AJAX
			add_filter( 'woocommerce_add_to_cart_fragments',
				array(
					$this,
					'get_cart_fragments',
				),
				10 );
			add_action( 'wp_ajax_learts_remove_cart_item',
				array(
					$this,
					'remove_cart_item',
				) );
			add_action( 'wp_ajax_nopriv_learts_remove_cart_item',
				array(
					$this,
					'remove_cart_item',
				) );
			add_action( 'wp_ajax_learts_undo_remove_cart_item',
				array(
					$this,
					'undo_remove_cart_item',
				) );
			add_action( 'wp_ajax_nopriv_learts_undo_remove_cart_item',
				array(
					$this,
					'undo_remove_cart_item',
				) );

			// Quick view AJAX
			add_action( 'wp_ajax_learts_quick_view',
				array(
					$this,
					'quick_view',
				) );
			add_action( 'wp_ajax_nopriv_learts_quick_view',
				array(
					$this,
					'quick_view',
				) );
			add_action( 'learts_after_page_container',
				array(
					$this,
					'add_quick_view_container',
				) );
			add_action( 'wp_ajax_learts_ajax_add_to_cart',
				array(
					$this,
					'ajax_add_to_cart',
				) );
			add_action( 'wp_ajax_nopriv_learts_ajax_add_to_cart',
				array(
					$this,
					'ajax_add_to_cart',
				) );

			// Enqueue scripts for the quick view
			add_action( 'wp_enqueue_scripts',
				function () {
					wp_enqueue_script( 'wc-add-to-cart' );
					wp_enqueue_script( 'woocommerce' );
					wp_enqueue_script( 'wc-single-product' );
					wp_enqueue_script( 'wc-add-to-cart-variation' );
				} );

			/******************************************************************************************
			 * Shop Page (Product Archive Page)
			 *****************************************************************************************/

			// Result count & Catalog ordering
			add_filter( 'woocommerce_show_page_title', '__return_false' );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

			// Shop toolbar
			add_action( 'learts_after_page_title', array( $this, 'shop_toolbar' ), 30 );
			add_action( 'learts_after_page_title', array( $this, 'filter_widgets' ), 31 );

			// Categories Rows
			add_action( 'woocommerce_before_shop_loop', array( $this, 'categories_row' ), 32 );

			// Remove breadcrumb
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Remove content wrapper
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper' );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );

			// Change subcategory count HTML
			add_filter( 'woocommerce_subcategory_count_html', array( $this, 'subcategory_count_html', ), 10, 2 );

			// Change thumbnail size for subcategory within loop
			add_filter( 'subcategory_archive_thumbnail_size',
				function () {
					return 'full';
				} );

			add_filter( 'woocommerce_gallery_image_size',
				function () {
					return 'woocommerce_single';
				} );

			add_filter( 'woocommerce_get_image_size_gallery_thumbnail',
				function () {
					return array(
						'width'  => 120,
						'height' => 150,
						'crop'   => 1,
					);
				} );

			//Currency loadmore with WPML
			add_filter( 'wcml_multi_currency_ajax_actions', array( $this, 'add_action_to_multi_currency_ajax' ), 10, 1 );

			/******************************************************************************************
			 * Product Loop Items
			 *
			 * @see woocommerce_template_loop_product_link_open()
			 * @see woocommerce_template_loop_product_link_close()
			 * @see woocommerce_template_loop_add_to_cart()
			 * @see woocommerce_template_loop_product_thumbnail()
			 * @see woocommerce_template_loop_product_title()
			 * @see woocommerce_template_loop_rating()
			 * @see woocommerce_template_loop_price()
			 *****************************************************************************************/
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'button_wishlist' ), 20 );

			add_filter( 'woocommerce_loop_add_to_cart_args', array( $this, 'add_to_cart_args' ), 10, 2 );

			//if( class_exists('pw_woocommerc_brans_Wc_Brands')){
			//	add_action('woocommerce_after_shop_loop_item', array($this, 'brand_show_title'));
			//	remove_action('woocommerce_after_shop_loop_item', array('pw_woocommerc_brans_Wc_Brands', 'brand_show_title'));
			//
			//}

			// Add hover image
			remove_action( 'woocommerce_before_shop_loop_item_title',
				'woocommerce_template_loop_product_thumbnail',
				10 );
			add_action( 'woocommerce_before_shop_loop_item_title',
				array( $this, 'template_loop_product_thumbnail', ),
				10 );

			// Add link to the product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			add_action( 'woocommerce_shop_loop_item_title', array( $this, 'template_loop_product_title', ), 10 );

			// Rating & Price: Swap rating & price
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );

			// Hide default wishlist button
			add_filter( 'yith_wcwl_positions',
				function () {
					return array(
						'add-to-cart' => array(
							'hook'     => '',
							'priority' => 0,
						),
						'thumbnails'  => array(
							'hook'     => '',
							'priority' => 0,
						),
						'summary'     => array(
							'hook'     => '',
							'priority' => 0,
						),
					);
				} );

			// Hide default compare button
			add_filter( 'yith_woocompare_remove_compare_link_by_cat', '__return_true' );

			if ( class_exists( 'Insight_Swatches' ) ) {
				// Hidden swatches default
				add_filter( 'insight_swatches_show_loop',
					function () {
						return false;
					} );
			}

			/******************************************************************************************
			 * Single Product
			 *
			 * @see woocommerce_output_product_data_tabs()
			 * @see woocommerce_upsell_display()
			 * @see woocommerce_output_related_products()
			 *****************************************O************************************************/
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

			// Swap rating & title
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );

			// Swap price & excerpt
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

			// Single Navigation
			add_action( 'woocommerce_single_product_summary',
				function () {
					echo Learts_Templates::single_navigation();
				},
				6 );

			add_filter( 'woocommerce_review_gravatar_size',
				function () {
					return '70';
				} );

			// Change number of Related & Up sells product
			add_filter( 'woocommerce_output_related_products_args',
				function ( $args ) {

					$args['posts_per_page'] = learts_get_option( 'product_related' );
					$args['columns']        = 4;

					return $args;
				} );

			/**
			 * Product List Widget
			 */
			add_filter( 'woocommerce_before_widget_product_list',
				function () {
					return '<div class="product_list_widget">';
				} );
			add_filter( 'woocommerce_after_widget_product_list',
				function () {
					return '</div>';
				} );

			/**
			 * Mini cart
			 */
			add_filter( 'woocommerce_is_attribute_in_product_name',
				array( $this, 'is_attribute_in_product_name', ),
				10,
				3 );

			add_filter( 'woocommerce_get_item_data',
				array( $this, 'get_item_data' ),
				10,
				2 );

			//Add label quantity
			add_action( 'woocommerce_before_add_to_cart_quantity', array( $this, 'add_label_qty' ), 15 );

			add_action( 'woocommerce_before_add_to_cart_quantity', array( $this, 'add_block_quantity' ), 10 );
			add_action( 'woocommerce_after_add_to_cart_quantity', array( $this, 'close_block_quantity' ), 10 );

			//Block Action::Single product
			add_action( 'woocommerce_after_add_to_cart_quantity',
				array( 'Learts_Woo', 'open_block_action_single_product' ),
				10 );
			add_action( 'woocommerce_after_add_to_cart_quantity', array( 'Learts_Woo', 'wishlist_button' ), 10 );
			add_action( 'woocommerce_after_add_to_cart_button', array( 'Learts_Woo', 'compare_button' ), 10 );

			add_action( 'woocommerce_after_add_to_cart_button',
				array( 'Learts_Woo', 'close_block_action_single_product' ),
				10 );

		}

		public static function add_block_quantity() {
			echo '<div class="block-quantity">';
		}

		public static function open_block_action_single_product() {
			echo '<div class="block-action">';
		}

		function close_block_quantity() {
			echo '</div>';
		}

		public static function close_block_action_single_product() {

			global $product;

			if ( $product->is_type( 'external' ) ) {
				echo '';
			} else {
				echo '</div>';
			}
		}

		public static function add_label_qty() {
			echo '<div class="qty">' . esc_html__( 'Quantity', 'learts' ) . '</div>';
		}

		/**
		 * Wishlist widget
		 */
		private function wishlist_widget() {

			$products = YITH_WCWL()->get_products( array(
				'is_default' => true,
			) );

			$products = array_reverse( $products );

			$wl_link = YITH_WCWL()->get_wishlist_url();


			$classes = array( 'wishlist_items product_list_widget' );

			if ( get_option( 'yith_wcwl_remove_after_add_to_cart' ) == 'yes' ) {
				$classes[] = 'remove_after_add_to_cart';
			}

			?>
			<p class="widget_wishlist_title"><?php esc_html_e( 'Wishlist', 'learts' ); ?>
				<a href="#" class="close-btn">&times;</a>
				<span class="undo">
						<?php esc_html_e( 'Item removed.', 'learts' ) ?>
					<a href="#"><?php esc_html_e( 'Undo', 'learts' ); ?></a>
				</span>
			</p>
			<ul class="<?php echo implode( ' ', $classes ); ?>">
				<li class="wishlist_empty_message empty<?php echo empty( $products ) ? '' : ' hidden'; ?>"><?php esc_html_e( 'No products in the wishlist.',
						'learts' ); ?></li>
				<?php
				if ( ! empty( $products ) ) :
					foreach ( $products as $p ) :

						global $product;

						if ( function_exists( 'wc_get_product' ) ) {
							$product = wc_get_product( $p['prod_id'] );
						} else {
							$product = get_product( $p['prod_id'] );
						}

						if ( ! $product ) {
							continue;
						}

						$product_name  = $product->get_title();
						$thumbnail     = $product->get_image( 'shop_thumbnail' );
						$product_price = $product->get_price_html();
						$remove_url    = add_query_arg( 'remove_from_wishlist', $p['prod_id'], $wl_link );

						?>
						<li class="wishlist_item"
						    data-product_id="<?php echo esc_attr( $p['prod_id'] ); ?>"
						    data-wishlist_id="<?php echo esc_attr( $p['wishlist_id'] ); ?>"
						    data-wishlist_token="<?php echo esc_attr( $p['wishlist_token'] ); ?>">
							<a href="<?php echo esc_url( $remove_url ); ?>" class="remove"
							   title="<?php esc_html_e( 'Remove this product', 'learts' ) ?>">&times;</a>
							<?php if ( ! $product->is_visible() ) : ?>
								<?php echo str_replace( array(
										'http:',
										'https:',
									),
										'',
										$thumbnail ) . '&nbsp;'; ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product->get_permalink() ); ?>"
								   class="wishlist_item_product_image">
									<?php echo str_replace( array(
											'http:',
											'https:',
										),
											'',
											$thumbnail ) . '&nbsp;'; ?>
								</a>
							<?php endif; ?>
							<div class="wishlist_item_right">
								<div class="product-title">
									<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product_name ); ?></a>
								</div>
								<?php echo wp_kses_post( $product_price ); ?>
								<?php if ( ! $product->is_in_stock() ) : ?>
									<p class="outofstock"><?php esc_html_e( 'Out of stock', 'learts' ); ?></p>
								<?php endif; ?>
								<?php if ( $product->is_in_stock() && learts_get_option( 'wishlist_add_to_cart_on' ) ) {
									if ( function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
										woocommerce_template_loop_add_to_cart();
									} else {
										wc_get_template( 'loop/add-to-cart.php' );
									}
								} ?>
							</div>
						</li>
					<?php endforeach;
				endif; ?>
			</ul>
			<?php

			if ( ! empty( $products ) ) {

				$target = '';

				if ( learts_get_option( 'wishlist_target' ) ) {
					$target = '_blank';
				}
				?>
				<a href="<?php echo esc_url( $wl_link ); ?>"
				   target="<?php echo esc_attr( $target ); ?>"
				   class="button btn-view-wishlist"><?php esc_html_e( 'View Wishlist', 'learts' ); ?></a>
				<?php
			}
		}

		public function get_wishlist_fragments() {

			if ( ! function_exists( 'wc_setcookie' ) || ! class_exists( 'YITH_WCWL' ) ) {
				return;
			}

			$products = YITH_WCWL()->get_products( array(
				'is_default' => true,
			) );

			ob_start();

			$this->wishlist_widget();

			$wl       = ob_get_clean();
			$wl_count = YITH_WCWL()->count_products();

			// Fragments and wishlist are returned
			$data = array(
				'fragments' => array(
					'span.wishlist-count'         => '<span class="wishlist-count">' . $wl_count . '</span>',
					'div.widget_wishlist_content' => '<div class="widget_wishlist_content">' . $wl . '</div>',
					'tm-wishlist'                 => array(
						'count' => $wl_count,
					),
				),
				'wl_hash'   => md5( json_encode( $products ) ),
			);

			wp_send_json( $data );
		}

		public static function get_quickview_image_size() {

			$cropping_width  = max( 1,
				get_option( 'woocommerce_thumbnail_cropping_custom_width', '3' ) );
			$cropping_height = max( 1,
				get_option( 'woocommerce_thumbnail_cropping_custom_height', '4' ) );
			$image_width     = intval( get_option( 'woocommerce_single_image_width', 432 ) ) * .8;
			$image_height    = absint( round( ( $image_width / $cropping_width ) * $cropping_height ) );

			return array(
				apply_filters( 'learts_quickview_image_width', $image_width ),
				apply_filters( 'learts_quickview_image_height', $image_height ),
			);
		}

		public function remove_wishlist_item() {

			if ( ! function_exists( 'wc_setcookie' ) || ! class_exists( 'YITH_WCWL' ) ) {
				return;
			}

			$item = isset( $_POST['item'] ) ? $_POST['item'] : '';

			if ( ! $item ) {
				return;
			}

			YITH_WCWL()->details['remove_from_wishlist'] = $item['remove_from_wishlist'];
			YITH_WCWL()->details['wishlist_id']          = $item['wishlist_id'];

			if ( is_user_logged_in() ) {
				YITH_WCWL()->details['user_id'] = get_current_user_id();
			}

			if ( YITH_WCWL()->remove() ) {
				$this->get_wishlist_fragments();
			} else {
				wp_send_json( array( 'success' => $this->get_wishlist_fragments() ) );
			}

			$this->get_wishlist_fragments();
		}

		public function undo_remove_wishlist_item() {
			if ( ! function_exists( 'wc_setcookie' ) || ! class_exists( 'YITH_WCWL' ) ) {
				return;
			}

			$item = isset( $_POST['item'] ) ? $_POST['item'] : '';

			if ( ! $item ) {
				return;
			}

			YITH_WCWL()->details['add_to_wishlist'] = $item['add_to_wishlist'];
			YITH_WCWL()->details['wishlist_id']     = $item['wishlist_id'];

			if ( is_user_logged_in() ) {
				YITH_WCWL()->details['user_id'] = get_current_user_id();
			}

			if ( YITH_WCWL()->add() ) {
				$this->get_wishlist_fragments();
			} else {
				wp_send_json( array( 'success' => false ) );
			}
		}

		public static function get_cart_count() {

			ob_start();

			?>
			<span class="minicart-count"><?php echo WC()->cart->cart_contents_count; ?></span>
			<?php

			return ob_get_clean();
		}

		public static function get_cart_total() {

			ob_start();
			?>

			<span class="minicart-total"><?php echo WC()->cart->get_cart_total(); ?></span>

			<?php

			return ob_get_clean();
		}

		private function get_formated_cart_total( $price, $args = array() ) {

			extract( apply_filters( 'wc_price_args',
				wp_parse_args( $args,
					array(
						'ex_tax_label'       => false,
						'currency'           => '',
						'decimal_separator'  => wc_get_price_decimal_separator(),
						'thousand_separator' => wc_get_price_thousand_separator(),
						'decimals'           => wc_get_price_decimals(),
						'price_format'       => get_woocommerce_price_format(),
					) ) ) );

			$negative = $price < 0;
			$price    = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * - 1 : $price ) );
			$price    = apply_filters( 'formatted_woocommerce_price',
				number_format( $price, $decimals, $decimal_separator, $thousand_separator ),
				$price,
				$decimals,
				$decimal_separator,
				$thousand_separator );

			if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
				$price = wc_trim_zeros( $price );
			}

			$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format,
					'<span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol( $currency ) . '</span>',
					$price );

			return $formatted_price;
		}

		public function get_cart_fragments( $fragments ) {

			$count = $this->get_cart_count();
			$total = $this->get_cart_total();

			$fragments['span.minicart-count'] = $count;
			$fragments['span.minicart-total'] = $total;
			$fragments['tm-minicart']         = array(
				'total' => $this->get_formated_cart_total( WC()->cart->subtotal ),
				'count' => WC()->cart->cart_contents_count,
			);

			return $fragments;

		}

		public function refresh_cart_fragments() {

			$cart_ajax = new WC_AJAX();
			$cart_ajax->get_refreshed_fragments();

			exit();
		}

		public function remove_cart_item() {

			$item = isset( $_POST['item'] ) ? $_POST['item'] : '';

			if ( $item ) {
				WC()->instance()->cart->remove_cart_item( $item );
			}

			$this->refresh_cart_fragments();
		}

		public function undo_remove_cart_item() {

			$item = isset( $_POST['item'] ) ? $_POST['item'] : '';

			if ( $item ) {
				WC()->cart->restore_cart_item( $item );
			}

			$this->refresh_cart_fragments();
		}

		/**
		 * Shop Toolbar
		 */
		public function shop_toolbar() {

			if ( ! learts_get_option( 'shop_toolbar' ) || ! self::is_shop() ) {
				return;
			}

			ob_start();

			$column_switcher = learts_get_option( 'column_switcher' );
			$columns         = isset( $_COOKIE['learts_shop_columns'] ) && ! is_null( $_COOKIE['learts_shop_columns'] ) ? intval( $_COOKIE['learts_shop_columns'] ) : intval( get_option( 'woocommerce_catalog_columns',
				4 ) );
			$tabs            = learts_get_option( 'product_tabs' );
			$sort            = learts_get_option( 'product_sorting' );
			$full_width_shop = learts_get_option( 'full_width_shop' );

			if ( $tabs ) {
				$type      = learts_get_option( 'product_tabs_type' );
				$tabs_html = array(
					'<li data-filter="*" class="active"><a href="#">' . esc_html__( 'All',
						'learts' ) . '</a></li>',
				);

				if ( $type == 'tags' ) {
					$tags = trim( learts_get_option( 'product_tabs_tags' ) );
					$tags = get_terms( array(
						'taxonomy' => 'product_tag',
						'orderby'  => 'include',
						'name'     => explode( ',', $tags ),
					) );

					if ( $tags ) {
						foreach ( $tags as $tag ) {
							$tabs_html[] = sprintf( '<li data-filter=".product_tag-%s"><a href="#">%s</a></li>',
								esc_attr( $tag->slug ),
								esc_html( $tag->name ) );
						}
					}
				} elseif ( $type == 'categories' ) {
					$tab_categories = learts_get_option( 'product_tabs_categories' );
					$args           = array(
						'taxonomy' => 'product_cat',
						'orderby'  => 'count',
						'order'    => 'DESC',
						'parent'   => 0,
					);

					if ( is_numeric( $tab_categories ) ) {
						$args['number'] = $tab_categories;
						$args['parent'] = '';
					} elseif ( ! empty( $tab_categories ) ) {
						$args['name']    = explode( ',', $tab_categories );
						$args['orderby'] = 'include';
						$args['parent']  = '';
					}

					$categories = get_terms( $args );

					if ( $categories && ! is_wp_error( $categories ) ) {
						foreach ( $categories as $category ) {
							$tabs_html[] = sprintf( '<li data-filter=".product_cat-%s"><a href="#">%s</a></li>',
								esc_attr( $category->slug ),
								esc_html( $category->name ) );
						}
					}
				} elseif ( $type == 'groups' ) {
					$groups = learts_get_option( 'product_tabs_groups' );

					if ( $groups['featured'] ) {
						$tabs_html[] = '<li data-filter=".featured"><a href="#">' . esc_html__( 'Hot Products',
								'learts' ) . '</a></li>';
					}

					if ( $groups['new'] ) {
						$tabs_html[] = '<li data-filter=".new"><a href="#">' . esc_html__( 'New Products',
								'learts' ) . '</a></li>';
					}

					if ( $groups['sale'] ) {
						$tabs_html[] = '<li data-filter=".sale"><a href="#">' . esc_html__( 'Sales Products',
								'learts' ) . '</a></li>';
					}
				}
			}

			?>
			<div class="shop-toolbar <?php echo '' . ( $column_switcher === '0' ) ? ' disable-switcher' : ''; ?>">
				<div class="container<?php echo esc_attr( $full_width_shop != 'basic' ) ? ' wide' : ''; ?>">
					<div class="row">
						<div
							class="col-md-9 col-lg-8 hidden-xs nav-filter<?php echo esc_attr( $tabs ? '' : ' no-tabs' ); ?>">
							<?php if ( $tabs ) : ?>
								<ul class="product-tabs">
									<?php echo implode( "\n", $tabs_html ) ?>
								</ul>
							<?php else: ?>
								<?php
								if ( $sort ) {
									woocommerce_catalog_ordering();
								}
								woocommerce_result_count();
								?>
							<?php endif; ?>
						</div>
						<div class="col-md-3 col-lg-4 controls">
							<ul class="toolbar-control">
								<?php if ( $tabs ) : ?>
									<li class="totals">
										<?php
										if ( $sort ) {
											woocommerce_catalog_ordering();
										} else {
											woocommerce_result_count();
										}
										?>
									</li>
								<?php endif; ?>
								<li class="col-switcher">
									<a href="#" class="<?php echo esc_attr( $columns == 3 ) ? 'active' : '' ?>"
									   data-col="5">
										<i class="ti-layout-grid4-alt"></i>
									</a>
									<a href="#" class="<?php echo esc_attr( $columns == 4 ) ? 'active' : '' ?>"
									   data-col="4">
										<i class="ti-layout-grid3-alt"></i>
									</a>
									<a href="#" class="<?php echo esc_attr( $columns == 5 ) ? 'active' : '' ?>"
									   data-col="3">
										<i class="ti-layout-grid2-alt"></i>
									</a>
								</li>
								<?php if ( is_active_sidebar( 'shop-filter' ) && learts_get_option( 'product_filter' ) ) : ?>
									<li class="filter-button">
										<a href="#" class="open-filters"><?php _e( 'Фільтр', 'learts' ); ?></a>
									</li><!-- .l-filter-buttons -->
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php
			echo ob_get_clean();
		}

		/**
		 * Filter Widget
		 */
		public function filter_widgets() {

			if ( ! learts_get_option( 'shop_toolbar' ) || ! self::is_shop() ) {
				return;
			}

			$full_width_shop = learts_get_option( 'full_width_shop' );

			if ( is_active_sidebar( 'shop-filter' ) && learts_get_option( 'product_filter' ) ) :
				ob_start();
				?>
				<div class="filter-widgets">
					<div class="container<?php echo esc_attr( $full_width_shop != 'basic' ) ? ' wide' : ''; ?>">
						<div class="row">
							<?php dynamic_sidebar( 'shop-filter' ); ?>
						</div>
					</div>
				</div>
				<div class="active-filters">
					<div class="container<?php echo esc_attr( $full_width_shop != 'basic' ) ? ' wide' : ''; ?>">
						<div class="row">
							<div class="col-xs-12">
								<?php the_widget( 'WC_Widget_Layered_Nav_Filters' ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				echo ob_get_clean();
			endif;
		}

		/**
		 * Categories Row
		 */
		public function categories_row() {

			$display_type = woocommerce_get_loop_display_mode();

			// If displaying categories, append to the loop.
			if ( 'subcategories' === $display_type || 'both' === $display_type ) {

				$layout        = learts_get_option( 'categories_layout' );
				$data_carousel = ' data-carousel="' . learts_get_option( 'categories_columns' ) . '"';
				$before        = '<div class="categories-row row';

				if ( $layout == 'carousel' ) {
					$before .= ' categories-carousel"';
					$before .= $data_carousel . '>';
				} else {
					$before .= '">';
				}

				woocommerce_output_product_categories( array(
					'before'    => $before,
					'after'     => '</div>',
					'parent_id' => is_product_category() ? get_queried_object_id() : 0,
				) );
			}
		}

		/**
		 * Product categories menu on the product archive page
		 *
		 * @return string|void
		 */
		public static function product_categories_menu() {

			$args = array(
				'hide_empty'         => 0,
				'menu_order'         => 'asc',
				'show_option_all'    => '',
				'show_option_none'   => '',
				'taxonomy'           => 'product_cat',
				'title_li'           => '',
				'use_desc_for_title' => 1,
			);

			$current_cat = false;

			if ( is_tax( 'product_cat' ) ) {
				$current_cat = get_queried_object();
			}

			// Show children of current category
			if ( $current_cat ) {

				// Direct children are wanted
				$include = get_terms( 'product_cat',
					array(
						'fields'       => 'ids',
						'parent'       => $current_cat->term_id,
						'hierarchical' => true,
						'hide_empty'   => false,
					) );

				$args['include']          = implode( ',', $include );
				$args['current_category'] = ( $current_cat ) ? $current_cat->term_id : '';

				$link = ( $current_cat->parent ) ? get_category_link( $current_cat->parent ) : get_permalink( wc_get_page_id( 'shop' ) );

				if ( empty( $include ) ) { ?>
					<?php if ( is_product_category() || is_product_tag() ) { ?>
						<div class="shop-menu">
							<a href="#" class="show-categories-menu"><?php esc_html_e( 'Categories',
									'learts' ) ?></a>
							<ul class="product-categories-menu">
								<li class="cat-item shop-back-link">
									<a href="<?php echo esc_url( $link ); ?>"><span>&larr;</span><?php esc_html_e( 'Back',
											'learts' ) ?>
									</a>
								</li>
							</ul>
						</div>
						<?php
					}

					return;
				}

			} else {
				$args['child_of']     = 0;
				$args['depth']        = 1;
				$args['hierarchical'] = 1;
			}

			$args = apply_filters( 'learts_product_categories_menu_args', $args );

			include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

			ob_start();
			?>
			<div class="shop-menu">
				<a href="#" class="show-categories-menu"><?php esc_html_e( 'Categories', 'learts' ) ?></a>
				<ul class="product-categories-menu">
					<?php if ( is_product_category() || is_product_tag() ) : ?>
						<?php $link = ( $current_cat->parent ) ? get_category_link( $current_cat->parent ) : get_permalink( wc_get_page_id( 'shop' ) ); ?>
						<li class="cat-item shop-back-link">
							<a href="<?php echo esc_url( $link ); ?>"><span>&larr;</span><?php esc_html_e( 'Back',
									'learts' ) ?>
							</a>
						</li>
					<?php endif; ?>
					<?php wp_list_categories( $args ); ?>
				</ul>
			</div>

			<?php

			return ob_get_clean();
		}

		public function subcategory_count_html( $mark_class_count_category_count_mark, $category ) {
			if ( $category->count > 0 ) {
				echo ' <mark class="count">' . $category->count . '</mark>';
			}
		}

		/**
		 * Calculate sale percentage
		 *
		 * @param $product
		 *
		 * @return float|int
		 */
		public static function get_sale_percentage( $product ) {
			$percentage    = 0;
			$regular_price = $product->get_regular_price();
			$sale_price    = $product->get_sale_price();

			if ( $product->get_regular_price() ) {
				$percentage = - round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
			}

			return $percentage . '%';
		}

		public function button_wishlist() {

			?>
			<div class="product-buttons">
				<?php
				echo Learts_Woo::wishlist_button();
				?>
			</div>
			<?php
		}

		/**
		 * Add product name (for add to cart notification)
		 *
		 * @param $args
		 * @param $product
		 *
		 * @return mixed
		 */
		public function add_to_cart_args( $args, $product ) {
			$args['attributes']['data-product_name'] = get_the_title( $product->get_id() );

			return $args;
		}

		/**
		 * Add a hover image for product thumbnail within loops
		 *
		 * @see woocommerce_template_loop_product_thumbnail()
		 */
		public function template_loop_product_thumbnail() {

			global $product;

			$id        = $product->get_id();
			$size      = 'shop_catalog';
			$gallery   = get_post_meta( $id, '_product_image_gallery', true );
			$hover_img = '';

			$size = apply_filters( 'learts_product_loop_thumbnail_size', $size );

			if ( ! empty( $gallery ) ) {
				$gallery        = explode( ',', $gallery );
				$first_image_id = $gallery[0];
				$hover_img      = wp_get_attachment_image( $first_image_id,
					$size,
					false,
					array( 'class' => 'hover-image' ) );
			}

			$thumb_img = get_the_post_thumbnail( $id, $size, array( 'class' => 'thumb-image' ) );
			if ( ! $thumb_img ) {
				if ( wc_placeholder_img_src() ) {
					$thumb_img = wc_placeholder_img( $size );
				}
			}

			echo '' . $thumb_img;
			echo '' . $hover_img;
		}

		/**
		 * Custom product title instead of default product title
		 *
		 * @see woocommerce_template_loop_product_title()
		 */
		public function template_loop_product_title() {
			echo '<div class="product-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
		}

		/**
		 * Wishlist button
		 */
		public static function wishlist_button() {
			if ( class_exists( 'YITH_WCWL' ) && learts_get_option( 'shop_wishlist_on' ) ) {
				echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			}
		}

		/**
		 * Quickview button
		 */
		public static function quick_view_button() {

			ob_start();

			global $product;
			$id = $product->get_id();

			if ( learts_get_option( 'shop_quick_view_on' ) && ! wp_is_mobile() ) : ?>
				<div class="quick-view-btn hint--top hint-bounce"
				     aria-label="<?php esc_html_e( 'Quick View', 'learts' ); ?>"
				     data-pid="<?php echo esc_attr( $id ) ?>"
				     data-pnonce="<?php echo esc_attr( wp_create_nonce( 'learts_quick_view' ) ); ?>">
					<a href="#" aria-label="<?php esc_html_e( 'Quick View', 'learts' ); ?>" rel="nofollow">
						<?php esc_html_e( 'Quick View', 'learts' ); ?>
					</a>
				</div>
			<?php endif;

			echo ob_get_clean();
		}

		/**
		 * Compare button
		 */
		public static function compare_button() {

			ob_start();

			global $product;
			$id = $product->get_id();

			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'learts' ) );

			if ( function_exists( 'yith_wpml_register_string' ) && function_exists( 'yit_wpml_string_translate' ) ) {
				yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
				$button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			}

			if ( class_exists( 'YITH_Woocompare' ) && learts_get_option( 'shop_compare_on' ) && ! wp_is_mobile() ) : ?>
				<div class="compare-btn hint--bounce hint--top"
				     aria-label="<?php esc_html_e( 'Compare', 'learts' ); ?>">
					<?php
					//die();
					printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>',
						self::get_compare_add_product_url( $id ),
						'compare',
						$id,
						$button_text );
					?>
				</div>
			<?php endif;

			echo ob_get_clean();
		}

		/**
		 * Get compare URL
		 */
		private static function get_compare_add_product_url( $product_id ) {

			$action_add = 'yith-woocompare-add-product';

			$url_args = array(
				'action' => $action_add,
				'id'     => $product_id,
			);

			return apply_filters( 'yith_woocompare_add_product_url',
				esc_url_raw( add_query_arg( $url_args ) ),
				$action_add );
		}

		public function quick_view() {

			global $post, $product;

			$post = get_post( $_REQUEST['pid'] );
			setup_postdata( $post );

			$product = wc_get_product( $post->ID );

			ob_start();

			get_template_part( 'woocommerce/quick-view' );

			echo ob_get_clean();

			die();
		}

		public function add_quick_view_container() {
			echo '<div id="woo-quick-view" class="' . ( learts_get_option( 'animated_quick_view_on' ) ? 'animated-quick-view' : '' ) . '"></div>';
		}

		public function ajax_add_to_cart() {

			global $woocommerce;

			$variation_id      = ( isset( $_POST['variation_id'] ) ) ? $_POST['variation_id'] : '';
			$_POST['quantity'] = ( isset( $_POST['quantity'] ) ) ? $_POST['quantity'] : 1;

			$variations = array();

			foreach ( $_POST as $key => $value ) {
				if ( substr( $key, 0, 10 ) == 'attribute_' ) {
					$variations[ $key ] = $value;
				}
			}

			if ( is_array( $_POST['quantity'] ) && ! empty( $_POST['quantity'] ) ) { // grouped product
				$quantity_set = false;

				foreach ( $_POST['quantity'] as $id => $qty ) {

					if ( $qty > 0 ) {

						$quantity_set = true;
						$atc          = $woocommerce->cart->add_to_cart( $id, $qty );

						if ( $atc ) {
							continue;
						} else {
							break;
						}
					}
				}

				if ( ! $quantity_set ) {
					$response            = array( 'result' => 'fail' );
					$response['message'] = esc_html__( 'Please choose the quantity of items you wish to add to your cart.',
						'learts' );
				}

			} else { // simple & variable product
				$atc = $woocommerce->cart->add_to_cart( $_POST['pid'], $_POST['quantity'], $variation_id, $variations );
			}

			if ( $atc ) {
				$this->refresh_cart_fragments();
			} else {

				$sold_indv = get_post_meta( $_POST['pid'], '_sold_individually', true );

				if ( $sold_indv == 'yes' ) {
					$response            = array( 'result' => 'fail' );
					$response['message'] = esc_html__( 'Sorry, that item can only be added once.', 'learts' );
				} else {

					if ( ! is_array( $_POST['quantity'] ) ) {
						$response            = array( 'result' => 'fail' );
						$response['message'] = esc_html__( 'Sorry, something went wrong. Please try again.',
							'learts' );
					}
				}

				$response['post'] = $_POST;

				wp_send_json( $response );
			}
		}

		/**
		 * Get Instagram image by hashtag for product
		 *
		 * @return string|void
		 */
		public static function product_instagram() {

			$hashtag = get_post_meta( Learts_Helper::get_the_ID(), 'learts_product_hashtag', true );

			if ( ! $hashtag ) {
				return;
			}

			ob_start();

			$number = apply_filters( 'learts_product_instagram_number', 8 );
			$col    = apply_filters( 'learts_product_instagram_columns', 4 );
			$class  = Learts_Helper::get_grid_item_class( array(
				'xl' => $col,
				'lg' => 4,
				'md' => 2,
				'sm' => 1,
			) );

			?>
			<div class="product-instagram">
				<div class="container">
					<p><?php printf( wp_kses( __( 'Tag your photos with <a href="%s" target="%s">%s</a> on Instagram.',
							'learts' ),
							'learts' ),
							esc_url( 'https://www.instagram.com/explore/tags/' . substr( $hashtag, 1 ) ),
							$hashtag,
							apply_filters( 'learts_product_instagram_link_target', '__blank' ) ); ?></p>
					<?php

					$media_array = learts_Instagram::get_instance()->scrape_instagram( $hashtag, $number );

					if ( is_wp_error( $media_array ) ): ?>
						<div class="tm-instagram--error">
							<p><?php echo wp_kses_post( $media_array->get_error_message() ); ?></p>
						</div>
					<?php else: ?>
						<div class="tm-instagram-pics row">
							<?php foreach ( $media_array as $item ) : ?>
								<div class="item <?php echo esc_attr( $class ) ?>">
									<div class="item-info">
										<span><?php esc_html_e( 'View on Instagram', 'learts' ); ?></span>
									</div>
									<img src="<?php echo esc_url( $item['thumbnail'] ) ?>" alt="image"
									     class="item-image"/>
									<?php if ( 'video' == $item['type'] ) : ?>
										<span class="play-button"></span>
									<?php endif; ?>

									<div class="overlay">
										<a href="<?php echo esc_url( $item['link'] ); ?>"
										   target="<?php echo apply_filters( 'learts_product_instagram_link_target',
											   '_blank' ); ?>"><?php esc_html_e( 'View on Instagram', 'learts' ) ?></a>
									</div>

								</div>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>
				</div>
			</div>
			<?php

			return ob_get_clean();
		}

		/**
		 * Display variation name
		 * The product must be get by $_product->get_title() instead of $_product->get_name()
		 *
		 * The product in cart will be display like this: https://prntscr.com/fe1ylt
		 * instead of this: https://prntscr.com/fe1yt9
		 *
		 * @param $is_in_name
		 * @param $attribute
		 * @param $name
		 *
		 * @return bool
		 */
		public function is_attribute_in_product_name( $is_in_name, $attribute, $name ) {
			return false;
		}

		/**
		 * Gets and formats a list of cart item data + variations for display on the frontend.
		 *
		 * @param $cart_item
		 *
		 * @return string
		 */
		public static function get_item_data( $swatch_item_data, $cart_item ) {

			if ( ! current_theme_supports( 'insight-swatches' ) ) {
				return $swatch_item_data;
			}

			$isw_settings = get_option( 'isw_settings' );

			if ( class_exists( 'SitePress' ) ) {

				global $sitepress;

				if ( method_exists( $sitepress, 'get_default_language' ) ) {

					$default_language = $sitepress->get_default_language();
					$current_language = $sitepress->get_current_language();

					if ( $default_language != $current_language ) {
						$isw_settings = get_option( 'isw_settings_' . $current_language );
					}
				}
			}

			// Variation values are shown only if they are not found in the title as of 3.0.
			// This is because variation titles display the attributes.
			if ( $cart_item['data']->is_type( 'variation' ) && is_array( $cart_item['variation'] ) ) {
				foreach ( $cart_item['variation'] as $name => $value ) {
					$taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

					if ( taxonomy_exists( $taxonomy ) ) {
						// If this is a term slug, get the term's nice name.
						$term = get_term_by( 'slug', $value, $taxonomy );
						if ( ! is_wp_error( $term ) && $term && $term->name ) {
							$value = $term->name;
						}
						$label = wc_attribute_label( $taxonomy );
					} else {
						continue;
					}

					if ( isset( $isw_settings['isw_attr'] ) && is_array( $isw_settings['isw_attr'] ) && in_array( $taxonomy,
							$isw_settings['isw_attr'] ) ) {

						$isw_attr = $isw_settings['isw_attr'];

						if ( isset( $isw_settings['isw_style'] ) && is_array( $isw_settings['isw_style'] ) ) {
							$isw_style = $isw_settings['isw_style'];
							$swatch    = '';

							for ( $i = 0; $i < count( $isw_style ); $i ++ ) {

								if ( $taxonomy == $isw_attr[ $i ] ) {

									switch ( $isw_style[ $i ] ) {

										case 'isw_color':

											if ( isset( $isw_settings['isw_custom'] ) && is_array( $isw_settings['isw_custom'] ) ) {

												$isw_custom = isset( $isw_settings['isw_custom'][ $i ] ) ? $isw_settings['isw_custom'][ $i ] : '';

												if ( is_array( $isw_custom ) ) {

													foreach ( $isw_custom as $key => $value ) {

														if ( $term->slug == $key ) {
															$swatch_style = 'background-color:' . $value . ';';
														}
													}
												}

												if ( ! empty( $swatch_style ) ) {
													$swatch = '<span class="filter-swatch swatch-color hint--top hint--bounce" aria-label="' . esc_attr( esc_html( $term->name ) ) . '" style="' . $swatch_style . '"></span>';
												}
											}
											break;

										case 'isw_image':

											if ( isset( $isw_settings['isw_custom'] ) && is_array( $isw_settings['isw_custom'] ) ) {

												$isw_custom = isset( $isw_settings['isw_custom'][ $i ] ) ? $isw_settings['isw_custom'][ $i ] : '';

												if ( is_array( $isw_custom ) ) {

													foreach ( $isw_custom as $key => $value ) {

														if ( $term->slug == $key ) {

															$swatch = '<span class="filter-swatch swatch-image hint--top hint--bounce" aria-label="' . esc_attr( esc_html( $term->name ) ) . '"><img src="' . esc_url( $value ) . '" alt="' . esc_attr( $term->slug ) . '"/></span>';
														}
													}
												}
											}
											break;

										case 'isw_html':

											if ( isset( $isw_settings['isw_custom'] ) && is_array( $isw_settings['isw_custom'] ) ) {

												$isw_custom = isset( $isw_settings['isw_custom'][ $i ] ) ? $isw_settings['isw_custom'][ $i ] : '';

												if ( is_array( $isw_custom ) ) {

													foreach ( $isw_custom as $key => $value ) {

														if ( $term->slug == $key ) {

															$swatch = '<span class="filter-swatch swatch-html">' . $value . '</span>';
														}
													}
												}
											}
											break;

										case 'isw_text':
										default:

											if ( isset( $isw_settings['isw_custom'] ) && is_array( $isw_settings['isw_custom'] ) ) {

												$isw_custom = isset( $isw_settings['isw_custom'][ $i ] ) ? $isw_settings['isw_custom'][ $i ] : '';

												if ( is_array( $isw_custom ) ) {

													foreach ( $isw_custom as $key => $value ) {

														if ( $term->slug == $key ) {

															$swatch = '<span class="filter-swatch swatch-text">' . $value . '</span>';
														}
													}
												}
											}
											break;
									}
								}
							}

							$swatch_item_data[] = array(
								'id'      => 'isw_item_data',
								'name'    => $label,
								'value'   => $value,
								'display' => $swatch,
							);
						}
					}
				}
			}

			return $swatch_item_data;
		}

		/**
		 * Get product by given data source
		 *
		 * @param $data_source
		 * @param $atts array
		 * @param $args array Additional arguments
		 *
		 * @return mixed|WP_Query
		 */
		public static function get_products_by_datasource( $data_source, $atts, $args = array() ) {

			global $learts_options;

			if ( isset( $atts['product_style'] ) ) {
				if ( $atts['product_style'] == 'button-hover' ) {
					$learts_options['product_style'] = 'button-hover';
				}

				if ( $atts['product_style'] == 'default' ) {
					$learts_options['product_style'] = 'default';
				}
			}

			$defaults = array(
				'post_type'           => 'product',
				'status'              => 'published',
				'ignore_sticky_posts' => 1,
				'orderby'             => $atts['orderby'],
				'order'               => $atts['order'],
				'posts_per_page'      => intval( $atts['number'] ) > 0 ? intval( $atts['number'] ) : 1000,
			);

			$args = wp_parse_args( $args, $defaults );

			switch ( $data_source ) {
				case 'filter':
					$tax_array = $atts['tax_array'];
					$tax_query = array();

					foreach ( $tax_array as $key => $value ) {

						$tax_query[] = array(
							'relation' => $value['query_type'],
							array(
								'taxonomy' => $key,
								'field'    => 'slug',
								'terms'    => $value['terms'],
							),
						);
					}

					$args['tax_query'] = array( $tax_query );

					break;
				case 'featured_products':
					if ( version_compare( WC()->version, '3.0.0', '<' ) ) {
						$args['meta_key']   = '_featured';
						$args['meta_value'] = 'yes';
					} else {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'product_visibility',
								'field'    => 'name',
								'terms'    => array( 'featured' ),
								'operator' => 'IN',
							),
						);
					}
					break;
				case 'sale_products':
					$args['meta_query'] = array(
						array(
							'key'     => '_sale_price',
							'value'   => 0,
							'compare' => '>',
							'type'    => 'numeric',
						),
					);
					break;
				case 'best_selling_products':
					$args['meta_key'] = 'total_sales';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = 'DESC';
					break;
				case 'top_rated_products':
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = 'DESC';
					break;
				case 'product_attribute':
					$args['tax_query'] = array(
						array(
							'taxonomy' => strstr( $atts['attribute'],
								'pa_' ) ? sanitize_title( $atts['attribute'] ) : 'pa_' . sanitize_title( $atts['attribute'] ),
							'field'    => 'slug',
							'terms'    => array_map( 'sanitize_title', explode( ',', $atts['filter'] ) ),
						),
					);
					break;
				case 'products':
					if ( $atts['product_ids'] != '' ) {
						$args['post__in'] = explode( ',', $atts['product_ids'] );
						$args['orderby']  = ( ! $args['orderby'] || $args['orderby'] == 'none' ) ? 'post__in' : '';
					}
					break;
				case 'categories':
					$args['tax_query'] = array(
						'relation' => 'OR',
						array(
							'taxonomy'         => 'product_cat',
							'field'            => 'slug',
							'terms'            => explode( ',', $atts['product_cat_slugs'] ),
							'include_children' => $atts['include_children'],
						),
					);
					break;
				case 'category':
					$args['tax_query'] = array(
						'relation' => 'OR',
						array(
							'taxonomy'         => 'product_cat',
							'field'            => 'slug',
							'terms'            => $atts['category'],
							'include_children' => $atts['include_children'],
						),
					);
					break;
				case 'recent_products':
					$args['orderby'] = 'DESC';
					$args['order']   = 'DESC';
					break;
				default:
					if ( ! $args['orderby'] || $args['orderby'] == 'menu_order' ) {
						$args['order'] = 'ASC';
					}
					break;
			}

			switch ( $atts['orderby'] ) {
				case 'price':
				case 'price-desc':
					$args['meta_key'] = '_price';
					$args['orderby']  = 'meta_value_num';
					break;
				case 'salse':
					$args['meta_key'] = 'total_sales';
					$args['orderby']  = 'meta_value_num';
					break;
				case 'rating':
					$args['meta_key'] = '_wc_average_rating';
					$args['orderby']  = 'meta_value_num';
					break;
			}


			$transient_name = 'learts_wc_loop' . substr( md5( json_encode( $args ) . $data_source ),
					28 ) . WC_Cache_Helper::get_transient_version( 'product_query' );
			$query          = get_transient( $transient_name );

			if ( false === $query || ! is_a( $query, 'WP_Query' ) ) {
				$query = new WP_Query( $args );
				set_transient( $transient_name, $query, DAY_IN_SECONDS * 30 );
			}

			return $query;

		}

		/**
		 * Get base shop page link
		 *
		 * @param bool $keep_query
		 *
		 * @return false|string|void|WP_Error
		 */
		public static function get_shop_page_link( $keep_query = false ) {

			// Base Link decided by current page
			if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
				$link = home_url();
			} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
				$link = get_post_type_archive_link( 'product' );
			} elseif ( is_product_category() ) {
				$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
			} elseif ( is_product_tag() ) {
				$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
			} else {
				$link = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			}

			if ( $keep_query ) {

				// Keep query string vars intact
				foreach ( $_GET as $key => $val ) {

					if ( 'orderby' === $key || 'submit' === $key ) {
						continue;
					}

					$link = add_query_arg( $key, $val, $link );
				}
			}

			return $link;
		}

		public static function is_shop() {
			return ( is_shop() || is_product_taxonomy() );
		}

		public function learts_360_product() {
			$product_360_on           = get_post_meta( Learts_Helper::get_the_ID(), 'learts_product_360_on', true );
			$product_360_numbers      = get_post_meta( Learts_Helper::get_the_ID(),
				'learts_product_360_numbers',
				true );
			$product_360_image_review = get_post_meta( Learts_Helper::get_the_ID(),
				'learts_product_360_image_review',
				true );
			$product_360_image        = get_post_meta( Learts_Helper::get_the_ID(), 'learts_product_360_image', true );
			if ( $product_360_on === 'on' ) { ?>
				<div class="cd-product-viewer-wrapper has-<?php echo esc_attr( $product_360_numbers ) ?>-frames"
				     data-frame="<?php echo esc_attr( $product_360_numbers ); ?>" data-friction="0.1">
					<a href="#" class="close-360">
						<i class="ti-close"></i>
					</a>
					<div class="product-viewer">
						<?php if ( $product_360_image && $product_360_image_review ) { ?>
							<img src="<?php echo esc_attr( $product_360_image_review ); ?>" alt="Product Preview">
							<div
								style="background: url('<?php echo esc_attr( $product_360_image ); ?>') no-repeat center center;"
								class="product-sprite"
								data-image="<?php echo esc_attr( $product_360_image ); ?>"></div>
						<?php } ?>
					</div>

					<div class="cd-product-viewer-handle">
						<span class="fill"></span>
						<span class="handle"></span>
					</div>
				</div>
			<?php }
		}

		public function add_action_to_multi_currency_ajax( $ajax_actions ) {
			$ajax_actions[] = 'learts_ajax_load_more';

			return $ajax_actions;
		}
	}

	new Learts_Woo();
	}
