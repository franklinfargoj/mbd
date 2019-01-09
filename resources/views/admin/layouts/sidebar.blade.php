<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();

@endphp

{{--@php--}}`
{{--dd((\Illuminate\Support\Facades\Request::is('lease_detail/*')--}}
{{--&& (isset($count) && ($count==0)))--}}
{{--|| \Illuminate\Support\Facades\Request::is('lease_detail/create/*')--}}
{{--|| \Illuminate\Support\Facades\Request::is('lease_detail/view-lease/*')--}}
{{--|| \Illuminate\Support\Facades\Request::is('lease_detail/edit-lease/*'));--}}
{{--@endphp--}}

<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    @php
    $land_permission = ['village_detail.index', 'village_detail.create', 'village_detail.edit',
    'village_detail.update', 'village_detail.destroy',
    'loadDeleteVillageUsingAjax', 'village_detail.store', 'society_detail.index', 'society_detail.create',
    'society_detail.store',
    'lease_detail.index', 'lease_detail.create', 'lease_detail.store', 'renew-lease.renew', 'renew-lease.update-lease'
    ];
    @endphp

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " style="position: relative;">
        <div class="m-scrollable m-scroller ps ps--active-y" data-scrollbar-shown="true" data-scrollable="true"
            data-max-height="100vh">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">

                @if((session()->get('permission') && in_array('dashboard', session()->get('permission')) && !(strpos($route,'resolution') !== false)) ||
                (strpos($route,'dashboard') !== false) || (strpos($route,'detail') !== false) || !($route ==
                'hearing'))
                <li class="m-menu__item {{(strpos($route,'dashboard') !== false)?'m-menu__item--active':''}}">
                    <a href="{{ session()->get('dashboard') }}" class="m-menu__link m-menu__toggle">
                        <span class="sidebar-icon sidebar-menu-icon--level-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.106 512.106">
                                <path fill="#fff" d="M127.686 37.216a12.578 12.578 0 0 0-16.486.128L76.853 68.081v-4.028c0-4.713-3.82-8.533-8.533-8.533s-8.533 3.82-8.533 8.533v19.311L45.561 96.096a8.534 8.534 0 0 0 11.383 12.715l62.575-56.013 62.575 56.013a8.534 8.534 0 1 0 11.383-12.715l-65.791-58.88zM170.72 119.52a8.533 8.533 0 0 0-8.533 8.533v59.733H76.853v-59.733c0-4.713-3.82-8.533-8.533-8.533s-8.533 3.82-8.533 8.533v65.152c.084 6.515 5.432 11.729 11.947 11.648h95.573c6.519.066 11.862-5.155 11.947-11.674v-65.126a8.535 8.535 0 0 0-8.534-8.533zM119.52 221.92c-32.99 0-59.733 26.744-59.733 59.733s26.744 59.733 59.733 59.733 59.733-26.744 59.733-59.733c-.038-32.974-26.759-59.696-59.733-59.733zm-42.667 59.733c.026-20.268 14.281-37.731 34.133-41.813v36.975L79.413 295.75a42.071 42.071 0 0 1-2.56-14.097zm11.354 28.729l29.99-17.994 24.815 24.815c-17.433 11.63-40.755 8.727-54.805-6.821zm66.871-5.245l-27.025-27.017v-38.28a42.592 42.592 0 0 1 27.025 65.297zM460.853 153.653v-29.21c-.005-7.43-6.027-13.452-13.457-13.457H423.11c-7.43.005-13.452 6.027-13.457 13.457v29.21h-17.067v-53.504c-.009-8.149-6.613-14.753-14.763-14.763h-21.675c-8.148.01-14.752 6.614-14.762 14.763v53.504H324.32V59.786c0-9.426-7.641-17.067-17.067-17.067h-17.067c-9.426 0-17.067 7.641-17.067 17.067v93.867h-8.533a8.533 8.533 0 0 1-8.533-8.533V42.72a8.533 8.533 0 0 0-17.066 0v102.4c0 14.138 11.461 25.6 25.6 25.6h196.267a8.534 8.534 0 0 0-.001-17.067zm-153.6 0h-17.067V59.786h17.067v93.867zm68.267 0h-17.067v-51.2h17.067v51.2zm68.266 0H426.72v-25.6h17.067v25.6zM460.853 324.32H264.586a8.533 8.533 0 0 1-8.533-8.533v-13.534l28.1-28.1a8.712 8.712 0 0 1 12.066 0l10.001 10.001c9.997 9.994 26.202 9.994 36.198 0l35.601-35.601a8.712 8.712 0 0 1 12.066 0l10.001 10.01c10.008 9.966 26.19 9.966 36.198 0l30.601-30.601a8.533 8.533 0 0 0-.104-11.962 8.533 8.533 0 0 0-11.962-.104l-30.601 30.592a8.534 8.534 0 0 1-12.066 0l-10.001-10.001c-10.13-9.668-26.069-9.668-36.198 0l-35.601 35.601a8.534 8.534 0 0 1-12.066 0l-9.992-10.001c-10.132-9.669-26.075-9.669-36.207 0l-16.034 16.034v-64.734a8.533 8.533 0 0 0-17.066 0v102.4c0 14.138 11.461 25.6 25.6 25.6h196.267a8.534 8.534 0 0 0-.001-17.067z"/>
                                <path fill="#fff" d="M512.053 396.46V47.37C513.24 22.556 494.19 1.43 469.386.053H42.72C17.916 1.431-1.134 22.557.053 47.37v349.09c-1.191 24.817 17.859 45.948 42.667 47.326h136.533v17.067H145.12c-18.851 0-34.133 15.282-34.133 34.133v8.533a8.533 8.533 0 0 0 8.533 8.533h273.067a8.533 8.533 0 0 0 8.533-8.533v-8.533c0-18.851-15.282-34.133-34.133-34.133h-34.133v-17.067h136.533c24.807-1.377 43.857-22.509 42.666-47.326zm-145.067 81.46c9.426 0 17.067 7.641 17.067 17.067h-256c0-9.426 7.641-17.067 17.067-17.067h221.866zM196.32 460.853v-17.067h119.467v17.067H196.32zm273.066-34.133H42.72c-15.361-1.41-26.754-14.877-25.6-30.259V375.52h477.867v20.941c1.154 15.382-10.239 28.849-25.601 30.259zm25.6-379.35v311.083H17.12V47.37c-1.154-15.381 10.24-28.845 25.6-30.251h426.667c15.359 1.406 26.754 14.87 25.599 30.251z"/>
                            </svg>
                        </span>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Dashboard
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                {{--@if(session()->get('permission') && in_array('architect_layout_dashboard',
                session()->get('permission')))--}}
                {{--<li class="m-menu__item {{($route=='architect_layout_dashboard')?'m-menu__item--active':''}}"
                    aria-haspopup="true">--}}
                    {{--<a href="{{ url('architect_layout_dashboard') }}" class="m-menu__link ">--}}
                        {{--<i class="m-menu__link-icon flaticon-line-graph"></i>--}}
                        {{--<span class="m-menu__link-title">--}}
                            {{--<span class="m-menu__link-wrap">--}}
                                {{--<span class="m-menu__link-text">--}}
                                    {{--Dashboard--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endif--}}


                @if(session()->get('permission') && (in_array('architect_application', session()->get('permission')) ||
                in_array('view_architect_application',
                session()->get('permission')) || in_array('evaluate_architect_application',
                session()->get('permission'))
                ||
                in_array('shortlisted_architect_application', session()->get('permission')) ||
                in_array('final_architect_application',
                session()->get('permission')) || in_array('save_evaluate_marks', session()->get('permission')) ||
                in_array('generate_certificate', session()->get('permission')) ||
                in_array('forward_application', session()->get('permission')) ||
                in_array('finalCertificateGenerate', session()->get('permission')) ||
                in_array('tempCertificateGenerate', session()->get('permission')) ||
                in_array('postfinalCertificateGenerate', session()->get('permission')) ||
                in_array('architect.edit_certificate', session()->get('permission')) ||
                in_array('architect.update_certificate', session()->get('permission'))||
                in_array('architect.post_final_signed_certificate', session()->get('permission'))))


                <li class="m-menu__item {{($route=='architect_application')?'m-menu__item--active':''}}" aria-haspopup="true">
                    <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Appointing Architect
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') != "" && in_array('resolution.index', session()->get('permission')))
                <li class="m-menu__item {{ ($route == 'resolution.index' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{ url('/resolution') }}" class="m-menu__link ">
                        <span class="sidebar-icon sidebar-menu-icon--level-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 57" fill="#fff">
                              <path d="M49.179 38.5l-5.596 8.04-3.949-3.241a1 1 0 1 0-1.268 1.545l4.786 3.929a.995.995 0 0 0 .771.217c.276-.038.524-.19.684-.419l6.214-8.929a1 1 0 1 0-1.642-1.142z"/>
                              <path d="M54 35.705V12.176C54 5.462 48.538 0 41.824 0H12.176C5.462 0 0 5.462 0 12.176v29.648C0 48.538 5.462 54 12.176 54h23.529c2.253 1.872 5.144 3 8.295 3 7.168 0 13-5.832 13-13 0-3.151-1.128-6.042-3-8.295zM12.176 52C6.565 52 2 47.436 2 41.824V12.176C2 6.564 6.565 2 12.176 2h29.648C47.435 2 52 6.564 52 12.176v21.592c-.075-.059-.155-.109-.231-.166-.21-.158-.42-.315-.64-.46l-.071-.043a12.97 12.97 0 0 0-1.616-.888c-.076-.035-.15-.075-.226-.109-.22-.097-.445-.18-.671-.265-.143-.054-.286-.109-.431-.158-.207-.069-.416-.13-.627-.189a13.64 13.64 0 0 0-1.115-.262c-.23-.043-.462-.076-.695-.106-.156-.02-.311-.045-.469-.06-.4-.039-.803-.062-1.208-.062-6.134 0-11.277 4.276-12.637 10H27a1 1 0 1 0 0 2h4.051c-.026.331-.051.663-.051 1 0 .405.024.808.061 1.208.015.159.039.314.06.471.03.231.063.462.106.69a13.873 13.873 0 0 0 .453 1.748c.047.141.101.279.153.418.086.23.171.459.269.683.029.066.064.13.094.196.267.58.571 1.14.918 1.67l.026.042c.146.221.304.432.462.644.057.076.107.155.165.23H12.176zM44 55c-2.821 0-5.39-1.077-7.339-2.83a10.837 10.837 0 0 1-.693-.679c-.049-.052-.096-.105-.144-.158a11.32 11.32 0 0 1-.595-.721c-.043-.057-.087-.114-.129-.172a11.08 11.08 0 0 1-.521-.789c-.033-.054-.067-.107-.099-.163a10.999 10.999 0 0 1-.451-.869c-.022-.047-.046-.092-.067-.14a10.651 10.651 0 0 1-.37-.946c-.013-.04-.03-.078-.043-.117a11.244 11.244 0 0 1-.273-.995c-.009-.039-.022-.077-.03-.117a10.57 10.57 0 0 1-.163-1.005c-.006-.047-.016-.093-.021-.141A10.843 10.843 0 0 1 33 44c0-6.065 4.935-11 11-11 .39 0 .777.021 1.161.063.045.005.088.015.133.021.34.041.679.093 1.012.165.038.008.074.021.112.029.338.077.672.166 1 .274.037.012.073.027.11.04.324.11.643.234.955.374.044.02.087.043.131.063.299.139.592.29.878.455.052.03.103.063.154.094.273.165.539.339.798.527l.163.122c.252.19.496.391.732.603.05.045.1.089.148.135.239.223.469.458.69.704A10.937 10.937 0 0 1 55 44c0 6.065-4.935 11-11 11z"/>
                              <path d="M27 14h18a1 1 0 1 0 0-2H27a1 1 0 1 0 0 2zM27 28h18a1 1 0 1 0 0-2H27a1 1 0 1 0 0 2zM19.169 7.35l-6.248 7.288L9.1 11.771a1 1 0 0 0-1.2 1.599l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-8a1 1 0 1 0-1.519-1.299zM19.169 21.35l-6.248 7.288L9.1 25.771a1 1 0 0 0-1.2 1.599l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-8a1 1 0 1 0-1.519-1.299zM19.169 36.35l-6.248 7.287L9.1 40.771a1.001 1.001 0 0 0-1.4.2.998.998 0 0 0 .2 1.399l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-7.999a1 1 0 1 0-1.519-1.3z"/>
                            </svg>
                        </span>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Resolution Listing
                                </span>
                            </span>
                        </span>
                    </a>
                </li>

                <li class="m-menu__item {{ ($route == 'resolution.create' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{route('resolution.create')}}" class="m-menu__link ">
                        <span class="sidebar-icon sidebar-menu-icon--level-1">
                            <svg viewBox="0 0 496 496.012" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#fff" d="M451.023 405.316c7.926-7.312 12.985-17.695 12.985-29.304v-16c0-22.055-17.945-40-40-40-19.313 0-35.473 13.77-39.195 32h-26.278c-3.312-9.29-12.113-16-22.527-16-10.418 0-19.219 6.71-22.531 16h-26.278c-3.191-15.649-15.547-28-31.191-31.192v-17.945c13.765-3.574 24-15.992 24-30.863h8c4.422 0 8-3.575 8-8v-24h16v-16h-16v-.086c0-15.305 7.254-30.348 19.902-41.242 22.938-19.786 36.098-48.457 36.098-78.672 0-28.575-11.356-55.215-31.969-75.016C299.438 9.196 272.207-1.14 243.72.102c-54 2.175-98.73 47.941-99.696 102.015-.554 30.606 12.352 59.758 35.407 79.985 12.687 11.117 20.062 26.328 20.496 41.91h-15.918v16h16v24c0 4.425 3.574 8 8 8h8c0 14.87 10.23 27.289 24 30.863v17.945c-15.649 3.192-28 15.543-31.195 31.192h-26.278c-3.312-9.29-12.113-16-22.527-16-10.418 0-19.219 6.71-22.531 16H111.2c-3.722-18.23-19.875-32-39.191-32-22.059 0-40 17.945-40 40v16c0 11.61 5.055 21.992 12.98 29.304C18.645 416.027.008 441.867.008 472.012v16c0 4.426 3.574 8 8 8h128c4.422 0 8-3.574 8-8v-16c0-30.145-18.64-55.985-44.985-66.696 7.926-7.312 12.985-17.695 12.985-29.304v-8h25.469c3.312 9.289 12.113 16 22.53 16 10.415 0 19.216-6.711 22.528-16h25.473v8c0 11.61 5.055 21.992 12.98 29.304-26.343 10.711-44.98 36.551-44.98 66.696v16c0 4.426 3.574 8 8 8h128c4.422 0 8-3.574 8-8v-16c0-30.145-18.64-55.985-44.985-66.696 7.926-7.312 12.985-17.695 12.985-29.304v-8h25.469c3.312 9.289 12.113 16 22.53 16 10.415 0 19.216-6.711 22.528-16h25.473v8c0 11.61 5.055 21.992 12.98 29.304-26.343 10.711-44.98 36.551-44.98 66.696v16c0 4.426 3.574 8 8 8h128c4.422 0 8-3.574 8-8v-16c0-30.145-18.64-55.985-44.985-66.696zm-323.015 66.696v8h-16v-16h-16v16h-48v-16h-16v16h-16v-8c0-30.871 25.125-56 56-56 30.87 0 56 25.129 56 56zm-80-96v-16c0-13.23 10.765-24 24-24 13.23 0 24 10.77 24 24v16c0 13.23-10.77 24-24 24-13.235 0-24-10.77-24-24zm112-8a8 8 0 0 1 0-16c4.414 0 8 3.586 8 8 0 4.418-3.586 8-8 8zm29.965-197.946c-19.504-17.109-30.422-41.773-29.95-67.671.825-45.75 38.657-84.47 84.336-86.313 24.407-.887 47.168 7.715 64.59 24.457 17.45 16.746 27.059 39.297 27.059 63.473 0 25.558-11.137 49.816-30.547 66.543-16.176 13.953-25.453 33.402-25.453 53.37v.087h-64.082c-.434-20.184-9.793-39.785-25.953-53.946zm90.035 69.946v16h-64v-16zm-48 32h32c0 8.824-7.18 16-16 16-8.824 0-16-7.176-16-16zm72 200v8h-16v-16h-16v16h-48v-16h-16v16h-16v-8c0-30.871 25.125-56 56-56 30.87 0 56 25.129 56 56zm-80-96v-16c0-13.23 10.765-24 24-24 13.23 0 24 10.77 24 24v16c0 13.23-10.77 24-24 24-13.235 0-24-10.77-24-24zm112-8a8 8 0 0 1 0-16c4.414 0 8 3.586 8 8 0 4.418-3.586 8-8 8zm64 8v-16c0-13.23 10.765-24 24-24 13.23 0 24 10.77 24 24v16c0 13.23-10.77 24-24 24-13.235 0-24-10.77-24-24zm80 104h-16v-16h-16v16h-48v-16h-16v16h-16v-8c0-30.871 25.125-56 56-56 30.87 0 56 25.129 56 56zm0 0"/>
                                <path fill="#fff" d="M232.008 192.012h32v16h-32zm8-48.809v16.809h16v-16.809c5.094-1.039 9.832-3.07 14.023-5.855l12.32 12.32 11.31-11.313-12.317-12.32c2.781-4.191 4.812-8.926 5.855-14.023h16.809v-16h-16.809c-1.043-5.098-3.074-9.832-5.855-14.024l12.316-12.32-11.308-11.313-12.32 12.32c-4.192-2.784-8.93-4.816-14.024-5.855V48.012h-16V64.82c-5.098 1.04-9.832 3.07-14.028 5.856l-12.32-12.32-11.308 11.312 12.32 12.32c-2.785 4.192-4.817 8.926-5.86 14.024h-16.804v16h16.805c1.042 5.097 3.074 9.832 5.859 14.023l-12.32 12.32 11.308 11.313 12.32-12.32c4.196 2.785 8.93 4.816 14.028 5.855zm8-63.191c13.23 0 24 10.77 24 24s-10.77 24-24 24c-13.235 0-24-10.77-24-24s10.765-24 24-24zm0 0"/>
                            </svg>
                        </span>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Add Resolution
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') != "" && in_array('appointing_architect.index',
                session()->get('permission')))
                <li class="m-menu__item {{ ($route == 'appointing_architect.index' ? 'm-menu__item--active' : '') }}"
                    aria-haspopup="true">
                    <a href="{{ route('appointing_architect.index') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Applications
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @if(session()->get('permission') && in_array('rti_applicants', session()->get('permission')))
                <li class="m-menu__item">
                    <a href="{{url('/rti_applicants')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    RTI Applicants
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif

                @php
                $hearing_permission = ['hearing.show', 'hearing.index', 'hearing.store', 'hearing.create',
                'hearing.destroy', 'hearing.update', 'hearing.edit', 'loadDeleteReasonOfHearingUsingAjax',
                'schedule_hearing.add', 'schedule_hearing.store',
                'fix_schedule.add', 'fix_schedule.store', 'fix_schedule.edit', 'fix_schedule.update',
                'upload_case_judgement.add', 'upload_case_judgement.store', 'upload_case_judgement.edit',
                'upload_case_judgement.update',
                'forward_case.create', 'forward_case.store', 'forward_case.edit', 'forward_case.update',
                'send_notice_to_appellant.create', 'send_notice_to_appellant.store', 'send_notice_to_appellant.edit',
                'send_notice_to_appellant.update',
                ];
                @endphp

                {{--@if(session()->get('permission') && in_array('hearing.dashboard',
                session()->get('permission')))--}}
                {{--<li class="m-menu__item {{($route=='hearing.dashboard')?'m-menu__item--active':''}}">--}}
                    {{--<a href="{{ url('hearing-dashboard') }}" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-line-graph"></i>--}}
                        {{--<span class="m-menu__link-title">--}}
                            {{--<span class="m-menu__link-wrap">--}}
                                {{--<span class="m-menu__link-text">--}}
                                    {{--Dashboard--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--@endif--}}


                {{-- @if(!empty(array_intersect($hearing_permission, session()->get('permission'))))--}}
                @if(session()->get('permission') && in_array('hearing.index', session()->get('permission')))
                <li class="m-menu__item {{($route=='hearing.index')?'m-menu__item--active':''}}">
                    <a href="{{ url('hearing') }}" class="m-menu__link m-menu__toggle">
                    <span class="sidebar-icon sidebar-menu-icon--level-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 57" fill="#fff">
                            <path d="M49.179 38.5l-5.596 8.04-3.949-3.241a1 1 0 1 0-1.268 1.545l4.786 3.929a.995.995 0 0 0 .771.217c.276-.038.524-.19.684-.419l6.214-8.929a1 1 0 1 0-1.642-1.142z"/>
                            <path d="M54 35.705V12.176C54 5.462 48.538 0 41.824 0H12.176C5.462 0 0 5.462 0 12.176v29.648C0 48.538 5.462 54 12.176 54h23.529c2.253 1.872 5.144 3 8.295 3 7.168 0 13-5.832 13-13 0-3.151-1.128-6.042-3-8.295zM12.176 52C6.565 52 2 47.436 2 41.824V12.176C2 6.564 6.565 2 12.176 2h29.648C47.435 2 52 6.564 52 12.176v21.592c-.075-.059-.155-.109-.231-.166-.21-.158-.42-.315-.64-.46l-.071-.043a12.97 12.97 0 0 0-1.616-.888c-.076-.035-.15-.075-.226-.109-.22-.097-.445-.18-.671-.265-.143-.054-.286-.109-.431-.158-.207-.069-.416-.13-.627-.189a13.64 13.64 0 0 0-1.115-.262c-.23-.043-.462-.076-.695-.106-.156-.02-.311-.045-.469-.06-.4-.039-.803-.062-1.208-.062-6.134 0-11.277 4.276-12.637 10H27a1 1 0 1 0 0 2h4.051c-.026.331-.051.663-.051 1 0 .405.024.808.061 1.208.015.159.039.314.06.471.03.231.063.462.106.69a13.873 13.873 0 0 0 .453 1.748c.047.141.101.279.153.418.086.23.171.459.269.683.029.066.064.13.094.196.267.58.571 1.14.918 1.67l.026.042c.146.221.304.432.462.644.057.076.107.155.165.23H12.176zM44 55c-2.821 0-5.39-1.077-7.339-2.83a10.837 10.837 0 0 1-.693-.679c-.049-.052-.096-.105-.144-.158a11.32 11.32 0 0 1-.595-.721c-.043-.057-.087-.114-.129-.172a11.08 11.08 0 0 1-.521-.789c-.033-.054-.067-.107-.099-.163a10.999 10.999 0 0 1-.451-.869c-.022-.047-.046-.092-.067-.14a10.651 10.651 0 0 1-.37-.946c-.013-.04-.03-.078-.043-.117a11.244 11.244 0 0 1-.273-.995c-.009-.039-.022-.077-.03-.117a10.57 10.57 0 0 1-.163-1.005c-.006-.047-.016-.093-.021-.141A10.843 10.843 0 0 1 33 44c0-6.065 4.935-11 11-11 .39 0 .777.021 1.161.063.045.005.088.015.133.021.34.041.679.093 1.012.165.038.008.074.021.112.029.338.077.672.166 1 .274.037.012.073.027.11.04.324.11.643.234.955.374.044.02.087.043.131.063.299.139.592.29.878.455.052.03.103.063.154.094.273.165.539.339.798.527l.163.122c.252.19.496.391.732.603.05.045.1.089.148.135.239.223.469.458.69.704A10.937 10.937 0 0 1 55 44c0 6.065-4.935 11-11 11z"/>
                            <path d="M27 14h18a1 1 0 1 0 0-2H27a1 1 0 1 0 0 2zM27 28h18a1 1 0 1 0 0-2H27a1 1 0 1 0 0 2zM19.169 7.35l-6.248 7.288L9.1 11.771a1 1 0 0 0-1.2 1.599l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-8a1 1 0 1 0-1.519-1.299zM19.169 21.35l-6.248 7.288L9.1 25.771a1 1 0 0 0-1.2 1.599l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-8a1 1 0 1 0-1.519-1.299zM19.169 36.35l-6.248 7.287L9.1 40.771a1.001 1.001 0 0 0-1.4.2.998.998 0 0 0 .2 1.399l4.571 3.429a.995.995 0 0 0 1.36-.15l6.857-7.999a1 1 0 1 0-1.519-1.3z"/>
                        </svg>
                    </span>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    List of Hearings
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @if(Auth::user()->name == 'Joint CO PA' || Auth::user()->name == 'CO PA')
                <li class="m-menu__item {{($route=='hearing.create')?'m-menu__item--active':''}}">
                    <a href="{{route('hearing.create')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Add Hearing
                                </span>
                            </span>
                        </span>
                    </a>
                </li>
                @endif
                @endif



                {{-- @if(!empty(array_intersect($land_permission, session()->get('permission'))))--}}
                @if(session()->get('permission') && in_array('village_detail.index', session()->get('permission')))
                <li class="m-menu__item m-menu__item--icon {{($route!='architect_layout.index' && $route!='architect_layouts_layout_details.index')?'':'collapsed'}}"
                    data-toggle="collapse" data-target="#land-module-actions">
                    <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    <img class="sidebar-icon" src="{{ asset('/img/sidebar/land-icon.svg')}}">Land
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                    {{-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">

                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                        src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land
                                        Detail
                                        {{$route}}</span></img></a>
                            </li>
                            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                                <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img
                                        class="radio-icon" src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                        Detail</span></i></a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                <li id="land-module-actions" class="collapse {{($route!='architect_layout.index' && $route!='architect_layouts_layout_details.index')?'show':''}}">
                    <ul class="list-unstyled">
                        <li class="m-menu__item m-menu__item--level-2 {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show' || $route=='village_detail.create')?  '' :'collapsed'}}"
                            data-toggle="collapse" data-target="#village-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <span class="sidebar-icon sidebar-menu-icon--level-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                      <path fill="#fff" d="M465.229 215.91L256.044 352.199 46.859 215.91.088 240.255l255.956 166.116L512 240.255z"/>
                                      <path fill="#fff" d="M465.229 305.863l-209.185 136.29-209.185-136.29L.088 330.209l255.956 166.116L512 330.209zM155.163 68.298l-46.579 24.776 71.88 46.509 45.305-27.576zM179.975 174.983l-72.946 44.402 50.365 32.816 70.958-45.916zM254.36 129.706l-45.941 27.964 47.533 30.757 45.6-29.507zM329.762 176.385l-46.21 29.9 70.964 45.916 47.611-31.021zM355.945 67.872l-72.854 44.345 46.322 28.676 73.907-47.822z"/>
                                      <path fill="#fff" d="M255.952 224.143l-71.053 45.977 71.057 46.298 71.055-46.297zM78.291 109.189L0 150.302l79.174 50.935 72.847-44.341zM255.956 15.675l-70.147 36.32 68.69 42.523 70.671-43.019zM433.614 109.185l-75.991 49.171 72.264 44.737 82.025-52.791z"/>
                                    </svg>
                                </span>
                                <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                Land Details
                                            </span>
                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                        </span>
                                </span>


                            </a>
                            <!-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land Detail
                                    {{$route}}</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                    Detail</span></i></a>
                        </li>
                    </ul>
                </div> -->
                        </li>
                        <li id="village-actions" class="collapse m-menu__item--level-3 {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show' || $route=='village_detail.create')?  'show' :''}}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">List of Lands</span></a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('village_detail.create')}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Add Land</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="m-menu__item m-menu__item--level-2 {{ ($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' || $route=='society_detail.create')? '':'collapsed' }}"
                            data-toggle="collapse" data-target="#society-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            <img class="sidebar-icon" src="{{ asset('/img/sidebar/society-details-icon.svg')}}">Society
                                            Details
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </span>
                            </a>
                            <!-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">

                    <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land Detail
                                {{$route}}</span></i></a>
                    </li>
                    <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                        <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                Detail</span></i></a>
                    </li>
                </ul>
            </div> -->
                        </li>
                        <li id="society-actions" class="collapse m-menu__item--level-3 {{ ($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' || $route=='society_detail.create')? 'show':'' }}">
                            <ul class="list-unstyled">
                                <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit' || $route=='society_detail.show_end_date_lease' )?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{url('/society_detail')}}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">List of Societies</span></a>
                                </li>
                                <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.create')}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Add Society</span></a>
                                </li>
                            </ul>
                        </li>

                        @if(\Illuminate\Support\Facades\Request::is('lease_detail/*') ||
                        (strpos($route,'village_detail') !== false) || (strpos($route,'renew-lease') !== false) ||
                        (strpos($route,'architect_layout') !== false) || (strpos($route,'society_detail') !== false) ||
                        $route =='land.dashboard')
                        <li class="m-menu__item m-menu__item--level-2 {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit' || $route=='lease_detail.create')? '' : 'collapsed'}}"
                            data-toggle="collapse" data-target="#lease-actions">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                                <span class="sidebar-icon sidebar-menu-icon--level-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff" d="M85.072 454.931c-1.859-1.861-4.439-2.93-7.069-2.93s-5.21 1.069-7.07 2.93c-1.86 1.861-2.93 4.44-2.93 7.07s1.069 5.21 2.93 7.069c1.86 1.86 4.44 2.931 7.07 2.931s5.21-1.07 7.069-2.931c1.86-1.859 2.931-4.439 2.931-7.069s-1.07-5.21-2.931-7.07zm384.452-271.993a10.054 10.054 0 0 0-7.07-2.93c-2.63 0-5.21 1.069-7.07 2.93-1.859 1.86-2.93 4.44-2.93 7.07s1.07 5.21 2.93 7.069a10.077 10.077 0 0 0 7.07 2.931c2.64 0 5.21-1.07 7.07-2.931 1.869-1.859 2.939-4.439 2.939-7.069s-1.07-5.21-2.939-7.07z"/>
                                        <path fill="#fff" d="M509.065 2.929A10.006 10.006 0 0 0 501.992 0L255.998.013c-5.522 0-9.999 4.478-9.999 10V38.61L151.21 64.009c-5.335 1.43-8.501 6.913-7.071 12.247l49.127 183.342-42.499 42.499c-5.409-7.898-14.491-13.092-24.764-13.092H30.006c-16.542 0-29.999 13.458-29.999 29.999V482c0 16.542 13.457 30 29.999 30h95.998c14.053 0 25.875-9.716 29.115-22.78l11.89 10.369a50.382 50.382 0 0 0 33.118 12.412h301.867c5.522 0 10-4.478 10-10V10a10.01 10.01 0 0 0-2.929-7.071zM136.002 482.001c0 5.513-4.486 10-10 10H30.005c-5.514 0-10-4.486-10-10V319.005c0-5.514 4.486-10 10-10h37.999V424.2c0 5.522 4.478 10 10 10s10-4.478 10-10V309.005h37.999c5.514 0 10 4.486 10 10v162.996zm30.043-401.262l79.954-21.424V96.37l-6.702 1.796a9.997 9.997 0 0 0-7.071 12.247c3.843 14.341-4.698 29.134-19.039 32.977a9.998 9.998 0 0 0-7.066 12.267L245.1 299.995h-20.07l-10.343-40.464a9.985 9.985 0 0 0-1.676-3.507L166.045 80.739zm79.954 61.49v84.381l-18.239-67.535c7.619-3.934 13.854-9.82 18.239-16.846zM389.663 492H200.125a30.388 30.388 0 0 1-19.974-7.485l-24.149-21.061V325.147l43.658-43.658 7.918 30.98a10 10 0 0 0 9.688 7.523l196.604.012c7.72 0 14 6.28 14 14s-6.28 14-14 14H313.13c-5.522 0-10 4.478-10 10s4.478 10 10 10h132.04c7.72 0 14 6.28 14 14s-6.28 14-14 14H313.13c-5.522 0-10 4.478-10 10s4.478 10 10 10h110.643c7.72 0 14 6.28 14 14s-6.28 14-14 14H313.13c-5.522 0-10 4.478-10 10s4.478 10 10 10h76.533c7.72 0 14 6.28 14 14-.001 7.716-6.281 13.996-14 13.996zm102.331 0h-71.36c1.939-4.273 3.028-9.01 3.028-14s-1.089-9.727-3.028-14h3.139c18.747 0 33.999-15.252 33.999-33.999a33.778 33.778 0 0 0-3.609-15.217c14.396-3.954 25.005-17.149 25.005-32.782a33.816 33.816 0 0 0-6.711-20.255v-126.74c0-5.522-4.478-10-10-10s-10 4.478-10 10v113.792a34.008 34.008 0 0 0-7.289-.795h-.328a33.79 33.79 0 0 0 3.028-14c0-18.748-15.252-33.999-33.999-33.999h-16.075c17.069-7.32 29.057-24.286 29.057-44.005 0-26.389-21.468-47.858-47.857-47.858-26.388 0-47.857 21.469-47.857 47.858 0 19.719 11.989 36.685 29.057 44.005h-54.663V109.863c17.864-3.893 31.96-17.988 35.852-35.853h75.221c3.892 17.865 17.988 31.96 35.852 35.853v31.09c0 5.522 4.478 10 10 10s10-4.478 10-10v-40.018c0-5.522-4.478-10-10-10-14.847 0-26.924-12.079-26.924-26.925 0-5.522-4.478-10-10-10h-93.076c-5.522 0-10 4.478-10 10 0 14.847-12.078 26.925-26.924 26.925-5.522 0-10 4.478-10 10v199.069H266V20.011L491.994 20v472zM378.996 283.858c-15.361 0-27.857-12.497-27.857-27.857s12.497-27.858 27.857-27.858S406.853 240.64 406.853 256s-12.496 27.858-27.857 27.858z"/>
                                    </svg>
                                </span>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Lease Details
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endif
                        <li id="lease-actions" class="collapse m-menu__item--level-3 {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit' || $route=='lease_detail.create' || strpos($route,'renew-lease') !== false)? 'show' : ''}}">
                            <ul class="list-unstyled">


                                {{--@if(\Illuminate\Support\Facades\Request::is('village_detail')--}}
                                {{--|| \Illuminate\Support\Facades\Request::is('village_detail/*'))--}}
                                {{--@endif--}}

                                {{--@if(\Illuminate\Support\Facades\Request::is('society_detail')--}}
                                {{--|| \Illuminate\Support\Facades\Request::is('society_detail/*'))--}}
                                {{--@endif--}}
                                {{--@php dd($route); @endphp--}}
                                @if((strpos($route,'village_detail') !== false)
                                || (strpos($route,'lease_detail') !== false)
                                || (strpos($route,'society_detail') !== false)
                                || (strpos($route,'architect_layout') !== false)
                                || (strpos($route,'renew-lease') !== false)
                                || (strpos($route,'view-lease') !== false)
                                || (strpos($route,'edit-lease') !== false)
                                || ($route == 'land.dashboard')
                                )

                                @php
                                    if((strpos($route,'village_detail') !== false) || (strpos($route,'society_detail') !==
                                    false) || (strpos($route,'architect_layouts') !== false) || ($route == 'land.dashboard') || (strpos($route,'lease.index') !== false)){
                                    $id = '0' ;
                                    }else{

                                    if(collect(request()->segments())->last() == 'architect_layouts'){
                                    $id = collect(request()->segments())->last();
                                    }else{
                                    $id = decrypt(collect(request()->segments())->last());
                                    }
                                    }
                                @endphp
                                <li class="m-menu__item m-menu__item--submenu {{ ($route=='lease_detail.index' || (strpos($route,'view-lease') !== false) || $route=='edit-lease.edit')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{ route('lease_detail.index', encrypt($id))}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">List of Lease</span></a>
                                </li>

                                @if((strpos($route,'lease_detail') !== false)|| (strpos($route,'renew-lease') !==
                                false) || (strpos($route,'view-lease') !== false) || (strpos($route,'edit-lease') !==
                                false))
                                @if(isset($count) && ($count==0) && ($id != 0) || ($route=='lease_detail.create'))
                                <li class="m-menu__item m-menu__item--submenu {{($route=='lease_detail.create')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.create', encrypt($id))}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Add Lease</span></a>
                                </li>
                                @endif
                                @if(isset($count) && ($count != 0) && ($id != 0))
                                <li class="m-menu__item m-menu__item--submenu {{($route=='renew-lease.renew')?'m-menu__item--active':''}}">
                                    <a class="m-menu__link m-menu__toggle" href="{{route('renew-lease.renew', encrypt($id))}}"
                                        class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">Renew Lease</span></a>
                                </li>
                                @endif
                                @endif
                                @endif


                            </ul>
                        </li>
                    </ul>
                </li>
                @endif

                @if(session()->get('permission') && (in_array('architect_layout.index', session()->get('permission'))
                ||
                in_array('architect_layouts_layout_details.index',
                session()->get('permission')) || in_array('architect_layout_details.view',
                session()->get('permission'))
                ||
                in_array('forward_architect_layout', session()->get('permission')) ||
                in_array('architect_layout_get_scrtiny',
                session()->get('permission')) || in_array('architect_layout_add_scrutiny_report',
                session()->get('permission')) ||
                in_array('architect_layout_detail_view_cts_plan', session()->get('permission')) ||
                in_array('architect_layout_detail_view_prc_detail', session()->get('permission')) ||
                in_array('architect_detail_dp_crz_remark_view', session()->get('permission')) ||
                in_array('view_court_case_or_dispute_on_land', session()->get('permission')) ||
                in_array('architect_layout_add_scrutiny_report', session()->get('permission')) ))

                <li class="m-menu__item {{($route=='architect_layout.index' || $route=='architect_layouts_layout_details.index' || $route=='architect_layout.add')?'':'collapsed'}}"
                    data-toggle="collapse" data-target="#architect-layouts">
                    <a href="{{ route('architect_layout.index') }}" class="m-menu__link m-menu__toggle">
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    <img class="sidebar-icon" src="{{ asset('/img/sidebar/architect-layouts-icon.svg')}}">Architect
                                    Layouts
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>

                <li id="architect-layouts" class="collapse {{($route=='architect_layout.index'|| $route=='architect_layouts_layout_details.index' || $route=='architect_layout.add')?'show':''}}">
                    <ul class="list-unstyled">
                        @if(session()->get('role_name')=='junior_architect')
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layout.add')?'m-menu__item--active':''}}"
                            aria-haspopup="true">
                            <a href="{{ route('architect_layout.add') }}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Add Layout
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @endif
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layout.index' || $route=='architect_layouts_layout_details.index')?'m-menu__item--active':''}}"
                            aria-haspopup="true">
                            <a href="{{ route('architect_layout.index') }}" class="m-menu__link m-menu__toggle">
                            <span class="sidebar-icon">
                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496.941 496.941">
                                  <g fill="#fff">
                                    <path d="M475.299 106.918l-12.047-3.765c-3.012-.753-6.024-1.506-9.788-1.506-13.553 0-25.6 9.035-30.118 21.835l-6.776 20.329V128c0-2.259-1.506-4.518-3.012-6.024L290.076 2.259C288.57.753 286.311 0 284.805 0H43.111c-4.518 0-7.529 3.012-7.529 7.529V30.87H7.723c-4.518 0-7.529 3.012-7.529 7.529v451.012c0 4.518 3.012 7.529 7.529 7.529h365.929c4.518 0 7.529-3.012 7.529-7.529V466.07h27.859c4.518 0 7.529-3.012 7.529-7.529V356.894l21.082-28.612.753-2.259 56.471-179.953c6.024-16.564-3.011-33.882-19.576-39.152zM292.334 25.6l98.635 94.871h-98.635V25.6zm73.789 456.282H15.252V45.929h20.329v412.612c0 4.518 3.012 7.529 7.529 7.529h323.012v15.812zm36.141-30.87H50.64V15.059h226.635V128c0 4.518 3.012 7.529 7.529 7.529h117.459V192l-35.388 111.435v2.259l1.506 95.624c0 3.012 2.259 6.024 5.271 6.776 3.012.753 6.776 0 8.282-3.012l20.329-27.106v73.036zm-19.577-73.036l-1.506-62.494 37.647 12.047-36.141 50.447zm98.636-236.423l-54.212 172.424-43.671-14.306L437.652 128c3.012-8.282 12.047-13.553 20.329-10.541l12.047 3.765c9.036 2.258 14.306 12.047 11.295 20.329z"/>
                                    <path d="M101.84 135.529h108.424c4.518 0 7.529-3.012 7.529-7.529V51.2c0-4.518-3.012-7.529-7.529-7.529H101.84c-4.518 0-7.529 3.012-7.529 7.529V128c0 3.765 3.765 7.529 7.529 7.529zm7.53-76.8h93.365v61.741H109.37V58.729zM86.782 206.306h228.894c4.518 0 7.529-3.012 7.529-7.529 0-4.518-3.012-7.529-7.529-7.529H86.782c-4.518 0-7.529 3.012-7.529 7.529-.001 4.517 3.011 7.529 7.529 7.529zM86.782 261.271h228.894c4.518 0 7.529-3.012 7.529-7.529s-3.012-7.529-7.529-7.529H86.782c-4.518 0-7.529 3.012-7.529 7.529s3.011 7.529 7.529 7.529zM86.782 316.235h228.894c4.518 0 7.529-3.012 7.529-7.529s-3.012-7.529-7.529-7.529H86.782c-4.518 0-7.529 3.012-7.529 7.529s3.011 7.529 7.529 7.529zM322.452 363.671c0-4.518-3.012-7.529-7.529-7.529H86.782c-4.518 0-7.529 3.012-7.529 7.529s3.012 7.529 7.529 7.529h228.894c3.764 0 6.776-3.765 6.776-7.529zM347.299 411.106H233.605c-4.518 0-7.529 3.012-7.529 7.529s3.012 7.529 7.529 7.529h112.941c4.518 0 7.529-3.012 7.529-7.529s-3.011-7.529-6.776-7.529z"/>
                                  </g>
                               </svg>
                            </span>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Layouts & Revision Requests
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        {{-- <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='architect_layouts_layout_details.index')?'m-menu__item--active':''}}"
                            aria-haspopup="true">
                            <a href="{{ route('architect_layouts_layout_details.index') }}" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Layout Details
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                @endif


                <!-- Tabs for Estate and Conveyance -->
                @if(session()->get('permission') && (( in_array('conveyance.index', session()->get('permission')) ||
                in_array('renewal.index', session()->get('permission')) || in_array('get_sf_applications.index',
                session()->get('permission')) ) ))
                <li class="m-menu__item {{($route=='conveyance.index' || $route=='renewal.index' || $route=='get_sf_applications.index')?'':'collapsed'}}"
                    data-toggle="collapse" data-target="#estate-actions">
                    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                    <span class="sidebar-icon sidebar-menu-icon--level-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <g fill="#fff">
                                <path d="M503.467 494.933h-34.661a66.43 66.43 0 0 0 .528-8.533c0-24.086-13.861-44.588-34.133-54.082V145.067c0-5.12-3.413-8.533-8.533-8.533h-128v-128c0-5.12-3.413-8.533-8.533-8.533h-230.4C54.613 0 51.2 3.413 51.2 8.533v486.4H8.533c-5.12 0-8.533 3.413-8.533 8.533S3.413 512 8.533 512H503.467c5.12 0 8.533-3.413 8.533-8.533s-3.413-8.534-8.533-8.534zm-85.334-67.664a61.623 61.623 0 0 0-8.533-.603 57.633 57.633 0 0 0-18.731 3.148c-1.487-1.982-3.884-3.148-6.869-3.148-5.12 0-8.533 3.413-8.533 8.533v2.615a59.762 59.762 0 0 0-8.97 7.943c-.431.456-.855.918-1.27 1.388-7.071-8.839-16.179-15.233-26.477-18.346-1.479-1.357-3.518-2.134-5.95-2.134-.951 0-1.843.119-2.666.344a50.562 50.562 0 0 0-5.867-.344c-5.348 0-11.37.694-16.249 2.675-.604.204-1.204.414-1.798.639-5.897-4.794-12.794-8.245-20.062-10.144-.077-.021-.156-.036-.232-.057a52.418 52.418 0 0 0-1.909-.457 50.919 50.919 0 0 0-1.565-.311c-.227-.042-.454-.087-.682-.126a49.98 49.98 0 0 0-2.4-.353 48.26 48.26 0 0 0-1.534-.169c-.375-.035-.751-.061-1.127-.088-.402-.028-.803-.061-1.208-.08a50.66 50.66 0 0 0-2.434-.063c-.628 0-1.251.013-1.871.036-.406.014-.811.039-1.216.062-.162.01-.326.017-.488.028-7.774.516-15.412 2.71-22.026 6.596V153.6h170.667v273.669zM68.267 17.067H281.6v119.467h-42.667c-5.12 0-8.533 3.413-8.533 8.533v265.387a61.815 61.815 0 0 0-14.861-10.937 57.506 57.506 0 0 0-1.461-.752c-.193-.095-.384-.194-.578-.287a59.076 59.076 0 0 0-19.642-5.617l-.293-.028a58.788 58.788 0 0 0-2.424-.19c-.215-.013-.43-.026-.646-.037a58.92 58.92 0 0 0-2.762-.072c-12.7 0-24.466 4.177-34.133 11.197v-2.663c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 1.28.213 2.453.613 3.493a61.518 61.518 0 0 0-8.293 22.961 57.96 57.96 0 0 0-26.453 9.943v-2.263c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 .996.133 1.925.379 2.779a59.514 59.514 0 0 0-8.296 22.82h-9.149V17.067zm64.383 443.91c.169-.015.34-.025.51-.038.45-.035.9-.069 1.354-.09a45.05 45.05 0 0 1 2.02-.05c5.12 0 8.533-3.413 8.533-8.533 0-23.893 18.773-42.667 42.667-42.667 21.333 0 39.253 15.36 41.813 36.693a9.253 9.253 0 0 0 3.821 5.474c.118.083.239.161.362.238.132.081.263.163.4.237a8.827 8.827 0 0 0 1.023.486 9.491 9.491 0 0 0 1.222.393c.508.169 1.085.234 1.695.215 2.805.041 5.414-1.493 6.837-3.626l.002-.002.853-.853c6.827-8.533 16.213-13.653 27.307-13.653 5.762 0 11.521 1.614 16.69 4.632-10.179 9.571-15.951 22.048-16.622 35.398a51.246 51.246 0 0 0-.068 2.637c0 5.934.987 11.621 2.94 17.067H94.72c3.994-18.373 19.204-32.257 37.93-33.958zm163.504 33.956c-3.26-5.514-5.167-12.033-5.167-17.92 0-9.436 3.72-17.937 10.114-24.151a34.545 34.545 0 0 1 3.901-3.126 8.57 8.57 0 0 0 3.905-.883c18.773-10.24 40.96-.853 47.787 17.92.853 2.56 3.413 5.12 7.68 5.12.81 0 1.706-.258 2.606-.716 2.141-.351 3.834-1.923 5.074-4.404 3.307-7.027 8.427-12.637 14.659-16.57 1.345-.375 2.5-1.039 3.419-1.94 5.861-2.946 12.505-4.53 19.469-4.53 23.893 0 42.667 18.773 42.667 42.667 0 2.56 0 5.973-.853 8.533H296.154z"/>
                                <path d="M281.6 221.867c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533zM281.6 375.467c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533zM281.6 273.067c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533zM281.6 324.267c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533zM281.6 170.667c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533zM332.8 256c5.12 0 8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 204.8c5.12 0 8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 307.2c5.12 0 8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 358.4c5.12 0 8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 409.6c5.12 0 8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 307.2c5.12 0 8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 256c5.12 0 8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 409.6c5.12 0 8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 358.4c5.12 0 8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 204.8c5.12 0 8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM93.867 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 426.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM247.467 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM247.467 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533z"/>
                            </g>
                        </svg>
                    </span>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Estate & Conveyance
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>

                <li id="estate-actions" class="collapse {{($route=='conveyance.index' || $route=='renewal.index' || $route=='get_sf_applications.index')? 'show' : ''}}">
                    <ul class="list-unstyled">
                        @if(session()->get('permission') && (in_array('conveyance.index', session()->get('permission'))
                        ))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='conveyance.index') ? 'm-menu__item--active' : '' }}">
                            <a href="{{ route('conveyance.index') }}" class="m-menu__link m-menu__toggle">
                            <span class="sidebar-icon sidebar-menu-icon--level-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                  <g fill="#fff">
                                    <path d="M503.467 494.933h-34.661a66.43 66.43 0 0 0 .528-8.533c0-24.086-13.861-44.588-34.133-54.082V145.067c0-5.12-3.413-8.533-8.533-8.533h-128v-128c0-5.12-3.413-8.533-8.533-8.533h-230.4C54.613 0 51.2 3.413 51.2 8.533v486.4H8.533c-5.12 0-8.533 3.413-8.533 8.533S3.413 512 8.533 512H503.467c5.12 0 8.533-3.413 8.533-8.533s-3.413-8.534-8.533-8.534zm-85.334-67.664a61.623 61.623 0 0 0-8.533-.603 57.633 57.633 0 0 0-18.731 3.148c-1.487-1.982-3.884-3.148-6.869-3.148-5.12 0-8.533 3.413-8.533 8.533v2.615a59.762 59.762 0 0 0-8.97 7.943c-.431.456-.855.918-1.27 1.388-7.071-8.839-16.179-15.233-26.477-18.346-1.479-1.357-3.518-2.134-5.95-2.134-.951 0-1.843.119-2.666.344a50.562 50.562 0 0 0-5.867-.344c-5.348 0-11.37.694-16.249 2.675-.604.204-1.204.414-1.798.639-5.897-4.794-12.794-8.245-20.062-10.144-.077-.021-.156-.036-.232-.057a52.418 52.418 0 0 0-1.909-.457 50.919 50.919 0 0 0-1.565-.311c-.227-.042-.454-.087-.682-.126a49.98 49.98 0 0 0-2.4-.353 48.26 48.26 0 0 0-1.534-.169c-.375-.035-.751-.061-1.127-.088-.402-.028-.803-.061-1.208-.08a50.66 50.66 0 0 0-2.434-.063c-.628 0-1.251.013-1.871.036-.406.014-.811.039-1.216.062-.162.01-.326.017-.488.028-7.774.516-15.412 2.71-22.026 6.596V153.6h170.667v273.669zM68.267 17.067H281.6v119.467h-42.667c-5.12 0-8.533 3.413-8.533 8.533v265.387a61.815 61.815 0 0 0-14.861-10.937 57.506 57.506 0 0 0-1.461-.752c-.193-.095-.384-.194-.578-.287a59.076 59.076 0 0 0-19.642-5.617l-.293-.028a58.788 58.788 0 0 0-2.424-.19c-.215-.013-.43-.026-.646-.037a58.92 58.92 0 0 0-2.762-.072c-12.7 0-24.466 4.177-34.133 11.197v-2.663c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 1.28.213 2.453.613 3.493a61.518 61.518 0 0 0-8.293 22.961 57.96 57.96 0 0 0-26.453 9.943v-2.263c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 .996.133 1.925.379 2.779a59.514 59.514 0 0 0-8.296 22.82h-9.149V17.067zm64.383 443.91c.169-.015.34-.025.51-.038.45-.035.9-.069 1.354-.09a45.05 45.05 0 0 1 2.02-.05c5.12 0 8.533-3.413 8.533-8.533 0-23.893 18.773-42.667 42.667-42.667 21.333 0 39.253 15.36 41.813 36.693a9.253 9.253 0 0 0 3.821 5.474c.118.083.239.161.362.238.132.081.263.163.4.237a8.827 8.827 0 0 0 1.023.486 9.491 9.491 0 0 0 1.222.393c.508.169 1.085.234 1.695.215 2.805.041 5.414-1.493 6.837-3.626l.002-.002.853-.853c6.827-8.533 16.213-13.653 27.307-13.653 5.762 0 11.521 1.614 16.69 4.632-10.179 9.571-15.951 22.048-16.622 35.398a51.246 51.246 0 0 0-.068 2.637c0 5.934.987 11.621 2.94 17.067H94.72c3.994-18.373 19.204-32.257 37.93-33.958zm163.504 33.956c-3.26-5.514-5.167-12.033-5.167-17.92 0-9.436 3.72-17.937 10.114-24.151a34.545 34.545 0 0 1 3.901-3.126 8.57 8.57 0 0 0 3.905-.883c18.773-10.24 40.96-.853 47.787 17.92.853 2.56 3.413 5.12 7.68 5.12.81 0 1.706-.258 2.606-.716 2.141-.351 3.834-1.923 5.074-4.404 3.307-7.027 8.427-12.637 14.659-16.57 1.345-.375 2.5-1.039 3.419-1.94 5.861-2.946 12.505-4.53 19.469-4.53 23.893 0 42.667 18.773 42.667 42.667 0 2.56 0 5.973-.853 8.533H296.154z"/>
                                    <path d="M281.6 221.867c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533zM281.6 375.467c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533zM281.6 273.067c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533zM281.6 324.267c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533zM281.6 170.667c-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533s8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533zM332.8 256c5.12 0 8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 204.8c5.12 0 8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 307.2c5.12 0 8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 358.4c5.12 0 8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM332.8 409.6c5.12 0 8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 307.2c5.12 0 8.533-3.413 8.533-8.533V281.6c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 256c5.12 0 8.533-3.413 8.533-8.533V230.4c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 409.6c5.12 0 8.533-3.413 8.533-8.533V384c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 358.4c5.12 0 8.533-3.413 8.533-8.533V332.8c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM384 204.8c5.12 0 8.533-3.413 8.533-8.533V179.2c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c0 5.12 3.413 8.533 8.533 8.533zM93.867 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 426.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM93.867 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM145.067 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533-5.12 0-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 170.667c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 375.467c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 324.267c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 273.067c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM196.267 221.867c5.12 0 8.533-3.413 8.533-8.533v-17.067c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM247.467 119.467c5.12 0 8.533-3.413 8.533-8.533V93.867c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533zM247.467 68.267c5.12 0 8.533-3.413 8.533-8.533V42.667c0-5.12-3.413-8.533-8.533-8.533s-8.533 3.413-8.533 8.533v17.067c-.001 5.119 3.413 8.533 8.533 8.533z"/>
                                  </g>
                                </svg>
                            </span>    
                                <span class="m-menu__link-text">
                                    Society Conveyance Applications
                                </span>
                            </a>
                        </li>
                        @endif

                        @if(session()->get('permission') && (in_array('renewal.index', session()->get('permission')) ))

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='renewal.index') ? 'm-menu__item--active' : '' }}">
                            <a href="{{ route('renewal.index') }}" class="m-menu__link m-menu__toggle">
                                <span class="sidebar-icon sidebar-menu-icon--level-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                                      <path d="M360.605 252.558a14.982 14.982 0 0 0-9.858-10.781l-73.594-24.536 52.266-104.531c3.281-6.577 1.318-14.575-4.644-18.882-5.991-4.292-14.194-3.647-19.38 1.567l-150 150a15.015 15.015 0 0 0-3.999 14.048 14.982 14.982 0 0 0 9.858 10.781l73.594 24.536-52.266 104.531c-3.281 6.577-1.318 14.575 4.644 18.882 5.971 4.279 14.158 3.653 19.38-1.567l150-150a15.015 15.015 0 0 0 3.999-14.048z"/>
                                      <path d="M256 0C179.87 0 107.961 35.406 60 92.529V76c0-8.291-6.709-15-15-15s-15 6.709-15 15v63.721c0 14.315 18.49 16.364 15 15 .308 0 .615-.015.923-.029l60-3.721c8.276-.513 14.561-7.632 14.048-15.894-.513-8.262-7.734-14.487-15.894-14.048l-30.394 1.89C115.783 65.651 183.9 30 256 30c124.072 0 226 101.928 226 226 0 8.291 6.709 15 15 15s15-6.709 15-15C512 115.39 396.61 0 256 0zM466.077 357.308l-60 3.721c-8.276.513-14.561 7.632-14.048 15.894s7.896 14.561 15.894 14.048l30.394-1.89C396.217 446.349 328.1 482 256 482 131.928 482 30 380.072 30 256c0-8.291-6.709-15-15-15s-15 6.709-15 15c0 140.61 115.39 256 256 256 76.13 0 148.039-35.406 196-92.529V436c0 8.291 6.709 15 15 15s15-6.709 15-15v-63.721c0-8.24-7.901-15.423-15.923-14.971z"/>
                                    </svg>
                                </span>
                                <span class="m-menu__link-text">
                                    Society Renewal Applications
                                </span>
                            </a>
                        </li>
                        @endif

                        @if(in_array('get_sf_applications.index',session()->get('permission')))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='get_sf_applications.index') ? 'm-menu__item--active' : '' }}">
                            <a href="{{ route('get_sf_applications.index') }}" class="m-menu__link m-menu__toggle">
                                <span class="sidebar-icon sidebar-menu-icon--level-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                                  <path d="M324.267 332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8zM315.733 426.667a8.536 8.536 0 0 0-8.533 8.533v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2c.001-4.71-3.822-8.533-8.533-8.533zM358.4 230.4c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V230.4zM324.267 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM324.267 384c0-4.71-3.823-8.533-8.533-8.533S307.2 379.29 307.2 384v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V384zM358.4 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM290.133 230.4c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V230.4zM324.267 230.4c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V230.4zM358.4 145.067V128c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533zM290.133 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM392.533 128c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V128zM281.6 324.267a8.536 8.536 0 0 0-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8a8.536 8.536 0 0 0-8.533-8.533zM426.667 384c0-4.71-3.823-8.533-8.533-8.533S409.6 379.29 409.6 384v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V384zM418.133 426.667a8.536 8.536 0 0 0-8.533 8.533v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2c.001-4.71-3.822-8.533-8.533-8.533zM452.267 324.267a8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V332.8a8.536 8.536 0 0 0-8.533-8.533z"/>
                                  <path d="M315.733 153.6a8.536 8.536 0 0 0 8.533-8.533v-36.002L409.6 87.731V230.4a8.55 8.55 0 0 0 5.538 7.996l62.729 23.518v87.953c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V256a8.55 8.55 0 0 0-5.538-7.996l-62.729-23.518V59.733c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v10.402l-95.94 23.987a8.528 8.528 0 0 0-6.46 8.277v42.667c0 4.711 3.823 8.534 8.533 8.534z"/>
                                  <path d="M460.8 281.6a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V281.6zM426.667 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM358.4 384c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V384zM426.667 332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8zM349.867 426.667a8.536 8.536 0 0 0-8.533 8.533v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2a8.536 8.536 0 0 0-8.533-8.533zM358.4 332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8z"/>
                                  <path d="M384 477.867a8.536 8.536 0 0 0 8.533-8.533V196.267a8.536 8.536 0 0 0-6.46-8.277L249.54 153.856a8.546 8.546 0 0 0-7.322 1.553 8.518 8.518 0 0 0-3.285 6.724v187.733c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V173.065l119.467 29.867v266.402c.001 4.71 3.824 8.533 8.534 8.533zM187.733 179.2c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V179.2zM187.733 128c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V128zM119.467 384c0-4.71-3.823-8.533-8.533-8.533S102.4 379.29 102.4 384v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V384z"/>
                                  <path d="M42.667 307.2a8.536 8.536 0 0 0 8.533-8.533V256h85.333v213.333a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V247.467a8.536 8.536 0 0 0-8.533-8.533h-102.4a8.536 8.536 0 0 0-8.533 8.533v51.2c0 4.71 3.823 8.533 8.534 8.533zM136.533 179.2v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V179.2a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533zM187.733 76.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V76.8z"/>
                                  <path d="M110.933 426.667a8.536 8.536 0 0 0-8.533 8.533v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2c.001-4.71-3.822-8.533-8.533-8.533z"/>
                                  <path d="M503.467 494.933H486.4v-52.412c14.677-3.814 25.6-17.067 25.6-32.922 0-18.825-15.309-34.133-34.133-34.133s-34.133 15.309-34.133 34.133c0 15.855 10.923 29.107 25.6 32.922v52.412H256v-34.995c19.447-3.968 34.133-21.197 34.133-41.805 0-23.526-19.14-42.667-42.667-42.667-23.526 0-42.667 19.14-42.667 42.667 0 20.608 14.686 37.837 34.133 41.805v34.995H51.2v-86.195c19.447-3.968 34.133-21.197 34.133-41.805 0-23.526-19.14-42.667-42.667-42.667C19.14 324.267 0 343.407 0 366.933c0 20.608 14.686 37.837 34.133 41.805v86.195h-25.6c-4.71 0-8.533 3.823-8.533 8.533S3.823 512 8.533 512h494.933c4.71 0 8.533-3.823 8.533-8.533s-3.822-8.534-8.532-8.534zm-486.4-128c0-14.114 11.486-25.6 25.6-25.6s25.6 11.486 25.6 25.6-11.486 25.6-25.6 25.6-25.6-11.486-25.6-25.6zm204.8 51.2c0-14.114 11.486-25.6 25.6-25.6s25.6 11.486 25.6 25.6-11.486 25.6-25.6 25.6-25.6-11.486-25.6-25.6zM460.8 409.6c0-9.412 7.654-17.067 17.067-17.067s17.067 7.654 17.067 17.067c0 9.412-7.654 17.067-17.067 17.067S460.8 419.012 460.8 409.6z"/>
                                  <path d="M68.267 435.2v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533zM119.467 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM119.467 332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8zM68.267 281.6v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533zM187.733 332.8c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V332.8zM221.867 230.4a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V230.4zM221.867 179.2a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V179.2zM221.867 281.6a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V281.6zM213.333 324.267a8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V332.8c.001-4.71-3.822-8.533-8.533-8.533zM221.867 128a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V128zM187.733 384c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V384z"/>
                                  <path d="M110.933 221.867a8.536 8.536 0 0 0 8.533-8.533V150.34l29.414-14.703a8.542 8.542 0 0 0 4.719-7.637V56.474l42.667-21.333 42.667 21.333V128c0 4.71 3.823 8.533 8.533 8.533S256 132.71 256 128V51.2a8.541 8.541 0 0 0-4.719-7.637L204.8 20.326V8.533c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v11.793l-46.481 23.236a8.542 8.542 0 0 0-4.719 7.637v71.526l-29.414 14.703a8.542 8.542 0 0 0-4.719 7.637v68.267c-.001 4.712 3.822 8.535 8.532 8.535zM187.733 281.6c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V281.6zM179.2 426.667a8.536 8.536 0 0 0-8.533 8.533v34.133c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V435.2a8.536 8.536 0 0 0-8.533-8.533z"/>
                                  <path d="M221.867 76.8a8.536 8.536 0 0 0-8.533-8.533 8.536 8.536 0 0 0-8.533 8.533v17.067a8.536 8.536 0 0 0 8.533 8.533 8.536 8.536 0 0 0 8.533-8.533V76.8zM187.733 230.4c0-4.71-3.823-8.533-8.533-8.533s-8.533 3.823-8.533 8.533v17.067c0 4.71 3.823 8.533 8.533 8.533s8.533-3.823 8.533-8.533V230.4z"/>
                                </svg>

                                </span>
                                <span class="m-menu__link-text">
                                    Society Formation Applications
                                </span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                <!-- end of Estate of Conveyance -->


                @if(isset($route) && (in_array('ree_applications.index', session()->get('permission')) ||
                in_array('ee.index', session()->get('permission')) ||
                in_array('dyce.index', session()->get('permission')) ||
                in_array('co.index', session()->get('permission')) ||
                in_array('vp.index', session()->get('permission')) ||
                in_array('ree_applications.reval', session()->get('permission')) ||
                in_array('co_applications.reval', session()->get('permission')) ||
                in_array('vp_applications.reval', session()->get('permission')) ||
                in_array('cap_applications.reval', session()->get('permission')) ||
                in_array('ree_applications.noc', session()->get('permission'))||
                in_array('co_applications.noc', session()->get('permission')) ||
                in_array('ree_applications.noc_cc', session()->get('permission'))||
                in_array('co_applications.noc_cc', session()->get('permission')) ||
                in_array('tripartite.index', session()->get('permission'))
                ) ||
                in_array('ree_applications.consent_oc', session()->get('permission')) || (Session::all()['role_name'] == 'EM'))
                <li class="m-menu__item {{( $route=='co_applications.noc_cc' || $route=='ree_applications.noc_cc' || $route=='co_applications.noc' || $route=='ree_applications.noc' || $route=='cap_applications.reval' || $route=='vp_applications.reval' || $route=='co_applications.reval' || $route=='ree_applications.reval' || $route=='ree_applications.index' || $route=='ee.index' || $route=='dyce.index' || $route=='co.index' || $route=='vp.index' || $route=='ee.consent_for_oc' || $route == 'em.consent_for_oc' || $route == 'ree_applications.consent_oc')?'':'collapsed'}}" data-toggle="collapse" data-target="#society-actions">
                    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                    <span class="sidebar-icon sidebar-menu-icon--level-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.001 512.001" fill="#fff">
                            <path d="M37.07 309.64c-1.859-1.86-4.439-2.93-7.069-2.93s-5.21 1.07-7.07 2.93-2.93 4.43-2.93 7.07c0 2.63 1.069 5.21 2.93 7.07 1.86 1.859 4.44 2.93 7.07 2.93s5.21-1.07 7.069-2.93c1.86-1.87 2.931-4.44 2.931-7.07s-1.07-5.21-2.931-7.07zM57.072 76.928l-20-20c-3.906-3.904-10.236-3.904-14.143 0l-20 20c-3.905 3.905-3.905 10.237 0 14.143 3.906 3.904 10.236 3.904 14.143 0l2.929-2.928v188.245c0 5.522 4.478 10 10 10s10-4.478 10-10V88.143l2.929 2.929C44.883 93.023 47.442 94 50.001 94s5.118-.977 7.071-2.929c3.905-3.905 3.905-10.237 0-14.143zM509.073 420.929l-20-20c-3.906-3.904-10.236-3.904-14.143 0-3.905 3.905-3.905 10.237 0 14.143l2.929 2.929h-35.888V277.667c0-5.522-4.478-10-10-10s-10 4.478-10 10V418H313.606v-64c0-5.522-4.478-10-10-10s-10 4.478-10 10v64h-83.13V257.525c0-5.522-4.478-10-10-10s-10 4.478-10 10V418h-80.29v-62.5c0-5.522-4.478-10-10-10s-10 4.478-10 10V418H40.001v-57.555c0-5.522-4.478-10-10-10s-10 4.478-10 10V428c0 5.522 4.478 10 10 10h447.857l-2.929 2.929c-3.905 3.905-3.905 10.237 0 14.143 1.953 1.952 4.512 2.929 7.071 2.929s5.118-.977 7.071-2.929l20-20c3.907-3.906 3.907-10.238.002-14.143z"/>
                            <path d="M431.969 131.476c-19.91 0-36.107 16.197-36.107 36.107 0 5.71 1.338 11.113 3.708 15.918l-78.304 78.304a35.875 35.875 0 0 0-17.662-4.632c-6.27 0-12.17 1.609-17.314 4.431l-52.962-52.962a35.88 35.88 0 0 0 3.253-14.951c0-19.91-16.197-36.108-36.107-36.108s-36.108 16.198-36.108 36.108a35.872 35.872 0 0 0 4.264 17.001l-51.027 51.027a35.882 35.882 0 0 0-17.419-4.492c-19.91 0-36.107 16.197-36.107 36.107s16.199 36.107 36.109 36.107 36.108-16.197 36.108-36.107a35.878 35.878 0 0 0-4.532-17.488l50.816-50.816a35.873 35.873 0 0 0 17.897 4.768 35.887 35.887 0 0 0 19.794-5.931l51.82 51.82a35.87 35.87 0 0 0-4.592 17.593c0 19.91 16.197 36.108 36.107 36.108s36.107-16.198 36.107-36.108a35.883 35.883 0 0 0-4.392-17.244l77.721-77.721a35.883 35.883 0 0 0 18.929 5.376c19.91 0 36.107-16.198 36.107-36.108 0-19.91-16.197-36.107-36.107-36.107zM100.187 309.442c-8.881 0-16.107-7.226-16.107-16.107s7.224-16.108 16.106-16.108c4.351 0 8.298 1.741 11.2 4.555.049.051.092.107.142.157.059.059.124.109.185.167 2.83 2.904 4.582 6.863 4.582 11.229 0 8.882-7.227 16.107-16.108 16.107zm100.289-99.645c-8.881 0-16.108-7.226-16.108-16.107s7.226-16.108 16.108-16.108c8.882 0 16.107 7.227 16.107 16.108s-7.226 16.107-16.107 16.107zm103.13 99.59c-8.881 0-16.107-7.227-16.107-16.108s7.226-16.107 16.107-16.107 16.107 7.225 16.107 16.107-7.226 16.108-16.107 16.108zM431.971 183.69c-8.881 0-16.107-7.227-16.107-16.108s7.225-16.107 16.107-16.107 16.107 7.226 16.107 16.107-7.226 16.108-16.107 16.108z"/>
                            <path d="M439.041 228.93c-1.86-1.86-4.44-2.93-7.07-2.93s-5.21 1.069-7.07 2.93c-1.859 1.86-2.93 4.44-2.93 7.07s1.07 5.21 2.93 7.069c1.86 1.86 4.44 2.931 7.07 2.931s5.21-1.07 7.07-2.931c1.859-1.859 2.93-4.439 2.93-7.069s-1.07-5.21-2.93-7.07z"/>
                        </svg>
                    </span>
                         <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Redevelopement
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>
                
                <li id="society-actions" class="collapse {{($route=='tripartite.index' || $route=='co_applications.noc_cc' || $route=='ree_applications.noc_cc' || $route=='co_applications.noc' || $route=='ree_applications.noc' || $route=='cap_applications.reval' || $route=='vp_applications.reval' || $route=='co_applications.reval' || $route=='ree_applications.reval' || $route=='ree_applications.index' || $route=='ee.index' || $route=='dyce.index' || $route=='co.index' || $route=='vp.index' || $route=='ee.consent_for_oc' || $route=='em.consent_for_oc' || $route == 'ree_applications.consent_oc')?'show':''}}">
                    <ul class="list-unstyled">
                    @if (isset($route) && (in_array('ree_applications.index', session()->get('permission')) ||
                    in_array('ee.index', session()->get('permission')) ||
                    in_array('dyce.index', session()->get('permission')) ||
                    in_array('co.index', session()->get('permission')) ||
                    in_array('cap.index', session()->get('permission')) ||
                    in_array('vp.index', session()->get('permission')) ||
                    in_array('tripartite.index', session()->get('permission')) ||
                    in_array('ree_applications.noc_cc', session()->get('permission'))||
                    in_array('co_applications.noc_cc', session()->get('permission'))
                    ))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2  {{( $route=='ee.index' || $route=='dyce.index' || $route=='ree_applications.index' || $route=='co.index' || $route=='cap.index' || $route=='vp.index' || $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' || $route=='documents_uploaded' || $route=='documents_upload')?'m-menu__item--active':''}}">
                            <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"--}}
                                    {{--viewBox="0 0 510 510">--}}
                                    {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                                        {{--fill="#FFF" />--}}
                                {{--</svg>--}}
                                <span class="sidebar-icon sidebar-menu-icon--level-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff">
                                        <path d="M494.2 488V187c0-3.1-3.9-7-7.7-9.9L407.8 120V56.9c0-6.2-5.2-10.4-10.4-10.4h-89.7L262 13.2c-3.1-2.1-8.3-2.1-11.5 0l-45.7 33.3h-89.7c-6.2 0-10.4 5.2-10.4 10.4v62.4L25 177.2c-4.7 2.9-7.7 6.7-7.7 9.9v303c0 5.9 4.7 10 9.6 10.4h456.8c6.7-.1 10.5-5.3 10.5-12.5zm-19.8-282.3v263.6L302.3 331.5l172.1-125.8zm-7.7-18.3l-58.9 42.9v-86.2l58.9 43.3zM255.8 32.9l18.3 13.5h-36.7l18.4-13.5zM387 67.3v178.2l-131.2 95.6-131.2-95.6V67.3H387zM37.2 205.7l172.1 125.8L37.2 470.1V205.7zm67.6 25.4l-60.4-44 60.4-43.9v87.9zM55.9 480.6L226 343.7l23.5 17.2c4.5 3.4 7.9 3.4 12.5 0l23.5-17.2 171.1 136.9H55.9z"/>
                                        <path d="M186.1 118.3h140.5v19.8H186.1zM186.1 181.8h140.5v19.8H186.1zM186.1 245.3h140.5v19.8H186.1z"/>
                                    </svg>
                                </span>
                                <span class="m-menu__link-text">
                                    Offer Letter
                                </span>
                            </a>
                        </li>
                        @endif


                        @if (isset($route) && (in_array('ree_applications.reval', session()->get('permission')) ||
                        in_array('co_applications.reval', session()->get('permission')) ||
                        in_array('vp_applications.reval', session()->get('permission')) ||
                        in_array('cap_applications.reval', session()->get('permission'))
                        ))
                        @php
                        $reval_redirect_to = "";
                        if(Session::all()['role_name'] == config('commanConfig.ree_junior') || Session::all()['role_name'] == config('commanConfig.ree_deputy_engineer') || Session::all()['role_name'] == config('commanConfig.ree_assistant_engineer') ||
                        Session::all()['role_name'] == config('commanConfig.ree_branch_head'))
                        $reval_redirect_to = "ree_applications.reval";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                        $reval_redirect_to = "co_applications.reval";
                        elseif(Session::all()['role_name'] == 'cap_engineer' )
                        $reval_redirect_to = "cap_applications.reval";
                        elseif(Session::all()['role_name'] == 'vp_engineer' )
                        $reval_redirect_to = "vp_applications.reval";
                        @endphp
                        @if($reval_redirect_to != "")

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$reval_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($reval_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Revalidation Of Offer Letter
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif
                        @if (isset($route) && in_array('tripartite.index', session()->get('permission')))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='tripartite.index')?'m-menu__item--active':'' }}">
                            <a href="{{ route('tripartite.index') }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Tripartite
                                </span>
                            </a>
                        </li>
                        @endif

                        @if (isset($route) && (in_array('ree_applications.noc', session()->get('permission'))||
                        in_array('co_applications.noc', session()->get('permission'))
                        ))
                        @php
                        $reval_redirect_to = "";

                        if(Session::all()['role_name'] == config('commanConfig.ree_junior') || Session::all()['role_name'] == config('commanConfig.ree_deputy_engineer') || Session::all()['role_name'] == config('commanConfig.ree_assistant_engineer') ||
                        Session::all()['role_name'] == config('commanConfig.ree_branch_head'))
                        $reval_redirect_to = "ree_applications.noc";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                        $reval_redirect_to = "co_applications.noc";
                        @endphp
                        @if($reval_redirect_to != "")
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$reval_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($reval_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Noc
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif
                        @if (isset($route) && (in_array('ree_applications.noc_cc', session()->get('permission'))||
                        in_array('co_applications.noc_cc', session()->get('permission'))
                        ))
                        {{-- @if (isset($route) && in_array($route, session()->get('permission'))) --}}
                        @php
                        $noc_redirect_to = "";

                        if(Session::all()['role_name'] == config('commanConfig.ree_junior') || Session::all()['role_name'] == config('commanConfig.ree_deputy_engineer') || Session::all()['role_name'] == config('commanConfig.ree_assistant_engineer') ||
                        Session::all()['role_name'] == config('commanConfig.ree_branch_head'))
                        $noc_redirect_to = "ree_applications.noc_cc";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                        $noc_redirect_to = "co_applications.noc_cc";
                        @endphp
                        @if($noc_redirect_to != "")
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$noc_redirect_to)?'m-menu__item--active':'' }}">
                            <a href="{{ route($noc_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Noc for CC
                                </span>
                            </a>
                        </li>
                        @endif
                        @endif
                        @php
                        if(Session::all()['role_name'] == 'REE Junior Engineer' || Session::all()['role_name'] == 'REE deputy Engineer' || Session::all()['role_name'] == 'REE Assistant Engineer' ||
                        Session::all()['role_name'] == 'ree_engineer')
                        $oc_redirect_to = "ree_applications.consent_oc";
                        elseif(Session::all()['role_name'] == 'ee_engineer' ||  Session::all()['role_name'] == 'ee_dy_engineer' ||  Session::all()['role_name'] == 'ee_junior_engineer')
                        $oc_redirect_to = "ee.consent_for_oc";
                        elseif(Session::all()['role_name'] == 'EM')
                        $oc_redirect_to = "em.consent_for_oc";
                        elseif(Session::all()['role_name'] == 'co_engineer' )
                        $oc_redirect_to = "co_applications.consent_oc";
                        else
                        $oc_redirect_to = "";
                        @endphp
                        @if($oc_redirect_to != "")
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route==$oc_redirect_to)?'m-menu__item--active':'' }}">
                                    <a href="{{ route($oc_redirect_to) }}" class="m-menu__link m-menu__toggle">
                                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 510 510">
                                            <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                                fill="#FFF" />
                                        </svg>
                                        <span class="m-menu__link-text">
                                            Consent for Oc
                                        </span>
                                    </a>
                                </li>
                        @endif
            </ul>
            <!-- comment-->
        </li>
                @if(Session::all()['role_name'] == 'ee_engineer')
                {{-- <li class="m-menu__item {{($route=='society_detail.billing_level')?'m-menu__item--active':''}}">
                    <a href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Service Tax Rates
                                </span>
                            </span>
                        </span>
                    </a>
                </li> --}}

                <li class="m-menu__item {{($route=='society.billing_level' || $route=='society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.edit' || $route == 'arrears_charges.create' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'':'collapsed'}}"
                    data-toggle="collapse" data-target="#e_billing">
                    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text"> E Billing </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </span>
                        </span>
                    </a>
                </li>
                <li id="e_billing" class="collapse {{($route=='society.billing_level'|| $route == 'society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.edit' || $route == 'arrears_charges.create' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'show':''}}">
                    <ul class="list-unstyled">
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society.billing_level' || $route == 'society.society_details' || $route == 'arrears_charges' || $route == 'arrears_charges.create' || $route == 'arrears_charges.edit' || $route == 'service_charges' || $route == 'service_charges.edit' || $route == 'service_charges.create')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('society.billing_level') }}">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                {{-- <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap"> --}}
                                        <span class="m-menu__link-text">
                                            Society Master
                                        </span>
                                        {{-- </span>
                                </span> --}}
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="m-menu__item">
                    <a href="{{ route('society.billing_level') }}" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Society Master
                                </span>
                            </span>
                        </span>
                    </a>
                </li> --}}
                @endif

                @if(Session::all()['role_name'] == 'society')
            </ul>
            </li>
            <li class="m-menu__item {{($route=='society_conveyance.create' )?'m-menu__item--active':''}}">
                <a href="{{ route('society_conveyance.create') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Apply for Society Conveyance
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @if(Session::has('application_count'))
            @if(Session::get('application_count') == 0)
            <li class="m-menu__item {{($route=='society_detail.application' )?'m-menu__item--active':''}}">
                <a href="{{route('society_detail.application')}}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Apply for Offer Letter
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif
            @endif
            @endif
            @endif


            @if(Session::all()['role_name'] == 'EM')
            <li class="m-menu__item {{($route=='generate_tenant_bill' || $route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony')?'':'collapsed'}}"
                data-toggle="collapse" data-target="#e_billing">
                <a href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text"> E Billing </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </span>
                    </span>
                </a>
            </li>
            <li id="e_billing" class="collapse {{($route=='generate_tenant_bill' || $route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony' || $route == 'billing_calculations' || $route == 'generateTenantBill' || $route == 'arrears_calculations' || $route == 'generateBuildingBill'|| $route == 'get_tenant_ajax')?'show':''}}">
                <ul class="list-unstyled">
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='get_societies' || $route == 'get_buildings' || $route == 'get_tenants' || $route == 'edit_tenant' || $route == 'add_tenant' || $route == 'edit_building' || $route == 'add_building' || $route == 'soc_bill_level' || $route == 'soc_ward_colony')?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('get_societies') }}">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">
                                Manage Societies
                            </span>
                        </a>
                    </li>

                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2  {{($route=='generate_tenant_bill' || $route == 'billing_calculations' || $route == 'generateTenantBill' || $route == 'arrears_calculations' || $route == 'generateBuildingBill' || $route == 'get_tenant_ajax')?'m-menu__item--active':''}}"
                        id="e_billing">
                        <a href="{{ route('generate_tenant_bill') }}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">
                                Generate Bill
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif


            @if(Session::all()['role_name'] == 'em_clerk')

            <li class="m-menu__item m-menu__item--submenu {{($route=='em_clerk.index' || $route == 'tenant_payment_list' || $route == 'tenant_arrear_calculation') ?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('em_clerk.index') }}">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Manage Societies
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            @endif

            @if(Session::all()['role_name'] == 'Account')

            <li class="m-menu__item m-menu__item--submenu m-menu__item--active">
                <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('search_accounts') }}">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                List Of Society/Search Accounts
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            @endif

            @if(Session::all()['role_name'] == 'rc_collector')
            <!--<li class="m-menu__item m-menu__item--submenu {{($route=='bill_collection_society')?'m-menu__item--active':''}}">
                            <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('bill_collection_society') }}">
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Collect Bill (Society)
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>-->

            <li class="m-menu__item m-menu__item--submenu {{($route=='bill_collection_tenant')?'m-menu__item--active':''}}">
                <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{ route('bill_collection_tenant') }}">

                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Collect Bill
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif

            @yield('actions')

            <!-- <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                    <a href="{{ route('society_offer_letter_dashboard') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Offer Letter Dashboard
                                </span>
                            </span>
                        </span>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')

{{-- <script>
    function end_lease_notifications(count) {
        console.log(count);
        var end_lease_date_count = count;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route('
            society_detail.index ') }}',
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

</script> --}}

@endsection
