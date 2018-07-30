 function dateFormatter(value, row, index) {
     //呢度value系用start 目的系拎start個月份日期
     var date = moment(value, "YYYY-MM-DD HH:mm:ss");
     //日曆時間 
     //http://momentjs.cn/docs/#/displaying/calendar-time/
     return date.calendar(null, {
         sameDay: 'DD/MM/YYYY',
         nextDay: 'DD/MM/YYYY',
         nextWeek: 'DD/MM/YYYY',
         lastDay: 'DD/MM/YYYY',
         lastWeek: 'DD/MM/YYYY',
         sameElse: 'DD/MM/YYYY'
     });
 }


 function startFormatter(value, row, index) {
     //呢度value系用start 目的系拎start個月份日期
     var date = moment(value, "YYYY-MM-DD HH:mm:ss");
     //日曆時間 
     //http://momentjs.cn/docs/#/displaying/calendar-time/
     return date.calendar(null, {
         sameDay: 'hh:mm',
         nextDay: 'hh:mm',
         nextWeek: 'hh:mm',
         lastDay: 'hh:mm',
         lastWeek: 'hh:mm',
         sameElse: 'hh:mm'
     });
 }

 function endFormatter(value, row, index) {
     //呢度value系用start 目的系拎start個月份日期
     var date = moment(value, "YYYY-MM-DD HH:mm:ss");
     //日曆時間 
     //http://momentjs.cn/docs/#/displaying/calendar-time/
     return date.calendar(null, {
         sameDay: 'hh:mm',
         nextDay: 'hh:mm',
         nextWeek: 'hh:mm',
         lastDay: 'hh:mm',
         lastWeek: 'hh:mm',
         sameElse: 'hh:mm'
     });
 }

 function statusFormatter(value, row, index) {
     //https://github.com/wenzhixin/bootstrap-table/issues/324
     var label_type;
     var startTime = moment(row.start);
     var now = moment();
     switch (value) {
         case "Ready":
             //如果時間比現在前 -> 之前
             if (startTime.isBefore(now)) {
                 //缺席
                 value = "Absence";
                 label_type = "label-danger";
             } else {
                 label_type = "label-info";
             }
             break;
         case "Attend":
             label_type = "label-success";
             break;
         case "Cancel":
             label_type = "label-default";
             break;
     }
     return ['<span class="label ' + label_type + '">',
         value, '</span>'
     ].join('');
 }

 function cancelButtonFormatter(value, row, index) {
     var startTime = moment(row.start);
     var now = moment();
     //如果booking未到時間個陣可以取消
     if (row.status == "Ready") {
         if (!startTime.isBefore(now)) {
             console.log("index : ", index);
             //http://www.booking.wingpage.net/history/changeStatus/75/Cancel
             //html to js -> https://www.freeformatter.com/javascript-escape.html#ad-output
             return '<div class=\"btn-group\">\r\n <button type=\"button\" class=\"btn btn-success\" id=\"attendButton\">Attend<\/button>\r\n <button type=\"button\" class=\"btn btn-danger\" id=\"cancelButton\">Cancel<\/button>\r\n <\/div>';            
         }
     }
 }
 
 window.cancelEvents = {
     'click #cancelButton': function(e, value, row, index) {
         var url = "/updateStatus";
         $.ajax({
             type: "POST",
             url: url,
             // dataType: "json",
             data: {
                 booking_id: value,
                 status: "Cancel"
             },
             success: function(data) {
                 $('#historyTable').bootstrapTable('updateRow', {
                     index: index,
                     row: {
                         status: data
                     }
                 });
             },
             error: function(jqXHR) {
                 alert("發生錯誤: " + jqXHR.status);
             }
         });
     },
     'click #attendButton': function(e, value, row, index) {
         var url = "/updateStatus";
         $.ajax({
             type: "POST",
             url: url,
             // dataType: "json",
             data: {
                 booking_id: value,
                 status: "Attend"
             },
             success: function(data) {
                 $('#historyTable').bootstrapTable('updateRow', {
                     index: index,
                     row: {
                         status: data
                     }
                 });
             },
             error: function(jqXHR) {
                 alert("發生錯誤: " + jqXHR.status);
             }
         });
     }

 };