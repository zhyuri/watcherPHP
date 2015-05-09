{{block name=content}}
<div id="map" style="height: 600px;"></div>

<script type="text/javascript">
function getGeo (item) {
    var ownerLoc = item.owner.location;
    var fromLoc = item.from.location;
    return [{
        geoCoord: [ownerLoc.longitude, ownerLoc.latitude]
    }, {
        geoCoord: [fromLoc.longitude, fromLoc.latitude]
    }];
}

function sameCity (item) {
    var ownerLoc = item.owner.location;
    var fromLoc = item.from.location;
    if (ownerLoc.id == fromLoc.id) {
        return ownerLoc.id;
    };
    return 0;
}

function getType(o)
{
    var _t;
    return ((_t = typeof(o)) == "object" ? o==null && "null" || Object.prototype.toString.call(o).slice(8,-1):_t).toLowerCase();
}
function extend(destination,source)
{
    for(var p in source)
    {
        if(getType(source[p])=="array"||getType(source[p])=="object")
        {
            destination[p]=getType(source[p])=="array"?[]:{};
            arguments.callee(destination[p],source[p]);
        }
        else
        {
            destination[p]=source[p];
        }
    }
}

require.config({
    paths: {
        echarts: './static/js/echarts'
    }
});

require(
    [
        'echarts',
        'echarts/chart/map'
    ],
    function(ec) {

        var mapOption = {
            backgroundColor: null,
            roam : true,
            animation : true,
            title: {
                text: '全国概况',
                subtext: '守望者舆情监控',
                x: 'center',
                y: 'top',
                textStyle: {
                    color: 'grey'
                }
            },
            series: [{
                name: "Watcher",
                type: 'map',
                mapType: 'china',
                mapLocation: {x:'center',y:'center',height: 500},
                selectedMode: null,

                itemStyle: {
                    normal: {
                        borderColor: 'rgba(100,149,237,0.2)',
                        borderWidth: 0.5,
                        areaStyle: {
                            color: '#1b1b1b'
                        }
                    }
                },
                data: [{}],
                hoverable: false,
                clickable: false,
                roam: true,
                markLine: {
                    effect: {
                        show: true,
                        loop: true,
                        period: 15,
                        scaleSize : 1,
                        color : 'rgba(204, 246, 255, 0.09)',
                        shadowColor : null,
                        shadowBlur : null
                    },
                    bundling: {
                        enable: true
                    },
                    large: true,
                    smooth: false,
                    smoothness: 0.1,
                    symbol: ['none', 'none'],
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(2, 166, 253, 0.05)',
                                type: 'solid',
                                width: 5,
                                opacity: 0.2
                            }
                        }
                    },
                    data: []
                },
                markPoint: {
                    symbol: 'circle',
                    symbolSize: 1.5,
                    large: false,
                    itemStyle: {
                        normal: {
                            color: 'rgba(255, 0, 0, 0.5)'
                        }
                    },
                    data: []
                }
            }]
        };

        var option = {
            timeline: {
                zlevel : 0,
                data: [],
                autoPlay: true,
                notMerge: true,
                playInterval: 10000
            },
            options: [mapOption]
        }

        var chart = ec.init(document.getElementById('map'));

        var topic = '';
        $.ajax({
            url: '/api/topic'+topic,
            dataType: 'json',
            success: function(data) {
                if (data.errno != 0) {
                    alert(data.errmsg);
                    return ;
                };
                data = data.data;

                var length = data.length;
                var startTime = new Date(data[0].time);//默认后端传来数据有时间顺序
                var endTime = new Date(data[length-1].time);
                var diff = (endTime.getTime() - startTime.getTime()) / 1000;//获取时间差的秒数

                // 2015-04-01T00:39:11+08:00
                var mod = 2;
                if (diff <= 2678400) {
                    mod = 2; // day
                } else if (diff <= 32140800) {
                    mod = 1; // month
                } else {
                    mod = 0; // year
                }

                var series = [];
                var dots = [];
                var tempSeries = [];
                var tempDots = {};
                extend(tempDots, citys);//深拷贝
                var city = 0;
                var label = 0;
                var thisOne = data[0].time.split('-', 3);
                var nextOne = [];

                for (var i = 0; i < length; i++) {
                    if ((city = sameCity(data[i])) == 0) {//连线两端不能是同一点
                        tempSeries.push(getGeo(data[i]));
                        tempDots[data[i].owner.location.id -1].weight ++;
                        tempDots[data[i].from.location.id -1].weight ++;
                    } else {
                        tempDots[city-1].weight++;//城市id与序号相差一
                    }
                    city = 0;//复位

                    //判断是否下一时间片
                    if (i < length - 1) {
                        nextOne = data[i+1].time.split('-', 3);
                    } else {
                        break;
                    }
                    if (thisOne[mod].split('T',1)[0] != nextOne[mod].split('T',1)[0]) {
                        series.push({time : data[label].time.split('T',1)[0], geo : tempSeries});
                        label = i+1;
                        dots.push(tempDots);
                        tempSeries = [];
                        tempDots = {};
                        extend(tempDots, citys);
                    };
                    thisOne = nextOne;
                };

                dots = dots.map(function(item){
                    var ret = [];
                    for(var index in item) {
                        if(item[index].weight > 0){
                            ret.push(item[index]);
                        }
                    }
                    return ret;
                });

                //到这里series的geo已可以直接赋给option里的data了
                //dots里边还有城市信息和权重，可以进一步处理
                option.timeline.data = series.map(function(v, i){
                    return v.time;//时间轴文本
                })

                length = series.length;//更新为组数
                for (var i = 0; i < length; i++) {
                    var temp = {};
                    $.extend(true, temp, mapOption);
                    $.extend(true, temp, {
                        title: {
                            'text': series[i].time//时间分组标签
                        },
                        series: [{
                            z : i,
                            markLine : {
                                data : series[i].geo//数组，连线信息
                            },
                            markPoint : {
                                data : dots[i].map(function(item){
                                    return {
                                        // name: item.city,
                                        // value: item.weight,
                                        geoCoord : [item.longitude, item.latitude]
                                    }
                                })//描点信息，城市名称、经纬度、权重
                            }
                        }]
                    });
                    option.options.push(temp);
                };

                chart.setOption(option);
            }
        });


    }
);
</script>
{{/block}}
