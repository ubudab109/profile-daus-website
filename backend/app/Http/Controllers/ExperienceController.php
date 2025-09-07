<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function createExperiences(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'title'         => ['required'],
            'company_name'  => ['required'],
            'location'      => ['required'],
            'desc'          => [''],
            'start_date'    => ['required'],
            'end_date'      => [''],
            'stack'         => [''],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['stack'] = json_encode($input['stack']);
            DB::table('experiences')->insert($input);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $err->getMessage().' '. $err->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteExperiences($id)
    {
         DB::table('experiences')->delete($id);
         return response()->json(['success' => true, 'message' => 'success'], Response::HTTP_OK);
    }

    public function updateExperiences(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'title'         => ['required'],
            'company_name'  => ['required'],
            'location'      => ['required'],
            'desc'          => [''],
            'start_date'    => ['required'],
            'end_date'      => [''],
            'stack'         => [''],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        $input = $request->all();
        DB::beginTransaction();
        try {
            $input['stack'] = json_encode($input['stack']);
            $data = DB::table('experiences')->where('id', $id)->update($input);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
        } catch (\Exception $err) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $err->getMessage().' '. $err->getLine()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function detailExperiences($id)
    {
        $data = DB::table('experiences')->find($id);
        return response()->json(['success' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
    }
}
