@if ($message = Session::get('success'))
    <div class="bg-success/10 border border-success/10 alert text-success" role="alert">
        <span class="font-bold">Succès : </span> {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="bg-danger/10 border border-danger/10 alert text-danger" role="alert">
        <span class="font-bold">Erreur : </span> {{ $message }}
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="bg-warning/10 border border-warning/10 alert text-warning" role="alert">
        <span class="font-bold">Attention : </span> {{ $message }}
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="bg-info/10 border border-info/10 alert text-info" role="alert">
        <span class="font-bold">Info : </span> {{ $message }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-danger/10 border border-danger/10 alert text-danger" role="alert">
        <span class="font-bold">Erreur : </span> {{ $message }}
    </div>
@endif
