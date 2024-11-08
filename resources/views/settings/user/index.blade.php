@extends('layouts.app')

@if(auth()->user()->role == 'admin')
@section('content')
    <div class="modal fade" id="addRiskFactorModal" tabindex="-1" aria-labelledby="addRiskFactorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRiskFactorModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRiskFactorForm"
                                                    action="{{route('settings.user.store')}}"
                          method="POST"
                    >
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_no" class="form-label">Employee Number</label>
                            <input type="text" class="form-control" id="employee_no" name="employee_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">User Roles</label>
                            <select type="text" class="form-control" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRiskFactorModal" tabindex="-1" aria-labelledby="addRiskFactorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRiskFactorModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRiskFactorForm"
                          action="{{route('settings.user.update')}}"
                          method="POST"
                    >
                        @csrf
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="edit_contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="employee_no" class="form-label">Employee Number</label>
                            <input type="text" class="form-control" id="edit_employee_no" name="employee_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">User Roles</label>
                            <select type="text" class="form-control" id="edit_role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-5">
        <div class="card">
            <div class="row">
                <h3 class="col-9 m-3">Users</h3>
                <div class="col-2 m-3">
                    <a href="" class="btn btn-primary"
                       data-bs-toggle="modal" data-bs-target="#addRiskFactorModal"
                    >Add User</a>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <table class="table text-wrap table-responsive">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Employee Number</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="usersTable">
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->employee_no}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->contact}}</td>
                            <td>@if(strtolower($user->status) == 'active')
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary"
                                   onclick="editUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->contact }}', '{{ $user->employee_no }}', '{{ $user->role }}')"
                                   data-bs-toggle="modal" data-bs-target="#editRiskFactorModal"
                                >Edit</a>
                                <a
                                    href="{{ route('settings.user.reset',[ 'user'=>$user->id]) }}"
                                    class="btn btn-sm btn-info">
                                   Reset
                                </a>
                                <a
                                    href="{{ route('settings.user.toggle',[ 'user'=>$user->id]) }}"
                                    class="btn btn-sm btn-{{ strtolower($user->status) =='active' ? 'danger' : 'success' }}">
                                    {{ strtolower($user->status) =='active' ? 'Deactivate' : 'Activate' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchQuery = this.value.toLowerCase();
            var tableRows = document.querySelectorAll('#usersTable tr');
            tableRows.forEach(function(row) {
                var rowText = row.textContent.toLowerCase();
                if (rowText.indexOf(searchQuery) !== -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function editUser(id, name, email, contact, employee_no, role) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_contact').value = contact;
            document.getElementById('edit_employee_no').value = employee_no;
            document.getElementById('edit_role').value = role;
        }
    </script>
@endsection
@else
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin: 0;">

    <h1 class="text-center">You are not Authorized to view this page. Contact the system administrator if you feel this is a mistake.</h1>

    </div>
@endif
