@if (count($errors) > 0)
    @foreach($errors->all() as $error)
        <div id="alert-box" class="alert alert-danger alert-rounded" role="alert">
            <i class="fa fa-stop"></i> <b>Error!</b> {{ $error }}
        </div>
    @endforeach
@endif

@if (Session('success'))
    <div id="alert-box" class="alert alert-success alert-rounded" role="alert">
        <i class="fa fa-check"></i> <b>Success!</b> {{ Session('success') }}
    </div>
@endif

@if (Session('error'))
    <div id="alert-box" class="alert alert-danger alert-rounded" role="alert">
        <i class="fa fa-stop"></i> <b>Error!</b> {{ Session('error') }}
    </div>
@endif

@if (Session('warning'))
    <div id="alert-box" class="alert alert-warning alert-rounded" role="alert">
        <i class="fa fa-exclamation-triangle"></i> <b>Warning!</b> {{ Session('warning') }}
    </div>
@endif

@if (Session('info'))
    <div id="alert-box" class="alert alert-info alert-rounded" role="alert">
        <i class="fa fa-info"></i> <b>Info!</b> {{ Session('info') }}
    </div>
@endif

@if (session('status'))
    <div id="alert-box" class="alert alert-info alert-rounded" role="alert">
        {{ session('status') }}
    </div>
@endif

<script>
    setTimeout(function() {
        $('#alert-box').fadeOut('fast');
    }, 10000);
</script>
