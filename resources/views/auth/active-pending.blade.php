@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your account is not actived') }}</div>

                <div class="card-body">
                  Your account <strong>has NOT been activated</strong> yet.<br>
                  Your account should be activated by an administrator before you can access.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
