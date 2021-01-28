<div class="row flex-center p-6">

  <a id="backBtn" class="btn btn-light-info font-weight-bolder btn-lg py-3 px-6 text-uppercase d-none back-categories-button"> &lt; Back</a>

</div>

<div class="row">

@foreach (config('categories.list') as $index => $category)

  <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 category" data-category="{{ $category['shortname'] }}">
    <div class="card gutter-b card-stretch">
      <div class="card-body text-center pt-4">

        <div class="mt-7">
          <div class="symbol symbol-circle symbol-lg-90">
            @php
              $categoryIcon = config('categories.iconPath') . $category['shortname'] . config('categories.iconExtension');
            @endphp
            <img class="mw-50 w-100px" src="{{ asset($categoryIcon) }}" alt="{{ $category['name'] }}">
          </div>
        </div>
        
        <div class="my-4">
          <a class="text-dark font-weight-bold text-hover-primary font-size-h4" data="{{ $category['shortname'] }}">{{ $category['name'] }}</a>
        </div>

        <div class="mt-9">
          <a class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase" data="{{ $category['shortname'] }}">Select</a>
        </div>

      </div>
    </div>
  </div>

  @foreach ($category['subcategories'] as $subindex => $subcategory)
    
    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 subcategory d-none" data-parent="{{ $category['shortname'] }}">
      <div class="card gutter-b card-stretch">
        <div class="card-body text-center pt-4">

          <div class="mt-7">
            <div class="symbol symbol-circle symbol-lg-90">
              @php

                $subcategoryIcon = config('categories.iconPath') . $subcategory['shortname'] . config('categories.iconExtension');
              @endphp
              <img class="mw-50 w-100px" src="{{ asset($subcategoryIcon) }}" alt="{{ $subcategory['name'] }}">
            </div>
          </div>
          
          <div class="my-4">
            <a class="text-dark font-weight-bold text-hover-primary font-size-h4" data="{{ $subcategory['shortname'] }}">{{ $subcategory['name'] }}</a>
          </div>

          <div class="mt-9">
            <a class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase" data="{{ $category['shortname'] }}">Select</a>
          </div>

        </div>
      </div>
    </div>

  @endforeach

@endforeach

</div>
