@extends('layouts/contentFrontLayout')


@section('content')
<style>
    .page-description-featured-product-text p a{color:#fff;}
</style>
<main class="content-wrapper">


    <section class="breadcrumb-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="breadcrumb-container">
                        <nav aria-label="breadcrumb" style="display:none;">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">home</a></li>
                                <li class="breadcrumb-item"><a href="#">product category</a></li>
                                <li class="breadcrumb-item active" aria-current="page">product name</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {!! $body !!}

    <div class="space-footer-section"></div>
</main>
@endsection