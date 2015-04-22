@extends('app')

@section('content')
    <div class="container snippet-container">
        <div class="row">
            <div class="col-sm-9">
                <h4>ナレッジを共有しよう</h4>
                <a href="{{ url('/snippet/create') }}" class="btn btn-info btn-post">ノウハウ・Tips・週報を投稿する</a>
                <div class="tab-pane active" id="feeds">
                    <ul class="nav nav-tabs top-tabs">
                        <li class="active"><a href="#newarraival" data-toggle="tab">新着投稿</a></li>
                        <li><a href="#weekly-report" data-toggle="tab">週報</a></li>
                    </ul>
                    <div class="tab-content">
                        <!--新着-->
                        <div class="tab-pane active" id="newarraival">
                            <div class="comments-list" id="articles-list">
                                <ul class="blue-knowledge-list">
                                    @foreach($snippets as $snippet)
{{--                                        {{{ dd($snippet) }}}--}}
                                    <li>
                                        <img class="blue-knowledge-list-thumb img-rounded" src="data:image/jpeg;base64,{{{ $snippet->users['thumbnail'] }}}" alt="">
                                        <div class="blue-knowledge-list-info">
                                            <a href="/snippet/{{{ $snippet->id }}}" class="blue-knowledge-list-title">{{{ $snippet->title }}}</a>
                                            <ul class="list-inline">
                                            @foreach($snippet->tags as $tag)
                                                <li>
                                                    <a href="" class="btn btn-default btn-xs">{{{ $tag['tag'] }}}</a>
                                                </li>
                                            @endforeach
                                            </ul>
                                            <p class="blue-knowledge-list-name">{{{ $snippet->users['name'] }}}が{{{ $snippet->created_at->format('Y/m/d H:i') }}}に投稿しました</p>
                                            {{--<p class="blue-knowledge-list-date">{{{ $snippet->created_at->format('Y/m/d H:i') }}}</p>--}}
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="btn-more text-center">
                                {!! $snippets->render() !!}
                            </div>
                        </div>
                        <!--マイフィード-->
                        <!--<div class="tab-pane" id="myfeed">-->
                        <!--<div class="comments-list">-->
                        <!--<% @articles.each do |article| %>-->
                        <!--<div class="media">-->
                        <!--<span class="media-left">-->
                        <!--&lt;!&ndash;<img src="http://lorempixel.com/40/40/people/1/">&ndash;&gt;-->
                        <!--</span>-->

                        <!--<div class="media-body">-->
                        <!--<p>-->
                        <!--<small><%= article.published.strftime("%Y/%m/%d") %></small>-->
                        <!--<small class="pull-right">-->
                        <!--<button type="button" class="btn btn-link like-button">-->
                        <!--<i class="glyphicon glyphicon-heart-empty"></i></button>-->
                        <!--</small>-->
                        <!--</p>-->
                        <!--<p class="media-heading article-name">-->
                        <!--<a href="<%= article.url %>" target="_blank"><%= article.name %></p></a>-->
                        <!--<p>-->
                        <!--<small>Posted by</small>-->
                        <!--<span><a href="blogs/<%= article.blog_id %>"><%= article.blog.name %></a></span>-->
                        <!--</p>-->
                        <!--</div>-->
                        <!--</div>-->
                        <!--<% end %>-->
                        <!--</div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <!--サイドバー-->
            <div class="col-sm-3">
                <div class="list-group">
                    <a class="list-group-item" href="#">週報</a>
                    <a class="list-group-item" href="#">伝達事項</a>
                    <a class="list-group-item" href="#">ほげほげ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
