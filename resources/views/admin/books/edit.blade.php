@extends('layouts.my_admin_layout')
@section('title', 'Ubah Buku')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Ubah Buku</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.books.update', [$data->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required value="{{ $data->title }}">
                        </div>
                        {{-- kategori --}}
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" class="form-control" id="category" name="category" required value="{{ $data->category }}">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" class="form-control" id="author" name="author" required value="{{ $data->author }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $data->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="published_at" class="form-label
                            ">Terbit Pada</label>
                            <input type="date" class="form-control" id="published_at" name="published_at" required value="{{ $data->published_at }}">
                        </div>
                        {{-- display gambar sekarang --}}
                        <div class="mb-3">
                            <label for="cover" class="form-label">Cover</label>
                            <img src="{{ url('storage/' . $data->cover) }}" alt="{{ $data->title }}"
                                class="img-fluid" style="width: 100px">
                        </div>
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover (Kosongkan jika tidak ingin mengubah cover)</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn my-bg text-white p-2 px-4"><i class="fa fa-save fa-fw"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/7xnlebadsdtolt354v068luj3h8nyhzkv3ah7upzxliu57p7/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
{{-- <script>
    $(document).ready(function() {
        tinymce.init({
            selector: '#answer',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    });
</script> --}}
@endsection
