<x-admin-master>
    @section('content')
        <h1>Edit aPost</h1>
        <form method="post" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
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
                        value="{{$post->title}}">

            </div>
            <div class="form-group">
                <label for="post_image">Files</label>
                <input  type="file" 
                        name="post_image"
                        id = "post_image"
                        class="form-control-file" 
                        value="{{$post->post_image}}"
                        >
                @csrf

            </div>

            <div class="form-group">
                <textarea
                 name="body" 
                class="form-control"
                 id="body" cols="30" 
                 rows="10">
                 {{$post->body}}
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection


</x-admin-master>