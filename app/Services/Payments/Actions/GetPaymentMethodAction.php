<?php

namespace App\Services\Payments\Actions;


use App\Services\Payments\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Collection;

class GetPaymentMethodAction
{
    private bool|null $active = null;
    private int|null $id = null;

    public function id(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function active(bool $active): static
    {
        $this->active = $active;
        return $this;
    }

    public function get(): Collection
    {
        $query = PaymentMethod::query();

        if (!is_null($this->active)) {
            $query->where('active', $this->active);
        }

        return $query->get();
    }

    public function first(): PaymentMethod|null
    {
        $query =  PaymentMethod::query();

        if (!is_null($this->active)) {
            $query->where('active', $this->active);
        }

        if (!is_null($this->id)) {
            $query->where('id', $this->id);
        }

        return $query->first();
    }
}
