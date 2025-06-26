{{-- resources/views/auth/verify-email.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Email Verification</div>
            <div class="card-body">
                <p class="mb-4">Before proceeding, please check your email for a verification link.</p>
                <p>If you didn’t receive the email, click the button below to request another.</p>

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                </form>

                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>    
</div>

@endsection
