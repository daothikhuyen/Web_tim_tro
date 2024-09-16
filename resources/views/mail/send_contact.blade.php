<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="mail">
        <div>
            <div>
                <span>Tên người dùng: {{$username}}</span>
            </div>
            <div >
                Phương thức liên hệ: {{$email}}
            </div> <br>
            <div>
                Nội dung nghi vấn:
            </div>
            <div>
                {{$content}}
            </div>
        </div>
    </div>
</body>
</html>

<style>
    div{
        line-height: 30px;

    }

    .mail{
        width: 70%;
        max-width: 100%;
        margin: auto;
    }
   .header_navbar .navbar .navbar-brand {
        width: 120px;
    }

    .navbar-light .navbar-brand {
        color: rgba(0, 0, 0, .9);
    }
    .navbar-brand {
        padding-top: .3125rem;
        padding-bottom: .3125rem;
        margin-right: 1rem;
        font-size: 1.25rem;
        text-decoration: none;
        white-space: nowrap;
    }

    .title_email{
        font-weight: 500;
        color: #e65322;
        text-decoration: underline;
    }

    .link{
        font-weight: 500;
        color: rgb(49, 85, 243);
        cursor: pointer;
    }

    .link:hover{
        color: rgb(49, 85, 243,0.75);
    }


    .modal .body-send{
        padding: 10px 10px;
        border: 1px solid #dcdcdc;
        border-radius: 8px ;
        margin: 10px 0;
        cursor: pointer;
        transition: all .3s ease-in;
    }

    .modal .body-send:hover{
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .modal .model-body .img_success {
        width: 100%;
        text-align: center;
        transition: all .3s ease-out;
    }

    .modal .model-body .img_success img{
        width: 100px;
        max-width: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
