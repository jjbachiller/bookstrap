@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
	@auth
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			@php
				$subscription = Auth::user()->subscription();
			@endphp
			<i class="icon-2x text-success {{ $subscription['icon'] }}"></i> {{ $subscription['name'] }} member
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>
	@endauth

	{{-- Content --}}
  <div class="offcanvas-content pr-5 mr-n5">
	{{-- Header --}}
    <div class="d-flex align-items-center mt-5">
      <div class="symbol symbol-100 mr-5">
        <div class="symbol-label" style="background-image:url('{{ asset('media/img/user' . rand(1,12) . '.png') }}')"></div>
				<i class="symbol-badge bg-success"></i>
      </div>
			@auth
      <div class="d-flex flex-column">
      	<a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
					{{ Auth::user()->name }}
				</a>
        <div class="text-muted mt-1">
        	Renew: {{ $subscription['next_billing']->toFormattedDateString() }}
        </div>
        <div class="navi mt-2">
        	<a href="#" class="navi-item">
          	<span class="navi-link p-0 pb-2">
            	<span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
              <span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
            </span>
          </a>
        </div>
      </div>
			@endauth
    </div>

		{{-- Separator --}}
		<div class="separator separator-dashed mt-8 mb-5"></div>

		{{-- Nav --}}
		<div class="navi navi-spacer-x-0 p-0">
		    {{-- Item --}}
		    <a href="{{ route('dashboard') }}" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
											<i class="icon-xl fas fa-tachometer-alt text-primary"></i>
										</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Dashboard
		                </div>
		                <div class="text-muted">
		                    Books list and settings
		                </div>
		            </div>
		        </div>
		    </a>

				{{-- Item --}}
		    <a href="{{ route('books.wizard') }}" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
											<i class="icon-xl fas fa-book-medical text-info"></i>
										</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    New Book
		                </div>
		                <div class="text-muted">
		                    Wizard book creating
		                </div>
		            </div>
		        </div>
		    </a>

		    {{-- Item --}}
		    <a href="{{ route('logout') }}"  class="navi-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   <i class="icon-xl fas fa-door-open text-danger"></i>
 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Logout
		                </div>
		                <div class="text-muted">
		                    Close your session
		                </div>
		            </div>
		        </div>
		    </a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
				</form>
		</div>

		{{-- Separator --}}
		<div class="separator separator-dashed my-7"></div>

		{{-- Notifications --}}
		<div>
			{{-- Heading --}}
        	<h5 class="mb-5">
            	Recent Notifications
        	</h5>

			{{-- Item --}}
	        <div class="d-flex align-items-center bg-light-warning rounded p-5 gutter-b">
	            <span class="svg-icon svg-icon-warning mr-5">
	                {{ Metronic::getSVG("media/svg/icons/Home/Library.svg", "svg-icon-lg") }}
	            </span>

	            <div class="d-flex flex-column flex-grow-1 mr-2">
	                <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another purpose persuade</a>
	                <span class="text-muted font-size-sm">Due in 2 Days</span>
	            </div>

	            <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>
	        </div>

	        {{-- Item --}}
	        <div class="d-flex align-items-center bg-light-success rounded p-5 gutter-b">
	            <span class="svg-icon svg-icon-success mr-5">
	                {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-lg") }}
	            </span>
	            <div class="d-flex flex-column flex-grow-1 mr-2">
	                <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Would be to people</a>
	                <span class="text-muted font-size-sm">Due in 2 Days</span>
	            </div>

	            <span class="font-weight-bolder text-success py-1 font-size-lg">+50%</span>
	        </div>

	        {{-- Item --}}
	        <div class="d-flex align-items-center bg-light-danger rounded p-5 gutter-b">
	            <span class="svg-icon svg-icon-danger mr-5">
	                {{ Metronic::getSVG("media/svg/icons/Communication/Group-chat.svg", "svg-icon-lg") }}
	            </span>
	            <div class="d-flex flex-column flex-grow-1 mr-2">
	                <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">Purpose would be to persuade</a>
	                <span class="text-muted font-size-sm">Due in 2 Days</span>
	            </div>

	            <span class="font-weight-bolder text-danger py-1 font-size-lg">-27%</span>
	        </div>

	        {{-- Item --}}
	        <div class="d-flex align-items-center bg-light-info rounded p-5">
	            <span class="svg-icon svg-icon-info mr-5">
	                {{ Metronic::getSVG("media/svg/icons/General/Attachment2.svg", "svg-icon-lg") }}
	            </span>

	            <div class="d-flex flex-column flex-grow-1 mr-2">
	                <a href="#" class="font-weight-normel text-dark-75 text-hover-primary font-size-lg mb-1">The best product</a>
	                <span class="text-muted font-size-sm">Due in 2 Days</span>
	            </div>

	            <span class="font-weight-bolder text-info py-1 font-size-lg">+8%</span>
	        </div>
		</div>
    </div>
</div>
