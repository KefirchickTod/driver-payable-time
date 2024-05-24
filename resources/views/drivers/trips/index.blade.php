<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>
<body>
<div>
    <form method="post" action="{{route('drivers.trips.save')}}" enctype="multipart/form-data">
        @csrf
        <label>Load file</label>
        <input type="file" name="file" accept=".csv" />
        <input type="submit" />
    </form>
    <table>
        <thead>
        <tr>
            <th>Driver Id</th>
            <th>Payable Time (Minutes)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td>{{$group->getId()}}</td>
                <td>{{$group->getTrips()->calculatePayableTime()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
