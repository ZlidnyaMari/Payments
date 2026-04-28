<?php

namespace App\Support\Values;

use http\Exception\InvalidArgumentException;
use Illuminate\Contracts\Database\Eloquent\Castable;

class AmountValue implements Castable
{
    private string $value;

    public function __construct(string $value)
    {
        if (!is_numeric($value)) {

            throw new InvalidArgumentException(
                'Invalid amount value: ' . $value,
            );
        }

        $this->value = $value;

    }

    public function value(): string
    {
        return $this->value;
    }

    public function mul(AmountValue $amount, ?int $scale = null): AmountValue
    {
        $result = bcmul($this->value, $amount->value(), $scale); // функция для точного умножения
        return new AmountValue($result);
    }

    public function div(AmountValue $amount, ?int $scale = null): AmountValue
    {
        $result = bcdiv($this->value, $amount->value(), $scale); // функция для точного деления
        return new AmountValue($result);
    }

    public function add(AmountValue $amount, ?int $scale = null): AmountValue
    {
        $result = bcadd($this->value, $amount->value(), $scale); // функция для точного сложения
        return new AmountValue($result);
    }

    public function sub(AmountValue $amount, ?int $scale = null): AmountValue
    {
        $result = bcsub($this->value, $amount->value(), $scale); // функция для точного вычитания
        return new AmountValue($result);
    }

    public static function castUsing(array $arguments): string
    {
        return AmountCast::class;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
