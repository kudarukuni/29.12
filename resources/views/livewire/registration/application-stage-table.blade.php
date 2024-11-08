<div>
    <input wire:model.live="search" class="form-control" type="text" placeholder="search">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Reference</th>
            <th>Name</th>
            <th>Type</th>
            <th>ID Number</th>
            <th>Company Registration</th>
            <th>Account Number</th>
            {{--<th>Address (Individual)</th>--}}
            {{--<th>Address (Company)</th>--}}
            {{--<th>Phone Number</th>--}}
            {{--<th>Phone Number 2</th>--}}
            {{--<th>Email</th>--}}
            {{-- <th>Proposed Capacity</th>--}}
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
        @foreach($applications as $application)

            <tr>
                <td>{{ $application->application->reference }}</td>
                <td>{{ $application->application->name }}</td>
                <td>{{ ucfirst($application->application->type) }}</td> <!-- Capitalize 'individual' or 'company' -->
                <td>{{ $application->application->id_number }}</td>
                <td>{{ $application->application->company_reg ?? 'N/A' }}</td> <!-- Handle nullable field -->
                <td>{{ $application->application->account_number }}</td>
                {{--                <td>{{ $application->application->address_individual }}</td>--}}
                {{--                <td>{{ $application->application->address_company ?? 'N/A' }}</td> <!-- Handle nullable field -->--}}
                {{--                <td>{{ $application->application->phone_number }}</td>--}}
                {{--                <td>{{ $application->application->phone_number_2 }}</td>--}}
                {{-- <td>{{ $application->application->email }}</td> --}}
                {{-- <td>{{ $application->application->proposed_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                {{-- <td>{{ $application->application->existing_capacity ?? 'N/A' }}</td> <!-- Handle nullable field --> --}}
                {{-- <td>{{ $application->application->inverter_make }}</td> --}}
                {{-- <td>{{ $application->application->inverter_model }}</td> --}}
                {{-- <td>{{ $application->application->isolation_protection ? 'Yes' : 'No' }}</td> --}}
                {{-- <td>{{ $application->application->generation_meter_installed ? 'Yes' : 'No' }}</td> --}}
                <td>{{ $application->application->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#applicationDetailsModal-{{ $application->application->id }}">
                        Details
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#viewStagesModal-{{ $application->application->id }}">
                        View Stages
                    </button>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addDecisionModal"
                            onclick="addDecision('{{ $application->id }}', 'passed')">
                        Approve
                    </button>

                    @if( $application->state != 'failed')
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#addDecisionModal"
                                onclick="addDecision('{{ $application->id }}', 'failed')">
                            Deny
                        </button>
                    @endif
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="applicationDetailsModal-{{ $application->application->id }}" tabindex="-1"
                 aria-labelledby="applicationDetailsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="applicationDetailsModalLabel">Application Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <p>{{ $application->application->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type:</label>
                                <p>{{ ucfirst($application->application->type) }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="id_number" class="form-label">ID Number:</label>
                                <p>{{ $application->application->id_number }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="company_reg" class="form-label">Company Registration:</label>
                                <p>{{ $application->application->company_reg ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="account_number" class="form-label">Account Number:</label>
                                <p>{{ $application->application->account_number }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="address_individual" class="form-label">Address:</label>
                                <p>{{ $application->application->address() }}</p>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                <p>{{ $application->application->phone_number }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number_2" class="form-label">Phone Number 2:</label>
                                <p>{{ $application->application->phone_number_2 }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <p>{{ $application->application->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="proposed_capacity" class="form-label">Proposed Capacity:</label>
                                <p>{{ $application->application->proposed_capacity ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="existing_capacity" class="form-label">Existing Capacity:</label>
                                <p>{{ $application->application->existing_capacity ?? 'N/A' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="inverter_make" class="form-label">Inverter Make:</label>
                                <p>{{ $application->application->inverter_make }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="inverter_model" class="form-label">Inverter Model:</label>
                                <p>{{ $application->application->inverter_model }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="isolation_protection" class="form-label">Isolation Protection:</label>
                                <p>{{ $application->application->isolation_protection ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="generation_meter_installed" class="form-label">Generation Meter
                                    Installed:</label>
                                <p>{{ $application->application->generation_meter_installed ? 'Yes' : 'No' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <p>{{ $application->application->status ? 'Active' : 'Inactive' }}</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if($application->application->meter_image || $application->application->meter_box_image || $application->application->inverter_image)
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewImagesModal-{{ $application->id }}">
                                    View Images
                                </button>
                            @endif
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="viewImagesModal-{{ $application->id }}" tabindex="-1" aria-labelledby="viewImagesModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewImagesModalLabel">Application Images</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Meter
                            <br>
                            @if($application->application->meter_image)
                                <img style="width: 100%" src="{{ asset('storage/' . $application->application->meter_image) }}" class="img-fluid mb-3" alt="Meter Image">
                            @endif
                            <br>
                            Meter Box
                            <br>
                            @if($application->application->meter_box_image)
                                <img style="width: 100%" src="{{ asset('storage/' . $application->application->meter_box_image) }}" class="img-fluid mb-3" alt="Meter Box Image">
                            @endif
                            <br>
                            Inverter
                            <br>
                            @if($application->application->inverter_image)
                                <img style="width: 100%" src="{{ asset('storage/'.$application->application->inverter_image) }}" class="img-fluid" alt="Inverter Image">
                            @endif
                            <br>
                            <span>Identification Card</span>
                            <br>
                            @if($application->application->id_image)
                                <img style="width: 100%" src="{{ asset('storage/'.$application->application->id_image) }}"
                                     class="img-fluid" alt="Inverter Image">
                            @endif
                            <br>
                            <span>Proof of residence</span>
                            <br>
                            @if($application->application->inverter_image)
                                <img style="width: 100%"
                                     src="{{ asset('storage/'.$application->application->proof_of_residence_image) }}"
                                     class="img-fluid" alt="Inverter Image">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="viewStagesModal-{{ $application->application->id }}" tabindex="-1" aria-labelledby="addRiskFactorModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRiskFactorModalLabel">View Stages</h5>

                        </div>
                        <div class="modal-body">
                               @foreach($application->application->stages as $stage)
                                   <div class="row mb-3">
                                       <div class="col-3">{{$stage->stage->name}}</div>
                                       <div class="col-3">{{$stage->state}}</div>
                                       <div class="col-3">{{$stage->note}}</div>
                                       <div class="col-3">{{$stage->updated_at}}</div>
                                   </div>
                               @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>


</div>
