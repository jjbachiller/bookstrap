<div id="book_download">

  <button class="btn btn-secondary" id="creating_container" type="button" disabled>
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Creating No Content book...
  </button>

  <div id="error_container" class="d-none">
    <strong>Oooops! something goes wrong. Please try again.</strong>
  </div>

  @guest
    <div id="creator-register-form" class="row justify-content-center d-none">
      <div class= "col-md-8">

        <div class="alert alert-warning" role="alert">
          You have to register on Bookstrap in order to download your book
        </div>
        <div class="card">
          <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">

            </div>

          </div>
        </div>
      </div>
    </div>

  @endguest
  @auth
    <div id="download_container" class="justify-content-center d-none">
      @if (Auth::user()->active)
        <div class="bg-light-success px-6 py-8 rounded-xl mb-7 text-center w-50 text-success font-size-lg">
          <strong>Your books is now available for download!</strong><br>
          <a href="#" id="book_link" class="btn btn-success btn-lg text-light-success font-weight-bold font-size-h6 mt-2">
            <i class="icon-xl fas fa-cloud-download-alt text-light-success"></i>
            Download your book
          </a>
        </div>
      @endif
    </div>

    <div id="reload_container" class="justify-content-around d-none">

      <div class="bg-light-primary px-6 py-8 rounded-xl mb-7 text-center w-25 text-primary font-size-lg">
        <strong>Go to your Dashboard</strong><br>
        <a href="{{ route('dashboard') }}" class="btn btn-primary text-light-primary font-weight-bold font-size-h6 mt-2" id="dashboard_button">
          <i class="icon-xl fas fa-tachometer-alt text-light-primary"></i>
          Dashboard
        </a>
      </div>

      <div class="bg-light-info px-6 py-8 rounded-xl mb-7 text-center w-25 text-info font-size-lg">
        <strong>Create another book</strong><br>
        <a href="{{ route('books.wizard') }}" class="btn btn-info text-light-info font-weight-bold font-size-h6 mt-2" id="new_book_button">
          <i class="icon-xl fas fa-book-medical text-light-info"></i>
          New book
        </a>
      </div>
    </div>


  @endauth

</div>
