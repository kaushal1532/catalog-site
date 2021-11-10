(function($) {
    $("#primaryNavMenu li").addClass("nav-item");
    $("#primaryNavMenu li a").addClass("nav-link");
    $("#primaryNavMenu li.current-menu-item a, #primaryNavMenu li.current_page_item a").addClass("text-dark active");

    $(".load-more-blogs").on("click", function(e) {
        e.preventDefault();
        myAjax.blogs_paged = parseInt(myAjax.blogs_paged) + 1
        jQuery.ajax({
            type: "post",
            url: myAjax.ajaxurl,
            data: {
                action: "load_more_blogs",
                paged: myAjax.blogs_paged
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

}(jQuery));