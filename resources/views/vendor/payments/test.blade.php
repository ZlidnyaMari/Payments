@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Тестовый платеж (кастомная страница)
                            </h5>
                            <p>
                                Вы можете подтвердить или отменить оплату в целях теста
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <form action="{{route('payments.complete', $payment)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            Подтвердить
                                        </button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{route('payments.cancel', $payment)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            Отменить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

