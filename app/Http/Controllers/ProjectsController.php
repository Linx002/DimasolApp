<?php

namespace App\Http\Controllers;

use App\Projects;
use App\DataEntries;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class ProjectsController extends Controller
{
//Index
    public function Index(){
        $projects = DB::table('projects')->get();
        $projects = DB::table('projects')->Paginate(5);
        return view('projects.indexprojects', ['projects' => $projects]);
    }
//Create project - ver form
    public function Create(){
        return view ('projects.createprojects');
    }
//Create project - guardar form
    public function Store(Request $request){
        $validator = Validator::make($request->all(), [
            'projectName' => 'required|max:191',
            'projectDescription' => 'required|max:191',
            'company'=> 'required|max:191',
            'area' => 'required|max:191',
            'requisitedBy' => 'required|max:191',
            'startDate' => 'date',
            'endDate' => 'date',
        ]);

        if ($validator->fails()) {
                    return redirect('projects/create')
                                ->withErrors($validator)
                                ->withInput();
                }

            $project = New projects;

            $project -> projectName= $request->input('projectName');
            $project -> projectDescription = $request->input('projectDescription');
            $project -> company = $request->input('company');
            $project -> area = $request->input('area');
            $project -> requisitedBy = $request->input('requisitedBy');
            $project -> startDate = $request->input('startDate');
            $project -> endDate = $request->input('endDate');
            $project -> consumables = $request->boolean('consumables');

            $project->save();
        return redirect('/projects')->with('msg', 'Proyecto agregado correctamente');
    }
//Read project - ver form
    public function Details($id){
        $projects = DB::table('projects')->find($id);
        $projects = Projects::with('dataEntries')->find($id);
        return view ('projects.projectdetails')->with('projects',$projects);
    }
//Edit project - ver form
    public function Edit($id){
        $projects = DB::table('projects')->find($id);
        return view('projects.editproject', ['projects' => $projects]);
    }
//Edit project - guardar form
    public function Update(Request $request){
        $validator = Validator::make($request->all(), [
            'projectName' => 'required|max:191',
            'projectDescription' => 'required|max:191',
            'company'=> 'required|max:191',
            'area' => 'required|max:191',
            'requisitedBy' => 'required|max:191',
            'startDate' => 'date',
            'endDate' => 'date',
        ]);

        if ($validator->fails()) {
                    return redirect('projects/edit')
                                ->withErrors($validator)
                                ->withInput();
                }
        $id = $request->input('id');
        $projectName= $request->input('projectName');
        $projectDescription = $request->input('projectDescription');
        $company = $request->input('company');
        $area = $request->input('area');
        $requisitedBy = $request->input('requisitedBy');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $consumables = $request->boolean('consumables');
        if(DB::table('projects')->where('id', $id)->exists() == true){
           DB::table('projects')->where('id',$id)->update([
            'projectName' => $projectName,
            'projectDescription' =>$projectDescription,
            'company'=>$company,
            'area'=>$area,
            'requisitedBy'=>$requisitedBy,
            'startDate' =>$startDate,
            'endDate'=>$endDate,
            'consumables'=>$consumables]);
        }
    return redirect('/projects')->with('msg', 'Proyecto editado correctamente');
    }
//Delete project - mostrar form
    public function Delete($id){
        $projects = DB::table('projects')->find($id);
        return view('projects.deleteproject', ['projects' => $projects]);
    }
//Delete project - eliminar form
    public function Remove(Request $request){
        $id = $request->input('id');
        if(DB::table('projects')->where('id', $id)->exists() == true){
            DB::table('projects')->where('id',$id)->delete();}
        return redirect('/projects')->with('msg', 'Proyecto eliminado correctamente');
    }
//Create Entry - mostrar form
    public function createEntry($id){
        $projects = DB::table('projects')->find($id);
        $projects = Projects::with('dataEntries')->find($id);
        return view ('dataEntry.createEntry', ['projects' => $projects]);
    }
//Create Entry - guardar form
    public function storeDataEntry(Request $request){
        $validator = Validator::make($request->all(), [
            'entryType' => 'required|max:191',
            'entryDescription' => 'required',
            'entryStartDate' => 'date',
            'entryEndDate' => 'date',
        ]);

        if ($validator->fails()) {
                    return redirect('/dataentry/create/{id}')
                                ->withErrors($validator)
                                ->withInput();
                }
    if($request->hasFile('entryFile')){
    $fileNameWithExt = $request->file('entryFile')->getClientOriginalName();
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('entryFile')->getClientOriginalExtension();
    $finalFileName = $fileName.'_'.time().'.'.$extension;

    $path = $request->file('entryFile')->storeAs('public/entriesData/'
                                                  .$request->input('id').'/'
                                                  .$request->input('entryType'),$finalFileName);
    }
    else{ $finalFileName = "No_file_uploaded"; }
    $sortPos = $request->input('entryType');
    if($sortPos == "CompraMat"){ $sortVar = "0"; }
    else if($sortPos == "Protos"){ $sortVar = "1"; }
    else if($sortPos == "Avance25"){ $sortVar = "2"; }
    else if($sortPos == "Avance50"){ $sortVar = "3"; }
    else if($sortPos == "Avance75"){ $sortVar = "4"; }
    else if($sortPos == "Final"){ $sortVar = "5"; }
    $dataEntry = New DataEntries;
    $dataEntry -> projects_Id= $request->input('id');
    $dataEntry -> entryType = $request->input('entryType');
    $dataEntry -> entryDescription = $request->input('entryDescription');
    $dataEntry -> entryFile = $finalFileName;
    $dataEntry -> entryStartDate = $request->input('entryStartDate');
    $dataEntry -> entryEndDate = $request->input('entryEndDate');
    $dataEntry -> sortPos = $sortVar;
    $dataEntry->save();
    return redirect('/projects/'.$request->input('id'))->with('msg', 'Actividad agregada correctamente');
    }
//Edit Entry - ver form
    public function editEntry($id){
        $entry = DB::table('data_entries')->find($id);
        return view ('dataEntry.editEntry', ['entry' => $entry]);
    }
//Edit Entry - guardar form
    public function updateEntry(Request $request){
        $validator = Validator::make($request->all(), [
            'entryType' => 'required|max:191',
            'entryDescription' => 'required',
            'entryStartDate' => 'date',
            'entryEndDate' => 'date',
        ]);

        if ($validator->fails()) {
                    return redirect('/dataentry/create/{id}')
                                ->withErrors($validator)
                                ->withInput();
                }

    if($request->hasFile('entryFile')){
    $fileNameWithExt = $request->file('entryFile')->getClientOriginalName();
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('entryFile')->getClientOriginalExtension();
    $finalFileName = $fileName.'_'.time().'.'.$extension;

    $path = $request->file('entryFile')->storeAs('public/entriesData/'
                                                  .$request->input('projects_id').'/'
                                                  .$request->input('entryType'),$finalFileName);
    }
    else{
        $finalFileName = "No_file_uploaded";
    }

    $sortPos = $request->input('entryType');
    if($sortPos == "CompraMat"){
        $sortVar = "0";
    }
    else if($sortPos == "Protos"){
        $sortVar = "1";
    }
    else if($sortPos == "Avance25"){
        $sortVar = "2";
    }
    else if($sortPos == "Avance50"){
        $sortVar = "3";
    }
    else if($sortPos == "Avance75"){
        $sortVar = "4";
    }
    else if($sortPos == "Final"){
        $sortVar = "5";
    }

    $id= $request->input('id');
    $entryType = $request->input('entryType');
    $entryDescription = $request->input('entryDescription');
    $entryFile=$finalFileName;
    $entryStartDate = $request->input('entryStartDate');
    $entryEndDate = $request->input('entryEndDate');
    $sortPos = $sortVar;

    if(DB::table('data_entries')->where('id', $id)->exists() == true){
        DB::table('data_entries')->where('id',$id)->update([
        'entryDescription' =>$entryDescription,
        'entryType'=>$entryType,
        'entryFile'=>$entryFile,
        'entryStartDate'=>$entryStartDate,
        'entryEndDate'=>$entryEndDate,
        'sortPos' => $sortVar
        ]);
    }
    return redirect('/projects/'.$request->input('projects_Id'))->with('msg', 'Actividad editada correctamente');
    }
//Delete Entry - ver form
    public function deleteEntry($id){
        $entry = DB::table('data_entries')->find($id);
        return view ('dataEntry.deleteEntry', ['entry' => $entry]);
    }
//Delete Entry - eliminar form
    public function removeEntry(Request $request){
        $id = $request->input('id');
        if(DB::table('data_entries')->where('id', $id)->exists() == true){
            DB::table('data_entries')->where('id',$id)->delete();}
        return redirect('/projects/'.$request->input('projects_Id'))->with('msg', 'Actividad eliminada correctamente');
    }

}
