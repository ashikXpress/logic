<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/Ionicons/css/ionicons.min.css') }}">

    @yield('style')


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/css/custom.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>AP</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <h4 class="pull-left" style="color: white; margin-top: 15px; padding-left: 20px">{{ config('app.name') }}</h4>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('img/avatar.png') }}" class="user-image" alt="Avatar">
                            <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>

                <?php
                $subMenu = ['all_course','create_course','course_edit', 'all_batch','create_batch',
                    'batch_edit', 'all_student','new_admission','all_department','create_department',
                    'course_department'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Training</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'all_department' ? 'active' : '' }}">
                            <a href="{{ route('all_department') }}"><i class="fa fa-circle-o"></i>Department</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'all_course' ? 'active' : '' }}">
                            <a href="{{ route('all_course') }}"><i class="fa fa-circle-o"></i>Course</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'all_batch' ? 'active' : '' }}">
                            <a href="{{ route('all_batch') }}"><i class="fa fa-circle-o"></i>Batch</a>
                        </li>
                        <?php
                        $subSubMenu = ['all_student','new_admission'];
                        ?>
                        <li class="treeview {{ in_array(Route::currentRouteName(), $subSubMenu) ? 'active' : '' }}">
                            <a href="#"><i class="fa fa-circle-o"></i> Student
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subSubMenu) ? 'active menu-open' : '' }}">
                                <li class="{{ Route::currentRouteName() == 'new_admission' ? 'active' : '' }}">
                                    <a href="{{ route('new_admission') }}"><i class="fa fa-circle-o"></i> New Admission</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'all_student' ? 'active' : '' }}">
                                    <a href="{{ route('all_student') }}"><i class="fa fa-circle-o"></i> All Student</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>

                <?php
                $subMenu = ['unit', 'unit.add', 'unit.edit', 'department', 'department.add', 'department.edit', 'designation',
                    'designation.add', 'designation.edit', 'sister_concern', 'sister_concern.add',
                    'sister_concern.edit', 'client', 'client.add', 'client.edit', 'project',
                    'project.add', 'project.edit', 'product', 'product.add',
                    'product.edit', 'warehouse', 'warehouse.add', 'warehouse.edit'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'unit' ? 'active' : '' }}">
                            <a href="{{ route('unit') }}"><i class="fa fa-circle-o"></i> Unit</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'warehouse' ? 'active' : '' }}">
                            <a href="{{ route('warehouse') }}"><i class="fa fa-circle-o"></i> Warehouse</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'department' ? 'active' : '' }}">
                            <a href="{{ route('department') }}"><i class="fa fa-circle-o"></i> Department</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'designation' ? 'active' : '' }}">
                            <a href="{{ route('designation') }}"><i class="fa fa-circle-o"></i> Designation</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'sister_concern' ? 'active' : '' }}">
                            <a href="{{ route('sister_concern') }}"><i class="fa fa-circle-o"></i> Sister Concern</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'client' ? 'active' : '' }}">
                            <a href="{{ route('client') }}"><i class="fa fa-circle-o"></i> Client</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'project' ? 'active' : '' }}">
                            <a href="{{ route('project') }}"><i class="fa fa-circle-o"></i> Project</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'product' ? 'active' : '' }}">
                            <a href="{{ route('product') }}"><i class="fa fa-circle-o"></i> Product</a>
                        </li>
                    </ul>
                </li>

                <?php
                $subMenu = ['bank', 'bank.add', 'bank.edit', 'branch', 'branch.add', 'branch.edit',
                    'bank_account', 'bank_account.add', 'bank_account.edit'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Bank & Account</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'bank' ? 'active' : '' }}">
                            <a href="{{ route('bank') }}"><i class="fa fa-circle-o"></i> Bank</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'branch' ? 'active' : '' }}">
                            <a href="{{ route('branch') }}"><i class="fa fa-circle-o"></i> Branch</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'bank_account' ? 'active' : '' }}">
                            <a href="{{ route('bank_account') }}"><i class="fa fa-circle-o"></i> Account</a>
                        </li>
                    </ul>
                </li>

                <?php
                $subMenu = ['candidate_evalution_form','candidate_evalution_form.all','appointment_letter.all','agreement_letter.all','employee.all',
                    'employee.add', 'employee.edit', 'employee.details','employee.attendance','report.employee_list','employee.id_card', 'employee.attendance_application_view',
                    'acceptance_of_Resignation.all','experience_certificate.all','Employee_information.all','job_description.all','job_description','job_description_input',
                    'employee_information_details','experience_certificate_input','experience_certificate','resignation_letter_input','leave_application_form','employee.attendance_application_in_charge','employee.attendance_application_hr',
                    'acceptance_of_Resignation','candidate_agreement_letter','appointment_letter_input','candidate_appointment_letter','leave_application',
                    'extension_letter.all','extension_letter','extension_letter_input','warning_letter.all','warning_letter','warning_letter_input','employment_offer_letter.all',
                    'employment_offer_letter','employment_offer_letter_input','job_confirmation_letter.all','job_confirmation_letter','job_confirmation_letter_input',
                    'employee.attendance.process','employee.excelfileimport','candidate_evalution_form.add','candidate_evalution_form.edit','candidate_evalution_form.details'
                     ,'academic_and_training.all','training_information.all','job_information.all'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>HR</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">

                        <li class="{{ Route::currentRouteName() == 'candidate_evalution_form.all' ? 'active' : '' }}">
                            <a href="{{ route('candidate_evalution_form.all') }}"><i class="fa fa-circle-o"></i> Candidate Evalution Form</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'employee.all' ? 'active' : '' }}">
                            <a href="{{ route('employee.all') }}"><i class="fa fa-circle-o"></i> Employee</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'report.employee_list' ? 'active' : '' }}">
                            <a href="{{ route('report.employee_list') }}"><i class="fa fa-circle-o"></i> Employee List</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.attendance' ? 'active' : '' }}">
                            <a href="{{ route('employee.attendance') }}"><i class="fa fa-circle-o"></i> Employee Attendance</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.attendance.process' ? 'active' : '' }}">
                            <a href="{{ route('employee.attendance.process') }}"><i class="fa fa-circle-o"></i> Employee Attendance Process</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.attendance_application_view' ? 'active' : '' }}">
                            <a href="{{ route('employee.attendance_application_view') }}"><i class="fa fa-circle-o"></i> Employee Attendance Application</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.attendance_application_in_charge' ? 'active' : '' }}">
                            <a href="{{ route('employee.attendance_application_in_charge') }}"><i class="fa fa-circle-o"></i>Attendance Application Incharge</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.attendance_application_hr' ? 'active' : '' }}">
                            <a href="{{ route('employee.attendance_application_hr') }}"><i class="fa fa-circle-o"></i>Attendance Application Hr</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.excelfileimport' ? 'active' : '' }}">
                            <a href="{{ route('employee.excelfileimport') }}"><i class="fa fa-circle-o"></i>Attendance Excel Import</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employee.id_card' ? 'active' : '' }}">
                            <a href="{{ route('employee.id_card') }}"><i class="fa fa-circle-o"></i> Employee ID Card</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'appointment_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('appointment_letter.all') }}"><i class="fa fa-circle-o"></i> Appointment Letter</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'agreement_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('agreement_letter.all') }}"><i class="fa fa-circle-o"></i> Agreement Letter</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'acceptance_of_Resignation.all' ? 'active' : '' }}">
                            <a href="{{ route('acceptance_of_Resignation.all') }}"><i class="fa fa-circle-o"></i> Acceptance of Resignation</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'experience_certificate.all' ? 'active' : '' }}">
                            <a href="{{ route('experience_certificate.all') }}"><i class="fa fa-circle-o"></i> Experience certificate</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'Employee_information.all' ? 'active' : '' }}">
                            <a href="{{ route('Employee_information.all') }}"><i class="fa fa-circle-o"></i> Employee Information</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'job_description.all' ? 'active' : '' }}">
                            <a href="{{ route('job_description.all') }}"><i class="fa fa-circle-o"></i> Job Description</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'leave_application' ? 'active' : '' }}">
                            <a href="{{ route('leave_application') }}"><i class="fa fa-circle-o"></i> Leave Application</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'extension_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('extension_letter.all') }}"><i class="fa fa-circle-o"></i> Extension Letter</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'employment_offer_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('employment_offer_letter.all') }}"><i class="fa fa-circle-o"></i> Employment Offer Letter</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'job_confirmation_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('job_confirmation_letter.all') }}"><i class="fa fa-circle-o"></i> Job Confirmation</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'warning_letter.all' ? 'active' : '' }}">
                            <a href="{{ route('warning_letter.all') }}"><i class="fa fa-circle-o"></i> Warning Letter</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'academic_and_training.all' ? 'active' : '' }}">
                            <a href="{{ route('academic_and_training.all') }}"><i class="fa fa-circle-o"></i>Academic & Training</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'training_information.all' ? 'active' : '' }}">
                            <a href="{{ route('training_information.all') }}"><i class="fa fa-circle-o"></i>Training Information</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'job_information.all' ? 'active' : '' }}">
                            <a href="{{ route('job_information.all') }}"><i class="fa fa-circle-o"></i>Job Information</a>
                        </li>

                    </ul>
                </li>

                <?php
                $subMenu = ['payroll.salary_update.index', 'payroll.salary_process.index',
                    'payroll.leave.index','payroll.holiday.index','payroll.holiday_add','payroll.holiday_edit',
                    'payroll.salary_process.report','payroll.deduction_history','payroll.salary.slip',
                    'payroll.consolidation','payroll.salary.approved-list','payroll.employee.leave.information','payroll.employee.payment.history',
                    'payroll.all.employee.data','payroll.create.loan','payroll.employee_wise.leave',
                    'payroll.create.pf_loan','payroll.create.skrp_loan'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Payroll</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'payroll.salary_update.index' ? 'active' : '' }}">
                            <a href="{{ route('payroll.salary_update.index') }}"><i class="fa fa-circle-o"></i> Salary Update</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'payroll.salary_process.index' ? 'active' : '' }}">
                            <a href="{{ route('payroll.salary_process.index') }}"><i class="fa fa-circle-o"></i> Salary Process</a>
                        </li>

