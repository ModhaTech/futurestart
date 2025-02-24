@extends('admin.common')

@section('title', 'Blog Listing')

@section('content')
<!-- Content Wrapper. Contains page content -->
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
         <div class="card-header" style="display: flex; justify-content:space-between;">
            <div>
               <h3 class="card-title">Total Guest Blog Post</h3>
            </div>
            <div style="margin-left: auto;display: flex;">
              <h3 class="card-title"></h3>&nbsp;&nbsp;
              <form action="{{ route('admin.blog-role') }}" method="get">
                @csrf
                 <input type="text" name="search" placeholder="Search...">
                 <button style="border:1px solid" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
              </form>
            </div>
         </div>
         <!-- /.card-header -->
         <div class="card">
            <div class="row">
               <div class="col-sm-3 col-md-6">
                  <!-- form start -->
                   
               </div>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
             
               <table class="table table-hover text-nowrap">
                  <thead>
                     <tr>
                        <th class="check-add">                     
                           <input type="checkbox" name="emp_checkbox" id="select_all" style="display: block !important;">
                        </th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Social Share</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(count($blogs) > 0 )
                     @foreach($blogs as $blog)
                        @php $output = str_split($blog->title, 21);@endphp
                        @php $sup_text = !empty($blog->blog_status == 1) ? 'Published' : 'Draft'; @endphp
                        @php $sup_class = !empty($blog->blog_status == 1) ? 'text-success' : 'text-danger'; @endphp
                         <tr>
                            <td class="check-add">
                               <input type="checkbox" id="blog-{{ $blog->id }}" name="products" value="{{ $blog->id }}" class="emp_checkbox" data-emp-id="{{ $blog->id }}"> 
                            </td>
                            <td>{{ $output[0] ?? "" }}<br/>{{ $output[1] ?? "" }}...<sup class="{{ $sup_class }}">[{{ $sup_text }}]</sup></td>
                            <td>{{ $blog->author_first_name ?? "" }}&nbsp;{{ $blog->author_last_name ?? "" }}</td>
                            <td>{{ $blog->getBlogCatagories['name'] }}</td>
                            <td><span class="tag tag-success">
                                 {{ count($blog->getBlogComments) }}
                               </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($blog->date)->format('d, M Y')}}</td>
                            <td>1</td>
                           <td>
   @if($blog->blog_status == 0)
      <a class="btn btn-warning btn-sm">Pending</a>
      <form action="{{ route('admin.blog.approve', $blog->id) }}" method="POST" style="display:inline;">
         @csrf
         <button type="submit" class="btn btn-success btn-sm">Approve</button>
      </form>
   @else
      <form action="{{ route('admin.blog.unapprove', $blog->id) }}" method="POST" style="display:inline;">
         @csrf
         <button type="submit" class="btn btn-danger btn-sm">Unapprove</button>
      </form>
   @endif
</td>




                         </tr>
                       @endforeach
                       @else
                       <h4 class="text-center text-danger">No Blog Available.</h4>
                       @endif
                  </tbody>
               </table>
             
               <div class="card-footer clearfix">
  
                  <ul class="pagination pagination-sm m-0 float-right">
                       {{ $blogs->links() }}
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
// <script>
// document.querySelectorAll('.approve-btn, .unapprove-btn').forEach(button => {
//     button.addEventListener('click', function() {
//         const blogId = this.getAttribute('data-id');
//         const action = this.classList.contains('approve-btn') ? 'approve' : 'unapprove';

//         fetch(`/blog/${action}/${blogId}`, {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({ status: action === 'approve' ? 0 : 1 })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 location.reload(); // Refresh the page to update the status
//             }
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });

// </script>
@endsection




