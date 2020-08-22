<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- <script src="https://use.fontawesome.com/0a0bb3cf1c.js"></script> --}}
        <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css')}}">

        <link rel="stylesheet" href="{{ asset('/css/app.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/theme.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/pricing.css')}}">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('pricing') }}">Pricing</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
              <div class="demo">
                <div class="container">
                    <div class="row text-center">
                        <h1 class="white">pricing table style : demo 150</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="pricingTable">
                                <div class="pricingTable-header">
                                    <div class="icon">
                                        <i class="fas fa-bicycle"></i>
                                    </div>
                                    <div class="price-value">
                                        <span class="currency">$</span>
                                        <span class="amount">10</span>
                                    </div>
                                </div>
                                <div class="pricing-content">
                                    <h3 class="title">Standard</h3>
                                    <ul>
                                        <li>50GB Disk Space</li>
                                        <li>50 Email Accounts</li>
                                        <li>50GB Bandwidth</li>
                                        <li class="disable">Maintenance</li>
                                        <li class="disable">15 Subdomains</li>
                                    </ul>
                                    <div class="pricingTable-signup">
                                        <a href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="pricingTable yellow">
                                <div class="pricingTable-header">
                                    <div class="icon">
                                        <i class="fas fa-train"></i>
                                    </div>
                                    <div class="price-value">
                                        <span class="currency">$</span>
                                        <span class="amount">20</span>
                                    </div>
                                </div>
                                <div class="pricing-content">
                                    <h3 class="title">Business</h3>
                                    <ul>
                                        <li>50GB Disk Space</li>
                                        <li>50 Email Accounts</li>
                                        <li>50GB Bandwidth</li>
                                        <li>Maintenance</li>
                                        <li class="disable">15 Subdomains</li>
                                    </ul>
                                    <div class="pricingTable-signup">
                                        <a href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="pricingTable pink">
                                <div class="pricingTable-header">
                                    <div class="icon">
                                        <i class="fas fa-rocket"></i>
                                    </div>
                                    <div class="price-value">
                                        <span class="currency">$</span>
                                        <span class="amount">30</span>
                                    </div>
                                </div>
                                <div class="pricing-content">
                                    <h3 class="title">Premium</h3>
                                    <ul>
                                        <li>50GB Disk Space</li>
                                        <li>50 Email Accounts</li>
                                        <li>50GB Bandwidth</li>
                                        <li>Maintenance</li>
                                        <li>15 Subdomains</li>
                                    </ul>
                                    <div class="pricingTable-signup">
                                        <a href="#">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>
