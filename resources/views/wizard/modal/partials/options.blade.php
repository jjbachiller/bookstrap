{{-- begin::Sudoku --}}
<div class="library-pane justify-content-center align-self-center w-100 d-none" id="sudoku" role="tabpanel" aria-labelledby="sudoku-tab">
  @include('wizard.modal.partials.forms.sudoku')
</div>
{{-- end::Sudoku --}}
{{-- begin::Sikaku --}}
<div class="library-pane justify-content-center align-self-center w-100 d-none" id="sikaku" role="tabpanel" aria-labelledby="sikaku-tab">
  @include('wizard.modal.partials.forms.sikaku')
</div>
{{-- end::Sikaku --}}
{{-- begin::Coming soon --}}
<div class="library-pane justify-content-center align-self-center w-100 d-none" id="coming_soon" role="tabpanel" aria-labelledby="coming-soon-tab">
  @include('wizard.modal.partials.forms.coming_soon')
</div>
{{-- end::Coming soon --}}
