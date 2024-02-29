<?php

namespace App\Jobs;

use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Imports\BillImport;
use Illuminate\Support\Facades\Storage;
use App\Models\Path;


class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;

    protected $id;

    protected $user;

    public $tries = 2;

    /**
     * Create a new job instance.
     */
    public function __construct($path, $id, $user)
    {   
        $this->path = $path;
        $this->id = $id;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if(Excel::import(new BillImport($this->user), storage_path('/app/public/' . $this->path))){
                
                $path = Path::find($this->id);
                
                if($path){
                    $path->imported = true;
                    $path->save();
                    unlink(storage_path('/app/public/'. $path->path));
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
