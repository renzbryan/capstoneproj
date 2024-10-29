<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative;
        }

        section {
            max-width: 600px; /* Adjusted max-width for a wider form */
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"] {
            margin-left: 10px;
            background-color: #e74c3c;
        }

        button:hover {
            background-color: #2980b9;
        }

        .cancel-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <section>
        <form action="{{ route('iar.update', $iars->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $iars->id }}"/>

            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" id="item_name" value="{{ $iars->item_name }}" />

            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="{{ $iars->description }}" />

            <label for="unit">Unit:</label>
            <input type="text" name="unit" id="unit" value="{{ $iars->unit }}" />

            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity" value="{{ $iars->quantity }}" />

            <button type="submit">Update</button>
            <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
        </form>
    </section>
</body>
</html>
