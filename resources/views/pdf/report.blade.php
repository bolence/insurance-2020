<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
            body {
                font-family: DejaVu Sans;
            }

            .page-break {
                page-break-after: always;
            }

            .right_bolder {
                font-weight: bold;
                text-align: right;
                color: red;
            }


    </style>
</head>

<body>

  <section class="container">

    <h3>Isticanje osiguranja za mesec  {{ $month }} {{ $year }}.godine - {{ count($data) }} vozila
        <span style="font-size: 15px; float: right; color: blue; padding-top: 5px;"> Izveštaj kreiran {{ date('d.m.Y H:i') }} </span>
    </h3>

    <table class="table table-striped table-bordered">
        <thead class="thead-inverse" style="background-color: #F6DE42 !important">
            <tr>
                <th>Vozilo</th>
                <th>Registarski broj</th>
                <th>Datum isticanja osiguranja</th>
                <th>Visina prošle premije</th>
            </tr>
            </thead>
            <tbody>
                @foreach( $data as $vehicle )
                <tr>
                    <td>{{ $vehicle->vozilo }}
                        @if( !is_null($vehicle->steta) )
                        <span class="text-danger" style="font-size:9px; font-weight: bold;"> Bonus malus {{ date('d.m.Y', strtotime($vehicle->datum_udesa)) }}</span>
                        @endif
                    </td>
                    <td>{{ $vehicle->registracija }}</td>
                    <td><span style="float:right;font-weight: bolder;">{{ date('d.m.Y', strtotime($vehicle->datum_isticanja_osiguranja)) }}</span></td>
                    <td><span style="float:right;font-weight: bolder;">{{ number_format($vehicle->visina_premije,2) }}</span></td>
                </tr>
                @endforeach

                <tr>
                        <td colspan="3" class="right_bolder">Okvirna suma polisa:</td>
                        <td class="right_bolder">{{ number_format($sum,2) }}</td>
                </tr>

            </tbody>
    </table>
    @if($count_damages > 0)
    <p class="text-danger"><b>Napomena:</b> Za {{ $count_damages }} vozilo/a postoji šteta u prošloj godini i suma polisa će biti veća za procenat bonus malus.</p>
    @endif
  </section>

</body>

</html>


