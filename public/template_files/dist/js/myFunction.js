// check all rows in datatable table
function check_all() {
    $('input[class = "item_checkbox"]:checkbox').each(function() {
        if ($('input[class="check_all"]:checkbox:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }

    })
}

// get ids of all selected rows
function delete_all() {
    $(document).on('click', '.del_all', function() {
        $('#form_data').submit();
    });

    $(document).on('click', '.del_btn', function() {
        var item_checked = $('input[class = "item_checkbox"]:checkbox').filter(":checked").length;

        if (item_checked > 0) {
            $('.record_count').text(item_checked);
            $('.not_empty_record').removeAttr('hidden');
            $('.empty_record').attr('hidden', true);
        } else {
            $('.record_count').text('');
            $('.not_empty_record').attr('hidden', true);
            $('.empty_record').removeAttr('hidden');
        }

        $('#multipleDelete').modal('show');
    });
}


// // image preview
$(".image").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});

$(".personal_photo").change(function() {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.personal_photo_review').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});

//scrolling to the top and bottom of the page
$("#page-up").click(function() {
    $(window).scrollTop(0);
})
$("#page-down").click(function() {
    $("html, body").animate({ scrollTop: $(document).height() }, 100);
})

// timer for  partnership perioud
$(function() {
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    if ($("#intervalDate").length != 0) {
        let timeUp = $("#intervalDate").val();
        if (timeUp != null) {
            let countDown = new Date(timeUp).getTime(),
                x = setInterval(function() {

                    let now = new Date().getTime(),
                        distance = countDown - now;
                    document.getElementById("days").innerText = Math.floor(distance / (day)),
                        document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                        document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                        document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                    //do something later when date is reached
                    if (distance < 0) {
                        let countdown = document.getElementById("countdown"),
                            conterMsg = document.getElementById("counter-msg");
                        countdown.style.display = "none";
                        conterMsg.style.display = "block";
                        clearInterval(x);
                    }
                    //seconds
                }, 0)
        }
    }
}());

//all search btn behavior
$("#allSearch").click(function() {
    $(".hidden-div").show("slow");
    $("#allSearch").remove();
});
$("#advancedSearch").click(function() {
    $(".hidden-div").show("slow");
    $("#advancedSearch").remove();
});
$(document).on("readystatechange", function(e) {
    if (document.readyState == "complete" && $(document).width() > 600) {
        //datatable length and filter, in the same row
        let tableNames = ["admins", "borrow", "attends", "AnnualAbsence", "TaxesAndInsurances", "official-absences", "companies", "employees", "salaries", "absences", "permits", "rewards", "punishes"];
        for (let tableName of tableNames) {
            dataTableLengthAndFilter(tableName);
        }
        $(".filter-length-row").addClass("px-3");
        $(".dt-buttons").addClass("px-3");
    }
});

function dataTableLengthAndFilter(tableName) {
    $(`#${tableName}-datatable-table_length, #${tableName}-datatable-table_filter`).wrapAll("<div class='row filter-length-row' style='direction: ltr !important;'></div>");
    $(`#${tableName}-datatable-table_length`).addClass('col-md-6 col-sm-12 d-flex justify-content-end');
    $(`#${tableName}-datatable-table_filter`).addClass('col-md-6 col-sm-12 d-flex justify-content-start');
}
/////////////// datatable add div element for each table ///////////////
$(`#admins-datatable-table, #absences-datatable-table, #permits-datatable-table, #companies-datatable-table,
  #borrow-datatable-table, #AnnualAbsence-datatable-table, #official-absences-datatable-table,
  #attends-datatable-table, #employees-datatable-table, #punishes-datatable-table, #salaries-datatable-table,
  #TaxesAndInsurances-datatable-table, #rewards-datatable-table`).on('init.dt', function() {
    $(this).wrap("<div class='col-12' style='overflow-x:auto'></div>");
    $(this).width("100%");
});
// After initializting salaries data table
$('#salaries-datatable-table').on('init.dt', function() {
    //append columns filter in salaries datatable
    $("#salaries-datatable-table_wrapper .dt-buttons").append(`  <!-- multi select columns-->
     <div class="multipleSelection">
    <div class="selectBox" id="ddlShownColumns">
    <button class="btn btn-outline-blue btn_size" data-bs-toggle = 'tooltip' data-bs-placement= 'bottom' title = 'الأعمدة المعروضة'><i class="fas fa-columns columns-icon"></i>▾</button>
    <div class="overSelect"></div>
    </div>
    <div class="checkBoxes" id="chkcolumns">
    <label class="form-check-label" for="chkAllColumns">
     <input class="form-check-input" data-column="all" name="relatedColumns" type="checkbox" value="" id="chkAllColumns">
      الكل
    </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="4" name="relatedColumns" type="checkbox" value="">
     الأساسى </label>
     <label class="form-check-label" for="chkStore2">
     <input class="form-check-input" data-column="5" name="relatedColumns" type="checkbox" value="">
     البدلات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="6" name="relatedColumns" type="checkbox" value="">
     إجازات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="7" name="relatedColumns" type="checkbox" value="">
     آذونات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="8" name="relatedColumns" type="checkbox" value="">
    مكافآت </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="9" name="relatedColumns" type="checkbox" value="">
     جزاءات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="10" name="relatedColumns" type="checkbox" value="">
     استحقاقات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="11" name="relatedColumns" type="checkbox" value="">
    سُلف </label>
    <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="12" name="relatedColumns" type="checkbox" value="">
     تأخيرات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="13" name="relatedColumns" type="checkbox" value="">
    انصراف مبكر </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="14" name="relatedColumns" type="checkbox" value="">
     إضافى </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="15" name="relatedColumns" type="checkbox" value="">
    ضرائب و تأمينات </label>

    </div>
    </div>`);
    let column_No = $('#salaries-datatable-table').DataTable().columns().nodes().length;
    for (let i = 4; i < column_No - 1; i++) {
        let column = $("#salaries-datatable-table").DataTable().column(i);
        column.visible(false);
        $("#salaries-datatable-table").width("100%");
    }
    //columns filter behavior in salaries
    $(`#chkAllColumns`).click(function() {
        toggleChecked(this, $(this).attr("name"));
    });
    $("#ddlShownColumns").click(function() {
        $(".checkBoxes").slideToggle("fast");
    });
    //toggle the visibility of columns according to what is checked
    $(":checkbox[name='relatedColumns']").change(function(evt) {
        evt.preventDefault();
        if ($(this).attr("id") == 'chkAllColumns') {
            if ($('#chkAllColumns').prop('checked') == true) {
                for (let i = 0; i < column_No; i++) {
                    let column = $("#salaries-datatable-table").DataTable().column(i);
                    column.visible(true);
                    $("#salaries-datatable-table").width("100%");
                }
            } else {
                for (let i = 4; i < column_No - 1; i++) {
                    let column = $("#salaries-datatable-table").DataTable().column(i);
                    column.visible(false);
                    $("#salaries-datatable-table").width("100%");
                }
            }
        } else {
            let column = $("#salaries-datatable-table").DataTable().column($(this).attr('data-column'));
            column.visible(!column.visible());
            $("#salaries-datatable-table").width("100%");
        }
    });
});
//close ddl of shown columns
$(document).on("click", function(evt) {
    var $trigger = $("#ddlShownColumns");
    if ($trigger !== evt.target && !$trigger.has(evt.target).length) {
        $(".checkBoxes").slideUp("slow");
    }
});
// After initializting taxes and insurances data table
/* $('#TaxesAndInsurances-datatable-table').on('init.dt', function() {
    //append columns filter in taxes and insurances datatable
    $("#TaxesAndInsurances-datatable-table_wrapper .dt-buttons").append(`<!-- multi select columns-->
     <div class="multipleSelection">
    <div class="selectBox" id="ddlShownColumns">
    <button class="btn btn-outline-blue btn_size" data-bs-toggle = 'tooltip' data-bs-placement= 'bottom' title = 'الأعمدة المعروضة'><i class="fas fa-columns columns-icon"></i>&#9662;</button>
    <div class="overSelect"></div>
    </div>
    <div class="checkBoxes checkBoxes-wider" id="chkcolumns">
    <label class="form-check-label" for="chkAllColumns">
     <input class="form-check-input" data-column="all" name="relatedColumns" type="checkbox" value="" id="chkAllColumns">
      الكل
    </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="5" name="relatedColumns" type="checkbox" value="">
      التأمينات الشهرية للموظف </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="6" name="relatedColumns" type="checkbox" value="">
      التأمينات السنوية للموظف </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="9" name="relatedColumns" type="checkbox" value="">
      الراتب السنوي </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="10" name="relatedColumns" type="checkbox" value="">
      إعفاء شخصى </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="11" name="relatedColumns" type="checkbox" value="">
      الراتب السنوى بعد الاعفاءات </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="12" name="relatedColumns" type="checkbox" value="">
      ضريبة كسب العمل السنوية </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="13" name="relatedColumns" type="checkbox" value="">
      ضريبة كسب العمل الشهرية </label>
    <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="14" name="relatedColumns" type="checkbox" value="">
      صافى المرتب بعد الضريبة </label>
     <label class="form-check-label" for="chkStore2">
      <input class="form-check-input" data-column="15" name="relatedColumns" type="checkbox" value="">
      خصم المساهمه التكافليه 1% </label>
    </div>
    </div>`);
    let column_No = $('#TaxesAndInsurances-datatable-table').DataTable().columns().nodes().length;
    for (let i = 5; i < column_No - 1; i++) {
        if (i !== 7 && i !== 8) {
            let column = $("#TaxesAndInsurances-datatable-table").DataTable().column(i);
            column.visible(false);
            $("#TaxesAndInsurances-datatable-table").width("100%");
        }
    }
    //columns filter behavior in salaries
    $(`#chkAllColumns`).click(function() {
        toggleChecked(this, $(this).attr("name"));
    });
    $("#ddlShownColumns").click(function() {
        $(".checkBoxes").slideToggle("fast");
    });
    //toggle the visibility of columns according to what is checked
    $(":checkbox[name='relatedColumns']").change(function(evt) {
        evt.preventDefault();
        if ($(this).attr("id") == 'chkAllColumns') {
            if ($('#chkAllColumns').prop('checked') == true) {
                for (let i = 0; i < column_No; i++) {
                    let column = $("#TaxesAndInsurances-datatable-table").DataTable().column(i);
                    column.visible(true);
                    $("#TaxesAndInsurances-datatable-table").width("100%");
                }
            } else {
                for (let i = 5; i < column_No - 1; i++) {
                    if (i !== 7 && i !== 8) {
                        let column = $("#TaxesAndInsurances-datatable-table").DataTable().column(i);
                        column.visible(false);
                        $("#TaxesAndInsurances-datatable-table").width("100%");
                    }
                }
            }
        } else {
            let column = $("#TaxesAndInsurances-datatable-table").DataTable().column($(this).attr('data-column'));
            column.visible(!column.visible());
            $("#TaxesAndInsurances-datatable-table").width("100%");
        }
    });
}); */

function toggleChecked(source, name = null) {
    checkboxes = document.getElementsByName(name);
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}
//footer : showing copy right till the current year
var dt = new Date();
$(".main-footer #currentYear").text(dt.getFullYear());
//////////////////      Employees behavior          //////////////////////
$(document).ready(function() {
    /* File upload, company image*/
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#upload-img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#file-upload").on('change', function() {
        readURL(this);
    });

    $(".upload-button").on('click', function() {
        $("#file-upload").click();
    });
    //add social media links in add employee behavior
    var max_fields = 50; //maximum input boxes allowed
    var new_social_account = $(".new_social_account"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e) { //on add input button click
        e.preventDefault();
        /*  if (x < max_fields) { //max input box allowed
             x++; //text box increment
             $(add_button).before(
                 `<div class=" row new_social_account mt-3 pt-1" style="position: relative;border: 1px solid #dfdfe1;">
                     <div class="form-group col-md-6 px-1">
                         <label>موقع التواصل الاجتماعى</label>
                         <input type="text" name="link[]" class="form-control" placeholder="موقع التواصل الاجتماعى الخاص بالعمل">
                     </div>
                     <div class="form-group col-md-6 px-1">
                         <label>كلمة مرور الموقع</label>
                         <input type="text" name="password[]" class="form-control" placeholder="كلمة مرور موقع التواصل">
                     </div>
                     <i class="bi bi-x-square-fill mt-2 removeSocialRow" style="font-size: 24px;position: absolute;left:0%;top:-17px"></i>
                 </div>
                 `);

         }
         $(".removeSocialRow").on("click", function() {
             $(this).parent('div').remove();
         }); */
    });
    //button next in add employee behavior
    $("#nextPane").click(function() {
        $(".nav-link[href='#activity'], .nav-link[href='#settings'], #settings, #activity").toggleClass("active");
        if ($("#nextPane[href='#settings']").length === 0) {
            $("#nextPane").attr("href", "#settings");
        }
    });
    //Create reward behavior
    $(":radio[name='rewardType']").change(function() {
        if (this.id == 'rewardValueRadio') {
            $("#rewardValue").show(200);
            $("#rewardedDays").hide();
            $("#rewardedDays input").val('');
        } else if (this.id == 'rewardedDaysRadio') {
            $("#rewardedDays").show(200);
            $("#rewardValue").hide();
            $("#rewardValue input").val('');
        }
    });
    //toggle employee views between list and grid view
    if (typeof(Storage) == "undefined") {
        sessionStorage.setItem("gridView", false);
        sessionStorage.setItem("departmentsTab", false);
    }
    $("#show_grid").click(function() {
        $("#employee_list").hide("slow");
        $("#employee_grid").show("slow");
        sessionStorage.gridView = true;
    });
    $("#show_list").click(function() {
        $("#employee_list").show("slow");
        $("#employee_grid").hide("slow");
        sessionStorage.gridView = false;
    });
    //branches and departments tabs state
    $("a[href='#branches']").click(function() {
        sessionStorage.departmentsTab = false;
    });
    $("a[href='#departments']").click(function() {
        sessionStorage.departmentsTab = true;
    });
    if (typeof(Storage) !== "undefined") {
        if (sessionStorage.getItem("gridView") == "true") {
            $("#employee_list").hide();
            $("#employee_grid").show();
        }
        if (sessionStorage.getItem("departmentsTab") == "true") {
            $("a[href='#branches']").toggleClass("active");
            $("#branches").toggleClass("show active");
            $("a[href='#departments']").toggleClass("active");
            $("#departments").toggleClass("show active");
        }
    }
    //create employee step form
    // ------------step-wizard-------------
    $('.nav-tabs > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        var target = $(e.target);
        if (target.parent().hasClass('disabled')) {
            return false;
        }
    });
    $("#completeStep1").click(function() {
        let isvalid = true;
        let errorMsgs = ["يجب ادخال اسم موظف", "يجب ادخال رقم تليفون صحيح"]
        for (let i = 0; i < 2; i++) {
            if ($("#step1 input").eq(i).val() == "") {
                isvalid = false;
                $("#step1 input").eq(i).addClass('is-invalid');
                if ($("#step1 input").eq(i).next().length == 0) {
                    addErrorMessage($("#step1 input").eq(i).attr("id"), errorMsgs[i]);
                }
            }
        }
        if (isvalid) {
            activateNextTab();
        }
    });
    //removing validation from step1 when data is valid
    const step1Inputs = document.querySelectorAll("#step1 input");
    for (let i = 0; i < step1Inputs.length; i++) {
        step1Inputs[i].addEventListener('change', function() {
            if ($(this).val() != "" && step1Inputs[i].classList.contains('is-invalid')) {
                step1Inputs[i].classList.remove('is-invalid');
                step1Inputs[i].nextElementSibling.remove();
            }
        });
    }
    $("#completeStep2").click(function() {
        let isvalid = true;
        let errorMsgs = ["يجب ادخال المسمى الوظيفى", "يجب اختيار فرع", "يجب اختيار قسم", "يجب تحديد تاريخ التعيين", "يجب تحديد ميعاد بداية العمل", "يجب تحديد ميعاد انتهاء العمل", "عدد أيام الإجازة ضرورى", "يجب تحديد عدد دقائق التأخير المسموح بها", "يجب تحديد قيمة ساعة العمل الإضافى", "حدد الدقائق التى يبدأ بعدها حساب العمل كأضافى", "يجب تحديد قيمة الراتب"];
        for (let i = 0; i < $("#step2 #step2Requried :input").length - 4; i++) {
            if ($("#step2 #step2Requried :input").eq(i).val() == "") {
                isvalid = false;
                $("#step2 #step2Requried :input").eq(i).addClass('is-invalid');
                if ($("#step2 #step2Requried :input").eq(i).next().length == 0) {
                    addErrorMessage($("#step2 #step2Requried :input").eq(i).attr("id"), errorMsgs[i]);
                }
            }
        }
        if (isvalid) {
            $("#employeeForm").submit();
        }
    });
    //removing validation from step2 when data is valid
    const step2Inputs = document.querySelectorAll("#step2 input");
    for (let i = 0; i < step2Inputs.length; i++) {
        step2Inputs[i].addEventListener('change', function() {
            if ($(this).val() != "" && step2Inputs[i].classList.contains('is-invalid')) {
                step2Inputs[i].classList.remove('is-invalid');
                step2Inputs[i].nextElementSibling.remove();
            }
        });
    }
    $("#departments,#branches, #weekendDays").change(function() {
        if ($("departments, weekendDays").val() != "") {
            $(this).removeClass('is-invalid');
            $(this).next().remove();
        }
    });
    $(".prev-step").click(function(e) {
        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
    //show military service input if it was a male
    if ($(":radio[name='gender']#Male").is(':checked')) {
        $("#militaryService").show();
    }
});
//toggle search bar in employee profile
$("#searchEmployee, #leftSearch").click(function() {
    $('.side-search').toggleClass("side-search-toggled");
    if ($(this).find('i').hasClass("bi bi-search")) {
        $(this).find('i').removeClass("bi bi-search").addClass("fas fa-times");
    } else {
        $(this).find('i').removeClass("fas fa-times").addClass("bi bi-search");
    }
});

function activateNextTab() {
    let active = $('.wizard .nav-tabs li.active');
    active.next().removeClass('disabled');
    nextTab(active);
}

function addErrorMessage(inputID, msgText) {
    document.getElementById(inputID).insertAdjacentHTML('afterend', `<div class="error-msgs d-inline"><p>${msgText}</p></div>`);
}

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
$('.nav-tabs').on('click', 'li', function() {
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});
//show military service input when male is checked
$(":radio[name='gender']").change(function() {
    if (this.id == 'Male') {
        $("#militaryService").show("slow");
    } else if (this.id == 'Female') {
        $("#militaryService").hide("slow");
    }
    $("#militaryService").val('');
});


// add select 2 to any employee select
$("#employee_id").select2();
