<table class='list_news'>
  
  <thead>
    <tr > 
      <th>#Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Status</th>
      <th>Feature </th>
      <th>Media</th>
      <th >Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($news as $n)
   <tr id='{{$n->id}}' >
      <td>{{$n->id}}</td>
      <td>{{$n->title}}</td>
      <td class="desc">{{$n->description}}</td>
      @if($n->status == 0)
      <td><span class="tag red" >in-active</span></td>
      @else
      <td><span class="tag green">active</span></td>
      @endif
      @if($n->feature == 0)
      <td><span class="tag yellow">No</span></td>
      @else
      <td><span class="tag orange">Yes</span></td>
      @endif
      
      <td><img src="{{url('images/'.$n->image) }}" height=80px width=100px></td>
      <td>
      <a href="{{ route('news.show', ['news' => $n->id])}}"><button class="secondary icon-preview"></button></a>
     <a href="{{ route('news.edit', ['news' => $n->id])}}"><button class="secondary icon-edit"></button></a>
     <form action="{{route('news.destroy',['news'=>$n->id])}}" class="delete_form"> 
       @csrf
       @method('delete')
       <input type="hidden" value="{{$n->id}}"  class='id'>
       <button type="submit" class="delete_btn secondary icon-trash"></button>
     </form>
      
      
      </td>
   </tr>
 @endforeach
  </tbody>
</table>
<!-- <div class="pagination"> -->
   <!-- {{$news->links()}} -->
   @if($news->hasPages())
    <div class="pagination">
    <span class="button-group">
      @if($news->onFirstPage())
        <a href="{{ $news->previousPageUrl() }}"> <button disabled class="secondary icon-prev"></button></a>
      @else
      <a href="{{ $news->previousPageUrl() }}"> <button  class="secondary icon-prev"></button></a>
      @endif
      @if($news->hasMorePages()) 
        <a href=" {{ $news->nextPageUrl() }}"> <button class="secondary icon-next"></button></a>
      @else
         <a href=" {{ $news->nextPageUrl() }}"> <button disabled class="secondary icon-next"></button></a>
      @endif 
       
      </span>
  </div>
 @endif
<!-- </div> -->