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
              <div data-scroll="true" data-height="300">
                <div class="row">
                  {{-- begin::Jigsaw --}}
                  <div class="col-md-3 col-xxl-3 col-lg-3">
                    <div class="car card-custom card-shadowless">
                      <div class="card-body p-0">
                        {{-- begin::Image --}}
                        <div class="overlay">
                          <div class="overlay-wrapper rounded bg-light text-center p-5 bg-hover-light-primary">
                            <img class="mw-50 w-150px" src="{{ asset('media/categories/jigsaw3.png') }}">
                          </div>
                        </div>
                        {{-- end::Image --}}
                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                          <a class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1" href="#">Jigsaw</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- end::Jigsaw --}}
                  {{-- begin::Coloring --}}
                  <div class="col-md-3 col-xxl-3 col-lg-3">
                    <div class="car card-custom card-shadowless">
                      <div class="card-body p-0">
                        {{-- begin::Image --}}
                        <div class="overlay">
                          <div class="overlay-wrapper rounded bg-light text-center p-5 bg-hover-light-primary">
                            <img class="mw-50 w-150px" src="{{ asset('media/categories/coloring1.png') }}">
                          </div>
                        </div>
                        {{-- end::Image --}}
                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                          <a class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1" href="#">Coloring</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- end::Coloring --}}
                  {{-- begin::Activity --}}
                  <div class="col-md-3 col-xxl-3 col-lg-3">
                    <div class="car card-custom card-shadowless">
                      <div class="card-body p-0">
                        {{-- begin::Image --}}
                        <div class="overlay">
                          <div class="overlay-wrapper rounded bg-light text-center p-5 bg-hover-light-primary">
                            <img class="mw-50 w-150px" src="{{ asset('media/categories/activity1.png') }}">
                          </div>
                        </div>
                        {{-- end::Image --}}
                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                          <a class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1" href="#">Activities</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- end::Activity --}}
                  {{-- begin::Journal --}}
                  <div class="col-md-3 col-xxl-3 col-lg-3">
                    <div class="car card-custom card-shadowless">
                      <div class="card-body p-0">
                        {{-- begin::Image --}}
                        <div class="overlay">
                          <div class="overlay-wrapper rounded bg-light text-center p-5 bg-hover-light-primary">
                            <img class="mw-50 w-150px" src="{{ asset('media/categories/journal1.png') }}">
                          </div>
                        </div>
                        {{-- end::Image --}}
                        <div class="text-center mt-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column">
                          <a class="font-size-h5 font-weight-bolder text-dark-75 text-hover-primary mb-1" href="#">Journal</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- end::Journal --}}
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
