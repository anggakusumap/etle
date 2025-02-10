@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col-reverse lg:flex-row justify-center gap-6 w-full">
        <div class="w-full lg:w-[55%]">
            <div class="flex flex-col gap-4">
                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Range Waktu</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-range-waktu text-white">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu</th>
                                        <th>Jumlah</th>
                                        <th>Potensi (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Lokasi</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-lokasi text-white">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kamera</th>
                                        <th>Jumlah</th>
                                        <th>Potensi (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Jenis Pelanggaran</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-jenis-pelanggaran text-white">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Potensi (Rp.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="risk_matrix" class="relative h-fit w-full lg:w-[45%] text-center bg-[#141719] rounded-sm px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">Risk Matrix - Distribusi Kendaraan</h1>
                <div class="flex justify-center">
                    <div class="grid grid-cols-4 w-full max-w-4xl">
                        <p class="absolute left-[-10px] top-[45%] -translate-y-1/2 rotate-[-90deg] text-xl font-bold">
                            Likelihood
                        </p>

                        <p class="flex flex-col justify-center items-end mr-5">Low</p>
                        <a href="{{ route('risks.show', $riskX1Y3->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX1Y3->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX1Y3->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX2Y3->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX2Y3->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX2Y3->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX3Y3->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#ed0b07] hover:bg-red-600 border-1 border-black flex flex-col justify-center text-base text-white">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX3Y3->risk_code}}
                                    </p>
                                    <div class="border-1 border-white w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX3Y3->total}}</p>
                                </div>
                            </div>
                        </a>

                        <p class="flex flex-col justify-center items-end mr-5">Medium</p>
                        <a href="{{ route('risks.show', $riskX1Y2->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX1Y2->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX1Y2->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX2Y2->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX2Y2->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX2Y2->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX3Y2->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX3Y2->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX3Y2->total}}</p>
                                </div>
                            </div>
                        </a>

                        <p class="flex flex-col justify-center items-end mr-5">High</p>
                        <a href="{{ route('risks.show', $riskX1Y1->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX1Y1->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX1Y1->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX2Y1->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">
                                        {{$riskX2Y1->risk_code}}
                                    </p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{$riskX2Y1->total}}</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('risks.show', $riskX3Y1->risk_code) }}">
                            <div class="h-32 transition transform ease-in-out duration-100 scale-100 hover:scale-105 font-bold cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                                <div class="flex flex-col">
                                    <p class="m-0">{{ $riskX3Y1->risk_code }}</p>
                                    <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                    <p class="m-0">{{ $riskX3Y1->total }}</p>
                                </div>
                            </div>
                        </a>

                        <div></div>
                        <p class="mt-3">Low</p>
                        <p class="mt-3">Medium</p>
                        <p class="mt-3">High</p>

                        <div></div>
                        <p></p>
                        <p class="font-bold text-xl mt-2">Impact</p>
                        <p></p>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.data-range-waktu').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table1' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'waktu',
                        name: 'waktu',
                        render: function(data, type, row) {
                            return `<a href="/times/${row.waktu}" style="text-decoration: underline !important;">
                                        ${row.waktu}
                                    </a>`;
                        }
                    },
                    {data: 'jumlah', name: 'jumlah'},
                    {
                        data: 'potensi',
                        name: 'potensi',
                        render: function(data, type, row) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    }
                ],
                paging: false,
                searching: false,
            });

            $('.data-lokasi').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table2' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'kamera',
                        name: 'kamera',
                        render: function(data, type, row) {
                            return `<a href="/locations/${row.kamera}" style="text-decoration: underline !important;">
                                        ${row.kamera}
                                    </a>`;
                        }
                    },
                    {data: 'jumlah', name: 'jumlah'},
                    {
                        data: 'potensi',
                        name: 'potensi',
                        render: function(data, type, row) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                ],
                paging: false,
                searching: false,
            });

            $('.data-jenis-pelanggaran').DataTable({
                processing: false,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table3' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'jenis',
                        name: 'jenis',
                        render: function(data, type, row) {
                            return `<a href="/fouls/${row.jenis}" style="text-decoration: underline !important;">
                                        ${row.jenis}
                                    </a>`;
                        }
                    },
                    {data: 'jumlah', name: 'jumlah'},
                    {
                        data: 'potensi',
                        name: 'potensi',
                        render: function(data, type, row) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    }
                ],
                paging: false,
                searching: false,
            });
        });
    </script>
@endpush
