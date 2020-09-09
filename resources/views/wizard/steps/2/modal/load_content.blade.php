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
          <div class="modal-body">
              <input type="hidden" id="modalAffectedSection" value="">
              <div data-scroll="true" data-height="250">
                @include('wizard.steps.2.modal.partials.content_menu')
              </div>
              <div class="tab-content">
                {{-- begin::Sudoku --}}
                <div class="tab-pane fade" id="sudoku_options" role="tabpanel" aria-labelledby="sudoku-tab">
                  @include('wizard.steps.2.modal.partials.sudoku_options')
                </div>
                {{-- end::Sudoku --}}
                {{-- begin::Coming soon --}}
                <div class="tab-pane fade" id="coming_soon" role="tabpanel" aria-labelledby="coming-soon-tab">
                  @include('wizard.steps.2.modal.partials.coming_soon')
                </div>
                {{-- end::Coming soon --}}
              </div>
          </div>
        </div>
    </div>
</div>
