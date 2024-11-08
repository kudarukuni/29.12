<?php

namespace App\Livewire\Registration2;

use App\Models\registration\Application2;
use Livewire\Component;

class ApplicationTable extends Component{
    public $search = '';
    public $state = '';
    public function render(){
        $applications = Application2::search($this->search)->orderBy('created_at', 'desc')->paginate(100);
        return view('livewire.registration.application-table', compact('applications'));
    }
}
