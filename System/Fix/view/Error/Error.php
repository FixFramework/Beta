<!--
/*
 * Author  : Fix Framework | Cengiz Akcan
 * Web     : fixframework.com
 * Mail    : info@fixframework.com
 * Docs    : docs.fixframework.com
 * Version : Beta
 * Github  : github.com/FixFramework
 * */
-->
<html>
<head>
    <title>Error Debug</title>

    <link href='https://fonts.googleapis.com/css?family=Lato:100&amp;subset=latin-ext' rel='stylesheet' type='text/css'>

    <style>
        /* 7. Layout styles */
        html {
            height: 100%; }

        body {
            min-height: 100%;
            position: relative;
            padding: 50px; }
        body:before {
            content: '';
            position: absolute;
            z-index: -1;
            background: -webkit-linear-gradient(top left, #D7BBEA, #65A8F1);
            background: linear-gradient(to bottom right, #D7BBEA, #65A8F1);
            top: 0px;
            left: 0px;
            bottom: 0px;
            right: 0px; }
        .all-wrapper {
            box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            max-width: 1600px;
            margin: 0px auto;
            position: relative;
            min-height: 100%; }
    </style>

</head>
<body>

    <div class='all-wrapper'>
       <?php print_r(error_get_last()); ?>

    </div>

</body>
</html>

