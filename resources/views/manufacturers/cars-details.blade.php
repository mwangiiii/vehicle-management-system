<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('vehicle-hub-favicon.png') }}">
</head>
<body class="bg-light">
    <div class="container py-5">
        
        <div class="card shadow-sm">
            <div class="row g-0">
                <!-- Image Section -->
                <div class="col-md-4">
                    @if (!empty($vehicle->images[0]->image_path))
                        <img src="{{ asset('storage/' . $vehicle->images[0]->image_path) }}" class="img-fluid rounded-start" alt="Main Image" onclick="openImageModal(this.src)">
                    @else
                        <p class="text-muted text-center p-3">No main image available.</p>
                    @endif

                    @if ($vehicle->images->count() > 1)
                        <div class="d-flex flex-wrap gap-2 p-3">
                            @foreach ($vehicle->images as $image)
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-thumbnail" width="100" alt="Additional Image" onclick="openImageModal(this.src)">
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center p-3">No additional images available.</p>
                    @endif
                </div>
                
                <!-- Vehicle Details Section -->
                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title">{{ $vehicle->vehicleModel->make->type ?? 'Unknown Make' }} - {{ $vehicle->vehicleModel->type ?? 'Unknown Model' }}</h2>
                        
                        <table class="table mt-4">
                            <tbody>
                                <tr>
                                    <th>Colour</th>
                                    <td>{{ $vehicle->colour }}</td>
                                </tr>
                                <tr>
                                    <th>Number Plate</th>
                                    <td>{{ $vehicle->numberplate }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $vehicle->category->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Propulsion</th>
                                    <td>{{ $vehicle->propulsion->type ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Date Listed</th>
                                    <td>{{ $vehicle->created_at->format('d M Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid" alt="Expanded Image">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
