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

                {{-- <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end p-3">
                        Do you already have an account? <strong><a href="{{ route('login') }}">Log in</a></strong>
                    </div>
                </form> --}}
            </div>
          </div>
        </div>
      </div>
    </div>

  @endguest
  @auth
    <div id="download_container" class="d-none">
      @if (Auth::user()->hasVerifiedEmail())
        @if (Auth::user()->active)
          <a href="#" id="book_link" class="btn btn-success btn-lg" role="button">
            <span class="oi oi-cloud-download" title="cloud download" aria-hidden="true"></span>

            Download your book
          </a>
        @else
          Your account <strong>is NOT active</strong>.<br>
          Your account should be activated by an administrator before you can download a book.
        @endif
      {{-- @else
        {{ __('To download the book, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form> --}}
      @endif
    </div>

    <div id="reload_container" class="d-none">
      <button class="btn btn-warning restart_wizard" id="restart_wizard" type="button">
        <span class="oi oi-reload" title="reload" aria-hidden="true"></span>

        Restart Wizard
      </button>
    </div>

  @endauth

</div>
