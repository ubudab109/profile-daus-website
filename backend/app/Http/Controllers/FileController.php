<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    private function generateImageName($extension) 
    {
        return preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime()).'.'.$extension;
    }

    private function storeImages($path, $files)
    {
        if (is_array($files)) {
            $imgs = [];
            foreach ($files as $file) {
                $extension = $file['file']->getClientOriginalExtension();
                $imageName = $this->generateImageName($extension);
                $file['file']->storeAs(
                    $path,
                    $imageName
                );

                array_push($imgs, $imageName);
            }
            return $imgs;
        } else {
            $extension = $files->getClientOriginalExtension();
            $imageName = $this->generateImageName($extension);
            $files->storeAs(
                $path,
                $imageName
            );
            return $imageName;
        }
    }

    public function unsetImages(array $images, $field, $value)
    {
        foreach ($images as $key => $image) {
            if ($image[$field] == $value) unset($images[$key]);
        }
        return $images;
    }

    public function deleteImage(Request $request)
    {

        $data = DB::table('files')->where('id', $request->input('key'))->first();
        if (file_exists(public_path($data->dir_file))) unlink(public_path($data->dir_file));
        if ($request->idPortfolio) {
            $portfolio = DB::table('portofolios')->where('id', $request->idPortfolio)->first();
            $decodeImage = json_decode($portfolio->images);
            $imagesData = json_decode(json_encode($decodeImage), true);
            Log::info($imagesData);
            $newImagesArray = $this->unsetImages($imagesData, 'key', $request->input('key'));
            DB::table('portofolios')->where('id', $request->idPortfolio)->update([
                'images' => json_encode($newImagesArray)
            ]);
        }
        DB::table('files')->where('id', $request->input('key'))->delete();
        return response()->json(true);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'files' => 'mimes:jpg,jpeg,png',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        $input = $request->all();
        $image = $input['files'];
        $imageName = $this->storeImages('public/images/', $image);
        $path = Storage::url('public/images/'. $imageName);
        $fileName = URL::to($path);
        $idFile = DB::table('files')->insertGetId([
            'file' => $fileName,
            'dir_file' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $out = [
            'key' => $idFile,
            'initialPreview' => [$fileName],
            'initialPreviewConfig' => [
                [
                    'caption' => $image->getClientOriginalName(),
                    'downloadUrl' => $fileName,
                    'exif' => null,
                    'key' => $idFile,
                    'size' => $image->getSize(),
                    'url' => '/delete-image',
                ]
            ],
            'initialPreviewAsData' => true,
        ];
        return $out;
    }
}
