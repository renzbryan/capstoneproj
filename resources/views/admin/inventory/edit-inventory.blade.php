<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Form</title>
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
            padding: 10px; /* Reduced padding */
            text-align: left;
        }

        section {
            max-width: 500px; /* Increased max-width */
            margin: 20px auto;
            background-color: #ecf0f1;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #bdc3c7;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            color: #333;
        }

        input {
            margin-bottom: 15px;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button {
            padding: 15px;
            background-color: #3498db;
            color: #ecf0f1;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .cancel-btn {
            margin-top: 10px;
            padding: 15px;
            background-color: #e74c3c;
            color: #ecf0f1;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Form</h1>
    </header>
    <section>
        <form action="{{ route('update-inventory', ['inventory_id' => $inventories->inventory_id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="inventory_id" id="inventory_id" value="{{ $inventories->inventory_id }}"/>

            <label for="inventory_name">Name:</label>
            <input type="text" name="inventory_name" id="inventory_name" value="{{ $inventories->inventory_name }}"/>

            <label for="inventory_category">Category:</label>
            <input type="text" name="inventory_category" id="inventory_category" value="{{ $inventories->inventory_category }}"/>

            <label for="inventory_quantity">Quantity:</label>
            <input type="text" name="inventory_quantity" id="inventory_quantity" value="{{ $inventories->inventory_quantity }}"/>

            <label for="inventory_status">Status:</label>
            <input type="text" name="inventory_status" id="inventory_status" value="{{ $inventories->inventory_status }}"/>

            <button type="submit">Update</button>
            <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
        </form>
    </section>
</body>
</html>
