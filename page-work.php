<?php
namespace Roots\Sage;
use Roots\Sage\View;
?>
<?php while (have_posts()) : the_post(); ?>
    <section class="content full-width">
        <?php if( is_user_logged_in() && is_admin() == false ): ?>
            <?= View::render( 'templates/grid-list.php', [ 'args' => 'post_type=project&posts_per_page=-1&post_status=private' ]) ?>
        <?php else: ?>
            <?= View::render( 'templates/grid-list.php', [ 'args' => 'post_type=project&posts_per_page=-1' ]) ?>
        <?php endif ?>
    </section>

    <section class="container-fluid links">
        <div class="row">
            <div class="col-md-12">
                <?= get_field('footer_links', 17) ?>
            </div>
        </div>
    </section>
<?php endwhile; ?>