@extends('layouts.main')

@section('main')
<div class="container">
       
       <div class="col-md-8">
           <div class="card">
               {{-- <div class="card-header">New Post</div> --}}
           </div>
           <div class="card-body">
           <form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   <div class="form-group">
                       <label for="title">Title</label>
                   <input name="title" type="text" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" >
                       @if($errors->has('title'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('title')}}</strong>
                       </span>
                   @endif
                       <label for="content">Content</label>
                   <textarea class="form-control @error('title') is-invalid @enderror" id="" cols="30" rows="10" name="content">{{old('content')}}</textarea>
                   @if($errors->has('content'))
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $errors->first('content')}}</strong>
                   </span>
               @endif
                       <label for="">Image</label>
                       <input type="file" class="form-control"name='image'>
                       @if($errors->has('image'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('image')}}</strong>
                       </span>
                   @endif
                       <br>
                       <button class="btn btn-success" type="submit">Post</button>
                   </div>
               </form>
           </div>
       </div>
   </div>    
</div>
@endsection