




@extends('layouts.main')

@section('main')
     <div class="container" >

     <div id='myModal' class="modal img-fluid">
                        <span class="close">&times;</span>
                        <img class="modal-content img-fluid" id="ModalImage">
                        <div id="caption"></div>
                    </div>
  
     
      @if (Session::has('message'))
      <div class="alert alert-success">
          {{Session::get('message')}}
      </div>
       @endif
  @if($posts->count()!=0)
  <p>All Posts</p>
      <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Content</th>
              <th scope="col">Image <br><small style="color:red"> Click the image to expand*</small></th>
              <th scope="col">Create date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($posts as $post)
              <tr>
              <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
              <td><img src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}" width="100" id="img{{$post->id}}" onclick="Image(event,{{$post->id}});"></td>
              
             
              <td>{{$post->created_at->diffForHumans()}}</td>
              <td>
              <a href="{{route('post.edit',$post->id)}}"><button class="btn btn-success">Edit</button></a> 
                  <a href="{{route('post.delete',$post)}}" class="btn btn-danger">Delete</a> 
                </td>
              </tr>
              
                  
              @endforeach
          </tbody>
        </table>
       
        {{$posts->links()}}
        
      @else
        <p>No posts till now</p>
      @endif
     
     </div>

     <script>

  function Image(event,id){
    console.log("Clicked")
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("img"+id);
var modalImg = document.getElementById("ModalImage");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
 }
}

 </script>
    
        
  @stop


