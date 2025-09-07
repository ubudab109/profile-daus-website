<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function experiences(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('experiences')->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="edit('. $row->id .')" class="btn btn-warning mx-2">Edit</button>';
                $btn .= '<button onclick="destroy('. $row->id .')" class="btn btn-danger ml-2">Delete</button>';
                return $btn;
            })
            ->editColumn('end_date', function ($row) {
                if (!is_null($row->end_date)) {
                    return $row->end_date;
                }
                return 'Present';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.experiences');
    }

    public function skills(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('skills')->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<button onclick="edit('. $row->id .')" class="btn btn-warning mx-2">Edit</button>';
                $btn .= '<button onclick="destroy('. $row->id .')" class="btn btn-danger ml-2">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.skill');
    }

    public function portfolio(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('portofolios')->get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $btn = '<a href="'. route('detail.portfolio', $row->id) .'" class="btn btn-warning mx-2">Edit</a>';
                $btn .= '<button onclick="destroy('. $row->id .')" class="btn btn-danger ml-2">Delete</button>';
                return $btn;
            })
            ->editColumn('end_date', function ($row) {
                return $row->end_date ?? 'Present';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('pages.portfolio');
    }

    public function createPortfolio()
    {
        return view('pages.create_portfolio');
    }

    public function detailPortfolio(Request $request, $id)
    {
        $data = DB::table('portofolios')->find($id);
        return view('pages.update_portfolio', compact('data'));
    }
    
    public function getImagesPortfolio(Request $request)
    {
        $data = DB::table('portofolios')->select('id', 'images')->find($request->id);
        return $data;
    }
}
