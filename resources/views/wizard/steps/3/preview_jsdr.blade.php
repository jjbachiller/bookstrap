var firstLoad = true;

// Load Book content from server and generate book
function loadPreviewContent() {

  KTApp.blockPage({
    overlayColor: '#000',
    state: 'info',
    message: 'Loading preview content. Please wait...',
    opacity: 0.15,
  });

  $.ajax({
    type: "POST",
    url : "{{ route('preview.content') }}",
    success: function (data) {
      setTotalPages(data.total_pages);
      var current_page = current_page_blankpages_book = 1;

      // Delete old content
      $('#mybook').empty();

      // Create the content div.
      $('<div/>', {
        id: 'mybook-content',
        "class": 'b-load',
        width: '905px',
        height: '181px'
      }).appendTo('#mybook');

      // Delete old content from the blank pages book
      $('#mybook-blankpages').empty();

      // Create the content div for the blank pages book.
      $('<div/>', {
        id: 'mybook-blankpages-content',
        "class": 'b-load',
        width: '905px',
        height: '181px'
      }).appendTo('#mybook-blankpages');


      addCopyright();

      function addSectionContent(section, images, solutions = false) {
        var sectionStart = true;
        // if has a title, add title page
        var title = (solutions) ? section.solutions_title : section.title;
        if (title) {
          // Add a title page to the simple page book
          var page = getNewTitlePage(current_page, title);
          $('#mybook-content').append(page);
          current_page++;

          // Add a title page to the blank page book
          page = getNewTitlePage(current_page_blankpages_book, title)
          $('#mybook-blankpages-content').append(page);
          current_page_blankpages_book++;
          var blankpage = getNewTitlePage(current_page_blankpages_book, '');
          $('#mybook-blankpages-content').append(blankpage);
          current_page_blankpages_book++;

          sectionStart = false;
        }

        var imagesPerPage = (solutions) ? section.solutions_per_page : section.images_per_page;
        var currentPageImages = new Array();
        images.forEach(function(image, j) {
          // If we have collected the number of the images need on each page
          if (currentPageImages.length == imagesPerPage) {
            var pageOptions = {
              'pageNumber': current_page,
              'imagesPerPage': imagesPerPage,
              'images': currentPageImages,
              'header': (solutions) ? section.solutions_header : section.header,
              'imageNameAsTitle': (solutions) ? section.solutions_name_as_title : section.image_name_as_title,
              'sectionStart': sectionStart,
            };
            // Add a new Images page to the simple pages book
            var page = getNewImagePage(pageOptions);
            $('#mybook-content').append(page);
            current_page++;
            sectionStart = false;

            // And Add a new Images page to the Blank pages book
            pageOptions['pageNumber'] = current_page_blankpages_book;
            page = getNewImagePage(pageOptions);
            $('#mybook-blankpages-content').append(page);
            current_page_blankpages_book++;
            var blankpage = getNewTitlePage(current_page_blankpages_book, '');
            $('#mybook-blankpages-content').append(blankpage);
            current_page_blankpages_book++;

            // Reset the images per page array
            currentPageImages = new Array();
          }

          currentPageImages.push({'name': image.show_name, 'url': image.url});
        });

        // Just finished the loop, add a new page with the pending images
        if (currentPageImages.length > 0) {
          var pageOptions = {
            'pageNumber': current_page,
            'imagesPerPage': imagesPerPage,
            'images': currentPageImages,
            'header': (solutions) ? section.solutions_header : section.header,
            'imageNameAsTitle': (solutions) ? section.solutions_name_as_title : section.image_name_as_title,
            'sectionStart': sectionStart,
          };

          var page = getNewImagePage(pageOptions);
          $('#mybook-content').append(page);
          current_page++;
          sectionStart = false;

          // Blank pages
          pageOptions['pageNumber'] = current_page_blankpages_book;
          page = getNewImagePage(pageOptions);
          $('#mybook-blankpages-content').append(page);
          current_page_blankpages_book++;
          var blankpage = getNewTitlePage(current_page_blankpages_book, '');
          $('#mybook-blankpages-content').append(blankpage);
          current_page_blankpages_book++;
        }
      }

      var solutionsToTheEnd = [];
      // Add Sections to the book preview
      $.each(data.sections, function(i, section) {
        // var section = json.sections[section_index];
        addSectionContent(section, section.images);
        // Check if solutions go now or at the end
        if (section.solutions_to_the_end) {
          var sectionSolutions = {
            'section': section,
            'images': section.solutions
          };
          solutionsToTheEnd.push(sectionSolutions);
        } else {
          addSectionContent(section, section.solutions, true);
        }
      });

      // Add solutions marked to the end on each section, to the end of the book preview.
      solutionsToTheEnd.forEach(function(solution, i) {
        addSectionContent(solution.section, solution.images, true);
      });

      generateBook();
      var blank = $('#addBlankPages').is(":checked");
      generateBookSlider(blank);

      if (firstLoad) {
        // Only load the option for the saved book, the first time that
        // This step is shown on each edition.
        @isset($book)
          var editingBook = @json($book);
          loadEditingBookValues(editingBook);
        @endisset
        firstLoad = false;
      }
    }
  });
}

