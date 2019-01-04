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
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
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
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
                                {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">--}}
                                    {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        --}} {{--fill="#FFF" />--}} {{--</svg>--}} <span class="m-menu__link-title">
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
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
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
                                <i class="m-menu__link-icon flaticon-line-graph"></i>
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
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
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
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Society Conveyance Applications
                                </span>
                            </a>
                        </li>
                        @endif

                        @if(session()->get('permission') && (in_array('renewal.index', session()->get('permission')) ))

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='renewal.index') ? 'm-menu__item--active' : '' }}">
                            <a href="{{ route('renewal.index') }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Society Renewal Applications
                                </span>
                            </a>
                        </li>
                        @endif

                        @if(in_array('get_sf_applications.index',session()->get('permission')))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{ ($route=='get_sf_applications.index') ? 'm-menu__item--active' : '' }}">
                            <a href="{{ route('get_sf_applications.index') }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
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
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
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
                    in_array('vp.index', session()->get('permission')) ||
                    in_array('vp.index', session()->get('permission')) ||
                    in_array('tripartite.index', session()->get('permission')) ||
                    in_array('ree_applications.noc_cc', session()->get('permission'))||
                    in_array('co_applications.noc_cc', session()->get('permission'))
                    ))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2  {{( $route=='ee.index' || $route=='dyce.index' || $route=='ree_applications.index' || $route=='co.index' || $route=='cap.index' || $route=='vp.index' || $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' || $route=='documents_uploaded' || $route=='documents_upload')?'m-menu__item--active':''}}">
                            <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                        fill="#FFF" />
                                </svg>
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
