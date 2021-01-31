
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
