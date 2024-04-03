@extends('layout.app')
@section('title', $property->property_title)

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            @if (session()->has('message'))
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="col-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="col-6">
                <h1>{{ $property->property_title }}
                    @if ($property->status == 'unlisted')
                        <span class="badge text-bg-secondary fw-light">Unlisted</span>
                    @endif
                </h1>
                <p>Date listed/created: {{ $property->created_at->format('F j, Y') }}</p>
            </div>
            <div class="col-6 text-end">
                <form action="{{ url('/properties/' . $slug . '/editStatus') }}" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($property->status == 'listed')
                        <input type="hidden" name="status" value="unlisted" class="d-none">
                        <button type="submit" class="btn btn-primary px-5">Unlist</button>
                    @else
                        <input type="hidden" name="status" value="listed" class="d-none">
                        <button type="submit" class="btn btn-primary px-5">List</button>
                    @endif
                    <a href="{{ url('properties/' . $slug . '/edit') }}" class="btn btn-primary px-5">Edit</a>
                </form>
            </div>
            <hr>
            {{-- Photos, Rating, Discount Section --}}
            <div class="col-3 pe-3">
                <p class="fs-5">Photos:</p>
                <div class="row g-2">
                    @if ($pictures->count() != 0)
                        @foreach ($pictures->take(4) as $picture)
                            <div class="col-6">
                                <img class="img-fluid rounded" src="{{ asset($picture->path) }}" alt="property picture"
                                    style="height:150px">
                            </div>
                        @endforeach
                    @endif
                    @for ($i = $pictures->count() + 1; $i <= 4; $i++)
                        <div class="col-6">
                            <div class="card" style="height:150px"></div>
                        </div>
                    @endfor
                </div>
                <button type="button" class="btn btn-primary my-3 w-100" data-bs-toggle="modal"
                    data-bs-target="#imageUpload">
                    + Add Photo
                </button>
                <div class="bg-white rounded border border-black border-opacity-25 text-center">
                    <p class="fs-1 fw-bold mb-0">
                        @if ($property->reviews->count())
                            @php
                                $ratings =
                                    $property->reviews->pluck('rating')->sum() /
                                    $property->reviews->pluck('rating')->count();
                            @endphp
                            {{ number_format($ratings, 2) }}
                        @else
                            0
                        @endif
                    </p>
                    <p class="fs-1">
                        @if ($property->reviews->count())
                            @for ($i = 0; $i < floor($ratings); $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                            @for ($i = floor($ratings); $i < 5; $i++)
                                <i class="bi bi-star"></i>
                            @endfor
                        @else
                            @for ($i = 0; $i < 5; $i++)
                                <i class="bi bi-star"></i>
                            @endfor
                        @endif
                    </p>
                    <p>Avg Guest Rating</p>
                </div>
                <p class="fs-5 my-3">Discount offered:</p>
                @foreach ($property->discounts->sortBy('discount_id') as $discount)
                    <div class="discount bg-white rounded border border-dark border-opacity-25 p-2 mb-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="m-0">
                                {{ $discount->discountDetail->name }}
                                @if ($discount->changed_value)
                                    ({{ $discount->changed_value * 100 }}%)
                                @else
                                    ({{ $discount->discountDetail->percentage * 100 }}%)
                                @endif
                            </p>
                            <div>
                                <button class="btn btn-primary"
                                    onclick="editDiscount({{ $discount->id }}, '{{ $discount->discountDetail->name }}')"
                                    data-bs-toggle="modal" data-bs-target="#editDiscount"><i
                                        class="bi bi-pencil"></i></button>
                                <button class="btn btn-primary"
                                    onclick="deleteDiscount({{ $discount->id }},'{{ $discount->discountDetail->name }}')"
                                    data-bs-toggle="modal" data-bs-target="#deleteDiscount"><i
                                        class="bi bi-trash3"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($discounts->count())
                    <button class="btn btn-primary my-3 w-100" data-bs-toggle="modal" data-bs-target="#addDiscount">+ Add a
                        New Discount Promo</button>
                @endif
            </div>
            <div class="col-9 pt-3 ps-5 border-start">
                <div class="row">
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2"><strong>Price
                                (per night):</strong> P
                            {{ $property->price }}</p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2">
                            <strong>Cancellation Policy:</strong>
                            {{ ucfirst($property->policy->first()->name) }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2">
                            <strong>Type:</strong>
                            {{ $property->type->first()->name }}
                        </p>
                    </div>
                    <div class="col-8">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2">
                            <strong>Address:</strong>
                            {{ ucfirst($property->address->first()->barangay) }},
                            {{ ucfirst($property->address->first()->municipality) }},
                            {{ ucfirst($property->address->first()->province) }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2">
                            <strong>Capacity:</strong>
                            {{ $property->capacity }} persons
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2"><strong>No. of
                                beds:</strong>
                            {{ $property->no_of_beds }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2"><strong>No.
                                of
                                bedrooms:</strong>
                            {{ $property->no_of_bedrooms }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="border bg-white border-opacity-25 border-black rounded shadow-sm px-2 py-2"><strong>No.
                                of
                                bathrooms:</strong>
                            {{ $property->no_of_bathrooms }}
                        </p>
                    </div>
                    <div class="col-12">
                        <p class=" fw-bold">Description:</p>
                        <p>{{ $property->description }}</p>
                    </div>
                    <hr class="mb-5">
                    <hr>
                    <div class="col-12 my-3">
                        <p class="fw-bold">Amenities</p>
                        <div class="row">
                            @foreach ($property->amenities as $amenity)
                                <div class="col-3">
                                    <p
                                        class="border border-opacity-25 bg-white border-black rounded shadow-sm px-2 py-2 fw-light">
                                        <i class="bi bi-box-fill"></i> {{ $amenity->name }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-5">
                        <hr>
                    </div>
                    <div class="col-2 text-center">Latest Reviews:</div>
                    <div class="col-5">
                        <hr>
                    </div>
                    <div class="col-12 py-3">
                        <div class="row g-3">
                            @foreach ($property->reviews->sortByDesc('created_at')->take(4) as $review)
                                <div class="col-6">
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
                                                <p class="text-truncate">{{ $review->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-5">
                        <hr>
                    </div>
                    <div class="col-2 text-center">
                        <a class="btn btn-primary" href="{{url('/properties/'.$slug.'/reviews')}}">View All Reviews</a>
                    </div>
                    <div class="col-5">
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Upload -->
    <div class="modal fade" id="imageUpload" tabindex="-1" aria-labelledby="imageUploadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-0" id="imageUploadLabel">Upload Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('properties/' . $slug . '/addPhoto') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" name="photo" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Discount Modal -->
    <div class="modal fade" id="addDiscount" tabindex="-1" aria-labelledby="addDiscountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-0" id="addDiscountLabel">Available Discounts</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($discounts as $discount)
                        <form class="mb-2" action="{{ url('/properties/' . $slug . '/addDiscount') }}" method="POST">
                            @csrf
                            <input type="hidden" name="discount_id" value="{{ $discount->id }}">
                            <div class="rounded border border-dark px-3 py-2">
                                <p class="m-0 fw-bold mb-2">
                                    {{ $discount->name }} (%)
                                </p>
                                <div class="row g-3">
                                    <div class="col-9">
                                        <input class="form-control border border-dark mb-3" type="number" name="value"
                                            value="{{ $discount->percentage * 100 }}">
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary w-100">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Discount Modal -->
    <div class="modal fade" id="editDiscount" tabindex="-1" aria-labelledby="editDiscountLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-0" id="editDiscountLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/properties/' . $slug . '/editDiscount') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label class="label-control mb-3" for="editId">Discount (%)</label>
                        <input type="hidden" name="discount_id" id="editId">
                        <input type="number" class="form-control border border-dark" name="percentage">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Discount Modal -->
    <div class="modal fade" id="deleteDiscount" tabindex="-1" aria-labelledby="deleteDiscountLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-0" id="deleteDiscountLabel">Delete Discount</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/properties/' . $slug . '/removeDiscount') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" id="deleteId" name="discount_id">
                        <h2 id="deleteMessage"></h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editDiscount(id, description) {
            editInput = document.getElementById('editId');
            editTitle = document.getElementById('editDiscountLabel');
            console.log(editTitle)
            editInput.value = id
            editTitle.innerHTML = `Edit Discount "${description}"?`
        }

        function deleteDiscount(id, description) {
            deleteInput = document.getElementById('deleteId');
            deleteMessage = document.getElementById('deleteMessage');
            deleteInput.value = id
            deleteMessage.innerHTML = `Are your sure you want to delete "${description}"?`
        }
    </script>

@endsection
