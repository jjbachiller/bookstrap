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

  // SECTION CONTENT: If user is updating a section and the section has a title, set the title values
  if ((typeof section['title'] !== 'undefined')
    && (section['title'] !== null)) {
      newSection.find(".addSectionTitle").prop('checked', true).change();
      newSection.find(".section-title-input").val(section['title']);
      newSection.find('.section-button').text(section['title']);
      if (!section['header']) {
        newSection.find('addTitleHeader').prop('checked', false);
      }
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
      newSection.find(".solutions-title-block div.alert").text(section['solutions_title']);
      if (!section['solutions_header']) {
        newSection.find('addTitleHeaderSolution').prop('checked', false);
      }
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
        sectionDropzone.displayExistingFile(image.data, image.url);
        // Add to the dropZone files array (so you can delete all).
        sectionDropzone.files.push(image.data);
      }
    }
  }

  // And the same for the solutions if user is editing an existing section with solutions
  if (typeof section['solutions'] !== 'undefined') {
    var solutions = section['solutions'];
    if (solutions instanceof Array) {
      for (var index in solutions) {
        var solution = solutions[index];
        solutionsDropzone.displayExistingFile(solution.data, solution.url);
        solutionsDropzone.files.push(solution.data);
      }
    }
  }

}

function setupDropzone(newDropzone, newSection, newIndex, solutions=0) {

  newDropzone.on("sending", function(file, xhr, formData) {
    var filenames = [];
    $('.dz-preview .dz-filename').each(function() {
      filenames.push($(this).find('span').text());
    });
    formData.append("_token", $('#_token').val());
    // formData.append("user", $('#user').val());
    formData.append("section", newIndex);
    formData.append("solutions", solutions);
    // formData.append("orderByName", $('#orderByName'+newIndex).is(':checked')?1:0);
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
    var error = (newDropzone.files.length + 1) - secondDZ.files.length;
    updateSolutionsNumberMatchMessage(newIndex, error);
  });

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

//// End new section add

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
  handle: 'span.oi-ellipses',
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
