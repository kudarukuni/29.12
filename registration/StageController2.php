<?php

namespace App\Http\Controllers\registration;

use App\Http\Controllers\Controller;
use App\Models\registration\ApplicationStage2;
use App\Models\settings\Stage2;
use Illuminate\Http\Request;

class StageController2 extends Controller{
    public function index(){
        $stages = Stage2::where('status', 1)->orderBy('order', 'asc')->get();
        return view('registration2.stage.index', compact('stages'));
    }
    public function view(Stage2 $stage){
        return view('registration2.stage.view', compact('stage'));
    }
    public function showCompleted(){
        return view('registration2.applications.completed');
    }
    public function makeDecision(Request $request){
        try {
            $validated = $request->validate([
                'id' => 'required',
                'state'=>'required|in:pending,failed,passed',
                'note'=>'nullable',
            ]);
            $applicationStage = ApplicationStage2::find($validated['id']);
            $applicationStage->state = $validated['state'];
            $applicationStage->note = $validated['note'];
            $applicationStage->save();
            if($applicationStage->state == 'passed'){
                $stage = $this->getNextStage($applicationStage);
                if($stage){
                    ApplicationStage2::create([
                        'application_id' => $applicationStage->application_id,
                        'stage_id' => $stage->id,
                        'user_id' => auth()->user()->id,
                    ]);
                }
                else{
                    return back()->with('success', 'Final stage has been approved');
                }
            }
            return back()->with('success', 'Decision has been made successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getNextStage($applicationStage){
        return Stage2::where('order', '>', $applicationStage->stage->order)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->first();
    }
}
