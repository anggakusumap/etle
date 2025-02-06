<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use Illuminate\Http\Request;
use DataTables;

class RiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $riskX1Y1 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X1Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX1Y2 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X1Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX1Y3 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X1Y3')
            ->groupBy('risk_code')
            ->first();

        $riskX2Y1 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X2Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX2Y2 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X2Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX2Y3 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X2Y3')
            ->groupBy('risk_code')
            ->first();

        $riskX3Y1 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X3Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX3Y2 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X3Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX3Y3 = Risk::select('risk_code', \DB::raw('SUM(total_pelanggaran) as total'))
            ->where('risk_code', 'X3Y3')
            ->groupBy('risk_code')
            ->first();

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

        return view('risks.index', compact(
            'riskX1Y1',
            'riskX1Y2',
            'riskX1Y3',
            'riskX2Y1',
            'riskX2Y2',
            'riskX2Y3',
            'riskX3Y1',
            'riskX3Y2',
            'riskX3Y3',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($risk_code, Request $request)
    {
        $risk = Risk::where('risk_code', $risk_code)->firstOrFail();

        if ($request->ajax()) {
            $data = Risk::where('risk_code', $risk_code)->select([
                'plat',
                'total_pelanggaran',
                'denda_total',
                'skor_risiko'
            ]);

            return DataTables::of($data)->make(true);
        }

        return view('risks.show', compact('risk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Risk $risk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Risk $risk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Risk $risk)
    {
        //
    }
}
