<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="ulasan" content="{{ route('ulasan', ['id', 'uid']) }}">

    <title>Depapokan</title>

    <link rel="stylesheet" href="{{ asset('css/old_app.css') }}">
    <script src="{{ asset('js/old_app.js') }}"></script>
</head>
<body class="p-0 pt-5 pb-4 m-0" style="background: #EEEEEE;">

    <div id="conUbah" class="card position-absolute shadow d-none" style="z-index:1023; min-height:max-content;">
        <form action="#" method="post" enctype="application/x-www-form-urlencoded">
            <div class="card-body">
                    <div class="mb-2">
                        <label for="inputName" class="form-label">Nama siswa</label>
                        <input type="text" class="form-control" id="inputName" name="nama">
                    </div>
                    <div class="mb-2">
                        <label for="areaUlasan" class="form-label">Ulasan</label>
                        <textarea class="form-control" id="areaUlasan" rows="3" name="ulasan"></textarea>
                    </div>
            </div>
            <div class="card-footer">
                @csrf
                @method("PATCH")
                <button type="button" class="btn btn-link text-danger" onclick="closeConUbah(event);">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="card mb-4">
            <ul class="list-group list-group-flush">
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
            </ul>
        </div>

        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mb-1" role="alert">
            {{ $error }}
        </div>
        @endforeach

        <div class="card mt-4">
            @foreach ($padepokan->ulasan as $ulasan)
            <div class="card-body @if(!$loop->first) border-top @endif" data-id="{{ $padepokan->id }}" data-uid="{{ $ulasan->id }}">
                <h4 class="card-title" name='nama'>{{$ulasan->name}}</h4>
                <p class="text-muted">{{$ulasan->created_at}}</p>
                <p class="card-text" name='ulasan'>{{$ulasan->comment}}</p>
                <div>
                    <button type="button" class="btn btn-link text-muted" data-id="{{ $padepokan->id }}" data-uid="{{$ulasan->id}}" onclick="btnUbah(event, '{{ $padepokan->id }}', '{{ $ulasan->id }}');">Ubah</button>
                    <form class="d-inline-block" action="{{ route('ulasan', [$padepokan->id, $ulasan->id]) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-link text-muted">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
            <div class="card-footer clearfix @if($padepokan->ulasan->count() == 0) border-top-0 @endif">
                <form action="{{ route('ulas', $padepokan->id) }}" method="post" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <div class="mb-2">
                        <label for="inputName" class="form-label">Nama siswa</label>
                        <input type="text" class="form-control" id="inputName" name="nama">
                    </div>
                    <div class="mb-2">
                        <label for="areaUlasan" class="form-label">Ulasan</label>
                        <textarea class="form-control" id="areaUlasan" rows="3" name="ulasan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Ulas</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function btnUbah(event, id, uid){
            var cardBody = $(`.card-body[data-id=${id}][data-uid=${uid}]`);
            var bound = cardBody[0].getBoundingClientRect();
            var conUbah = $("#conUbah");

            conUbah.find("input[name=nama]").val(cardBody.find('h4[name=nama]').text());
            conUbah.find("textarea[name=ulasan]").val(cardBody.find('p[name=ulasan]').text());

            conUbah.removeClass('d-none')
                .css({
                    "opacity":"0.0",
                    "top": `${bound.top + window.scrollY}px`,
                    "left": `${bound.left + window.scrollX}px`,
                    "width": `${bound.width}px`
                });

            setTimeout(function(){
                conUbah.css({"transition": "all 0.2s ease 0s"})
                    .css({
                        "opacity": "1.0",
                        "top": `calc(${bound.top + window.scrollY}px - 1em)`,
                        "left": `calc(${bound.left + window.scrollX}px - 1em)`,
                        "width": `calc(${bound.width}px + 2em)`,
                    });

                conUbah.attr('data-id', id).attr('data-uid', uid);

                var url = $("meta[name='ulasan']").attr('content');
                url = url.replace(/\/id\//ig, `/${id}/`);
                url = url.replace(/\/uid/ig, `/${uid}`);
                $("#conUbah form").attr('action', url);
            }, 1);
        }

        function closeConUbah(event){
            var conUbah = $("#conUbah");

            var id = conUbah.attr('data-id');
            var uid = conUbah.attr('data-uid');

            var cardBody = $(`.card-body[data-id=${id}][data-uid=${uid}]`);
            var bound = cardBody[0].getBoundingClientRect();

            conUbah.css({
                    "opacity":"0.0",
                    "top": `${bound.top + window.scrollY}px`,
                    "left": `${bound.left + window.scrollX}px`,
                    "width": `${bound.width}px`,
                });

            setTimeout(function(){
                conUbah.addClass('d-none').css('transition',  '');
            }, 200);

            conUbah.attr('data-id', null).attr('data-uid', null);

            $("#conUbah form").attr('action', '#');
        }
    </script>
</body>
</html>
