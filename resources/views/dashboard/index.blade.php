@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end mb-4">
      <div class="col-md-4">
        <a href="{{ route('books.wizard') }}" class="btn btn-success btn-block">
          <span class="oi oi-plus"></span> Add New Book
        </a>
      </div>
    </div>

    <!-- Book List -->
    <div class="card">
        <div class="card-body p-4">
            <div class="table-responsive-md">
                <table class="table table-borderless table-striped">
                    <thead>
                    <tr class="text-uppercase font-size-1">
                        <th scope="col" class="font-weight-medium">
                            <div class="d-flex justify-content-between align-items-center">
                                Book Name
                            </div>
                        </th>
                        <th scope="col" class="font-weight-medium">
                            <div class="d-flex justify-content-between align-items-center">
                                Sections
                            </div>
                        </th>
                        <th scope="col" class="font-weight-medium">
                            <div class="d-flex justify-content-between align-items-center">
                                Size
                            </div>
                        </th>
                        <th scope="col" class="font-weight-medium">
                            <div class="d-flex justify-content-between align-items-center">
                                Downloadable
                            </div>
                        </th>
                        <th scope="col" class="font-weight-medium">
                            <div class="d-flex justify-content-between align-items-center">

                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="font-size-1">
                      @forelse ($books as $book)
                      <tr>
                          <td class="align-middle font-weight-normal">
                              <span class="d-block">
                                <a href="https://dahsboard.stripe.com" target="_blank">
                                  <span class="fab fa-stripe"></span>
                                </a>
                                @if ($book->name)
                                  {{ $book->name }}
                                @else
                                  <span class="text-muted">-- No name specified --</span>
                                @endif
                              </span>
                              <span class="pl-4 d-block text-muted small">
                                {{ $book->created_at->format('F d, Y \a\t h:i A') }}
                              </span>
                          </td>
                          <td class="align-middle text-center">
                              <span class="d-block h5">{{ count($book->sections) }}</span>
                          </td>
                          <td class="align-middle">
                              <span class="d-block">{{ formatBytes($book->total_size) }}</span>
                          </td>
                          <td class="align-middle">
                            @if ($book->pdf)
                              <a href="{{ $book->pdf }}" target="_blank" class="text-primary small mr-3">
                                <span class="oi oi-cloud-download"></span> PDF
                              </a>
                            @else
                              -
                            @endif
                            @if ($book->ppt)
                              <a href="{{ $book->pdf }}" target="_blank" class="text-primary small mr-3">
                                <span class="oi oi-cloud-download"></span> PowerPoint
                              </a>
                            @else
                              -
                            @endif
                          </td>
                          <td class="align-middle">
                            <a href="{{ route('books.edit', $book->id) }}" class="text-primary small">
                              <span class="oi oi-pencil"></span> Edit
                            </a>
                            <br>
                            <a href="#" class="text-danger small" onclick="if(confirm('Delete this book?')){document.getElementById('delete-book-{{ $book->id }}').submit();return false;}">
                              <span class="oi oi-trash"></span> Delete
                            </a>
                            <form id="delete-book-{{ $book->id }}" action="{{ route('books.destroy', $book) }}" method="POST">
                              <input type="hidden" name="_method" value="DELETE">
                              @csrf
                            </form>
                          </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4" class="align-center">
                          <strong>No books found</strong><br>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Book List -->
    {{ $books->links('components.pagination') }}        

</div>
@endsection
