<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ecf0f1;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #bdc3c7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #bdc3c7;
            text-align: left;
        }

        th {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .action-column {
            text-align: center;
        }

        .restore-btn {
            padding: 8px 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            color: #ecf0f1;
            text-decoration: none;
            background-color: #3498db;
            transition: background-color 0.3s;
        }

        .restore-btn:hover {
            background-color: #2980b9;
        }

        .back-btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            color: #ecf0f1;
            border-radius: 5px;
            background-color: #e74c3c;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>Archive List</h1>
    </header>
    <section>
        <a class="back-btn" href="view-inventory">Back</a>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $data)
                <tr>
                    <td>{{ $data->inventory_name }}</td>
                    <td>{{ $data->inventory_category }}</td>
                    <td>{{ $data->inventory_quantity }}</td>
                    <td>{{ $data->inventory_status }}</td>
                    <td class="action-column">
                        <a class="restore-btn" href="/restore-inventory/{{ $data->inventory_id }}">Restore</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>
