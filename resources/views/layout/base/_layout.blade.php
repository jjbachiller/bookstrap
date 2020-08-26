@if(config('layout.self.layout') == 'blank'  || isset($fullLayout))
    <div class="d-flex flex-column flex-root">
        @yield('content')
    </div>
@else

    @include('layout.base._header-mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            @if(config('layout.aside.self.display'))
                @include('layout.base._aside')
            @endif

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('layout.base._header')

                <div class="content {{ Metronic::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">

                    @if(config('layout.subheader.display'))
                        @if(array_key_exists(config('layout.subheader.layout'), config('layout.subheader.layouts')))
                            @include('layout.partials.subheader._'.config('layout.subheader.layout'))
                        @else
                            @include('layout.partials.subheader._'.array_key_first(config('layout.subheader.layouts')))
                        @endif
                    @endif

                    @include('layout.base._content')
                </div>


                <!--begin::ContactForm-->
                <div class="modal fade" id="contactModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                   Send us your enquiries
                                 </h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <i aria-hidden="true" class="ki ki-close"></i>
                                 </button>
                            </div>
                            <!--begin::Form-->
                            <form class="form">
                              <div class="modal-body">
                                <!--begin::Input-->
                                <div class="form-group">
                                  <label>Name</label>
                                  <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Enter your name">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <div class="form-group">
                                  <label>Phone</label>
                                  <input type="text" class="form-control form-control-solid form-control-lg" placeholder="Enter your phone">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <div class="form-group">
                                  <label>Email address</label>
                                  <input type="email" class="form-control form-control-solid form-control-lg" placeholder="Enter email">
                                </div>
                                <!--end::Input-->

                                <!--begin::Input-->
                                <div class="form-group">
                                  <label for="exampleTextarea">Your Message</label>
                                  <textarea class="form-control form-control-solid form-control-lg" id="exampleTextarea" rows="3"></textarea>
                                  <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--begin::Actions-->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                              <button type="reset" class="btn btn-primary font-weight-bold mr-2">Submit</button>
                            </div>
                            <!--end::Actions-->
                          </form>
                          <!--end::Form-->
                        </div>
                    </div>
                </div>
                <!--end::ContactForm-->


                @include('layout.base._footer')
            </div>
        </div>
    </div>

@endif

@if (config('layout.self.layout') != 'blank'  || !isset($fullLayout))

    @if (config('layout.extras.search.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-search')
    @endif

    @if (config('layout.extras.notifications.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-notifications')
    @endif

    @if (config('layout.extras.quick-actions.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-actions')
    @endif

    @if (config('layout.extras.user.layout') == 'offcanvas')
        @include('layout.partials.extras.offcanvas._quick-user')
    @endif

    @if (config('layout.extras.quick-panel.display'))
        @include('layout.partials.extras.offcanvas._quick-panel')
    @endif

    @if (config('layout.extras.toolbar.display'))
        @include('layout.partials.extras._toolbar')
    @endif

    @if (config('layout.extras.chat.display'))
        @include('layout.partials.extras._chat')
    @endif

    @include('layout.partials.extras._scrolltop')

@endif
