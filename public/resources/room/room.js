$(function () {
    $("#calendar").fullCalendar({
        editable: false, // enable draggable events
        // eventDurationEditable: true, //調整持續時間
        eventOverlap: false, //調整大小的事件相互重疊。
        height: "auto",
        scrollTime: "09:00",
        ///早上9點 - 晚上9點
        minTime: "09:00:00",
        maxTime: "21:00:00",
        //每段時間一個鐘
        slotDuration: "01:00:00",
        header: {
            left: "today prev,next",
            center: "title",
            right: "timelineDay,timelineThreeDays,agendaWeek,listWeek"
        },
        defaultView: "timelineDay",
        views: {
            timelineThreeDays: {
                type: "timeline",
                duration: {
                    days: 3
                }
            }
        },
        //Room 資料
        resourceLabelText: "Rooms",
        resources: [
            {
                id: $("#room_id").val(),
                title: $("#room_name").val()
            }
        ],
        //Booking 資料
        events: function (start, end, timezone, callback) {
            jQuery.ajax({
                url:
                    window.location.origin + "/room/" +
                    $("#room_id").val() +
                    "/getBooking",
                type: "GET",
                dataType: "json",
                data: {
                    // start: start.format(),
                    // end: end.format()
                },
                success: function (doc) {
                    console.log(doc);
                    var events = [];
                    $.each(doc, function (index, value) {
                        console.log("index: " + index);
                        console.log("value: " + value.id);
                        console.log("loged userID: " + $("#user_id").val());
                        console.log("event userID: " + value.user_id);

                        //如果個booking自己既就可以edit佢
                        if ($("#user_id").val() == value.user_id) {
                            events.push({
                                id: value.id,
                                resourceId: value.room_id,
                                start: value.start,
                                end: value.end,
                                color: 'green',
                                durationEditable: true
                            });
                        } else {
                            events.push({
                                id: value.id,
                                resourceId: value.room_id,
                                start: value.start,
                                end: value.end,
                                color: 'gray',
                                durationEditable: false
                            });
                        }

                    });
                    console.log(events);
                    callback(events);
                }
            });
        },
        //Click
        eventClick: function (calEvent, jsEvent, view) {
            // alert('Event: ' + calEvent.title);
            console.log("event id: " + calEvent.id);
            console.log("event start: " + calEvent.start.format()); //iso 8601 -> string

        },
        dayClick: function (date, jsEvent, view, resourceObj) {
            if (moment(date.format()).isBefore()) {
                alert('不能預約已過去的時間');
                return;
            }

            hasEvent = false;
            eventArray = $("#calendar").fullCalendar("clientEvents");
            for (var i = eventArray.length - 1; i >= 0; i--) {
                // console.log(i);
                // console.log('Event Strat: ' + eventArray[i].start.format());
                // console.log('Date: ' + date.format());
                //check 該時間有冇人book左
                if (
                    moment(date.format()).isSame(eventArray[i].start.format()) ||
                    moment(date.format()).isBetween(
                        eventArray[i].start.format(),
                        eventArray[i].end.format()
                    )
                ) {
                    console.log("呢個時間已經有人book左啦, 請選第二個時間啦");
                    alert("呢個時間已經有人book左啦, 請選第二個時間啦");
                    hasEvent = true;
                    break; //跳出去for loop
                }
            }
            if (hasEvent == false) {
                console.log("呢個時間可以book");
                if ($("#user_id").val() === undefined) {
                    alert("Please login first");
                } else {
                    var confirmBox = confirm(
                        "Room : " +
                        $("#room_name").val() +
                        "時間 : " +
                        date.format("llll") +
                        " - " +
                        moment(date)
                            .add(1, "hours")
                            .format("llll") +
                        "\n" +
                        "確定要book嗎?"
                    );
                    if (confirmBox == true) {
                        $.ajax({
                            type: "POST",
                            url: window.location.origin + "/bookRoom",
                            // dataType: "json",
                            data: {
                                user_id: $("#user_id").val(),
                                room_id: $("#room_id").val(),
                                start: JSON.stringify(date.format()), //因為要上server 所以要咁 (記得decode)
                                end: JSON.stringify(
                                    moment(date.format())
                                        .add(1, "hours")
                                        .format()
                                )
                            },
                            success: function (data) {
                                // console("data: " + data);
                                alert("成功");
                                $("#calendar").fullCalendar("refetchEvents"); //更新timeline 重新load一次
                            },
                            error: function (jqXHR) {
                                alert("發生錯誤: " + jqXHR.status);
                            }
                        });
                    }
                }
            }
        },
        schedulerLicenseKey: "CC-Attribution-NonCommercial-NoDerivatives",
        resourceRender: function (resourceObj, labelTds, bodyTds) {
            labelTds.on("click", function () {
                //click list左邊個room name
                console.log(resourceObj.id);
            });
        },
        eventResize: function (event, delta, revertFunc) {
            if (moment(event.start.format()).isBefore()) {
                alert('不能預約已過去的時間');
                revertFunc();
                return;
            }
            console.log(event.id);
            console.log(event.start.format());

            console.log(event.end.format());
            // alert(event.title + " end is now " + event.end.format());

            if (!confirm("Room : " +
                $("#room_name").val() +
                "時間 : " +
                event.start.format("llll") +
                " - " +
                event.end.format("llll") +
                "\n" +
                "確定修改booking時間嗎?")) {
                revertFunc();
            } else {
                $.ajax({
                    type: "POST",
                    url: window.location.origin + "/updateBookingTime",
                    // dataType: "json",
                    data: {
                        booking_id: event.id,
                        user_id: $("#user_id").val(),
                        start: JSON.stringify(event.start.format()), //因為要上server 所以要咁 (記得decode)
                        end: JSON.stringify(event.end.format())
                    },
                    success: function (data) {
                        // console("data: " + data);
                        alert("成功");
                        $("#calendar").fullCalendar("refetchEvents"); //更新timeline 重新load一次
                    },
                    error: function (jqXHR) {
                        alert("發生錯誤: " + jqXHR.status);
                    }
                });
            }
        }
    });
});
