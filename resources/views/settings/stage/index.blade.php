@extends('layouts.app')

@if(auth()->user()->role == 'admin')
@section('content')
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="row">
                <h3 class="col-9 m-3">Stages</h3>
                <div class="col-2 m-3">
                    <a href="" class="btn btn-primary"
                       data-bs-toggle="modal" data-bs-target="#addStageModal"
                    >Add Stage</a>
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
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="stagesTable">
                    @foreach($stages as $stage)
                        <tr>
                            <td>{{$stage->name}}</td>
                            <td>{{$stage->description}}</td>
                            <td>{{$stage->order}}</td>
                            <td>@if($stage->status)
                                    <span class="text-success">Active</span>
                                @else
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-primary"
                                   onclick="editStage('{{$stage->id}}', '{{$stage->name}}', '{{$stage->description}}', '{{$stage->order}}')"
                                   data-bs-toggle="modal" data-bs-target="#editStageModal"
                                >Edit</a>
                                <a href="{{ route('settings.stage.toggle', $stage->id) }}" class="btn btn-{{ $stage->status ? 'danger' : 'success' }}">
                                    {{ $stage->status ? 'Deactivate' : 'Activate' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addStageModal" tabindex="-1" aria-labelledby="addStageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStageModalLabel">Add Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addStageForm"
                          action="{{route('settings.stage.store')}}"
                          method="POST"
                    >
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editStageModal" tabindex="-1" aria-labelledby="editStageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStageModalLabel">Edit Stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editStageForm"
                          action="{{route('settings.stage.update')}}"
                          method="POST"
                    >
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit_description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" min="1" max="100" step="1" class="form-control" id="edit_order" name="order" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchQuery = this.value.toLowerCase();
            var tableRows = document.querySelectorAll('#stagesTable tr');
            tableRows.forEach(function(row) {
                var rowText = row.textContent.toLowerCase();
                if (rowText.indexOf(searchQuery) !== -1) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function editStage(id, name, description, order) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_order').value = order;
        }
    </script>
@endsection
@else
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh; margin: 0;">

        <h1 class="text-center">You are not Authorized to view this page. Contact the system administrator if you feel this is a mistake.</h1>

    </div>
@endif
