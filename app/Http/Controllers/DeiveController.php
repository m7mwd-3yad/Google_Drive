<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Drive;

class DeiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $drive = Drive::where("user_id","=",$user_id)->paginate(500);
        return view('drive.index', compact('drive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('drive.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file_size = 5 * 1024;
        $request->validate([
            'title' => "required|string|min:3|max:20|unique:categories,title",
            'description' => "required|string|min:10|max:50",
            'file' => "required|file|max:$file_size|mimes:png,jpg,jpeg,pdf",
            'category_id' => "required",
        ]);
        $drive = new Drive();
        $drive->title = $request->title;
        $drive->description = $request->description;
        $drive->category_id = $request->category_id;
        $drive_Data = $request->file("file");

        $drive->user_id = auth()->user()->id;


        $file_Extination = $drive_Data->getClientOriginalExtension();
        $file_Name = $drive_Data->getClientOriginalName();
        $location = public_path() . '/upload';
        $drive_Data->move($location, $file_Name);
        $drive->file = $file_Name;
        $drive->file_extination = $file_Extination;
        $drive->save();
        return redirect()->back()->with('done', 'Create Drive Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $drive = DB::table('drivescategory')->where('id', '=', $id)->first();
        return view('drive.show', compact('drive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $drive = DB::table('drivescategory')->where('id', '=', $id)->first();
        $category = Category::all();
        return view('drive.edit', compact('drive', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file_size = 5 * 1024;
        $request->validate([
            'title' => "required|string|min:3|max:20|unique:categories,title,$id",
            'description' => "required|string|min:10|max:50",
            'file' => "file|max:$file_size|mimes:png,jpg,jpeg,pdf",
            'category_id' => "required",
        ]);


        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;
        $drive->category_id = $request->category_id;
        $drive_Data = $request->file("file");

        if ($drive_Data == null) {
            $file_Name = $drive->file;
            $file_Extination = $drive->file_extination;
        } else {

            //delete old
            $file_name = $drive->file;
            $file_path = public_path("upload/$file_name");
            unlink($file_path);

            $file_Extination = $drive_Data->getClientOriginalExtension();
            $file_Name = $drive_Data->getClientOriginalName();
            $location = public_path() . '/upload';
            $drive_Data->move($location, $file_Name);
        }
        $drive->user_id = auth()->user()->id;
        $drive->file = $file_Name;
        $drive->file_extination = $file_Extination;
        $drive->save();
        return redirect()->route('drive.show', $drive->id)->with('done', 'Updated Drive Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deive = Drive::find($id);
        $file_name = $deive->file;
        $file_path = public_path("upload/$file_name");
        unlink($file_path);
        $deive->delete();
        return redirect()->route('drive.index')->with('done', 'Drive Deleted Successfully');
    }

    public function download($id)
    {
        $drive = Drive::find($id);
        $file_name = $drive->file;
        $file_path = public_path("upload/$file_name");
        return response()->download($file_path);
    }

    public function cahngeStatus($id){
        $drive = Drive::find($id);
        if($drive->status =='public'){
            $drive->status = 'private';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'Make File Private Successfully');
        }else{
            $drive->status = 'public';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'Make File Public Successfully');
        }
    }

    public function publicDrives()
    {
        $user_id = auth()->user()->id;
        $drive = Drive::where("status","=","public")->paginate(500);
        return view('drive.public', compact('drive'));
    }

}
