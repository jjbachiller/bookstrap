@foreach (config('categories.list') as $category)

  @if (empty($category['subcategories']))
    @include('wizard.modal.partials.form_item', ['item' => $category, 'parent' => ''])
  @else
    @foreach ($category['subcategories'] as $subcategory)
      @include('wizard.modal.partials.form_item', ['item' => $subcategory, 'parent' => $category['shortname']])
    @endforeach
  @endif

@endforeach
