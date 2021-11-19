(function($) {
    $("#primaryNavMenu li").addClass("nav-item");
    $("#primaryNavMenu li a").addClass("nav-link");
    $("#primaryNavMenu li.current-menu-item a, #primaryNavMenu li.current_page_item a").addClass("text-dark active");

    $(".load-more-blogs").on("click", function(e) {
        e.preventDefault();
        let query_filter = $(this).attr("data-query_filter");
        if (query_filter != "") {
            query_filter = JSON.parse(query_filter);
        }
        myAjax.blogs_paged = parseInt(myAjax.blogs_paged) + 1
        jQuery.ajax({
            type: "post",
            url: myAjax.ajaxurl,
            data: {
                action: "load_more_blogs",
                paged: myAjax.blogs_paged,
                query_filter: query_filter
            },
            success: function(response) {
                if (response == "") {
                    $(".load-more-blogs").fadeOut();
                    return;
                }

                let blog_data = $(".blogs-data").html();
                blog_data += response;
                $(".blogs-data").html(blog_data);
            }
        });
    });

    /* Mobile Menu Logic */
    // to close mobile menu when user will click out side the menu
    $(window).on("click", function() {
        if ($('.catlog-site-mobile-menu').hasClass('active')) {
            $(".catlog-site-mobile-menu, .catlog-site-mobile-menu ul").removeClass("active");
            return false;
        }
    });

    // prevent mobile menu close when user will click inside the mobile menu
    $('.catlog-site-mobile-menu').on("click", function(e) {
        e.stopPropagation();
    });

    // to open main mobile menu
    $(".catlog-site-mobile-menu-btn").on("click", function(e) {
        e.preventDefault();
        $(".catlog-site-mobile-menu").toggleClass("active");
        e.stopPropagation(); // prevent mobile menu close when user will click inside the mobile menu
    });

    // to close main mobile menu
    $(".catlog-site-mobile-menu-close").on("click", function(e) {
        e.preventDefault();
        $(".catlog-site-mobile-menu").removeClass("active");
    });

    // to open all sub mobile menu items
    $(".catlog-site-mobile-menu ul li a").on("click", function(e) {
        let subMenuItems = $(this).parent().find(">ul.sub-menu");
        if (subMenuItems.length > 0) {
            e.preventDefault();
            subMenuItems.addClass('active');
        }
    });

    // to add mobile sub menu back button icon
    $(".catlog-site-mobile-menu ul li").each(function() {
        let subMenuItems = $(this).find(">ul.sub-menu");
        if (subMenuItems.length > 0) {
            $(subMenuItems).prepend('<li><a href="#" class="catlog-site-mobile-menu-sub-menu-close"><i class="bi bi-chevron-left"></i></a></li>');
        }
    });

    // to back mobile sub menu
    $(".catlog-site-mobile-menu-sub-menu-close").on("click", function(e) {
        e.preventDefault();
        $(this).parent().parent().removeClass("active");
    });

    // to add icon to menu items which has sub menu
    $(".catlog-site-mobile-menu ul li").each(function() {
        let subMenuItems = $(this).find(">ul.sub-menu");
        if (subMenuItems.length > 0) {
            $(this).find(">a").append('<i class="bi bi-chevron-right float-end"></i>');
        }
    });
    /* EOF Mobile Menu Logic */

}(jQuery));