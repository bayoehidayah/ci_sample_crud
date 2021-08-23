<script>
    $(document).ready(function(){
        AmCharts.makeChart("kt_amcharts_1", {
            "rtl": KTUtil.isRTL(),
            "type": "serial",
            "theme": "light",
            "dataProvider": [
            <?php  
                $string = "";
                for($i = 0; $i < sizeof($grade); $i++){
                    $string .= '{ "grade" : "Grade '.$grade[$i]['grade'].'", "total" : '.$grade[$i]['total'].' }, ';
                }

                echo substr($string,0, -1);
            ?>
            ],
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b> Pegawai",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "total"
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "grade",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
            },
            "export": {
                "enabled": false
            }

        });
    });
</script>