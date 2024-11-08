<?php

namespace App\Livewire\Registration2;

use App\Models\registration\ApplicationStage2;
use Livewire\Component;

class ApplicationStageTable extends Component{
    public $search = '';
    public $stage;
    public function mount($stage = null){
        $this->stage = $stage; // Initialize the property
    }
    public function render(){
        $applications = ApplicationStage2::where('stage_id', $this->stage->id)->whereIn('state', ['pending', 'failed'])->whereHas('application', function($query) {
        $query->search($this->search);
    })->orderBy('created_at', 'desc')->paginate(100);
        return view('livewire.registration.application-stage-table', compact('applications'));
    }
}
