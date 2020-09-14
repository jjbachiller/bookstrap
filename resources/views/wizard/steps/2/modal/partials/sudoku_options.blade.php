<h3 class="pb-3">Sudoku options:</h3>

<div class="form-group row">

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
    <div class="dropdown bootstrap-select form-control">
      <select class="form-control selectpicker" data-style="btn-light-info" data-container="body" id="sudokusNumber">
        @foreach (config('sudokus.addGroups') as $amount)
          <option value="{{ $amount }}">{{ $amount }} Sudokus</option>
        @endforeach
      </select>
    </div>
  </div>

</div>

<div class="form-group row justify-content-end card-footer">
  <button class="col-lg-4 col-md-4 col-sm-6 btn btn-light-primary font-weight-bold mr-2" type="button" data-dismiss="modal" id="addSudokusButton">
    <i class="icon-2x flaticon2-add-square"></i>
    Add sudokus
  </button>
  <button class="col-lg-3 col-md-3 col-sm-6 btn btn-light-danger font-weight-bold" type="button"  data-dismiss="modal">
    <i class="icon-2x flaticon2-cancel"></i>
    Cancel
  </button>
</div>
