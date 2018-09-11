@extends('admin.layouts.app')
@section('content')
<form class="letter-form" action="" method="post">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader letter-form-header">
		<div class="d-flex align-items-center justify-content-center">
			<h3 class="m-subheader__title ">
				अर्जाचा नमुना
			</h3>
		</div>
		<div class="letter-form-header-content">
			<p>
				<span class="d-block font-weight-semi-bold">प्रति,</span>
				<span class="d-block">कार्यकारी अभियंता, <input type="text" id="" name="" required> विभाग,</span>
				<span class="d-block">मुंबई गृहनिर्माण व क्षेत्रविकास मंडळ,</span>
				<span class="d-block">गृहनिर्माण भवन, वांद्रे (पुर्व),</span>
				<span class="d-block">मुंबई -४०००५१.</span>
			</p>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content letter-form-content">
		<div class="letter-form-subject">
			<p><span class="font-weight-semi-bold">विषय :- </span>इमारत क्र. <input type="text" id="" name="" required>, <input type="text" id="" name="" required> सहकारी गृहनिर्माण संस्थेच्या स्वयंपुनर्विकासाच्या प्रस्तावास मंजूरी मिळण्याबाबतचा अर्ज.</p>
			<p class="font-weight-semi-bold">महोदय,</p>
			<p>आम्ही <input type="text" id="" name="" required> सहकारी गृहनिर्माण संस्थेचे पदाधिकारी ( इमारत क्र. <input type="text" id="" name="" required> पत्ता - <input type="text" id="" name="" required> ) आपणांस विनंती करतो की, आम्ही रहात असलेल्या सदरहू इमारतीचा स्वयंपुनर्विकास विकास नियंत्रण नियमावली ३३ (५) अंतर्गत अधिमुल्य आधारित तत्वावर करु इच्छितो. आमच्या गृहनिर्माण संस्थेने दिनांक <input type="text" id="" name="" required> रोजी स्वयंपुनर्विकासासंदर्भात सर्वसाधारण सभेचा ठराव क्र. <input type="text" id="" name="" required> अन्वये निर्णय घेतला आहे.</p>
			<p>आम्ही सहकारी गृहनिर्माण संस्थेच्या स्वयंपुनर्विकासाच्या कामांसाठी वि.नि.नि ३३ (५) मधील तरतूदींच्या अधिन राहून याबाबतचे सविस्तर आराखडे / नकाशे व पुनर्विकासाच्या कामावर देखरेख करण्यासाठी  <input type="text" id="" name="" required> या वास्तुशास्त्रज्ञाची नियुक्ती केली आहे.</p>
			<p>यानुसार आपणांस विनंती करण्यात येते की, अभिन्यासातील अनुज्ञेय प्रोराटा क्षेत्रफळाचे वितरण संस्थेस करावे व संस्थेस वितरण करण्यात येणाÅया अतिरिक्त बांधकाम क्षेत्रफळाकरीता भरणा करावे लागणारे अधिमुल्य म्हाडाच्या धोरणानुसार ४ समान हप्त्यात देण्यात यावे.</p>
			<p>सदर प्रस्तावावर उचित कार्यवाही करुन देकारपत्र जारी करण्याची कार्यवाही करण्यात यावी, ही विनंती.</p>
		</div>
		<div class="letter-form-footer d-flex font-weight-semi-bold mt-5">
			<div class="ml-auto text-center">
				<p class="mb-5">आपला विश्वासू</p>
				<p>
					<span class="d-block">अध्यक्ष / सचिव / खजिनदार</span>
					<span class="d-block">------- स.गृ.नि. संस्था मर्या.</span>
				</p>
			</div>
		</div>
	</div>
</form>

@endsection