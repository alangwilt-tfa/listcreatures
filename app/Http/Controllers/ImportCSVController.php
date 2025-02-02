<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCSVRequest;
use App\Models\Pokemon;

class ImportCSVController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ImportCSVRequest $request)
    {
        $file = $request->file('csv_import_input')->openFile();

        $headers = $file->fgetcsv();
        $headers = array_filter($headers, function($a) {
            $a = strtolower($a);
            $a = str_replace(' ', '_', $a);
            return $a;
        });
        while (!$file->eof()) {
            $line = $file->fgetcsv();

            if (empty($line)) {
                continue;
            }

            $p = Pokemon::create(array_combine($headers, $line));

            $p->save();
        }

        return redirect('dashboard');
    }
}
