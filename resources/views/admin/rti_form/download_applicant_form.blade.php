<div>
    <div style="text-align: center;">
        <h1>RTI Application Registration</h1>
        <p>Application for obtaining information under the Right to Information Act, 2005</p>
    </div>
    <div>
        <div style="width: 100%; margin-top: 30px;">
            <div style="width: 50%; float: left;">
                <label style="display: block;">Board</label>
                @foreach($boards as $board_value)
                @if($application_form_data->board_id==$board_value->id)
                <h3 style="margin-top: 10px; margin-bottom: 10px;">{{$board_value->board_name}}</h3>
                @endif
                @endforeach
            </div>
            <div style="width: 50%; float: left;">
                <label>Department</label>
                @foreach($departments as $department_value)
                @if($application_form_data->department_id==$department_value->id)
                <h3 style="margin-top: 10px; margin-bottom: 10px;">{{$department_value->department_name}}</h3>
                @endif
                @endforeach
            </div>
            <div style="clear: both;"></div>
        </div>
        <div style="width: 100%;  margin-top: 30px;">
            <div style="width: 50%; float: left;">
                <label style="display: block;">Full Naadssadme</label>
                <input style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 35px; border: 1px solid black; padding-left: 5px; margin-top: 10px;" type="text" value="{{$application_form_data->applicant_name}}">
            </div>
            <div style="width: 50%; float: left;">
                <label style="display: block;">Address</label>
                <textarea style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 35px; border: 1px solid black; padding-left: 5px; margin-top: 10px; padding-top: 6px; resize: none;">{{$application_form_data->applicant_addr}}</textarea>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div style="margin-top: 30px;">
            <label style="display: block;">Subject matter of information</label>
            <input style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 35px; border: 1px solid black; padding-left: 5px; margin-top: 10px; width: 100%;" type="text" value="{{  $application_form_data->info_subject}}">
        </div>

        <div style="margin-top: 30px;">
            <label style="display: block;">The period to which the information relates</label>
            <input style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 35px; border: 1px solid black; padding-left: 5px; margin-top: 10px;" type="text" value="{{$application_form_data->info_period_from}}">
            <input style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 35px; border: 1px solid black; padding-left: 5px; margin-top: 10px; margin-left: 10px;" type="text" value="{{$application_form_data->info_period_to}}">
        </div>

        <div style="margin-top: 30px;">
            <label style="display: block;">Description of the information required</label>
            <textarea style="font-family: Arial, sans-serif; font-size: 16px; font-weight: normal; height: 70px; border: 1px solid black; padding-left: 5px; padding-top: 6px; margin-top: 10px; resize: none; width: 100%;">{{$application_form_data->info_descr}}</textarea>
        </div>

    </div>
        <div style="margin-top: 30px;">
            <label style="display: block;">Whether information is required by?</label>
            <div>
                <label for="rtiInfoRespondRadios1" style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" id="rtiInfoRespondRadios1" name="info_post_or_person" value="1"
                        {{ $application_form_data->info_post_or_person=='1'?'checked':''}}>Post
                    <span></span>
                </label>
                <label for="rtiInfoRespondRadios2" style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" id="rtiInfoRespondRadios2" name="info_post_or_person" value="0"
                        {{ $application_form_data->info_post_or_person=='0'?'checked':''}}>Person
                    <span></span>
                </label>
            </div>
        </div>

        @if($application_form_data->info_post_or_person=='1')
        <div style="margin-top: 30px;">
            <label>Post Type</label>
            <div>
                <label style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" name="info_post_type" id="rtiPostTypeRadios1"
                        {{ $application_form_data->info_post_type=='1'?'checked':''}} value="1">
                    Ordinary
                    <!-- <span></span> -->
                </label>
                <label style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" name="info_post_type" id="rtiPostTypeRadios2"
                        {{ $application_form_data->info_post_type=='2'?'checked':''}} value="2">
                    Registered
                    <!-- <span></span> -->
                </label>
                <label style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" name="info_post_type" id="rtiPostTypeRadios3"
                        {{ $application_form_data->info_post_type=='3'?'checked':''}} value="3">
                    Speed
                    <!-- <span></span> -->
                </label>
                <span>{{$errors->first('info_post_type')}}</span>
            </div>
        </div>
        @endif
        <div style="margin-top: 30px;">
            <label>Whether the applicant is below poverty line?</label>
            <div>
                <label style="line-height: 0;">
                    <input style="margin-top: 4px; margin-right: 5px;" type="radio" name="applicant_below_poverty_line" value="1"
                        {{ $application_form_data->applicant_below_poverty_line=='1'?'checked':''}}>Yes
                    <span></span>
                </label>
                <label style="line-height: 0;">
                    <input style="margin-top: 4px;  margin-right: 5px;" type="radio" name="applicant_below_poverty_line" value="0"
                        {{ $application_form_data->applicant_below_poverty_line=='0'?'checked':''}}>No
                    <span></span>
                </label>
            </div>
        </div>
</div>
