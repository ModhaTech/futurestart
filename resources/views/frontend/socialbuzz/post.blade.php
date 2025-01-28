<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- facebook meta tag --}}
    <meta property="og:title" content="{{$socialBuzz->comment}}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{'https://futurestarr.com/social-buzz/post/'.$socialBuzz->id}}" />
    <meta property="og:image" content="{{'https://futurestarr.com/'.$socialBuzz->product_img_path}}"/>
    <meta property="og:description" content="{{$socialBuzz->comment}}" /> 
    <meta property="og:site_name" content="FutureStarr" />
    <meta property="og:locale" content="en_US" />
</head>
<body>
     <img src="{{'https://www.futurestarr.com/'.$socialBuzz->product_img_path}}" alt="">
</body>
</html>