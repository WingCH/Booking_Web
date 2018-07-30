window.deleteEvents = {
    'click #deleteButton': function(e, value, row, index) {
        console.log("hi");
        console.log(value);
        alert("hi");
    },
    'click .btn': function(e, value, row, index) {
        console.log("hi");
        console.log(value);
        alert("hi");
    }
};
function deleteButtonFormatter(value, row, index) {
    //html to js -> https://www.freeformatter.com/javascript-escape.html#ad-output
    return '<button type=\"button\" class=\"btn btn-danger\" id=\"deleteButton\">Delete<\/button>\r\n <\/div>';
}

 window.deleteEvents = {
     'click #deleteButton': function(e, value, row, index) {
         var url = "/deleteRoom";
         $.ajax({
             type: "POST",
             url: url,
             // dataType: "json",
             data: {
                 room_id: row.id
             },
             success: function(data) {
                alert("delete Room(id: "+row.id+") success ");
                 $('#roomTable').bootstrapTable('refresh');
             },
             error: function(jqXHR) {
                 alert("發生錯誤: " + jqXHR.status);
             }
         });
     }
 };