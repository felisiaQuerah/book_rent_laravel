@extends('layouts.my_admin_layout')
@section('title', 'Sewa Buku')
@section('content')
    <main class="content">
        <div class="container p-0">
            <h1 class="mb-3 fw-bold my-text-color">Sewa Buku</h1>
            @include('components.flash-message')
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.rent', $book->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="rented_at">Tanggal Sewa</label>
                                <input type="date" class="form-control" id="rented_at" name="rented_at" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="returned_at">Tanggal Kembali</label>
                                <input type="date" class="form-control" id="returned_at" name="returned_at" required>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn my-bg text-white p-2 px-4"><i class="fa fa-save fa-fw"></i>
                                Sewa Sekarang</button>
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
