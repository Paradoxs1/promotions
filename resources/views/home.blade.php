@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Admin panel</div>
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    <table class="table category-product">
                        <thead>
                            <tr>
                                <th>Продукт</th>
                                <th>Магазин</th>
                                <th>Название</th>
                                <th>Цена (грн)</th>
                                <th>Категория</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($data))
                            @foreach($data as $product)
                            <tr>
                                <td class="table-img"><img src="{{ $product->img }}" alt=""></td>
                                <td class="table-shop"><img src="{{ $product->shop }}" alt=""></td>
                                <td>{{ $product->name }} {{ $product->description }}</td>
                                <td class="table-price">{{ $product->price_sale }}</td>
                                <td>
                                    <select class="selectpicker" name="category">
                                        <option value="0">---</option>
                                        <option value="1">grocery</option>
                                        <option value="2">bakery</option>
                                        <option value="3">sweet_dessert</option>
                                        <option value="4">ready_meals</option>
                                        <option value="5">vegetables_fruits</option>
                                        <option value="6">milk_egg</option>
                                        <option value="7">meat_fish</option>
                                        <option value="8">fish_products_caviar</option>
                                        <option value="9">frozen</option>
                                        <option value="10">tea_coffe</option>
                                        <option value="11">beverages</option>
                                        <option value="12">tobacco</option>
                                        <option value="13">goods_for_animals</option>
                                        <option value="14">goods_for_children</option>
                                        <option value="15">cosmetics_and_hygiene</option>
                                        <option value="16">goods_for_home</option>
                                        <option value="17">cosmetics_and_hygiene</option>
                                        <option value="18">clothes_shoes</option>
                                        <option value="19">household_goods</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection


