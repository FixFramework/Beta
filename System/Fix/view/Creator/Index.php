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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Fix Framework | Create New Application</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- This is what you need -->
    <script src="http://cdn.fixframework.com/sweet-alert/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="http://cdn.fixframework.com/sweet-alert/sweetalert.css">
    <!--.......................-->

    <script>
        $(document).ready(function() {

            /*
            * Select Js
            * */
            $('select').material_select();

            /*
            * Menu Js
            * */
            $('.button-collapse').sideNav({
                    edge: 'left', // Choose the horizontal origin
                    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                    draggable: true // Choose whether you can drag to open on touch screens
                }
            );

            /*
            * Modal Js
            * */
            $('.modal').modal();

            /*
            * Creator Form Submit Process
            * */
            $(".creatorform").submit(function(){

                var controller   = $("input[name=controller]").val();
                var functions     = $("input[name=function]").val();

                if(controller === functions){

                    swal("WARNING","controller same as name function","warning");

                }else {


                    $(".logwrite").html("");
                    $('#modal1').modal('open');
                    $(".requestmodel").show();

                    var form = $(this).serialize();

                    $.ajax({
                        type: "post",
                        url: '?process',
                        data: form,
                        dataType: "json",
                        success: function (data) {

                            $.each(data, function (index, value) {

                                $(".logwrite").append("<a class='collection-item'>" + value + "</a>");

                            });

                            $(".requestmodel").hide();

                        },
                        complete: function () {

                            $(".requestmodel").hide();
                            $(".homelog").fadeIn();

                        },
                        statusCode: {
                            404: function () {
                                alert("hata");
                            }
                        }
                    });
                }

            });

        });
    </script>
    <style>

        body            { background: #1e88e5; margin: 0;  padding: 0;  width: 100%;  height: 100%;  color: white;  display: table;   font-weight: 100;  font-family: 'Lato'; }
        .title          { text-align: center; }
        .title > .one   { font-size: 45px; margin-top: 30px;}
        strong          { font-weight: 500;}
        .form           { margin-top: 25px; }
        .input-field label  { color: white !important; }
        input           { font-weight: 300 !important; font-size: 25px !important; }
        input:focus     { border-bottom: 1px solid white !important; }
        input:valid     { border-bottom: 1px solid white !important; }
        input:not([type]).invalid, input:not([type]):focus.invalid, input[type=text].invalid, input[type=text]:focus.invalid   { border-bottom: 1px solid white !important; box-shadow: none; }
        input:not([type]), input[type=text], input[type=password], input[type=email], input[type=url], input[type=time], input[type=date], input[type=datetime], input[type=datetime-local], input[type=tel], input[type=number], input[type=search], textarea.materialize-textarea { border-bottom: 1px solid white; }
        .select-wrapper input.select-dropdown {  font-weight: 100 !important;   border-bottom: 1px solid #ffffff; }
        .dropdown-content li>a, .dropdown-content li>span   { color: #1e88e5; font-weight: 300; }
        blockquote                                          { border-left: 5px solid #ffffff !important; display: table-cell; font-size: 18px;}
        blockquote:before                                    { margin-left: 10px; }
        .breadcrumb:last-child { color: #1e88e5;  font-weight: 300; font-size: 21px; }
        nav { text-align: center; color: #1e88e5; background-color: #ffffff; width: 100%; height: 56px; line-height: 56px; }
        .btn, .btn-large { text-decoration: none; color: #1e88e5; background-color: #ffffff !important; text-align: center; font-weight: 300; letter-spacing: .5px; transition: .2s ease-out; cursor: pointer; }
        .orta { text-align: center; }
        .btn:hover, .btn-large:hover { background-color: #ffffff !important; }
        .caret { color: white !important; }
        .side-nav .userView .background { background-color: #1e88e5; }
        .requestmodel { display: none; }
        .collection a.collection-item { display: block; transition: .25s; color: #3996e8; font-weight: 300; }
        .homelog { display: none; }
    </style>

</head>
<body>
<ul id="slide-out" class="side-nav">
    <li><div class="userView">
            <div class="background"></div>
            <a><img class="circle" src="http://fixframework.com/assets/img/repair-garage-white.png"></a>
            <a><span class="white-text name">Fix Framework</span></a>
            <a><span class="white-text email">info@fixframework.com</span></a>
        </div></li>
    <li><a href="http://docs.fixframework.com"><i class="fa fa-book" aria-hidden="true"></i>Documentation</a></li>
    <li><a href="https://github.com/FixFramework"><i class="fa fa-github" aria-hidden="true"></i>Github</a></li>
    <li><a href="http://fixframework.com/team.html"><i class="fa fa-users" aria-hidden="true"></i>Team</a></li>
    <li><a href="http://fixframework.com/about.html"><i class="fa fa-question-circle" aria-hidden="true"></i>About us</a></li>
    <li><a href="http://fixframework.com/contact.html"><i class="fa fa-paper-plane" aria-hidden="true"></i>Contact</a></li>

</ul>
<div class="container">
    <div class="row">
        <div class="col s12 title">
            <div class="col s12 one">FIX FRAMEWORK</div>
            <div class="col s12 two"><strong>APPLICATION CREATOR</strong></div>
        </div>
        <div class="col s12 form">
            <div class="row">
                <form class="col s12 creatorform" method="post" action="#" onsubmit="return false">
                    <div class="row">

                        <div class="input-field col s12">
                            <input id="app" name="app" readonly value="<?php echo System\Router\FIX_Router::appDedection(true); ?>" type="text"  class="validate" required="" aria-required="true" >
                            <label for="app">APPLICATION</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="controller" name="controller" type="text"  class="validate" required="" aria-required="true" >
                            <label for="controller"  data-error="wrong" >DEFAULT CONTROLLER</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="function" name="function" type="text"  class="validate" required="" aria-required="true" >
                            <label for="function"  data-error="wrong"  >DEFAULT FUNCTION</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="error" name="error" value="/" type="text" class="validate">
                            <label for="error" data-error="wrong"  >ERROR PAGE</label>
                        </div>
                        <div class="input-field col s6">
                            <select id="method" name="method"  class="validate" required="" aria-required="true" >
                                <option value="get">GET</option>
                                <option value="post">POST</option>
                            </select>
                            <label  for="method" data-error="wrong"  >METHOD</label>
                        </div>
                        <div class="input-field col s12">
                            <nav>
                                <div class="nav-wrapper">
                                    <div class="col s12">
                                        <span class="breadcrumb">DATABASE</span>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="input-field col s6">
                            <input id="dbserver" name="dbserver" type="text" class="validate">
                            <label for="dbserver">SERVER</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="dbtable" name="dbtable" type="text" class="validate">
                            <label for="dbtable">TABLE</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="dbusername" name="dbusername" type="text" class="validate">
                            <label for="dbusername">USER NAME</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="dbpassword" name="dbpassword" type="text" class="validate">
                            <label for="dbpassword">DB PASSWORD</label>
                        </div>
                        <div class="input-field col s12 orta ">
                            <button class="waves-effect waves-light btn">CREATE</button>
                        </div>
                        <div class="input-field col s12 orta ">
                            <span class="waves-effect waves-light btn button-collapse "  data-activates="slide-out" >MENU</span>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <nav>
            <div class="nav-wrapper">
                <div class="col s12">
                    <a class="breadcrumb">LOG</a>
                </div>
            </div>
        </nav>
        <div class="collection logwrite"></div>

        <div class="progress requestmodel">
            <div class="indeterminate"></div>
        </div>

        <div class="input-field col s12 orta homelog ">
            <span class="waves-effect waves-light btn" onclick="location.href = '/'" >GO TO HOME</span>
        </div>
    </div>
</div>

</body>
</html>