@extends('layouts.app')

@section('title', '' . $camera)

@section('content')
    <div class="w-full">
        <div class="flex justify-end">
            <a href="{{ url('/') }}">
                <button class="bg-[#3A1CC3] px-10 py-2 rounded-sm font-bold text-white hover:bg-blue-700 transition">
                    BACK
                </button>
            </a>
        </div>
        <div class="card p-3 rounded-lg mt-4" style="background: #141719; color: white">
            <div class="card-header flex flex-col" style="background: #141719">
                <p class="text-2xl">
                    Lokasi :
                    <span class="font-bold">
                        {{$camera}}
                    </span>
                </p>
                <p class="text-xl -mt-3">
                    Jumlah Pelanggaran :
                    <span class="font-bold">
                        {{$jumlahPelanggaran}}
                    </span>
                </p>
            </div>
            <div class="card-body -mt-3">
                <div class="table-responsive w-100 d-block d-md-table">
                    <table class="table table-bordered data-table-show text-white">
                        <thead class="bg-white text-black">
                            <tr>
                                <th>Plat</th>
                                <th>Tipe Kendaraan</th>
                                <th>Warna Kendaraan</th>
                                <th>Jenis Pelanggaran</th>
                                <th>Tanggal Pelanggaran</th>
                                <th>Potensi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $('.data-table-show').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('locations.show', $camera) }}",
                columns: [
                    { data: 'plat', name: 'plat' },
                    { data: 'tipe_kendaraan', name: 'tipe_kendaraan' },
                    { data: 'warna_kendaraan', name: 'warna_kendaraan' },
                    { data: 'jenis_pelanggaran', name: 'jenis_pelanggaran' },
                    { data: 'tanggal_pelanggaran', name: 'tanggal_pelanggaran' },
                    {
                        data: 'potensi',
                        name: 'potensi',
                        render: function(data) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                ],
                initComplete: function() {
                    $('.dataTables_filter').css('margin-bottom', '24px');
                    $('.dataTables_info').css('margin-top', '18px');
                    $('.dataTables_paginate').css('margin-top', '24px');
                }
            });
        });
    </script>
@endpush
