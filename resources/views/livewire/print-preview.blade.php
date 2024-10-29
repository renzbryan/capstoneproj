<!DOCTYPE html>
<html>
<head>
    <title>Excel Print Preview</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            margin-left: 20%;
        }
        .container {
            width: calc(100% - 2rem);
            margin: 0 auto;
            padding: 1.25rem;
            background-color: #ffffff;
            border-top: 4px solid #0033cc; /* Blue-900 */
            border-radius: 0.375rem; /* Rounded-md */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow-lg */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 3rem; /* Add some spacing from top */
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Excel Print Preview</h2>
        <table>
            <thead>
                <tr>
                    <th>Entity Name</th>
                    <th>Fund Cluster</th>
                    <th>Supplier</th>
                    <th>PO Date</th>
                    <th>Receipt Date</th>
                    <th>Receiving Clerk</th>
                    <th>Number</th>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>Invoice Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->iar_entityname }}</td>
                    <td>{{ $data->iar_fundcluster }}</td>
                    <td>{{ $data->iar_supplier }}</td>
                    <td>{{ $data->iar_Podate }}</td>
                    <td>{{ $data->iar_rod }}</td>
                    <td>{{ $data->iar_rcc }}</td>
                    <td>{{ $data->iar_number }}</td>
                    <td>{{ $data->iar_date }}</td>
                    <td>{{ $data->iar_invoice }}</td>
                    <td>{{ $data->iar_invoice_d }}</td>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td colspan="2">{{ $item->item_name }}</td>
                    <td>{{ $item->item_unit }}</td>
                    <td>{{ $item->item_quantity }}</td>
                    <td colspan="6"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
