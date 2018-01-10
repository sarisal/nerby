<?php $query = new WP_Query( $args ) ?>
<div class="container-fluid grid-list grid">

    <?php if( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); ?>

    <div class="col-xs-12 <?= ( $columns == 4 ? 'col-sm-3' : 'col-sm-6' ) ?> grid-list-item">
        <figure>
            <a href="<?= get_the_permalink() ?>">
                <?php the_post_thumbnail( 'full' ) ?>
            </a>
            <figcaption>
                <div>
                    <div>
                        <span><?= get_field('thumbnail_title') ?: get_the_title() ?></span>
                        <p><?= get_field('thumbnail_subtext') ?></p>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
    <?php endwhile; wp_reset_postdata(); endif ?>
</div>