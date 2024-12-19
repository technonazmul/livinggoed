jQuery(document).ready(function ($) {
  $("#calendar").fullCalendar({
    events: function (start, end, timezone, callback) {
      $.ajax({
        url: ajaxParams.ajaxurl,
        type: "POST",
        dataType: "json",
        data: {
          action: "fetch_tasks",
          security: ajaxParams.security,
        },
        success: function (data) {
          callback(data);
        },
      });
    },
    eventClick: function (event) {
      // Add logic to handle task click
    },
  });
});
