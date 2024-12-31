<?php

namespace Modules\Campaigns\App\Http\Controllers\Api\Auth\Gateways;

trait Curlec
{
    /**
     * Prepares the JSON structure to save in the donation column `transaction_json`.
     *
     * @param array<string, mixed> $curlec Curlec data structure.
     * @return array<string, mixed>
     */
    public function getCurlecInfo($curlec): array
    {
        return [
            'accept_partial'    => $curlec['accept_partial'],
            'amount'            => $curlec['amount'],
            'amount_paid'       => $curlec['amount_paid'],
            'callback_method'   => $curlec['callback_method'],
            'callback_url'      => $curlec['callback_url'],
            'cancelled_at'      => $curlec['cancelled_at'],
            'created_at'        => $curlec['created_at'],
            'currency'          => $curlec['currency'],
            'customer' => [
                'email'     => $curlec['customer']['email'],
                'name'      => $curlec['customer']['name'],
                'contact'   => $curlec['customer']['contact']
            ],
            'description'   => $curlec['description'],
            'expire_by'     => $curlec['expire_by'],
            'expired_at'    => $curlec['expired_at'],
            'first_min_partial_amount' => $curlec['first_min_partial_amount'],
            'id' => $curlec['id'],
            'notes' => [
                'InvoiceNo'   => $curlec['notes']['InvoiceNo'],
                'donation_id' => $curlec['notes']['donation_id'],
                'campaign_id' => $curlec['notes']['campaign_id'],
            ],
            'notify' => [
                'email' => $curlec['notify']['email'],
                'sms' => $curlec['notify']['sms'],
                'whatsapp' => $curlec['notify']['whatsapp'],
            ],
            //'order_id' => $curlec['order_id'],
            'payments' => [
                'amount' => $curlec['payments'][0]['amount'] ?? '',
                'created_at' => $curlec['payments'][0]['created_at'] ?? '',
                'payment_id' => $curlec['payments'][0]['payment_id'] ?? '',
                'status' => $curlec['payments'][0]['status'] ?? '',
            ],
            'reference_id' => $curlec['reference_id'],
            'reminder_enable' => $curlec['reminder_enable'],
            'short_url' => $curlec['short_url'],
            'status' => $curlec['status'],
            'updated_at' => $curlec['updated_at'],
            'upi_link' => $curlec['upi_link'],
            'user_id' => $curlec['user_id'],
            'whatsapp_link' => $curlec['whatsapp_link'],
        ];
    }

    /**
     * Checks the reference_id in the donation to retrieve and save transaction data.
     *
     * @param mixed $id Reference ID to fetch data.
     * @return array
     */
    public function curlec($id): array
    {
        $curlec = curlec()->paymentLink->fetch($id);
        if (!empty($curlec)) {
            $transaction_json = $this->getCurlecInfo($curlec);
            $entity = $this->entity::where('reference_id', $id)->first();
            $entity->status = $transaction_json['status']  == 'paid' ? 'done' : 'rejected';
            $entity->gateway = 'curlec';
            $entity->transaction_json = json_encode($transaction_json);
            $entity->save();
            return [
                'message' => __('campaigns::curlec.' . $transaction_json['status']),
                'status' => 200
            ];
        } else {
            return  [
                'message' => __('campaigns::messages.please_send_the_reference_id'),
                'status' => 301
            ];
        }
    }
}
