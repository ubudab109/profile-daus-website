<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    public function addPortfolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'url' => '',
            'images' => 'array',
            'stack' => '',
            'start_date' => 'required',
            'end_date' => '',
            'company' => '',
            'description' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();
        $images = [];
        foreach($input['images'] as $image) {
            $images[] = $image;
        }
        DB::table('portofolios')->insert([
            'title' => $input['title'],
            'category' => $input['category'],
            'url' => $input['url'],
            'images' => json_encode($images),
            'stack' => json_encode($input['stack']),
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'company' => $input['company'],
            'description' => $input['description'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
    }

    public function deletePortfolio($id)
    {
        $portfolio = DB::table('portofolios')->find($id);
        $currentImages = json_decode($portfolio->images);
        $arrayImages = json_decode(json_encode($currentImages), true);
        foreach($arrayImages as $image) {
            $data = DB::table('files')->where('id', $image['key'])->first();
            if (file_exists(public_path($data->dir_file))) unlink(public_path($data->dir_file));
            DB::table('files')->where('id', $image['key'])->delete();
        }
        DB::table('portofolios')->where('id', $id)->delete();
        return true;
    }

    public function updatePortfolio(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'url' => '',
            'images' => 'array',
            'stack' => '',
            'start_date' => 'required',
            'end_date' => '',
            'company' => '',
            'description' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();
        $currentData = DB::table('portofolios')->find($request->id);
        $currentImages = json_decode($currentData->images);
        if (isset($input['images']) && !empty($input['images'])) {
            $imageData = [];
            foreach($input['images'] as $image) {
                $imageData[] = $image;
            }
            $images = array_merge(json_decode(json_encode($currentImages), true), $imageData);
        } else {
            $images = $currentImages;
        }
        DB::table('portofolios')->where('id', $request->id)->update([
            'title' => $input['title'],
            'category' => $input['category'],
            'url' => $input['url'],
            'images' => json_encode($images),
            'stack' => json_encode($input['stack']),
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'company' => $input['company'],
            'description' => $input['description'],
            'updated_at' => now(),
        ]);
        return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
    }
    
}
