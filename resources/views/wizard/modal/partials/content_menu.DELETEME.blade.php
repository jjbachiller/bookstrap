@foreach (config('categories.list') as $index => $category)

  @if ($index % config('categories.itemsPerRow') == 0)

    @if($index > 0)
      </ul>
    @endif

    <ul class="dashboard-tabs nav nav-pills nav-light-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">

  @endif

    <li class="nav-item d-flex col flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">

      <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center content-category" data-toggle="pill" data="sudoku">
        <span class="nav-icon py-2 w-auto">
            @php
              $categoryIcon = config('categories.iconPath') . $category['shortname'] . config('categories.iconExtension');
            @endphp
            <img class="mw-50 w-100px" src="{{ asset($categoryIcon) }}">
        </span>
        <span class="nav-text font-size-lg py-2 font-weight-bold text-center">
          {{ $category['name'] }}
        </span>
      </a>

      @if (!empty($category['subcategories']))
        <div class="content-subcategories">
        <!-- TODO: BACK BUTTON -->
        @foreach ($category['subcategories'] as $subindex => $subcategory)
    
          @if ($subindex % config('categories.itemsPerRow') == 0)
    
            @if ($subindex > 0)
              </ul>
            @endif

            <ul class="dashboard-tabs nav nav-pills nav-light-primary row row-paddingless m-0 p-0 flex-column flex-sm-row" role="tablist">
          
          @endif 

          <li class="nav-item d-flex col flex-grow-1 flex-shrink-0 mr-3 mb-3 mb-lg-0">

            <a class="nav-link border py-10 d-flex flex-grow-1 rounded flex-column align-items-center" data-toggle="pill" data="sudoku">
              <span class="nav-icon py-2 w-auto">
                  @php
                    $subcategoryIcon = config('categories.iconPath') . $subcategory['shortname'] . config('categories.iconExtension');
                  @endphp
                  <img class="mw-50 w-100px" src="{{ asset($subcategoryIcon) }}">
              </span>
              <span class="nav-text font-size-lg py-2 font-weight-bold text-center">
                {{ $subcategory['name'] }}
              </span>
            </a>

          </li>
        @endforeach

          </ul>
        </div>
      @endif
    </li>

@endforeach

</ul>
