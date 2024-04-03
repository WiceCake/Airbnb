@extends('layout.app')
@section('title', $property->property_title)

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-12">
                <h1>{{$property->property_title}} Reviews:</h1>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-12 py-3">
                <div class="row g-3">
                    @foreach ($property->reviews->sortByDesc('created_at') as $review)
                        <div class="col-4">
                            <div class="card shadow-sm h-100">
                                <div class="row p-3 g-3">
                                    <div class="col-3">
                                        <div class="border rounded-circle overflow-hidden me-3 d-flex justify-content-center align-items-center"
                                            style="aspect-ratio: 1/1">
                                            <img height="100px" src="{{ asset('storage/default.jpg') }}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <p class="fw-bold m-0">{{ $review->getUser->fullname }}</p>
                                        <p class="m-0 fw-light">{{ $review->created_at->format('F j, Y') }}</p>
                                        <p class="m-0">
                                            @for ($i = 0; $i < round($review->rating); $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                            @for ($i = round($review->rating); $i < 5; $i++)
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p>{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
    </div>

@endsection
