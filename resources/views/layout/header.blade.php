<header class="border-bottom border-dark border-opacity-25">
    <div class="container-fluid px-5 py-3">
        <div class="d-flex justify-content-between">
            <h1>TurisTahanan</h1>
            <div>
                <p class="text-end m-0 mb-2">Welcome {{auth()->user()->username}}</p>
                <a class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover" href="{{url('/')}}">Property Listings</a>
                /
                <a class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover" href="{{url('/bookings')}}">Bookings</a>
                /
                <a class="link-dark link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover" href="{{url('/logout')}}">Logout</a>
            </div>
        </div>
    </div>
</header>