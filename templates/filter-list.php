<?php
$query = new WP_Query( $args );
$tags  = get_tags([ 'hide_empty' => false ]);
?>
<div class="container-fluid filter-list">
    <div class="row">
        <div class="col-xs-12 col-md-7">
            <?php if($heading): ?><h2><?= $heading ?></h2><?php endif ?>
        </div>
        <div class="col-md-2 hidden-xs">
            <label for="filter" class="filter-label">Filter by</label>
        </div>
        <div class="col-md-3 hidden-xs">
            <div class="filter-list-sort">
                <select class="filter">
                    <?php foreach( $tags as $tag ): ?>
                    <option value="<?= get_tag_link( $tag->term_id ) ?>"><?= $tag->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 filter-list-item">
            <a href="<?= get_the_permalink() ?>" class="thumb-link"><?php the_post_thumbnail( 'project-thumbnail' ) ?></a>
            <h3><a href="<?= get_the_permalink() ?>"><?php the_title() ?></a></h3>
            <p><?= Roots\Sage\Utils\get_excerpt(get_the_excerpt(), 250) ?></p>
            <?= get_the_tag_list('<p class="tag"><i class="icon-tag"></i> Found in: &nbsp;','','</p>'); ?>
        </div>
        <?php endwhile; wp_reset_postdata(); else: ?>
            There are no posts to show here.
        <?php endif ?>
    </div>
</div>