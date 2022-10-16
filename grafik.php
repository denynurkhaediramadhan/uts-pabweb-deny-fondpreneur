<html>
    <head>
        <script type="text/javascript" src="js/fusioncharts.js"></script>
        <script type="text/javascript" src="js/themes/fusioncharts.theme.fint.js"></script>
        <script type="text/javascript">
            FusionCharts.ready(function(){
                    var hargaChart = new FusionCharts({
                        "type":"column3d",
                        "renderAt":"posisix",
                        "width": "900",
                        "height":"400",
                        "dataFormat":"json",
                        "dataSource":{
                            "chart":{
                                "caption":"Harga Buku",
                                "subCaption":"BY FONDPRENEUR",
                                "xaxisName":"nama_buku",
                                "yAxisName":"harga",
                                "theme":"fint"
                            },
                            "data":[
                
                                {"label":"Original","value":"207000"},
                                {"label":"Platform","value":"113000"},
                                {"label":"Sprint","value":"296000"},
                                {"label":"The 4 Hour","value":"349000"},
                                {"label":"The Lean","value":"180000"}
                            ]
                        }
                    });
                    hargaChart.render();
                }
            )
        </script>
    </head>
    <body>
        <div id="posisix"></div>
    </body>
</html>