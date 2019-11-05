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

    <h3>Štete za {{ $year }}. godinu - {{ count($data) }} vozila
        <span style="font-size: 15px; float: right; color: blue; padding-top: 5px;"> Izveštaj kreiran {{ date('d.m.Y H:i') }} </span>
    </h3>

    <table class="table table-striped table-bordered">
        <thead class="thead-inverse" style="background-color: #F6DE42 !important">
            <tr>
                <th>Vozilo</th>
                <th>Vozač</th>
                <th>Datum udesa</th>
                <th>Mesto udesa</th>
                <th>Kriv</th>
                <th>Opis</th>
            </tr>
            </thead>
            <tbody>
                @foreach( $data as $damage )
                <tr>
                    <td>{{ $damage->name }}</td>
                    <td>{{ $damage->ime_vozaca }}</td>
                    <td><span style="float:right;font-weight: bolder;">{{ date('d.m.Y', strtotime($damage->datum_udesa)) }}</span></td>
                    <td>{{ $damage->mesto_udesa }}</td>
                    <td>{{ $damage->kriv }}</td>
                    <td>{{ $damage->opis }}</td>
                </tr>
                @endforeach
            </tbody>
    </table>
  </section>

</body>

</html>


