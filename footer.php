			<footer class="footer" role="contentinfo">
				<?php if ( shortcode_exists( 'instagram-feed' ) ) { echo do_shortcode('[instagram-feed num=12 cols=6 imagepadding=0 showheader=false  showfollow=false showbutton=false]'); } ?>
				<div id="inner-footer" class="wrap cf">
					<div class="source-org copyright">
						&#169; <?php echo date_i18n(__('Y','travel-notes')) . ' '; bloginfo( 'name' ); ?>
						<span><?php if(is_home()): ?>
							- <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'travel-notes' ) ); ?>"><?php printf( __( 'Powered by %s', 'travel-notes' ), 'WordPress' ); ?></a> <span><?php esc_html_e('and','travel-notes'); ?></span> <a href="<?php echo esc_url( __( 'http://wpdevshed.com/', 'travel-notes' ) ); ?>"><?php printf( esc_html( '%s', 'travel-notes' ), 'WP Dev Shed' ); ?></a>
						<?php endif; ?>
						</span>
					</div>
				</div>

			</footer>
			<a href="#" class="scrollToTop"><span class="fa fa-chevron-circle-up"></span></a>
		</div>

		<?php wp_footer(); ?>
	</body>

</html>