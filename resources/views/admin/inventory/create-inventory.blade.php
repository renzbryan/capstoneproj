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
            padding: 10px;
            text-align: left;
        }

        section {
            max-width: 600px; /* Adjusted max-width */
            margin: 20px auto;
            background-color: #ecf0f1;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #bdc3c7;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            margin-bottom: 15px; /* Adjusted margin */
            padding: 12px; /* Adjusted padding */
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 95%;
        }

        button {
            padding: 15px; /* Adjusted padding */
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
            margin-top: 15px; /* Adjusted margin */
            padding: 15px; /* Adjusted padding */
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
        <h1 style="font-size: 1.5em;">Inventory Form</h1>
    </header>
    <section>
        <form action="store-inventory" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div>
                    <label for="inventory_name">Name:</label>
                    <input type="text" name="inventory_name" id="inventory_name"/>
                </div>

                <div>
                    <label for="inventory_category">Category:</label>
                    <input type="text" name="inventory_category" id="inventory_category"/>
                </div>

                <div>
                    <label for="inventory_quantity">Quantity:</label>
                    <input type="text" name="inventory_quantity" id="inventory_quantity"/>
                </div>
                
                <div>
                    <label for="inventory_status">Status:</label>
                    <input type="text" name="inventory_status" id="inventory_status"/>
                </div>

                <div>
                    <button type="submit">Save</button>
                    <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
                </div>
            </div>
        </form>
    </section>
</body>
</html>
