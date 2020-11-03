<?php

namespace App\Http\Controllers;

use App\Projects;
use App\DataEntries;
use DB;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function Index(){
        $projects = DB::table('projects')->get();
        $projects = DB::table('projects')->Paginate(5);
        return view('projects.indexprojects', ['projects' => $projects]);
    }

    public function Create(){
        return view ('projects.createprojects');
    }

    public function Store(Request $request){
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

    public function Details($id){
        $projects = DB::table('projects')->find($id);
        $projects = Projects::with('dataEntries')->find($id);
        return view ('projects.projectdetails')->with('projects',$projects);
    }

    public function Edit($id){
        $projects = DB::table('projects')->find($id);
        return view('projects.editproject', ['projects' => $projects]);
    }

    public function Update(Request $request){
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

    public function Delete($id){
        $projects = DB::table('projects')->find($id);
        return view('projects.deleteproject', ['projects' => $projects]);
    }

    public function Remove(Request $request){
        $id = $request->input('id');
        if(DB::table('projects')->where('id', $id)->exists() == true){
            DB::table('projects')->where('id',$id)->delete();}
        return redirect('/projects')->with('msg', 'Proyecto eliminado correctamente');
    }

    public function createEntry($id){
        $projects = DB::table('projects')->find($id);
        $projects = Projects::with('dataEntries')->find($id);
        return view ('dataEntry.createEntry', ['projects' => $projects]);
    }

    public function storeDataEntry(Request $request){
    if($request->hasFile('entryFile')){
    $fileNameWithExt = $request->file('entryFile')->getClientOriginalName();
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('entryFile')->getClientOriginalExtension();
    $finalFileName = $fileName.'_'.time().'.'.$extension;

    }
    if(!$request->hasFile('entryFile')){
        $finalFileName = "No file uploaded";
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
    else if($sortrPos == "Avance75"){
        $sortVar = "4";
    }
    else if($sortPos == "Final"){
        $sortVar = "5";
    }

    $dataEntry = New DataEntries;

    $dataEntry -> projects_Id= $request->input('id');
    $dataEntry -> entryType = $request->input('entryType');
    $dataEntry -> entryDescription = $request->input('entryDescription');
    $dataEntry -> entryFile = $finalFileName;
    $dataEntry -> entryStartDate = $request->input('entryStartDate');
    $dataEntry -> entryEndDate = $request->input('entryEndDate');
    $dataEntry -> sortPos = $sortVar;

    $dataEntry->save();
    return redirect('/projects')->with('msg', 'Actividad agregada correctamente');
    }

    public function editEntry($id){
        $entry = DB::table('data_entries')->find($id);
        return view ('dataEntry.editEntry', ['entry' => $entry]);
    }

    public function updateEntry(Request $request){
    if($request->hasFile('entryFile')){
    $fileNameWithExt = $request->file('entryFile')->getClientOriginalName();
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    $extension = $request->file('entryFile')->getClientOriginalExtension();
    $finalFileName = $fileName.'_'.time().'.'.$extension;

    }
    if(!$request->hasFile('entryFile')){
        $finalFileName = "No file uploaded";
    }

    $id = $request->input('id');
    $projects_Id= $request->input('id');
    $entryType = $request->input('entryType');
    $entryDescription = $request->input('entryDescription');
    $entryFile=$finalFileName;
    $entryStartDate = $request->input('entryStartDate');
    $entryEndDate = $request->input('entryEndDate');

    if(DB::table('data_entries')->where('id', $id)->exists() == true){
        DB::table('data_entries')->where('id',$id)->update([
        'projects_Id' => $projects_Id,
        'entryDescription' =>$entryDescription,
        'entryType'=>$entryType,
        'entryFile'=>$entryFile,
        'entryStartDate'=>$entryStartDate,
        'entryEndDate'=>$entryEndDate,
        ]);
    }
    return redirect('/projects')->with('msg', 'Actividad agregada correctamente');
    }

    public function deleteEntry($id){
        $entry = DB::table('data_entries')->find($id);
        return view ('dataEntry.deleteEntry', ['entry' => $entry]);
    }

    public function removeEntry(Request $request){
        $id = $request->input('id');
        if(DB::table('data_entries')->where('id', $id)->exists() == true){
            DB::table('data_entries')->where('id',$id)->delete();}
        return redirect('/projects')->with('msg', 'Actividad eliminada correctamente');
    }

}
