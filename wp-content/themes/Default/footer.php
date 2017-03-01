<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

?>
    </section><!-- #content-wrap -->
    <footer id="site-footer" class="<?php footer_class(true); ?>" role="contentinfo">
            <?php
            get_template_part( 'templates/footer/footer', 'widgets' );
            ?>
    </footer>
</section><!-- #site -->
<?php wp_footer(); ?>
</body>
</html>
