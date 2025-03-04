@extends('layouts.my_admin_layout')
@section('title', 'Kelola Buku')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Kelola Buku</h1>
            @include('components.flash-message')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex mb-4 justify-content-end">
                        <a href="{{ route('admin.books.create') }}" class="btn my-bg text-white p-2 px-4"><i
                                class="fa fa-plus fa-fw"></i>
                            Tambah Data</a>
                    </div>
                    <table id="datatable" class="table table-bordered rounded w-100">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Author</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Terbit Pada</th>
                                <th class="text-center">Cover</th>
                                <th class="text-center"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $data)
                                <tr>
                                    <td class="text-center">{{ $no++ }}</td>
                                    <td>{{ $data->title }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->author }}</td>
                                    {{-- string limit --}}
                                    <td>{{ Str::limit($data->description, 50) }}</td>
                                    <td>{{ $data->published_at }}</td>
                                    <td class="text-center">
                                        <img src="{{ url('storage/cover_image/' . $data->cover_image) }}" alt="{{ $data->title }}"
                                            class="img-fluid" style="width: 100px">
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.books.edit', [$data->id]) }}"
                                            class="btn my-bg text-white"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin.books.destroy', [$data->id]) }}"
                                            class="d-inline-block delete-btn" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
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
