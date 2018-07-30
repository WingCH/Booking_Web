function dateFormatter(value, row, index) {
  //呢度value系用start 目的系拎start個月份日期
  var date = moment(value, "YYYY-MM-DD HH:mm:ss");
  //日曆時間
  //http://momentjs.cn/docs/#/displaying/calendar-time/
  return date.calendar(null, {
    sameDay: "DD/MM/YYYY",
    nextDay: "DD/MM/YYYY",
    nextWeek: "DD/MM/YYYY",
    lastDay: "DD/MM/YYYY",
    lastWeek: "DD/MM/YYYY",
    sameElse: "DD/MM/YYYY"
  });
}

function addressFormatter(value, row, index) {
  var icon = '<i aria-hidden="true" class="fa fa-map-marker"></i>';
  return icon + " " + value;
}

function startFormatter(value, row, index) {
  //呢度value系用start 目的系拎start個月份日期
  var date = moment(value, "YYYY-MM-DD HH:mm:ss");
  //日曆時間
  //http://momentjs.cn/docs/#/displaying/calendar-time/
  return date.calendar(null, {
    sameDay: "hh:mm",
    nextDay: "hh:mm",
    nextWeek: "hh:mm",
    lastDay: "hh:mm",
    lastWeek: "hh:mm",
    sameElse: "hh:mm"
  });
}

function endFormatter(value, row, index) {
  //呢度value系用start 目的系拎start個月份日期
  var date = moment(value, "YYYY-MM-DD HH:mm:ss");
  //日曆時間
  //http://momentjs.cn/docs/#/displaying/calendar-time/
  return date.calendar(null, {
    sameDay: "hh:mm",
    nextDay: "hh:mm",
    nextWeek: "hh:mm",
    lastDay: "hh:mm",
    lastWeek: "hh:mm",
    sameElse: "hh:mm"
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
  return ['<span class="label ' + label_type + '">', value, "</span>"].join("");
}

function buttonFormatter(value, row, index) {
  var startTime = moment(row.start);
  var now = moment();
  //如果booking未到時間個陣可以取消
  if (row.status == "Ready") {
    if (!startTime.isBefore(now)) {
      console.log("index : ", index);
      //http://www.booking.wingpage.net/history/changeStatus/75/Cancel
      // return '<a href="' + location.href + "/changeStatus/" + value + "/Cancel" + '" class="btn btn-danger" role="button">' + "Cancel" + '</a>';
      // return '<button class="btn btn-danger" id="cancelButton" type="button">Cancel</Button>';
      return '<div class="btn-group" role="group"> <button type="button" class="btn btn-primary" id="qrCodeButton">QR Code</button> <button class="btn btn-danger" id="cancelButton" type="button">Cancel</Button> </div>';
    }
  }
}

$hasQR = false;
window.cancelEvents = {
  "click #cancelButton": function(e, value, row, index) {
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
        $("#historyTable").bootstrapTable("updateRow", {
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

  "click #qrCodeButton": function(e, value, row, index) {
    if ($hasQR) {
      $("#imagemodal").modal("show");
    } else {
      var el = kjua({
        render: "image",
        text: row.id.toString()
      });
      document.querySelector("#qrCode").appendChild(el);
      $("#imagemodal").modal("show");
      $hasQR = true;
    }
  }
};
