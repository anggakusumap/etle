@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col gap-4">
        <div class="card p-3 rounded-lg" style="background: #141719; color: white">
            <div class="card-header text-xl font-bold">Per Range Waktu</div>
            <div class="card-body">
                <table class="table table-bordered data-table-1 text-white">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
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
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
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
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            var table1 = $('.data-table-1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                ]
            });

            var table2 = $('.data-table-2').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                ]
            });

            var table3 = $('.data-table-3').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                ]
            });

        });
    </script>
@endpush
