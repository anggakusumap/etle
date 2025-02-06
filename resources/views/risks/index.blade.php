@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col lg:flex-row justify-center gap-6 px-0 lg:px-0 w-full">
        <div class="w-full lg:w-3/4">
            <div class="flex flex-col gap-4">
                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Range Waktu</div>
                    <div class="card-body">
                        <table class="table table-bordered data-table-1 text-white">
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

                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Lokasi</div>
                    <div class="card-body">
                        <table class="table table-bordered data-table-2 text-white">
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

                <div class="card p-3 rounded-lg" style="background: #141719; color: white">
                    <div class="card-header text-xl font-bold">Per Jenis Pelanggaran</div>
                    <div class="card-body">
                        <table class="table table-bordered data-table-3 text-white">
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

        <div class="relative lg:w-1/2">
            <div id="risk_matrix" class="md:fixed text-center md:w-[30%] lg:w-[32%] xl:w-[35%] 2xl:w-[26%] bg-[#141719] rounded-sm px-4 py-8">
                <h1 class="text-2xl font-bold mb-4">Risk Matrix - Distribusi Kendaraan</h1>
                <div class="flex justify-center">
                    <div class="grid grid-cols-4 w-full max-w-4xl">
                        <p class="absolute left-[-10px] top-[45%] -translate-y-1/2 rotate-[-90deg] text-xl font-bold">
                            Likelihood
                        </p>

                        <p class="flex flex-col justify-center items-end mr-5">Low</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX1Y3->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX1Y3->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX2Y3->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX2Y3->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#ed0b07] hover:bg-red-600 border-1 border-black flex flex-col justify-center text-base text-white">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX3Y3->risk_code}}
                                </p>
                                <div class="border-1 border-white w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX3Y3->total}}</p>
                            </div>
                        </div>

                        <p class="flex flex-col justify-center items-end mr-5">Medium</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX1Y2->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX1Y2->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX2Y2->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX2Y2->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX3Y2->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX3Y2->total}}</p>
                            </div>
                        </div>

                        <p class="flex flex-col justify-center items-end mr-5">High</p>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX1Y1->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX1Y1->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#18bc3c] hover:bg-green-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX2Y1->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX2Y1->total}}</p>
                            </div>
                        </div>
                        <div class="h-32 cursor-pointer bg-[#f1ec0c] hover:bg-yellow-600 border-1 border-black flex flex-col justify-center text-base text-black">
                            <div class="flex flex-col">
                                <p class="m-0">
                                    {{$riskX3Y1->risk_code}}
                                </p>
                                <div class="border-1 border-black w-1/2 mx-auto m-0"></div>
                                <p class="m-0">{{$riskX3Y1->total}}</p>
                            </div>
                        </div>

                        <div></div>
                        <p class="mt-3">Low</p>
                        <p class="mt-3">Medium</p>
                        <p class="mt-3">High</p>

                        <div></div>
                        <p></p>
                        <p class="font-bold text-xl -mt-1">Impact</p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.data-table-1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table1' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'waktu', name: 'waktu'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'potensi', name: 'potensi'},
                ],
                paging: false,
                searching: false
            });

            $('.data-table-2').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table2' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'kamera', name: 'kamera'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'potensi', name: 'potensi'},
                ],
                paging: false,
                searching: false
            });

            $('.data-table-3').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('risks.index') }}",
                    data: { table_type: 'table3' }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'jenis', name: 'jenis'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'potensi', name: 'potensi'},
                ],
                paging: false,
                searching: false
            });
        });
    </script>
@endpush
