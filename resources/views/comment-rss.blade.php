@if($mess != '')
    <center> <h2>{{$mess}}</h2></center>
@else

<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ futurestarr.com/ ]]></title>
        <link><![CDATA[ https://www.futurestarr.com/feed ]]></link>
        <description><![CDATA[ Talent Marketplace: Buy or Sell - Mp3s,Mp4s,Photos: If you want to sell your raw talent to earn a lot of money online fast visit Future Starr! ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
        @php 
            $oldcmd = ''; $x = 1;  
        @endphp
        @foreach($posts as $post)
        @if($post->blog_id != '')
        @if($oldcmd != $post->blog_id)
        @if($x == 1)
            <item>
        @else
            </item>
            <item>
        @endif
            <title><![CDATA[{{ $post->blog_id }}]]></title>
            <link>{{ $post->status }}</link>
            <comments>{{$post->message}}</comments>
        @else
            <comments>{{$post->message}}</comments>
        @endif
        @php 
            $oldcmd = $post->blog_id; $x++; 
        @endphp
        @endif
        @endforeach
        </item>
    </channel>
</rss>

@endif