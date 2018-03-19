@if ($errors->any())
    <div class="alert alert-dismissible alert-warning">
        @foreach($errors->all() as $error)
            <p>
                {{ $error }}
            </p>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div class="alert alert-dismissible alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-dismissible alert-danger">
        {{ session('error') }}
    </div>
@endif