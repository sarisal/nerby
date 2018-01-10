<?php
namespace Roots\Sage;
use Roots\Sage\View;
?>
<section class="content full-width">
    <?= View::render( 'templates/grid-list.php', [ 'columns' => 4, 'args' => 'cat=2&posts_per_page=-1' ]) ?>
</section>