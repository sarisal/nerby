<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
    <div class="container-fluid">
        <div class="alert alert-warning">
            <?php _e('Sorry, no results were found.', 'sage'); ?>
        </div>
    </div>
<?php endif; ?>

<div class="container-fluid">
    <div class="row filter-list">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 filter-list-item">
            <a href="<?= get_the_permalink() ?>" class="thumb-link"><?php the_post_thumbnail( 'project-thumbnail' ) ?></a>
            <h3><?php the_title() ?></h3>
            <p><?php the_excerpt() ?></p>
            <?= get_the_tag_list('<p class="tag"><i class="icon-tag"></i> Found in: &nbsp;','','</p>'); ?>
        </div>
    <?php endwhile; ?>
    </div>
</div>