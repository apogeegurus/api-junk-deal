<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index()
    {
        $backups = [];
        foreach(glob(storage_path('app' . DIRECTORY_SEPARATOR .'backups') . DIRECTORY_SEPARATOR . '*.*') as $file) {
            $backups[] = [
                'file_path' => $file,
                'file_name' => last(explode(DIRECTORY_SEPARATOR, $file))
            ];
        }

        return view('backup.index', compact('backups'));
    }


    public function backupDB()
    {
        Artisan::call('backup:db --c');
        return redirect()->back()->with('message', 'Successfully backed up DB.');
    }

    public function importBackup(Request $request)
    {
        Artisan::call('backup:db');
        $fileName = $request->input('backup_file');
        Artisan::call('import:db ' . $fileName);
        return redirect()->back()->with('message', 'Successfully updated DB.');
    }


    public function removeBackup($fileName)
    {
        unlink(storage_path('app' . DIRECTORY_SEPARATOR . 'backups' . DIRECTORY_SEPARATOR . $fileName));
        return response()->json(['message' => 'success']);
    }
}