function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function addCopyright() {
  //First add the copyright page if it's selected:
  if ($('#addCopyright').is(':checked')) {
    var copyrightText = nl2br($('#copyright').val());
    var copyrightPage = $('#copyright-template').clone().html();
    copyrightPage = copyrightPage.replace('[COPYRIGHT]', copyrightText);
    $('#mybook-content').append(copyrightPage);
    // Add an aditional blank page after the copyright page.
    copyrightPage = $('#copyright-template').clone();
    copyrightPage.find('.copyright-text').remove();
    $('#mybook-content').append(copyrightPage);
  }
}

function getNewPageGenericContent(page, pageNumber) {
  page = page.replace(/\[PAGE_NUMBER\]/g, pageNumber);
  return page;
}

// Return a new page formated for the book.
function getNewImagePage(imagePageOptions) {
  var imageTemplate = $('#page-template').clone();
  //Remove the title section from the template
  imageTemplate.find('.title-content').remove();
  if (imagePageOptions['header']) {
    imageTemplate.find('.page-header').toggleClass('invisible');
    imageTemplate.find('.header-text').text(imagePageOptions['header']);
  }

  if (imagePageOptions['sectionStart']) {
    // If it is the first page of a section we add the section-start class
    imageTemplate.find('.page').addClass("section-start");
  }

  var numImages = imagePageOptions['imagesPerPage'];
  var imagesLayout = $('.images-layout').find('.images-per-page-' + numImages).clone();
  imagePageOptions['images'].forEach(function(image, i) {
    var imageNumber = i + 1;
    // Load or remove the title for each image
    var imgTitle = imagesLayout.find('.title-' + imageNumber);
    if (!imagePageOptions['imageNameAsTitle']) {
      imgTitle.html('');
    } else {
      // Remove path & extension from image route.
      imgTitle.html(image.name);
    }

    imagesLayout.find('.image-' + imageNumber).attr('data-src', image.url);
  });

  // Remove the empty image container for the layout if correspond.
  if (numImages == 7) {
    imagesLayout.find('.image-8').remove();
  }

  if (numImages > 8 && numImages < 12) {
    for (i = numImages+1; i <= 12; i++) {
      imagesLayout.find('.image-' + i).remove();
    }
  }

  // Load the images layout on the images container section in the template.
  imageTemplate.find('.images-content').html(imagesLayout);

  var page = imageTemplate.html();

  var footer = $('#footer').val();
  page = page.replace('[FOOTER]', imagePageOptions['footer']);

  return getNewPageGenericContent(page, imagePageOptions['pageNumber'], false);
}

function getNewTitlePage(pageNumber, title) {
  var titleTemplate = $('#page-template').clone();
  //Remove the image section from the template
  titleTemplate.find('.img-content').remove();
  titleTemplate.find('.img-title').remove();
  titleTemplate.find('.page-header').removeClass('page-header').addClass('page-hidden-meta');
  titleTemplate.find('.page-footer').removeClass('page-footer').addClass('page-hidden-meta');

  // If it is a real title page it is always the beginning of a section
  if (title != '') {
    titleTemplate.find('.page').addClass("section-start");
  }

  var page = titleTemplate.html();
  page = page.replace('[TITLE]', title);


  return getNewPageGenericContent(page, pageNumber);
}

