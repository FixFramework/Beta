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
    <title><?php echo $data["title"]; ?></title>

    <link href='https://fonts.googleapis.com/css?family=Lato:100&amp;subset=latin-ext' rel='stylesheet' type='text/css'>

    <style>
        body            {  margin: 0;  padding: 0;  width: 100%;  height: 100%;  color: #B0BEC5;  display: table;  font-weight: 100;  font-family: 'Lato';  }
        .container      {  text-align: center;  display: table-cell;  vertical-align: middle;  }
        .content        {  text-align: center;  display: inline-block;  }
        .title          {  font-size: 96px;  margin-bottom: 40px;  }
        .quote          {  font-size: 24px;  }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title"><?php echo $data["hood"]; ?></div>
        <div class="quote"><?php echo $data["subtitle"]; ?></div>
    </div>
</div>
</body>
</html>
