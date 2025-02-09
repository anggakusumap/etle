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
                $data = $this->getTimeDataTables();
            } elseif ($dataTableType === 'table2') {
                $data = $this->getLocationDataTables();
            } elseif ($dataTableType === 'table3') {
                $data = $this->getFoulDataTables();
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
    public function show($riskCode, Request $request)
    {
        $risk = Risk::where('risk_code', $riskCode)->firstOrFail();

        if ($request->ajax()) {
            $data = Risk::where('risk_code', $riskCode)->select([
                'plat',
                'total_pelanggaran',
                'denda_total',
                'skor_risiko'
            ]);

            return DataTables::of($data)->make(true);
        }

        return view('risks.show', compact('risk'));
    }

    public function showTimes($timeRange, Request $request){
        $times = explode('-', $timeRange);
        $startTime = $times[0] . ':00';
        $endTime = date('H:i:s', strtotime($times[1] . ':00') - 1); // Convert end to HH:MM:SS and subtract 1 second

        $jumlahPelanggaran = Violate::whereTime('tanggal_pelanggaran', '>=', $startTime)
            ->whereTime('tanggal_pelanggaran', '<=', $endTime)
            ->where('status', 'baru')
            ->count();

        if($request->ajax()){
            $data = $this->getTimesData($startTime, $endTime);

            return DataTables::of($data)->make(true);
        }

        return view('risks.showTimes', compact('timeRange', 'jumlahPelanggaran'));
    }

    public function showLocations($cameraCode, Request $request){
        $camera = $cameraCode;
        $jumlahPelanggaran = Violate::where('lokasi', $cameraCode)->where('status', 'baru')->count();

        if($request->ajax()){
            $data = $this->getLocationsData($cameraCode);

            return DataTables::of($data)->make(true);
        }

        return view('risks.showLocations', compact('camera', 'jumlahPelanggaran'));
    }

    public function showFouls($foulsReason, Request $request){
        $fouls = $foulsReason;
        $jumlahPelanggaran = Violate::where('jenis_pelanggaran', $foulsReason)->where('status', 'baru')->count();

        if($request->ajax()){
            $data = $this->getFoulsData($foulsReason);

            return DataTables::of($data)->make(true);
        }

        return view('risks.showFouls', compact('fouls', 'jumlahPelanggaran'));
    }

    private function getTimeDataTables()
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

    private function getLocationDataTables()
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

    private function getFoulDataTables()
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

    private function getTimesData($startTime, $endTime){
        $data = Violate::where('status', 'baru')
            ->selectRaw('
                lokasi,
                plat,
                tanggal_pelanggaran,
                tipe_kendaraan,
                warna_kendaraan,
                SUM(CASE
                    WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                    WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                    WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                    ELSE 0
                END) as potensi
            ')
            ->whereTime('tanggal_pelanggaran', '>=', $startTime)
            ->whereTime('tanggal_pelanggaran', '<=', $endTime)
            ->groupBy('plat', 'tanggal_pelanggaran', 'jenis_pelanggaran', 'tipe_kendaraan', 'warna_kendaraan', 'lokasi')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'lokasi' => $item->lokasi,
                'plat' => $item->plat,
                'jenis_pelanggaran' => $item->jenis_pelanggaran,
                'tanggal_pelanggaran' => $item->tanggal_pelanggaran,
                'tipe_kendaraan' => $item->tipe_kendaraan,
                'warna_kendaraan' => $item->warna_kendaraan,
                'potensi' => $item->potensi,
            ];
        });
    }

    private function getLocationsData($cameraCode){
        $data = Violate::where('status', 'baru')
            ->where('lokasi', $cameraCode)
            ->selectRaw('
                jenis_pelanggaran,
                plat,
                tanggal_pelanggaran,
                tipe_kendaraan,
                warna_kendaraan,
                SUM(CASE
                    WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                    WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                    WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                    ELSE 0
                END) as potensi
            ')
            ->groupBy('plat', 'tanggal_pelanggaran', 'jenis_pelanggaran', 'tipe_kendaraan', 'warna_kendaraan')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'plat' => $item->plat,
                'jenis_pelanggaran' => $item->jenis_pelanggaran,
                'tanggal_pelanggaran' => $item->tanggal_pelanggaran,
                'tipe_kendaraan' => $item->tipe_kendaraan,
                'warna_kendaraan' => $item->warna_kendaraan,
                'potensi' => $item->potensi,
            ];
        });
    }

    private function getFoulsData($foulsReason){
        $data = Violate::where('status', 'baru')
            ->where('jenis_pelanggaran', $foulsReason)
            ->selectRaw('
                lokasi,
                plat,
                tanggal_pelanggaran,
                tipe_kendaraan,
                warna_kendaraan,
                SUM(CASE
                    WHEN jenis_pelanggaran = "Menggunakan HP" THEN 750000
                    WHEN jenis_pelanggaran = "Tidak menggunakan sabuk pengaman" THEN 250000
                    WHEN jenis_pelanggaran = "Tidak menggunakan helm" THEN 250000
                    ELSE 0
                END) as potensi
            ')
            ->groupBy('plat', 'tanggal_pelanggaran', 'lokasi', 'tipe_kendaraan', 'warna_kendaraan')
            ->get();

        return $data->map(function ($item, $index) {
            return [
                'id' => $index + 1,
                'plat' => $item->plat,
                'lokasi' => $item->lokasi,
                'tanggal_pelanggaran' => $item->tanggal_pelanggaran,
                'tipe_kendaraan' => $item->tipe_kendaraan,
                'warna_kendaraan' => $item->warna_kendaraan,
                'potensi' => $item->potensi,
            ];
        });
    }
}
