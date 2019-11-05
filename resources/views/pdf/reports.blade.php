@extends('layouts.master')
@push('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')

<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Izaberi mesec i godinu za izveštaj osiguranja</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('generate-pdf', ['download' => 'pdf']) }}">
              <div class="card-body">

                <div class="row">

                    <div class="col-3">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mesec</label>
                            <select name="month" id="month" class="form-control">
                                <option value="">Izaberi mesec</option>
                                @for( $i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                    </div>


                    <div class="col-3">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Godina</label>
                            <select name="year" id="year" class="form-control" >
                                <option value="">Izaberi godinu</option>
                                @for($i = 2019; $i <= 2030; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor

                            </select>
                        </div>

                    </div>


                </div>

              <div class="card-footer">

                <button type="submit" class="btn btn-primary float-right">
                    <i class="fa fa-pdf"></i>
                    Napravi izveštaj
                    </button>

              </div>
            </form>
          </div>
        </div>


    <!-- left column -->
    <div class="col">
      <!-- general form elements -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Napravi izveštaj za štete </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ route('generate-pdf-damage', ['download' => 'pdf']) }}">
          <div class="card-body">

            <div class="row">

                <div class="col-3">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Godina</label>
                        <select name="year" id="year" class="form-control" >
                            <option value="">Izaberi godinu</option>
                            @for($i = 2015; $i <= 2030; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor

                        </select>
                    </div>

                </div>


            </div>

          <div class="card-footer">

            <button type="submit" class="btn btn-primary float-right">
                <i class="fa fa-pdf"></i>
                Napravi izveštaj
                </button>

          </div>
        </form>
      </div>
    </div>

</div>




</section>

@endsection
