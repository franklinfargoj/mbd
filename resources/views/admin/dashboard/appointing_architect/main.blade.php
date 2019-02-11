@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" href="../../../../public/css/amcharts.css">
@endsection

@section('content') @php $chart = 0; $chart1 = 0; $chart2 = 0; $chart3 = 0; $chart4 = 0;
@endphp
<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Dashboard</h3>
        </div>
    </div>
    <!-- end -->
    @if(session()->get('role_name')==config('commanConfig.selection_commitee'))
    @include('admin.dashboard.appointing_architect.dashboard',compact('appointing_architect_data'))
    @endif
</div>

@endsection

@section('js')


<script>
   $(".appointing-architect-accordion").on("click", function () {
                    var data = $('.appointing-architect-accordion').children().children().attr('aria-expanded');
                    if (!(data)) {
                        $('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                    }
                    else {
                        if (data == 'undefine' || data == 'false') {
                            $('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.appointing-architect-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

                $(".appointing-architect-pendencies-accordion").on("click", function () {
                    var data = $('.appointing-architect-pendencies-accordion').children().children().attr('aria-expanded');
                    if (!(data)) {
                        $('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                    }
                    else {
                        if (data == 'undefine' || data == 'false') {
                            $('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/minus-icon.svg')");
                        } else {
                            $('.appointing-architect-pendencies-accordion-icon').css('background-image', "url('../../../../img/plus-icon.svg')");
                        }
                    }
                });

</script>


@endsection
