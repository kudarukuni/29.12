<div>
    <div class="row">
        <div class="col-md-4">
            <h4>{{$applications->count() == 1 ? '1 Application' : $applications->count().' Applications'}}</h4>
        </div>
        <div class="col-md-4">
            <a onclick="printTable()" class="btn btn-primary">Print</a>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-4">
            <select class="form-control" wire:model.live="state">
                <option value="all">All</option>
                <option value="pending">Pending </option>
                <option value="failed">Failed </option>
                <option value="passed">Passed </option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" wire:model.live="sortColumn">
                <option value="created_at">Date</option>
                <option value="name">Name</option>
                <option value="type">Type</option>
                <option value="id_number">ID Number</option>
                <option value="proposed_capacity">Proposed Capacity</option>
                <option value="existing_capacity">Existing Capacity</option>
                <option value="inverter_make">Inverter Make</option>
                <option value="inverter_model">Inverter Model</option>
                <option value="isolation_protection">Isolation Protection</option>
                <option value="generation_meter_installed">Generation Meter Installed</option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" wire:model.live="sortOrder">
                <option value="asc">ASCENDING</option>
                <option value="desc">DESCENDING</option>
            </select>
        </div>
    </div>
    <div class="row mb-2" wire:ignore>
        <div class="col-md-4">
            <select id="towns" name="selectedTowns[]" class="form-control" wire:model.live="selectedTowns" multiple>
                @foreach($towns as $town)
                    <option value="{{ $town->municipality_code }}">{{ $town->municipality_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select id="suburbs" name="selectedSuburbs[]" class="form-control" wire:model.live="selectedSuburbs" multiple>
                @foreach($suburbs as $suburb)
                    <option value="{{ $suburb->locality_code }}">{{ $suburb->locality_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" wire:model.live="results">
                <option value="1">1</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="250">250</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
                <option value="5000">5000</option>
                <option value="10000">10000</option>
                <option value="0">Selected Number of Rows</option>
            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-4">
            <span>
                Search Keyword: <input wire:model.live="search" class="form-control" type="text" placeholder="search">
            </span>
        </div>
        <div class="col-md-4">
            <span>
                Start Date: <input type="date" class="form-control" wire:model.live="startDate">
            </span>
        </div>
        <div class="col-md-4">
            <span>
                End Date: <input type="date" class="form-control" wire:model.live="endDate">
            </span>
        </div>

    </div>

    <div class="table-responsive" id="printArea">
        <table class="table table-striped table-bordered" style="">
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
                <th>Email</th>
                <th>Proposed Capacity</th>
                <th>Existing Capacity</th>
                <th>Inverter Make</th>
                <th>Inverter Model</th>
                <th>Isolation Protection</th>
                <th>Generation Meter Installed</th>
                <th>Date</th>
{{--                <th>Status</th>--}}
{{--                <th>Actions</th>--}}
            </tr>
            </thead>
            <tbody>

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
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->proposed_capacity ?? 'N/A' }}</td> <!-- Handle nullable field -->
                        <td>{{ $application->existing_capacity ?? 'N/A' }}</td> <!-- Handle nullable field -->
                        <td>{{ $application->inverter_make }}</td>
                        <td>{{ $application->inverter_model }}</td>
                        <td>{{ $application->isolation_protection ? 'Yes' : 'No' }}</td>
                        <td>{{ $application->generation_meter_installed ? 'Yes' : 'No' }}</td>
                        <td>{{ $application->created_at->format('d-M-Y') }}</td>
{{--                        <td>{{ $application->status ? 'Active' : 'Inactive' }}</td>--}}
{{--                        <td>--}}
{{--                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#applicationDetailsModal-{{ $application->id }}">--}}
{{--                                View--}}
{{--                            </button>--}}

{{--                        </td>--}}
                    </tr>


                @endforeach



            </tbody>

        </table>
    </div>
    <script>
        function printTable() {
            let printContents = document.getElementById('printArea').innerHTML;
            let printWindow = window.open('', '', 'height=400,width=600');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }

        $(document).ready(function() {
            new TomSelect("#towns", {
                placeholder: "Select Towns...",
                maxItems: 3
            });
            new TomSelect("#suburbs", {
                placeholder: "Select Suburbs..."
            });
        });
    </script>
</div>
