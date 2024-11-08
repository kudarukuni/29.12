<?php

namespace App\Http\Controllers\registration;

use App\Http\Controllers\Controller;
use App\Models\registration\Application;
use App\Models\registration\ApplicationStage;
use App\Models\settings\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function index(){
        return view('registration.applications.index');
    }
    public function indexAPI(){
        $applications = Application::all();
        return response()->json($applications);
    }
    public function storeAPI(Request $request){
        try {
            $stage = Stage::where('status', 1)->orderBy('order', 'asc')->first();
            if ($stage) {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'type' => 'required|in:individual,company',
                    'id_number' => 'required|string|max:255',
                    'company_reg' => 'nullable|string|max:255',
                    'stand_no' => 'required|string|max:255',
                    'account_number' => 'required|string|max:255',
                    'longitude' => 'required|string|max:255',
                    'latitude' => 'required|string|max:255',
                    'phone_number' => 'required|string|max:255',
                    'phone_number_2' => 'nullable|string|max:255',
                    'email' => 'required|email|max:255',
                    'proposed_capacity' => 'nullable|numeric|max:255',
                    'existing_capacity' => 'nullable|numeric|max:255',
                    'inverter_make' => 'required|string|max:255',
                    'inverter_model' => 'required|string|max:255',
                    'generation_licence' => 'nullable|string|max:255',
                    'isolation_protection' => 'required',
                    'generation_meter_installed' => 'required',
                    'meter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
                    'meter_box_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
                    'inverter_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
                    'id_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
                    'proof_of_residence_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
                    'municipality_code' => 'required|integer',
                    'locality_code' => 'required|integer',
                    'street_code' => 'required|integer',
                ]);
                $validated['isolation_protection'] = $validated['isolation_protection'] == 'true' ? 1 : 0;
                $validated['generation_meter_installed'] = $validated['generation_meter_installed'] == 'true' ? 1 : 0;
                $meterImagePath = null;
                if ($request->hasFile('meter_image')) {
                    $meterImagePath = $request->file('meter_image')->storeAs('public/application_images', uniqid() . '.' . $request->file('meter_image')->getClientOriginalExtension());
                }
                $meterBoxImagePath = null;
                if ($request->hasFile('meter_box_image')) {
                    $meterBoxImagePath = $request->file('meter_box_image')->storeAs('public/application_images', uniqid() . '.' . $request->file('meter_box_image')->getClientOriginalExtension());
                }
                $inverterImagePath = null;
                if ($request->hasFile('inverter_image')) {
                    $inverterImagePath = $request->file('inverter_image')->storeAs('public/application_images', uniqid() . '.' . $request->file('inverter_image')->getClientOriginalExtension());
                }
                $idImagePath = null;
                if ($request->hasFile('id_image')) {
                    $idImagePath = $request->file('id_image')->storeAs('public/application_images', uniqid() . '.' . $request->file('id_image')->getClientOriginalExtension());
                }
                $proofOfResidenceImagePath = null;
                if ($request->hasFile('proof_of_residence_image')) {
                    $proofOfResidenceImagePath = $request->file('proof_of_residence_image')->storeAs('public/application_images', uniqid() . '.' . $request->file('proof_of_residence_image')->getClientOriginalExtension());
                }
                $application = Application::create(array_merge($validated, [
                    'meter_image' => str_replace('public/', '', $meterImagePath),
                    'meter_box_image' => str_replace('public/', '', $meterBoxImagePath),
                    'inverter_image' => str_replace('public/', '', $inverterImagePath),
                    'id_image' => str_replace('public/', '', $idImagePath),
                    'proof_of_residence_image' => str_replace('public/', '', $proofOfResidenceImagePath),
                ]));
                ApplicationStage::create([
                    'application_id' => $application->id,
                    'stage_id' => $stage->id,
                    'note' => null,
                ]);
                return response()->json($application, 201);
            } else {
                return response()->json(['message' => 'No stage found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function getStageAPI(Request $request){
        try {
            $request->validate([
                'reference' => 'required|string'
            ]);
            $application = Application::where('reference', $request->reference)->first();
            if($application) {
                $aplicationStage = ApplicationStage::where('application_id', $application->id)
                    ->with(['Application', 'Stage'])
                    ->latest()
                    ->first();
                return response()->json($aplicationStage, 200);
            }
            else{
                return response()->json(['message' => 'Application not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
