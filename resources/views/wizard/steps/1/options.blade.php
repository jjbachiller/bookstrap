<div id="step1-body">
  <h3 class="mb-10 font-weight-bold text-dark">Book type &amp; size</h3>
  <div class="row">
    <div class="col-1">

    </div>
    <div class="col-3 text-right">

      <select class="form-control form-control-lg" data-show-content="true" name="book-type" id="book-type">
        @foreach (config('book-types') as $key => $type)
          @isset($book)
            <option data-content="<i class='icon-xl {{ $type['icon'] }} {{ $type['text-color'] }}'></i> {{ $type['name'] }}" value="{{ $key }}" {{ ($book->book_type == $key) ? 'selected' : '' }}>
            </option>
          @else
            <option data-content="<i class='icon-xl {{ $type['icon'] }} {{ $type['text-color'] }}'></i> {{ $type['name']}}" value="{{ $key }}" value="{{ $key }}" >
            </option>
          @endisset
        @endforeach
      </select>

    </div>
    <div class="col-6">
      <select class="form-control form-control-lg" data-show-content="true" name="book-size" id="book-size">
        @foreach (config('book-sizes') as $key => $size)
          @isset($book)
            <option data-content="{{ $size['text'] }}" value="{{ $key }}" {{ ($book->dimensions == $key) ? 'selected' : '' }}></option>
          @else
            <option data-content="{{ $size['text'] }}" value="{{ $key }}"></option>
          @endisset
        @endforeach
      </select>
     </div>
     <div class="col-2">

     </div>
  </div>
</div>
