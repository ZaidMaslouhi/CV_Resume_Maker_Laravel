<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if(session()->has('success'))
                <div class="alert alert-success my-2" role="alert">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

