@extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    <!-- <p>You are: {{ $shopDomain ?? Auth::user()->name }}</p> -->
    <a href="{{url('/showApi')}}" > <button class='add_btn' style="background: #2a674e">create Api</button > </a>
<div class="add_news_btn">
<input type="search"  name="search" id="search" class="search" placeholder="Search News Title"/>
  <a href="{{url('/create')}}" > <button class='add_btn' style="background: #2a674e">Add news</button > </a>
</div>

<div class="success">

  </div>
  <!-- <div class="error">

  </div> -->
  <!-- <hr> -->
<article>
  <div class="card" id="table_data">
   @include('partials.pagination')

  </div>
</article>
   




@endsection

@section('scripts')
    @parent

    <script>
        actions.TitleBar.create(app, { title: 'Welcome' });
    </script>
@endsection