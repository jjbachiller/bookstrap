@extends('layouts.app')

@section('title', 'Book Wizard')

@section('extra_css')
  <link href="https://cdn.jsdelivr.net/npm/smartwizard@5.0.0/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

  <style media="screen">

    .sw-theme-dots > .nav::before {
      background: #f5f5f5;
    }

    .sw-theme-dots > .nav .nav-link.done::after {
      background: #fde0e8;
    }

    .sw-theme-dots > .nav .nav-link.done {
      color: #f6648c;
    }

  </style>

  <link href="{{ asset('css/open-iconic/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet" />

  @include('wizard.steps.2.upload_css')
  @include('wizard.steps.3.preview_css')
@endsection

@section('content')
    <div id="smartwizard">
      <ul class="nav">
         <li>
             <a class="nav-link" href="#step-1">
                <strong>Step 1</strong>
                <br>
                Book Options
             </a>
         </li>
         <li>
             <a class="nav-link" href="#step-2">
                <strong>Step 2</strong>
                <br>
                Add Sections
             </a>
         </li>
         <li>
             <a class="nav-link" href="#step-3">
                <strong>Step 3</strong>
                <br>
                Book Preview
             </a>
         </li>
         <li>
             <a class="nav-link" href="#step-4">
                <strong>Step 4</strong>
                <br>
                File Options
             </a>
         </li>
         <li>
             <a class="nav-link" href="#step-5">
                <strong>Step 5</strong>
                <br>
                Download your file
             </a>
         </li>
      </ul>

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

    </div>
@endsection

@section('extra_js')

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
        theme: 'dots',
        justified: true,
        enableURLhash: false,
        keyboardSettings: {
          keyNavigation: false,
        },
        toolbarSettings: {
          toolbarExtraButtons: [
            $('<button/>').html('<span class="oi oi-reload"></span> Restart wizard')
              .addClass('btn btn-warning restart_wizard float-left')
          ]
        }
      });

      function bookGenerated() {
        $('#creating_container').addClass('d-none');
        $('#reload_container').removeClass('d-none');
      }

      function bookGenerationReset() {
        $('#creating_container').removeClass('d-none');
        $('#reload_container').addClass('d-none');
        $('#download_container').addClass('d-none');
        $('#error_container').addClass('d-none');
        $('#creator-register-form').addClass('d-none');
      }

      function bookGeneratedSuccess(url) {
        bookGenerated();
        $('#book_link').attr('href', url);
        $('#download_container').removeClass('d-none');
        $('#creator-register-form').removeClass('d-none');
      }

      function bookGeneratedError() {
        bookGenerated();
        $('#error_container').removeClass('d-none');
      }

      function getBookSections() {
        var sections = [];
        $("#Sections .section-block").each(function(index) {
            var section = {};
            section.folder = $(this).find("input.section-index").val();
            section.addTitle = $(this).find(".addSectionTitle").is(':checked');
            section.title = $(this).find(".section-title-input").val();
            section.imageNameAsTitle = $(this).find(".imageNameAsTitle").is(':checked');
            section.addTitleHeader = $(this).find(".addTitleHeader").is(':checked');
            section.imagesPerPage = $(this).find(".imagesPerPage").val();
            // Solutions fields
            section.addSolutionsTitle = $(this).find(".addSolutionTitle").is(':checked');
            section.solutionsTitle = $(this).find(".section-title-solutions-input").val();
            section.solutionNameAsTitle = $(this).find(".imageNameAsTitleSolution").is(':checked');
            section.solutionsHeader = $(this).find(".addTitleHeaderSolution").is(':checked');
            section.solutionsPerPage = $(this).find(".solutionsPerPage").val();
            section.solutionsToTheEnd = $(this).find(".placeSolutionsAtTheEnd").is(':checked');
            sections.push(section);
        });
        return sections;
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

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // Wizard config and requests logic
      $("#smartwizard").on("stepContent", function(e, anchorObject, stepIndex, stepDirection) {
        if ((stepIndex == 2) && (stepDirection == 'forward')) {
          loadPreviewContent();
        }
        if (stepIndex == 4) {

          bookGenerationReset();

          var data = {
            size: $('#book-size').val(),
            user: $('#user').val(),
            copyright: getCopyright(),
            sections: getBookSections(),
            imageSize: $("#image-size").val(),
            imagePosition: $("#image-position").find(".btn-primary").attr('rel'),
            header: getBookHeader(),
            footer: getBookFooter(),
            pageNumber: getBookPageNumber(),
            addBlankPages: $('#addBlankPages').is(':checked'),
            fullBleed: $('#fullBleed').is(':checked'),
            totalPages: $('#total-pages').val(),
            filetype: $("input[name='book_filetype']:checked").val(),
            filename: $("input[name='book_filename']").val(),
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

    });

  </script>

@endsection
