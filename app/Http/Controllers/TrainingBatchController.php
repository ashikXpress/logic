<?php

namespace App\Http\Controllers;

use App\Model\BatchLevel;
use App\Model\Product;
use App\Model\TrainingBatch;
use App\Model\TrainingCourse;
use Illuminate\Http\Request;

class TrainingBatchController extends Controller
{
    public function all(){
        $batches=TrainingBatch::orderBy('sort')->get();
        return view('training.batch.all',compact('batches'));
    }
    public function createBatch(){
        $courses=TrainingCourse::where('status',1)->get();

        return view('training.batch.add',compact('courses'));
    }
    public function createBatchPost(Request $request){
        //dd($request->all());
        $request->validate([
            'course' => 'required',
            'name' => 'required|string|max:255',
            'batch_code'=> 'required',
            'batch_amount' => 'required',
            'total_mark' => 'required',
            'level.*' => 'required',
            'mark.*' => 'required|numeric|min:.01',
            'sort' => 'required',
            'status' => 'required'
        ]);
        $batch = new TrainingBatch();
        $batch->course_id = $request->course;
        $batch->name = $request->name;
        $batch->batch_code = $request->batch_code;
        $batch->batch_amount = $request->batch_amount;
        $batch->total_mark = $request->total_mark;
        $batch->sort = $request->sort;
        $batch->status = $request->status;
        $batch->save();

        $counter = 0;
        $total = 0;
        foreach ($request->level as $level) {
            $batchlevel = new BatchLevel();
            $batchlevel->batch_id =$batch->id;
            $batchlevel->course_id =$batch->course_id;
            $batchlevel->level = $request->level[$counter];
            $batchlevel->mark = $request->mark[$counter];
            $batchlevel->save();

            $counter++;
        }
        //dd('fbfhb');

        return redirect()->route('all_batch')->with('message', 'Batch add successfully.');
    }
    public function editBatch(TrainingBatch $batch){

        $courses=TrainingCourse::where('status',1)->get();

        return view('training.batch.edit',compact('batch','courses'));
    }
    public function editBatchPost(TrainingBatch $batch,Request $request){
        //dd($request->all());
        $request->validate([
            'course' => 'required',
            'name' => 'required|string|max:255',
            'batch_code'=> 'required',
            'batch_amount' => 'required',
            'total_mark' => 'required',
            'level.*' => 'required',
            'mark.*' => 'required|numeric|min:.01',
            'sort' => 'required',
            'status' => 'required'
        ]);

        $batch->course_id = $request->course;
        $batch->name = $request->name;
        $batch->batch_code = $request->batch_code;
        $batch->batch_amount = $request->batch_amount;
        $batch->total_mark = $request->total_mark;
        $batch->sort = $request->sort;
        $batch->status = $request->status;
        $batch->save();


        $counter = 0;
        BatchLevel::where('batch_id',$batch->id)->delete();
        foreach ($request->level as $level) {
            $batchlevel = new BatchLevel();
            $batchlevel->batch_id =$batch->id;
            $batchlevel->course_id =$batch->course_id;
            $batchlevel->level = $request->level[$counter];
            $batchlevel->mark = $request->mark[$counter];
            $batchlevel->save();

            $counter++;
        }
        return redirect()->route('all_batch')->with('message', 'Batch edit successfully.');

    }
}
