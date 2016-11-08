@extends('layouts.default')

@section('content')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group pull-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li>
                        <a href="#">谱元</a>
                    </li>
                    <li>
                        <a href="#">样品管理系统</a>
                    </li>
                    <li class="active">
                        管理界面
                    </li>
                </ol>
            </div>
            <h4 class="page-title">管理界面</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->


<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-chart-areaspline widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">批次数</p>
                <h2>20 <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 10</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-account-convert widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">样品数</p>
                <h2>1000 <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 1200</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-layers widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User This Month">实验中样品</p>
                <h2>200 <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 100</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-av-timer widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Request Per Minute">项目数</p>
                <h2>5 <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 7</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-account-multiple widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Total Users">任务数</p>
                <h2>200 <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 205</p>
            </div>
        </div>
    </div><!-- end col -->

    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="card-box widget-box-one">
            <i class="mdi mdi-download widget-one-icon"></i>
            <div class="wigdet-one-content">
                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="New Downloads">已产出报告</p>
                <h2>100 <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>
                <p class="text-muted m-0"><b>上周:</b> 90</p>
            </div>
        </div>
    </div><!-- end col -->

</div>
<!-- end row -->



@stop
