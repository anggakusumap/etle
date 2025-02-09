<?php

namespace App\Http\Controllers;

use App\Models\Risk;
use App\Models\Violate;
use Illuminate\Http\Request;
use DataTables;

class RiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $riskX1Y1 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X1Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX1Y2 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X1Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX1Y3 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X1Y3')
            ->groupBy('risk_code')
            ->first();

        $riskX2Y1 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X2Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX2Y2 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X2Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX2Y3 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X2Y3')
            ->groupBy('risk_code')
            ->first();

        $riskX3Y1 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X3Y1')
            ->groupBy('risk_code')
            ->first();
        $riskX3Y2 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X3Y2')
            ->groupBy('risk_code')
            ->first();
        $riskX3Y3 = Risk::select('risk_code', \DB::raw('COUNT(*) as total'))
            ->where('risk_code', 'X3Y3')
            ->groupBy('risk_code')
            ->first();

        if ($request->ajax()) {
            $dataTableType = $request->query('table_type');

            if ($dataTableType === 'table1') {
                $data = $this->getTable1Data();
            } elseif ($dataTableType === 'table2') {
                $data = $this->getTable2Data();
            } elseif ($dataTableType === 'table3') {
                $data = $this->getTable3Data();
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

    public function showLocations($camera_code, Request $request){
        $camera = $camera_code;
        $jumlahPelanggaran = Violate::where('lokasi', $camera_code)->where('status', 'baru')->count();

        if($request->ajax()){
            $data = $this->getLocationsData($camera_code);

            return DataTables::of($data)->make(true);
        }

        return view('risks.showLocations', compact('camera', 'jumlahPelanggaran'));
    }

    public function showFouls($fouls_reason, Request $request){
        $fouls = $fouls_reason;
        $jumlahPelanggaran = Violate::where('jenis_pelanggaran', $fouls_reason)->where('status', 'baru')->count();

        if($request->ajax()){
            $data = $this->getFoulsData($fouls_reason);

            return DataTables::of($data)->make(true);
        }

        return view('risks.showFouls', compact('fouls', 'jumlahPelanggaran'));
    }

    private function getTable1Data()
    {
        $timeRanges = [
            '00:00-03:00' => ['00:00:00', '02:59:59'],
            '03:00-06:00' => ['03:00:00', '05:59:59'],
            '06:00-09:00' => ['06:00:00', '08:59:59'],
            '09:00-12:00' => ['09:00:00', '11:59:59'],
            '12:00-15:00' => ['12:00:00', '14:59:59'],
            '15:00-18:00' => ['15:00:00', '17:59:59'],
            '18:00-21:00' => ['18:00:00', '20:59:59'],
            '21:00-00:00' => ['21:00:00', '23:59:59'],
        ];

        $data = collect();

        foreach ($timeRanges as $label => $times) {
            $count_hp = Violate::where('status', 'baru')
                ->where('jenis_pelanggaran', 'Menggunakan HP')
                ->whereTime('tanggal_pelanggaran', '>=', $times[0])
                ->whereTime('tanggal_pelanggaran', '<=', $times[1])
                ->count();

            $count_sabuk = Violate::where('status', 'baru')
                ->where('jenis_pelanggaran', 'Tidak menggunakan sabuk pengaman')
                ->whereTime('tanggal_pelanggaran', '>=', $times[0])
                ->whereTime('tanggal_pelanggaran', '<=', $times[1])
                ->count();

            $count_helm = Violate::where('status', 'baru')
                ->where('jenis_pelanggaran', 'Tidak menggunakan helm')
                ->whereTime('tanggal_pelanggaran', '>=', $times[0])
                ->whereTime('tanggal_pelanggaran', '<=', $times[1])
                ->count();

            $potensi = ($count_hp * 750000) + ($count_sabuk * 250000) + ($count_helm * 25000);

            $data->push([
                'id' => $data->count() + 1,
                'waktu' => $label,
                'jumlah' => $count_hp + $count_sabuk + $count_helm,
                'potensi' => $potensi,
            ]);
        }

        return $data;
    }

    private function getTable2Data()
    {
        $data = Violate::where('status', 'baru')
            ->selectRaw('lokasi as kamera, COUNT(*) as jumlah,
            SUM(CASE
                WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                ELSE 0
            END) as potensi')
            ->groupBy('lokasi')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'kamera' => $item->kamera,
                'jumlah' => $item->jumlah,
                'potensi' => $item->potensi,
            ];
        });
    }

    private function getTable3Data()
    {
        $data = Violate::where('status', 'baru')
            ->selectRaw('jenis_pelanggaran as jenis, COUNT(*) as jumlah,
            SUM(CASE
                WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                ELSE 0
            END) as potensi')
            ->groupBy('jenis_pelanggaran')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'jenis' => $item->jenis,
                'jumlah' => $item->jumlah,
                'potensi' => $item->potensi,
            ];
        });
    }

    private function getLocationsData($camera_code){
        $data = Violate::where('status', 'baru')
            ->where('lokasi', $camera_code)
            ->selectRaw('
                jenis_pelanggaran,
                plat,
                tanggal_pelanggaran,
                SUM(CASE
                    WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                    WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                    WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                    ELSE 0
                END) as potensi
            ')
            ->groupBy('plat', 'tanggal_pelanggaran', 'jenis_pelanggaran')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'plat' => $item->plat,
                'jenis_pelanggaran' => $item->jenis_pelanggaran,
                'tanggal_pelanggaran' => $item->tanggal_pelanggaran,
                'potensi' => $item->potensi,
            ];
        });
    }

    private function getFoulsData($fouls_reason){
        $data = Violate::where('status', 'baru')
            ->where('jenis_pelanggaran', $fouls_reason)
            ->selectRaw('
                lokasi,
                plat,
                tanggal_pelanggaran,
                SUM(CASE
                    WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                    WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                    WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                    ELSE 0
                END) as potensi
            ')
            ->groupBy('plat', 'tanggal_pelanggaran', 'lokasi')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'plat' => $item->plat,
                'lokasi' => $item->lokasi,
                'tanggal_pelanggaran' => $item->tanggal_pelanggaran,
                'potensi' => $item->potensi,
            ];
        });
    }
}
