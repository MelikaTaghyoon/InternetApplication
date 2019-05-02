@extends('layouts.app')
@section('content')
@push('styles')
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endpush
<div class="content">
    <div class="row justify-content-center">
        <svg width="380px" height="500px" viewBox="0 0 837 1045" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <path d="M353,9 L626.664028,170 L626.664028,487 L79.3359724,487 L79.3359724,170 L353,9 Z" id="Polygon-1" stroke="#FF005C" stroke-width="16" fill="#f0f0f5" sketch:type="MSShapeGroup"></path>
                <path d="M78.5,529 L147,569.186414 L147,648.311216 L10,648.311216 L10,569.186414 L78.5,529 Z" id="Polygon-2" stroke="#FDDF03" stroke-width="16" fill="#f0f0f5" sketch:type="MSShapeGroup"></path>
                <path d="M773,186 L827,217.538705 L827,279.636651 L719,279.636651 L719,217.538705 L773,186 Z" id="Polygon-3" stroke="#3CAEA3" stroke-width="16" fill="#f0f0f5" sketch:type="MSShapeGroup"></path>
                <path d="M639,529 L773,607.846761 L773,763.091627 L505,763.091627 L505,607.846761 L639,529 Z" id="Polygon-4" stroke="#00B2C0" stroke-width="16"  fill="#f0f0f5" sketch:type="MSShapeGroup"></path>
                <path d="M281,801 L383,861.025276 L383,979.21169 L179,979.21169 L179,861.025276 L281,801 Z" id="Polygon-5" stroke="#20639B" stroke-width="16" fill="#f0f0f5" sketch:type="MSShapeGroup"></path>
            </g>
        </svg>
        <div class="container">
        
        <div class="message-box">
          <h1>Petwo</h1>
          <p>At petwo, We believe everyone deserves a second chance in life, so do pets</p>
          <h4 id="label" >Help us give them a new home</h4>
          </div>
        </div>

    </div>

</div>
@endsection