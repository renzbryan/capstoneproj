<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RLSDDSP Table</title>
</head>
<body>
    <h1>RLSDDSP Table</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item ID</th>
                <th>Department</th>
                <th>Account Officer</th>
                <th>Designation</th>
                <th>Policy</th>
                <th>Policy Status</th>
                <th>Policy Date</th>
                <th>Policy Number</th>
                <th>Date</th>
                <th>ICS ID</th>
                <th>ICS Number</th>
                <th>ICS Date</th>
                <!-- Add other table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($rlsddspData as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->item_id }}</td>
                <td>{{ $item->rlsddsp_dept }}</td>
                <td>{{ $item->rlsddsp_acc_offcr }}</td>
                <td>{{ $item->rlsddsp_desg }}</td>
                <td>{{ $item->rlsddsp_pol }}</td>
                <td>{{ $item->rlsddsp_pol_sta }}</td>
                <td>{{ $item->rlsddsp_pol_date }}</td>
                <td>{{ $item->rlsddsp_no }}</td>
                <td>{{ $item->rlsddsp_date }}</td>
                <td>{{ $item->ics_id }}</td>
                <td>{{ $item->ics_no }}</td>     
                <td>{{ $item->ics_date }}</td>
                <!-- Add other table cells as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>