@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <h4 class="mb-3">Оплата</h4>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-0">Детали платежа</h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">ID заказа</div>
                            <div class="col-8">{{$payment->uuid}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Сумма платежа</div>
                            <div class="col-8">{!! $payment->amount !!} {{$payment->currency_id}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Статус платежа</div>
                            <div class="col-8">
                                <div class="text-{{$payment->status->color()}}">{{$payment->status->name()}}</div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Операция</div>
                            <div class="col-8"> {{$payment->payable->getPayableName()}}</div>
                        </div>
                    </li>
                </ul>

                <div class="card-body">
                    @if($methods->isEmpty())
                        Извините, оплата временно недоступна (=
                    @else
                        <form action="{{route('payments.method', $payment->uuid)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <select name="method_id" class="form-control">
                                            <option value="">Cпособ оплаты</option>
                                            @foreach($methods as $method)
                                                <option value="{{$method->id}}">{{$method->name}} ({{$method->driver_currency_id}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Продолжить
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    @if($errors->any())
                        <div class="mb-3 text-danger">
                            {{$errors->first()}}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
