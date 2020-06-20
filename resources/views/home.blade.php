@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    <a name="crud" id="crud" class="btn btn-outline-success btn-block btn-lg" href="/crud" role="button">Latihan CRUD dengan Ajax</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
