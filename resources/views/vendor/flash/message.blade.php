@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="toast align-items-center text-{{ $message['level'] == 'warning' ? 'black' : 'white'}} bg-{{ $message['level'] }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ $message['message'] }}
                </div>
                <button type="button" class="btn-close {{ $message['level'] != 'warning' ? 'btn-close-white' : '' }} me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
