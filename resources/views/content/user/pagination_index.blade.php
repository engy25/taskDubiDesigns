<?php
$i=0;
?>
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table id="data-table2" class="table border p-0 text-nowrap mb-0">
        <thead class="tabel-row-heading text-dark">
          <tr style="background:#f4f5f7">
            <th class="fw-semibold border-bottom">{{ trans('words.user') }}</th>
            <th class="fw-semibold border-bottom">{{ trans('words.role') }}</th>
            <th class="fw-semibold border-bottom">{{ trans('words.phone') }}</th>
            <th class="fw-semibold border-bottom">{{ trans('words.active') }}</th>
          
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>

            <td class="sorting_1">
              <div class="d-flex align-items-center user-name">
                <div class="avatar-wrapper">
                  <div class="avatar avatar-sm me-3">
                    <img src="{{ $user->image }}" alt="Image" class="rounded-circle">
                  </div>
                </div>
                <div class="d-flex flex-column">
                  <span class="fw-semibold">{{ $user->fname }}</span>
                  <small class="text-muted">{{ $user->email }}</small>
                </div>
              </div>
            </td>

            <td>
              @if($user->roles->isNotEmpty())

              @foreach($user->roles as $role)
              <span class="badge bg-primary">{{ $role->name }}</span>
              @endforeach
              @else
              <span class="text-muted">No roles assigned</span>
              @endif

            </td>

            <td>
              <span class="text-dark fs-13 fw-semibold">{{ $user->country_code }} {{ $user->phone }}</span>
            </td>
            <td>
              @if($user->is_active==1)
              <span class="badge text-white bg-success fw-semibold fs-11">Active</span>
              @else
              <span class="badge text-white bg-danger fw-semibold fs-11">Not Active</span>
              @endif
            </td>

          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-4 d-flex justify-content-center">
        @if ($users->lastPage() > 1)
        {{ $users->links('pagination.simple-bootstrap-4') }}
        @endif
      </div>



