<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Feed Consumption Report - {{ $date }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Daily Feed Consumption Report</h1>
    <p>Date: {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
    <p>Total Consumption: {{ number_format($totalConsumption, 2) }} kg</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Feed Name</th>
                <th>Consumed Quantity</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedConsumption as $log)
                <tr>
                    <td>{{ $log->created_at->format('Y-m-d') }}</td>
                    <td>{{ $log->item->name }}</td>
                    <td>{{ number_format(abs($log->quantity_change), 2) }}</td>
                    <td>{{ $log->item->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>