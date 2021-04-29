@extends('layouts.app')



@section('title')
    Employee List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report.employee_list') }}">
                        <div class="row">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><br>

                    <div id="prinarea">
                       <div style="padding:10px; width:100%; text-align:center;">
                            <h2>{{ config('app.name') }}</h2>
                            <h4>Corporate Office : Plot # 314/A, Road # 18, Block # E , Bashundhara R/A, Dhaka-1229</h4>
                           <h4>
                               @if (request()->get('category')==1)
                                   Dhaka Office Employees
                               @elseif(request()->get('category')==2)
                                   Factory Employees
                               @elseif(request()->get('category')=='')
                                   Dhaka Office and Factory Employees
                               @endif
                           </h4>
                        </div>
                         <table id="table" class="table table-bordered table-striped">
                             <thead>
                             <tr >
                                 <th class="text-center">ID</th>
                                 <th class="text-center">Name</th>
                                 <th class="text-center">Designation</th>
                                 <th class="text-center">Department</th>
                                 <th class="text-center">Mobile</th>
                                 <th class="text-center">Employee Type</th>

                             </tr>
                             </thead>
                             <tbody>
                             @foreach($employees as $employee)
                                 <tr>
                                     <td class="text-center">{{$employee->employee_id}}</td>
                                     <td class="text-center">{{$employee->name}}</td>
                                     <td class="text-center">{{$employee->designation->name}}</td>
                                     <td class="text-center">{{$employee->department->name}}</td>
                                     <td class="text-center">{{$employee->mobile_no}}</td>
                                     <td class="text-center">
                                         @if($employee->employee_type== 1)
                                         <span class="label label-success">Permanent</span>
                                         @else
                                         <span class="label label-warning">Temponary</span>

                                         @endif

                                     </td>
                                 </tr>
                             @endforeach
                             </tbody>
                         </table>

                     </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>


        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea) {

            $('body').html($('#'+prinarea).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
