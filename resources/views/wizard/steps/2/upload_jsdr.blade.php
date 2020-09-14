//// New section add
$(function() {
  $(".myDrop").sortable({
    items: '.dz-preview',
    cursor: 'move',
    opacity: 0.5,
    containment: '.myDrop',
    distance: 20,
    tolerance: 'pointer',
  });

  $(".myDrop").disableSelection();
});

//Dropzone script
Dropzone.autoDiscover = false;

// Add a section block
$(".section-index").on('change', function() {
  var index = $(this).val();
  var sectionBlock = $(this).closest(".section-block");
  var sectionHeader = sectionBlock.find(".card-header");

  sectionHeader.attr('id', 'heading' + index);

  sectionBlock.find(".section-button").html("Section " + index);

  sectionBlock.find(".addSectionTitle").attr('id', 'addHeader' + index);
  sectionBlock.find(".addSolutionTitle").attr('id', 'addHeaderSolution' + index);
  sectionBlock.find(".imageNameAsTitle").attr('id', 'addImageNameAsTitle' + index);
  sectionBlock.find(".imageNameAsTitleSolution").attr('id', 'addImageNameAsTitleSolution' + index);
  sectionBlock.find(".addTitleHeader").attr('id', 'addTitleHeader' + index);
  sectionBlock.find(".addTitleHeaderSolution").attr('id', 'addTitleHeaderSolution' + index);
  sectionBlock.find(".addHeaderLabel").attr('for', 'addHeader' + index);
  sectionBlock.find(".addHeaderSolutionLabel").attr('for', 'addHeaderSolution' + index);
  sectionBlock.find(".imageNameAsTitleLabel").attr('for', 'addImageNameAsTitle' + index);
  sectionBlock.find(".imageNameAsTitleLabelSolution").attr('for', 'addImageNameAsTitleSolution' + index);
  sectionBlock.find(".section-title-input").attr('id', 'sectionTitle' + index);
  sectionBlock.find(".section-title-solutions-input").attr('id', 'sectionTitleSolution' + index);
  sectionBlock.find(".dropzone").attr('id', 'myDrop' + index);
  sectionBlock.find(".dropzone-solutions").attr('id', 'myDropSolutions' + index);
  sectionBlock.find(".addSolutions").attr('id', 'addSolutions' + index);
  sectionBlock.find(".addSolutionsLabel").attr('for', 'addSolutions' + index);
  sectionBlock.find(".placeSolutionsAtTheEnd").attr('id', 'solutionsAtTheEnd' + index);
  sectionBlock.find(".placeSolutionsAtTheEndLabel").attr('for', 'solutionsAtTheEnd' + index);

  sectionBlock.find(".imagesPerPage").attr('id', 'imagesPerPage' + index);
  sectionBlock.find(".imagesPerPageLabel").attr('for', 'imagesPerPage' + index);
  sectionBlock.find(".solutionsPerPage").attr('id', 'solutionsPerPage' + index);
  sectionBlock.find(".solutionsPerPageLabel").attr('for', 'solutionsPerPage' + index);

  if (index > 1) {
    sectionBlock.find(".delete-section").removeClass('d-none');
  }
});

$('#addSection').on("click", addNewSection);

