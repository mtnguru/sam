
function glossary_old_replace_handler(event) {
  // Disable superscript field if not selected.
  if ($("input[@name=glossary_old_replace]:checked").val() == 'superscript') {
    $("input[@name=glossary_old_superscript]").parents("div.glossary_old_superscript").show();
  }
  else {
    $("input[@name=glossary_old_superscript]").parents("div.glossary_old_superscript").hide();
  }

  // Disable icon URL field if not selected.
  var selected = $("input[@name=glossary_old_replace]:checked").val();
  if (selected == 'icon' || selected == 'iconterm') {
    $("input[@name=glossary_old_icon]").parents("div.glossary_old_icon").show();
  }
  else {
    $("input[@name=glossary_old_icon]").parents("div.glossary_old_icon").hide();;
  }
}

function glossary_old_link_related_handler(event) {
  // Disable one-way field if not selected.
  if ($("input[@name=glossary_old_link_related]:checked").val() == 1) {
    $("input[@name=glossary_old_link_related_how]").parents("div.glossary_old_link_related_how").show();
  }
  else {
    $("input[@name=glossary_old_link_related_how]").val(0);
    $("input[@name=glossary_old_link_related_how]").parents("div.glossary_old_link_related_how").hide();
  }
}

// Run the javascript on page load.
if (Drupal.jsEnabled) {
  $(document).ready(function () {
  // On page load, determine the current settings.
  glossary_old_replace_handler();
  glossary_old_link_related_handler();

  // Bind the functions to click events.
  $("input[@name=glossary_old_replace]").bind("click", glossary_old_replace_handler);
  $("input[@name=glossary_old_link_related]").bind("click", glossary_old_link_related_handler);
  });
}