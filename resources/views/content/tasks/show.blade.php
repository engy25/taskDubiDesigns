@extends('layouts.layoutMaster')

@section('title', 'Order')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlRyjrVDFE3Ry_wivw70bqbH6VYccL9n0"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
@endsection

@section('page-script')
<script src="{{ asset('assets/js/offcanvas-add-payment.js') }}"></script>
{{-- <script src="{{ asset('assets/js/offcanvas-send-invoice.js') }}"></script> --}}
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
@endsection

@section('content')

@if(isset($msg))
<div class="alert alert-success">{{ $msg }}</div>
@endif

<div class="card invoice-preview-card">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
            <div class="mb-xl-0 mb-4">
                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                    <span class="app-brand-text fw-bold fs-4">
                        {{ $order->order_number }}
                    </span>
                </div>
            </div>
            <div style="max-width:20 ">
                <br>
            </div>
        </div>
    </div>

    <hr class="my-0" />

    <div class="card-body">
        <div class="row p-sm-3 p-0">
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h5 class="mb-1">Delivery First Name:</h5>
                @if($order->delivery)
                    <h6 class="mb-3">{{ $order->delivery->fname }}</h6>
                    <h5 class="mb-1">Delivery Phone:</h5>
                    <h6 class="mb-3">{{ $order->delivery->country_code ?? '' }} {{ $order->delivery->phone ?? '' }}</h6>
                @else
                    <h6 class="mb-3">This Delivery Does not have last name</h6>
                @endif

                <h5 class="mb-1">User First Name:</h5>
                <h6 class="mb-3">{{ $order->user->fname }}</h6>
                <h5 class="mb-1">User Phone:</h5>
                <h6 class="mb-3">{{ $order->user->phone }}</h6>
                <h4 class="mb-1">Address:</h4>
                <h5 class="mb-1">From(من):</h5>
                <h6 class="mb-3">{{ $order->from }}</h6>
                <h5 class="mb-1">To:(الي)</h5>
                <h6 class="mb-3">{{ $order->to }}</h6>

                <h5 class="mb-1">Base Price:</h5>
                <h6 class="mb-3">{{ $order->base_price }}</h6>
                <h5 class="mb-1">Price Per Distance</h5>
                <h6 class="mb-3">{{ $order->price_per_distance }}</h6>
                <h5 class="mb-1">Price Per Minute</h5>
                <h6 class="mb-3">{{ $order->price_per_minute }}</h6>
            </div>

            <div class="col-xl-6 col-md-12 col-sm-7 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h4 class="mb-1">Expected Money:</h4>
                <h6 class="mb-3">{{ $order->expected_salary }} {{ $defaultCurrency->isocode }}</h6>
                <h4 class="mb-1">Total:</h4>
                <h6 class="mb-3">{{ $order->salary }} {{ $defaultCurrency->isocode }}</h6>
                <h4 class="mb-1">Tax:</h4>
                <h6 class="mb-3">{{ $order->tax }} {{ $defaultCurrency->isocode }}</h6>
                <h4 class="mb-1">Expected Distance:</h4>
                <h6 class="mb-3">{{ $order->expected_distance }}</h6>
                <h4 class="mb-1">Distance:</h4>
                <h6 class="mb-3">{{ $order->distance ?? 'Distance still unknown' }}</h6>
                <h4 class="mb-1">Expected Time:</h4>
                <h6 class="mb-3">{{ $order->expected_time }}</h6>
                <h4 class="mb-1">Actual Time:</h4>
                <h6 class="mb-3">{{ $order->delivery_time ?? 'Time still unknown' }}</h6>
                <h4 class="mb-1">Number Of Passengers(عدد الركاب):</h4>
                <h6 class="mb-3">{{ $order->num_of_passengers }}</h6>
                @if($order->description_of_shipment)
                <h4 class="mb-1">Description Of Shipment:</h4>
                <h6 class="mb-3">{{ $order->description_of_shipment }}</h6>
                @endif
                @if($order->When)
                <h4 class="mb-1">When(متي):</h4>
                <h6 class="mb-3">{{ $order->When }}</h6>
                @endif
                @if($order->arrival_at)
                <h4 class="mb-1">Arrival At:</h4>
                <h6 class="mb-3">{{ $order->arrival_at }}</h6>
                @endif
            </div>
        </div>

        <div class="card-body mx-3">
            <div class="row">
                <div class="col-12">
                    <h5 class="mb-1">Service Name: </h5>
                    <h6 class="mb-3">{{ $order->service->name }}</h6>
                    <h5 class="mb-1">Category:</h5>
                    <h6 class="mb-3">{{ $order->category->name }}</h6>
                    <h4 class="mb-1">Statuses:</h4>
                    @foreach($order->statuses as $status)
                        <h5 class="mb-3">{{ $status->name }}</h5>
                    @endforeach

                    @if($order->user_cancel_reason != null)
                    <h5 class="mb-1">User Cancel Reason:</h5>
                    <h6 class="mb-3">{{ $order->user_cancel_reason }}</h6>
                    @endif

                    @if($order->driver_cancel_reason != null)
                    <h5 class="mb-1">DriverCancel Reason:</h5>
                    <h6 class="mb-3">{{ $order->driver_cancel_reason }}</h6>
                    @endif

                </div>
                <div id="map" style="height: 400px;"></div>

                <script>
                  function initMap() {
                      var map = new google.maps.Map(document.getElementById('map'), {
                          center: {lat: {{ $order->from_lat }}, lng: {{ $order->from_lng }}},
                          zoom: 8 // Adjust zoom level as needed
                      });

                      var fromLatLng = new google.maps.LatLng({{ $order->from_lat }}, {{ $order->from_lng }});
                      var toLatLng = new google.maps.LatLng({{ $order->to_lat }}, {{ $order->to_lng }});

                      var line = new google.maps.Polyline({
                          path: [fromLatLng, toLatLng],
                          geodesic: true,
                          strokeColor: '#FF0000',
                          strokeOpacity: 1.0,
                          strokeWeight: 2
                      });

                      line.setMap(map);
                  }
              </script>

              <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlRyjrVDFE3Ry_wivw70bqbH6VYccL9n0&callback=initMap"></script>

            </div>
        </div>
    </div>
</div>

@endsection
