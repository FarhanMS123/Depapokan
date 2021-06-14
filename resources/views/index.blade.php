<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Depapokan</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="p-0 pt-5 pb-4 m-0" style="background: #EEEEEE;">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Padepokan</h4>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($padepokans as $padepokan)
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <img class="w-100" src="{{asset($padepokan->gambar)}}" alt="">
                        </div>
                        <div class="col-2">{{ $padepokan->nama }}</div>
                        <div class="col-5">{{ $padepokan->deskripsi }}</div>
                        <div class="col-3">
                            <a href="{{ route('ubah', $padepokan->id) }}" type="button" class="btn btn-primary">Ubah</a>
                            <form class="d-inline-block" action="{{route('ubah', $padepokan->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <div class="mt-1">
                                <a href="{{ route('ulas', $padepokan->id) }}" type="button" class="btn btn-success">Ulasan ({{ $padepokan->ulasan->count() }})</a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="card-footer d-flex justify-content-end">
                <a type="button" href="{{ route('tambah') }}" class="btn btn-primary">Tambah Perguruan</a>
            </div>
        </div>
    </div>
</body>
</html>
