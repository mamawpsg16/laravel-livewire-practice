<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = DB::table('cities')->get()->toArray();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return view('posts.index',['hasPost' => true, 'reports' => []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        dd($post);
        // return view('post', [
        //     'post' => Post::where('slug', $slug)->first()
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        // Save the file to the public directory
        $path = $file->store('csv', 'public');
        $fullPath = public_path('storage/' . $path);

        try {
            DB::transaction(function () use ($fullPath) {
                // Process CSV file
                $this->importCsv($fullPath);
            });

            return back()->with('success', 'File uploaded and data imported successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('CSV import failed: ' . $e->getMessage());

            // Delete the uploaded file
            // if (File::exists($fullPath)) {
            //     File::delete($fullPath);
            // }

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
    private function importCsv($filePath)
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Read the header
            fgetcsv($handle);

            $rowNumber = 0; // Start from 1 for CSV rows (1-based index)
            
            while (($row = fgetcsv($handle)) !== false) {
                $rowNumber++;

                // Validate each row
                if (!$this->validateRow($row)) {
                    throw new \Exception('Invalid data found in CSV on row ' . $rowNumber);
                }

                // Check for duplicate entry
                if (DB::table('cities')->where('name', $row[0])->exists()) {
                    throw new \Exception('Duplicate entry found in CSV on row ' . $rowNumber);
                }

                // Insert into database
                DB::table('cities')->insert([
                    'name' => $row[0],
                    'location' => $row[1],
                ]);
            }

            fclose($handle);
        } else {
            throw new \Exception('Unable to open the CSV file.');
        }
    }
    
    private function validateRow($row)
    {
        // Assuming the CSV columns are ['name', 'location']

        // Check if 'name' is a string and not empty
        if (empty($row[0]) || !is_string($row[0])) {
            return false;
        }

        // Check if 'location' is in the expected format (e.g., (x, y))
        if (empty($row[1]) || !preg_match('/^\(\d+(\.\d+)?,\s*\d+(\.\d+)?\)$/', $row[1])) {
            return false;
        }

        return true;
    }

    public function export()
{
    $data = DB::table('cities')->get();

    $csvFileName = 'data_export.csv';

    $response = new StreamedResponse(function () use ($data) {
        $handle = fopen('php://output', 'w');

        // Add CSV headers
        fputcsv($handle, ['Name', 'Location']);

        // Add data rows
        foreach ($data as $item) {
            fputcsv($handle, [$item->name, $item->location]);
        }

        fclose($handle);
    });

    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="' . $csvFileName . '"');

    return $response;
}
}
