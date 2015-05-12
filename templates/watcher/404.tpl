<div class="row" style="margin-top: 20%;">
    <div class="col-xs-4 col-xs-offset-4 text-center">
      <h1>未收录该话题</h1>
      <hr>
      <div class="row" style="margin-top: 20px;">
          <form class="form-inline">
            <div class="form-group">
              <label for="exampleInputName2"></label>
              <input id="newTopic" type="text" class="form-control nav-item-dark" value="{{if isset($smarty.get.word)}}{{$smarty.get.word}}{{/if}}">
            </div>
            <button id="submitTopic" type="button" class="btn btn-default nav-item-dark" data-loading-text="提交中">提交收录</button>
          </form>
          <p id="newTopicInfo" class="brand-breath" style="margin-top: 5px;">帮助我们收录更多的热门话题</p>
      </div>
    </div>
</div>

<script type="text/javascript">
$('button#submitTopic').on('click', function(){
    var topic = $('input#newTopic').val();
    if (topic == '') {
        alert('请输入话题');
        return false;
    };
    $(this).button('loading');
    $.ajax({
        type: 'GET',
        url: '/watcher/api/topic',
        dataType: 'json',
        data: {
            word: topic
        },
        success: function(data){
            $(this).button('reset')
            var text = '感谢您的提交,系统将会选择合适时机收录。';
            if (data.errno != 0) {
                text = data.errmsg;
            } else {
                $('input#newTopic').val('');
            }
            $('p#newTopicInfo').removeClass('brand-breath').addClass('brand-red').text(text);
        }.bind(this)
    });
})
</script>
