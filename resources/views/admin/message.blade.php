@extends('layouts.my_admin_layout')
@section('title', 'Kelola Pesan Masuk')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Kelola Pesan Masuk</h1>
            @include('components.flash-message')
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered rounded w-100">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">No Telepon</th>
                                <th class="text-center">Pesan</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($datas->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endif
                            <?php $no = 1; ?>
                            @foreach ($datas as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{Str::limit($data->message, 50)}}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td class="text-center">
                                        {{-- menampilkan modal detail --}}
                                        <a href="#" class="btn my-bg text-white" data-bs-toggle="modal"
                                            data-bs-target="#detail{{ $data->id }}"><i class="fa fa-eye"></i></a>
                                        {{-- modal --}}
                                        <div class="modal fade text-start" id="detail{{ $data->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="mb-0">Nama Pengirim: </p>
                                                        <p class="fw-bold">{{ $data->name }}</p>
                                                        <p class="mb-0">Email Pengirim: </p>
                                                        <p class="fw-bold">{{ $data->email }}</p>
                                                        <p class="mb-0">No Telepon: </p>
                                                        <p class="fw-bold">{{ $data->phone }}</p>
                                                        <hr>
                                                        <p class="mb-0">Pesan: </p>
                                                        <p class="fw-bold">{!! $data->message !!}</p>
                                                        <hr>
                                                        <p class="mb-0">Tanggal: </p>
                                                        <p class="fw-bold">{{ $data->created_at }}</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            new DataTable('#datatable', {
                "columnDefs": [{
                    "orderable": false,
                    "targets": 2
                }]
            });
        })
    </script>
@endsection
