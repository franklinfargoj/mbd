@php
$route="";
$route=\Request::route()->getName();
@endphp
<li class="m-menu__item m-menu__item--submenu m-menu__item--level-1" >
    <a href="{{ route('architect_application') }}" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon flaticon-line-graph"></i>
        <span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Back to Applications
                </span>
            </span>
        </span>
    </a>   
</li>
<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2" data-toggle="collapse" data-target="#cap-actions">
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
<li id="cap-actions" class="collapse show">
    <ul class="list-unstyled">
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{($route=='view_architect_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ url('view_architect_application/'. encrypt($ArchitectApplication->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
                <span class="m-menu__link-text">View Application</span>
            </a>
        </li>
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{( $route=='evaluate_architect_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ url('evaluate_architect_application/'. encrypt($ArchitectApplication->id)) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
              <span class="m-menu__link-text">Evaluate Application</span>
            </a>
        </li>

        @php $status=getLastStatusIdArchitectApplication($ArchitectApplication->id); @endphp
        @if($ArchitectApplication->application_status=='Final' && config('commanConfig.selection_commitee')!=session()->get('role_name'))
        <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{( $route=='generate_certificate' || $route=='finalCertificateGenerate')?'m-menu__item--active':''}}">
          <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('generate_certificate',['id'=>encrypt($ArchitectApplication->id)]) }}">
              <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                  <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                      fill="#FFF" />
              </svg>
            <span class="m-menu__link-text">Issue Certificate</span>
          </a>
        </li>
        @endif

        @if($status)
        @if($status['status_id']!=config('commanConfig.architect_applicationStatus.forward'))
          @if(($ArchitectApplication->application_status!='Final') || config('commanConfig.architect')!=session()->get('role_name'))
          <li class="m-menu__item m-menu__item--submenu m-menu__item--level-3 {{( $route=='architect.forward_application')?'m-menu__item--active':''}}">
            <a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('architect.forward_application',['id'=>encrypt($ArchitectApplication->id)]) }}">
                <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                    <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                        fill="#FFF" />
                </svg>
              <span class="m-menu__link-text">Forward Application</span>
            </a>
          </li>
          @endif
        @endif
      @endif
       
    </ul>
</li>
