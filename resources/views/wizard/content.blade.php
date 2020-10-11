{{-- Extends layout --}}
@extends('layout.default')

@section('styles')
  <link href="https://cdn.jsdelivr.net/npm/smartwizard@5.0.0/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
  @include('wizard.steps.2.upload_css')
  @include('wizard.steps.3.preview_css')
@endsection

@section('content')
  <div class="card card-custom">
    <div class="card-body p-0">
      <div id="smartwizard" class="wizard wizard-1" data-wizard-state="first" data-wizard-clickable="true">
        <div class="wizard-nav border-bottom">
          <ul class="nav wizard-steps p-3">
             <li class="wizard-step m-auto" data-wizard-step="step" data-wizard-state="current">
               <div class="d-flex justify-content-center align-items-center">
                 <a class="nav-link wizard-label flex-column text-center" href="#step-1">
                    <i class="icon-xl fas fa-pencil-ruler mb-2" style="color: inherit;"></i>
                    <h5 class="flex-row">1. Book Options</h5>
                 </a>
                 <span class="flex-column pl-6">
                   <i class="icon-xl fas fa-chevron-circle-right text-light-secondary"></i>
                 </span>
               </div>
             </li>
             <li class="wizard-step m-auto" data-wizard-step="step" data-wizard-state="pending">
               <div class="d-flex justify-content-center align-items-center">
                 <a class="nav-link wizard-label flex-column text-center" href="#step-2">
                    <i class="icon-xl fas fa-layer-group mb-2" style="color: inherit;"></i>
                    <h5>2. Book Sections</h5>
                 </a>
                 <span class="flex-column pl-6">
                   <i class="icon-xl fas fa-chevron-circle-right text-light-secondary"></i>
                 </span>
               </div>
             </li>
             <li class="wizard-step m-auto" data-wizard-step="step" data-wizard-state="pending">
               <div class="d-flex justify-content-center align-items-center">
                 <a class="nav-link wizard-label flex-column text-center" href="#step-3">
                    <i class="icon-xl far fa-eye mb-2" style="color: inherit;"></i>
                    <h5>3. Book Preview</h5>
                 </a>
                 <span class="flex-column pl-6">
                   <i class="icon-xl fas fa-chevron-circle-right text-light-secondary"></i>
                 </span>
               </div>
             </li>
             <li class="wizard-step m-auto" data-wizard-step="step" data-wizard-state="pending">
               <div class="d-flex justify-content-center align-items-center">
                 <a class="nav-link wizard-label flex-column text-center" href="#step-4">
                    <i class="icon-xl far fa-file-alt mb-2" style="color: inherit;"></i>
                    <h5>4. File Options</h5>
                 </a>
                 <span class="flex-column pl-6">
                   <i class="icon-xl fas fa-chevron-circle-right text-light-secondary"></i>
                 </span>
               </div>
             </li>
             <li class="wizard-step m-auto" data-wizard-step="step" data-wizard-state="pending">
                 <a class="nav-link wizard-label flex-column" href="#step-5">
                    <i class="icon-xl fas fa-cloud-download-alt mb-2" style="color: inherit;"></i>
                    <h5>5. Download</h5>
                 </a>
             </li>
          </ul>
        </div>


        <div class="tab-content">

           <input type="hidden" name="user" id="user" value="{{ substr(str_shuffle(MD5(microtime())), 0, 30) }}">
           <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

           <div id="step-1" class="tab-pane" role="tabpanel">
             @include('wizard.steps.1.options')
           </div>

           <div id="step-2" class="tab-pane" role="tabpanel">
             <div id="step2" class="step">
               @include('wizard.steps.2.upload')
             </div>
           </div>

           <div id="step-3" class="tab-pane" role="tabpanel">

             <div id="step3" class="step">
               @include('wizard.steps.3.preview')
             </div>

           </div>

           <div id="step-4" class="tab-pane" role="tabpanel">
             <div id="step4" class="step">
               @include('wizard.steps.4.file')
             </div>
           </div>

           <div id="step-5" class="tab-pane" role="tabpanel">
             <div id="step5" class="step">
               @include('wizard.steps.5.download')
             </div>
           </div>

        </div>

        {{-- Modal for library content --}}

        @include('wizard.modal.load_content')

      </div>

    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/smartwizard@5.0.0/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>

  @include('wizard.steps.2.upload_js')

  @include('wizard.steps.3.preview_js')

  <script type="text/javascript">

    $(document).ready(function () {
      // To prevent fields to keep value on reload.
      var allInputs = $(":input");
      $(allInputs).attr('autocomplete', 'off');


      // Book Generation
      $('#smartwizard').smartWizard({
        autoAdjustHeight: false,
        theme: 'default',
        justified: true,
        enableURLhash: false,
        keyboardSettings: {
          keyNavigation: false,
        },
        toolbarSettings: {
          toolbarExtraButtons: [
            $('<button/>').html('<span class="oi oi-reload"></span> Restart wizard')
              .addClass('btn btn-primary restart_wizard float-left')
          ]
        }
      });

      function bookGenerated() {
        $('#creating_container').addClass('d-none');
        $('#reload_container').removeClass('d-none').addClass('d-flex');
      }

      function bookGenerationReset() {
        $('#creating_container').removeClass('d-none');
        $('#reload_container').removeClass('d-flex').addClass('d-none');
        $('#download_container').removeClass('d-flex').addClass('d-none');
        $('#error_container').addClass('d-none');
        $('#creator-register-form').addClass('d-none');
      }

      function bookGeneratedSuccess(url) {
        bookGenerated();
        $('#book_link').attr('href', url);
        $('#download_container').removeClass('d-none').addClass('d-flex');
        $('#creator-register-form').removeClass('d-none');
      }

      function bookGeneratedError() {
        bookGenerated();
        $('#error_container').removeClass('d-none');
      }

      // function getBookSections() {
      //   var sections = [];
      //   $("#Sections .section-block").each(function(index) {
      //       var section = {};
      //       section.folder = $(this).find("input.section-index").val();
      //       section.addTitle = $(this).find(".addSectionTitle").is(':checked');
      //       var sectionTitle = $(this).find(".section-title-input").val();
      //       var titleAs = $('#section-title-as').find('.active').find('input').val();
      //       section.title = (titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE') }} | titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? sectionTitle : '';
      //       section.titleHeader = (titleAs == {{ config('bookstrap-constants.sectionTitle.HEADER') }} | titleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? sectionTitle : '';
      //       section.imageNameAsTitle = $(this).find(".imageNameAsTitle").is(':checked');
      //       section.imagesPerPage = $(this).find(".imagesPerPage").val();
      //       // Solutions fields
      //       section.addSolutionsTitle = $(this).find(".addSolutionTitle").is(':checked');
      //       var solutionsTitle = $(this).find(".section-title-solutions-input").val();
      //       var solutionsTitleAs = $('#solutions-title-as').find('.active').find('input').val();
      //       section.solutionsTitle = (solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE') }} | solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? solutionsTitle : '';
      //       section.solutionsHeader = (solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.HEADER') }} | solutionsTitleAs == {{ config('bookstrap-constants.sectionTitle.PAGE_AND_HEADER') }}) ? solutionsTitle : '';
      //       section.solutionNameAsTitle = $(this).find(".imageNameAsTitleSolution").is(':checked');
      //       section.solutionsPerPage = $(this).find(".solutionsPerPage").val();
      //       section.solutionsToTheEnd = $(this).find(".placeSolutionsAtTheEnd").is(':checked');
      //       sections.push(section);
      //   });
      //   return sections;
      // }

      function getImageSize() {
          var imagePercentage = $("#image-size").val();
          return imagePercentage.replace('%', '');
      }

      function getImagePosition() {
          return $('#image-position').find('.active').find('input').val();
      }

      function getBookHeader() {
        var header = {};
        header.addHeader = $('#addHeader').is(':checked');
        header.text = $('#header').val();
        return header;
      }

      function getBookFooter() {
        var footer = {};
        footer.addFooter = $('#addFooter').is(':checked');
        footer.text = $('#footer').val();
        return footer;
      }

      function getBookPageNumber() {
        var pageNumber = {};
        pageNumber.addPageNumber = $('#addPageNumber').is(':checked');
        pageNumber.position = $('#pageNumberOptions').find('.active').find('input').val();
        return pageNumber;
      }

      function getCopyright() {
        var copyright = {};
        copyright.addCopyright = $('#addCopyright').is(':checked');
        copyright.text = $('#copyright').val();
        return copyright;
      }


      function generateBookFile() {

        bookGenerationReset();

        var data = {
          filetype: $("input[name='book_filetype']:checked").val(),
        };

        $.ajax({
          type: "POST",
          url: "{{ route('books.generate') }}",
          dataType: 'json',
          data: JSON.stringify(data),
          success: function(response) {
            bookGeneratedSuccess(response.file_url);
          },
          error: function (data){
            bookGeneratedError();
          }
        });
      }

      function updateBookOptions(generateBook) {
        @can('active-subscription')
          var data = {
            type: $('#book-type').val(),
            size: $('#book-size').val(),
            user: $('#user').val(),
            imageSize: getImageSize(),
            imagePosition: getImagePosition(),
            header: getBookHeader(),
            footer: getBookFooter(),
            pageNumber: getBookPageNumber(),
            addBlankPages: $('#addBlankPages').is(':checked'),
            fullBleed: $('#fullBleed').is(':checked'),
            totalPages: $('#total-pages').val(),
            filename: $("input[name='book_filename']").val(),
          };

          $.ajax({
            type: "POST",
            url: "{{ route('books.update') }}",
            dataType: 'json',
            data: JSON.stringify(data),
            success: function(response) {
              if (generateBook) {
                // If user goes to the generating screen
                generateBookFile();
              }
            },
          });
        @else
          if (generateBook) {
            bookGeneratedError();
          } else {
            showExpiredAccountError();
          }
        @endcan
      }

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // Wizard config and requests logic
      $("#smartwizard").on("leaveStep", function(e, anchorObject, currentStepIndex, stepDirection) {
        switch (currentStepIndex) {
          // If run this, sections options not loaded will be deleted from database.
          // case 0:
          //   updateBookOptions(false);
          //   break;
          case 1:
            // Update sections with a method on the upload_jsdr.
            sendSectionsUpdate();
            break;
          case 2:
            updateBookOptions(false);
            break;
          case 3:
            var generateBook = (stepDirection == 'forward') ? true:false;
            updateBookOptions(generateBook);
            break;
        }
      });

      $('.restart_wizard').click(function() {
        if (confirm("Do you really want to delete all your changes and restart the wizard?")) {
          location.reload();
        }
      });

      function resetAllOptions() {
        $('#section-last-index').val(0);
        $('#image-size').val(100);
        $('.image-position .btn').removeClass('btn-primary').addClass('btn-light');
        $('.image-position .btn[rel=5]').removeClass('btn-light').addClass('btn-primary');
        $('#addHeader').prop("checked", false);
        $('#addFooter').prop("checked", false);
        $('#addPageNumber').prop("checked", false);
        $('#addBlankPages').prop("checked", false);
        $('#addCopyright').prop("checked", false);
      }

      resetAllOptions();

      @include('wizard.steps.1.options_jsdr')

      @include('wizard.steps.2.upload_jsdr')

      @include('wizard.steps.3.preview_jsdr')

      @include('wizard.modal.load_content_jsdr')

    });


    function showExpiredAccountError() {
      $('#denyMessage').html("{{ config('bookstrap-constants.DENIES.EXPIRED_ACCOUNT.message') }}");
      $('#showAlertDeny').modal('show');
    }

  </script>

@endsection
