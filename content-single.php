<?php
namespace Roots\Sage;
use Roots\Sage\View;
$tags  = get_tags();

while (have_posts()) : the_post();
    $post_id = get_the_ID();
    setup_postdata( $post_id );
    $prev_post = get_next_post();
    $next_post = get_previous_post();

    if( have_rows('content_sections') ):?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php the_content() ?>
            </div>
        </div>
    </div>

    <?php $count = 1 ?>
    <?php while ( have_rows('content_sections') ) : the_row() ?>
        <div class="content-section content-section-<?= get_row_layout() ?>">
            <?php
            $bg = get_sub_field('background_colour') ?: 'transparent';
            $title = get_sub_field('title');
            ?>

            <?php if( get_row_layout() == 'image' ): ?>

            <div class="content-section-title" style="color: <?= get_sub_field('title_colour') ?: '#222' ?>"><?= $title ?></div>
            <?php if( have_rows('images') ): while ( have_rows('images') ) : the_row() ?>

            <?php $image = get_sub_field('image') ?>
            <div class="content-section-item" style="background-color: <?= $bg ?>;">
                <img src="<?= $image['url'] ?>" alt="<?= get_the_title() ?>">
            </div>
            <?php endwhile; endif ?>

            <?php elseif( get_row_layout() == 'video' ): ?>
            <div class="content-section-item" style="background-color: <?= $bg ?>;padding: 140px 0">
                <?php if( $title ): ?>
                <div class="content-section-title" style="color: <?= get_sub_field('title_colour') ?: '#222' ?>"><?= $title ?></div>
                <?php endif ?>
                <div class="embed-container"><?= get_sub_field('embed_code') ?></div>
            </div>

            <?php elseif( get_row_layout() == 'slideshow' ): ?>
            <div class="content-section-item" style="background-color: <?= $bg ?>;">
                <?php if( $title ): ?>
                    <div class="content-section-title" style="color: <?= get_sub_field('title_colour') ?: '#222' ?>"><?= $title ?></div>
                <?php endif ?>
                <?php if( get_sub_field('images') ): ?>
                <!-- Slider main container -->
                <div id="slider-<?= $count ?>" class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php foreach( get_sub_field('images') as $image ): ?>
                        <div class="swiper-slide">
                            <img src="<?= $image['image'] ?>" alt="">
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php $slideshow_arrow_colour = get_sub_field('slideshow_arrow_colour') ?>
                    <div class="swiper-button-prev" style="color: <?= ( $slideshow_arrow_colour == 'light' ? '#fff' : '#222' ) ?>">
                        <i class="icon-arrow-left"></i>
                    </div>
                    <div class="swiper-button-next" style="color: <?= ( $slideshow_arrow_colour == 'light' ? '#fff' : '#222' ) ?>">
                        <i class="icon-arrow-right"></i>
                    </div>
                </div>
                <?php else: ?>
                No images in slideshow
                <?php endif ?>
            </div>
            <?php endif ?>
        </div>
        <?php $count++ ?>
        <?php endwhile; ?>

        <?php else: ?>
        <div class="container-fluid entry-content">
            <div class="row pagination-row">
                <div class="col-md-6 back">
                    <a href="/blog" class="black button"><i class="icon-arrow-left"></i> Past Projects</a>
                </div>
                <div class="col-md-6 prev-next">
                    <a href="<?= get_permalink( $prev_post ) ?>" class="black button"><i class="icon-arrow-left"></i></a>
                    <a href="<?= get_permalink( $next_post ) ?>" class="black button"><i class="icon-arrow-right"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="row post-content">
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <section class="container-fluid links">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if (!empty( $prev_post )): ?>
                        <a href="<?= get_permalink( $prev_post ) ?>" class="post-link left-link">
                            <span><?= get_field('thumbnail_title', $prev_post->ID) ?: get_the_title($prev_post) ?></span>
                            <?= get_field('thumbnail_subtext', $prev_post->ID) ?>
                        </a>
                    <?php endif ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if (!empty( $next_post )): ?>
                        <a href="<?= get_permalink( $next_post ) ?>" class="post-link right-link">
                            <span><?= get_field('thumbnail_title', $next_post->ID) ?: get_the_title($next_post) ?></span>
                            <?= get_field('thumbnail_subtext', $next_post->ID) ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </section>

<?php endwhile; ?>

<script>
    $(document).ready(function() {
        $('.swiper-container').each(function(){
            var swp = $(this).swiper({
                mode:'horizontal',
                loop: true,
                slidesPerView: 1,
                autoHeight:true
            });

            var $swipers = $(this);

            $swipers.find('.swiper-button-prev').on('click', function(e){
                e.preventDefault();
                swp.slidePrev();
            });
            $swipers.find('.swiper-button-next').on('click', function(e){
                e.preventDefault();
                swp.slideNext();
            });
        });
    });
</script>
