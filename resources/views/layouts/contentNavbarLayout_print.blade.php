@extends('layouts/commonMaster' )



@section('layoutContent')
<div class="layout-wrapper layout-content-navbar">
  <div class="container" style="padding:0;">


   

            @yield('content')


    </div>


  </div>
  <script type="text/javascript">
		window.onload = function() {		
			window.print();
		}
	</script>
  <!-- / Layout wrapper -->
  @endsection
