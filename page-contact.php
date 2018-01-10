<?php while (have_posts()) : the_post(); ?>
    <div class="container-fluid">
        <?php the_content(); ?>
    </div>
<?php endwhile; ?>
