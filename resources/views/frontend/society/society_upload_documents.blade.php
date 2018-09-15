@extends('admin.layouts.app')
@section('content')
<div class="row" style="margin-top: 5%">
    <div class="col-md-12">
       <div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi mb-0 m-portlet--table">
          <div class="m-portlet__head main-sub-title">
             <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                   <span class="m-portlet__head-icon m--hide">
                   <i class="flaticon-statistics"></i>
                   </span>
                   <h2 class="m-portlet__head-label m-portlet__head-label--custom">
                      <span>
                      Upload Attachments
                      </span>
                   </h2>
                </div>
             </div>
          </div>
          <div class="m-portlet__body m-portlet__body--table">
             <div class="m-section mb-0">
                <div class="m-section__content mb-0 table-responsive">
                   <table class="table mb-0">
                      <thead class="thead-default">
                         <tr>
                            <th>
                               #
                            </th>
                            <th>
                               Document Name
                            </th>
                            <th>
                               Status
                            </th>
                            <th>
                               Actions
                            </th>
                         </tr>
                      </thead>
                      <tbody>
                      @php $i=1; @endphp
                        @foreach($documents as $document)                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    {{ $document->name }}<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                                </td>
                                <td class="text-center">
                                    <h2 class="m--font-danger">
                                        @if(count($documents_uploaded) > 0 )
                                            @foreach($documents_uploaded as $document_uploaded)
                                                @if($document_uploaded['document_id'] == $document->id)
                                                    <i class="fa fa-check"></i>
                                                @else
                                                    <i class="fa fa-remove"></i>
                                                @endif
                                            @endforeach
                                        @else
                                            <i class="fa fa-remove"></i>
                                        @endif
                                    </h2>
                                </td>
                                <td>
                                   <form action="{{ route('uploaded_documents') }}" method="post">
                                   @csrf
                                        <div class="custom-file">
                                            <input class="custom-file-input" name="document_name"  type="file" class="" id="test-upload" required>
                                            <input class="custom-file-input" type="hidden" name="document_id" class="" id="test-upload" value="{{ $document->id }}">
                                            <label class="custom-file-label" for="test-upload">Choose file...</label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                   </form>
                                </td>
                            </tr>
                        @php $i++; @endphp
                        @endforeach
                         <!-- <tr>
                            <td>2</td>
                            <td>
                                सर्वसाधारण सभेच्या पुर्नविकास करणेबाबतचा ठराव<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload2" required>
                                        <label class="custom-file-label" for="test-upload2">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                सर्वसाधारण सभेचा इतीवृताच्या रजिष्टरची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload3" required>
                                        <label class="custom-file-label" for="test-upload3">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>
                                सर्वसाधारण सभेच्या ठरावात विकासकाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload4" required>
                                        <label class="custom-file-label" for="test-upload4">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>
                                सर्वसाधारण सभेच्या ठरावात वास्तुशास्त्रज्ञाचे नाव व पत्ता नमुद केलेल्या ठरावाची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload5" required>
                                        <label class="custom-file-label" for="test-upload5">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>
                                वास्तुशास्त्रज्ञाच्या नेमणूकिचे व पत्रव्यवहाराच्या अधिकाराचे मान्यता पत्र केलेल्या ठरावाची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload6" required>
                                        <label class="custom-file-label" for="test-upload6">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>
                                वास्तुशास्त्रज्ञाच्या परवाण्याची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload7" required>
                                        <label class="custom-file-label" for="test-upload7">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>
                                विकासकाबरोबर केलेल्या नोंदणीकृत करारनाम्याची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload8" required>
                                        <label class="custom-file-label" for="test-upload8">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>
                                ७० % सभासदांची पुनर्विकासाकरीता वैयक्तीक संमती पत्र<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload9" required>
                                        <label class="custom-file-label" for="test-upload9">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>
                                अभिहस्तांतरण करारनामा (सेल/ कन्व्हेस) साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload10" required>
                                        <label class="custom-file-label" for="test-upload10">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>
                                भाडेपट्टा करारनामा (लीज डिड)<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload11" required>
                                        <label class="custom-file-label" for="test-upload11">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>
                                अभिहस्तांतरण नकाशा ची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload12" required>
                                        <label class="custom-file-label" for="test-upload12">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>
                                कार्यकारी अभियंता / कुर्ला विभाग / मुंबई मंडळ यांचेकडुन इमारतीचा व सलग्न भूखंडाचा सिमांकन नकाशा <span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload13" required>
                                        <label class="custom-file-label" for="test-upload13">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>
                                संस्थेच्या नाेंदणी प्रमाणपत्राची साक्षांकित प्रत<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload14" required>
                                        <label class="custom-file-label" for="test-upload14">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>
                                मिळकत व्यवस्थापक यांचे ना देय प्रमाणपत्र<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload15" required>
                                        <label class="custom-file-label" for="test-upload15">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>
                                नगरभुमापन नकाशे<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload16" required>
                                        <label class="custom-file-label" for="test-upload16">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>
                                मिळकत पत्रिका (PR  कार्ड )<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload17" required>
                                        <label class="custom-file-label" for="test-upload17">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>
                                अस्तीत्वातील इमारतीचे फोटो<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload18" required>
                                        <label class="custom-file-label" for="test-upload18">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>
                                प्रस्तावीत इमारतीचा नकाशा<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload19" required>
                                        <label class="custom-file-label" for="test-upload19">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>
                                डी.पी.रिमार्क<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload20" required>
                                        <label class="custom-file-label" for="test-upload20">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>
                                उपनिबंधक यांचेसमक्ष सर्वसाधारण सभेमध्ये विकासकाची नियुक्ती झाल्याबाबतचे पत्र<span class="compulsory-text"><small>(Compulsory Document)</small></span>
                            </td>
                            <td class="text-center">
                                <h2 class="m--font-danger"><i class="fa fa-remove"></i></h2>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="" type="file" class="" id="test-upload21" required>
                                        <label class="custom-file-label" for="test-upload21">Choose file...</label>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-custom">Upload</button>
                                </form>
                            </td>
                        </tr> -->
                      </tbody>
                   </table>
                </div>
             </div>
       </div>
    </div>
     </div>
</div>
@endsection
