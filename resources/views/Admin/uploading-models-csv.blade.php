<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV</title>
</head>
<body>
    <h1>Uploading the MODELs CSV</h1>
    <p>Please upload a CSV file to import data into the system.</p>

    <!-- Form for uploading the CSV -->
    <form action="{{ route('uploading-csv-models-post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="upload-csv">Upload MODELS CSV:</label>
        <input type="file" name="csv" id="upload-csv" required>
        <br><br>
        <button type="submit">Upload</button>
    </form>

    @if ($errors->any())
        <div>
            <h3>Errors:</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