function addNewSection(section = []) {

  if (typeof section['folder'] === 'undefined') {
    // New section
    var currentIndex = $("#section-last-index").val();
    var newIndex = parseInt(currentIndex) + 1;
  } else {
    // Existing section (update)
    var newIndex = parseInt(section['folder']);
  }

  $("#section-last-index").val(newIndex);
  var newSection = $(".section-template").clone(true, true);
  newSection.removeClass('section-template d-none').addClass('section-block');
  $("#Sections").append(newSection);
  $('#Sections').accordion("refresh");
  newSection.find('.card-header').click();

  // Change index value triggering the change in the identifiers and classes for the block
  newSection.find(".section-index").val(newIndex).change();

  // Load section value if is an editing section
  if ((typeof section['id'] !== 'undefined')
    && (section['id'] !== null)) {
    newSection.find(".section-id").val(section['id']);
  }

  // SECTION CONTENT: If user is updating a section and the section has a title, set the title values
  if ((typeof section['title'] !== 'undefined')
    && (section['title'] !== null)) {
      newSection.find(".addSectionTitle").prop('checked', true).change();
      newSection.find(".section-title-input").val(section['title']);
      newSection.find('.section-button').text(section['title']);
      if ((typeof section['header'] !== 'undefined')
        && (section['header'] !== null)) {
        $('#section-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }} + ']').click();
      } else {
        $('#section-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.PAGE') }} + ']').click();
      }
  } else if ((typeof section['header'] !== 'undefined')
    && (section['header'] !== null)) {
      newSection.find(".addSectionTitle").prop('checked', true).change();
      newSection.find(".section-title-input").val(section['header']);
      newSection.find('.section-button').text(section['header']);
      $('#section-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.HEADER') }} + ']').click();
  }

  if (typeof section['image_name_as_title'] !== 'undefined') {
    if (section['image_name_as_title'] == 1) {
      newSection.find(".imageNameAsTitle").prop('checked', true).change();
    }
  }

  if (typeof section['images_per_page'] !== 'undefined') {
    newSection.find('.imagesPerPage').val(section['images_per_page']);
  }

  // SOLUTIONS CONTENT:
  if (typeof section['solutions'] !== 'undefined' && section['solutions'].length > 0) {
    newSection.find(".addSolutions").prop('checked', true).change();

    if (section['solutions_title'] !== null) {
      newSection.find(".addSolutionTitle").prop('checked', true).change();
      newSection.find(".section-title-solutions-input").val(section['solutions_title']);
      newSection.find(".solutions-content div.alert").text(section['solutions_title']);
      if (section['solutions_header'] !== null) {
        $('#solutions-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }} + ']').click();
      } else {
        $('#solutions-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.PAGE') }} + ']').click();
      }
    } else if (section['solutions_header'] !== null) {
      newSection.find(".addSolutionTitle").prop('checked', true).change();
      newSection.find(".section-title-solutions-input").val(section['solutions_header']);
      newSection.find(".solutions-content div.alert").text(section['solutions_header']);
      $('#solutions-title-as .btn input[value=' + {{ config('bookstrap-constants.sectionTitle.HEADER') }} + ']').click();
    }

    if (typeof section['solutions_name_as_title'] !== 'undefined') {
      if (section['solutions_name_as_title'] == 1) {
        newSection.find(".imageNameAsTitleSolution").prop('checked', true).change();
      }
    }

    if (typeof section['solutions_per_page'] !== 'undefined') {
        newSection.find('.solutionsPerPage').val(section['solutions_per_page']);
    }

    if (typeof section['solutions_to_the_end'] !== 'undefined') {
      if (section['solutions_to_the_end'] == 1) {
        newSection.find(".placeSolutionsAtTheEnd").prop('checked', true).change();
      }
    }
  }


  // If newIndex > 1 add deleteSection button
  var newDrops = newSection.find(".myDrop");

  // Set the dropzone & solution dropzone functionality
  newDrops.dropzone(
  {
       paramName: "files", // The name that will be used to transfer the file
       addRemoveLinks: true,
       uploadMultiple: true,
       autoProcessQueue: true,
       parallelUploads: 50,
       maxFilesize: 5, // MB
       acceptedFiles: ".png, .jpeg, .jpg, .gif",
       url: "{{ route('section.upload-images') }}",
  });

  var sectionDropzone = Dropzone.forElement("#myDrop"+newIndex);

  setupDropzone(sectionDropzone, newSection, newIndex);

  var solutionsDropzone = Dropzone.forElement("#myDropSolutions"+newIndex);

  setupDropzone(solutionsDropzone, newSection, newIndex, 1);

  // If is editing a section, add the images of the existing section to the dropZone.
  if (typeof section['images'] !== 'undefined') {
    var images = section['images'];
    if (images instanceof Array) {
      for (var index in images) {
        var image = images[index];
        var imageData = {'name': image['show_name'], 'size': image['size'], 'type': image['type']};

        sectionDropzone.displayExistingFile(imageData, image['preview_url']);
        sectionDropzone.files.push(imageData);
      }
    }
  }

  // And the same for the solutions if user is editing an existing section with solutions
  if (typeof section['solutions'] !== 'undefined') {
    var solutions = section['solutions'];
    if (solutions instanceof Array) {
      for (var index in solutions) {
        var solution = solutions[index];
        var solutionData = {'name': solution['show_name'], 'size': solution['size'], 'type': solution['type']};
        solutionsDropzone.displayExistingFile(solutionData, solution['preview_url']);
        solutionsDropzone.files.push(solutionData);
      }
    }
  }
}
// End AddSection block
function getSectionByIndex(sectionIndex) {
  var section = $("#Sections").find(".section-index[value=" + sectionIndex + "]").closest(".section-block");

  return section;
}


