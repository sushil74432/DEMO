<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="{{ URL::asset('resources/css/main.css') }}"> -->
        <!-- Styles -->
        
        <style>
            body{
                /*margin: 0 5% 0 5%;*/
                padding: 2%;
                font: 1rem/1.5 "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
                color: #2C2C2C;
                font-weight: 400;

            }

            h1{
                font-size: 2rem;
                line-height: 1px;
            }
            .container {
                max-width: 1000px;
                margin: 0 auto;
            }

            .header{
                margin-left: 1%;
            }
            #posts h4{
                    margin-left: 1%;
            }

            .post{
                /*width: 700px;*/
                min-height: 105px;
                height: auto;
                margin: 1% 1% 2% 1%;
                padding : 1%;
                display: block;
                overflow: auto;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
            }
            .post:hover{
                background-color: #f0f0f0;
            }

            .left-item{
                width: 15%;
                float: left;
            }
            .left-item img{
                margin: 1em;
                width: 180px;   
            }
            .center-item{
                width: 65%;
                float: left;
                margin: 0 1% 0 1%;
                min-height: 185px;
                /*border-right: 1px rgba(0, 0, 0, 0.3) solid;*/
                padding-left: 1%;
                padding-right: 1%;
                letter-spacing: -1px;
                word-spacing: 1px;
            }
            .center-item .heading-link{
                text-decoration: none;
                font-family: 'Nunito', sans-serif;
                color: #2C2C2C;
            }

            .center-item .heading-link:hover{
                color: #ce4946;
            }

            .date {
                color: #848484;
            }
            .right-item{
                min-height: 200px;
                text-align: center;
                width: 15%;
                float: left;
                border-left: 1px rgba(0, 0, 0, 0.3) solid;

            }
            .avatar img{
                border-radius: 50%;
            }

            .author{
                color: #ce4946;
            }

            #pagination {
                text-decoration: none;
                text-align: center;
            }

            #pagination a{
                text-decoration: none;
                text-align: center;
                font: 16px Arial, sans-serif;
                width: 36px;
                height: 36px;
                padding: 1%;
                margin: 1%;
                color: #000;
                text-align: center;
                font: 16px Arial, sans-serif;
            }

            .active{
                border-radius: 50%;
                width: 36px;
                height: 36px;
                padding: 1%;
                margin: 1%;
                font-style: bold;
                background: #c83430;
                color: #fff !important;
                text-align: center;
                font: 16px Arial, sans-serif;

            }

            /*.no-circle{
                color : #000;
                font: 16px Arial, sans-serif;
            }*/
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div class="header">
                <h1 class = "title">MAQE FORUMS</h1>
                <h3 id="subtitle"> Your source of knowledge</h3>
            </div>
            <div id="posts">
                <h4>Posts</h4>
                <div class="postContainer">
                    @foreach($data["postData"] as $post)
                    <div class="post">
                        <div class="left-item">
                            <!-- <img src="{{$post['image_url']}}" alt="{{$post['title']}}"> -->
                            <img src="https://picsum.photos/180" alt="{{$post['title']}}">
                            
                        </div>
                        <div class="center-item">
                            <span class="title">
                                <h3>
                                    <a href="#" class = "heading-link">
                                        {{$post['title']}}
                                    </a>
                                </h3>
                            </span>
                            <span class="desc">{{$post['body']}}</span>
                            <br>
                            <span class="date">
                                <i class="fa fa-clock-o" style="font-size:15px"></i>
                                {{$post['created_time_ago']}}
                            </span>
                            
                        </div>
                        <div class="right-item">
                            <span class="avatar">
                                <!-- <img src="{{$post['avatar_url']}}" alt="{{$post['name']}}"> -->
                                <img src="https://i.pravatar.cc/150" alt="{{$post['name']}}">
                            </span>
                            <br>
                            <span class="author">{{$post['name']}}</span>
                            <br>
                            <span class="status"><strong>{{$post['role']}}</strong></span>
                            <br>
                            <span class="location"><i class="fa fa-map-marker fa-2" style="font-size:15px"></i> {{$post['place']}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="pagination">
                    @if (($data['currentPage']-1) > 0)
                        <a href="http://127.0.0.1:8000/{{($data['currentPage']-1)}}" class = "no-circle"> <strong>Previous</strong></a>
                    @endif
    
                    @for ($i = 1; $i <= $data["totalPages"]; $i++)
                        <a href="http://127.0.0.1:8000/{{$i}}" class = "{{($data['currentPage'] == $i) ? 'active' : ''}}"> <strong>{{ $i }}</strong> </a>
                    @endfor

                    @if (($data['currentPage']) < $data['totalPages'])
                        <a href="http://127.0.0.1:8000/{{($data['currentPage']+1)}}" class = "no-circle"> <strong>Next</strong></a>
                    @endif

                </div>
            </div>

        </div>
    </body>
</html>
