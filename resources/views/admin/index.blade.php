@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">Header Images</h1>
    <div class="row">
        @for($i = 1; $i <= 1; $i++)<admin-mast-head id="{{ $i }}"></admin-mast-head>@endfor
            <admin-services></admin-services>
            <!-- <admin-about></admin-about> -->
            <messages></messages>
    </div>
</div>

@endsection