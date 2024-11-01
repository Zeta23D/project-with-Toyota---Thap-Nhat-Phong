<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kpis;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\KpisImport;
use Maatwebsite\Excel\Facades\Excel;

class KPIController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kpis::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_kpi.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editUser" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_kpi.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteUser" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kpi.kpi');
    }

    public function getUsers(Request $request)
    {
        $term = $request->get('term');
        $users = User::where('name', 'LIKE', '%' . $term . '%')->get(['name']);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        Kpis::updateOrCreate(
            ['id_kpi' => $request->id],
            ['name' => $request->name, 'diem' => $request->diem, 'thang' => $request->thang, 'nam' => 2024, 'ghi_chu'=>$request->ghi_chu  ]
        );
        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'toastr' => true,
        ]);
    }


    public function edit($id)
    {
        $kpi = Kpis::find($id);
        return response()->json($kpi);
    }

    public function destroy($id)
    {
        Kpis::find($id)->delete();
        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }

    public function import(Request $request)
    {
        Excel::import(new KpisImport, $request->file('file'));
        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'toastr' => true,
        ]);
    }

}

