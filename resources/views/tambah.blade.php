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
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card">
                <form action="{{ route("tambah") }}" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h4>Tambah Depapokan</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                        @endforeach

                        <div class="mb-3">
                            <label for="fileLogo" class="form-label">Logo</label>
                            <div id="conImg" class="mb-1 d-none">
                                <img id="img" class="w-100" src="#">
                            </div>
                            <input class="form-control @error("gambar") is-invalid @enderror" type="file" id="fileLogo" name="gambar">
                            @error("gambar")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error("nama") is-invalid @enderror" id="inputNama" name="nama" value="{{ old("nama") }}">
                            @error("nama")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="areaDeskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error("deskripsi") is-invalid @enderror" id="areaDeskripsi" rows="3">{{ old("deskripsi") }}</textarea>
                            @error("deskripsi")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        @csrf
                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // https://stackoverflow.com/a/4459419/5832341
        $("#fileLogo").change(function(){
            var file = $("#fileLogo")[0].files[0];
            if(file){
                $("#img").attr("src", URL.createObjectURL(file));
                $("#conImg").removeClass("d-none");
            }else $("#conImg").addClass("d-none");
        });
    </script>
</body>
</html>
