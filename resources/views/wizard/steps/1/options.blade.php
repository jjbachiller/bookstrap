 <div class="card">
   <div class="card-header">
     Book size
   </div>
   <div class="card-body">
     <div class="row">
       <div class="col">

       </div>
       <div class="col-6">
         <select class="form-control form-control-lg" name="book-size" id="book-size">
           @foreach (config('book-sizes') as $key => $size)
             @isset($book)
               <option value="{{ $key }}" {{ ($book->dimensions == $key) ? 'selected' : '' }}>{{ $size['text'] }}</option>
             @else
               <option value="{{ $key }}">{{ $size['text'] }}</option>
              @endif
           @endforeach
         </select>
       </div>
       <div class="col">

       </div>
     </div>
   </div>
 </div>

<?php /*
  At this moment we are omitting the copyright section

  <div class="row" id="copyright-option">
    <div class="col">
      <div>
        <div class="custom-control custom-switch">
          <input type="checkbox" class="custom-control-input" id="addCopyright">
          <label class="custom-control-label" for="addCopyright">Add a Copyright page</label>
        </div>
      </div>
      <div id="customCopyright" class="d-none">
        <label for="copyright">Customize Copyright text:</label>
        <textarea class="form-control" id="copyright" rows="8">{{ config('constants.COPYRIGHT_TEXT') }}</textarea>
      </div>
    </div>
  </div>
*/ ?>
