<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/ForumClass.inc.php');
$forum = new \Forum();
$forum->checkSession();
$sessionObj = \Forum\Session::getInstance();
$currentUser = \Forum\User::getById($sessionObj->getUserId());
$currentUser->getSettingsObject();
$dateTimeZoneObj = new DateTimeZone(ini_get('date.timezone'));
$backgroundImageObj = new \Forum\BackgroundImages();

?>
<!doctype html>
<html>
  <head>
    <title>Hondaforum.hu</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/jstorage/jstorage.min.js"></script>
    <script type="text/javascript" src="/js/json/json2.js"></script>
    <script type="text/javascript" src="/js/jsgettext/Gettext.js"></script>
    <script type="text/javascript" src="/js/sprintf.js"></script>
    <script type="text/javascript" src="/js/date.format.js"></script>
    <script type="text/javascript" src="/js/qTip2/dist/jquery.qtip.js"></script>
    <script type="text/javascript" src="/js/yepnope/yepnope.1.5.4-min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript">
      Forum.settings.displayLanguage = '<?php print $currentUser->getLanguage()?>';
      Forum.settings.cacheKey = '<?php print $forum->configOptions->cacheKey?>';
      Forum.settings.languageObj = <?php print json_encode($forum->configOptions->languageArray)?>;
      Forum.settings.usedSkin = '<?php print $currentUser->getUsedSkin()?>';
      Forum.settings.timeZoneDiff = <?php print $dateTimeZoneObj->getOffset(new DateTime('now', new DateTimeZone('GMT'))) / 60?>;
      Forum.settings.bgImageArray = <?php print json_encode($backgroundImageObj->getSource())?>;
      Forum.settings.userSettings = <?php print json_encode($sessionObj->getSettings())?>;
    </script>
<!--

    <script type="text/javascript" src="/js/widget/forumTabs.js"></script>
    <script type="text/javascript" src="/js/widget/topicList.js"></script>
    <script type="text/javascript" src="/js/model/Topic.js"></script>
    <script type="text/javascript" src="/js/widget/topicName.js"></script>
    <script type="text/javascript" src="/js/controller/topic.js"></script>
    <script type="text/javascript" src="/js/model/User.js"></script>
    <script type="text/javascript" src="/js/controller/user.js"></script>
    <script type="text/javascript" src="/js/widget/dateTime.js"></script>
    <script type="text/javascript" src="/js/widget/userName.js"></script>
    <script type="text/javascript" src="/js/widget/topicGroup.js"></script>

-->
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="/js/qTip2/dist/jquery.qtip.min.css" type="text/css" />
    <link rel="stylesheet" href="/skins/<?php print $currentUser->getUsedSkin()?>/css/style.css" type="text/css" />
  </head>
  <body>
    <div id="pageHolder">
      <div id="loader">
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/skins/' . $currentUser->getUsedSkin() . '/html/loaderTemplate.html')?>
      </div>
      <div id="mainContentHolder">
        <div></div>
        <div id="tabsHolder">
          <div></div>
          <div id="languageSelectorHolder">
            <form id="languageSelectorForm">
            <select></select>
            </form>
          </div>
          <div id="contentHolder">
            <div id="mainTab">
              <ul id="tabList">
              </ul>
            </div>
          </div>
        </div>
        <div id="sidebarHolder"></div>
      </div>
    </div>
  </body>
</html>
