  <style>
      .letra { color: #ffffff; }
    </style>

@if (session('Estado'))
 <div class="alert alert alert-warning" role="alert">
      <h3 class="letra text-center"> {{ session('Estado')}} </h3> 
 </div>
@endif

