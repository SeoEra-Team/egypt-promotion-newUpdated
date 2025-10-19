<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $tours = DB::table('tours_old')
        ->select('category_id', DB::raw('GROUP_CONCAT(DISTINCT dest_id) as dest_ids'))
        ->groupBy('category_id')
        ->get();

    foreach ($tours as $tour) {
        $category_id = $tour->category_id;
        $dest_ids = explode(',', $tour->dest_ids); // Split the comma-separated string into an array

        // Process each category_id and its dest_ids
        echo "Category ID: $category_id\n";
        echo "Destination IDs: " . implode(', ', $dest_ids) . "\n";

        // Loop through individual dest_ids if needed
        foreach ($dest_ids as $dest_id) {
            echo "Processing Destination ID: $dest_id for Category ID: $category_id\n";
            // Add your logic here (e.g., fetch data for each dest_id)
        }
    }
});
