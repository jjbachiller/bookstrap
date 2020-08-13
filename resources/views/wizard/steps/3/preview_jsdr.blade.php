
var firstLoad = true;

// Load Book content from server and generate book
function loadPreviewContent() {
  var sections = [];
  $("#Sections").find(".section-index").each(
    function(index) {
      sections.push($(this).val());
    }
  );

  $.ajax({
    type: "POST",
    url : "{{ route('preview.content') }}",
    data: {user: $('#user').val(), _token: "{{ csrf_token() }}", sections: sections},
    success: function (data) {
      json = eval("(" + data + ")");
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

      function addSectionContent(section_index, images, solutions = false) {

        var sectionStart = true;
        // Get title for .section-index i
        var sectionIndex = $('.section-index[value=' + section_index + ']');
        var titleBlock = solutions ? sectionIndex.closest('.card-body-container').find('.solutions-title-block') : sectionIndex.closest('.title-block');
        var titleHeader = false;
        var sectionTitle = solutions ? titleBlock.find('.addSolutionTitle') : titleBlock.find('.addSectionTitle');
        if (sectionTitle.is(':checked')) {
          var title = solutions ? titleBlock.find('.section-title-solutions-input').val() : titleBlock.find('.section-title-input').val();
          var page = getNewTitlePage(current_page, title);
          var addHeader = solutions ? titleBlock.find('.addTitleHeaderSolution') : titleBlock.find('.addTitleHeader');
          titleHeader = (addHeader.is(':checked')) ? title : false;
          $('#mybook-content').append(page);
          sectionStart = false;
          current_page++;

          // Blank pages
          page = getNewTitlePage(current_page_blankpages_book, title)
          $('#mybook-blankpages-content').append(page);
          current_page_blankpages_book++;
          var blankpage = getNewTitlePage(current_page_blankpages_book, '');
          $('#mybook-blankpages-content').append(blankpage);
          current_page_blankpages_book++;
        }

        var imageNameAsTitle = solutions ? titleBlock.find('.imageNameAsTitleSolution').is(':checked') : titleBlock.find('.imageNameAsTitle').is(':checked');
        var imagesPerPage = solutions ? titleBlock.find('.solutionsPerPage').val() : titleBlock.find('.imagesPerPage').val();

        if (solutions) {
          console.log('Adding solutions');
          console.log(titleBlock.html());
        }

        var currentPageImages = new Array();
        images.forEach(function(image, j) {
          if (currentPageImages.length == imagesPerPage) {
            pageOptions = {
              'pageNumber': current_page,
              'images': currentPageImages,
              'header': titleHeader,
              'imageNameAsTitle': imageNameAsTitle,
              'sectionStart': sectionStart,
            };
            var page = getNewImagePage(pageOptions);
            $('#mybook-content').append(page);
            current_page++;
            sectionStart = false;

            // Blank pages
            page = getNewImagePage(pageOptions);
            $('#mybook-blankpages-content').append(page);
            current_page_blankpages_book++;
            var blankpage = getNewTitlePage(current_page_blankpages_book, '');
            $('#mybook-blankpages-content').append(blankpage);
            current_page_blankpages_book++;

            // Reset the images per page array
            currentPageImages = new Array();
          }

          currentPageImages.push(image);
        });

        // Add a new page with the pending images.
        if (currentPageImages.length > 0) {
          pageOptions = {
            'pageNumber': current_page,
            'images': currentPageImages,
            'header': titleHeader,
            'imageNameAsTitle': imageNameAsTitle,
            'sectionStart': sectionStart,
          };
          var page = getNewImagePage(pageOptions);
          $('#mybook-content').append(page);
          current_page++;
          sectionStart = false;

          // Blank pages
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
      $.each(json.order, function(i, section_index) {
        var section = json.sections[section_index];
        addSectionContent(section_index, section.images);
        // Check if solutions go now or at the end
        var postponedSolution = $('.section-index[value=' + section_index + ']').closest('.card-body').find('.placeSolutionsAtTheEnd');
        if (postponedSolution.is(':checked')) {
          var sectionSolutions = {
            'index': section_index,
            'images': section.solutions
          };
          solutionsToTheEnd.push(sectionSolutions);
        } else {
          addSectionContent(section_index, section.solutions, true);
        }
      });

      // Add solutions marked to the end on each section, to the end of the book preview.
      solutionsToTheEnd.forEach(function(solution, i) {
        addSectionContent(solution.index, solution.images, true);
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
  if (imagePageOptions['header'] !== false) {
    imageTemplate.find('.page-header').toggleClass('invisible');
    imageTemplate.find('.header-text').text(imagePageOptions['header']);
  }

  if (imagePageOptions['sectionStart']) {
    // If it is the first page of a section we add the section-start class
    imageTemplate.find('.page').addClass("section-start");
  }

  var numImages = imagePageOptions['images'].length;
  var imagesLayout = $('.images-layout').find('.images-per-page-' + numImages).clone();
  imagePageOptions['images'].forEach(function(image, i) {
    var imageNumber = i + 1;
    // Load or remove the title for each image
    var imgTitle = imagesLayout.find('.title-' + imageNumber);
    if (!imagePageOptions['imageNameAsTitle']) {
      // imgTitle.remove();
      imgTitle.html('');
    } else {
      // Remove path & extension from image route.
      var imageName = image.replace(/^.*[\\\/]/, '').replace(/\.[^/.]+$/, "");
      imgTitle.html(imageName);
    }

    imagesLayout.find('.image-' + imageNumber).attr('data-src', image);
  });
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
      $("div.b-page-" + i).find('img.lazy').lazy();
    }
  }
}

// Regenerate book on device rotation
var supportsOrientationChange = "onorientationchange" in window,
    orientationEvent = supportsOrientationChange ? "orientationchange" : "resize";

window.addEventListener(orientationEvent, function() {
  generateBook();
}, false);


// Image size options management
$('#image-size').TouchSpin({
  min: 1,
  max: 100,
  initval: '100',
  replacementval: '',
  decimals: 0,
  forcestepdivisibility: 'round',
  verticalbuttons: false,
  verticalupclass: 'oi oi-chevron-top',
  verticaldownclass: 'oi oi-chevron-bottom',
  boostat: 5,
  booster: true,
  maxboostedstep: 10,
  postfix: '%',
  step: 1,
  stepinterval: 100,
  stepintervaldelay: 500,
  mousewheel: true,
  buttondown_class: 'btn btn-primary',
  buttonup_class: 'btn btn-primary',
  buttondown_txt: '-',
  buttonup_txt: '+'
});

$('#image-size').on('change', function() {
  var percentage = $(this).val();
  if (percentage) {
    $('.img-content img').width(percentage+'%');
  }
});

$('#image-size').focusout(function() {
  var percentage = $(this).val();
  if (!isNaN(percentage) || percentage < 0 || percentage > 100) {
    var image_width = $('.page-content img').width();
    var parent_width = $('.page-content img').parent().width();
    var image_percentage = Math.ceil(image_width / parent_width * 100);
    $(this).val(image_percentage);
  }
});
// End image size options management

// Image position options management
function imagePosition(position) {
  var align = 'center';
  var justify = 'center';

  switch (position) {
    case '1':
      align="start";
      justify = "start";
      break;
    case '2':
      align="start";
      justify = "center";
      break;
    case '3':
      align="start";
      justify = "end";
      break;
    case '4':
      align="center";
      justify = "start";
      break;
    case '5':
      align="center";
      justify = "center";
      break;
    case '6':
      align="center";
      justify = "end";
      break;
    case '7':
      align="end";
      justify = "start";
      break;
    case '8':
      align="end";
      justify = "center";
      break;
    case '9':
      align="end";
      justify = "end";
      break;
  }

  $('.img-content').css({'align-items': align, 'justify-content': justify});
};

$('.image-position .btn').on('click', function() {
  var position = $(this).attr('rel');
  imagePosition(position);
  $('.image-position .btn').removeClass('btn-primary').addClass('btn-light');
  $(this).removeClass('btn-light').addClass('btn-primary');
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
  } else {
    // removeBlankPages();
    $('#mybook').booklet("gotopage", 'start');
    $('#mybook').show();
    $('#mybook-blankpages').hide();
    generateBookSlider();
  }
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
}

function loadEditingBookValues(book) {
  $('#image-size').val(book['img_scale']);
  $('.image-position .btn[rel=' + book['img_position'] + ']').click();
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
}

// End pagination slider
