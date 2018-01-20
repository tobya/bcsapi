<?php

//test api

include_once('env.php');
include_once('../BCSStudentApi_Class.php');
include_once('../BCSCourseApi_Class.php');


$BCSStudent = new BCSStudentAPI($APIURL, $APIKEY);

$StudentInfo = $BCSStudent->BookingInfo(83704);

$Output['Retrieved Student: '] =  $StudentInfo['booking']['FirstName'] . ' ' . $StudentInfo['booking']['LastName'];

$BCSCourse = new BCSCourseAPI($APIURL,$APIKEY);
$CourseInfo = $BCSCourse->CourseInfo(102291);
//print_r($CourseInfo);
$Output['Retrieved Course:'] = $CourseInfo['course']['CourseName'];

$RunningCourses = $BCSCourse->RunningCourses();

$Output['Count Standard Courses Today:'] = $RunningCourses['count_courses'];
//print_r($RunningCourses);

foreach ($RunningCourses['courses'] as $key => $value) {
    # code...
    $Output['RunningCourse' . $key] = $value['CourseName'];
}

$AllEvents = $BCSCourse->AllRunningEvents();
//print_r($AllEvents);
$Output['Count All Events Today:'] = ($AllEvents['count_courses']);

foreach ($AllEvents['courses'] as $key => $value) {
    # code...
    $Output['Running Event' . $key] = $value['CourseName'];
}

$AllBookings = $BCSCourse->CourseBookings(102291);

$Output['Course Bookings on ' . $AllBookings['courseinfo']['CourseName']] = $AllBookings['bookings_count'];

$Student = array_pop($AllBookings['bookings']);

$StudentInfo = $BCSStudent->StudentInfo($Student['IndividualID']);

$Output['Studend Info retreived for Student'] = $StudentInfo['student']['FullName'] . ' - ' . $StudentInfo['student']['Email'];

// Output all tests.
foreach ($Output as $key => $value) {
    # code...
    echo '<Li>' . $key . ' : ' . $value;
}