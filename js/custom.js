function courses() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#course_se').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_courses.php',
            type: 'POST',
            data: {courseid:keyword},
            success:function(data){
                $('#course_list_id').show();
                $('#course_list_id').html(data);
            }
        });
    } else {
        $('#course_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item(item) {
    // change input value
    $('#course_se').val(item);
    // hide proposition list
    $('#course_list_id').hide();
}

function course_title() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#course_title_se').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_course_title.php',
            type: 'POST',
            data: {courseid:keyword},
            success:function(data){
                $('#course_title_list_id').show();
                $('#course_title_list_id').html(data);
            }
        });
    } else {
        $('#course_title_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item6(item) {
    // change input value
    $('#course_title_se').val(item);
    // hide proposition list
    $('#course_title_list_id').hide();
}

function semester() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#semester_se').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_semester.php',
            type: 'POST',
            data: {semesterid:keyword},
            success:function(data){
                $('#semester_list_id').show();
                $('#semester_list_id').html(data);
            }
        });
    } else {
        $('#semester_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item4(item) {
    // change input value
    $('#semester_se').val(item);
    // hide proposition list
    $('#semester_list_id').hide();
}

function department() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#department_se').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_department.php',
            type: 'POST',
            data: {departmentid:keyword},
            success:function(data){
                $('#department_list_id').show();
                $('#department_list_id').html(data);
            }
        });
    } else {
        $('#department_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item3(item) {
    // change input value
    $('#department_se').val(item);
    // hide proposition list
    $('#department_list_id').hide();
}

function titleid() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#title_se').val();
    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_title.php',
            type: 'POST',
            data: {titleid:keyword},
            success:function(data){
                $('#title_list_id').show();
                $('#title_list_id').html(data);
            }
        });
    } else {
        $('#title_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item2(item) {
    // change input value
    $('#title_se').val(item);
    // hide proposition list
    $('#title_list_id').hide();
}

function instructor() {
    var min_length = 0; // min caracters to display the autocomplete
    var keyword = $('#instructor_se').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax_instructor.php',
            type: 'POST',
            data: {name:keyword},
            success:function(data){

                $('#instructor_list_id').show();
                $('#instructor_list_id').html(data);
            }
        });
    } else {
        $('#instructor_list_id').hide();
    }
}

// set_item : this function will be executed when we select an item
function set_item1(item) {
    // change input value
    $('#instructor_se').val(item);
    // hide proposition list
    $('#instructor_list_id').hide();
}


$('#timeslot1').click(function() {
    $("#room_1").toggle(this.checked);
    $("#day_1").toggle(this.checked);
    $("#start_1").toggle(this.checked);
    $("#end_1").toggle(this.checked);
    $("#timeslot_2").toggle(this.checked);
});

jQuery(document).ready(function () {
    
    $('#timeslot1').each(function(){
        if ($(this).is(':checked')) {
          $("#room_1").toggle(this.checked);
    $("#day_1").toggle(this.checked);
    $("#start_1").toggle(this.checked);
    $("#end_1").toggle(this.checked);
    $("#timeslot_2").toggle(this.checked);  
        } 
    });
    $('#timeslot2').each(function(){
        if ($(this).is(':checked')) {
          $("#room_2").toggle(this.checked);
    $("#day_2").toggle(this.checked);
    $("#start_2").toggle(this.checked);
    $("#end_2").toggle(this.checked);
    $("#timeslot_3").toggle(this.checked);  
        } 
    });
    $('#timeslot3').each(function(){
        if ($(this).is(':checked')) {
          $("#room_3").toggle(this.checked);
    $("#day_3").toggle(this.checked);
    $("#start_3").toggle(this.checked);
    $("#end_3").toggle(this.checked);
        } 
    });

});

$('#timeslot2').click(function() {
    $("#day_2").toggle(this.checked);
    $("#room_2").toggle(this.checked);
    $("#start_2").toggle(this.checked);
    $("#end_2").toggle(this.checked);
    $("#timeslot_3").toggle(this.checked);
});

