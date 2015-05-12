{{extends file='layout/main.tpl'}}
{{* 首页 *}}
{{block name=content}}
<script type="text/javascript">
    $("ul.navbar-nav li[role!='about']").html('');{{*清除导航栏中原本的搜索框*}}
</script>
<div class="row text-center head-title">
    <h1 style="display: inline;">守望者舆情监控</h1><small style="color: #83f6a5;">alpha</small>
</div>

{{* 搜索框 *}}
<div class="row center-block" style="width: 40%;margin-top: 20px;">
    <form class="input-group" action="/watcher/country/" method="get">
      <input name="word" type="text" class="form-control nav-item-dark" placeholder="关键字" tabindex="1">
      <span class="input-group-btn">
        <button class="btn btn-default nav-item-dark" tabindex="-1">搜索</button>
      </span>
    </form>
    <ul class="list-inline" style="margin-top: 10px; max-height: 20px; width: 550px;">
        <li>热门话题:</li>
      {{foreach from=$hotTopic item=item}}
        <li><a class="label label-default" style="background-color: #222;color: #9d9d9d;" href="/watcher/country/?word={{$item}}">{{$item}}</a></li>
        {{if $item@iteration >= 5}}{{* 为了样式最多显示五条热门话题 *}}
            {{break}}
        {{/if}}
      {{/foreach}}
    </ul>
</div>

{{* 全国整体情绪展示 *}}
<div class="row">
    <div class="center-block" id="wholeCountry" style="height: 500px;width: 50%;"></div>
</div>
<div class="row text-center">
    <h4 id="chartTitle" style="display: none;">实时情绪概况</h4>
</div>
<script type="text/javascript">

$('#wholeCountry').mouseenter(function(){
    $('#chartTitle').stop(true).fadeIn("slow");
}).mouseleave(function(){
    $('#chartTitle').stop(true).fadeOut("slow");
});


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
        var option = {
            backgroundColor : '#131313',
            title: {
                show: false
            },
            tooltip : {
                trigger: 'axis',
                show: true,
                showDelay: 0,
                hideDelay: 50,
                transitionDuration: 0,
                backgroundColor : 'rgba(255,0,255,0.7)',
                borderColor : '#f50',
                borderRadius : 8,
                borderWidth: 2,
                padding: 10,
                position : function(p) {
                    return [p[0] + 10, p[1] - 10];
                },
                textStyle : {
                    color: 'yellow',
                    decoration: 'none',
                    fontFamily: 'Microsoft YaHei',
                    fontSize: 15,
                    fontWeight: 'lighter'
                }
            },
            dataRange: {
                show: true,
                min: -100,
                max: 100,
                orient: 'horizontal',
                x: 'center',
                y: 'bottom',
                padding: [15, 0, 0, 0],
                itemWidth: 30,
                text: ['正面', '负面'], // 文本，默认为数值文本
                calculable: true,
                color: ['green', '#9d9d9d', 'red'],
                textStyle: {
                    color: '#9d9d9d'
                }
            },
            series: [{
                name: '情绪指数',
                type: 'map',
                mapType: 'china',
                clickable: false,
                hoverable: true,
                dataRangeHoverLink: false,
                mapValueCalculation: 'average',
                roam: false, //首页概况图禁止缩放
                itemStyle: {
                    normal: {
                        borderWidth: 2,
                        borderColor:'#9d9d9d',
                        label: {
                            show: true,
                            textStyle: {
                                color: '#131313'
                            }
                        }
                    },
                    emphasis: {
                        borderWidth: 2,
                        borderColor:'#0af',
                        color: null,
                        label: {
                            show: true
                        }
                    }
                },
                data: []
            }]
        };

        var chart = ec.init(document.getElementById('wholeCountry'));

        $.ajax({
            url: '/watcher/api/mood',
            dataType: 'json',
            success: function(data){
                if (data.errno != 0) {
                    alert(data.errmsg);
                    return ;
                };
                data = data.data;
                var ret = new Array();
                for (key in data) {
                    ret.push({name: key, value: data[key]});
                };
                option.series[0].data = ret;
                chart.setOption(option);
            }
        });
    });
</script>
{{/block}}
