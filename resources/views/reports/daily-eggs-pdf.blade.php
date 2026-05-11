<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Egg Production Report - {{ $date }}</title>
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
    <h1>Daily Egg Production Report</h1>
    <p>Date: {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
    <p>Total Production: {{ number_format($totalProduction) }} eggs</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Egg Type</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Current Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eggs as $egg)
                <tr>
                    <td>{{ $egg->date->format('Y-m-d') }}</td>
                    <td>{{ $egg->egg_type }}</td>
                    <td>{{ number_format($egg->quantity) }}</td>
                    <td>{{ number_format($egg->price, 2) }}</td>
                    <td>{{ number_format($egg->current_stock) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>