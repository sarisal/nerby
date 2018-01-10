<?php
global $wp_query;
$post = $wp_query->post;
use Roots\Sage\Nav;
?>
</div>
<footer>
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <span id="footer-copyright"><?= get_field('footer_text', 'options') ?></span>
        </div>
        <div class="col-sm-6">
            <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav horizontal footer-nav']);
            endif;
            ?>
        </div>
    </div>
  </div>
</footer>