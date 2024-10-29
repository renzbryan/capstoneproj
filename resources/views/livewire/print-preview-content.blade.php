<!DOCTYPE html>
<html>
<head>
    <title>Excel Print Preview</title>
    <style>
        /* Define styles for print preview */
        /* Add your print preview styles here */
        /* Ensure that the styles are suitable for printing */
    </style>
</head>
<body>
    <h2>Excel Print Preview</h2>
    <table>
        <thead>
            <tr>
                <!-- Add table headings dynamically -->
                @foreach($excelData['headings'] as $heading)
                    <th>{{ $heading }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Add table rows dynamically -->
            @foreach($excelData['rows'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
