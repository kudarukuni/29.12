<div>
    <input wire:model.live="search" class="form-control" type="text" placeholder="search">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>ID Number</th>
            <th>Company Registration</th>
            <th>Account Number</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Phone Number 2</th>
            {{--<th>Email</th>--}}
            {{--<th>Proposed Capacity</th>--}}
            {{--<th>Existing Capacity</th>--}}
            {{--<th>Inverter Make</th>--}}
            {{--<th>Inverter Model</th>--}}
            {{--<th>Isolation Protection</th>--}}
            {{--<th>Generation Meter Installed</th>--}}
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($state == 'all')
            @foreach($applications as $application)
                <tr>
                    <td>{{ $application->name }}</td>
                    <td>{{ ucfirst($application->type) }}</td> <!-- Capitalize 'individual' or 'company' -->
                    <td>{{ $application->id_number }}</td>
                    <td>{{ $application->company_reg ?? 'N/A' }}</td> <!-- Handle nullable field -->
                    <td>{{ $application->account_number }}</td>
                    <td>{{ $application->address()}}</td>
                    <td>{{ $application->phone_number }}</td>
                    <td>{{ $application->phone_number_2 }}</td>
                    {{-- <td>{{ $application->email }}</td> --}}
                    {{-- <td>{{ $application->proposed_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                    {{-- <td>{{ $application->existing_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                    {{-- <td>{{ $application->inverter_make }}</td> --}}
                    {{-- <td>{{ $application->inverter_model }}</td> --}}
                    {{-- <td>{{ $application->isolation_protection ? 'Yes' : 'No' }}</td> --}}
                    {{-- <td>{{ $application->generation_meter_installed ? 'Yes' : 'No' }}</td> --}}
                    <td>{{ $application->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#applicationDetailsModal-{{ $application->id }}">
                            View
                        </button>

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="applicationDetailsModal-{{ $application->id }}" tabindex="-1"
                     aria-labelledby="applicationDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applicationDetailsModalLabel">Application Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <p>{{ $application->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type:</label>
                                    <p>{{ ucfirst($application->type) }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="id_number" class="form-label">ID Number:</label>
                                    <p>{{ $application->id_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="company_reg" class="form-label">Company Registration:</label>
                                    <p>{{ $application->company_reg ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account Number:</label>
                                    <p>{{ $application->account_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="address_individual" class="form-label">Address:</label>
                                    <p>{{ $application->address() }}</p>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number:</label>
                                    <p>{{ $application->phone_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number_2" class="form-label">Phone Number 2:</label>
                                    <p>{{ $application->phone_number_2 }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <p>{{ $application->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="proposed_capacity" class="form-label">Proposed Capacity:</label>
                                    <p>{{ $application->proposed_capacity ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="existing_capacity" class="form-label">Existing Capacity:</label>
                                    <p>{{ $application->existing_capacity ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_model" class="form-label">Generation Licence:</label>
                                    <p>{{ $application->generation_licence }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_make" class="form-label">Inverter Make:</label>
                                    <p>{{ $application->inverter_make }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_model" class="form-label">Inverter Model:</label>
                                    <p>{{ $application->inverter_model }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="isolation_protection" class="form-label">Isolation Protection:</label>
                                    <p>{{ $application->isolation_protection ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="generation_meter_installed" class="form-label">Generation Meter
                                        Installed:</label>
                                    <p>{{ $application->generation_meter_installed ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <p>{{ $application->status ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if($application->meter_image || $application->meter_box_image || $application->inverter_image)
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#viewImagesModal-{{ $application->id }}">
                                        View Images
                                    </button>
                                @endif
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Images Modal -->
                <div class="modal fade" id="viewImagesModal-{{ $application->id }}" tabindex="-1"
                     aria-labelledby="viewImagesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewImagesModalLabel">Application Images</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span>Meter</span>
                                <br>
                                @if($application->meter_image)
                                    <img style="width: 100%" src="{{ asset('storage/' . $application->meter_image) }}"
                                         class="img-fluid mb-3" alt="Meter Image">
                                @endif
                                <br>
                                <span>Meter Box</span>
                                <br>
                                @if($application->meter_box_image)
                                    <img style="width: 100%"
                                         src="{{ asset('storage/' . $application->meter_box_image) }}"
                                         class="img-fluid mb-3" alt="Meter Box Image">
                                @endif
                                <br>
                                <span>Inverter</span>
                                <br>
                                @if($application->inverter_image)
                                    <img style="width: 100%" src="{{ asset('storage/'.$application->inverter_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif
                                <br>
                                <span>Identification Card</span>
                                <br>
                                @if($application->id_image)
                                    <img style="width: 100%" src="{{ asset('storage/'.$application->id_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif
                                <br>
                                <span>Proof of residence</span>
                                <br>
                                @if($application->inverter_image)
                                    <img style="width: 100%"
                                         src="{{ asset('storage/'.$application->proof_of_residence_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
        @if($state == 'completed')
            @foreach($applications as $application)
                @if($application->passed())

                <tr>
                    <td>{{ $application->name }}</td>
                    <td>{{ ucfirst($application->type) }}</td> <!-- Capitalize 'individual' or 'company' -->
                    <td>{{ $application->id_number }}</td>
                    <td>{{ $application->company_reg ?? 'N/A' }}</td> <!-- Handle nullable field -->
                    <td>{{ $application->account_number }}</td>
                    <td>{{ $application->address()}}</td>
                    <td>{{ $application->phone_number }}</td>
                    <td>{{ $application->phone_number_2 }}</td>
                    {{-- <td>{{ $application->email }}</td> --}}
                    {{-- <td>{{ $application->proposed_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                    {{-- <td>{{ $application->existing_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                    {{-- <td>{{ $application->inverter_make }}</td> --}}
                    {{-- <td>{{ $application->inverter_model }}</td> --}}
                    {{-- <td>{{ $application->isolation_protection ? 'Yes' : 'No' }}</td> --}}
                    {{-- <td>{{ $application->generation_meter_installed ? 'Yes' : 'No' }}</td> --}}
                    <td>{{ $application->status ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#applicationDetailsModal-{{ $application->id }}">
                            View
                        </button>

                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="applicationDetailsModal-{{ $application->id }}" tabindex="-1"
                     aria-labelledby="applicationDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applicationDetailsModalLabel">Application Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name:</label>
                                    <p>{{ $application->name }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type:</label>
                                    <p>{{ ucfirst($application->type) }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="id_number" class="form-label">ID Number:</label>
                                    <p>{{ $application->id_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="company_reg" class="form-label">Company Registration:</label>
                                    <p>{{ $application->company_reg ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account Number:</label>
                                    <p>{{ $application->account_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="address_individual" class="form-label">Address:</label>
                                    <p>{{ $application->address() }}</p>
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Phone Number:</label>
                                    <p>{{ $application->phone_number }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number_2" class="form-label">Phone Number 2:</label>
                                    <p>{{ $application->phone_number_2 }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <p>{{ $application->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="proposed_capacity" class="form-label">Proposed Capacity:</label>
                                    <p>{{ $application->proposed_capacity ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="existing_capacity" class="form-label">Existing Capacity:</label>
                                    <p>{{ $application->existing_capacity ?? 'N/A' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_model" class="form-label">Generation Licence:</label>
                                    <p>{{ $application->generation_licence }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_make" class="form-label">Inverter Make:</label>
                                    <p>{{ $application->inverter_make }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="inverter_model" class="form-label">Inverter Model:</label>
                                    <p>{{ $application->inverter_model }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="isolation_protection" class="form-label">Isolation Protection:</label>
                                    <p>{{ $application->isolation_protection ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="generation_meter_installed" class="form-label">Generation Meter
                                        Installed:</label>
                                    <p>{{ $application->generation_meter_installed ? 'Yes' : 'No' }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status:</label>
                                    <p>{{ $application->status ? 'Active' : 'Inactive' }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if($application->meter_image || $application->meter_box_image || $application->inverter_image)
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#viewImagesModal-{{ $application->id }}">
                                        View Images
                                    </button>
                                @endif
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View Images Modal -->
                <div class="modal fade" id="viewImagesModal-{{ $application->id }}" tabindex="-1"
                     aria-labelledby="viewImagesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewImagesModalLabel">Application Images</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <span>Meter</span>
                                <br>
                                @if($application->meter_image)
                                    <img style="width: 100%" src="{{ asset('storage/' . $application->meter_image) }}"
                                         class="img-fluid mb-3" alt="Meter Image">
                                @endif
                                <br>
                                <span>Meter Box</span>
                                <br>
                                @if($application->meter_box_image)
                                    <img style="width: 100%"
                                         src="{{ asset('storage/' . $application->meter_box_image) }}"
                                         class="img-fluid mb-3" alt="Meter Box Image">
                                @endif
                                <br>
                                <span>Inverter</span>
                                <br>
                                @if($application->inverter_image)
                                    <img style="width: 100%" src="{{ asset('storage/'.$application->inverter_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif
                                <br>
                                <span>Identification Card</span>
                                <br>
                                @if($application->id_image)
                                    <img style="width: 100%" src="{{ asset('storage/'.$application->id_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif
                                <br>
                                <span>Proof of residence</span>
                                <br>
                                @if($application->inverter_image)
                                    <img style="width: 100%"
                                         src="{{ asset('storage/'.$application->proof_of_residence_image) }}"
                                         class="img-fluid" alt="Inverter Image">
                                @endif


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
        </tbody>
    </table>
</div>
