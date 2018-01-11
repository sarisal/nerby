
<?php while (have_posts()) : the_post(); ?>
    <?php if( have_rows('content_section') ): while ( have_rows('content_section') ) : the_row() ?>

    <article>
        <div class="container-fluid">
            <?php if(get_sub_field('primary_heading') && get_sub_field('secondary_heading')): ?>
            <section class="header-content">
                <h1><?= get_sub_field('primary_heading') ?></h1>
                <h2><?= get_sub_field('secondary_heading') ?></h2>
                <div class="header-divider"></div>
            </section>
            <?php endif ?>
        </div>

        <?php if (have_rows('content')): ?>
        <section class="about-item">
            <?php  while (have_rows('content')) : the_row() ?>
                <?php $layout = get_row_layout() ?>
                <?php if($layout == 'content'): ?>
                <div class="container-fluid">
                    <div class="content-item header-content">
                        <?= get_sub_field('content') ?>
                    </div>
                </div>
                <?php elseif($layout == 'image'): ?>
                <div class="image-item">
                    <img src="<?= get_sub_field('image') ?>">
                </div>
                <?php elseif($layout == 'recognition_list'): ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4">
                            <ul>
                                <?php  while (have_rows('left_list')) : the_row() ?>
                                <li><strong><?= get_sub_field('brand_name') ?></strong> - <?= get_sub_field('deliverables') ?></li>
                                <?php endwhile ?>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul>
                                <?php  while (have_rows('middle_list')) : the_row() ?>
                                    <li><strong><?= get_sub_field('brand_name') ?></strong> - <?= get_sub_field('deliverables') ?></li>
                                <?php endwhile ?>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <ul>
                                <?php  while (have_rows('right_list')) : the_row() ?>
                                    <li><strong><?= get_sub_field('brand_name') ?></strong> - <?= get_sub_field('deliverables') ?></li>
                                <?php endwhile ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            <?php endwhile ?>
        </section>
        <?php endif ?>
    </article>
<?php endwhile; endif; endwhile ?>