<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title><![CDATA[ futurestarr.com/ ]]></title>
        <link><![CDATA[ https://www.futurestarr.com/feed ]]></link>
        <description><![CDATA[ Talent Marketplace: Buy or Sell - Mp3s,Mp4s,Photos: If you want to sell your raw talent to earn a lot of money online fast visit Future Starr! ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
  
        @foreach($posts as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ $post->canonical_url }}</link>
                <description><![CDATA[{!! $post->content !!}]]></description>
                <category>News</category>
                <author><![CDATA[{{ $post->author_first_name }} {{ $post->author_last_name }}]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->date }}</pubDate>
                <media:thumbnail url="{{asset($post->blog_img)}}" />
            </item>
        @endforeach
    </channel>
</rss>