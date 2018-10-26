<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();
@endphp
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    @php
    // $land_permission = ['village_detail.index', 'village_detail.create', 'village_detail.edit',
    // 'village_detail.update', 'village_detail.destroy',
    // 'loadDeleteVillageUsingAjax', 'village_detail.store', 'society_detail.index', 'society_detail.create',
    // 'society_detail.store',
    // 'lease_detail.index', 'lease_detail.create', 'lease_detail.store', 'renew-lease.renew', 'renew-lease.update-lease'
    // ];
    @endphp

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " style="position: relative;">
        <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true"
            data-max-height="100vh">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
                @yield('actions')
            </ul>
        </div>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')

<script>
    function end_lease_notifications(count) {
        console.log(count);
        var end_lease_date_count = count;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route('society_detail.index') }}',
            method: 'get',
            data: {
                end_lease_date_count: count
            },
            success: function (res) {
                if (res.society_email != undefined) {
                    $('#society_email').text(res.society_email[0]);
                } else {
                    $('#society_email').text('');
                }
            }
        });
    }

</script>

@endsection
