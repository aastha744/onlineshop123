<!-- Messages -->
<div class="toast-container position-fixed bottom-0 start-0 p-3">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endforeach
    @endif
    @include('flash::message')
</div>
<!-- Messages -->
