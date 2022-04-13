@extends('shopify-app::layouts.default')

@section('content')
<div class="create-header">
   <a href="{{route('home')}}">  <button class="secondary icon-arrow-left"></button></a>
    <h2>Update News</h2>
  </div>
  <div class="success">

   </div>
  <article>
  <div class="card create_news">
   <form  method="post" action="#" enctyp="multipart/form-data" id="update_news" class="create_news">

  <div class="align">
   <input type="hidden" value="{{$news->id}}" name="id" class="news_id"> 
  
  <div class="row">
    <label>Title</label>
    <input type="text" name="title" value="{{$news->title}}" />
    <div class="error">
        <ul class='title d-none'></ul>
    </div>
  </div>
  <div class="row">
  <label>Description</label>
    <textarea name="description"  >{{$news->description}}</textarea>
    <div class="error">
        <ul class='description d-none'></ul>
    </div>
</div>
  <div class="row">
  <label>Status</label>  
    <select name="status">
    @if($news->status == 0)
    <option value="0" selected>In-active</option>
    <option value="1">Active</option>
     @else
     <option value="0" >In-active</option>
     <option value="1" selected >Active</option>
     @endif
    </select>
  </div>
  <div class="row">
  <label>Feautres</label>
  <select name="feature">
    @if($news->feature == 0)
      <option value="0" selected>No</option>
      <option value="1">Yes</option>
    @else
      <option value="0" >No</option>
      <option value="1" selected>Yes</option>
    @endif 
    </select>
  </div>
  <div class="row">
  <label>Images</label>
   <input type="file"  name="image">
   <div class="error ">
        <ul class='image d-none'></ul>
    </div>
  </div>
  <button class='popup_add_btn add_btn' type="submit" id="popup_add_btn" style="background: #2a674e">Update</button>
  
  <span style="color: #ccc;font-size: 13px; font-weight: 200;">Allowed image Type:jpg,png,jpeg,jif, File size less then </span>
    </div>

</form>
  </div>
</article>



@endsection

@section('scripts')
    @parent

    <script src="{{asset('js/script.js')}}">
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection