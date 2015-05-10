{{* 全国情感趋势图 *}}
{{block name=content}}

<span class="label label-default">转发数: 2000</span>
<span class="label label-default">参与用户: 2000</span>
<div class="row">
    <div class="center-block" id="moodTimeline" style="height: 650px;"></div>
</div>

<script type="text/javascript">
require.config({
    paths: {
        echarts: '{{$base}}watcher/static/js/echarts'
    }
});

require(
    [
        'echarts',
        'echarts/chart/map'
    ],
    function(ec) {
        var _optionTpl = {
            title: {
                show: true,
                text: '全国情绪发展图',
                subtext: '#{{$smarty.session.word}}#',
                x: 'center',
                y: 'top',
                textStyle: {
                    fontSize: 25,
                    fontWeight: 'bolder',
                    color: '#9d9d9d'
                }
            },
            tooltip: {
                trigger: 'axis',
                show: true,
                showDelay: 0,
                hideDelay: 50,
                transitionDuration: 0,
                backgroundColor: 'rgba(255,0,255,0.7)',
                borderColor: '#f50',
                borderRadius: 8,
                borderWidth: 2,
                padding: 10,
                position: function(p) {
                    return [p[0] + 10, p[1] - 10];
                },
                textStyle: {
                    color: 'yellow',
                    decoration: 'none',
                    fontFamily: 'Microsoft YaHei',
                    fontSize: 15,
                    fontWeight: 'lighter'
                }
            },
            dataRange: {
                show: false,
                min: -100,
                max: 100,
                orient: 'horizontal',
                x: 'center',
                y: 'bottom',
                padding: [15, 0, 0, 0],
                itemWidth: 30,
                text: ['正面', '负面'],
                calculable: true,
                color: ['green', '#9d9d9d', 'red'],
                textStyle: {
                    color: '#9d9d9d'
                }
            },
            series: []
        }
        var option = {
            timeline: {
                data: ['{{$labels}}'],
                label: {
                },
                autoPlay: true,
                playInterval: 1000
            },
            options: []
        };

        var data = {{$data}};
        for (i in data) {
            option.options.push($.extend({}, _optionTpl, {series: [data[i]]}));
        }

        var chart = ec.init(document.getElementById('moodTimeline'));
        chart.setOption(option);
    }
)
</script>







{{/block}}
