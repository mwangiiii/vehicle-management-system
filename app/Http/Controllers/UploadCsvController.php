<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleMake;

class UploadCsvController extends Controller
{
    /**
     * Show the form for uploading a CSV file.
     */
    public function create()
    {
        return view('Admin.uploading-csv');
    }

    /**
     * Process the uploaded CSV file and store its data in the database.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt'
        ]);

        set_time_limit(6000);



        // Store the file in the public disk under 'csv' directory
        $file = $request->file('csv')->store('csv', ['disk' => 'public']);

        // Open the file for reading
        $fileStream = fopen(storage_path('app/public/' . $file), 'r');
        if (!$fileStream) {
            Log::error('Failed to open the CSV file');
            return back()->withErrors(['csv' => 'Failed to process the uploaded file.']);
        }

        $skipHeader = false; // Flag to skip the first row (header)

        // Read the file line by line
        while (($line = fgetcsv($fileStream)) !== false) {
            // Skip the header row
            if ($skipHeader) {
                $skipHeader = true;
                continue;
            }

            // Validate CSV structure
            if (!isset($line[0])) {
                Log::warning('Invalid CSV format', ['line' => $line]);
                continue;
            }

            $type = trim($line[1]); // Column index for 'type'

            // Insert into the 'makes' table or update if the type already exists
            VehicleMake::updateOrCreate(
                ['type' => $type], // Check if this 'type' exists
                ['type' => $type]  // Insert/Update with the same 'type'
            );
        }

        // Close the file stream
        fclose($fileStream);

        // Delete the temporary file from storage
        \Storage::delete($file);

        // Return a response to indicate success
        return view('manufacturers.confirmation')->with('success', 'CSV data imported successfully!');
    }
}
