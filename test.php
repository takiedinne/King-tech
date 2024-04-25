<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Row Color Example</title>
    <link rel="stylesheet" href="./assets/DataTables-1.12.1/datatables.min.css">
    <style>
        .less {
            background-color: #ffcccc !important; /* Light red */
        }

        .color2 {
            background-color: #ccffcc !important; /* Light green */
        }
    </style>
</head>
<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <th>Column 3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Value 1</td>
                <td>Value 2</td>
                <td>Value 3</td>
            </tr>
            <tr>
                <td>Value 4</td>
                <td>Value 5</td>
                <td>Value 6</td>
            </tr>
        </tbody>
    </table>

    <script src="assets/jquery-3.6.0/jquery-3.6.0.js"></script>
    <script src="assets/DataTables-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "rowCallback": function(row, data) {
                    var columnIndex = 2; // Index of the column to check
                    var columnValue = data[columnIndex];
                    
                    if (columnValue == 'Value 3') {
                        $(row).addClass('color1');
                    } else if (columnValue == 'Value 6') {
                        $(row).addClass('color2');
                    }
                }
            });
        });
    </script>
</body>
</html>
