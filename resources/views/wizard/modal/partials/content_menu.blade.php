<div class="row flex-center p-6">

  <a id="backBtn" class="btn btn-light-info font-weight-bolder btn-lg py-3 px-6 text-uppercase d-none backFromSubcategories"> &lt; Back</a>

</div>

<div class="row">

@foreach (config('categories.list') as $category)

  @include('wizard.modal.partials.menu_item', [ 'item' => $category, 'parent' => '' ])

  @foreach ($category['subcategories'] as $subcategory)

    @include('wizard.modal.partials.menu_item', [ 'item' => $subcategory, 'parent' => $category["shortname"] ])  

  @endforeach

@endforeach

</div>
