@extends('admin.layout.page')

@section('content')
<div class="row">
    <div class="col-12 main-content mt-5">

		@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
		
        <div class="card">
            <h5 class="card-header">Welcome</h5>
            <div class="card-body">
                <p class="card-text">You are logged in!</p>
                <div class="row">
				  <div class="col-sm-6">
				    <div class="card">
				      <div class="card-body">
				        <h5 class="card-title">Pelamar</h5>
				        <p class="card-text">Berikut adalah info sekilas tentang pelamar pada sistem ini.</p>
				        <ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center">
							    Total Pelamar
							    <span class="badge badge-primary badge-pill">{{$jumlahLamaran}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
							    Lamaran Terakhir
							    <span class="badge badge-primary badge-pill">{{date('d-m-Y h:i',strtotime($last))}}</span>
							</li>
						</ul>
						<br>
				        <a href="{{route('pelamar')}}" class="btn btn-primary">Kelola Pelamar</a>
				      </div>
				    </div>
				  </div>
				  <div class="col-sm-6">
				    <div class="card">
				      <div class="card-body">
				        <h5 class="card-title">Lowongan Kerja</h5>
				        <p class="card-text">Berikut adalah info sekilas tentang lowongan kerja pada sistem ini.</p>
				        <ul class="list-group">
				        	<li class="list-group-item d-flex justify-content-between align-items-center">
				        		Wajib upload CV
				        		<?php if ($setting==1) { ?>
				        		<span class="badge badge-success badge-pill">Active</span>			
				        		<?php } else{ ?>
								<span class="badge badge-danger badge-pill">Non Active</span>		
				        		<?php }
				        		?>
				        							        		
				        		 <a href="#" onclick="editRole('{{$setting}}')" type="button" class="btn btn-danger">Ubah</a>
				        	</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
							    Jumlah Lowongan Kerja Aktif
							    <span class="badge badge-primary badge-pill">{{$jumlahLowongan}}</span>
							</li>
						</ul>
						<br>
				        <a href="{{route('vacancy')}}" class="btn btn-primary">Kelola Lowongan</a>
				      </div>
				    </div>
				  </div>
				</div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/custom.js')}}" type="text/javascript"></script>
@endsection
