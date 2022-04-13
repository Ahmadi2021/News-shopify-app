@extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    <!-- <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p> -->
    <div class="create-header">
       <a href="{{route('home')}}">  <button class="secondary icon-arrow-left"></button></a>
    <h2>{{$news->title}} Details</h2>
  </div>
<hr>
<article>
  <div class="card">
   <table>

    <tr>
      <th>Title</th>
      <td> {{$news->title}}  </td>
    </tr>
    <tr>
      <th>Description</th>
      <td> {{$news->description}}  </td>
    </tr>
    <tr>
      <th>Status</th>
      @if($news->status == 0)
      <td><span class="tag red" >in-active</span></td>
      @else
      <td><span class="tag green">active</span></td>
      @endif
     
    </tr>
    <tr>
      <th>Feature</th>
      @if($news->feature == 0)
      <td><span class="tag yellow">No</span></td>
      @else
      <td><span class="tag orange">Yes</span></td>
      @endif
    </tr>
    <tr>
      <th>Media</th>
      <td> <img  src="{{url('images/'.$news->image)}}" height="200px" width="300px"> </td>
    </tr>
  

</table>


  </div>
</article>
   




@endsection

@section('scripts')
    @parent

    <script >
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection