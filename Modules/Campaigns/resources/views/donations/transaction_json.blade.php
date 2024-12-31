@if ($page == 'show' && $data->translation_json != null)
    <div class="col-md-12">
        @php
            $transaction_json = json_decode($data->transaction_json, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        @endphp
        {{-- @dd($transaction_json) --}}
        <p type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ trans('campaigns::main.transaction_details') }}
        </p>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ trans('campaigns::main.transaction_details') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-body">
                                {{-- Customer Card --}}
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('campaigns::main.donor') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.name') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['customer']['name'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.email') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['customer']['email'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.mobile') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['customer']['contact'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- Payment Card --}}
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('campaigns::main.payment_details') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.payment_id') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['payments']['payment_id'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.total_amount') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['payments']['amount'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.created_at') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ \Carbon\Carbon::createFromTimestamp($transaction_json['payments']['created_at']) }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.status') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ trans('campaigns::main.' . $transaction_json['payments']['status']) ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <hr>
                                {{-- Notes Card --}}
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('campaigns::main.notes') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.invoice_number') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notes']['InvoiceNo'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.campaign_number') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notes']['campaign_id'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.donation_number') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notes']['donation_id'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                                <hr>
                                {{-- Notify Card --}}
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('campaigns::main.notify') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.email') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notify']['email'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.sms') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notify']['sms'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.whatsapp') }} </p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['notify']['whatsapp'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                                {{-- Other Card --}}
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('campaigns::main.info') }}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.id') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['id'] ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.description') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['description'] ?? '-' }}</p>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.total_amount') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['amount'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.currency') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['currency'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.reminder_enable') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['reminder_enable'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.accept_partial') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['accept_partial'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.callback_url') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    <a
                                                        href="{{ $transaction_json['callback_url'] }}">{{ $transaction_json['callback_url'] }}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.cancelled_at') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['cancelled_at'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.expire_by') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['expire_by'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.expired_at') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['expired_at'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    {{ trans('campaigns::main.first_min_partial_amount') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['first_min_partial_amount'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    {{ trans('campaigns::main.whatsapp_link') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['whatsapp_link'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">
                                                    {{ trans('campaigns::main.upi_link') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ $transaction_json['upi_link'] == true ? trans('Yes') : trans('No') }}
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.status') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ trans('campaigns::main.' . $transaction_json['status']) ?? '-' }}
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.created_at') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ \Carbon\Carbon::createFromTimestamp($transaction_json['created_at']) }}
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">{{ trans('campaigns::main.updated_at') }}</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class=" mb-0">
                                                    {{ \Carbon\Carbon::createFromTimestamp($transaction_json['updated_at']) }}
                                                    <br>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif
