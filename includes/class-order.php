<?php

namespace NikolayS93\PluginName;

class Order
{
    const STATUS_INIT = 'new';
    const STATUS_DONE = 'complete';

    public $id;
    public $status;
    public $amount;
    public $payment_type = '';
    public $payment_code = '';

    /**
     * @param int|string $orderId
     * @return mixed
     */
    public static function get($orderId = null)
    {

        if (is_string($orderId)) {
            return new static(getOrderFromDatabaseByPaymentCode($orderId));
        }

        if (is_numeric($orderId)) {
            return new static(getOrderFromDatabaseById($orderId));
        }

        // Get all orders
        return [];
    }

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->status = self::STATUS_INIT;

        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function complete(): void
    {
        $this->status = self::STATUS_DONE;
    }

    public function save(): void
    {
        // ...
    }
}
