<div id="sudokus-header" class="text-center mb-10">
  <img class="mw-50 w-100px mb-5" src="{{ asset('media/categories/sudoku.png') }}">

  <h3 class="pb-3">Sudoku Options</h3>
</div>

<div class="form-group row mb-10">

  <label class="col-form-label text-right col-lg-2 col-sm-12">Difficulty level:</label>
  <div class="col-lg-4 col-md-9 col-sm-12">
    <div class="dropdown bootstrap-select form-control">
      <select class="form-control selectpicker" data-style="btn-light-info" data-container="body" id="sudokusDifficulty">
        @foreach (config('sudokus.difficulties') as $difValue => $difName)
          <option value="{{ $difValue }}">{{ $difName }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <label class="col-form-label text-right col-lg-2 col-sm-12">Amount:</label>
  <div class="col-lg-4 col-md-9 col-sm-12">
    <div class="row">
      <div class="col-8">
        <div class="ion-range-slider">
           <input type="hidden" class="slider_num_library_items"/>
        </div>
      </div>
      <div class="col-4">
        <input type="text" step="1" class="form-control num_library_items" id="sudokusNumber" value="10"  data-style="btn-light-info" data-container="body">
      </div>
    </div>
  </div>

</div>

<div class="form-group row justify-content-end card-footer">
  <button class="back-categories-button col-lg-2 col-md-2 col-sm-3 btn btn-secondary font-weight-bold mr-1" type="button">
    <i class="icon-2x flaticon2-back"></i>
    Back
  </button>
  <button class="col-lg-4 col-md-4 col-sm-4 btn btn-light-primary font-weight-bold mr-2" type="button" data-dismiss="modal" id="addSudokusButton">
    <i class="icon-2x flaticon2-add-square"></i>
    Add sudokus
  </button>
  <button class="col-lg-3 col-md-3 col-sm-4 btn btn-light-danger font-weight-bold" type="button"  data-dismiss="modal">
    <i class="icon-2x flaticon2-cancel"></i>
    Cancel
  </button>
</div>
