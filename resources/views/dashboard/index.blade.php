{{-- Extends layout --}}
@extends('layout.default')

@section('styles')
  <style media="screen">
    .apexcharts-datalabel-value {
      font-size: 30px;
      font-weight: 700;
      fill: #5e6278 !important;
    }

    .widget-big-text {
      font-size: 6rem;
    }
  </style>
@endsection

{{-- Content --}}
@section('content')

  {{-- Dashboard 1 --}}
  <div class="order-2 order-xxl-1">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label font-weight-bolder text-dark">Your Books</span>
          <span class="text-muted mt-3 font-weight-bold font-size-sm">You have created {{ count($books) }} books</span>
        </h3>
        <div class="card-toolbar">
          <a href="{{ route('books.wizard') }}" class="btn btn-info btn-lg font-weight-bolder font-size-sm mr-3">
            <i class="icon-xl fas fa-book-medical text-light-info"></i>
            New Book
          </a>
        </div>
      </div>
      <div class="card-body pt-2 pb-0 mt-n3">
        <div class="row pt-10">

          <div class="col-lg-4 col-xxl-4">
            <!--begin::Mixed Widget 1-->
            @can('download-book')
              <div class="card card-custom bg-light-primary text-primary card-stretch gutter-b">
            @else
              <div class="card card-custom bg-light-secondary text-secondary text-muted card-stretch gutter-b">
            @endcan
              <!--begin::Header-->
              <div class="card-header border-0 py-5">
                  <h3 class="card-title font-weight-bolder text-primary">Books Stats</h3>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body p-0 position-relative overflow-hidden text-center">
                <h1 class="font-weight-bolder mt-20">
                  <span class="widget-big-text">{{ $statistics['totalBooks'] }}</span> Books <br>
                  <span class="text-dark-75 font-size-lg">
                    ({{ $statistics['totalPages'] }} total pages.)
                  </span>
                </h1>
                @php
                  $subscription = Auth::user()->subscription();
                  $downloads = $subscription['week_downloads'] - Auth::user()->numDownloadsThisWeek();

                  $pagesPercentage = ceil(Auth::user()->totalPages() * 100 / $subscription['max_total_pages']);
                @endphp

                <div class="mt-10">
                  <i class="icon-8x fas fa-cloud-download-alt text-primary"></i>
                  {{-- <h3 class="mt-3">
                    {{ $downloads }} / {{ $subscription['week_downloads'] }} <span class="font-size-lg"> Available Downloads</span>
                  </h3> --}}
                </div>
                <div class="m-5">
                  <h5 class="text-align-center">Your Pages Quota</h3>
                  <div class="progress m-5">
                    <div class="progress-bar progress-bar-striped" role="progressbar"  style="width: {{ $pagesPercentage }}%" aria-valuenow="{{ $pagesPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
              <!--end::Body-->
            </div>
            <!--end::Mixed Widget 1-->
        	</div>

          <div class="col-lg-4 col-xxl-4">
            <!--begin::Mixed Widget 1-->
            @can('space-available', 0)
              <div class="card card-custom bg-light-primary text-primary card-stretch gutter-b">
            @else
              <div class="card card-custom bg-light-secondary text-secondary text-muted card-stretch gutter-b">
            @endcan
              <!--begin::Header-->
              <div class="card-header border-0 py-5">
                  <h3 class="card-title font-weight-bolder text-primary">Account Stats</h3>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body p-0 position-relative overflow-hidden text-center">
                <div id="chart" style="min-height: 250px;">

                </div>
                @can('space-available', 0)
                  <h3 class="text-dark-50 pb-2">
                @else
                  <h3 class="text-danger pb-2">
                @endcan
                  {{ formatBytes($statistics['totalSize']) }} occupied
                </h3>

                @can('space-available', 0)
                  <span class="btn btn-primary btn-shadow btn-shadow-hover font-weight-bolder mb-10 py-3">
                @else
                  <span class="btn btn-danger btn-shadow btn-shadow-hover font-weight-bolder mb-10 py-3">
                @endcan
                  @php
                    $subscription = Auth::user()->subscription();
                  @endphp

                  <i class="icon-xl far fa-hdd"></i>
                  {{ formatBytes($subscription['disk_quota']) }} Disk Available
                </span>
                {{-- <span class="label label-lg label-primary label-inline font-weight-bolder mb-10 py-3">Disk Percentage</span> --}}
              </div>
              <!--end::Body-->
            </div>
            <!--end::Mixed Widget 1-->
        	</div>

          <div class="col-lg-4 col-xxl-4">
            <!--begin::Mixed Widget 1-->
            @can('active-subscription')
              <div class="card card-custom bg-light-primary text-primary card-stretch gutter-b">
            @else
              <div class="card card-custom bg-light-secondary text-secondary text-muted card-stretch gutter-b">
            @endcan
              <!--begin::Header-->
              <div class="card-header border-0 py-5">
                  <h3 class="card-title font-weight-bolder text-primary">Subscription</h3>
                  <a href="#" class="btn btn-success btn-shadow-hover font-weight-bolder py-3">Manage</a>
              </div>
              <!--end::Header-->
              <!--begin::Body-->
              <div class="card-body p-0 position-relative overflow-hidden mt-10 text-center">
                <h1 class="widget-big-text mt-10">
                  @can('active-subscription')
                    <i class="icon-6x text-primary {{ $subscription['icon'] }}"></i><br>
                  @else
                    <i class="icon-6x text-secondary text-muted {{ $subscription['icon'] }}"></i><br>
                  @endcan
                  {{ $subscription['name'] }}
                </h1>
                <h4>{{ $subscription['max_book_pages']}} pages per book</h4>
                <h4>{{ $subscription['max_total_pages']}} total pages</h4>

              </div>
              <!--end::Body-->
              @cannot('active-subscription')
                <h5 class="text-danger">
                  **Your subscription is expired **
                  <a href="https://puzzlebookcompiler.com/members/product/LCBW-Gold">Renew</a>
                </h5>
              @endcannot
            </div>
            <!--end::Mixed Widget 1-->
          </div>

          <div class="col-xxl-12 order-2 order-xxl-1">
            <!-- Start Widget Table -->
            <div id="myBooksTable" class="tab-content mt-5">
              <div class="table-responsive">
                <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                  <thead>
                    <tr class="text-left text-uppercase">
                      <th></th>
                      <th class="pl-7" style="min-width: 250px">
                        <span class="text-dark-75">Book Name</span>
                      </th>
                      <th class="text-right" style="min-width: 100px">Total Pages</th>
                      <th class="text-right" style="min-width: 100px">Sections</th>
                      <th class="text-right" style="min-width: 100px">Size</th>
                      <th class="text-right" style="min-width: 100px">Downloads</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($books as $book)
                    <tr>
                        <td class="pl-0 py-4">
                          <div class="symbol symbol-50 symbol-light">
                            <span class="symbol-label">
                              @php
                                $types = config('book-types');
                                $type = $types[$book->book_type];
                              @endphp
                              <i class="icon-xl {{ $type['icon'] }} {{ $type['text-color'] }}"></i>
                              {{-- <img src="{{ asset('media/svg/misc/014-kickstarter.svg') }}" class="h-50 align-self-center"> --}}
                            </span>
                          </div>
                        </td>
                        <td class="pl-0">
                          <a href="{{ route('books.edit', $book->id) }}" class="bookNameLink" target="_blank">
                            @if ($book->name)
                              {{ $book->name }}
                            @else
                              <span class="text-muted">Unnamed</span>
                            @endif
                          </a>
                          <div>
                            <span class="text-muted font-weight-bold">
                              {{ $book->created_at->format('F d, Y \a\t h:i A') }}
                            </span>
                          </div>
                        </td>
                        <td class="text-right">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $book->total_pages ?? 0 }}</span>
                            @if (!is_null($book->dimensions))
                              @php
                                $bookSizes = config('book-sizes');
                                $bookSize = $bookSizes[$book->dimensions];
                              @endphp
                              <span class="text-muted font-weight-500">{{ $bookSize['text'] }}</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ count($book->sections) }}</span>
                        </td>
                        <td class="text-right">
                            <span class="d-block">{{ formatBytes($book->total_size) }}</span>
                        </td>
                        <td class="text-right">
                          @if ($book->pdf)
                            <a href="{{ $book->pdf }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                                <i class="icon-xl far fa-file-pdf text-danger"></i>
                            </a>
                          @else
                            <span class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="icon-xl far fa-file-pdf text-muted"></i>
                            </span>
                          @endif
                          @if ($book->ppt)
                            <a href="{{ $book->ppt }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="icon-xl far fa-file-powerpoint text-warning"></i>
                            </a>
                          @else
                            <span class="btn btn-icon btn-light btn-hover-primary btn-sm">
                              <i class="icon-xl far fa-file-powerpoint text-muted"></i>
                            </span>
                          @endif
                        </td>
                        <td class="text-right pr-0">
                          <a href="{{ route('books.edit', $book->id) }}" class="btn btn-icon btn-light btn-hover-primary btn-sm">
                            <i class="icon-xl far fa-edit text-primary"></i>
                          </a>
                          <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3 cloneThisBook" data={{ $book->id }} data-toggle="modal" data-target="#cloneBookModal">
                            <i class="icon-xl fas fa-clone text-primary"></i>
                          </a>
                          <a href="#" class="btn btn-icon btn-light btn-hover-primary btn-sm" onclick="if(confirm('Delete this book?')){document.getElementById('delete-book-{{ $book->id }}').submit();return false;}">
                            <i class="icon-xl fas fa-trash-alt text-primary"></i>
                          </a>
                          <form id="delete-book-{{ $book->id }}" action="{{ route('books.destroy', $book) }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            @csrf
                          </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="align-center">
                        <div class="bg-light-info px-6 py-8 rounded-xl mb-7 text-center">
                          <strong>No books created yet!</strong><br>
                          <a href="{{ route('books.wizard') }}" class="text-info font-weight-bold font-size-h6 mt-2">
                            <i class="icon-xl fas fa-book-medical text-info"></i>
                            Create a book now clicking here!
                          </a>
                        </div>
                    </div>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>

                <!-- End Book List -->
                {{ $books->links('components.pagination') }}

              </div>
              <!-- End Widget Table -->
          </div>

        </div>
      </div>
    </div>
  </div>

  @include('dashboard.modal.clone_book')

