@extends('layouts.app')

@section('content')
    <div class="card m-2 p-2">
        <div class="row m-3">
            <h3>{{$stage->name}}</h3>
        </div>


        <livewire:registration.application-stage-table :stage="$stage"/>

    </div>

    <div class="modal fade" id="addDecisionModal" tabindex="-1" aria-labelledby="addRiskFactorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="decisionLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRiskFactorForm"
                          action="{{route('registration.stage.decision')}}"
                          method="POST"
                    >
                        @csrf
                        <input type="hidden" name="state" id="state">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addDecision(id, state) {
            document.getElementById('state').value = state;
            document.getElementById('id').value = id;
            document.getElementById('decisionLabel').innerHTML = 'Mark as ' + state;
        }
    </script>




@endsection
