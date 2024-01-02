<footer class="footer">
  <div class="container-fluid">
      <div class="text-center">
         <ul>
       
         @foreach ($menuDataArray as $menuDataValue)
         @foreach ($menuDataValue->childs as $menuDataValue)
		 <li><a href="{{$menuDataValue->url}}">{{$menuDataValue->title}}</a></li>
         @endforeach
         @endforeach
		 </ul>
      </div>
	  
	  
	<div class="copyright-section">
	<div class="opening-time">Monday-Thursday 10-4 Friday 10-2 CST</div>
	<div class="copyright-text">© Copyright. All Rights Reserved. St. Patrick’s of Texas</div>
	</div>  
	  
  </div>
</footer>
<style>


    .text-top{margin-top:0px !important}
    .text-deco {
    position: relative;
}

.text-deco:before {
    border-bottom: 3px solid red;
    position: absolute;
    content: "";
    width: 100%;
    height: 50%;
}

</style>