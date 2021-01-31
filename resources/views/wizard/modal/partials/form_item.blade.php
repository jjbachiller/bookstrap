<div class="form_item justify-content-center align-self-center w-100 d-none" id="{{ $item['shortname'] }}_form" role="tabpanel"> 

  <div class="text-center mb-10">

    @php

      $itemIcon = config('categories.iconPath') . $item['shortname'] . config('categories.iconExtension');
    @endphp
    <img class="mw-50 w-100px mb-5" src="{{ asset($itemIcon) }}">

    <h3 class="pb-3">{{ $item['name'] }} Options</h3>
  </div>

  <div class="form-group row mb-10">

    <label class="col-form-label text-right col-lg-2 col-sm-12">Grid size:</label>
    <div class="col-lg-4 col-md-9 col-sm-12">
      <div class="dropdown bootstrap-select form-control">
        <select class="form-control selectpicker dificulty_select" data-style="btn-light-info" data-container="body">
          @foreach ($item['difficulties'] as $difficultyFolder => $difficultyName)  
            <option value="{{ $difficultyFolder }}">{{ $difficultyName }}</option>
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
          <input type="text" step="1" class="form-control num_library_items" id="amount" value="10"  data-style="btn-light-info" data-container="body">
        </div>
      </div>
    </div>

  </div>

  <div class="form-group row justify-content-end card-footer">
    <button class="col-lg-4 col-md-4 col-sm-4 btn btn-light-primary font-weight-bold mr-2" type="button" data-dismiss="modal" id="add_puzzles">
      <i class="icon-2x flaticon2-add-square"></i>
      Add 
    </button>
    <button class="col-lg-3 col-md-3 col-sm-4 btn btn-light-danger font-weight-bold backFromForm" type="button">
      <i class="icon-2x flaticon2-cancel"></i>
      Cancel
    </button>
  </div>
</div>
