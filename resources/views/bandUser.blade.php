@extends('client_template.master')
@section('content')
    <div class="">
        <div class="my-3">
            <h4 class="text-danger"> <i class="bi bi-exclamation-circle "></i> You are banded by Admin.</h4>
            <div class="text-danger">
                <p class="text-danger"> <i class="bi bi-chevron-double-right"></i> You against the {{ config('app.name','LaraBlog') }} policy.</p>
                <p class="text-danger"> <i class="bi bi-chevron-double-right"></i> Please Contact to Admin.</p>
            </div>
            <hr>
        </div>
    </div>
@endsection
