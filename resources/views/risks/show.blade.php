@extends('layouts.app')

@section('title', '' . $risk->risk_code)

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
            <div class="card-header text-center flex justify-center gap-2 text-2xl " style="background: #141719">
                RISK CODE :
                <p class="font-bold">
                    {{$risk->risk_code}}
                </p>
            </div>
            <div class="card-body -mt-3">
                <div class="table-responsive w-100 d-block d-md-table">
                    <table class="table data-table-show text-white">
                        <thead>
                            <tr>
                                <th>Plat</th>
                                <th>Jumlah Pelanggaran</th>
                                <th>Nominal Pelanggaran</th>
                                <th>Risk Score</th>
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
                ajax: "{{ route('risks.show', $risk->risk_code) }}",
                columns: [
                    { data: 'plat', name: 'plat' },
                    { data: 'total_pelanggaran', name: 'total_pelanggaran' },
                    {
                        data: 'denda_total',
                        name: 'denda_total',
                        render: function(data, type, row) {
                            return 'Rp. ' + new Intl.NumberFormat('id-ID').format(data);
                        }
                    },
                    {
                        data: 'skor_risiko',
                        name: 'skor_risiko',
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('en-US').format(data);
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
