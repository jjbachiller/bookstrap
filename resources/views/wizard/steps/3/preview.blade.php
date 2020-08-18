<div class="book_options">

  <div class="row">

    <div class="col-md-10 mx-auto">

      <div class="form-group row">

        <div class="col-md-6 book-options-col image-options">

          <div class="row">
            <div class="col h-100">
              <div class="row">
                <label for="image-size">Image Size</label>
              </div>
              <div class="row d-flex justify-content-center">
                <input type="text" value="100" id="image-size" class="col-md-3 form-control">
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col h-100">

              <div class="row">
                <label for="image-position">Image position</label>
              </div>

              <div class="row d-flex justify-content-start">

                <div class="btn-group image-position" id="image-position">
                  <div class="btn-group-vertical">
                    <button type="button" class="btn btn-light" rel="1"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-light" rel="4"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-light" rel="7"><span class="oi oi-media-record"></span></button>
                  </div>
                  <div class="btn-group-vertical">
                    <button type="button" class="btn btn-light" rel="2"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-primary" rel="5"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-light" rel="8"><span class="oi oi-media-record"></span></button>
                  </div>
                  <div class="btn-group-vertical">
                    <button type="button" class="btn btn-light" rel="3"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-light" rel="6"><span class="oi oi-media-record"></span></button>
                    <button type="button" class="btn btn-light" rel="9"><span class="oi oi-media-record"></span></button>
                  </div>
                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="col-md-6 book-options-col">

          <div class="row">
            <div class="col h-100">
              <div class="row">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="addFooter">
                  <label class="custom-control-label" for="addFooter">Add footer</label>
                </div>
              </div>
              <div class="row d-none" id="footerOptions">
                <label for="footer">Footer</label>
                <input type="text" class="form-control" id="footer" aria-describedby="Footer text" maxlength="60" value="Footer Details">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col h-100">
              <div class="row">
                <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="addPageNumber">
                  <label class="custom-control-label" for="addPageNumber">Add page number</label>
                </div>
              </div>
              <div class="row d-none" id="pageNumberOptions">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option1" autocomplete="off" value="1"> Header
                  </label>
                  <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option2" autocomplete="off" value="2"> Footer
                  </label>
                  <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option3" autocomplete="off" value="3"> Both
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="addBlankPages">
              <label class="custom-control-label" for="addBlankPages">Add intermediate blank pages</label>
            </div>
          </div>

          <div class="row">
            <div class="custom-control custom-switch">
              <input type="checkbox" class="custom-control-input" id="fullBleed">
              <label class="custom-control-label" for="fullBleed">Full bleed images</label>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</div>

<div class="book_wrapper">
  <a id="next_page_button"></a>
  <a id="prev_page_button"></a>
  <div id="loading" class="loading">Loading pages...</div>
  <div id="mybook" style="display:none;">

  </div>
  <div id="mybook-blankpages" style="display:none;">

  </div>
  <div id="mybook-slider" class="d-none">

    <input id="bookPagination" data-slider-id='bookPaginationSlider' type="text"/>

  </div>
</div>

<input type="hidden" name="total-pages" id="total-pages" value="0">

<?php
/*  *** PAGES TEMPLATES *** */
?>

<div id="copyright-template" class="d-none">
  <div class="page">
    <div class="copyright-text">
      [COPYRIGHT]
    </div>
  </div>
</div>

<div id="page-template" class="d-none">
  <div class="page">
    <div class="d-inline page-header invisible">
      <span class="header-text">[HEADER]</span>
    </div>
    <div class="d-inline h-page-number page-number invisible">[PAGE_NUMBER]</div>
    <div class="page-content">
      <div class="title-content">
        <h1>[TITLE]</h1>
      </div>
      <div class="images-content">
        {{-- Here we'll load the correspondant images layout --}}
      </div>
    </div>
    <div class="d-inline page-footer invisible">
      <span class="footer-text">[FOOTER]</span>
    </div>
    <div class="d-inline f-page-number page-number invisible float-right">[PAGE_NUMBER]</div>
  </div>
</div>

<div class="images-layout d-none">
  {{-- 1 image per page --}}
  <div class="p-0 w-100 h-100 images-per-page-1">
    <div class="h-100 d-flex flex-column flex-nowrap justify-content-center">
      <div class="img-title-full title-1"></div>
      <img class="lazy w-100 img-fluid image-1 full"  data-src="[IMG_URL]" alt=""/>
    </div>
  </div>
  {{-- 2 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-2">
   <div class="h-50 d-flex flex-column flex-nowrap justify-content-center">
     <div class="img-title title-1"></div>
     <img class="lazy w-100 img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
   </div>
   <div class="h-50 d-flex flex-column flex-nowrap justify-content-center">
     <div class="img-title title-2"></div>
     <img class="lazy w-100 img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
   </div>
  </div>
   {{-- 3 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-3">
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-left">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-right">
      <div class="w-50 d-flex flex-column">
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-2"></div>
        <img class="lazy w-100 mini img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-left">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-3"></div>
        <img class="lazy w-100 mini img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
      </div>
    </div>
   </div>
   {{-- 4 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-4">
    <div class="h-50 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-1"></div>
        <img class="lazy w-100 img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-3"></div>
        <img class="lazy w-100 img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-50 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-2"></div>
        <img class="lazy w-100 img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-4"></div>
        <img class="lazy w-100 img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
   {{-- 5 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-5">
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-3"></div>
        <img class="lazy w-100 mini img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-100 d-flex flex-column">
        <div class="img-title-mini title-5"></div>
        <img class="lazy w-100 mini img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-2"></div>
        <img class="lazy w-100 mini img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-4"></div>
        <img class="lazy w-100 mini img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
   {{-- 6 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-6">
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-4"></div>
        <img class="lazy w-100 mini img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-2"></div>
        <img class="lazy w-100 mini img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-5"></div>
        <img class="lazy w-100 mini img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-3"></div>
        <img class="lazy w-100 mini img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-6"></div>
        <img class="lazy w-100 mini img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
   {{-- 7 to 8 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-7 images-per-page-8">
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-1"></div>
        <img class="lazy w-100 nano img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-5"></div>
        <img class="lazy w-100 nano img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-2"></div>
        <img class="lazy w-100 nano img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-6"></div>
        <img class="lazy w-100 nano img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-3"></div>
        <img class="lazy w-100 nano img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-7"></div>
        <img class="lazy w-100 nano img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-4"></div>
        <img class="lazy w-100 nano img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-8"></div>
        <img class="lazy w-100 nano img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
   {{-- 9 to 12 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-9 images-per-page-10 images-per-page-11 images-per-page-12">
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-1"></div>
        <img class="lazy w-100 nano img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-5"></div>
        <img class="lazy w-100 nano img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-9"></div>
        <img class="lazy w-100 nano img-fluid image-9"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-2"></div>
        <img class="lazy w-100 nano img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-6"></div>
        <img class="lazy w-100 nano img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-10"></div>
        <img class="lazy w-100 nano img-fluid image-10"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-3"></div>
        <img class="lazy w-100 nano img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-7"></div>
        <img class="lazy w-100 nano img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-11"></div>
        <img class="lazy w-100 nano img-fluid image-11"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center">
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-4"></div>
        <img class="lazy w-100 nano img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-8"></div>
        <img class="lazy w-100 nano img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-33 d-flex flex-column">
        <div class="img-title-nano title-12"></div>
        <img class="lazy w-100 nano img-fluid image-12"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
</div>
