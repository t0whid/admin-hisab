<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use ZipArchive;
use Illuminate\Http\Response;

class BackupController extends Controller
{
    public function index()
    {
        return view('backup.index');
    }
    public function downloadBackupZip()
    {
        $databaseName = env('DB_DATABASE');
        $key = "Tables_in_{$databaseName}";

        // Create a temp file for ZIP
        $zipPath = tempnam(sys_get_temp_dir(), 'backup_') . '.zip';

        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
            abort(500, 'Could not create ZIP archive.');
        }

        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = $table->$key;
            $rows = DB::table($tableName)->get();

            if ($rows->isEmpty()) {
                $header = DB::getSchemaBuilder()->getColumnListing($tableName);
                $csvData = implode(',', $header) . "\n";
            } else {
                $csvData = '';
                $header = array_keys((array) $rows->first());
                $csvData .= implode(',', $header) . "\n";

                foreach ($rows as $row) {
                    $line = [];
                    foreach ($header as $col) {
                        $val = $row->$col;
                        if (is_null($val)) {
                            $val = '';
                        } else {
                            $val = str_replace('"', '""', $val);
                            if (strpos($val, ',') !== false || strpos($val, '"') !== false) {
                                $val = '"' . $val . '"';
                            }
                        }
                        $line[] = $val;
                    }
                    $csvData .= implode(',', $line) . "\n";
                }
            }

            $zip->addFromString($tableName . '.csv', $csvData);
        }

        $zip->close();

        $downloadName = 'Shahjalalenterprice_DB.zip'; // fixed file name

        return response()->download($zipPath, $downloadName)->deleteFileAfterSend(true);
    }
}
