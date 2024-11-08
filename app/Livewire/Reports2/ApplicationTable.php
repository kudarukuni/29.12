<?php

namespace App\Livewire\Reports2;

use App\Models\registration\Application2;
use App\Models\settings\Suburb;
use App\Models\settings\Town;
use Carbon\Carbon;
use Livewire\Component;

class ApplicationTable extends Component{
    public $search = '';
    public $state = '';
    public $results = 10;
    public $selectedTowns = [];
    public $selectedSuburbs = [];
    public $sortOrder = 'desc';
    public $sortColumn = 'created_at';
    public $towns = [];
    public $suburbs = [];
    public $stateCount = [];
    public $startDate = '';
    public $endDate = '';

    public function mount(){
        $this->stateCount['passed'] = 0;
        $this->stateCount['pending'] = 0;
        $this->stateCount['failed'] = 0;
        $this->towns = Town::orderBy('municipality_name', 'asc')->get();
        $this->suburbs = Suburb::orderBy('locality_name', 'asc')->get();
    }

    public function render(){
        $query = Application2::search($this->search);
        if ($this->state === 'passed') {
            $this->stateCount['passed'] = $query->returnPassed()->count();
            $query = $query->returnPassed();
        } elseif ($this->state === 'pending') {
            $this->stateCount['pending'] = $query->returnPending()->count();
            $query = $query->returnPending();
        } elseif ($this->state === 'failed') {
            $this->stateCount['failed'] = $query->returnFailed()->count();
            $query = $query->returnFailed();
        }
        if ($this->startDate) {
            $query->where('created_at', '>=', Carbon::parse($this->startDate)->startOfDay());
        }
        if ($this->endDate) {
            $query->where('created_at', '<=', Carbon::parse($this->endDate)->endOfDay());
        }
        if (!empty($this->selectedTowns) || !empty($this->selectedSuburbs)) {
            $query->where(function ($query) {
                if (!empty($this->selectedTowns)) {
                    $query->whereIn('municipality_code', $this->selectedTowns);
                }

                if (!empty($this->selectedSuburbs)) {
                    $query->orWhereIn('locality_code', $this->selectedSuburbs);
                }
            });
        }
        $applications = $query
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->paginate($this->results);
        return view('livewire.reports2.application-table', compact('applications'));
    }
}
