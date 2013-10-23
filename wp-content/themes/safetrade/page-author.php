<?php get_header() ?>

      <!-- main start -->
      <div class="container">
        <?php
          // 投稿者IDの取得
          $user_id = htmlspecialchars($_GET['uid'], ENT_QUOTES);
          $title = get_cimyFieldValue($user_id, 'TITLE');
          $nickname = get_cimyFieldValue($user_id, 'NICKNAME');
          $avater_image = get_cimyFieldValue($user_id, 'AVATER_IMG');
          $appeal = get_cimyFieldValue($user_id, 'APPEAL');
          $kampa_key = get_cimyFieldValue($user_id, 'KAMPA_CONSUMER_KEY');


        ?>

        <h2><?php echo $title ?></h2>

        <div class="user_info">
          <p><?php echo $nickname ?> さん</p>
        </div>

        <div class="content">
          <?php echo $appeal ?>

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
                  $('<p/>').html('現在の状況').appendTo(conf);
                  var graph_area = $('<div/>').attr('class', 'graph_area');
                  $('<div/>').attr('class', 'graph').html(json.data[i].percentage + '%').appendTo(graph_area);
                  graph_area.appendTo(conf);

                  amazon_image.appendTo(area);
                  conf.appendTo(area);
                  area.appendTo('div#kampa_list');
                }
              }
            });
          });
          </script>
          <div id="kampa_list"></div>
          <div class="kampa_area">
            <div class="kampa_conf">
            </div>
          </div>
        </div>
      </div>
      <!-- main end -->

      <?php include( TEMPLATEPATH . '/login-area.php'); ?>
    </div>

<div id="container">
  <div id="content" role="main">
<?php
$users = get_users_of_blog();
foreach ( $users as $user ) :
  $the_user = new WP_User( $user->ID );
  if ( $the_user->has_cap( 'subscriber' ) ) :
?>
    <div class="user">
      <h2><?php echo $user->display_name; ?></h2>
      <?php echo get_avatar( $user->ID, 64, get_bloginfo('stylesheet_directory') . '/images/default-avatar.png' ); ?>
      <p><?php echo $the_user->description; ?></p>
    </div>
<?php
  endif;
endforeach;
?>
  </div>
</div>
<?php get_footer(); ?>