<div class="book_options">

  <div class="row">

    <div class="col-md-10 mx-auto">

      <div class="form-group row">

        <div class="col-md-6 book-options-col image-options">

          <div class="row">
            <div class="col">
              <div class="row">
                <label for="image-size">Image Size</label>
              </div>
              <div class="row d-flex justify-content-center">
                <input type="text" value="100" id="image-size" class="col-md-3 form-control">
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col">

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
            <div class="col">
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
            <div class="col">
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
      <div class="img-content">
        <img src="[IMG_URL]" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;"/>
      </div>
    </div>
    <div class="d-inline page-footer invisible">
      <span class="footer-text">[FOOTER]</span>
    </div>
    <div class="d-inline f-page-number page-number invisible float-right">[PAGE_NUMBER]</div>
  </div>
</div>
