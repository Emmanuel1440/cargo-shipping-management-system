<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipment Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Shipment Report</h2>
    <table>
        <thead>
            <tr>
                <th>Cargo Type</th>
                <th>Client</th>
                <th>Weight</th>
                <th>From</th>
                <th>To</th>
                <th>Ship</th>
                <th>Status</th>
                <th>Departure</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $shipment)
            <tr>
                <td>{{ $shipment->cargo->type }}</td>
                <td>{{ $shipment->cargo->client->first_name }} {{ $shipment->cargo->client->last_name }}</td>
                <td>{{ $shipment->cargo->weight }} kg</td>
                <td>{{ $shipment->cargo->origin->name }}</td>
                <td>{{ $shipment->cargo->destination->name }}</td>
                <td>{{ $shipment->ship->name }}</td>
                <td>{{ ucfirst($shipment->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($shipment->departure_date)->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
