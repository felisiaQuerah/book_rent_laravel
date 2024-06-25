@extends('layouts.my_admin_layout')
@section('title', 'Riwayat Peminjaman Buku')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Riwayat Peminjaman Buku</h1>
            @include('components.flash-message')
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered rounded w-100">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Pinjam Pada</th>
                                <th class="text-center">Kembali Pada</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    {{-- format tanggal indonesia --}}
                                    <td> {{ date('d-m-Y', strtotime($data->rented_at)) }} </td>
                                    {{-- format tanggal indonesia --}}
                                    <td> {{ date('d-m-Y', strtotime($data->returned_at)) }} </td>
                                    <td>{{ $data->book->title }}</td>
                                    <td>{{ $data->book->author }}</td>
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

            const deleleBtn = document.querySelectorAll('.delete-btn')
            deleleBtn.forEach(el => {
                console.log(el)
                el.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Ingin menghapus data ini",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit()
                        }
                    })
                })
            })
        })
    </script>
@endsection