function currentSectionData(sectionIndex) {
  var currentSection = getSectionByIndex(sectionIndex);

  var section = {};
  section.id = currentSection.find("input.section-id").val();
  section.folder = currentSection.find("input.section-index").val();
  section.addTitle = currentSection.find(".addSectionTitle").is(':checked');
  var sectionTitle = currentSection.find(".section-title-input").val();
  var titleAs = currentSection.find('#section-title-as').find('.active').find('input').val();
  section.title = (titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE') }} | titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? sectionTitle : '';
  section.titleHeader = (titleAs == {{ config('bookstrap-constants.sectionTitle.HEADER') }} | titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? sectionTitle : '';
  section.imageNameAsTitle = currentSection.find(".imageNameAsTitle").is(':checked');
  section.imagesPerPage = currentSection.find(".imagesPerPage").val();
  // Solutions fields
  section.addSolutionsTitle = currentSection.find(".addSolutionTitle").is(':checked');
  var solutionsTitle = currentSection.find(".section-title-solutions-input").val();
  var solutionsTitleAs = currentSection.find('#solutions-title-as').find('.active').find('input').val();
  section.solutionsTitle = (solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE') }} | solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? solutionsTitle : '';
  section.solutionsHeader = (solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.HEADER') }} | solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? solutionsTitle : '';
  section.solutionNameAsTitle = currentSection.find(".imageNameAsTitleSolution").is(':checked');
  section.solutionsPerPage = currentSection.find(".solutionsPerPage").val();
  section.solutionsToTheEnd = currentSection.find(".placeSolutionsAtTheEnd").is(':checked');

  return section;
}

function sendSectionsUpdate() {
    var sections = [];
    var order = 1;
    $("#Sections .section-block").each(function(index) {
      var currentIndex = $(this).find("input.section-index").val()
      var currentSection = currentSectionData(currentIndex);
      currentSection.order = order;
      order += 1;
      sections.push(currentSection );
    });

    var data = {
      sections: sections
    }

    $.ajax({
      type: "POST",
      url: "{{ route('sections.update') }}",
      dataType: 'json',
      data: JSON.stringify(data),
      success: function(response) {
        // After update the section data, load the content in the preview
        loadPreviewContent();
      },
    });
}

function updateSectionId(sectionIndex, id) {
  var currentSection = getSectionByIndex(sectionIndex);

  currentSection.find("input.section-id").val(id);
}

function setupDropzone(newDropzone, newSection, newIndex, solutions=0) {

  newDropzone.on("sending", function(file, xhr, formData) {
    var filenames = [];
    $('.dz-preview .dz-filename').each(function() {
      filenames.push($(this).find('span').text());
    });
    formData.append("_token", $('#_token').val());
    formData.append("section", newIndex);
    // On every image upload, we send the section data for update/creation.
    var sectionData = currentSectionData(newIndex);
    formData.append("section-data", JSON.stringify(sectionData));
    formData.append("solutions", solutions);
    formData.append('filenames', filenames);
  });

  var deleteClass = solutions ? '.delete-solutions' : '.delete-images';

  newDropzone.on("addedfile", function(file) {
    // Enable the delete all images button
    newSection.find(deleteClass).prop('disabled', false);
    // Append the file name to the image preview.
    var previewContent = solutions ? newSection.find('.solutions-content') : newSection.find('.section-content');
    var preview = previewContent.find(".dz-preview:last-child");
    var filenameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
    var imageName = $("<span/>")
                      .attr("class", "badge badge-pill badge-primary mb-2")
                      .attr("data-placement", "top")
                      .attr("data-toggle", "tooltip")
                      .attr("title", filenameWithoutExt)
                      .html(filenameWithoutExt);
    imageName.tooltip();
    preview.prepend(imageName);

    var secondDZ = solutions ? Dropzone.forElement("#myDrop"+newIndex) : Dropzone.forElement("#myDropSolutions"+newIndex);
    // If the number of files are different error = true
    /// (When we added an existing file, it calls this event but index
    // count one less so here we check only this scenario )
    var error = (newDropzone.files.length + 1) - secondDZ.files.length;

    updateSolutionsNumberMatchMessage(newIndex, error);
  });

  newDropzone.on("success", function(file, response) {
    // Check the normal scenario of uploading a file from the user computer
    var secondDZ = solutions ? Dropzone.forElement("#myDrop"+newIndex) : Dropzone.forElement("#myDropSolutions"+newIndex);

    // If the number of files are different error = true
    var error = newDropzone.files.length - secondDZ.files.length;

    // Update the sectionId
    updateSectionId(newIndex, response.sectionId);

    updateSolutionsNumberMatchMessage(newIndex, error);
  })

  newDropzone.on("removedfile", function(file) {
    $.ajax({
      type: "POST",
      url : "{{ route('section.delete-image') }}",
      data: {user: $('#user').val(), _token: "{{ csrf_token() }}", section: newIndex, image: file.name, solutions: solutions}
    });

    if (newDropzone.files.length == 0) {
      newSection.find(deleteClass).prop('disabled', true);
    }

    var secondDZ = solutions ? Dropzone.forElement("#myDrop"+newIndex) : Dropzone.forElement("#myDropSolutions"+newIndex);
    // If the number of files are different error = true
    var error = newDropzone.files.length - secondDZ.files.length;
    updateSolutionsNumberMatchMessage(newIndex, error);
  });
}

function updateSolutionsNumberMatchMessage(sectionIndex, error) {
  if ($(document).find("#addSolutions"+sectionIndex).is(':checked')) {
    var sectionHeader = $(document).find("#heading"+sectionIndex);
    if (error) {
      sectionHeader.addClass('bg-danger');
      sectionHeader.find('.section-error').removeClass('d-none');
    } else {
      sectionHeader.removeClass('bg-danger');
      sectionHeader.find('.section-error').addClass('d-none');
    }
  }
}

$(".addSectionTitle").on('change', function() {
  $(this).closest(".title-block").find(".section-title-text").toggleClass('d-none');
});

$(".addSolutionTitle").on('change', function() {
  $(this).closest(".solutions-title-block").find(".section-title-text").toggleClass('d-none');
})

$('.delete-images').on('click', function() {
  if (confirm("Are you sure you want to delete all images from this section?")) {
    var dropzoneIndex = $(this).closest(".section-block").find('.section-index').val();
    var sectionDropzone = Dropzone.forElement("#myDrop"+dropzoneIndex);
    sectionDropzone.removeAllFiles(true);
  }
});

$('.delete-solutions').on('click', function() {
  if (confirm("Are you sure you want to delete all solutions from this section?")) {
    var dropzoneIndex = $(this).closest(".section-block").find('.section-index').val();
    var sectionDropzone = Dropzone.forElement("#myDropSolutions"+dropzoneIndex);
    sectionDropzone.removeAllFiles(true);
  }
});

$('.delete-section').on('click', function(e) {
  if (confirm("Do you really want to delete this section?")) {
    $(this).closest(".section-block").remove();
  } else {
    e.stopPropagation();
  }
});

$('.section-title-input').keyup(function() {
  $(this).closest('.section-block').find('.section-button').text($(this).val());
});

$('.section-title-solutions-input').keyup(function() {
  $(this).closest('.section-block').find('.alert').text($(this).val());
});

// Disabling bootstrap collapsing
$('.sections-list').on('hide.bs.collapse', function (e) {
  e.preventDefault();
})

$('#Sections').accordion({
  active: true,
  heightStyle: "content",
  "ui-accordion-header": "card-header",
  "ui-accordion-header-collapsed": "collapsed-header",
  "ui-accordion-content": "collapse"
});

// Make sections sortable
$('.sections-list').sortable({
  group: 'sections-list',
  handle: 'span.flaticon-more',
  axis: 'y',
  opacity: 0.7,
  cursor: 'move',
  start: function(event, ui) {
    // ui.item.addClass("scalated");
  },
  stop: function(event, ui) {
    // ui.item.removeClass("scalated");
  },
}).disableSelection();

$('.addSolutions').on('change', function() {
  $(this).closest('.section-block').find('.solutions-content').toggleClass('d-none');
});

$('.toggleSectionOptions').on('click', function() {
  $(this).closest(".section-block").find('.section-options').toggleClass('d-none');
});

$('.toggleSolutionsOptions').on('click', function() {
  $(this).closest(".section-block").find('.solutions-options').toggleClass('d-none');
});

// On load add the existing sections to edit.
@isset($book)
  @foreach($book->sections as $section)
    var section = @json($section);
    addNewSection(section);
  @endforeach
@else
  // If is not editing, we add a new blank section
  addNewSection();
@endisset


// Begin ::::> Load content from library functions

$('.loadLibraryContentButton').on('click', function() {
  var sectionIndex = $(this).closest(".section-block").find(".section-index").val();
  // Save the section index that will be affected by the actions on the modal
  $("#modalAffectedSection").val(sectionIndex);
});

function updateProgress(startFrom, targetNum, sectionId) {
  // Query each 2 seconds, the number of files from s3 copied locally.
  setTimeout(function() {
    $.ajax({
      type: "POST",
      url: "{{ route('section.num-images') }}",
      dataType: 'json',
      data: JSON.stringify({ 'id': sectionId}),
      success: function(response) {
        var numNewFiles = response.num_images - startFrom;
        var percentage = (numNewFiles * 100) / targetNum;
        $('.currentProgress div.progress-bar').width(percentage + '%');
        if (percentage < 100) {
          updateProgress(startFrom, targetNum, sectionId);
        }
      }
    });
  }, 2000);
}

function showProgress(numNewImages, sectionId) {
  $('#progress-container').clone().removeClass('d-none').addClass('currentProgress').appendTo('.blockPage');
  $.ajax({
    type: "POST",
    url: "{{ route('section.num-images') }}",
    dataType: 'json',
    data: JSON.stringify({ 'id': sectionId}),
    success: function(response) {
      updateProgress(response.num_images, numNewImages, sectionId);
    }
  });
}

$('#addSudokusButton').on('click', function() {
  var affectedSectionIndex = $("#modalAffectedSection").val();
  var affectedSection = currentSectionData(affectedSectionIndex);

  // Take the selected values from the popup
  var data = {
    'section-data': affectedSection,
    'difficulty': $('#sudokusDifficulty').val(),
    'number': $('#sudokusNumber').val(),
  }

  // Block the section container
  // var sectionToLock = getSectionByIndex(affectedSectionIndex);
  KTApp.blockPage({
    overlayColor: '#000',
    state: 'info',
    message: 'Generating content. Please wait...',
    opacity: 0.15,
  });

  // The number of images is doubled to include solutions
  var numImages = data.number * 2;
  showProgress(numImages, data.section-data.id);

  // ajax call to randomly associate sudokus to section
  $.ajax({
    type: "POST",
    url: "{{ route('section.load-sudokus') }}",
    dataType: 'json',
    data: JSON.stringify(data),
    success: function(response) {
      $('.currentProgress').remove();
      KTApp.unblockPage('#smartwizard');
      updateSectionId(affectedSectionIndex, response.sectionId);
      // Mark the section as a section with solutions.
      if (!$("#addSolutions"+affectedSectionIndex).prop('checked')) {
        $("#addSolutions"+affectedSectionIndex).prop('checked', true).change();
      }
      var sectionDropzone = Dropzone.forElement("#myDrop"+affectedSectionIndex);

      var images = response.images;
      for (var index in images) {
        var image = images[index];
        var imageData = {'name': image.show_name, 'size': image.size, 'type': image.type};
        sectionDropzone.displayExistingFile(imageData, image.url);
        // Add to the dropZone files array (so you can delete all).
        sectionDropzone.files.push(imageData);
      }

      var solutionsDropzone = Dropzone.forElement("#myDropSolutions"+affectedSectionIndex);

      var solutions = response.solutions;
      for (var index in response.solutions) {
        var solution = solutions[index];
        var solutionData = {'name': solution.show_name, 'size': solution.size, 'type': solution.type};
        solutionsDropzone.displayExistingFile(solutionData, solution.url);
        solutionsDropzone.files.push(solutionData);
      }

    },
  });

});

// End ::::> Load content from library functions
