@if($hearing_data->hearingStatusLog[0]->hearing_status_id == config('commanConfig.hearingStatus.forwarded') || $hearing_data->hearingStatusLog[0]->hearing_status_id == config('commanConfig.hearingStatus.case_closed'))
    @php
        $style = 'pointer-events: none;
   cursor: default;';
    @endphp
@else
    @php
        $style = '';
    @endphp
@endif
@php
$route="";
$route=\Request::route()->getName();

@endphp

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

<li class="m-menu__item" data-toggle="collapse" data-target="#hearing-actions">
    <a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Actions
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </span>
        </span>
    </a>
</li>

<li id="hearing-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='hearing.show')?'m-menu__item--active':''}}">
            <a href="{{ route('hearing.show', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">
                    View Hearing
                </span>
            </a>
        </li>

    @if($hearing_data->hearingStatusLog[0]->hearing_status_id != config('commanConfig.hearingStatus.case_closed'))

        @if(in_array('hearing.edit', session()->get('permission')))
{{--            @php dd(config('commanConfig.hearingStatus.forwarded')); @endphp--}}
            @if($hearing_data->hearingStatusLog[0]->hearing_status_id != config('commanConfig.hearingStatus.forwarded'))
                    @if($hearing_data->hearingStatusLog[0]->hearing_status_id != config('commanConfig.hearingStatus.notice_send'))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='hearing.edit')?'m-menu__item--active':''}}">
                            <a href="{{ route('hearing.edit', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                                        <span class="m-menu__link-text">
                                            Edit Details
                                        </span>
                            </a>
                        </li>
                    @endif
            @endif
                @if($hearing_data->hearingSchedule)
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='schedule_hearing.add')?'m-menu__item--active':''}}">
                        <a href="{{ route('schedule_hearing.show', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                            fill="#FFF" />
                    </svg>
                                        View Scheduled Hearing
                                    </span>
                        </a>
                    </li>
                @else
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='schedule_hearing.add')?'m-menu__item--active':''}}">
                        <a href="{{ route('schedule_hearing.add', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                            fill="#FFF" />
                    </svg>
                                    <span class="m-menu__link-text">
                                        Schedule Hearing
                                    </span>
                        </a>
                    </li>
                    {{--<li class="m-menu__item m-menu__item--submenu">--}}
                        {{--<a href="#" class="m-menu__link m-menu__toggle">--}}
                            {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">--}}
                        {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                            {{--fill="#FFF" />--}}
                    {{--</svg>--}}
                                    {{--<span class="m-menu__link-text">--}}
                                        {{--Prepone/ Postpone Hearing--}}
                                    {{--</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                @endif

                @if($hearing_data->hearingSchedule)
                    @if(count($hearing_data->hearingSchedule->prePostSchedule))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='fix_schedule.edit')?'m-menu__item--active':''}}">
                            <a href="{{ route('fix_schedule.edit', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                            fill="#FFF" />
                    </svg>
                                        <span class="m-menu__link-text">
                                            Hearing
                                            @if($hearing_data->hearingSchedule->prePostSchedule[0]->pre_post_status == 0)
                                                Postponed
                                            @else
                                                Preponed
                                            @endif
                                        </span>
                            </a>
                        </li>
                    @else
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='fix_schedule.add')?'m-menu__item--active':''}}">
                            <a href="{{ route('fix_schedule.add', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                            fill="#FFF" />
                    </svg>
                                        <span class="m-menu__link-text">
                                            Prepone/ Postpone Hearing
                                        </span>
                            </a>
                        </li>
                    @endif
                @endif


            {{--<a href=""></i>Update Status</a> |--}}
            @if(count($hearing_data->hearingUploadCaseJudgement) > 0)
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='upload_case_judgement.edit')?'m-menu__item--active':''}}">
                    <a href="{{ route('upload_case_judgement.edit', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                                <span class="m-menu__link-text">
                                    Case Judgement
                                </span>
                    </a>
                </li>
            @else
                <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='upload_case_judgement.add')?'m-menu__item--active':''}}">
                    <a href="{{ route('upload_case_judgement.add', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                        <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                                <span class="m-menu__link-text">
                                    Case Judgement
                                </span>
                    </a>
                </li>
            @endif
        @endif

        @if(count($hearing_data->hearingForwardCase))
            @if($hearing_data->hearingStatusLog[0]->hearing_status_id == config('commanConfig.hearingStatus.forwarded'))
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='forward_case.show')?'m-menu__item--active':''}}">
                        <a href="{{ route('forward_case.show', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                      fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">
                                Forward Case
                            </span>
                        </a>
                    </li>
                @else
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='forward_case.edit')?'m-menu__item--active':''}}">
                        <a href="{{ route('forward_case.edit', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                      fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">
                                Forward Case
                                </span>
                        </a>
                    </li>
                @endif
            @else
            <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='forward_case.create')?'m-menu__item--active':''}}">
                <a href="{{ route('forward_case.create', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                    <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                        <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                            fill="#FFF" />
                    </svg>
                    <span class="m-menu__link-text">
                        Forward Case   
                    </span>
                </a>
            </li>
        @endif

        @if(in_array('send_notice_to_appellant.edit', session()->get('permission')))
                @if($hearing_data->hearingSchedule)
                    @if(count($hearing_data->hearingSendNoticeToAppellant))
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='send_notice_to_appellant.edit')?'m-menu__item--active':''}}">
                            <a href="{{ route('send_notice_to_appellant.edit', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                          fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Send Notice To Applicant
                            </span>
                            </a>
                        </li>
                        @else
                        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='send_notice_to_appellant.create')?'m-menu__item--active':''}}">
                            <a href="{{ route('send_notice_to_appellant.create', $hearing_data->id) }}" class="m-menu__link m-menu__toggle">
                                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                          fill="#FFF" />
                                </svg>
                                <span class="m-menu__link-text">
                                    Send Notice To Applicant
                            </span>
                            </a>
                        </li>
                        @endif
                        @else
                    {{--<li class="m-menu__item m-menu__item--submenu">--}}
                    {{--<a href="#" class="m-menu__link m-menu__toggle">--}}
                    {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">--}}
                    {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                    {{--fill="#FFF" />--}}
                    {{--</svg>--}}
                    {{--<span class="m-menu__link-text">--}}
                    {{--Send Notice To Applicant--}}
                    {{--</span>--}}
                    {{--</a>--}}
                    {{--</li>--}}
                    @endif
                    @if($hearing_data->hearingStatusLog[0]->hearing_status_id != config('commanConfig.hearingStatus.forwarded'))
                        @if($hearing_data->hearingStatusLog[0]->hearing_status_id != config('commanConfig.hearingStatus.notice_send'))
                    <li class="m-menu__item m-menu__item--submenu m-menu__item--level-2" >
                        <a href="javascript:void(0);" data-id="{{ $hearing_data->id }}" class="m-menu__link m-menu__toggle delete-hearing">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                      fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">
                                Delete
                    </span>
                        </a>
                    </li>
                        @endif
                    @endif
        @endif
        @endif
    </ul>
</li>