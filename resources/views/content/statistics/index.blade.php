@extends('layouts.layoutMaster')

@section('title', 'User Task Statistics List - Pages')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
  .checked {
    color: orange;
  }
</style>

@section('content')
<div class="d-flex justify-content-between align-items-center">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">User Task Statistics /</span> List
    <br>
  </h4>
</div>

<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="data-table2" class="table border p-0 text-nowrap mb-0">
        <thead class="tabel-row-heading text-dark">
          <tr style="background:#f4f5f7">
        <th>User</th>
        <th>Email</th>
        <th>Task Count</th>
      </tr>
    </thead>
    <tbody>
      @foreach($topUsers as $topUser)
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <div class="avatar avatar-sm me-3">
              <img src="{{ $topUser->user->image }}" alt="Image" class="rounded-circle">
            </div>
            <div>
              <span class="fw-semibold">{{ $topUser->user->fname }}</span>
            </div>
          </div>
        </td>
        <td>{{ $topUser->user->email }}</td>
        <td>{{ $topUser->task_count }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{!! Toastr::message() !!}
@endsection
