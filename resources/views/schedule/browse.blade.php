@extends('layouts.app')

@section('content')
@php
	$currentDay = date("Y-m-d");

	$timeFrames = App\Http\Controllers\ScheduleController::getTimesFromRange('09:00:00', '18:00:00'); 
@endphp
	<style>
		body {
			padding: 0;
			font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
			font-size: 14px;
		}

		#calendar {
			max-width: 900px;
			margin: 0 auto;
		}

		table.fc-border-separate { table-layout: fixed; }

		table.fc-border-separate, table.fc-border-separate.fc td, .fc th {
			width: 91px !important;
			height: 50px !important;
		}

		tr.fc-chrono .fc-cell-content {
			text-align: center;
		}

		.add-button, .sub-button {
			border-radius: 5px;
			border-color: #b09e43;
			background-color: #b09e43;
		}

		.count-order {
			border-color: #ffffff00;
			background-color: #ffffff00;
		}
	</style>
	<div id='calendar'></div>
@endsection

@section('javascript')
	<script>
		/*
		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
				},
				defaultDate: '2020-02-12',
				navLinks: true, // can click day/week names to navigate views
				businessHours: true, // display business hours
				editable: true,
				events: [
					{
						title: 'Business Lunch',
						start: '2020-02-03T13:00:00',
						constraint: 'businessHours'
					},
					{
						title: 'Meeting',
						start: '2020-02-13T11:00:00',
						constraint: 'availableForMeeting', // defined below
						color: '#257e4a'
					},
					{
						title: 'Conference',
						start: '2020-02-18',
						end: '2020-02-20'
					},
					{
						title: 'Party',
						start: '2020-02-29T20:00:00'
					},

					// areas where "Meeting" must be dropped
					{
						groupId: 'availableForMeeting',
						start: '2020-02-11T10:00:00',
						end: '2020-02-11T16:00:00',
						rendering: 'background'
					},
					{
						groupId: 'availableForMeeting',
						start: '2020-02-13T10:00:00',
						end: '2020-02-13T16:00:00',
						rendering: 'background'
					},

					// red areas where no events can be dropped
					{
						start: '2020-02-24',
						end: '2020-02-28',
						overlap: false,
						rendering: 'background',
						color: '#ff9f89'
					},
					{
						start: '2020-02-06',
						end: '2020-02-08',
						overlap: false,
						rendering: 'background',
						color: '#ff9f89'
					}
				]
			});

			calendar.render();
		});
		*/

		/*
		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				plugins: [ 'resourceTimeline' ],
				header: {
					left: 'today prev,next',
					center: 'title',
					right: 'resourceTimelineDay,resourceTimelineWeek'
				},
				defaultView: 'resourceTimelineDay',
				aspectRatio: 1.5,
				resourceColumns: [
					{
						labelText: 'Room',
						field: 'title'
					},
					{
						labelText: 'Occupancy',
						field: 'occupancy'
					}
				],
				resources: [
					{ id: 'a', title: 'Auditorium A', occupancy: 40 },
					{ id: 'b', title: 'Auditorium B', occupancy: 60 },
					{ id: 'c', title: 'Auditorium C', occupancy: 40 },
					{ id: 'd', title: 'Auditorium D', occupancy: 40 },
					{ id: 'e', title: 'Auditorium E', occupancy: 60 },
					{ id: 'f', title: 'Auditorium F', occupancy: 60 },
					{ id: 'g', title: 'Auditorium G', occupancy: 60 },
					{ id: 'h', title: 'Auditorium H', occupancy: 40 },
					{ id: 'i', title: 'Auditorium I', occupancy: 70 },
					{ id: 'j', title: 'Auditorium J', occupancy: 70 },
					{ id: 'k', title: 'Auditorium K', occupancy: 70 },
					{ id: 'l', title: 'Auditorium L', occupancy: 75 },
					{ id: 'm', title: 'Auditorium M', occupancy: 40 },
					{ id: 'n', title: 'Auditorium N', occupancy: 40 },
					{ id: 'o', title: 'Auditorium O', occupancy: 40 },
					{ id: 'p', title: 'Auditorium P', occupancy: 40 },
					{ id: 'q', title: 'Auditorium Q', occupancy: 40 },
					{ id: 'r', title: 'Auditorium R', occupancy: 40 },
					{ id: 's', title: 'Auditorium S', occupancy: 40 },
					{ id: 't', title: 'Auditorium T', occupancy: 40 },
					{ id: 'u', title: 'Auditorium U', occupancy: 40 },
					{ id: 'v', title: 'Auditorium V', occupancy: 40 },
					{ id: 'w', title: 'Auditorium W', occupancy: 40 },
					{ id: 'x', title: 'Auditorium X', occupancy: 40 },
					{ id: 'y', title: 'Auditorium Y', occupancy: 40 },
					{ id: 'z', title: 'Auditorium Z', occupancy: 40 }
				]
			});

			calendar.render();
		});
		*/

		document.addEventListener('DOMContentLoaded', function() {
			var calendarEl = document.getElementById('calendar');

			var calendar = new FullCalendar.Calendar(calendarEl, {
				plugins: [ 'resourceTimeline' ],
				now: "{{ $currentDay }}",
				editable: true,
				header: {
					left: 'today prev,next',
					center: 'title',
					right: '' // resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth
				},
				defaultView: 'resourceTimelineDay',
				slotDuration: '00:30',
				minTime: '09:00',
				maxTime: '18:00',
				slotLabelFormat: {
					hour: 'numeric',
					minute: '2-digit',
					omitZeroMinute: false,
					meridiem: false,
					hour12: false
                },
				aspectRation: 1.5,
				resourceColumns: [
					{
						labelText: '集計欄を隠す',
						field: 'title'
					}
				],
				resources: [
					{ id: 'count_setting', title: '予約数'},
					{ id: 'b', title: '残り受付可能数'},
					{ id: 'l', title: '桜木　花 \n 受付可能数： 3'},
					{ id: 'm', title: '平野　ユウキ \n 受付可能数： 1'},
					{ id: 'n', title: '木島　潤子 \n 受付可能数： 1'}
				],
				eventOrder: "start",
				events: [
					@foreach($timeFrames as $key => $timeFrame)
						@if ($key < count($timeFrames) - 1)
							{ "id": "add-{{ $key }}", "resourceId": "count_setting", "start": "{{ $currentDay . 'T' . $timeFrame }}", "end": "{{ $currentDay . 'T' . $timeFrames[$key+1] }}", "title": "+", "className": "add-button" },
							{ "id": "count-order-{{ $key }}", "resourceId": "count_setting", "start": "{{ $currentDay . 'T' . $timeFrame }}", "end": "{{ $currentDay . 'T' . $timeFrames[$key+1] }}", "title": "0", "className": "count-order" },
							{ "id": "sub-{{ $key }}", "resourceId": "count_setting", "start": "{{ $currentDay . 'T' . $timeFrame }}", "end": "{{ $currentDay . 'T' . $timeFrames[$key+1] }}", "title": "-", "className": "sub-button" },
						@endif
					@endforeach
					// { "id": "1", "resourceId": "count_setting", "start": "2020-05-01T09:00:00", "end": "2020-05-01T11:00:00", "title": "event 1" },
					// { "id": "2", "resourceId": "n", "start": "2020-05-01T12:00:00", "end": "2020-05-01T13:30:00", "title": "event 2" },
					// { "id": "3", "resourceId": "m", "start": "2020-05-01", "end": "2020-05-02", "title": "event 3" },
					// { "id": "4", "resourceId": "l", "start": "2020-05-01T15:00:00", "end": "2020-05-01T15:30:00", "title": "event 4" },
					// { "id": "5", "resourceId": "n", "start": "2020-05-01T16:30:00", "end": "2020-05-01T17:30:00", "title": "event 5" },
					// { "id": "6", "resourceId": "l", "start": "2020-05-01T09:00:00", "end": "2020-05-01T12:30:00", "title": "event 6" },
				],
				eventClick: function(info) {
					console.log(info);
				},
			});

			calendar.render();
		});

	</script>
@endsection