<div class="custom-control">
  <div class="row">

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Filetype:
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm text-center">
              <input type="radio" class="radio-type" id="pdf" name="book_filetype" value="1" checked>
              <label for="pdf">PDF</label><br>
            </div>
            <div class="col-sm text-center">
              <input type="radio" class="radio-type" id="ppt" name="book_filetype" value="2">
              <label for="ppt">PowerPoint</label><br>
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
