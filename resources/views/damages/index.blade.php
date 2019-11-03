@extends('layouts.master')
@push('css')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/j-pro/css/demo.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/j-pro/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/pages/j-pro/css/j-pro-modern.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
<link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}">


@endpush

@section('content')


                  <!-- Page-body start -->
                  <div class="page-body">
                    <!-- DOM/Jquery table start -->
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5>DOM/Jquery</h5>
                            <span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span>
                        </div> --}}

                        <div class="card-block">
                        <div id="app">
                            <vuetable-damages-component></vuetable-damages-component>
                        </div>
                    </div>
                </div>
                <!-- DOM/Jquery table end -->

            </div>


@endsection

@push('js')

<script type="text/javascript" src="{{ asset('assets/pages/j-pro/js/custom/form-job.js') }}"></script>

@endpush
