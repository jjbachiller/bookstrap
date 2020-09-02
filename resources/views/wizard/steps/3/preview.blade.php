<div class="book_options">

  <div class="d-flex justify-content-center">

    <div class="card card-custom shadow w-75">
    	<div class="card-header card-header-right ribbon ribbon-clip ribbon-left">
    		<div class="ribbon-target" style="top: 12px;">
    			<span class="ribbon-inner bg-info"></span>
          <i class="icon-xl text-white far fa-clock"></i>
          &nbsp;&nbsp;Realtime updated
    		</div>
    		<h3 class="card-title">
    			Book Options
    		</h3>
    	</div>
    	<div class="card-body">

        <div class="book-options-col col-12">

          <div class="row">

            <div class="col-4 h-100">
              <label class="addFooterLabel text-muted">Add Footer:</label>
              <span class="switch switch-outline switch-icon switch-info">
                <label>
                  <input type="checkbox" class="custom-control-input" id="addFooter"/>
                  <span></span>
                </label>
              </span>
              <div class="d-none" id="footerOptions">
                <input type="text" class="form-control" id="footer" aria-describedby="Footer text" maxlength="60" value="Footer Details">
              </div>
            </div>

            <div class="col-4 h-100">
              <label class="addPageNumberLabel text-muted">Add page number:</label>
              <span class="switch switch-outline switch-icon switch-info">
                <label>
                  <input type="checkbox" class="custom-control-input" id="addPageNumber"/>
                  <span></span>
                </label>
              </span>
              <div class="d-none" id="pageNumberOptions">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-outline-secondary">
                    <input type="radio" name="options" id="option1" autocomplete="off" value="1"> Header
                  </label>
                  <label class="btn btn-outline-secondary active">
                    <input type="radio" name="options" id="option2" autocomplete="off" value="2" checked> Footer
                  </label>
                  <label class="btn btn-outline-secondary">
                    <input type="radio" name="options" id="option3" autocomplete="off" value="3"> Both
                  </label>
                </div>
              </div>
            </div>

            <div class="col-2 h-100">
              <label class="fullBleedLabel text-muted">Image size:</label>
              <div class="size-input-container">
        			  <input type="text" class="form-control col-md-10" id="image-size"  placeholder="Size %"/>
              </div>
            </div>
            <div class="col-2 h-100 pt-10">
              <div id="size-slider" class="nouislider nouislider-handle-info"></div>
            </div>

          </div>

          <div class="row">

            <div class="col">
              <label class="addBlankPagesLabel text-muted">Add intermediate blank pages:</label>
              <span class="switch switch-outline switch-icon switch-info">
                <label>
                  <input type="checkbox" class="custom-control-input" id="addBlankPages"/>
                  <span></span>
                </label>
              </span>
            </div>

            <div class="col">
              <label class="fullBleedLabel text-muted">Full bleed images:</label>
              <span class="switch switch-outline switch-icon switch-info">
                <label>
                  <input type="checkbox" class="custom-control-input" id="fullBleed"/>
                  <span></span>
                </label>
              </span>
            </div>

            <div class="col">
              <label class="addPageNumberLabel text-muted">Image position:</label>
              <div id="imagePositionOptions">
                <div class="btn-group btn-group-toggle" data-toggle="buttons" id="image-position">
                  <label class="btn btn-outline-secondary">
                    <input type="radio" name="options" id="position1" autocomplete="off" value="2"> Top
                  </label>
                  <label class="btn btn-outline-secondary active">
                    <input type="radio" name="options" id="postion2" autocomplete="off" value="5" checked> Middle
                  </label>
                  <label class="btn btn-outline-secondary">
                    <input type="radio" name="options" id="position3" autocomplete="off" value="8"> Bottom
                  </label>
                </div>
              </div>

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
    <div class="img-title-full title-1"></div>
    <div class="h-100 d-flex flex-column flex-nowrap">
      <div class="image-container justify-content-center align-items-center">
        <img class="lazy w-100 img-fluid image-1 full"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  {{-- 2 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-2">
   <div class="image-container h-50 d-flex flex-column flex-nowrap justify-content-center align-items-center">
     <div class="img-title title-1"></div>
     <img class="lazy w-100 img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
   </div>
   <div class="image-container h-50 d-flex flex-column flex-nowrap justify-content-center align-items-center">
     <div class="img-title title-2"></div>
     <img class="lazy w-100 img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
   </div>
  </div>
   {{-- 3 images per page --}}
   <div class="p-0 w-100 h-100 images-per-page-3">
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-left align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-right align-items-center">
      <div class="w-50 d-flex flex-column">
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-2"></div>
        <img class="lazy w-100 mini img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-left align-items-center">
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
    <div class="image-container h-50 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-1"></div>
        <img class="lazy w-100 img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title title-3"></div>
        <img class="lazy w-100 img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-50 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-3"></div>
        <img class="lazy w-100 mini img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-100 d-flex flex-column">
        <div class="img-title-mini title-5"></div>
        <img class="lazy w-100 mini img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-1"></div>
        <img class="lazy w-100 mini img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-4"></div>
        <img class="lazy w-100 mini img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-2"></div>
        <img class="lazy w-100 mini img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-mini title-5"></div>
        <img class="lazy w-100 mini img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-1"></div>
        <img class="lazy w-100 nano img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-5"></div>
        <img class="lazy w-100 nano img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-2"></div>
        <img class="lazy w-100 nano img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-6"></div>
        <img class="lazy w-100 nano img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-3"></div>
        <img class="lazy w-100 nano img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
      <div class="w-50 d-flex flex-column">
        <div class="img-title-nano title-7"></div>
        <img class="lazy w-100 nano img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
   <div class="image-container p-0 w-100 h-100 images-per-page-9 images-per-page-10 images-per-page-11 images-per-page-12">
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
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
