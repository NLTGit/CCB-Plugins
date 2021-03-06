jQuery(document).on("click", ".btn-group-multi > .btn-multi", function(evt) {
    var tgt = jQuery(evt.target);
    tgt.hasClass("btn-group-multi") || (tgt = tgt.closest(".btn-group-multi")), tgt.toggleClass("active")
  }), jQuery(document).on("click", ".grid-item .grid-item-detail-tabs .btn.grid-item-detail-tab", function(event) {
    var btn = jQuery(event.target);
    btn.hasClass("btn") || (btn = btn.parent());
    var selector = btn.data("target"),
      item = btn.closest(".grid-item");
    item.find(".grid-item-detail.active").removeClass("active"), item.find(".grid-item-details").find(selector).addClass("active"), btn.siblings().removeClass("active"), btn.addClass("active")
  }), jQuery(document).on("click", ".gp-ui-card__tab", function(event) {
    var tab = jQuery(event.target);
    if (tab.hasClass("btn") || (tab = tab.parent()), !tab.hasClass("active")) {
      tab.siblings().removeClass("active"), tab.addClass("active");
      var pane = tab.closest(".gp-ui-card").find(tab.data("target"));
      pane.siblings().removeClass("active"), pane.addClass("active")
    }
  }),
  function(jQuery) {
    var REQUIRED_CLASS = "is-required",
      CHECKED_CLASS = "is-checked",
      FOCUS_CLASS = "is-focused",
      ERROR_CLASS = "has-error",
      EMPTY_CLASS = "is-empty",
      GROUP_SELECTOR = ".form-group.t-material",
      selector = GROUP_SELECTOR + " > .form-control, " + GROUP_SELECTOR + " > .input-group > .form-control, " + GROUP_SELECTOR + " > .input-group-slick > .form-control",
      switchSelector = GROUP_SELECTOR + ".switch .lever",
      requiredSelector = GROUP_SELECTOR + " .form-control[required]";
    jQuery(document).on("focus", selector, function(event) {
      var field = jQuery(event.target),
        group = field.closest(GROUP_SELECTOR);
      group.addClass(FOCUS_CLASS)
    }), jQuery(document).on("blur", selector, function(event) {
      var field = jQuery(event.target),
        group = field.closest(GROUP_SELECTOR);
      group.removeClass(FOCUS_CLASS)
    }), jQuery(document).on("change", selector, function(event) {
      var field = jQuery(event.target),
        group = field.closest(GROUP_SELECTOR);
      field.val().length ? (group.removeClass(EMPTY_CLASS), "undefined" != typeof field[0].checkValidity ? field[0].checkValidity() ? group.removeClass(ERROR_CLASS) : group.addClass(ERROR_CLASS) : group.removeClass(ERROR_CLASS)) : (group.addClass(EMPTY_CLASS), group.hasClass(REQUIRED_CLASS) && group.addClass(ERROR_CLASS))
    }), jQuery(document).on("click", switchSelector, function(event) {
      var field = jQuery(event.target),
        checkbox = field.siblings('[type="checkbox"]'),
        isChecked = checkbox.is(":checked"),
        group = field.closest(".switch");
      checkbox.prop("checked", !isChecked), isChecked ? group.removeClass(CHECKED_CLASS) : group.addClass(CHECKED_CLASS)
    }), jQuery(document).find(requiredSelector).each(function(index, input) {
      var jQueryinput = jQuery(input),
        group = jQueryinput.closest(GROUP_SELECTOR);
      group.addClass(REQUIRED_CLASS), jQueryinput.trigger("change")
    })
  }(jQuery);
