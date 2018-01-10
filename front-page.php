<?php
namespace Roots\Sage;
use Roots\Sage\View;
$social_links = get_field('social_links', 'options');
?>
<?php while (have_posts()) : the_post(); ?>


    <section class="content full-width">
        <?= View::render( 'templates/grid-list.php', [ 'args' => 'post_type=project&posts_per_page=12&post_status=publish' ]) ?>
    </section>

<?php endwhile; ?>