$('#timeslot3').click(function() {
    $("#day_3").toggle(this.checked);
    $("#room_3").toggle(this.checked);
    $("#start_3").toggle(this.checked);
    $("#end_3").toggle(this.checked);
});

$('#search_courses').click(function(){
    var course = $('#course_se').val();
    var department = $('#department_se').val();
    var semester = $('#semester_se').val();
    var instructor = $('#instructor_se').val();
    var title = $('#title_se').val();
    var year1 = $('#year_se1').val();
    var year2 = $('#year_se2').val();
    if(year1>year2)
    {
        alert("Year Range is not correct.")
    }
    else{
    $.ajax({
            url: 'ajax_search.php',
            type: 'POST',
            data: {course:course,department:department,semester:semester,instructor:instructor,title:title,year1:year1,year2:year2},
            success:function(data){

                $('#search_table').show();
                $('#search_table').html(data);
                $('#course_list_id').hide();
                $('#instructor_list_id').hide();
                $('#title_list_id').hide();
                $('#department_list_id').hide();
                $('#semester_list_id').hide();
            }
        });
    }

});

$('#submit_tt').click(function(){

    var year = $('#year_tt').val();
    var semester = $('#semester_tt').val();
    var department = $('#department_tt').val();
    if(year.length == 0)
        alert("Please input year.");
    else {
        $.ajax({
            url: 'ajax_timetable.php',
            type: 'POST',
            data: {year:year,department:department,semester:semester},
            success:function(data){

                
                $('#table_tt').html(data);
                
            }
        });
    }

});
function search(){
    var course = $('#course_se').val();
    var department = $('#department_se').val();
    var semester = $('#semester_se').val();
    var instructor = $('#instructor_se').val();
    var title = $('#title_se').val();
    var year1 = $('#year_se1').val();
    var year2 = $('#year_se2').val();
    
    $.ajax({
            url: 'ajax_search.php',
            type: 'POST',
            data: {course:course,department:department,semester:semester,instructor:instructor,title:title,year1:year1,year2:year2},
            success:function(data){

                $('#search_table').show();
                $('#search_table').html(data);
                $('#course_list_id').hide();
                $('#instructor_list_id').hide();
                $('#title_list_id').hide();
                $('#department_list_id').hide();
                $('#semester_list_id').hide();
            }
        });
}
function my_search(){
    var course = $('#course_me').val();
    var semester = $('#semester_me').val();
    var title = $('#title_me').val();
    var year = $('#year_me').val();
    var credits = $("#credits_me").val();
    
    $.ajax({
            url: 'ajax_my.php',
            type: 'POST',
            data: {course:course,semester:semester,title:title,year:year,credits:credits},
            success:function(data){

                $('#my_table').show();
                $('#my_table').html(data);
            }
        });
}




$('#all_courses').click(function(){
    var course = $('#course_se').val();
    var department = $('#department_se').val();
    
    var title = $('#title_se').val();
    var credits = $('#credits_se').val();
    
    $.ajax({
            url: 'ajax_all.php',
            type: 'POST',
            data: {course:course,department:department,title:title,credits:credits},
            success:function(data){

                $('#search_table').show();
                $('#search_table').html(data);
                $('#course_list_id').hide();
                
                $('#title_list_id').hide();
                $('#department_list_id').hide();
                
            }
        });

});

function all_courses() {
    var course = $('#course_se').val();
    var department = $('#department_se').val();
    
    var title = $('#title_se').val();
    var credits = $('#credits_se').val();
    
    $.ajax({
            url: 'ajax_all.php',
            type: 'POST',
            data: {course:course,department:department,title:title,credits:credits},
            success:function(data){

                $('#search_table').show();
                $('#search_table').html(data);
                $('#course_list_id').hide();
                
                $('#title_list_id').hide();
                $('#department_list_id').hide();
                
            }
        });
}




$('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });
