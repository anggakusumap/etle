@extends('layouts.app')

@section('title', '' . $fouls)

@section('content')
    <div class="w-full">
        <div class="card p-3 rounded-lg mt-4" style="background: #141719; color: white">
            <div class="card-header" style="background: #141719">
                <div class="flex justify-end">
                    <a href="{{ url('/') }}">
                        <button class="bg-[#3A1CC3] px-3 py-2 rounded-sm font-bold text-white hover:bg-blue-700 transition text-sm">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                        </button>
                    </a>
                </div>
                <p class="text-2xl">
                    Jenis Pelanggaran :
                    <span class="font-bold">
                        {{$fouls}}
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
                    <table class="table data-table-show text-white">
                        <thead>
                            <tr>
                                <th>Plat</th>
                                <th>Lokasi</th>
                                <th>Tipe Kendaraan</th>
                                <th>Warna Kendaraan</th>
                                <th>Potensi (Rp.)</th>
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
                ajax: "{{ route('fouls.show', $fouls) }}",
                columns: [
                    { data: 'plat', name: 'plat', searchable: true },
                    { data: 'lokasi', name: 'lokasi' },
                    { data: 'tipe_kendaraan', name: 'tipe_kendaraan' },
                    { data: 'warna_kendaraan', name: 'warna_kendaraan' },
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
