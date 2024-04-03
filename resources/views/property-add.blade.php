@extends('layout.app')
@section('title', 'Add Property')

@section('content')
    <div class="container py-5">
        <h1 class="border-dark border-bottom py-3 mb-3">Add New Listing</h1>
        <form action="{{ url('properties') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control border border-dark" name="title" id="title"
                        value="{{ @old('title') }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control border border-dark pe-none" name="slug" id="slug"
                        value="{{ @old('slug') }}">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="price" class="form-label">Price (per night)</label>
                    <input type="number" class="form-control border border-dark" name="price" id="price"
                        value="{{ @old('price') }}">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="cp" class="form-label">Cancellation Policy</label>
                    <select class="form-select border border-dark" name="cp" id="cp">
                        <option value=""><-- Select Policy --></option>
                        @foreach ($policies as $policy)
                            <option value="{{ $policy->id }}">{{ ucfirst($policy->name) }} -
                                {{ $policy->description }}</option>
                        @endforeach
                    </select>
                    @error('cp')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select border border-dark" name="type" id="type">
                        <option value=""><-- Select Type --></option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="province" class="form-label">Province</label>
                    <select class="form-select border border-dark" name="province" id="province"
                        onchange="getProvince(this, municipality)">
                    </select>
                    @error('province')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="municipality" class="form-label">Municipality</label>
                    <select class="form-select border border-dark" name="municipality" id="municipality" disabled
                    onchange="getCity(this, brgy)"
                    >
                    </select>
                    @error('municipality')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="brgy" class="form-label">Barangay</label>
                    <select class="form-select border border-dark" name="brgy" id="brgy" disabled>
                    </select>
                    @error('brgy')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-control border border-dark" id="capacity"
                        value="{{ @old('capacity') }}">
                    @error('capacity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Beds</label>
                    <input type="number" name="no_beds" class="form-control border border-dark" id="no_beds"
                        value="{{ @old('no_beds') }}">
                    @error('no_beds')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Bedrooms</label>
                    <input type="number" name="no_bedrooms" class="form-control border border-dark" id="no_bedrooms"
                        value="{{ @old('no_bedrooms') }}">
                    @error('no_bedrooms')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Bathrooms</label>
                    <input type="number" name="no_bathrooms" class="form-control border border-dark" id="no_bathrooms"
                        value="{{ @old('no_bathrooms') }}">
                    @error('no_bathrooms')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control border border-dark" name="description" id="description" style="height: 100px"> {{ @old('description') }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold fs-4">Amenities</label>
                    <div class="row">
                        @foreach ($amenities as $amenity)
                            <div class="col-3 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input border border-dark" type="checkbox" name="amenities[]"
                                        value="{{ $amenity->id }}">
                                    <label class="form-check-label">
                                        {{ $amenity->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('amenities')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <a href="{{ url('/') }}" class="btn btn-danger w-100">Cancel</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100" id="create">Add New Listing</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        titleTag = document.getElementById("title")
        slugTag = document.getElementById("slug")

        titleTag.addEventListener("input", function(e) {
            titleTag.value = title.value.replace(/[^a-zA-Z0-9\s]+/g, '')
            slugTag.value = e.target.value.replace(/[^a-zA-Z0-9]+|\s+/g, '-').toLowerCase()
        })

        async function getProvince(tag, id){
            brgyTag = document.getElementById("brgy")
            brgyTag.innerHTML = ''
            brgyTag.setAttribute('disabled', '')
            selectedId = tag.options[tag.selectedIndex].getAttribute('code')
            getName = id.getAttribute('id')
            data = await fetchData(`/airbnb/properties/getAddress?province=${selectedId}`)
            id.removeAttribute('disabled')
            populateTag(id, data, `city_code`, `city_name`, 'Municipality')
        }

        async function getCity(tag, id){
            selectedId = tag.options[tag.selectedIndex].getAttribute('code')
            getName = id.getAttribute('id')
            data = await fetchData(`/airbnb/properties/getAddress?city=${selectedId}`)
            id.removeAttribute('disabled')
            populateTag(id, data, `brgy_code`, `brgy_name`, 'Barangay')
        }

        function fetchData(url) {
            return fetch(url).then(res => res.json())
        }

        function populateTag(tag, data, key1, key2, name){
            tag.innerHTML = ''
            tag.innerHTML += `<option value=""><-- Select ${name} --></option>`
            data.forEach(item => {
                tag.innerHTML += `<option code="${item[key1]}" value="${item[key2]}">${item[key2]}</option>`
            });
        }

        async function province(){
            provinceTag = document.getElementById("province")
            data = await fetchData('/airbnb/properties/getAddress')
            data.filter((a,b) => a.province_name.localeCompare(b.province_name))
            populateTag(provinceTag, data, 'province_code', 'province_name', 'Province')
        }

        province()
    </script>
@endsection
