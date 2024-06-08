@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($books->chunk(5) as $chunk)
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($chunk as $index => $book)
                            <div class="col custom-col">
                                <div class="card mb-4">
                                    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('img/book.jpg') }}" class="card-img-top" alt="Cover image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $book->title }}</h5>
                                        <p class="card-text">{{ $book->author }}</p>
                                        <div class="btn-box"><a href="/books/{{ $book->id }}" class="btn btn-primary">More details...</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @for ($i = count($chunk); $i < 5; $i++)
                            <div class="col custom-col">
                                <div class="card mb-4 empty-card">
                                    <!-- 空白卡片内容 -->
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-container">
            <div class="pagination">
                @if ($books->previousPageUrl())
                    <a href="{{ $books->previousPageUrl() }}" class="page-item">Previous</a>
                @else
                    {{--                    <span class="page-item disabled">Previous</span>--}}
                @endif

                @for ($i = 1; $i <= $books->lastPage(); $i++)
                    <a href="{{ $books->appends(['genre' => $genre, 'page' => $i])->url($i) }}" class="page-item {{ ($books->currentPage() == $i) ? 'active' : '' }}">{{ $i }}</a>
                @endfor

                @if ($books->nextPageUrl())
                    <a href="{{ $books->nextPageUrl() }}" class="page-item">Next</a>
                @else
                    {{--                    <span class="page-item disabled">Next</span>--}}
                @endif
            </div>
            <div class="results-info">
                Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
            </div>
        </div>
    </div>
@endsection
