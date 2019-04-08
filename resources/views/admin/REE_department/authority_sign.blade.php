
@if (isset($status) && $status->status_id == config('commanConfig.applicationStatus.in_process'))
    <p style="padding-left: 5px; padding-right: 5px;" lang="en-US" align="justify">
        <strong>(Draft approved by CO/MB)</strong>
    </p>

    <table style="width: 100%; border-collapse: collapse;">
    <tbody>
        <tr>
            @if (isset($authority) && count($authority) > 0)
                @foreach($authority as $roles)
                    <td>({{ isset($roles->name) ? $roles->name : '________' }})<br />{{ isset($roles->roleDetails->display_name) ? $roles->roleDetails->display_name : '________' }}<br /></td>
                @endforeach
            @endif
        </tr>
    </tbody>
    </table>
@else
    <p style="padding-left: 1000px; padding-right: 5px;" lang="en-US" align="justify">
        <strong>(Draft approved by CO/MB)</strong>
    </p>
    <table style="width: 80%; border-collapse: collapse;" align="right">
        <tbody>
            <tr valign="top">
                <td width="226">
                    <p style="padding-right: 5px;" lang="en-US" align="right">
                        Sd/-
                    </p>
                    <p style="padding-right: 5px;" lang="en-US" align="right">
                        ({{ isset($authority['reeHead']) ? $authority['reeHead']->name : '________'}})
                    </p>
                    <p style="padding-right: 5px;" lang="en-US" align="right">
                        <strong>{{ isset($authority['reeHead']) && isset($authority['reeHead']->roleDetails) ? $authority['reeHead']->roleDetails->display_name : '________'}}</strong>
                    </p>
                    <p style="padding-right: 5px;" lang="en-US" align="right">
                        <strong>M. H. &amp; A. D. Board</strong>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
@endif


