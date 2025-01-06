jQuery(document).ready(function () {
  // toggle panel with .sel__panel_list
  jQuery(
    ".sel__label_panel, .sel__panel_list .backdrop, .sel__panel_list .icon-close-blue, .sel__panel_list .icon-close-blue"
  ).click(function () {
    var select = jQuery(this).closest(".sel__group_select");
    select.find(".sel__label_panel").toggleClass("is-open");
    select.find(".sel__panel_list").toggle();
  });
  // select_radio on page load
  jQuery('.sel__group_select input[type="radio"]:checked').each(function () {
    sel__select_radio(this);
  });
  jQuery('.sel__group_select input[type="checkbox"]:checked').each(function () {
    sel__select_check(this);
  });
  // count_filter on page load
  count_filter();
  jQuery(
    '#houzez_advanced_search-2 input[type="text"].form-control, #houzez_advanced_search-2 select.sel_picker, #houzez_advanced_search-2 input.radio-style'
  ).change(count_filter);
  // fixed position filter
  if (jQuery(window).width() < 980) {
    var filtr = jQuery("#sidebar>#houzez_advanced_search-2");
    filtr.addClass("fixed");
    filtr.prepend(
      '<span class="icon-close-blue" onClick="toggleFilter();"></span>'
    );
    jQuery(
      '<div class="btn_filter" onClick="toggleFilter();"><span class="wicons2-search-circled"></span> Zoeken</div><div class="backdrop" onClick="toggleFilter();"></div>'
    ).insertBefore(filtr);
  }
});
function toggleFilter() {
  jQuery("#sidebar>#houzez_advanced_search-2").toggle();
  jQuery("#sidebar>.backdrop").toggle();
}
// click on select radiobut
function sel__select_radio(input) {
  var select = jQuery(input).closest(".sel__group_select");
  select
    .find(".sel__selected_options")
    .html("")
    .append(
      '<div data-name="' +
        input.name +
        '" onclick="sel__unselect_radio(this)"><span class="icon-close-blue"></span>' +
        jQuery(input).next("label").text() +
        "</div>"
    );
  if (jQuery(window).width() < 980) {
    jQuery(input).closest(".sel__group_select").find(".backdrop").click();
  }
}
// click on select checkbut
function sel__select_check(input) {
  var select = jQuery(input).closest(".sel__group_select");
  if (!jQuery(input).is(":checked")) {
    var selected = select.find(
      'div[data-name="' + input.name + '"][data-value="' + input.value + '"]'
    );
    sel__unselect_check(selected);
    return;
  }
  select
    .find(".sel__selected_options")
    .append(
      '<div data-name="' +
        input.name +
        '" data-value="' +
        input.value +
        '" onclick="sel__unselect_check(this)"><span class="icon-close-blue"></span>' +
        jQuery(input).next("label").text() +
        "</div>"
    );
  //if( jQuery(window).width()<980 ){
  //	jQuery(input).closest('.sel__group_select').find('.backdrop').click();
  //}
}
// click on unselect radiobut
function sel__unselect_radio(div_selected) {
  var div_selected = jQuery(div_selected);
  jQuery(
    'input[value=""][name="' + div_selected.attr("data-name") + '"]'
  ).click();
  div_selected.remove();
  count_filter();
}
// click on unselect checkbut
function sel__unselect_check(div_selected) {
  var div_selected = jQuery(div_selected);
  jQuery(
    'input[value="' +
      div_selected.attr("data-value") +
      '"][name="' +
      div_selected.attr("data-name") +
      '"]'
  )
    .prop("checked", false)
    .change(); //.click();
  div_selected.remove();
  count_filter();
}
// count_filter
function count_filter() {
  var count_filter =
    jQuery(
      '#houzez_advanced_search-2 input[type="radio"]:checked, #houzez_advanced_search-2 input[type="checkbox"]:checked'
    ).filter(function () {
      return this.value != "";
    }).length +
    jQuery(
      '#houzez_advanced_search-2 input[type="text"].form-control, #houzez_advanced_search-2 select'
    ).filter(function () {
      return this.value != "";
    }).length;
  jQuery("#houzez_advanced_search-2 .count_filter>span").html(count_filter);
}

(function ($) {
  $(document).ready(function () {
    // Initialize range slider
    $("#area-range").slider({
      range: true,
      min: 0, // Minimum range value for area
      max: 10000, // Maximum range value for area
      step: 10, // Step value for the slider
      values: [0, 10000], // Initial values
      slide: function (event, ui) {
        // Update the visible range values
        $(".min-area-range").html(ui.values[0] + " m<sup>2</sup>");
        $(".max-area-range").html(ui.values[1] + " m<sup>2</sup>");
        // Update the hidden inputs
        $("#min-area").val(ui.values[0]);
        $("#max-area").val(ui.values[1]);
      },
    });

    // Set initial values for display
    $(".min-area-range").html(
      $("#area-range").slider("values", 0) + " m<sup>2</sup>"
    );
    $(".max-area-range").html(
      $("#area-range").slider("values", 1) + " m<sup>2</sup>"
    );
  });
})(jQuery);