function generateBook() {
  var $bttn_next		= $('#next_page_button');
  var $bttn_prev		= $('#prev_page_button');
  var bookletWidth = 800;
  var bookletHeight = 500;

  $('#loading').hide();

  $bttn_next.show();
  $bttn_prev.show();

  if (window.screen.availWidth < 1000) {
    if (window.screen.availWidth >= 700) {
      bookletWidth = 598;
      bookletHeight = 360;
    } else {
      bookletWidth = 250;
      bookletHeight = 155;
    }
  }

  var bookletOptions = {
    name:               null,                            // name of the booklet to display in the document title bar
    width:              bookletWidth,                             // container width
    height:             bookletHeight,                             // container height
    speed:              0,                             // speed of the transition between pages
    direction:          'LTR',                           // direction of the overall content organization, default LTR, left to right, can be RTL for languages which read right to left
    startingPage:       0,                               // index of the first page to be displayed
    easing:             'easeInOutQuad',                 // easing method for complete transition
    easeIn:             'easeInQuad',                    // easing method for first half of transition
    easeOut:            'easeOutQuad',                   // easing method for second half of transition

    closed:             true,                           // start with the book "closed", will add empty pages to beginning and end of book
    closedFrontTitle:   null,                            // used with "closed", "menu" and "pageSelector", determines title of blank starting page
    closedFrontChapter: null,                            // used with "closed", "menu" and "chapterSelector", determines chapter name of blank starting page
    closedBackTitle:    null,                            // used with "closed", "menu" and "pageSelector", determines chapter name of blank ending page
    closedBackChapter:  null,                            // used with "closed", "menu" and "chapterSelector", determines chapter name of blank ending page
    covers:             false,                           // used with  "closed", makes first and last pages into covers, without page numbers (if enabled)

    pagePadding:        10,                              // padding for each page wrapper
    pageNumbers:        false,                            // display page numbers on each page

    hovers:             false,                            // enables preview pageturn hover animation, shows a small preview of previous or next page on hover
    overlays:           false,                            // enables navigation using a page sized overlay, when enabled links inside the content will not be clickable
    tabs:               false,                           // adds tabs along the top of the pages
    tabWidth:           60,                              // set the width of the tabs
    tabHeight:          20,                              // set the height of the tabs
    arrows:             false,                           // adds arrows overlayed over the book edges
    cursor:             'pointer',                       // cursor css setting for side bar areas

    hash:               false,                           // enables navigation using a hash string, ex: #/page/1 for page 1, will affect all booklets with 'hash' enabled
    keyboard:           true,                            // enables navigation with arrow keys (left: previous, right: next)
    next:               $bttn_next,          			// selector for element to use as click trigger for next page
    prev:               $bttn_prev,          			// selector for element to use as click trigger for previous page

    menu:               null,                            // selector for element to use as the menu area, required for 'pageSelector'
    pageSelector:       true,                           // enables navigation with a dropdown menu of pages, requires 'menu'
    chapterSelector:    true,                           // enables navigation with a dropdown menu of chapters, determined by the "rel" attribute, requires 'menu'

    shadows:            true,                            // display shadows on page animations
    shadowTopFwdWidth:  166,                             // shadow width for top forward anim
    shadowTopBackWidth: 166,                             // shadow width for top back anim
    shadowBtmWidth:     50,                              // shadow width for bottom shadow

    before:             function(){},                    // callback invoked before each page turn animation
    after:              function(){},                   // callback invoked after each page turn animation
    change: function(event, page) {
      // On page change, lazy loading the images on the new page.
      loadPage(page.index);
    }
  };

  if (!firstLoad) {
    // If is not the first time that previwe is show, destroy the old instances.
    $('#mybook').booklet("destroy")
    $('#mybook-blankpages').booklet("destroy")
  }
  $('#mybook').booklet(bookletOptions);
  $('#mybook-blankpages').booklet(bookletOptions);

  if ($('#addBlankPages').is(":checked")) {
    $('#mybook-blankpages').show();
  } else {
    $('#mybook').show();
  }

  // Lazy loading first image
  loadPage(0);

  // Show the slider for pagination
  $('#mybook-slider').removeClass('d-none');

}

function loadPage(index) {
  var totalPages = {{ config('bookstrap-constants.NUM_IMAGES_PRELOADED') }} * 2 + 1;
  var start = index - {{ config('bookstrap-constants.NUM_IMAGES_PRELOADED') }};
  var end = totalPages + index;
  for (var i = start; i <= end; i++) {
    if (i >= 0) {
      var image = $("div.b-page-" + i).find('img.lazy');
      // Only load image if it has not been loaded yet.
      if (image.parent().hasClass('spinner')) {
        image.lazy({
          // Remove the spinner when the image has been loaded
          afterLoad: function(img) {
            img.parent().removeClass('spinner spinner-center');
          }

        });
      }
    }
  }
}

