@extends('layout.app')
@section('title', 'Bookings')

@section('content')
    <div class="container-fluid p-5" style="min-height: 100vh">
        <div class="row">
            <div class="col-4">
                <h2>Bookings</h2>
            </div>
            <div class="col-8 text-end">
                <form action="{{url('/bookings')}}" id="formSort">
                    <label for="filterSelectId" class="w-25 d-inline me-3">Property:</label>
                    <select class="form-select border border-dark w-25 d-inline me-3" name="properties"
                        onchange="selectProperty(this)" id="filterSelectId">
                        <option>All Properties</option>
                        @foreach ($properties as $property)
                            <option value="{{ $property->property->id }}" @if (request()->get('properties') == $property->property->id) selected @endif>
                                {{ $property->property->property_title }}</option>
                        @endforeach
                    </select>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-dark" 
                        @if(request()->get('bookings') == 'ub') checked @endif
                        name="bookings" type="checkbox" id="ubradio" onchange="checkBox(this, pbradio, cbradio)" value="ub">
                        <label class="form-check-label" for="ubradio">
                            Upcoming Bookings
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-dark" 
                        @if(request()->get('bookings') == 'pb') checked @endif
                        name="bookings" type="checkbox" id="pbradio" onchange="checkBox(this, ubradio, cbradio)" value="pb">
                        <label class="form-check-label" for="pbradio">
                            Past Bookings
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input border border-dark" 
                        @if(request()->get('bookings') == 'cb') checked @endif
                        name="bookings" type="checkbox" id="cbradio" onchange="checkBox(this, pbradio, ubradio)" value="cb">
                        <label class="form-check-label" for="pbradio">
                            Cancelled Bookings
                        </label>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-2">
                <table class="table table-striped table-bordered border-dark">
                    <thead>
                        <td class="fw-bold">Property</td>
                        <td class="fw-bold">Guest</td>
                        <td class="fw-bold">Date Booked</td>
                        <td class="fw-bold">Check In Date</td>
                        <td class="fw-bold">Check Out Date</td>
                        <td class="fw-bold">Cancelled?</td>
                        <td class="fw-bold">Amount Paid</td>
                    </thead>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->property->property_title }}</td>
                            <td>
                                {{ $booking->guest->first_name }}
                                {{ $booking->guest->middle_name }}
                                {{ $booking->guest->last_name }}
                            </td>
                            <td>
                                {{ $booking->booking_date }}
                            </td>
                            <td>
                                {{ $booking->check_in_date }}
                            </td>
                            <td>
                                {{ $booking->check_out_date }}
                            </td>
                            <td>
                                {{$booking->isCancelled ? 'Yes' : 'No'}}
                            </td>
                            <td>
                                P {{ $booking->price }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-6">
                <div class="d-inline">Page {{ $bookings->currentPage() }} of {{ $bookings->lastPage() }}</div>
            </div>
            <div class="col-6 text-end">
                @if (!$bookings->onFirstPage())
                    <a class="btn btn-primary"
                        href="{{ $bookings->previousPageUrl() }}@if (request()->has('property')) &property={{ request()->property }} @endif @if (request()->has('bookings')) &bookings={{ request()->bookings }} @endif
                        "><i
                            class="bi bi-caret-left-fill"></i></a>
                @endif
                @if ($bookings->hasMorePages())
                    <a class="btn btn-primary"
                        href="{{ $bookings->nextPageUrl() }}@if (request()->has('property')) &property={{ request()->property }} @endif @if (request()->has('bookings')) &bookings={{ request()->bookings }} @endif
                        "><i
                            class="bi bi-caret-right-fill"></i></a>
                @else
                @endif
            </div>
        </div>
    </div>

    <script>
        function selectProperty(data) {
            document.getElementById('formSort').submit()
        }

        function checkBox(currentCB, cb1, cb2) {
            cb1.checked = false
            cb2.checked = false
            document.getElementById('formSort').submit()
        }
    </script>
@endsection
