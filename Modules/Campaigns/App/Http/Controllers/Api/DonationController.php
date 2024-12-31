<?php

namespace Modules\Campaigns\App\Http\Controllers\Api;

use Modules\Campaigns\App\Models\Donation;
use Modules\Campaigns\App\Resources\DonationResource;
use Modules\Campaigns\App\Http\Controllers\Api\Auth\Gateways\Curlec;

class DonationController extends \Lynx\Base\Api
{
    use Curlec;

    /**
     * @var string
     */
    protected $entity                   = Donation::class;
    /**
     * @var string
     */
    protected $resourcesJson            = DonationResource::class;
    /**
     * @var bool
     */
    protected $spatieQueryBuilder       = true;
    /**
     * @var bool
     */
    protected $paginateIndex            = true;
    /**
     * @var bool
     */
    protected $withTrashed              = true;
    /**
     * @var bool
     */
    protected $FullJsonInStore          = false;
    /**
     * @var bool
     */
    protected $FullJsonInUpdate         = false;
    /**
     * @var bool
     */
    protected $FullJsonInDestroy        = false;
    /**
     * can handel custom query when retrive data on index,indexGuest
     * @param Donation $entity
     * @return object
     */
    public function query($entity): object
    {
        return $entity->where(function ($query) {
            !empty(request('campaign_id')) ? $query->where('campaign_id', request('campaign_id')) : null;
        });
    }

    /**
     * Validation rules for store and update.
     *
     * @param string $type
     * @param int|string|null $id
     * @return array<string, string>
     */
    public function rules(string $type, mixed $id = null): array
    {
        return [
            'name'              => 'required|string',
            'email'             => 'required|email',
            'mobile'            => 'required|numeric',
            'love_donation'     => 'required|in:yes,no',
            'love_name'         => 'required_if:love_donation,yes|nullable|string',
            'love_email'        => 'required_if:love_donation,yes|nullable|email',
            'love_mobile'       => 'required_if:love_donation,yes|nullable|numeric',
            'love_comment'      => 'required_if:love_donation,yes|nullable|string',
            'ongoing_charity'   => 'required|in:yes,no',
            'amount'            => 'required|numeric',
            'charity_amount'    => 'required_if:ongoing_charity,yes|nullable|numeric',
            'currency_id'       => 'required|exists:countries,id',
            'campaign_id'       => 'required|exists:campaigns,id',
        ];
    }

    /**
     * Attribute names for validation messages.
     *
     * @return array<string, string>
     */
    public function niceName()
    {
        return [
            'name'              =>  __('campaigns::main.name'),
            'email'             =>  __('campaigns::main.email'),
            'mobile'            =>  __('campaigns::main.mobile'),
            'love_donation'     =>  __('campaigns::main.love_donation'),
            'love_name'         =>  __('campaigns::main.love_name'),
            'love_email'        =>  __('campaigns::main.love_email'),
            'love_mobile'       =>  __('campaigns::main.love_mobile'),
            'love_comment'      =>  __('campaigns::main.love_comment'),
            'ongoing_charity'   =>  __('campaigns::main.ongoing_charity'),
            'amount'            =>  __('campaigns::main.amount'),
            'charity_amount'    =>  __('campaigns::main.charity_amount'),
            'currency_id'       =>  __('campaigns::main.currency_id'),
            'campaign_id'       =>  __('campaigns::main.campaign_id'),
        ];
    }

    /**
     * Modify data before storing.
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    public function beforeStore(array $data): array
    {
        if ($data['love_donation'] == 'no') {
            unset(
                $data['love_name'],
                $data['love_email'],
                $data['love_mobile'],
                $data['love_comment']
            );
        }
        $currency = currency_change()['results'][env('CURLEC_CURRENCY')];
        $data['status']         = 'pending';
        $data['usd_rate']       = $currency;
        $data['amount']         = request('amount', 0);
        $data['total_amount']   = request('charity_amount',  0) + request('amount');
        $data['total_usd']      = $currency * $data['total_amount'];

        return $data;
    }

    /**
     * Handle actions after storing data.
     *
     * @param Donation $entity
     */
    public function afterStore($entity): void
    {
        $curlec = curlec()->paymentLink->create([
            'upi_link'          => env('CURLEC_MODE',) == 'sandbox' ? false : true,
            'accept_partial'    => false,
            'amount'            => intval(round(($entity->total_usd ?? 0) * 100)),
            'description'       => __('campaigns::messages.donate_for', ['name' => ($entity?->campaign?->name ?? '')]),
            'currency'          => env('CURLEC_CURRENCY'),
            'customer'          => [
                'name'      => $entity->name ?? '',
                'email'     => $entity->email ?? '',
                'contact'   => $entity->mobile ?? '',
            ],
            'notify'            => array('sms' => false, 'email' => false),
            'reminder_enable'   => false,
            'callback_url'      => url('curlec/return'),
            'callback_method'   => 'get',
            'notes' => [
                'InvoiceNo'     => ($entity->id ?? '') . '-' . time(),
                'donation_id'   => ($entity->id ?? 0),
                'campaign_id'   => $entity->campaign_id ?? '',
            ]
        ]);

        if (!empty($curlec) && isset($curlec['id'], $curlec['short_url']) && !empty($curlec['id'])) {
            $entity->reference_id =  $curlec['id'];
            $entity->gateway_url  =  $curlec['short_url'];
            $entity->save();
        }
    }

    /**
     * Handle gateway callback.
     *
     * @return mixed
     */
    public function gateway_callback(): mixed
    {
        abort_if(empty(request('razorpay_payment_link_id')), 400, __('campaigns::messages.missing_payment_link_id'));

        $gateway = $this->curlec(request('razorpay_payment_link_id'));

        return lynx()
            ->status($gateway['status'])
            ->message($gateway['message'])
            ->response();
    }


    /**
     * Modify data before updating.
     *
     * @param Donation $entity
     */
    public function beforeUpdate($entity): void
    {
        if (request()['love_donation'] == 'no') {
            unset(
                request()['love_name'],
                request()['love_email'],
                request()['love_mobile'],
                request()['love_comment']
            );
        }
    }



    /**
     * Modify data before showing.
     *
     * @param Donation $entity
     * @return Donation
     */
    public function beforeShow($entity): Object
    {
        return $entity;
    }

    /**
     * Modify data after showing.
     *
     * @param Donation $entity
     * @return DonationResource
     */
    public function afterShow($entity): Object
    {
        return new DonationResource($entity);
    }
}
