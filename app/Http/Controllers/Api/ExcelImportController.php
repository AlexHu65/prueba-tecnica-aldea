<?php

namespace App\Http\Controllers\Api;

use App\Jobs\ImportJob;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\ImportExcelRequest;
use App\Models\Path;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExcelImportController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function import(ImportExcelRequest $request){
        
        $file = $request->file('file');
        
        $str = 'AABbCcDdEeFfG';

        $folder = 'bills';
            
        $shuffled = str_shuffle($str);

        $fileName = time() . $shuffled  . '.'. $file->extension();

        //send file to job
        $path = Storage::disk('public')->putFileAs($folder, $file, $fileName, 'public');

        if($path){

            $newPath = Path::create(['path' => $path]);

            $user = auth('api')->user();

            ImportJob::dispatch($newPath->path, $newPath->id, $user);
        }
        
        return $this->success('Importando.',[
            'msg' => 'Se estan importando tus gastos, y seras notificado por correo electrónico.'
        ]
    );
        
    }
}
