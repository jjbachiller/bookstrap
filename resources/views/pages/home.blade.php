{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Home --}}
    <header class="mt-12">
      <div class="container">
        <div class="row align-items-center h-100">
          <div class="col-lg-5">
            <h1 class="display-4 text-dark font-weight-bolder">
                Bookstrap
            </h1>
            <p>All you need to create low content books</p>
            <a href="#pricing" class="btn btn-lg btn-success btn-shadow-hover font-weight-bolder py-3">Get Started</a>
            <a href="#benefits" class="btn btn-lg btn-outline-success btn-shadow-hover font-weight-bolder py-3">Features</a>
          </div>
          <div class="col-lg-6 ml-auto">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://youtu.be/6EbYJSThKKg"></iframe>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="card card-custom gutter-b mt-12" id="benefits">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="icon-2x text-danger flaticon-black"></i></span>
                <h3 class="card-label">Awesome Benefits!</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/speed1.png') }}" alt="Super fast content generation">
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Super Fast!</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Rich content library</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/course.png') }}" alt="Rich content library">
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/strugle.png') }}" alt="Stop Strugling">
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Stop Strugling!</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">The only tool you need</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/tools.png') }}" alt="The only tools you need">
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/easy.png') }}" alt="Stop Strugling">
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Intuitive and easy to use</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Different filetypes generation</h2>
                <p class="text-dark-50 font-size-lg">Lorem ipsum dolor sit amet</p>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/download.png') }}" alt="Different formats accesible">
              </div>
            </div>
        </div>
    </div>

    <div class="card card-custom gutter-b mt-12" id="features">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="icon-2x text-warning flaticon2-box"></i></span>
                <h3 class="card-label">Amazing Features!</h3>
            </div>
        </div>
        <div class="card-body">
          <div class="row my-20">
            <div class="col-sm-7 d-flex justify-content-center align-items-center">
              <div id="carouselScreenshot" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselScreenshot" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselScreenshot" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('/media/img/screenshot1.png') }}" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/media/img/screenshot2.png') }}" alt="Second slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselScreenshot" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselScreenshot" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="d-flex align-items-center">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-success align-self-stretch mr-6">
                </span>
                <!--end::Bullet-->

                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                        Ready for KDP content
                    </a>
                    <span class="text-muted font-weight-bold">
                        auto-calculate margins, kdp book sizes,...
                    </span>
                </div>
                <!--end::Text-->
              </div>

              <div class="d-flex align-items-center mt-10">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-success align-self-stretch mr-6">
                </span>
                <!--end::Bullet-->

                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                        Organized content
                    </a>
                    <span class="text-muted font-weight-bold">
                        Create independently formated sections
                    </span>
                </div>
                <!--end::Text-->
              </div>

              <div class="d-flex align-items-center mt-10">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-success align-self-stretch mr-6">
                </span>
                <!--end::Bullet-->

                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                        Puzzle + Solutions easily created
                    </a>
                    <span class="text-muted font-weight-bold">
                        Associate a puzzle content with their solutions.
                    </span>
                </div>
                <!--end::Text-->
              </div>

              <div class="d-flex align-items-center mt-10">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-success align-self-stretch mr-6">
                </span>
                <!--end::Bullet-->

                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                        Use our library of content or upload yours
                    </a>
                    <span class="text-muted font-weight-bold">
                        You can use and merge any content on a book.
                    </span>
                </div>
                <!--end::Text-->
              </div>

              <div class="d-flex align-items-center mt-10">
                <!--begin::Bullet-->
                <span class="bullet bullet-bar bg-success align-self-stretch mr-6">
                </span>
                <!--end::Bullet-->

                <!--begin::Text-->
                <div class="d-flex flex-column flex-grow-1">
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mb-1">
                        PPTX or PDF available download
                    </a>
                    <span class="text-muted font-weight-bold">
                        Download your generated book for edition (PPTX) or aPDF ready to upload to KDP withour errors.
                    </span>
                </div>
                <!--end::Text-->
              </div>

            </div>
          </div>
        </div>
    </div>

    <div class="card card-custom gutter-b mt-12" id="FAQ">
      <div class="card-header">
          <div class="card-title">
              <span class="card-icon"><i class="icon-xl fab fa-pied-piper-pp text-success"></i></span>
              <h3 class="card-label">FAQ</h3>
          </div>
      </div>
      <div class="card-body">
        <div class="row">
                <div class="col-lg-3">
                    <!--begin::Navigation-->
                    <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0" role="tablist">
                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" data-toggle="tab" href="#">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">Bookstrap Use</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link active" data-toggle="tab" href="#">
                                <span class="navi-text text-dark font-size-h5 font-weight-bold">Subscription</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" data-toggle="tab" href="#">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">Product Support</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" data-toggle="tab" href="#">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">Theme 4</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" data-toggle="tab" href="#">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">Theme 5</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                        <!--begin::Nav Item-->
                        <li class="navi-item mb-2">
                            <a class="navi-link" data-toggle="tab" href="#">
                                <span class="navi-text text-dark-50 font-size-h5 font-weight-bold">...</span>
                            </a>
                        </li>
                        <!--end::Nav Item-->

                    </ul>
                    <!--end::Navigation-->
                </div>

                <div class="col-lg-9">
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Accordion-->
                        <div class="accordion accordion-light accordion-light-borderless accordion-svg-toggle" id="faq">
                            <!--begin::Item-->
                            <div class="card">
                                <div class="card-header" id="faqHeading1">
                                    <a class="card-title text-dark" data-toggle="collapse" href="#faq1" aria-expanded="true" aria-controls="faq1" role="button">
                                        <span class="svg-icon svg-icon-primary">
                                          <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                              <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                              <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                              <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                            </g>
                                          </svg>
                                          <!--end::Svg Icon-->
                                        </span>
                                        <div class="card-label text-dark pl-4">How does it work?</div>
                                    </a>
                                  </div>
                                  <div id="faq1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                          Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                  </div>
                              </div>
                              <!--end::Item-->

                              <!--begin::Item-->
                              <div class="card border-top-0">
                                  <!--begin::Header-->
                                  <div class="card-header" id="faqHeading2">
                                      <a class="card-title collapsed text-dark" data-toggle="collapse" href="#faq2" aria-expanded="false" aria-controls="faq2" role="button">
                                          <span class="svg-icon svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                              </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                          </span>
                                          <div class="card-label text-dark pl-4">Question 2?</div>
                                      </a>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading3">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq3" aria-expanded="false" aria-controls="faq3" role="button">
                                            <span class="svg-icon svg-icon-primary">
                                              <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-right.svg-->
                                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                  <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                  <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721  L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                                                  <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378   L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
                                                </g>
                                              </svg>
                                              <!--end::Svg Icon-->
                                            </span>
                                          <div class="card-label text-dark pl-4">Question 3?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->
                        </div>
                        <!--end::Accordion-->
                    </div>
                    <!--end::Tab Content-->
                </div>
            </div>
      </div>
    </div>


    <div class="card card-custom gutter-b mt-12" id="pricing">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon"><i class="icon-xl fas fa-unlock-alt text-primary"></i></span>
                <h3 class="card-label">Pricing</h3>
            </div>
        </div>
        <div class="card-body">
          <div class="row justify-content-center text-center my-0 my-md-25">
      			<!-- begin: Pricing-->
            <div class="col-md-4 col-xxl-3 bg-white rounded-right shadow-sm">
              <div class="pt-25 pb-25 pb-md-10 px-4">
                <h4 class=" mb-15">Starter</h4>
                <span class="px-7 py-3 d-inline-flex flex-center rounded-lg mb-15 bg-primary-o-10">
                  <span class="pr-2 opacity-70">$</span>
                  <span class="pr-2 font-size-h1 font-weight-bold">9.99</span>
                  <span class="opacity-70">/&nbsp;&nbsp;Per Month</span>
                </span>
                <br>
                <p class="mb-10 d-flex flex-column text-dark-50">
                  <span>Lorem ipsum dolor sit amet adipiscing elit</span>
                  <span>sed do eiusmod tempors labore et dolore</span>
                  <span>magna siad enim aliqua</span>
                </p>
                <a href="https://puzzlebookcompiler.com/members/product/LCBW-Gold" type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Subscribe</a>
              </div>
            </div>
      			<!-- end: Pricing-->

    			<!-- begin: Pricing-->
    			<div class="col-md-4 col-xxl-3 bg-primary my-md-n15 rounded shadow-sm">
    				<div class="pt-25 pt-md-37 pb-25 pb-md-10 py-md-28 px-4">
    					<h4 class=" text-white mb-15">Silver</h4>
    					<span class="px-7 py-3 bg-white d-inline-flex flex-center rounded-lg mb-15 bg-white">
    						<span class="pr-2 text-primary opacity-70">$</span>
    						<span class="pr-2 font-size-h1 font-weight-bold text-primary">29.99</span>
    						<span class="text-primary opacity-70">/&nbsp;&nbsp;Per Month</span>
    					</span>
    					<br>
    					<p class="text-white mb-10 d-flex flex-column">
    						<span>Lorem ipsum dolor sit amet adipiscing elit</span>
    						<span>sed do eiusmod tempors labore et dolore</span>
    						<span>magna siad enim aliqua</span>
    					</p>
    					<a href="https://puzzlebookcompiler.com/members/product/LCBW-Silver" type="button" class="btn btn-white text-uppercase font-weight-bolder px-15 py-3">Subscribe</a>
    				</div>
    			</div>
    			<!-- end: Pricing-->

    			<!-- begin: Pricing-->
    			<div class="col-md-4 col-xxl-3 bg-white rounded-right shadow-sm">
    				<div class="pt-25 pb-25 pb-md-10 px-4">
    					<h4 class=" mb-15">Gold</h4>
    					<span class="px-7 py-3 d-inline-flex flex-center rounded-lg mb-15 bg-primary-o-10">
    						<span class="pr-2 opacity-70">$</span>
    						<span class="pr-2 font-size-h1 font-weight-bold">59.99</span>
    						<span class="opacity-70">/&nbsp;&nbsp;Per Month</span>
    					</span>
    					<br>
    					<p class="mb-10 d-flex flex-column text-dark-50">
    						<span>Lorem ipsum dolor sit amet adipiscing elit</span>
    						<span>sed do eiusmod tempors labore et dolore</span>
    						<span>magna siad enim aliqua</span>
    					</p>
    					<a href="https://puzzlebookcompiler.com/members/product/LCBW-Gold" type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Subscribe</a>
    				</div>
    			</div>
    			<!-- end: Pricing-->
    		</div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12">
        <!--begin::Tiles Widget 25-->
        <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-primary" style="height: 250px; background-image: url(media/svg/patterns/taieri.svg)">
          <div class="card-body d-flex">
            <div class="d-flex py-5 flex-column align-items-start flex-grow-1">
              <div class="flex-grow-1">
                <a href="#" class="text-white font-weight-bolder font-size-h3">Create a Free Account</a>
                <p class="text-white opacity-75 font-weight-bold mt-3">
                    Temporarily you can create a free account to test Bookstrap.
                </p>
              </div>
              <a href="https://puzzlebookcompiler.com/members/product/LCBW-Free" class="btn btn-link btn-link-white font-weight-bold">
                Create a Free Account
                <span class="svg-icon svg-icon-lg svg-icon-white">
                  <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <polygon points="0 0 24 0 24 24 0 24"></polygon>
                      <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) " x="11" y="5" width="2" height="14" rx="1"></rect>
                      <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-  rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997) "></path>
                    </g>
                  </svg>
                  <!--end::Svg Icon-->
                </span>
              </a>
            </div>
          </div>
        </div>
        <!--end::Tiles Widget 25-->
      </div>
    </div>

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
@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{-- <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script> --}}

    <script type="text/javascript">

      $(document).ready(function () {

        $(document).on('click', 'a[href^="#"]', function (e) {
            e.preventDefault();
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 1000, 'linear');
        });

        $('.contactModalTrigger a').on('click', function() {
          $('#contactModal').modal('show');
        });

      });

    </script>
@endsection
