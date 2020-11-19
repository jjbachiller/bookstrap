<div class="book_options">

  <div class="d-flex justify-content-center">

    <div class="card card-custom shadow w-75">
    	<div class="card-header card-header-right ribbon ribbon-clip ribbon-left">
    		<div class="ribbon-target" style="top: 12px;">
    			<span class="ribbon-inner bg-info"></span>
          <i class="icon-xl text-white far fa-clock"></i>
          &nbsp;&nbsp;Realtime updated
    		</div>
        <div class="row">
          <div class="col-12">
              <button class="btn btn-light-info mt-2 mb-2 float-right">Book Pages: <span id="current-book-pages" class="font-weight-bolder">0</span> </button>
          </div>
        </div>    	</div>
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
    <div class="img-title title-1"></div>
    <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
      <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
    </div>
  </div>
  {{-- 2 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-2">
    <div class="p-0 w-100 h-50">
      <div class="img-title title-1"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="p-0 w-100 h-50">
      <div class="img-title title-2"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  {{-- 4 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-3 images-per-page-4">
  <div class="h-50 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-1"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-2"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-50 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-3"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-4"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  </div>
  {{-- 6 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-5 images-per-page-6">
  <div class="h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-1"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-2"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-3"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-4"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-5"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-6"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  </div>
  {{-- 7 to 8 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-7 images-per-page-8">
  <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-1"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-2"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-3"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-4"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-5"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-6"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-7"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-50 h-100 d-flex flex-column">
      <div class="img-title title-8"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
  </div>
  </div>
  {{-- 9 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-9">
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-1"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-2"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-3"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
    <div class="h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-4"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-5"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-6"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
    <div class="image-container h-33 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-7"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-8"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-9"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-9"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
  </div>
  {{-- 10 to 12 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-10 images-per-page-11 images-per-page-12">
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-1"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-2"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-3"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
    <div class="h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-4"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-5"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-6"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-7"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-8"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-9"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-9"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
    <div class="image-container h-25 d-flex flex-row flex-nowrap justify-content-center align-items-center">
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-10"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-10"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-11"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-11"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
      <div class="w-33 h-100 d-flex flex-column">
        <div class="img-title title-12"></div>
        <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
          <img class="lazy img-fluid image-12"  data-src="[IMG_URL]" alt=""/>
        </div>
      </div>
    </div>
  </div>

  {{-- 13 to 24 images per page --}}
  <div class="p-0 w-100 h-100 images-per-page-13 images-per-page-14 images-per-page-15 images-per-page-16 images-per-page-17 images-per-page-18 images-per-page-19 images-per-page-20 images-per-page-21 images-per-page-22 images-per-page-23 images-per-page-24">
   <div class="h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-1"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-1"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-2"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-2"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-3"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-3"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-4"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-4"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
   </div>
   <div class="h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-5"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-5"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-6"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-6"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-7"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-7"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-8"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-8"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
   </div>
   <div class="image-container h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-9"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-9"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-10"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-10"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-11"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-11"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-12"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-12"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
   </div>
   <div class="image-container h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-13"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-13"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-14"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-14"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-15"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-15"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-16"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-16"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
   </div>
   <div class="image-container h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
    <div class="w-25 h-100 d-flex flex-column">
      <div class="img-title title-17"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-17"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-25 h-100 d-flex flex-column">
      <div class="img-title title-18"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-18"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-25 h-100 d-flex flex-column">
      <div class="img-title title-19"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-19"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
    <div class="w-25 h-100 d-flex flex-column">
      <div class="img-title title-20"></div>
      <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
        <img class="lazy img-fluid image-20"  data-src="[IMG_URL]" alt=""/>
      </div>
    </div>
   </div>
   <div class="image-container h-16 d-flex flex-row flex-nowrap justify-content-center align-items-center">
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-21"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-21"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-22"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-22"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-23"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-23"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
     <div class="w-25 h-100 d-flex flex-column">
       <div class="img-title title-24"></div>
       <div class="img-container spinner spinner-center d-flex flex-column flex-nowrap justify-content-center align-items-center">
         <img class="lazy img-fluid image-24"  data-src="[IMG_URL]" alt=""/>
       </div>
     </div>
   </div>
 </div>
</div>
