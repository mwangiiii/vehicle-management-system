<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEHICLE HUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-3">Vehicle Listings</h1>
        <div class="row">
            @foreach($vehicles as $vehicle)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($vehicle->images->count() > 0)
                            <img src="{{ asset('storage/' . $vehicle->images->first()->image_path) }}" class="card-img-top" alt="Vehicle Image">
                        @else
                            <img src="https://via.placeholder.com/300" class="card-img-top" alt="No Image Available">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $vehicle->vehicleModel->make->type ?? 'Unknown Make' }} - {{ $vehicle->vehicleModel->type ?? 'Unknown Model' }}</h5>
                            <p class="card-text"><strong>Colour:</strong> {{ $vehicle->colour }}</p>
                            <p class="card-text"><strong>Number Plate:</strong> {{ $vehicle->numberplate }}</p>
                            <p class="card-text"><strong>Category:</strong> {{ $vehicle->category->name ?? 'N/A' }}</p>
                            <a href="{{ route('car-details', ['id' => $vehicle->id]) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
