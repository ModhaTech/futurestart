<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use App\Models\BlogContent;
use Response;
use Session;
use Carbon;

class BlogCommentController extends Controller
{
    /*** Display a listing of the resource.** @return \Illuminate\Http\Response */
    public function index(Request $request)
    {
        $comments = [];
        $comments = BlogComment::with(['blogData', 'getCommentUser'])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.blog-comment.index', compact('comments' ));
    }

    /*** Show the form for creating a new resource.** @return \Illuminate\Http\Response */
    public function create()
    {
        //
    }

    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request * @return \Illuminate\Http\Response */
    public function store(Request $request)
    {
        //
    }

    /*** Display the specified resource.** @param  int  $id * @return \Illuminate\Http\Response */
    public function show($id)
    {
        //
    }

    /*** Show the form for editing the specified resource. ** @param  int  $id * @return \Illuminate\Http\Response */
    public function edit($id)
    {
        //
    }

    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request * @param  int  $id * @return \Illuminate\Http\Response */
    public function update(Request $request, $id)
    {
        if(!empty($id)) 
        {
            $status = $request->input('status');
            if($status != '3')
            {
                $updateTable = ['status' => $status];
                $changeStatus = BlogComment::where('id', $id)->update($updateTable);
                if(!empty($changeStatus)) 
                { 
                    switch ($status) 
                    {
                        case '1':
                            $response = ['success' => 'Comment Approved successfully'];
                            break;

                        case '2':
                            $response = ['success' => 'Comment Disapproved successfully'];
                            break;
                        
                        default:
                            $response = ['error' => 'Please try again later.'];
                            break;
                    }
                    return Response::json($response);
                } 
                else 
                {
                    $response = ['error' => 'Please try again later.'];
                    return Response::json($response);
                }
            }
            else
            {
                BlogComment::where('id', $id)->delete();
                $response = ['success' => 'Comment Remove successfully'];
                return Response::json($response);
            }
        } 
        else 
        {
             Session::flash('error', 'No direct script access allowed.');
             return redirect( route('admin.blog.comment') );
        }
    }

    /*** Remove the specified resource from storage.** @param  int  $id * @return \Illuminate\Http\Response */
    public function destroy($id)
    {
        //
    }
}
