
var categoriesHeight = $("#content-categories").height();

function showForm() {
  $("#content-categories").animate({
    height: 0
  });
}

function showCategories() {
  $('.library-pane').addClass('d-none');
  $("#content-categories").animate({
    height: categoriesHeight
  });
}

$('.nav-link').on('click', function() {
  // made visible the corresponding options container form
  var optionsContainer = $(this).attr('data');
  $('#' + optionsContainer).removeClass('d-none');
  showForm();
});

$('.back-categories-button').on('click', function() {
  showCategories();
});

$('#loadContentFromLibrary').on('hidden.bs.modal', function () {
  showCategories();
});

$('#addSudokusButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.SUDOKUS') }}");

  loadContentFromLibrary();
});

$('#addAkarisButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.AKARIS') }}");

  loadContentFromLibrary();
});

$('#addDominosButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.DOMINOS') }}");

  loadContentFromLibrary();
});

$('#addFillominosButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.FILLOMINOS') }}");

  loadContentFromLibrary();
});

$('#addFutoshikisButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.FUTOSHIKIS') }}");

  loadContentFromLibrary();
});

$('#addSikakusButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.SIKAKUS') }}");

  loadContentFromLibrary();
});
