@extends('layouts/contentNavbarLayout')

@section('title', 'Email - List')



@section('content')
    
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Email / </span> List</h4>

<div class="card">
    <h5 class="card-header"> Manage your Email here.
        <a href="{{ route('emails.create') }}" class="btn btn-primary btn-sm float-right">Add new Email</a>
    </h5>
    
    
    <div class="mt-2">
        @include('_partials.messages')
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
        <thead>
            <tr>
                <th>subject</th>
          
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
            <tr>
                <td>{{ $email->subject }}</td>
          
                <td>
                        <a href="{{ route('emails.edit', $email->id) }}" class="btn btn-info btn-sm">Edit</a> 
                       
                        </td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
   

</div>


<script type="text/javascript">
    
  window.onload = function() {

    $('.dropify').dropify({
    messages: {
      'default': 'Drag and drop a file here or click'
      , 'replace': 'Drag and drop or click to replace'
      , 'remove': 'Remove'
      , 'error': 'Ooops, something wrong happended.'
    }
  });
}

</script>
@endsection
