<div class="bg-light">
    <div class="container py-5">
        <h2 class="my-text-color text-center mb-5">Temukan Sekarang</h2>
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari produk atau jasa yang kamu butuhkan" aria-label="Cari produk atau jasa yang kamu butuhkan" aria-describedby="button-addon2">
                    <button class="btn my-bg text-white" type="button" id="button-addon2">Cari</button>
                </div>
            </div>

            {{-- row product --}}
            <div class="row">
                @foreach ($datas as $data)
                <div class="col-4">
                    <div class="card">
                        {{-- gambar --}}
                        <img src="{{ url('storage/product/' . $data->images[0]->image) }}" alt="{{ $data->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        {{-- harga pojok kanan atas --}}
                        <span class="badge bg-primary position-absolute" style="top: 10px; right: 10px">Rp. {{ number_format($data->price, 0, ',', '.') }}</span>
                        {{-- card body --}}
                        <div class="card-body">
                            <h5 class="card-title my-text-color">{{ substr($data->name, 0, 20) }}</h5>
                            {{-- category foreach --}}
                            <p class="card-text mb-1">
                                @foreach ($data->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                @endforeach
                            </p>
                            {{-- deskripsi max 100 karakter --}}
                            <p class="card-text">{{ substr($data->description, 0, 100) }}</p>
                            <a href="#" class="btn my-bg text-white col-12">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