// Regenerate book on device rotation
var supportsOrientationChange = "onorientationchange" in window,
    orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";

window.addEventListener(orientationEvent, function() {
  generateBook();
}, false);


function setTotalPages(totalPages) {
  @php
    $subscription = Auth::user()->subscription();
  @endphp
  $('#current-book-pages').html(totalPages);
  if (totalPages > {{ $subscription['max_book_pages'] }} ) {
    $('#current-book-pages').addClass('text-danger');
    $('#max-pages-error').removeClass('d-none');
  } else {
    $('#current-book-pages').removeClass('text-danger');
    $('#max-pages-error').addClass('d-none');    
  }
}

// Image position options management
function imagePosition(position) {
  var justify = 'justify-content-center';

  switch (position) {
    case '2':
      justify = "justify-content-start";
      break;
    case '8':
      justify = "justify-content-end";
      break;
  }
  $('.img-container').removeClass('justify-content-start justify-content-center justify-content-end');
  $('.img-container').addClass(justify);
};

$('#image-position').on('click', function() {
  var position = $(this).find('.active').find('input').val();
  imagePosition(position);
  // $('.image-position .btn').removeClass('btn-primary').addClass('btn-light');
  // $(this).removeClass('btn-light').addClass('btn-primary');
});
// End image position options management

// End header options management

// Footer options management
$('#addFooter').on('change', function() {
  $('#footerOptions').toggleClass('d-none');
  $('.page-footer').toggleClass('invisible');
  $('.footer-text').text($('#footer').val());
});

$('#footer').keyup(function() {
  $('.footer-text').text($(this).val());
});
// End footer options management

// Page number optionsmanagement
$('#addPageNumber').on('change', function() {
  $('#pageNumberOptions').toggleClass('d-none');
  if ($(this).is(':checked')) {
    var pageNumberLocation = $('#pageNumberOptions label.active input').val();
    showPageNumber(pageNumberLocation);
  } else {
    $('.h-page-number').addClass('invisible');
    $('.f-page-number').addClass('invisible');
  }
});

$('#pageNumberOptions .btn').on('click', function() {
  var pageNumberLocation = $(this).find('input').val();
  showPageNumber(pageNumberLocation);
});

function showPageNumber(location) {
  switch (location) {
    case '1':
      $('.h-page-number').removeClass('invisible');
      $('.f-page-number').addClass('invisible');
      break;
    case '2':
      $('.h-page-number').addClass('invisible');
      $('.f-page-number').removeClass('invisible');
      break;
    case '3':
      $('.h-page-number').removeClass('invisible');
      $('.f-page-number').removeClass('invisible');
      break;
  }
}
// End page number options management

// Blank pages options management
$('#addBlankPages').on('change', function() {
  if ($(this).is(':checked')) {
    // addBlankPages();
    $('#mybook').hide();
    $('#mybook-blankpages').booklet("gotopage", 'start');
    $('#mybook-blankpages').show();
    generateBookSlider(true);
    bookPages = $('#mybook-blankpages').find('div.page');
  } else {
    // removeBlankPages();
    $('#mybook').booklet("gotopage", 'start');
    $('#mybook').show();
    $('#mybook-blankpages').hide();
    generateBookSlider();
    bookPages = $('#mybook').find('div.page');
  }
  setTotalPages(bookPages.length);
});
//End Blank pages options management

// Pagination Slider
$('#prev_page_button').on('click', function() {
  var currentPage = $("#bookPagination").bootstrapSlider('getValue');
  if (currentPage == 0) return;
  if (currentPage % 2 == 1) {
    //Si estaba en la última página y era impar, lo pasamos a la anterior.
    currentPage = currentPage - 1;
  } else {
    currentPage = currentPage - 2;
  }
  $("#bookPagination").bootstrapSlider('setValue', currentPage);
});

$('#next_page_button').on('click', function() {
  var currentPage = $("#bookPagination").bootstrapSlider('getValue');
  var maxPages =  $("#bookPagination").bootstrapSlider('getAttribute', 'max');
  if (currentPage == maxPages) return;
  currentPage = currentPage + 2;
  $("#bookPagination").bootstrapSlider('setValue', currentPage);
});

