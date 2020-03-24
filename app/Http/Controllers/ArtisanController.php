<?php 
namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use PhpParser\Node\Scalar\String_;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\App;
use function foo\func;
use Artisan;
class ArtisanController extends Controller
{
    public function changeLang($l){
        App::setLocale($l);
        return back();
    }
    public function getFiles($filename)
    {
        $path = storage_path('public/' . $filename);
    
        if (!File::exists($path)) {
            abort(404);
        }
    
        $file = File::get($path);
        $type = File::mimeType($path);
    
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
    
        return $response;
    }
    public function storageLink(){
        // $exitCode = Artisan::call('storage:link');
        symlink('/home/damoluz/back.damol.uz/storage/app/public/', '/home/damoluz/back.damol.uz/public/storage');

        return '<h1>Link Storage</h1>';
    }    
    public function clearCache(){
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    }
    public function optimize(){
        $exitCode = Artisan::call('optimize');
        return '<h1>Reoptimized class loader</h1>';
    }
    public function routeCache(){
        $exitCode = Artisan::call('route:cache');
        return '<h1>Routes cached</h1>';
    }
    public function routeClear(){
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    }
    public function viewClear(){
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    }
    public function configCache(){
        $exitCode = Artisan::call('config:cache');
        return '<h1>Clear Config cleared</h1>';
    }
}