@endsection

{{-- Scripts Section --}}
@section('scripts')

  {{-- <script src="{{ asset('js/pages/features/charts/apexcharts.js') }}" type="text/javascript"></script> --}}

  <script type="text/javascript">
    $(document).ready( function () {

      // var options = {
      //           series: [70],
      //           chart: {
      //             height: 250,
      //             type: 'radialBar',
      //           },
      //           plotOptions: {
      //             radialBar: {
      //               hollow: {
      //                 size: '70%',
      //               },
      //               dataLabels: {
      //                 name: {
      //                   show: false,
      //                 },
      //               },
      //             },
      //           },
      //           labels: ['Disk Use'],
      //       };

      var options = {
              series: [{{ $statistics['percentDiskOccupied'] }}],
              chart: {
              height: 250,
              type: 'radialBar',
              toolbar: {
                show: false
              }
            },
            plotOptions: {
              radialBar: {
                startAngle: -135,
                endAngle: 225,
                 hollow: {
                  margin: 0,
                  size: '70%',
                  background: '#e1f0ff',
                  image: undefined,
                  imageOffsetX: 0,
                  imageOffsetY: 0,
                  position: 'front',
                  dropShadow: {
                    enabled: true,
                    top: 3,
                    left: 0,
                    blur: 4,
                    opacity: 0.24
                  }
                },
                track: {
                  background: '#fff',
                  strokeWidth: '67%',
                  margin: 0, // margin is in pixels
                  dropShadow: {
                    enabled: true,
                    top: -3,
                    left: 0,
                    blur: 4,
                    opacity: 0.35
                  }
                },

                dataLabels: {
                  show: true,
                  name: {
                    offsetY: -10,
                    show: false,
                    color: '#888',
                    fontSize: '17px'
                  },
                  value: {
                    formatter: function(val) {
                      return parseInt(val) + '%';
                    },
                    color: '#111',
                    fontSize: '36px',
                    show: true,
                  }
                }
              }
            },
            fill: {
              type: 'gradient',
              gradient: {
                shade: 'dark',
                type: 'horizontal',
                shadeIntensity: 0.5,
                gradientToColors: ['#ABE5A1'],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
              }
            },
            stroke: {
              lineCap: 'round'
            },
            labels: ['Percent'],
            };


      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();

      $('.cloneThisBook').on('click', function() {
        var bookId = $(this).attr('data');
        var bookNameLink = $(this).closest('tr').find('.bookNameLink');
        // if book has no name, we set the new name to an empty string
        var bookName = bookNameLink.children().length > 0 ? '' : bookNameLink.html().trim() + ' Clone';

        $('#originalBookId').val(bookId);
        $('#cloneBookName').val(bookName);
      });

      // On show modal
      $('#cloneBookModal').on('shown.bs.modal', function() {
        $('#cloneBookName').focus().select();
      });

      $('#cloneBookButton').on('click', function() {
        // Hide modal button
        $('.modal-footer').addClass('d-none');
        $('#clonedName').addClass('d-none');
        // Show circle for waiting till the book is cloned.
        $('#clonedWait').removeClass('d-none');

        var data = {
          _token: "{{ csrf_token() }}",
          id: $('#originalBookId').val(),
          name: $('#cloneBookName').val(),
        }

        $.ajax({
          type: "POST",
          url: "{{ route('book.clone') }}",
          dataType: 'json',
          data: data,
          success: function(response) {
            if (response.deny) {
              $('#denyMessage').html(response.message);
              $('#cloneBookModal').modal('hide');
              $('#showAlertDeny').modal('show');
            } else {
              // Show buttons for close modal or edit cloned book
              $("#editClonedBook").attr('href', response.editUrl);
              $('#clonedWait').addClass('d-none');
              $('#clonedActions').removeClass('d-none');
            }
          },
        });
      });

      $('#cloneBookModal').on('hidden.bs.modal', function () {
        $('#clonedName').removeClass('d-none');
        $('.modal-footer').removeClass('d-none');
        $('#clonedWait').addClass('d-none');
        $('#clonedActions').addClass('d-none');
      });

    });
  </script>

@endsection
