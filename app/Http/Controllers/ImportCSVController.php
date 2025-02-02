<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ImportCSVController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validateWithBag('import',[
            'csv_import_input' => [
                File::types('text/csv')
            ]
        ]);
        $file = $request->file('csv_import_input')->openFile();

        $headers = $file->fgetcsv();
        $headers = array_map(function($a) {
            $a = strtolower($a);
            $a = str_replace(' ', '_', $a);
            return $a;
        }, $headers);

        while (!$file->eof()) {
            $line = $file->fgetcsv();

            $p = new Pokemon(array_combine($headers, $line));

            $p->save();
        }

        return redirect('dashboard');
    }
}
