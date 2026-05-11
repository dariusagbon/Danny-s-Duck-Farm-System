<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; }
        h1 { font-size: 20px; margin-bottom: 0.5rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { border: 1px solid #d1d5db; padding: 0.75rem; }
        th { background: #f8fafc; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h1>Inventory Report</h1>
    <p>Generated: {{ now()->format('M d, Y H:i') }}</p>

    <h2>Egg Inventory</h2>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Quantity</th>
                <th>Current Stock</th>
                <th>Min Stock</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eggStock as $egg)
                <tr>
                    <td>{{ $egg->egg_type }}</td>
                    <td>{{ number_format($egg->quantity) }}</td>
                    <td>{{ number_format($egg->current_stock, 2) }}</td>
                    <td>{{ number_format($egg->min_stock_level, 2) }}</td>
                    <td class="text-right">{{ number_format($egg->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="margin-top: 1.5rem;">Feed Inventory</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Current Stock</th>
                <th>Min Stock</th>
                <th>Unit</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($feedsStock as $feed)
                <tr>
                    <td>{{ $feed->name }}</td>
                    <td>{{ number_format($feed->current_stock, 2) }}</td>
                    <td>{{ number_format($feed->min_stock_level, 2) }}</td>
                    <td>{{ $feed->unit }}</td>
                    <td class="text-right">{{ number_format($feed->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
