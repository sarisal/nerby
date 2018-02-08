<?php
/**
 * Template Name: Projects
 */

namespace Roots\Sage;
use Roots\Sage\View;
?>
<?php while (have_posts()) : the_post(); ?>

<div class="container-fluid">

    <h3>Most Recent Projects</h3>

    <?php if(get_sub_field('primary_heading') && get_sub_field('secondary_heading')): ?>
    <section class="header-content">
        <h1><?= get_sub_field('primary_heading') ?></h1>
        <h2><?= get_sub_field('secondary_heading') ?></h2>
        <div class="header-divider"></div>
    </section>
    <?php endif ?>

    <?php if($projects = get_field('featured_projects', 'option')): ?>
    <section class="content full-width">

        <div class="container-fluid grid-list grid">

            <?php foreach($projects as $project): setup_postdata($project) ?>

                <div class="col-xs-12 col-sm-6 grid-list-item">
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
            <?php endforeach; wp_reset_postdata() ?>
        </div>
    </section>
    <?php endif ?>
</div>

<div class="grey-wrapper">
    <div class="container-fluid">

        <?php  while (have_rows('project_list')) : the_row() ?>
            <h3><?= get_sub_field('heading') ?></h3>
            <table class="project-table" width="100%">
                <thead>
                    <tr>
                        <th width="63%">Name</th>
                        <th width="25%">Type</th>
                        <th width="12%">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (have_rows('projects')): while (have_rows('projects')) : the_row() ?>
                    <?php $project = get_sub_field('project') ?>
                    <tr>
                        <td><a href="<?= get_permalink($project) ?>"><?= $project->post_title ?></a></td>
                        <td><?= strip_tags(get_the_category_list(',', '', $project)) ?></td>
                        <td><?= date('d/m/Y', strtotime($project->post_date)) ?></td>
                    </tr>
                    <?php endwhile; endif ?>
                </tbody>
            </table>
        <?php endwhile ?>
    </div>
</div>
<?php endwhile ?>