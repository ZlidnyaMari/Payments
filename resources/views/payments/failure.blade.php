@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <div class="text-center">
                <div class="mb-4 text-success">
                </div>
                <h5>
                    Оплата отменена
                </h5>
                <p>
                    Обычно это занимает несколько минут
                </p>
                <a href="{{ $payment->payable->getPayableUrl() }}" class="btn btn-primary">
                    Продолжить
                </a>
            </div>
        </div>
    </section>
@endsection
