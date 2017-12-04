<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */
?>

<article <?php post_class(); ?>>

	<header class="post-header">
		<h1><?php esc_html_e( 'Preview: ', 'acorn' ) . the_title(); ?></h1>

		<div class="entry-meta">
			Date: <code><?php the_date(); ?></code>
			Author: <code><?php the_author(); ?></code>
			Slug: <code><?php echo esc_html( $post->post_name ); ?></code>
		</div><!-- .entry-meta -->
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<footer class="post-footer">
			<?php the_tags( 'Tags: <code>', ', ', '</code><br/>' ); ?>
			<?php echo esc_html( 'Categories: ' ) . '<code>' . get_the_category_list( ', ' ) . '</code>'; ?>
		</footer>
	<?php endif; ?>

</article>
