<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package learts
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Нічого не знайдено', 'learts' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Готові опублікувати свій перший пост? <a href="%1$s">Почніть тут</a>.', 'learts' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Вибачте, але нічого не відповідає вашим пошуковим термінам. Будь ласка, спробуйте ще раз із іншими ключовими словами.', 'learts' ); ?></p>
			<?php
				get_search_form(); 

		else : ?>

			<p><?php esc_html_e( 'Здається, ми не можемо знайти те, що ви шукаєте. Можливо, пошук допоможе.', 'learts' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section><!-- .no-results -->
