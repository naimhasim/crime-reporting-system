@extends('layouts.app')

@section('content')
<div style="background-colo:; height:">
    <div class="card mb-3 " style="width:100%; height:100%;">
        <div class="card-body " style="height: ;">
            <div id="totalperdate_chart" style="width: ; height: 100% ;"></div>
        </div>
        <a href="{{ url('/') }}" class="btn" style="color: white; width: 100%; background-color:#17a2b8;">Back</a>
    </div>


</div>
@endsection

@section('scripts')
<script>
    $.ajax({
        type: "GET",
        url: "show-chart",
        dataType: "json",
        success: function (response)
        {
            //console.log(response.totalperdate);
            google.charts.load("current", {packages:["calendar"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                // console.log("day "+response.totalperdate[0].date.substring(8,11));
                // console.log("month "+response.totalperdate[0].date.substring(5,7));
                // console.log("Year "+response.totalperdate[0].date.substring(0,4));
                var alldate=[];
                $.each(response.totalperdate, function (key, item) {
                    var date   = new Date( item.date.substring(0,4), (item.date.substring(5,7)-1), item.date.substring(8,11));
                    var jumlah = item.jumlah;
                    alldate.push(
                        [date,jumlah]
                    );

                });
                console.log(alldate);

                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'date', id: 'Date' });
                dataTable.addColumn({ type: 'number', id: 'CrimeEveryDay' });
                dataTable.addRows(alldate);

                var chart = new google.visualization.Calendar(document.getElementById('totalperdate_chart'));

                var options = {
                    title: "Report Timeline",
                    calendar: {
                        cellSize: 23,
                        dayOfWeekRightSpace: 10,
                        monthLabel: {
                            fontName: 'Roboto',
                            fontSize: 12,
                            color: 'black',
                            bold: true,
                            italic: false
                        },
                        yearLabel: {
                            fontName: 'Roboto',
                            // fontSize: ,
                            color: '#D0D0D0' ,
                            bold: false,
                            italic: false
                        },
                    },
                };

                chart.draw(dataTable, options);
            }

        ;}
    });
</script>
@endsection
