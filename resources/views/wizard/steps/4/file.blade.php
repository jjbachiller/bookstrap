<div class="custom-control">
  <div class="row">

    <div class="col-md-6">
      <div class="card card-custom">
        <div class="card-header card-header-right ribbon ribbon-clip ribbon-left">
          <div class="ribbon-target" style="top: 12px;">
            <span class="ribbon-inner bg-info"></span>
            <i class="icon-xl text-white fas fa-magic"></i>
            &nbsp;&nbsp;Available formats
          </div>
          <h3 class="card-title">
            File type selection
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm text-center">
              <label class="radio radio-accent radio-danger">
                  <input type="radio" class="radio-type" id="pdf" name="book_filetype" value="1" checked>
                  <span></span>
                  &nbsp;&nbsp;
                  <i class="icon-xl far fa-file-pdf text-danger"></i>
                  &nbsp;&nbsp;
                  PDF
              </label>
            </div>
            <div class="col-sm text-center">
              <label class="radio radio-accent radio-warning">
                <input type="radio" class="radio-type" id="ppt" name="book_filetype" value="2">
                <span></span>
                &nbsp;&nbsp;
                <i class="icon-xl far fa-file-powerpoint text-warning"></i>
                &nbsp;&nbsp;
                PowerPoint
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="input-group filename">
        <div class="input-group-prepend">
          <span class="input-group-text">Filename:</span>
        </div>
        @isset($book)
          <input class="form-control" type="text" name="book_filename" placeholder="Filename" value="{{ $book->name }}">
        @else
          <input class="form-control" type="text" name="book_filename" placeholder="Filename">
        @endisset
      </div>
    </div>

  </div>
</div>
