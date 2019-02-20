<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Revision in Layout</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="m-portlet db-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <th style="width: 10%;">Sr. No</th>
                        <th style="width: 60%;" class="text-center">Stages</th>
                        <th style="width: 15%;" class="text-left">Count</th>
                        {{--<th style="width: 15%;">Action</th>--}}
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Total No of Application Sent For Revision</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_appln_for_revision']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Application Pending</td>
                            <td><span class="count-circle">{{$architect_data['application_pending']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Application Forwarded</td>
                            <td><span class="count-circle">{{$architect_data['ree_forwarded_layouts']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="m-portlet">
                <img src="img/data-gola.jpg">
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Layout Approval</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="m-portlet db-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <th style="width: 10%;">Sr. No</th>
                        <th style="width: 60%;" class="text-center">Stages</th>
                        <th style="width: 15%;" class="text-left">Count</th>
                        {{--<th style="width: 15%;">Action</th>--}}
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Total No of Application Sent For Approval</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['appln_sent_for_arroval']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Application Pending</td>
                            <td><span class="count-circle">{{$architect_data['application_pending_after_layout_and_excel']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Application Forwarded</td>
                            <td><span class="count-circle">{{$architect_data['application_forwarded_after_layout_and_excel']}}</span></td>
                            {{--<td><button class="btn btn-action">View</button></td>--}}
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="m-portlet">
                <img src="img/data-gola.jpg">
            </div>
        </div>
    </div>

</div>

@if(session()->get('role_name')==config('commanConfig.ree_branch_head'))
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Layout Approval</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <div class="m-portlet db-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                            <th style="width: 10%;">Sr. No</th>
                            <th style="width: 60%;" class="text-center">Stages</th>
                            <th style="width: 15%;" class="text-left">Count</th>
                            {{--<th style="width: 15%;">Action</th>--}}
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1.</td>
                                <td>Total No of Application Sent For Approval</td>
                                <td class="text-center"><span class="count-circle">{{$architect_data['appln_sent_for_arroval']}}</span></td>
                                {{--<td><button class="btn btn-action">View</button></td>--}}
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td>Pending at JE / SE</td>
                                <td><span class="count-circle">{{$architect_data['jr_ree_pending']}}</span></td>
                                {{--<td><button class="btn btn-action">View</button></td>--}}
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td>Pending at Deputy Engineer</td>
                                <td><span class="count-circle">{{$architect_data['dy_ree_pending']}}</span></td>
                                {{--<td><button class="btn btn-action">View</button></td>--}}
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td>Pending at  Asst REEr</td>
                                <td><span class="count-circle">{{$architect_data['assistant_ree_pending']}}</span></td>
                                {{--<td><button class="btn btn-action">View</button></td>--}}
                            </tr>
                            <tr>
                                <td class="text-center">5.</td>
                                <td>Pending at REE</td>
                                <td><span class="count-circle">{{$architect_data['head_ree_pending']}}</span></td>
                                {{--<td><button class="btn btn-action">View</button></td>--}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="m-portlet">
                    <img src="img/data-gola.jpg">
                </div>
            </div>
        </div>

    </div>

@endif

