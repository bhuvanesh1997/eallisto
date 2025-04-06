@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form id="login-form">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div class="mt-3" id="login-error" style="color:red;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#login-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '/login',
                method: 'POST',
                data: $(this).serialize(),
                success: function () {
                    window.location.href = '/dashboard';
                },
                error: function (xhr) {
                    const error = xhr.responseJSON?.errors?.email?.[0] || 'Login failed';
                    $('#login-error').text(error);
                }
            });
        });
    });
</script>
@endsection
