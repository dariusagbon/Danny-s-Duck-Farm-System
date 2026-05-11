<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
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
    <h1>Sales Report</h1>
    <p>Generated: {{ now()->format('M d, Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Eggs Sold</th>
                <th>Gross Income</th>
                <th>Expenses</th>
                <th>Net Income</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->month_of->format('Y-m-d') }}</td>
                    <td>{{ optional($sale->customer)->name ?? 'Walk-in' }}</td>
                    <td>{{ number_format($sale->total_eggs_sold) }}</td>
                    <td class="text-right">{{ number_format($sale->gross_income, 2) }}</td>
                    <td class="text-right">{{ number_format($sale->total_expenses, 2) }}</td>
                    <td class="text-right">{{ number_format($sale->net_income, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
