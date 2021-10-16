<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pro;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Bus\Dispatcher;

class GeneralController extends Controller
{
    public function ExportCSV(){


        //\App\Jobs\ExportProducts::dispatch()->delay(now()->addSeconds(5));
        dispatch(new \App\Jobs\ExportProducts())->delay(now()->addSeconds(5));

        $fileName = 'products.csv';
        $tasks = Pro::all();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ProductTitle', 'ProductDescription', 'ProductPrice');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['ProductTitle']  = $task->producttitle;
                $row['ProductDescription']    = $task->productdescription;
                $row['ProductPrice']    = $task->productprice;

                fputcsv($file, array($row['ProductTitle'], $row['ProductDescription'], $row['ProductPrice']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
