@extends('admin.layouts.app')

<h3>Your Application is submitted successfully. RTI Application No {{Session::get('rtiFormId')}}</h3>
<em>Please Note Application No to view  response send by RTI officer, Mhada</em>
<a role="button" href="{{url('rti_form_success_close')}}" class="btn btn-info">Close</a>
