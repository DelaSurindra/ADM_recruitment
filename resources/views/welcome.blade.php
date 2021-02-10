@extends('main.main')
@section('pageTitle',$pageTitle)
@section('title',$title)
@section('content')
<?php
$kode_cabang = session('session_id.kode_cabang');
$id_branch = session('session_id.id_branch');
$expPerm = session('session_id.expPerm');
$startDate = date('01-m-Y');
$endDate = date('t-m-Y');
?>


@endsection