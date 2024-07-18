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
        <div class="header_navbar">
            <div class="header py-2 bg-light">
                <div class="d-flex justify-content-between aglin-items-center text-center">
                    <div class="ps-5">
                        <span class="text-secondary" style="font-size: 14px">Nơi cung cấp những căn phòng tốt nhất</span>
                    </div>
                    <div class="pe-5">
                        <span class="text-secondary" style="font-size: 14px">Liên lạc: 0834006771 | Phòng tốt | Nhà tốt</span>
                    </div>
                </div>
            </div> <br>
        </div>
        <div>
            <div>
                Chào Bạn <span style="font-weight: 500;">{{$user->username}}</span>
            </div>
            <div >
                Bạn đang yêu cầu thay đổi mật khẩu tải khoản <span class="title_email">{{$user->email}}</span>
            </div> <br>
            <div>
                Để cấp lại mật khẩu, Vui lòng click vào đường dẫn dưới đây: <a href="http://localhost:8000/account/reset_password/{{$token}}" class="link">Link xác nhận khôi phục mật khẩu.</a>
            </div>
            <div>
                Mọi thắc mắc xin vui lòng liên hệ hòm mail <span class="title_email">phongtrontot@gmail.com</span> để được hỗ trợ và giải đáp.
            </div>
            <div>
                Chúc các bạn có những trải nghiệm thú vị cùng <span class="link">PhongTroTot.com</span>
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
