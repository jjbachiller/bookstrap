
var categoriesHeight = $("#content-categories").height();

function showCategories() {
  $('.item:not([data-parent=""])').addClass('d-none');
  $('.item[data-parent=""]').removeClass('d-none');
  $('#backBtn').addClass('d-none');
}

function showSubcategories(category) {
  $('.item[data-parent=""]').addClass('d-none');
  $('.item[data-parent="' + category + '"]').removeClass('d-none');
  $('#backBtn').removeClass('d-none');
}

function showForm(category) {
  $('#' + category + '_form').removeClass('d-none');
  $("#content-categories").animate({
    height: 0
  });
}

function hideForm() {
  $('.form_item').addClass('d-none');
  $("#content-categories").animate({
    height: categoriesHeight
  });
}

$('.showForm').on('click', function() {
   showForm($(this).data('current'));
});

$('.showSubcategories').on('click', function() {
  showSubcategories($(this).data('current'));
});

$('.backFromSubcategories').on('click', function() {
  showCategories();
});

$('.backFromForm').on('click', function() {
  hideForm();
});

$('.num_library_items').inputmask('numeric', { min:1, max:200 });

$('.slider_num_library_items').ionRangeSlider({
  min: 1,
  max: 200,
  from: 10,
  skin: "sharp",
  onChange: function(data) {
    $('.num_library_items').val(data.from);
  }
});

$('.num_library_items').on('change', function() {
  var numItemsRange = $(this).closest('.row').find('.slider_num_library_items').data("ionRangeSlider");
  numItemsRange.update({ from: $(this).val(), to: $(this).val() });
})


$('.addSelectedLibraryContent').on('click', function() {
  // Populate the hidden form with the selected values
  var form = $(this).closest('.form_item');
  var contentType = form.find('input.selected_content_type').val();
  $('#SelectedContentType').val(contentType);
  var difficulty = form.find('select.dificulty_select').val();
  $('#SelectedDifficulty').val(difficulty);
  var amount = form.find('input.slider_num_library_items').val();
  $('#SelectedAmount').val(amount);
  var hasSolutions = form.find('input.content_type_has_solutions').val();
  $('#SelectedHasSolutions').val(hasSolutions);

  loadContentFromLibrary();
});
