/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){function i(){var b,c,d={height:f.innerHeight,width:f.innerWidth};return d.height||(b=e.compatMode,(b||!a.support.boxModel)&&(c="CSS1Compat"===b?g:e.body,d={height:c.clientHeight,width:c.clientWidth})),d}function j(){return{top:f.pageYOffset||g.scrollTop||e.body.scrollTop,left:f.pageXOffset||g.scrollLeft||e.body.scrollLeft}}function k(){if(b.length){var e=0,f=a.map(b,function(a){var b=a.data.selector,c=a.$element;return b?c.find(b):c});for(c=c||i(),d=d||j();e<b.length;e++)if(a.contains(g,f[e][0])){var h=a(f[e]),k={height:h[0].offsetHeight,width:h[0].offsetWidth},l=h.offset(),m=h.data("inview");if(!d||!c)return;l.top+k.height>d.top&&l.top<d.top+c.height&&l.left+k.width>d.left&&l.left<d.left+c.width?m||h.data("inview",!0).trigger("inview",[!0]):m&&h.data("inview",!1).trigger("inview",[!1])}}}var c,d,h,b=[],e=document,f=window,g=e.documentElement;a.event.special.inview={add:function(c){b.push({data:c,$element:a(this),element:this}),!h&&b.length&&(h=setInterval(k,250))},remove:function(a){for(var c=0;c<b.length;c++){var d=b[c];if(d.element===this&&d.data.guid===a.guid){b.splice(c,1);break}}b.length||(clearInterval(h),h=null)}},a(f).on("scroll resize scrollstop",function(){c=d=null}),!g.addEventListener&&g.attachEvent&&g.attachEvent("onfocusin",function(){d=null})});

(function($) {

    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function() {
                $('.grid-list-item').on('inview', function(event, isInView) {
                    if (isInView) {
                        $('figure', $(this)).addClass('ready');
                    }
                });
                // JavaScript to be fired on all pages
                $("select").selecter({
                    label: "Please Select"
                });
                $('#open-mobile').on('click', function(){
                    $('#responsive-navigation, #close-mobile').show();
                    $(this).hide();
                });
                $('#close-mobile').on('click', function(){
                    $(this).hide();
                    $('#open-mobile').show();
                    $('#responsive-navigation').hide();
                });
                $('select.filter').on('change', function(){
                    if( $(this).val() != '' ) {
                        window.location = $(this).val();
                        return false;
                    }
                });
                function revealIntro() {
                    setTimeout(function() {
                        $('h1').addClass('ready');
                        $('h2').addClass('ready');
                    }, 200);
                }
                revealIntro();

            },
            finalize: function() {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        // Home page
        'home': {
            init: function() {

                function revealIntro() {
                    setTimeout(function() {
                        $('body.home ul.social-icons').addClass('ready');
                    }, 200);
                }

                $('.grid-list-item').on('inview', function(event, isInView) {
                    if (isInView) {
                        $('figure', $(this)).addClass('ready');
                    }
                });

                revealIntro();

                // JavaScript to be fired on the home page
                // function resizeHomeContent() {
                //
                //     if( $(window).width() > 700 ) {
                //         var windowHeight = $(window).height(),
                //             percentage = (29 / 100) * windowHeight;
                //
                //         $('.full-screen').css({
                //             height: ( windowHeight - percentage )
                //         });
                //     }
                // }
                //
                // $(window).bind('resize', function() {
                //     resizeHomeContent();
                // });
                //
                // resizeHomeContent();

            },
            finalize: function() {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // About us page, note the change from about-us to about_us.
        'about': {
            init: function() {

                function resizeAside() {
                    if( $(window).width() > 800 ) {
                        var $aside = $('body.about aside'),
                            parentHeight = $('#upper-left-content').height(),
                            asideHeight = $aside.height(),
                            asideMargin = (parentHeight >= asideHeight ) ? (parentHeight - asideHeight) - ( (parentHeight - asideHeight) / 2) : 0;
                        }
                    else {
                        asideMargin = 30;
                    }

                    $aside.css('marginTop', asideMargin );
                }
                // JavaScript to be fired on the home page
                function resizeHomeContent() {
                    if( $(window).width() > 800 ) {

                        var windowHeight = $(window).height(),
                            percentage = (20.5 / 100) * windowHeight;

                        $('.full-screen').css({
                            height: ( windowHeight - percentage )
                        });
                    }
                }

                $(window).bind('resize', function() {
                    resizeHomeContent();
                    resizeAside();
                });

                resizeHomeContent();
                resizeAside();
            }
        },

        'category_blog': {
            init: function() {
                var height = $('div.grid-list .grid-list-item:first-child').find('img').eq(0).attr('height');
                console.log(height);
                $('.grid-list-item').each(function() {
                    $(this).css('maxHeight', height);
                });

                $(window).on('resize', function() {
                    $('.grid-list-item').each(function() {
                        $(this).css('maxHeight', 'auto');
                    });
                });
            }
        },

        'work': {
            init: function() {
                function revealIntro() {
                    setTimeout(function() {
                        $('body.home ul.social-icons').addClass('ready');
                    }, 200);
                }

                $('.grid-list-item').on('inview', function(event, isInView) {
                    if (isInView) {
                        $('figure', $(this)).addClass('ready');
                    }
                });

                //animate;
                revealIntro();
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            // Fire common init JS
            UTIL.fire('common');

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
