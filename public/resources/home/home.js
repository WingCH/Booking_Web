    $(".thumbnail").click(function(e) {
        var roomId = jQuery(this).attr("id");
        console.log(roomId);
        window.location.assign("http://www.booking.wingpage.net/room/"+roomId);
    });