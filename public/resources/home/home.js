    $(".thumbnail").click(function(e) {
        var roomId = jQuery(this).attr("id");
        console.log(roomId);
        window.location.assign(window.location.origin+"/room/"+roomId);
    });
