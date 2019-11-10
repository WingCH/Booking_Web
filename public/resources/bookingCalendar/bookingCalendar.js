$(function () {
    $("#calendar").fullCalendar({
        editable: false, // enable draggable events
        eventStartEditable: false, // 5準拖拉
        height: "auto",
        scrollTime: "09:00",
        // 早上9點 - 晚上9點
        minTime: "09:00:00",
        maxTime: "21:00:00",
        //每段時間一個鐘
        //每段時間一個鐘slotDuration: "01:00:00",
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
        resources: window.location.origin + "/getAllRoom",
        //Booking 資料
        events: function (start, end, timezone, callback) {
            jQuery.ajax({
                url: window.location.origin + "/getAllBooking",
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
                        var startTime = moment(value.start);
                        var now = moment();
                        var status = value.status;
                        var color;
                        if (status == "Ready") {
                            //如果時間比現在前 -> 之前
                            if (startTime.isBefore(now)) {
                                status = "Absence";
                            }
                        }
                        switch (status) {
                            case "Absence":
                                color = "red";
                                break;
                            case "Ready":
                                color = "green";
                                break;
                            case "Attend":
                                color = "blue";
                                break;
                            case "Cancel":
                                color = "gray";
                                break;
                        }
                        events.push({
                            id: value.id,
                            resourceId: value.room_id,
                            start: value.start,
                            end: value.end,
                            title: status,
                            description: value.user,
                            color: color
                        });
                    });
                    // console.log(events);
                    callback(events);
                }
            });
        },
        //Click
        eventClick: function (calEvent, jsEvent, view) {
            // alert('Event: ' + calEvent.title);
            $room = $("#calendar").fullCalendar("getResourceById", 1);

            console.log("event start: " + calEvent.start.format()); //iso 8601 -> string
            console.log("event description: " + calEvent.description); //iso 8601 -> string

            alert(
                "Room: " +
                $room.title +
                "\nUser email: " +
                calEvent.description.email +
                "\nStatus: " +
                calEvent.title
            );
        },
        dayClick: function (date, jsEvent, view, resourceObj) {
        },
        schedulerLicenseKey: "CC-Attribution-NonCommercial-NoDerivatives",
        resourceRender: function (resourceObj, labelTds, bodyTds) {
            labelTds.on("click", function () {
                //click list左邊個room name
                console.log(resourceObj.id);
            });
        }
    });
});
