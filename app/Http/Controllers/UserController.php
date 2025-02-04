<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dataTableType = $request->query('table_type');

            if ($dataTableType === 'table1') {
                $data = collect([
                    ['id' => 1, 'waktu' => '06.00 - 09.00', 'jumlah' => 10, 'potensi' => 1000000],
                    ['id' => 2, 'waktu' => '09.00 - 12.00', 'jumlah' => 1, 'potensi' => 2000000],
                ]);
            } elseif ($dataTableType === 'table2') {
                $data = collect([
                    ['id' => 1, 'kamera' => 'AAA', 'jumlah' => 10, 'potensi' => 1000000],
                    ['id' => 2, 'kamera' => 'BBB', 'jumlah' => 1, 'potensi' => 2000000],
                ]);
            } elseif ($dataTableType === 'table3') {
                $data = collect([
                    ['id' => 1, 'jenis' => 'Jenis A', 'jumlah' => 10, 'potensi' => 1000000],
                    ['id' => 2, 'jenis' => 'Jenis B', 'jumlah' => 1, 'potensi' => 2000000],
                ]);
            } else {
                $data = collect([]);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('users.index');
    }
}
