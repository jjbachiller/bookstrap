
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

$('#addGokigensButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.GOKIGENS') }}");

  loadContentFromLibrary();
});

$('#addKakurosButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.KAKUROS') }}");

  loadContentFromLibrary();
});

$('#addKendokusButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.KENDOKUS') }}");

  loadContentFromLibrary();
});

$('#addMinesweepersButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.MINESWEEPERS') }}");

  loadContentFromLibrary();
});

$('#addMurapekesButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.MURAPEKES') }}");

  loadContentFromLibrary();
});

$('#addRoundaboutsButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.ROUNDABOUTS') }}");

  loadContentFromLibrary();
});

$('#addSikakusButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.SIKAKUS') }}");

  loadContentFromLibrary();
});

$('#addSudokusButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.SUDOKUS') }}");

  loadContentFromLibrary();
});

$('#addTatamisButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.TATAMIS') }}");

  loadContentFromLibrary();
});

$('#addTentsButton').on('click', function() {
  $('#selectedContentType').val("{{ config('content-types.TENTS') }}");

  loadContentFromLibrary();
});
