{{-- Footer --}}

<div class="footer bg-white py-4 d-flex flex-lg-column {{ Metronic::printClasses('footer', false) }}" id="kt_footer">
    {{-- Container --}}
    <div class="{{ Metronic::printClasses('footer-container', false) }} d-flex flex-column flex-md-row align-items-center justify-content-between">
        {{-- Copyright --}}
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">{{ date("Y") }} &copy;</span>
            <a href="{{ url('/') }}" target="_blank" class="text-dark-75 text-hover-primary">Bookstrap</a>
        </div>

        {{-- Nav --}}
        <div class="nav nav-dark order-1 order-md-2">
            <a href="#" target="_blank" class="nav-link pr-3 pl-0">About</a>
            <a href="#" target="_blank" rel="nofollow" class="nav-link px-3">Terms & Conditions</a>
            <a href="#" target="_blank" rel="nofollow" class="nav-link pl-3 pr-0">Privacy Policy</a>
        </div>
    </div>
</div>
