<x-admin-master>
    @section('content')
        <h1>Edit Post</h1>
        <form method="post" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-group">
          @csrf
          @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input  type="text" 
                        name="title"
                        class="form-control" 
                        id="title" 
                        aria-describedby=""
                        placeholder="Enter title"
                        value = {{$post->title}}>

            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input  type="file" 
                        name="post_image"
                        class="form-control-file" 
                        id="post_image" >

            </div>

            <div class="form-group">
                <textarea name="body" 
                class="form-control" 
                id="body" cols="30" 
                rows="10"
                value = {{$post->body}}>
            </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection


</x-admin-master>