{{--                        <li class="{{ Route::currentRouteName() == 'payroll.salary_process.report' ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('payroll.salary_process.report') }}"><i class="fa fa-circle-o"></i> Salary Process Report</a>--}}
{{--                        </li>--}}

                        <li class="{{ Route::currentRouteName() == 'payroll.deduction_history' ? 'active' : '' }}">
                            <a href="{{ route('payroll.deduction_history') }}"><i class="fa fa-circle-o"></i> Deduction History</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'payroll.leave.index' ? 'active' : '' }}">
                            <a href="{{ route('payroll.leave.index') }}"><i class="fa fa-circle-o"></i> Leave</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.salary.slip' ? 'active' : '' }}">
                            <a href="{{ route('payroll.salary.slip') }}"><i class="fa fa-circle-o"></i>Salary Slip</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.consolidation' ? 'active' : '' }}">
                            <a href="{{ route('payroll.consolidation') }}"><i class="fa fa-circle-o"></i>Consolidation</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.salary.approved-list' ? 'active' : '' }}">
                            <a href="{{ route('payroll.salary.approved-list') }}"><i class="fa fa-circle-o"></i>Pre-Salary Approved List</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.employee.leave.information' ? 'active' : '' }}">
                            <a href="{{ route('payroll.employee.leave.information') }}"><i class="fa fa-circle-o"></i>Employee Leave Information</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.employee.payment.history' ? 'active' : '' }}">
                            <a href="{{ route('payroll.employee.payment.history') }}"><i class="fa fa-circle-o"></i>Employee Payment History</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.all.employee.data' ? 'active' : '' }}">
                            <a href="{{ route('payroll.all.employee.data') }}"><i class="fa fa-circle-o"></i>All Employee Data</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.create.loan' ? 'active' : '' }}">
                            <a href="{{ route('payroll.create.loan') }}"><i class="fa fa-circle-o"></i>Create Loan</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.create.pf_loan' ? 'active' : '' }}">
                            <a href="{{ route('payroll.create.pf_loan') }}"><i class="fa fa-circle-o"></i>Create PF Loan</a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'payroll.create.skrp_loan' ? 'active' : '' }}">
                            <a href="{{ route('payroll.create.skrp_loan') }}"><i class="fa fa-circle-o"></i>Create SKRP Loan</a>
                        </li>
{{--                        <li class="{{ Route::currentRouteName() == 'payroll.holiday.index' ? 'active' : '' }}">--}}
{{--                            <a href="{{ route('payroll.holiday.index') }}"><i class="fa fa-circle-o"></i> Holiday</a>--}}
{{--                        </li>--}}

                    </ul>
                </li>

                <?php
                $subMenu = ['supplier', 'supplier.add', 'supplier.edit', 'purchase_order.create',
                    'purchase_receipt.all', 'purchase_receipt.details', 'purchase_inventory.all',
                    'supplier_payment.all', 'purchase_receipt.payment_details', 'utilize.all',
                    'utilize.add', 'purchase_inventory.details','supplier_payment_details'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Purchase</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'supplier' ? 'active' : '' }}">
                            <a href="{{ route('supplier') }}"><i class="fa fa-circle-o"></i> Supplier</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'purchase_order.create' ? 'active' : '' }}">
                            <a href="{{ route('purchase_order.create') }}"><i class="fa fa-circle-o"></i> Purchase Order</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'purchase_receipt.all' ? 'active' : '' }}">
                            <a href="{{ route('purchase_receipt.all') }}"><i class="fa fa-circle-o"></i> Receipt</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'supplier_payment.all' ? 'active' : '' }}">
                            <a href="{{ route('supplier_payment.all') }}"><i class="fa fa-circle-o"></i> Supplier Payment</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'purchase_inventory.all' ? 'active' : '' }}">
                            <a href="{{ route('purchase_inventory.all') }}"><i class="fa fa-circle-o"></i> Inventory</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'utilize.all' ? 'active' : '' }}">
                            <a href="{{ route('utilize.all') }}"><i class="fa fa-circle-o"></i> Utilize</a>
                        </li>
                    </ul>
                </li>

                <?php
                $subMenu = ['sales_order.create', 'sale_receipt.all', 'sale_receipt.details',
                    'sale_receipt.payment_details', 'customer_payment.all', 'sale_receipt.edit',
                    'client_payment.all'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Sale</span>
                        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'sales_order.create' ? 'active' : '' }}">
                            <a href="{{ route('sales_order.create') }}"><i class="fa fa-circle-o"></i> Sales Order</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'sale_receipt.all' ? 'active' : '' }}">
                            <a href="{{ route('sale_receipt.all') }}"><i class="fa fa-circle-o"></i> Receipt</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'client_payment.all' ? 'active' : '' }}">
                            <a href="{{ route('client_payment.all') }}"><i class="fa fa-circle-o"></i> Client Payment</a>
                        </li>
                    </ul>
                </li>

                <?php
                $subMenu = ['account_head.type', 'account_head.type.add', 'account_head.type.edit',
                    'account_head.sub_type', 'account_head.sub_type.add', 'account_head.sub_type.edit',
                    'transaction.all', 'transaction.add', 'transaction.details', 'balance_transfer.add',
                    'project_payment.all'];
                ?>

                <li class="treeview {{ in_array(Route::currentRouteName(), $subMenu) ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-circle-o text-danger"></i> <span>Accounts</span>
                        <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu {{ in_array(Route::currentRouteName(), $subMenu) ? 'active menu-open' : '' }}">
                        <li class="{{ Route::currentRouteName() == 'account_head.type' ? 'active' : '' }}">
                            <a href="{{ route('account_head.type') }}"><i class="fa fa-circle-o"></i> Account Head Type</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'account_head.sub_type' ? 'active' : '' }}">
                            <a href="{{ route('account_head.sub_type') }}"><i class="fa fa-circle-o"></i> Account Head Sub Type</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'transaction.all' ? 'active' : '' }}">
                            <a href="{{ route('transaction.all') }}"><i class="fa fa-circle-o"></i> Transaction</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'balance_transfer.add' ? 'active' : '' }}">
                            <a href="{{ route('balance_transfer.add') }}"><i class="fa fa-circle-o"></i> Balance Transfer</a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'project_payment.all' ? 'active' : '' }}">
                            <a href="{{ route('project_payment.all') }}"><i class="fa fa-circle-o"></i> Project Payment</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Design & Developed By <a target="_blank" href="http://2aitbd.com">2A IT</a></b>
        </div>
        <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('dashboard') }}">{{ config('app.name') }}</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('themes/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('themes/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@yield('script')
<!-- AdminLTE App -->
<script src="{{ asset('themes/backend/js/adminlte.min.js') }}"></script>
</body>
</html>
