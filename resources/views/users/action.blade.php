<a href="{{route('users.show',$id)}}" class="edit btn btn-secondary btn-sm">Show</a>
<a href="{{route('users.edit',$id)}}" class="edit btn btn-primary btn-sm">Edit</a>
<a href="javascript:void(0)" class="edit btn btn-danger btn-sm user-delete-btn" data-id="{{$id}}">Delete</a>
