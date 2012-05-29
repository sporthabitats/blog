<?php 
/*
* The template for displaying the footer.
*/
?>
	</section><!--//main-->		

	<footer id="footer" class="container" role="contentinfo">	
		<div class="sixteen columns">
			<?php if ( is_active_sidebar( 'footer-bottom' ) ) { ?>
					<?php dynamic_sidebar( 'footer-bottom' ); ?>
			<?php } ?>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
</body>
</html>