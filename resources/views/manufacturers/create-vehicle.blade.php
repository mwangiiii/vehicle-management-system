<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Vehicle Form</h2>
        <form action="{{ route('storing-car') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="make" class="form-label">Make:</label>
                <select class="form-select" name="make_id" id="makeSelect" required>
                    <option value="">Select a Vehicle Make</option>
                    @foreach($makes as $make)
                        <option value="{{ $make->id }}">{{ $make->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model:</label>
                <select class="form-select" name="model_id" id="modelSelect" required>
                    <option value="">Select a Model</option>
                    @foreach($models as $model)
                        <option value="{{ $model->id }}" data-make="{{ $model->make_id }}">{{ $model->type }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-3">
                <label for="category_id" class="form-label">Category:</label>
                <select class="form-select" name="category_id" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="propulsion_id" class="form-label">Propulsion:</label>
                <select class="form-select" name="propulsion_id" required>
                    <option value="">Select Propulsion Type</option>
                    @foreach($propulsions as $propulsion)
                        <option value="{{ $propulsion->id }}">{{ $propulsion->type }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="year_of_manufacture" class="form-label">Year of Manufacture:</label>
                <input type="number" class="form-control" name="year_of_manufacture" required 
                       value="{{ old('year_of_manufacture') }}" min="1900" max="{{ now()->year }}" />
            </div>
            
            <div class="mb-3">
                <label for="colour" class="form-label">Colour:</label>
                <input type="text" class="form-control" name="colour" required value="{{ old('colour') }}" />
            </div>
            
            <div class="mb-3">
                <label for="number_plate" class="form-label">Number Plate:</label>
                <input type="text" class="form-control" name="numberplate" required value="{{ old('number_plate') }}" />
            </div>
            
            <div class="mb-3">
                <label for="images" class="form-label">Images:</label>
                <input type="file" class="form-control" name="images[]" accept="image/*" multiple required autofocus />
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const makeSelect = document.getElementById("makeSelect");
            const modelSelect = document.getElementById("modelSelect");

            makeSelect.addEventListener("change", function () {
                const selectedMake = this.value;

                Array.from(modelSelect.options).forEach(option => {
                    if (option.value === "") {
                        option.hidden = false; 
                        option.selected = true; // Ensure placeholder is selected
                    } else {
                        option.hidden = option.getAttribute("data-make") !== selectedMake;
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
