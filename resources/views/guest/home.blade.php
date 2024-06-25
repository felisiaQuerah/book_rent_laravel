@extends('layouts.my_admin_layout')
@section('title', 'Home')
@section('content')
    @include('components.welcome_hero')
    {{-- @include('components.info') --}}
    <div class="bg-light">
        <div class="container py-5">
            <h2 class="my-text-color text-center mb-5">Temukan Sekarang</h2>
            <div class="row">
                <div class="col-12">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="cari" placeholder="Cari buku yang kamu butuhkan" aria-label="Cari buku yang kamu butuhkan" aria-describedby="button-addon2"value="{{ $key ?? '' }}">
                        <button class="btn my-bg text-white" type="button" id="button-addon2">Cari</button>
                    </div>
                </div>
                @include('components.flash-message')
                {{-- row product --}}
                <div class="row">
                    @if($datas->isEmpty())
                        <div class="col-12">
                            <h3 class="text-center">Data tidak ditemukan</h3>
                        </div>
                    @endif
                    @foreach ($datas as $data)
                    <div class="col-4">
                        <div class="card h-100">
                            {{-- gambar --}}
                            <img src="{{ url('storage/cover_image/' . $data->cover_image) }}" alt="{{ $data->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            {{-- kategori pojok kanan atas --}}
                            <span class="badge bg-primary position-absolute" style="top: 10px; right: 10px"> {{ $data->category }}</span>
                            {{-- card body --}}
                            <div class="card-body">
                                <h5 class="card-title my-text-color">{{ substr($data->title, 0, 20) }}</h5>
                                {{-- deskripsi max 100 karakter --}}
                                <p class="card-text">{{ substr($data->description, 0, 150) }}</p>
                                <hr>
                                <a href="{{ route('user.rent', $data->id) }}" class="btn my-bg text-white col-12">Sewa</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- script --}}
@section('scripts')
    <script>
        $('#button-addon2').click(function() {
            let search = $('#cari').val();
            window.location.href = `{{ url('search') }}/${search}`;
        });
        //ketika tombol enter
        $('input').keypress(function(e) {
            if (e.which == 13) {
                let search = $('#cari').val();
                window.location.href = `{{ url('search') }}/${search}`;
            }
        });
    </script>
@endsection