function generateBookSlider(blank = false) {

  var bookPages = null;
  if (blank) {
    bookPages = $('#mybook-blankpages').find('div.page');
  } else {
    bookPages = $('#mybook').find('div.page');
  }

  var totalPages = bookPages.length;
  var sectionsPage = [];

  // Set the total pages in the input hidden to send it to the controller on the document Generation
  $("#total-pages").val(totalPages);

  bookPages.each(function(index) {
    if ($(this).hasClass('section-start')) {
      sectionsPage.push(index);
    }
  });
  // The percentage in the bar is the totalPages/100 factor.
  var percentage = 100 / totalPages;
  var ticksPositions = [];
  var ticksLabels = [];
  sectionsPage.forEach(function(page, index, sectionsPage) {
    if (index == 0) {
      ticksPositions.push(0);
      ticksLabels.push('B');
    } else {
      //Si es impar, cambiamos a la página anterior
      if (sectionsPage[index] % 2 == 1) {
        sectionsPage[index]++;
      }
      ticksPositions.push(Math.ceil(sectionsPage[index] * percentage));
      ticksLabels.push('S' + (index + 1));
    }
  });

  // Add the final book tick:
  var endPage = (totalPages % 2 == 1) ? totalPages - 1 : totalPages;
  sectionsPage.push(endPage);
  ticksPositions.push(100);
  ticksLabels.push(endPage.toString());

  if ($("#bookPagination").hasClass("Initialized")) {
    // If it has been initializad, destroy the old version
    $("#bookPagination").bootstrapSlider('destroy');
  }

  // And create the new pagination slider
  $("#bookPagination").bootstrapSlider({
    ticks: sectionsPage,
    ticks_positions: ticksPositions,
    ticks_labels: ticksLabels,
    formatter: function(value) {
      if (value == 0) return 'Book Start';
      return 'pags: ' + value + ' & ' + (value+1);
    },
    ticks_tooltip: true,
    value: 0,
    min: 0,
    max: totalPages,
    step: 2
  });

  $("#bookPagination").on("slideStop", function(e) {
    if (blank) {
      $('#mybook-blankpages').booklet("gotopage", $(this).val());
    } else {
      $('#mybook').booklet("gotopage", $(this).val());
    }
  });

  $('#bookPagination').addClass('Initialized');

  // When the preview book is generated, unlock the interface.
  KTApp.unblockPage('#smartwizard');
}

function initSizeSlider() {
  // init slider
  var verticalSlider = document.getElementById('size-slider');
  noUiSlider.create(verticalSlider, {
    start: 100,
    // orientation: 'vertical',
    range: {
      'min': 0,
      'max': 100
    },
    format: wNumb({
        decimals: 0,
        suffix: '%'
    })
  });

  // init slider input
  var sliderInput = document.getElementById('image-size');

  verticalSlider.noUiSlider.on('update', function( values, handle ) {
    sliderInput.value = values[handle];
    resizePreviewImage(sliderInput.value);
  });

  sliderInput.addEventListener('change', function(){
    verticalSlider.noUiSlider.set(this.value);
    resizePreviewImage(this.value);
  });
}

function resizePreviewImage(percentage)
{
  $('.images-content').find('img').css({'max-width': percentage, 'max-height' : percentage});
}

// $('#image-size').on('change', function() {
//   alert("El valor ha cambiado " + this.val());
//   // Update the images on the preview
//   // $('.images-content').find('img').attr('style', this.val() + ' !important');
//
// });

initSizeSlider();

function loadEditingBookValues(book) {
  // $('#image-size').val(book['img_scale']);
  var verticalSlider = document.getElementById('size-slider');
  verticalSlider.noUiSlider.set(book['img_scale'] + '%');
  $('#image-position .btn input[value=' + book['img_position'] + ']').click();
  imagePosition(book['img_position'].toString());
  if (book['footer_details'] != '') {
    $('#addFooter').prop('checked', true).change();
    $('#footer').val(book['footer_details']);
    $('.footer-text').text(book['footer_details']);
  }
  if (book['page_number_position'] != 0) {
    $('#addPageNumber').prop('checked', true).change();
    $('#pageNumberOptions #option' + book['page_number_position']).click();
  }
  if (book['add_blank_pages'] != 0) {
    $('#addBlankPages').prop('checked', true).change();
  }
  if (book['full_bleed'] != 0) {
    $('#fullBleed').prop('checked', true).change();
  }
}

// End pagination slider
