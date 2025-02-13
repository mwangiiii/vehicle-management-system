<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleMake;
use App\Models\VehicleModel;

class UploadModelCsvController extends Controller
{
    public function store(Request $request)
{
    // Validate CSV upload
    $request->validate([
        'csv' => 'required|file|mimes:csv,txt'
    ]);

    // Increase script execution time for large files
    set_time_limit(6000);

    // Store file and get its path
    $file = $request->file('csv')->store('modelCsv', ['disk' => 'public']);
    $filePath = storage_path('app/public/' . $file);

    // Ensure file is readable
    if (!file_exists($filePath) || !is_readable($filePath)) {
        return back()->withErrors(['csv' => 'Failed to open the CSV file.']);
    }

    // Open the file for reading
    $fileStream = fopen($filePath, 'r');
    if (!$fileStream) {
        return back()->withErrors(['csv' => 'Failed to open the CSV file.']);
    }

    $data = [];
    $headerSkipped = false;

    // Read CSV data line by line
    while (($line = fgetcsv($fileStream, 0, ",")) !== false) {
        // Skip the header if it contains known column names
        if (!$headerSkipped) {
            if (strtolower($line[0]) === 'id' || strtolower($line[1]) === 'make_id') {
                $headerSkipped = true;
                continue;
            }
        }

        // Ensure columns exist before inserting
        $make_id = isset($line[1]) ? trim($line[1]) : null;
        $type = isset($line[2]) ? trim($line[2]) : null;

        if (!empty($make_id) && !empty($type)) {
            $data[] = [
                'make_id' => $make_id,
                'type' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    }

    fclose($fileStream);

    // Insert data in bulk to maintain order
    if (!empty($data)) {
        VehicleModel::insert($data);
    }

    // Delete the file after processing
    \Storage::disk('public')->delete($file);

    // Return confirmation view
    return view('manufacturers.confirmation');
}


    public function create()
    {
        // Return the view for uploading CSV files
        return view('admin.uploading-models-csv');
    }
}
