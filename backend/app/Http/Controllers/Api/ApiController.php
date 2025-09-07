<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function experiences()
    {
        $experiences = DB::table('experiences')->orderBy('start_date', 'desc')->get();
        $data = [];
        foreach($experiences as $exp) {
            $data[] = [
                'title' => $exp->title,
                'company' => $exp->company_name,
                'location' => $exp->location,
                'desc' => $exp->desc,
                'start_date' => date('F Y', strtotime($exp->start_date)),
                'end_date' => !is_null($exp->end_date) ? date('F Y', strtotime($exp->end_date)) : null,
                'stack' => json_decode($exp->stack),
            ];
        }
        return response()->json($data);
    }

    public function skills()
    {
        $skills = DB::table('skills')->orderBy('percentage', 'desc')->get();
        return response()->json($skills);
    }

    public function portfolios()
    {
        $portfolios = DB::table('portofolios')->select('id', 'title', 'images', 'start_date')->orderBy('start_date', 'desc')->get();
        return response()->json($portfolios);
    }

    public function detailPortfolio($id)
    {
        $portfolio = DB::table('portofolios')->find($id);
        $data = [
            'id' => $id,
            'title' => $portfolio->title,
            'category' => $portfolio->category,
            'url' => $portfolio->url,
            'images' => json_decode($portfolio->images),
            'stack' => json_decode($portfolio->stack),
            'start_date' => date('F Y', strtotime($portfolio->start_date)),
            'end_date' => !is_null($portfolio->end_date) ? date('F Y', strtotime($portfolio->end_date)) : null,
            'company' => $portfolio->company,
            'description' => $portfolio->description,
        ];
        return response()->json($data);
    }
}
