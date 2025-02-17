<?php
include 'conf.php';

class Calendar {

    public function __construct($db) {
        $this->conn = $db;
    }

    public function viewCalendar() {
        echo <<<HTML
        <div id="calendar"></div>
    
        <table id="eventTable" class="table table-bordered table-striped">
            <thead class="table-calm">
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Location</th>
                    <th>Event Type</th>
                    <th>Package Name</th>
                    <th>Price</th>
                    <th>Customer Name</th>
                    <th>Customer Tel</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    
        <script>
            $(document).ready(function () {
                $('#calendar').fullCalendar({
                    defaultView: 'month',
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: 'fetch_events.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function(response) {
                                var events = response.map(function(event) {
                                    return {
                                        title: 'Event',
                                        start: event.start,
                                        backgroundColor: 'red',
                                        borderColor: 'red'
                                    };
                                });
                                callback(events);
                            }
                        });
                    },
                    dayClick: function (date, jsEvent, view) {
                        let selectedDate = date.format();
                        fetchEventDetails(selectedDate);
                    }
                });
    
                function fetchEventDetails(date) {
                    $.ajax({
                        url: 'fetch_events.php',
                        type: 'GET',
                        data: { eventDate: date },
                        dataType: 'json',
                        success: function (response) {
                            $('#eventTable tbody').empty();
    
                            if (response.length === 0) {
                                $('#eventTable tbody').append('<tr><td colspan="12">No events found</td></tr>');
                            } else {
                                response.forEach(function(event) {
                                    $('#eventTable tbody').append(`
                                        <tr>
                                            <td>\${event.orderID}</td>
                                            <td>\${event.orderDate}</td>
                                            <td>\${event.status}</td>
                                            <td>\${event.eventDate}</td>
                                            <td>\${event.eventTime}</td>
                                            <td>\${event.eventLocation}</td>
                                            <td>\${event.eventType}</td>
                                            <td>\${event.packageName}</td>
                                            <td>\${event.price}</td>
                                            <td>\${event.firstName}</td>
                                            <td>\${event.telNO}</td>
                                            <td>\${event.itemNames}</td>
                                        </tr>
                                    `);
                                });
                            }
                        }
                    });
                }
            });
        </script>
    HTML;
    }
    

    public function viewEventCalendar() {}
   

}
?>
