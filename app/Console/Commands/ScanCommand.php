<?php

namespace App\Console\Commands;

use App\Models\Folder;
use App\Models\Image;
use Illuminate\Console\Command;
use Str;

class ScanCommand extends Command
{
    protected $signature = 'v:scan';

    protected $description = 'Scan folder for new voting galleries';

 public function handle()
    {
        $directory = storage_path('app/public');

        $this->info('Scanning directory ' . $directory);

        $files_in_directory = $this->scan($directory);


        $all_images = Image::all();
        $all_folders = Folder::all();

        $delete_me = collect();


        foreach ($files_in_directory as $path) {

            if (Str::startsWith($path,'.')){
                continue;
            }

            $segments = explode('/', $path);

            $folder = $segments[0];
            $file_name = $segments[1];

            $folder = Folder::firstOrCreate(['name' => $folder]);
            $image = Image::firstOrCreate(['name'=>$file_name, 'folder_id' => $folder->id]);

            $all_images = $all_images->where('name', '!=', $file_name);

        }


        $all_images->each(function ($item) {
            $item->delete();
        });


    }



    /**
     * @param string $directory
     * @return array
     */
    protected function scan(string $directory)
    {
        $list = $this->dirToArray($directory);

        $list = $this->slash($list);

        return $list;

    }

    /**
     * Flatten a multi-dimensional associative array with dots.
     *
     * @param  iterable  $array
     * @return array
     */
    public function slash($array, $prepend='')
    {
        $results = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && ! empty($value)) {
                $results = array_merge($results, $this->slash($value, $prepend.$key.'/'));
            } else {
                $results[] = $prepend . $value;
            }
        }

        return $results;
    }


    public function dirToArray($dir)
    {

        $result = array();

        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = $this->dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                } else {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }
}
