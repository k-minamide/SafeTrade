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

          // Kampa! エリア
          var link_box = $('<div/>').attr('class', 'kampalink-box');
          // Kampa! image
          var link_image = $('<div/>').attr('class', 'kampalink-image');
          // box image
          var amazon_image = $('<img/>').attr({'src': json.data[i].pic, 'alt': json.data[i].title});
          // link
          $('<a/>')
            .attr({'href': json.data[i].kmp_page, 'title': json.data[i].title, '_target': 'blank'})
            .append(amazon_image)
            .appendTo(link_image);

          // info area
          var link_info = $('<div/>').attr('class', 'kampalink-info');
          // name area
          var link_name = $('<div/>').attr('class', 'kampalink-name');
          // name
          $('<a/>')
            .attr({'href': json.data[i].kmp_page, 'title': json.data[i].title, '_target': 'blank'})
            .append(json.data[i].title)
            .appendTo(link_name);

          // detail
          var link_detail = $('<div/>').attr('class', 'kampalink-detail');

          // progressbar
          var progressbar = $('<div/>').attr('id', 'pg-' + json.data[i].item_bs);
          var progressbarValue = progressbar.find('.ui.progressbar-value');
          var progressLabel = $('<div/>').attr('class', 'progress-label');

          // プログレスバーの値を設定する
          progressbar.progressbar({ value: false });
          progressbar.progressbar({ value: json.data[i].percentage });
          progressbarValue.css({'backend': '#c6c6c6'});
          progressLabel.text( '現在の状況： ' + json.data[i].percentage + ' %' );

          progressLabel.appendTo(progressbar);
          progressbar.appendTo(link_detail);

          // カンパボタン
          var link_button = $('<div/>').attr('class', 'kampalink-button');
          var button = $('<img/>').attr({
                'class': 'kampa_button',
                'src': '<?php echo get_template_directory_uri(); ?>/images/kampabutton.png',
                'width': '146',
                'height': '40',
                'alt': 'カンパする'});
          $('<a/>')
           .attr({'href': json.data[i].kmp_page, '_target': 'blank'})
           .append(button)
           .appendTo(link_button);

          // 合体
          link_image.appendTo(link_box);
          link_name.appendTo(link_info);
          link_button.appendTo(link_detail);
          link_detail.appendTo(link_info);
          link_info.appendTo(link_box);

          link_box.appendTo(kampa_list);
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