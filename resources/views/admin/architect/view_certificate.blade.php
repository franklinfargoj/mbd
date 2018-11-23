@extends('admin.layouts.app')
@section('content')
<div style="margin-top: 30px; text-align: right;">
        <div style="float: left; width: 63%;">&nbsp;</div>
        <div style="float: left; width: 37%;">
            <div style="text-align: left;">
                <span>ARCH/M.B/ARCH. PANEL/312/2018</span>
            </div>
            <div style="text-align: left;">
                <span>Date:</span>
            </div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <h3 style="text-decoration: underline; text-align: center; font-size: 24px; margin-top: 40px; text-transform: uppercase;">Certificate</h3>

    <div style="margin-top: 30px; line-height: 1.8;">
        <p style="text-indent: 25px; margin-top: 10px; margin-bottom: 10px;">We are pleases to inform you that your <span style="font-weight: bold;">firm M / s. {{$ArchitectApplication->candidate_name}}</span> is selected as Grade - <span style="font-weight: bold;"></span>
        Architect /Consultant for the HOUSING panel of <span style="font-weight: bold;">Mumbai Housing and area Developement Board</span>, expiring on
        31/12/2022.</p>
        <p style="text-indent: 25px; margin-top: 10px; margin-bottom: 10px;">We expect your kine co-operation whenever any project is entrusted to you by MHADA during the above mentioned
        period</p>
        <p style="margin-bottom: 0; margin-top: 30px; font-weight: bold;">(Draft approved by CO/MB)</p>
        <div style="width: 100%; line-height: 1.5;">
            <div style="float: left; width: 70%">&nbsp;</div>
            <div style="margin-bottom: 5px; margin-top: 50px; float: left; width: 30%;">
                <div style="text-align: center;">
                    <div style="display: block; font-weight: bold;">Architect & Planner</div>
                    <div style="display: block;">Mumbai Housing & Area Developement Board.</div>
                </div>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
    @endsection