@extends('admin.common')

@section('title', 'Blog Listing')

@section('content')
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  button.swal2-cancel.btn.btn-danger {
      margin-right: 10px;
  }
</style>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header ch total_blog_post">
      <div class="container-fluid">
         <div class="row mb-2">
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Total Blog Comment</h3>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-6 col-md-12">
                  <!-- form start -->
                  <div class="card-body">
                       
                  </div>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
             @if(count($comments) > 0 )
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Blog Title</th>
                        <th>Comment</th>
                        <th>Posted By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                     @php $counter = 0; @endphp
                     @foreach($comments as $comment)
                        @php 
                           if($comment->getCommentUser == null){
                              continue;
                           }
                        @endphp
                        @if($comment->status == '0')
                            @php  $status = 'Pendding' @endphp
                        @elseif($comment->status == '1')
                            @php  $status = 'Approved' @endphp
                        @elseif($comment->status == '2')
                            @php  $status = 'Disapproved' @endphp
                        @elseif($comment->status == '3')
                            @php  $status = 'Remove' @endphp
                        @endif
                        @if(empty($comment->blogData))
                          @continue
                        @else
                        @php $crdate = \Carbon\Carbon::parse($comment->created_at); @endphp
                         <tr>
                            <td>{{ ++$counter }}</td>
                            <td>{{ $comment->blogData['title'] }}</td>
                            <td>{{ $comment->message }}</td>
                            <td>{{ $comment->getCommentUser['first_name'] }}&nbsp; {{ $comment->getCommentUser['last_name'] }}</td>
                            <td>{{ $crdate->format('d, M Y')}}</td>
                            <td>{{ $status }}</td>
                            <td>
                               @if($comment->status == '0')
                                  <a class="btn btn-success" href="javascript:void(0)" data-commentid="{{ $comment->id }}" id="approve-blog-comment-{{ $comment->id }}" data-url="{{ route('admin.blog.comment.status', $comment->id ) }}">Approve</a>
                                  <a class="btn btn-danger" href="javascript:void(0)" data-commentid="{{ $comment->id }}" id="disapprove-blog-comment-{{ $comment->id }}" data-url="{{ route('admin.blog.comment.status', $comment->id ) }}">Disapprove</a> 
                                  <a class="btn btn-warning" href="javascript:void(0)" data-commentid="{{ $comment->id }}" id="remove-blog-comment-{{ $comment->id }}" data-url="{{ route('admin.blog.comment.status', $comment->id ) }}">Remove</a> 
                                  
                                @elseif($comment->status == '1')
                                  <a href="javascript:void();" class="btn btn-warning"><i class="fa fa-check"></i>Approved</a>
                                @elseif($comment->status == '2')
                                  <a href="javascript:void();" class="btn btn-danger"><i class="fa fa-check"></i>Disapproved</a>
                                @elseif($comment->status == '3')
                                  <a href="javascript:void();" class="btn btn-warning"><i class="fa fa-check"></i>Remove</a>
                               @endif

                            </td>
            
                         </tr>
                         @endif
                       @endforeach

                  </tbody>

               </table>

               @else
                 
                 <p class="text-danger text-center" style="font-size: 20px;">No Comment available</p>

               @endif
             
               <div class="card-footer clearfix">
  
                  <ul class="pagination pagination-sm m-0 float-right">
                       {!! $comments->render() !!}
                </ul>
               </div>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection




