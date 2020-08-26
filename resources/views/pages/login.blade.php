{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
  <!--begin::Login-->
  <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Aside-->
    <div class="login-aside d-flex flex-column flex-row-auto">
      <!--begin::Aside Top-->
      <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
        <!--begin::Aside header-->
        <a href="{{ url('/') }}" class="login-logo text-center pt-lg-25 pb-10">
          <img src="media/logos/bookstrap-logo.png" class="max-h-70px" alt=""/>
        </a>
        <!--end::Aside header-->

        <!--begin::Aside Title-->
        <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">
            Big books<br/>
            in small time!
        </h3>
        <!--end::Aside Title-->
      </div>
      <!--end::Aside Top-->

      <!--begin::Aside Bottom-->
      <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
          style="background-position-y: calc(100% + 5rem); background-image: url(media/img/login{{ rand(1, 8) }}.jpg)">
      </div>
      <!--end::Aside Bottom-->
    </div>
    <!--begin::Aside-->

    <!--begin::Content-->
    <div class="login-content flex-row-fluid d-flex flex-column p-10">
      <!--begin::Top-->
      <div class="text-right d-flex justify-content-center">
        <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
        <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
        <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2" id="kt_login_signup">Get Help</a>
      </div>
    </div>
    <!--end::Top-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-row-fluid flex-center">
      <!--begin::Signin-->
      <div class="login-form">
        <!--begin::Form-->
        <form class="form" id="kt_login_singin_form"  method="POST" action="{{ route('login') }}">
          @csrf
          <!--begin::Title-->
          <div class="pb-5 pb-lg-15">
            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h3>
            <div class="text-muted font-weight-bold font-size-h4">
              New Here?
              <a href="{{ url('/') }}#pricing" class="text-primary font-weight-bolder">Create Account</a>
            </div>
          </div>
            <!--begin::Title-->

          <!--begin::Form group-->
          <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark">Your Email</label>
            <input class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>
          <!--end::Form group-->

          <!--begin::Form group-->
          <div class="form-group">
            <div class="d-flex justify-content-between mt-n5">
              <label class="font-size-h6 font-weight-bolder text-dark pt-5">Your Password</label>
              <a href="https://puzzlebookcompiler.com/members/login?sendpass" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
                Forgot Password ?
              </a>
            </div>
            <input class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password"/>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <!--end::Form group-->

          <!--begin::Action-->
          <div class="pb-lg-0 pb-5">
            <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
              <i class="icon-2x flaticon2-shield text-light-primary"></i>
              Sign In
            </button>
            <a href="{{ url('/') }}" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">
              <i class="icon-2x text-primary flaticon2-fast-back"></i>
              Cancel
            </a>
          </div>
          <!--end::Action-->
        </form>
        <!--end::Form-->
      </div>
      <!--end::Signin-->
    </div>
    <!--end::Wrapper-->
  </div>
  <!--end::Content-->
</div>
<!--end::Login-->
@endsection

{{-- Scripts Section --}}
@section('scripts')


        <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
        <!--begin::Global Config(global config for global JS scripts)-->
        <script>
            var KTAppSettings = {
    "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
    },
    "colors": {
        "theme": {
            "base": {
                "white": "#ffffff",
                "primary": "#3699FF",
                "secondary": "#E5EAEE",
                "success": "#1BC5BD",
                "info": "#8950FC",
                "warning": "#FFA800",
                "danger": "#F64E60",
                "light": "#E4E6EF",
                "dark": "#181C32"
            },
            "light": {
                "white": "#ffffff",
                "primary": "#E1F0FF",
                "secondary": "#EBEDF3",
                "success": "#C9F7F5",
                "info": "#EEE5FF",
                "warning": "#FFF4DE",
                "danger": "#FFE2E5",
                "light": "#F3F6F9",
                "dark": "#D6D6E0"
            },
            "inverse": {
                "white": "#ffffff",
                "primary": "#ffffff",
                "secondary": "#3F4254",
                "success": "#ffffff",
                "info": "#ffffff",
                "warning": "#ffffff",
                "danger": "#ffffff",
                "light": "#464E5F",
                "dark": "#ffffff"
            }
        },
        "gray": {
            "gray-100": "#F3F6F9",
            "gray-200": "#EBEDF3",
            "gray-300": "#E4E6EF",
            "gray-400": "#D1D3E0",
            "gray-500": "#B5B5C3",
            "gray-600": "#7E8299",
            "gray-700": "#5E6278",
            "gray-800": "#3F4254",
            "gray-900": "#181C32"
        }
    },
    "font-family": "Poppins"
  };
        </script>
        <!--end::Global Config-->

      <!--begin::Global Theme Bundle(used by all pages)-->
               <script src="assets/plugins/global/plugins.bundle.js"></script>
             <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
             <script src="assets/js/scripts.bundle.js"></script>
        <!--end::Global Theme Bundle-->


                    <!--begin::Page Scripts(used by this page)-->
                            <script src="assets/js/pages/custom/login/login-3.js"></script>
                        <!--end::Page Scripts-->

@endsection
