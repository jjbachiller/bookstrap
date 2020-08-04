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
      var current_page = 1;

      // Delete old content
      $('#mybook').empty();

      // Create the content div.
      $('<div/>', {
        id: 'mybook-content',
        "class": 'b-load',
        width: '905px',
        height: '181px'
      }).appendTo('#mybook');

      addCopyright();

      $.each(json.order, function(i, section_index) {
        var sectionStart = true;
        // Get title for .section-index i
        var sectionIndex = $('.section-index[value=' + section_index + ']');
        var titleBlock = sectionIndex.closest('.title-block');
        var titleHeader = false;
        if (titleBlock.find('.addSectionTitle').is(':checked')) {
          var title = titleBlock.find('.section-title-input').val();
          var page = getNewTitlePage(current_page, title);
          titleHeader = (titleBlock.find('.addTitleHeader').is(':checked')) ? title : false;
          $('#mybook-content').append(page);
          sectionStart = false;
          current_page++;
        }
        // Add section images to the book
        var section = json.sections[section_index];
        section.forEach(function(image, j) {
          var page = getNewImagePage(current_page, image, titleHeader, sectionStart);
          $('#mybook-content').append(page);
          current_page++;
          sectionStart = false;
        });
      });
      generateBook();
      generateBookSlider();
      @isset($book)
        var editingBook = @json($book);
        loadEditingBookValues(editingBook);
      @endisset
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
function getNewImagePage(pageNumber, image, header, sectionStart) {
  var imageTemplate = $('#page-template').clone();
  //Remove the title section from the template
  imageTemplate.find('.title-content').remove();
  if (header !== false) {
    imageTemplate.find('.page-header').toggleClass('invisible');
    imageTemplate.find('.header-text').text(header);
  }

  if (sectionStart) {
    // If it is the first page of a section we add the section-start class
    imageTemplate.find('.page').addClass("section-start");
  }


  var page = imageTemplate.html();
  page = page.replace('[IMG_URL]', image);

  var footer = $('#footer').val();
  page = page.replace('[FOOTER]', footer);

  return getNewPageGenericContent(page, pageNumber, false);
}

function getNewTitlePage(pageNumber, title) {
  var titleTemplate = $('#page-template').clone();
  //Remove the image section from the template
  titleTemplate.find('.img-content').remove();
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

function loadBookPreview() {
  var $mybook 		= $('#mybook');
  var $bttn_next		= $('#next_page_button');
  var $bttn_prev		= $('#prev_page_button');
  var bookletWidth = 800;
  var bookletHeight = 500;

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

  $mybook.show().booklet({
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
      loadPage(page.index);
    }
  });

  //Bucle para cargar imágenes desde la 0 con lazy

  $('#mybook-slider').removeClass('d-none');

}

function generateBook() {
  $('#loading').hide();
  loadBookPreview();
  loadPage(0);
  // Apply the selected options to book.
  var percentage = $('#image-size').val();
  $('.img-content img').width(percentage + '%');
  var position = $('.image-position .btn-primary').attr('rel');
  imagePosition(position);
  if($('#addBlankPages').is(':checked')) {
    addBlankPages();
  }
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
    addBlankPages();
  } else {
    removeBlankPages();
  }
});

function addBlankPages() {
  var $mybook 		= $('#mybook');
  var current_page = 1;
  var pages = $('#mybook div.page');
  // If there is a copyright page, content start on page 3
  var shift =   $('#addCopyright').is(':checked') ? 2 : 0;
  $mybook.booklet("gotopage", 'start');
  $.each(pages, function(index, p) {
    if (index > shift) {
      current_page++;
      var page = getNewTitlePage(current_page, '');
      $mybook.booklet("add", current_page-1 + shift, page);

      current_page++;
      // Modify page number for every page but first.
      $(this).find('.page-number').text(current_page);
    }
  });
  loadBookPreview();
  generateBookSlider();
}

function removeBlankPages() {
  var $mybook 		= $('#mybook');
  var current_page = 1;
  var pages = $('#mybook div.page');
  var shift =   $('#addCopyright').is(':checked') ? 2 : 0;
  $mybook.booklet("gotopage", 'start');
  $.each(pages, function(index, page) {
    if (index > shift) {
      if ((index % 2)) {
        $mybook.booklet("remove", current_page + shift);
      } else {
        current_page++;
        $(this).find('.page-number').text(current_page);
      }
    }
  });
  loadBookPreview();
  generateBookSlider();
}
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

function generateBookSlider() {

  var bookPages = $('#mybook').find('div.page');
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
    var $mybook 		= $('#mybook');
    $mybook.booklet("gotopage", $(this).val());
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
