@extends('template')
@section('content')
    @include('blocks.bread')

    <div class="coupon-area">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title mb-20">
                <h2>Заказ успешно оформлен!</h2>
            </div>
            <!-- Section Title Start End -->
            <div class="row">
                <div class="col-lg-12">
                    <h5>Уникальный номер вашего заказа: <i>{{ $unique_id }}</i></h5>

                    <h5 class="my-2">Наш менеджер свяжется с Вами в ближайшее время для проверки и подтверждения информации.</h5>

                    <h6 style="text-align: center" class="my-5"><a href="{{ route('catalog.index') }}">Перейти в каталог</a></h6>
                </div>
            </div>
        </div>
    </div>

    @include('blocks.brands')
@endsection
