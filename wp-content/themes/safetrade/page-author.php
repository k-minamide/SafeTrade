<?php get_header() ?>

<?php
  // 投稿者IDの取得
  $user_id = htmlspecialchars($_GET['uid'], ENT_QUOTES);
  $title = get_cimyFieldValue($user_id, 'TITLE');
  $nickname = get_cimyFieldValue($user_id, 'NICKNAME');
  $avater_image = get_cimyFieldValue($user_id, 'AVATER_IMG');
  $appeal = get_cimyFieldValue($user_id, 'APPEAL');
  $kampa_key = get_cimyFieldValue($user_id, 'KAMPA_CONSUMER_KEY');
?>

  <script type="text/javascript">
  $(document).ready(function(){
    $.jsonp({
      url: 'http://kampa-proxy-api.herokuapp.com/kampa/<?php echo $kampa_key; ?>',
      dataType: 'jsonp',
      jsonp: 'callback',
      callbackParameter: 'callback',
      cache: true,
      pageCache: true,
      success: function(json) {
        for(var i in json.data) {
          // エリア
          var area = $('<div/>').attr('class', 'kampa_area');

          // 画像情報
          var amazon_image = $('<img/>').attr({'src': json.data[i].pic, 'class': 'img_amazon', 'height': '200'});

          // Kampa!情報
          var conf = $('<div/>').attr('class', 'kampa_conf');
          $('<h2/>').append(json.data[i].title).appendTo(conf);

          var progressbar = $('<div/>').attr('id', 'pg-' + json.data[i].item_bs);
          var progressbarValue = progressbar.find('.ui.progressbar-value');
          var progressLabel = $('<div/>').attr('class', 'progress-label');

          progressLabel.appendTo(progressbar);
          progressbar.appendTo(conf));


          // カンパボタン
          var button = $('<img/>').attr({'class': 'kampa_button', 'src': '<?php echo get_template_directory_uri(); ?>/images/kampabutton.png', 'width': '216', 'height': '59', 'alt': 'カンパする'});
          $('<a/>').attr('href', json.data[i].kmp_page).append(button).appendTo(conf);

          amazon_image.appendTo(area);
          conf.appendTo(area);
          area.appendTo('div#kampa_list');

          // プログレスバーの値を設定する
          progressbar.progressbar({ value: json.data[i].percentage });
          progressbarValue.css({'backend': '#c6c6c6'});
          progressLabel.text( '現在の状況： ' + json.data[i].perventege);

        }
      }
    });
  });
  </script>

  <!-- main start -->
  <div class="container">
    <h2><?php echo $title ?></h2>

    <div class="user_info">
      <p><?php echo $nickname ?> さん</p>
    </div>

    <div class="content">
      <?php echo $appeal ?>

      <div id="kampa_list"></div>
    </div>
  </div>
  <!-- main end -->

  <?php include( TEMPLATEPATH . '/login-area.php'); ?>

<?php get_footer(); ?>