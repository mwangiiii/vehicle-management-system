<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>
    <h1 class="font-semibold"> VEHICLES </h1>
    <table class ="w-full mt-2 text-pretty">
        <table>
            <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Colour </th>
                <td class ="py2 px-4">{{ $vehicle->colour }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Number plate: </th>
                <td class ="py2 px-4">{{ $vehicle->numberplate }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Make </th>
                <td class ="py2 px-4">{{ $vehicle->vehicleModel->make->type }}</td>
            </tr>


             <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Category </th>
                <td class ="py2 px-4">{{ $vehicle->category->name }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Propulsion </th>
                <td class ="py2 px-4">{{ $vehicle->propulsion->type }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-2 px-4 font-medium text-gray-900"> Model </th>
                <td class ="py2 px-4">{{ $vehicle->vehicleModel->type }}</td>
            </tr>

            <div id="vehicle-images">
    @if($vehicle->images && $vehicle->images->count() > 0) 
        @foreach($vehicle->images as $image)
            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Vehicle Image" class="w-32 h-32 object-cover">
        @endforeach
    @else
        <p>No images available.</p>
    @endif
</div>


</table>
</table>

    

</div>

</body>
</html>