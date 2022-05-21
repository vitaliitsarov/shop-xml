@extends('layouts.app')

@section('content')
<div class="filter__item">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="filter__sort">
                                    <span>Sortuj według</span>
                                    <select>
                                        <option value="title-ASC">nazwy (A-Z)</option>
                                        <option value="title-DESC">nazwy (Z-A)</option>
                                        <option value="price_brutto-ASC">ceny (rosnąco)</option>
                                        <option value="price_brutto-DESC">ceny (malejąco)</option>
                                        <option value="created_at-ASC">daty dodania (rosnąco)</option>
                                        <option value="created_at-DESC">daty dodania (malejąco)</option>
                                        <option value="p.ordering-DESC">domyślnej kolejności</option>
                                        <option value="p.sell_count-DESC">najlepiej sprzedające się</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $product->getMainImage() }}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ route('product.show', ['id' => $product->getId(), 'slug' => $product->getSlug($product->getTitle())]) }}">{{ $product->getTitle() }}</a></h6>
                                        <h5>{{ $product->getBrutto() }} zł</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{ $products->links('vendor/pagination/simple-bootstrap-5') }}
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
@endsection
