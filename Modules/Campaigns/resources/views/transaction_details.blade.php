@if ($page == 'show')
    <div class="col-md-12">
        @php
            $transaction_details = json_encode($data->transaction_details, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        @endphp
JSON DATA
        {{-- $transaction_details --}}

    </div>
@endif
