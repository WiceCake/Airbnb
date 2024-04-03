@extends('layout.app')
@section('title', 'Edit Property')

@section('content')
    <div class="container py-5">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <h1 class="border-dark border-bottom py-3 mb-3">Edit {{ $property->property_title }}</h1>
        <form action="{{ url('properties/' . $slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control border border-dark" name="title" id="title"
                        value="{{ $property->property_title }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control border border-dark pe-none" name="slug" id="slug"
                        value="{{ $property->slug }}">
                    @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="price" class="form-label">Price (per night)</label>
                    <input type="number" class="form-control border border-dark" name="price" id="price"
                        value="{{ $property->price }}">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6 mb-3">
                    <label for="cp" class="form-label">Cancellation Policy</label>
                    <select class="form-select border border-dark" name="cp" id="cp">
                        <option value=""><-- Select Policy --></option>
                        @foreach ($policies as $policy)
                            <option value="{{ $policy->id }}" @if ($property->policy->first()->id == $policy->id) selected @endif>
                                {{ ucfirst($policy->name) }} -
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
                            <option value="{{ $type->id }}" @if ($property->type->first()->id == $type->id) selected @endif>
                                {{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="province" class="form-label">Province</label>
                    <input type="hidden" id="provinceName" value="{{ $property->address->first()->province }}">
                    <select class="form-select border border-dark" name="province" id="province"
                    onchange="getProvince(this, municipality)">
                    </select>
                    @error('province')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="municipality" class="form-label">Municipality</label>
                    <input type="hidden" id="municipalityName" value="{{ $property->address->first()->municipality }}">
                    <select class="form-select border border-dark" name="municipality" id="municipality"
                    onchange="getCity(this, brgy)">
                    </select>
                    @error('municipality')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="brgy" class="form-label">Barangay</label>
                    <input type="hidden" id="brgyName" value="{{ $property->address->first()->barangay }}">
                    <select class="form-select border border-dark" name="brgy" id="brgy" disabled>
                    </select>
                    @error('brgy')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-3 mb-3">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-control border border-dark" id="capacity"
                        value="{{ $property->capacity }}">
                    @error('capacity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Beds</label>
                    <input type="number" name="no_beds" class="form-control border border-dark" id="no_beds"
                        value="{{ $property->no_of_beds }}">
                    @error('no_beds')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Bedrooms</label>
                    <input type="number" name="no_bedrooms" class="form-control border border-dark" id="no_bedrooms"
                        value="{{ $property->no_of_bedrooms }}">
                    @error('no_bedrooms')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4 mb-3">
                    <label for="no_beds" class="form-label">No. of Bathrooms</label>
                    <input type="number" name="no_bathrooms" class="form-control border border-dark" id="no_bathrooms"
                        value="{{ $property->no_of_bathrooms }}">
                    @error('no_bathrooms')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control border border-dark" name="description" id="description" style="height: 100px"> {{ $property->description }}</textarea>
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
                                        @if (in_array($amenity->id, $property->amenities->pluck('id')->toArray())) checked @endif value="{{ $amenity->id }}">
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
                    <button type="submit" class="btn btn-primary w-100" id="create">Edit Listing</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        provinceTag = document.getElementById("province")
        municipalityTag = document.getElementById("municipality")
        brgyTag = document.getElementById("brgy")
        titleTag = document.getElementById("title")
        slugTag = document.getElementById("slug")

        municipalityFlag = true
        brgyFlag = true

        titleTag.addEventListener("input", function(e) {
            titleTag.value = title.value.replace(/[^a-zA-Z0-9\s]+/g, '')
            titleSlug = e.target.value.replace(/[^a-zA-Z0-9]+|\s+/g, '-').toLowerCase()
            slugTag.value = titleSlug
        })

        function fetchData(url) {
            return fetch(url).then(res => res.json())
        }

        function populateTag(tag, data, key1, key2, name, selected){
            tag.innerHTML = ''
            tag.innerHTML += `<option value=""><-- Select ${name} --></option>`
            data.forEach(item => {
                selectedItem = selected == item[key2] ? 'selected' : ''
                tag.innerHTML += `<option code="${item[key1]}" value="${item[key2]}" ${selectedItem}>${item[key2]}</option>`
            });
        }

        async function getProvince(tag, id){
            brgyTag = document.getElementById("brgy")
            brgyTag.innerHTML = ''
            brgyTag.setAttribute('disabled', '')
            selectedId = tag.options[tag.selectedIndex].getAttribute('code')
            getName = id.getAttribute('id')
            data = await fetchData(`/airbnb/properties/getAddress?province=${selectedId}`)
            id.removeAttribute('disabled')
            selected = document.getElementById('municipalityName').value
            populateTag(id, data, `city_code`, `city_name`, 'Municipality', selected)
            getCity(municipalityTag, brgyTag)
        }

        async function getCity(tag, id){
            selectedId = tag.options[tag.selectedIndex].getAttribute('code')
            getName = id.getAttribute('id')
            data = await fetchData(`/airbnb/properties/getAddress?city=${selectedId}`)
            id.removeAttribute('disabled')
            selected = document.getElementById('brgyName').value
            populateTag(id, data, `brgy_code`, `brgy_name`, 'Barangay', selected)
        }
        

        // function dropdown(dropdown, name, data, value, text, province_name) {
        //     dropdown.innerHTML = `<option value="">--Select ${name}--</option>`
        //     data.forEach(item => {
        //         selected = item[text].toLowerCase() == province_name ? 'selected' : ''
        //         dropdown.innerHTML +=
        //             `<option code="${item[value]}" ${selected} value="${item[text].toLowerCase()}">${item[text]}</option>`
        //     })
        // }

        // async function provinceDropdown() {
        //     provinceName = document.getElementById("provinceName").value
        //     const provinceData = await fetchData('/airbnb/public/storage/province.json')
        //     provinceData.sort((a, b) => a.province_name.localeCompare(b.province_name))
        //     dropdown(provinceTag, 'Province', provinceData, 'province_code', 'province_name', provinceName)
        //     municipalityDropdown()
        // }

        // async function municipalityDropdown() {
        //     brgyTag.setAttribute('disabled', '')
        //     brgyTag.innerHTML = ''
        //     if (municipalityFlag) {
        //         municipalityName = document.getElementById("municipalityName").value
        //         municipalityFlag = false
        //     }
        //     selectedValue = provinceTag.options[provinceTag.selectedIndex].getAttribute('code')
        //     if (selectedValue) {
        //         municipalityTag.removeAttribute('disabled')
        //         const municipalityData = await fetchData('/airbnb/public/storage/city.json')
        //         const filteredMunicipality = municipalityData.filter(municipality => municipality.province_code ==
        //             selectedValue)
        //         filteredMunicipality.sort((a, b) => a.city_name.localeCompare(b.city_name))
        //         dropdown(municipalityTag, 'Municipality', filteredMunicipality, 'city_code', 'city_name',
        //             municipalityName)
        //         brgyDropdown()
        //     } else {
        //         municipalityTag.setAttribute('disabled', '')
        //     }
        // }

        // async function brgyDropdown() {
        //     if (brgyFlag) {
        //         brgyName = document.getElementById("brgyName").value
        //         brgyFlag = false
        //     }
        //     selectedValue = municipalityTag.options[municipalityTag.selectedIndex].getAttribute('code')
        //     if (selectedValue) {
        //         brgyTag.removeAttribute('disabled')
        //         const brgyData = await fetchData('/airbnb/public/storage/barangay.json')
        //         const filteredBrgy = brgyData.filter(brgy => brgy.city_code == selectedValue)
        //         filteredBrgy.sort((a, b) => a.brgy_name.localeCompare(b.brgy_name))
        //         dropdown(brgyTag, 'Barangay', filteredBrgy, 'brgy_code', 'brgy_name', brgyName)
        //     } else {
        //         brgyTag.setAttribute('disabled', '')
        //     }
        // }

        async function province(){
            provinceTag = document.getElementById("province")
            data = await fetchData('/airbnb/properties/getAddress')
            data.filter((a,b) => a.province_name.localeCompare(b.province_name))
            selected = document.getElementById('provinceName').value
            populateTag(provinceTag, data, 'province_code', 'province_name', 'Province', selected)
            getProvince(provinceTag, municipalityTag)
        }

        province()

        // provinceDropdown()
        // provinceTag.addEventListener('change', municipalityDropdown)
        // municipalityTag.addEventListener('change', brgyDropdown)
    </script>
@endsection
