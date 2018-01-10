<?php
global $wp_query;
$post = $wp_query->post;
use Roots\Sage\Nav;

$page_object = get_queried_object();
$page_id     = get_queried_object_id();
$social_links = get_field('social_links', 'options');
$background_image = get_field('background_image', $post->ID);
$header_height = get_field('header_height', $post->ID);
$primary_heading = get_field('primary_heading', $post->ID);
$secondary_heading = get_field('secondary_heading', $post->ID);
$project_heading = get_field('project_heading', $post->ID);
$project_sub_heading = get_field('project_sub_heading', $post->ID);
$rotating_titles = get_field('rotating_titles', $post->ID);

// Let's work out which heading to use
if($project_heading && $project_sub_heading) {
    $heading = $project_heading;
    $sub_heading = $project_sub_heading;
}

elseif($primary_heading && $secondary_heading) {
    $heading = $primary_heading;
    $sub_heading = $secondary_heading;
}

else {
    $heading = get_the_title($post->ID);
}

if(is_page('contact') && $_POST) {
    $heading = 'Fail??!!';
}
?>
<header>
    <div id="responsive-navigation">
    <?php
    if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav horizontal']);
    endif;
    ?>
    </div>
    <div class="container-fluid" id="header-top">
        <div class="row main-header">
            <div class="col-xs-6">
                <a href="<?= esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" id="logo">
                    <i class="icon-n"></i>
                </a>
            </div>
            <div class="col-xs-6">
                <a href="javascript:;" id="open-mobile"><i class="icon-burger"></i></a>
                <a href="javascript:;" id="close-mobile"><i class="icon-x"></i></a>
                <nav role="navigation">
                    <?php
                    if (has_nav_menu('primary_navigation')) :
                        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new Nav\SageNavWalker(), 'menu_class' => 'nav navbar-nav horizontal']);
                    endif;
                    ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid header-bottom">
        <div class="row">
            <div class="col-md-12">
                <section class="header-content">
                    <?php
                    // Check for rotating titles
                    if( have_rows('rotating_titles') ):
                        $titles = [];
                        while ( have_rows('rotating_titles') ) : the_row();
                            $titles[] = get_sub_field('title');
                        endwhile;
                    ?>
                    <h1 class="rotate">
                        <?= implode(" ", $titles) ?>
                    </h1>
                    <?php else: ?>
                    <h1><?= $heading ?></h1>
                    <?php endif ?>
                    <h2><?= $sub_heading ?></h2>
                    <div class="header-divider"></div>
                    <?php if($project_heading): ?>
                    <p><?= $post->post_content ?></p>
                    <?php endif ?>
                </section>
            </div>
        </div>
    </div>

</header>

<div id="body-container">