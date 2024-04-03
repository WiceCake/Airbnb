@extends('layout.app')
@section('title', 'Properties')

@section('content')
    <div class="container py-5" style="min-height: 100vh">
        <div class="row">
            <div class="col-6 mb-5">
                <p class="opacity-50">You have a total of {{ $properties->count() }} properties listed</p>
            </div>
            <div class="col-6 text-end">
                <a href="{{ url('properties/create') }}" class="btn btn-primary">Add New Listing</a>
            </div>
            @if (session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            @foreach ($properties as $property)
                <div class="col-3">
                    <div class="card shadow-sm h-100 border-dark">
                        @if ($property->pictures->count() != 0)
                            <img src="{{ asset($property->pictures->pluck('path')->random()) }}" class="card-img-top h-100" alt="default">
                        @else
                            <img src="{{ asset('storage/default.jpg') }}" class="card-img-top" alt="default">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title mb-3 fw-bold border-bottom pb-3">{{ $property->property_title }}
                                @if ($property->status == 'unlisted')
                                    <span class="badge text-bg-secondary fw-light">Unlisted</span>
                                @endif
                            </h5>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <span class="badge rounded-pill text-bg-dark">{{ $property->type->first()->name }}</span>
                                    <span class="badge rounded-pill text-bg-dark">{{ $property->capacity }} persons</span>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="fw-light">
                                        {{ ucfirst($property->address->first()->barangay) }},
                                        {{ ucfirst($property->address->first()->municipality) }},
                                        {{ ucfirst($property->address->first()->province) }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p>Price: P{{ $property->price }}</p>
                                </div>
                            </div>
                            <a href="{{url('/properties/'.$property->slug)}}" class="btn btn-dark">More info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
