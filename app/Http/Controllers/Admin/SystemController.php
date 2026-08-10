<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SystemController extends Controller
{
    public function clearCache()
    {
        Artisan::call('optimize:clear');
        return redirect()->back()->with('success', 'Application cache cleared successfully.');
    }

    public function clearLogs()
    {
        $logPath = storage_path('logs');
        $files = File::files($logPath);
        
        $cleared = 0;
        foreach ($files as $file) {
            if ($file->getExtension() === 'log') {
                File::put($file->getPathname(), '');
                $cleared++;
            }
        }
        
        return redirect()->back()->with('success', "Cleared $cleared log file(s).");
    }
}
