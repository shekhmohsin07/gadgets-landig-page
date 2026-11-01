@extends('admin.layout')
@section('title', 'Change password')
@section('content')
<h1 class="h4 fw-bold mb-3">Change password</h1>
<form method="post" action="{{ route('admin.settings.account.save') }}" class="card card-body" style="max-width:480px">
    @csrf
    <div class="mb-3"><label class="form-label">Current password</label><input type="password" name="current_password" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">New password (min 8)</label><input type="password" name="password" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Confirm new password</label><input type="password" name="password_confirmation" class="form-control" required></div>
    <button class="btn btn-brand">Update password</button>
</form>
@endsection
