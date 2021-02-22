<!-- Modal-->
<div class="modal fade" id="loadContentFromLibrary" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Select the type of content</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <i aria-hidden="true" class="ki ki-close"></i>
              </button>
          </div>
          <div id="load-content-window" class="modal-body container-fluid">
            <div id="load-content-steps" class="w-100" style="height: 550px; overflow: hidden">



              <!-- MOVE THIS INTO THE FORM, WHO IS USING THIS ONE?? -->
              <input type="hidden" id="modalAffectedSection" value="">



              <div id="content-categories" class="float-left w-100" data-scroll="true" data-height="550">
                @include('wizard.modal.partials.content_menu')
              </div>
              <div class="library-content float-left d-flex w-100" style="height: 550px;">
                @include('wizard.modal.partials.content_form')
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<form id='SelectedContentData'>
  <input type="hidden" id="SelectedContentType"/>
  <input type="hidden" id="SelectedDifficulty"/>
  <input type="hidden" id="SelectedAmount"/>
  <input type="hidden" id="SelectedHasSolutions"/>
</form>
