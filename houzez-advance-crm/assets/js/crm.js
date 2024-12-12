jQuery(document).ready(function ($) {
  // Handle "View Details" button click
  $(".view-details").on("click", function () {
    const leadId = $(this).data("id");

    $.post(
      houzezCRM.ajaxurl,
      { action: "get_lead_details", lead_id: leadId },
      function (response) {
        if (response.success) {
          const data = response.data;
          $("#leadName").text(data.name);
          $("#leadEmail").text(data.email);
          $("#leadPhone").text(data.phone);
          $("#leadComments").html("");

          data.comments.forEach((comment) => {
            $("#leadComments").append(
              `<li class="list-group-item">${comment.comment}</li>`
            );
          });

          $("#leadDetailsModal").modal("show");
        }
      }
    );
  });

  // Handle comment submission
  $("#addCommentForm").on("submit", function (e) {
    e.preventDefault();
    const leadId = $(".view-details").data("id");
    const newComment = $("#newComment").val();

    $.post(
      houzezCRM.ajaxurl,
      { action: "add_comment", lead_id: leadId, comment: newComment },
      function (response) {
        if (response.success) {
          $("#leadComments").append(
            `<li class="list-group-item">${newComment}</li>`
          );
          $("#newComment").val("");
        }
      }
    );
  });
});
