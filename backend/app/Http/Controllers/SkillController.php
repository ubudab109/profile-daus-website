<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data'  => 'required|array',
            'data.*.skill' => 'required',
            'data.*.percentage' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        $input = $request->all();
        foreach($input['data'] as $data) {
            DB::table('skills')->insert([
                'name' => $data['skill'],
                'percentage' => $data['percentage'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
    }

    public function detailSkill($id)
    {
        $data = DB::table('skills')->find($id);
        return response()->json(['success' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
    }

    public function updateSkill(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'skill' => 'required',
            'percentage' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'messages' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $input = $request->all();
        DB::table('skills')->where('id', $id)->update([
            'name' => $input['skill'],
            'percentage' => $input['percentage'],
        ]);

        return response()->json(['success' => true, 'message' => 'Success'], Response::HTTP_OK);
    }

    public function deleteSkill($id)
    {
        DB::table('skills')->delete($id);
        return response()->json(['success' => true, 'message' => 'success'], Response::HTTP_OK);
    }
}
