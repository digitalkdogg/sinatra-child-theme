<?php
/**
 * The template for displaying theme footer.
 *
 * @package     Sinatra
 * @author      Sinatra Team <hello@sinatrawp.com>
 * @since       1.0.0
 */

?>

<?php do_action( 'sinatra_before_footer' ); ?>
<div id="sinatra-footer" <?php sinatra_footer_classes(); ?>>
	<div class="si-container">
		<div class="si-flex-row" id="sinatra-footer-widgets">

			<?php millwood_footer_widgets(); ?>

		</div><!-- END .si-flex-row -->
	</div><!-- END .si-container -->
</div><!-- END #sinatra-footer -->
<input type = "hidden" id = "customvars" value = "<?php echo get_custom_vars(); ?>" />
<input type = "hidden" id = "sitename" value = "<?php echo get_sitename_var(); ?>" />
<?php do_action( 'sinatra_after_footer' ); ?>
