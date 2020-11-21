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
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/6EbYJSThKKg"></iframe>
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
                <p class="text-dark-50 font-size-lg">Just 5 simple steps, from Book Options to downloading your Master Piece</p>
                <ul class="text-left ml-6">
                  <li>Select type of book and size</li>
                  <li>Create your interior book sections</li>
                  <li>Preview your book and make final customizations</li>
                  <li>Select file option to generate book from .pdf or .pptx</li>
                  <li>Download your creation</li>
                </ul>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Super Rich Content Library!</h2>
                <ul class="text-left ml-6">
                  <li>
                    <div>
                      <p class="text-dark-50 font-size-lg">15 Different Japanese Puzzles</p>
                      <span class="label label-info label-inline m-2">Akari</span>
                      <span class="label label-info label-inline m-2">Domino</span>
                      <span class="label label-info label-inline m-2">Fillomino</span>
                      <span class="label label-info label-inline m-2">Futoshiki</span>
                      <span class="label label-info label-inline m-2">Gokigen</span>
                      <span class="label label-info label-inline m-2">Kakuro</span>
                      <span class="label label-info label-inline m-2">Kendoku</span>
                      <span class="label label-info label-inline m-2">Killer Sudoku</span>
                      <span class="label label-info label-inline m-2">Marupeke</span>
                      <span class="label label-info label-inline m-2">Minesweeper</span>
                      <span class="label label-info label-inline m-2">Roundabouts</span>
                      <span class="label label-info label-inline m-2">Sikaku</span>
                      <span class="label label-info label-inline m-2">Slitherlink</span>
                      <span class="label label-info label-inline m-2">Sudoku</span>
                      <span class="label label-info label-inline m-2">Tatami</span>
                      <span class="label label-info label-inline m-2">Tents</span>
                    </div>
                  </li>
                  <li>
                    <div>
                      <p class="text-dark-50 font-size-lg">Mazes</p>
                      <span class="label label-success label-inline m-2">Tubular</span>
                      <span class="label label-success label-inline m-2">Squared</span>
                      <span class="label label-success label-inline m-2">Themed</span>
                    </div>
                  </li>
                  <li class="text-dark-50 font-size-lg">Drawing Grids</li>
                  <li class="text-dark-50 font-size-lg">Drawing & Coloring Grids</li>
                  <li class="text-dark-50 font-size-lg">Word Scrambles</li>
                  <li>
                    <div>
                      <p class="text-dark-50 font-size-lg">Low Content</p>
                      <span class="label label-primary label-inline m-2">Coloring Books</span>
                      <span class="label label-primary label-inline m-2">Comic Books</span>
                      <span class="label label-primary label-inline m-2">Activity Books</span>
                      <span class="label label-primary label-inline m-2">Journals</span>
                      <span class="label label-primary label-inline m-2">Notebooks</span>
                      <span class="label label-primary label-inline m-2">Log Books</span>
                      <span class="label label-primary label-inline m-2">etc.</span>
                    </div>
                  </li>
                  <li>
                    <div>
                      <p class="text-dark-50 font-size-lg">No Content</p>
                      <span class="label label-warning label-inline m-2">Blank Drawing Books</span>
                      <span class="label label-warning label-inline m-2">Lined Journals</span>
                      <span class="label label-warning label-inline m-2">Music Sheets</span>
                      <span class="label label-warning label-inline m-2">Journals</span>
                      <span class="label label-warning label-inline m-2">Notebooks</span>
                      <span class="label label-warning label-inline m-2">Log Books</span>
                      <span class="label label-warning label-inline m-2">etc.</span>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/course.png') }}" alt="Rich content library">
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/strugle.png') }}" alt="Stop Struggling">
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Stop Struggling!</h2>
                <p class="text-dark-50 font-size-lg">To Find Content For Your Projects.</p>
                <ul class="text-left ml-6">
                  <li>Use Our Extensive Cloud Based Library. Alwasy adding more.</li>
                  <li>Discover Where You Can Find Even More Content</li>
                </ul>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Honestly The Only Tool You Will Ever Need...!</h2>
                <p class="text-dark-50 font-size-lg">The Perfect Swiss Army Knikfe</p>
                <ul class="text-left ml-6">
                  <li>For Creating and Generating Your KDP Paperback Books.</li>
                  <li>For Creating and Generating Your Printables for Etsy and Your Own Website.</li>
                </ul>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/tools.png') }}" alt="The only tools you need">
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 d-flex align-items-center justify-content-sm-center">
                <img src="{{ asset('/media/img/easy.png') }}" alt="Stop Struggling">
              </div>
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Very Simple, Intuitive and Easy To Use</h2>
                <p class="text-dark-50 font-size-lg">Can You Follow Simple Instructions...</p>
                <ul class="text-left ml-6">
                  <li>Step One: Select Your Book Options.</li>
                  <li>Step Two: Add A Book Section or Sections.</li>
                  <li>Step Three: Preview Your Book and Tweak How It Will Look.</li>
                  <li>Step Four: Select File Option To Generate (.pdf or .pptx).</li>
                  <li>Step Five: Download Your Creation.</li>
                </ul>
              </div>
            </div>
            <div class="row justify-content-center my-20">
              <div class="col-sm-6 text-center">
                <h2 class="text-dark mb-4">Your Projects Are Stored in The Cloud</h2>
                <p class="text-dark-50 font-size-lg">Save Space and Clutter on Your Computer</p>
                <p class="text-dark-50 font-size-lg">Access Your Files From Anywhere on Any Device.</p>
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
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/media/img/screenshot3.png') }}" alt="Third slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('/media/img/screenshot4.png') }}" alt="Four slide">
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
                {{-- <div class="col-lg-3">
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
                </div> --}}

                <div class="col-lg-11">
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
                                        <div class="card-label text-dark pl-4">Do you offer refunds?</div>
                                    </a>
                                  </div>
                                  <div id="faq1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        No. You have a full 7 day trial before your subscription starts.<br>
                                        This will give you plenty of time to evaluate whether Bookstrap fits your requirements
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
                                          <div class="card-label text-dark pl-4">What happens if I cancel my subscription?</div>
                                      </a>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faq">
                                        <div class="card-body text-dark-50 font-size-lg pl-12">
                                          You will have access upto and including the date your subscription started.<br>
                                          Example: If your subscription started on the 24th of the month and you cancel on the 23rd; you will 1 day left before access is restricted.
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
                                          <div class="card-label text-dark pl-4">What happens to my files when I cancel my subscription?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Your books will be available to download in both formats upto and including the last day of your subscription.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading4">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq4" aria-expanded="false" aria-controls="faq4" role="button">
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
                                          <div class="card-label text-dark pl-4">What happens if I do not renew my subscription?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq4" class="collapse" aria-labelledby="faqHeading4" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Your books will remain on the server for 30 days after your subscription expires, This will give you time to renew without losing your Books.<br>
                                        After the 30 days all your books will be permanently deleted and membership terminated.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading5">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq5" aria-expanded="false" aria-controls="faq5" role="button">
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
                                          <div class="card-label text-dark pl-4">Can I sell the Books as Printables I create?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Absolutely. You just can not offer them as PLR or other types of packages to other vendors.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading6">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq6" aria-expanded="false" aria-controls="faq6" role="button">
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
                                          <div class="card-label text-dark pl-4">What License rights do I have?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq6" class="collapse" aria-labelledby="faqHeading6" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Commercial Use and Personal Use ONLY. You can use Bookstrap for your own Personal Use and to compile Paperback Books for your clients.<br>
                                        You have all rights to sell your creations/compilations in any ethical manner without restrictions except the following: You DO NOT have PLR Rights to sell to other authors.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading7">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq7" aria-expanded="false" aria-controls="faq7" role="button">
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
                                          <div class="card-label text-dark pl-4">Is your software Newbie friendly?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq7" class="collapse" aria-labelledby="faqHeading7" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Yes. Watch the training videos before seding in a support ticket.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading8">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq8" aria-expanded="false" aria-controls="faq8" role="button">
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
                                          <div class="card-label text-dark pl-4">Do You Provide Support & Training?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq8" class="collapse" aria-labelledby="faqHeading8" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Support & Training is provided through the Private Facebook Group
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading9">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq9" aria-expanded="false" aria-controls="faq9" role="button">
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
                                          <div class="card-label text-dark pl-4">Do I need to buy any other software to make this work?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq9" class="collapse" aria-labelledby="faqHeading9" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Absolutely not. Although if you feel you have to then that is your decision to do so and not a prerequisite.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading10">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq10" aria-expanded="false" aria-controls="faq10" role="button">
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
                                          <div class="card-label text-dark pl-4">Do you have an Affiliate Program to sell Bookstrap?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq10" class="collapse" aria-labelledby="faqHeading10" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Not at this point in time.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading11">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq11" aria-expanded="false" aria-controls="faq11" role="button">
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
                                          <div class="card-label text-dark pl-4">Is Bookstrap available in other languages?</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq11" class="collapse" aria-labelledby="faqHeading11" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Not at this point in time.
                                      </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="card border-top-0">
                                    <!--begin::Header-->
                                    <div class="card-header" id="faqHeading12">
                                        <div class="card-title collapsed text-dark" data-toggle="collapse" data-target="#faq12" aria-expanded="false" aria-controls="faq12" role="button">
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
                                          <div class="card-label text-dark pl-4">Who is behind Bookstrap.io</div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="faq12" class="collapse" aria-labelledby="faqHeading12" data-parent="#faq">
                                      <div class="card-body text-dark-50 font-size-lg pl-12">
                                        Ron Pumfleet (coder and KDP author)<br>
                                        Juan Bachiller (Head Programmer)
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
                  <span class="pr-2 font-size-h3 text-muted font-weight-bold" style="text-decoration: line-through;">19.99</span>
                  <span class="pr-2 font-size-h1 font-weight-bold">9.99</span>
                  <span class="opacity-70">/&nbsp;&nbsp;Per Month</span>
                </span>
                <br>
                <p class="mb-10 d-flex flex-column text-dark-50">
                  <span>Unlimited Downloads</span>
                  <span>250 MBytes of disk quota</span>
                  <span>Books up to 200 pages</span>
                  <span>Up to 1,500 pages in total</span>
                  <span>Unlimited access to library content</span>
                </p>
                <a href="https://puzzlebookcompiler.com/members/product/LCBW-Starter" target="_blank" type="button" class="btn btn-primary text-uppercase font-size-lg font-weight-bolder px-15 py-3">Subscribe</a>
              </div>
            </div>
      			<!-- end: Pricing-->

    			<!-- begin: Pricing-->
    			<div class="col-md-4 col-xxl-3 bg-primary my-md-n15 rounded shadow-sm">
    				<div class="pt-25 pt-md-37 pb-25 pb-md-10 py-md-28 px-4">
    					<h4 class=" text-white mb-15">Silver</h4>
    					<span class="px-7 py-3 bg-white d-inline-flex flex-center rounded-lg mb-15 bg-white">
    						<span class="pr-2 text-primary opacity-70">$</span>
                <span class="pr-2 font-size-h3 text-muted font-weight-bold" style="text-decoration: line-through;">39.99</span>
    						<span class="pr-2 font-size-h1 font-weight-bold text-primary">19.99</span>
    						<span class="text-primary opacity-70">/&nbsp;&nbsp;Per Month</span>
    					</span>
    					<br>
    					<p class="text-white mb-10 d-flex flex-column">
                <span>Unlimited Downloads</span>
                <span>1 GByte of disk quota</span>
                <span>Books up to 350 pages</span>
                <span>Up to 5,600 pages in total</span>
                <span>Unlimited access to library content</span>
    					</p>
    					<a href="https://puzzlebookcompiler.com/members/product/LCBW-Silver" target="_blank" type="button" class="btn btn-white text-uppercase font-size-lg font-weight-bolder px-15 py-3">Subscribe</a>
    				</div>
    			</div>
    			<!-- end: Pricing-->

    			<!-- begin: Pricing-->
    			<div class="col-md-4 col-xxl-3 bg-white rounded-right shadow-sm">
    				<div class="pt-25 pb-25 pb-md-10 px-4">
    					<h4 class=" mb-15">Gold</h4>
    					<span class="px-7 py-3 d-inline-flex flex-center rounded-lg mb-15 bg-primary-o-10">
    						<span class="pr-2 opacity-70">$</span>
    						<span class="pr-2 font-size-h1 font-weight-bold">39.99</span>
    						<span class="opacity-70">/&nbsp;&nbsp;Per Month</span>
    					</span>
    					<br>
    					<p class="mb-10 d-flex flex-column text-dark-50">
                <span>Unlimited Downloads</span>
                <span>5 GByte of disk quota</span>
                <span>Books up to 550 pages</span>
                <span>Up to 40,000 pages in total</span>
                <span>Unlimited access to library content</span>
    					</p>
    					<a href="https://puzzlebookcompiler.com/members/product/LCBW-Gold" target="_blank" type="button" class="btn btn-primary text-uppercase font-size-lg font-weight-bolder px-15 py-3">Subscribe</a>
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
                <a href="#" class="text-white font-weight-bolder font-size-h3">Create a Starter Account</a>
                <p class="text-white opacity-75 font-weight-bold mt-3">
                    Temporarily you can create a starter account to test Bookstrap for a really cheap price.
                </p>
              </div>
              <a href="https://puzzlebookcompiler.com/members/product/LCBW-Starter" target="_blank" class="btn btn-link btn-link-white font-weight-bold">
                Create a Starter Account
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

    <!-- Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">


          <div class="modal-body">

           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <!-- 16:9 aspect ratio -->
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/OlUIEWUaB2s" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
            </div>

          </div>

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

        $('#videoModal').on('shown.bs.modal', function(e) {
          $('#kt_quick_user').removeClass('offcanvas-on');
        });

        $('#videoModal').on('hide.bs.modal', function(e) {
          $('#video').attr('src', $('#video').attr('src'));
        });

      });

    </script>
@endsection
