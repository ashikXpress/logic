
@extends('layouts.app')

@section('content')
@section('style')
@endsection
<div class="pre-print-area">
    <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button><br>
    <div class="print-area" id="prinarea_profile">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row"  style="margin-left: 40px;margin-right: 40px">
                                <table class="table table-bordered"  >
                                    <tr style="height: 100%;width: 100%">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <div class="logo" style="margin-top: 26px;margin-left: 22px;">
                                                    <div class="logo-img">
                                                        <img src="{{asset('img/logo.png')}}" alt="" height="120px" width="120px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-10">
                                                <div class="heading">
                                                    <strong><h1 style="color: #00B050;font-family: broadway; font-size: 43px;">LOGIC</h1></strong>
                                                    <strong><h1 style="color:#FF0000;font-family: times-new-roman;font-size: 33px;">ENGINEERING LIMITED</h1></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <hr style="margin-right: 16px;border-top: 4px solid #B898D0;">
                                    <tr>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="ongikar-nama" style="margin-bottom: 40px;margin-top: -27px">
                                                    <u><h3 style="text-align: center">অঙ্গীকারনামা</h3></u>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <p>এই মর্মে অঙ্গীকার করিতেছি আমি {{$candidate->name}}  পিতা: {{$candidate->fathers_name}}  মাতা: .........................................................................
                                             গ্রাম: {{$candidate->villaeg}}  উপজেলা: {{$candidate->police_station}} জেলা: {{$candidate->district}}
                                            আমি লজিক অটোমেশন টেকনোলজিস্ট এর একজন কর্মকর্তা। আমার আইডি নং: {{$candidate->id}}</p>
                                    </tr>
                                    <tr>
                                        <p>১। আমি ঘোষণা করিতেছি  যে, আমি  এই প্রতিষ্ঠানে কর্মরত অবস্থায় সরকারি চাকুরী ব্যতীত আগামী এক বছর এই প্রতিষ্ঠানে কর্মরত
                                            থাকিতে প্রতিজ্ঞাবদ্ধ।  যদি কোন কারণে উক্ত প্রতিজ্ঞা ভঙ্গ হয়  তাহলে প্রতিষ্ঠানে কর্তৃক নির্ধারিত সিদ্ধান্ত চূড়ান্ত বলে গণ্য হইবে।  </p>
                                        <p>২। এমতবস্থায় প্রতিষ্ঠান কর্তৃক নির্ধারিত সকল সুযোগ-সুবিধা ভোগ করিব। </p>
                                        <p>৩। আমি ঘোষণা করিতেছি যে, উপর্যুক্ত সকল বিষয়ে অবগত থেকে স্বজ্ঞানে, সুস্থ মস্তিষ্কে এবং কারো কোনো প্ররোচনা ব্যতীত এ অঙ্গীকারনামায় স্বাক্ষর প্রদান করিলাম।   </p>
                                    </tr>
                                    <div class="row">
                                        <div class="secound-part" style="margin-top: 50px;margin-bottom: 130px">
                                            <div class="col-xs-4">
                                                <p>তারিখঃ  {{date('d-m-Y', strtotime($candidate->created_at))}} </p>
                                            </div>

                                            <div class="col-xs-5 col-xs-offset-3">
                                                <p>অঙ্গীকারকারীর স্বাক্ষর</p>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <u><p>স্বাক্ষীদের স্বাক্ষর</p></u>
                                            </div>
                                        </div>
                                    </tr>
                                    <div class="name-part" style="margin-bottom: 10px;">
                                        <tr>
                                            <p style="margin-bottom: 10px;">১।নামঃ</p>
                                        </tr>
                                        <tr>
                                            <p style="margin-bottom: 10px;">২।নামঃ</p>
                                        </tr>
                                        <tr>
                                            <p style="margin-bottom: 10px;">৩।নামঃ</p>
                                        </tr>
                                        <tr>
                                            <p style="margin-bottom: 10px;">৪।নামঃ</p>
                                        </tr>
                                        <tr>
                                            <p style="margin-bottom: 10px;">৫।নামঃ</p>
                                        </tr>
                                    </div>
                                </table>
                            </div>
                        </div>
                        <hr style="border-top: 4px solid #B898D0;margin-left: 40px;margin-right: 40px;">
                        <p style="text-align: center">Address: Mariam Tower 1st Floor, Polytechnic Road, Boroytola More, Gangkola, Pabna-6600.</p>
                        <p style="text-align: center">Mobile: +088 01711-955 452, 01812-955 452, 01711-220 128, 01723-655 858</p>
                        <p style="text-align: center">E-mail: logicgroupbd@gmail.com, Web: www.logicgroupbd.com</p>
                        <table class="table table-bordered" style="" >
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <div class="row" style="margin-left: 40px;margin-right: 40px">
                                <table class="table table-bordered"  >
                                    <tr style="height: 100%;width: 100%">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <div class="logo" style="margin-top: 26px;margin-left: 22px;">
                                                    <div class="logo-img">
                                                        <img src="{{asset('img/logo.png')}}" alt="" height="120px" width="120px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-10">
                                                <div class="heading">
                                                    <strong><h1 style="color: #00B050;font-family: broadway; font-size: 43px;">LOGIC</h1></strong>
                                                    <strong><h1 style="color:#FF0000;font-family: times-new-roman;font-size: 33px;">ENGINEERING LIMITED</h1></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <hr style="margin-right: 16px;border-top: 4px solid #B898D0;">
                                    <tr>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="ongikar-nama" style="margin-bottom: 40px;margin-top: -27px">
                                                    <u><h3 style="text-align: center">অঙ্গীকারনামা</h3></u>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <p>এই মর্মে ঘোষণা করা যাইতেছে যে,লজিক অটোমেশন ট্রেনিং ইনিস্টিউটে  এর সকল কর্মকর্তা ও কর্মচারীবৃন্দের প্রতিমাসে মূল বেতনের থেকে ১০% কর্তন করা হইবে।</p>
                                    </tr>
                                    <tr>
                                        <p>যদি কোন কর্মকর্তা ও কর্মচারীবৃন্দ চাকুরীতে যোগদানের এক (১) বছর এর পূর্বে চাকুরী ছেড়ে দেয়, তাহলে তাহাকে উক্ত কর্তনকৃত টাকা প্রদান করা হইবে না। </p>

                                        <p>যদি কোন কর্মকর্তা ও কর্মচারীবৃন্দ ১ বছর থেকে ২ বছরের মধ্যে চাকুরী ছেড়ে দেয়, তাহলে তাহাকে উক্ত কর্তনকৃত টাকা থেকে ৪০% প্রদান করা হইবে এবং বাকি ৬০% প্রতিষ্ঠান রেখে দিবে। </p>

                                        <p>যদি কোন কর্মকর্তা ও কর্মচারীবৃন্দ ২ বছর থেকে ৫ বছরের মধ্যে চাকুরী ছেড়ে দেয়, তাহলে তাহাকে উক্ত কর্তনকৃত টাকার সম্পূর্ণ টাকা প্রদান করা হইবে। </p>

                                        <p>আরও উল্লেখ্য যে,  যদি কোন কর্মকর্তা ও কর্মচারীবৃন্দ ২ বছর থেকে ৫ বছর পূর্ণ হইলে কর্তনকৃত টাকা বা জমানো টাকার দ্বিগুণ টাকা প্রদান করা হইবে। </p>
                                        <p>এবং  প্রতিষ্ঠানের চাকুরী ছাড়িবার তিনমাস আগে প্রতিষ্ঠান প্রধানকে নোটিশ প্রদান করিতে হইবে  </p>
                                        <p>যদি কোন কর্মকর্তা-কর্মচারী মারাত্মক ক্ষতি বা কর্মক্ষমতা হারালে বা মারা গেলে তাহারা জমানো টাকার দ্বিগুণ টাকা তাহাকে বা তাহার নির্বাচিত নমিনীকে প্রদান করা হইবে।</p>
                                    </tr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="order-part" style="margin-top: 40px;margin-bottom: 95px">
                                                <p>নির্দেশক্রমে</p>
                                                <p>কর্তৃপক্ষ</p>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <hr style="border-top: 2px solid #555">
                                                <p style="text-align: center;margin-top: -17px">কৌশিক আহমেদ শাকিল </p>
                                                <p style="text-align: center;">চেয়ারম্যান </p>
                                                <p style="text-align: center;">লজিক অটোমেশন ট্রেনিং ইনস্টিটিউট</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <hr style="border-top: 2px solid #555">
                                                <p style="text-align: center; margin-top: -17px">মোঃ আজিজুর রহমান</p>
                                                <p style="text-align: center;">ব্যবস্থাপনা পরিচালক</p>
                                                <p style="text-align: center;">লজিক অটোমেশন ট্রেনিং ইনস্টিটিউট</p>
                                            </div>
                                            <div class="col-xs-4">
                                                <hr style="border-top: 2px solid #555">
                                                <p style="text-align: center;margin-top: -17px">মোঃ সাইফুল ইসলাম </p>
                                                <p style="text-align: center;">পরিচালক</p>
                                                <p style="text-align: center;">লজিক অটোমেশন ট্রেনিং ইনস্টিটিউট</p>
                                            </div>
                                        </div>
                                    </tr>
                                    <tr>
                                        <div class="border-part" style="margin-top: 20px;">
                                            <td width="20%" style="text-align: center">ক্রমিক নং</td>
                                            <td width="26.66%" style="text-align: center">নাম</td>
                                            <td width="26.66%" style="text-align: center">পদবী</td>
                                            <td width="26.66%" style="text-align: center">স্বাক্ষর</td>
                                        </div>
                                    </tr>
                                    <tr>
                                        <td width="20%" style="text-align: center">{{$candidate->id}}</td>
                                        <td width="26.66%" style="text-align: center">{{$candidate->name}}</td>
                                        <td width="26.66%" style="text-align: center">{{$candidate->designation->name}}</td>
                                        <td width="26.66%" style="text-align: center"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr style="border-top: 4px solid #B898D0;margin-left: 40px;margin-right: 40px;margin-top: -8px;">
                        <p style="text-align: center;margin-top: -17px;">Address: Mariam Tower 1st Floor, Polytechnic Road, Boroytola More, Gangkola, Pabna-6600.</p>
                        <p style="text-align: center">Mobile: +088 01711-955 452, 01812-955 452, 01711-220 128, 01723-655 858</p>
                        <p style="text-align: center">E-mail: logicgroupbd@gmail.com, Web: www.logicgroupbd.com</p>
                        <table class="table table-bordered" style="" >
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>

@endsection


