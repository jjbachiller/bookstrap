@php

  $itemAction = empty($item['subcategories']) ? 'showForm' : 'showSubcategories';

@endphp

<div class="col-xl-3 col-lg-5 col-md-5 col-sm-5 item {{ empty($parent) ? '':'d-none' }}" data-category="{{ $item['shortname'] }}" data-parent="{{ $parent }}">
  <div class="card gutter-b card-stretch">
    <div class="card-body text-center pt-4">

      <div class="mt-7">
        <div class="symbol symbol-circle symbol-lg-90">
          @php

            $itemIcon = config('categories.iconPath') . $item['shortname'] . config('categories.iconExtension');
          @endphp
          <img class="mw-50 w-100px" src="{{ asset($itemIcon) }}" alt="{{ $item['name'] }}">
        </div>
      </div>
      
      <div class="my-4">
        <a class="text-dark font-weight-bold text-hover-primary font-size-h4" data="{{ $item['shortname'] }}">{{ $item['name'] }}</a>
      </div>

      <div class="mt-9">
        <a class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase {{ $itemAction }}" data-parent="{{ $parent }}" data-current="{{ $item['shortname'] }}">Select</a>
      </div>

    </div>
  </div>
</div>
