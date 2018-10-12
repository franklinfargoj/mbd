@php
    $route="";
    $route=\Request::route()->getName();
@endphp

<li class="m-menu__item" data-toggle="collapse" data-target="#role-actions">
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

<li id="role-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu {{($route=='roles.index')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Listing Role" href="{{ route('roles.index')}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Role Listing</span>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--submenu {{($route=='roles.create')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="Create Role" href="{{ route('roles.create')}}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                          fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">Add Role</span>
            </a>
        </li>
        {{--<li class="m-menu__item m-menu__item--submenu {{($route=='ree.society_EE_documents')?'m-menu__item--active':''}}"--}}
            {{--aria-haspopup="true">--}}
            {{--<a class="m-menu__link m-menu__toggle" title="Society & EE Documents" href="{{route('ree.society_EE_documents',$ol_application->id)}}">--}}
                {{--<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">--}}
                    {{--<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"--}}
                          {{--fill="#FFF" />--}}
                {{--</svg>--}}
                {{--<span class="m-menu__link-text">Society & EE Documents</span>--}}
            {{--</a>--}}
        {{--</li>--}}
    </ul>
</li>
