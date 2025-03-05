@extends('layouts.Client')
@section('content')
    <section class="slider-container">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <h4>Transit minimaliste industriel</h4>
                    </li>
                </ul>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                    <i class="las la-arrow-left"></i>
                </button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                    <i class="las la-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>
@endsection