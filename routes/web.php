<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');


   // Traning//Department
    Route::get('training-department', 'TrainingDepartmentController@all')->name('all_department');
    Route::get('create-department', 'TrainingDepartmentController@createDepartment')->name('create_department');
    Route::post('create-department', 'TrainingDepartmentController@createDepartmentPost');
    Route::get('create-department-edit/{department}', 'TrainingDepartmentController@editDepartment')->name('department_edit');
    Route::post('create-department-edit/{department}', 'TrainingDepartmentController@editDepartmentPost');

    // Traning//Project
    Route::get('training-course', 'TrainingCourseController@all')->name('all_course');
    Route::get('create-course', 'TrainingCourseController@createCourse')->name('create_course');
    Route::post('create-course', 'TrainingCourseController@createCoursePost');
    Route::get('create-course-edit/{course}', 'TrainingCourseController@editCourse')->name('course_edit');
    Route::post('create-course-edit/{course}', 'TrainingCourseController@editCoursePost');

    // Traning//batch
    Route::get('batch', 'TrainingBatchController@all')->name('all_batch');
    Route::get('create-batch', 'TrainingBatchController@createBatch')->name('create_batch');
    Route::post('create-batch', 'TrainingBatchController@createBatchPost');
    Route::get('create-batch-edit/{batch}', 'TrainingBatchController@editBatch')->name('batch_edit');
    Route::post('create-batch-edit/{batch}', 'TrainingBatchController@editBatchPost');

    // Traning//Student
    Route::get('student', 'TrainingStudentController@all')->name('all_student');
    Route::get('student/datatable', 'TrainingStudentController@studentDatatable')->name('student.all.datatable');
    Route::get('new-admission', 'TrainingStudentController@newAdmission')->name('new_admission');
    Route::post('new-admission', 'TrainingStudentController@newAdmissionPost');
    Route::get('new-admission-edit/{studentAdmission}', 'TrainingStudentController@newAdmissionEdit')->name('new_admission_edit');
    Route::post('new-admission-edit/{studentAdmission}', 'TrainingStudentController@newAdmissionEditPost');
    Route::get('new-admission-Details/{studentAdmission}', 'TrainingStudentController@newAdmissionDetails')->name('new_admission_details');
    Route::get('student-delete-confirm', 'TrainingStudentController@studentDelete')->name('student_delete_confirm');
    Route::post('create-student', 'TrainingStudentController@createStudentPost');
    Route::get('create-student-edit/{student}', 'TrainingStudentController@editStudent')->name('student_edit');
    Route::post('create-student-edit/{student}', 'TrainingStudentController@editStudentPost');

    // Warehouse
    Route::get('warehouse', 'WarehouseController@index')->name('warehouse');
    Route::get('warehouse/add', 'WarehouseController@add')->name('warehouse.add');
    Route::post('warehouse/add', 'WarehouseController@addPost');
    Route::get('warehouse/edit/{warehouse}', 'WarehouseController@edit')->name('warehouse.edit');
    Route::post('warehouse/edit/{warehouse}', 'WarehouseController@editPost');

    // Unit
    Route::get('unit', 'UnitController@index')->name('unit');
    Route::get('unit/add', 'UnitController@add')->name('unit.add');
    Route::post('unit/add', 'UnitController@addPost');
    Route::get('unit/edit/{unit}', 'UnitController@edit')->name('unit.edit');
    Route::post('unit/edit/{unit}', 'UnitController@editPost');

    // Department
    Route::get('department', 'DepartmentController@index')->name('department');
    Route::get('department/add', 'DepartmentController@add')->name('department.add');
    Route::post('department/add', 'DepartmentController@addPost');
    Route::get('department/edit/{department}', 'DepartmentController@edit')->name('department.edit');
    Route::post('department/edit/{department}', 'DepartmentController@editPost');

    // Designation
    Route::get('designation', 'DesignationController@index')->name('designation');
    Route::get('designation/add', 'DesignationController@add')->name('designation.add');
    Route::post('designation/add', 'DesignationController@addPost');
    Route::get('designation/edit/{designation}', 'DesignationController@edit')->name('designation.edit');
    Route::post('designation/edit/{designation}', 'DesignationController@editPost');

    // Sister Concern
    Route::get('sister-concern', 'SisterConcernController@index')->name('sister_concern');
    Route::get('sister-concern/add', 'SisterConcernController@add')->name('sister_concern.add');
    Route::post('sister-concern/add', 'SisterConcernController@addPost');
    Route::get('sister-concern/edit/{sisterConcern}', 'SisterConcernController@edit')->name('sister_concern.edit');
    Route::post('sister-concern/edit/{sisterConcern}', 'SisterConcernController@editPost');

    // Client
    Route::get('client', 'ClientController@index')->name('client');
    Route::get('client/add', 'ClientController@add')->name('client.add');
    Route::post('client/add', 'ClientController@addPost');
    Route::get('client/edit/{client}', 'ClientController@edit')->name('client.edit');
    Route::post('client/edit/{client}', 'ClientController@editPost');

    // Project
    Route::get('project', 'ProjectController@index')->name('project');
    Route::get('project/add', 'ProjectController@add')->name('project.add');
    Route::post('project/add', 'ProjectController@addPost');
    Route::get('project/edit/{project}', 'ProjectController@edit')->name('project.edit');
    Route::post('project/edit/{project}', 'ProjectController@editPost');

    // Bank
    Route::get('bank', 'BankController@index')->name('bank');
    Route::get('bank/add', 'BankController@add')->name('bank.add');
    Route::post('bank/add', 'BankController@addPost');
    Route::get('bank/edit/{bank}', 'BankController@edit')->name('bank.edit');
    Route::post('bank/edit/{bank}', 'BankController@editPost');

    // Bank Branch
    Route::get('bank-branch', 'BranchController@index')->name('branch');
    Route::get('bank-branch/add', 'BranchController@add')->name('branch.add');
    Route::post('bank-branch/add', 'BranchController@addPost');
    Route::get('bank-branch/edit/{branch}', 'BranchController@edit')->name('branch.edit');
    Route::post('bank-branch/edit/{branch}', 'BranchController@editPost');

    // Bank Account
    Route::get('bank-account', 'BankAccountController@index')->name('bank_account');
    Route::get('bank-account/add', 'BankAccountController@add')->name('bank_account.add');
    Route::post('bank-account/add', 'BankAccountController@addPost');
    Route::get('bank-account/edit/{account}', 'BankAccountController@edit')->name('bank_account.edit');
    Route::post('bank-account/edit/{account}', 'BankAccountController@editPost');
    Route::get('bank-account/get-branches', 'BankAccountController@getBranches')->name('bank_account.get_branch');

    // Product
    Route::get('product', 'ProductController@index')->name('product');
    Route::get('product/add', 'ProductController@add')->name('product.add');
    Route::post('product/add', 'ProductController@addPost');
    Route::get('product/edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::post('product/edit/{product}', 'ProductController@editPost');

    // Supplier
    Route::get('supplier', 'SupplierController@index')->name('supplier');
    Route::get('supplier/add', 'SupplierController@add')->name('supplier.add');
    Route::post('supplier/add', 'SupplierController@addPost');
    Route::get('supplier/edit/{supplier}', 'SupplierController@edit')->name('supplier.edit');
    Route::post('supplier/edit/{supplier}', 'SupplierController@editPost');

    // Purchase Order
    Route::get('purchase-order', 'PurchaseController@purchaseOrder')->name('purchase_order.create');
    Route::post('purchase-order', 'PurchaseController@purchaseOrderPost');
    Route::get('purchase-product-json', 'PurchaseController@purchaseProductJson')->name('purchase_product.json');

    // Purchase Receipt
    Route::get('purchase-receipt', 'PurchaseController@purchaseReceipt')->name('purchase_receipt.all');
    Route::get('purchase-receipt/details/{order}', 'PurchaseController@purchaseReceiptDetails')->name('purchase_receipt.details');
    Route::get('purchase-receipt/print/{order}', 'PurchaseController@purchaseReceiptPrint')->name('purchase_receipt.print');
    Route::get('purchase-receipt/datatable', 'PurchaseController@purchaseReceiptDatatable')->name('purchase_receipt.datatable');
    Route::post('purchase-receipt/receive', 'PurchaseController@orderReceive')->name('purchase_receipt.receive');
    Route::get('purchase-receipt/payment/details/{payment}', 'PurchaseController@purchasePaymentDetails')->name('purchase_receipt.payment_details');
    Route::get('purchase-receipt/payment/print/{payment}', 'PurchaseController@purchasePaymentPrint')->name('purchase_receipt.payment_print');

    // Supplier Payment
    Route::get('supplier-payment', 'PurchaseController@supplierPayment')->name('supplier_payment.all');
    Route::get('supplier-payment/get-orders', 'PurchaseController@supplierPaymentGetOrders')->name('supplier_payment.get_orders');
    Route::get('supplier-payment/order-details', 'PurchaseController@supplierPaymentOrderDetails')->name('supplier_payment.order_details');
    Route::post('supplier-payment/payment', 'PurchaseController@makePayment')->name('supplier_payment.make_payment');

    // Purchase Inventory
    Route::get('purchase-inventory', 'PurchaseController@purchaseInventory')->name('purchase_inventory.all');
    Route::get('purchase-inventory/datatable', 'PurchaseController@purchaseInventoryDatatable')->name('purchase_inventory.datatable');
    Route::get('purchase-inventory/details/datatable', 'PurchaseController@purchaseInventoryDetailsDatatable')->name('purchase_inventory.details.datatable');
    Route::get('purchase-inventory/details/{inventory}', 'PurchaseController@purchaseInventoryDetails')->name('purchase_inventory.details');

    // Utilize
    Route::get('utilize', 'PurchaseController@utilizeIndex')->name('utilize.all');
    Route::get('utilize/datatable', 'PurchaseController@utilizeDatatable')->name('utilize.datatable');
    Route::get('utilize/add', 'PurchaseController@utilizeAdd')->name('utilize.add');
    Route::post('utilize/add', 'PurchaseController@utilizeAddPost');

    // Sales Order
    Route::get('sales-order', 'SaleController@salesOrder')->name('sales_order.create');
    Route::post('sales-order', 'SaleController@salesOrderPost');
    Route::get('sale-order/product/details', 'SaleController@saleProductDetails')->name('sale_product.details');

    // Sale Receipt
    Route::get('sale-receipt', 'SaleController@saleReceipt')->name('sale_receipt.all');
    Route::get('sale-receipt/details/{order}', 'SaleController@saleReceiptDetails')->name('sale_receipt.details');
    Route::get('sale-receipt/print/{order}', 'SaleController@saleReceiptPrint')->name('sale_receipt.print');
    Route::get('sale-receipt/datatable', 'SaleController@saleReceiptDatatable')->name('sale_receipt.datatable');
    Route::get('sale-receipt/payment/details/{payment}', 'SaleController@salePaymentDetails')->name('sale_receipt.payment_details');
    Route::get('sale-receipt/payment/print/{payment}', 'SaleController@salePaymentPrint')->name('sale_receipt.payment_print');

    // Client Payment
    Route::get('client-payment', 'SaleController@clientPayment')->name('client_payment.all');
    Route::get('client-payment/datatable', 'SaleController@clientPaymentDatatable')->name('client_payment.datatable');
    Route::get('client-payment/get-orders', 'SaleController@clientPaymentGetOrders')->name('client_payment.get_orders');
    Route::post('client-payment/payment', 'SaleController@makePayment')->name('client_payment.make_payment');

    // Account Head Type
    Route::get('account-head/type', 'AccountsController@accountHeadType')->name('account_head.type');
    Route::get('account-head/type/add', 'AccountsController@accountHeadTypeAdd')->name('account_head.type.add');
    Route::post('account-head/type/add', 'AccountsController@accountHeadTypeAddPost');
    Route::get('account-head/type/edit/{type}', 'AccountsController@accountHeadTypeEdit')->name('account_head.type.edit');
    Route::post('account-head/type/edit/{type}', 'AccountsController@accountHeadTypeEditPost');

    // Account Head Sub Type
    Route::get('account-head/sub-type', 'AccountsController@accountHeadSubType')->name('account_head.sub_type');
    Route::get('account-head/sub-type/add', 'AccountsController@accountHeadSubTypeAdd')->name('account_head.sub_type.add');
    Route::post('account-head/sub-type/add', 'AccountsController@accountHeadSubTypeAddPost');
    Route::get('account-head/sub-type/edit/{subType}', 'AccountsController@accountHeadSubTypeEdit')->name('account_head.sub_type.edit');
    Route::post('account-head/sub-type/edit/{subType}', 'AccountsController@accountHeadSubTypeEditPost');

    // Transaction
    Route::get('transaction', 'AccountsController@transactionIndex')->name('transaction.all');
    Route::get('transaction/datatable', 'AccountsController@transactionDatatable')->name('transaction.datatable');
    Route::get('transaction/add', 'AccountsController@transactionAdd')->name('transaction.add');
    Route::post('transaction/add', 'AccountsController@transactionAddPost');
    Route::post('transaction/edit', 'AccountsController@transactionEditPost')->name('transaction.edit_post');
    Route::get('transaction/details/json', 'AccountsController@transactionDetailsJson')->name('transaction.details_json');
    Route::get('transaction/details/{transaction}', 'AccountsController@transactionDetails')->name('transaction.details');
    Route::get('transaction/print/{transaction}', 'AccountsController@transactionPrint')->name('transaction.print');

    // Balance Transfer
    Route::get('balance-transfer/add', 'AccountsController@balanceTransferAdd')->name('balance_transfer.add');
    Route::post('balance-transfer/add', 'AccountsController@balanceTransferAddPost');

    // Project Payment
    Route::get('project-payment', 'AccountsController@projectPayment')->name('project_payment.all');
    Route::get('project-payment/datatable', 'AccountsController@projectPaymentDatatable')->name('project_payment.datatable');
    Route::get('project-payment/get-project', 'AccountsController@projectPaymentGetProjects')->name('project_payment.get_projects');
    Route::post('project-payment/payment', 'AccountsController@makeProjectPayment')->name('project_payment.make_payment');

    //HR// Candidte Evalution Form
    Route::get('candidate-evalution-form', 'HRController@candidateEvalutionFormIndex')->name('candidate_evalution_form.all');
    Route::get('candidate-evalution-form/datatable', 'HRController@candidateEvalutionFormDatatable')->name('candidate_evalution_form.datatable');
    Route::get('candidate-evalution-form/add', 'HRController@candidateEvalutionAdd')->name('candidate_evalution_form.add');
    Route::post('candidate-evalution-form/add', 'HRController@candidateEvalutionPost');
    Route::get('candidate-evalution-form/edit/{candidate}', 'HRController@candidateEvalutionEdit')->name('candidate_evalution_form.edit');
    Route::post('candidate-evalution-form/edit/{candidate}', 'HRController@candidateEvalutionEditPost');
    Route::get('candidate-evalution-form/details/{candidate}', 'HRController@candidateEvalutionDetails')->name('candidate_evalution_form.details');

      Route::get('candidate-evaluation/{candidate}', 'HRController@candidateEvaluation')->name('candidate_evaluation');
    Route::post('candidate-evaluation/{candidate}', 'HRController@candidateEvaluationPost');
    Route::get('candidate-evaluation-print/{candidate}', 'HRController@candidateEvaluationPrint')->name('candidate_evaluation_print');
    Route::get('candidate-promotion-proposal/{candidate}', 'HRController@promotionProposal')->name('promotion_proposal');
    Route::post('candidate-promotion-proposal/{candidate}', 'HRController@promotionProposalPost');
    Route::get('candidate-promotion-proposal-print/{candidate}', 'HRController@promotionProposalPrint')->name('promotion_proposal_print');





    // HR
    Route::get('employee', 'HRController@employeeAll')->name('employee.all');
    Route::get('employee/datatable', 'HRController@employeeDatatable')->name('employee.all.datatable');
    Route::get('employee/add', 'HRController@employeeAdd')->name('employee.add');
    Route::post('employee/add', 'HRController@employeeAddPost');
    Route::get('employee/edit/{employee}', 'HRController@employeeEdit')->name('employee.edit');
    Route::post('employee/edit/{employee}', 'HRController@employeeEditPost');
    Route::get('employee/details/{employee}', 'HRController@employeeDetails')->name('employee.details');
    Route::post('employee/designation/update', 'HRController@employeeDesignationUpdate')->name('employee.designation_update');
    Route::get('employee/attendance', 'HRController@employeeAttendance')->name('employee.attendance');
    Route::post('employee/attendance', 'HRController@employeeAttendancePost');
    Route::get('employee/attendance/process', 'HRController@employeeAttendanceProcess')->name('employee.attendance.process');
    Route::post('employee/attendance/process', 'HRController@employeeAttendanceProcessPost');
    Route::get('employee/wise/attendance/{candidate}', 'HRController@employeeWiseAttendance')->name('employee_wise_attendance');
    Route::get('attendance/manually/input/{candidate}', 'HRController@attendanceManuallyInput')->name('attendance_manually_input');
    Route::post('attendance/manually/input/{candidate}', 'HRController@attendanceManuallyInputPost');
    Route::post('attendance/overtime/approved/hours', 'HRController@overtimeApprovedHoursPost')->name('overtime_approved_hours.post');
    Route::post('attendance/overtime/reject', 'HRController@overtimeRejectdPost')->name('overtime_reject.post');
    Route::post('attendance/approved/reject', 'HRController@overtimeApprovedPost')->name('overtime_approved.post');
    Route::get('employee/wise/over/time/{candidate}', 'HRController@employeeWiseOvertime')->name('employee_wise_over_time');
    Route::get('employee/excelfileimport', 'HRController@employeeExcelFileImport')->name('employee.excelfileimport');
    Route::post('employee/excelfileimport', 'HRController@employeeExcelFileImportPost');

    Route::get('employee/attendance-application-view', 'HRController@employeeAttendanceApplicationView')->name('employee.attendance_application_view');
    Route::get('employee/attendance-application', 'HRController@employeeAttendanceApplication')->name('employee.attendance_application');
    Route::post('employee/attendance-application', 'HRController@employeeAttendanceApplicationPost');
    Route::get('employee/attendance-application-in-charge', 'HRController@employeeAttendanceApplicationInCharge')->name('employee.attendance_application_in_charge');
    Route::get('employee/attendance-application-hr', 'HRController@employeeAttendanceHr')->name('employee.attendance_application_hr');
    Route::get('employee/attendance-application-status-in-charge/{attendanceApplication}', 'HRController@employeeAttendanceInCharge')->name('attendance_application_status_in_charge');
    Route::get('employee/attendance-application-status-hr/{attendanceApplication}', 'HRController@employeeAttendanceStatusHr')->name('attendance_application_status_hr');


    Route::post('payroll/get-leave', 'HRController@getLeave')->name('employee.get_leaves');



    //HR//Attendance Application

    Route::get('employee/attendance/application', 'HRController@employeeAttendanceApplication')->name('employee_attendance_application');

    // HR//Appointment Letter
    Route::get('candidate-appointment-letter-all', 'HRController@candidateAppointmentLetterAll')->name('appointment_letter.all');
    Route::get('candidate-appointment-letter/datatable', 'HRController@candidateAppointmentLetterDatatable')->name('candidate_appointment_letter.datatable');
    Route::get('candidate-appointment-letter/{candidate}', 'HRController@candidateAppointmentLetter')->name('candidate_appointment_letter');
    Route::get('appointment-letter', 'HRController@appointmentLetter')->name('appointment_letter');
    Route::get('appointment-letter-input/{candidate}', 'HRController@appointmentLetterInput')->name('appointment_letter_input');
    Route::post('appointment-letter-input/{candidate}', 'HRController@appointmentLetterPost');

    // HR//Agreement Letter
    Route::get('candidate-agreement-letter-all', 'HRController@candidateAgreementLetterAll')->name('agreement_letter.all');
    Route::get('candidate-agreement-letter/{candidate}', 'HRController@candidateAgreementLetter')->name('candidate_agreement_letter');



    // HR//Id Card
    Route::get('employee-id-card', 'HRController@employeeIdCard')->name('employee.id_card');
    Route::post('employee-id-card', 'HRController@employeeIdCardPost');

    // HR//Acceptance of Resignation
    Route::get('acceptance-of-Resignation', 'HRController@AcceptanceOfResignation')->name('acceptance_of_Resignation.all');
    Route::get('acceptance-of-Resignation/{candidate}', 'HRController@acceptanceOfResignationLetter')->name('acceptance_of_Resignation');
    Route::get('resignation-letter-input/{candidate}', 'HRController@acceptanceOfResignationLetterInput')->name('resignation_letter_input');
    Route::post('resignation-letter-input/{candidate}', 'HRController@acceptanceOfResignationLetterPost');

    // HR//Acceptance of Resignation
    Route::get('experience-certificate', 'HRController@experienceCertificate')->name('experience_certificate.all');
    Route::get('experience-certificate/{candidate}', 'HRController@experienceCertificatePage')->name('experience_certificate');
    Route::get('experience-certificate-input/{candidate}', 'HRController@experienceCertificateInput')->name('experience_certificate_input');
    Route::post('experience-certificate-input/{candidate}', 'HRController@experienceCertificatePost');

    // HR//Acceptance of Resignation
    Route::get('employee-information', 'HRController@employeeInformation')->name('Employee_information.all');
    Route::get('employee-information-details/{candidate}', 'HRController@employeeInformationDetails')->name('employee_information_details');

    // HR//Job Description
    Route::get('job-description', 'HRController@jobDescription')->name('job_description.all');
    Route::get('job-description/{candidate}', 'HRController@jobDescriptionPage')->name('job_description');
    Route::get('job-description-input/{candidate}', 'HRController@jobDescriptionInput')->name('job_description_input');
    Route::post('job-description-input/{candidate}', 'HRController@jobDescriptionPost');
    // HR//Leave Application Form
    Route::get('leave-application', 'HRController@leaveApplication')->name('leave_application');
    Route::get('leave-application-form/{candidate}', 'HRController@leaveApplicationForm')->name('leave_application_form');
    Route::get('leave-application-confirm', 'HRController@leaveApplicationConfirm')->name('leave_application_confirm');
    Route::get('leave-application-cancel', 'HRController@leaveApplicationCancel')->name('leave_application_cancel');
    Route::post('leave-application-form/{candidate}', 'HRController@leaveApplicationFormPost');

    // HR//Extension Letter
    Route::get('extension-letter', 'HRController@extensionLetter')->name('extension_letter.all');
    Route::get('extension-letter/datatable', 'HRController@extensionLetterDatatable')->name('extension_letter.datatable');
    Route::get('extension-letter/{candidate}', 'HRController@extensionLetterPage')->name('extension_letter');
    Route::get('extension-letter-input/{candidate}', 'HRController@extensionLetterInput')->name('extension_letter_input');
    Route::post('extension-letter-input/{candidate}', 'HRController@extensionLetterPost');

    // HR//Warning Letter
    Route::get('warning-letter', 'HRController@warningLetter')->name('warning_letter.all');
    Route::get('warning-letter/{candidate}', 'HRController@warningLetterPage')->name('warning_letter');
    Route::get('warning-letter-input/{candidate}', 'HRController@warningLetterInput')->name('warning_letter_input');
    Route::post('warning-letter-input/{candidate}', 'HRController@warningLetterPost');

    // HR//Academic & Training
    Route::get('academic-training', 'HRController@academicTraining')->name('academic_and_training.all');
    Route::get('academic-training-form/{candidate}', 'HRController@academicTrainingForm')->name('academic_and_training_form');
    Route::post('academic-training-form/{candidate}', 'HRController@academicTrainingPost');
    Route::get('academic-wise-form/{academicTraining}', 'HRController@academicWiseAdd')->name('academic_wise.add');
    Route::post('academic-wise-form/{academicTraining}', 'HRController@academicWiseAddPost');
    Route::get('academic-wise-edit/{academicTraining}', 'HRController@academicWiseEdit')->name('academic_wise.edit');
    Route::post('academic-wise-edit/{academicTraining}', 'HRController@academicWiseEditPost');
    Route::get('academic-training-details/{candidate}', 'HRController@academicTrainingDetails')->name('academic_and_training.details');
    Route::post('academic-training-post/{candidate}', 'HRController@academicTraining');
    Route::get('academic-training-edit/{candidate}', 'HRController@academicTrainingEdit')->name('academic_and_training.edit');
    Route::post('academic-training-edit/{candidate}', 'HRController@academicTrainingEditPost');
    Route::get('academic-wise-delete', 'HRController@academicWiseDelete')->name('academic_wise.delete');

    // HR//Training Information
    Route::get('training-information', 'HRController@trainingInformation')->name('training_information.all');
    Route::get('training-information-form/{candidate}', 'HRController@trainingInformationForm')->name('training_information_form');
    Route::post('training-information-form/{candidate}', 'HRController@trainingInformationFormPost');
    Route::get('employee-wise-training-information-add/{trainingInformation}', 'HRController@employeeWiseTrainingAdd')->name('employee_wise_training_information.add');
    Route::post('employee-wise-training-information-add/{trainingInformation}', 'HRController@employeeWiseTrainingAddPost');
    Route::get('employee-wise-training-information-edit/{trainingInformation}', 'HRController@employeeWiseTrainingEdit')->name('employee_wise_training_information.edit');
    Route::post('employee-wise-training-information-edit/{trainingInformation}', 'HRController@employeeWiseTrainingEditPost');
    Route::get('employee-wise-training-information-delete', 'HRController@employeeWiseTrainingDelete')->name('employee_wise_training_information.delete');
    Route::get('training-information-details/{candidate}', 'HRController@trainingInformationDetails')->name('training_information.details');
    Route::post('training-information-post/{candidate}', 'HRController@trainingInformation');
    Route::get('training-information-edit/{candidate}', 'HRController@trainingInformationEdit')->name('training_information.edit');
    Route::post('training-information-edit/{candidate}', 'HRController@trainingInformationEditPost');
    //Route::get('employee-wise-training-information-delete', 'HRController@academicWiseDelete')->name('employee_wise_training_information.delete');

    // HR//Job Information
    Route::get('job-information', 'HRController@jobInformationAll')->name('job_information.all');
    Route::get('job-information-form/{candidate}', 'HRController@jobInformationForm')->name('job_information_form');
    Route::post('job-information-form/{candidate}', 'HRController@jobInformationPost');
    Route::get('job-information-details/{candidate}', 'HRController@jobInformationDetails')->name('job_information.details');
    Route::post('job-information-post/{candidate}', 'HRController@jobInformation');
    Route::get('job-information-edit/{candidate}', 'HRController@jobInformationEdit')->name('job_information.edit');
    Route::post('job-information-edit/{candidate}', 'HRController@jobInformationEditPost');
    Route::get('employee-wise-job-information-form/{jobInformation}', 'HRController@employeeWisejobInformationAdd')->name('employee_wise_job_information.add');
    Route::post('employee-wise-job-information-form/{jobInformation}', 'HRController@employeeWisejobInformationAddPost');
    Route::get('employee-wise-job-information-edit/{jobInformation}', 'HRController@employeeWisejobInformationEdit')->name('employee_wise_job_information.edit');
    Route::post('employee-wise-job-information-edit/{jobInformation}', 'HRController@employeeWisejobInformationEditPost');
    Route::get('employee-wise-job-information-delete/', 'HRController@employeeWisejobInformationDelete')->name('employee_wise_job_information.delete');

    // HR//Employment Offer Letter
    Route::get('employment-offer-letter', 'HRController@employmentOfferLetter')->name('employment_offer_letter.all');
    Route::get('employment-offer-letter/{candidate}', 'HRController@employmentOfferLetterPage')->name('employment_offer_letter');
    Route::get('employment-offer-letter-input/{candidate}', 'HRController@employmentOfferLetterInput')->name('employment_offer_letter_input');
    Route::post('employment-offer-letter-input/{candidate}', 'HRController@employmentOfferLetterPost');

    // HR//Job Confirmation Letter
    Route::get('job-confirmation-letter', 'HRController@jobConfirmationLetter')->name('job_confirmation_letter.all');
    Route::get('job-confirmation-letter/{candidate}', 'HRController@jobConfirmationPage')->name('job_confirmation_letter');
    Route::get('job-confirmation-letter-input/{candidate}', 'HRController@jobConfirmationInput')->name('job_confirmation_letter_input');
    Route::post('job-confirmation-letter-input/{candidate}', 'HRController@jobConfirmationPost');

    // Payroll - Salary Update job_description.all
    Route::get('payroll/salary-update', 'PayrollController@salaryUpdateIndex')->name('payroll.salary_update.index');
    Route::post('payroll/salary-update/update', 'PayrollController@salaryUpdatePost')->name('payroll.salary_update.post');
    Route::get('payroll/salary-update/datatable', 'PayrollController@salaryUpdateDatatable')->name('payroll.salary_update.datatable');
    Route::post('payroll/salary-approved', 'PayrollController@salaryApprovedPost')->name('payroll.salary_approved.post');
    Route::post('payroll/salary-rejected', 'PayrollController@salaryRejectedPost')->name('payroll.salary_rejected.post');
    Route::post('payroll/salary-delete', 'PayrollController@salaryDeletePost')->name('payroll.salary_delete.post');

    // Payroll - Salary Process And Salary Report
    Route::get('payroll/salary-process', 'PayrollController@salaryProcessIndex')->name('payroll.salary_process.index');
    Route::post('payroll/salary-process', 'PayrollController@salaryProcessPost');
    Route::get('payroll/salary-process/report', 'PayrollController@salaryProcessReport')->name('payroll.salary_process.report');
    Route::get('payroll/deduction-history', 'PayrollController@deductionHistory')->name('payroll.deduction_history');
    Route::get('payroll/employee-wise-deduction/{candidate}', 'PayrollController@employeeWiseDeduction')->name('payroll.employee_wise_deduction');
    Route::get('payroll/employee-wise-all-due-report/{candidate}', 'PayrollController@employeeWiseAllDue')->name('payroll.employee_wise_all_due_report');
    Route::get('payroll/employee-wise-all-salary/{candidate}', 'PayrollController@employeeWiseAllSalary')->name('payroll.employee_wise_all_salary');
    Route::get('payroll/employee-wise-salary-page/{candidate}', 'PayrollController@employeeWiseSalaryPage')->name('payroll.employee_wise_salary_page');
    Route::get('payroll/employee-wise-due-salary/{candidate}', 'PayrollController@employeeWiseDueSalary')->name('payroll.employee_wise_due_salary');
    Route::get('payroll/salary-slip', 'PayrollController@salarySlip')->name('payroll.salary.slip');
    Route::get('payroll/employee-wise-salary-slip/{candidate}', 'PayrollController@employeeWisesalarySlip')->name('payroll.employee.wise.salary.slip');
    Route::get('payroll/employee-wise-salary-slip-details/{candidate}/{month}/{year}', 'PayrollController@employeeWisesalarySlipDetails')->name('payroll.employee_wise_salary_slip_details');
    Route::get('payroll/consolidation', 'PayrollController@Consolidation')->name('payroll.consolidation');
    Route::get('payroll/employee-leave-information', 'PayrollController@EmployeeLeaveInformation')->name('payroll.employee.leave.information');
    Route::get('payroll/employee-payment-history', 'PayrollController@EmployeePaymentHistory')->name('payroll.employee.payment.history');
    Route::get('payroll/all-employee-data', 'PayrollController@employeeData')->name('payroll.all.employee.data');
    Route::post('payroll/all-employee-data', 'PayrollController@employeeDataPost')->name('payroll.employee_update.post');
    Route::get('payroll/create-loan', 'PayrollController@createLoan')->name('payroll.create.loan');
    Route::post('payroll/create-loan', 'PayrollController@createLoanPost');
    Route::get('payroll/create-pf-loan', 'PayrollController@createPfLoan')->name('payroll.create.pf_loan');
    Route::post('payroll/create-pf-loan', 'PayrollController@createPfLoanPost');
    Route::get('payroll/create-skrp-loan', 'PayrollController@createSkrpLoan')->name('payroll.create.skrp_loan');
    Route::post('payroll/create-skrp-loan', 'PayrollController@createSkrpLoanPost');
    Route::get('payroll/previous-loan/{candidate}', 'PayrollController@previousLoan')->name('previous_loan');
    Route::get('payroll/current-loan/{candidate}', 'PayrollController@currentLoan')->name('current_loan');
    Route::get('payroll/employee-wise/loan/{candidate}', 'PayrollController@employeeWiseLoan')->name('payroll.employee.wise.loan');

    // Payroll - Leave
    Route::get('payroll/leave', 'PayrollController@leaveIndex')->name('payroll.leave.index');
    Route::post('payroll/leave', 'PayrollController@leavePost');
    Route::get('payroll/employee/wise/leave/{candidate}', 'PayrollController@employeeWiseLeave')->name('payroll.employee_wise.leave');
    Route::get('payroll/leave/datatable', 'PayrollController@leaveDatatable')->name('payroll.leave.datatable');


    // Payroll - Salary Approved List
    Route::get('payroll/salary/approved/list', 'PayrollController@salaryApprovedList')->name('payroll.salary.approved-list');


    // Payroll - holiday
    Route::get('payroll/holiday', 'PayrollController@holidayIndex')->name('payroll.holiday.index');
    Route::get('payroll/holiday/add', 'PayrollController@holidayAdd')->name('payroll.holiday_add');
    Route::post('payroll/holiday/add', 'PayrollController@holidayPost');
    Route::get('payroll/holiday/edit/{holiday}', 'PayrollController@holidayEdit')->name('payroll.holiday_edit');
    Route::post('payroll/holiday/edit/{holiday}', 'PayrollController@holidayEditPost');
    Route::get('payroll/holiday-datatable', 'PayrollController@holidayDatatable')->name('holiday.datatable');

    //HR//Employee Wise Report payroll.employee_wise.report
    Route::get('employee/wise/report/{candidate}', 'PayrollController@employeeWiseReport')->name('payroll.employee_wise.report');
    Route::get('employee/wise/salary/report/{candidate}', 'PayrollController@employeeWiseSalaryReport')->name('payroll.employee_wise_salary_report');
    Route::get('employee/wise/loan/report/{candidate}', 'PayrollController@employeeWiseLoanReport')->name('payroll.employee_wise_loan_report');
    Route::get('employee/wise/attendance/report/{candidate}', 'PayrollController@employeeWiseAttendanceReport')->name('payroll.employee_wise_attendance_report');
    Route::get('employee/wise/leave/report/{candidate}', 'PayrollController@employeeWiseLeaveReport')->name('payroll.employee_wise_leave_report');

    // Report
    Route::get('report/employee-list', 'ReportController@employeeList')->name('report.employee_list');
    Route::get('report/ledger', 'ReportController@ledger')->name('report.ledger');

    // Common
    Route::get('get-client', 'CommonController@getClient')->name('get_client');
    Route::get('get-project', 'CommonController@getProject')->name('get_project');
    Route::get('get-product', 'CommonController@getProduct')->name('get_product');
    Route::get('get-supplier', 'CommonController@getSupplier')->name('get_supplier');
    Route::get('get-branch', 'CommonController@getBranch')->name('get_branch');
    Route::get('get-bank-account', 'CommonController@getBankAccount')->name('get_bank_account');
    Route::get('order-details', 'CommonController@orderDetails')->name('get_order_details');
    Route::get('project-details', 'CommonController@projectDetails')->name('get_project_details');
    Route::get('get-course-code', 'CommonController@getCourseCode')->name('get_course_code');
    Route::get('get-department-code', 'CommonController@getDepartmentCode')->name('get_department_code');
    Route::get('get-batch-code', 'CommonController@getBatchCode')->name('get_batch_code');
    Route::get('get-account-head-type', 'CommonController@getAccountHeadType')->name('get_account_head_type');
    Route::get('get-account-head-sub-type', 'CommonController@getAccountHeadSubType')->name('get_account_head_sub_type');
    Route::get('get-designation', 'CommonController@getDesignation')->name('get_designation');
    Route::get('get-employee-details', 'CommonController@getEmployeeDetails')->name('get_employee_details');
    Route::get('get-overtime', 'CommonController@getOvertime')->name('get_overtime');
    Route::get('get-employee-salary-change-details', 'CommonController@getEmployeeSalaryChangeDetails')->name('get_employee_salaryChange_details');
    Route::get('get-month', 'CommonController@getMonth')->name('get_month');
    Route::get('get-month-salary-sheet', 'CommonController@getMonthSalaryMonth')->name('get_month_salary_sheet');
});
